<?php
/**
 * DisplayAdminPanel($id, $params, $returnid, $message)
 * NOT PART OF THE MODULE API
 * 
 * This is an example of a simple method to present an Admin
 * panel.
 * 
 * It sets smarty tag values, and then calls the
 * code necessary to render the template.   
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
 * wrapped in the DisplayAdminPanel() method in the module body.
 */
 
// Tab Infrastructure for Admin Area -- create two tabs, one of which
// is only accessible if permissions are right
if (FALSE == empty($params['active_tab']))
  {
    $tab = $params['active_tab'];
  } else {
  $tab = '';
 }

$tab_header = $this->StartTabHeaders() .
   $this->SetTabHeader('general',$this->Lang('title_general'),('general' == $tab)?true:false);
$this->smarty->assign('start_general_tab',$this->StartTab('general', $params));


if ($this->CheckPermission('Set Skeleton Prefs'))
   {
   $tab_header .= $this->SetTabHeader('prefs',$this->Lang('title_mod_prefs'),
      ('prefs' == $tab)?true:false);
   $this->smarty->assign('start_prefs_tab',$this->StartTab('prefs', $params));
   }
else
   {
   $this->smarty->assign('start_prefs_tab','');
   }

$this->smarty->assign('tabs_start',$tab_header.$this->EndTabHeaders().$this->StartTabContent());
$this->smarty->assign('tab_end',$this->EndTab());
$this->smarty->assign('tabs_end',$this->EndTabContent());

// Content defines and Form stuff for the admin
$smarty->assign('start_form', $this->CreateFormStart($id, 'save_admin_prefs', $returnid));
$smarty->assign('input_allow_add',$this->CreateInputCheckbox($id, 'allow_add', 1,
   $this->GetPreference('allow_add','0')). $this->Lang('title_allow_add_help'));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));

// translated strings
$smarty->assign('title_allow_add',$this->Lang('title_allow_add'));
$smarty->assign('welcome_text',$this->Lang('welcome_text'));

echo $this->ProcessTemplate('adminpanel.tpl');
/**
 * You might also want to look at other modules that have done this :)
 *  (News and Questions are good examples)
 */

?>