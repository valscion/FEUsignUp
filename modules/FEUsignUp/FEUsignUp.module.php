<?php
#-------------------------------------------------------------------------
# Module: FEUsignUp - Gives the ability to put together a sign-up for 
# events to CGCalendar and Team Sport Scores
# Version: 0.0.1, VesQ
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2011 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
# This file originally created by ModuleMaker module, version 0.3.2
# Copyright (c) 2011 by Samuel Goldstein (sjg@cmsmadesimple.org) 
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

#-------------------------------------------------------------------------
# For Help building modules:
# - Read the Documentation as it becomes available at
#   http://dev.cmsmadesimple.org/
# - Check out the Skeleton Module for a commented example
# - Look at other modules, and learn from the source
# - Check out the forums at http://forum.cmsmadesimple.org
# - Chat with developers on the #cms IRC channel
#-------------------------------------------------------------------------

$cgextensions = cms_join_path($gCms->config['root_path'],'modules',
			      'CGExtensions','CGExtensions.module.php');
if( !is_readable( $cgextensions ) )
{
  echo '<h1><font color="red">ERROR: The CGExtensions module could not be found.</font></h1>';
  return;
}
require_once($cgextensions);

// Some static preferences, names of templates
define('FEUSIGNUP_PREF_NEWDISPLAYEVENT_TEMPLATE', 'feusignup_pref_newdisplayevent_template');
define('FEUSIGNUP_PREF_DFLTDISPLAYEVENT_TEMPLATE', 'feusignup_pref_dfltdisplayevent_template');
define('FEUSIGNUP_PREF_NEWCALLINK_TEMPLATE', 'feusignup_pref_newcallink_template');
define('FEUSIGNUP_PREF_DFLTCALLINK_TEMPLATE', 'feusignup_pref_dfltcallink_template');
define('FEUSIGNUP_PREF_NEWTSSLINK_TEMPLATE', 'feusignup_pref_newtsslink_template');
define('FEUSIGNUP_PREF_DFLTTSSLINK_TEMPLATE', 'feusignup_pref_dflttsslink_template');


class FEUsignUp extends CGExtensions
{
    var $events_table_name;
    var $linkings_table_name;
    
    function __construct()
    {
        parent::__construct();
        
        $this->events_table_name = cms_db_prefix().'module_feusignup_events';
        $this->linkings_table_name = cms_db_prefix().'module_feusignup_linkings';
    }
    
    function GetName()
    {
        return 'FEUsignUp';
    }

    /*---------------------------------------------------------
       GetFriendlyName()
       This can return any string, preferably a localized name
       of the module. This is the name that's shown in the
       Admin Menus and section pages (if the module has an admin
       component).
       
       See the note on localization at the top of this file.
      ---------------------------------------------------------*/
    function GetFriendlyName()
    {
        return $this->Lang('friendlyname');
    }

    
    /*---------------------------------------------------------
       GetVersion()
       This can return any string, preferably a number or
       something that makes sense for designating a version.
       The CMS will use this to identify whether or not
       the installed version of the module is current, and
       the module will use it to figure out how to upgrade
       itself if requested.       
      ---------------------------------------------------------*/
    function GetVersion()
    {
        return '0.2.2';
    }

    /*---------------------------------------------------------
       GetHelp()
       This returns HTML information on the module.
       Typically, you'll want to include information on how to
       use the module.
       
       See the note on localization at the top of this file.
      ---------------------------------------------------------*/
    function GetHelp()
    {
        return $this->Lang('help');
    }

    /*---------------------------------------------------------
       GetAuthor()
       This returns a string that is presented in the Module
       Admin if you click on the "About" link.
      ---------------------------------------------------------*/
    function GetAuthor()
    {
        return 'VesQ';
    }

    /*---------------------------------------------------------
       GetAuthorEmail()
       This returns a string that is presented in the Module
       Admin if you click on the "About" link. It helps users
       of your module get in touch with you to send bug reports,
       questions, cases of beer, and/or large sums of money.
      ---------------------------------------------------------*/
    function GetAuthorEmail()
    {
        return 'laakso.vesa@gmail.com';
    }

