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

// Return message as an array with two cells. First cell
// specifies whether all is successful or not and the second
// specifies the message to display.
$ret = array( true, '' );

if( isset( $params['cancel'] ) ) {
  // We just want to cancel! So do nothing. :)
}
elseif( isset( $params['delete'] ) ) {
  // We want to delete a signup
  $ret = $this->DeleteSignup( $params['signup_id'] );
} else {
  /*
  // We're modifying a link
  $ret = $this->ModifySignup( $params['linking_id'],
                                 $params['user_id'], 
                                 $params['signup'],
                                 $params['description'],
                                 $params['from']
                               );
  */
}

if( $ret[0] === FALSE ) {
  // set to display error, if unsuccessful
  $params['error'] = $ret[1];
}

// Message to display
$params['message'] = $ret[1];

// set the active tab
$params['active_tab'] = 'overview';

// redirect back to default admin page
$this->Redirect($id, 'defaultadmin', $returnid, $params);

## EOF