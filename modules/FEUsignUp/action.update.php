<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for FEUsignUp "toggle" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

// Let's check whether all necessary information is submitted
if( !isset($_POST) || empty($_POST) || !isset( $_POST['user_id'], $_POST['username'], $_POST['signup'], $_POST['description'] ) ) {
  die('<p class="error">Ilmoittautuminen epäonnistui!</p>');
} elseif( $_POST['signup'] !== 'in' && $_POST['signup'] !== 'out' ) {
  die('<p class="error">Ilmoittautuminen epäonnistui! Sinun täytyy valita IN tai OUT.</p>');
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
  die('<p class="error">Sinulla ei ole oikeuksia muokata tämän käyttäjän ilmoittautumista!</p>');
}

// Let's check whether the user we're about to sign in/out is real.
if( !$feu->UserExistsByID( $userid ) ) {
  die('<p class="error">Käyttäjää ID:llä ' . $userid . ' ei löydy tietokannasta!</p>');
}

echo '<p>Request complete</p><pre>';
print_r( $_POST );
echo '</pre>';

## EOF