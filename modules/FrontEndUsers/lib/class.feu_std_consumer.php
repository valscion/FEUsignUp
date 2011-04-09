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

class feu_std_consumer implements feu_auth_consumer
{
  public function is_authenticated()
  {
    $mod = cge_utils::get_module('FrontEndUsers');
    $mod->_AttemptLoginWithCookie();
    return $mod->LoggedIn();
  }

  public function get_capabilities()
  {
    $res = array();
    $res[] = self::CAPABILITY_LOGIN;
    $res[] = self::CAPABILITY_LOGOUT;
    $res[] = self::CAPABILITY_CHANGESETTINGS;
    $res[] = self::CAPABILITY_LOSTUSERNAME;
    $res[] = self::CAPABILITY_FORGOTPASSWD;
    $res[] = self::CAPABILITY_CHANGEPASSWD;
    return $res;
  }

  public function has_capability($flag)
  {
    if( in_array($flag,$this->get_capabilities()) )
      return TRUE;
    return FALSE;
  }

  public function get_login_display($id,$returnid,$params)
  {
    return;
  }

  public function get_logout_display($id,$returnid,$params)
  {
    return;
  }

  public function get_changesettings_display($id,$returnid,$params)
  {
    return;
  }

  public function get_user_info()
  {
    stack_trace();
    die('not implemented');
  }

  public function get_connecting_property_name()
  {
    return self::PROPERTY_UID;
  }

  public function get_unique_identifier()
  {
    die('this is invalid, should not be calling this for this object');
  }
}

#
# EOF
#
?>