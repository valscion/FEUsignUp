<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for FEUsignUp "displayevent" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

// Create a "event"-object that stores information about this event
// and assign it to smarty by reference.
$event = new stdClass();
$this->smarty->assign_by_ref('event', $event);

if( $params['from'] == 'cgcal' || $params['from'] == 'cgcalendar' ) {
  $event->from = 'cgcalendar';

  // Fetch CGCalendar info
  $cgcal_id = (int)$params['from_id'];
  $event->id = $cgcal_id;
  
  $cgcal =& cge_utils::get_module('CGCalendar');
  if( $cgcal === null ) die('CGCalendar module is not installed!');
  
  $feu =& cge_utils::get_module('FrontEndUsers');
  if( $feu === null ) die('FrontEndUsers module is not installed!');

  $event->info = $cgcal->GetEvent( $cgcal_id );
  
  $events_to_categories_table = $cgcal->events_to_categories_table_name;
  $categories_table = $cgcal->categories_table_name;
  
  $cat_ids = array();
  
  $q = 'SELECT C.category_id,C.category_name FROM ' . $categories_table . ' C
          INNER JOIN '.$events_to_categories_table.' E
            ON C.category_id = E.category_id
          WHERE E.event_id = ?';
  $data = $db->GetArray($q,array($cgcal_id));
  foreach( $data as $row ) {
    $cat_ids[$row['category_name']] = $row['category_id'];
  }
  
  $feug_ids = array();
  foreach( $cat_ids as $name => $id ) {
    $q = 'SELECT feusers_group_id FROM ' . $this->linkings_table_name . " WHERE cgcal_category_id = $id";
    $rs = $db->Execute($q);
    while( $row = $rs->FetchRow() ) {
      $feug_ids[$name] = $row['feusers_group_id'];
    }
  }
  
  // Fetch all the previous sign-ups from the database
  $signups = $this->GetEventUsers( $cgcal_id, 'cgcal' );
  
} elseif( $params['from'] == 'tss' ) {
  $event->from = 'tss';
  // TODO: Hae matsin joukkueeseen linkitettyjen joukkueiden perusteella FEU-ryhmien ID:t
  // taulukkoon $feug_ids.
  $tss_id = (int)$params['from_id'];
  $event->id = $tss_id;
  $feug_ids = array();
} else {
  echo '<p class="error">ERROR</p>';
  return;
}

$groups = array();
foreach( $feug_ids as $name => $id ) {
  $fullUsers = $feu->GetFullUsersInGroup( $id );
  if( $fullUsers )
    $groups[$name] = $fullUsers;
}

$users = array();

// Array to hold only user ID's to ensure we won't get the same user twice or more often
$users_only_once = array(); 

foreach( $groups as $name => $group ) {
  foreach( $group as $user ) {
    if( in_array( $user['id'], $users_only_once ) ) 
      continue;
    
    $users_only_once[] = $user['id'];
    $onerow = new stdClass();
    $onerow->username = $user['username'];
    $onerow->id = $user['id'];
    $onerow->props = $user['props'];
    $onerow->cal_link = $name;
    $onerow->submit_href = "/feusignup/update/{$user['id']}/";
    // Fetch old signup informations
    foreach( $signups as $signup ) {
      if( $signup['feu_user_id'] == $user['id'] ) {
        $onerow->exists = 1;
        $onerow->signed_up = $signup['signed_up'];
        $onerow->description = $signup['description'];
        // No need for more loops, we found what we wanted
        break;
      }
    }
    array_push( $users, $onerow );
  }
}


$this->smarty->assign('users', $users);

echo $this->ProcessTemplateFromDatabase( FEUSIGNUP_PREF_NEWDISPLAYEVENT_TEMPLATE );

## EOF