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

if( isset($params['feu_cancel']) ) 
  {
    if( isset( $params['feu_returnto'] ) )
      {
	$returnid = (int)$params['feu_returnto'];
      }
    $this->RedirectContent($returnid);
  }

$uid = $this->LoggedInId();
if( $uid == false ) 
  {
    // user isn't logged in
    $this->_DisplayErrorPage( $id, $params, $returnid, 
			      $this->Lang('error_notloggedin'));
    return;
  }
$result = $this->GetUserInfo( $uid );
if( $result[0] == FALSE )
  {
    // user isn't logged in
    $this->_DisplayErrorPage( $id, $params, $returnid, 
			      $result[1]);
    return;
  }
$uinfo = $result[1];

$password = '';
// check if user is allowed to change password.
$consumer = feu_utils::get_auth_consumer();
if( $consumer->has_capability(feu_auth_consumer::CAPABILITY_CHANGEPASSWD) )
  {
    $password = cms_html_entity_decode(trim($params['feu_input_password']));
    $repeat   = cms_html_entity_decode(trim($params['feu_input_repeatpassword']));
    if( $password != $repeat && $password != '')
      {
	$params['error'] = 1;
	$params['message'] = $this->Lang('error_passwordmismatch');
	$this->Redirect($id, 'changesettings', $returnid, $params );
      }
    
    if( $password != '' && !$this->IsValidPassword($password) )
      {
	$params['error'] = 1;
	$params['message'] = $this->Lang('error_invalidpassword');
	$this->Redirect($id, 'changesettings', $returnid, $params );
      }
  }

// get property definitions
$defnsbyname = $this->GetPropertyDefns();

// Get member groups
$groups = $this->GetMemberGroupsArray($uid);

// Get group property relations into a union.
$properties = array();
{
  $tmp = array();
  foreach( $groups as $onegroup )
    {
      $proprelations = $this->GetGroupPropertyRelations( $onegroup['groupid'] );
      $tmp = RRUtils::array_merge_by_name_required( $tmp, $proprelations );
      uasort( $tmp, array('cge_array','compare_elements_by_sortorder_key') );
    }
  $properties = cge_array::to_hash($tmp,'name');
}

$userprops = $this->GetUserProperties($uid);

// do validation of the fields.
foreach( $properties as $propname => $prop )
{
  $fldtype = $defnsbyname[$propname]['type'];
  $required = ($prop['required'] == 2);
  
  switch( $fldtype )
    {
    case '0': /* text */
      if( $required )
	{
	  if( !isset($params['feu_input_'.$propname]) ||
	      empty($params['feu_input_'.$propname]) )
	    {
	      $params['error'] = 1;
	      $params['message'] = $this->Lang('error_requiredfield',$defnsbyname[$propname]['prompt']);
	      $this->Redirect( $id, 'changesettings', $returnid, $params );
	    }
	}
      break;
      
    case '2': /* email */
      if( $required )
	{
	  if( !isset($params['feu_input_'.$propname]) )
	    {
	      $params['error'] = 1;
	      $params['message'] = $this->Lang('error_invalidemailaddress').' '.$result[1];
	      $this->Redirect( $id, 'changesettings', $returnid, $params );
	    }
	  else
	    {
	      $result = $this->IsValidEmailAddress( $params['feu_input_'.$propname], $uid );
	      if( $result[0] == false )
		{
		  $params['error'] = 1;
		  $params['message'] = $this->Lang('error_invalidemailaddress').' '.$result[1];
		  $this->Redirect( $id, 'changesettings', $returnid, $params );
		}
	    }
	}
      break;

    case '3': /* textarea */
      if( $required && !isset($params['feu_input_'.$propname]) )
	{
	  $params['error'] = 1;
	  $params['message'] = $this->Lang('error_requiredfield',$defnsbyname[$propname]['prompt']);
	  $this->Redirect( $id, 'changesettings', $returnid, $params );
	}
      if( $required && empty($params['feu_input_'.$propname]) )
	{
	  $params['error'] = 1;
	  $params['message'] = $this->Lang('error_requiredfield',$defnsbyname[$propname]['prompt']);
	  $this->Redirect( $id, 'changesettings', $returnid, $params );
	}
      break;

    case '5': /* multiselect */
      if( $required && !isset($params['feu_input_'.$propname]) )
	{
	  $params['error'] = 1;
	  $params['message'] = $this->Lang('error_requiredfield',$defnsbyname[$propname]['prompt']);
	  $this->Redirect( $id, 'changesettings', $returnid, $params );
	}
      // encode it into a comma separated list.
      $params['feu_input_'.$propname] = implode(',',$params['feu_input_'.$propname] );
      break;

    case '6': /* image */
      if( isset($params['feu_input_'.$propname.'_clear']) && 
	  $params['feu_input_'.$propname.'_clear'] == 'clear' )
       {
         // we're told to clear an image property, we must also
         // delete the image
         $destDir1 = $gCms->config['uploads_path'].'/';
         $destDir1 .= $this->GetPreference('image_destination_path','feusers').'/';
         $file1 = $destDir1.$params['feu_input_'.$propname];
         @unlink( $file1 );
        
         // unset the hidden param to prevent any further processing
         unset( $params['feu_input_'.$propname] );
       }
      if( $required && 
	  ((!isset($_FILES[$id.'feu_input_'.$propname]) || $_FILES[$id.'feu_input_'.$propname]['size'] == 0) &&
	   (!isset($params['feu_input_'.$propname]) || $params['feu_input_'.$propname] == '')) )
	{
	  // but we can't find a value
	  $params['error'] = 1;
	  $params['message'] = $this->Lang('error_requiredfield',$propname);
	  $this->Redirect( $id, 'changesettings', $returnid, $params );
	}
      break;

    case '8': /* date */
      if( isset($params['feu_input_'.$propname.'Month']) )
	{
	  $params['feu_input_'.$propname] = 
	    mktime(0,0,0,
		   $params['feu_input_'.$propname.'Month'],
		   $params['feu_input_'.$propname.'Day'],
		   $params['feu_input_'.$propname.'Year']);
	  unset($params['feu_input_'.$propname.'Month']);
	  unset($params['feu_input_'.$propname.'Day']);
	  unset($params['feu_input_'.$propname.'Year']);
	}
      if( $required && !isset($params['feu_input_'.$propname]) )
	{
	  $params['error'] = 1;
	  $params['message'] = $this->Lang('error_requiredfield',$propname);
	  $this->Redirect( $id, 'changesettings', $returnid, $params );
	}
      break;
    }
}


