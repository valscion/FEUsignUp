<?php
#-------------------------------------------------------------------------
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
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

if (isset($params['gss_id'])) {
	$gss_id = $params['gss_id'];
}
else {
	// Returned from delete/update detail, use different parameter
	$gssmatch_id = $params['gssmatch_id'];
}

// If a template has been mentioned, use it
$row= '';
if (isset($params['templatestats'])) {
	$templatequery = 'SELECT * FROM '.cms_db_prefix().'module_tss_template WHERE title = ?';
	$row = $db->GetRow($templatequery, array($params['templatestats']));
}
else {
	// Select first template that can be found from templates table
	// Type 4 is template that starts with stats_.
	$templatequery = 'SELECT * FROM '.cms_db_prefix().'module_tss_template WHERE type_id = 4 ORDER BY title';
	$row = $db->GetRow($templatequery);
}
if ($row) {
	// It would be very strang that there is no template, so one hit will be made at least
	$template_id = $row['template_id'];
	$fetemplate = $row['template'];
	// Initialize for next use during querying
	$row= '';	
}

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
	if ($row['hometeam_score'] != NULL) {
		if ($row['hometeam_score'] != 'C') {
			$match_score = $row['hometeam_score'].' - '.$row['visitorteam_score'];
		}
		else {
			// This match has been canceled (due to flood, snow or other reason)
			$match_score = $this->Lang('cancelledcode');
		}
	}
	else {
		$match_score = $this->Lang('noscoreavailable');
	}
	$league_name = $row['name'];
	$usedleague_id = $row['league_id'];
	$matchreport = $row['matchreport'];
}

// Display template
$this->smarty->assign('titlehometeam', $this->Lang('title_hometeam'));
$this->smarty->assign('hometeamname', $hometeam);
$this->smarty->assign('titlevisitorteam', $this->Lang('title_visitorteam'));
$this->smarty->assign('visitorteamname', $visitorteam);
$this->smarty->assign('titlelocation', $this->Lang('title_location'));
$this->smarty->assign('location', $location);
$this->smarty->assign('titlescore', $this->Lang('title_score'));
$this->smarty->assign('match_score', $match_score);
$this->smarty->assign('matchdatetitle', $this->Lang('title_matchdate'));
$this->smarty->assign_by_ref('match_date', $usedmatch_date);
$this->smarty->assign('match_dateprefix', $id.'match_date_');
$this->smarty->assign('use_24hours', $this->GetPreference('use_24hour_clock', true));
$this->smarty->assign('display_seconds', $this->GetPreference('show_seconds', true));
$this->smarty->assign('leaguetitle', $this->Lang('league'));
$this->smarty->assign('leaguename', $leaguename);
$this->smarty->assign('hometeamscoretitle', $this->Lang('title_hometeamscore'));
$this->smarty->assign('hometeamscore', $hometeam_score);
$this->smarty->assign('visitorteamscoretitle', $this->Lang('title_visitorteamscore'));
$this->smarty->assign('visitorteamscore', $visitorteam_score);
$this->smarty->assign('matchreporttitle', $this->Lang('title_matchreport'));
$this->smarty->assign('matchreport', $matchreport);

// Prepare a list of players of the home team
$homeplayerlist = array();
// Add a none existing member in case no players exist
$NotApplicable=$this->Lang('*None');
$homeplayerlist[$NotApplicable] = 0;
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_member WHERE status = \'A\' and team_id = ? ORDER BY membername';
$dbresult = $db->Execute($query, array($usedhometeam_id));

while ($dbresult && $row = $dbresult->FetchRow())
{
	$homeplayerlist[$row['membername']] = $row['member_id'];
}

// Array is now filled with name and number. Using flip, it will become number and name
$homeplayernames = array();
$homeplayernames = array_flip($homeplayerlist);