    /*---------------------------------------------------------
       GetChangeLog()
       This returns a string that is presented in the module
       Admin if you click on the About link. It helps users
       figure out what's changed between releases.
       See the note on localization at the top of this file.
      ---------------------------------------------------------*/
    function GetChangeLog()
    {
        return $this->Lang('changelog');
    }

    /*---------------------------------------------------------
       IsPluginModule()
       This function returns true or false, depending upon
       whether users can include the module in a page or
       template using a smarty tag of the form
       {cms_module module='FEUsignUp' param1=val param2=val...}
       
       If your module does not get included in pages or
       templates, return "false" here.
      ---------------------------------------------------------*/
    function IsPluginModule()
    {
        return true;
    }

    /*---------------------------------------------------------
       HasAdmin()
       This function returns a boolean value, depending on
       whether your module adds anything to the Admin area of
       the site. For the rest of these comments, I'll be calling
       the admin part of your module the "Admin Panel" for
       want of a better term.
      ---------------------------------------------------------*/
    function HasAdmin()
    {
        return true;
    }


    /*---------------------------------------------------------
       GetAdminSection()
       If your module has an Admin Panel, you can specify
       which Admin Section (or top-level Admin Menu) it shows
       up in. This method returns a string to specify that
       section. Valid return values are:

       main        - the Main menu tab.
       content     - the Content menu
       layout      - the Layout menu
       usersgroups - the Users and Groups menu
       extensions  - the Extensions menu (this is the default)
       siteadmin   - the Site Admin menu
       viewsite    - the View Site menu tab
       logout      - the Logout menu tab
       
       Note that if you place your module in the main,
       viewsite, or logout sections, it will show up in the
       menus, but will not be visible in any top-level
       section pages.
      ---------------------------------------------------------*/
    function GetAdminSection()
    {
        return 'extensions';
    }


    /*---------------------------------------------------------
       GetAdminDescription()
       If your module does have an Admin Panel, you
       can have it return a description string that gets shown
       in the Admin Section page that contains the module.
      ---------------------------------------------------------*/
    function GetAdminDescription()
    {
        return $this->Lang('admindescription');
    }


    /*---------------------------------------------------------
       VisibleToAdminUser()
       If your module does have an Admin Panel, you
       can control whether or not it's displayed by the boolean
       that is returned by this method. This is primarily used
       to hide modules from admins who lack permission to use
       them.
       
       Typically, you'll use some permission to set this
       (e.g., $this->CheckPermission('Some Permission'); )
      ---------------------------------------------------------*/
    function VisibleToAdminUser()
    {
        return $this->CheckAccess();
    }
    

    /*---------------------------------------------------------
       CheckAccess()
       This wrapper function will check against the specified permission,
       and display an error page if the user doesn't have adequate permissions.
      ---------------------------------------------------------*/
    function CheckAccess($perm = 'Use FEUsignUp')
        {
        return $this->CheckPermission($perm);
        }
    
    /*---------------------------------------------------------
       DisplayErrorPage()
       This is a simple function for generating error pages.
      ---------------------------------------------------------*/
    function DisplayErrorPage($id, &$params, $return_id, $message='')
    {
        $this->smarty->assign('title_error', $this->Lang('error'));
        $this->smarty->assign_by_ref('message', $message);

        // Display the populated template
        echo $this->ProcessTemplate('error.tpl');
    }
    


    /*---------------------------------------------------------
       GetDependencies()
       Your module may need another module to already be installed
       before you can install it.
       This method returns a list of those dependencies and
       minimum version numbers that this module requires.
       
       It should return an hash, eg.
       return array('somemodule'=>'1.0', 'othermodule'=>'1.1');
      ---------------------------------------------------------*/
    function GetDependencies()
    {
        return array('CGCalendar'=>'1.5.7','FrontEndUsers'=>'1.12.13');
    }

