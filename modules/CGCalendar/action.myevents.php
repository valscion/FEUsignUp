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
// Initialization
//
$thetemplate = 'myevents_'.$this->GetPreference(CGCALENDAR_PREF_DFLTMYEVENTS_TEMPLATE);
if( isset($params['myeventstemplate'] ) )
  {
    $thetemplate = 'myevents_'.$params['myeventstemplate'];
  }
$feu = $this->GetModuleInstance('FrontEndUsers');
if( !is_object($feu) ) return; // no feu module.
$feu_uid = $feu->LoggedInId();
if( $feu_uid <= 0 ) return; // not logged in

$destpage = $returnid;
{
  $tmp = $this->GetPreference('frontend_redirectpage','');
  $tmp = $this->ProcessTemplateFromData($tmp);
  if( isset($params['editpage']) )
    {
      $tmp = trim($params['editpage']);
    }
  $tmp = $this->resolve_alias_or_id($tmp);
  if( $tmp )
    {
      $destpage = $tmp;
    }
}

// 
// Get data 
//
$query = 'SELECT * FROM '.$this->events_table_name.'
           WHERE event_created_by = ? ORDER BY event_modified_date';
$data = $db->GetArray($query,array($feu_uid));

//
// Give data to smarty
//
if( is_array($data) && count($data) > 0 )
  {
    for( $i = 0; $i < count($data); $i++ )
      {
	$rec =& $data[$i];
	$parms = $params;
	$parms['return_id'] = $returnid;
	$parms['event_id'] = $rec['event_id'];
	$rec['edit_url'] = $this->CreateURL($id,'addedit_event',$destpage,$parms);
	$rec['delete_url'] = $this->CreateURL($id,'delete_event',$destpage,$parms);
      }
    $smarty->assign('records',$data);
  }
$gid = $this->GetPreference('frontend_group','');
if( $gid && $feu->MemberOfGroup($feu_uid,$gid) )
  {
    $smarty->assign('add_event_url',$this->CreateURL($id,'addedit_event',$returnid));
  }

//
// Process the template.
//
echo $this->ProcessTemplateFromDatabase($thetemplate);

#
# EOF
#
?>