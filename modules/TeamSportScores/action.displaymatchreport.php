<?php
#-------------------------------------------------------------------------
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2010 by Duketown <duketown@mantox.nl>
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
if (isset($params['template'])) {
	$templatequery = 'SELECT * FROM '.cms_db_prefix().'module_tss_template WHERE title = ?';
	$row = $db->GetRow($templatequery, array($params['template']));
}
else {
	// Select first template that can be found from templates table
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

// Now show the template

echo $this->ProcessTemplateFromDatabase('teamsportscores_'.$template_id);

?>