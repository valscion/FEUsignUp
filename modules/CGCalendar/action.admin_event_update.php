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
$message="";

function handle_null_date_ts($val)
{
  if( $val )
    {
      $db = cmsms()->GetDb();
      $str = $db->DbTimeStamp($val);
      return trim($str,"'");
    }
}

function handle_null_date($str)
{
  if( !is_null($str) )
    {
      return trim($str,"'");
    }
  return $str;
}


function nth_weekday($nth,$weekday,$fromdate)
{
  $month = date('m',$fromdate);
  $year = date('Y',$fromdate);
  $hours = date('H',$fromdate);
  $minutes = date('i',$fromdate);
  $seconds = date('s',$fromdate);
  $ndays = -1;

  $nth = strtolower($nth);
  switch( $nth )
    {
    case 'first':
      $nth = 1;
      break;
    case 'second':
      $nth = 2;
      break;
    case 'third':
      $nth = 3;
      break;
    case 'fourth':
      $nth = 4;
      break;
    case 'last':
      $nth = -1;
      break;
    default:
      $nth = (int)$nth;
      break;
    }
  if( $nth == -1 )
    {
      $days_in_month = date('t',$fromdate);
      $tmp1 = mktime(0,0,0,$month,$days_in_month,$year);
      $weekday_of_last = date('w',$tmp1);

      if( $weekday_of_last < $weekday )
	{
	  //$ndays = $days_in_month - $weekday_of_last - $weekday - 1;
	  $ndays = $days_in_month - $weekday_of_last + $weekday - 7; 
	}
      else
	{
	  $ndays = $days_in_month - $weekday_of_last + $weekday;
	}
    }
  else
    {
      $nth = max($nth,1);
      $nth = min($nth,4);

      // get weekday of first of the month
      $tmp1 = mktime(0,0,0,$month,1,$year);
      $weekday_of_first = date('w',$tmp1);

      if( $weekday_of_first <= $weekday )
	{
	  $ndays = ($weekday - $weekday_of_first + 1) + ($nth - 1) * 7;
	}
      else
	{
	  $ndays = (7 - $weekday_of_first + $weekday + 1) + ($nth - 1) * 7;
	}

    }

  $date = mktime($hours,$minutes,$seconds,$month,$ndays,$year);
  return $date;
}



function check_overlapping_events($event_start_ut,$event_end_ut,
				  $child_events)
{
  $tmp = array();
  $tmp[] = array('start'=>$event_start_ut,'end'=>$event_end_ut);
  $tmp = array_merge($tmp,$child_events);

  // trivial check, if the end date is null or empty
  // there is no chance that events can overlap.
  if(empty($event_end_ut) ) return false;

  for( $i = 1; $i < count($tmp); $i++ )
    {
      $prev =& $tmp[$i-1];
      $cur =& $tmp[$i];
      if( ($cur['start'] >= $prev['start'] && $cur['start'] <= $prev['end']) ||
	  ($cur['end'] >= $prev['start'] && $cur['end'] <= $prev['end']) )
	{
	  return true;
	}
    }

  return false;
}


