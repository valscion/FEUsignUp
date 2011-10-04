<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown
#
# This function allows the administrator to change league information
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

$gCms = cmsms(); if( !is_object($gCms) ) exit;

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
	$params = array('active_tab' => 'leagues');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
  }

$league_id = '';
if (isset($params['league_id']))
  {
    $league_id = $params['league_id'];
  }

$usedseason_id = $this->GetPreference('default_season_id', '');
if (isset($params['season_id']))
{
	$usedseason_id = $params['season_id'];
}

$status = 'A';
if (isset($params['status']))
{
	$status = $params['status'];
}

$name = '';
if (isset($params['name']))
  {
    $name = $params['name'];
    if ($name != '')
      {

	$query = 'UPDATE '.cms_db_prefix().'module_tss_leagues SET name = ?, season_id = ?, status = ? WHERE league_id = ?';
	$db->Execute($query, array($name, $usedseason_id, $status, $league_id));

	@$this->SendEvent('LeagueEdited', array('league_id' => $league_id, 'leaguename' => $name));

	$params = array('tab_message'=> 'leagueupdated', 'active_tab' => 'leagues');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
      }
    else
      {
		echo $this->ShowErrors($this->Lang('noleaguenamegiven'));
      }
  }
 else
   {
     $query = 'SELECT * FROM '.cms_db_prefix().'module_tss_leagues WHERE league_id = ?';
     $row = $db->GetRow($query, array($league_id));

     if ($row)
       {
      	 $name = $row['name'];
      	 $status = $row['status'];
       }
   }

// Prepare dropdown values for seasons
$seasonlist = array();
$seasonlist = $this->GetListSeasons('A');

$statusdropdown = array();
$statusdropdown[$this->Lang('status_active')] = 'A';
$statusdropdown[$this->Lang('status_inactive')] = 'I';

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'editleague', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('nametitle', $this->Lang('title_leaguename'));
$this->smarty->assign('nameinput', $this->CreateInputText($id, 'name', $name, 50, 50));
$this->smarty->assign('seasontitle', $this->Lang('season'));
$this->smarty->assign('seasoninput', $this->CreateInputDropdown($id, 'season_id', $seasonlist, -1, $usedseason_id));
$this->smarty->assign('statustext', $this->Lang('status'));
$this->smarty->assign('inputstatus', $this->CreateInputDropdown($id, 'status', $statusdropdown, -1, $status));
$this->smarty->assign('hidden', $this->CreateInputHidden($id, 'league_id', $league_id));
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
echo $this->ProcessTemplate('editleague.tpl');
?>
