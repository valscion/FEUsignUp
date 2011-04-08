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
            feu_user_id I,
            cgcal_event_id I,
            tss_game_id I DEFAULT 0,
            signed_up L,
            description C(255)
            ";

        // create it. This should do error checking, but I'm a lazy sod.
        $sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_feusignup",
                $flds, $taboptarray);
        $dict->ExecuteSQLArray($sqlarray);

        // create a sequence
        $db->CreateSequence(cms_db_prefix()."module_feusignup_seq");
        
        
        // permissions
        

        // put mention into the admin log
        $this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('installed',$this->GetVersion()));
        
?>