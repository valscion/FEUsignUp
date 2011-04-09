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

$changepasswd = TRUE;
if( !feu_utils::using_std_consumer() )
  {
    $consumer = feu_utils::get_auth_consumer();
    $changepasswd = $consumer->has_capability(feu_auth_consumer::CAPABILITY_CHANGEPASSWD);

    if( $consumer->has_capability(feu_auth_consumer::CAPABILITY_CHANGESETTINGS) )
      {
	// the consumer provides the login capabilities
	echo $consumer->get_changesettings_display($id,$returnid,$params);
	return;
      }
    else if( $consumer->has_capability(feu_auth_consumer::CAPABILITY_USESTDCHANGESETTINGS) )
      {
	// we're gonna use this form.
      }
    else
      {
	return;
      }
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

if( isset( $params['error'] ) )
  {
    $this->smarty->assign('error', $params['error'] );
  }
if( isset( $params['message'] ) )
  {
    $this->smarty->assign('message', $params['message'] );
  }

// get the users member groups
$groups = $this->GetMemberGroupsArray( $uid );
if( !$groups )
  {
    // this user is not a member of any gruops...
    // handle this later todo
    $this->_DisplayErrorPage( $id, $params, $returnid, 
			      $this->Lang('error_nogroups'));
    return;
  }

// now we have the groups, we build a union of all of the groups properties
$properties = array();
foreach( $groups as $grprecord )
{
  $gid = $grprecord['groupid'];
  $proprelations = $this->GetGroupPropertyRelations( $gid );
  $properties = RRUtils::array_merge_by_name_required( $properties, $proprelations );
  uasort( $properties, 
	  array('cge_array','compare_elements_by_sortorder_key') );
}

if( count($properties) == 0 )
  {
    if( $this->GetPreference('require_onegroup') == 1 )
      {
	// this user is not a member of any gruops...
	// handle this later todo
	$this->_DisplayErrorPage( $id, $params, $returnid, 
				  $this->Lang('error_onegrouprequired'));
	return;
      }
  }


// now we're ready to populate the template
// first we put in stuff that is required (username, password, etc, etc)
$rowarray = array();

// make sure username is in there
// we can hide it in the template.
$val = $uinfo['username'];
$onerow = new StdClass();
$onerow->name = 'username';
$onerow->type = 0;
$onerow->color = $this->GetPreference('required_field_color','blue');
$onerow->marker = $this->GetPreference('required_field_marker','*');
$onerow->required = 1;
if ($this->GetPreference('username_is_email'))
  {
  $onerow->prompt = $this->Lang('prompt_email');
  }
 else
  {
  $onerow->prompt = $this->Lang('prompt_username');
  }
$onerow->control =$this->CreateInputText($id, 'feu_input_username', $val,
					 $this->GetPreference('usernamefldlength'),
					 $this->GetPreference('max_usernamelength'),
					 'disabled="disabled"');
$rowarray[$onerow->name] = $onerow;

if( $changepasswd )
  {
    // and password
    $val = '';
    if( isset( $params['feu_input_password'] ) )
      $val = $params['feu_input_password'];
    $onerow = new StdClass();
    $onerow->name = 'password';
    $onerow->type = 0;
    $onerow->color = $this->GetPreference('required_field_color','blue');
    $onerow->marker = $this->GetPreference('required_field_marker','*');
    $onerow->required = 1;
    $onerow->prompt = $this->Lang('password');
    $onerow->control =$this->CreateInputPassword($id, 'feu_input_password', $val,
						 $this->GetPreference('passwordfldlength'),
						 $this->GetPreference('max_passwordlength'));
    $onerow->addtext =$this->Lang('info_emptypasswordfield');
    $rowarray[$onerow->name] = $onerow;
    
    // and make him repeat the password
    $val = '';
    if( isset( $params['feu_input_repeatpassword'] ) )
      $val = $params['feu_input_repeatpassword'];
    $onerow = new StdClass();
    $onerow->name = 'repeat_password';
    $onerow->type = 0;
    $onerow->color = $this->GetPreference('required_field_color','blue');
    $onerow->marker = $this->GetPreference('required_field_marker','*');
    $onerow->required = 1;
    $onerow->prompt = $this->Lang('repeatpassword');
    $onerow->control =$this->CreateInputPassword($id, 'feu_input_repeatpassword', 
						 $val, 
						 $this->GetPreference('passwordfldlength'),
						 $this->GetPreference('max_passwordlength'));
    $onerow->addtext =$this->Lang('info_emptypasswordfield');
    $rowarray[$onerow->name] = $onerow;
  }
        
// now for the properties
$this->SetEncryptionKey($uid);
foreach( $properties as $prop )
{
  // get the property definition
  $defn = $this->GetPropertyDefn( $prop['name'] );
  $val = $this->GetUserPropertyFull( $prop['name'], $uid );

  $readonlytext = '';
  if( $prop['required'] == 4 )
    {
      $readonlytext='readonly="readonly"';
      if( $defn['type'] == 4 || $defn['type'] == 5 )
	{
	  $readonlytext='disabled="disabled"';
	}
    }
  $classname = $prop['name'];
  $addtext = $readonlytext;

  $onerow = new StdClass(); 

  // Handle hidden fields differently
  $onerow->name     = 'input_'.$prop['name'];
  $onerow->id       = $id.$onerow->name;
  if( $prop['required'] == 3 )
    {
      $onerow->control = $this->CreateInputHidden( $id, 'feu_input_'.$prop['name'],$val);								   				   
      $rowarray[$onerow->name] = $onerow;
      continue;
    }

  $color = '';
  $marker = '';
  if( $defn['encrypt'] )
    {
      $color = $this->GetPreference('secure_field_color','yellow');
      $marker = $this->GetPreference('secure_field_marker','^^');
    }
  if( $prop['required'] == 2 ) $color = $this->GetPreference('required_field_color','blue');
  if( $prop['required'] == 2 ) $marker = $this->GetPreference('required_field_marker','*');

  $onerow->required = ($prop['required'] == 2);
  $onerow->status   = $prop['required'];
  $onerow->type = $defn['type'];
  $onerow->color    = $color;
  $onerow->marker   = $marker;
  $onerow->classname = $classname;

  //Added by Silmarillion
  if (isset($params['feu_'.$onerow->name])) {
    $val=$params['feu_'.$onerow->name];
  }


  switch( $defn['type'] )
    {
    case 0: // text
      $onerow->control = $this->CreateInputText( $id, 'feu_'.$onerow->name,
						 $val, $defn['length'], 
						 $defn['maxlength'],
						 $addtext);
      break;

    case 1: // checkbox
      $onerow->control  = $this->CreateInputHidden($id,'feu_'.$onerow->name,0);
      $onerow->control  .= RRUtils::myCreateInputCheckbox( $id, 
							 'feu_'.$onerow->name,
							 1, $val,
							 $addtext);
      break;

    case 2: // email
      $onerow->control = $this->CreateInputText( $id, 'feu_'.$onerow->name,
						 $val, $defn['length'], 
						 $defn['maxlength'],
						 $addtext);
      break;

    case 3: // textarea
      $flag = false;
      if( isset($defn['attribs']) && !empty($defn['attribs']) )
	{
	  $attribs = unserialize($defn['attribs']);
	  if( is_array($attribs) && isset($attribs['wysiwyg']) )
	    {
	      $flag = $attribs['wysiwyg'];
	    }
	}
      $onerow->control = $this->CreateTextArea($flag, $id, $val, 
					       'feu_'.$onerow->name);
      break;

    case 4: // dropdown
      $onerow->control = $this->CreateInputDropdown(
						    $id, 
						    'feu_'.$onerow->name,
						    $this->GetSelectOptions($defn['name'], 1), 
						    -1, 
						    $val,
						    $addtext);
      break;

    case 5: // multiselect
      {
	$selected = explode(',',$val);
	$onerow->control = $this->CreateInputSelectList(
							$id, 
							'feu_'.$onerow->name.'[]', 
							$this->GetSelectOptions($defn['name'], 1), 
							$selected,
							$defn['length'],
							$addtext);
	break;
      }

    case 6: // image
      {
	global $gCms;
	$destDir1 = $gCms->config['uploads_path'].DIRECTORY_SEPARATOR;
	$destDir1 .= $this->GetPreference('image_destination_path','feusers').DIRECTORY_SEPARATOR;
	$destDir2 = $gCms->config['uploads_url'].DIRECTORY_SEPARATOR;
	$destDir2 .= $this->GetPreference('image_destination_path','feusers').DIRECTORY_SEPARATOR;
	$file1 = $destDir1.$val;
	$file2 = $destDir2.$val;
	if( is_readable( $file1 ) && is_file($file1) )
	  {
	    $onerow->image = '<img src="'.$file2.'" alt="'.$val.'"/>';
	    if( !$onerow->required )
	      {
		$onerow->prompt2 = $this->Lang('prompt_clear');
		$onerow->control2 = $this->CreateInputCheckbox($id,
							       'feu_'.$onerow->name.'_clear',
							       'clear','');
	      }
	  }
	$onerow->control = $this->CreateInputHidden($id,'feu_'.$onerow->name,$val).
	  $this->CreateFileUploadInput($id,'feu_'.$onerow->name, '', $defn['length']);
	break;
      }

    case '7': // radio group
      {
	$onerow->control = $this->CreateInputRadioGroup($id, 'feu_'.$onerow->name,
							$this->GetSelectOptions($defn['name'],1),
							$val, '', '<br/>');
	    
      }
      break;

    case '8': // date
      {
	if( $prop['required'] == 4 )
	  {
	    // Read only
	    $onerow->control = $this->CreateInputHidden( $id, 'feu_input_'.$prop['name'],$val);
	    $this->smarty->assign('val',$val);
	    $onerow->control .= $this->ProcessTemplateFromData('{$val|cms_date_format}');
	  }
	else
	  {
	    $parms = array();
	    $parms['prefix'] = $id.'feu_'.$onerow->name;
	    if( $val )  $parms['time'] = $val;
	    $parms['start_year'] = "-5";
	    $parms['end_year'] = "+10";
	    
	    if( isset($defn['attribs']) && !empty($defn['attribs']) )
	      {
		$attribs = unserialize($defn['attribs']);
		if( isset($attribs['startyear']) && !empty($attribs['startyear']) )
		  {
		    $parms['start_year'] = $attribs['startyear'];
		  }
		if( isset($attribs['endyear']) && !empty($attribs['endyear']) )
		  {
		    $parms['end_year'] = $attribs['endyear'];
		  }
	      }
	    
	    $str = '{html_select_date ';
	    foreach( $parms as $key=>$value )
	      {
		$str.=$key.'="'.$value.'" ';
	      }
	    $str .= '}';
	    $onerow->control = $this->ProcessTemplateFromData($str);
	  }
      }
      break;
    }
  $onerow->labelfor = $id.$prop['name'];
  $onerow->type = $defn['type'];
  $onerow->length = $defn['length'];
  $onerow->maxlength = $defn['maxlength'];
  $onerow->prompt = $defn['prompt'];
  $rowarray[$prop['name']] = $onerow;
}

// fill in the variables for the template
$this->smarty->assign('title',$this->Lang('user_settings'));
$this->smarty->assign('startform',
		      $this->feCreateFormStart($id,'do_userchangesettings',
					       $returnid, true, 'post', 
					       'multipart/form-data' ));
$this->smarty->assign('endform',
		      $this->CreateFormEnd());
$this->smarty->assign('submit',
		      $this->CreateInputSubmit($id, 'feu_submit',$this->Lang('submit')));
$this->smarty->assign('cancel',
		      $this->CreateInputSubmit($id, 'feu_cancel',$this->Lang('cancel')));

if( isset( $params['returnto'] ) )
  {
    $this->smarty->assign('hidden',
			  $this->CreateInputHidden($id,'feu_returnto',$params['returnto']));
  }
$this->smarty->assign('formid',$id);
$this->smarty->assign('controls', $rowarray);
$this->smarty->assign('controlcount', count($rowarray));

echo $this->ProcessTemplateFromDatabase('feusers_changesettingsform');

// EOF
?>
