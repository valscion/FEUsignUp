<?php
if (!isset($gCms)) exit;

if (! $this->CheckAccess())
    {
    return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
    }

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for FEUsignUp "defaultadmin" admin action
   
   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
   Typically, this will display something from a template
   or do some other task.
   
*/

// Tab Infrastructure for Admin Area -- create two tabs, (one of which
// is only accessible if permissions are right)
if (FALSE == empty($params['active_tab']))
  {
    $tab = $params['active_tab'];
  } else {
  $tab = '';
 }
 
// If there's messages, assign 'em to smarty
if( isset($params['message']) && !empty($params['message']) ) {
    if( isset($params['error']) && !empty($params['error']) ) {
        // If the message is an error, apply it.
        $this->smarty->assign('message', $this->ShowErrors($params['message']));
    } else {
        // Otherwise, display a normal message.
        $this->smarty->assign('message', $this->ShowMessage($params['message']));
    }
}


$tab_header = $this->StartTabHeaders();

$tab_header .= $this->SetTabHeader('overview',$this->Lang('title_overview'),
    ('overview' == $tab)?true:false);
    $this->smarty->assign('start_overview_tab',$this->StartTab('overview', $params));

$tab_header .= $this->SetTabHeader('linkings',$this->Lang('title_linkings'),
    ('linkings' == $tab)?true:false);
    $this->smarty->assign('start_linkings_tab',$this->StartTab('linkings', $params));
    
$this->smarty->assign('tabs_start',$tab_header.$this->EndTabHeaders().$this->StartTabContent());
$this->smarty->assign('tab_end',$this->EndTab());
$this->smarty->assign('tabs_end',$this->EndTabContent());
$this->smarty->assign('title_section','defaultadmin');


// Adding some content to the tabs. I just love output buffering.
ob_start();
require_once(dirname(__FILE__).'/function.admin_overviewtab.php');
$this->smarty->assign('content_overview',ob_get_clean());

ob_start();
require_once(dirname(__FILE__).'/function.admin_linkingstab.php');
$this->smarty->assign('content_linkings',ob_get_clean());

echo $this->ProcessTemplate('adminpanel.tpl');


## EOF