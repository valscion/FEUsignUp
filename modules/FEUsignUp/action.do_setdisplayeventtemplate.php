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
  $dflt = $this->GetTemplate( FEUSIGNUP_PREF_DFLTDISPLAYEVENT_TEMPLATE );
  $this->SetTemplate(FEUSIGNUP_PREF_NEWDISPLAYEVENT_TEMPLATE, $dflt );
  $message = $this->Lang('success_defaults');
} else {
  $this->SetTemplate(FEUSIGNUP_PREF_NEWDISPLAYEVENT_TEMPLATE, $params['template']);
  $message = $this->Lang('success_template');
}

// set the active tab and a message
$params = array('message' => $message);
// redirect back to default admin page
$this->RedirectToTab($id, 'template_displayevent', $params);


## EOF