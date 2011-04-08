<?php
/**
 *
 * This is an example of a method to save
 * database data.
 *
 * If the "skeleton_id" parameter is -1, it's a new record.
 * Otherwise, we're updating an old record.

 */

/**
 * For separated methods, you'll always want to start with the following
 * line which check to make sure that method was called from the module
 * API, and that everything's safe to continue:
 */
if (!isset($gCms)) exit;

// don't trust that this was safe, just because the link is hidden if the option is off!
// always code defensively! There are beasties that lurk and things go bump in the night.
if (! $this->GetPreference('allow_add',1) == 1) exit;

/**
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the action.
 */

// get our records from the database
$db = $gCms->GetDb();

if (isset($params['skeleton_id']) && $params['skeleton_id'] != -1)
   {
	// we received a skeleton_id that was not -1, which means we're updating an
	// existing record. So we issue a SQL Update
   $query = 'UPDATE '.cms_db_prefix().
      'module_skeleton set description=?, explanation=? where skeleton_id = ?';
   $result = $db->Execute($query,array($params['description'],$params['explanation'],$params['skeleton_id']));
   $params['module_message'] = $this->Lang('updated_record');
   }
else
   {
	// we received no skeleton_id or one that was -1, which means we're creating
	// a new record. So we issue a SQL Insert. But first, we use the sequence to get a fresh ID
   $sid = $db->GenID(cms_db_prefix().'module_skeleton_seq');
   $query = 'INSERT INTO '.cms_db_prefix().
      'module_skeleton (skeleton_id, description, explanation) VALUES (?,?,?)';
   $result = $db->Execute($query,array($sid,$params['description'],$params['explanation']));
   $params['module_message'] = $this->Lang('added_record');
   }

if ($result === false)
   {
   // yeah, that's graceful :(
   echo "Database error!";
   exit;
   }

unset($params['skeleton_id']);
// set a message and return to the page.
$this->Redirect($id, 'default', $returnid, $params);
?>