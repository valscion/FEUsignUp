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

function DisplayEvent(&$module, $id, &$parameters, $returnid)
{
  global $gCms;
  $smarty =& $gCms->GetSmarty();

	$detailpage = 1;
	if (isset($parameters['detailpage']))
	{
		$manager =& $gCms->GetHierarchyManager();
		$node =& $manager->sureGetNodeByAlias($parameters['detailpage']);
		if (isset($node))
		{
			$content =& $node->GetContent();
			if (isset($content))
			{
				$detailpage = $content->Id();
			}
		}
		else
		{
			$node =& $manager->sureGetNodeById($parameters['detailpage']);
			if (isset($node))
			{
				$detailpage = $parameters['detailpage'];
			}
		}
	}

	$categories_table_name = $module->categories_table_name;
	$event_field_values_table_name = $module->event_field_values_table_name;
	$events_to_categories_table_name = $module->events_to_categories_table_name;
	$events_table_name = $module->events_table_name;
	$return_id = get_parameter_value($parameters, 'return_id', $returnid);
	$category = get_parameter_value($parameters, 'category', '');
	$first_day_of_week = get_parameter_value($parameters, 'first_day_of_week', 1);
	$event_id = get_parameter_value($parameters, 'event_id', 'next');
	$use_session = get_parameter_value($parameters, 'use_session', true);

	$db =& $module->GetDb();
	$sql = "SELECT DISTINCT $events_table_name.*
				FROM $events_table_name ";

	if( $event_id == 'next' )
	  {
	    $start = date('Y-m-d H:i:s'); // start now !
	    $sql .= "WHERE event_date_start > '$start' OR event_date_end > '$start'";
	  }
	else if( (int)$event_id > 0 )
	  {
	    $sql .= "WHERE event_id = $event_id";
	  }
	else 
	  {
	    // no event
	    echo '<div class="calendar-error">'.$this->Lang('error_event_not_found',$event_id).'</div>';
	    return;
	  }

	$sql .= ' LIMIT 1';
	$rs = $db->Execute($sql);
	if(!is_object($rs) || $rs->RecordCount() != 1)
	{
	  // something's wrong
	  echo '<div class="calendar-error">'.$this->Lang('error_event_not_found',$event_id).'</div>';
	  return;
	}

	$event = $rs->FetchRow();
	if( $event_id == 'next' )
	  {
	    $event_id = $event['event_id'];
	  }

	$userops =& $gCms->GetUserOperations();
	$userlist =& $userops->LoadUsers();
	// print_r($userlist);
	$users = array();
	foreach ($userlist as $oneuser)
	{
		$users[$oneuser->id] = $oneuser;
	}
	$event['author'] = $users[$event['event_created_by']]->username;
	$event['authorname'] = $users[$event['event_created_by']]->firstname.' '.$users[$event['event_created_by']]->lastname;

	// pick up categories
	$sql = "SELECT DISTINCT $categories_table_name.*
				FROM $categories_table_name
				LEFT JOIN $events_to_categories_table_name
				ON $events_to_categories_table_name.category_id = $categories_table_name.category_id
				WHERE $events_to_categories_table_name.event_id = $event_id";
	$rs = $db->Execute($sql);
	$categories = array();
	if($rs)
	{
		$categories = $rs->GetArray();
	}

	// Begin custom fields retrieval
	{
		$fieldDb = $module->GetDb();

		// Build the sql to retrieve the field values for this event.
		$sql = "SELECT field_name,field_value
			FROM $event_field_values_table_name
			WHERE event_id = $event_id";
		$frs = $fieldDb->Execute($sql); // Get the field values
		$fields = array();
		$fields_temp = array();
		if ($frs) // make sure there are results and assign to the $fields array
		{
			$fields_temp = $frs->GetArray();

			foreach($fields_temp as $field)
			{
				$field_name = $field['field_name'];
				$field_value = $field['field_value'];
				if( $field_value != '' )
				  {
				    $fields[$field_name] = $field_value;
				  }
			}
		}
		// Attach the custom fields to the event
		$event['fields'] = $fields;
	}
	// End custom fields retrieval
	$return_url = $module->CreateReturnLink($id, $return_id, $module->lang('cal_return'));
	$return_url2 = $module->CreateReturnLink($id, $return_id, $module->lang('cal_return'),array(),true);

	$day_names = $module->GetDayNames();
	$day_short_names = $module->GetDayShortNames();
	$month_names = $module->GetMonthNames();

	if($first_day_of_week != 0)
	{
		for($i = 0; $i < $first_day_of_week; $i++)
		{
			$first = array_shift($day_names);
			$day_names[] = $first;
			$first = array_shift($day_short_names);
			$day_short_names[] = $first;
		}
	}

	// other language fields
	$lang = $module->GetLabels();
	
	if (isset($parameters['show_ical']))
	{
		$domain = $gCms->config['root_url'];
		$time_zone = 0;
		$outstr  = "BEGIN:VCALENDAR\n";
		$outstr .= "PRODID:-//".$domain."//CGCalendar ".$module->GetVersion()."//EN\n";
		$outstr .= "VERSION:2.0\n";
		$outstr .= "CALSCALE:GREGORIAN\n";
		$outstr .= "METHOD:PUBLISH\n";
		$outstr .= "X-WR-CALNAME:".strtoupper($module->ConvertCategoriesToString($categories))."\n";
		if (date('e', strtotime($event['event_date_start'])) != 'e')
			$outstr .= "X-WR-TIMEZONE:".date('e', strtotime($event['event_date_start']))."\n";
		$outstr .= "X-WR-CALDESC:Schedule from ".get_site_preference('sitename', 'CMSMS Site')."\n";
		
	  	$outstr .= "BEGIN:VEVENT\n";
		$outstr .= "DTSTART:";
		$outstr .= $module->UnixTimestampToiCal(strtotime($event['event_date_start']), $time_zone)."\n";
		$outstr .= "DTEND:";
		$end_date = strtotime($event['event_date_start']) + 3600;
		if(!(empty($event['event_date_end']) || $event['event_date_end'] == null || $event['event_date_end'] == 0))
		{
			$end_date = strtotime($event['event_date_end']);
		}
		$outstr .= $module->UnixTimestampToiCal($end_date, $time_zone)."\n";
		$outstr .= 'SUMMARY:'.str_replace("\n", "\\n", $event['event_title'])."\n";
		$outstr .= 'DESCRIPTION:'.str_replace("\n", "\\n", $event['event_details']);
		$extrafields = "SELECT field_name,field_value FROM ".$module->event_field_values_table_name." WHERE event_id = ?";
		$frs = $db->Execute($extrafields,array($event_id));
		while ($frs && $row=$frs->FetchRow())
		{
			$outstr .= "\\n" . $row['field_name'].': '.str_replace("\n", "\\n", $row['field_value']);
		}
		$outstr .= "\n";
		$outstr .= 'UID:'.$event_id.'@'.$domain."\n";
		$outstr .= 'DTSTAMP:'.$module->unixTimestampToiCal(time(), $time_zone)."\n";
		$outstr .= "CLASS:PUBLIC\n";
		$outstr .= "END:VEVENT\n";
		$outstr .= "END:VCALENDAR\n";
		
		while(@ob_end_clean());
		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private',false);
		header('Content-Description: File Transfer');
		header('Content-Type: text/calendar');
		header('Content-Length: ' . strlen($outstr));
		header('Content-Disposition: attachment; filename=calendar.ics');
		echo $outstr;
		exit;
	}
	else
	{
		// assign to Smarty
		$smarty->assign('month_names', $month_names);
		$smarty->assign('day_names', $day_names);
		$smarty->assign('day_short_names', $day_short_names);
		$smarty->assign('event', $event);
		$smarty->assign('categories', $categories);
		$smarty->assign('return_link', $return_url); 
		$smarty->assign('return_url', $return_url2);
		$smarty->assign('lang', $lang);
		$smarty->assign('mo', $lang);
		$smarty->assign('ical_url', $module->CreateLink($id, 'default', $returnid, '', array('show_ical' => 'true', 'display' => 'event', 'event_id' => $event_id), '', true));

		// Assign title to class var so event title can be added to page title in  ContentPostRender()
		$module->current_event_title = $event['event_title'];

		// Display template
		$thetemplate = 'event_'.$module->GetPreference(CGCALENDAR_PREF_DFLTEVENT_TEMPLATE);
		if (isset($parameters['eventtemplate']))
		{
		  $thetemplate = 'event_'.$parameters['eventtemplate'];
		}
		echo $module->ProcessTemplateFromDatabase($thetemplate);
	}
}

?>