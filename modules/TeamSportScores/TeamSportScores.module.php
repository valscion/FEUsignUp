<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown
#
# This function will install the module Team Sport Scores
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
 
class TeamSportScores extends CMSModule
{

	function GetName()
	{
		return 'TeamSportScores';
	}

	function GetFriendlyName()
	{
		return $this->Lang('friendlyname');
	}

	function GetVersion()
	{
		return '1.1.8';
	}

	function GetHelp()
	{
		return $this->Lang('help');
	}

	function GetAuthor()
	{
		return 'Duketown';
	}

	function GetAuthorEmail()
	{
		return 'cmsms at duketown dot eu';
	}

	function GetChangeLog()
	{
		return file_get_contents(dirname(__FILE__).'/changelog.inc');
	}

	function IsPluginModule()
	{
		return true;
	}

	function HasAdmin()
	{
		return true;
	}

	function GetAdminSection()
	{
		return 'extensions';
	}

	function GetAdminDescription()
	{
		return $this->Lang('moddescription');
	}

	function VisibleToAdminUser()
	{
        return $this->CheckPermission('Use TeamSportScores');
	}

	function GetDependencies()
	{
		return array();
	}

	function MinimumCMSVersion()
	{
		return "1.0.3";
	}
	
	function SetParameters()
	{
		# The top most parameter will be shown in the bottom and vice versa
		$this->CreateParameter('timeformat', 'g:i a', $this->Lang('helptimeformat'));
		$this->CreateParameter('templatestats', '', $this->Lang('helptemplatestats'));
		$this->CreateParameter('templatereport', '', $this->Lang('helptemplatereport'));
		$this->CreateParameter('template', '', $this->Lang('helptemplate'));
		$this->CreateParameter('teamlength', '50', $this->Lang('helpteamlength'));
		$this->CreateParameter('team', '', $this->Lang('helpteam'));
		$this->CreateParameter('sortorder', '', $this->Lang('helpsortorder'));
		$this->CreateParameter('showlocation', '1', $this->Lang('helpshowlocation'));
		$this->CreateParameter('played', '', $this->Lang('helpplayed'));
		$this->CreateParameter('orderby', '', $this->Lang('helporderby'));
		$this->CreateParameter('noscorecode', '', $this->Lang('helpnoscorecode'));
		$this->CreateParameter('noheading', '', $this->Lang('helpnoheading'));
		$this->CreateParameter('matchlimit', '', $this->Lang('helpmatchlimit'));
		$this->CreateParameter('league', '', $this->Lang('helpleague'));
		$this->CreateParameter('display', '', $this->Lang('helpdisplay'));
		$this->CreateParameter('dateformat', 'F j, Y, g:i a', $this->Lang('helpdateformat'));
		$this->CreateParameter('cancelledcode', '', $this->Lang('helpcancelled'));
	}


	function GetEventDescription ( $eventname )
	{
		return $this->Lang('event_info_'.$eventname );
	}


	function GetEventHelp ( $eventname )
	{
		return $this->Lang('event_help_'.$eventname );
	}

	function InstallPostMessage()
	{
		return $this->Lang('postinstall');
	}

	function UninstallPostMessage()
	{
		return $this->Lang('postuninstall');
	}

	function UninstallPreMessage()
	{
		return $this->Lang('really_uninstall');
	}
	
	function DisplayErrorPage($id, &$params, $returnid, $message='')
	{
		$this->smarty->assign('title_error', $this->Lang('error'));
		if ($message != '')
			{
				$this->smarty->assign_by_ref('message', $message);
			}

	    // Display the populated template
	    echo $this->ProcessTemplate('error.tpl');
	}

	function DisplayAdminNav($id, &$params, $returnid) {
		$this->smarty->assign('admin_nav',
			$this->CreateLink($id, 'defaultadmin', $returnid, $this->Lang('title_mod_admin'), array()) .
			' : ' .
			$this->CreateLink($id, 'admin_prefs', $returnid, $this->Lang('title_mod_prefs'), array()));
	}

	/* --------------------------------------------------------
		GetListClubs($status = 'A')
		A function to return all clubs in an array
		A status of '%' means all clubs will be listed
		--------------------------------------------------------*/	
	function GetListClubs($status = 'A')
	{
		// Initialize the Database
		$db = cmsms()->GetDb();

		$clublist = array();
		$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_club';
		$query .= ' WHERE status = ?';
		$query .= ' ORDER BY description';
		$dbresult = $db->Execute($query, array($status));
		
		while ($dbresult && $row = $dbresult->FetchRow())
		{
			$clublist[$row['description']] = $row['club_id'];
		}
		return $clublist;
	}		

	/* --------------------------------------------------------
		GetListSeasons($status = 'A')
		A function to return all seasons in an array
		A status of '%' means all seasons will be listed
		--------------------------------------------------------*/	
	function GetListSeasons($status = 'A')
	{
		// Initialize the Database
		$db = cmsms()->GetDb();
		
		$seasonlist = array();
		$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_season';
		$query .= ' WHERE status LIKE ?';
		$query .= ' ORDER BY start_date desc';
		$dbresult = $db->Execute($query, array($status));
		
		while ($dbresult && $row = $dbresult->FetchRow())
		{
			$seasonlist[$row['season_desc']] = $row['season_id'];
		}
		
		return $seasonlist;
	}
}

?>
