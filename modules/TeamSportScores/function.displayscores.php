<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function will handle the front end request to Team Sport Scores
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

$db =& $this->GetDb();

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

$dateformat = "F j, Y, g:i a";
if (isset($params['dateformat'])) {
	$dateformat = $params['dateformat'];
}

$timeformat = "g:i a";
if (isset($params['timeformat'])) {
	$timeformat = $params['timeformat'];
}

// Prepare the basic part of the query
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_gameschedule_score WHERE gss_id > 0';

// Check if a specific team has been requested to show
if (isset($params['team'])) {
	$team_id = $params['team'];
	$query .= ' AND (hometeam_id = '.$team_id.' || visitorteam_id = '.$team_id.')';
}

// Check if a specific league has been requested to show
if (isset($params['league'])) {
	$league_name = $params['league'];
	$query .= ' AND league_id IN (SELECT league_id FROM '.cms_db_prefix().'module_tss_leagues WHERE upper(name)= upper(\''.$league_name.' \'))';
}

// Selection on played or still to be played matches
if (isset($params['played'])) {
	$played = $params['played'];
	switch ($played) {
		case '1':
			$query .= ' AND hometeam_score <> \'\'';
			break;
		case '2':
			$query .= ' AND hometeam_score = \'\'';
			break;
		default:
			break;
	}

}

// Prepare the length of the team codes to present
if (isset($params['teamlength'])) {
	$teamlength = $params['teamlength'];
	if ( $teamlength < 1 ) {
		$teamlength = 1;
	}
	else {
		if ( $teamlength > 20 ) {
			$teamlength = 20;
		}
	}
}
else {
	$teamlength = 50;
}

// Prepare the constant to present if match has been canceled
if (isset($params['cancelledcode'])) {
	$cancelledcode = $params['cancelledcode'];
} 
else {
	$cancelledcode = $this->Lang('cancelledcode');
}

// Check if the location is to be shown (0 = No, 1 = Yes)
$showlocation = '1';
if (isset($params['showlocation'])) {
	$showlocation = $params['showlocation'];
	if ($showlocation <> '0' && $showlocation <> '1') {
		$showlocation = '1';
	}
}

// Prepare the constant to present if no score is available yet
if (isset($params['noscorecode'])) {
	$noscorecode = $params['noscorecode'];
}
else {
	$noscorecode = $this->Lang('noscoreavailable');
}

// Set the order sequence
$query .= ' ORDER BY date';

// Sorting order. If it starts with a d, descending is assumed. Otherwise, default is ascending
if (isset($params['sortorder'])) {
	$sortorder = strtoupper(substr($params['sortorder'], 0, 1));
	if ( $sortorder == 'D' ) {
		$query .= ' desc';
	}
}

// Set limit of matches
if (isset($params['matchlimit'])) {
	$matchlimit = $params['matchlimit'];
	if ( $matchlimit > 0 ) {
		$query .= ' LIMIT '.$matchlimit;
	}
}

// Exclude headings?
$smarty->assign('heading', 1);
if (isset($params['noheading'])) {
	$smarty->assign('heading', 0);
}

// If a template has been mentioned, use it
$row= '';
if (isset($params['template'])) {
	$templatequery = 'SELECT * FROM '.cms_db_prefix().'module_tss_template WHERE title = ?';
	$row = $db->GetRow($templatequery, array($params['template']));
}
else {
	// Select first template that can be found from templates table
	$templatequery = 'SELECT * FROM '.cms_db_prefix().'module_tss_template WHERE type_id = 3 ORDER BY title';
	$row = $db->GetRow($templatequery);
}
if ($row) {
	// It would be very strang that there is no template, so one hit will be made at least
	$template_id = $row['template_id'];
	$fetemplate = $row['template'];
	// Initialize for next use during querying
	$row= '';	
}

// Check if time should be suppressed if playing time not set
$displaytime_when_0000 = $this->GetPreference('displaytime_when_0000', false);

// Query string has been build completly, now request it
$dbresult = $db->Execute($query);

$fe_showstatistics = $this->GetPreference('fe_show_statistics', true);
$rowclass = 'row1';

while ($dbresult && $row = $dbresult->FetchRow())
{
	$onerow = new stdClass();

	$onerow->id = $row['gss_id'];
	$onerow->hometeam = substr($row['hometeam'], 0, $teamlength);
	$onerow->visitorteam = substr($row['visitorteam'], 0, $teamlength);
	$onerow->hometeamscore = $row['hometeam_score'];
	$onerow->visitorteamscore = $row['visitorteam_score'];
  $match_date = date($dateformat, $db->UnixTimeStamp($row['date']));
  $match_date = str_ireplace( array("monday","tuesday","wednesday","thursday","friday","saturday","sunday"), array("maanantai","tiistai","keskiviikko","torstai","perjantai","lauantai","sunnuntaina"), $match_date );
	$onerow->match_date = str_ireplace( array("mon","tue","wed","thu","fri","sat","sun"), array("ma","ti","ke","to","pe","la","su"), $match_date );
	$testmatch_time = date('Hi', $db->UnixTimeStamp($row['date']));
	if ($testmatch_time == '0000') {
		if (!$displaytime_when_0000) {
			$onerow->match_time = date($timeformat, $db->UnixTimeStamp($row['date']));
		}
	}
	else {
		$onerow->match_time = date($timeformat, $db->UnixTimeStamp($row['date']));
	}
	if ($showlocation == '1') {
		$onerow->location = $row['location'];
	}
  
	
	if ($row['hometeam_score'] != NULL) {
		if ($row['hometeam_score'] != 'C') {
			if ($fe_showstatistics) {
				if (isset($params['templatestats'])) { 
					$templatestats = $params['templatestats'];
				} else {
					unset($params['template']);
				}
				$onerow->match_score = $this->CreateFrontendLink($id, $returnid, 'displaymatchstats', $row['hometeam_score'].' - '.$row['visitorteam_score'], 
					array('gss_id'=>$row['gss_id'], 'templatestats'=>$templatestats), '', false, false, '');
			}
			else {
					$onerow->match_score = $row['hometeam_score'].' - '.$row['visitorteam_score'];
			}
		}
		else {
			// This match has been canceled (due to flood, snow or other reason)
			$onerow->match_score = $cancelledcode;
		}
	}
	else {
		$onerow->match_score = $noscorecode;
	}
	if ($row['matchreport'] != '') {
		$onerow->matchreport = $this->CreateFrontendLink($id, $returnid, 'displaymatchreport', $this->Lang('displaymatchreport'), 
			array('gss_id'=>$row['gss_id'], 'templatereport'=>$params['templatereport']), '', false, false, '');
	}

	$onerow->rowclass = $rowclass;

	$entryarray[] = $onerow;

	($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
}

// Based upon the preferences to show midnight or not, the time variable can be used or not
$smarty->assign('showtime', $displaytime_when_0000);
$smarty->assign('showlocation', $showlocation);

$smarty->assign('itemcount', count($entryarray));
$smarty->assign_by_ref('items', $entryarray);
$smarty->assign('titlehometeam', $this->Lang('title_hometeam'));
$smarty->assign('titlevisitorteam', $this->Lang('title_visitorteam'));
$smarty->assign('titlelocation', $this->Lang('title_location'));
$smarty->assign('titlematchdate', $this->Lang('title_matchdate'));
$smarty->assign('titlematchtime', $this->Lang('title_matchtime'));
$smarty->assign('titlescore', $this->Lang('title_score'));
$smarty->assign('titlematchreport', $this->Lang('title_matchreport'));

echo $this->ProcessTemplateFromDatabase('teamsportscores_'.$template_id);
?>