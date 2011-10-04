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
$this->SetCurrentTab('defaultadmin');

if( !$this->AllowAccess() )
{
  return;
}

$db = $this->GetDb(); /* @var $db ADOConnection */
$categories = $this->GetCategories();
// Get the event
$event_id = get_parameter_value($params, 'event_id', -1);
$event = $this->GetEvent($event_id);
if( isset($params['do_get_from_params']) && $params['do_get_from_params'] == 1 )
  {
    $this->GetEventFromParams($event,$params);
  }
$tmp = cgcalendar_utils::get_username($event['event_created_by']);
if( $tmp )
  {
    $event['owner_name'] = $tmp;
  }
$smarty->assign('event',$event);
$fields = $this->GetFields();

$button_text = $this->Lang('cal_add');
if($event_id > 0)
{
	$button_text = $this->Lang('cal_update');
}

$extra="";
if ($this->GetPreference("force_category")==1) {
  $extra="onsubmit='for(i=0;i<".count($categories).";i++){var name=\"category\"+i; var element=document.getElementById(name); if (element.checked) return true;}; alert(\"".$this->Lang("category_reminder")."\"); return false;'";  
}
$smarty->assign('formstart',$this->CreateFormStart($id, 'admin_event_update', $returnid, $method='post', $enctype='multipart/form-data', 
						   false,"",array(),$extra));
$smarty->assign('hidden',$this->CreateInputHidden($id, 'event_id', $event_id));

$current_year = date('Y');
$start = $current_year - $this->GetPreference('showpastyears',2);
$end = $current_year + $this->GetPreference('showfutureyears',10);
$smarty->assign('start_year',$start);
$smarty->assign('end_year',$end);

$event_date_start_ut = time();
if(isset($params['startdate_Hour']))
{
  $event_date_start_ut = mktime($params['startdate_Hour'],
				$params['startdate_Minute'],
				0,
				$params['startdate_Month'],
				$params['startdate_Day'],
				$params['startdate_Year']);
}

$event_date_end_ut = 0;
if(isset($params['enddate_Hour']))
{
  $event_date_end_ut = mktime($params['enddate_Hour'],
				$params['enddate_Minute'],
				59,
				$params['enddate_Month'],
				$params['enddate_Day'],
				$params['enddate_Year']);
}

$event_recur_period = 'none';
if (isset($event['event_recur_period']))  $event_recur_period = $event['event_recur_period'];

$recur_days = array();
$recur_days['specified']        = $this->Lang('specified_date');
$recur_days['1,0']  = $this->Lang('first_sunday');
$recur_days['1,1']  = $this->Lang('first_monday');
$recur_days['1,2']  = $this->Lang('first_tuesday');
$recur_days['1,3']  = $this->Lang('first_wednesday');
$recur_days['1,4']  = $this->Lang('first_thursday');
$recur_days['1,5']  = $this->Lang('first_friday');
$recur_days['1,6']  = $this->Lang('first_saturday');
$recur_days['2,0']  = $this->Lang('second_sunday');
$recur_days['2,1']  = $this->Lang('second_monday');
$recur_days['2,2']  = $this->Lang('second_tuesday');
$recur_days['2,3']  = $this->Lang('second_wednesday');
$recur_days['2,4']  = $this->Lang('second_thursday');
$recur_days['2,5']  = $this->Lang('second_friday');
$recur_days['2,6']  = $this->Lang('second_saturday');
$recur_days['3,0']  = $this->Lang('third_sunday');
$recur_days['3,1']  = $this->Lang('third_monday');
$recur_days['3,2']  = $this->Lang('third_tuesday');
$recur_days['3,3']  = $this->Lang('third_wednesday');
$recur_days['3,4']  = $this->Lang('third_thursday');
$recur_days['3,5']  = $this->Lang('third_friday');
$recur_days['3,6']  = $this->Lang('third_saturday');
$recur_days['4,0']  = $this->Lang('fourth_sunday');
$recur_days['4,1']  = $this->Lang('fourth_monday');
$recur_days['4,2']  = $this->Lang('fourth_tuesday');
$recur_days['4,3']  = $this->Lang('fourth_wednesday');
$recur_days['4,4']  = $this->Lang('fourth_thursday');
$recur_days['4,5']  = $this->Lang('fourth_friday');
$recur_days['4,6']  = $this->Lang('fourth_saturday');
$recur_days['-1,0'] = $this->Lang('last_sunday');
$recur_days['-1,1'] = $this->Lang('last_monday');
$recur_days['-1,2'] = $this->Lang('last_tuesday');
$recur_days['-1,3'] = $this->Lang('last_wednesday');
$recur_days['-1,4'] = $this->Lang('last_thursday');
$recur_days['-1,5'] = $this->Lang('last_friday');
$recur_days['-1,6'] = $this->Lang('last_saturday');
$smarty->assign('recur_days',$recur_days);


$weekdays = array($this->Lang('sunday')=>'0',
		  $this->Lang('monday')=>'1',
		  $this->Lang('tuesday')=>'2',
		  $this->Lang('wednesday')=>'3',
		  $this->Lang('thursday')=>'4',
		  $this->Lang('friday')=>'5',
		  $this->Lang('saturday')=>'6');
