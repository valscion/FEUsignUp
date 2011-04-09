<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function will handle and add team information
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/teamsportscores
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
if (!isset($gCms)) exit;

		global $gCms;
		$db =& $gCms->GetDb();

if (!$this->CheckPermission('Modify TeamSportScores'))
{
	echo $this->ShowErrors($this->Lang('accessdenied', array('Modify TeamSportScores')));
	return;
}

$team_code = '';
if (isset($params['team_code']))
{
  $team_code = $params['team_code'];
}

$usedclub_id = '';
if (isset($params['club_id']))
{
  $usedclub_id = $params['club_id'];
}

$usedseason_id = '';
if (isset($params['season_id']))
{
  $usedseason_id = $params['season_id'];
}

$sexe = $this->GetPreference('default_sexes', 0);
if (isset($params['sexe']))
{
  $sexe = $params['sexe'];
}

$start_date = $db->DBTimeStamp(time());
if (isset($params['start_date']))
{
  $start_date = $params['start_date'];
}

$end_date = strftime( "%Y-%m-%d %H:%M:%S", strtotime( "+12 months"));
if (isset($params['end_date']))
{
  $end_date = $params['end_date'];
}

$usedstatus = 'A';
if (isset($params['status']))
{
  $usedstatus = $params['status'];
}

$season_id = 1;
if (isset($params['season_id']))
{
  $season_id = $params['season_id'];
}

if (isset($params['cancel']))
{
	$params = array('active_tab' => 'teams');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$team_name = '';
if (isset($params['team_name']))
{
	$team_name = $params['team_name'];
	if ($team_name != '')
	{
		$team_id = $db->GenID(cms_db_prefix()."module_tss_team_seq");
		$time = $db->DBTimeStamp(time());
		$team_code = strtoupper($team_code);
		$query = 'INSERT INTO '.cms_db_prefix().'module_tss_team (team_id, team_code, club_id, team_name, sexe, start_date, end_date, status, season_id, create_date, modified_date)
		 VALUES (?,?,?,?,?,'.$start_date.',?,?,?,'.$time.','.$time.')';
		$db->Execute($query, array($team_id, $team_code, $usedclub_id, $team_name, $sexe, $end_date, $usedstatus, $usedseason_id));
		@$this->SendEvent('TeamAdded', array('team_id' => $teamid, 'team_name' => $team_name));

		$params = array('tab_message'=> 'teamadded', 'active_tab' => 'teams');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	}
	else
	{
		echo $this->ShowErrors($this->Lang('noteamnamegiven'));
	}
}
$statusdropdown = array();
$statusdropdown[$this->Lang('status_active')] = 'A';
$statusdropdown[$this->Lang('status_inactive')] = 'I';

// Prepare dropdown values for clubs
$clublist = array();
$query = "SELECT * FROM ".cms_db_prefix()."module_tss_club ORDER BY description and status='A'";
$dbresult = $db->Execute($query);

while ($dbresult && $row = $dbresult->FetchRow())
{
	$clublist[$row['description']] = $row['club_id'];
}

// Prepare dropdown values for seasons
$seasonlist = array();
$query = "SELECT * FROM ".cms_db_prefix()."module_tss_season ORDER BY start_date desc";
$dbresult = $db->Execute($query);

while ($dbresult && $row = $dbresult->FetchRow())
{
	$seasonlist[$row['season_desc']] = $row['season_id'];
}
// Add a none existing season if the team should not be connected to a season
$NotApplicable=$this->Lang('*None');
$seasonlist[$NotApplicable] = 0;

// Prepare list of possible sexes
$sexedropdown = array();
$sexedropdown[$this->Lang('male')] = 'MALE';
$sexedropdown[$this->Lang('female')] = 'FEMALE';
$sexedropdown[$this->Lang('both')] = 'BOTH';

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addteam', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('codetext', $this->Lang('team_code'));
$this->smarty->assign('inputcode', $this->CreateInputText($id, 'team_code', $team_code, 10, 10));
$this->smarty->assign('codeautocapital', $this->Lang('team_codeautocapital'));
$this->smarty->assign('nametext', $this->Lang('team_name'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'team_name', $team_name, 40, 255));
$this->smarty->assign('clubtext', $this->Lang('club'));
$this->smarty->assign('inputclub', $this->CreateInputDropdown($id, 'club_id', $clublist, -1, $usedclub_id));
$this->smarty->assign('seasontext', $this->Lang('season'));
$this->smarty->assign('inputseason', $this->CreateInputDropdown($id, 'season_id', $seasonlist, -1, $usedseason_id));
$this->smarty->assign('sexetext', $this->Lang('sexe'));
$this->smarty->assign('inputsexe', $this->CreateInputDropdown($id, 'sexe', $sexedropdown, -1, $sexe));
$this->smarty->assign('statustext', $this->Lang('status'));
$this->smarty->assign('inputstatus', $this->CreateInputDropdown($id, 'status', $statusdropdown, -1, $usedstatus));
$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
echo $this->ProcessTemplate('editteam.tpl');
?>
