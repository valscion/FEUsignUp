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
  $tab = 'overview';
 }

$tab_header = $this->StartTabHeaders();

$tab_header .= $this->SetTabHeader('overview',$this->Lang('title_overview'),
    ('overview' == $tab)?true:false);
    $this->smarty->assign('start_overview_tab',$this->StartTab('overview', $params));

$tab_header .= $this->SetTabHeader('groups',$this->Lang('title_groups'),
    ('groups' == $tab)?true:false);
    $this->smarty->assign('start_groups_tab',$this->StartTab('groups', $params));
    
$this->smarty->assign('tabs_start',$tab_header.$this->EndTabHeaders().$this->StartTabContent());
$this->smarty->assign('tab_end',$this->EndTab());
$this->smarty->assign('tabs_end',$this->EndTabContent());
$this->smarty->assign('title_section','defaultadmin');


// Adding some content to the tabs
$this->smarty->assign('content_overview',$this->Lang('content_overview'));
$this->smarty->assign('content_groups',$this->Lang('content_groups'));

echo $this->ProcessTemplate('adminpanel.tpl');


?>