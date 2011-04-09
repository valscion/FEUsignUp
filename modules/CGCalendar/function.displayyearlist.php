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

function DisplayYearList(&$module, $id, &$parameters, $returnid)
{
  $detailpage = '';
  global $gCms;
  $smarty =& $gCms->GetSmarty();
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

	$event_field_values_table_name = $module->event_field_values_table_name;	
	$events_to_categories_table_name = $module->events_to_categories_table_name;
	$events_table_name = $module->events_table_name;

	$category = get_parameter_value($parameters, 'category', '');
	$categories_table_name = $module->categories_table_name;
	$first_day_of_week = get_parameter_value($parameters, 'first_day_of_week', 1);
	$return_link = get_parameter_value($parameters, 'return_link', 0);
	$limit = get_parameter_value($parameters, 'limit', -1);

	$reverse = get_parameter_value($parameters, 'reverse', 'false');
	$sorting = ($reverse == 'true' ? 'DESC' : 'ASC');

	$use_session = get_parameter_value($parameters, 'use_session', true);
	if($use_session)
	{
		$year = get_parameter_value($parameters, 'year', date('Y'), 'calendar-year'.$id.$returnid);
	}
	else
	{
		$year = get_parameter_value($parameters, 'year', date('Y'));
	}

	// basic information about dates
	$prev_year['timestamp'] = strtotime("-1 year", mktime(0,0,0,1, 1, $year));
	$prev_year['year'] = date('Y', $prev_year['timestamp']);
	$next_year['timestamp'] = strtotime("+1 year", mktime(0,0,0,1, 1, $year));
	$next_year['year'] = date('Y', $next_year['timestamp']);

	$last_day_of_year = mktime(0, 0, 0, 1, 0, $next_year['year']);

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

	$start = sprintf('%04d-%02d-01 00:00:00', $year, 1);
	$end = sprintf('%04d-%02d-%02d 23:59:59', date('Y', $last_day_of_year), date('m', $last_day_of_year), date('d', $last_day_of_year));

	$sql .= "$where ($events_table_name.event_date_start >= '$start' 
                 OR $events_table_name.event_date_end >= '$start')\n";
	$sql .= "AND ($events_table_name.event_date_start <= '$end' OR 
                 ($events_table_name.event_date_end <= '$end' AND COALESCE($events_table_name.event_date_end,'0000-00-00 00:00:00') != '0000-00-00 00:00:00'))\n";
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

	$events = array();
	if($rs->RecordCount() > 0)
	{
		while($row = $rs->FetchRow())
		{
			$titleSEO = preg_replace("/[^\w-]+/", "-", $row['event_title']);
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
			if( isset($parameters['eventtemplate']) )
			  {
			    $parms['eventtemplate'] = $parameters['eventtemplate'];
			  }
			if( isset($parameters['lang']) )
			  {
			    $parms['lang'] = $parameters['lang'];
			  }
			$url = $module->CreateLink($id, 'default', $destpage, $contents='', 
						   $parms,  '', true, '', '', $prettyurl);
			$row['url'] = $url;

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
	$parms['display'] = 'yearlist';
	if( isset($parameters['detailpage']) )
	  {
	    $parms['detailpage'] = $parameters['detailpage'];
	  }
	if( isset($parameters['eventtemplate']) )
	  {
	    $parms['eventtemplate'] = $parameters['eventtemplate'];
	  }
	if( isset($parameters['lang']) )
	  {
	    $parms['lang'] = $parameters['lang'];
	  }
	$parms['year'] = $next_year['year'];
	$navigation['next'] = $module->CreateReturnLink($id, $returnid, '', $parms, true);
	$parms['year'] = $prev_year['year'];
	$navigation['prev'] = $module->CreateReturnLink($id, $returnid, '', $parms, true);

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
