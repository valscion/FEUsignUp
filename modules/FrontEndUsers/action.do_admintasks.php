<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: FrontEndUsers (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow management of frontend
#  users, and their login process within a CMS Made Simple powered 
#  website.
# 
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin 
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE
if( !isset($gCms) ) exit;

if( !$this->_HasSufficientPermissions('usersngroups') )
  {
    return;
  }

if( isset( $params['button_exportusers'] ) )
  {
    $export_passhash = 0;
    if( isset($params['export_passhash']) ) $export_passhash = (int)$params['export_passhash'];

    // we want to export a csv file do we
    // Start with an empty output (this will become the CSV file)
    $output = '';

    $last_groupname = '';

    // Print headings in the output at the start of each new 

    $db =& $this->GetDb();

    // Start by getting a table of each user for each group they are in
    $uquery = 'SELECT DISTINCT u.id,u.username,u.password,u.createdate,u.expires
                 FROM '.cms_db_prefix().'module_feusers_users u';

    $dbresultu = $db->Execute( $uquery );
    if( !$dbresultu || ($dbresultu->RecordCount() == 0) )
      {
	echo $db->ErrorMsg();
	exit();
      }
	
    $propdefns = $this->GetPropertyDefns();
    if( !$propdefns )
      {
	$this->SetError($this->Lang('error_propertydefns'));
	$this->RedirectToTab($id,'admin');
      }

    // Output headings relevant to this group
    set_time_limit(9999);
    $output_heading = '';
    {
      $columns = array('##userid','username','createdate','expires','groupname');
      // todo - output something sensible for groupname, userid, username, createdate, expires
      if( $export_passhash )
	{
	  $columns = array('##userid','username','passwordhash','createdate','expires','groupname');
	}
      $output_heading .= implode(',',$columns);
    }

    $groups = Array();
    $fields = Array();
    while( $urow = $dbresultu->FetchRow() )
      {
	$line = array();
	$line[] = $urow['id'];
	$line[] = $urow['username'];
	if( $export_passhash )
	  {
	    $line[] = $urow['password'];
	  }
	$line[] = $urow['createdate'];
	$line[] = $urow['expires'];
	
	$gquery = 'SELECT DISTINCT 	g.id, g.groupname
				FROM '.cms_db_prefix().'module_feusers_belongs b
				LEFT JOIN '.cms_db_prefix().'module_feusers_groups g
				  ON  g.id = b.groupid
				WHERE b.userid = ?
				ORDER BY g.groupname';
	$dbresultg = $db->Execute( $gquery, array($urow['id']) );
	if( !$dbresultg || ($dbresultg->RecordCount() == 0) )
	  {
	    $output .= implode(',',$line)."\n";
	    continue;
	  }
	
	$first_group = true;
	$ugroups = array();
	while( $grow = $dbresultg->FetchRow() )
	  {
	    $ugroups[] = $grow['groupname'];
	    if (!isset( $groups[ $grow['groupname'] ] ))
	      {
		// Get the list of property names for this group in the correct order
		$fquery = "SELECT name FROM ".cms_db_prefix()."module_feusers_grouppropmap
						WHERE group_id = ?
						ORDER BY sort_key";
		$dbresultf = $db->Execute( $fquery, array($grow['id']) );
		if( !$dbresultf || ($dbresultf->RecordCount() == 0) )
		  {
		    echo $db->ErrorMsg();
		    exit();
		  }
		// now iterate through this group properties
		while ( $frow = $dbresultf->FetchRow() )
		  {
		    if (!isset(  $fields[ $frow['name'] ] ))
		      {
			$output_heading .= ",".'"'.$frow['name'].'"';
			$fields[ $frow['name'] ] = 'true';
		      }
		  }
		$groups[ $grow['groupname'] ] ='true';
	      }
	  }
		$line[] = implode(':',$ugroups);

		// For this user, get all their fields and use a right join to "fill in the blanks"
		// for any missing fields which shouldbe in this group
		$pquery = "SELECT * FROM ".cms_db_prefix()."module_feusers_properties as c WHERE userid=?";
		$dbresultp = $db->Execute( $pquery , array($urow['id']) );
		$props = Array();
		if( $dbresultp && $dbresultp->RecordCount() > 0 )
		{
		  while ( $prow = $dbresultp->FetchRow() )
		    {
		      if(  isset( $propdefns[$prow['title']] ))
			{
			  $props[ $prow['title'] ] = array($prow['data'],$propdefns[$prow['title']]);
			}else
			{
			  // todo, fatal error
			  echo "DEBUG: FATAL, could not find property definition for ".$prow['title']."<br/>";
			  exit();
			}
		    }
		}

		foreach ( $fields as $key => $value )
		{
			if (isset( $props[ $key ] ))
			{
				// now we have to handle special property types
				//print_r($props[ $key ]);
				switch ( $props[ $key ][1]['type'] )
				{
					case 0: // text
					case 1: // checkbox
					case 2: // email
					case 3: // textarea
					case 6: // image
						// no special handling
						$line[] = '"'.$props[$key][0].'"';
						break;
					case 4: // dropdown
					case 5: // multiselect
					case 7: // radiobutton
						// check each of the values in the string
						$options = $this->GetSelectOptions( $key );
						$tmpvalues = explode(',',$props[ $key ][0]);
						$tmp2 = array();
						foreach( $tmpvalues as $onevalue )
						{
							foreach( $options as $opttext => $optname )
							{
								if( $optname == $onevalue )
								{
									$tmp2[] = $opttext;
									break;
								}
							}
						}
						if( count($tmp2) != count($tmpvalues) )
						{
							echo "There is a problem with the options for ".$props[ $key ]." field in record ".$urow['username']."<br />";
							exit(); 	// TODO: Add these fields to Lang
						}
						$line[] = '"'.implode(':',$tmp2).'"';
						break;
					case 8: // date
					  if( isset($props[$key][0]) && $props[$key][0] )
					    {
					      $line[] = date('m-d-Y',$props[ $key ][0]);
					    }
					  else
					    {
					      $line[] = '""';
					    }
					  break;
				}
			}else
			{
				$line[] = '""';
			}
		}
			
		$output .= implode(',',$line)."\n";
	}

    $handlers = ob_list_handlers(); 
    for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }
    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header('Content-Disposition: attachment; filename=feusers.csv');
    echo $output_heading."\n".$output;    
    exit();
  }
else if( isset( $params['button_exportuserhistory'] ) )
  {
    include(dirname(__FILE__).'/function.admin_exportuserhistory.php');
  }
else if( isset( $params['button_clearuserhistory'] ) )
  {
    include(dirname(__FILE__).'/function.admin_clearuserhistory.php');
  }
else if( isset( $params['button_importusers'] ) )
  {
    include(dirname(__FILE__).'/function.admin_importusers.php');
  }
  
// EOF