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
$smarty->assign('prompt_template_cal',$this->Lang('template_cal'));
$smarty->assign('input_template_cal',
      $this->CreateTextArea( false, $id,
             $this->GetTemplate('feusignup_displayevent_cal'),
             'template_cal'));
$smarty->assign('prompt_template_tss',$this->Lang('template_tss'));
$smarty->assign('input_template_tss',
      $this->CreateTextArea( false, $id,
             $this->GetTemplate('feusignup_displayevent_tss'),
             'template_tss'));
$smarty->assign('submit',
      $this->CreateInputSubmit ($id, 'submit',
                $this->Lang('submit')));
/*
$smarty->assign('defaults',
      $this->CreateInputSubmit ($id, 'defaults',
                $this->Lang('defaults')));
*/
$smarty->assign('endform',$this->CreateFormEnd());

echo $this->ProcessTemplate('admin_template_displayeventtab.tpl');
## EOF