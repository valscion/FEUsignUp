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
if( !isset($gCms) ) exit;

function _DisplayAdminLoginTemplateTab( &$module, $id, &$params, $returnid )
{
  $module->smarty->assign('startform',
			  $module->CreateFormStart( $id, 'do_setlogintemplate'));
  $module->smarty->assign('prompt_template',$module->Lang('template'));
  $module->smarty->assign('input_template',
			  $module->CreateTextArea( false, $id,
						   $module->GetTemplate ('feusers_loginform'),
						   'templateloginform'));
  $module->smarty->assign('submit',
			  $module->CreateInputSubmit ($id, 'submit',
						      $module->Lang('submit')));
  $module->smarty->assign('defaults',
			  $module->CreateInputSubmit ($id, 'defaults',
						      $module->Lang('defaults')));
  $module->smarty->assign('endform',$module->CreateFormEnd());
  echo $module->ProcessTemplate('templateform.tpl');
}


function _DisplayAdminLogoutTemplateTab( &$module, $id, &$params, $returnid )
{
  $module->smarty->assign('startform',
			  $module->CreateFormStart( $id, 'do_setlogouttemplate'));
  $module->smarty->assign('prompt_template',$module->Lang('template'));
  $module->smarty->assign('input_template',
			  $module->CreateTextArea( false, $id,
						   $module->GetTemplate ('feusers_logoutform'),
						   'templatelogoutform'));
  $module->smarty->assign('submit',
			  $module->CreateInputSubmit ($id, 'submit',
						      $module->Lang('submit')));
  $module->smarty->assign('defaults',
			  $module->CreateInputSubmit ($id, 'defaults',
						      $module->Lang('defaults')));
  $module->smarty->assign('endform',$module->CreateFormEnd());
  echo $module->ProcessTemplate('templateform.tpl');
}


function _DisplayAdminChangeSettingsTemplateTab( &$module, $id, &$params, $returnid )
{
  $module->smarty->assign('startform',
			  $module->CreateFormStart( $id, 'do_setchangesettingstemplate'));
  $module->smarty->assign('prompt_template',$module->Lang('template'));
  $module->smarty->assign('input_template',
			  $module->CreateTextArea( false, $id,
						   $module->GetTemplate ('feusers_changesettingsform'),
						   'templatecontent'));
  $module->smarty->assign('submit',
			  $module->CreateInputSubmit ($id, 'submit',
						      $module->Lang('submit')));
  $module->smarty->assign('defaults',
			  $module->CreateInputSubmit ($id, 'defaults',
						      $module->Lang('defaults')));
  $module->smarty->assign('endform',$module->CreateFormEnd());
  echo $module->ProcessTemplate('templateform.tpl');
}


function _DisplayAdminForgotPasswordTemplateTab( &$module, $id, &$params, $returnid )
{
  $module->smarty->assign('startform',
			  $module->CreateFormStart( $id, 'do_setforgotpwtemplate'));
  $module->smarty->assign('prompt_template1',$module->Lang('forgotpassword_template'));
  $module->smarty->assign('input_template1',
			  $module->CreateTextArea( false, $id,
						   $module->GetTemplate ('feusers_forgotpasswordform'),
						   'templatecontent1'));
  $module->smarty->assign('prompt_template2',$module->Lang('forgotpassword_emailtemplate'));
  $module->smarty->assign('input_template2',
			  $module->CreateTextArea( false, $id,
						   $module->GetTemplate ('feusers_forgotpasswordemailform'),
						   'templatecontent2'));
  $module->smarty->assign('prompt_template3',$module->Lang('forgotpassword_verifytemplate'));
  $module->smarty->assign('input_template3',
			  $module->CreateTextArea( false, $id,
						   $module->GetTemplate ('feusers_forgotpasswordverifyform'),
						   'templatecontent3'));
  $module->smarty->assign('submit',
			  $module->CreateInputSubmit ($id, 'submit',
						      $module->Lang('submit')));
  $module->smarty->assign('defaults',
			  $module->CreateInputSubmit ($id, 'defaults',
						      $module->Lang('defaults')));
  $module->smarty->assign('endform',$module->CreateFormEnd());
  echo $module->ProcessTemplate('forgotpw_templateform.tpl');
}



//////////////////////////////////////////////////////////////////////
// DO THE ACTION
//////////////////////////////////////////////////////////////////////

