<?php
if (!isset($gCms)) exit;

/*---------------------------------------------------------
 Uninstall()
 Sometimes, an exceptionally unenlightened or ignorant
 admin will wish to uninstall your module. While it
 would be best to lay into these idiots with a cluestick,
 we will do the magnanimous thing and remove the module
 and clean up the database, permissions, and preferences
 that are specific to it.
 This is the method where we do this.
 ---------------------------------------------------------*/


// Typical Database Removal
$db =& $gCms->GetDb();

// remove the database table
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( $this->events_table_name );
$dict->ExecuteSQLArray($sqlarray);

// remove the sequence
$db->DropSequence( $this->events_table_name.'_seq' );

// remove the database table
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( $this->linkings_table_name );
$dict->ExecuteSQLArray($sqlarray);

// remove the sequence
$db->DropSequence( $this->linkings_table_name.'_seq' );

// templates
$this->DeleteTemplate();

// preferences
$this->RemovePreference();

// remove the permissions
$this->RemovePermission('Use FEUsignUp');


// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));

?>