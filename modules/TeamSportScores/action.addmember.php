<?php
# Sport Coach Manager. A plugin for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function will add information of a member
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

global $gCms;
$db =& $gCms->GetDb();

if (!$this->CheckPermission('Modify TeamSportScores')) {
	echo $this->ShowErrors($this->Lang('accessdenied', array('Modify TeamSportScores')));
	return;
}

$useduser_id = 0;
if (isset($params['user_id'])) {
 	 $useduser_id = $params['user_id'];
}

$usedteam_id = 0;
if (isset($params['team_id'])) {
 	 $usedteam_id = $params['team_id'];
}

$type = 'PLAYER';
if (isset($params['type'])) {
 	 $type = $params['type'];
}

$may_see_evaluation = 0;
if (isset($params['may_see_evaluation'])) {
 	 $may_see_evaluation = $params['may_see_evaluation'];
}

$note = '';
if (isset($params['note'])) {
 	 $note = $params['note'];
}

$status = 'A';
if (isset($params['status'])) {
 	 $status = $params['status'];
}


if (isset($params['cancel'])) {
 	 $params = array('active_tab' => 'members', 'team_id'=>$usedteam_id);
	 $this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$user_id = 0;
$membername = '';
$errorfound = 'No';

$prefusertable = $this->GetPreference('user_table', 'CMSMS_USR');
switch ($prefusertable) {
	case 'CMSMS_USR':
	case 'FEU_USR':
		if (isset($params['user_id'])) {
			$user_id = $params['user_id'];
			if ($user_id != 0) {
				$member_id = $db->GenID(cms_db_prefix()."module_tss_member_seq");
				$time = $db->DBTimeStamp(time());
				$query = 'INSERT INTO '.cms_db_prefix().'module_tss_member (member_id, user_id, membername, team_id, 
					type, may_see_evaluation, points_last_season, points_this_season, note, status, create_date, modified_date)
					VALUES (?,?,?,?,?,?, 0, 0,?,?,'.$time.','.$time.')';
				$db->Execute($query, array($member_id, $useduser_id, $membername, $usedteam_id, $type, $may_see_evaluation, $note, $status));

				#$message = $this->Lang('memberadded', $membername);
				echo $this->ShowMessage($this->Lang('memberadded', $membername));
				#@$this->SendEvent('tssmemberAdded', array('member_id' => $member_id, 'user_id' => $user_id));

			}
			else {
				echo $this->ShowErrors($this->Lang('nouserselected'));
				$errorfound = 'Yes';
			}
		}
		break;
	case 'MAN_USR':
		if (isset($params['membername'])) {
		 	$membername = $params['membername'];
			if ($membername != '') {
				$member_id = $db->GenID(cms_db_prefix()."module_tss_member_seq");
				$time = $db->DBTimeStamp(time());
				$query = 'INSERT INTO '.cms_db_prefix().'module_tss_member (member_id, user_id, membername, team_id, 
					type, may_see_evaluation, note, status, create_date, modified_date)
					VALUES (?,?,?,?,?,?,?,?,'.$time.','.$time.')';
				$db->Execute($query, array($member_id, $useduser_id, $membername, $usedteam_id, $type, $may_see_evaluation, $note, $status));

				echo $this->ShowMessage($this->Lang('memberadded', $membername));
				#$params['message'] = $this->Lang('memberadded', $membername);
				#@$this->SendEvent('tssmemberAdded', array('member_id' => $member_id, 'user_id' => $user_id));

			}
			else {
				echo $this->ShowErrors($this->Lang('nonameentered'));
				$errorfound = 'Yes';
			}
		}
		break;
	default:
		break;
}

if ($errorfound == 'No' && $params['submit'] != '' ) {
	$params = array('tab_message'=> 'memberwasadded', 'active_tab' => 'members', 'team_id'=>$usedteam_id, 'saveandnew'=>$params['saveandnew']);
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}
else {
	if ($errorfound == 'No' ) {
		// Appearantly the user wants to add another member, clear some datafields
		$useduser_id = 0;
		$type = 'PLAYER';
		$may_see_evaluation = 0;
		$membername = '';
		$note = '';
		$status = 'A';
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
switch ($prefusertable) {
	case 'CMSMS_USR':
		$query = "SELECT * FROM ".cms_db_prefix()."users ORDER BY first_name";
		$dbresult = $db->Execute($query);

		while ($dbresult && $row = $dbresult->FetchRow()) {
			$userlist[$row['first_name'].' '.$row['last_name']] = $row['user_id'];
		}
		break;
	case 'FEU_USR':
		$query = "SELECT * FROM ".cms_db_prefix()."module_feusers_users ORDER BY username";
		$dbresult = $db->Execute($query);

		while ($dbresult && $row = $dbresult->FetchRow()) {
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

// Future usage
$seeevaldropdown = array();
$seeevaldropdown['No'] = 0;
$seeevaldropdown['All'] = 1;
$seeevaldropdown['Own'] = 2;

$statusdropdown = array();
$statusdropdown['Active'] = 'A';
$statusdropdown['Inactive'] = 'I';

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addmember', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('prefusertable', $prefusertable);
$this->smarty->assign('usertext', $this->Lang('member'));
$this->smarty->assign('inputuser', $this->CreateInputDropdown($id, 'user_id', $userlist, -1, $useduser));
$this->smarty->assign('ormembernametext', $this->Lang('ormembername'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'membername', $membername, 50, 50));
$this->smarty->assign('teamtext', $this->Lang('team'));
$this->smarty->assign('inputteam', $this->CreateInputDropdown($id, 'team_id', $teamlist, -1, $usedteam_id));
$this->smarty->assign('typetext', $this->Lang('membertype'));
$this->smarty->assign('inputtype', $this->CreateInputDropdown($id, 'type', $typedropdown, -1, $type));
$this->smarty->assign('seeevaltext', $this->Lang('may_see_evaluation'));
$this->smarty->assign('inputseeeval', $this->CreateInputDropdown($id, 'may_see_evaluation', $seeevaldropdown, -1, $may_see_evaluation));
$this->smarty->assign('notetext', $this->Lang('membernote'));
$this->smarty->assign('inputnote', $this->CreateTextArea(false, $id, $note, 'note', 'pagesmalltextarea', 'note'));
$this->smarty->assign('statustext', $this->Lang('status'));
$this->smarty->assign('inputstatus', $this->CreateInputDropdown($id, 'status', $statusdropdown, -1, $status));
$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('saveandnew', $this->CreateInputSubmit($id, 'saveandnew', $this->Lang('saveandnew')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
echo $this->ProcessTemplate('editmember.tpl');
?>
