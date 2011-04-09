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

  // this tab has merely one mofo list of uses and the ability to edit them, 
  // see details about them, and then delete them
  // maybe send an email to them too if I get around to it that is.

  if( $this->_HasSufficientPermissions('listusers') )
    {
      // bulk action stuff
      if( isset( $params['bulkdelete']) )
	{
	  if( isset($params['selected']) && is_array($params['selected']) )
	    {
	      $sel = serialize($params['selected']);
	      $this->myRedirect( $id, 'admin_bulkactions', $returnid,
				 array('job'=>'delete',
				       'uids'=>$sel));
	    }
	}

      // filtering stuff
      if( isset( $params['filter']) )
	{
	  if( isset( $params['filter_group'] ) )
	    {
	      $this->SetPreference('current_group', $params['filter_group'] );
	    }
	  if( isset( $params['filter_regex'] ) )
	    {
	      $this->SetPreference('current_regex', $params['filter_regex'] );
	    }
	  if( isset( $params['filter_loggedinonly'] ) )
	    {
	      $this->SetPreference('current_loggedinonly', $params['filter_loggedinonly'] );
	    }
	  else
	  {
	    $this->SetPreference('current_loggedinonly', 0);
	  }
	  if( isset( $params['filter_limit'] ) )
	    {
	      $this->SetPreference('current_limit', $params['filter_limit'] );
	    }
	  if( isset( $params['filter_sortby'] ) )
	    {
	      $this->SetPreference('current_sort', $params['filter_sortby'] );
	    }
	  if( isset( $params['filter_propertysel'] ) )
	    {
	      $this->SetPreference('current_propsel', $params['filter_propertysel'] );
	    }
	  if( isset( $params['filter_propertysel'] ) )
	    {
	      $this->SetPreference('current_propval', $params['filter_property'] );
	    }
	}
      $curgroup = $this->GetPreference('current_group', '');
      $curregex = $this->GetPreference('current_regex', '');
	  $currloggedinonly = $this->GetPreference('current_loggedinonly', 0);
      $curlimit = $this->GetPreference('current_limit', 100);
      $cursort  = $this->GetPreference('current_sort', '');
      $curpropsel = $this->GetPreference('current_propsel', 'none');
      $curpropval = $this->GetPreference('current_propval', ''); 
	
      // get a group list for the filter
      // it should be ready to go right into the dropdown (cool eh)
      $groups1 = $this->GetGroupList();
      $groups = array_merge( array("All Groups" => -1), $groups1 );
	
      // a pulldown list for limits
      $limits = array( '100' => 100,
		       '10' => 10,
		       '25' => 25,
		       '50' => 50,
		       '250' => 250,
		       '500' => 500 );

      // a pulldown list for property definitions
      $defns1 = $this->GetPropertyDefns();
      $defns = array();
      $defns['None'] = 'none';
      if( is_array($defns1) )
	{
	  foreach( $defns1 as $def )
	    {
	      $defns[$def['prompt']] = $def['name'];
	    }
	}
	
      // a pulldown list for sorting
      $sorts = array ('Username' => 'username',
		      'Username (descending)' => 'username desc',
		      'Create Date' => 'createdate',
		      'Create Date (descending)' => 'createdate desc',
		      'Expiry Date' => 'expires',
		      'Expiry Date (descending)' => 'expires desc');
      // now setup the template fields
      $smarty->assign( 'prompt_filter', $this->Lang('filter'));
      $smarty->assign( 'prompt_sort', $this->Lang('sort'));
      $smarty->assign( 'startform',
			       $this->CreateFormStart( $id, 'defaultadmin'));
      $smarty->assign( 'perm_removeusers',
		       $this->_HasSufficientPermissions('removeusers')?1:0);
      $smarty->assign( 'prompt_group', $this->Lang('group'));
      $smarty->assign( 'usersfound', $this->Lang('usersfound'));
      $smarty->assign( 'usersingroup', $this->Lang('usersingroup'));
      $smarty->assign( 'filter_group',
			       $this->CreateInputDropDown( $id, 'filter_group', $groups, -1,
							     $curgroup));
      $smarty->assign( 'prompt_userfilter', $this->Lang('userfilter'));
      $smarty->assign( 'filter_regex', 
			       $this->CreateInputText( $id, 'filter_regex',
							 $curregex, 20, 20 ));

      $smarty->assign( 'prompt_propertyfiltersel',$this->Lang('propertyfilter'));
      $smarty->assign( 'filter_propertysel',
			       $this->CreateInputDropDown( $id, 'filter_propertysel',
							     $defns, -1, $curpropsel ));
      $smarty->assign( 'prompt_propertyfilter',$this->Lang('valueregex'));
      $smarty->assign( 'filter_property',
			       $this->CreateInputText( $id, 'filter_property',
							 $curpropval, 20, 20 ));

	  $smarty->assign( 'prompt_loggedinonly',
					   $this->Lang('prompt_loggedinonly'));
	  $smarty->assign( 'filter_loggedinonly',
					   $this->CreateInputCheckbox($id,'filter_loggedinonly',
												  1,$currloggedinonly));
      $smarty->assign( 'prompt_limit',
			       $this->Lang('userlimit'));
      $smarty->assign( 'filter_limit',
			       $this->CreateInputDropDown( $id, 'filter_limit', $limits, -1,
							     $curlimit));
      $smarty->assign( 'prompt_sortby',
			       $this->Lang('sortby'));
      $smarty->assign( 'filter_sortby',
			       $this->CreateInputDropDown( $id, 'filter_sortby', $sorts, -1,
							     $cursort));

      $smarty->assign('input_select',
			      $this->CreateInputSubmit( $id, 'filter',
							  $this->Lang('applyfilter')));
      $smarty->assign('input_hidden',
			      $this->CreateInputHidden( $id, 'cg_activetab', 'users')
			      );
      $smarty->assign ('endform', $this->CreateFormEnd ());


      $users = $this->GetUsersInGroup( $curgroup, $curregex, $curlimit, $cursort,
				       $curpropsel, $curpropval, $currloggedinonly );
      if( !is_array($users) )
	{
	  // an error occurred
	  $db =& $this->GetDb();
	  $this->_DisplayErrorPage ($id, $params, $returnid,
				      $db->ErrorMsg() );
// 	  return;
	}

      // get the total number of users
      $numusers = $this->CountUsersInGroup( $curgroup );

      $rowarray = array();
      $rowclass = "row1";
      global $gCms;
      $smarty->assign('numusers', $numusers );
      if( $this->GetPreference('username_is_email') )
	{
	  $smarty->assign('usernametext', $this->Lang('prompt_email'));
	}
      else
	{
	  $smarty->assign('usernametext', $this->Lang('username'));
	}
      $smarty->assign('emailtext', $this->Lang('email'));
      $smarty->assign('statustext', $this->Lang('status'));
      $smarty->assign('createdtext', $this->Lang('created'));
      $smarty->assign('expirestext', $this->Lang('expires'));
      if( is_array($users) )
	{
	  foreach( $users as $row )
	    {
	      $onerow = new StdClass();
	      $onerow->rowclass = $rowclass;
	      $onerow->id = $row['id'];
	      $onerow->created  = $row['createdate'];
	      $onerow->username = $this->CreateLink($id, 'edituser', $returnid, $row['username'],
						      array('user_id' => $row['id']));
	      $onerow->expires  = $row['expires'];
	      if( $this->_HasSufficientPermissions('listusers') )
		{
		  $onerow->historylink =
		    $this->CreateLink ($id, 'userhistory', $returnid,
				       $gCms->variables['admintheme']->DisplayImage('icons/system/info.gif',
										$this->Lang('history'),'','','systemicon'),
				       array('user_id'=>$row['id']));
		}

	      if( $this->_HasSufficientPermissions('editusers') )
		{
		  $onerow->editlink =
		    $this->CreateLink ($id, 'edituser', $returnid,
				       $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif',
										    $this->Lang ('edit'), '', '', 'systemicon'),
				       array ('user_id' => $row['id'] ));
		  if( $row['loggedin'] )
			  {
				  $onerow->logoutlink =
					  $this->CreateLink ($id,'admin_logout',$returnid,
								 $gCms->variables['admintheme']->DisplayImage('icons/system/back.gif',
								 $this->Lang('prompt_logout'),'','','systemicon'),
						array('user_id'=>$row['id']));
			  }

		}
	      
	      if( $this->_HasSufficientPermissions('removeusers') )
		{
		  $onerow->deletelink = 
		    $this->CreateLink ($id,'do_deleteuser',$returnid,
				       $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif',
										    $this->Lang ('delete'), '', '', 'systemicon'),
				       array ('user_id' => $row['id']),
				       $this->Lang ('areyousure'));
		}
	      
	      $rowarray[] = $onerow;
	      ($rowclass == "row1" ? $rowclass = "row2" : $rowclass = "row1");
	    }
	}

      $smarty->assign('items',$rowarray);
      $smarty->assign('itemcount', count($rowarray));
    }

  if( $this->_HasSufficientPermissions('adduser') )
    {
      if( $this->GetPreference('require_onegroup') == 0 ||
	  count($groups1) > 0 )
	{
	  $smarty->assign('addlink', 
			  $this->CreateLink($id,'adduser',$returnid,
					    $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif',
											 $this->Lang('adduser'),'','','systemicon'),
					    array(), '', false, false, '').' '.
			  $this->CreateLink( $id, 'adduser',
					     $returnid,
					     $this->Lang('adduser'),
					     array(), '', false,
					     false,
					     'class="pageoptions"'));
	}
      else
	{
	  $smarty->assign('addlink',
				  $this->Lang('nogroups'));
	}
    }

  echo $this->ProcessTemplate( 'userlist.tpl' );

// EOF
?>
