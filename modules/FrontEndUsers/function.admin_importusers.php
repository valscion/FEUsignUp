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


// A function to read a line from the file
// trim any newline or whitespace characters from it
// clear any comments from the line
// and return what's left.
function _fgets($fh,$num = '')
{
  if( !$fh ) return;
  $pos1 = ftell($fh);
  
  $line = fgets($fh,$num);
  if( strpos($line,"\r") === FALSE )
    {
      return $line;
    }

  // line is probably a crappy mac line.
  $len1 = strlen($line);
  $pos = strpos($line,"\r");

  $line = substr($line,0,$pos);
  fseek($fh,($len1 - $pos -1 ) * -1,SEEK_CUR);
  return $line;
}


function _getline(&$fh,$comments = '//')
{
  $inline = _fgets($fh,4096);
  $pos = strpos($inline,$comments);
  if( $pos !== FALSE )
    {
      $line = substr($inline,0,$pos);
    }
  return trim($inline);
}

function _errorout($str)
{
  echo '<div class="error">'.$str."</div>\n";
  flush(); @ob_flush();
}

function _resultout($prompt,$value)
{
  echo '<div class="reportline">';
  echo '<p class="prompt">'.$prompt.'</p>';
  echo '<p class="value">'.$value.'</p>';
  echo '</div>';
}

//
// 1.  Check the input parameters
// 
if( !isset( $params['input_importdestgroup'] ) )
  {
    $this->RedirectToTab($id,'admin',array('error'=>$this->Lang('error_insufficientparams')));
    return;
  }

$key = $id.'input_importusersfile';
if( (!isset( $_FILES[$key] )) 
    || $_FILES[$key]['size'] <= 0 
    || $_FILES[$key]['error'] != 0 )
  {
    $this->RedirectToTab($id,'admin',
			 array('error'=>$this->Lang('error_missing_upload')));
    return;
  }


if( !feu_utils::using_std_consumer() )
  {
    $this->SetError($this->Lang('error_notsupported'));
    $this->RedirectToTab($id,'admin');
  }

$groups = array();
$grouppropmap = $this->GetGroupPropertyRelations( $params['input_importdestgroup'] );
$groupinfo = $this->GetGroupInfo( $params['input_importdestgroup'] );	
if( $grouppropmap[0] == FALSE )
{
		$this->RedirectToTab($id,'admin',
				     array('error'=>$this->Lang('error_nogroupproperties')));
		return;
}
$propdefns = $this->GetPropertyDefns();
if( !$propdefns )
{
  $this->RedirectToTab($id,'admin',
		array('error'=>$this->Lang('error_propertydefns')));
	return;
}
$groups[ $groupinfo['groupname'] ] =  $grouppropmap;
$default_group = $groupinfo['groupname'];

$imageDir = $gCms->config['uploads_path'].DIRECTORY_SEPARATOR;
$imageDir .= $this->GetPreference('image_destination_path', 'feusers');

//
// 2.  Open the uploaded file
//
$handle = fopen($_FILES[$key]['tmp_name'], "r");
if( !$handle )
{
	$this->RedirectToTab($id,'admin',
			     array('error'=>$this->Lang('error_couldnotopenfile')));
	return;
}

//
// 3.  Read the first line, validate it's syntax, and build a field map
//
$firstline = _getline($handle);
if( substr($firstline,'##') != 0 )
{
	# the top line doesn't have two pound chars
	$this->RedirectToTab($id,'admin',
			     array('error'=>$this->Lang('error_importfileformat')));
	return;
}
$tmpmap = cge_array::smart_explode($firstline);
if( count($tmpmap) < 3 )
{
	# insufficient fields
	$this->RedirectToTab($id,'admin',
			     array('error'=>$this->Lang('error_importfileformat')));
	return;
}
$fieldmap = array();
$i=0;
foreach( $tmpmap as $tmp )
{
	  if( isset($fieldmap[$tmp]) )
	{
	  # duplicate field reference
	  die('error 3');
	  $this->RedirectToTab($id,'admin',
			       array('error'=>$this->Lang('error_importfileformat')));
	  return;
	}
$fieldmap[ trim($tmp,'\"#') ] = $i;
$i++;
}


//
// 4.  Check the field map against the required fields, and the groups properties
//

//
// 4.1 Check for standard fields
$have_username = FALSE;
$have_password = FALSE;
$have_expires  = FALSE;
$have_groups  = FALSE;
$have_userid  = FALSE;

