<?php
/*
$extracontent = '';

$extracontent .= 'feu_group: ' . $params['feu_group'] . '|';
$extracontent .= 'cgc_category: ' . $params['cgc_category'] . '|';
$extracontent .= 'tss_team: ' . $params['tss_team'];
#$extracontent[] = ': ' . $params[''];
*/

// set the active tab
$params = array('active_tab' => 'linkings');

// display error
$params['tab_error'] = 'ERROR!!! Your site is about to get blown apart! (Just kidding...)';

// If all successful, display a message telling it.
if( !isset( $params['tab_error'] ) ) {
    $params['tab_message'] = 'linkings_updated';
}

// redirect back to default admin page
$this->Redirect($id, 'defaultadmin', $returnid, $params);

## EOF