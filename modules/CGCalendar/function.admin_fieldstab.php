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

  // NOTE: this should use a template, rather than hardcoding the html

$db =& $this->GetDb(); /* @var $db ADOConnection */
$fields = $this->GetFields();
$num_fields = count($fields);

$smarty->assign('formstart',
		$this->CreateFormStart($id, 'admin_fields_update', $returnid, 
				       $method='post', $enctype=''));
$smarty->assign('formend',$this->CreateFormEnd());
$smarty->assign('submit',$this->CreateInputSubmit($id,'',$this->Lang('cal_update_fields')));

$fields[$num_fields]['field_name'] = '';
$fields[$num_fields]['field_type'] = 0;
$fields[$num_fields]['field_searchable'] = 0;
$num_fields ++;

$types = array();
$types[$this->Lang('textfield')] = 0;
$types[$this->Lang('uploadfield')] = 1;
$types[$this->Lang('textarea')] = 2;
$cdmod = cms_utils::get_module('CompanyDirectory');
if( is_object($cdmod) )
  {
    $types[$this->Lang('cd_company')] = 3;
  }

$fieldsarr = array();
for($i = 0; $i < $num_fields; $i++)
  {
    $field = $fields[$i];
    $field_name = $field['field_name'];
    $field_type = $field['field_type'];
    $field_searchable = $field['field_searchable'];
    
    $obj = new StdClass();
    $obj->hidden = $this->CreateInputHidden($id, 'field_ids[]', $field_name);
    $obj->name = $this->CreateInputText($id, 'field_names[]', $field_name, 25);
    $obj->type = $this->CreateInputDropdown($id, 'field_types[]', $types, $field_type );
    if( $field_type != 1 )
      {
	// only for non file fields.
	$obj->searchable = $this->CreateInputCheckbox($id,'field_searchable['.$field_name.']',1,$field_searchable);
      }
    else
      {
	$obj->searchable = $this->CreateInputHidden($id,'field_searchable['.$field_name.']',0);
      }
    $fieldsarr[] = $obj;
  }
$smarty->assign('typetext',$this->Lang('type'));
$smarty->assign('nametext',$this->Lang('name'));
$smarty->assign('fields',$fieldsarr);
echo $this->ProcessTemplate('fieldstab.tpl');

// EOF
?>