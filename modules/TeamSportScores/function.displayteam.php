<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown
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

$db = cmsms()->GetDb();

// Prepare the basic part of the query
// Check the preferences which table to use
$prefusertable = $this->GetPreference('user_table', '');
switch ($prefusertable) 	{
	case 'CMSMS_USR':
		$query = "SELECT m.*, t.team_name AS team_name, CONCAT(u.first_name, ' ', u.last_name) AS member_name
		FROM "
			.cms_db_prefix(). "module_tss_member m, "
			.cms_db_prefix(). "module_tss_team t, "
			.cms_db_prefix(). "users u
		WHERE m.team_id = t.team_id AND m.user_id = u.user_id";
		break;
	case 'FEU_USR':
		$query = "SELECT m.*, t.team_name AS team_name, username AS member_name
		FROM "
			.cms_db_prefix(). "module_tss_member m, "
			.cms_db_prefix().	"module_tss_team t, "
			.cms_db_prefix(). "module_feusers_users u
		WHERE m.team_id = t.team_id AND m.user_id = u.id";
		break;
	case 'MAN_USR':
	default:
		$query = "SELECT m.*, t.team_name AS team_name, membername AS member_name
		FROM "
			.cms_db_prefix(). "module_tss_member m, "
			.cms_db_prefix().	"module_tss_team t 
		WHERE m.team_id = t.team_id";
		break;
}

// Check if a specific team has been requested to show
$team_id = '';
if (isset($params['team'])) {
	$team_id = $params['team'];
	$query .= ' AND m.team_id = '.$team_id;
}
else {
	// Apparantly all teams/all members requested
	
}

// Check if only active records are to be shown (0 = No, 1 = Yes)
$showactive = '1';
if (isset($params['showactive'])) {
	$showactive = $params['showactive'];
	if ($showactive <> '0' && $showactive <> '1') {
		$showactive = '1';
	}
	if ($showactive == '1') {
		$query .= ' AND m.status = '.$showactive;
	}
}

// Set the order sequence
$orderby = '';
if (isset($params['orderby'])) {
	$orderby = $params['orderby'];
	switch ($prefusertable) 	{
		case 'CMSMS_USR':
			switch ($orderby) {
				case 'team':
					$query .= ' ORDER BY t.team_name';
					break;	
				case 'type':
					$query .= ' ORDER BY m.type';
					break;	
				default:
					$query .= ' ORDER BY u.first_name, u.last_name';
			}
			break;
		case 'FEU_USR':
			switch ($orderby) {
				case 'team':
					$query .= ' ORDER BY t.team_name';
					break;	
				case 'type':
					$query .= ' ORDER BY m.type';
					break;	
				default:
					$query .= ' ORDER BY u.username';
			}
			break;
		case 'MAN_USR':
		default:
			switch ($orderby) {
				case 'team':
					$query .= ' ORDER BY t.team_name';
					break;
				case 'type':
					$query .= ' ORDER BY m.type';
					break;	
				default:
					$query .= ' ORDER BY m.membername';
			}
	}
}
else {
	$query .= ' ORDER BY m.membername';
}

// Sorting order. If it starts with a d, descending is assumed. Otherwise, default is ascending
if (isset($params['sortorder'])) {
	$sortorder = strtoupper(substr($params['sortorder'], 0, 1));
	if ( $sortorder == 'D' ) {
		$query .= ' desc';
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
	$templatequery = 'SELECT * FROM '.cms_db_prefix().'module_tss_template WHERE type_id = 2 ORDER BY title';
	$row = $db->GetRow($templatequery);
}
if ($row) {
	// It would be very strang that there is no template, so one hit will be made at least
	$template_id = $row['template_id'];
	$fetemplate = $row['template'];
	// Initialize for next use during querying
	$row= '';	
}

// Query string has been build completly, now request it
$dbresult = $db->Execute($query);

$rowclass = 'row1';
$entryarray = array();

while ($dbresult && $row = $dbresult->FetchRow()) 	{
	$onerow = new stdClass();

	$onerow->id = $row['member_id'];
	$onerow->name = $row['member_name'];
	$onerow->team = substr($row['team_name'], 0, $teamlength);

	switch ($row['type']) {
		case 'PLAYER':
			$onerow->type = $this->Lang('typeplayer');
			break;
		case 'COACH':
			$onerow->type = $this->Lang('typecoach');
			break;
		case 'DOCTOR':
			$onerow->type = $this->Lang('typemedic');
			break;
		case 'GOALIE':
			$onerow->type = $this->Lang('typegoalie');
			break;
		case 'MANAGER':
			$onerow->type = $this->Lang('typemanager');
			break;
		default:
			break;
	}

	$onerow->rowclass = $rowclass;

	$entryarray[] = $onerow;

	($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
}

$smarty->assign('itemcount', count($entryarray));
$smarty->assign_by_ref('items', $entryarray);

$smarty->assign('titleteam', $this->Lang('team'));
$smarty->assign('titlename', $this->Lang('membername'));
$smarty->assign('titletype', $this->Lang('membertype'));

echo $this->ProcessTemplateFromDatabase('teamsportscores_'.$template_id);
?>