//
// now we actually change the user settings
//

// password
if( $password != '')
  {
    $result = $this->SetUser( $uid, $uinfo['username'], $password );
    if( $result[0] == FALSE )
      {
	$params['error'] = 1;
	$params['message'] = $this->Lang('error_problemsettinginfo').' '.$result[1];
	$this->Redirect( $id, 'changesettings', $returnid, $params );
      }
  }

//
// sorry, but changing your settings invalidates too
//
$this->_AttemptInvalidateLoginCookie();

//
// now delete all the properties for this user
// in preparation for setting new ones.
//
$this->SetEncryptionKey($uid);
//$this->DeleteUserPropertyFull( "", $uid, true );
foreach( $params as $key => $val )
{
  if( preg_match( '/password$/', $key ) )
    {
      continue;
    }

  if( preg_match('/_clear$/', $key ) )
    {
      continue;
    }

  if( preg_match( '/^feu_input_/', $key ) )
    {
      $propname = substr( $key, strlen('feu_input_'));
      $required = ($properties[$propname]['name'] == 2);
      $hidden   = ($properties[$propname]['name'] == 3);
      $readonly = ($properties[$propname]['name'] == 4);
      $fldtype  = $defnsbyname[$propname]['type'];
      $force_unique = $defnsbyname[$propname]['force_unique'];

      if( $readonly || $hidden ) continue;

      if( $fldtype == 6 )
	{
	  // image type
	  $val = $params['feu_input_'.$propname];
	  if( isset( $_FILES[$id.'feu_input_'.$propname] ) &&
	      $_FILES[$id.'feu_input_'.$propname]['size'] > 0)
	    {
	      // It is an upload file type
	      $result = $this->ManageImageUpload($id, 'feu_input_', $propname, $uid );
	      if( $result[0] == false )
		{
		  $params['error'] = 1;
		  $params['message'] = $this->Lang('error').'&nbsp;'.$result[1];
		  $this->Redirect( $id, 'changesettings', $returnid, $params );
		}
	      $val = $result[1];
	    }
	}
      else if( isset( $params['feu_input_'.$propname] ) )
	{
	  $val = trim($params['feu_input_'.$propname]);
	  $val = cms_html_entity_decode($val);
	}
      else 
	{
	  continue;
	}

      // check for forced unique values.
      if( $force_unique && !$this->IsUserPropertyValueUnique( $uid, $propname, $val ) )
	{
	  $params['error'] = 1;
	  $params['message'] = $this->Lang('error_user_nonunique_field_value',$propname);
	  $this->Redirect( $id, 'changesettings', $returnid, $params );
	}

      $ret = $this->SetUserPropertyFull( $propname, $val, $uid );
      if( $ret == false )
	{
	  $params['error'] = 1;
	  $params['message'] = $this->Lang('error_settingproperty').' '.$propname;
	  $this->Redirect( $id, 'changesettings', $returnid, $params );
	  return;
	}
    }
}

// send the event
$event_params = array();
$event_params['name'] = $uinfo['username'];
$event_params['id'] = $uid;
$this->SendEvent('OnUpdateUser',$event_params);
$this->_SendNotificationEmail('OnUpdateUser',$event_params);

if( isset( $params['feu_returnto'] ) )
  {
    $page = ContentManager::GetPageIDFromAlias( $params['feu_returnto'] );
    if( $page )
      {
	$this->RedirectContent( $page );
	return;
      }
  }

$page = $this->GetPreference('pageid_afterchangesettings');
if( !empty($page) )
  {
    $smarty->assign('username',$uinfo['username']);
    $smarty->assign('userinfo',$uinfo);
    $groups = $this->GetMemberGroupsArray( $this->LoggedinId() );
    $groupname = $this->GetGroupName( $groups[0]['groupid'] );
    $smarty->assign('group',$groupname);
    $page = $this->ProcessTemplateFromData($page);

    $pageid = ContentManager::GetPageIDFromAlias( $page );
    if( $pageid )
      {
	$returnid = $pageid;
      }
  }

// and redirect back to destination page
$this->RedirectContent( $returnid );
?>
