<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Output for FEUsignUp adminpanel tab "groups"

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

// Assign CGCalendar categories
$q = 'SELECT category_id,category_name FROM ' . $cgcal->categories_table_name . ' ORDER BY category_order, category_name';
$dbresult = $db->Execute( $q );
if( $dbresult ) {
    while( $row = $dbresult->FetchRow() ) {
        $cgcc_dropdown[ $row['category_name'] ] = $row['category_id'];
    }
}

// Assign TSS teams
// Ignore the NONE-team.
$q = 'SELECT team_id,team_name,team_code FROM '.cms_db_prefix().'module_tss_team WHERE team_id != 0';
$dbresult = $db->Execute( $q );
if( $dbresult ) {
    while( $row = $dbresult->FetchRow() ) {
        $tsst_dropdown[ $row['team_code'] ] = $row['team_id'];
    }
}

/*
// Assign fetched groups and teams to smarty
$this->smarty->assign('feu_groups',$feu_groups);
$this->smarty->assign('tss_teams',$tss_teams);
*/

// Assign form elements
$smarty->assign('start_form', $this->CreateFormStart($id, 'adminsave_groups', $returnid));
$smarty->assign('feug_dropdown', $this->CreateInputDropdown($id, 'feu_group', $feug_dropdown));
$smarty->assign('cgcc_dropdown', $this->CreateInputDropdown($id, 'cgc_category', $cgcc_dropdown));
$smarty->assign('tsst_dropdown', $this->CreateInputDropdown($id, 'tss_team', $tsst_dropdown));

// Assign forms language-specific strings
$smarty->assign('link_feugroup', $this->Lang('link_feugroup'));
$smarty->assign('to_cgcal_category', $this->Lang('to_cgcal_category'));
$smarty->assign('or_tss_team', $this->Lang('or_tss_team'));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', $this->Lang('submit_groups')));

// Run the template
echo $this->ProcessTemplate('admin_groupstab.tpl');

## EOF