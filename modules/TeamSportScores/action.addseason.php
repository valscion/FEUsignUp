<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown
#
# This function will add season information
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

$start_date = $db->DBTimeStamp(time());
if (isset($params['start_date_Month']))
{
	$start_date = date("Ymd",mktime(0, 0, 0, $params['start_date_Month'], $params['start_date_Day'], $params['start_date_Year']));
}

$end_date = strtotime('+12 months', time());
if (isset($params['end_date_Month']))
{
	$end_date = date("Ymd",mktime(0, 0, 0, $params['end_date_Month'], $params['end_date_Day'], $params['end_date_Year']));
}

$status = 'A';
if (isset($params['status']))
{
  $status = $params['status'];
}

if (isset($params['cancel']))
{
	$params = array('active_tab' => 'seasons');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$season_desc = '';
if (isset($params['season_desc']))
{
	$season_desc = $params['season_desc'];
	if ($season_desc != '')
	{
		$season_id = $db->GenID(cms_db_prefix()."module_tss_season_seq");
		$time = $db->DBTimeStamp(time());
		$query = 'INSERT INTO '.cms_db_prefix().'module_tss_season (season_id, season_desc, start_date, end_date, status, create_date, modified_date)
		 VALUES (?,?,'.$start_date.','.$end_date.',?,'.$time.','.$time.')';
		$db->Execute($query, array($season_id, $season_desc, $status));

		@$this->SendEvent('SeasonAdded', array('season_id' => $season_id, 'season_desc' => $season_desc));

		$params = array('tab_message'=> 'seasonadded', 'active_tab' => 'seasons');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	}
	else
	{
		echo $this->ShowErrors($this->Lang('noseasondescgiven'));
	}
}

$statusdropdown = array();
$statusdropdown[$this->Lang('status_active')] = 'A';
$statusdropdown[$this->Lang('status_inactive')] = 'I';

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addseason', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('seasontext', $this->Lang('season_desc'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'season_desc', $season_desc, 50, 50));
$this->smarty->assign_by_ref('start_date', $start_date);
$this->smarty->assign('start_dateprefix', $id.'start_date_');
$this->smarty->assign_by_ref('end_date', $end_date);
$this->smarty->assign('end_dateprefix', $id.'end_date_');
$this->smarty->assign('startdatetext', $this->Lang('seasonstartdate'));
$this->smarty->assign('enddatetext', $this->Lang('seasonenddate'));
$this->smarty->assign('statustext', $this->Lang('status'));
$this->smarty->assign('inputstatus', $this->CreateInputDropdown($id, 'status', $statusdropdown, -1, $status));
$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
echo $this->ProcessTemplate('editseason.tpl');
?>
