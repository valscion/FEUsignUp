<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function will handle adding a template
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

global $gCms;
$db =& $gCms->GetDb();

if (!$this->CheckPermission('Modify TeamSportScores'))
{
	echo $this->ShowErrors($this->Lang('accessdenied', array('Modify TeamSportScores')));
	return;
}

$usedtype_id = '';
if (isset($params['type_id']))
{
	$usedtype_id = $params['type_id'];
}

if (isset($params['cancel']))
{
	$params = array('active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$template = '';
if (isset($params['template']))
{
	$template = $params['template'];
}

$title = '';
if (isset($params['title']))
{
	$title = $params['title'];
	if ($title != '')
	{
		$template_id = $db->GenID(cms_db_prefix()."module_tss_template_seq");
		$query = 'INSERT INTO '.cms_db_prefix().'module_tss_template (template_id, type_id, title, template)
		 VALUES (?,?,?,?)';
		$db->Execute($query, array($template_id, $usedtype_id, $title, $template));
		// Create template so retrieval from database is easy
		$this->SetTemplate('teamsportscores_'.$template_id,$template);

		$params = array('tab_message'=> 'templateadded', 'active_tab' => 'templates');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	}
	else
	{
		echo $this->ShowErrors($this->Lang('notemplatedescgiven'));
	}
}

// Build list of possible template types
$typedropdown = array();
$typedropdown[$this->Lang('league_page')] = 1;
$typedropdown[$this->Lang('team_page')] = 2;
$typedropdown[$this->Lang('summary_page')] = 3;
$typedropdown[$this->Lang('stats_page')] = 4;

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addtemplate', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('titletext', $this->Lang('title'));
$this->smarty->assign('titleinput', $this->CreateInputText($id, 'title', $title, 40, 40));
$this->smarty->assign('templatetext',$this->Lang('template'));
$this->smarty->assign('templateinput', $this->CreateTextArea(false, $id, $template,'template', '','','','',80,25));
$this->smarty->assign('typetext', $this->Lang('templatetype'));
$this->smarty->assign('typeinput', $this->CreateInputDropdown($id, 'type_id', $typedropdown, -1, $usedtype_id));
$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
echo $this->ProcessTemplate('edittemplate.tpl');
?>