function check_db_for_conflicts(&$module,$event,$event_id,$policy,$event_allows_overlap)
{
  $db = cmsms()->GetDb();

  $str = '';
  if( $policy == 'individual' && $event_allows_overlap)
    {
      $str .= ' AND event_allows_overlap = 0';
    }
  if( $event_id != '' && $event_id != -1)
    {
      $str .= " AND event_id != $event_id";
    }

  $dbr = '';
  if( $event['event_date_end'] == NULL )
    {
      $start = '';
      if( isset($event['event_date_start']) )
	{
	  $start = $event['event_date_start'];
	}
      else if( isset($event['start']) )
	{
	  // assume unix timestamp
	  $start = $db->DbTimeStamp($event['start']);
	}

      $query = 'SELECT event_id FROM '.$module->events_table_name."
                 WHERE ($start BETWEEN event_date_start and event_date_end)";
      $dbr = $db->GetOne($query.$str);
    }
  else
    {
      $start = '';
      if( isset($event['event_date_start']) )
	{
	  $start = $event['event_date_start'];
	}
      else if( isset($event['start']) )
	{
	  // assume unix timestamp
	  $start = $db->DbTimeStamp($event['start']);
	}

      $end = '';
      if( isset($event['event_date_end']) )
	{
	  $end = $event['event_date_end'];
	}
      else if( isset($event['end']) )
	{
	  // assume unix timestamp
	  $end = $db->DbTimeStamp($event['end']);
	}

      $query = 'SELECT event_id FROM '.$module->events_table_name."
                 WHERE (($start BETWEEN event_date_start and event_date_end) 
                       OR ($end BETWEEN event_date_start and event_date_end))";
      $dbr = $db->GetOne($query.$str);
    }
  if( $dbr ) return true;
  return false;
}

function calculate_recurring_events($event_start_ut, $event_end_ut,
				    $event_recur_period,
				    $event_recur_end_ut,
				    $event_recur_interval,
				    $event_recur_count,
				    $event_recur_weekdays,
				    $event_recur_monthdays)
{
  $results = array();
  $weekdays = array('sunday','monday','tuesday','wednesday',
		    'thursday','friday','saturday');
  $date = $event_start_ut;
  $deltat = $event_end_ut - $event_start_ut;
  if( (int)$event_end_ut == 0 )
    {
      $deltat = 0;
    }
  
  $period = 'day';
  $datefmtstr = "+%d %s";
  $hour = (int)strftime('%H',$date);
  $minute = (int)strftime('%M',$date);
  if( $event_recur_count < 0 )
    {
      $event_recur_count = 1000000;
    }

  switch( $event_recur_period )
    {
    case 'daily':
      $period = 'days';
      break;
    case 'weekly':
      $datefmtstr = "+%d %s %s %d:%d";
      $period = 'weeks';
      $tmp = '';
      // this loop handles event in the same week as the start event
      foreach( $event_recur_weekdays as $wd )
	{
	  if( count($results) >= $event_recur_count ) break;
	  $str = sprintf($datefmtstr,0,$period,$weekdays[$wd],$hour,$minute);
	  $tmp = strtotime($str,$date);
	  if( $tmp <= $event_start_ut ) continue;
	  
	  $tmpa = array();
	  $tmpa['start'] = $tmp;
	  if( $deltat == 0 )
	    {
	      $tmpa['end'] = NULL;
	    }
	  else
	    {
	      $tmpa['end'] = $tmp + $deltat;
	    }

	  // here we check for an overlap
	  // with the start and end dates
	  // and ignore anything that might overlap
	  $tmp2 = array($tmpa);
	  $test = check_overlapping_events($event_start_ut,$event_end_ut,
					   $tmp2);
	  if( $test == false )
	    {
	      $results[] = $tmpa;
	    }
	}
      break;

    case 'monthly':
      $period = 'months';
      if( $event_recur_monthdays[0] == 'specified' ) 
	{
	  $event_recur_period = 'monthly_specified';
	}
      else
	{
	  $datefmtstr = "%s %s %d %d:%d";
	  // this loop handles events in the same month as the start event
	  $month = date('M',$date);
	  $year = date('Y',$date);
	  foreach( $event_recur_monthdays as $md )
	    {
	      if( count($results) >= $event_recur_count ) break;
	      list($nth,$wd) = explode(',',$md,2);
	      $tmp = nth_weekday($nth,$wd,$date);
	      //$str = sprintf($datefmtstr,$md,$month,$year,$hour,$minute);
	      //$tmp = strtotime($str,$date);
	      if( $tmp <= $event_start_ut ) continue;
	      $results[] = $tmp;
	    }
	  $tmp2 = strtotime(sprintf('+%d months',$event_recur_interval),$date);
	  if (date('d',$tmp2)>28)
            {
	      $tmp2 = strtotime('-4 days',$tmp2);
            }
	  $date = $tmp2;
	}
      break;

    case 'yearly':
      $period = 'years';
      break;
    }

  // handle the recurring nature of things.
  while( count($results) < $event_recur_count &&
	 $date <= $event_recur_end_ut )
    {
      switch( $event_recur_period )
	{
	case 'weekly':
	  {
	    // handle each weekday
	    $tmp = '';
	    foreach( $event_recur_weekdays as $wd )
	      {
		if( count($results) >= $event_recur_count ) break;
		$str = sprintf($datefmtstr,$event_recur_interval,$period,$weekdays[$wd],$hour,$minute);
		$tmp = strtotime($str,$date);
		if( $tmp > $event_recur_end_ut ) break;
		$tmpa = array();
		$tmpa['start'] = $tmp;
		if( $deltat == 0 )
		  {
		    $tmpa['end'] = NULL;
		  }
		else
		  {
		    $tmpa['end'] = $tmp + $deltat;
		  }
		$results[] = $tmpa;
	      }
	    $date = $tmp;
	  }
	  break;
	  
	case 'monthly':
	  {
	    $tmp = '';
	    $month = date('M',$date);
	    $year = date('Y',$date);
	    foreach( $event_recur_monthdays as $md )
	      {
		if( count($results) >= $event_recur_count ) break;
		list($nth,$wd) = explode(',',$md,2);
		$tmp = nth_weekday($nth,$wd,$date);
		//$str = sprintf($datefmtstr,$md,$month,$year,$hour,$minute);
		//$tmp = strtotime($str,$date);
		if( $tmp <= $event_start_ut ) continue;

		$tmpa = array();
		$tmpa['start'] = $tmp;
		if( $deltat == 0 )
		  {
		    $tmpa['end'] = NULL;
		  }
		else
		  {
		    $tmpa['end'] = $tmp + $deltat;
		  }
		$results[] = $tmpa;

	      }

	    $tmp2 = strtotime(sprintf('+%d months',$event_recur_interval),$date);
	    if (date('d',$tmp2)>28)
	      {
		$tmp2 = strtotime('-4 days',$tmp2);
	      }
	    $date = $tmp2;
	  }
	  break;

	default:
	  {
	    // normal incrementing
	    $tmp = strtotime(sprintf($datefmtstr,$event_recur_interval,$period),$date);
	    $tmpa = array();
	    $tmpa['start'] = $tmp;
	    if( $deltat == 0 )
	      {
		$tmpa['end'] = NULL;
	      }
	    else
	      {
		$tmpa['end'] = $tmp + $deltat;
	      }
	    $results[] = $tmpa;
	    $date = $tmp;
	  }
	  break;
	}
    }

  return $results;
}

