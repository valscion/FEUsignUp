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

function DisplayCalendar(&$module, $id, &$parameters, $returnid)
{
  global $gCms;
  $smarty =& $gCms->GetSmarty();
	
  $categories_table_name = $module->categories_table_name;
  $event_field_values_table_name = $module->event_field_values_table_name;
  $events_to_categories_table_name = $module->events_to_categories_table_name;
  $events_table_name = $module->events_table_name;

  $use_session = isset($parameters['use_session']) ? trim($parameters['use_session']) : '';

  $month = -1;
  $year = -1;
  $detailpage = '';
  $category = '';
  $inline = 0;
  $first_day_of_week = 1;
  $thetemplate = $module->GetPreference(CGCALENDAR_PREF_DFLTCALENDAR_TEMPLATE);
  if( !empty($use_session) )
    {
      // see if our param data is saved in the session
      $month = $module->session_get($use_session.'cur_month',-1);
      $year = $module->session_get($use_session.'cur_year',-1);
      $detailpage = $module->session_get($use_session.'detailpage','');
      $category = $module->session_get($use_session.'category','');
      $inline = $module->session_get($use_session.'inline','');
      $first_day_of_week = $module->session_get($use_session.'first_day_of_week',$first_day_of_week);
      $thetemplate = $module->session_get($use_session.'calendartemplate',$thetemplate);
    }
  
  // get selected data from parameters
  $month = get_parameter_value($parameters, 'month', $month);
  $year = get_parameter_value($parameters, 'year', $year);
  $category = get_parameter_value($parameters, 'category', $category);
  $inline = get_parameter_value($parameters,'inline',$inline);
  $first_day_of_week = get_parameter_value($parameters,'first_day_of_week',$first_day_of_week);
  $thetemplate = get_parameter_value($parameters,'calendartemplate',$thetemplate);

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
  
  if( $month == -1 )
    {
      // fallback to current month and year
      $month = date('n');
      $year  = date('Y');
    }
  
  if( !empty($use_session) )
    {
      // store them back in the session.
      $module->session_put($use_session.'cur_month',$month);
      $module->session_put($use_session.'cur_year',$year);
      $module->session_put($use_session.'detailpage',$detailpage);
      $module->session_put($use_session.'category',$category);
      $module->session_put($use_session.'inline',$inline);
      $module->session_put($use_session.'first_day_of_week',$first_day_of_week);
      $module->session_put($use_session.'calendartemplate',$thetemplate);
    }

  // basic information about dates
  $prev_month['timestamp'] = strtotime("-1 month", mktime(0,0,0,$month, 1, $year));
  $prev_month['year'] = date('Y', $prev_month['timestamp']);
  $prev_month['month'] = date('n', $prev_month['timestamp']);
  $next_month['timestamp'] = strtotime("+1 month", mktime(0,0,0,$month, 1, $year));
  $next_month['year'] = date('Y', $next_month['timestamp']);
  $next_month['month'] = date('n', $next_month['timestamp']);

  $last_day_of_month = mktime(0, 0, 0, $next_month['month'], 0, $next_month['year']);


  $db =& $module->GetDb();
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

  $start = sprintf('%04d-%02d-01 00:00:00', $year, $month);
  $end = sprintf('%04d-%02d-%02d 23:59:59', date('Y', $last_day_of_month), date('m', $last_day_of_month), date('d', $last_day_of_month));

  $sql .= "
	    WHERE 
	    (
		($events_table_name.event_date_start >= '$start' AND $events_table_name.event_date_start <= '$end')
		OR
		($events_table_name.event_date_end >= '$start' AND $events_table_name.event_date_end <= '$end')
		OR
		($events_table_name.event_date_start <= '$start' AND $events_table_name.event_date_end >= '$end')
	    )
	";

  if($category)
    {
      $cats = explode(',', $category);
      $sql .= ' AND (';
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
    }
  $sql .= " ORDER BY $events_table_name.event_date_start ASC";

  $rs = $db->Execute($sql); /* @var $rs ADOConnection */
  if( !$rs )
    {
      echo "DEBUG: query failed:<br/>"; $db->sql."<br/>"; $db->ErrorMsg()."<br/>";
    }

  $number_of_days_in_month = date('d', $last_day_of_month);

  $days = array();
  $parms = array();
  $parms['returnid'] = $returnid;
  $parms['detailpage'] = $detailpage;
  $parms['year'] = $year;
  $parms['month'] = $month;
  $parms['display'] = 'list';
  $parms['return_link'] = 1;
  $parms['detail'] = 1;
  if( isset($parameters['lang']) )
    {
      $parms['lang'] = $parameters['lang'];
    }
  if( isset($parameters['eventtemplate']) )
    {
      $parms['eventtemplate'] = $parameters['eventtemplate'];
    }
  for($i = 1; $i <= $number_of_days_in_month; $i++)
    {
      $parms['day'] = $i;
      $days[$i]['date'] = mktime(0,0,0,$month,$i,$year);
      $days[$i]['url'] = $module->CreateLink($id, 'default', $detailpage!=''?$detailpage:$returnid, $contents='',
					     $parms, '', true, $inline);
      $days[$i]['events'] = array();
    }
  if($rs->RecordCount() > 0)
    {
      while($row = $rs->FetchRow())
	{
	  $event_id = $row['event_id']; // Added for use in sql for event categories by Colin Johnson
	  $start_date = strtotime($row['event_date_start']);

	  if(empty($row['event_date_end']) || $row['event_date_end'] == 0)
	    {
	      $end_date = $start_date;
	    }
	  else
	    {
	      $end_date = strtotime($row['event_date_end']);
	    }

	  $start_month = date('n', $start_date);
	  $end_month = date('n', $end_date);
	  $start_year = date('Y', $start_date);
	  $end_year = date('Y', $end_date);

	  // find out where the event starts within this month
	  $first_day_of_event_in_this_month = date('j', $start_date);
	  if($start_month < $month || $start_year < $year)
	    {
	      $first_day_of_event_in_this_month = 1;
	    }

	  // find out where the event ends within in this month
	  $last_day_of_event_in_this_month = date('j', $end_date);
	  if($end_month > $month || $end_year > $year)
	    {
	      $last_day_of_event_in_this_month = $number_of_days_in_month;
	    }

	  $titleSEO = preg_replace("/[^\w-]+/", "-", $row['event_title']);
	  $destpage = $module->GetPreference('defaultcalendarpage',-1);
	  $destpage=$destpage!=-1?$destpage:$returnid;
	  $destpage=$detailpage!=''?$detailpage:$destpage;

	  $parms = array();
	  $parms['first_day_of_week'] = $first_day_of_week;
	  $parms['event_id'] = $row['event_id'];
	  $parms['display'] = 'event';
	  if( isset($parameters['lang']) )
	    {
	      $parms['lang'] = $parameters['lang'];
	    }
	  $parms['detailpage'] = $detailpage;
	  $parms['return_id'] = $returnid;
	  if( isset($parameters['eventtemplate']) )
	    {
	      $parms['eventtemplate'] = $parameters['eventtemplate'];
	    }
	  $prettyurl = sprintf($module->GetPreference('url_prefix','calendar')."/%d/%d-%s",
			       $destpage,
			       $row['event_id'],
			       $titleSEO);
	  $url = $module->CreateLink($id, 'default', $destpage, $contents='', 
				     $parms, '', true, '', '', '',
				     $prettyurl);
	  $row['url'] = $url;

	  // Added by Colin R. R. Johnson, crrj@candjsolutions.com on 2006-10-18
	  // Retreive the category IDs for the event into an array appended into the events array.
	  // This will allow for custom formatting of event summaries based on category in the
	  // Calendar display.
	  $categoryDb = $module->GetDb();

	  // Build the sql to retrieve the categories for the event.
	  $sql = "SELECT DISTINCT $categories_table_name.*
				FROM $categories_table_name
				INNER JOIN $events_to_categories_table_name
				ON $events_to_categories_table_name.category_id = $categories_table_name.category_id
				WHERE $events_to_categories_table_name.event_id = $event_id";

	  $crs = $categoryDb->Execute($sql); // Get the categories result set
	  $categories = array();
	  if ($crs) // make sure there are results and assign to the $categories array
	    {
	      $categories = $crs->GetArray();
	    }
	  $row['categories'] = $categories; // make sure that we actually provide a categories item to the row, even if empty.
			
	  // End category retreval.
			
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
		    $fields[$field_name] = $field_value;
		  }
	      }
	    // Attach the custom fields to the event
	    $row['fields'] = $fields;
	  }
	  // End custom fields retrieval

	  // stick the event into the $days array
	  for($i = $first_day_of_event_in_this_month; $i <= $last_day_of_event_in_this_month; $i++)
	    {
	      $days[$i]['events'][] = $row;
	    }
	}
    }

  if($year == date('Y') && $month == date('m'))
    {
      // month being displayed is this month. Therefore today exists
      $today = date('j');
      if (FALSE == isset($days[$today]['class'])) // Fix undeclared index error
	{
	  $days[$today]['class'] = '';
	}
      $days[$today]['class'] .= ' calendar-today';
    }


  $parms = $parameters;
  $parms['use_session'] = $use_session;
  $parms['year'] = $next_month['year'];
  $parms['month'] = $next_month['month'];
  if( isset($parameters['lang']) )
    {
      $parms['lang'] = $parameters['lang'];
    }
  $navigation['next'] = $module->CreateURL($id,'default',$returnid,
					   $parms,$inline);
  $navigation['ni_next'] = $module->CreateURL($id,'default',$returnid,
					      $parms,false);

  $parms = $parameters;
  $parms['use_session'] = $use_session;
  $parms['year'] = $prev_month['year'];
  $parms['month'] = $prev_month['month'];
  $navigation['prev'] = $module->CreateURL($id,'default',$returnid,
					   $parms,$inline);
  $navigation['ni_prev'] = $module->CreateURL($id,'default',$returnid,
					      $parms,false);


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

  // calendar stuff
  $first_of_month = gmmktime(0,0,0,$month,1,$year);
  $first_of_month_weekday_number = gmstrftime('%w',$first_of_month);
  $first_of_month_weekday_number = ($first_of_month_weekday_number + 7 - $first_day_of_week) % 7; #adjust for $first_day

    // assign to Smarty
  $smarty->assign('month_names', $month_names);
  $smarty->assign('day_names', $day_names);
  $smarty->assign('day_short_names', $day_short_names);
  $smarty->assign('first_of_month_weekday_number', $first_of_month_weekday_number);
  $smarty->assign('navigation', $navigation);
  $smarty->assign('days', $days);
  $smarty->assign('month', $month);
  $smarty->assign('year', $year);

  // Display template
  echo $module->ProcessTemplateFromDatabase('calendar_'.$thetemplate);
}

?>
