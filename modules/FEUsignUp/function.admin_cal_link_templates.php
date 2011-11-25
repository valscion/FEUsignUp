<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Output for FEUsignUp adminpanel tab "cal_link_templates"

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

echo $this->Lang('info_cal_link_templates');

echo $this->ShowTemplateList($id,$returnid,'callink_',
           FEUSIGNUP_PREF_NEWCALLINK_TEMPLATE,
           'cal_link_templates',
           FEUSIGNUP_PREF_DFLTCALLINK_TEMPLATE,
           $this->Lang('add-edit_template'));
## EOF