    /*---------------------------------------------------------
       MinimumCMSVersion()
       Your module may require functions or objects from
       a specific version of CMS Made Simple.
       Ever since version 0.11, you can specify which minimum
       CMS MS version is required for your module, which will
       prevent it from being installed by a version of CMS that
       can't run it.
       
       This method returns a string representing the
       minimum version that this module requires.
       ---------------------------------------------------------*/
    function MinimumCMSVersion()
    {
        return "1.8.2";
    }


    /*---------------------------------------------------------
       MaximumCMSVersion()
       You may want to prevent people from using your module in
       future versions of CMS Made Simple, especially if you
       think API features you use may change -- after all, you
       never really know how the CMS MS API could evolve.
       
       So, to prevent people from flooding you with bug reports
       when a new version of CMS MS is released, you can simply
       restrict the version. Then, of course, the onus is on you
       to release a new version of your module when a new version
       of the CMS is released...
       
       This method returns a string representing the
       maximum version that this module supports.
       ---------------------------------------------------------*/
    function MaximumCMSVersion()
    {
        return "1.9.4.2";
    }

    /**
   * SetParameters()
   * This function serves as a module initialization area.
   * Specifically, it enables you to:
   * 1) Simplify your module's tag (if you're writing a plug-in module)
   * 2) Create mappings for your module when using "Pretty Urls".
   * 3) Impose security by controlling incoming parameters
   * 4) Register the events your module handles 
   *
   * 1. Simply module tag:
   * Simple!
   * Calling RegisterModulePlugin allows you to use the tag {Skeleton} in your
   * template or page; otherwise, you would have to use the more cumbersome
   * tag {cms_module module='Skeleton'}
   *
   * 2. Pretty URLS:
   * Typically, modules create internal links that have
   * big ugly strings along the lines of:
   * index.php?mact=ModName,cntnt01,actionName,0&cntnt01param1=1&cntnt01param2=2&cntnt01returnid=3
   *
   * You might prefer these to look like:
   * /ModuleFunction/2/3
   *
   * To do this, you have to register routes and map
   * your parameters in a way that the API will be able
   * to understand.
   *
   * Also note that any calls to CreateLink will need to
   * be updated to pass the pretty url parameter.
   *
   * 3. Security:
   * By using the RestrictUnknownParams function, your module will not
   * receive any parameters other than the ones you declare here.
   * Furthermore, the parameters your module does receive will be filtered
   * according to the rules you set here.
   *
   * 4. Event Handling
   * If your module generates events, you register that fact in your install method
   * (see method.install.php for an example of this). However, if your module will
   * handle/process/consume events generated by the Core or other modules, you
   * can register that in this method.
   * 
   */ 