if (!$this->AllowAccess()) return;
$events_to_categories_table_name = $this->events_to_categories_table_name;

if( isset($params['cancel']) )
  {
    $this->Redirect($id,'defaultadmin',$returnid,array("module_message"=>$message));
  }

//
// Gather parameters
//
$recurring_events = '';
$user_id = $gCms->variables['user_id'] * -1 - 100;
$categories = get_parameter_value($params, 'event_categories',-1);
$event['event_id'] = get_parameter_value($params, 'event_id', -1);
$event = $this->GetEvent($event['event_id']);
$this->GetEventFromParams($event,$params,true);
$event_parent_id = $event['event_id'];

// Carry through any old values
// just incase a new file was not uploaded
foreach( $params as $k => $v )
{
  if( preg_match('/^upload_field_oldvalue_/', $k) )
    {
      $thefield = substr($k,strlen('upload_field_oldvalue_'));
      $params['field_'.$thefield] = $v;
    }
}
// handle deletion
foreach( $params as $k => $v )
{
  if( preg_match('/^remove_field_/', $k) && $v == 1 )
    {
      $thefield = substr($k,strlen('remove_field_'));
      if( isset($params['upload_field_oldvalue_'.$thefield]) )
	{
	  $v = $params['upload_field_oldvalue_'.$thefield];
	  $config = cmsms()->GetConfig();
	  $destDir = $this->GetPreference('uploaddirectory',$config['uploads_path']);
	  $dn = cms_join_path($destDir,$v);

	  @unlink($dn);
	  unset($params['field_'.$thefield]);
	}
    };
}

