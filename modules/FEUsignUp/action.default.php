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

// Get stuff from the calendar module, linked to parameter "cal_id"
if( isset( $params['cal_id'] ) && !empty( $params['cal_id'] ) ) {
    $this->smarty->assign('event',$cgcal->GetEvent( $params['cal_id'] ) );
    $linkdescription = $this->ProcessTemplate('cal_link.tpl');
    $linktarget = 'cgcal';
    $linkId = $params['cal_id'];
}
// Or, if 'cgcal_id' wasn't given, try 'tss_id'.
else {
    // TODO: Get match info from database based on $params['tss_id']
    $this->smarty->assign('match','gamestuff' );
    $linkdescription = $this->ProcessTemplate('tss_link.tpl');
    $linktarget = 'tss';
    $linkId = $params['tss_id'];
}


$event = $cgcal->GetEvent( $params['cal_id'] );

// create attributes for rendering "view" links for the object.
// $id and $returnid are predefined for us by the module API
// that last parameter is the Pretty URL link
$link = $this->CreateFrontendLink($id, $returnid, 'view',
      $params['description'],array('class'=>'pickable'),'',false,true,'',true,
      "feusignup/view/$linktarget/$linkId/");
      
echo '<p>'.$link.'</p>';

?>