<?php
if (!isset($gCms)) exit;

if( !isset( $params['linking_id'] ) )
{
    // set the active tab and an error
    $params = array('active_tab' => 'linkings', 'tab_error' => $this->Lang('error'));
    // redirect back to default admin page
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}

// Get existing information
$oldinfo = $this->GetLinkingById( $params['linking_id'] );

if( empty( $oldinfo ) ) {
    // set the active tab and an error
    $params = array('active_tab' => 'linkings', 'tab_error' => $this->Lang('error'));
    // redirect back to default admin page
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}

// Fetch FEU groups, CGCalendar categories and TSS teams directly from db.
$feug_array = $this->_GetFEUgroups();
$feug_dropdown = array_flip( $feug_array );

$cgcc_array = $this->_GetCGCalendarCategories();
$cgcc_dropdown = array_flip( $cgcc_array );

$tsst_array = $this->_GetTSSteams();
$tsst_dropdown = array_flip( $tsst_array );


// Assign form elements
$smarty->assign('start_form', $this->CreateFormStart(
    $id, 'admin_savelink', $returnid));
$smarty->assign('hidden', $this->CreateInputHidden(
    $id, 'linking_id', $oldinfo['linking_id']));
$smarty->assign('input_feugroup', $this->CreateInputDropdown(
    $id, 'feu_group', $feug_dropdown, -1, $oldinfo['feusers_group_id']));
$smarty->assign('input_cgcal_category', $this->CreateInputDropdown(
    $id, 'cgc_category', $cgcc_dropdown, -1, $oldinfo['cgcal_category_id']));
$smarty->assign('input_tss_team', $this->CreateInputDropdown(
   $id, 'tss_team', $tsst_dropdown, -1, $oldinfo['tss_team_id']));
$smarty->assign('input_description', $this->CreateInputText(
    $id, 'description',$oldinfo['description'],40));


// Assign forms language-specific strings
$smarty->assign('prompt_editlink', $this->Lang('prompt_editlink'));
$smarty->assign('prompt_feugroup', $this->Lang('prompt_feugroup'));
$smarty->assign('prompt_cgcal_category', $this->Lang('prompt_cgcal_category'));
$smarty->assign('prompt_tss_team', $this->Lang('prompt_tss_team'));
$smarty->assign('prompt_description', $this->Lang('prompt_description'));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', $this->Lang('submit_existing_link')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', $this->Lang('cancel')));

// Run the template
echo $this->ProcessTemplate('admin_editlinking.tpl');
## EOF