//
// Error Handling
//
if( $event['event_date_end_ut'] != NULL &&
    $event['event_date_end_ut'] < $event['event_date_start_ut'] )
  {
    $params['module_error'] = $this->Lang('error_invalid_dates');
    $params['event_recur_weekdays'] = implode(',',$params['event_recur_weekdays']);
    $params['event_recur_monthdays'] = implode(',',$params['event_recur_monthdays']);
    $params['do_get_from_params'] = 1;
    $this->Redirect($id,'admin_add_event',$returnid,$params);
  }
if($event['event_recur_period'] != 'none' &&
   $event['event_date_recur_end_ut'] != NULL &&
   ($event['event_date_recur_end_ut'] < $event['event_date_start_ut'] ||
    ($event['event_date_end_ut'] != NULL && 
     $event['event_date_recur_end_ut'] < $event['event_date_end_ut'])) )
  {
    $params['module_error'] = $this->Lang('error_invalid_dates');
    $params['event_recur_weekdays'] = implode(',',$event['event_recur_weekdays']);
    $params['event_recur_monthdays'] = implode(',',$event['event_recur_monthdays']);
    $params['do_get_from_params'] = 1;
    $this->Redirect($id,'admin_add_event',$returnid,$params);
  }
if($event['event_recur_period'] == 'monthly' &&
   count($event['event_recur_monthdays']) > 1 &&
   $event['event_recur_monthdays'][0] == 'specified')
  {
    $params['module_error'] = $this->Lang('error_invalid_recur_monthly_freq');
    $params['event_recur_weekdays'] = implode(',',$event['event_recur_weekdays']);
    $params['event_recur_monthdays'] = implode(',',$event['event_recur_monthdays']);
    $params['do_get_from_params'] = 1;
    $this->Redirect($id,'admin_add_event',$returnid,$params);
  }
if( empty($event['event_title']) )
  {
    $params['module_error'] = $this->Lang('error_noeventname');
    $params['event_recur_weekdays'] = implode(',',$event['event_recur_weekdays']);
    $params['event_recur_monthdays'] = implode(',',$event['event_recur_monthdays']);
    $params['do_get_from_params'] = 1;
    $this->Redirect($id,'admin_add_event',$returnid,$params);
  }
if( ($categories == -1) && $this->GetPreference('force_category') == 1)
  {
    $params['module_error'] = $this->Lang('error_nocategory');
    $params['event_recur_weekdays'] = implode(',',$event['event_recur_weekdays']);
    $params['event_recur_monthdays'] = implode(',',$event['event_recur_monthdays']);
    $params['do_get_from_params'] = 1;
    $this->Redirect($id,'admin_add_event',$returnid,$params);
  }
if( $event['event_recur_period'] != 'none' )
  {
    // calculate recurring events
    $recurring_events = calculate_recurring_events($event['event_date_start_ut'],
						   $event['event_date_end_ut'],
						   $event['event_recur_period'],
						   $event['event_date_recur_end_ut'],
						   $event['event_recur_interval'],
						   $event['event_recur_count'],
						   $event['event_recur_weekdays'],
						   $event['event_recur_monthdays']);



    // check recurring events for overlap
    $overlap = check_overlapping_events($event['event_date_start_ut'],
					$event['event_date_end_ut'],
					$recurring_events);
    if( $overlap === true )
      {
	$params['module_error'] = $this->Lang('error_eventoverlap');
	$params['event_recur_weekdays'] = implode(',',$params['event_recur_weekdays']);
	$params['event_recur_monthdays'] = implode(',',$params['event_recur_monthdays']);
	$params['do_get_from_params'] = 1;
	$this->Redirect($id,'admin_add_event',$returnid,$params);
      }

  }


