<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Output for FEUsignUp adminpanel tab "linkings"

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

$feu =& cge_utils::get_module('FrontEndUsers');
if( $feu === null ) die('Front End Users module is not installed!');

$cgcal =& cge_utils::get_module('CGCalendar');
if( $cgcal === null ) die('CGCalendar module is not installed!');

$tss =& cge_utils::get_module('TeamSportScores');
if( $tss === null ) die('TeamSportScores module is not installed!');

// Let's hack the DB directly to get all the possible information with only one query.
$db =& $this->GetDb(); /* @var $db ADOConnection */

// Assign FrontEndUsers groups
$q = 'SELECT id,groupname,groupdesc FROM '.cms_db_prefix().'module_feusers_groups';
$dbresult = $db->Execute( $q );
if( $dbresult ) {
    while( $row = $dbresult->FetchRow() ) {
        $feug_dropdown[ $row['groupdesc'] ] = $row['id'];
    }
}
$feug_array = array_flip( $feug_dropdown );

// Assign CGCalendar categories
$q = 'SELECT category_id,category_name FROM ' . $cgcal->categories_table_name . ' ORDER BY category_order, category_name';
$dbresult = $db->Execute( $q );
if( $dbresult ) {
    while( $row = $dbresult->FetchRow() ) {
        $cgcc_dropdown[ $row['category_name'] ] = $row['category_id'];
    }
}
$cgcc_array = array_flip( $cgcc_dropdown );

// Assign TSS teams
// Ignore the NONE-team.
$q = 'SELECT team_id,team_name,team_code FROM '.cms_db_prefix().'module_tss_team WHERE team_id != 0 ORDER BY team_id ASC';
$dbresult = $db->Execute( $q );
if( $dbresult ) {
    while( $row = $dbresult->FetchRow() ) {
        $tsst_dropdown[ $row['team_code'] ] = $row['team_id'];
    }
}
$tsst_array = array_flip( $tsst_dropdown );

// Fetch all existing linkings
$linkings = array();
$linkings = $this->GetLinkings();
$linkings_amount = count($linkings); 

$linkings_objs = array();
foreach( $linkings as $link )
{
    $onerow = new stdClass();
    $onerow->id = $link['linking_id'];
    $onerow->feu_group = $feug_array[$link['feusers_group_id']];
    $onerow->cgcal_category = $cgcc_array[$link['cgcal_category_id']];
    $onerow->tss_team = $tsst_array[$link['tss_team_id']];
    $onerow->desc = $link['description'];
    
    // Add edit-links
    $onerow->editlink = 
		    $this->CreateLink ($id, 'admin_editlinking', $returnid,
				       $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif',
										    $this->Lang ('edit'), '', '', 'systemicon'),
				       array ('linking_id' => $link['linking_id'] ));
    
    // Add all fetched info to array $linkings_objs
    array_push( $linkings_objs, $onerow );
}

/*
// Just a TEST
$onerow = new stdClass();
$onerow->id = 1337;
$onerow->feu_group = "Paras A-ryhmä";
$onerow->cgcal_category = 'Testikalenterikategoria';
$onerow->tss_team = 'DreamTeam';
$onerow->desc = 'A simple test';
$onerow->editlink = 
    $this->CreateLink ($id, 'editlinking', $returnid,
               $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif',
                                    $this->Lang ('edit'), '', '', 'systemicon'),
               array ('linking_id' => 1337 ));
array_push( $linkings_objs, $onerow );
*/

// Assign form elements
$smarty->assign('start_form', $this->CreateFormStart($id, 'admin_savelink', $returnid));
$smarty->assign('input_feugroup', $this->CreateInputDropdown($id, 'feu_group', $feug_dropdown));
$smarty->assign('input_cgcal_category', $this->CreateInputDropdown($id, 'cgc_category', $cgcc_dropdown));
$smarty->assign('input_tss_team', $this->CreateInputDropdown($id, 'tss_team', $tsst_dropdown));
$smarty->assign('input_description', $this->CreateInputText($id, 'description','',40));

// Assign forms language-specific strings
$smarty->assign('prompt_addlink', $this->Lang('prompt_addlink'));
$smarty->assign('prompt_feugroup', $this->Lang('prompt_feugroup'));
$smarty->assign('prompt_cgcal_category', $this->Lang('prompt_cgcal_category'));
$smarty->assign('prompt_tss_team', $this->Lang('prompt_tss_team'));
$smarty->assign('prompt_description', $this->Lang('prompt_description'));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', $this->Lang('submit_link')));

// Assign linkings list to smarty
$smarty->assign('itemcount', $linkings_amount);
$smarty->assign('items', $linkings_objs);

// Assign lists language-specific strings
$smarty->assign('th_id', $this->Lang('th_id'));
$smarty->assign('th_feug', $this->Lang('th_feug'));
$smarty->assign('th_cgcc', $this->Lang('th_cgcc'));
$smarty->assign('th_tsst', $this->Lang('th_tsst'));
$smarty->assign('th_desc', $this->Lang('th_desc'));


// Run the template
echo $this->ProcessTemplate('admin_linkingstab.tpl');

## EOF