<?php  /* -*- Mode: PHP; tab-width: 4; c-basic-offset: 2 -*- */
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

$cgextensions = cms_join_path($gCms->config['root_path'],'modules',
			      'CGExtensions','CGExtensions.module.php');
if( !is_readable( $cgextensions ) )
{
  echo '<h1><font color="red">ERROR: The CGExtensions module could not be found.</font></h1>';
  return;
}
require_once($cgextensions);

define('CGCALENDAR_PREF_NEWCALENDAR_TEMPLATE','cgcalendar_pref_newcalendar_template');
define('CGCALENDAR_PREF_DFLTCALENDAR_TEMPLATE','cgcalendar_pref_dfltcalendar_template');
define('CGCALENDAR_PREF_NEWLIST_TEMPLATE','cgcalendar_pref_newlist_template');
define('CGCALENDAR_PREF_DFLTLIST_TEMPLATE','cgcalendar_pref_dfltlist_template');
define('CGCALENDAR_PREF_NEWUPCOMINGLIST_TEMPLATE','cgcalendar_pref_newupcominglist_template');
define('CGCALENDAR_PREF_DFLTUPCOMINGLIST_TEMPLATE','cgcalendar_pref_dfltupcominglist_template');
define('CGCALENDAR_PREF_NEWEVENT_TEMPLATE','cgcalendar_pref_newevent_template');
define('CGCALENDAR_PREF_DFLTEVENT_TEMPLATE','cgcalendar_pref_dfltevent_template');
define('CGCALENDAR_PREF_NEWSEARCH_TEMPLATE','cgcalendar_pref_newsearch_template');
define('CGCALENDAR_PREF_DFLTSEARCH_TEMPLATE','cgcalendar_pref_dfltsearch_template');
define('CGCALENDAR_PREF_NEWSEARCHRESULT_TEMPLATE','cgcalendar_pref_newsearchresult_template');
define('CGCALENDAR_PREF_DFLTSEARCHRESULT_TEMPLATE','cgcalendar_pref_dfltsearchresult_template');
define('CGCALENDAR_PREF_NEWMYEVENTS_TEMPLATE','cgcalendar_pref_newmyevents_template');
define('CGCALENDAR_PREF_DFLTMYEVENTS_TEMPLATE','cgcalendar_pref_dfltmyevents_template');
define('CGCALENDAR_PREF_NEWEDITEVENT_TEMPLATE','cgcalendar_pref_neweditevent_template');
define('CGCALENDAR_PREF_DFLTEDITEVENT_TEMPLATE','cgcalendar_pref_dflteditevent_template');

class CGCalendar extends CGExtensions
{
  var $categories_table_name;
  var $events_to_categories_table_name;
  var $events_table_name;
  var $fields_table_name;
  var $event_field_values_table_name;
  var $admin_tools_loaded;
  
  function __construct()
    {
      parent::__construct();
      
      $this->categories_table_name = cms_db_prefix() . 'module_cgcalendar_categories';
      $this->events_to_categories_table_name = cms_db_prefix().'module_cgcalendar_events_to_categories';
      $this->events_table_name = cms_db_prefix().'module_cgcalendar_events';
      $this->event_field_values_table_name = cms_db_prefix() . 'module_cgcalendar_event_field_values';
      $this->fields_table_name = cms_db_prefix() . 'module_cgcalendar_fields';
      $this->admin_tools_loaded = false;
    }

