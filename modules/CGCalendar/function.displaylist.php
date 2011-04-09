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

function DisplayList(&$module, $id, &$parameters, $returnid)
{
  global $gCms;
  $smarty =& $gCms->GetSmarty();

	$detailpage = '';
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
	

	$category = get_parameter_value($parameters, 'category', '');
	$categories_table_name = $module->categories_table_name;
	$events_to_categories_table_name = $module->events_to_categories_table_name;
	$event_field_values_table_name = $module->event_field_values_table_name;
	$events_table_name = $module->events_table_name;
	$first_day_of_week = get_parameter_value($parameters, 'first_day_of_week', 1);
	$return_link = get_parameter_value($parameters, 'return_link', 0);
	$limit = get_parameter_value($parameters, 'limit', -1);
	$inline = get_parameter_value($parameters,'inline',0);

	$reverse = get_parameter_value($parameters, 'reverse', 'false');
	$sorting = ($reverse == 'true' ? 'DESC' : 'ASC');

	$use_session = isset($parameters['use_session']) ? trim($parameters['use_session']) : '';
	$month = -1;
	$year = -1;
	if( !empty($use_session))
	{
	  $month = $module->session_get($use_session.'cur_month',-1);
	  $year = $module->session_get($use_session.'cur_year',-1);
	}

	// get selected date from parameters
	$month = get_parameter_value($parameters, 'month', $month);
	$year = get_parameter_value($parameters, 'year', $year);
	
	if( $month == -1 )
	  {
	    // fallback to current month and year
	    $month = date('n');
	  }
	if( $year == -1 )
	  {
	    $year  = date('Y');
	  }
	
	if( !empty($use_session) )
	  {
	    // store them back in the session.
	    $module->session_put($use_session.'cur_month',$month);
	    $module->session_put($use_session.'cur_year',$year);
	  }

	// basic information about dates
	$prev_month['timestamp'] = strtotime("-1 month", mktime(0,0,0,$month, 1, $year));
	$prev_month['year'] = date('Y', $prev_month['timestamp']);
	$prev_month['month'] = date('n', $prev_month['timestamp']);
	$next_month['timestamp'] = strtotime("+1 month", mktime(0,0,0,$month, 1, $year));
	$next_month['year'] = date('Y', $next_month['timestamp']);
	$next_month['month'] = date('n', $next_month['timestamp']);

	$last_day_of_month = mktime(0, 0, 0, $next_month['month'], 0, $next_month['year']);

	$day = get_parameter_value($parameters, 'day', -1);

	$db =& $module->GetDb();
	$where = 'WHERE';
	$sql = "SELECT DISTINCT $events_table_name.*
				FROM $events_table_name\n";
	if($category)
	{
		$sql .= "INNER JOIN $events_to_categories_table_name
				   ON $events_table_name.event_id = $events_to_categories_table_name.event_id
				INNER JOIN $categories_table_name
				   ON $events_to_categories_table_name.category_id = $categories_table_name.category_id
			";
	}

	if($day > 0)
	{
		$start = sprintf('%04d-%02d-%02d 00:00:00', $year, $month, $day);
		$end = sprintf('%04d-%02d-%02d 23:59:59', $year, $month, $day);
	}
	else
	{
		$start = sprintf('%04d-%02d-01 00:00:00', $year, $month);
		$end = sprintf('%04d-%02d-%02d 23:59:59', date('Y', $last_day_of_month), date('m', $last_day_of_month), date('d', $last_day_of_month));
	}
	$sql .= "$where ($events_table_name.event_date_start >= '$start' \n\tOR $events_table_name.event_date_end >= '$start')\n";
	$sql .= "AND ($events_table_name.event_date_start <= '$end' OR
                 ($events_table_name.event_date_end <= '$end'
                 AND COALESCE($events_table_name.event_date_end,'00-00-00 00:00:00') != '0000-00-00 00:00:00') )";
	$where = ' AND ';

	if($category)
	{
		$cats = explode(',', $category);
		$sql .= $where . ' (';
		$count = 0;
		foreach($cats as $cat)
		{
			$cat = trim($cat);
			if($count != 0)
			{
				$sql .= ' OR ';
			}
			$count++;
			$sql .= "$categories_table_name.category_name LIKE '$cat' ";
		}
		$sql .=	') ';
		$where = ' AND ';
	}
	$sql .= " ORDER BY $events_table_name.event_date_start $sorting";

	if($limit > 0)
	{
		$rs = $db->SelectLimit($sql, $limit);
	}
	else
	{
		$rs = $db->Execute($sql); /* @var $rs ADOConnection */
	}

	$userops =& $gCms->GetUserOperations();
	$userlist =& $userops->LoadUsers();
	// print_r($userlist);
	$users = array();
	foreach ($userlist as $oneuser)
	{
		$users[$oneuser->id] = $oneuser;
	}
	$events = array();
	if($rs->RecordCount() > 0)
	{
		while($row = $rs->FetchRow())
		{	
		  $titleSEO = munge_string_to_url($row['event_title']);
			$destpage = $module->GetPreference('defaultcalendarpage',-1);
			$destpage=$destpage!=-1?$destpage:$returnid;
			$destpage=$detailpage!=''?$detailpage:$destpage;
			$prettyurl = sprintf($module->GetPreference('url_prefix','calendar')."/%d/%d-%s",
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
				$fieldDb = $module->GetDb();
				
				// Build the sql to retrieve the field values for this event.
				$sql = "SELECT field_name,field_value
					FROM $event_field_values_table_name
					WHERE event_id = ?";
				$frs = $fieldDb->Execute($sql,array($row['event_id'])); // Get the field values
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
			
			
			$events[] = $row;
		}
	}


	$parms = array();
	$parms['display'] = 'list';
	if( isset($parameters['detailpage']) )
	  {
	    $parms['detailpage'] = $parameters['detailpage'];
	  }
	if( isset($parameters['eventtemplate']) )
	  {
	    $parms['eventtemplate'] = $parameters['eventtemplate'];
	  }
	$parms['use_session'] = $use_session;
	$parms['year'] = $next_month['year'];
	$parms['month'] = $next_month['month'];
	$navigation['next'] = $module->CreateURL($id, 'default', $returnid, $parms, $inline );
	$navigation['ni_next'] = $module->CreateURL($id, 'default', $returnid, $parms, false );
	$parms['year'] = $prev_month['year'];
	$parms['month'] = $prev_month['month'];
	$navigation['prev'] = $module->CreateURL($id, 'default', $returnid, $parms, $inline );
	$navigation['ni_prev'] = $module->CreateURL($id, 'default', $returnid, $parms, false );

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

	$return_url = '';
	if($return_link == 1)
	{
		$return_url = $module->CreateReturnLink($id, $returnid, $module->lang('cal_return'));
	}

	// other language fields
	$lang = $module->GetLabels();

	// assign to Smarty
	$smarty->assign('month_names', $month_names);
	$smarty->assign('day_names', $day_names);
	$smarty->assign('day_short_names', $day_short_names);
	$smarty->assign('events', $events);
	$smarty->assign('day', $day);
	$smarty->assign('month', $month);
	$smarty->assign('year', $year);
	$smarty->assign('return_url', $return_url);
	$smarty->assign('lang', $lang);
	$smarty->assign('navigation', $navigation);

	// Display template
  $thetemplate = 'list_'.$module->GetPreference(CGCALENDAR_PREF_DFLTLIST_TEMPLATE);
  if (isset($parameters['listtemplate']))
    {
      $thetemplate = 'list_'.$parameters['listtemplate'];
    }

  echo $module->ProcessTemplateFromDatabase($thetemplate);
}


?>
