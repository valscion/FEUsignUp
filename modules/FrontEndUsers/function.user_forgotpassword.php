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

$username = '';
if( isset( $params['input_username'] ) )
  {
    $username = trim( $params['input_username'] );
  }

if( isset( $params['error'] ) )
  {
    $error = html_entity_decode(trim($params['error']));
    $this->smarty->assign('error',$error);
  }
if( isset( $params['message'] ) )
  {
    $message = html_entity_decode(trim($params['message']));
    $this->smarty->assign('message',$message);
  }

if( !isset( $params['skipformdisplay'] ) )
  {
    // setup the template
    $this->smarty->assign('startform',
			  $this->feCreateFormStart( $id, 'do_forgotpw', $returnid ));
    $this->smarty->assign('endform',
			  $this->CreateFormEnd());
    $this->smarty->assign('title',
			  $this->Lang('forgotpw'));
    $this->smarty->assign('lostpw_message',
			  $this->Lang('lostpw_message'));
    $this->smarty->assign('prompt_username',
			  $this->Lang('prompt_username'));
    $this->smarty->assign('input_label',$id);
    $this->smarty->assign('input_username',
			  $this->CreateInputText( $id, 'input_username',
						  $username, 
						  $this->GetPreference('usernamefldlength'), 
						  $this->GetPreference('max_usernamelength')));
    $this->smarty->assign('submit',
			  $this->CreateInputSubmit($id, 'submit',$this->Lang('submit')));
    $this->smarty->assign('cancel',
			  $this->CreateInputSubmit($id, 'cancel',$this->Lang('cancel')));
    if( isset( $params['returnto'] ) )
      {
	$this->smarty->assign('hidden',
			      $this->CreateInputHidden($id,'input_returnto',$params['returnto']));
      }
  }
echo $this->ProcessTemplateFromDatabase( 'feusers_forgotpasswordform' );

// EOF
?>