  function SetParameters()
  {
   /*
    * 1. Simply module tag
    * This next line allows you to use the tag {FEUsignUp} in your template or page; otherwise,
    * you would have to use the more cumbersome tag {cms_module module='FEUsignUp'}
    */
  $this->RegisterModulePlugin();

   /*
    * 2. Pretty URLS
    *

    For example:
    $this->RegisterRoute('/skeleton\/add\/(?P<skeleton_id>[0-9]+)\/(?P<returnid>[0-9]+)$/',
		 array('action'=>'default'));

    now, any url that looks like:
    /skeleton/view/3/5
    would call the default action, with:
    $params['skeleton_id'] set to 3
    and $returnid set to 5

	Be sure to take a look in action.default.php, where the links are created for viewing, editing, and adding
	records. You'll see that the CreateFrontendLink takes all the parameters to create a link for non-pretty
	URLs, but also takes a string parameter which is a fully-assembled Pretty URL. Just registering the routes
	is not enough; you module's links need to create the URLs on their side as well.
    */
	$this->RegisterRoute(
        '/feusignup\/view\/(?P<from>(cgcal)|(tss))\/(?P<from_id>[0-9]+)$/',
        array('action'=>'displayevent', 'showtemplate'=>'false')
    );
	$this->RegisterRoute(
        '/feusignup\/update\/(?P<from_id>[0-9]+)$/',
        array('action'=>'update', 'showtemplate'=>'false')
    );

   /*
	* 2a. Custom URLs for Specific Content
	*

	As of CMSMS 1.9, you can create a specific URL and map it to whatever you want. Say you knew that the
	record with skeleton_id = 1 was going to be a special record, and you wanted to associate it with the URL:

	http://yoursite.com/this/is/insanely/great/stuff 

	To do this, you'd register a route with the correct paramters using the CMS Route Manager:
	
	
	$gCms = cmsms();
	$contentops = $gCms->GetContentOperations();
	$returnid = $contentops->GetDefaultContent();
	// The previous three lines are to get a returnid; many modules, like News, have a default
	// page in which to display detail views. In that case, the page_id would be used for returnid.
	
	// The next three lines are where we map the URL to our detail page.
	$parms = array('action'=>'default','skeleton_id'=>1,'returnid'=>$returnid);
	$route = new CmsRoute('this/is/insanely/great/stuff',$this->GetName(),$parms,TRUE);
	cms_route_manager::register($route);
	*/
   /*
    * 3. Security
    *
    */
   // Don't allow parameters other than the ones you've explicitly defined
   $this->RestrictUnknownParams();
  
   // syntax for creating a parameter is parameter name, default value, description
   $this->CreateParameter('feusu_id', -1, $this->Lang('help_feusu_id'));
   // feusu_id must be an integer
   $this->SetParameterType('feusu_id',CLEAN_INT);

   // cal_id must be an integer
   $this->CreateParameter('cal_id',-1,$this->Lang('help_cal_id'));
   $this->SetParameterType('cal_id',CLEAN_INT);
   
   // tss_id must be an integer
   $this->CreateParameter('tss_id',-1,$this->Lang('help_tss_id'));
   $this->SetParameterType('tss_id',CLEAN_INT);
   
   // group must be a string
   $this->CreateParameter('group','',$this->Lang('help_group'));
   $this->SetParameterType('group',CLEAN_STRING);
   
   // limit must be an integer
   $this->CreateParameter('limit',-1,$this->Lang('help_limit'));
   $this->SetParameterType('limit',CLEAN_INT);
    
   // description must be a string
   $this->CreateParameter('description','',$this->Lang('help_description'));
   $this->SetParameterType('description',CLEAN_STRING);
   
   // rel must be a string
   $this->CreateParameter('rel','',$this->Lang('help_rel'));
   $this->SetParameterType('rel',CLEAN_STRING);
   
   // template must be a string
   $this->CreateParameter('template','',$this->Lang('help_template'));
   $this->SetParameterType('template',CLEAN_STRING);

   /*
    * 4. Event Handling
    *
   
    Typical example: specify the originator, the event name, and whether or not
    the event is removable (used for one-time events)

    $this->AddEventHandler( 'Core', 'ContentPostRender', true );
    */
  }

    
  /**
   * DoEvent()
   * If your module receives/handles/processes events generated
   * by the core or by other modules, you will need to provide
   * this method to do whatever it is you're going to do.
   * Other than the event details, the parameters passed to your
   * method depend entirely on the event originator. You can
   * see what those parameters are by clicking on the Information
   * button for the event in the Admin > Extensions > Event Manager
   *
   * @param string originator where the event originated, e.g. "Core",
   * "News", etc.
   * @param string eventname the name of the event
   * @param mixed params the parameters passed by the event initiator
   
    function DoEvent( $originator, $eventname, &$params )
	{
	if ($originator == 'FrontEndUsers' && $eventname == 'OnDeleteUser')
		{
            $userId = $params['id'];
            // Doing something to the user who was deleted?
		}
	}
    */
   
    /*---------------------------------------------------------
       InstallPostMessage()
       After installation, there may be things you want to
       communicate to your admin. This function returns a
       string which will be displayed.
      ---------------------------------------------------------*/
    function InstallPostMessage()
    {
        return $this->Lang('postinstall');
    }

    /*---------------------------------------------------------
       UninstallPostMessage()
       After removing a module, there may be things you want to
       communicate to your admin. This function returns a
       string which will be displayed.
      ---------------------------------------------------------*/
    function UninstallPostMessage()
    {
        return $this->Lang('postuninstall');
    }