  function SetParameters()
    {
      $this->RegisterModulePlugin();
      $this->RestrictUnknownParams();
      
      $this->SetParameterType('day',CLEAN_INT);

      $this->SetParameterType('display',CLEAN_STRING);
      $this->SetParameterType('category',CLEAN_STRING);
      $this->SetParameterType('month',CLEAN_INT);
      $this->SetParameterType('year',CLEAN_INT);
      $this->SetParameterType('first_day_of_week',CLEAN_INT);
      $this->SetParameterType('use_session',CLEAN_STRING);
      $this->SetParameterType('inline',CLEAN_INT);
	  $this->SetParameterType('reverse',CLEAN_STRING);
      $this->SetParameterType('detailpage',CLEAN_STRING);
      $this->SetParameterType('columns',CLEAN_INT);
      $this->SetParameterType('columnstyle',CLEAN_STRING);
      $this->SetParameterType('currentcolumn',CLEAN_INT);

	  $this->SetParameterType('page',CLEAN_INT);
      $this->SetParameterType('event_id',CLEAN_INT);
      $this->SetParameterType('limit',CLEAN_INT);
	  $this->SetParameterType('detail',CLEAN_STRING);
      $this->SetParameterType('calendartemplate',CLEAN_STRING);
      $this->SetParameterType('eventtemplate',CLEAN_STRING);
      $this->SetParameterType('listtemplate',CLEAN_STRING);
      $this->SetParameterType('upcominglisttemplate',CLEAN_STRING);
	  $this->SetParameterType('searchtemplate',CLEAN_STRING); // todo, doc this.
	  $this->SetParameterType('searchresulttemplate',CLEAN_STRING); // todo, doc this.
	  $this->SetParameterType('searchresultpage',CLEAN_STRING); // todo, doc this
	  $this->SetParameterType('displayforday',CLEAN_INT);

	  $this->CreateParameter('myeventstemplate','',$this->Lang('help_param_myeventstemplate'));
	  $this->SetParameterType('myeventstemplate',CLEAN_STRING); 
	  $this->CreateParameter('editeventtemplate','',$this->Lang('help_param_editeventtemplate'));
	  $this->SetParameterType('editeventtemplate',CLEAN_STRING); 
	  $this->CreateParameter('editpage','',$this->Lang('help_param_editpage'));
      $this->SetParameterType('editpage',CLEAN_INT);

	  $this->SetParameterType('unique_only',CLEAN_INT);

      $this->SetParameterType('return_id',CLEAN_INT);
      $this->SetParameterType('return_link',CLEAN_STRING);

	  $this->SetParameterType('show_ical',CLEAN_STRING);
      
	  $this->SetParameterType(CLEAN_REGEXP.'/cal_.*/',CLEAN_STRING);

      $this->RegisterRoute('/'.$this->GetPreference('url_prefix','calendar').'\/(?P<returnid>[0-9]+)\/(?P<event_id>[0-9]+)-.*$/',
			   array('action'=>'default',
				 'display'=>'event'));
    }
  

  function GetName()
    {
      return 'CGCalendar';
    }
  
  function GetFriendlyName()
    {
      return $this->Lang('cal_calendar');
    }
  
  function GetAuthor()
    {
      return 'Rob Allen/Calguy1000/Morten Poulsen';
    }
  
  function GetAuthorEmail()
    {
      return 'morten@poulsen.org/calguy1000@hotmail.com';
    }
  
  function IsPluginModule()
    {
      return true;
    }
  
  function HasAdmin()
    {
      return true;
    }
  
  function VisibleToAdminUser()
    {
      return $this->CheckPermission('Modify Calendar') ||
		$this->CheckPermission('Manage Calendar Attributes') ||
		$this->CheckPermission('Modify Site Preferences') ||
		$this->CheckPermission('Modify Templates');
    }
  
  function GetEventDescription( $eventname )
    {
      return $this->lang('eventdesc-' . $eventname);
    }

  function GetEventHelp( $eventname )
    {
      return $this->lang('eventhelp-' . $eventname);
    }

  function GetVersion()
    {
      return '1.7.4';
    }

  function GetDependencies()
    {
      return array('CGExtensions'=>'1.25');
    }

  function GetDescription($lang = 'en_US')
    {
      return $this->Lang("description");
    }

  function GetAdminDescription()
    {
      return $this->Lang('cal_description');
    }

  function GetAdminSection()
    {
      return 'content';
    }

  function GetHelp ()
    {
      return $this->Lang ('cal_help');
    }

  function MinimumCMSVersion()
    {
      return '1.9.2';
    }

