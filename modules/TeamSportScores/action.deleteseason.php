<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function deletes a season
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

$season_id = '';
if (isset($params['season_id']))
{
  $season_id = $params['season_id'];
}

// Reset all the teams to no season situation
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_team WHERE season_id = ?';
$row = $db->GetRow( $query, array($season_id) );
if ($row) {
  $query = 'UPDATE '.cms_db_prefix().'module_tss_team set season_id=0 WHERE season_id = ?';
  $db->Execute($query, array($season_id) );
}

// Remove the season
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_season WHERE season_id = ?';
$row = $db->GetRow( $query, array($season_id) );
if ($row) {
  $query = 'DELETE FROM '.cms_db_prefix().'module_tss_season WHERE season_id = ?';
  $db->Execute($query, array($season_id) );
}

@$this->SendEvent('OnseasonDeleted', array('season_id' => $season_id, 'season_desc' => $row['season_desc']));

$params = array('tab_message'=> 'seasondeleted', 'active_tab' => 'seasons');
$this->Redirect($id, 'defaultadmin', $returnid, $params);
?>
