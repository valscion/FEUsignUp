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
  
  
echo '<p>Request complete</p><pre>';
print_r( $_POST );
echo '</pre>';

## EOF