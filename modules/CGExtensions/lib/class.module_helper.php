<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGExtensions (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to provide useful functions
#  and commonly used gui capabilities to other modules.
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

class module_helper
{
  static public function &get_instance($name)
  {
    return cge_utils::get_module($name);
  }


  static public function get_preference($modulename,$preference,$dflt = '')
  {
    $module =& self::get_instance($modulename);
    if( !$module ) return $dflt;

    return $module->GetPreference($preference,$dflt);
  }


  static public function get_modules_with_method($methodname)
  {
    $gCms = cmsms();
    $res = array();
    
    if( version_compare(CMS_VERSION,'1.10-beta0') < 0 )
      {
	foreach( $gCms->modules as $modulename => $onemodule )
	  {
	    if( !isset($onemodule['object']) ) continue;
	    $mod =& $onemodule['object'];
	    if( !method_exists($mod,$methodname) ) continue;
	    $res[$mod->GetName()] = $mod->GetFriendlyName();
	  }
      }
    else
      {
	$modules = ModuleOperations::get_instance()->GetInstalledModules();
	foreach( $modules as $onemodule )
	  {
	    $mod = ModuleOperations::get_instance()->get_module_instance($onemodule);
	    if( !$mod ) continue;

	    if( !method_exists($mod,$methodname) ) continue;
	    $res[$mod->GetName()] = $mod->GetFriendlyName();
	  }
      }

    if( empty($res) ) return FALSE;
    return $res;
  }


  static public function get_modules_with_capability($capability,$params = array())
  {
    $mod = cms_utils::get_module('CGExtensions');
    $tmp = $mod->GetModulesWithCapability($capability,$params);
    if( is_array($tmp) && count($tmp) )
      {
	$t2 = array();
	for( $i = 0; $i < count($tmp); $i++ )
	  {
	    $t2[$tmp[$i]] = $tmp[$i];
	  }
	return $t2;
      }
  }
} // class

#
# EOF
#
?>