  function GetChangeLog()
    {
      return file_get_contents(dirname(__FILE__).'/changelog.inc');
    }

  function InstallPostMessage()
    {
      return $this->Lang('install_postmessage');
    }

  function UninstallPreMessage()
  {
	return $this->Lang('areyousure_uninstall');
  }

  function UninstallPostMessage()
  {
	return $this->Lang('post_uninstall');
  }

  function GetEvent($event_id)
    {
      $db = $this->GetDb(); /* @var $db ADOConnection */

      $sql = 'SELECT * FROM ' . $this->events_table_name .' WHERE event_id = ?';
      $rs = $db->Execute($sql,array($event_id));
      if($rs && $rs->RecordCount() > 0)
		{
		  $result = $rs->FetchRow();
		  $result['event_date_start_ut'] = $db->UnixTimeStamp($result['event_date_start']);
		  if( is_null($result['event_date_end']) || $result['event_date_end'] == '0000-00-00 00:00:00')
			{
			  $result['event_date_end'] = NULL;
			}
		  $result['event_date_end_ut'] = $db->UnixTimeStamp($result['event_date_end']);
		  if( is_null($result['event_date_recur_end']) || $result['event_date_recur_end'] == '0000-00-00 00:00:00' )
			{
			  $result['event_date_recur_end'] = NULL;
			}
		  $result['event_date_recur_end_ut'] = $db->UnixTimeStamp($result['event_date_recur_end']);
		  $result['event_recur_count'] = $result['event_recur_nevents'];
		  $result['event_recur_weekdays'] = explode(',',$result['event_recur_weekdays']);
		  $result['event_recur_monthdays'] = explode(',',$result['event_recur_monthdays']);
		  $result['categories'] = array();

		  // now pick up categories
		  $sql = 'SELECT category_id FROM ' . $this->events_to_categories_table_name . ' WHERE event_id = ?';
		  $rs = $db->Execute($sql,array($event_id));
		  if($rs)
			{
			  while($row = $rs->FetchRow())
				{
				  $result['categories'][] = $row['category_id'];
				}
			}
		  
		  // now pick up the custom fields
		  $result['fields'] = array();
		  $sql = 'SELECT field_name, field_value FROM ' . $this->event_field_values_table_name . ' WHERE event_id = ?';
		  $rs = $db->Execute($sql,array($event_id));
		  if($rs)
			{
			  while($row = $rs->FetchRow())
				{
				  $result['fields'][$row['field_name']] = $row['field_value'];
				}
			}

		  // test if this is an all day event.
		  // cuz we don't store that info in the database.
		  $sd = date('z',$result['event_date_start_ut']);
		  $sh = date('G',$result['event_date_start_ut']);
		  $sm = date('i',$result['event_date_start_ut']);
		  $ed = date('z',$result['event_date_end_ut']);
		  $eh = date('G',$result['event_date_end_ut']);
		  $em = date('i',$result['event_date_end_ut']);
		  $result['all_day_event'] = 0;
		  $result['alt_end_date'] = 0;
		  if( $sh == 0 && $sm == 0 && $eh == 23 && $em == 59 )
			{
			  $result['all_day_event'] = 1;
			}
		  if( $sd != $ed )
			{
			  $result['alt_end_date'] = 1;
			}
		}
      else
		{
		  // create an empty record
		  $result = array();
		  $result['event_id'] = -1;
		  $result['event_title'] = '';
		  $result['event_summary'] = '';
		  $result['event_details'] = '';
		  $result['event_date_start'] = NULL;
		  $result['event_date_end'] = NULL;
		  $result['event_date_start_ut'] = strtotime($this->GetPreference('dflt_starttime'));
		  $result['event_date_end_ut'] = NULL;
		  $result['event_created_by'] = -1;
		  $result['event_create_date'] = NULL;
		  $result['event_modified_date'] = NULL;
		  $result['event_recur_period'] = 'none';
		  $result['event_date_recur_end_ut'] = NULL;
		  $result['event_date_recur_end'] = NULL;
		  $result['event_recur_interval'] = -1;
		  $result['event_parent_id'] = -1;
		  $result['event_recur_count'] = -1;
		  $result['event_recur_weekdays'] = array();
		  $result['event_recur_monthdays'] = array();
		  $result['event_allows_overlap'] = 1; // default to yes.
		  $result['categories'] = array();
		  $result['fields'] = array();
		  $result['all_day_event'] = $this->GetPreference('dflt_alldayevent');
		  $result['alt_end_date'] = 0;
		}
	  
      return $result;
    }