foreach( $fieldmap as $onefieldname => $index )
{ 
	if( $onefieldname == 'username' )
	{
		$have_username = TRUE;
		continue;
	}

	if( $onefieldname == 'password' )
	{
		$have_password = TRUE;
		continue;
	}

	if( $onefieldname == 'expires' )
	{
		$have_expires = TRUE;
		continue;
	}

	if( $onefieldname == 'groupname' )
	{
		$have_groups = TRUE;
		continue;
	}
	if( $onefieldname == 'userid' )
	{
		$have_userid = TRUE;
		continue;
	}
}
if( $have_username === FALSE )
{
	// could not find required field 
	$this->RedirectToTab($id,'admin',
			     array('error'=>$this->Lang('error_importrequiredfield',
							'username')));
	return;
}

// Only use if we aren't importing a group field -- This will be done on the user level since we now use a group field
// 4.2 check for required properties
//

if ($have_groups === FALSE)
{
	$ufieldmap = array();
	$ugroups = $params['input_importdestgroup'];
	foreach( $grouppropmap as $onegroupprop )
	{
		if( $onegroupprop['required'] != 0)
		{
		
			if( $onegroupprop['required'] == 2 && !isset($fieldmap[$onegroupprop['name'] ]) )
			{
				// could not find required field 
				 $this->RedirectToTab($id,'admin',
						      array('error'=>$this->Lang('error_importrequiredfield',
										 $onegroupprop['name'])));
				return;
			}
			if( isset($fieldmap[$onegroupprop['name'] ]) )
			{
				$ufieldmap[$onegroupprop['name']] = $fieldmap[$onegroupprop['name']];
			}
		}
	}
}

//
// 5.  Prepare for progress output
//
echo '
<style type="text/css">
	div.progress {
		color: #384654;  
	}
	div.error {
		color: #cc0000;
	}
	div.reportline {
		clear: left;
		padding-top: 1px;
		width: 97%; 
		overflow: hidden;
	}
	p.prompt {
	font-weight: normal;
		float: left;
		padding-top: 5px;
		padding-right: 5px;
		width: 15em;
		margin-bottom: 0.5em;
	}
	p.value {
		font-weight: bold;
		float: left;
		padding-top: 5px;
		margin-bottom: 0.5em;
	}
</style>';
echo '
<div class="pageoverflow">
<div class="progress" align="center">';