//
// check for conflicting events.
//
$policy = $this->GetPreference('overlap_policy','all');
if( $policy != 'all' )
  {
    $conflict = check_db_for_conflicts($this,$event,$event['event_id'],$policy,
				       $event['event_allows_overlap']);
    if( $conflict )
      {
	// this is the parent event... we always display an error message if 
	// this parent event conflicts with another event.
	$params['module_error'] =  $this->Lang('error_event_conflict');
	$params['event_recur_weekdays'] = implode(',',$params['event_recur_weekdays']);
	$params['event_recur_monthdays'] = implode(',',$params['event_recur_monthdays']);
	$params['do_get_from_params'] = 1;
	$this->Redirect($id,'admin_add_event',$returnid,$params);
      }   

    // now check any child events
    if( $event['event_recur_period'] != 'none' && count($recurring_events) > 0 )
      {
	$new_recurring = array();
	foreach( $recurring_events as $oneevent )
	  {
	    $conflict = check_db_for_conflicts($this,$oneevent,$event['event_id'],$policy,
					       $event['event_allows_overlap']);
	    if( $conflict )
	      {
		if( $this->GetPreference('overlap_action','error') == 'error' )
		  {
		    $params['module_error'] = $this->Lang('error_event_conflict');
		    $params['event_recur_weekdays'] = implode(',',$params['event_recur_weekdays']);
		    $params['event_recur_monthdays'] = implode(',',$params['event_recur_monthdays']);
		    $params['do_get_from_params'] = 1;
		    $this->Redirect($id,'admin_add_event',$returnid,$params);
		  }
		else
		  {
		    // silently remove this event.
		    continue;
		  }
	      }
	    $new_recurring[] = $oneevent;
	  }
	$recurring_events = $new_recurring;
      }
  }



//
// Fix up the event so it's suitable for the database
//


//
// Process any file uploads that may have occurred
//
if( isset( $_FILES ) ) 
  {
    $fldname = '';
    $thefield = '';
    foreach( $params as $k => $v )
      {
	// see if we're expecting an upload
	if( preg_match('/^upload_field_/', $k) )
	  {
	    // we are it appears
            $thefield = substr($k,strlen('upload_field_'));
	    $fldname = $id.'field_'.$thefield;

	    if( !isset($_FILES[$fldname]) ||
		empty($_FILES[$fldname]['tmp_name']) ) continue;

	    $error = '';
	    $filename = $this->HandleUpload($fldname,$error);
	    if( $filename === false )
	      {
		// an error occurred
		$this->Redirect($id,'defaultadmin',$returnid,array("module_error"=>$error));
		return;
	      }

	    $params['field_'.$thefield] = $filename;
	  }
      }
  }


