<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function will edit existing match information
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

$detailpage = '';
if (isset($params['detailpage']))
{
	$manager =& $gCms->GetHierarchyManager();
	$node =& $manager->sureGetNodeByAlias($params['detailpage']);
	if (isset($node))
		{
			$content =& $node->GetContent();
			if (isset($content))
			{
			$detailpage = $content->Id();
			}
		}
	else
	{
		$node =& $manager->sureGetNodeById($params['detailpage']);
		if (isset($node))
		{
			$detailpage = $params['detailpage'];
		}
	}
}

if (!$this->CheckPermission('Modify TeamSportScores'))
{
 	echo $this->ShowErrors($this->Lang('needpermission', array('Modify TeamSportScores')));
	return;
}

if (isset($params['cancel']))
{
	$params = array('active_tab' => 'matches');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$gss_id = '';
if (isset($params['gss_id']))
{
	$gss_id = $params['gss_id'];
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
	$usedmatch_date = mktime($params['match_date_Hour'], $params['match_date_Minute'], $params['match_date_Second'], $params['match_date_Month'], $params['match_date_Day'], $params['match_date_Year']);
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

$usedleague_id = '';
if (isset($params['league_id']))
{
	$usedleague_id = $params['league_id'];
}

$matchreport = '';
if (isset($params['matchreport']))
{
	$matchreport = $params['matchreport'];
}

$ok_to_update = 'Yes';
if (isset($params['hometeam']))
{
	if ($hometeam == '')
	{
		echo $this->ShowErrors($this->Lang('nohometeamgiven'));
	}
	if ($visitorteam != '')
	{
		echo $this->ShowErrors($this->Lang('novisitorteamgiven'));
	}
	
	// Validation done, commence to update if no errors occured
	if ($ok_to_update == 'Yes')
	{
		$query = 'UPDATE '.cms_db_prefix().'module_tss_gameschedule_score SET date = ?, 
			location = ?, hometeam = ?, visitorteam = ?, hometeam_id = ?, 
			visitorteam_id = ?, hometeam_score = ?, visitorteam_score = ?, 
			league_id = ?, matchreport = ? 
			WHERE gss_id = ?';
		$db->Execute($query, array(trim($db->DBTimeStamp($usedmatch_date), "'"), 
			$location, $hometeam, $visitorteam, $usedhometeam_id, 
			$usedvisitorteam_id, $hometeam_score, $visitorteam_score, 
			$usedleague_id, $matchreport,  
			$gss_id));

		@$this->SendEvent('TSSMatchEdited', array('gss_id' => $gss_id, 'hometeam' => $hometeam, 'visitorteam' => $visitorteam));

		$params = array('tab_message'=> 'matchupdated', 'active_tab' => 'matches');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	}
}
else
{
	$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_gameschedule_score WHERE gss_id = ?';
	$row = $db->GetRow($query, array($gss_id));

	if ($row)
	{
		$usedhometeam_id = $row['hometeam_id'];
		$hometeam = $row['hometeam'];
		$usedvisitorteam_id = $row['visitorteam_id'];
		$visitorteam = $row['visitorteam'];
		$location = $row['location'];
		$usedmatch_date = $row['date'];
		$hometeam_score = $row['hometeam_score'];
		$visitorteam_score = $row['visitorteam_score'];
		$usedleague_id = $row['league_id'];
		$matchreport = $row['matchreport'];
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
$imageurl = '<img src="'.$config['root_url'].DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'TeamSportScores'.
	DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
$imagestat = $imageurl.'am.png" alt="'.$this->Lang('addmatchstats').'">';

if ($hometeam_score != NULL && $hometeam_score != 'C') {
	#$this->smarty->assign('addmatchstatslink', $this->CreateLink($id, 'editmatchstats', $returnid, $this->Lang('addmatchstats'), array(gss_id=>$gss_id), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('addmatchstatslink', $this->CreateLink($id, 'editmatchstats', $returnid, $imagestat, array(gss_id=>$gss_id), '', false, false, 'class="pageoptions"').' '.$this->CreateLink($id, 'editmatchstats', $returnid, $this->Lang('addmatchstats'), array(gss_id=>$gss_id), '', false, false, 'class="pageoptions"'));
}
#$this->smarty->assign('addmatchstatslink', $this->CreateLink($id, 'editmatchstats', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addmatchstats'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addmatchstats', $returnid, $this->Lang('addmatchstats'), array(), '', false, false, 'class="pageoptions"'));

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'editmatch', $returnid));
$this->smarty->assign('hometeamtitle', $this->Lang('title_hometeam'));
$this->smarty->assign('hometeamidinput', $this->CreateInputDropdown($id, 'hometeam_id', $hometeamlist, -1, $usedhometeam_id));
$this->smarty->assign('ortitle', $this->Lang('title_or_teamid'));
$this->smarty->assign('hometeaminput', $this->CreateInputText($id, 'hometeam', $hometeam, 50, 50));
$this->smarty->assign('visitorteamtitle', $this->Lang('title_visitorteam'));
$this->smarty->assign('visitorteamidinput', $this->CreateInputDropdown($id, 'visitorteam_id', $visitorteamlist, -1, $usedvisitorteam_id));
$this->smarty->assign('visitorteaminput', $this->CreateInputText($id, 'visitorteam', $visitorteam, 50, 50));
$this->smarty->assign('locationtitle', $this->Lang('title_location'));
$this->smarty->assign('locationinput', $this->CreateInputText($id, 'location', $location, 50, 50));
$this->smarty->assign('matchdatetitle', $this->Lang('title_matchdate'));
$this->smarty->assign_by_ref('match_date', $usedmatch_date);
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

$this->smarty->assign('hidden', $this->CreateInputHidden($id, 'gss_id', $gss_id));
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
$this->smarty->assign('endform', $this->CreateFormEnd());

echo $this->ProcessTemplate('editmatch.tpl');

?>