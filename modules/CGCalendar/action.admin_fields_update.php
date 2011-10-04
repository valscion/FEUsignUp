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
$this->SetCurrentTab('fields');
$db =& $this->GetDb(); /* @var $db ADOConnection */

$ids = $params['field_ids'];
$names = $params['field_names'];
$types = $params['field_types'];
$searchable = $params['field_searchable'];

$num_records = count($ids);
for($i = 0; $i < $num_records; $i++)
{
  // don't trust user input, but do $name later as quote() will add '' to it.
  $field_oldname = $ids[$i];
  $field_newname = $names[$i];
  $field_type = $types[$i];
  $field_searchable = (isset($searchable[$field_oldname]))?$searchable[$field_oldname]:0;

  if( $field_type == 1 || $field_type == 3 )
    {
      // file upload fields are never searchable.
      $field_searchable = 0;
    }

  if($field_oldname == '')
    {
      if($field_newname != '')
	{
	  $this->AdminAddField($field_newname,$field_type,$field_searchable);
	  $message.=$this->Lang("fieldadded")."<br/>";
	}
    }
  else
    {
      if($field_newname == '')
	{
	  $this->AdminDeleteField($field_oldname);
	  $message.=$this->Lang("fielddeleted")."<br/>";
	}
      else
	{
	  $this->AdminUpdateField($field_oldname, $field_newname, $field_type, $field_searchable );
	  $message.=$this->Lang("fieldupdated")."<br/>";
	}
    }
 }

if( $error )
  {
    $this->SetError($error);
  }
else if( $message )
  {
    $this->SetMessage($message);
  }
$this->RedirectToTab($id);
?>
