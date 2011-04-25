<?php
$extracontent = '';

$extracontent .= 'feu_group: ' . $params['feu_group'] . '|';
$extracontent .= 'cgc_category: ' . $params['cgc_category'] . '|';
$extracontent .= 'tss_team: ' . $params['tss_team'];
#$extracontent[] = ': ' . $params[''];

// set the active tab, and a message to display
$params = array('tab_message'=> 'linkings_updated', 'active_tab' => 'linkings', 'extracontent'=>$extracontent);

// redirect back to default admin page
$this->Redirect($id, 'defaultadmin', $returnid, $params);

## EOF