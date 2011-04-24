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

// Assign FrontEndUsers groups to $feu_groups
$feu_groups = array();
$q = 'SELECT id,groupname,groupdesc FROM '.cms_db_prefix().'module_feusers_groups';
$dbresult = $db->Execute( $q );
if( $dbresult ) {
    while( $row = $dbresult->FetchRow() ) {
        $feu_groups[] = array(
            'group_id' => $row['id'],
            'group_name' => $row['groupname'],
            'group_desc' => $row['groupdesc']
        );
    }
}

// Assign TSS teams to $tss_teams
$tss_teams = array();
// Ignore the NONE-team.
$q = 'SELECT team_id,team_name,team_code FROM '.cms_db_prefix().'module_tss_team WHERE team_id != 0';
$dbresult = $db->Execute( $q );
if( $dbresult ) {
    while( $row = $dbresult->FetchRow() ) {
        $tss_teams[] = array(
            'team_id' => $row['team_id'],
            'team_name' => $row['team_name'],
            'team_code' => $row['team_code']
        );
    }
}

// Assign fetched groups and teams to smarty
$this->smarty->assign('feu_groups',$feu_groups);
$this->smarty->assign('tss_teams',$tss_teams);

// Assign form elements
$smarty->assign('start_form', $this->CreateFormStart($id, 'adminsave_groups', $returnid));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));

// Run the template
echo $this->ProcessTemplate('admin_groupstab.tpl');

## EOF