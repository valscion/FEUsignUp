<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Output for FEUsignUp adminpanel tab "cal_link_templates"

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

echo $this->Lang('info_cal_link_templates');

echo $this->ShowTemplateList($id,$returnid,'callink_',
			     FEUSIGNUP_PREF_NEWCALLINK_TEMPLATE,
			     'link_templates',
			     FEUSIGNUP_PREF_DFLTCALLINK_TEMPLATE,
			     'Add/edit',
			     'CGCalendar links','defaultadmin');
## EOF