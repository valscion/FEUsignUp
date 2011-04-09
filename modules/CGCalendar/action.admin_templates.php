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
if( !isset($gCms) ) exit;
if( !$this->CheckPermission('Modify Templates') ) return;

echo '<div class="pageoverflow" style="text-align: right; width: 80%;">'.
$this->CreateImageLink($id,'defaultadmin',$returnid,
		       $this->Lang('lbl_back'),'icons/system/back.gif',array(),'','',false).'</div><br/>';

echo $this->StartTabHeaders();
echo $this->SetTabHeader('admin_calendar_template', $this->Lang('cal_calendar_template'));
echo $this->SetTabHeader('admin_list_template', $this->Lang('cal_list_template'));
echo $this->SetTabHeader('admin_upcominglist_template', $this->Lang('cal_upcominglist_template'));
echo $this->SetTabHeader('admin_event_template', $this->Lang('cal_event_template'));
echo $this->SetTabHeader('admin_search_form_templates', $this->Lang('cal_search_form_templates'));
echo $this->SetTabHeader('admin_search_result_templates', $this->Lang('cal_search_result_templates'));
echo $this->SetTabHeader('admin_myevents_templates',$this->Lang('cal_myevents_templates'));
echo $this->SetTabHeader('admin_editevent_templates',$this->Lang('cal_editevent_templates'));
echo $this->SetTabHeader('admin_default_templates', $this->Lang('cal_default_templates'));
echo $this->EndTabHeaders();

echo $this->StartTabContent();
echo $this->StartTab("admin_calendar_template",$params);
include(dirname(__FILE__).'/function.admin_calendar_template_tab.php');
echo $this->EndTab();

echo $this->StartTab("admin_list_template",$params);
include(dirname(__FILE__).'/function.admin_list_template_tab.php');
echo $this->EndTab();

echo $this->StartTab("admin_upcominglist_template",$params);
include(dirname(__FILE__).'/function.admin_upcominglist_template_tab.php');
echo $this->EndTab();

echo $this->StartTab("admin_event_template",$params);
include(dirname(__FILE__).'/function.admin_event_template_tab.php');
echo $this->EndTab();

echo $this->StartTab("admin_search_form_templates",$params);
include(dirname(__FILE__).'/function.admin_search_templates_tab.php');
echo $this->EndTab();

echo $this->StartTab("admin_search_result_templates",$params);
include(dirname(__FILE__).'/function.admin_search_result_templates_tab.php');
echo $this->EndTab();

echo $this->StartTab("admin_myevents_templates",$params);
include(dirname(__FILE__).'/function.admin_myevents_templates_tab.php');
echo $this->EndTab();

echo $this->StartTab("admin_editevent_templates",$params);
include(dirname(__FILE__).'/function.admin_editevent_templates_tab.php');
echo $this->EndTab();

echo $this->StartTab("admin_default_templates",$params);
include(dirname(__FILE__).'/function.admin_default_templates_tab.php');
echo $this->EndTab();
echo $this->EndTabContent();
#
# EOF
#
?>