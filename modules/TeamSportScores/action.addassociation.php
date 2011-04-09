<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function will handle the adding of an association
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

if (!$this->CheckPermission('Modify TeamSportScores')) {
	echo $this->ShowErrors($this->Lang('accessdenied', array('Modify TeamSportScores')));
	return;
}

$maxperiods = 2;
if (isset($params['maxperiods'])) {
	$maxperiods = $params['maxperiods'];
}

$periodheading = $this->Lang('period');
if (isset($params['periodheading'])) {
	$periodheading = $params['periodheading'];
}

$periodlabel = $this->Lang('period');
if (isset($params['periodlabel'])) {
	$periodlabel = $params['periodlabel'];
}

if (isset($params['pcblack'])) {
	$pcblack = $params['pcblack'];
}
if (isset($params['pcblue'])) {
	$pcblue = $params['pcblue'];
}
if (isset($params['pcgreen'])) {
	$pcgreen = $params['pcgreen'];
}
if (isset($params['pcred'])) {
	$pcred = $params['pcred'];
}
if (isset($params['pcwhite'])) {
	$pcwhite = $params['pcwhite'];
}
if (isset($params['pcyellow'])) {
	$pcyellow = $params['pcyellow'];
}

if (isset($params['cancel'])) {
	$params = array('active_tab' => 'associations');
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$desc = '';
if (isset($params['description'])) {
	$desc = $params['description'];
	$maxperiods = $params['maxperiods'];
	$periodheading = $params['periodheading'];
	$periodlabel = $params['periodlabel'];
	if ($desc != ''  && $maxperiods != '' && $periodheading != '' && $periodlabel != '') {
		$assid = $db->GenID(cms_db_prefix()."module_tss_association_seq");
		$time = $db->DBTimeStamp(time());
		$query = 'INSERT INTO '.cms_db_prefix().'module_tss_association (association_id, description, maxperiods, periodheading, periodlabel,
			penaltycardblack, penaltycardblue, penaltycardgreen, penaltycardred, penaltycardwhite, penaltycardyellow, 
			create_date, modified_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,'.$time.','.$time.')';
		$db->Execute($query, array($assid, $desc, $maxperiods, $periodheading, $periodlabel, 
			$pcblack, $pcblue, $pcgreen, $pcred, $pcwhite, $pcyellow));

		@$this->SendEvent('AssociationAdded', array('association_id' => $assid, 'description' => $desc));

		$params = array('tab_message'=> 'associationadded', 'active_tab' => 'associations');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	}
	else
	{
		if ($desc == '') {
			echo $this->ShowErrors($this->Lang('noassociationdescgiven'));
		}
		if ($maxperiods == '') {
			echo $this->ShowErrors($this->Lang('nomaxperiodsgiven'));
		}
		if ($periodheading == '') {
			echo $this->ShowErrors($this->Lang('noperiodheadinggiven'));
		}
		if ($periodlabel == '') {
			echo $this->ShowErrors($this->Lang('noperiodlabelgiven'));
		}
	}
}

#Display template
$this->smarty->assign('startform', $this->CreateFormStart($id, 'addassociation', $returnid));
$this->smarty->assign('endform', $this->CreateFormEnd());
$this->smarty->assign('nametext', $this->Lang('associationdescription'));
$this->smarty->assign('inputname', $this->CreateInputText($id, 'description', $desc, 40, 40));
$this->smarty->assign('titlemaxperiods', $this->Lang('title_maxperiods'));
$this->smarty->assign('inputmaxperiods', $this->CreateInputText($id, 'maxperiods', $maxperiods, 2, 2));
$this->smarty->assign('titleperiodheading', $this->Lang('periodheading'));
$this->smarty->assign('inputperiodheading', $this->CreateInputText($id, 'periodheading', $periodheading, 15, 15));
$this->smarty->assign('titleperiodlabel', $this->Lang('periodlabel'));
$this->smarty->assign('inputperiodlabel', $this->CreateInputText($id, 'periodlabel', $periodlabel, 15, 15));
$this->smarty->assign('titlepenaltycards', $this->Lang('title_penaltycards'));
$this->smarty->assign('titlepcblack', $this->Lang('title_pcblack'));
$this->smarty->assign('inputpcblack', $this->CreateInputCheckbox($id, 'pcblack', true, true));
$this->smarty->assign('titlepcblue', $this->Lang('title_pcblue'));
$this->smarty->assign('inputpcblue', $this->CreateInputCheckbox($id, 'pcblue', true, true));
$this->smarty->assign('titlepcgreen', $this->Lang('title_pcgreen'));
$this->smarty->assign('inputpcgreen', $this->CreateInputCheckbox($id, 'pcgreen', true, true));
$this->smarty->assign('titlepcred', $this->Lang('title_pcred'));
$this->smarty->assign('inputpcred', $this->CreateInputCheckbox($id, 'pcred', true, true));
$this->smarty->assign('titlepcwhite', $this->Lang('title_pcwhite'));
$this->smarty->assign('inputpcwhite', $this->CreateInputCheckbox($id, 'pcwhite', true, true));
$this->smarty->assign('titlepcyellow', $this->Lang('title_pcyellow'));
$this->smarty->assign('inputpcyellow', $this->CreateInputCheckbox($id, 'pcyellow', true, true));
$this->smarty->assign('hidden', '');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));

echo $this->ProcessTemplate('editassociation.tpl');
?>
