<?php
# Sport Coach Manager. A plugin for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function allows the aministrator to change member information
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/teamsportscores/
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
	$params = array('active_tab' => 'members');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
  }

$member_id = '';
if (isset($params['member_id']))
  {
    $member_id = $params['member_id'];
  }

$membername = '';
if (isset($params['membername']))
  {
    $membername = $params['membername'];
  }

$useduser_id = '';
if (isset($params['user_id']))
  {
    $useduser_id = $params['user_id'];
  }

$usedteam_id = '';
if (isset($params['team_id']))
  {
    $usedteam_id = $params['team_id'];
  }

$may_see_evaluation = 0;
if (isset($params['may_see_evaluation']))
  {
    $may_see_evaluation = $params['may_see_evaluation'];
  }

$type = '';
if (isset($params['type']))
  {
    $type = $params['type'];
  }

$note = '';
if (isset($params['note']))
  {
    $note = $params['note'];
  }

$status = 'A';
if (isset($params['status']))
{
$status = $params['status'];
}

$user_id = '';
$retrievememberinfo = '';
$prefusertable = $this->GetPreference('user_table', 'CMSMS_USR');
switch ($prefusertable) {
	case 'CMSMS_USR':
		$membername = '';
	case 'FEU_USR':
		if (isset($params['user_id'])) {
			if ($params['user_id'] != 0) {
				$query = 'UPDATE '.cms_db_prefix().'module_tss_member SET team_id = ?, user_id = ?, membername = ?, note = ?, may_see_evaluation = ?, type = ?, status = ?, modified_date = '.$db->DBTimeStamp(time()).' WHERE member_id = ?';
				$db->Execute($query, array($usedteam_id, $useduser_id, $membername, $note, $may_see_evaluation, $type, $status, $member_id));

				#@$this->SendEvent('tssMemberEdited', array('member_id' => $member_id, 'user_id' => $user_id));

				$params = array('tab_message'=> 'memberupdated', 'active_tab' => 'members');
				$this->Redirect($id, 'defaultadmin', $returnid, $params);
			}
			else {
				echo $this->ShowErrors($this->Lang('nomembergiven'));
			}
		}
		else {
			$retrievememberinfo = 'Yes';
		}
		break;
	case 'MAN_USR':
		if (isset($params['membername'])) {
			if ($member_id != 0) {
				$query = 'UPDATE '.cms_db_prefix().'module_tss_member SET team_id = ?, membername = ?, note = ?, may_see_evaluation = ?, type = ?, status = ?, modified_date = '.$db->DBTimeStamp(time()).' WHERE member_id = ?';
				$db->Execute($query, array($usedteam_id, $membername, $note, $may_see_evaluation, $type, $status, $member_id));

				#@$this->SendEvent('tssMemberEdited', array('member_id' => $member_id, 'user_id' => $user_id));

				$params = array('tab_message'=> 'memberupdated', 'active_tab' => 'members');
				$this->Redirect($id, 'defaultadmin', $returnid, $params);
			}
		}
		else {
			$retrievememberinfo = 'Yes';
		}
		break;
	default:
		break;
}

if ($retrievememberinfo == 'Yes') {
	$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_member WHERE member_id = ?';
	$row = $db->GetRow($query, array($member_id));

	if ($row) {
		$useduser_id = $row['user_id'];
		$membername = $row['membername'];
		$usedteam_id = $row['team_id'];
		$type = $row['type'];
		$may_see_evaluation = $row['may_see_evaluation'];
		$note = $row['note'];
		$status = $row['status'];
	}
}

$typedropdown = array();
$typedropdown[$this->Lang('typeplayer')] = 'PLAYER';
$typedropdown[$this->Lang('typecoach')] = 'COACH';
$typedropdown[$this->Lang('typegoalie')] = 'GOALIE';
$typedropdown[$this->Lang('typemedic')] = 'DOCTOR';
$typedropdown[$this->Lang('typemanager')] = 'MANAGER';

$userlist = array();

// Build a list of users based upon the table defined in the preferences
$prefusertable = $this->GetPreference('user_table', 'CMSMS_USR');
switch ($prefusertable) {
	case "CMSMS_USR":
		$query = "SELECT * FROM ".cms_db_prefix()."users ORDER BY first_name";
		$dbresult = $db->Execute($query);

		while ($dbresult && $row = $dbresult->FetchRow()) 	{
			$userlist[$row['first_name'].' '.$row['last_name']] = $row['user_id'];
		}
	break;
	case "FEU_USR":
		$query = "SELECT * FROM ".cms_db_prefix()."module_feusers_users ORDER BY username";
		$dbresult = $db->Execute($query);

		while ($dbresult && $row = $dbresult->FetchRow()) 	{
			$userlist[$row['username']] = $row['id'];
		}
		break;
	default:
		break;
}

$teamlist = array();
$query = "SELECT * FROM ".cms_db_prefix()."module_tss_team where status<>'I' ORDER BY team_name";
$dbresult = $db->Execute($query);

while ($dbresult && $row = $dbresult->FetchRow()) {
	$teamlist[$row['team_name']] = $row['team_id'];
}

$seeevaldropdown = array();
$seeevaldropdown['No'] = 0;
$seeevaldropdown['All'] = 1;
$seeevaldropdown['Own'] = 2;

$statusdropdown = array();
$statusdropdown['Active'] = 'A';
$statusdropdown['Inactive'] = 'I';

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'editmember', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('prefusertable', $prefusertable);
$this->smarty->assign('usertext', $this->Lang('member'));
$this->smarty->assign('inputuser', $this->CreateInputDropdown($id, 'user_id', $userlist, -1, $useduser_id));
$this->smarty->assign('ormembernametext', $this->Lang('ormembername'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'membername', $membername, 50, 50));
$this->smarty->assign('teamtext', $this->Lang('team'));
$this->smarty->assign('inputteam', $this->CreateInputDropdown($id, 'team_id', $teamlist, -1, $usedteam_id));
$this->smarty->assign('typetext', $this->Lang('membertype'));
$this->smarty->assign('inputtype', $this->CreateInputDropdown($id, 'type', $typedropdown, -1, $type));
$this->smarty->assign('seeevaltext', $this->Lang('may_see_evaluation'));
$this->smarty->assign('inputseeeval', $this->CreateInputDropdown($id, 'may_see_evaluation', $seeevaldropdown, -1, $may_see_evaluation));
$this->smarty->assign('notetext', $this->Lang('membernote'));
$this->smarty->assign('inputnote', $this->CreateTextarea(false, $id, $note, 'note', 'pagesmalltextarea', 'note'));
$this->smarty->assign('statustext', $this->Lang('status'));
$this->smarty->assign('inputstatus', $this->CreateInputDropdown($id, 'status', $statusdropdown, -1, $status));
$this->smarty->assign('hidden', $this->CreateInputHidden($id, 'member_id', $member_id));
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
echo $this->ProcessTemplate('editmember.tpl');
?>
