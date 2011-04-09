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

//
// safety checks
//
$feu = $this->GetModuleInstance('FrontEndUsers');
if( !$feu )
  {
    $this->RedirectContent($returnid);
  }
else if( !$feu->LoggedIn() )
  {
    $this->RedirectContent($returnid);
  }

if( !isset($params['event_id']) )
  {
    $this->RedirectContent($returnid);
  }

$feu_uid = $feu->LoggedInId();
$query = 'SELECT event_id FROM '.$this->events_table_name.'
           WHERE event_id = ? AND event_created_by = ?';
$tmp = $db->GetOne($query,array((int)$params['event_id'],$feu_uid));

if( $tmp == $params['event_id'] )
  {
    $this->AdminDeleteEvent($id,$params,$returnid);
  }

$this->RedirectContent($returnid);

#
# EOF
#
?>