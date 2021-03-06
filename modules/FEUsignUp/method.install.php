<?php
if (!isset($gCms)) exit;

/*---------------------------------------------------------
   Install()
   When your module is installed, you may need to do some
   setup. Typical things that happen here are the creation
   and prepopulation of database tables, database sequences,
   permissions, preferences, etc.
   
   For information on the creation of database tables,
   check out the ADODB Data Dictionary page at
   http://phplens.com/lens/adodb/docs-datadict.htm
   
   This function can return a string in case of any error,
   and CMS will not consider the module installed.
   Successful installs should return FALSE or nothing at all.
  ---------------------------------------------------------*/

// Typical Database Initialization
$db =& $gCms->GetDb();

// mysql-specific, but ignored by other database
$taboptarray = array('mysql' => 'TYPE=MyISAM');
$dict = NewDataDictionary($db);

// table schema description
$flds = "
    id I KEY,
    feu_user_id I NOTNULL,
    cgcal_event_id I DEFAULT -1,
    tss_game_id I DEFAULT -1,
    signed_up L DEFAULT 0,
    description C(255)
    ";

// create it. This should do error checking, but I'm a lazy sod.
$sqlarray = $dict->CreateTableSQL($this->events_table_name,
        $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// create a sequence
$db->CreateSequence($this->events_table_name.'_seq');


// table schema description
$flds = "
    linking_id I KEY,
    feusers_group_id I NOTNULL,
    cgcal_category_id I DEFAULT -1,
    tss_team_id I DEFAULT -1,
    description C(255)
    ";

// create it. This should do error checking, but I'm a lazy sod.
$sqlarray = $dict->CreateTableSQL($this->linkings_table_name,
        $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// create a sequence
$db->CreateSequence($this->linkings_table_name.'_seq');


// permissions
$this->CreatePermission('Use FEUsignUp', 'Use FEUsignUp');


// templates
$fn = cms_join_path(dirname(__FILE__),'templates','orig_displayevent.tpl');
if( file_exists( $fn ) )
  {
    $template = @file_get_contents($fn);
    $this->SetTemplate('displayevent_Sample',$template);
    $this->SetPreference(FEUSIGNUP_PREF_NEWDISPLAYEVENT_TEMPLATE, $template);
    $this->SetPreference(FEUSIGNUP_PREF_DFLTDISPLAYEVENT_TEMPLATE, 'Sample');
  }
else {
  return "Failed to locate templates/orig_displayevent.tpl - is your install package corrupted?";
}
$fn = cms_join_path(dirname(__FILE__),'templates','orig_cal_link.tpl');
if( file_exists( $fn ) )
  {
    $template = @file_get_contents($fn);
    $this->SetTemplate('callink_Sample',$template);
    $this->SetPreference(FEUSIGNUP_PREF_NEWCALLINK_TEMPLATE, $template);
    $this->SetPreference(FEUSIGNUP_PREF_DFLTCALLINK_TEMPLATE, 'Sample');
  }
else {
  return "Failed to locate templates/orig_cal_link.tpl - is your install package corrupted?";
}
$fn = cms_join_path(dirname(__FILE__),'templates','orig_tss_link.tpl');
if( file_exists( $fn ) )
  {
    $template = @file_get_contents($fn);
    $this->SetTemplate('tsslink_Sample',$template);
    $this->SetPreference(FEUSIGNUP_PREF_NEWTSSLINK_TEMPLATE, $template);
    $this->SetPreference(FEUSIGNUP_PREF_DFLTTSSLINK_TEMPLATE, 'Sample');
  }
else {
  return "Failed to locate templates/orig_tss_link.tpl - is your install package corrupted?";
}


// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('installed',$this->GetVersion()));

?>