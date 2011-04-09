<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function allows the administrator to change club information
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
	$params = array('active_tab' => 'clubs');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
  }

$club_id = '';
if (isset($params['club_id']))
  {
    $club_id = $params['club_id'];
  }

$usedassociation = '';
if (isset($params['association_id']))
  {
    $usedassociation = $params['association_id'];
  }

$status = 'A';
if (isset($params['status']))
{
$status = $params['status'];
}

$description = '';
if (isset($params['description']))
  {
    $description = $params['description'];
    if ($description != '')
      {

	$query = 'UPDATE '.cms_db_prefix().'module_tss_club SET description = ?, association_id= ?, status = ?, modified_date = '.$db->DBTimeStamp(time()).' WHERE club_id = ?';
	$db->Execute($query, array($description, $usedassociation, $status, $club_id));

	@$this->SendEvent('ClubEdited', array('club_id' => $club_id, 'description' => $description));

	$params = array('tab_message'=> 'clubupdated', 'active_tab' => 'clubs');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
      }
    else
      {
		echo $this->ShowErrors($this->Lang('noclubdescgiven'));
      }
  }
 else
   {
     $query = 'SELECT * FROM '.cms_db_prefix().'module_tss_club WHERE club_id = ?';
     $row = $db->GetRow($query, array($club_id));

     if ($row)
       {
      	 $description = $row['description'];
      	 $usedassociation = $row['association_id'];
      	 $status = $row['status'];
       }
   }

$statusdropdown = array();
$statusdropdown[$this->Lang('status_active')] = 'A';
$statusdropdown[$this->Lang('status_inactive')] = 'I';

$associationlist = array();
$query = "SELECT * FROM ".cms_db_prefix()."module_tss_association ORDER BY description";
$dbresult = $db->Execute($query);

while ($dbresult && $row = $dbresult->FetchRow())
{
$associationlist[$row['description']] = $row['association_id'];
}

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'editclub', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('nametext', $this->Lang('clubdescription'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'description', $description, 40, 40));
$this->smarty->assign('associationtext', $this->Lang('association'));
$this->smarty->assign('inputassociation', $this->CreateInputDropdown($id, 'association_id', $associationlist, -1, $usedassociation));
$this->smarty->assign('statustext', $this->Lang('status'));
$this->smarty->assign('inputstatus', $this->CreateInputDropdown($id, 'status', $statusdropdown, -1, $status));
$this->smarty->assign('hidden', $this->CreateInputHidden($id, 'club_id', $club_id));
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
echo $this->ProcessTemplate('editclub.tpl');
?>
