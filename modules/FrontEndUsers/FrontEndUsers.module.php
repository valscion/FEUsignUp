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

$cgextensions = cms_join_path($gCms->config['root_path'],'modules',
			      'CGExtensions','CGExtensions.module.php');
if( !is_readable( $cgextensions ) )
{
  echo '<h1><font color="red">ERROR: The CGExtensions module could not be found.</font></h1>';
  return;
}
require_once($cgextensions);

// a very important line that includes all of our api functions
require_once(dirname(__FILE__)."/lib/class.feu_smarty.php" );
class FrontEndUsers extends CGExtensions
{
  /**
   * The default template used for the login form
   */
  var $dflt_forgotpasswordtemplate2 = '
<!-- forgot password email template -->
<p>{$message_forgotpwemail}</p>
<p>{$prompt_code}&nbsp;{$data_code}</p>
<p>{$prompt_link}&nbsp;{$data_link}<p>
<!-- forgot password email template -->
  ';


  var $dflt_logoutformtemplate = '
<!-- Logout form template -->
  <p>{$prompt_loggedin}&nbsp;{$username}</p> 
  <p><a href="{$url_logout}" title="{$mod->Lang(\'info_logout\')}">{$mod->Lang(\'logout\')}</a></p>
<!-- Logout form template -->
 ';


  //How many seconds of inactivity before a user is automatically logged out.
  var $expirytime;
  
  //Set this to true if user should be redirected to default page after 
  // logging in/out.
  var $logintarget;
  var $otherintarget;
  var $logouttarget;
  var $otherouttarget;  
  var $allowuseradmin;
  var $enableemailpw;
  var $lang="";
  var $usermanip = false;
  var $types = false;

  // constructor
  public function __construct()
  {
    parent::__construct();
    $this->types = array( 'text' => 0,
			  'checkbox' => 1,
			  'email' => 2,
			  'textarea' => 3,
			  'dropdown' => 4,
                          'multiselect' => 5,
                          'image' => 6,
			  'radiobuttons' => 7,
			  'date' => 8);
    
    global $gCms;
    $obj = new feu_smarty($this);
    $smarty =& $gCms->GetSmarty();
    $smarty->assign_by_ref('feu_smarty',$obj);
  }

  private function _load()
  {
    if( $this->usermanip == NULL )
    {
      // check a preference to see which user manipulator class
      // we should use.  
      $usermanip = 'FrontEndUsers.api.php';
      $fn = cms_join_path(dirname(__FILE__),$usermanip);
      if( !is_readable( $fn ) ) 
        die("Could not read usermanipulator class file: $fn");
      require_once($fn);
      if( !isset( $manipulator ) )
        die('Could not determine manipulator class name');
      $this->usermanip = new $manipulator( $this );
      if( !is_object( $this->usermanip ) )
        die("Error instantiationg $manipulator object");
    }
  }


  function GenerateRandomPrintableString( $len = 10 )
  {
    $o1 = new Random("23456789ABCDEFGHJKMNPQRSTUVWXYZ");
    return $o1->get($len);
  }


  /*---------------------------------------------------------
   GetName()
   ---------------------------------------------------------*/
  function GetName() 	
  {
    return 'FrontEndUsers';
  }

 
  /*---------------------------------------------------------
   GetVersion()
   ---------------------------------------------------------*/
  function GetVersion()	
  {
    return '1.12.13';
  }

 
  /*---------------------------------------------------------
   langifyKeys()
 
   Given an associative array, replace the values with
   translated ones.
   ---------------------------------------------------------*/
  function langifyKeys( $arr )
  {
    $out = array();
    foreach( $arr as $k=>$v )
    {
      $k = $this->Lang($k);
      $out[ $k ] = $v;
    }
    return $out;
  }


  /*---------------------------------------------------------
   IsPluginModule()
   ---------------------------------------------------------*/
  function IsPluginModule() {
    return true;
  }


  /*---------------------------------------------------------
   AllowAutoInstall()
   ---------------------------------------------------------*/
  function AllowAutoInstall() {
    return FALSE;
  }


  /*---------------------------------------------------------
   AllowAutoUpgrade()
   ---------------------------------------------------------*/
  function AllowAutoUpgrade() {
    return FALSE;
  }


  /*---------------------------------------------------------
   MinimumCMSVersion()
   ---------------------------------------------------------*/
  function MinimumCMSVersion()
  {
    return "1.9.2";
  }
  
 
 
 /*---------------------------------------------------------
   GetAdminDescription()
   ---------------------------------------------------------*/
  function GetAdminDescription ()
  {
    return $this->Lang ('moddescription');
  }


  /*---------------------------------------------------------
   GetAdminSection()
   ---------------------------------------------------------*/
  function GetAdminSection ()
  {
    return 'usersgroups';
  }


  /*---------------------------------------------------------
   GetDependencies()
   ---------------------------------------------------------*/
  function GetDependencies()
  {
    return array( 'CMSMailer' => '1.73.9',
		  'CGExtensions' => '1.24' );
  }


  /*---------------------------------------------------------
   SetParameters()
   ---------------------------------------------------------*/
  function SetParameters()
  {
    $this->RestrictUnknownParams();
    $this->RegisterModulePlugin();
    $this->SetParameterType('code',CLEAN_STRING);
    $this->SetParameterType('form',CLEAN_STRING);
    $this->SetParameterType('returnto',CLEAN_STRING);
    $this->SetParameterType('only_groups',CLEAN_STRING);
    $this->SetParameterType('nocaptcha',CLEAN_INT);
    $this->SetParameterType('input_username',CLEAN_STRING);
    $this->SetParameterType('input_password',CLEAN_STRING);
    $this->SetParameterType('input_repeatpassword',CLEAN_STRING);
    $this->SetParameterType('error',CLEAN_INT);
    $this->SetParameterType('message',CLEAN_STRING);
    $this->SetParameterType('lostun_group',CLEAN_STRING);
    $this->SetParameterType('input_captcha',CLEAN_STRING);
    $this->SetParameterType('submit',CLEAN_STRING);
    $this->SetParameterType('cancel',CLEAN_STRING);
    $this->SetParameterType('input_returnto',CLEAN_INT);
    $this->SetParameterType('input_uid',CLEAN_INT);
    $this->SetParameterType('input_code',CLEAN_STRING);
    $this->SetParameterType('skipformdisplay',CLEAN_INT);
    $this->SetParameterType('uid',CLEAN_INT);
    $this->SetParameterType('checkonly',CLEAN_INT);

    $this->SetParameterType('returnlast',CLEAN_INT);
    $this->CreateParameter('returnlast','',$this->Lang('help_returnlast'));

    $this->SetParameterType('noinline',CLEAN_INT);
    $this->CreateParameter('noinline','',$this->Lang('help_noinline'));

    $this->SetParameterType(CLEAN_REGEXP.'/feu_.*/',CLEAN_STRING);

    $this->RegisterRoute('/[fF]eu\/verify\/(?P<returnid>[0-9]+)\/(?P<uid>[0-9]+)\/(?P<code>.*?)$/',
			 array('action'=>'verifycode'));

    $this->RegisterRoute('/[fF]eu\/reset\/(?P<uid>[0-9]+)$/',
			 array('action'=>'reset_session',
			       'showtemplate'=>'false',
			       'checkonly'=>'1'));

    //nuno-dev-Pretty Url's
    $this->RegisterRoute('/[fF]eu\/edit\/(?P<returnid>[0-9]+)$/',
			 array('action'=>'changesettings'));
    
    $this->RegisterRoute('/[fF]eu\/logout\/(?P<returnid>[0-9]+)$/',
			 array('action'=>'logout'));
    
    $this->RegisterRoute('/[fF]eu\/forgot\/(?P<returnid>[0-9]+)$/',
			 array('action'=>'forgotpw'));
    
    $this->RegisterRoute('/[fF]eu\/lostusername\/(?P<returnid>[0-9]+)$/',
			 array('action'=>'lostusername'));
    
    //end
  }


  /*---------------------------------------------------------
   _ExportLoggedInUserVariables()
   ---------------------------------------------------------*/
  function _ExportLoggedInUserVariables($id,&$params,$returnid) 
  {
    // replace {$username} with the user name
    $uid = $this->LoggedInId();
    if( !$uid ) return;
    $username = $this->LoggedInName();

    // replace {$groupname} with the first groupname we can find that matches
    $groups = $this->GetMemberGroupsArray( $uid );
    $groupname = $this->GetGroupName( $groups[0]['groupid'] );

    $this->smarty->assign('userid', $uid);
    $this->smarty->assign('username', $username );
    $this->smarty->assign('link_logout',
			  $this->CreateLink($id,"logout",$returnid,
					    $this->Lang('logout')));
  //nuno-dev-Pretty Url's
	 $prettyurl_logout = 'feu/logout/'.$returnid;
	 $logout_feu = $this->CreateLink($id, 'logout', $returnid,  '',
				    array(), '', true, false, '', false, $prettyurl_logout);
	
	$this->smarty->assign('url_logout', $logout_feu);
	//end

    $page = $this->ProcessTemplateFromData($this->GetPreference('pageid_changesettings'));
    if( $page )
    {
      $pageid = ContentManager::GetPageIDFromAlias( $page );
      if( $pageid == false )
      {
        $this->smarty->assign('link_changesettings','<!-- Error could not determine page from alias/id -->');
      }
      else 
      {
        $this->smarty->assign('link_changesettings',
			      $this->CreateLink($id,'default',$pageid,
						$this->Lang('prompt_changesettings'),
						array('form'=>'changesettings')));
	//nuno-dev-Pretty Url's
	$prettyurl_changesettings = 'feu/edit/'.$pageid;
	$changesettings_feu = $this->CreateLink($id, 'default', $pageid,  '',
				    array('form'=>'changesettings'), '', 
					true, false, '', false, $prettyurl_changesettings);
	
	$this->smarty->assign('url_changesettings',$changesettings_feu);
	//end 
      }
    }
    else
    {
       $this->smarty->assign('link_changesettings',
			  $this->CreateLink($id,'default',$returnid,
					    $this->Lang('prompt_changesettings'),
					    array('form'=>'changesettings')));
      //nuno-dev-Pretty Url's
	$prettyurl_changesettings = 'feu/edit/'.$returnid;
	$changesettings_feu = $this->CreateLink($id, 'default', $returnid,  '',
				    array('form'=>'changesettings'), '', 
					true, false, '', false, $prettyurl_changesettings);
	
	$this->smarty->assign('url_changesettings',$changesettings_feu);
	//end
    }
    $props = $this->GetUserProperties( $this->LoggedInId() );
    foreach( $props as $p )
    {
      $this->smarty->assign($p['title'],$p['data']);
    }
  }


  /*---------------------------------------------------------
   GetEventDescription()
   ---------------------------------------------------------*/
  function GetEventDescription ( $eventname )
  {
    return $this->Lang('event_info_'.$eventname );
  }


  /*---------------------------------------------------------
   GetEventHelp()
   ---------------------------------------------------------*/
  function GetEventHelp ( $eventname )
  {
    return $this->Lang('event_help_'.$eventname );
  }


  /*---------------------------------------------------------
   GetFriendlyName()
   ---------------------------------------------------------*/
  function GetFriendlyName ()
  {
    return $this->Lang('friendlyname');
  }


  /*---------------------------------------------------------
   HasAdmin()
   ---------------------------------------------------------*/
  function HasAdmin ()
  {
    return true;
  }


 function GetPageId($alias) {		
    if ($alias=="") return false;
    $db =& $this->GetDb();
    $query = "SELECT content_id FROM ".cms_db_prefix()."content WHERE content_alias = '".str_replace("'",'_',$alias)."'";
    $dbresult = $db->Execute($query);
    if ($dbresult && $dbresult->RecordCount() > 0)	{
      $row = $dbresult->FetchRow();
      return $row['content_id'];
    }
    return false;
  }


 function _HasSufficientPermissions( $perm = '' )
 {
   if ($this->GetPreference('feusers_specific_permissions','0') == '1')
     {
       $p1 = $this->CheckPermission( 'FEU Add Users' );
       $p2 = $this->CheckPermission( 'FEU Modify Users' );
       $p3 = $this->CheckPermission( 'FEU Remove Users' );
       $p4 = $this->CheckPermission( 'FEU Add Groups' );
       $p5 = $this->CheckPermission( 'FEU Modify Groups' );
       $p6 = $this->CheckPermission( 'FEU Modify Group Assignments' );
       $p7 = $this->CheckPermission( 'FEU Remove Groups' );
       $p8 = $this->CheckPermission( 'FEU Modify Site Preferences' );
       $p9 = $this->CheckPermission( 'FEU Modify FrontEndUserProps' );
       $p10 = $this->CheckPermission( 'FEU Modify Templates' );
     }
   else
     {
       $p1 = $this->CheckPermission( 'Add Users' );
       $p2 = $this->CheckPermission( 'Modify Users' );
       $p3 = $this->CheckPermission( 'Remove Users' );
       $p4 = $this->CheckPermission( 'Add Groups' );
       $p5 = $this->CheckPermission( 'Modify Groups' );
       $p6 = $this->CheckPermission( 'Modify Group Assignments' );
       $p7 = $this->CheckPermission( 'Remove Groups' );
       $p8 = $this->CheckPermission( 'Modify Site Preferences' );
       $p9 = $this->CheckPermission( 'Modify FrontEndUserProps' );
       $p10 = $this->CheckPermission( 'Modify Templates' );
     }
   
   $ret = 0;
   switch( $perm )
     {
     case '':  // any permission
       $ret = ($p1 || $p2 || $p3 || $p4 || $p5 || $p6 || $p7 || $p8 || $p9 || $p10 );
       break;
       
     case 'addgroup':
       $ret = ($p4);
       break;
       
     case 'adduser':
       $ret = ($p1);
       break;
       
     case 'addprop':
     case 'addprop2':
     case 'editprop':
     case 'deleteprop':
     case 'properties':
       $ret = ($p9);
       break;
     
     case 'listusers':
       $ret = ($p2 || $p3);
       break;
       
     case 'listgroups':
       $ret = ($p5 || $p6);
       break;
       
     case 'editgroups':
       $ret = ($p5 || $p6);
       break;
       
     case 'editusers':
       $ret = ($p2);
       break;
       
     case 'removegroups':
       $ret = ($p7);
       break;
       
     case 'removeusers':
       $ret = ($p3);
       break;

     case 'editprefs':
     case 'siteprefs':
       $ret = ($p8);
       break;
       
     case 'usersngroups':
       $ret = ($p1 || $p2 || $p3 || $p4 || $p5 || $p6 || $p7);
       break;
       
     case 'templates':
       $ret = ($p10);
       break;
       
     default:
       $ret = 0;
       break;
     }

   return $ret;
 }


  function InstallPostMessage()	
  {
    return $this->Lang('postinstallmessage');
  }


  function VisibleToAdminUser()
  {
    if ($this->GetPreference('feusers_specific_permissions','0') == '1')
      {
	return $this->CheckPermission('FEU Modify Site Preferences') ||
	  $this->CheckPermission('FEU Modify Templates') ||
	  $this->CheckPermission('FEU Add Groups') ||
	  $this->CheckPermission('FEU Modify Groups') ||
	  $this->CheckPermission('FEU Remove Groups') ||
	  $this->CheckPermission('FEU Add Users') ||
	  $this->CheckPermission('FEU Modify Users') ||
	  $this->CheckPermission('FEU Remove Users') ||
	  $this->CheckPermission('FEU Modify FrontEndUserProps');
      }
    else
      {
	return $this->CheckPermission('Modify Site Preferences') ||
	  $this->CheckPermission('Modify Templates') ||
	  $this->CheckPermission('Add Groups') ||
	  $this->CheckPermission('Modify Groups') ||
	  $this->CheckPermission('Remove Groups') ||
	  $this->CheckPermission('Add Users') ||
	  $this->CheckPermission('Modify Users') ||
	  $this->CheckPermission('Remove Users') ||
	  $this->CheckPermission('Modify FrontEndUserProps');
      }
  }


  /*---------------------------------------------------------
   _DisplayErrorPage($id, $params, $returnid, $message)
   NOT PART OF THE MODULE API

   This is an example of a simple method to display
   error information on the admin side.
   ---------------------------------------------------------*/
  function _DisplayErrorPage($id, &$params, $returnid, $message='')
  {
    $this->smarty->assign('title_error', $this->Lang('error'));
    if ($message != '')
      {
	$this->smarty->assign('message', $message);
      }
      
    // Display the populated template
    echo $this->ProcessTemplate('error.tpl');
  }


  function _DoSetChangeSettingsTemplate( $id, &$params, $returnid )
  {
    if( isset( $params['defaults'] ) )
      {
	$fn = dirname(__FILE__).'/templates/orig_changesettings.tpl';
	$this->SetTemplate('feusers_changesettingsform', file_get_contents($fn) );
      }
    else
      {
	$this->SetTemplate('feusers_changesettingsform', $params['templatecontent']);
      }
    $this->RedirectToTab($id, 'changesettings_template' );
  }


  function _DoSetForgotPWTemplate( $id, &$params, $returnid )
  {
    if( isset( $params['defaults'] ) )
      {
	
	$fn = dirname(__FILE__).'/templates/orig_forgotpassword1.tpl';
	$this->SetTemplate('feusers_forgotpasswordform', file_get_contents($fn) );

	$this->SetTemplate('feusers_forgotpasswordemailform', $this->dflt_forgotpasswordtemplate2);

	$fn = dirname(__FILE__).'/templates/orig_forgotpassword3.tpl';
	$this->SetTemplate('feusers_forgotpasswordverifyform',file_get_contents($fn));
      }
    else
      {
	$this->SetTemplate('feusers_forgotpasswordform', $params['templatecontent1']);
	$this->SetTemplate('feusers_forgotpasswordemailform', $params['templatecontent2']);;
	$this->SetTemplate('feusers_forgotpasswordverifyform', $params['templatecontent3']);;
      }
    $this->RedirectToTab($id, 'forgotpassword_template' );
  }


  function _DoSetLoginTemplate( $id, &$params, $returnid )
  {
    if( isset( $params['defaults'] ) )
      {
	$fn = dirname(__FILE__).'/templates/orig_loginform.tpl';
	$this->SetTemplate('feusers_loginform', file_get_contents($fn) );
      }
    else
      {
	$this->SetTemplate('feusers_loginform', $params['templateloginform']);
      }
    $this->RedirectToTab($id, 'logintemplate' );
  }

  
  function _DoSetLogoutTemplate( $id, &$params, $returnid )
  {
    if( isset( $params['defaults'] ) )
      {
	$this->SetTemplate('feusers_logoutform', $this->dflt_logoutformtemplate);
      }
    else
      {
	$this->SetTemplate('feusers_logoutform', $params['templatelogoutform']);
      }
    $this->RedirectToTab($id, 'logouttemplate', $params);
  }
  

  function _DoUserAction( $id, &$params, $returnid )
  {
    $form = 'login';
    if( isset($params['form']) ) $form = $params['form'];

    if( !isset($params['form']))
      {
	$uid = $this->LoggedInId();
	if( $uid <= 0 )
	  {
	    $form = 'login';
	  }
	else 
	  {
	    $form = 'logout';
	  }
      }

    $auth_consumer = feu_utils::get_auth_consumer();
    switch( $form )
      {
      case 'login':
	include dirname(__FILE__).'/function.user_loginform.php';
	break;
      case 'logout':
	include dirname(__FILE__).'/function.user_logoutform.php';
	break;
      case 'lostusername':
	include(dirname(__FILE__).'/function.default_lostusernameform.php');
	break;
      case 'forgotpw':
	include(dirname(__FILE__).'/function.user_forgotpassword.php');
	break;
      case 'changesettings':
	include(dirname(__FILE__).'/function.user_changesettings.php');
	break;
      case 'silent':
	$this->_ExportLoggedInUserVariables( $id, $params, $returnid );
	break;
      }
  }


  function _DisplayAdminUserPage( $id, &$params, $returnid )
  {
    global $gCms;

    // populate the template
    $hidden = array();
    if( isset($params['returnto']) )
      {
	$hidden['returnto'] = $params['returnto'];
      }
    $editing = 0;
    if( isset( $params['action'] ) && 
	($params['action'] == 'edituser'|| $params['action'] == 'do_edituser1' ) )
      {
	$editing = 1;
	$hidden['user_id'] = $params['user_id'];
	$this->smarty->assign('title', $this->Lang('edituser'));
	$this->smarty->assign('startform',
				      $this->CreateFormStart ($id,
							      'do_edituser1',
							      $returnid));
      }
    else
      {
	$this->smarty->assign('title', $this->Lang('adduser'));
	$this->smarty->assign('startform',
				      $this->CreateFormStart ($id,
							      'do_adduser1',
							      $returnid));
      }

    if( !empty($hidden) )
      {
	$txt = '';
	foreach( $hidden as $key => $value )
	  {
	    $txt .= $this->CreateInputHidden($id,$key,$value);
	  }
	$this->smarty->assign('hidden',$txt);
      }

    if( isset($params['error']) )
      $this->smarty->assign('error',$params['error']);
    if( isset($params['message']) )
      $this->smarty->assign('message',$params['message']);

    $username = '';
    if( $this->GetPreference('use_randomusername',0) == 1 )
      {
	$username = $this->GenerateRandomUsername();
      }
    if( isset($params['input_username']) )
      {
	$username = trim($params['input_username']);
      }
    $password = '';
    if( isset($params['input_password']) )
      $password = trim($params['input_password']);
    $repeatpassword = '';
    if( isset($params['input_repeatpassword']) )
      $repeatpassword = trim($params['input_repeatpassword']);
    $expires = '';
    if( isset($params['input_expires']) )
      $expires = trim($params['input_expires']);
    
    $this->smarty->assign('endform', $this->CreateFormEnd ());
    $this->smarty->assign('submit',
				  $this->CreateInputSubmit ($id, 'submit',
							    $this->Lang('next')));
    $this->smarty->assign('cancel',
				  $this->CreateInputSubmit ($id, 'cancel',
							    $this->Lang('cancel')));
    if ($this->GetPreference('username_is_email'))
      {
      $this->smarty->assign ('prompt_username',
			   $this->Lang ('prompt_email'));
      }
     else
      {
      $this->smarty->assign ('prompt_username',
			   $this->Lang ('username'));
      }
    $this->smarty->assign ('input_username',
			   $this->CreateInputText ($id, 'input_username',
						   $username, 
						   $this->GetPreference('usernamefldlength'), 
						   $this->GetPreference('max_usernamelength')));

    $this->smarty->assign ('prompt_password',
			   $this->Lang ('password'));
    $this->smarty->assign ('input_password',
			   $this->CreateInputPassword ($id, 'input_password',
						       $password, 
						       $this->GetPreference('passwordfldlength'),
						       $this->GetPreference('max_passwordlength')));
    $this->smarty->assign ('prompt_repeatpassword',
			   $this->Lang ('repeatpassword'));
    $this->smarty->assign ('input_repeatpassword',
			   $this->CreateInputPassword ($id, 'input_repeatpassword',
						       $repeatpassword,
						       $this->GetPreference('passwordfldlength'),
						       $this->GetPreference('max_passwordlength')));

    if( $editing == 1 )
      {
	$this->smarty->assign ('info_password',
			       $this->Lang ('info_admin_password'));
	
	$this->smarty->assign ('info_repeatpassword',
			       $this->Lang ('info_admin_repeatpassword'));
      }

    $this->smarty->assign ('prompt_expires',
			   $this->Lang('expires'));
    $this->smarty->assign ('expires_dateprefix', $id.'expiresdate_');
    $tmp = $this->GetPreference('expireage_months',520);
    $expiresdate = strtotime("+{$tmp} months", time());
    if( isset( $params['input_expiresdate'] ) )
      {
	$expiresdate = $params['input_expiresdate'];
      }
    $this->smarty->assign ('expiresdate', $expiresdate );
    

    // Display this user's properties and allow us to edit them

    // display and edit groups
    if( $this->_HasSufficientPermissions('editgroups') )
      {
	if( isset($params['memberof'] ) )
	  {
	    $tmp = (int)$params['memberof'];
	    $params['memberof_'.$tmp] = 1;
	  }

	// now display a list of groups that this user may optionally be in
	$this->smarty->assign( 'idtext', $this->Lang('id') );
	$this->smarty->assign( 'nametext', $this->Lang('name') );
	$this->smarty->assign( 'desctext', $this->Lang('description') );
	
	$groups = $this->GetGroupListFull();
	$rowarray = array();
	$rowclass = 'row1';
	foreach( $groups as $group )
	{
	  $onerow = new StdClass();
	  $onerow->id = $group['id'];
	  $onerow->name = $group['groupname'];
	  $onerow->desc = $group['groupdesc'];
	  $onerow->member = $this->CreateInputCheckbox($id,'memberof_'.$group['id'],
						  $group['id'],
						  (isset($params['memberof_'.$group['id']]) ? 
						   $params['memberof_'.$group['id']] : -1));
	  $onerow->rowclass = $rowclass;
	  
	  array_push ($rowarray, $onerow);
	  ($rowclass == "row1" ? $rowclass = "row2" : $rowclass = "row1");
	}
	$this->smarty->assign('itemcount',count($rowarray));
	$this->smarty->assign('items',$rowarray);
      }

    $this->smarty->assign('propadd', $this->CreateInputSubmit( $id, 'propadd',
							       $this->Lang('add')));
    $this->smarty->assign('groupstitle', $this->Lang('groups'));
    $this->smarty->assign('propertiestitle', $this->Lang('properties'));

    $this->smarty->assign('props',
			  $this->CreateInputSubmit($id, 'props', $this->Lang('properties')."..."));
    echo $this->ProcessTemplate('adduser1.tpl');
  }


  function DoAction($action, $id, $params, $returnid = -1) 
  {
    global $gCms;
    $smarty =& $gCms->GetSmarty();
    $smarty->assign('feuactionid',$id);
    $smarty->assign('feuactionparams',$params);
    $smarty->assign('mod',$this);
    $smarty->assign($this->GetName(),$this);
    
    switch ($action)
      {
      case 'changesettings_url':
	break;

      case 'changesettings':
	$params['form'] = $action;
	$this->_DoUserAction( $id, $params, $returnid );
	break;

      case 'lostusername':
      case 'forgotpw':
	$params['form'] = $action;	
	$this->_DoUserAction( $id, $params, $returnid );
	break;

      case "default": 
        {
      $this->_DoUserAction( $id, $params, $returnid );
	  break;
        }

      case 'do_setchangesettingstemplate':
	{
	  if( $this->_HasSufficientPermissions( 'templates' ) )
	    {
	      $this->_DoSetChangeSettingsTemplate( $id, $params, $returnid );
	    }
	  else
	    {
	      $this->_DisplayErrorPage($id, $params, $returnid,
				      $this->Lang('accessdenied'));
	    }
	  break;
	}

      case 'do_setforgotpwtemplate':
	{
	  if( $this->_HasSufficientPermissions( 'templates' ) )
	    {
	      $this->_DoSetForgotPWTemplate( $id, $params, $returnid );
	    }
	  else
	    {
	      $this->_DisplayErrorPage($id, $params, $returnid,
				      $this->Lang('accessdenied'));
	    }
	  break;
	}

      case 'do_setlogintemplate':
	{
	  if( $this->_HasSufficientPermissions( 'templates' ) )
	    {
	      $this->_DoSetLoginTemplate( $id, $params, $returnid );
	    }
	  else
	    {
	      $this->_DisplayErrorPage($id, $params, $returnid,
				      $this->Lang('accessdenied'));
	    }
	  break;
	}

      case 'do_setlogouttemplate':
	{
	  if( $this->_HasSufficientPermissions( 'templates' ) )
	    {
	      $this->_DoSetLogoutTemplate( $id, $params, $returnid );
	    }
	  else
	    {
	      $this->_DisplayErrorPage($id, $params, $returnid,
				      $this->Lang('accessdenied'));
	    }
	  break;
	}



      case 'edituser':
	{
	  if( $this->_HasSufficientPermissions( 'editusers' ) )
	    {
	      $this->_DisplayAdminEditUserStep1Page( $id, $params, $returnid );
	    }
	  else
	    {
	      $this->_DisplayErrorPage($id, $params, $returnid,
				       $this->Lang('accessdenied'));
	    }
	  break;
	}

      case 'admin_bulkactions':
      case 'admin_importgroup':
      case 'admin_exportgroup':
      case 'admin_logout':
      case 'admin_setviewuser_template':
      case 'admin_setlostun_template':
      case 'addgroup':
      case 'adduser':
      case 'addprop':
      case 'defaultadmin': 
      case 'do_deleteprop':
      case 'do_deletegroup':
      case 'do_login':
      case 'do_adduser1':
      case 'do_adduser3':
      case 'do_deleteuser':
      case 'do_addgroup':
      case 'do_edituser3':
      case 'do_userchangesettings':
      case 'do_forgotpw':
      case 'do_setprefs':
      case 'do_edituser1':
      case 'do_admintasks':
      case 'do_lostusername':
      case 'do_verifycode':
      case 'logout':
      case 'userhistory':
      case 'verifycode':
      case 'viewuser':
      case 'do_edituser2':
      case 'do_adduser2':
      default:
	parent::DoAction($action,$id,$params,$returnid);
	break;
      }
  }


  function _DisplayAdminEditUserStep1Page( $id, &$params, $returnid )
  {
    if( !isset( $params['user_id'] ) )
      {
	$this->_DisplayErrorPage ($id, $params, $returnid,
				 $this->Lang ('error_insufficientparams'));
	return;
      }

    // now get the user info
    $user = $this->GetUserInfo( $params['user_id'] );
    if( $user[0] == false )
      {
	$this->_DisplayErrorPage ($id, $params, $returnid, $user[1] );
	return;
      }
    $user = $user[1];

    // get the user properties
    $this->SetEncryptionKey($params['user_id']);
    $props = $this->GetUserProperties( $params['user_id'] );
    
    // get the group memberships
    $groups = $this->GetMemberGroupsArray( $params['user_id'] );
// todo, users may (optionally) not be part of any gruops
//     if( $groups == false )
//       {
// 	$this->_DisplayErrorPage ($id, $params, $returnid, $this->Lang('error_membergroups') );
// 	return;
//       }

    // populate the params with the appropriate stuff
    // that we just loaded
    $params['input_username'] = $user['username'];
    $params['input_expiresdate'] = $user['expires'];
//     $params['input_password'] = $user['password'];  // the password row is md5 hashed, don't bother displaying it
//     $params['input_repeatpassword'] = $user['password'];
    $userprops = '';
    foreach( $props as $prop )
    {
      if( $userprops == '' )
	{
	  $userprops = $prop['title']."=".$prop['data'];
	}
      else
	{
	  $userprops .= ",".$prop['title']."=".$prop['data'];
	}
    }
    $params['userprops'] = $userprops;

    $memberof = '';
    if( $groups != false )
      {
	foreach( $groups as $group )
	{
	  $params['memberof_'.$group['groupid']] = $group['groupid'];
	}
      }

    // and display the user page
    // todo, put a redirect here
    $this->_DisplayAdminUserPage( $id, $params, $returnid );
  }


  function _handleUserInfoValidation( $id, &$params, $returnid, &$message, $needpw = true, 
				      $doexpire = true, $checkusername = true )
  {
    // make sure the parameters are filled in
    $username = trim($params['input_username']);
    $password = trim($params['input_password']);
    $repeat   = trim($params['input_repeatpassword']);
    
    // make sure the username fits the rules
    if( $checkusername )
      {
	
	$message = $this->Lang('error_invalidusername');
	if( $this->GetPreference('username_is_email',0) == 1 )
	  {
	    $message = $this->Lang('error_invalidemailaddress');
	    if( strpos($username,'@') == false )
	      {
		return -1;
	      }
	  }
	if( !$this->IsValidUsername( $username ) )
	  {
	    return -1;
	  }
      }

    if ($this->GetPreference('username_is_email','0') == '1'
      && strpos($username,'@') === false)
      {
      $message = $this->Lang('error_invalidemailaddress');
      return -1;
      }
    
    if( $username == '' 
	|| ($needpw && ($password == '' || $repeat == ''))  )
      {
	//die("$username, $needpw, $password, $repeat");
	$message = $this->Lang('error_invalidparams');
	return -1;
      }

    // make sure the passwords match
    if( $password != $repeat )
      {
	$message = $this->Lang('error_passwordmismatch');
	return -1;
      }

    // make sure the password fits the rules
    if( $needpw && !$this->IsValidPassword( $password ) )
      {
	$message = $this->Lang('error_invalidpassword');
	return -1;
      }

    if( $doexpire == false )
      {
	return 1;
      }

    // make sure an expiry date is set
    if( !isset($params['expiresdate_Month']) )
      {
	$message = $this->Lang('error_invalidexpirydate');
	return -1;
      }

    $expires = mktime(23,59,59,
		      $params['expiresdate_Month'], $params['expiresdate_Day'], 
		      $params['expiresdate_Year']);
    if( !$expires )
      {
	$message = $this->Lang('error_invalidexpirydate');
	return -1;
      }
    $params['input_expiresdate'] = $expires;
    return 1;
  }


 function myRedirect( $id, $action, $returnid, $params = array(), $ignore_returnto = false )
  {
    if( isset($params['returnto']) && !$ignore_returnto)
      {
	list($mod,$act) = explode(',',$params['returnto']);
	$this->LoadRedirectMethods();
	$modobj =& $this->GetModuleInstance($mod);
	$tmp = array();
	return cms_module_Redirect($modobj,$id,$act,$returnid);
      }
    $this->Redirect( $id, $action, $returnid, $params );
  }

function feCreateFormStart( $id, $action, $returnid, $inline=true, $method='post', $enctype='', $idsuffix='', $params = array() )
  {
    return $this->CreateFormStart($id,$action,$returnid,$method,$enctype,$inline,$idsuffix, $params);
  }


  function GetHelp($lang='en_US')	
  {
    return $this->Lang('help');
  }


  function GetAuthor() 
  {
    return 'calguy1000';
  }

  
  function GetAuthorEmail()	
  {
    return 'calguy1000@hotmail.com';
  }

  
  function GetChangeLog()	
  {
    return file_get_contents(dirname(__FILE__).'/changelog.inc');
  }


  /*---------------------------------------------------------
   GetHeaderHTML()
   ---------------------------------------------------------*/
  function GetHeaderHTML()
  {
$tmpl =<<<EOT
{JQueryTools action="incjs"}
{JQueryTools action="ready"}
EOT;
    $obj =& $this->GetModuleInstance('JQueryTools');
    if( is_object($obj) )
      {
	return $this->ProcessTemplateFromData($tmpl);
      }
  }	


  // send an event that this user account has been expired
  function NotifyExpiredUser( $userid )	
  {
    $user = $this->GetUserInfo( $userid );
    if( $user[0] == FALSE )
      {
	// this should be an error
	return;
      }
    $parms = array();
    $parms['id'] = $userid;
    $parms['username'] = $user[1]['username'];
    $this->SendEvent('OnExpireUser',$parms);
    $this->_SendNotificationEmail('OnExpireUser',$parms);
  }


  function imageTransform($srcSpec, $destSpec, $size, &$config)
  {
    require_once(dirname(__FILE__).'/../../lib/filemanager/ImageManager/Classes/Transform.php');
    
    $it = new Image_Transform;
    $img = $it->factory($config['image_manipulation_prog']);
    $img->load($srcSpec);
    if ($img->img_x < $img->img_y)
      {
	$long_axis = $img->img_y;
      }
    else
      {
	$long_axis = $img->img_x;
      }
    
    if ($long_axis > $size)
      {
	$img->scaleByLength($size);
	$img->save($destSpec, 'jpeg');
      }
    else
      {
	$img->save($destSpec, 'jpeg');
      }
    $img->free();
  }


  function get_upload_dirname($uid)
  {
    global $gCms;
    $config = $gCms->GetConfig();

    $dn = cms_join_path($config['uploads_path'],
			$this->GetPreference('image_destination_path', 'feusers'));
    return $dn;
  }


  function GetUploadedFilename($uid,$fldvalue)
  {
    $fn = cms_join_path($this->get_upload_dirname($uid),
			"{$uid}_{$fldvalue}");
    return $fn;
  }


  function ManageImageUpload($id, $fldprefix, $fldname, $uid, $image_width = '')
  {
    global $gCms;

    if( $image_width == '' )
      {
	$image_width = $this->GetPreference('thumbnail_size',75);
      }

    $allowed_extensions=$this->GetPreference('allowed_image_extensions',
					     '.gif,.png,.jpg');
    $maxfilesize = $this->GetPreference('max_upload_size',10*1024*1024);
    if( !isset($_FILES[$id.$fldprefix.$fldname]) || !isset( $_FILES ) )
      {
	return array(false,$this->Lang('error_missing_upload'));
      }

    //$destname = $_FILES[$id.$fldname]['name'];
    $file =& $_FILES[$id.$fldprefix.$fldname];
    if (!isset ($file['type']))
      $file['type'] = '';
    if (!isset ($file['size']))
      $file['size'] = '';
    if (!isset ($file['tmp_name']))
      $file['tmp_name'] = '';
    $file['name'] =
      preg_replace('/[^a-zA-Z0-9\.\$\%\'\`\-\@\{\}\~\!\#\(\)\&\_\^]/', '',
       str_replace (array (' ', '%20'), array ('_', '_'), $file['name']));
    
    // set the destination name
    $ext = strchr($file['name'],'.');
    $destname = $uid.'_'.$fldname.$ext;

    // Create the destination directory if necessary
    $destDir = $this->get_upload_dirname($uid);
    @mkdir($destDir);
    if( !is_writable( $destDir ) )
      {
	return array(false,$this->Lang('error_destinationnotwritable'));
      }

    // here we'd resize the image to the desired width
    // it also saves the file to the destination directory.
    $this->imageTransform($file['tmp_name'], $destDir.DIRECTORY_SEPARATOR.$destname, $image_width, $gCms->config);

    return array(true,$destname);
  }


  function SetLoginCookie($username,$password)
  {
    global $gCms;
    $config = $gCms->GetConfig();
    if( $this->GetPreference('usecookiestoremember') &&
	($this->GetPreference('cookiename') != '') )
      {
	$cookiename = $this->GetPreference('cookiename');

	//$pat = dirname($_SERVER['SCRIPT_NAME']);
	$dom = $_SERVER['HTTP_HOST'];

	$expires = time()+(3600*24*365);
	$val = array();
	$val['u'] = $username;
	$val['p'] = md5($password);
	$str = serialize( $val );
	$key = 'FEU'.md5($config['root_path']).md5($cookiename);
	$str = $this->_encrypt($key,$str);
	if( $str !== FALSE )
	  {
	    $str = base64_encode($str);
	    @setcookie( $cookiename, $str, $expires, "/" );
	  }
	return;
      }
  }


  function _AttemptInvalidateLoginCookie()
  {
    global $gCms;
    $config = $gCms->GetConfig();
    if( $this->GetPreference('usecookiestoremember') &&
	($this->GetPreference('cookiename') != '') )
      {
	$cookiename = $this->GetPreference('cookiename');
	$value = FALSE;
	if( isset($_COOKIE[$cookiename]) )
	  {
	    $value = $_COOKIE[$cookiename];
	  }
	
	$expires = time()-(3600*24); // one day ago
	$res = setcookie( $cookiename, $value, $expires, "/" );
	if( !$res ) die('delete cookie failed');
      }
  }


  function _AttemptLoginWithCookie()
  {
  }


  function _SendNotificationEmail($event,$params)
  {
    $notifications = explode(',',$this->GetPreference('notifications',''));
    if( !in_array( $event, $notifications ) ) return;
    $dest = trim($this->GetPreference('notification_address'));
    if( empty($dest) ) return;

    // Setup some smarty stuff.
    global $gCms;
    $smarty =& $gCms->GetSmarty();
    $smarty->assign('event',$event);
    $smarty->assign('event_name',$this->Lang($event));
    $smarty->assign('plaintext_event',$this->Lang('event'));
    foreach( $params as $key => $value )
      {
	$smarty->assign('param_'.$key,$value);
      }
    $text = $this->ProcessTemplateFromDatabase('notification_template');

    $cmsmailer =& $this->GetModuleInstance('CMSMailer');
    $cmsmailer->reset();
    $cmsmailer->AddAddress($dest);
    $cmsmailer->SetSubject($this->GetPreference('notification_subject'));
    $cmsmailer->SetBody($text);
    $cmsmailer->IsHTML(false);
    $cmsmailer->Send();
  }

  function _params_to_session(&$params, $key = 'feu_params')
  {
    $_SESSION[$key] = $params;
  }

  function _session_to_params($key = 'feu_params')
  {
    if( !isset($_SESSION[$key]) )
      {
	return false;
      }
    $tmp = $_SESSION[$key];
    unset($_SESSION[$key]);
    return $tmp;
  }


  //////////////////////////////////////////
  //  API FUNCTIONS //
  //////////////////////////////////////////

  function AddGroup( $name, $description )
  {
    $this->_load();
    return $this->usermanip->AddGroup( $name, $description );
  }


  function AddGroupPropertyRelation( $grpid, $propname, $sortkey, $lostun, $val )
  {
    $this->_load();
    return $this->usermanip->AddGroupPropertyRelation( $grpid, $propname, $sortkey, $lostun, $val );
  }


  function AddPropertyDefn( $name, $prompt, $type, $length, $maxlength = 0, $attribs = '', $force_unique = 0, $encrypt = 0 )
  {
    $this->_load();
    return $this->usermanip->AddPropertyDefn( $name, $prompt, $type, $length, $maxlength, $attribs, $force_unique, $encrypt  );
  }

  
  function AddSelectOptions( $name, $seloptions )
  {
    $this->_load();
    return $this->usermanip->AddSelectOptions( $name, $seloptions );
  }

 
  function AddUser( $name, $password, $expires, $do_md5 = true )
  {
    $this->_load();
    return $this->usermanip->AddUser( $name, $password, $expires, $do_md5 );
  }


  function AssignUserToGroup( $uid, $gid )
  {
    $this->_load();
    return $this->usermanip->AssignUserToGroup( $uid, $gid );
  }

 
  function CheckPassword($username,$password,$groups = '',$md5pw = false)
  {
    $this->_load();
    return $this->usermanip->CheckPassword($username,$password,$groups,$md5pw);
  }

 
  function CountTempCodeRecords()
  {
    $this->_load();
    return $this->usermanip->CountTempCodeRecords();
  }

 
  function CountUsersInGroup( $gid = '' )
  {
    $this->_load();
    return $this->usermanip->CountUsersInGroup( $gid );
  }


  /* what's this? */
  function DeleteAllGroupPropertyRelations( $grpid )
  {
    $this->_load();
    return $this->usermanip->DeleteAllGroupPropertyRelations( $grpid );
  }


  function DeleteAllGroupPropertyRelation( $grpid, $propname )
  {
    $this->_load();
    return $this->usermanip->DeleteAllGroupPropertyRelations( $grpid, $propname );
  }

  
  function DeletePropertyDefn( $name )
  {
    $this->_load();
    return $this->usermanip->DeletePropertyDefn( $name );
  }


  function DeletePropertyDefns()
  {
    $this->_load();
    return $this->usermanip->DeletePropertyDefns();
  }


  function DeleteSelectOptions( $name )
  {
    $this->_load();
    return $this->usermanip->DeleteSelectOptions( $name );
  }


  function DeleteUserFull( $uid )
  {
    $this->_load();
    return $this->usermanip->DeleteUserFull( $uid );
  }


  function DeleteUserPropertyByName( $title )
  {
    $this->_load();
    return $this->usermanip->DeleteUserPropertyByName($title);
  }

  /*What is this?*/
  function DeleteUserProperty($title,$all=false) 
  {
    $this->_load();
    return $this->usermanip->DeleteUserProperty($title,$all);
  }


  function DeleteAllUserProperties() 
  {
    $this->_load();
    return $this->usermanip->DeleteAllUserProperties();
  }

  
  function DeleteAllUserPropertiesFull($userid) 
  {
    $this->_load();
    return $this->usermanip->DeleteAllUserPropertiesFull($userid);
  }



  function DeleteUserPropertyFull($title,$userid,$all=false) 
  {
    $this->_load();
    return $this->usermanip->DeleteUserPropertyFull($title,$userid,$all);
  }


  function DeleteGroupFull( $gid )
  {
    $this->_load();
    return $this->usermanip->DeleteGroupFull( $gid );
  }


  function DeleteUser($id) 
  {
    $this->_load();
    return $this->usermanip->DeleteUser( $id );
  }

  function ExpireUsers() 
  {
    $this->_load();
    return $this->usermanip->ExpireUsers();
  }

  function ExpireTempCodes( $expirycode )
  {
    $this->_load();
    return $this->usermanip->ExpireTempCodes( $expirycode );
  }


  function GenerateRandomUsername( $prefix = 'user' )
  {
    $this->_load();
    return $this->usermanip->GenerateRandomUsername( $prefix );
  }
  
  function GetUserProperties($uid)
  {
    $this->_load();
    return $this->usermanip->GetUserProperties($uid);
  }
  

  function GetMemberGroupsArray($userid)
  {
    $this->_load();
    return $this->usermanip->GetMemberGroupsArray($userid);
  }

  function GetUserProperty($title,$defaultvalue=false) 
  {
    $this->_load();
    return $this->usermanip->GetUserProperty( $title, $defaultvalue );
  }

  function GetUserPropertyFull($title,$userid, $defaultvalue=false) 
  {
    $this->_load();
    return $this->usermanip->GetUserPropertyFull($title,$userid,$defaultvalue);
  }

  function GetUserTempCode( $uid )
  {
    $this->_load();
    return $this->usermanip->GetUserTempCode( $uid );
  }  


  function GetPropertyGroupRelations( $title )
  {
    $this->_load();
    return $this->usermanip->GetPropertyGroupRelations( $title );
  }


  function GetGroupPropertyRelations( $grpid )
  {
    $this->_load();
    return $this->usermanip->GetGroupPropertyRelations( $grpid );
  }


  function GetGroupInfo( $gid )
  {
    $this->_load();
    return $this->usermanip->GetGroupInfo( $gid );
  }


  function GetUserHistory( $uid, $action = '', $count = -1 )
  {
    $this->_load();
    return $this->usermanip->GetUserHistory($uid,$action,$count);
  }


  function GetUserInfo( $uid )
  {
    $this->_load();
    return $this->usermanip->GetUserInfo( $uid );
  }


  function GetUserInfoByName( $username )
  {
    $this->_load();
    return $this->usermanip->GetUserInfoByName( $username );
  }


  function GetFullUsersInGroup($gid)
  {
    $this->_load();
    return $this->usermanip->GetFullUsersInGroup($gid);
  }


  function GetUsersInGroup( $gid = '', $regex = '', $limit = '', $sort = '',
			    $property = '', $propregex = '', $loggedinonly = 0, $start_record = 0)
  {
    $this->_load();
    return $this->usermanip->GetUsersInGroup( $gid, $regex, $limit, $sort,
					      $property, $propregex, $loggedinonly, $start_record );
  }


  function GroupExistsByID( $gid )
  {
    $this->_load();
    return $this->usermanip->GroupExistsByID( $gid );
  }

  function GroupExistsByName( $name )
  {
    $this->_load();
    return $this->usermanip->GroupExistsByName( $name );
  }
	
  function LoggedInEmail()
  {
    $this->_load();
    return $this->usermanip->LoggedInEmail();
  }

  function GetEmail($uid)
  {
    $this->_load();
    return $this->usermanip->GetEmail($uid);
  }

  function ClearPropertyCache()
  {
    $this->_load();
    return $this->usermanip->ClearPropertyCache();
  }

  function GetPropertyDefns()
  {
    $this->_load();
    return $this->usermanip->GetPropertyDefns();
  }

  function GetPropertyDefn( $name )
  {
    $this->_load();
    return $this->usermanip->GetPropertyDefn( $name );
  }

  function GetSelectOptions( $name, $dim = 1 )
  {
    $this->_load();
    return $this->usermanip->GetSelectOptions( $name, $dim );
  }

  
  function GetUserName($userid) 
  {
    $this->_load();
    return $this->usermanip->GetUserName($userid);
  }

  
  function GetUserID($username) 
  {
    $this->_load();
    return $this->usermanip->GetUserID($username);
  }


  function GetGroupName($groupid) 
  {
    $this->_load();
    return $this->usermanip->GetGroupName( $groupid );
  }

  function GetGroupDesc($groupid)
  {
    $this->_load();
    return $this->usermanip->GetGroupDesc( $groupid );
  }


  function GetGroupList()
  {
    $this->_load();
    return $this->usermanip->GetGroupList();
  }

  
  function GetGroupListFull()
  {
    $this->_load();
    return $this->usermanip->GetGroupListFull();
  }

  function GetGroupID($groupname)
  {
    $this->_load();
    return $this->usermanip->GetGroupID( $groupname );
  }

  
 function GetMemberGroups($userid) 
  {
    $this->_load();
    return $this->usermanip->GetMemberGroups($userid);
  }

  
  function GetExpiryDate( $uid )
  {
    $this->_load();
    return $this->usermanip->GetExpiryDate( $uid );
  }


  function IsAccountExpired( $uid )
  {
    $this->_load();
    return $this->usermanip->IsAccountExpired( $uid );
  }

  
  function IsValidPassword( $password )
  {
    $this->_load();
    return $this->usermanip->IsValidPassword( $password );
  }

 
  function IsValidEmailAddress( $email, $uid = -1, $check_existing = true )
  {
    $this->_load();
    return $this->usermanip->IsValidEmailAddress( $email, $uid, $check_existing );
  }

  
  function IsValidUsername( $username, $check = true )
  {
    $this->_load();
    return $this->usermanip->IsValidUsername( $username, $check );
  }

  
  function Login( $username, $password, $groups = '', $md5pw = false,
		$force_logout = false)
  {
    $this->_load();
    return $this->usermanip->Login( $username, $password, $groups,
				    $md5pw, $force_logout);
  }


  function LoggedInName() 
  {
    $this->_load();
    $str = $this->usermanip->LoggedInName();
    return $str;
  }

  
  function Logout($uid = '') 
  {
    $this->_load();
    return $this->usermanip->Logout($uid);
  }

  
  function LogoutUser($uid,$eventmsg = 'logout') 
  {
    $this->_load();
    return $this->usermanip->LogoutUser($uid,$eventmsg);
  }

 
  function LoggedInId() 
  {
    $this->_load();
    return $this->usermanip->LoggedInId();
  }

 
  function LoggedIn() 
  {
    $tmp = $this->LoggedInId();
    if( $tmp > 0 ) return TRUE;
    return FALSE;
  }

 
  function MemberOfGroup($userid,$groupid) 
  {
    $this->_load();
    return $this->usermanip->MemberOfGroup($userid,$groupid);
  }

  
  function RemoveUserTempCode( $uid )
  {
    $this->_load();
    return $this->usermanip->RemoveUserTempCode( $uid );
  }  

  
  function RemoveUserFromGroup( $uid, $gid )
  {
    $this->_load();
    return $this->usermanip->RemoveUserFromGroup( $uid, $gid );
  }

  
  function SetUserTempCode( $uid, $code )
  {
    $this->_load();
    return $this->usermanip->SetUserTempCode( $uid, $code, $this->GetPreference('allow_duplicate_reminders') );
  }

  
function SetPropertyDefn( $name, $newname, $prompt, $length, $type, $maxlength = 0, $attribs = '', $force_unique = 0, $encrypt = 0 )
  {
    $this->_load();
    return $this->usermanip->SetPropertyDefn( $name, $newname, $prompt, $type, $length, $maxlength, $attribs, $force_unique, $encrypt );
  }

  
  function SetGroup( $gid, $name, $desc )
  {
    $this->_load();
    return $this->usermanip->SetGroup( $gid, $name, $desc );
  }

  
  function SetUserPassword( $uid, $password )
  {
    $this->_load();
    return $this->usermanip->SetUserPassword( $uid, $password );
  }

  
  function SetUser( $uid, $username, $password, $expires = false, $do_md5 = true )
  {
    $this->_load();
    return $this->usermanip->SetUser( $uid, $username, $password, $expires, $do_md5 );
  }


  function SetUserGroups( $uid, $grpids )
  {
    $this->_load();
    return $this->usermanip->SetUserGroups( $uid, $grpids );
  }

  
  function SetUserProperties( $uid, $props )
  {
    $this->_load();
    return $this->usermanip->SetUserProperties( $uid, $props );
  }

  function SetUserProperty($title,$data) 
  {
    $this->_load();
    return $this->usermanip->SetUserProperty($title,$data);
  }

  function IsUserPropertyValueUnique($uid,$title,$value)
  {
    $this->_load();
    return $this->usermanip->IsUserPropertyValueUnique($uid,$title,$value);
  }

  function SetUserPropertyFull($title,$data,$userid) 
  {
    $this->_load();
    return $this->usermanip->SetUserPropertyFull($title,$data,$userid);
  }

  function UserExistsByID( $uid )
  {
    $this->_load();
    return $this->usermanip->UserExistsByID( $uid );
  }

  function SetEncryptionKey($uid = -1,$force = FALSE)
  {
    $this->_load();
    return $this->usermanip->SetEncryptionKey( $uid, $force );
  }

  function _encrypt($key,$data)
  {
    if( !function_exists('mcrypt_module_open') ) return FALSE;
    srand((double) microtime() * 1000000);
    $encdata = FALSE;
    $td = @mcrypt_module_open(MCRYPT_DES,'',MCRYPT_MODE_ECB,'');
    if( $td === FALSE ) return FALSE;

    $key = substr($key,0,mcrypt_enc_get_key_size($td));
    $iv_size = mcrypt_enc_get_iv_size($td);
    $iv = @mcrypt_create_iv($iv_size, MCRYPT_RAND);

    // initialize encryption handle
    $tmp = @mcrypt_generic_init($td,$key, $iv);
    if( $tmp != -1 )
      {
	$tmp = mcrypt_generic($td,$data);
	@mcrypt_generic_deinit($td);
	$encdata = $tmp;
      }
    @mcrypt_module_close($td);
    return $encdata;
  }

  function _decrypt($key,$encdata)
  {
    if( !function_exists('mcrypt_module_open') ) return FALSE;
    $data = FALSE;
    $td = @mcrypt_module_open(MCRYPT_DES,'',MCRYPT_MODE_ECB,'');
    if( $td === FALSE ) return FALSE;

    $key = substr($key,0,mcrypt_enc_get_key_size($td));
    $iv_size = @mcrypt_enc_get_iv_size($td);
    $iv = @mcrypt_create_iv($iv_size, MCRYPT_RAND);

    // initialize encryption handle
    $tmp = @mcrypt_generic_init($td,$key, $iv);
    if( $tmp != -1 )
      {
	$data = @mdecrypt_generic($td,$encdata);
	mcrypt_generic_deinit($td);
      }
    @mcrypt_module_close($td);
    return $data;
  }

  function HasCapability($capability,$params = array())
  {
    switch( $capability )
      {
      case 'contentblocks':
      case 'content_attributes':
	return TRUE;
      default:
	return FALSE;
      }
  }

  function get_content_attributes($content_type)
  {
    $tmp = array();
    $attr = new CmsContentTypeProfileAttribute('feu_groups','visitors');
    $attr->set_helper(feu_content_attribute_helper::get_instance());
    $tmp[] = $attr;
    return $tmp;
  }


  function GetContentBlockInput($blockName,$value,$params,$adding = false)
  {
    switch( $params['selecttype'] )
      {
      case 'groupselect':
	$tmp1 = array();
	$tmp = $this->GetGroupList();
	$groups = array_merge($tmp1,$tmp);
	//var_dump($value); die();
	$value = explode(',', trim($value));
	return $this->CreateInputSelectList('',$blockName . '[]',$groups,$value);
	break;
      }
    return FALSE;
  }

  function GetContentBlockValue($blockName,$blockParams,$inputParams)
  {
    if( isset($blockParams['selecttype']) )
      {
	if( isset($inputParams[$blockName]) )
	  {
	    $val = $inputParams[$blockName];
		if (is_array($val))
		{
			$val = implode(',', $val);
			return $val;
		}
	  }
	    return '-1';
      }
    return '';
  }

  function ValidateContentBlockValue($blockName,$value,$blockParams)
  {
    switch($blockParams['selecttype'])
      {
      case 'groupselect':
/*
	if( $value == -1 )
	  {
	    return $this->Lang('error_mustselect_group');
	  }
*/
	break;
      }
    return '';
  }
			
} // class


// EOF
?>
