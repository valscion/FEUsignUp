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
global $gCms;
if( !feu_utils::using_std_consumer() )
  {
    $consumer = feu_utils::get_auth_consumer();
    if( $consumer->has_capability(feu_auth_consumer::CAPABILITY_LOGIN) )
      {
	// the consumer provides the login capabilities
	echo $consumer->get_login_display($id,$returnid,$params);
	return;
      }
    else
      {
	return;
      }
  }

// the remainer is the builtin authentication consumer.
$smarty =& $gCms->GetSmarty();

// build the form
$captcha =& $this->GetModuleInstance('Captcha');
if( is_object($captcha) && !isset($params['nocaptcha']) )
  {
    $smarty->assign('captcha_title', $this->Lang('captcha_title'));
    $smarty->assign('input_captcha',
		    $this->CreateInputText($id,'input_captcha','',10));
    $smarty->assign('captcha', $captcha->getCaptcha());
  }

$username = (isset($params['feu_input_username'])?$params['feu_input_username']:'');
$password = (isset($params['feu_input_password'])?$params['feu_input_password']:'');
$rememberme = (isset($params['feu_rememberme'])?$params['feu_rememberme']:'');

$inline = true;
if( isset($params['noinline']) )
  {
    $inline = false;
  }
// if( !isset($params['returnto']) )
//   {
//     $params['returnto'] = $returnid;
//   }

$cge = $this->GetModuleInstance('CGExtensions');
if( $cge && isset($params['returnlast']) )
  {
    $this_url = cge_url::current_url();
    $_SESSION['feu_prelogin_url'] = $this_url;
    $smarty->assign('feu_prelogin_url',$this_url);
  }

$smarty->assign('error', isset($params['error']) ? $params['error'] : '');
$smarty->assign('startform', 
		$this->feCreateFormStart( $id, 'do_login', $returnid, $inline,
					  'post', '', '', $params));
$smarty->assign('id_username',$id.'feu_input_username');
if( $this->GetPreference('username_is_email') )
  {
    $smarty->assign('prompt_username', $this->Lang('prompt_email'));
  }
else
  {
    $smarty->assign('prompt_username', $this->Lang('prompt_username'));
  }
$smarty->assign('input_username', 
		$this->CreateInputText( $id, 'feu_input_username',
					$username,
					$this->GetPreference('usernamefldlength'),
					$this->GetPreference('max_usernamelength')));

$smarty->assign('input_label', $id );
$smarty->assign('id_password',$id.'feu_input_password');
$smarty->assign('prompt_password', $this->Lang('prompt_password'));
$smarty->assign('input_password',
		      $this->CreateInputPassword($id, 'feu_input_password',
						 $password, 
						 $this->GetPreference('passwordfldlength'), 
						 $this->GetPreference('max_passwordlength')));

$smarty->assign('prompt_rememberme',$this->Lang('prompt_rememberme'));
$smarty->assign('id_rememberme',$id.'feu_rememberme');

if( $this->GetPreference('usecookiestoremember') &&
    $this->GetPreference('cookiename') != '' &&
    function_exists('mcrypt_module_open') )
  {
    $smarty->assign('input_rememberme',
		    $this->CreateInputCheckbox($id,'feu_rememberme',1,
					       $rememberme));
  }

$smarty->assign('input_submit',
		      $this->CreateInputSubmit($id, 'feu_btn_login',
					       $this->GetPreference('signin_button',$this->Lang('login'))));

// from this point forward, any links, etc... should return to this page
// if they can
$params['returnto'] =  $returnid;

$page = $this->ProcessTemplateFromData($this->GetPreference('pageidforgotpasswd'));
if( $page )
  {
    $pid = ContentManager::GetPageIDFromAlias( $page );
    if( $pid == false )
      {
        $smarty->assign('link_forgot','<!-- Error could not determine page from alias/id -->');
      }
    else 
      {
	$params['form'] = 'forgotpw';
        $smarty->assign('link_forgot',
			$this->CreateLink($id,'default',$pid,
					  $this->Lang('forgotpw'),
					  $params));
	//nuno-dev-Pretty Url's
	$prettyurl_forgot = 'feu/forgot/'.$pid;
	$forgot_feu = $this->CreateLink($id, 'default', $pid,  '',
					$params, '', 
					true, false, '', false, $prettyurl_forgot);
	
	$this->smarty->assign('url_forgot',$forgot_feu);
		

	$params['form'] = 'lostusername';
	$smarty->assign('link_lostun',
			$this->CreateLink($id,'default',$pid,
					  $this->Lang('lostusername'),
					  $params));
					  	//nuno-dev-Pretty Url's
	$prettyurl_lostun = 'feu/lostusername/'.$pid;
	$lostun_feu = $this->CreateLink($id, 'default', $pid,  '',
				    $params, '', 
					true, false, '', false, $prettyurl_lostun);
	
	$this->smarty->assign('url_lostun',$lostun_feu);
      }
  }
 else 
   {
     $params['form'] = 'forgotpw';
     $smarty->assign('link_forgot',
		     $this->CreateFrontendLink($id,$returnid,'default',
				       $this->Lang('forgotpw'),
				       $params));
	$forgot_feu = $this->CreateLink($id, 'default', $returnid,  '',
					$params, '', 
					true, false, '', false);
	
	$this->smarty->assign('url_forgot',$forgot_feu);
		
		                	/*
	  	$$smarty->assign('url_forgot',
		     $this->CreateLink($id,'default',$returnid,'',
				       $params,'',true));
	                        */
		 //end 
					  
					  
         $params['form'] = 'lostusername';
        $smarty->assign('link_lostun',
		     $this->CreateFrontendLink($id,$returnid,'default',
				       $this->Lang('lostusername'),
				       $params));
				       
	$lostun_feu = $this->CreateLink($id, 'default', $returnid,  '',
					$params, '', 
					true, false, '', false);
	
	$this->smarty->assign('url_lostun',$lostun_feu);
   }
if (isset($params['only_groups'])) {
  $smarty->assign('endform', '<div>'.$this->CreateInputHidden($id, 'only_groups', $params['only_groups']) .'</div>'. $this->CreateFormEnd());
 }
 else {
   $smarty->assign('endform', $this->CreateFormEnd());
 }
echo $this->ProcessTemplateFromDatabase('feusers_loginform');
// EOF
?>
