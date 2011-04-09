<?php
# Team Sport Scores. A module for CMS - CMS Made Simple
# Copyright (c) 2008 by Duketown <duketown@mantox.nl>
#
# This function will handle the back end information for Team Sport Scores
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

#The tabs
echo $this->StartTabHeaders();
if (FALSE == empty($params['active_tab']))
{
	$tab = $params['active_tab'];
} else {
	$tab = '';
}

if (! $this->CheckPermission('Modify TeamSportScores')) {
	return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

$user_id = '';
if (get_userid() ) {
	$user_id = get_userid();
}

$this->DisplayAdminNav($id, $params, $returnid);

echo $this->SetTabHeader('matches',$this->Lang('matches'), ('matches' == $tab)?true:false);
echo $this->SetTabHeader('associations',$this->Lang('associations'), ('associations' == $tab)?true:false);
echo $this->SetTabHeader('clubs',$this->Lang('clubs'), ('clubs' == $tab)?true:false);
echo $this->SetTabHeader('teams',$this->Lang('teams'), ('teams' == $tab)?true:false);
echo $this->SetTabHeader('members',$this->Lang('members'), ('members' == $tab)?true:false);
echo $this->SetTabHeader('leagues',$this->Lang('leagues'), ('leagues' == $tab)?true:false);
echo $this->SetTabHeader('seasons',$this->Lang('seasons'), ('seasons' == $tab)?true:false);
echo $this->SetTabHeader('templates',$this->Lang('templates'), ('templates' == $tab)?true:false);
echo $this->SetTabHeader('options',$this->Lang('options'), ('options' == $tab)?true:false);
echo $this->EndTabHeaders();

# The content of the tabs
echo $this->StartTabContent();
if ($this->CheckPermission('Modify TeamSportScores'))
{
	// --- Start tab Matches ---
	echo $this->StartTab('matches', $params);

	// Retrieve the selection criteria from previous visit
	if (isset($user_id) ) {
		$usedhometeam = get_preference( $user_id, 'tss_hometeam' );
		$usedvisitorteam = get_preference( $user_id, 'tss_visitorteam' );
		$usedleaguename = get_preference( $user_id, 'tss_leaguename' );
		$usedfuture = get_preference( $user_id, 'tss_future' );
		$datefrom = get_preference( $user_id, 'tss_datefrom' );
		$dateto = get_preference( $user_id, 'tss_dateto' );
		$sortby = get_preference( $user_id, 'tss_sortby' );
		$sequence = get_preference( $user_id, 'tss_sequence' );
	}
	
	// Reset of user preferences
	if (isset($params['submitreset'])) {
		$query = 'DELETE FROM '.cms_db_prefix().'userprefs WHERE preference like "tss_%" and user_id = '. $user_id;
		$db->Execute($query);
		$usedhometeam = 0;
		$usedvisitorteam = 0;
		$usedleaguename = 0;
		$usedfuture = 'NOPLAY';
		$datefrom = date('Y-m-d', time());
		$dateto = $datefrom;
		$sortby = 'sb_matchdate';
		$sequence = 'ASC';
	}

	// Submit has been used, use all the parameters to prepare the query for the data
	if (isset($params['submitfilter'])) {
		if (isset($params['hometeam']))
	  	{
	  	 	 $usedhometeam = $params['hometeam'];
	  	}
		if (isset($params['visitorteam']))
	  	{
	  	 	 $usedvisitorteam = $params['visitorteam'];
	  	}
		if (isset($params['future']))
	  	{
	  	 	 $usedfuture = $params['future'];
	  	}
		if (isset($params['leaguename']))
	  	{
	  	 	 $usedleaguename = $params['leaguename'];
	  	}
		if (isset($params['datefrom_Month']))
	  	{
			$datefrom = date("Y-m-d H:i:s",mktime(0,0,0,$params['datefrom_Month'],$params['datefrom_Day'],$params['datefrom_Year'])); 
	  	}
		if (isset($params['dateto_Month']))
	  	{
			$dateto = date("Y-m-d H:i:s",mktime(23,59,59,$params['dateto_Month'],$params['dateto_Day'],$params['dateto_Year']));
			// Make sure that the to date is not less then the from date
			if ( substr($datefrom, 1, 10) > substr($dateto, 1, 10) ) {
				$dateto = $datefrom;
			}
	  	}
		if (isset($params['sortby']))
		{
		 	 $sortby = $params['sortby'];
		}
		if (isset($params['sequence']))
		{
		 	 $sequence = $params['sequence'];
		}
		if (isset($user_id) ) {
			// Store the used selection criteria for next visit
			set_preference( $user_id, 'tss_hometeam', $usedhometeam );
			set_preference( $user_id, 'tss_visitorteam', $usedvisitorteam );
			set_preference( $user_id, 'tss_leaguename', $usedleaguename );
			set_preference( $user_id, 'tss_future', $usedfuture );
			set_preference( $user_id, 'tss_sortby', $sortby );
			set_preference( $user_id, 'tss_sequence', $sequence );
			set_preference( $user_id, 'tss_datefrom', $datefrom );
			set_preference( $user_id, 'tss_dateto', $dateto );
		}

	}

	// Prepare dropdown values for hometeams
	$hometeamlist = array();
	// Add a selection option to see all
	$NotApplicable=$this->Lang('allhometeams');
	$hometeamlist[$NotApplicable] = 0;
	$query = 'SELECT DISTINCT(hometeam) FROM '.cms_db_prefix().'module_tss_gameschedule_score ORDER BY hometeam';
	$dbresult = $db->Execute($query);

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$hometeamlist[$row['hometeam']] = $row['hometeam'];
	}

	// Prepare a list of the visitors teams
	$visitorteamlist = array();
	// Add a selection option to see all
	$NotApplicable=$this->Lang('allvisitorteams');
	$visitorteamlist[$NotApplicable] = 0;
	$query = 'SELECT DISTINCT(visitorteam) FROM '.cms_db_prefix().'module_tss_gameschedule_score ORDER BY visitorteam';
	$dbresult = $db->Execute($query);

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$visitorteamlist[$row['visitorteam']] = $row['visitorteam'];
	}

	// Prepare a list of league names
	$leagueslist = array();
	// Add a selection option to see all
	$NotApplicable=$this->Lang('allleagues');
	$leagueslist[$NotApplicable] = 0;
	$query = 'SELECT DISTINCT(name) FROM '.cms_db_prefix().'module_tss_leagues ORDER BY name';
	$dbresult = $db->Execute($query);

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$leagueslist[$row['name']] = $row['name'];
	}

	$sortbylist = array();
	$sortbylist[$this->Lang('matchbyhometeam')] = 'sb_hometeam';
	$sortbylist[$this->Lang('matchbyvisitorteam')] = 'sb_visitorteam';
	$sortbylist[$this->Lang('matchbyleaguename')] = 'sb_leaguename';
	$sortbylist[$this->Lang('matchbydate')] = 'sb_matchdate';

	$sequencelist = array();
	$sequencelist[$this->Lang('matchbyseqasc')] = 'ASC';
	$sequencelist[$this->Lang('matchbyseqdesc')] = 'DESC';
	
	$matchtypes = array($this->Lang('all')=>'ALL',
		$this->Lang('notplayed')=>'NOPLAY',
		$this->Lang('played')=>'PLAY');

	// Prepare the basic statement
	$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_gameschedule_score gss LEFT OUTER JOIN '
			.cms_db_prefix().'module_tss_leagues lea ON gss.league_id = lea.league_id';

	// Set where clause
	$query .= ' WHERE gss_id > 0';
	
	switch ($usedfuture) {
		case 'PLAY':
			$query .= ' AND hometeam_score <> \'\'';
			break;
		case 'NOPLAY':
			$query .= ' AND hometeam_score = \'\'';
			break;
		default:
			break;
	}

	// Select the hometeam (if one selected)
	if ($usedhometeam != $this->Lang('allteams') && $usedhometeam != '0') {
		$query .= ' AND hometeam = \''. $usedhometeam.'\'';
	}

	// Select the visitorteam (if one selected)
	if ($usedvisitorteam != $this->Lang('allteams') && $usedvisitorteam != '0') {
		$query .= ' AND visitorteam = \''. $usedvisitorteam.'\'';
	}
	// Select the leaguename (if one selected)
	if ($usedleaguename != $this->Lang('allleagues') && $usedleaguename != '0') {
		$query .= ' AND name = \''. $usedleaguename.'\'';
	}
	// Select date range
	if ( substr($datefrom, 1, 10) != substr($dateto, 1, 10)) {
		$query .= ' AND date BETWEEN "'.$datefrom.'" AND "'.$dateto.'"';
	}

	// Set order by
	switch ($sortby) {
		case 'sb_hometeam':
			$query .= ' ORDER by hometeam';
			break;
		case 'sb_visitorteam':
			$query .= ' ORDER by visitorteam';
			break;
		case 'sb_leaguename':
			$query .= ' ORDER by name';
			break;
		case 'sb_matchdate':
			$query .= ' ORDER by date';
			break;
		default:
			$query .= ' ORDER by gss_id';
	} 

	// Sequence
	$query .= ' '.$sequence;

	// Complete SQL statement is now build and thus w're able to run it
	$dbresult = $db->Execute($query);

	// Using the front end language would make it possible to use set localle, 
	// which would translate month names. But no not with smarty.
	// code left inside for maybe later update
	$frontendlang = get_site_preference('frontendlang','');
	if ($frontendlang != '')
	{
	    @setlocale(LC_ALL, $frontendlang);
	}

	$rowclass = 'row1';
	$entryarray = array();

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$onerow = new stdClass();

		$onerow->id = $row['gss_id'];
		$onerow->hometeam = $this->CreateLink($id, 'editmatch', $returnid, $row['hometeam'], array('gss_id'=>$row['gss_id']));
		$onerow->visitorteam = $this->CreateLink($id, 'editmatch', $returnid, $row['visitorteam'], array('gss_id'=>$row['gss_id']));
		$onerow->matchdate = $row['date'];
		
		if ($row['hometeam_score'] != NULL) {
			if ($row['hometeam_score'] != 'C') {
				$onerow->match_score = $row['hometeam_score'].' - '.$row['visitorteam_score'];
			}
			else {
				// This match has been canceled (due to flood, snow or other reason)
				$onerow->match_score = $this->Lang('cancelledcode');
			}
		}
		else {
			$onerow->match_score = $this->Lang('noscoreavailable');
		}
		$onerow->league_name = $row['name'];

		/* Show the icons needed for editing, deleting */
		$onerow->editlink = $this->CreateLink($id, 'editmatch', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('gss_id'=>$row['gss_id']));
		$onerow->deletelink = $this->CreateLink($id, 'deletematch', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('gss_id'=>$row['gss_id']), $this->Lang('areyousurematch'));

		$onerow->rowclass = $rowclass;

		$entryarray[] = $onerow;

		($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
	}

	$this->smarty->assign('formstart', $this->CreateFormStart($id, 'defaultadmin', $returnid, $params));

	$this->smarty->assign_by_ref('items', $entryarray);
	$this->smarty->assign('itemcount', count($entryarray));
	if (count($entryarray) == 0) {
		$this->smarty->assign('message', $this->Lang('nomatchfound'));
	}

	#Setup links
	$this->smarty->assign('addmatchlink', $this->CreateLink($id, 'addmatch', $returnid, $this->Lang('addmatch'), array(), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('addmatchlink', $this->CreateLink($id, 'addmatch', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addmatch'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addmatch', $returnid, $this->Lang('addmatch'), array(), '', false, false, 'class="pageoptions"'));

	$this->smarty->assign('matchfiltertitle', $this->Lang('matchfiltertitle'));
	$this->smarty->assign('hometeamidinput', $this->CreateInputDropdown($id, 'hometeam', $hometeamlist, -1, $usedhometeam));
	$this->smarty->assign('visitorteamidinput', $this->CreateInputDropdown($id, 'visitorteam', $visitorteamlist, -1, $usedvisitorteam));
	$this->smarty->assign('leaguenameinput', $this->CreateInputDropdown($id, 'leaguename', $leagueslist, -1, $usedleaguename));
	$this->smarty->assign('datefromtitle', $this->Lang('matchdatefrom'));
	$this->smarty->assign_by_ref('datefrom', $datefrom);
	$this->smarty->assign('datefromprefix', $id.'datefrom_');
	$this->smarty->assign('datetotitle', $this->Lang('matchdateto'));
	$this->smarty->assign_by_ref('dateto', $dateto);
	$this->smarty->assign('datetoprefix', $id.'dateto_');
	$this->smarty->assign('sortmatchbytitle', $this->Lang('matchsortbytitle'));
	$this->smarty->assign('sortmatchbyinput', $this->CreateInputDropdown($id, 'sortby', $sortbylist, -1, $sortby));
	$this->smarty->assign('matchsequenceinput', $this->CreateInputDropdown($id, 'sequence', $sequencelist, -1, $sequence));
	$this->smarty->assign('futurematchonlytitle',$this->Lang('futurematchonlytitle'));
	$this->smarty->assign('futurematchonlyinput', $this->CreateInputRadioGroup($id, 'future', $matchtypes, $usedfuture));

	$this->smarty->assign('titlehometeam', $this->Lang('title_hometeam'));
	$this->smarty->assign('titlevisitorteam', $this->Lang('title_visitorteam'));
	$this->smarty->assign('titlematchdate', $this->Lang('title_matchdate'));
	$this->smarty->assign('titlescore', $this->Lang('title_score'));
	$this->smarty->assign('titleleaguename', $this->Lang('title_leaguename'));

	$params['active_tab'] = 'matches';

	$this->smarty->assign('submitfilter', $this->CreateInputSubmit($id,'submitfilter',$this->Lang('submit')));
	$this->smarty->assign('submitreset', $this->CreateInputSubmit($id,'submitreset',$this->Lang('reset')));

	$this->smarty->assign('formend', $this->CreateFormEnd());
	// Display template
	echo $this->ProcessTemplate('listmatches.tpl');

	echo $this->EndTab();
	// --- End tab Matches ---

	// --- Start tab Associations ---
	echo $this->StartTab('associations', $params);

	$curassociation = (isset($params['curassociation'])?$params['curassociation']:'');
	$allassociations = (isset($params['allassociations'])?$params['allassociations']:'no');
	$newassociation = $curassociation;

	if (isset($params['submitassociation']))
	{
		$newassociation = (isset($params['newassociation'])?$params['newassociation']:$newassociation);
	}

	$curassociation = $newassociation;
	$listassociation = array();
	$listassociation[$this->Lang('allassociation')] = '';
	$query = "SELECT * FROM ".cms_db_prefix()."module_tss_association ORDER BY description";
	$dbresult = $db->Execute($query);

	$rowclass = 'row1';
	$row = '';
	$entryarray = array();

	// Prepare images that can be shown
	$penaltycardnames = array();
	$imageurl = '<img src="'.$config['root_url'].DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'TeamSportScores'.
		DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
	$imagepcblack = $imageurl.'bf.png" alt="'.$penaltycardnames['BLACK'].'">';
	$imagepcblue = $imageurl.'cs.png" alt="'.$penaltycardnames['BLUE'].'">';
	$imagepcgreen = $imageurl.'af.png" alt="'.$penaltycardnames['GREEN'].'">';
	$imagepcred = $imageurl.'cr.png" alt="'.$penaltycardnames['RED'].'">';
	$imagepcwhite = $imageurl.'bw.png" alt="'.$penaltycardnames['WHITE'].'">';
	$imagepcyellow = $imageurl.'be.png" alt="'.$penaltycardnames['YELLOW'].'">';
	$imagenone = $imageurl.'cardnone.gif">';

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$onerow = new stdClass();
		$onerow->id = $row['association_id'];
		$onerow->description = $this->CreateLink($id, 'editassociation', $returnid, $row['description'], array('association_id'=>$row['association_id']));
		$onerow->maxperiods = $row['maxperiods'];
		$onerow->periodheading = $row['periodheading'];
		if ($row['penaltycardblack'] == '1') {
			$onerow->pcblack = $imagepcblack;
		}
		else {
			$onerow->pcblack = $imagenone;
		}
		if ($row['penaltycardblue'] == '1') {
			$onerow->pcblue = $imagepcblue;
		}
		else {
			$onerow->pcblue = $imagenone;
		}
		if ($row['penaltycardgreen'] == '1') {
			$onerow->pcgreen = $imagepcgreen;
		}
		else {
			$onerow->pcgreen = $imagenone;
		}
		if ($row['penaltycardred'] == '1') {
			$onerow->pcred = $imagepcred;
		}
		else {
			$onerow->pcred = $imagenone;
		}
		if ($row['penaltycardwhite'] == '1') {
			$onerow->pcwhite = $imagepcwhite;
		}
		else {
			$onerow->pcwhite = $imagenone;
		}
		if ($row['penaltycardyellow'] == '1') {
			$onerow->pcyellow = $imagepcyellow;
		}
		else {
			$onerow->pcyellow = $imagenone;
		}
 		// Show the icons needed for editing, deleting
		$onerow->editlink = $this->CreateLink($id, 'editassociation', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('association_id'=>$row['association_id']));
		$onerow->deletelink = $this->CreateLink($id, 'deleteassociation', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('association_id'=>$row['association_id']), $this->Lang('areyousureassociation'));

		$onerow->rowclass = $rowclass;

		$entryarray[] = $onerow;

		($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
	}
	$this->smarty->assign_by_ref('items', $entryarray);
	$this->smarty->assign('itemcount', count($entryarray));

	// Setup links
	$this->smarty->assign('addassociationlink', $this->CreateLink($id, 'addassociation', $returnid, $this->Lang('addassociation'), array(), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('addassociationlink', $this->CreateLink($id, 'addassociation', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addassociation'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addassociation', $returnid, $this->Lang('addassociation'), array(), '', false, false, 'class="pageoptions"'));

	$this->smarty->assign('associationtext', $this->Lang('association'));
	$this->smarty->assign('titlemaxperiods', $this->Lang('title_maxperiods'));
	$this->smarty->assign('titleperiodheading', $this->Lang('periodheading'));
	$this->smarty->assign('titlepcblack', $this->Lang('title_pcblack'));
	$this->smarty->assign('titlepcblue', $this->Lang('title_pcblue'));
	$this->smarty->assign('titlepcgreen', $this->Lang('title_pcgreen'));
	$this->smarty->assign('titlepcred', $this->Lang('title_pcred'));
	$this->smarty->assign('titlepcwhite', $this->Lang('title_pcwhite'));
	$this->smarty->assign('titlepcyellow', $this->Lang('title_pcyellow'));
	
	// Display template
	echo $this->ProcessTemplate('listassociation.tpl');

	echo $this->EndTab();

	// --- End tab Associations ---

	// --- Start tab Clubs ---
	echo $this->StartTab('clubs', $params);

	$curclub = (isset($params['curclub'])?$params['curclub']:'');
	$allclubs = (isset($params['allclubs'])?$params['allclubs']:'no');
	$newclub = $curclub;

	if (isset($params['submitclub']))
	{
		$newclub = (isset($params['newclub'])?$params['newclub']:$newclub);
	}

	$query = '';
	$dbresult = '';

	$curclub = $newclub;
	$listclub = array();
	$listclub[$this->Lang('allclub')] = '';

	$query = "SELECT c.*, a.description AS ass_desc FROM ".cms_db_prefix()."module_tss_club c LEFT OUTER JOIN ".cms_db_prefix()."module_tss_association a ON c.association_id = a.association_id ORDER BY c.description";
	$dbresult = $db->Execute($query);

	$rowclass = 'row1';
	$entryarray = array();

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$onerow = new stdClass();

		$onerow->id = $row['club_id'];
		$onerow->description = $this->CreateLink($id, 'editclub', $returnid, $row['description'], array('club_id'=>$row['club_id']));
		if ($row['association_id'] > 0) {
				$onerow->association = $row['ass_desc'];
		} else {
				$onerow->association = 'Unknown';
		}

 		/* Show the icons needed for editing, deleting */
		if ($row['status'] == 'A')
			{
				$onerow->statuslink = $this->CreateLink($id, 'switchstatus', $returnid, 
					$gCms->variables['admintheme']->DisplayImage('icons/system/true.gif',$this->Lang('setinactive'),'','','systemicon'),array('table'=>'Club','status'=>'I','record_id'=>$row['club_id']));
			}
		else
			{
				$onerow->statuslink = $this->CreateLink($id,'switchstatus', $returnid, 
					$gCms->variables['admintheme']->DisplayImage('icons/system/false.gif',$this->Lang('setactive'),'','','systemicon'),array('table'=>'Club','status'=>'A','record_id'=>$row['club_id']));
			}
		$onerow->editlink = $this->CreateLink($id, 'editclub', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('club_id'=>$row['club_id']));
		if ($row['club_id'] > 0 ) {
				$onerow->deletelink = $this->CreateLink($id, 'deleteclub', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('club_id'=>$row['club_id']), $this->Lang('areyousureclub'));
	  	}
		$onerow->rowclass = $rowclass;

		$entryarray[] = $onerow;

		($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
	}
	$this->smarty->assign_by_ref('items', $entryarray);
	$this->smarty->assign('itemcount', count($entryarray));

	// Setup links
	$this->smarty->assign('addclublink', $this->CreateLink($id, 'addclub', $returnid, $this->Lang('addclub'), array(), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('addclublink', $this->CreateLink($id, 'addclub', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addclub'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addclub', $returnid, $this->Lang('addclub'), array(), '', false, false, 'class="pageoptions"'));

	$this->smarty->assign('clubtext', $this->Lang('club'));
	$this->smarty->assign('statustext', $this->Lang('status'));

	// Display template
	echo $this->ProcessTemplate('listclub.tpl');

	echo $this->EndTab();
	// --- End tab Clubs ---
	
	// --- Start tab Teams ---
	echo $this->StartTab('teams', $params);

	$query = '';
	$dbresult = '';

	$listteam = array();
	$listteam[$this->Lang('allteam')] = '';

	$query = "SELECT t.*, c.description AS club_desc, season_desc
				 FROM "
				 			.cms_db_prefix()."module_tss_team t, "
							.cms_db_prefix()."module_tss_club c, "
							.cms_db_prefix()."module_tss_season s
				 WHERE t.club_id = c.club_id AND t.season_id = s.season_id
				 ORDER BY t.team_name";
	$dbresult = $db->Execute($query);

	$rowclass = 'row1';
	$entryarray = array();

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$onerow = new stdClass();

		$onerow->id = $row['team_id'];
		$onerow->code = $this->CreateLink($id, 'editteam', $returnid, $row['team_code'], array('team_id'=>$row['team_id']));
		$onerow->name = $this->CreateLink($id, 'editteam', $returnid, $row['team_name'], array('team_id'=>$row['team_id']));
		$onerow->smartyparm = '{... team=\''.$row['team_id'].'\' ...}';
		$onerow->season = $row['season_desc'];
		if ($row['club_id'] > 0) {
				$onerow->description = $row['club_desc'];
		} else {
			if ($id == 0) {
				$onerow->description = $this->Lang('clubnotconnected');
			} else {
				$onerow->description = $this->Lang('clubunknown');
			}
		}

 		// Show the icons needed for editing, deleting
		if ($row['status'] == 'A') {
			$onerow->statuslink = $this->CreateLink($id, 'switchstatus', $returnid, 
				$gCms->variables['admintheme']->DisplayImage('icons/system/true.gif',$this->Lang('setinactive'),'','','systemicon'),array('table'=>'Team','status'=>'I','record_id'=>$row['team_id']));
		}
		else {
			$onerow->statuslink = $this->CreateLink($id,'switchstatus', $returnid, 
				$gCms->variables['admintheme']->DisplayImage('icons/system/false.gif',$this->Lang('setactive'),'','','systemicon'),array('table'=>'Team','status'=>'A','record_id'=>$row['team_id']));
		}
		$onerow->editlink = $this->CreateLink($id, 'editteam', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('team_id'=>$row['team_id']));
		if ($row['team_id'] > 0 ) {
			 $onerow->deletelink = $this->CreateLink($id, 'deleteteam', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('team_id'=>$row['team_id']), $this->Lang('areyousureteam'));
		}

		$onerow->rowclass = $rowclass;

		$entryarray[] = $onerow;

		($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
	}
	$this->smarty->assign_by_ref('items', $entryarray);
	$this->smarty->assign('itemcount', count($entryarray));

	// Setup links
	$this->smarty->assign('addteamlink', $this->CreateLink($id, 'addteam', $returnid, $this->Lang('addteam'), array(), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('addteamlink', $this->CreateLink($id, 'addteam', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addteam'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addteam', $returnid, $this->Lang('addteam'), array(), '', false, false, 'class="pageoptions"'));

	$this->smarty->assign('teamcodetext', $this->Lang('teamcode'));
	$this->smarty->assign('teamtext', $this->Lang('team'));
	$this->smarty->assign('smartyteamtext', $this->Lang('title_smartyteam'));
	$this->smarty->assign('seasontext', $this->Lang('season'));
	$this->smarty->assign('clubtext', $this->Lang('club'));
	$this->smarty->assign('statustext', $this->Lang('status'));

	// Display template
	echo $this->ProcessTemplate('listteam.tpl');

	echo $this->EndTab();
	// --- End tab Teams ---
	
	// --- Start tab Members ---
	echo $this->StartTab('members', $params);

	$query = '';
	$dbresult = '';

	#if (isset($params['submitmemberfilter'])) {
		if (isset($params['team_id'])) {
	  	 	 $usedteam_id = $params['team_id'];
	  	}
	#}

	// Prepare dropdown values for teams
	$teamlist = array();
	// Add a selection option to see all
	$NotApplicable = $this->Lang('allteams');
	$teamlist[$NotApplicable] = 'ALL';
	$query = 'SELECT team_id, team_name FROM '.cms_db_prefix().'module_tss_team ORDER BY team_name';
	$dbresult = $db->Execute($query);

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$teamlist[$row['team_name']] = $row['team_id'];
	}

	$listmember = array();
	$listmember[$this->Lang('allmember')] = '';
	// Check the preferences which table to use
	$prefusertable = $this->GetPreference('user_table', '');
	switch ($prefusertable) 	{
		case 'CMSMS_USR':
			$query = "SELECT m.*, t.team_name AS team_name, CONCAT(u.first_name, ' ', u.last_name) AS member_name
			FROM "
				.cms_db_prefix(). "module_tss_member m, "
				.cms_db_prefix(). "module_tss_team t, "
				.cms_db_prefix(). "users u
			WHERE m.team_id = t.team_id AND m.user_id = u.user_id
			ORDER BY u.first_name, u.last_name";
			break;
		case 'FEU_USR':
			$query = "SELECT m.*, t.team_name AS team_name, username AS member_name
			FROM "
				.cms_db_prefix(). "module_tss_member m, "
				.cms_db_prefix().	"module_tss_team t, "
				.cms_db_prefix(). "module_feusers_users u
			WHERE m.team_id = t.team_id AND m.user_id = u.id
			ORDER BY u.username";
			break;
		case 'MAN_USR':
			if ( $usedteam_id != 'ALL' and $usedteam_id != NULL ) {
				$query = "SELECT m.*, t.team_name AS team_name, membername AS member_name
				FROM "
					.cms_db_prefix(). "module_tss_member m, "
					.cms_db_prefix().	"module_tss_team t 
				WHERE m.team_id = t.team_id AND m.team_id = $usedteam_id 
				ORDER BY membername";
			}
			else {
				$query = "SELECT m.*, t.team_name AS team_name, membername AS member_name
				FROM "
					.cms_db_prefix(). "module_tss_member m, "
					.cms_db_prefix().	"module_tss_team t 
				WHERE m.team_id = t.team_id 
				ORDER BY membername";
			}
			break;
		default:
			break;
	}

	$dbresult = $db->Execute($query);

	$rowclass = 'row1';
	$entryarray = array();

	while ($dbresult && $row = $dbresult->FetchRow()) 	{
		$onerow = new stdClass();

		$onerow->id = $row['member_id'];
		$onerow->membername = $this->CreateLink($id, 'editmember', $returnid, $row['member_name'], array('member_id'=>$row['member_id']));
		$onerow->team = $row['team_name'];

		switch ($row['type']) {
			case 'PLAYER':
				$onerow->type = $this->Lang('typeplayer');
				break;
			case 'COACH':
				$onerow->type = $this->Lang('typecoach');
				break;
			case 'DOCTOR':
				$onerow->type = $this->Lang('typemedic');
				break;
			case 'GOALIE':
				$onerow->type = $this->Lang('typegoalie');
				break;
			case 'MANAGER':
				$onerow->type = $this->Lang('typemanager');
				break;
			default:
				break;
		}
		if ($row['status'] == 'A') {
			$onerow->statuslink = $this->CreateLink($id, 'switchstatus', $returnid, 
				$gCms->variables['admintheme']->DisplayImage('icons/system/true.gif',$this->Lang('setinactive'),'','','systemicon'),array('table'=>'Member','status'=>'I','record_id'=>$row['member_id']));
		}
		else {
			$onerow->statuslink = $this->CreateLink($id,'switchstatus', $returnid, 
				$gCms->variables['admintheme']->DisplayImage('icons/system/false.gif',$this->Lang('setactive'),'','','systemicon'),array('table'=>'Member','status'=>'A','record_id'=>$row['member_id']));
		}

		// Show the icons needed for editing, deleting
		$onerow->editlink = $this->CreateLink($id, 'editmember', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('member_id'=>$row['member_id']));
		$onerow->deletelink = $this->CreateLink($id, 'deletemember', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('member_id'=>$row['member_id']), $this->Lang('areyousuremember'));

		$onerow->rowclass = $rowclass;

		$entryarray[] = $onerow;

		($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
	}
	$this->smarty->assign_by_ref('items', $entryarray);
	$this->smarty->assign('itemcount', count($entryarray));

	// Setup links
	$this->smarty->assign('addmemberlink', $this->CreateLink($id, 'addmember', $returnid, $this->Lang('addmember'), array('team_id'=>$usedteam_id), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('addmemberlink', $this->CreateLink($id, 'addmember', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addmember'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addmember', $returnid, $this->Lang('addmember'), array('team_id'=>$usedteam_id), '', false, false, 'class="pageoptions"'));

	$this->smarty->assign('memberfiltertitle', $this->Lang('memberfiltertitle'));
	$this->smarty->assign('teamtitle', $this->Lang('team'));
	$this->smarty->assign('teamidinput', $this->CreateInputDropdown($id, 'team_id', $teamlist, -1, $usedteam_id));
	$this->smarty->assign('membertext', $this->Lang('membername'));
	$this->smarty->assign('teamtext', $this->Lang('team_name'));
	$this->smarty->assign('typetext', $this->Lang('membertype'));
	$this->smarty->assign('statustext', $this->Lang('status'));
	$this->smarty->assign('submitmemberfilter', $this->CreateInputSubmit($id,'submitmemberfilter',$this->Lang('submit')));
	$this->smarty->assign('hidden', $this->CreateInputHidden($id, 'active_tab', 'members'));

	// Display template
	echo $this->ProcessTemplate('listmember.tpl');

	echo $this->EndTab();
	// --- End tab Member ---

	// --- Start tab Leagues ---
	echo $this->StartTab('leagues', $params);

	$query = '';
	$dbresult = '';

	$listleague = array();
	$listleague[$this->Lang('allleagues')] = '';

	$query = 'SELECT league_id, l.name AS leaguename, l.status AS leaguestatus, season_desc
			FROM '.cms_db_prefix().'module_tss_leagues l, '
				.cms_db_prefix().'module_tss_season s
			WHERE l.season_id = s.season_id
			ORDER BY name';
	$dbresult = $db->Execute($query);

	$rowclass = 'row1';
	$entryarray = array();

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$onerow = new stdClass();

		$onerow->id = $row['league_id'];
		$onerow->name = $this->CreateLink($id, 'editleague', $returnid, $row['leaguename'], array('league_id'=>$row['league_id']));
		$onerow->season = $row['season_desc'];

 		// Show the icons needed for editing, deleting
		if ($row['leaguestatus'] == 'A')
			{
				$onerow->statuslink = $this->CreateLink($id, 'switchstatus', $returnid, 
					$gCms->variables['admintheme']->DisplayImage('icons/system/true.gif',$this->Lang('setinactive'),'','','systemicon'),array('table'=>'League','status'=>'I','record_id'=>$row['league_id']));
			}
		else
			{
				$onerow->statuslink = $this->CreateLink($id,'switchstatus', $returnid, 
					$gCms->variables['admintheme']->DisplayImage('icons/system/false.gif',$this->Lang('setactive'),'','','systemicon'),array('table'=>'League','status'=>'A','record_id'=>$row['league_id']));
			}
		$onerow->editlink = $this->CreateLink($id, 'editleague', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('league_id'=>$row['league_id']));
		if ($row['league_id'] > 0 ) {
				$onerow->deletelink = $this->CreateLink($id, 'deleteleague', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('league_id'=>$row['league_id']), $this->Lang('areyousureleague'));
	  	}
		$onerow->rowclass = $rowclass;

		$entryarray[] = $onerow;

		($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
	}
	$this->smarty->assign_by_ref('items', $entryarray);
	$this->smarty->assign('itemcount', count($entryarray));

	// Setup links
	$this->smarty->assign('addleaguelink', $this->CreateLink($id, 'addleague', $returnid, $this->Lang('addleague'), array(), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('addleaguelink', $this->CreateLink($id, 'addleague', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addleague'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addleague', $returnid, $this->Lang('addleague'), array(), '', false, false, 'class="pageoptions"'));

	$this->smarty->assign('leaguetext', $this->Lang('leagues'));
	$this->smarty->assign('seasontext', $this->Lang('season'));
	$this->smarty->assign('statustext', $this->Lang('status'));

	// Display template
	echo $this->ProcessTemplate('listleagues.tpl');

	echo $this->EndTab();
	// --- End tab leagues ---	
  
	// --- Start tab Seasons ---
	echo $this->StartTab('seasons', $params);

	$query = '';
	$dbresult = '';

	$curseason = (isset($params['curseason'])?$params['curseason']:'');
	$allseasons = (isset($params['allseasons'])?$params['allseasons']:'no');
	$newseason = $curseason;

	if (isset($params['submitseason']))
	{
		$newseason = (isset($params['newseason'])?$params['newseason']:$newseason);
	}

	$curseason = $newseason;
	$listseason = array();
	$listseason[$this->Lang('allseasons')] = '';
	$query = "SELECT * FROM ".cms_db_prefix()."module_tss_season ORDER BY start_date, season_desc";
	$dbresult = $db->Execute($query);

	$rowclass = 'row1';
	$entryarray = array();

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$onerow = new stdClass();

		$onerow->id = $row['season_id'];
		$onerow->season_desc = $this->CreateLink($id, 'editseason', $returnid, $row['season_desc'], array('season_id'=>$row['season_id']));
		$onerow->start_date = $row['start_date'];
		$onerow->end_date = $row['end_date'];

		// Show the icons needed for editing, deleting
		if ($row['status'] == 'A')
			{
				$onerow->statuslink = $this->CreateLink($id, 'switchstatus', $returnid, 
					$gCms->variables['admintheme']->DisplayImage('icons/system/true.gif',$this->Lang('setinactive'),'','','systemicon'),array('table'=>'Season','status'=>'I','record_id'=>$row['season_id']));
			}
		else
			{
				$onerow->statuslink = $this->CreateLink($id,'switchstatus', $returnid, 
					$gCms->variables['admintheme']->DisplayImage('icons/system/false.gif',$this->Lang('setactive'),'','','systemicon'),array('table'=>'Season','status'=>'A','record_id'=>$row['season_id']));
			}
		$onerow->editlink = $this->CreateLink($id, 'editseason', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('season_id'=>$row['season_id']));
		if ($row['season_id'] > 0 ) {
				$onerow->deletelink = $this->CreateLink($id, 'deleteseason', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('season_id'=>$row['season_id']), $this->Lang('areyousureseason'));
		}

		$onerow->rowclass = $rowclass;

		$entryarray[] = $onerow;

		($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
	}
	$this->smarty->assign_by_ref('items', $entryarray);
	$this->smarty->assign('itemcount', count($entryarray));

	// Setup links
	$this->smarty->assign('addseasonlink', $this->CreateLink($id, 'addseason', $returnid, $this->Lang('addseason'), array(), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('addseasonlink', $this->CreateLink($id, 'addseason', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addseason'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addseason', $returnid, $this->Lang('addseason'), array(), '', false, false, 'class="pageoptions"'));

	$this->smarty->assign('seasontext', $this->Lang('season'));
	$this->smarty->assign('startdatetext', $this->Lang('seasonstartdate'));
	$this->smarty->assign('enddatetext', $this->Lang('seasonenddate'));

	// Display template
	echo $this->ProcessTemplate('listseason.tpl');

	echo $this->EndTab();
	// --- End tab Seasons ---

	// --- Start tab Templates ---
	echo $this->StartTab('templates', $params);

	// Build list of possible template types
	$typelist = array();
	$typelist[$this->Lang('league_page')] = 1;
	$typelist[$this->Lang('team_page')] = 2;
	$typelist[$this->Lang('summary_page')] = 3;
	$typelist[$this->Lang('stats_page')] = 4;
	$templatetypelist = array();
	$templatetypelist = array_flip($typelist);

	$query = '';
	$dbresult = '';
	$query = 'SELECT *
			FROM '.cms_db_prefix().'module_tss_template
			ORDER BY title';
	$dbresult = $db->Execute($query);

	$rowclass = 'row1';
	$entryarray = array();

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$onerow = new stdClass();

		$onerow->id = $row['template_id'];
		$onerow->title = $this->CreateLink($id, 'edittemplate', $returnid, $row['title'], array('template_id'=>$row['template_id']));
		$onerow->typename = $templatetypelist[$row['type_id']];
		$onerow->editlink = $this->CreateLink($id, 'edittemplate', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('template_id'=>$row['template_id']));
		$onerow->deletelink = $this->CreateLink($id, 'deletetemplate', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('template_id'=>$row['template_id']), $this->Lang('areyousuretemplate'));

		$onerow->rowclass = $rowclass;

		$entryarray[] = $onerow;

		($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
	}

	// Setup links
	$this->smarty->assign('addtemplatelink', $this->CreateLink($id, 'addtemplate', $returnid, $this->Lang('addtemplate'), array(), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('addtemplatelink', $this->CreateLink($id, 'addtemplate', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addtemplate'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addtemplate', $returnid, $this->Lang('addtemplate'), array(), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('reimporttemplatelink', $this->CreateLink($id, 'reimporttemplate', $returnid, $this->Lang('reimporttemplate'), array(), '', false, false, 'class="pageoptions"'));
	$this->smarty->assign('reimporttemplatelink', $this->CreateLink($id, 'reimporttemplate', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/import.gif', $this->Lang('reimporttemplate'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'reimporttemplate', $returnid, $this->Lang('reimporttemplate'), array(), '', false, false, 'class="pageoptions"'));
	
	$this->smarty->assign('titletext', $this->Lang('title'));
	$this->smarty->assign('typetext', $this->Lang('templatetype'));

	// Display the templates
	echo $this->ProcessTemplate ('listtemplates.tpl');
	
	echo $this->EndTab();
	// --- End tab Templates ---

	// --- Start tab Options ---
	echo $this->StartTab('options', $params);
	
	// Prepare list of possible leagues to select from
	$leaguelist = array();
	$query = 'SELECT * FROM '.cms_db_prefix().'module_tss_leagues WHERE status = \'A\' ORDER BY name';
	$dbresult = $db->Execute($query);

	while ($dbresult && $row = $dbresult->FetchRow())
	{
		$leaguelist[$row['name']] = $row['league_id'];
	}

	// Prepare the possible values of the sexes
	$sexedropdown = array();
	$sexedropdown[$this->Lang('male')] = 'MALE';
	$sexedropdown[$this->Lang('female')] = 'FEMALE';
	$sexedropdown[$this->Lang('both')] = 'BOTH';

	// Prepare a dropdown list of where the user information is to be derived from
	$usrtabledropdown = array();
	$usrtabledropdown['CMSMS User table'] = 'CMSMS_USR';
	if ($gCms->modules['FrontEndUsers']['installed'] == true &&
        $gCms->modules['FrontEndUsers']['active'] == true) {
		$usrtabledropdown['Front End User Table'] = 'FEU_USR';
		$this->smarty->assign('info_user_table', $this->Lang('info_user_table'));
	}
	else {
		$this->smarty->assign('info_user_table', $this->Lang('info_user_table_no_FEU'));
	}
	$usrtabledropdown[$this->Lang('usermanualentry')] = 'MAN_USR';
	
	$this->smarty->assign('startform', $this->CreateFormStart ($id, 'save_admin_options', $returnid));
	$this->smarty->assign('title_dateformat',$this->Lang('title_dateformat'));
	$this->smarty->assign('input_dateformat', $this->CreateInputText($id, 'dateformat', $this->GetPreference('dateformat', '%x'), '50', '255'));
	$this->smarty->assign('title_fieldset_match',$this->Lang('title_fieldset_match'));
	$this->smarty->assign('title_default_league_id',$this->Lang('title_default_league_id'));
	$this->smarty->assign('input_default_league_id', $this->CreateInputDropdown($id, 'default_league_id', $leaguelist, -1, $this->GetPreference('default_league_id', '')));
	$this->smarty->assign('title_24hourclock',$this->Lang('title_24hourclock'));
	$this->smarty->assign('input_24hourclock', $this->CreateInputCheckbox($id, 'use_24hour_clock', true, $this->GetPreference('use_24hour_clock', true)));
	$this->smarty->assign('title_show_seconds',$this->Lang('title_show_seconds'));
	$this->smarty->assign('input_show_seconds', $this->CreateInputCheckbox($id, 'show_seconds', true, $this->GetPreference('show_seconds', true)));
	$this->smarty->assign('title_display0000',$this->Lang('title_display0000'));
	$this->smarty->assign('input_display0000', $this->CreateInputCheckbox($id, 'displaytime_when_0000', true, $this->GetPreference('displaytime_when_0000', true)));
	$this->smarty->assign('title_showstats',$this->Lang('title_showstats'));
	$this->smarty->assign('input_showstats', $this->CreateInputCheckbox($id, 'fe_show_statistics', true, $this->GetPreference('fe_show_statistics', true)));
	$this->smarty->assign('title_fieldset_team',$this->Lang('title_fieldset_team'));
	$this->smarty->assign('title_default_sexes',$this->Lang('title_default_sexes'));
	$this->smarty->assign('input_default_sexes', $this->CreateInputDropdown($id, 'default_sexes', $sexedropdown, -1, $this->GetPreference('default_sexes', 0)));
	$this->smarty->assign('title_fieldset_member',$this->Lang('title_fieldset_member'));
	$this->smarty->assign('title_user_table', $this->Lang('title_user_table'));
	$this->smarty->assign('input_user_table', $this->CreateInputDropdown($id, 'user_table', $usrtabledropdown, -1, $this->GetPreference('user_table', '')));
	$this->smarty->assign('submit', $this->CreateInputSubmit ($id, 'optionssubmitbutton', $this->Lang('submit')));
	$this->smarty->assign('endform', $this->CreateFormEnd ());

	// Display the Admin options
	echo $this->ProcessTemplate ('adminprefs.tpl');
	echo $this->EndTab();
	// --- End tab Optionss ---

  
}
echo $this->EndTabContent();

?>