global $gCms;
if (! $this->_HasSufficientPermissions())  {
  echo "Breaking an entry, are we?";
  return;
 }

$db =& $this->GetDb();


// the tabs
echo $this->StartTabHeaders();

if( $this->_HasSufficientPermissions('properties') )
  {
    echo $this->SetTabHeader( 'properties', $this->Lang('user_properties'));
  }
if( $this->_HasSufficientPermissions('usersngroups') )
  {
    echo $this->SetTabHeader( 'groups', $this->Lang('groups'));
    echo $this->SetTabHeader( 'users', $this->Lang('users'));
    echo $this->SetTabHeader( 'userhistory', $this->Lang('userhistory'));
    echo $this->SetTabHeader( 'admin', $this->Lang('admin'));
  }
if( $this->_HasSufficientPermissions('siteprefs') )
  {
    echo $this->SetTabHeader( 'prefs', $this->Lang('preferences'));
    echo $this->SetTabHeader( 'auth', $this->Lang('authentication'));
  }
if( $this->_HasSufficientPermissions('templates') )
  {
    echo $this->SetTabHeader( 'logintemplate', $this->Lang('login_template'));
    echo $this->SetTabHeader( 'logouttemplate', $this->Lang('logout_template'));
    echo $this->SetTabHeader( 'changesettings_template', $this->Lang('changesettings_template'));
    echo $this->SetTabHeader( 'forgotpassword_template', $this->Lang('forgotpassword_template'));
    echo $this->SetTabHeader( 'lostusername_template', $this->Lang('lostusername_template'));
    echo $this->SetTabHeader( 'view_user', $this->Lang('viewuser_template'));
    echo $this->SetTabHeader( 'reset_session', $this->Lang('resetsession_template'));

  }
echo $this->EndTabHeaders();

// Thecontent of the tabs
echo $this->StartTabContent();

if( $this->_HasSufficientPermissions('properties') )
  {
    echo $this->StartTab('properties',$params);
    include(dirname(__FILE__).'/function.admin_propertiestab.php');
    echo $this->EndTab();
  }
    
if( $this->_HasSufficientPermissions('usersngroups') )
  {
    echo $this->StartTab('groups',$params);
    include(dirname(__FILE__).'/function.admin_groupstab.php');
    echo $this->EndTab();

    echo $this->StartTab('users',$params);
    include(dirname(__FILE__).'/function.admin_userstab.php');
    echo $this->EndTab();

    echo $this->StartTab('userhistory',$params);
    include(dirname(__FILE__).'/action.userhistory.php');
    echo $this->EndTab();

    echo $this->StartTab('admin',$params);
    include(dirname(__FILE__).'/function.admin_admintab.php');
    echo $this->EndTab();
  }

if( $this->_HasSufficientPermissions('siteprefs') )
  {
    echo $this->StartTab('prefs',$params);
    include(dirname(__FILE__).'/function.admin_prefstab.php');
    echo $this->EndTab();

    echo $this->StartTab('auth',$params);
    include(dirname(__FILE__).'/function.admin_authtab.php');
    echo $this->EndTab();
  }

if( $this->_HasSufficientPermissions('templates') )
  {
    echo $this->StartTab('logintemplate',$params);
    _DisplayAdminLoginTemplateTab( $this, $id, $params, $returnid );
    echo $this->EndTab();

    echo $this->StartTab('logouttemplate',$params);
    _DisplayAdminLogoutTemplateTab( $this, $id, $params, $returnid );
    echo $this->EndTab();

    echo $this->StartTab('changesettings_template',$params);
    _DisplayAdminChangeSettingsTemplateTab( $this, $id, $params, $returnid );
    echo $this->EndTab();

    echo $this->StartTab('forgotpassword_template',$params);
    _DisplayAdminForgotPasswordTemplateTab( $this, $id, $params, $returnid );
    echo $this->EndTab();

    echo $this->StartTab('lostusername_template',$params);
    include(dirname(__FILE__).'/function.admin_lostusername_template.php');
    echo $this->EndTab();

    echo $this->StartTab('view_user',$params);
    include(dirname(__FILE__).'/function.admin_viewuser_template.php');
    echo $this->EndTab();

    echo $this->StartTab('reset_session',$params);
    include(dirname(__FILE__).'/function.admin_resetsession_template.php');
    echo $this->EndTab();
  }

echo $this->EndTabContent();

?>
