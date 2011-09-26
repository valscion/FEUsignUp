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

if( !isset( $params['signup_id'] ) )
{
    // set the active tab and an error
    $params = array('active_tab' => 'overview', 'error' => true, 'message' => $this->Lang('error'));
    // redirect back to default admin page
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$signup_id = (int)$params['signup_id'];

$info = $this->GetSignup( $signup_id );

if( empty( $info ) ) {
  die( $this->Lang('event_not_found') );
}

echo 'Coming soon...';
## EOF