  function GetEventFromParams(&$event,$params,$is_edit = false)
    {
	  $db = $this->GetDb();
	  if( isset($params['event_id']) )
		{
		  $event['event_id'] =  (int)$params['event_id'];
		}
	  if( isset($params['event_parent_id']) )
		{
		  $event['event_parent_id'] = (int)$params['event_parent_id'];
		}
	  if( isset($params['event_title']) )
		{
		  $event['event_title'] = trim($params['event_title']);
		}
	  if( isset($params['event_summary']) )
		{
		  $event['event_summary'] = trim($params['event_summary']);
		}
	  if( isset($params['event_details']) )
		{
		  $event['event_details'] = trim($params['event_details']);
		}
	  
	  if( isset($params['event_allows_overlap']) )
		{
		  $event['event_allows_overlap'] = (int)$params['event_allows_overlap'];
		}
	  else
		{
	      $tmp = $this->GetPreference('overlap_policy','all');
		  $event['event_allows_overlap'] = ($tmp == 'all')?1:0;
		}

	  $all_day_event = 0;
	  if( isset($params['all_day_event']) )
		{
		  $all_day_event = (int)$params['all_day_event'];
		}
	  $event['all_day_event'] = $all_day_event;

	  $start_hour = 0;
	  $start_minute = 0;
	  if( isset($params['startdate_Month']) )
		{
		  if( !$all_day_event )
			{
			  $start_hour = $params['startdate_Hour'];
			  $start_minute = $params['startdate_Minute'];
			  if( isset($params['startdate_Meridian']) && $params['startdate_Meridian'] == 'pm' &&
				  $start_hour < 12)
				{
				  $start_hour += 12;
				}
			}
		  $event['event_date_start_ut'] = mktime($start_hour,$start_minute,0,
												 $params['startdate_Month'],$params['startdate_Day'],
												 $params['startdate_Year']);
		  $event['event_date_start'] = $db->DbTimeStamp($event['event_date_start_ut']);
		}

	  $end_hour = 23;
	  $end_minute = 59;
	  $end_month = $params['startdate_Month'];
	  $end_day = $params['startdate_Day'];
	  $end_year = $params['startdate_Year'];
	  $event['event_date_end'] = NULL;
	  $event['event_date_end_ut'] = NULL;
	  if( isset($params['enddate_valid']) && isset($params['enddate_Day']) )
		{
		  if( !$all_day_event )
			{
			  $end_hour = $params['enddate_Hour'];
			  $end_minute = $params['enddate_Minute'];

			  if( isset($params['enddate_Meridian']) && $params['enddate_Meridian'] == 'pm' &&
				  $end_hour < 12 )
				{
				  $end_hour += 12;
				}
			}

		  $end_month = $params['enddate_Month'];
		  $end_day = $params['enddate_Day'];
		  $end_year = $params['enddate_Year'];

		  $event['event_date_end_ut'] = mktime($end_hour,$end_minute,0,
											   $end_month,$end_day,$end_year);
		  $event['event_date_end'] = $db->DbTimeStamp($event['event_date_end_ut']);
		}
	  else if( isset($params['all_day_event']) && !isset($params['enddate_valid']) )
		{
		  $event['event_date_end_ut'] = mktime($end_hour,$end_minute,0,
											   $end_month,$end_day,$end_year);
		  $event['event_date_end'] = $db->DbTimeStamp($event['event_date_end_ut']);
		}

	  if( isset($params['event_recur_period']) )
		{
		  $event['event_recur_period'] = trim($params['event_recur_period']);
		}
	  if( isset($params['event_recur_interval']) )
		{
		  $event['event_recur_interval'] = (int)$params['event_recur_interval'];
		}
	  if( isset($params['event_recur_weekdays']) )
		{
		  if( is_array($params['event_recur_weekdays']) )
			{
			  $event['event_recur_weekdays'] = $params['event_recur_weekdays'];
			}
		  else
			{
			  $event['event_recur_weekdays'] = explode(',',$params['event_recur_weekdays']);
			}
		}
	  if( isset($params['event_recur_monthdays']) )
		{
		  if( is_array($params['event_recur_monthdays']) )
			{
			  $event['event_recur_monthdays'] = $params['event_recur_monthdays'];
			}
		  else
			{
			  $event['event_recur_monthdays'] = explode(',',$params['event_recur_monthdays']);
			}
		}
	  if( isset($params['event_recur_count']) )
		{
		  $event['event_recur_count'] = (int)$params['event_recur_count'];
		}
	  if( isset($params['event_recur_date_Month']) && $params['event_recur_period'] != 'none' )
		{
		  $event['event_date_recur_end_ut'] = mktime(0,0,0,
													 $params['event_recur_date_Month'],$params['event_recur_date_Day'],$params['event_recur_date_Year']);
		  $event['event_date_recur_end'] = $db->DbTimeStamp($event['event_date_recur_end_ut']);
		}
	  else
		{
		  $event['event_date_recur_end'] = NULL;
		  $event['event_date_recur_end_ut'] = NULL;
		}
	}


