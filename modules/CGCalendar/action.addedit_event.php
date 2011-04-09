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

function handle_null_date($str)
{
  if( !is_null($str) )
    {
      return trim($str,"'");
    }
  return $str;
}


//
// safety checks
//
$feu = $this->GetModuleInstance('FrontEndUsers');
if( !$feu )
  {
    echo '<h3><font color="red">'.$this->Lang('error_nofeu')."</font></h3>\n";
    return;
  }
else if( !$feu->LoggedIn() )
  {
    echo '<h3><font color="red">'.$this->Lang('error_feu_loggedin')."</font></h3>\n";
    return;
  }

//
// initialization
//
$feu_uid = $feu->LoggedInId();
$thetemplate = 'editevent_'.$this->GetPreference(CGCALENDAR_PREF_DFLTEDITEVENT_TEMPLATE);
if( isset($params['editeventtemplate'] ) )
  {
    $thetemplate = 'editevent_'.$params['editeventtemplate'];
  }
$event_id = get_parameter_value($params, 'event_id', -1);
$event = $this->GetEvent($event_id);
$fields = $this->GetFields();
$categories =$this->GetCategories();
$policy = $this->GetPreference('overlap_polciy','all');
$force_category = $this->GetPreference('force_category',0);
$destpage = $returnid;
if( isset($params['return_id']) )
  {
    $destpage = (int)$params['return_id'];
  }
else 
  {
    $tmp = $this->GetPreference('frontend_redirectpage','');
    $tmp = $this->ProcessTemplateFromData($tmp);
    $tmp = $this->resolve_alias_or_id($tmp);
    if( $tmp )
      {
	$destpage = $tmp;
      }
  }
$status = '';
$message = '';

// Add input controls for each of the custom fields that are defined.
if( $fields )
  {
    $tmp = array();
    foreach($fields as $field) 
      {
	$field_values = $event['fields'];
	$field_name = $field['field_name'];
	$field_type = $field['field_type'];
	$field_value = "";
	if( isset($field_values[$field_name]) )
	  {
	    $field_value = $field_values[$field_name];
	  }

	// Replace spaces with underbars for the form parameter (a bit of an ikky hack I know, 
	// but I can well imagine folk defining custom fields with spaces in the name) 
	// Perhaps it would have been better if custom fields also had a numeric key - hohum live and learn!
	
	$obj = new StdClass();
	$obj->name = $field['field_name'];
	$obj->safename =  str_replace ( " ", "_", $field_name );
	$obj->value = $field_value;
	$obj->type = $field_type;
	switch( $field_type )
	  {
	  case 0: // the normal text field
	    $obj->field = $this->CreateInputText($id, 'cal_field_'.$obj->safename, $field_value, 50, 255);
	    break;

	  case 1: // an upload field type
	    // display a label with the current value, and then an upload field
	    $obj->value = $field_value;
	    $obj->field = $this->CreateFileUploadInput($id,'cal_field_'.$obj->safename,'',50).
	      $this->CreateInputHidden($id,'cal_upload_field_'.$obj->safename,$field_name).
	      $this->CreateInputHidden($id,'cal_upload_field_oldvalue_'.$obj->safename,$field_value);
	    break;

	  case 2:
	    $obj->field = $this->CreateTextArea(false,$id,$field_value,'cal_field_'.$obj->safename);
	    break;
	  }
	$tmp[$obj->safename] = $obj;
      }
    if( count($tmp) )
      {
	$fields = $tmp;
      }
  }

if( $categories )
  {
    $dflt_cat = $this->GetPreference('default_category','');
    $tmp = array();
    foreach( $categories as $category )
      {
	$obj = new StdClass();
	$obj->id = $category['category_id'];
	$obj->name = $category['category_name'];
	$obj->checked = 0;
	if( $obj->id == $dflt_cat && $event_id == -1 )
	  {
	    $obj->checked = 1;
	  }
	else if( in_array($obj->id,$event['categories']) )
	  {
	    $obj->checked = 1;
	  }
	$obj->field = 
	  $this->CreateInputHidden($id,'cal_event_categories['.$obj->id.']',0).
	  $this->CreateInputCheckbox($id,'cal_event_categories['.$obj->id.']',1,$obj->checked,"id='category".$obj->id."'");
	$tmp[$obj->id] = $obj;
      }
    $categories = $tmp;
  }

//
// Process the form
//
if( isset($params['cal_cancel']) )
  {
    $this->RedirectContent($destpage);
  }
