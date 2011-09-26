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
    case "0.1":
      // Set the new display event template and delete the old one
      $this->SetTemplate('feusignup_pref_newdisplayevent_template', 
                         $this->GetTemplate('feusignup_displayevent'));
      $this->DeleteTemplate('feusignup_displayevent');
      
      // Set new defaults for templates to the database
      $dflt_displayevent = file_get_contents( cms_join_path( 
                            $gCms->config['root_path'], 'modules', 'FEUsignUp', 
                            'templates', 'orig_displayevent.tpl'));
      $dflt_cal_link = <<<'EOD'
{strip}
{assign var=day_name value=$event.event_date_start|date_format:"%A"}
{assign var=time_start value=$event.event_date_start|date_format:"%H:%M"}
{assign var=time_end value=$event.event_date_end|date_format:"%H:%M"}
{assign var=description value="$day_name, $time_start - $time_end"}
{$description} ({$signups_amount})
{/strip}
EOD;
      $dflt_tss_link = <<<'EOD'
{assign var=month value=$match.date|date_format:"%m"|regex_replace:"/0([1-9])/":"\\1"}
{$match.hometeam} - {$match.visitorteam}<br />
{$match.date|date_format:"%a %e."}{$month}. klo {$match.date|date_format:"%H:%M"}
EOD;
      $this->SetTemplate('feusignup_pref_dfltdisplayevent_template', $dflt_displayevent);
      $this->SetTemplate('feusignup_pref_dfltcallink_template', $dflt_cal_link);
      $this->SetTemplate('feusignup_pref_dflttsslink_template', $dflt_tss_link);
      
      // Set cal_link and tss_link new templates as defaults
      $this->SetTemplate('feusignup_pref_newcallink_template', $dflt_cal_link);
      $this->SetTemplate('feusignup_pref_newtsslink_template', $dflt_tss_link);
      break;
  }
  
  // put mention into the admin log
  $this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('upgraded',$this->GetVersion()));

?>