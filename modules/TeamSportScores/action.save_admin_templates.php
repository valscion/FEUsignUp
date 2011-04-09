<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function will save the database templates for Team Sport Scores
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

if (! $this->CheckPermission('modify TeamSportScores'))
	{
	return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
	}

// Save the templates
if (isset($params['input_summary_template']) && ! empty($params['input_summary_template']))
{
	$this->SetTemplate('summary_template',$params['input_summary_template'],'TeamSportScores');
}

// Finalizing the saving
$params['message'] = $this->Lang('templatesupdated');
$params = array('active_tab' => 'templates');
$this->DoAction('defaultadmin', $id, $params);

?>