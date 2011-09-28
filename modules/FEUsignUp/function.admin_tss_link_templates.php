<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Output for FEUsignUp adminpanel tab "tss_link_templates"

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

echo $this->Lang('info_tss_link_templates');

echo $this->ShowTemplateList($id,$returnid,'tsslink_',
			     FEUSIGNUP_PREF_NEWTSSLINK_TEMPLATE,
			     'link_templates',
			     FEUSIGNUP_PREF_DFLTTSSLINK_TEMPLATE,
			     'Add/edit',
			     'Team Sport Scores links','defaultadmin');
## EOF