    /**
     * UninstallPreMessage()
     * This allows you to display a message along with a Yes/No dialog box. If the user responds
     * in the affirmative to your message, the uninstall will proceed. If they respond in the
     * negative, the uninstall will be canceled. Thus, your message should be of the form
     * "All module data will be deleted. Are you sure you want to uninstall this module?"
     *
     * If you don't want the dialog, have this method return a FALSE, which will cause the
     * module to uninstall immediately if the user clicks the "uninstall" link.
     */
    function UninstallPreMessage()
    {
        return $this->Lang('really_uninstall');
    }
    
    /**
     * _GetFEUgroups()
     * Retrieves Front End User -groups directly from the database.
     */
     function _GetFEUgroups()
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $ret = array();
        $q = 'SELECT id,groupname,groupdesc FROM '.cms_db_prefix().'module_feusers_groups';
        $dbresult = $db->Execute( $q );
        if( $dbresult ) {
            while( $row = $dbresult->FetchRow() ) {
                $ret[ $row['id'] ] = $row['groupdesc'];
            }
        }
        return $ret;
     }
    
    /**
     * _GetCGCalendarCategories()
     * Retrieves CGCalendar categories directly from the database.
     */
     function _GetCGCalendarCategories()
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $cgcal =& cge_utils::get_module('CGCalendar');
        if( $cgcal === null ) die('CGCalendar module is not installed!');
        
        $ret = array();
        $q = 'SELECT category_id,category_name FROM ' . $cgcal->categories_table_name . ' ORDER BY category_order, category_name';
        $dbresult = $db->Execute( $q );
        if( $dbresult ) {
            while( $row = $dbresult->FetchRow() ) {
                $ret[ $row['category_id'] ] = $row['category_name'];
            }
        }
        return $ret;
     }
     
    /**
     * _GetTSSteams()
     * Retrieves TSS teams directly from the database.
     */
     function _GetTSSteams()
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $ret = array();
        // Ignore the NONE-team.
        $q = 'SELECT team_id,team_name,team_code FROM '.cms_db_prefix().'module_tss_team WHERE team_id != 0 ORDER BY team_id ASC';
        $dbresult = $db->Execute( $q );
        if( $dbresult ) {
            while( $row = $dbresult->FetchRow() ) {
                $ret[ $row['team_id'] ] = $row['team_code'];
            }
        }
        return $ret;
    }
    
    /**
     * _GetCGCalendarEventTitle()
     * Retrieves the title of a single event from CGCalendar directly from the database.
     */
     function _GetCGCalendarEventTitle( $eid )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $q = 'SELECT event_title FROM '.cms_db_prefix().'module_cgcalendar_events WHERE event_id = ?';
        $row = $db->GetRow( $q, array( (int)$eid ) );
        if( !$row ) return FALSE;
        
        return $row['event_title'];
     }
     
    /**
     * _CGCalendarEventExists()
     * Checks whether an event exists in CGCalendars database.
     */
     function _CGCalendarEventExists( $eid )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $q = 'SELECT event_id FROM '.cms_db_prefix().'module_cgcalendar_events WHERE event_id = ?';
        $row = $db->GetRow( $q, array( (int)$eid ) );
        if( !$row )
          return FALSE;
        else
          return TRUE;
      }
      
    /**
     * GetEventUsers()
     * Retrieves an array of users from those who are set to the group of the event.
     */
    function GetEventUsers( $id, $from = 'calendar' )
    {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $id = (int)$id;
        $events_table_name = $this->events_table_name;
        switch($from) {
            case 'calendar':
            case 'cgcalendar':
            case 'cgcal':
                $search_field = 'cgcal_event_id';
                break;
            case 'tss':
            case 'teamsportscores':
                $search_field = 'tss_game_id';
                break;
            default:
                return array();
        }
        
        $query = "SELECT * FROM $events_table_name WHERE $search_field = $id";
        $result = array();
        $rs = $db->Execute($query);
        if($rs && $rs->RecordCount() > 0) {
            $result = $rs->GetArray();
        }
        return $result;
    }
    
    /**
     * AddLinking()
     * Adds a link that links FEU-group to CGCalendar categories and/or TSS teams.
     */
    function AddLinking($feug_id, $cgcc_id, $tsst_id, $desc = '')
    {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $linkings_table_name = $this->linkings_table_name;
        
        $feug_id = (int)$feug_id;
        $cgcc_id = (int)$cgcc_id;
        $tsst_id = (int)$tsst_id;
        
        if( $cgcc_id < 0 ) $cgcc_id = -1;
        if( $tsst_id < 0 ) $tsst_id = -1;
        
        if( ( $tsst_id == -1 && $cgcc_id == -1 ) || $feug_id < 0 ) {
            return array( false, $this->Lang('error') );
        }
        
        // Get a fresh ID from sequence.
        $lid = $db->GenID($linkings_table_name . '_seq');
        
        $q = "INSERT INTO $linkings_table_name " .
             "(linking_id, feusers_group_id, cgcal_category_id, tss_team_id, description) " . 
             "VALUES (?, ?, ?, ?, ?)";
        
        $rs = $db->Execute($q,array($lid,$feug_id,$cgcc_id,$tsst_id,$desc));
        
        if( $rs ) { 
            return array( true, $this->Lang('linking_added') );
        } else {
            return array( false, $this->Lang('db_error') );
        }
    }
    
    /**
     * GetLinkings()
     * Fetches all linkings from database and returns a two-dimensional 
     * associative array containing all rows.
     */
    function GetLinkings()
    {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $q = 'SELECT * FROM ' . $this->linkings_table_name;
        
        $result = array();
        $rs = $db->Execute($q);
        if($rs && $rs->RecordCount() > 0) {
            $result = $rs->GetArray();
        }
        return $result;
    }
    
    /**
     * GetLinkingById()
     * Fetches information array from database by linking-ID.
     */
    function GetLinkingById( $lid )
    {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $lid = (int)$lid;
        $q = 'SELECT * FROM ' . $this->linkings_table_name . ' WHERE linking_id = ' . $lid;
        $q .= ' LIMIT 1';
        
        $result = array();
        $rs = $db->Execute($q);
        if($rs && $rs->RecordCount() > 0) {
            $result = $rs->FetchRow();
        }
        return $result;
    }
    
    /**
     * UpdateLinking()
     * Updates an existing linking.
     */
     function UpdateLinking( $lid, $feug_id = -1, $cgcc_id = -1, $tsst_id = -1, $desc = '-noupdate-' )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $q = 'UPDATE ' . $this->linkings_table_name . ' SET ';
        $pr_arr = array(); // Prepared statement array containing ?-values
        
        if( $feug_id >= 0 ) {
            $q .= 'feusers_group_id=?, ';
            $pr_arr[] = $feug_id;
        }
        if( $cgcc_id >= 0 ) {
            $q .= 'cgcal_category_id=?, ';
            $pr_arr[] = $cgcc_id;
        }
        if( $tsst_id >= 0 ) {
            $q .= 'tss_team_id=?, ';
            $pr_arr[] = $tsst_id;
        }
        if( $desc !== '-noupdate-' ) {
            $q .= 'description=?, ';
            $pr_arr[] = $desc;
        }
        
        // Check to see whether we are even going to update anything
        if( count($pr_arr) == 0 ) 
            return array( false, $this->Lang('nothing_updated') );
        
        // Remove the last comma and space
        $q = substr( $q, 0, -2 );
        
        $q .= ' WHERE linking_id = ?';
        $pr_arr[] = $lid;
        
        // Run the query
        $ret = $db->Execute( $q, $pr_arr );
        
        if( !$ret ) return array( false, $this->Lang('db_error') );
        
        if( $db->Affected_Rows() > 0 ) {
            return array( true, $this->Lang('linking_updated') );
        } else {
            return array( false, $this->Lang('nothing_updated') );
        }
     }
     
    /**
     * UpdateLinkingDescription()
     * Updates description of an existing linking.
     */
     function UpdateLinkingDescription( $lid, $desc )
     {
        return $this->UpdateLinking( $lid, -1, -1, -1, $desc );
     }
     
    /**
     * DeleteLinking()
     * Removes a linking from the database.
     */
     function DeleteLinking( $lid )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        // Query
        $q = 'DELETE FROM ' . $this->linkings_table_name . ' WHERE linking_id = ? LIMIT 1';
        
        // Run the query
        $ret = $db->Execute( $q, array( (int)$lid ) );
        
        if( $db->Affected_Rows() == 1 ) {
            return array( true, $this->Lang('linking_deleted') );
        } else {
            return array( false, $this->Lang('db_error') );
        }
     }
     
    /**
     * GetSignups()
     * Fetches signups from the database and returns an array containing them.
     * This function paginates, showing only 30 hits on one call.
     */
     function GetSignups( $page = 0, $restrict = '' )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        // Query
        $q = 'SELECT * FROM ' . $this->events_table_name . ' ' . $restrict . ' ORDER BY id LIMIT ?,?';
        
        if( $page < 0 ) $page = 0;
        // Run it and return the results
        $result = array();
        $ret = $db->Execute( $q, array( $page*30, ($page+1)*30 ) );
        if($ret && $ret->RecordCount() > 0) {
            $result = $ret->GetArray();
        }

        return $result;
     }
     
    /**
     * GetSignupPagesAmount()
     * This function returns the amount of signups divided by 30 from the database.
     */
    function GetSignupPagesAmount($restrict = '') {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        $q = 'SELECT COUNT(*) AS eventCount FROM ' . $this->events_table_name . ' ' . $restrict;
        
        $ret = $db->GetRow( $q );
        if( !$ret || empty($ret) ) return 0;
        
        return (int)ceil( $ret['eventCount'] / 30 );
    }
     
    /**
     * GetSignup()
     * Fetches one signup from the database and returns an array containing its fields.
     */
     function GetSignup( $sid )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        // Query
        $q = 'SELECT * FROM ' . $this->events_table_name . ' WHERE id = ?';
        
        // Run it and return the results
        $result = array();
        $ret = $db->Execute( $q, array( $sid ) );
        if($ret && $ret->RecordCount() > 0) {
            $result = $ret->GetArray();
        }

        return $result;
     }
     
    /**
     * ModifySignup()
     * Modifies an existing signup or adds a new one if there aren't any.
     */
     function ModifySignup( $event_id, $user_id, $signup, $description, $from = 'cgcalendar' )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        if( $from == 'cgcalendar' ) {
          $q = 'SELECT id FROM ' . $this->events_table_name . ' WHERE cgcal_event_id = ? AND feu_user_id = ?';
        } elseif( $from == 'tss' ) {
          $q = 'SELECT id FROM ' . $this->events_table_name . ' WHERE tss_game_id = ? AND feu_user_id = ?';
        } else {
          return array( false, $this->Lang('error') );
        }
        $row = $db->GetRow( $q, array( (int)$event_id, (int)$user_id ) );
        if( !$row )
          return $this->_AddSignup( $event_id, $user_id, $signup, $description, $from );
        else
          return $this->_UpdateSignup( $event_id, $user_id, $signup, $description, $from );
     }
       
    /**
     * _AddSignup()
     * Private function for handling the adding of a new signup to the database.
     */
     private function _AddSignup( $event_id, $user_id, $signup, $description, $from )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        // generate the sequence
        $sid = $db->GenID( $this->events_table_name . '_seq' );
        
        if( $from = 'cgcalendar' ) {
          $q = 'INSERT INTO ' . $this->events_table_name . ' (id,feu_user_id,cgcal_event_id,signed_up,description)
                VALUES (?,?,?,?,?)';
        } elseif( $from = 'tss' ) {
          $q = 'INSERT INTO ' . $this->events_table_name . ' (id,feu_user_id,tss_game_id,signed_up,description)
                VALUES (?,?,?,?,?)';
        } else {
          return FALSE;
        }
        
        $rs = $db->Execute($q,array($sid,$user_id,$event_id,($signup == true),$description));
        
        if( $rs ) {
          return array( true, $this->Lang( 'signup_updated' ) );
        } else {
          return array( false, $this->Lang( 'db_error' ) );
        }
     }
       
    /**
     * _UpdateSignup()
     * Private function for handling the updating of an existing signup.
     */
     private function _UpdateSignup( $event_id, $user_id, $signup, $description, $from )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        if( $from = 'cgcalendar' ) {
          $q = 'UPDATE ' . $this->events_table_name . ' SET feu_user_id = ?, cgcal_event_id = ?, signed_up = ?, description = ?
                WHERE cgcal_event_id = ? AND feu_user_id = ?';
        } elseif( $from = 'tss' ) {
          $q = 'UPDATE ' . $this->events_table_name . ' SET feu_user_id = ?, tss_game_id = ?, signed_up = ?, description = ?
                WHERE tss_game_id = ? AND feu_user_id = ?';
        } else {
          return FALSE;
        }
        
        $rs = $db->Execute($q,array($user_id,$event_id,($signup == true),$description,$event_id,$user_id));
        
        if( !$rs ) {
          return array( false, $this->Lang( 'db_error' ) );
        }
        
        if( $db->Affected_Rows() > 0 ) {
          return array( true, $this->Lang( 'signup_updated' ) );;
        } else {
          return array( true, $this->Lang( 'nothing_updated' ) );;
        }
     }
     
    /**
     * DeleteSignup()
     * Deletes a signup from the database.
     */
     function DeleteSignup( $sid )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        // Query
        $q = 'DELETE FROM ' . $this->events_table_name . ' WHERE id = ? LIMIT 1';
        
        // Run the query
        $ret = $db->Execute( $q, array( (int)$sid ) );
        
        if( $db->Affected_Rows() == 1 ) {
            return array( true, $this->Lang('signup_deleted') );
        } else {
            return array( false, $this->Lang('db_error') );
        }
     }
     
    /**
     * GetSignupsAmountForEvent()
     * Returns the amount of users signed up for a certain event
     */
     function GetSignupsAmountForEvent( $eid, $from = 'cgcalendar' )
     {
        $db =& $this->GetDb(); /* @var $db ADOConnection */
        
        if( $from == 'cgcalendar' ) {
          $q = 'SELECT id FROM ' . $this->events_table_name . ' WHERE cgcal_event_id = ? AND signed_up = 1';
        } elseif( $from == 'tss' ) {
          $q = 'SELECT id FROM ' . $this->events_table_name . ' WHERE tss_game_id = ? AND signed_up = 1';
        } else {
          return 0;
        }
        
        // Run the query
        $ret = $db->Execute( $q, array( (int)$eid ) );
        
        if($ret) {
          $result = $ret->RecordCount();
        } else {
          $result = 0;
        }
        
        return $result;
     }
     
    /**
     * _SortEventsByDate()
     * An internal callback function for usort()-function for sorting events by date.
     * Used in function.admin_overviewtab.php file.
     */
     static function _SortEventsByDate( &$a, &$b ) {
        if( $a->event_date_ut == $b->event_date_ut ) {
          return 0;
        }
        return ( $a->event_date_ut < $b->event_date_ut ) ? -1 : 1;
     }
     
    /**
     * _SortEventsByEventId()
     * An internal callback function for usort()-function for sorting events by events id.
     * Used in function.admin_overviewtab.php file.
     */
     static function _SortEventsByEventId( &$a, &$b ) {
        if( $a->event_id == $b->event_id ) {
          return 0;
        }
        return ( $a->event_id < $b->event_id ) ? -1 : 1;
     }
     
    /**
     * _SortEventsByUsername()
     * An internal callback function for usort()-function for sorting events by username.
     * Used in function.admin_overviewtab.php file.
     */
     static function _SortEventsByUsername( &$a, &$b ) {
        $al = strtolower( $a->feu );
        $bl = strtolower( $b->feu );
        if( $al == $bl ) {
          return 0;
        }
        return ( $al < $bl ) ? -1 : 1;
     }
}

?>