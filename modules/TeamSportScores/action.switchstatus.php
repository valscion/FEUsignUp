<?php

$gCms = cmsms(); if( !is_object($gCms) ) exit;

// Check permission
if (! $this->CheckPermission('Modify TeamSportScores'))
{
    // Show an error message
    echo $this->ShowError($this->Lang('access_denied'));
}
// User has sufficient privileges
else
{
	switch ($params['table'])
	{
		case 'Club':
			$query = 'UPDATE '.cms_db_prefix().'module_tss_club SET status = ?, modified_date = '.$db->DBTimeStamp(time()).' WHERE club_id = ? and club_id != \'0\'';
			$db->Execute($query, array($params['status'], $params['record_id']));
			$params = array('active_tab' => 'clubs');
			break;
		case 'League':
			$query = 'UPDATE '.cms_db_prefix().'module_tss_leagues SET status = ? WHERE league_id = ? and league_id != \'0\'';
			$db->Execute($query, array($params['status'], $params['record_id']));
			$params = array('active_tab' => 'leagues');
			break;
		case 'Member':
			$query = 'UPDATE '.cms_db_prefix().'module_tss_member SET status = ? WHERE member_id = ? and member_id != \'0\'';
			$db->Execute($query, array($params['status'], $params['record_id']));
			$params = array('active_tab' => 'members');
			break;
		case 'Season':
			$query = 'UPDATE '.cms_db_prefix().'module_tss_season SET status = ?, modified_date = '.$db->DBTimeStamp(time()).' WHERE season_id = ? and season_id != \'0\'';
			$db->Execute($query, array($params['status'], $params['record_id']));
			$params = array('active_tab' => 'seasons');
			break;
		case 'Team':
			$query = 'UPDATE '.cms_db_prefix().'module_tss_team SET status = ?, modified_date = '.$db->DBTimeStamp(time()).' WHERE team_id = ? and team_id != \'0\'';
			$db->Execute($query, array($params['status'], $params['record_id']));
			$params = array('active_tab' => 'teams');
			break;
		default:
			break;
	}

    // redirect the user to the default admin screen
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}

?>