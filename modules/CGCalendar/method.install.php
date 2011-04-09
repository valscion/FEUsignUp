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

$db =& $this->GetDb();				/* @var $db ADOConnection */
$dict = NewDataDictionary($db); 	/* @var $dict ADODB_DataDict */

$table_options = array('mysql' => 'TYPE=MyISAM');

// create categories table
$fields = "
			category_id I KEY NOT NULL,
			category_name C(255),
			category_order I
		";
$sql_array = $dict->CreateTableSQL($this->categories_table_name, $fields, $table_options);
$dict->ExecuteSQLArray($sql_array);

$db->CreateSequence($this->categories_table_name . '_seq');

$sqlarray = $dict->CreateIndexSQL('index_category_name',$this->categories_table_name,'category_name');
$dict->ExecuteSQLArray($sqlarray);

// create fields table
$fields = "
			field_name C(255) KEY,
                        field_type I,
                        field_searchable I1
		";
$sqlarray = $dict->CreateTableSQL($this->fields_table_name, $fields, $table_options);
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->CreateIndexSQL('index_field_name',$this->fields_table_name,'field_name');
$dict->ExecuteSQLArray($sqlarray);


// create events table
$fields = "
			event_id I KEY,
			event_title C(255),
			event_summary X,
			event_details X,
			event_date_start ".CMS_ADODB_DT.",
			event_date_end ".CMS_ADODB_DT.",
			event_parent_id I,
			event_recur_period C(10),
			event_date_recur_end ".CMS_ADODB_DT.",
			event_created_by I,
			event_create_date ".CMS_ADODB_DT.",
			event_modified_date ".CMS_ADODB_DT.",
                        event_recur_nevents I,
                        event_recur_interval I,
                        event_recur_weekdays C(255),
                        event_recur_monthdays C(255),
                        event_allows_overlap I1";
$sqlarray = $dict->CreateTableSQL($this->events_table_name, $fields, $table_options);
$dict->ExecuteSQLArray($sqlarray);

$db->Execute('ALTER TABLE '.$this->events_table_name.' ADD FULLTEXT(event_title,event_summary,event_details)');
$sqlarray = $dict->CreateIndexSQL('cgcalendar_events_date',$this->events_table_name,'event_date_start,event_date_end');
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->CreateIndexSQL('cgcalendar_events_created',$this->events_table_name,'event_create_date');
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->CreateIndexSQL('cgcalendar_events_modified',$this->events_table_name,'event_modified_date');
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->CreateIndexSQL('cgcalendar_events_parent',$this->events_table_name,'event_parent_id');
$dict->ExecuteSQLArray($sqlarray);

$db->CreateSequence($this->events_table_name.'_seq');

// create event_field_values table
$fields = "
			field_name C(255) KEY,
			event_id I KEY,
			field_value X
		";
$sqlarray = $dict->CreateTableSQL($this->event_field_values_table_name, $fields, $table_options );
$dict->ExecuteSQLArray( $sqlarray );

// create events_to_categories table
$fields = "
			category_id I KEY,
			event_id I KEY
		";
$sqlarray = $dict->CreateTableSQL($this->events_to_categories_table_name, $fields, $table_options );
$dict->ExecuteSQLArray( $sqlarray );

// set up a General category
$new_id = $db->GenID($this->categories_table_name.'_seq');

$sql = 'INSERT INTO ' . $this->categories_table_name . " (category_id, category_name, category_order)
						VALUES ($new_id, 'General', 50)";
$db->Execute($sql);



//
// templates
//

// Calendar template(s)
$fn = cms_join_path(dirname(__FILE__),'templates','orig_calendar_template.tpl');
if( file_exists($fn) )
{
  $template = file_get_contents($fn);
  $this->SetPreference(CGCALENDAR_PREF_NEWCALENDAR_TEMPLATE,$template);
  $this->SetTemplate('calendar_Sample',$template);
  $this->SetPreference(CGCALENDAR_PREF_DFLTCALENDAR_TEMPLATE,'Sample');
}

// Search form template(s)
$fn = cms_join_path(dirname(__FILE__),'templates','orig_search_template.tpl');
if( file_exists($fn) )
{
  $template = file_get_contents($fn);
  $this->SetPreference(CGCALENDAR_PREF_NEWSEARCH_TEMPLATE,$template);
  $this->SetTemplate('search_Sample',$template);
  $this->SetPreference(CGCALENDAR_PREF_DFLTSEARCH_TEMPLATE,'Sample');
}

// Search result template(s)
$fn = cms_join_path(dirname(__FILE__),'templates','orig_searchresult_template.tpl');
if( file_exists($fn) )
{
  $template = file_get_contents($fn);
  $this->SetPreference(CGCALENDAR_PREF_NEWSEARCHRESULT_TEMPLATE,$template);
  $this->SetTemplate('searchresult_Sample',$template);
  $this->SetPreference(CGCALENDAR_PREF_DFLTSEARCHRESULT_TEMPLATE,'Sample');
}

