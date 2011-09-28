<?php
if (!isset($gCms)) exit;

/** 
 * For separated methods, you won't be able to do permission checks in
 * the DoAction method, so you'll need to do them as needed in your
 * method:
*/ 
if (! $this->CheckAccess()) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for FEUsignUp "defaultadmin" admin action
   
   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/

// If there's messages, assign 'em to smarty
if( isset($params['message']) && !empty($params['message']) ) {
    if( isset($params['error']) && !empty($params['error']) ) {
        // If the message is an error, echo it.
        echo '<p>' . $this->ShowErrors($params['message']) . '</p>';
    } else {
        // Otherwise, display a normal message.
        echo '<p>' . $this->ShowMessage($params['message']) . '</p>';
    }
}


// Print tab headers
echo $this->StartTabHeaders();

echo $this->SetTabHeader('overview',$this->Lang('title_overview'));
echo $this->SetTabHeader('linkings',$this->Lang('title_linkings'));
echo $this->SetTabHeader('template_displayevent',$this->Lang('title_template_displayevent'));
echo $this->SetTabHeader('cal_link_templates',$this->Lang('title_cal_link_templates'));
echo $this->SetTabHeader('tss_link_templates',$this->Lang('title_tss_link_templates'));

echo $this->EndTabHeaders();


// Adding some content to the tabs
echo $this->StartTabContent();

echo $this->StartTab('overview', $params);
require_once(dirname(__FILE__).'/function.admin_overviewtab.php');
echo $this->EndTab();

echo $this->StartTab('linkings', $params);
require_once(dirname(__FILE__).'/function.admin_linkingstab.php');
echo $this->EndTab();

echo $this->StartTab('template_displayevent');
require_once(dirname(__FILE__).'/function.admin_template_displayeventtab.php');
echo $this->EndTab();

echo $this->StartTab('cal_link_templates', $params);
require_once(dirname(__FILE__).'/function.admin_cal_link_templates.php');
echo $this->EndTab();

echo $this->StartTab('tss_link_templates', $params);
require_once(dirname(__FILE__).'/function.admin_tss_link_templates.php');
echo $this->EndTab();

echo $this->EndTabContent();

// Print the copyright below everything
echo $this->Lang('copyright');

## EOF