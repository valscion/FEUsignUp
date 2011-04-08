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

$this->smarty->assign('tab_headers',$this->StartTabHeaders().
	$this->SetTabHeader('overview',$this->Lang('title_overview')).
	$this->EndTabHeaders().$this->StartTabContent());
$this->smarty->assign('end_tab',$this->EndTab());
$this->smarty->assign('tab_footers',$this->EndTabContent());
$this->smarty->assign('start_overview_tab',$this->StartTab('overview'));
$this->smarty->assign('title_section','defaultadmin');

echo $this->ProcessTemplate('adminpanel.tpl');


?>