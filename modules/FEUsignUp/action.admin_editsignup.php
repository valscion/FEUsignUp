<?php
if (!isset($gCms)) exit;

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