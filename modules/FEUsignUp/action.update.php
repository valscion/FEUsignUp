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

// Let's check whether we have a solid event
if( !$this->_CGCalendarEventExists( $_POST['event_id'] ) ) {
  die( $this->Lang('event_not_found') );
}

$feu =& cge_utils::get_module('FrontEndUsers');
if( $feu === null ) die('<p class="error">FrontEndUsers module is not installed!</p>');

$userid = (int)$_POST['user_id'];
$username = $_POST['username'];
$signup = ( $_POST['signup'] === 'in' ) ? 1 : 0;
$description = $_POST['description'];

// Let's check whether we have rights to modify this users sign-up.
$logged_in_user = (int)$feu->LoggedInId();
if( $logged_in_user !== $userid && !$feu->MemberOfGroup( $logged_in_user, 7 ) ) {
  die( $this->Lang('not_admin') );
}

// Let's check whether the user we're about to sign in/out is real.
if( !$feu->UserExistsByID( $userid ) ) {
  die( $this->Lang('user_not_found_by_id', $userid) );
}

echo '<p>Request complete</p><pre>';
print_r( $_POST );
echo '</pre>';

## EOF