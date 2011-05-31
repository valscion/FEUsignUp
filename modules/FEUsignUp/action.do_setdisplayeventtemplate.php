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

// set the active tab and a message
$params = array('active_tab' => 'template_displayevent', 'message' => 'Work in progress!');
// redirect back to default admin page
$this->Redirect($id, 'defaultadmin', $returnid, $params);


## EOF