// Build list of possible penalty cards
$penaltycardlist = array();
// Add a non applicable card
$NotApplicable=$this->Lang('*None');
$penaltycardlist[$NotApplicable] = 'NA';
$penaltycardlist[$this->Lang('title_pcblack')] = 'BLACK';
$penaltycardlist[$this->Lang('title_pcblue')] = 'BLUE';
$penaltycardlist[$this->Lang('title_pcgreen')] = 'GREEN';
$penaltycardlist[$this->Lang('title_pcred')] = 'RED';
$penaltycardlist[$this->Lang('title_pcwhite')] = 'WHITE';
$penaltycardlist[$this->Lang('title_pcyellow')] = 'YELLOW';
$penaltycardnames = array();
$penaltycardnames = array_flip($penaltycardlist);

// Prepare a list of players of the visitors team
$visitorplayerlist = array();
// Add a none existing member in case no players exist
$NotApplicable=$this->Lang('*None');
$visitorplayerlist[$NotApplicable] = 0;
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_member WHERE status = \'A\' and team_id = ? ORDER BY membername';
$dbresult = $db->Execute($query, array($usedvisitorteam_id));

while ($dbresult && $row = $dbresult->FetchRow())
{
	$visitorplayerlist[$row['membername']] = $row['member_id'];
}
$visitorplayernames = array();
$visitorplayernames = array_flip($visitorplayerlist);

// Check if there are any stats available. If so, show them
$this->smarty->assign('statedit', '0');
$stattime = 0;
if (isset($params['stattime']))
{
	$stattime = $params['stattime'];
}

$params['stattime'] = 0;

// Prepare a list of all the statistics, sort them by time during match
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_gamestats WHERE gss_id = ? ORDER BY stattime';
$dbresult = $db->Execute($query, array($gss_id));

// Prepare images that can be shown
$imageurl = '<img src="'.$config['root_url'].DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'TeamSportScores'.
	DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
$imagepcblack = $imageurl.'bf.png" alt="'.$penaltycardnames['BLACK'].'">';
$imagepcblue = $imageurl.'cs.png" alt="'.$penaltycardnames['BLUE'].'">';
$imagepcgreen = $imageurl.'af.png" alt="'.$penaltycardnames['GREEN'].'">';
$imagepcred = $imageurl.'cr.png" alt="'.$penaltycardnames['RED'].'">';
$imagepcwhite = $imageurl.'bw.png" alt="'.$penaltycardnames['WHITE'].'">';
$imagepcyellow = $imageurl.'be.png" alt="'.$penaltycardnames['YELLOW'].'">';

$rowclass = 'row1';
$entryarray = array();