//
// 6.  Begin Importing Records
//
$lineno = 1; // we've already read one line
$errors = 0;
$added  = 0;
while( !feof( $handle ) )
{
	//
	// 6.1 Get a line, and convert it into fields
	$line = _getline( $handle );
	$lineno++;
	if( $line == '' ) continue;
	$fields = cge_array::smart_explode( $line );
	$importerror = FALSE;
	
	//
	// 6.2 get the username, password and expires data
	//     and add the user
	$uprops=array();
	$userid = '';
	$username = trim($fields[$fieldmap['username']],'\"');
	$password = 'changeme';               // todo, customizable
	$expires  = strtotime("+10 years");   // todo, customizable
	if( $have_password )
	{
		// expect plaintext password
		$password = trim($fields[$fieldmap['password']],'\"');
	}
	if( $have_expires )
	{
		// expect a string time
		$expires = strtotime(trim($fields[$fieldmap['expires']],'\"'));
	  }
	if( $have_userid  && ( $fields[$fieldmap['userid']] != '' ))
	{
		$userid = trim($fields[$fieldmap['userid']],'\"');
		if( !$have_password )
		{
			$password = '';
		}
	}
	
	if( $have_groups )
	{
		$ufieldmap = array();
		$grpstring = trim($fields[$fieldmap['groupname']],'\"');
		if( $grpstring == '' )
		{
			$grpstring = $default_group;
		}
		$group_array = explode(':', $grpstring);
		$ugroups = array();
		foreach( $group_array as $name)
		{
			$name = trim($name,'\"');  // Make sure the are no \" in the field
			$gid = $this->GetGroupID($name);
			$ugroups[] = $gid;
			if( !isset($groups[$name]) )
			{
				$grouppropmap = $this->GetGroupPropertyRelations( $gid );
				if( $grouppropmap[0] == FALSE )
				{
						$this->RedirectToTab($id,'admin',
								     array('error'=>$this->Lang('error_nogroupproperties')));
							   return;
				}else
				{
					$groups[$name] = $grouppropmap;
				}
			}
			foreach( $groups[$name] as $onegroupprop )
			{
				if( !isset($ufieldmap[ $onegroupprop['name'] ]) &&  $onegroupprop['required'] != 0)
				{
				
					if( $onegroupprop['required'] == 2 && (!isset($fieldmap[$onegroupprop['name'] ]) || $fields[$fieldmap[$onegroupprop['name'] ]] == '') )
					{
						// could not find required field 
						_errorout($this->Lang('error_importrequiredfield',$onegroupprop['name'].' for line '.$lineno));
						$importerror = TRUE;
						$errors++;
						break;
					}
					if( isset($fieldmap[$onegroupprop['name'] ]) )
					{
						$ufieldmap[$onegroupprop['name']] = $fieldmap[$onegroupprop['name']];
					}
				}
			}
		}
	}
//
// 6.3 data validation on the properties
	foreach( $ufieldmap as $key => $index )
	{
		$setprop = TRUE;
		switch( $key )
		{
			case 'username':
			case 'password':
			case 'expires':
			case 'groupname':
			case 'userid';
				// these are already handled
				$setprop = FALSE;
				break;
			default:
			break;
		}
		$propvalue = trim($fields[$index],'\"');

		if( $setprop == FALSE  ||  $propvalue == '')
		{
			continue;
		}


		// now we have to handle special property types
		if( !isset( $propdefns[$key] ) )
		{	
			// TODO lang() for this
			_errorout($this->Lang('error_importusers',$lineno, 'Prop '.$key.' is missing') );
			$importerror = TRUE;
			$errors++;
			continue;
		}

		switch( $propdefns[$key]['type'] )
		{
			case 2: // email
				$result = $this->IsValidEmailAddress($propvalue, $uid);
				if( $result[0] == false )
				{
					_errorout($this->Lang('error_importusers',$lineno, $result[1],$key) );
					$importerror = TRUE;
					$errors++;
					break;
				}
			case 0: // text
				// validate it's length
				if( strlen($propvalue) > $propdefns[$key]['maxlength'] )
				{
					_errorout($this->Lang('error_importusers',$lineno,
								  $this->Lang('error_importfieldlength',$key)));
					$importerror = TRUE;
					$errors++;
				}
				break;
			case 1: // checkbox
			case 3: // textarea
				// no validation here
				break;
			case 4: // dropdown
			case 5: // multiselect
			case 7: // radiobutton
				// check each of the values in the string
				$options = $this->GetSelectOptions($key);
				$tmpvalues = explode(':',$propvalue);
				$tmp2 = array();
				foreach( $tmpvalues as $onevalue )
				{
					foreach( $options as $opttext => $optname )
					{
						if( $opttext == $onevalue )
						{
							$tmp2[] = $optname;
							break;
						}
					}
				}
				if( count($tmp2) != count($tmpvalues) )
				{
					_errorout($this->Lang('error_importusers',$lineno,
						      $this->Lang('error_importfieldvalue',$key)));
					$importerror = TRUE;
					$errors++;
				}
				$propvalue = implode(',',$tmp2);
				break;

			case 6: // image
				// ensure the image exists
				if( !file_exists( $imageDir.DIRECTORY_SEPARATOR.$propvalue ) )
				{
					_errorout($this->Lang('error_importusers',$lineno,
							      $this->Lang('error_importfilenotfound',$propvalue)));
					$importerror = TRUE;
					$errors++;
				}
				break;
			case 8: // date
				$tmp = explode('-',$propvalue);
				$propvalue = mktime(0,0,0,$tmp[0],$tmp[1],$tmp[2]);
				break;
		}

		if( !$importerror )
		{
			$uprops[] = $key.'='.$propvalue;
		}
	} // foreach

	// 
	// 6.4 Cleanup, Send the event
	//     and do auditing
	if( $importerror == FALSE )
	{
		if ( $have_userid && $userid != "")
		{
			$result = $this->SetUser($userid, $username, $password, $expires );
		}else
		{
			$result = $this->AddUser( $username, $password, $expires );
		}
		if( $result[0] === FALSE )
		{
				_errorout($this->Lang('error_importusers',$lineno,$result[1]));
				$errors++;
				continue; 
		 } 
		$uid = $result[1];
		$this->SetUserGroups($uid,$ugroups); 
		$result = $this->SetUserProperties($uid,$uprops);
		if( $result == FALSE )
		{
				_errorout($this->Lang('error_importusers',$lineno,"Error Setting User Properties"));
				$errors++;
				continue; 
		 } 
		$added++;
		// send the event
		// add something to the audit log
	}
} // while


//
// 7.  Display the 'finished' form, and close the file
//
fclose($handle);
$formtext = '';
$formtext .= $this->CreateFormStart($id,'defaultadmin',$returnid,'post','',false,'',
				    array('active_tab'=>'admin'));
$formtext .= $this->CreateInputSubmit($id,'submit',$this->Lang('prompt_return'));
$formtext .= $this->CreateFormEnd();				    
echo '</div><!-- progress -->';
echo '<p>'.$this->Lang('import_complete_msg').'</p>';
_resultout($this->Lang('prompt_linesprocessed'),$lineno);
_resultout($this->Lang('prompt_errors'),$errors);
_resultout($this->Lang('prompt_recordsadded'),$added);
echo '<p class="pagetext">&nbsp;</p>';
echo '<p class="pageinput">'.$formtext.'</p>';
echo '</div><!-- pageoverflow -->';

// EOF
?>