// Event template(s)
$fn = cms_join_path(dirname(__FILE__),'templates','orig_event_template.tpl');
if( file_exists($fn) )
{
  $template = file_get_contents($fn);
  $this->SetPreference(CGCALENDAR_PREF_NEWEVENT_TEMPLATE,$template);
  $this->SetTemplate('event_Sample',$template);
  $this->SetPreference(CGCALENDAR_PREF_DFLTEVENT_TEMPLATE,'Sample');
}
$fn = cms_join_path(dirname(__FILE__),'templates','db','blog-post-event-detail-example.tpl');
if( file_exists($fn) )
  {
    $template = file_get_contents($fn);
    $this->SetTemplate('event_blog-post-detail',$template);
  }

// List Templates
$fn = cms_join_path(dirname(__FILE__),'templates','orig_list_template.tpl');
if( file_exists($fn) )
{
  $template = file_get_contents($fn);
  $this->SetPreference(CGCALENDAR_PREF_NEWLIST_TEMPLATE,$template);
  $this->SetTemplate('list_Sample',$template);
  $this->SetPreference(CGCALENDAR_PREF_DFLTLIST_TEMPLATE,'Sample');
}
$fn = cms_join_path(dirname(__FILE__),'templates','db','blog-post-list.tpl');
if( file_exists($fn) )
  {
    $template = file_get_contents($fn);
    $this->SetTemplate('list_blog-post-list',$template);
  }
$fn = cms_join_path(dirname(__FILE__),'templates','db','blog-post-list-with-content.tpl');
if( file_exists($fn) )
  {
    $template = file_get_contents($fn);
    $this->SetTemplate('list_blog-post-list-with-content',$template);
  }
$fn = cms_join_path(dirname(__FILE__),'templates','db','blog-post-month-archive-list.tpl');
if( file_exists($fn) )
  {
    $template = file_get_contents($fn);
    $this->SetTemplate('list_blog-post-list-month-archive-list',$template);
  }

// UpcomingList Templates
$fn = cms_join_path(dirname(__FILE__),'templates','orig_upcominglist_template.tpl');
if( file_exists($fn) )
{
  $template = file_get_contents($fn);
  $this->SetPreference(CGCALENDAR_PREF_NEWUPCOMINGLIST_TEMPLATE,$template);
  $this->SetTemplate('upcominglist_Sample',$template);
  $this->SetPreference(CGCALENDAR_PREF_DFLTUPCOMINGLIST_TEMPLATE,'Sample');
}

// My Events template(s)
$fn = cms_join_path(dirname(__FILE__),'templates','orig_myevents_template.tpl');
if( file_exists($fn) )
{
  $template = file_get_contents($fn);
  $this->SetPreference(CGCALENDAR_PREF_NEWMYEVENTS_TEMPLATE,$template);
  $this->SetTemplate('myevents_Sample',$template);
  $this->SetPreference(CGCALENDAR_PREF_DFLTMYEVENTS_TEMPLATE,'Sample');
}

// Edit Event form template(s)
$fn = cms_join_path(dirname(__FILE__),'templates','orig_editevent_template.tpl');
if( file_exists($fn) )
{
  $template = file_get_contents($fn);
  $this->SetPreference(CGCALENDAR_PREF_NEWEDITEVENT_TEMPLATE,$template);
  $this->SetTemplate('editevent_Sample',$template);
  $this->SetPreference(CGCALENDAR_PREF_DFLTEDITEVENT_TEMPLATE,'Sample');
}


// Preferences
$this->SetPreference('defaultcalendarpage',-1);

// Events
$this->CreateEvent('EventAdded');
$this->CreateEvent('EventEdited');
$this->CreateEvent('EventDeleted');
$this->CreateEvent('CategoryAdded');
$this->CreateEvent('CategoryEdited');
$this->CreateEvent('CategoryDeleted');

// Permissions
$this->CreatePermission('Modify Calendar', 'Modify Calendar');
$this->CreatePermission('Manage Calendar Attributes','Manage Calendar Attributes');

//Insert example stylesheet
$config =& $gCms->GetConfig();
$new_css_id = $db->GenID(cms_db_prefix() . "css_seq");
$css_name = $this->Lang('module_example_stylesheet').' v'.$this->GetVersion();
$css_text = file_get_contents($config['root_path'] . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $this->GetName() . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'stylesheet.css');
$media_type = '';
$query = "INSERT INTO " . cms_db_prefix() . "css (css_id, css_name, css_text, media_type, create_date, modified_date) VALUES (?, ?, ?, ?, ?, ?)";
# add the stylesheet to the database
$result = $db->Execute($query, array($new_css_id, $css_name, $css_text, $media_type, $db->DBTimeStamp(time()), $db->DBTimeStamp(time())));


?>