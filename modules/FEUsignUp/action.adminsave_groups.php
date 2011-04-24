<?php
// TODO: Save a new group

// set the active tab, and a message to display
$params = array('tab_message'=> 'groups_updated', 'active_tab' => 'groups');

// redirect back to default admin page
$this->Redirect($id, 'defaultadmin', $returnid, $params);

## EOF