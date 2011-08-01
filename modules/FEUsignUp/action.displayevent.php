<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Code for FEUsignUp "displayevent" action

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

if( $params['from'] == 'cgcal' ) {
    // Fetch CGCalendar info
    $cgcal_id = (int)$params['from_id'];
    
    $cgcal =& cge_utils::get_module('CGCalendar');
    if( $cgcal === null ) die('CGCalendar module is not installed!');
    
    $feu =& cge_utils::get_module('FrontEndUsers');
    if( $feu === null ) die('FrontEndUsers module is not installed!');

    
    $events_to_categories_table = $cgcal->events_to_categories_table_name;
    $categories_table = $cgcal->categories_table_name;
    
    $cat_ids = array();
    
    $q = 'SELECT C.category_id,C.category_name FROM ' . $categories_table . ' C
            INNER JOIN '.$events_to_categories_table.' E
              ON C.category_id = E.category_id
            WHERE E.event_id = ?';
    $data = $db->GetArray($q,array($cgcal_id));
    foreach( $data as $row ) {
        $cat_ids[$row['category_name']] = $row['category_id'];
    }
    
    $feug_ids = array();
    foreach( $cat_ids as $name => $id ) {
        $q = 'SELECT feusers_group_id FROM ' . $this->linkings_table_name . " WHERE cgcal_category_id = $id";
        $rs = $db->Execute($q);
        while( $row = $rs->FetchRow() ) {
            $feug_ids[$name] = $row['feusers_group_id'];
        }
    }
} elseif( $params['from'] == 'tss' ) {
    // TODO: Hae matsin joukkueeseen linkitettyjen joukkueiden perusteella FEU-ryhmien ID:t
    // taulukkoon $feug_ids.
    #echo $params['from_id'];
    $feug_ids = array();
} else {
    echo '<p class="error">ERROR</p>';
    return;
}

$groups = array();
foreach( $feug_ids as $name => $id ) {
    $fullUsers = $feu->GetFullUsersInGroup( $id );
    if( $fullUsers )
        $groups[$name] = $fullUsers;
}

$users = array();
foreach( $groups as $name => $group ) {
    foreach( $group as $user ) {
        $onerow = new stdClass();
        $onerow->username = $user['username'];
        $onerow->id = $user['id'];
        $onerow->props = $user['props'];
        $onerow->cal_link = $name;
        $onerow->toggle_in = $this->CreateFrontendLink($id, $returnid, 'view',
                                'IN',array('class'=>'jslink'),'',true,true,'',false,
                                "feusignup/in/{$user['id']}/");
        $onerow->toggle_out = $this->CreateFrontendLink($id, $returnid, 'view',
                                'OUT',array('class'=>'jslink'),'',true,true,'',false,
                                "feusignup/out/{$user['id']}/");
        
        array_push( $users, $onerow );
    }
}


$this->smarty->assign('users', $users);
echo $this->ProcessTemplateFromDatabase('feusignup_displayevent');

## EOF