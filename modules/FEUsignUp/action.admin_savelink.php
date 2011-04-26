<?php
if (!isset($gCms)) exit;
/*
$extracontent = '';

$extracontent .= 'feu_group: ' . $params['feu_group'] . '|';
$extracontent .= 'cgc_category: ' . $params['cgc_category'] . '|';
$extracontent .= 'tss_team: ' . $params['tss_team'];
#$extracontent[] = ': ' . $params[''];
*/

// Return message as an array with two cells. First cell
// specifies whether all is successful or not and the second
// specifies the message to display.
$ret = array( true, '' );

if( isset( $params['cancel'] ) ) {
    // We just want to cancel! So do nothing. :)
}
elseif( isset( $params['delete'] ) ) {
    // We want to delete a record
    $ret = $this->DeleteLinking( $params['linking_id'] );
}
elseif( $params['linking_id'] == -1 ) {
    // We're creating a new linking.
    //   - AddLinking( $feug_id, $cgcc_id, $tsst_id, $desc = '' )
    $ret = $this->AddLinking( $params['feu_group'], 
                              $params['cgc_category'],
                              $params['tss_team'],
                              $params['description']
                            );
} else {
    // We're updating an existing linking.
    $ret = $this->UpdateLinking( $params['linking_id'],
                                 $params['feu_group'], 
                                 $params['cgc_category'],
                                 $params['tss_team'],
                                 $params['description']
                               );
}

if( $ret[0] === FALSE ) {
    // set to display error, if unsuccessful
    $params['error'] = $ret[1];
}

// Message to display
$params['message'] = $ret[1];

// set the active tab
$params['active_tab'] = 'linkings';

// redirect back to default admin page
$this->Redirect($id, 'defaultadmin', $returnid, $params);

## EOF