  function GetCategories($order_by='category_order, category_name')
    {
      $db = $this->GetDb(); /* @var $db ADOConnection */
      $categories_table_name = $this->categories_table_name;
      $sql = "SELECT * FROM $categories_table_name";
      if($order_by != '')
		{
		  $sql .= " ORDER BY $order_by";
		}
	  
      $result = array();
      $rs = $db->Execute($sql);
      if($rs && $rs->RecordCount() > 0)
		$result = $rs->GetArray();
      return $result;
    }

  function GetCategoryName($id)
  {
	$db = $this->GetDb();
	$sql = 'SELECT name FROM '.$this->categories_table_name.'
             WHERE id = ?';
	$name = $db->GetOne($query,array($id));
	return $name;
  }

  function AllowAccess($permission='Modify Calendar')
    {
      $access = $this->CheckPermission($permission);
      if (!$access)  {
	echo '<p class="error">'.$this->Lang('error_permission',$permission).'</p>';
	return false;
      }
      return true;
    }

  function LoadAdmin()
    {
      if( $this->admin_tools_loaded === false )
	{
	  require_once('functions.admin_tools.php');
	}
    }

  function AdminDisplayCategories($id, &$parameters, $returnid)
    {
      $this->LoadAdmin();
      return calendar_AdminDisplayCategories($this,$id,$parameters,$returnid);
    }


  function AdminDeleteEvent($id, &$parameters, $returnid)
    {
      $this->LoadAdmin();
      return calendar_AdminDeleteEvent($this,$id,$parameters,$returnid);
    }


  function GetFields()
    {
      $db = $this->GetDb(); /* @var $db ADOConnection */
      $fields_table_name = $this->fields_table_name;
      $sql = "SELECT * FROM $fields_table_name ORDER BY field_name";

      $result = array();
      $rs = $db->Execute($sql);
      if($rs && $rs->RecordCount() > 0)
	{
	  $result = $rs->GetArray();			
	}
      return $result;		
    }


  function AdminDeleteField($field_oldname)
    {
      $db = $this->GetDb(); /* @var $db ADOConnection */
      $fields_table_name = $this->fields_table_name;
      $event_field_values_table_name = $this->event_field_values_table_name;
	  
      $sql = "DELETE FROM $$event_field_values_table_name where field_name='$field_oldname'";
      $db->Execute($sql);
		
      $sql = "DELETE FROM $fields_table_name where field_name='$field_oldname'";
      $db->Execute($sql);
    }
	
