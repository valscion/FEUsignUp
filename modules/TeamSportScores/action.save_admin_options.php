<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function allows the administrator to update the preferences
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

if( !$this->CheckPermission( 'Modify TeamSportScores' ) )
{
  return;
}

// Normal save function
$this->SetPreference('default_league_id', $params['default_league_id']);
$this->SetPreference('use_24hour_clock', $params['use_24hour_clock']);
$this->SetPreference('show_seconds', $params['show_seconds']);
$this->SetPreference('displaytime_when_0000', $params['displaytime_when_0000']);
$this->SetPreference('default_sexes', $params['default_sexes']);
$this->SetPreference('dateformat', $params['dateformat']);
$this->SetPreference('user_table', $params['user_table']);
$this->SetPreference('fe_show_statistics', $params['fe_show_statistics']);

$params = array('tab_message'=> 'optionsupdated', 'active_tab' => 'options');
$this->Redirect($id, 'defaultadmin', '', $params);
?>