//
// Process the insert or update
//
$do_insert = true;
if($event['event_id'] > -1)
  {
    $do_insert = false;
    // update
    $sql = "UPDATE " . $this->events_table_name . " 
               SET event_title = ?
		   ,event_summary = ?
		   ,event_details = ?
                   ,event_date_start = ?
                   ,event_date_end = ?
		   ,event_recur_period = ?
		   ,event_date_recur_end = ?
                   ,event_recur_nevents = ?
                   ,event_recur_interval = ?
                   ,event_recur_weekdays = ?
                   ,event_recur_monthdays = ?
		   ,event_modified_date = NOW()
                   ,event_allows_overlap = ?
	     WHERE event_id = ?";
    $dbr =  $db->Execute($sql,
			 array($event['event_title'],
			       $event['event_summary'],
			       $event['event_details'],
			       trim($event['event_date_start'],"'"),
			       handle_null_date($event['event_date_end']),
			       $event['event_recur_period'],
			       handle_null_date($event['event_date_recur_end']),
			       $event['event_recur_count'],
			       $event['event_recur_interval'],
			       implode(',',$event['event_recur_weekdays']),
			       implode(',',$event['event_recur_monthdays']),
			       $event['event_allows_overlap'],
			       $event['event_id']));
    if( !$dbr )
      {
	echo "FATAL ERROR:<br/>";
	echo "QUERY = ".$db->sql."<br/>";
	echo "ERROR = ".$db->ErrorMsg()."<br/><br/>";
	die();
      }

    if( isset($params['update_children']) )
      {
	//here we also delete any and all children, and all sub-tables that may have been filled with child data. 
	$result=$db->Execute("SELECT event_id FROM " . $this->events_table_name . " WHERE event_parent_id = ?",array($event['event_id']));    
	$db->Execute("DELETE FROM " . $this->events_table_name . " WHERE event_parent_id = ?",array($event['event_id']));
	
	while ($row = $result->FetchRow()) 
	  {
	    //We clear these as they will be added later on
	  
	    //delete from categories
	    $db->Execute("DELETE FROM " . $this->events_to_categories_table_name . " WHERE event_id = ? LIMIT 1",array($row['event_id']));
	    //delete from custom fields
	    $db->Execute("DELETE FROM " . $this->event_field_values_table_name . " WHERE event_id = ? LIMIT 1",array($row['event_id']));
	  }
      }

  }
  //otherwise we are just adding a new event
else
  {
    $event['event_id'] = $db->GenID($this->events_table_name . "_seq");

    $sql = "INSERT INTO " . $this->events_table_name . "
             (event_id,event_title,event_summary,event_details
	      ,event_date_start,event_date_end,event_parent_id
	      ,event_recur_period, event_date_recur_end, event_created_by
              ,event_recur_nevents, event_recur_interval, event_recur_weekdays
              ,event_recur_monthdays, event_allows_overlap
	      ,event_create_date, event_modified_date) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW())";

    $dbr=$db->Execute($sql,
			 array($event['event_id'],
			       $event['event_title'],
			       $event['event_summary'],
			       $event['event_details'],
			       trim($event['event_date_start'],"'"),
			       handle_null_date($event['event_date_end']),
			       $event['event_parent_id'],
			       $event['event_recur_period'],
			       handle_null_date($event['event_date_recur_end']),
			       $user_id,
			       $event['event_recur_count'],
			       $event['event_recur_interval'],
			       implode(',',$event['event_recur_weekdays']),
			       implode(',',$event['event_recur_monthdays']),
			       $event['event_allows_overlap']));
    if( !$dbr )
      {
	echo "FATAL ERROR:<br/>";
	echo "QUERY = ".$db->sql."<br/>";
	echo "ERROR = ".$db->ErrorMsg()."<br/><br/>";
	die();
      }
  }


// delete current events_to_categories records for this event
$sql = "DELETE FROM " . $this->events_to_categories_table_name . " WHERE event_id = ?";
$result=$db->Execute($sql,array($event['event_id']));
//echo $sql; 

// update events_to_categories
if(is_array($categories) && (count($categories) > 0)) 
  {
    foreach($categories as $category_id) {
      $category_id = intval($category_id);
      if($category_id > 0) {
	$sql = "INSERT INTO " . $this->events_to_categories_table_name . "
	         (category_id, event_id)
	        VALUES (?,?)";
	$db->Execute($sql,array($category_id,$event['event_id']));
	//echo $sql;
      }
    }
  }