  function AdminAddField($field_newname,$field_type = 0,$field_searchable = 0)
    {
      $db = $this->GetDb(); /* @var $db ADOConnection */
      $sql = 'INSERT INTO ' . $this->fields_table_name . '
                (field_name,field_type,field_searchable)
              VALUES (?,?,?)';
      $db->Execute($sql,array($field_newname,$field_type,$field_searchable));
    }
	
  function AdminUpdateField($field_oldname,$field_newname,$field_type = 0,$field_searchable = 0)
    {
      $db = $this->GetDb(); /* @var $db ADOConnection */

      $sql = 'UPDATE ' . $this->fields_table_name . '
                 SET field_name = ?, field_type = ?, field_searchable = ?
               WHERE field_name = ?';
      $db->Execute($sql,array($field_newname, $field_type, $field_searchable, $field_oldname));
      $sql = 'UPDATE ' . $this->event_field_values_table_name . ' SET field_name = ? WHERE field_name = ?';
      $db->Execute($sql,array($field_newname, $field_oldname));
    }
	
  function GetDayNames()
    {
      $day_names[0] = $this->Lang('cal_sunday');
      $day_names[1] = $this->Lang('cal_monday');
      $day_names[2] = $this->Lang('cal_tuesday');
      $day_names[3] = $this->Lang('cal_wednesday');
      $day_names[4] = $this->Lang('cal_thursday');
      $day_names[5] = $this->Lang('cal_friday');
      $day_names[6] = $this->Lang('cal_saturday');
      return $day_names;
    }

  function GetDayShortNames()
    {
      $day_short_names[0] = $this->Lang('cal_sun');
      $day_short_names[1] = $this->Lang('cal_mon');
      $day_short_names[2] = $this->Lang('cal_tues');
      $day_short_names[3] = $this->Lang('cal_wed');
      $day_short_names[4] = $this->Lang('cal_thurs');
      $day_short_names[5] = $this->Lang('cal_fri');
      $day_short_names[6] = $this->Lang('cal_sat');
      return $day_short_names;
    }

  function GetMonthNames()
    {
      $month_names[1] = $this->Lang('cal_january');
      $month_names[2] = $this->Lang('cal_february');
      $month_names[3] = $this->Lang('cal_march');
      $month_names[4] = $this->Lang('cal_april');
      $month_names[5] = $this->Lang('cal_may');
      $month_names[6] = $this->Lang('cal_june');
      $month_names[7] = $this->Lang('cal_july');
      $month_names[8] = $this->Lang('cal_august');
      $month_names[9] = $this->Lang('cal_september');
      $month_names[10] = $this->Lang('cal_october');
      $month_names[11] = $this->Lang('cal_november');
      $month_names[12] = $this->Lang('cal_december');
      // note that we need the "0x" version because {date_format} doesn't give us the month number without a leading zero
      $month_names["01"] = $this->Lang('cal_january');
      $month_names["02"] = $this->Lang('cal_february');
      $month_names["03"] = $this->Lang('cal_march');
      $month_names["04"] = $this->Lang('cal_april');
      $month_names["05"] = $this->Lang('cal_may');
      $month_names["06"] = $this->Lang('cal_june');
      $month_names["07"] = $this->Lang('cal_july');
      $month_names["08"] = $this->Lang('cal_august');
      $month_names["09"] = $this->Lang('cal_september');

      return $month_names;
    }


  function GetLabels()
    {
      $lang['date'] = $this->Lang('cal_date');
      $lang['summary'] = $this->Lang('cal_summary');

      $lang['details'] = $this->Lang('cal_details');
      $lang['return'] = $this->Lang('cal_return');
      $lang['to'] = $this->Lang('cal_to');
      $lang['next'] = $this->Lang('cal_next');
      $lang['prev'] = $this->Lang('cal_prev');
      $lang['past_events'] = $this->Lang('cal_past_events');
      $lang['upcoming_events'] = $this->Lang('cal_upcoming_events');
      return $lang;
    }


  function isValidFilename($filename)
    {
      $this->LoadAdmin();
      return calendar_isValidFilename($this,$filename);
    }


