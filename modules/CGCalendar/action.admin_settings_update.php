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
if ($this->AllowAccess('Modify Site Preferences')) {
  $submit = get_parameter_value($params, 'submit');
  if($submit != '') {

    $this->SetCurrentTab('admin_manage_settings');

    $use_twelve_hour_clock = get_parameter_value($params,'use_twelve_hour_clock');
    $force_category = get_parameter_value($params, 'force_category');
    $showpastyears = get_parameter_value($params, 'showpastyears');
    $showfutureyears = get_parameter_value($params, 'showfutureyears');
    $default_category = get_parameter_value($params, 'default_category');
    $hidesummary = get_parameter_value($params, 'hidesummary',0);
    $hidecontent = get_parameter_value($params, 'hidecontent',0);
    $uploaddirectory = get_parameter_value($params, 'uploaddirectory');
    $uploadfiletypes = get_parameter_value($params, 'uploadfiletypes');
    $uploadunique = get_parameter_value($params, 'uploadunique');
    $thumb_width = get_parameter_value($params, 'thumb_width');
    $thumb_height = get_parameter_value($params, 'thumb_height');
    $large_width = get_parameter_value($params, 'large_width');
    $large_height = get_parameter_value($params, 'large_height');
    $overlap_policy = get_parameter_value($params, 'overlap_policy');
    $overlap_action = get_parameter_value($params, 'overlap_action');
    $frontend_redirectpage = get_parameter_value($params, 'frontend_redirectpage');

    $this->SetPreference('overlap_policy',$overlap_policy);
    $this->SetPreference('overlap_action',$overlap_action);
    $this->SetPreference('use_twelve_hour_clock', $use_twelve_hour_clock);
    $this->SetPreference('defaultcalendarpage', $_POST['parent_id']);
    $this->SetPreference('default_category', $default_category);
    $this->SetPreference('force_category', $force_category);
    $this->SetPreference('showpastyears', $showpastyears);
    $this->SetPreference('showfutureyears', $showfutureyears);
    $this->SetPreference('hidesummary', $hidesummary);
    $this->SetPreference('hidecontent', $hidecontent);
    $this->SetPreference('uploaddirectory', $uploaddirectory);
    $this->SetPreference('uploadfiletypes', $uploadfiletypes);
    $this->SetPreference('uploadunique', $uploadunique);
    
    $this->SetPreference('thumb_width', $thumb_width);
    $this->SetPreference('thumb_height', $thumb_height);
    $this->SetPreference('large_width', $large_width);
    $this->SetPreference('large_height', $large_height);

    $this->SetPreference('url_prefix',get_parameter_value($params,'url_prefix','calendar'));
    $this->SetPreference('dflt_alldayevent',get_parameter_value($params,'dflt_alldayevent',0));
    $start_time = '';
    $start_time = get_parameter_value($params,'dflt_starttime_Hour',12).':'.get_parameter_value($params,'dflt_starttime_Minute',00);
    $this->SetPreference('dflt_starttime',$start_time);

    if( isset($params['frontend_group']) )
      {
	$this->SetPreference('frontend_group',$params['frontend_group']);
      }
    $this->SetPreference('frontend_redirectpage',$frontend_redirectpage);
  }

  $this->RedirectToTab($id);
}
?>