$fieldtext = '';
// Clear out all the custom field values for this event, and add the new ones from the form
{
  $fields = $this->GetFields();
  
  // Delete the custom field values first
  {
    $sql = "DELETE FROM " . $this->event_field_values_table_name . "
             WHERE event_id = ?";
    $result=$db->Execute($sql,array($event['event_id']));
  }
  
  $customfieldsvalues = array();
  foreach ($fields as $field)
    {
      $fieldname = $field['field_name'];
      // Replace spaces with underbars for the form parameter (a bit of an ikky hack I know, but I can well imagine folk defining custom fields with spaces in the name) Perhaps it would have been better if custom fields also had a numeric key - hohum live and learn!
      $safefieldname =  str_replace ( " ", "_", $fieldname );
      $field_value = get_parameter_value($params, 'field_' . $safefieldname, '');
      
      $sql = "INSERT INTO " . $this->event_field_values_table_name . "
               (field_name, event_id, field_value)
              VALUES (?,?,?)";
      
      if ($field_value) {
      	$result=$db->Execute($sql,array($fieldname,$event['event_id'],$field_value));
      }
      
      $customfieldsvalues[] = array($fieldname,$event['event_id'],$field_value);
      if( $field['field_searchable'] )
	{
	  $fieldtext .= $field_value.' ';
	}
    }
}

//////////////////////////////////////////////////////////////
// Update Search
/////////////////////////////////////////////////////////////
$search =& $this->GetModuleInstance('Search');
if( $search != FALSE )
  {
    $text = "{$event['event_title']} {$event['event_summary']} {$event['event_details']}";
    $text .= ' '.$fieldtext;
    $search->AddWords($this->GetName(), $event['event_id'], 'event', $text, NULL);
  }
    

//////////////////////////////////////////////////////////////
// Add recurring events
/////////////////////////////////////////////////////////////
if( ($event['event_recur_period'] != 'none') && 
    (is_array($recurring_events) && count($recurring_events) > 0) &&
    (isset($params['update_children']) || ($do_insert == true) ) )
  {
    $sql = "INSERT INTO " . $this->events_table_name . "
             (event_id
              ,event_title
              ,event_summary
              ,event_details
	      ,event_date_start
              ,event_date_end
              ,event_parent_id
              ,event_created_by
              ,event_allows_overlap
	      ,event_create_date, event_modified_date) 
             VALUES (?,?,?,?,?,?,?,?,?,NOW(),NOW())";
    foreach( $recurring_events as $oneevent )
      {
	$child_event_id = $db->GenID($this->events_table_name . "_seq");
	$dbr = $db->Execute($sql,
			    array($child_event_id,
				  $event['event_title'],
				  $event['event_summary'],
				  $event['event_details'],
				  trim($db->DbTimeStamp($oneevent['start']),"'"),
				  handle_null_date_ts($oneevent['end']),
				  $event['event_id'],
				  $user_id,
				  $event['event_allows_overlap']));
	if( !$dbr )
	  {
	    echo "FATAL ERROR:<br/>";
	    echo "QUERY = ".$db->sql."<br/>";
	    echo "ERROR = ".$db->ErrorMsg()."<br/><br/>";
	    die();
	  }

	if(is_array($categories) && (count($categories) > 0)) 
	  {
	    foreach($categories as $category_id) {
	      $category_id = intval($category_id);
	      if($category_id > 0) {
		$sql2 = "INSERT INTO " . $this->events_to_categories_table_name . "
          	         (category_id, event_id)
	                VALUES (?,?)";
		$db->Execute($sql2,array($category_id,$child_event_id));
	      }
	    }
	  }


      }

  }

$eventname = 'EventAdded';
$parms = array();
$parms['event_title'] = $event['event_title'];
$parms['event_summary'] = $event['event_summary'];
$parms['event_details'] = $event['event_details'];
$parms['event_date_start'] = $event['event_date_start'];
$parms['event_date_end'] = $event['event_date_end'];
$parms['event_created_by'] = $user_id;
$parms['event_id'] = $event['event_id'];
if( $event['event_id'] > -1 )
  {
    $eventname = 'EventEdited';
  }
$this->SendEvent( $eventname, $parms );

$message=$this->Lang("eventupdated");

//
// done
//
$this->Redirect($id,'defaultadmin',$returnid,array("module_message"=>$message));


// EOF
?>