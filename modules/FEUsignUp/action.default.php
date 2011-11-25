<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for FEUsignUp "default" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/

$feu =& cge_utils::get_module('FrontEndUsers');
if( $feu === null ) die('Front End Users module is not installed!');

if( !$feu->LoggedIn() ) { 
    //echo('You\'re not logged in!'); 
    //return; 
} else {
    //echo $feu->LoggedInName();
}

// Make sure we have "cal_id" or "tss_id" parameter.
if( ( !isset( $params['cal_id'] ) || empty( $params['cal_id'] ) )
    && ( !isset( $params['tss_id'] ) || empty( $params['tss_id'] ) ) ) {
    echo '<p class="error">'.$this->Lang('error-no_id_given').'</p>';
    return;
}

// What's the ID for CGCalendar or TSS event?
$linkId = -1;

// String that contains the template used for output
$linkTemplate = '';

// What template to use for the link
$templatename = '';
if( isset($params['template']) && !empty($params['template']) ) {
  $templatename = $params['template'];
}

// Get stuff from the calendar module, linked to parameter "cal_id"
if( isset( $params['cal_id'] ) && !empty( $params['cal_id'] ) ) {
  $cgcal =& cge_utils::get_module('CGCalendar');
  if( $cgcal === null ) die('CGCalendar module is not installed!');
  
  $linkId = (int)$params['cal_id'];
  $event = $cgcal->GetEvent( $linkId );
  $this->smarty->assign('from', 'cgcal');
  $this->smarty->assign('event', $event);
  $this->smarty->assign('signups_amount', $this->GetSignupsAmountForEvent( $linkId, 'cgcalendar' ) );
  $this->smarty->assign('link_href',"{$gCms->config['root_url']}/feusignup/view/cgcal/$linkId/");
  if( $templatename === '' ) {
    $templatename = $this->GetPreference(FEUSIGNUP_PREF_DFLTCALLINK_TEMPLATE);
  }
  $linkTemplate = 'callink_' . $templatename;
}
// Or, if 'cgcal_id' wasn't given, try 'tss_id'.
else {
  $tss =& cge_utils::get_module('TeamSportScores');
  if( $tss === null ) die('TeamSportScores module is not installed!');
  
  $linkId = (int)$params['tss_id'];
  $db =& $this->GetDb(); /* @var $db ADOConnection */
  $q = 'SELECT * FROM '.cms_db_prefix().'module_tss_gameschedule_score WHERE gss_id = ?';
  $dbresult = $db->Execute( $q, array($linkId) );
  if( $dbresult && $matchInfo = $dbresult->FetchRow() ) {
    // All OK
  } else {
    echo '<p class="error">' . $this->Lang('db_error') . '</p>';
  }
  $this->smarty->assign('from', 'tss');
  $this->smarty->assign('match',$matchInfo);
  $this->smarty->assign('signups_amount', $this->GetSignupsAmountForEvent( $linkId, 'tss' ) );
  $this->smarty->assign('link_href',"{$gCms->config['root_url']}/feusignup/view/tss/$linkId/");
  if( $templatename === '' ) {
    $templatename = $this->GetPreference(FEUSIGNUP_PREF_DFLTTSSLINK_TEMPLATE);
  }
  $linkTemplate = 'tsslink_' . $templatename;
}
 
echo $this->ProcessTemplateFromDatabase($linkTemplate);

?>