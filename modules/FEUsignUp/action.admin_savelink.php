<?php
/*
$extracontent = '';

$extracontent .= 'feu_group: ' . $params['feu_group'] . '|';
$extracontent .= 'cgc_category: ' . $params['cgc_category'] . '|';
$extracontent .= 'tss_team: ' . $params['tss_team'];
#$extracontent[] = ': ' . $params[''];
*/

// Just go ahead and save!
//   - AddLinking( $feug_id, $cgcc_id, $tsst_id, $desc = '' )
$ret = $this->AddLinking( $params['feu_group'], 
                          $params['cgc_category'],
                          $params['tss_team'],
                          $params['description']
                        );


if( $ret === FALSE ) {
    // display error, if unsuccessful
    $params['tab_error'] = $this->Lang('db_error');
}

// If all successful, display a message telling it.
if( !isset( $params['tab_error'] ) || empty( $params['tab_error'] ) ) {
    $params['tab_message'] = 'linkings_updated';
}

// set the active tab
$params = array('active_tab' => 'linkings');

// redirect back to default admin page
$this->Redirect($id, 'defaultadmin', $returnid, $params);

## EOF