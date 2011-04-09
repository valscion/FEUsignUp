<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGCalendar (c) 2008 
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
if( !$this->CheckPermission('Modify Calendar') ) return;

// find all of the events that do not allow overlap.
$query = 'SELECT event_id,event_parent_id,event_date_start,event_date_end FROM '.$this->events_table_name.'
           WHERE event_allows_overlap = 0 ORDER BY event_id ASC';
$ids = $db->GetArray($query);
if( !$ids )
  {
    $this->Redirect($id,'defaultadmin',$returnid);
  }

$query1 = 'SELECT event_id,event_parent_id, j1.nchildren
            FROM '.$this->events_table_name." ev
          LEFT JOIN (SELECT event_parent_id AS parent, count(event_id) AS nchildren FROM ".$this->events_table_name." WHERE event_parent_id != -1 GROUP BY event_parent_id) j1 ON ev.event_id = j1.parent
           WHERE event_id != ?
             AND event_parent_id != ?
             AND ((event_date_start BETWEEN ? and ?) OR (event_date_end BETWEEN ? and ?))";
foreach( $ids as $one_event )
{
  $tmp = $db->GetRow($query1,array($one_event['event_id'],
				  $one_event['event_id'],
				  trim($one_event['event_date_start'],"'"),
				  trim($one_event['event_date_end'],"'"),
				  trim($one_event['event_date_start'],"'"),
				  trim($one_event['event_date_end'],"'")
				  ));
  if( !$tmp ) 
    {
      // nothing conflicts with this event.
      continue;
    }

  // we have a conflict.

  // is this a parent event ?
  if( $tmp['nchildren'] != -1 )
    {
      // yes... get the first child event id..
      $query = 'SELECT event_id FROM '.$this->events_table_name."
                 WHERE event_parent_id = ? ORDER BY event_id ASC";
      $new_parent_id = $db->GetOne($query,array($tmp['event_id']));
      
      // and make it the parent
      $query = 'UPDATE '.$this->events_table_name.'
                   SET event_parent_id = ?
                 WHERE event_parent_id = ?
                   AND event_id != ?';
      $db->Execute($query,array($new_parent_id,$tmp['event_id'],$new_parent_id));
      
      // and update the new parent record
      $query = 'UPDATE '.$this->events_table_name.'
                   SET event_parent_id = ?
                 WHERE event_id = ?';
      $db->Execute($query,array(-1,$new_parent_id));
    }

  // delete this event, unless it has child events
  // in which case we make the first child event the parent       
  $query = 'DELETE FROM '.$this->events_table_name.'
             WHERE event_id = ?';
  $db->Execute($query,array($tmp['event_id']));

  $query = 'DELETE FROM '.$this->events_to_categories_table_name.'
             WHERE event_id = ?';
  $db->Execute($query,array($tmp['event_id']));
}

$this->SetCurrentTab('defaultadmin');
$this->RedirectToTab($id);

#
# EOF
#
?>