else if( isset($params['cal_submit']) )
  {
    $tmp = array();
    foreach( $params as $key => $value )
      {
	if( startswith($key,'cal_') )
	  {
	    $key = substr($key,strlen('cal_'));
	  }
	$tmp[$key] = $value;
      }
    $params = $tmp;
    $this->GetEventFromParams($event,$tmp,true);
//     debug_display($params); 
//     debug_display($event);

    // check for data quality
    if( $event['event_date_end_ut'] != NULL &&
	$event['event_date_end_ut'] < $event['event_date_start_ut'] )
      {
	$status = 'error_invalid_dates';
	$message = $this->Lang('error_invalid_dates');
      }
    if( empty($status) && empty($event['event_title']) )
      {
	$status = 'error_noeventname';
	$message = $this->Lang('error_noeventname');
      }
    if( empty($status) && (!isset($params['event_categories']) || empty($params['event_categories'])) )
      {
	$status = 'error_nocategory';
	$message = $this->Lang('error_nocategory');
      }

    // check event for conflicts.
    if( empty($status) && $policy != 'all' )
      {
	$conflict = cgc_event_utils::is_event_conflicted($event,$policy);
	if( $conflict )
	  {
	    $status = 'error_event_conflict';
	    $message = $this->Lang('error_event_conflict');
	  }
      }
    
    // handle any file fields...
    if( isset($_FILES) )
      {
	foreach( $params as $key => $value )
	  {
	    if( !startswith($key,'upload_field_') ) continue;

	    $thefield = substr($key,strlen('upload_field_'));
	    $fldname = $id.'cal_field_'.$thefield;
	    if( !isset($_FILES[$fldname]) || empty($_FILES[$fldname]['tmp_name']) ) continue;

	    $error = '';
	    $filename = $this->HandleUpload($fldname,$error);
	    if( $filename === false )
	      {
		$status = 'error_upload';
		$message = $error;
		break;
	      }
	    $params['field_'.$thefield] = $filename;
	  }
      }

    // merge field values back into the fields array
    foreach( $params as $key => $value )
      {
	if( !startswith($key,'field_') ) continue;
	$fieldname = substr($key,strlen('field_'));
	$fields[$fieldname]->value = $value;
      }

    // merge category values back into the categories array
    if( isset($params['event_categories']) )
      {
	foreach( $categories as &$one )
	  {
	    if( isset($params['event_categories'][$one->id]) )
	      {
		$one->checked = $params['event_categories'][$one->id];
	      }
	    else
	      {
		$one->checked = 0;
	      }
	  }
      }
    
    
    // ready to insert or update
    if( empty($status) )
      {
	$dbr = '';
	if( $event['event_id'] > 0 )
	  {
	    //  it's an update
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
	     WHERE event_id = ? AND event_created_by = ?";

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
				       $event['event_id'],
				       $feu_uid));

	  }
	else
	  {
	    // it's an insert
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
				    $feu_uid,
				    $event['event_recur_count'],
				    $event['event_recur_interval'],
				    implode(',',$event['event_recur_weekdays']),
				    implode(',',$event['event_recur_monthdays']),
				    $event['event_allows_overlap']));
	  }

	if( !$dbr )
	  {
	    $status = 'error_dberror';
	    $message = $this->Lang('error_dberror').': '.$db->sql.' ('.$db->ErrorMsg().')';
	  }
      }

    // insert field definitions
    if( empty($status) )
      {
	// delete existing custom field values first.
	$query = 'DELETE FROM '.$this->event_field_values_table_name.'
                   WHERE event_id = ?';
	$db->Execute($query,array($event['event_id']));

	$query = 'INSERT INTO '.$this->event_field_values_table_name.'
                   (field_name, event_id, field_value)
                  VALUES (?,?,?)';

	foreach( $fields as $field )
	  {
	    $fieldname = $field->name;
	    $field->value = get_parameter_value($params, 'field_' . $field->safename, '');

	    if( !empty($field->value) )
	      {
		$db->Execute($query,array($field->name,$event['event_id'],$field->value));
	      }
	  }
      }

    // insert category values
    if( empty($status) )
      {
	$query = 'DELETE FROM '.$this->events_to_categories_table_name.' WHERE event_id = ?';
	$db->Execute($query,array($event['event_id']));

	$query = 'INSERT INTO '.$this->events_to_categories_table_name.'
                    (category_id,event_id)
                  VALUES (?,?)';
	foreach( $categories as &$one )
	  {
	    if( !$one->checked ) continue;
	    if( $one->id <= 0 ) continue;

	    $db->Execute($query,array($one->id,$event['event_id']));
	  }
      }

    if( empty($status) )
      {
	$this->RedirectContent($destpage);
      }

    // fall through.
  }

//
// build the form
//
$smarty->assign('event',$event);
if( !empty($status) ) 
  {
    $smarty->assign('status',$status);
  }
if( !empty($message) ) 
  {
    $smarty->assign('message',$message);
  }
if( $fields ) $smarty->assign('fields',$fields);
if( $categories ) $smarty->assign('categories',$categories);
$smarty->assign('formstart',$this->CGCreateFormStart($id,'addedit_event',$returnid,$params,false,'post','multipart/form-data'));
$smarty->assign('formend',$this->CreateFormEnd());
$current_year = date('Y');
$start = $current_year - $this->GetPreference('showpastyears',2);
$end = $current_year + $this->GetPreference('showfutureyears',10);
$smarty->assign('start_year',$start);
$smarty->assign('end_year',$end);


//
// display
//
echo $this->ProcessTemplateFromDatabase($thetemplate);
#
# EOF
#
?>