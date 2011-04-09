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

class cgc_event_utils
{
  static public function is_event_conflicted($event,$policy)
  {
    global $gCms;
    $db = $gCms->GetDb();

    $event_id = (isset($event['event_id'])) ? $event['event_id'] : -1;
    $str = '';
    if( $policy == 'individual')
      {
	$str .= ' AND event_allows_overlap = 0';
      }
    if( $event_id != -1)
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
	else if( isset($event['event_date_start_ut']) )
	  {
	    // assume unix timestamp
	    $start = $db->DbTimeStamp($event['event_date_start_ut']);
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
	else if( isset($event['event_date_start_ut']) )
	  {
	    // assume unix timestamp
	    $start = $db->DbTimeStamp($event['event_date_start_ut']);
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
	else if( isset($event['event_date_end_ut']) )
	  {
	    // assume unix timestamp
	    $end = $db->DbTimeStamp($event['event_date_end_ut']);
	  }
	else if( isset($event['end']) )
	  {
	    // assume unix timestamp
	    $end = $db->DbTimeStamp($event['end']);
	  }
	
	$query = 'SELECT event_id FROM '.$module->events_table_name."
                 WHERE (($start BETWEEN event_date_start and event_date_end) 
                       OR ($end BETWEEN event_date_start and event_date_end))";
	$dbr = $db->GetOne($query.$str,
			   array(trim($start,'"'),
				 trim($end,'"')));
      }

    if( $dbr ) return TRUE;
    return FALSE;
  }

} // end of class

#
# EOF
#
?>