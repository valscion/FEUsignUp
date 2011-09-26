<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Output for FEUsignUp adminpanel tab "template_displayevent"

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

// Basic info first.
$smarty->assign('tab_info', $this->Lang('info_template_displayevent') );

// Assign already-existing templates
$smarty->assign('startform',
      $this->CreateFormStart( $id, 'do_setdisplayeventtemplate', $returnid));
$smarty->assign('input_template',
      $this->CreateTextArea( false, $id,
             $this->GetTemplate(FEUSIGNUP_PREF_NEWDISPLAYEVENT_TEMPLATE),
             'template'));
$smarty->assign('submit',
      $this->CreateInputSubmit ($id, 'submit',
                $this->Lang('submit')));
$smarty->assign('defaults',
      $this->CreateInputSubmit ($id, 'defaults',
                $this->Lang('defaults')));
$smarty->assign('endform',$this->CreateFormEnd());

echo $this->ProcessTemplate('admin_template_displayeventtab.tpl');
## EOF