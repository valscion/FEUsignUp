<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Skeleton (c) 2008 
#      by Robert Allen (akrabat) and
#         Robert Campbell (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow displaying calendars,
#  and management and display of time based events.
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

if( !$this->CheckPermission("Modify Calendar") ) {
	return;
}

$error="";
$message="";

$db =& $this->GetDb(); /* @var $db ADOConnection */
$this->SetCurrentTab('admin_manage_categories');
$ids = $params['category_ids'];
$names = $params['category_names'];
$orders = $params['category_orders'];

$num_records = count($ids);
for($i = 0; $i < $num_records; $i++)
{
  // don't trust user input, but do $name later as quote() will add '' to it.
  $category_id = intval($ids[$i]);
  $category_order = intval($orders[$i]);
  $category_name = $names[$i];
  if($category_id > -1)
    {
      if($category_name == '')
	{
	  $sql = 'DELETE FROM '.$this->events_to_categories_table_name.' WHERE category_id = ?';
	  $db->Execute($sql,array($category_id));
	  $sql = 'DELETE FROM '.$this->categories_table_name.' WHERE category_id = ?';
	  $db->Execute($sql,array($category_id));
	  $this->SendEvent('CategoryDeleted',array('category_id'=>$category_id));
	}
      else
	{
	  $sql = 'SELECT category_id FROM '.$this->categories_table_name.'
                   WHERE category_name = ? AND category_id != ?';
	  $tmp = $db->GetOne($sql,array($category_name,$category_id));
	  if( $tmp )
	    {
	      $error=$this->Lang('error_categoryexists',$category_name);
	    }
	  else
	    {
	      $sql = 'UPDATE '.$this->categories_table_name . "
                     SET category_name = ?, category_order = ?
                   WHERE category_id = ?";
	      $db->Execute($sql,array($category_name,$category_order,$category_id));
	      $this->SendEvent('CategoryDeleted',array('category_id'=>$category_id));
	    }
	}
    }
  else if($category_name != '')
    {
      $sql = 'SELECT category_id FROM '.$this->categories_table_name.'
               WHERE category_name = ?';
      $tmp = $db->GetOne($sql,array($category_name));
      if( $tmp )
	{
	  $error=$this->Lang('error_categoryexists',$category_name);
	}
      else
	{
	  $category_id = $db->GenID($mod->categories_table_name.'_seq');
	  $sql = 'INSERT INTO '.$this->categories_table_name."
                (category_id, category_name, category_order)
              VALUES (?,?,?)";
	  $db->Execute($sql,array($category_id,$category_name,$category_order));
	  $this->SendEvent('CategoryAdded',
			   array('category_id'=>$category_id,
				 'category_name'=>$category_name,
				 'category_order'=>$category_order));
	}
    }
}

$this->RedirectToTab($id,'',array("module_error"=>$error,"module_message"=>$message));
?>
