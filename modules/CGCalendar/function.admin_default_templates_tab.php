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

# System Default Resource Calendar Template
echo $this->GetDefaultTemplateForm($this,$id,$returnid,
                                   CGCALENDAR_PREF_NEWCALENDAR_TEMPLATE,
                                   'admin_templates', 'default_templates',
                                   $this->Lang('info_sysdflt_calendar_template'),
                                   'orig_calendar_template.tpl',
                                   $this->Lang('info_sysdflt_template'));

echo '<div style="margin-bottom: 0.5em; height: 0.5em; border-top: 1px solid #000; width: 80%;"></div>'."\n";

# System Default Resource List Template
echo $this->GetDefaultTemplateForm($this,$id,$returnid,
                                   CGCALENDAR_PREF_NEWLIST_TEMPLATE,
                                   'admin_templates', 'default_templates',
                                   $this->Lang('info_sysdflt_list_template'),
                                   'orig_list_template.tpl',
                                   $this->Lang('info_sysdflt_template'));

echo '<div style="margin-bottom: 0.5em; height: 0.5em; border-top: 1px solid #000; width: 80%;"></div>'."\n";

# System Default Resource Upcominglist Template
echo $this->GetDefaultTemplateForm($this,$id,$returnid,
                                   CGCALENDAR_PREF_NEWUPCOMINGLIST_TEMPLATE,
                                   'admin_templates', 'default_templates',
                                   $this->Lang('info_sysdflt_upcominglist_template'),
                                   'orig_upcominglist_template.tpl',
                                   $this->Lang('info_sysdflt_template'));

echo '<div style="margin-bottom: 0.5em; height: 0.5em; border-top: 1px solid #000; width: 80%;"></div>'."\n";

# System Default Search Form Template
echo $this->GetDefaultTemplateForm($this,$id,$returnid,
                                   CGCALENDAR_PREF_NEWSEARCH_TEMPLATE,
                                   'admin_templates', 'default_templates',
                                   $this->Lang('info_sysdflt_search_template'),
                                   'orig_search_template.tpl',
                                   $this->Lang('info_sysdflt_template'));
echo '<div style="margin-bottom: 0.5em; height: 0.5em; border-top: 1px solid #000; width: 80%;"></div>'."\n";

# System Default Search Result Template
echo $this->GetDefaultTemplateForm($this,$id,$returnid,
                                   CGCALENDAR_PREF_NEWSEARCHRESULT_TEMPLATE,
                                   'admin_templates', 'default_templates',
                                   $this->Lang('info_sysdflt_searchresult_template'),
                                   'orig_searchresult_template.tpl',
                                   $this->Lang('info_sysdflt_template'));
echo '<div style="margin-bottom: 0.5em; height: 0.5em; border-top: 1px solid #000; width: 80%;"></div>'."\n";

# System Default Resource Event Template
echo $this->GetDefaultTemplateForm($this,$id,$returnid,
                                   CGCALENDAR_PREF_NEWEVENT_TEMPLATE,
                                   'admin_templates', 'default_templates',
                                   $this->Lang('info_sysdflt_event_template'),
                                   'orig_event_template.tpl',
                                   $this->Lang('info_sysdflt_template'));

echo '<div style="margin-bottom: 0.5em; height: 0.5em; border-top: 1px solid #000; width: 80%;"></div>'."\n";

# System Default Resource Event Template
echo $this->GetDefaultTemplateForm($this,$id,$returnid,
                                   CGCALENDAR_PREF_NEWMYEVENTS_TEMPLATE,
                                   'admin_templates', 'default_templates',
                                   $this->Lang('info_sysdflt_myevents_template'),
                                   'orig_myevents_template.tpl',
                                   $this->Lang('info_sysdflt_template'));


# System Default Resource Event Template
echo '<div style="margin-bottom: 0.5em; height: 0.5em; border-top: 1px solid #000; width: 80%;"></div>'."\n";
echo $this->GetDefaultTemplateForm($this,$id,$returnid,
                                   CGCALENDAR_PREF_NEWEDITEVENT_TEMPLATE,
                                   'admin_templates', 'default_templates',
                                   $this->Lang('info_sysdflt_editevent_template'),
                                   'orig_editevent_template.tpl',
                                   $this->Lang('info_sysdflt_template'));

#
# EOF
#
?>