$tmp = array();
$smarty->assign('input_weekdays',
		$this->CreateInputSelectList($id,'event_recur_weekdays[]',$weekdays,
					     $event['event_recur_weekdays'],7));
$smarty->assign('repeat_str',$this->Lang('plural_'.$event['event_recur_period']));
$smarty->assign('weekdays',$weekdays);
$nums = array();
$nums[-1] = $this->Lang('unlimited');
for( $i = 0; $i < 50; $i++ )
  {
    $nums[$i+1] = $i+1;
  }
$nums[100] = 100;
$nums[250] = 250;
$smarty->assign('maxiters',$nums);
$nums = array();
for( $i = 0; $i < 30; $i++ )
  {
    $nums[$i+1] = $i+1;
  }
$smarty->assign('nums',$nums);
$smarty->assign('recur_options',
		array($this->Lang('no')=>"none",
		      $this->Lang('daily')=>'daily',
		      $this->Lang('weekly')=>'weekly',
		      $this->Lang('monthly')=>'monthly',
		      $this->Lang('yearly')=>'yearly'));
$smarty->assign('event_recur_period',$event_recur_period);

if( $this->GetPreference('overlap_policy','all') == 'individual' )
  {
    $smarty->assign('allow_overlap',1);
  }

$smarty->assign('event_title',$this->CreateInputText($id, 'event_title', $event['event_title'], 50, 255));

if ($this->GetPreference("hidesummary")!=1) {
  $smarty->assign('event_summary',$this->CreateInputText($id, 'event_summary', $event['event_summary'], 50, 255));
}

// Add input controls for each of the custom fields that are defined.
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
  $safefieldname =  str_replace ( " ", "_", $field_name );
	
  $obj = new StdClass();
  $obj->name = $field['field_name'];
  $obj->value = $field_value;
  $obj->type = $field['field_type'];
  switch( $field_type )
    {
    case 0: // the normal text field
      $obj->field = $this->CreateInputText($id, 'field_'.$safefieldname, $field_value, 50, 255);
      break;
    case 1: // an upload field type
      // display a label with the current value, and then an upload field
      $obj->value = $field_value;
      $obj->field = $this->CreateFileUploadInput($id,'field_'.$safefieldname,'',50).
	$this->CreateInputHidden($id,'upload_field_'.$safefieldname,$field_name).
	$this->CreateInputHidden($id,'upload_field_oldvalue_'.$safefieldname,$field_value);
      if( $field_value ) $obj->field .=
	$this->CreateInputHidden($id,'remove_field_'.$safefiledname,0).
	$this->CreateInputCheckbox($id,'remove_field_'.$safefieldname,1).'&nbsp;'.$this->Lang('delete');
      break;

    case 2:
      $obj->field = $this->CreateTextArea(false,$id,$field_value,'field_'.$safefieldname);
      break;

    case 3:
      // company directory entry.
      $cdmod = cms_utils::get_module('CompanyDirectory');
      if( !$cdmod )
	{
	  // have field type, but no companydirectory module.
	  continue;
	}
      // get a list of the companies that we want to display
      {
	$query = 'SELECT id,company_name FROM '.cms_db_prefix().'module_compdir_companies ORDER BY company_name';
	$dbr = $db->GetArray($query);
	if( $dbr )
	  {
	    $tmp2 = array($this->Lang('none')=>-1);
	    for( $i = 0; $i < count($dbr); $i++ )
	      {
		$tmp2[$dbr[$i]['company_name']] = $dbr[$i]['id'];
	      }
	    $obj->field = $this->CreateInputDropdown($id,'field_'.$safefieldname,$tmp2,-1,$field_value);
	  }
      }
      break;
    }
  $tmp[] = $obj;
}
if( count($tmp) )
  {
    $smarty->assign('fields',$tmp);
  }

if ($this->GetPreference("hidecontent")!=1) {
  $smarty->assign('event_details',
		  $this->CreateTextArea(true, $id, $event['event_details'], 'event_details', 'content', $id));
}

$num_cats = count($categories);
$count = 0;
$tmp = array();
for($i = 0; $i < $num_cats; $i++,$count ++)
{
  $category = $categories[$i];
  $cat_id = $category['category_id'];
  $cat_name = $category['category_name'];
  $checked = '';
  // Following line seems non-function. commenting out. - Elijah	
  // if(in_array($cat_id, $event['categories']))	$checked = $cat_id;
  
  //Only tag the default-category is you are adding an event, not it you are editing
  if ($event_id==-1) {
    if($cat_id == $this->GetPreference('default_category', ''))
      {
	$checked = $cat_id;
      }
  } else {
    if(in_array($cat_id, $event['categories']))	$checked = $cat_id;
  }
  $obj = new StdClass();
  $obj->field = $this->CreateInputCheckbox($id, 'event_categories[]', $cat_id, $checked,"id='category$i'");
  $obj->name = $cat_name;
  $tmp[] = $obj;
}
if( count($tmp) )
  {
    $smarty->assign('categories',$tmp);
  }

$smarty->assign('submit',$this->CreateInputSubmit($id,'submit',$button_text));
$smarty->assign('cancel',$this->CreateInputSubmit($id,'cancel',$this->Lang('cancel')));
$smarty->assign('formend',$this->CreateFormEnd());

echo $this->ProcessTemplate('admin_add_event.tpl');

?>