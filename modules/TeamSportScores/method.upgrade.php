<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown
#
# This function will upgrade the module Team Sport Scores
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

$current_version = $oldversion;

// mysql-specific, but ignored by other database
$taboptarray = array('mysql' => 'TYPE=MyISAM');

$dict = NewDataDictionary($db);

switch($current_version)
{
	case '1.0':
		// Table schema description for leagues
		$flds = "
			league_id I KEY,
			name C(50),
			status C(1)
			";

		// Create it. for leagues This should do error checking.
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix().'module_tss_leagues',$flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);

		// Create a sequence for leagues
		$db->CreateSequence(cms_db_prefix().'module_tss_leagues_seq');

		// Table schema description for table: association
		$flds = "
			association_id I KEY,
			description C(40),
			create_date " . CMS_ADODB_DT . ",
			modified_date " . CMS_ADODB_DT . "
		";

		// Create the association table
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix().'module_tss_association',$flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);
		$this->CreateEvent( 'AssociationAdded' );
		$this->CreateEvent( 'AssociationEdited' );
		$this->CreateEvent( 'ClubAdded' );
		$this->CreateEvent( 'ClubEdited' );
		$this->CreateEvent( 'TeamAdded' );
		$this->CreateEvent( 'TeamEdited' );
		$this->CreateEvent( 'OnMatchDeleted' );
		$this->CreateEvent( 'OnSeasonDeleted' );
		$this->CreateEvent( 'OnTeamDeleted' );
		
		// Table schema description for table: club
		$flds = "
			club_id I KEY,
			description C(40),
			association_id I,
			status C(1),
			create_date " . CMS_ADODB_DT . ",
			modified_date " . CMS_ADODB_DT . "
		";
		// Create the club table
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix().'module_tss_club',$flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);
		// Create a sequence
		$db->CreateSequence(cms_db_prefix().'module_tss_club_seq');
		// Create a default club for 'roaming' members. Roaming members are those
		// members that, currently, are not connected to a team and thus not to any club
		$club_id = 0;
		$description = 'Floating Member Club';
		$association_id = 0;
		$status = 'A';
		$time = $db->DBTimeStamp(time());
		$query = 'INSERT INTO '.cms_db_prefix().'module_tss_club (club_id, description, association_id, status, create_date, modified_date)
		VALUES (?, ?, ?, ?, '.$time.', '.$time.')';
		$db->Execute($query, array($club_id, $description, $association_id, $status));

		// Table schema description for table: season
		$flds = "
			season_id I KEY,
			season_desc C(50),
			start_date D,
			end_date D,
			status C(1),
			create_date " . CMS_ADODB_DT . ",
			modified_date " . CMS_ADODB_DT . "
			";
		$dict = NewDataDictionary($db);
		$taboptarray = array('mysql' => 'TYPE=MyISAM');
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix().'module_tss_season',
			$flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);
		// Create a sequence
		$db->CreateSequence(cms_db_prefix().'module_tss_season_seq');
		// Create a default season for 'roaming' members. Roaming members are those
		// members that, currently, are not connected to a team. The Floating Team has a season id 0
		// and must there for be generated here
		$season_id = 0;
		$season_desc = 'Floating Team Season';
		$status = 'A';
		$query = 'INSERT INTO '.cms_db_prefix().'module_tss_season (season_id, season_desc, start_date, end_date, status, create_date, modified_date)
			VALUES (?, ?, '.$time.', '.$time.', ?, '.$time.', '.$time.')';
		$db->Execute($query, array($season_id, $season_desc, $status));

		// Table schema description for table: team
		$flds = "
			team_id I KEY,
			team_code C(10),
			club_id I,
			team_name C(255),
			sexe C(10),
			start_date " . CMS_ADODB_DT . ",
			end_date " . CMS_ADODB_DT . ",
			status C(1),
			season_id I,
			create_date " . CMS_ADODB_DT . ",
			modified_date " . CMS_ADODB_DT . "
			";
		// Create it
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix().'module_tss_team',
			$flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);

		// Create a sequence
		$db->CreateSequence(cms_db_prefix().'module_tss_team_seq');
		// Create a default team for 'roaming' members. Roaming members are those
		// members that, currently, are not connected to a team
		$team_id = 0;
		$team_code = '*NONE';
		$club_id = 0;
		$team_name = 'Floating Member Team';
		$sexe = 'BOTH';
		$status = 'A';
		$season_id = 0;
		$time = $db->DBTimeStamp(time());
		$query = 'INSERT INTO '.cms_db_prefix().'module_tss_team (team_id, team_code, club_id, team_name, sexe, start_date, end_date, status, season_id, create_date, modified_date)
		 VALUES (?, ?, ?, ?, ?, '.$time.', '.$time.', ?, ?, '.$time.', '.$time.')';
		$db->Execute($query, array($team_id, $team_code, $club_id, $team_name, $sexe, $status, $season_id));
	
		// Table schema description for table: members
		$flds = "
			member_id I KEY,
			user_id I,
			team_id I,
			type C(10),
			may_see_evaluation L,
			note C(255),
			status C(1),
			create_date " . CMS_ADODB_DT . ",
			modified_date " . CMS_ADODB_DT . "
			";
		$dict = NewDataDictionary($db);
		$taboptarray = array('mysql' => 'TYPE=MyISAM');
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix().'module_tss_member',
			$flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);
		// Create a sequence
		$db->CreateSequence(cms_db_prefix().'module_tss_member_seq');
		
  		$current_version = '1.1.2';

	case '1.1.2':
		// No changes to database made
  		$current_version = '1.1.3';

	case '1.1.3':
		// There are multiple leagues in one season for some sports, so need for a column to save season
		$dict = NewDataDictionary($db);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_leagues', 'season_id I' );
		$dict->ExecuteSQLArray($sqlarray);
		// As a result of adding the column season to a league, a league is needed per match and season is removed from match
		$dict = NewDataDictionary($db);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_gameschedule_score', 'league_id I' );
		$dict->ExecuteSQLArray($sqlarray);
		$dict = NewDataDictionary($db);
		$sqlarray = $dict->DropColumnSQL(cms_db_prefix().'module_tss_gameschedule_score', 'season_id' );
		$dict->ExecuteSQLArray($sqlarray);
		
		$this->SetPreference('default_league_id', 0);
		$this->SetPreference('use_24hour_clock', true);
		$this->SetPreference('show_seconds', false);
		$this->SetPreference('displaytime_when_0000', false);
		$this->SetPreference('default_sexes', 0);
		$this->SetPreference('dateformat', '%x');

  		$current_version = '1.1.4';

	case '1.1.4':
		// Table schema description for templates
		$flds = "
			template_id I KEY,
			type_id I,
			title C(255),
			template X
			";
		// Create it.
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix().'module_tss_template',$flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);
		// Create a sequence for templates
		$db->CreateSequence(cms_db_prefix().'module_tss_template_seq');

		// Table schema description for template types
		$flds = "
			type_id I KEY,
			name C(25)
			";
		// Create it.
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix().'module_tss_template_type',$flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);
		// Prepare various types
		$query = 'INSERT INTO '. cms_db_prefix(). 'module_tss_template_type VALUES (?,?)';
		$dbresult = $db->Execute($query,array(1, $this->Lang('league_page')));
		$dbresult = $db->Execute($query,array(2, $this->Lang('team_page')));
		$dbresult = $db->Execute($query,array(3, $this->Lang('summary_page')));
		
		// Save the current version of the template in the new template table
		$template = $this->GetTemplate('summary_template', 'TeamSportScores');
		$template_id = $db->GenID(cms_db_prefix().'module_tss_template_seq');
		$query = 'INSERT INTO '.cms_db_prefix().'module_tss_template (template_id, type_id, title, template)
		 VALUES (?,?,?,?)';
		$db->Execute($query, array($template_id, 3, 'Summary-Upgrade', $template));

		// Drop the template, since now template table is used
		$this->DeleteTemplate('summary_template', 'TeamSportScores');
		// Now recreate with new contents
		$this->SetTemplate('teamsportscores_'.$template_id, $template);

  		$current_version = '1.1.5';

	case '1.1.5':
		// Additional fields for members
		$dict = NewDataDictionary($db);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_member', 'membername C(50)' );
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_member', 'points_last_season I' );
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_member', 'points_this_season I' );
		$dict->ExecuteSQLArray($sqlarray);
		// Initialize the point fields
		$query = 'UPDATE '.cms_db_prefix().'module_tss_member SET points_this_season = 0, points_last_season = 0';
		$db->Execute($query);


		// There are some default values to be stored at association level
		$dict = NewDataDictionary($db);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_association', 'maxperiods I' );
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_association', 'periodheading C(15)' );
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_association', 'periodlabel C(15)' );
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_association', 'penaltycardblack L' );
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_association', 'penaltycardblue L' );
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_association', 'penaltycardgreen L' );
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_association', 'penaltycardred L' );
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_association', 'penaltycardwhite L' );
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_association', 'penaltycardyellow L' );
		$dict->ExecuteSQLArray($sqlarray);
		// New preference which will allow which user table is used for the members
		$this->SetPreference('user_table', '*none');
		$this->SetPreference('fe_show_statistics', '*none');

		// Table schema description for table: game statistics
		$flds = "
			gamestat_id I KEY,
			gss_id I,
			stattime I,
			period I,
			hplayer_id I,
			hplayer_goal L,
			hplayer_pcy L,
			hplayer_pcr L,
			hplayer_pcg L,
			hplayer_pcw L,
			hplayer_pcb L,
			hplayer_pcbl L,
			vplayer_id I,
			vplayer_goal L,
			vplayer_pcy L,
			vplayer_pcr L,
			vplayer_pcg L,
			vplayer_pcw L,
			vplayer_pcb L,
			vplayer_pcbl L,
			info C(60)
			";

		// Create it. This should do error checking.
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix().'module_tss_gamestats',$flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);
		// Create a sequence
		$db->CreateSequence(cms_db_prefix().'module_tss_gamestats_seq');
		
		// Insert new template type
		$query = 'INSERT INTO '. cms_db_prefix(). 'module_tss_template_type VALUES (?,?)';
		$dbresult = $db->Execute($query,array(4, $this->Lang('stats_page')));

  		$current_version = '1.1.6';

	case '1.1.6':
		// Insert new field to hold the report of a match
		$dict = NewDataDictionary($db);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_tss_gameschedule_score', 'matchreport X' );
		$dict->ExecuteSQLArray($sqlarray);

		$current_version = '1.1.7';

	case '1.1.7':

		$current_version = '1.1.8';
}

// Insert an audit trail in the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('upgraded',$this->GetVersion()));

?>