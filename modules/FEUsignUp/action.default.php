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
    //echo('You\'re not logged in!'); 
    //return; 
} else {
    //echo $feu->LoggedInName();
}

// create attributes for rendering "view" links for the object.
// $id and $returnid are predefined for us by the module API
// that last parameter is the Pretty URL link
$link = $this->CreateFrontendLink($id, $returnid, 'view',
      $params['description'],array('class'=>'pickable'),'',false,true,'',true,'feusignup/view/-1/');
      
echo '<p>'.$link.'</p>';

?>