while ($dbresult && $row = $dbresult->FetchRow())
{
	$onerow = new stdClass();

	$onerow->id = $row['gamestat_id'];
	$onerow->stattime = $row['stattime'];
	if ($row['hplayer_id'] > 0) {
		$onerow->hplayer = $homeplayernames[$row['hplayer_id']];
	}
	if ($row['hplayer_goal'] == 1) {
		$onerow->hplayer_goal = $row['hplayer_goal'];
	}
	$onerow->hplayer_pc = '&nbsp;';
	if ($row['hplayer_pcb'] == 1) {
		$onerow->hplayer_pc = $penaltycardnames['BLACK'].' '.$imagepcblack;
	}
	if ($row['hplayer_pcbl'] == 1) {
		$onerow->hplayer_pc = $penaltycardnames['BLUE'].' '.$imagepcblue;
	}
	if ($row['hplayer_pcg'] == 1) {
		$onerow->hplayer_pc = $penaltycardnames['GREEN'].' '.$imagepcgreen;
	}
	if ($row['hplayer_pcr'] == 1) {
		$onerow->hplayer_pc = $penaltycardnames['RED'].' '.$imagepcred;
	}
	if ($row['hplayer_pcw'] == 1) {
		$onerow->hplayer_pc = $penaltycardnames['WHITE'].' '.$imagepcwhite;
	}
	if ($row['hplayer_pcy'] == 1) {
		$onerow->hplayer_pc = $penaltycardnames['YELLOW'].' '.$imagepcyellow;
	}
	if ($row['vplayer_id'] > 0) {
		$onerow->vplayer = $visitorplayernames[$row['vplayer_id']];
	}
	if ($row['vplayer_goal'] == 1) {
		$onerow->vplayer_goal = $row['vplayer_goal'];
	}
	$onerow->vplayer_pc = '&nbsp;';
	if ($row['vplayer_pcb'] == 1) {
		$onerow->vplayer_pc = $penaltycardnames['BLACK'].' '.$imagepcblack;
	}
	if ($row['vplayer_pcbl'] == 1) {
		$onerow->vplayer_pc = $penaltycardnames['BLUE'].' '.$imagepcblue;
	}
	if ($row['vplayer_pcg'] == 1) {
		$onerow->vplayer_pc = $penaltycardnames['GREEN'].' '.$imagepcgreen;
	}
	if ($row['vplayer_pcr'] == 1) {
		$onerow->vplayer_pc = $penaltycardnames['RED'].' '.$imagepcred;
	}
	if ($row['vplayer_pcw'] == 1) {
		$onerow->vplayer_pc = $penaltycardnames['WHITE'].' '.$imagepcwhite;
	}
	if ($row['vplayer_pcy'] == 1) {
		$onerow->vplayer_pc = $penaltycardnames['YELLOW'].' '.$imagepcyellow;
	}
	if ($row['vplayer_id'] > 0) {
		$onerow->vplayer = $visitorplayernames[$row['vplayer_id']];
	}

	$onerow->rowclass = $rowclass;

	$entryarray[] = $onerow;

	($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
}
$this->smarty->assign_by_ref('items', $entryarray);
$this->smarty->assign('itemcount', count($entryarray));
// Make sure that the statistics are shown once there is at least one
if ( count($entryarray) > 0 ) {
	$this->smarty->assign('statedit', '1');
}

$this->smarty->assign('stattimetext', $this->Lang('stattime'));
$this->smarty->assign('inputstattime', $this->CreateInputText($id, 'stattime', $stattime, 4, 4));
$this->smarty->assign('playertext', $this->Lang('playertext'));
$this->smarty->assign('inputhomeplayerid', $this->CreateInputDropdown($id, 'homeplayer_id', $homeplayerlist, -1, $usedhomeplayer_id));
$this->smarty->assign('player_goaltext', $this->Lang('player_goaltext'));
$this->smarty->assign('penaltycard', $this->Lang('penaltycard'));
$this->smarty->assign('inputhplayer_goal', $this->CreateInputCheckbox( $id, 'hplayer_goal', 1, $hplayer_goal));
$this->smarty->assign('inputhplayer_pc', $this->CreateInputDropdown($id, 'hplayer_pc', $penaltycardlist, -1, $usedhomepc));
$this->smarty->assign('inputvisitorplayerid', $this->CreateInputDropdown($id, 'visitorplayer_id', $visitorplayerlist, -1, $usedvisitorplayer_id));
$this->smarty->assign('inputvplayer_goal', $this->CreateInputCheckbox( $id, 'vplayer_goal', 1, $vplayer_goal));
$this->smarty->assign('inputvplayer_pc', $this->CreateInputDropdown($id, 'vplayer_pc', $penaltycardlist, -1, $usedvisitorpc));

$this->smarty->assign('hiddengss', $this->CreateInputHidden($id, 'gss_id', $gss_id));
$this->smarty->assign('submitstat', $this->CreateInputSubmit($id, 'submitstat', $this->Lang('addmatchstats')));
$this->smarty->assign('nostatsavailable', $this->Lang('nostatsavailable'));

// Now show the template

echo $this->ProcessTemplateFromDatabase('teamsportscores_'.$template_id);

?>
