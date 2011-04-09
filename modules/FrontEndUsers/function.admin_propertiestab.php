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

  $message = '';
  if( isset( $params['message'] ) )
    {
      $this->smarty->assign('message', $message);
    }

  $this->smarty->assign('title',$this->Lang('properties'));

  $rowarray = array();
  $rowclass = 'row1';
  $keys = array_keys($this->types);

  $defns = $this->GetPropertyDefns();
  if( is_array($defns) ) {
    foreach( $defns as $defn )
      {
	$propgroups = $this->GetPropertyGroupRelations($defn['name']);

	$onerow = new StdClass();
	if( $this->_HasSufficientPermissions('editprop')) 
	  {
	    $onerow->name = 
	      $this->CreateLink( $id, 'addprop', $returnid, $defn['name'],
				 array('propname' => $defn['name']));
	  }
	else
	  {
	    $onerow->name = $defn['name'];
	  }
	$onerow->prompt = $defn['prompt'];
	$onerow->type = $this->Lang($keys[$defn['type']]);
	$onerow->length = $defn['length'];
	$onerow->force_unique = $defn['force_unique'];
	$onerow->rowclass = $rowclass;

	if( $this->_HasSufficientPermissions('editprop'))
	  {
	    $onerow->editlink =
	      $this->CreateLink ($id, 'addprop', $returnid,
				 $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif',
									      $this->Lang ('edit'), '', '', 'systemicon'),
				 array('propname' => $defn['name']));

	    if( count($propgroups) == 0 )
	      {
		$onerow->deletelink =
		  $this->CreateLink ($id, 'do_deleteprop', $returnid,
				     $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif',
										  $this->Lang ('delete'), '', '', 'systemicon'),
				     array('propname' => $defn['name'], 'proptype' => $defn['type']), 
				     $this->Lang('confirm_delete_prop'));
	      }
	  }

	$rowarray[] = $onerow;
	($rowclass == "row1" ? $rowclass = "row2" : $rowclass = "row1");
      }
  }

  $this->smarty->assign('nametext',$this->Lang('name'));
  $this->smarty->assign('lengthtext',$this->Lang('length'));
  $this->smarty->assign('prompttext',$this->Lang('prompt'));
  $this->smarty->assign('typetext',$this->Lang('prompt_type'));
  $this->smarty->assign('props',$rowarray);
  $this->smarty->assign('propcount', count($rowarray));
  $this->smarty->assign('propsfound',$this->Lang('propsfound'));

  if( $this->_HasSufficientPermissions('addprop') )
    {
      // todo, add a permission check around this
      // maybe create an "edit frontenduser properties" permission
      $this->smarty->assign('addlink', 
			    $this->CreateLink($id,'addprop',$returnid,
					      $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif',
											   $this->Lang('addprop'),'','','systemicon'),
					      array(), '', false, false, '').' '.
			    $this->CreateLink( $id, 'addprop',
					       $returnid,
					       $this->Lang('addprop'),
					       array(), '', false,
					       false,
					       'class="pageoptions"'));
    }


  echo $this->ProcessTemplate('propertiesform.tpl');

// EOF
?>
