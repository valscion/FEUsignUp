<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Output for FEUsignUp adminpanel tab "overview"

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

$cgcal =& cge_utils::get_module('CGCalendar');
if( $cgcal === null ) die('CGCalendar module is not installed!');

$feu =& cge_utils::get_module('FrontEndUsers');
if( $feu === null ) die('FrontEndUsers module is not installed!');

// Basic info first.
$smarty->assign('tab_info', $this->Lang('info_overview') );

// Table headers
$smarty->assign('th_id', $this->Lang('th_id') );
$smarty->assign('th_feu', $this->Lang('th_feu') );
$smarty->assign('th_cgc_event', $this->Lang('th_cgc_event') );
$smarty->assign('th_tss_game', $this->Lang('th_tss_game') );
$smarty->assign('th_group', $this->Lang('th_group') );
$smarty->assign('th_signed_up', $this->Lang('th_signed_up') );
$smarty->assign('th_desc', $this->Lang('th_desc') );


// Fetch all signups into an array containing objects
$fetchedSignups = $this->GetSignups();
$signups = array();

foreach( $fetchedSignups as $signup ) {
  $onerow = new stdClass();
  $onerow->id = $signup['id'];
  $onerow->feu = $feu->GetUsername( $signup['feu_user_id'] );
  if( $signup['cgcal_event_id'] == -1 )
    $onerow->cgc_event = $this->Lang('no_cgc_event');
  else
    $onerow->cgc_event = $this->_GetCGCalendarEventTitle( $signup['cgcal_event_id'] );
  
  if( $signup['tss_game_id'] == -1 )
    $onerow->tss_game = $this->Lang('no_tss_game');
  else
    $onerow->tss_game = $signup['tss_game_id'];
  
  $onerow->signed_up = $signup['signed_up'] ? 'IN' : 'OUT';
  $onerow->description = $signup['description'];
  $onerow->editlink = '';
  
  array_push( $signups, $onerow );
}

// "No signups" -translation
$smarty->assign('no_signups', $this->Lang('no_signups') );

// Assign the number of signups to smarty
$smarty->assign('signup_count', count($signups) );

// Now assign those signups to smarty
$smarty->assign('signups', $signups);

echo $this->ProcessTemplate('admin_overviewtab.tpl');
## EOF