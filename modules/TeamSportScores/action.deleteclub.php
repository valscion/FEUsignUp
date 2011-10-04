<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown
#
# This function deletes a club and resets connected records to floating
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

$club_id = '';
if (isset($params['club_id']))
{
  $club_id = $params['club_id'];
}
/*
// Reset all the member to no team situation
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_member WHERE team_id IN (SELECT team_id FROM '
			 .cms_db_prefix().'module_tss_team WHERE club_id = ?)';
$row = $db->GetRow( $query, array($club_id) );
if ($row) {
  $query = 'UPDATE '.cms_db_prefix().'module_tss_member set team_id=0 WHERE team_id IN (SELECT team_id FROM '
			 .cms_db_prefix().'module_tss_team WHERE club_id = ?)';
  $db->Execute($query, array($club_id) );
}
*/
// Remove any connected teams
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_team WHERE club_id = ?';
$row = $db->GetRow( $query, array($club_id) );
if ($row) {
  $query = 'DELETE FROM '.cms_db_prefix().'module_tss_team WHERE club_id = ?';
  $db->Execute($query, array($club_id) );
}

// Remove the club
$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_club WHERE club_id = ?';
$row = $db->GetRow( $query, array($club_id) );
if ($row) {
  $query = 'DELETE FROM '.cms_db_prefix().'module_tss_club WHERE club_id = ?';
  $db->Execute($query, array($club_id) );
}

@$this->SendEvent('OnclubDeleted', array('club_id' => $club_id, 'description' => $row['description']));

	$params = array('tab_message'=> 'clubdeleted', 'active_tab' => 'clubs');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
?>
