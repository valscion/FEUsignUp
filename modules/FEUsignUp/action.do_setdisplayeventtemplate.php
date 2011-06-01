<?php
if (!isset($gCms)) exit;

/** 
 * For separated methods, you won't be able to do permission checks in
 * the DoAction method, so you'll need to do them as needed in your
 * method:
*/ 
if (! $this->CheckAccess()) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

if( isset( $params['defaults'] ) ) {
  $fn = cms_join_path(dirname(__FILE__),'templates','displayevent.tpl');
  $this->SetTemplate('feusignup_displayevent', file_get_contents($fn) );
  $message = $this->Lang('success_defaults');
} else {
  $this->SetTemplate('feusignup_displayevent', $params['template']);
  $message = $this->Lang('success_template');
}

// set the active tab and a message
$params = array('active_tab' => 'template_displayevent', 'message' => $message);
// redirect back to default admin page
$this->Redirect($id, 'defaultadmin', $returnid, $params);


## EOF