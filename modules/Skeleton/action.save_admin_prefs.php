<?php
/**
 * NOT PART OF THE MODULE API
 * 
 * This is an example of a simple method to save Admin
 * prefs.
 */

/**
 * For separated methods, you'll always want to start with the following
 * line which check to make sure that method was called from the module
 * API, and that everything's safe to continue:
 */ 
if (!isset($gCms)) exit;

/** 
 * For separated methods, you won't be able to do permission checks in
 * the DoAction method, so you'll need to do them as needed in your
 * method:
 */ 
if (! $this->CheckPermission('Use Skeleton')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}
	
/**
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the DisplayAdminPrefs() method in the module body.
 */



// set our preference
$this->SetPreference('allow_add', isset($params['allow_add'])?$params['allow_add']:'0');

// send an event to any subscribing user tags or modules
$parms = array();
$parms['allow_add'] = (isset($params['allow_add'])?true:false);
$this->SendEvent('OnSkeletonPreferenceChange',$parms);

// write to the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('prefsupdated') );

// set the active tab, and a message to display
$params = array('tab_message'=> 'prefsupdated', 'active_tab' => 'prefs');

// redirect back to default admin page
$this->Redirect($id, 'defaultadmin', $returnid, $params);
?>