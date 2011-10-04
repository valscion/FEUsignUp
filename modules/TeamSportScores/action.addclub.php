<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown
#
# This function will handle adding a club
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
$db = cmsms()->GetDb();

if (!$this->CheckPermission('Modify TeamSportScores'))
{
	echo $this->ShowErrors($this->Lang('accessdenied', array('Modify TeamSportScores')));
	return;
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

if (isset($params['cancel']))
{
	$params = array('active_tab' => 'clubs');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$desc = '';
if (isset($params['description']))
{
	$desc = $params['description'];
	if ($desc != '')
	{
		$clubid = $db->GenID(cms_db_prefix()."module_tss_club_seq");
		$time = $db->DBTimeStamp(time());
		$query = 'INSERT INTO '.cms_db_prefix().'module_tss_club (club_id, description, association_id, status, create_date, modified_date)
		 VALUES (?,?,?,?,'.$time.','.$time.')';
		$db->Execute($query, array($clubid, $desc, $usedassociation, $status));

		@$this->SendEvent('ClubAdded', array('club_id' => $assid, 'description' => $desc));

		$params = array('tab_message'=> 'clubadded', 'active_tab' => 'clubs');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	}
	else
	{
		echo $this->ShowErrors($this->Lang('noclubdescgiven'));
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
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addclub', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('nametext', $this->Lang('clubdescription'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'description', $desc, 40, 40));
$this->smarty->assign('associationtext', $this->Lang('association'));
$this->smarty->assign('inputassociation', $this->CreateInputDropdown($id, 'association_id', $associationlist, -1, $usedassociation));
$this->smarty->assign('statustext', $this->Lang('status'));
$this->smarty->assign('inputstatus', $this->CreateInputDropdown($id, 'status', $statusdropdown, -1, $status));
$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
echo $this->ProcessTemplate('editclub.tpl');
?>
