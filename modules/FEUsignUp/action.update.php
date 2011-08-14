<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for FEUsignUp "update" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

// Let's check whether all necessary information is submitted
if( !isset($_POST) || empty($_POST) || !isset( $_POST['event_id'], $_POST['user_id'], $_POST['username'], $_POST['signup'], $_POST['description'] ) ) {
  die( $this->Lang('update_failed') );
} elseif( $_POST['signup'] !== 'in' && $_POST['signup'] !== 'out' ) {
  die( $this->Lang('update_failed_no_in_or_out') );
}

$feu =& cge_utils::get_module('FrontEndUsers');
if( $feu === null ) die('<p class="error">FrontEndUsers module is not installed!</p>');

$eventid = (int)$_POST['event_id'];
$userid = (int)$_POST['user_id'];
$username = $_POST['username'];
$signup = ( $_POST['signup'] === 'in' ) ? 1 : 0;
$description = $_POST['description'];

// Let's check whether we have a solid event
if( !$this->_CGCalendarEventExists( $eventid ) ) {
  die( $this->Lang('event_not_found') );
}

// Let's check whether we have rights to modify this users sign-up.
$logged_in_user = (int)$feu->LoggedInId();
if( $logged_in_user !== $userid && !$feu->MemberOfGroup( $logged_in_user, 7 ) ) {
  die( $this->Lang('not_admin') );
}

// Let's check whether the user we're about to sign in/out is real.
if( !$feu->UserExistsByID( $userid ) ) {
  die( $this->Lang('user_not_found_by_id', $userid) );
}

// Let's do it!
$ret = $this->ModifySignup( $eventid, $userid, $signup, $description, 'cgcalendar' );
if( $ret[0] ) {
  // Everything went OK
  echo '<p>' . $ret[1] . '</p>';
} else {
  // Something nasty happened :(
  echo '<p class="error">' . $ret[1] . '</p>';
}

## EOF