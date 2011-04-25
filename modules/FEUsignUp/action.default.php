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

$cgcal =& cge_utils::get_module('CGCalendar');
if( $cgcal === null ) die('CGCalendar module is not installed!');

$tss =& cge_utils::get_module('TeamSportScores');
if( $tss === null ) die('TeamSportScores module is not installed!');

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

// Is the link to TSS or CGCalendar event? 'tss' and 'cgcal' are possible values.
$linktarget = '';

// What's the ID for CGCalendar or TSS event?
$linkId = -1;

// Visible text for the link
$linkdescription = 'Aloha!';

// Get stuff from the calendar module, linked to parameter "cal_id"
if( isset( $params['cal_id'] ) && !empty( $params['cal_id'] ) ) {
	$event = $cgcal->GetEvent( $params['cal_id'] );
    $this->smarty->assign('event', $event);
    $linkdescription = $this->ProcessTemplate('cal_link.tpl');
    $linktarget = 'cgcal';
    $linkId = $params['cal_id'];
}
// Or, if 'cgcal_id' wasn't given, try 'tss_id'.
else {
	$db =& $this->GetDb(); /* @var $db ADOConnection */
    $q = 'SELECT * FROM '.cms_db_prefix().'module_tss_gameschedule_score WHERE gss_id = ?';
	$dbresult = $db->Execute( $q, array($params['tss_id']) );
	if( $dbresult && $matchInfo = $dbresult->FetchRow() ) {
		// All OK
	} else {
		echo '<p class="error">' . $this->Lang('db_error') . '</p>';
	}
    $this->smarty->assign('match',$matchInfo);
    $linkdescription = $this->ProcessTemplate('tss_link.tpl');
    $linktarget = 'tss';
    $linkId = $params['tss_id'];
}

// create attributes for rendering "view" links for the object.
// $id and $returnid are predefined for us by the module API
// that last parameter is the Pretty URL link
$link = $this->CreateFrontendLink($id, $returnid, 'view',
      $linkdescription,array('class'=>'pickable'),'',false,true,'',true,
      "feusignup/view/$linktarget/$linkId/");
      
echo '<p>'.$link.'</p>';

?>