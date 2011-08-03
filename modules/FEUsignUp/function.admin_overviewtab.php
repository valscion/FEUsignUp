<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Output for FEUsignUp adminpanel tab "overview"

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

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

// "No signups" -translation
$smarty->assign('no_signups', $this->Lang('no_signups') );

// Fetch all signups into an array containing objects
$signups = array();

$onerow = new stdClass();
$onerow->id = 1337;
$onerow->feu = 'Testiuser';
$onerow->cgc_event = 'testievent';
$onerow->tss_game = 'testigame';
$onerow->group = 'testigroup';
$onerow->signed_up = 'IN';
$onerow->description = 'testidesc';
$onerow->editlink = 'editlink';


array_push( $signups, $onerow );


// Assign the number of signups to smarty
$smarty->assign('signup_count', count($signups) );

// Now assign those signups to smarty
$smarty->assign('signups', $signups);

echo $this->ProcessTemplate('admin_overviewtab.tpl');
## EOF