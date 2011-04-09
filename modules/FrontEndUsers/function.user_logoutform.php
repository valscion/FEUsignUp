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
    if( $consumer->has_capability(feu_auth_consumer::CAPABILITY_LOGOUT) )
      {
	// the consumer provides the login capabilities
	$consumer->get_logout_display($id,$returnid,$params);
      }
    else
      {
	return;
      }
  }
else
  {
    // do the default
    $uid = $this->LoggedInId();
    if( !$uid ) return;
    $username = $this->LoggedInName();

    $cge = $this->GetModuleInstance('CGExtensions');
    if( $cge && isset($params['returnlast']) )
      {
	$this_url = cge_url::current_url();
	$_SESSION['feu_prelogout_url'] = $this_url;
	$smarty->assign('feu_prelogout_url',$this_url);
      }

    // replace {$groupname} with the first groupname we can find that matches
    $groups = $this->GetMemberGroupsArray( $uid );
    $groupname = $this->GetGroupName( $groups[0]['groupid'] );

    $this->smarty->assign('prompt_loggedin',
			  $this->Lang('msg_currentlyloggedinas'));
    $this->smarty->assign('userid', $uid);
    $this->smarty->assign('username', $username);

    $this->smarty->assign('link_logout',
			  $this->CreateFrontendLink($id,$returnid,"logout",
						    $this->Lang('logout')));
   //nuno-dev-Pretty Url's
	$prettyurl_logout = 'feu/logout/'.$returnid;
	$logout_feu = $this->CreateLink($id, 'logout', $returnid,  '',
				    array(), '', true, false, '', false, $prettyurl_logout);
	
	$this->smarty->assign('url_logout', $logout_feu);
	//end

    $parms = array();
    $parms['form'] = 'changesettings';
    $parms['returnto'] = $returnid;
    if( isset($params['lang']) )
    {
      $parms['lang'] = $params['lang'];
    }

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
			      $this->CreateLink( $id, 'default', $pageid,
						 $this->Lang('prompt_changesettings'),
						 $parms));
	$changesettings_feu = $this->CreateLink($id, 'default', $pageid,  '',
						$parms, '',
						true, false, '', false);
	
	$this->smarty->assign('url_changesettings',$changesettings_feu);
	//end
      }
    }
    else
    {
       $this->smarty->assign('link_changesettings',
			  $this->CreateLink($id,'default',$returnid,
					    $this->Lang('prompt_changesettings'),
					    $parms));
	$changesettings_feu = $this->CreateLink($id, 'default', $returnid,  '',
						$parms, '',
						true, false, '', false);
	
	$this->smarty->assign('url_changesettings',$changesettings_feu);
    }
    $props = $this->GetUserProperties( $this->LoggedInId() );
    if( $props !== false )
      {
	foreach( $props as $p )
	  {
	    $this->smarty->assign($p['title'],$p['data']);
	  }
      }
    echo $this->ProcessTemplateFromDatabase('feusers_logoutform');
  }
#
# EOF
#
?>