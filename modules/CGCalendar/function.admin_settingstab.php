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

global $gCms;

$smarty->assign('startform', $this->CreateFormStart($id, 'admin_settings_update', $returnid, $method='post', $enctype=''));
$smarty->assign('endform', $this->CreateFormEnd());

$smarty->assign('twelvehourtext',$this->Lang('cal_use_twelve_hour_clock'));
$smarty->assign('twelvehourinput',
		$this->CreateInputCheckbox($id,'use_twelve_hour_clock', 1,
		   $this->GetPreference('use_twelve_hour_clock',0)));
					   
$smarty->assign('forcecattext',$this->Lang('force_category'));
$smarty->assign('forcecatinput',$this->CreateInputCheckbox($id, 'force_category', 1, $this->GetPreference('force_category', 0)));
		
$smarty->assign('defcattext',$this->Lang('cal_default_category'));
$categories = $this->GetCategories();
foreach ($categories as $key => $cat)
{
  $list_categories[$cat['category_name']] = $cat['category_id'];
}
$smarty->assign('defcatinput',$this->CreateInputDropdown($id, 'default_category', $list_categories, -1, $this->GetPreference('default_category','')));
		
$years_array=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
$smarty->assign("pastyearstext",$this->Lang("showpastyears"));
$smarty->assign("pastyearsinput",$this->CreateInputDropdown($id, 'showpastyears', $years_array, -1, $this->GetPreference("showpastyears",2)));
		
$smarty->assign("futureyearstext",$this->Lang("showfutureyears"));
$smarty->assign("futureyearsinput",$this->CreateInputDropdown($id, 'showfutureyears', $years_array, -1, $this->GetPreference("showfutureyears",10)));
		
$smarty->assign('hidesummarytext',$this->Lang('hidesummary'));
$smarty->assign('hidesummaryinput',$this->CreateInputCheckbox($id, 'hidesummary', 1, $this->GetPreference('hidesummary', 0)));
		
$smarty->assign('hidecontenttext',$this->Lang('hidecontent'));
$smarty->assign('hidecontentinput',$this->CreateInputCheckbox($id, 'hidecontent', 1, $this->GetPreference('hidecontent', 0)));
		
$contentops =& $gCms->GetContentOperations();
$smarty->assign('defaultcalendarpage_text', $this->Lang('defaultcalendarpage'));
$smarty->assign('defaultcalendarpage_input', $contentops->CreateHierarchyDropdown('', $this->GetPreference('defaultcalendarpage','-1')));

$smarty->assign('uploaddirectory_text',$this->Lang('uploaddirectory'));
$smarty->assign('uploaddirectory_input',$this->CreateInputText($id,'uploaddirectory',
							       $this->GetPreference('uploaddirectory',$config['uploads_path']),
							       30));

$val = $this->GetPreference('uploadfiletypes','jpg,JPG,gif,GIF');
$smarty->assign('uploadfiletypes_text',$this->Lang('uploadfiletypes'));
$smarty->assign('uploadfiletypes_input',$this->CreateInputText($id,'uploadfiletypes',$val, 30));

$val = $this->GetPreference('thumb_width',180);
$smarty->assign('thumb_width_text',$this->Lang('thumb_width'));
$smarty->assign('thumb_width_input',$this->CreateInputText($id,'thumb_width',$val, 5));

$val = $this->GetPreference('thumb_height',180);
$smarty->assign('thumb_height_text',$this->Lang('thumb_height'));
$smarty->assign('thumb_height_input',$this->CreateInputText($id,'thumb_height',$val, 5));

$val = $this->GetPreference('large_width',500);
$smarty->assign('large_width_text',$this->Lang('large_width'));
$smarty->assign('large_width_input',$this->CreateInputText($id,'large_width',$val, 5));

$val = $this->GetPreference('large_height',500);
$smarty->assign('large_height_text',$this->Lang('large_height'));
$smarty->assign('large_height_input',$this->CreateInputText($id,'large_height',$val, 5));

$val = $this->GetPreference('uploadunique',1);
$smarty->assign('uploadunique_text',$this->Lang('uploadunique'));
$smarty->assign('uploadunique_input',
		$this->CreateInputCheckbox($id,'uploadunique', 1, $val));

$smarty->assign('frontend_redirectpage',$this->GetPreference('frontend_redirectpage'));

$policies = array();
$policies['all'] = $this->Lang('policy_all');
$policies['none'] = $this->Lang('policy_none');
$policies['individual'] = $this->Lang('policy_individual');
$smarty->assign('overlap_policies',$policies);
$smarty->assign('overlap_policy',$this->GetPreference('overlap_policy','all'));

$overlap_actions = array();
$overlap_actions['remove'] = $this->Lang('overlap_action_remove');
$overlap_actions['error'] = $this->Lang('overlap_action_error');
$smarty->assign('overlap_actions',$overlap_actions);
$smarty->assign('overlap_action',$this->GetPreference('overlap_action','error'));

$smarty->assign('url_prefix',$this->GetPreference('url_prefix','calendar'));
$smarty->assign('dflt_starttime',$this->GetPreference('dflt_starttime','12:00'));
$smarty->assign('dflt_alldayevent',$this->GetPreference('dflt_alldayevent',0));

$smarty->assign('submit',$this->CreateInputSubmit($id, 'submit', $this->Lang('cal_updatesettings')));

$feu = cge_utils::get_module('FrontEndUsers');
if( $feu )
  {
    $tmp = $feu->GetGroupList();
    $tmp = cge_array::hash_prepend($tmp,$this->Lang('none'),-1);
    $smarty->assign('grouplist',array_flip($tmp));
    $smarty->assign('frontend_group',$this->GetPreference('frontend_group',-1));
  }
echo $this->ProcessTemplate('settings.tpl');

// EOF
?>