<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function will handle importing default supplied templates
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

// Open the directory that contains the default templates
$dir=opendir(dirname(__FILE__).'/includes');
$temps = array();
// Push all files with extension .tpl in array
while($filespec=readdir($dir))
{
	if(! preg_match('/\.tpl$/i',$filespec))
	{
		continue;
	}
	array_push($temps, $filespec);
}

sort($temps);
$query = 'INSERT INTO '. cms_db_prefix().'module_tss_template  (template_id, type_id, title, template)
	VALUES (?,?,?,?)';

// Loop thru array with files and load them in the database
foreach ($temps as $filespec)
{
	$file = file(dirname(__FILE__).'/includes/'.$filespec);
	$template = implode('', $file);
	// Name of template will become filename without extension
	$temp_name = preg_replace('/\.tpl$/i','',$filespec);
	// Check if it already exists
	$excheck = 'SELECT template_id FROM '.cms_db_prefix().'module_tss_template WHERE title=?';
	$dbcount = $db->Execute($excheck, array($temp_name));
	while ($dbcount && $dbcount->RecordCount() > 0)
	{
		$temp_name .='_new';
		$dbcount = $db->Execute($excheck, array($temp_name));
	}
	// Set the type of template based upon first characters of filename
	$type_id = -1;
	if (substr($temp_name,0,7) == 'League-')
	{
		$type_id = 1;
	}
	else if (substr($temp_name,0,5) == 'Team-')
	{
		$type_id = 2;
	}
	else if (substr($temp_name,0,8) == 'Summary-')
	{
		$type_id = 3;
	}
	else if (substr($temp_name,0,6) == 'Stats-')
	{
		$type_id = 4;
	}
		
	$temp_id = $db->GenID(cms_db_prefix().'module_tss_template_seq');
	$dbresult = $db->Execute($query, array($temp_id, $type_id, $temp_name, $template));
	// Now recreate with new contents
	$this->SetTemplate('teamsportscores_'.$temp_id, $template);
}

// Return to the templates tab
$params = array('active_tab' => 'templates');
$this->Redirect($id, 'defaultadmin', $returnid, $params);
?>
