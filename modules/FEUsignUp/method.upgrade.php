<?php
if (!isset($gCms)) exit;

/*---------------------------------------------------------
   Upgrade()
   If your module version number does not match the version
   number of the installed module, the CMS Admin will give
   you a chance to upgrade the module. This is the function
   that actually handles the upgrade.
   Ideally, this function should handle upgrades incrementally,
   so you could upgrade from version 0.0.1 to 10.5.7 with
   a single call. For a great example of this, see the News
   module in the standard CMS install.
  ---------------------------------------------------------*/
  $current_version = $oldversion;
  switch($current_version)
  {
    case "0.2.1.4":
      // Remove old templates and preferences
      $this->DeleteTemplate();
      $this->RemovePreference();
      
      // Set them correctly
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
      break;
  }
  
  // put mention into the admin log
  $this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('upgraded',$this->GetVersion()));

?>