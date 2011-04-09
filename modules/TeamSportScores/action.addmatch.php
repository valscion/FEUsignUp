<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function will add match information
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

if (!$this->CheckPermission('Use TeamSportScores'))
{
	echo $this->ShowErrors($this->Lang('accessdenied', array('Use TeamSportScores')));
	return;
}

if (isset($params['cancel']))
{
	$params = array('active_tab' => 'matches');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);			
}

$hometeam = '';
if (isset($params['hometeam']))
{
	$hometeam = $params['hometeam'];
}
$usedhometeam_id = '';
if (isset($params['hometeam_id']))
{
	$usedhometeam_id = $params['hometeam_id'];
	// Check if the hometeam was filled, if not fill it with the name from the table
	if ($hometeam == '')
	{
		$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_team WHERE team_id = ?';
		$row = $db->GetRow($query, array($usedhometeam_id));
		if ($row)
		{
			$hometeam = $row['team_name'];
		}
	}
}

$visitorteam = '';
if (isset($params['visitorteam']))
{
	$visitorteam = $params['visitorteam'];
}
$usedvisitorteam_id = '';
if (isset($params['visitorteam_id']))
{
	$usedvisitorteam_id = $params['visitorteam_id'];
	// Check if the visitor team was filled, if not fill it with the name from the table
	if ($visitorteam == '')
	{
		$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_team WHERE team_id = ?';
		$row = $db->GetRow($query, array($usedvisitorteam_id));
		if ($row)
		{
			$visitorteam = $row['team_name'];
		}
	}
}

$location = '';
if (isset($params['location']))
{
	$location = $params['location'];
}

$match_date = time();
if (isset($params['match_date_Month']))
{
	$match_date = mktime($params['match_date_Hour'], $params['match_date_Minute'], $params['match_date_Second'], $params['match_date_Month'], $params['match_date_Day'], $params['match_date_Year']);
}

$usedleague_id = $this->GetPreference('default_league_id', '');
if (isset($params['league_id']))
{
	$usedleague_id = $params['league_id'];
}

$hometeam_score = NULL;
if (isset($params['hometeam_score']))
{
	$hometeam_score = $params['hometeam_score'];
}

$visitorteam_score = NULL;
if (isset($params['visitorteam_score']))
{
	$visitorteam_score = $params['visitorteam_score'];
}

$matchreport = '';
if (isset($params['matchreport']))
{
	$matchreport = $params['matchreport'];
}

if (isset($params['hometeam']))
{
	if ( ($hometeam != '' || $usedhometeam_id != '') && $visitorteam != '')
	{
		$gss_id = $db->GenID(cms_db_prefix()."module_tss_gameschedule_score_seq");
		$hometeam_id = 0;
		$visitorteam_id = 0;
		$query = 'INSERT INTO '.cms_db_prefix().'module_tss_gameschedule_score ( 
			gss_id, date, location, hometeam, visitorteam, hometeam_id, visitorteam_id,
			hometeam_score, visitorteam_score, league_id, matchreport)
			VALUES (?,?,?,?,?,?,?,?,?,?,?)';
		$db->Execute($query, array(
			$gss_id, trim($db->DBTimeStamp($match_date), "'"), $location, $hometeam, 
			$visitorteam, $usedhometeam_id, $usedvisitorteam_id, $hometeam_score, 
			$visitorteam_score, $usedleague_id, $matchreport));

		@$this->SendEvent('TSSMatchAdded', array('gss_id' => $gss_id));

		$params = array('tab_message'=> 'matchadded', 'active_tab' => 'matches');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	}
	else
	{
		echo $this->ShowErrors($this->Lang('noteamsgiven'));
	}
}

// Prepare dropdown values for leagues
$leaguelist = array();
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_leagues WHERE status = \'A\' ORDER BY name';
$dbresult = $db->Execute($query);

while ($dbresult && $row = $dbresult->FetchRow())
{
	$leaguelist[$row['name']] = $row['league_id'];
}

// Prepare dropdown values for hometeams (only active teams allowed)
$hometeamlist = array();
// Add a none existing team if teamname is manually entered
$NotApplicable=$this->Lang('*None');
$hometeamlist[$NotApplicable] = 0;
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_team WHERE status = \'A\' and team_id != \'0\' ORDER BY team_name';
$dbresult = $db->Execute($query);

while ($dbresult && $row = $dbresult->FetchRow())
{
	$hometeamlist[$row['team_name']] = $row['team_id'];
}

// Prepare a list of the visitors teams
$visitorteamlist = array();
$visitorteamlist = $hometeamlist;

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addmatch', $returnid));
$this->smarty->assign('hometeamtitle', $this->Lang('title_hometeam'));
$this->smarty->assign('hometeamidinput', $this->CreateInputDropdown($id, 'hometeam_id', 
	$hometeamlist, -1, $usedhometeam_id, 'class="defaultfocus"'));
$this->smarty->assign('ortitle', $this->Lang('title_or_teamid'));
$this->smarty->assign('hometeaminput', $this->CreateInputText($id, 'hometeam', $hometeam, 50, 50));
$this->smarty->assign('visitorteamtitle', $this->Lang('title_visitorteam'));
$this->smarty->assign('visitorteamidinput', $this->CreateInputDropdown($id, 'visitorteam_id', 
	$visitorteamlist, -1, $usedvisitorteam_id));
$this->smarty->assign('visitorteaminput', $this->CreateInputText($id, 'visitorteam', $visitorteam, 50, 50));
$this->smarty->assign('locationtitle', $this->Lang('title_location'));
$this->smarty->assign('locationinput', $this->CreateInputText($id, 'location', $location, 50, 50));
$this->smarty->assign('matchdatetitle', $this->Lang('title_matchdate'));
$this->smarty->assign_by_ref('match_date', $match_date);
$this->smarty->assign('match_dateprefix', $id.'match_date_');
$this->smarty->assign('use_24hours', $this->GetPreference('use_24hour_clock', true));
$this->smarty->assign('display_seconds', $this->GetPreference('show_seconds', true));
$this->smarty->assign('leaguetitle', $this->Lang('league'));
$this->smarty->assign('leagueinput', $this->CreateInputDropdown($id, 'league_id', $leaguelist, -1, $usedleague_id));
$this->smarty->assign('hometeamscoretitle', $this->Lang('title_hometeamscore'));
$this->smarty->assign('hometeamscoreinput', $this->CreateInputText($id, 'hometeam_score', $hometeam_score, 5, 5));
$this->smarty->assign('visitorteamscoretitle', $this->Lang('title_visitorteamscore'));
$this->smarty->assign('visitorteamscoreinput', $this->CreateInputText($id, 'visitorteam_score', $visitorteam_score, 5, 5));
$this->smarty->assign('matchreporttitle', $this->Lang('title_matchreport'));
$this->smarty->assign('matchreportinput', $this->CreateTextArea(true, $id, $matchreport, 
	'matchreport', '', '', '', '', '80', '10'));

$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
$this->smarty->assign('endform', $this->CreateFormEnd());

echo $this->ProcessTemplate('editmatch.tpl');
?>