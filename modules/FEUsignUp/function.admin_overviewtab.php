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
$smarty->assign('th_event', $this->Lang('th_event') );
$smarty->assign('th_date', $this->Lang('th_date') );
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
  if( $signup['cgcal_event_id'] != -1 ) {
    $cgcal_event = $cgcal->GetEvent( $signup['cgcal_event_id'] );
    $onerow->event_info = 
        $this->Lang('from_calendar', $signup['cgcal_event_id'] ) . $cgcal_event['event_title'];
    $onerow->event_date = 
        strftime( $this->Lang('event_time_format'), $cgcal_event['event_date_start_ut'] );
    $onerow->event_date_ut = $cgcal_event['event_date_start_ut'];
    $onerow->event_id = $signup['cgcal_event_id'];
  } elseif( $signup['tss_game_id'] != -1 ) {
    $onerow->event_info = $this->Lang('from_tss', $signup['tss_game_id'] );
    $onerow->event_date = '???';
    $onerow->event_date_ut = 0;
    $onerow->event_id = $signup['tss_game_id'];
  } else {
    // What, we had both tss and cgcal id's as -1?! ERROR!
    $onerow->event_info = $this->Lang('error');
    $onerow->event_date = '';
    $onerow->event_date_ut = 0;
    $onerow->event_id = -1;
  }

  
  $onerow->signed_up = $signup['signed_up'] ? 'IN' : 'OUT';
  $onerow->description = $signup['description'];
  $onerow->editlink = $this->CreateLink ($id, 'admin_editsignup', $returnid,
                $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif',
                        $this->Lang('edit'), '', '', 'systemicon'),
                array ('signup_id' => $signup['id'] ));
  $onerow->deletelink = $this->CreateLink ($id, 'admin_savesignup', $returnid,
                $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif',
                        $this->Lang('delete'), '', '', 'systemicon'),
                array ('signup_id' => $signup['id'], 'delete' => 1),
                $this->Lang ('areyousure_delsignup') );
  
  
  array_push( $signups, $onerow );
}

$sortby = ( isset( $params['sortby'] ) && !empty( $params['sortby'] ) ) ? $params['sortby'] : 'id';
switch( $sortby ) {
  case 'user':
    // Sort signups by username
    usort( $signups, array( $this, '_SortEventsByUsername' ) );
    break;
  case 'event':
    // Sort signups by event id
    usort( $signups, array( $this, '_SortEventsByEventId' ) );
    break;
  case 'date':
    // Sort signups by date
    usort( $signups, array( $this, '_SortEventsByDate' ) );
    break;
  case 'id':
  default:
    // Sort by id by default. Note that we don't have to do anything, actually ;)
}
if( isset( $params['sortdesc'] ) && $params['sortdesc'] == 1 ) {
  // We wanted to sort it in reverse order, so let's flip the whole damn array.
  $signups = array_reverse( $signups );
}

// "No signups" -translation
$smarty->assign('no_signups', $this->Lang('no_signups') );

// Assign the number of signups to smarty
$smarty->assign('signup_count', count($signups) );

// Now assign those signups to smarty
$smarty->assign('signups', $signups);

echo $this->ProcessTemplate('admin_overviewtab.tpl');
## EOF