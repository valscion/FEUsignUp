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
if( !isset($gCms) ) exit;

function DisplayUpcomingList(&$module, $id, &$parameters, $returnid)
{
  global $gCms;
  $db =& $module->GetDb();
  $smarty =& $gCms->GetSmarty();

  // get the parameters
  $detailpage = '';
  if (isset($parameters['detailpage']))
    {
      $manager =& $gCms->GetHierarchyManager();
      $node = $manager->sureGetNodeByAlias($parameters['detailpage']);
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

  $expr = '>=';
  $category = get_parameter_value($parameters, 'category', '');
  $categories_table_name = $module->categories_table_name;
  $event_field_values_table_name = $module->event_field_values_table_name;
  $events_to_categories_table_name = $module->events_to_categories_table_name;
  $events_table_name = $module->events_table_name;
  $first_day_of_week = get_parameter_value($parameters, 'first_day_of_week', 1);
  $pastitems = get_parameter_value($parameters, 'pastitems', 0);
  $reverse = 'false';
  $page = get_parameter_value($parameters,'page',1);
  if( $pastitems )
    {
      $expr = '<';
      $reverse = 'true';
    }
  $return_link = get_parameter_value($parameters, 'return_link', 0);
  $limit = get_parameter_value($parameters, 'limit', 10000);
  $reverse = get_parameter_value($parameters, 'reverse', 'false');
  $columns=get_parameter_value($parameters, 'columns', '1');
  $columnstyle=get_parameter_value($parameters, 'columnstyle', '1');
  $currentcolumn=get_parameter_value($parameters, 'currentcolumn', '1');


  // build the query
  $where = 'WHERE';
  $sql2 = "SELECT $events_table_name.* FROM $events_table_name";
  if(!empty($category))
    {
      $txt .= "INNER JOIN $events_to_categories_table_name
		  ON $events_table_name.event_id = $events_to_categories_table_name.event_id
	       INNER JOIN $categories_table_name
	          ON $events_to_categories_table_name.category_id = $categories_table_name.category_id";
      $sql2 .= " ".$txt;
    }

  $sorting = ($reverse == 'true' ? 'DESC' : 'ASC');
  $start = $db->DbTimeStamp(time());

  $txt = "$where ($events_table_name.event_date_start $expr $start OR
                 ($events_table_name.event_date_end $expr $start AND 
                  COALESCE($events_table_name.event_date_end,'0000-00-00 00:00:00') != '0000-00-00 00:00:00'))";
  if ($pastitems)
  {
    $txt = "$where (
                    ($events_table_name.event_date_start $expr $start AND
                      COALESCE($events_table_name.event_date_end,'0000-00-00 00:00:00') = '0000-00-00 00:00:00'
                    )
                    OR
                    ($events_table_name.event_date_end $expr $start AND 
                      COALESCE($events_table_name.event_date_end,'0000-00-00 00:00:00') != '0000-00-00 00:00:00'
                    )
                  )";
  }
  $sql2 .= ' '.$txt;
  $where = ' AND ';

  if(!empty($category))
    {
      $cats = explode(',', $category);

      $tmp = array();
      foreach( $cats as $cat )
	{
	  $tmp[] = "($categories_table_name.category_name LIKE '$cat')";
	}
      $txt = '('.implode(' OR ',$tmp).')';
      $sql2 .= ' AND '.$txt;
    }

  if( !isset($parameters['unique_only']) || $parameters['unique_only'] == 1 )
    {
      $sql2 .= " GROUP BY $events_table_name.event_title";
    }

  $sql1 = 'SELECT COUNT(*) FROM ('.$sql2.') AS sub';
  $sql2 .= " ORDER BY $events_table_name.event_date_start $sorting";


  // get the number of articles
  $count = $db->GetOne($sql1);
  if( !$count )
    {
      $tmp = $db->ErrorMsg();
      if( !empty($tmp) )
	{
	  echo "DEBUG: query failed: ".$db->sql."<br/>".$db->ErrorMsg();
	}
      return;
    }
  $numpages = (int)($count / $limit);
  if( $count % $limit ) $numpages++;
  $offset = ($page - 1) * $limit;

  // get the data
  $rs = false;
  $rs = $db->SelectLimit($sql2, $limit,$offset);
  if( !$rs ) 
    {
      echo "DEBUG: query failed: ".$db->sql."<br/>".$db->ErrorMsg();
    }

  // build the report
  $userops =& $gCms->GetUserOperations();
  $userlist =& $userops->LoadUsers();
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
	  $date_string = $row['event_date_start'];
	  $post_year = substr($date_string, 0, 4);
	  $post_month = substr($date_string, 5, 2);
	  $post_day = substr($date_string, 8, 2);
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
	  $parms['detailpage'] = $detailpage;
	  $parms['return_id'] = $returnid;
	  if( isset($parameters['eventtemplate']) )
	    {
	      $parms['eventtemplate'] = $parameters['eventtemplate'];
	    }
	  if( isset($parameters['lang']) )
	    {
	      $parms['lang'] = $parameters['lang'];
	    }
	  $url = $module->CreateLink($id, 'default', $destpage, $contents='', 
				     $parms,
				     '', true, '', '', '', 
				     $prettyurl);
	  $row['url'] = $url;
	  $row['author'] = $users[$row['event_created_by']]->username;
	  $row['authorname'] = $users[$row['event_created_by']]->firstname.' '.$users[$row['event_created_by']]->lastname;
	  
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
	  
	  // Begin categories retrieval
	  {
	    $categoryDb = $module->GetDb();
	    
	    // Build the sql to retrieve the categories for this event.
	    $sql = "SELECT category_name 
					FROM $events_to_categories_table_name
					INNER JOIN $categories_table_name
					ON  $events_to_categories_table_name.category_id = $categories_table_name.category_id
					WHERE event_id = ?";
	    $crs = $fieldDb->Execute($sql,array($row['event_id'])); // Get the field values
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
	  
	  $events[] = $row;
	}
    }

  //Handle 2 columns, could perhaps be done more elegantly...
  // Calguy: this is warped, fix this... shouldn't be here anyways
  // could be done in a smarty plugin.
  if ($columns>1) {
    if ($columnstyle=='1') {
      $middle=count($events)/2;
      $middle++; //If odd number column 1 should have one more event
      if ($currentcolumn==1) {
	$events=array_slice($events,0,$middle);
      } else {
	$events=array_slice($events,$middle);
      }
    } else {
      $newevents=array();
      $column=1;
      foreach($events as $event) {
	if ($currentcolumn==1) {
	  if ($column==1) {
	    $newevents[]=$event;
	    $column=2;
	  } else {
	    $column=1;
	  }
	} else {
	  if ($column==2) {
	    $newevents[]=$event;
	    $column=1;
	  } else {
	    $column=2;
	  }
	}
      }
      $events=$newevents;
    }
  }

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
  
  // navigation
  $navigation = array();
  $parms = $parameters;
  $parms['display'] = 'upcominglist';
  if( $page < $numpages )
    {
      $parms['page'] = $page + 1;
      $navigation['next'] = $module->CreateURL($id, 'default', $returnid, $parms, $inline );
      $navigation['ni_next'] = $module->CreateURL($id, 'default', $returnid, $parms, false );
    }
  if( $page > 1 )
    {
      $parms['page'] = $page - 1;
      $navigation['prev'] = $module->CreateURL($id, 'default', $returnid, $parms, $inline );
      $navigation['ni_prev'] = $module->CreateURL($id, 'default', $returnid, $parms, false );
    }
  
  // assign to Smarty
  if( count($navigation) )  $smarty->assign('navigation',$navigation);
  $smarty->assign('month_names', $month_names);
  $smarty->assign('day_names', $day_names);
  $smarty->assign('day_short_names', $day_short_names);
  $smarty->assign('events', $events);
  $smarty->assign('return_url', $return_url);
  $smarty->assign('lang', $lang);
  $smarty->assign('pastitems', $pastitems);
  
  // Display template
  $thetemplate = 'upcominglist_'.$module->GetPreference(CGCALENDAR_PREF_DFLTUPCOMINGLIST_TEMPLATE);
  if (isset($parameters['upcominglisttemplate']))
    {
      $thetemplate = 'upcominglist_'.$parameters['upcominglisttemplate'];
    }

  echo $module->ProcessTemplateFromDatabase($thetemplate);
}

?>