  function HandleUpload($fldname,&$error)
    {
      $this->LoadAdmin();
      return calendar_HandleUpload($this,$fldname,$error);
    }

  function GetDefaultTemplate($template)
    {
      $fn = sprintf('orig_%s_template.tpl',$template);
      $fn = cms_join_path(dirname(__FILE__),'templates',$fn);
      $data = @file_get_contents($fn);
      return $data;
    }

  function NoBreak($string) {
    return str_replace(" ","&nbsp;",$string);
  }
		
  function SearchResult($returnid, $event_id, $attr = '')
    {
      $result = array();
		  
      if( $attr != 'event')
	{
	  return $result;
	}
		  
      $db = $this->GetDb();
      $query = 'SELECT event_title FROM '.$this->events_table_name.' WHERE event_id = ?';
      $title = $db->GetOne( $query, array($event_id) );
		  
      $result[0] = $this->GetFriendlyName();
      $result[1] = $title;

      $titleSEO = preg_replace("/[^\w-]+/", "-", $title);
      $destpage = $this->GetPreference('defaultcalendarpage',-1);
      $destpage=$destpage!=-1?$destpage:$returnid;
      $destpage=$detailpage!=''?$detailpage:$destpage;
      $prettyurl = sprintf($this->GetPreference('url_prefix','calendar')."/%d/%d-%s",
			   $destpage,
			   $event_id,
			   $titleSEO);
      $result[2] = $this->CreateLink($id,'default',$destpage,'',
				     array('event_id'=>$event_id,
					   'display'=>'event',
					   'lang'=>$module->curlang,
					   'detailpage'=>$destpage,
					   'return_id'=>$returnid),
				     '', true, '', '', $prettyurl);
      return $result;
    }

		
  function SearchReindex(&$module)
    {
      $db = $this->GetDb();

      $query = 'SELECT * FROM '.$this->events_table_name.' ORDER BY event_date_start';
      $dbr = $db->Execute($query);

	  $fquery = 'SELECT fv.field_value FROM '.$this->fields_table_name.' fd 
                   LEFT JOIN '.$this->event_field_values_table_name.' fv 
                     ON fd.field_name = fv.field_name AND fd.field_searchable = 1 
                  WHERE fv.event_id = ?';
  
      while ($dbr && !$dbr->EOF)
		{
		  $text = $dbr->fields['event_title'].' '.$dbr->fields['event_summary'].' '.
			$dbr->fields['event_details'];

		  $morewords = $db->GetCol($fquery,array($dbr->fields['event_id']));
		  if( $morewords )
			{
			  $text .= ' '.implode(' ',$morewords);
			}
		  $module->AddWords($this->GetName(), $dbr->fields['event_id'], 'event', $text, NULL);
		  
		  $dbr->MoveNext();
		}
    }

  function ToAbbreviatedWeekdays($data)
  {
	if( !is_array($data) )
	  {
		$data = explode(',',$data);
	  }

	$weekdays = array(
					  0=>'sunday',
					  1=>'monday',
					  2=>'tuesday',
					  3=>'wednesday',
					  4=>'thursday',
					  5=>'friday',
					  6=>'saturday');
	$result = array();
	foreach( $data as $one )
	  {
		$result[] = $this->Lang('abbr_'.$weekdays[$one]);
	  }
    if( !count($result) ) return '';
	$tmp = implode(',',$result);
	return $tmp;
  }

	// timestamp is a Unix timestamp (seconds since epoch)
	// tzone is an time-zone offset from GMT
	function UnixTimestampToiCal($timestamp, $tzone = 0)
	{
		$zulu = $timestamp + ($tzone * 3600);
		$iCal  = date("Ymd\THis\Z", $zulu);
		return $iCal;       
	}
	
	function ConvertCategoriesToString($categories)
	{
		$ary = array();
		foreach ($categories as $one)
		{
			$ary[] = $one['category_name'];
		}
		return implode(',', $ary);
	}
	
}; // class
?>
