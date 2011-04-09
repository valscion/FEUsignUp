<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: FrontEndUsers (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow management of frontend
#  users, and their login process within a CMS Made Simple powered 
#  website.
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

class feu_smarty 
{
  var $_module;
  var $_properties;

  /*---------------------------------------------------------
   feu_smarty -- Constructor
   ---------------------------------------------------------*/
  function feu_smarty(&$module)
  {
    $this->_module =& $module;
  }
  

  /*---------------------------------------------------------
   get_users_by_groupname()
   ---------------------------------------------------------*/
  function get_users_by_groupname($groupname,$assign)
  {
    if( empty($groupname) ) return;
    if( empty($assign) ) return;
    if( !is_object($this->_module) ) return;

    $gid = $this->_module->GetGroupID($groupname);
    if( !$gid ) false;
    $usersfull = $this->_module->GetUsersInGroup($gid);
    
    $users = array();
    foreach( $usersfull as $oneuser )
      {
	$users[] = array('id'=>$oneuser['id'],'username'=>$oneuser['username']);
      }
    global $gCms;
    $smarty =& $gCms->GetSmarty();
    $smarty->assign($assign,$users);
    return;
  }

  function get_user_expiry($uid,$assign = '')
  {
    if( empty($uid) ) return;
    if( !is_object($this->_module) ) return;

    $res = $this->_module->GetExpiryDate($uid);
    if( !$res ) return;

    if( $assign )
      {
	global $gCms;
	$smarty =& $gCms->GetSmarty();
	$smarty->assign($assign,$res);
	return;
      }
    return $res;
  }


  function user_expired($uid,$assign = '')
  {
    if( empty($uid) ) return;
    if( !is_object($this->_module) ) return;

    $res = $this->_module->IsAccountExpired($uid);

    if( $assign )
      {
	global $gCms;
	$smarty =& $gCms->GetSmarty();
	$smarty->assign($assign,$res);
	return;
      }
    return $res;
  }


  function get_user_properties($uid,$assign)
  {
    if( empty($uid) ) return;
    if( empty($assign) ) return;
    if( !is_object($this->_module) ) return;

    $res = $this->_module->GetUserProperties($uid);
    if( !$res ) return;

    $res2 = array();
    foreach( $res as $one )
      {
	$res2[$one['title']] = $one['data'];
      }

    global $gCms;
    $smarty =& $gCms->GetSmarty();
    $smarty->assign($assign,$res2);
  }

  function get_dropdown_text($propname,$propvalue,$assign = '')
  {
    if( !is_object($this->_module) ) return;
    if( $this->_properties == null )
      {
	$this->_properties = array();
	$tmp = $this->_module->GetPropertyDefns();
	foreach( $tmp as $one )
	  {
	    if( $one['type'] == 4 || $one['type'] == 5 )
	      {
		$tmp2 = $this->_module->GetSelectOptions($one['name']);
		$one['options'] = array();
		foreach( $tmp2 as $k => $v )
		  {
		    $one['options'][$v] = $k;
		  }
	      }
	    $this->_properties[$one['name']] = $one;
	  }
      }

    if( !isset($this->_properties[$propname]) )
      {
	return FALSE;
      }

    if( ($this->_properties[$propname]['type'] != 4 &&
	 $this->_properties[$propname]['type'] != 5) ||
	!isset($this->_properties[$propname]['options']) )
      {
	return FALSE;
      }

    if( !isset($this->_properties[$propname]['options'][$propvalue]) )
      {
	return FALSE;
      }

    $res = $this->_properties[$propname]['options'][$propvalue];
    if( $assign != '' )
      {
	global $gCms;
	$smarty =& $gCms->GetSmarty();
	$smarty->assign($assign,$res);
	return;
      }
    return $res;
  }

  function get_multiselect_text($propname,$propvalue,$assign)
  {
    $values = explode(',',$propvalue);
    $res = array();
    foreach( $values as $one )
      {
	$res[] = $this->get_dropdown_text($propname,$one);
      }

    global $gCms;
    $smarty =& $gCms->GetSmarty();
    $smarty->assign($assign,$res);
  }
}

#
# EOF
#
?>