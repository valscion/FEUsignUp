<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Output for FEUsignUp adminpanel tab "template_displayevent"

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

echo $this->Lang('info_template_displayevent');

echo $this->ShowTemplateList($id,$returnid,'displayevent_',
           FEUSIGNUP_PREF_NEWDISPLAYEVENT_TEMPLATE,
           'template_displayevent',
           FEUSIGNUP_PREF_DFLTDISPLAYEVENT_TEMPLATE,
           $this->Lang('add-edit_template'));
## EOF