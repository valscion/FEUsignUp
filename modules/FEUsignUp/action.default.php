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

if( !$feu->LoggedIn() ) { 
    echo('You\'re not logged in!'); 
    //return; 
} else {
    echo $feu->LoggedInName();
}

echo '<pre>';
if( isset($params['cal_id']) ) {
    $event = $cgcal->GetEvent((int) $params['cal_id']);
    print_r( $event );
    echo "\n--------\n";
    foreach( $event['categories'] as $catId ) {
        echo $catId . ": ";
        echo $cgcal->GetCategoryName( 2 ) . "\n";
    }
} else {
    print_r( $cgcal->GetCategories() );
}
echo '</pre>';

?>