<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function allows the administrator to change team information
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
	$params = array('active_tab' => 'teams');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$team_id = '';
if (isset($params['team_id']))
{
  $team_id = $params['team_id'];
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

$sexe = 'BOTH';
if (isset($params['sexe']))
{
 $sexe = $params['sexe'];
}

$status = 'A';
if (isset($params['status']))
{
$status = $params['status'];
}

$team_name = '';
if (isset($params['team_name']))
  {
    $team_name = $params['team_name'];
    if ($team_name != '')
      {

	$team_code = strtoupper($team_code);
	if ($team_id == 0) {
		 $usedclub_id = 0;
	}
	$query = 'UPDATE '.cms_db_prefix().'module_tss_team SET team_code = ?, team_name = ?, club_id= ?, season_id= ?, status = ?, sexe = ?, modified_date = '.$db->DBTimeStamp(time()).' WHERE team_id = ?';
	$db->Execute($query, array($team_code, $team_name, $usedclub_id, $usedseason_id, $status, $sexe, $team_id));

	@$this->SendEvent('TeamEdited', array('team_id' => $team_id, 'team_name' => $team_name));

	$params = array('tab_message'=> 'teamupdated', 'active_tab' => 'teams');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
      }
    else
      {
		echo $this->ShowErrors($this->Lang('noteamdescgiven'));
      }
  }
 else
   {
     $query = 'SELECT * FROM '.cms_db_prefix().'module_tss_team WHERE team_id = ?';
     $row = $db->GetRow($query, array($team_id));

     if ($row)
       {
      	 $team_code = $row['team_code'];
      	 $team_name = $row['team_name'];
      	 $usedclub_id = $row['club_id'];
      	 $usedseason_id = $row['season_id'];
      	 $sexe = $row['sexe'];
      	 $status = $row['status'];
       }
   }

$statusdropdown = array();
$statusdropdown[$this->Lang('status_active')] = 'A';
$statusdropdown[$this->Lang('status_inactive')] = 'I';

$clublist = array();
$query = "SELECT * FROM ".cms_db_prefix()."module_tss_club ORDER BY description";
$dbresult = $db->Execute($query);

while ($dbresult && $row = $dbresult->FetchRow())
{
$clublist[$row['description']] = $row['club_id'];
}

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

$sexedropdown = array();
$sexedropdown['Male'] = 'MALE';
$sexedropdown['Female'] = 'FEMALE';
$sexedropdown['Both'] = 'BOTH';

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'editteam', $returnid));
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
$this->smarty->assign('statustext', $this->Lang('status'));
$this->smarty->assign('inputstatus', $this->CreateInputDropdown($id, 'status', $statusdropdown, -1, $status));
$this->smarty->assign('sexetext', $this->Lang('sexe'));
$this->smarty->assign('inputsexe', $this->CreateInputDropdown($id, 'sexe', $sexedropdown, -1, $sexe));
$this->smarty->assign('hidden', $this->CreateInputHidden($id, 'team_id', $team_id));
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
echo $this->ProcessTemplate('editteam.tpl');
?>
