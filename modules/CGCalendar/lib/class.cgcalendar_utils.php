<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Skeleton (c) 2008 
#      by Robert Allen (akrabat) and
#         Robert Campbell (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow displaying calendars,
#  and management and display of time based events.
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

class cgcalendar_utils
{
  static public function get_uid_by_username($username,$check_admin = false)
  {
    if( $check_admin )
      {
	global $gCms;
	$userops = $gCms->GetUserOperations();
	$user = $userops->LoadUserByUsername($username);
	if( is_object($user) )
	  {
	    return $user->id * -1 - 100;
	  }
      }

    $feu = cge_utils::get_module('FrontEndUsers');
    if( !$feu ) return FALSE;
    
    $info = $feu->GetUserInfoByName($username);
    if( !is_array($info) ) return FALSE;
    if( $info[0] == FALSE ) return FALSE;
    return $info[1]['id'];
  }


  static public function get_username($uid)
  {
    if( $uid < -100 )
      {
	// an admin user
	global $gCms;
	$userops = $gCms->GetUserOperations();
	$user = $userops->LoadUserByID($uid * -1 - 100);
	if( !$user )
	  {
	    return FALSE;
	  }
	return $user->username;
      }
    else if( $uid > 0 )
      {
	$feu = cge_utils::get_module('FrontEndUsers');
	if( !$feu ) return FALSE;

	$userinfo = $feu->GetUserInfo($uid);
	if( !is_array($userinfo) ) return FALSE;

	if( $userinfo[0] != TRUE ) return FALSE;
	return $userinfo[1]['username'];
      }

    return FALSE;
  }

  function expand_events($eventids,$returnid,$parameters,$limit = 10000,$startoffset = 0)
  {
    if( !is_array($eventids) || count($eventids) < 1 ) return FALSE;
    
    $module = cge_utils::get_module('CGCalendar');
    global $gCms;
    $db =& $gCms->GetDb();
    
    $events_to_categories_table_name = $module->events_to_categories_table_name;
    $categories_table_name = $module->categories_table_name;
    $event_field_values_table_name = $module->event_field_values_table_name;
    
    $userops =& $gCms->GetUserOperations();
    $tmp =& $userops->LoadUsers();
    $users = array();
    foreach ($tmp as $oneuser)
      {
	$users[$oneuser->id] = $oneuser;
      }
    
    $query = 'SELECT * FROM '.$module->events_table_name.'
             WHERE event_id IN ('.implode(',',$eventids).')';
    $rs = $db->SelectLimit($query,$limit,$startoffset);
    $events = array();
    while($rs && ($row = $rs->FetchRow()))
      {	
	$titleSEO = munge_string_to_url($row['event_title']);
	$destpage = $module->GetPreference('defaultcalendarpage',-1);
	$destpage=$destpage!=-1?$destpage:$returnid;
	$destpage=$detailpage!=''?$detailpage:$destpage;
	$prettyurl = sprintf($this->GetPreference('url_prefix','calendar')."/%d/%d-%s",
			     $destpage,
			     $row['event_id'],
			     $titleSEO);
	$parms = array();
	$parms['event_id'] = $row['event_id'];
	$parms['display'] = 'event';
	if( isset($parameters['lang']) )
	  {
	    $parms['lang'] = $parameters['lang'];
	  }
	if( isset($parameters['eventtemplate']) )
	  {
	    $parms['eventtemplate'] = $parameters['eventtemplate'];
	  }
	$url = $module->CreateLink($id, 'default',$destpage, $contents='', 
				   $parms, '', true, '', '', '', $prettyurl);
	$row['url'] = $url;
	$row['author'] = $users[$row['event_created_by']]->username;
	$row['authorname'] = $users[$row['event_created_by']]->firstname.' '.$users[$row['event_created_by']]->lastname;
			

	// Begin categories retrieval
	{

	  // Build the sql to retrieve the categories for this event.
	  $sql = "SELECT category_name 
	 	  FROM $events_to_categories_table_name
		 INNER JOIN $categories_table_name
		    ON  $events_to_categories_table_name.category_id = $categories_table_name.category_id
		 WHERE event_id = ?";
	  $crs = $db->Execute($sql,array($row['event_id'])); // Get the field values
	  $categories = array();
	  $categories_temp = array();
	  if ($crs) // make sure there are results and assign to the $categories array
	    {
	      $categories_temp = $crs->GetArray();
	      foreach($categories_temp as $category)
		{
		  $category_name = $category['category_name'];
		  $categories[$category_name] = '1';
		}
	    }
	  // Attach the custom fields to the event
	  $row['categories'] = $categories;
	}
	// End categories retrieval


	// Begin custom fields retrieval
	{
	  // Build the sql to retrieve the field values for this event.
	  $sql = "SELECT field_name,field_value
	 	  FROM $event_field_values_table_name
		  WHERE event_id = ?";
	  $frs = $db->Execute($sql,array($row['event_id'])); // Get the field values
	  $fields = array();
	  $fields_temp = array();
	  if ($frs) // make sure there are results and assign to the $fields array
	    {
	      $fields_temp = $frs->GetArray();
	      foreach($fields_temp as $field)
		{
		  $field_name = $field['field_name'];
		  $field_value = $field['field_value'];
		  $fields[$field_name] = $field_value;
		}
	    }
	  // Attach the custom fields to the event
	  $row['fields'] = $fields;
	}
	// End custom fields retrieval
			
	// and add it to the list of completed, expanded events.
	$events[] = $row;
      }
    if( $rs ) $rs->Close();

    return $events;
  }

} // end of class

#
# EOF
#
?>