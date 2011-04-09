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

switch( $oldversion )
  {
  case '1.0':
  case '1.0.1':
    $db->Execute('ALTER TABLE '.$this->events_table_name.' ADD FULLTEXT(event_title,event_summary,event_details)');
    $sqlarray = $dict->AddColumnSQL($this->events_table_name, "event_recur_monthdays C(255)");
    $dict->ExecuteSQLArray($sqlarray);

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

  case '1.2':
  case '1.2.1':
  case '1.2.2':
  case '1.2.3':
  case '1.2.4':
  case '1.2.5':
    $sqlarray = $dict->AddColumnSQL($this->events_table_name, 
				    "event_allows_overlap I1");
    $dict->ExecuteSQLArray($sqlarray);    

  case '1.3':
  case '1.3.1':
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

    $sqlarray = $dict->CreateIndexSQL('event_period',$this->events_table_name,
				      'event_date_start,event_date_end');
    $dict->ExecuteSQLArray( $sqlarray );

    $query = 'UPDATE '.$this->events_table_name.'
                 SET event_created_by = event_created_by * -1 - 100';
    $db->Execute($query);

  case '1.4':
    $sqlarray = $dict->AddColumnSQL($this->fields_table_name,'field_searchable I1');
    $dict->ExecuteSQLArray($sqlarray);

    $query = 'UPDATE '.$this->fields_table_name.' SET field_searchable = 1
               WHERE field_type != 1';
    $db->Execute($query);
  }

?>