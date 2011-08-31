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

// If we want to reset sorting, then clear the $params-array.
if( isset( $params['reset_sorting'] ) ) {
  $params = array();
}

// Assign form start and end for sorting / filtering form
$smarty->assign('formstart',$this->CreateFormStart($id,'defaultadmin',$returnid));
$smarty->assign('formend',$this->CreateFormEnd());

// Sort/filter infos
$smarty->assign( 'filter_and_sort', $this->Lang('filter_and_sort') );
$smarty->assign( 'filter_by_from', $this->Lang('filter_by_from') );
$smarty->assign( 'filter_by_event_id', $this->Lang('filter_by_event_id') );
$smarty->assign( 'filter_by_in_or_out', $this->Lang('filter_by_in_or_out') );
$smarty->assign( 'sort_by', $this->Lang('sort_by') );

// Sort/filter inputs
$smarty->assign( 'input_from', $this->CreateInputDropdown( 
      $id, 'input_from', array( 
                                $this->Lang('show_both') => 'both', 
                                'CGCalendar' => 'cgcal', 
                                'Team Sport Scores' => 'tss' 
                              ), -1,
      ( isset($params['input_from']) && !empty($params['input_from']) ) ? $params['input_from'] : '' ) );
$smarty->assign( 'input_event_id', $this->CreateInputText(
      $id, 'input_event_id', ( isset($params['input_event_id']) ) ? $params['input_event_id'] : '' ) );
$smarty->assign( 'input_in_or_out', $this->CreateInputDropdown( 
      $id, 'input_in_or_out', array( 
                                     $this->Lang('show_both') => 'both', 
                                     'IN' => 'in', 
                                     'OUT' => 'out' 
                                   ), -1,
      ( isset($params['input_in_or_out']) && !empty($params['input_in_or_out']) ) ? $params['input_in_or_out'] : 'both' ) );
$smarty->assign( 'input_sort_by', $this->CreateInputDropdown( 
      $id, 'input_sort_by', array( 
                                   $this->Lang('sort_by_id') => 'id', 
                                   $this->Lang('sort_by_username') => 'username', 
                                   $this->Lang('sort_by_event') => 'event',
                                   $this->Lang('sort_by_date') => 'date'
                                 ), -1,
      ( isset($params['input_sort_by']) && !empty($params['input_sort_by']) ) ? $params['input_sort_by'] : '' ) );
$smarty->assign( 'input_sort_order', $this->CreateInputDropdown( 
      $id, 'input_sort_order', array( 
                                   $this->Lang('in_ascending_order') => 'asc', 
                                   $this->Lang('in_descending_order') => 'desc'
                                 ), -1,
      ( isset($params['input_sort_order']) && !empty($params['input_sort_order']) ) ? $params['input_sort_order'] : '' ) );
$smarty->assign( 'input_submit_filter_and_sort', $this->CreateInputSubmit(
      $id, 'submit', $this->Lang('submit_filter_and_sort') ) );
$smarty->assign( 'reset_sorting', $this->CreateInputSubmit(
      $id, 'reset_sorting', $this->Lang('reset_sorting') ) );

// Table headers
$smarty->assign('th_id', $this->Lang('th_id') );
$smarty->assign('th_feu', $this->Lang('th_feu') );
$smarty->assign('th_event', $this->Lang('th_event') );
$smarty->assign('th_date', $this->Lang('th_date') );
$smarty->assign('th_group', $this->Lang('th_group') );
$smarty->assign('th_signed_up', $this->Lang('th_signed_up') );
$smarty->assign('th_desc', $this->Lang('th_desc') );


// Let's find out what stuff we filter from the database.
$filterSql = '';
if( ( isset($params['input_from']) && $params['input_from'] != 'both' ) ||
    ( isset($params['input_event_id']) && !empty($params['input_event_id']) ) ||
    ( isset($params['input_in_or_out']) && $params['input_in_or_out'] != 'both' ) )
{
  $filterSql = 'WHERE';
  
  if( $params['input_from'] == 'cgcal' ) {
    $filterSql .= ' cgcal_event_id != -1';
  } elseif( $params['input_from'] == 'tss' ) {
    $filterSql .= ' tss_game_id != -1';
  }
  
  if( !empty($params['input_event_id']) ) {
    if( $filterSql != 'WHERE' ) $filterSql .= ' AND';
    
    $filterSql .= ' (cgcal_event_id = '.$params['input_event_id'].' OR tss_game_id = '.$params['input_event_id'].')';
  }
  
  if( $params['input_in_or_out'] == 'in' ) {
    if( $filterSql != 'WHERE' ) $filterSql .= ' AND';
    
    $filterSql .= ' signed_up = 1';
  } elseif( $params['input_in_or_out'] == 'out' ) {
    if( $filterSql != 'WHERE' ) $filterSql .= ' AND';
    
    $filterSql .= ' signed_up = 0';
  }
}

// Fetch all signups into an array containing objects
$fetchedSignups = $this->GetSignups((int)$params['page']-1, $filterSql);
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

$sortby = ( isset( $params['input_sort_by'] ) && !empty( $params['input_sort_by'] ) ) ? $params['input_sort_by'] : 'id';
switch( $sortby ) {
  case 'username':
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
    // Sort by id by default. Note that we don't have to do anything here, actually ;)
}
if( isset( $params['input_sort_order'] ) && $params['input_sort_order'] == 'desc' ) {
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