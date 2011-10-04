<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown
#
# This function allows the administrator to change the content of a template
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
	$params = array('active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
  }

$template_id = '';
if (isset($params['template_id']))
{
	$template_id = $params['template_id'];
}

$template = '';
if (isset($params['template']))
{
	$template = $params['template'];
}

$type_id = '';
if (isset($params['type_id']))
{
	$type_id = $params['type_id'];
}

$title = '';
if (isset($params['title']))
{
	$title = $params['title'];
	if ($title != '')
	{
		$query = 'UPDATE '.cms_db_prefix().'module_tss_template SET title = ?, template = ?, type_id= ? WHERE template_id = ?';
		$db->Execute($query, array($title, $template, $type_id, $template_id));
		// Make sure old version is removed
		$this->DeleteTemplate('teamsportscores_'.$template_id);
		// Now recreate with new contents
		$this->SetTemplate('teamsportscores_'.$template_id, $template);

		$params = array('tab_message'=> 'templateupdated', 'active_tab' => 'templates');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	}
	else
	{
		echo $this->ShowErrors($this->Lang('notemplatedescgiven'));
	}
}
else
{
	$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_template WHERE template_id = ?';
	$row = $db->GetRow($query, array($template_id));

	if ($row)
	{
		$title = $row['title'];
		$template = $row['template'];
		$usedtype_id = $row['type_id'];
	}
}

// Build list of possible template types
$typedropdown = array();
$typedropdown[$this->Lang('league_page')] = 1;
$typedropdown[$this->Lang('team_page')] = 2;
$typedropdown[$this->Lang('summary_page')] = 3;
$typedropdown[$this->Lang('stats_page')] = 4;

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'edittemplate', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('titletext', $this->Lang('title'));
$this->smarty->assign('titleinput', $this->CreateInputText($id, 'title', $title, 40, 40));
$this->smarty->assign('templatetext',$this->Lang('template'));
$this->smarty->assign('templateinput', $this->CreateTextArea(false, $id, $template,'template', '','','','',80,25));
$this->smarty->assign('typetext', $this->Lang('templatetype'));
$this->smarty->assign('typeinput', $this->CreateInputDropdown($id, 'type_id', $typedropdown, -1, $usedtype_id));
$this->smarty->assign('hidden',
		      $this->CreateInputHidden($id, 'template_id', $template_id));
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
echo $this->ProcessTemplate('edittemplate.tpl');
?>
