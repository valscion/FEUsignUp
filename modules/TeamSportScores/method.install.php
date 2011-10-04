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

$gCms = cmsms(); if( !is_object($gCms) ) exit;
$db = cmsms()->GetDb();

// mysql-specific, but ignored by other database
$taboptarray = array('mysql' => 'TYPE=MyISAM');

$dict = NewDataDictionary($db);

// Table schema description for table: games (in other words the matches)
$flds = "
	gss_id I KEY,
	date " . CMS_ADODB_DT . ",
	location C(50),
	hometeam C(50),
	visitorteam C(50),
	hometeam_id I,
	visitorteam_id I,
	hometeam_score C(5),
	visitorteam_score C(5),
	league_id I,
	matchreport X
	";

// Create it. This should do error checking.
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_tss_gameschedule_score",$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
// Create a sequence
$db->CreateSequence(cms_db_prefix()."module_tss_gameschedule_score_seq");

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
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_tss_gamestats",$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
// Create a sequence
$db->CreateSequence(cms_db_prefix()."module_tss_gamestats_seq");

// Table schema description for table: association
$flds = "
	association_id I KEY,
	description C(40),
	maxperiods I,
	periodheading C(15),
	periodlabel C(15),
	penaltycardblack L,
	penaltycardblue L,
	penaltycardgreen L,
	penaltycardred L,
	penaltycardwhite L,
	penaltycardyellow L,
	create_date " . CMS_ADODB_DT . ",
	modified_date " . CMS_ADODB_DT . "
";
// Create the association table
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_tss_association",$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
// Create a sequence
$db->CreateSequence(cms_db_prefix()."module_tss_association_seq");

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
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_tss_club",$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
// Create a sequence
$db->CreateSequence(cms_db_prefix()."module_tss_club_seq");
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

// Table schema description for table: members
$flds = "
	member_id I KEY,
	user_id I,
	membername C(50),
	team_id I,
	type C(10),
	may_see_evaluation L,
	points_last_season I,
	points_this_season I,
	note C(255),
	status C(1),
	create_date " . CMS_ADODB_DT . ",
	modified_date " . CMS_ADODB_DT . "
	";
$dict = NewDataDictionary($db);
$taboptarray = array('mysql' => 'TYPE=MyISAM');
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_tss_member",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
// Create a sequence
$db->CreateSequence(cms_db_prefix()."module_tss_member_seq");

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
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_tss_season",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
// Create a sequence
$db->CreateSequence(cms_db_prefix()."module_tss_season_seq");
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
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_tss_team",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// Create a sequence
$db->CreateSequence(cms_db_prefix()."module_tss_team_seq");
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

// Table schema description for leagues
$flds = "
	league_id I KEY,
	name C(50),
	season_id I,
	status C(1)
	";
// Create it.
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_tss_leagues",$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
// Create a sequence for leagues
$db->CreateSequence(cms_db_prefix()."module_tss_leagues_seq");

// Table schema description for templates
$flds = "
	template_id I KEY,
	type_id I,
	title C(255),
	template X
	";
// Create it.
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_tss_template",$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
// Create a sequence for templates
$db->CreateSequence(cms_db_prefix()."module_tss_template_seq");

// Table schema description for template types
$flds = "
	type_id I KEY,
	name C(25)
	";
// Create it.
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_tss_template_type",$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
// Prepare various types
$query = 'INSERT INTO '. cms_db_prefix(). 'module_tss_template_type VALUES (?,?)';
$dbresult = $db->Execute($query,array(1, $this->Lang('league_page')));
$dbresult = $db->Execute($query,array(2, $this->Lang('team_page')));
$dbresult = $db->Execute($query,array(3, $this->Lang('summary_page')));
$dbresult = $db->Execute($query,array(4, $this->Lang('stats_page')));

// Create permissions
$this->CreatePermission('Use TeamSportScores', 'Use Team Sport Scores');
$this->CreatePermission('Modify TeamSportScores', 'Modify Team Sport Scores');

// create a preference
$this->SetPreference('default_league_id', 0);
$this->SetPreference('use_24hour_clock', true);
$this->SetPreference('show_seconds', false);
$this->SetPreference('displaytime_when_0000', false);
$this->SetPreference('default_sexes', 0);
$this->SetPreference('dateformat', '%x');
$this->SetPreference('user_table', '*none');
$this->SetPreference('fe_show_statistics', '*none');

// Register events that the Team Sport Scores will issue. Other modules
// or user tags will be able to subscribe to these events, and trigger
// other actions when it gets called.
$this->CreateEvent( 'OnTeamSportScoresPreferenceChange' );
$this->CreateEvent( 'AssociationAdded' );
$this->CreateEvent( 'AssociationEdited' );
$this->CreateEvent( 'ClubAdded' );
$this->CreateEvent( 'ClubEdited' );
$this->CreateEvent( 'TeamAdded' );
$this->CreateEvent( 'TeamEdited' );
$this->CreateEvent( 'SeasonAdded' );
$this->CreateEvent( 'SeasonEdited' );
$this->CreateEvent( 'OnMatchDeleted' );
$this->CreateEvent( 'OnSeasonDeleted' );
$this->CreateEvent( 'OnTeamDeleted' );

// Mention installation in the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('installed',$this->GetVersion()));

?>