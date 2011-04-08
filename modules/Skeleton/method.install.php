<?php
#-------------------------------------------------------------------------
# Module: Skeleton - a pedantic "starting point" module
# Version: 1.5, SjG
# Method: Install
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2008 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/skeleton/
#
#-------------------------------------------------------------------------

/**
 * For separated methods, you'll always want to start with the following
 * line which check to make sure that method was called from the module
 * API, and that everything's safe to continue:
 */ 
if (!isset($gCms)) exit;


/** 
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the Install() method in the module body.
 */

$db = $gCms->GetDb();

// mysql-specific, but ignored by other database
$taboptarray = array( 'mysql' => 'ENGINE=MyISAM' );

$dict = NewDataDictionary( $db );

// table schema description
$flds = "
     skeleton_id I KEY,
	 description C(80),
	 explanation X
";
			
// create it. This should do error checking, but I'm a lazy sod.
$sqlarray = $dict->CreateTableSQL( cms_db_prefix()."module_skeleton",
				   $flds, 
				   $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// create a sequence
$db->CreateSequence(cms_db_prefix()."module_skeleton_seq");

// create a permission
$this->CreatePermission('Use Skeleton', 'Use Skeleton');
$this->CreatePermission('Set Skeleton Prefs','Set Skeleton Prefs');

// create a preference
$this->SetPreference("allow_add", true);

// register an event that the Skeleton will issue. Other modules
// or user tags will be able to subscribe to this event, and trigger
// other actions when it gets called.
$this->CreateEvent( 'OnSkeletonPreferenceChange' );

// put mention into the admin log
$this->Audit( 0, 
	      $this->Lang('friendlyname'), 
	      $this->Lang('installed', $this->GetVersion()) );

	      
?>