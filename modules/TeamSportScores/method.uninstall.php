<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown
#
# This function will uninstall the module Team Sport Scores
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

// Remove the database table
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_tss_gameschedule_score" );
$dict->ExecuteSQLArray($sqlarray);
// Remove the sequence
$db->DropSequence( cms_db_prefix()."module_tss_gameschedule_score_seq" );

// Remove the database table
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_tss_gamestats" );
$dict->ExecuteSQLArray($sqlarray);
// Remove the sequence
$db->DropSequence( cms_db_prefix()."module_tss_gamestats_seq" );

// Remove the database table - Association
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_tss_association" );
$dict->ExecuteSQLArray($sqlarray);
// Remove the sequence
$db->DropSequence( cms_db_prefix()."module_tss_association_seq" );

// Remove the database table - Club
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_tss_club" );
$dict->ExecuteSQLArray($sqlarray);
// Remove the sequence
$db->DropSequence( cms_db_prefix()."module_tss_club_seq" );

// Remove the database table - Member
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_tss_member" );
$dict->ExecuteSQLArray($sqlarray);
// Remove the sequence
$db->DropSequence( cms_db_prefix()."module_tss_member_seq" );

// Remove the database table - Team
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_tss_team" );
$dict->ExecuteSQLArray($sqlarray);
// Remove the sequence
$db->DropSequence( cms_db_prefix()."module_tss_team_seq" );

// Remove the database table - Season
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_tss_season" );
$dict->ExecuteSQLArray($sqlarray);
// Remove the sequence
$db->DropSequence( cms_db_prefix()."module_tss_season_seq" );

// Remove the database table for leagues
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_tss_leagues" );
$dict->ExecuteSQLArray($sqlarray);
// Remove the sequence for leagues
$db->DropSequence( cms_db_prefix()."module_tss_leagues_seq" );

// Remove the database table for templates
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_tss_template" );
$dict->ExecuteSQLArray($sqlarray);
// Remove the sequence for templates
$db->DropSequence( cms_db_prefix()."module_tss_template_seq" );

// Remove the database table for template types
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_tss_template_type" );
$dict->ExecuteSQLArray($sqlarray);
// No sequence for the template types, since they are 'hard coded'

// Remove the permissions
$this->RemovePermission('Use TeamSportScores');
$this->RemovePermission('Modify TeamSportScores');

// Remove the preference
#$this->RemovePreference("prepare_auto_rss");
$this->RemovePreference('default_league_id');
$this->RemovePreference('use_24hour_clock');
$this->RemovePreference('show_seconds');
$this->RemovePreference('displaytime_when_0000');
$this->RemovePreference('default_sexes');
$this->RemovePreference('dateformat');
$this->RemovePreference('user_table');
$this->RemovePreference('fe_show_statistics');


// Remove the user preferences
$query = 'DELETE FROM '.cms_db_prefix().'userprefs WHERE preference like "tss_%"';
$db->Execute($query);


// Remove the events
$this->RemoveEvent( 'OnTeamSportScoresPreferenceChange' );
$this->RemoveEvent( 'AssociationAdded' );
$this->RemoveEvent( 'AssociationEdited' );
$this->RemoveEvent( 'ClubAdded' );
$this->RemoveEvent( 'ClubEdited' );
$this->RemoveEvent( 'SeasonAdded' );
$this->RemoveEvent( 'SeasonEdited' );
$this->RemoveEvent( 'TeamAdded' );
$this->RemoveEvent( 'TeamEdited' );
$this->RemoveEvent( 'OnMatchDeleted' );
$this->RemoveEvent( 'OnSeasonDeleted' );
$this->RemoveEvent( 'OnTeamDeleted' );

// Insert an audit trail in the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));

?>