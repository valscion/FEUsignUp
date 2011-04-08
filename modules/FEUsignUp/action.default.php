<?php
/**
 *
 * This is an example of a simple method to display
 * database data on page using a template.
 *
 * If the "skeleton_id" parameter is set, this page will
 * display only that single record. Otherwise, it will display
 * one page worth of records. This is really silly in this case,
 * because the view is identical. If you have a more complex
 * record though, you could do something useful.
 *
 * Note that it uses a template, and is thus very powerful,
 * even if it's simple.
 */

/**
 * For separated methods, you'll always want to start with the following
 * line which check to make sure that method was called from the module
 * API, and that everything's safe to continue:
 */ 
if (!isset($gCms)) exit;

/**
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the action.
 */

// get our records from the database
$db = $gCms->GetDb();

$query = 'SELECT skeleton_id, description, explanation from '.cms_db_prefix().
   'module_skeleton';

if (isset($params['skeleton_id']))
   {
   // *ALWAYS* use parameterized queries with user-provided input
   // to prevent SQL-Injection attacks!
   $query .= ' where skeleton_id = ?';
   $result = $db->Execute($query,array($params['skeleton_id']));
   $mode = 'detail'; // we're viewing a single record
   }
else
   {
   // we're not getting a specific record, so show 'em all. Probably should paginate.
   $result = $db->Execute($query);
   $mode = 'summary'; // we're viewing a list of records
   }
   
$records = array();
while ($result !== false && $row=$result->FetchRow())
   {
   // create a new object for every record that we retrieve
   $rec = new stdClass();
   $rec->id = $row['skeleton_id'];
   $rec->name = $row['description'];
   $rec->explanation = $row['explanation'];

   // create attributes for rendering "view" links for the object.
   // $id and $returnid are predefined for us by the module API
   // that last parameter is the Pretty URL link
   $rec->view = $this->CreateFrontendLink($id, $returnid, 'default', $this->Lang('link_view'),
      array('skeleton_id'=>$rec->id),'',false,true,'',false,'skeleton/view/'.$rec->id.'/'.$returnid);
   $rec->edit = $this->CreateFrontendLink($id, $returnid, 'add_edit', $this->Lang('edit'),
      array('skeleton_id'=>$rec->id),'',false,true,'',false,'skeleton/edit/'.$rec->id.'/'.$returnid);
   array_push($records,$rec);
   }

// Expose the list to smarty.
$this->smarty->assign('records',$records);

// Tell Smarty which mode we're in
$this->smarty->assign('mode',$mode);

// and a count of records
$this->smarty->assign('title_num_records',$this->Lang('title_num_records',array(count($records))));

if ($this->GetPreference('allow_add',1) == 1)
   {
   $this->smarty->assign('add', $this->CreateFrontendLink($id, $returnid, 'add_edit',
      $this->Lang('add_record'),array(),'',false,true,'',false,'skeleton/add/'.$returnid));

   }
else
   {
   $this->smarty->assign('add', '');
   }

if (isset($params['module_message']))
   {
   $this->smarty->assign('module_message',$params['module_message']);
   }
else
   {
   $this->smarty->assign('module_message','');
   }

// Display the populated template
echo $this->ProcessTemplate('skeleton_list.tpl');

?>