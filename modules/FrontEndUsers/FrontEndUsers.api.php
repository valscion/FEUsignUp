<?php // -*- mode:php; c-file-style:linux; tab-width:2; indent-tabs-mode:t; c-basic-offset: 2; -*-
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: FrontEndUsers (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow management of frontend
#  users, and their login process within a CMS Made Simple powered 
#  website.
# 
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin 
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE

require_once(dirname(__FILE__)."/UserManipulator.class.php" );

class FrontEndUsersManipulator extends UserManipulator
{
  private $_cached_propdefns;
  private $_cached_uid_map;
	private $_encryption_key;

	private function get_salt()
  {
		$mod = $this->GetModule();
		return $mod->GetPreference('pwsalt','');
  }

	function SetEncryptionKey($uid = -1,$force = FALSE )
	{
		global $CMS_ADMIN_PAGE;
		global $gCms;

		if( $CMS_ADMIN_PAGE )
			{
				// hack
				$module = $this->GetModule();
				if( !$module->_HasSufficientPermissions('editusers') )
					{
						return FALSE;
					}

				// an administrator can see encrypted data.
				$res = $this->GetUserInfo($uid);
				if( !is_array($res) || $res[0] == FALSE )
					{
						return FALSE;
					}

				$key = md5($gCms->config['root_url'].$uid.$res[1]['createdate'].$this->get_salt());
				$this->_encryption_key = $key;

				return TRUE;
			}
		else
			{
				$tuid = $this->LoggedInId();
				if( ($tuid != $uid || $tuid <= 0) && $force === FALSE )
					{
						return FALSE;
					}

				$res = $this->GetUserInfo($uid);
				if( !is_array($res) || $res[0] == FALSE )
					{
						return FALSE;
					}

				$key = md5($gCms->config['root_url'].$uid.$res[1]['createdate'].$this->get_salt());
				$this->_encryption_key = $key;
				return TRUE;
			}

		return FALSE;
	}


  function CountTempCodeRecords()
  {
    $db = $this->GetDB();
    $q = "SELECT COUNT(*) AS count FROM ".cms_db_prefix()."module_feusers_tempcode";
    $dbresult = $db->Execute( $q );
    if( !$dbresult )
      {
				return 0;
      }
    $row = $dbresult->FetchRow();
    return $row['count'];
  }

  function ExpireTempCodes($expirycode)
  {
    $db = $this->GetDb();
    $expires = strtotime( $expirycode );
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_tempcode
          WHERE created > ?";
    $dbresult = $db->Execute( $q, array( $expires ) );
    if( !$dbresult ) return false;
    return true;    
  }

  function RemoveUserTempCode( $uid )
  {
		if( !$uid ) return false;
    $db = $this->GetDb();
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_tempcode
          WHERE userid = ?";
    $dbresult = $db->Execute( $q, array( $uid ) );
    if( !$dbresult ) return false;
    return true;
  }


  function GetUserTempCode( $uid )
  {
		if( !$uid ) return false;
    $db = $this->GetDb();
    $q = "SELECT * FROM ".cms_db_prefix()."module_feusers_tempcode
          WHERE userid = ?";
    $dbresult = $db->Execute( $q, array( $uid ));
    if( $dbresult == FALSE || $dbresult->RecordCount() == 0 )
      {
				return array(FALSE,$db->ErrorMsg());
      }
    $row = $dbresult->FetchRow();
    return array(TRUE,$row);
  }


  function SetUserTempCode( $uid, $code, $replace=false )
  {
		if( !$uid ) return false;
   $db = $this->GetDb();
   $q = "INSERT INTO ".cms_db_prefix()."module_feusers_tempcode
          VALUES(?,?,?)";
   $dbresult = $db->Execute( $q, array( $uid, $code,
					 trim($db->DBTimeStamp(time()),"'") ) );

	 if( $dbresult == false )
    	{
		if ($replace)
			{
    		$q = "update ".cms_db_prefix()."module_feusers_tempcode
          set code=?, created=? WHERE userid=?";
    		$dbresult = $db->Execute( $q, array($code,
					 trim($db->DBTimeStamp(time()),"'"),$uid ) );
			if ($dbresult == false)
				{
				return false;
				}
			}
	 	else
	   	{
			return false;
      	}
     }
    return true;
  }


  function SetPropertyDefn( $name, $newname, $prompt, $length, $type, $maxlength = 0, $attribs = '', $force_unique = 0, $encrypt = 0 )
  {
    $db = $this->getDb();
    
    if( $maxlength == 0 )
      {
	$maxlength = $length;
      }
    $q = "UPDATE ".cms_db_prefix()."module_feusers_propdefn
          SET name = ?, prompt = ?, type = ?, length = ?, maxlength = ?, attribs = ?, force_unique = ?, encrypt = ?
          WHERE name = ?";
    $dbresult = $db->Execute( $q, array( $newname, $prompt, $type, $length, $maxlength, $attribs, $force_unique, $encrypt, $name ));
    if( !$dbresult )
      {
				return false;
      }
    return true;
  }


  function DeletePropertyDefn( $name )
  {
    $db = $this->GetDb();

    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_propdefn
          WHERE name=?";
    $dbresult = $db->Execute( $q, array( $name ) );
    if( !$dbresult )
      {
	return false;
      }
    return true;
  }


  function GetPropertyGroupRelations( $title )
  {
    $db = $this->GetDb();

    $q = "SELECT * FROM ".cms_db_prefix()."module_feusers_grouppropmap
          WHERE name = ? ORDER BY sort_key DESC";
    $dbresult = $db->Execute( $q, array( $title ) );
    if( !$dbresult )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    $result = array();
    while( $row = $dbresult->FetchRow() )
      {
	array_push( $result, $row );
      }
    return $result;
  }


	/**
	 * Return the unix timestamp of the users expiry date
	 * or false;
   */
	function GetExpiryDate($uid)
	{
		if( !$uid ) return false;
		global $gCms;
    $db = $gCms->GetDb();

		$query = 'SELECT expires FROM '.cms_db_prefix().'module_feusers_users
               WHERE id = ?';
		$expiry = $db->GetOne($query,array($uid));
		if( $expiry )
			{
				$expiry = $db->UnixTimeStamp($expiry);
			}
		return $expiry;
	}


  function IsAccountExpired( $uid )
  {
		if( !$uid ) return true; // dunno about this
		$expiry = $this->GetExpiryDate( $uid );
		
		if( !$expiry ) return true;
		if( $expiry < time() ) return true;
		return false;
  }


  function GetGroupPropertyRelations( $grpid )
  {
    $db = $this->GetDb();

    $q = "SELECT * FROM ".cms_db_prefix()."module_feusers_grouppropmap
          WHERE group_id = ? ORDER BY sort_key DESC";
    $dbresult = $db->Execute( $q, array( $grpid ));
    if( !$dbresult )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    $result = array();
    while( $row = $dbresult->FetchRow() )
      {
	$result[] = $row;
      }
    return $result;
  }


  function AddGroupPropertyRelation( $grpid, $propname, $sortkey, $lostun, $val )
  {
    $db = $this->GetDb();

    $q = "INSERT INTO ".cms_db_prefix()."module_feusers_grouppropmap
          VALUES(?,?,?,?,?)"; 
    $dbresult = $db->Execute( $q, array( $propname, $grpid, $sortkey, $val, $lostun ));
    if( !$dbresult )
      {
				return array(FALSE,$db->ErrorMsg());
      }
    return array(TRUE);
  }


  function DeleteAllGroupPropertyRelations( $grpid )
  {
    $db = $this->GetDb();
    
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_grouppropmap
          WHERE group_id = ?";
    $dbresult = $db->Execute( $q, array( $grpid ));
    if( !$dbresult )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    return array(TRUE);
  }


  function DeleteGroupPropertyRelation( $grpid, $propname )
  {
    $db = $this->GetDb();

    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_grouppropmap
          WHERE name = ? AND group_id = ?";
    $dbresult = $db->Execute( $q, array( $propname, $grpid ));
    if( !$dbresult )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    return array(TRUE);
  }


  function AddPropertyDefn( $name, $prompt, $type, $length, $maxlength = 0, $attribs = '', $force_unique = 0, $encrypt = 0 )
  {
    $db = $this->GetDb();

    if( $maxlength == 0 )
      {
				$maxlength == $length;
      }

    $p = array( $name, $prompt, $type, $length, $maxlength, $attribs, $force_unique, $encrypt );
    $q = "INSERT INTO ".cms_db_prefix()."module_feusers_propdefn
            (name,prompt,type,length,maxlength,attribs,force_unique,encrypt)
          VALUES (?,?,?,?,?,?,?,?)";
    $dbresult = $db->Execute( $q, $p );
    if( $dbresult == false )
      {
				return array(FALSE, $db->sql.'<br/>'.$db->ErrorMsg());
      }
		$new_id = $db->Insert_ID();

		$this->_cached_propdefn = null;
    return array(TRUE);
  }


  function AddSelectOptions( $name, $options )
  {
    $db = $this->GetDb();
    $insert_vals = '';
    $order_id = 0;
    foreach ($options as $opttext){
      // if no actual text in the line, make sure it equals '',
      // in order not to add it to the db
      $opttext = trim($opttext);
      if(trim($opttext) == '' || trim($opttext) == '__' ){
				continue;
      }

			$optname = $opttext;
      if( strchr( $opttext, '=' ) !== FALSE )
				{
					$tmp = explode('=',$opttext);
					$optname = $tmp[1];
					$opttext = $tmp[0];
				}
			
      $order_id++;
      $insert_vals .= "('"
				. $order_id . "', '"
				. $optname . "', '"
				. $opttext . "', '"
				. $name. "'), ";
    }
    
    $insert_vals = substr($insert_vals, 0, -2);

    $db = $this->getDb();
    $query = "INSERT INTO ".cms_db_prefix()."module_feusers_dropdowns
			(order_id, option_name, option_text, control_name) 
			VALUES " . $insert_vals;
    $dbresult = $db->Execute($query);
    if( $dbresult == false ) {
      return array(FALSE, $db->ErrorMsg());
    }
    return array(TRUE);
  }
		

  
  
  function DeletePropertyDefns()
  {
    $db = $this->GetDb();
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_propdefn";
    $dbresult = $db->Execute( $q );
    if( $dbresult == false )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    return array(TRUE);
  }


  function DeleteSelectOptions( $name )
  {
    $db = $this->GetDb();
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_dropdowns
          WHERE control_name = ?";
    $dbresult = $db->Execute( $q, array( $name ) );
    if( $dbresult == false )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    return array(TRUE);
  }


	function GenerateRandomUsername( $prefix = 'user' )
	{
		srand(time());
    $db = $this->GetDb();
		$mod = $this->GetModule();

		$num = rand(100,99999);
		$count = 0;
		$suffix = '';
		if ($mod->GetPreference("username_is_email"))
			{
				$suffix = '@sample.com';
			}
		while( $count < 100 ) { // todo, 100 should be configurable?
			$q = "SELECT id FROM ".cms_db_prefix()."module_feusers_users
             WHERE username = ?";
			$row = $db->GetRow( $q, array( $prefix.$num.$suffix ) );
			if( !$row ) 
				{
					return $prefix.$num.$suffix;
				}
			$num = rand(100,99999);
			++$count;
		}
		return false;
	}


	function ClearPropertyCache()
	{
		unset($this->_cached_propdefns);
	}

	function _cache_propertydefns()
	{
		if( !is_array($this->_cached_propdefns) )
			{
				$db = $this->GetDb();

				$query = 'SELECT * FROM '.cms_db_prefix().'module_feusers_propdefn';
				$data = $db->GetArray($query);
				if( !$data ) return;

				$this->_cached_propdefns = array();
				for( $i = 0; $i < count($data); $i++ )
					{
						$this->_cached_propdefns[$data[$i]['name']] = $data[$i];
					}
			}
	}

  function GetPropertyDefn( $name )
  {
		$this->_cache_propertydefns();
		if( !is_array($this->_cached_propdefns) ) return FALSE;
		if( !isset($this->_cached_propdefns[$name])) return FALSE;
		return $this->_cached_propdefns[$name];
  }


  function GetPropertyDefns()
  {
		$this->_cache_propertydefns();
		if( !is_array($this->_cached_propdefns) ) return FALSE;
		return $this->_cached_propdefns;
  }

  /**
   * Returns select options as a simple or a 2 dimensional array
   *
   * @param String $controlname - name of the dropdown as in the propdefn table
   * @param int $dim - dimension of the array
   * 	if $dim == 1, returns a 1 dimensional array text=>name
   *    if $dim == 2, returns a 2 dimensional array, each item being an
   * 		array with properties 'option_name', 'option_text', 'control_name'.
   */
  function GetSelectOptions( $controlname, $dim=1 )
  {
	$db = $this->GetDb();
	
	$q = "SELECT * FROM ".cms_db_prefix()."module_feusers_dropdowns
		WHERE control_name = ? ORDER BY order_id";
	$dbresult = $db->Execute( $q, array($controlname) );
	if( $dbresult == false ) {
		return false;
	}
	$ret = array();
	while( $row = $dbresult->FetchRow() ) {
		if ($dim==2){
		  $ret[] = $row;
		} else {
		  $ret[$row['option_text']] = $row['option_name'];
		}
	}
	return $ret;
  }

  
  function Login( $username, $password, $groups = '', $md5pw = false, 
									$force_logout = false)
  {
    $error = '';
    $uid = -1;
		global $gCms;
    $db = $this->GetDb();
    $mod = $this->GetModule();
		$config = $gCms->GetConfig();

    if( !$this->CheckPassword( $username, $password, $groups, $md5pw ) )
      {
				$uid = $this->GetUserID( $username );
				if( !$uid ) $uid = -1;
				$error = $mod->Lang('error_loginfailed');
      }
    else
      {
				$uid = $this->GetUserID( $username );
				if( $force_logout )
					{
						$this->Logout($uid);
					}
	
				if( $this->IsAccountExpired( $uid ) )
					{
						$error = $mod->Lang('error_accountexpired');
					}
				else if( $mod->GetPreference('allow_repeated_logins') == 0 )
					{
						// make sure this user isn't already logged in
						$q = "SELECT * FROM ".cms_db_prefix()."module_feusers_loggedin WHERE 
              USERID = ?";
						$dbresult = $db->Execute( $q, array( $uid ) );
						if( $dbresult && $dbresult->RecordCount() )
							{
								$error = $mod->Lang('error_norepeatedlogins');
							}
					}

      }

    $ip = cge_utils::get_real_ip();
    if( !$error )
      {
				$q = "INSERT INTO ".cms_db_prefix()."module_feusers_loggedin (sessionid,lastused,userid)
               VALUES (?,?,?)";
				
				/* we may need to start a session now */
				if( session_id() == "" )
					{
						@session_start();
					}
				
				// log the user in
				$dbresult = $db->Execute( $q, array( session_id(), time(), $uid ));
				if( !$dbresult ) 
					{
						return array(FALSE, $db->ErrorMsg());
					}
				
				// set the cookie
				$module = $this->GetModule();
				if( $module->GetPreference('cookie_keepalive',0) ) {
					$expirytime = $module->GetPreference('user_session_expires');
					@setcookie('feu_sessionid',session_id(),time()+$expirytime,"/");
					@setcookie('feu_uid',$uid,time()+$expirytime,"/");
				}

				// and add history info
				$q = "INSERT INTO ".cms_db_prefix()."module_feusers_history VALUES (?,?,?,?,?)";
				$db->Execute( $q, array( $uid, session_id(), 'login',
																 trim($db->DBTimeStamp(time()),"'"),
																 $ip ));
				
				return array($uid);
      }
    
    // log an invalid login
    $q = "INSERT INTO ".cms_db_prefix()."module_feusers_history VALUES (?,?,?,?,?)";
    $dbresult = $db->Execute( $q, array( $uid, session_id(), 'fail',
			     trim($db->DBTimeStamp(time()),"'"),
			     $ip ));
    if( !$dbresult ) $error = $db->ErrorMsg();

    return array(FALSE,$error);
  }


  function FeusersManipulator( $the_module )
  {
    parent::UserManipulator( $the_module );
  }


  // userid api function
  // returns true/false
  function AssignUserToGroup( $uid, $gid )
  {
		if( !$uid ) return false;
    // validate the user id
    if( !$this->UserExistsByID( $uid ) )
      {
				return false;
      }
    
    // validate the group id
    if( !$this->GroupExistsByID( $gid ) )
      {
				return false;
      }
    
    $db = $this->GetDb();
		// make sure it already doesn't exist
		$q = 'SELECT * FROM '.cms_db_prefix().'module_feusers_belongs
            WHERE userid = ? AND groupid = ?';
		$tmp = $db->GetRow($q,array($uid,$gid));
		if( $tmp ) return true;

    // add the record to the table to make this 
    // user a member of this group
    $q = "INSERT INTO ".cms_db_prefix()."module_feusers_belongs 
            (userid, groupid) VALUES (?,?)";
    $dbresult = $db->Execute( $q, array( $uid, $gid ) );
    return( $dbresult != false );
  }

  
  // userid api function
  // returns true/false
  function IsValidPassword( $password )
  {
    // a password is valid, if it's length is
    // within certain ranges
    $module = $this->GetModule();
    $minlen = $module->GetPreference('min_passwordlength', 6 );
    $maxlen = $module->GetPreference('max_passwordlength', 20 );
    $len = strlen($password);
    if( $len < $minlen )
      {
	return false;
      }
    else if( $len > $maxlen )
      {
	return false;
      }
    
    /*
    // there must be atleast 3 unique characters
    if( strlen(count_chars( $username, 3 )) < min(3,minlen))
      {
	return false;
      }
    */
    return true;
  }


  // userid api function
  // returns an array
  function DeleteUserFull( $id )
  {
    // log the user out
    $this->LogoutUser( $id );

    // delete user properties
    $this->DeleteAllUserPropertiesFull( $id );

    // delete user from groups
    $ret = $this->RemoveUserFromGroup( $id, '' );
    if( $ret[0] == false )
      {
				return $ret;
      }

    // delete user record
    $db = $this->GetDb();
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_users
          WHERE id = ?";
    $dbresult = $db->Execute( $q, array( $id ) );
    if( !$dbresult )
      {
				return array( FALSE, $db->ErrorMsg() );
      }

    // and delete anything from the tempcodes table too
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_tempcode
          WHERE userid = ?";
    $dbresult = $db->Execute( $q, array( $id ) );
    if( !$dbresult )
      {
				return array( FALSE, $db->ErrorMsg() );
      }
    
    return array( TRUE, "" );
  }


  // userid api function
  // returns an array
  function GetGroupInfo( $gid )
  {
    $db = $this->GetDb();
    $q = "SELECT * FROM ".cms_db_prefix()."module_feusers_groups WHERE id = ?";
    $dbresult = $db->Execute( $q, array( $gid ) );
    if( !$dbresult )
      {
				return array(FALSE,$db->ErrorMsg());
      }
    $row = $dbresult->FetchRow();
		$dbresult->Close();
    return $row;
  }
  
  
  private function _getUser($uid)
	{
		if( !$uid ) return FALSE;
		if( is_array($this->_cached_uid_map) && 
				isset($this->_cached_uid_map[$uid]) )
			{
				return $this->_cached_uid_map[$uid];
			}

    $db = $this->GetDb();
    $q = "SELECT * FROM ".cms_db_prefix()."module_feusers_users
                WHERE id = ?";
		$row = $db->GetRow($q,array($uid));
		if( !$row ) return FALSE;

		$this->_cached_uid_map[$uid] = $row;
		return $row;
	}

  // userid api function
  // returns an array
  // second element of array may be an array
  function GetUserInfo( $uid )
  {
		if( !$uid ) return array(FALSE); // todo, add a message
		$row = $this->_getUser($uid);
		if( !$row ) return array(FALSE);
    return array( TRUE, $row );
  }
  

	// userid api function
	// returns an array
	// second element of array may be an array
	function GetUserInfoByName( $username )
	{
		if( !$username ) return array(FALSE); // todo, add a message
		
		$module = $this->GetModule();
		$db = $this->GetDb();
		$query = 'SELECT id FROM '.cms_db_prefix().'module_feusers_users 
               WHERE username = ?';
		$uid = $db->GetOne($query,array($username));
		if( !$uid ) return array(FALSE,$module->Lang('error_usernotfound'));
		
		return $this->GetUserInfo($uid);
	}


	function GetUserInfoByProperty($propname,$propvalue)
	{
		$module = $this->GetModule();
		$defns = $this->GetPropertyDefns();
    if( !is_array($defns) ) return array(FALSE,$module->Lang('error_dberror'));

		$db = $this->GetDb();
		$query = 'SELECT userid FROM '.cms_db_prefix().'module_feusers_properties up
               WHERE up.title = ? AND data = ?';
		$uid = $db->GetOne($query,array($propname,$propval));
		if( !$uid ) return array(FALSE,$module->Lang('error_usernotfound'));

		return $this->GetUserInfo( $uid );
	}


	function GetUserHistory($uid,$action='',$count=-1)
	{
		$db = $this->GetDb();
		$parms = array($uid);
		$query = 'SELECT * FROM '.cms_db_prefix().'module_feusers_history
               WHERE userid = ?';
		if( !empty($action) )
			{
				$query .= ' AND action = ?';
				$parms[] = $action;
			}

		$results = '';
		if( $count <= 0 )
			{
				$results = $db->GetArray($query,$parms);
			}
		else
			{
				$dbr = $db->SelectLimit($query,(int)$count);
				while( $dbr && ($row = $dbr->FetchRow()) )
					{
						$results[] = $row;
					}

				if( count($results) == 1 )
					{
						$tmp = $results[0];
						$results = $tmp;
					}
			}
		return $results;
	}


	public function GetLoggedInUsers($not_active_since = '')
	{
		$db = $this->GetDb();
		
		$q = 'SELECT userid FROM '.cms_db_prefix().'module_feusers_loggedin';
		$qparms = array();
		if( $not_active_since )
			{
				$q .= " WHERE lastused < ?";
				$qparms[] = $not_active_since;
			}
		
		$res = $db->GetCol($q,$qparms);
		return $res;
	}


  // userid api function
  // returns an array or false
  function CountUsersInGroup( $groupid )
  {
    $db = $this->GetDb();
    
    $q = '';
    $parms = array();
    if( $groupid == '' || $groupid < 0 )
      {
	$q = "SELECT count(id) as num FROM ".cms_db_prefix()."module_feusers_users"; 
      }
    else
      {
	$q = "SELECT count(id) as num FROM ".cms_db_prefix()."module_feusers_users,".
	  cms_db_prefix()."module_feusers_belongs WHERE id=userid AND groupid = ?";
	$parms[] = $groupid;
      }

    $dbresult = $db->Execute( $q, $parms );
    if( !$dbresult )
      {
	return false;
      }

    $row = $dbresult->FetchRow();
    return $row['num'];
  }


	function GetFullUsersInGroup($gid)
	{
		$db = $this->GetDb();

		$q = 'SELECT U.* FROM '.cms_db_prefix().'module_feusers_users U
            LEFT JOIN '.cms_db_prefix().'module_feusers_belongs B
              ON U.id = B.userid
           WHERE B.groupid = ?';
		$data = $db->GetArray($q,array($gid));
		if( !$data ) return false;

		$uids = cge_array::extract_field($data,'id');
		if( !count($uids) ) return false;

		$q = 'SELECT * FROM '.cms_db_prefix().'module_feusers_properties
           WHERE userid IN ('.implode(',',$uids).') ORDER BY userid,title';
		$propdata = $db->GetArray($q);

		for( $u = 0; $u < count($data); $u++ )
			{
				$tmp = array();
				for($idx = 0; $idx < count($propdata); $idx++ )
					{
						if( $propdata[$idx]['userid'] != $data[$u]['id'] ) continue; 
						$tmp[$propdata[$idx]['title']] = $propdata[$idx]['data'];
					}
				if( count($tmp) )
					{
						$data[$u]['props'] = $tmp;
					}
			}

		return $data;
	}


  function GetUsersInGroup( $groupid = '', $userregex = '', 
														$limit = '', $sort = '',
														$property = '', $propregex = '',
														$loggedinonly = 0, $start_record = 0)
  {
    $db = $this->GetDb();
		$thelimit = 100000;

    $parms = array();
    $where = array();
		$group = array();
    $ordersort = "";
    $q = "SELECT A.*,count(D.userid) as loggedin FROM ".cms_db_prefix()."module_feusers_users A"; 
		$qc = 'SELECT COUNT(a.id)';
		$group[] = " A.id";
		if( $loggedinonly )
			{
				$q .= ",".cms_db_prefix()."module_feusers_loggedin D";
				$qc .= ",".cms_db_prefix()."module_feusers_loggedin D";
				$where[] = " A.id = D.userid";
			}
		else
			{
				$q .= " LEFT OUTER JOIN ".cms_db_prefix()."module_feusers_loggedin D
                  ON A.id = D.userid";
				$qc .= " LEFT OUTER JOIN ".cms_db_prefix()."module_feusers_loggedin D
                  ON A.id = D.userid";
			}

    if( $property != '' && $propregex != '' )
      {
				$q .= " LEFT JOIN ".cms_db_prefix()."module_feusers_properties B ON A.id = B.userid";
				$qc .= " LEFT JOIN ".cms_db_prefix()."module_feusers_properties B ON A.id = B.userid";
      }

    if( $groupid != '' && $groupid >= 0 )
      {
				$q .= " LEFT JOIN ".cms_db_prefix()."module_feusers_belongs C ON A.id = C.userid";
				$qc .= " LEFT JOIN ".cms_db_prefix()."module_feusers_belongs C ON A.id = C.userid";
				$where[] = " A.id = C.userid";
				$where[] = " groupid = ?";
				$parms[] = $groupid;
      }

	if (is_array($property) && is_array($propregex) && count($property) == count($propregex))
	{
		$ary = array();
		for ($z = 0; $z < count($property); $z++)
		{
			if( $property[$z] != '' && $propregex[$z] != '' )
			{
				$ary[] = "(B.title = ? and B.data REGEXP ?)";
				$parms[] = $property[$z];
				$parms[] = $propregex[$z];
			}
		}
		$where[] = "(" . implode(" OR ", $ary) . ")";
	}
	else
	{
		if( $property != '' && $propregex != '' )
		{
			$where[] = " B.title = ? and B.data REGEXP ?";
			$parms[] = $property;
			$parms[] = $propregex;
		}
	}
	if( $userregex != '' )
		{
			$where[] = " username REGEXP ?";
			$parms[] = $userregex;
		}
	if( $sort != '' )
		{
			$ordersort .= " ORDER BY $sort";
		}
	if( $limit != '' && $limit != '0' )
		{
			$thelimit = (int)$limit;
		}

	// put the query together
	if( count($where ) )
		{
			$q .= " WHERE " . implode(" AND ",$where);
			$qc .= " WHERE " . implode(" AND ",$where);
		}
	if( count($group) )
		{
			$q .= " GROUP BY ". implode(" , ",$group);
			$qc .= " GROUP BY ". implode(" , ",$group);
		}
	$q .= $ordersort;
	$dbresult = $db->SelectLimit( $q, $thelimit, $start_record, $parms );
	if( !$dbresult )
		{
			return false;
		}
	
	$result = $dbresult->GetArray();
	return $result;
  }


  // userid api function
  // returns true/false
  function GroupExistsByID( $gid )
  {
    $data = $this->GetGroupInfo( $gid );
    return( $data != false );
  }


  // userid api function
  // returns true/false
  function GroupExistsByName( $name )
  {
    $gid = $this->GetGroupID( $name );
    return( $gid != false );
  }


  function LoggedInEmail()
  {
      $userid=$this->LoggedInId();
      return $this->GetEmail($userid);
  }
  

  function GetEmail($uid)
   {
		 $module = $this->GetModule();
		 $db = $this->GetDb();
		 $result = false;
		 
		 if ($module->GetPreference('username_is_email'))
			 {
				 $q = 'SELECT username FROM '.cms_db_prefix().
					 'module_feusers_users WHERE id = ?';
				 $result = $db->GetOne( $q, array( $uid ) );
			 }
		 else
			 {
				 $q = 'SELECT data FROM '.cms_db_prefix().'module_feusers_propdefn,'.
					 cms_db_prefix().'module_feusers_properties WHERE name=title AND
          type=2 AND userid = ?';
				 $result = $db->GetOne( $q, array( $uid ) );
			 }
		 return $result;
   }
  

	// todo: move this to main module.
  function IsValidEmailAddress( $email, $uid = -1, $check_existing = true )
  {
    $module = $this->GetModule();
    $result = array();
		if( !is_email($email) )
			//if( !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email ) )
      {
       	$result[0] = false;
      	$result[1] = $module->Lang('error_improperemailformat');
      	return $result;
      }

		$db = $this->GetDb();

		if( $check_existing )
			{
				if ($module->GetPreference('username_is_email'))
					{
						$q = 'SELECT username FROM '.cms_db_prefix().
				    	'module_feusers_users WHERE username = ?';
						$parm = array($email);
						if ($uid > -1)
							{
								$q .= ' AND id != ?';
								$parm[] = $uid;
							}
						$dbresult = $db->Execute( $q, $parm );
						if( $dbresult && $dbresult->RecordCount() )
							{
								$result[0] = false;
								$result[1] = $module->Lang('error_emailalreadyused');
								return $result;
							}
					}
				else if( !$module->GetPreference('allow_duplicate_emails') )
					{
						$q = "SELECT data FROM ".cms_db_prefix()."module_feusers_propdefn,".
							cms_db_prefix()."module_feusers_properties WHERE name=title AND
          type=2 AND data LIKE ?";
						$parms = array( $email );
						if( $uid > -1 )
							{
								$q .= ' AND userid != ?';
								$parms[] = $uid;
							}
						$dbresult = $db->Execute( $q, array( $email ) );
						if( $dbresult && $dbresult->RecordCount() )
							{
								$result[0] = false;
								$result[1] = $module->Lang('error_emailalreadyused');
								return $result;
							}
					}
			}

    $result[0] = true;
    return $result;
  }


	// todo: move this to the main module.
  function IsValidUsername( $username, $check_email = true )
  {
    // a username is valid, if it's length is
    // within certain ranges, and it contains
    // only alphanumerics
    $module = $this->GetModule();
    $minlen = $module->GetPreference('min_usernamelength', 4 );
    $maxlen = $module->GetPreference('max_usernamelength', 20 );
    if( strlen( $username ) < $minlen || strlen( $username ) > $maxlen )
      {
       	return false;
      }
    if ($module->GetPreference('username_is_email'))
      {
        $test = $this->IsValidEmailAddress($username,-1,$check_email);
        if ($test[0] === false)
          {
            return false;
          }
      }
    else if( !preg_match( '/^[a-zA-Z0-9_-\s\.]*$/', $username ) )
      {
  	    return false;
      }
    return true;
  }

  
  // userid api function
  // returns an array
  function RemoveUserFromGroup( $uid, $gid )
  {
		if( !$uid ) return array( FALSE ); // todo, return error message
    $db = $this->GetDb();
    $parms = array( $uid );
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_belongs
          WHERE userid = ?";
    if( $gid != '' )
      {
	$q .= " AND groupid = ?";
	array_push( $parms, $gid );
      }
    $dbresult = $db->Execute( $q, $parms );
    if( $dbresult == false )
      {
	return array( FALSE, $db->ErrorMsg() );
      }
    else
      {
	return array( TRUE );
      }
  }


  // userid api function
  // returns array
  function SetGroup( $id, $name, $desc )
  {
    if( !isset( $name ) || $name == '' )
      {
	$this->_DisplayErrorPage ($id, $params, $return_id,
				  $this->Lang ('error_insufficientparams'));
	return;
      }
    
    $db = $this->GetDb();

    $eid = $this->GetGroupID( $name );
    if( $eid != false && $eid != $id )
      {
	$mod = $this->GetModule();
	return array(FALSE,$mod->Lang('error_groupname_exists'));
      }
    
    $q = "UPDATE ".cms_db_prefix()."module_feusers_groups SET
                groupname = ?, groupdesc = ? WHERE id = ?";
    $dbresult = $db->Execute( $q, array( $name, $desc, $id ) );
    if( !$dbresult )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    return array( TRUE, '');
  }


  function SetUserPassword( $uid, $password )
  {
		$mod = $this->GetModule();
		if( !$uid ) return array(FALSE,$mod->Lang('error_invalidparams'));
    $db = $this->GetDb();
    $q = "UPDATE ".cms_db_prefix()."module_feusers_users
          SET password = ? WHERE id = ?";
    $dbresult = $db->Execute( $q, array( md5($password.$this->get_salt()), $uid ));
    if( !$dbresult )
      {
				return array(FALSE,$db->ErrorMsg());
      }
    return array(TRUE,"");
  }


  // userid api function
  // returns array
  function SetUser( $uid, $username, $password, $expires = false, $do_md5 = true )
  {
		if( !$uid ) return array(FALSE,"");
    $db = $this->GetDb();
		$module = $this->GetModule();
    
    // make sure that this user exists
    $ret = $this->GetUserInfo( $uid );
    if( $ret[0] == FALSE )
    {
			return array(FALSE, $module->Lang('error_usernotfound'));	
    }

    // make sure that this username is not taken by some other id
    $nuid = $this->GetUserID($username);
    if( $nuid != false && $nuid != $uid )
      {
				return array(FALSE, $module->Lang('error_usernametaken',$uid));
      }

    $dbresult = '';
    $parms = array();
    $q = "UPDATE ".cms_db_prefix()."module_feusers_users SET
         username = ?";
	
    $parms[] = $username;
    if( trim( $password ) != '' )
      {
				$q .= ", password = ?";
				if( $do_md5 )
					{
						$parms[] = md5($password.$this->get_salt());
					}
				else
					{
						$parms[] = $password;
					}
      }
    if( $expires != false )
      {
	$q .= ", expires = ?";
	$parms[] = trim($db->DBTimeStamp($expires),"'");
      }
    $q .= " WHERE id = ?";
    $parms[] = $uid;
    $dbresult = $db->Execute( $q, $parms );

    if( $dbresult == false )
      {
				return array( FALSE, $db->ErrorMsg() );
      }

		if( isset($this->_cached_uid_map[$uid]) )
			{
				unset($this->_cached_uid_map[$uid]);
			}

    // Changed to pass $uid back so it matches AddUser()
    return array( TRUE, $uid );
  }

  
  // userid api function
  // returns true/false
  function SetUserGroups( $uid, $grpids )
  {
		if( !$uid ) return array(FALSE,"");
    $db = $this->GetDb();

    // first make sure this user exists
    $ret = $this->GetUserInfo( $uid );
    if( $ret[0] == FALSE )
      {
	return array(FALSE, "User does not exist");
      }

    // then remove all his current assignments
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_belongs 
          WHERE userid = ?";
    $dbresult = $db->Execute( $q, array( $uid ));
    if( !$dbresult )
      {
	return array( FALSE, $db->ErrorMsg()  );
      }

    // and add all of them in
    $q = "INSERT INTO ".cms_db_prefix()."module_feusers_belongs
          VALUES (?,?)";
    foreach( $grpids as $grpid )
    {
      $dbresult = $db->Execute( $q, array( $uid, $grpid ) );
      if( !$dbresult )
	{
	  return array( FALSE, $db->ErrorMsg()  );
	}
    }
    return array( TRUE, "" );
  }


  // userid api function
  // returns true/false
  function SetUserProperties( $uid, $props )
  {
		if( !$uid ) return false;
    // Delete all the user properties
    // and set new ones
    $this->DeleteUserPropertyFull( "", $uid, true );

    foreach( $props as $prop )
    {
      list( $key, $val ) = split("=",$prop);
      if ( $this->SetUserPropertyFull( $key, $val, $uid ) == false)
      {
        return false;
      }
    }
		
    return true;
  }


  // userid api function
  // returns true/false
  function UserExistsByID( $uid )
  {
    if( !$uid ) return false;
    $data = $this->GetUserInfo( $uid );
    return( $data[0] !== FALSE );
  }


  // userid api function
  // returns an array or false
  function GetUserProperties($uid)
  {
		if( !$uid ) return false;
		$defns = $this->GetPropertyDefns();
    $db = $this->GetDb();
    $q="SELECT * FROM ".cms_db_prefix()."module_feusers_properties WHERE userid=?";
    $p=array($uid);
    $arr = array();
    $dbresult=$db->Execute($q,$p);
    if( $dbresult == false )
      {
				return false;
      }
    while( $row = $dbresult->FetchRow() )
      {
				if( !isset($defns[$row['title']]) ) continue; // uh-oh

				if( $defns[$row['title']]['encrypt'] )
					{
						if( !$this->_encryption_key ) return false;
						$row['data'] = trim(cge_encrypt::decrypt($this->_encryption_key,base64_decode($row['data'])));
					}
				$arr[] = $row;
      }
    return $arr;
  }

  // userid api function
  // returns an array of records or false
  function GetMemberGroupsArray($userid) {
    $db = $this->GetDb();
    $q="SELECT * FROM ".cms_db_prefix()."module_feusers_belongs WHERE userid=?";
    $dbresult=$db->Execute($q,array($userid));
    if ($dbresult && $dbresult->RecordCount()) {
      $result=array();;
      while ($row=$dbresult->FetchRow()) {
	array_push( $result, $row );
      }
      return $result;
    } else {
      return false;
    }
  }

  //
  // end of rc functions
  //

  // userid api function
  function GetUserProperty($title,$defaultvalue=false) 
  {
    $userid=$this->LoggedInId();
    if ($userid===false) return false;
    return $this->GetUserPropertyFull($title,$userid,$defaultvalue);
  }
  

  // userid api function
  function GetUserPropertyFull($title,$userid, $defaultvalue=false) 
  {
    if ($userid===false) return false;
		$defn = $this->GetPropertyDefn($title);
		if( !$defn ) return FALSE;

    $db=$this->GetDB();
    $q="SELECT * FROM ".cms_db_prefix()."module_feusers_properties WHERE title=? AND userid=?";
		$p=array(str_replace(' ','_',$title),$userid);
    $result=$db->Execute($q,$p);
    if ($result && $result->RecordCount()) {
      $row=$result->FetchRow();
			if( $defn['encrypt'] )
				{
					if( !$this->_encryption_key ) return FALSE;
					$before = $row['data'];
					$row['data'] = trim(cge_encrypt::decrypt($this->_encryption_key,base64_decode($row['data'])));
				}
      return $row["data"];
    } else {
      return $defaultvalue;
    }
  }

	// userid api function
	function IsUserPropertyValueUnique($uid,$title,$data)
	{
		$db = $this->GetDb();
		$dbr = '';
		if( $uid > 0 )
			{
				$q = 'SELECT id FROM '.cms_db_prefix().'module_feusers_properties 
               WHERE title = ? AND userid != ? AND data = ?';
				$dbr = $db->GetOne($q,array($title,$uid,$data));
			}
		else
			{
				$q = 'SELECT id FROM '.cms_db_prefix().'module_feusers_properties 
               WHERE title = ? AND data = ?';
				$dbr = $db->GetOne($q,array($title,$data));
			}
		if( $dbr )
			{
				return FALSE;
			}
		return TRUE;
	}

	
  // userid api function
  function SetUserProperty($title,$data) 
  {
    $userid=$this->LoggedInId();
    if ($userid===false) return false;
    return $this->SetUserPropertyFull($title,$data,$userid);
  }


  // userid api function
  function SetUserPropertyFull($title,$data,$userid) 
  {
    if ($userid===false) return false;
		$defn = $this->GetPropertyDefn($title);
		if( !$defn ) return false;

		if( $defn['encrypt'] )
			{
				// gotta encrypt.
				if( !$this->_encryption_key ) return false;
				$before = $data;
				$data = base64_encode(cge_encrypt::encrypt($this->_encryption_key,$data));
			}

    $db=$this->GetDB();
    $q="SELECT * FROM ".cms_db_prefix()."module_feusers_properties WHERE title=? AND userid=?";
    $p=array($title,$userid);
    $r=$db->Execute($q,$p);
    if (!$r || ($r->NumRows()==0)) {
      $newid=$db->GenID(cms_db_prefix()."module_feusers_properties_seq");
      $q="INSERT INTO ".cms_db_prefix()."module_feusers_properties (id,userid,title,data) VALUES (?,?,?,?)";
      $p=array($newid,$userid,$title,$data);
      $r=$db->Execute($q,$p);
    } else {
      $row=$r->FetchRow();
      $q="UPDATE ".cms_db_prefix()."module_feusers_properties SET data=? WHERE id=?";
      $p=array($data,$row["id"]);
      $r=$db->Execute($q,$p);
    }
		if( $title == 'test' )
			{
				if( $data == '' ) 
					die("failed to update $title to $data");
			}
    return ($r!=false);
  }


  // delete all occurances of the userproperty by name
  function DeleteUserPropertyByName( $title )
  {
    $db = $this->GetDB();
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_properties WHERE title=?";
    $p = array( $title );
    $result = $db->Execute( $q, $p );
    return ($result!=false);
  }


  // userid api function
  function DeleteUserProperty($title,$all=false) 
  {
    $userid=$this->LoggedInId();
    if ($userid===false) return false;
    $db=$this->GetDB();
    $q="DELETE FROM ".cms_db_prefix()."module_feusers_properties WHERE userid=?";
    if (!$all) $q.=" AND title=?";
    $p=array();
    if ($all) $p=array($userid); else $p=array($userid,$title);
    $result=$db->Execute($q,$p);
    return ($result!=false);
  }
  

  // userid api function
  function DeleteUserPropertyFull($title,$userid,$all=false) 
  {
    $db=$this->GetDB();
    $q="DELETE FROM ".cms_db_prefix()."module_feusers_properties WHERE userid=?";
    if (!$all) $q.=" AND title=?";
    $p=array();
    if ($all) $p=array($userid); else $p=array($userid,$title);
    $result=$db->Execute($q,$p);
    return ($result!=false);
  }


  // userid api function
  function DeleteAllUserProperties() 
  {
    return $this->DeleteUserProperty("",true);
  }


  // userid api function
  function DeleteAllUserPropertiesFull($userid) 
  {
    return $this->DeleteUserPropertyFull("",$userid,true);
  }


  // userid api function
  function CheckPassword($username,$password,$groups = '',$md5pw = false) 
  {
    $db = $this->GetDb();
    $q="SELECT u.* FROM ".cms_db_prefix()."module_feusers_users u";
		if ($groups != '')
			{
				$q .= ' INNER JOIN '.cms_db_prefix().'module_feusers_belongs b ON u.id = b.userid INNER JOIN '.cms_db_prefix().'module_feusers_groups g ON g.id = b.groupid ';
			}
		$q .= ' WHERE u.username=? AND u.password=?';
		$p = '';
		if( $md5pw )
			{
				$p=array($username,$password);
			}
		else
			{
				$p=array($username,md5(trim($password).$this->get_salt()));
			}
		if ($groups != '')
			{			
				//split the string on the commas
				$groups = split(',\ ?', $groups);
				
				//make a bit for the query
				$q .= ' AND (' . implode(' OR ', array_fill(0, count($groups), 'g.groupname = ?')) . ')';
				foreach ($groups as $group)
					{
						$p[] = $group;
					}
			}
    $result=$db->Execute($q,$p);
    if ($result && $result->RecordCount()) return true;
    return false;
  }

  
  // userid api function
  function LoggedInName() 
  {
    $userid=$this->LoggedInId();
    if ($userid) return $this->GetUserName($userid); else return "";
  }


  // userid api function
  function Logout($uid = '',$message = 'logout') 
  {
		$gCms = cmsms();
		$config = $gCms->GetConfig();
    $db = $this->GetDb();
		$q = '';
		$p = '';
		if( $uid == '' )
			{
				$uid = $this->LoggedInId();
				if( !$uid ) return false;
				$q="DELETE FROM ".cms_db_prefix()."module_feusers_loggedin WHERE sessionid=?";
				$p=array(session_id());

				// delete the cookie
				@setcookie('feu_sessionid','',time()-60000,"/");
				@setcookie('feu_uid','',time()-60000,"/");
			}
		else
			{
				$q="DELETE FROM ".cms_db_prefix()."module_feusers_loggedin WHERE userid=?";
				$p=array($uid);
			}
		
    $result=$db->Execute($q,$p);

    // and add history info
    $ip = cge_utils::get_real_ip();
    $q = "INSERT INTO ".cms_db_prefix()."module_feusers_history VALUES (?,?,?,?,?)";
    $db->Execute( $q, array( $uid, session_id(), $message,
			     trim($db->DBTimeStamp(time()),"'"),$ip ));

		// send the event.
    $module = $this->GetModule();
		$module->SendEvent('OnLogout',array('id'=>$uid));
  }


  // userid api function
  function LogoutUser($uid,$eventmsg = 'logout') 
  {
		if( !$uid ) return;
    $db = $this->GetDb();
    $q="DELETE FROM ".cms_db_prefix()."module_feusers_loggedin WHERE userid=?";
    $p=array($uid);
    $result=$db->Execute($q,$p);

    $ip = cge_utils::get_real_ip();
    $q = "INSERT INTO ".cms_db_prefix()."module_feusers_history VALUES (?,?,?,?,?)";
    $db->Execute( $q, array( $uid, session_id(), $eventmsg ,
														 trim($db->DBTimeStamp(time()),"'"),$ip) );
  }


  // userid api function
  function ExpireUsers() 
  {
    $module = $this->GetModule();
		$expire_interval = $module->GetPreference('expireusers_interval');
		$expire_lastrun = $module->GetPreference('expireusers_lastrun');
		if( time() - $expire_lastrun >= $expire_interval )
			{
				$expirytime = $module->GetPreference('user_session_expires');
				$db = $this->GetDb();
				$q="SELECT * FROM ".cms_db_prefix()."module_feusers_loggedin WHERE lastused<?";
				$p=array(time()-$expirytime);
				$dbresult = $db->Execute( $q, $p );
				while( $dbresult && ($row = $dbresult->FetchRow()) )
					{
						$q2 = "INSERT INTO ".cms_db_prefix()."module_feusers_history
                 (userid,sessionid,action,refdate)
                 VALUES (?,?,?,?)";
						$db->Execute( $q2, array( $row['userid'], $row['sessionid'],'expire',
																			trim($db->DbTimeStamp(time()),"'")));
						$module->NotifyExpiredUser( $row['userid'] );
					}

				$q="DELETE FROM ".cms_db_prefix()."module_feusers_loggedin WHERE lastused<?";
				$result=$db->Execute($q,$p);

				$module->SetPreference('expire_lastrun',time());
			}
  }


  // userid api function
  function LoggedInId() 
  {
    // if the user is authenticated using the auth module
		$module = $this->GetModule();
    $auth_consumer = feu_utils::get_auth_consumer();
		if( $auth_consumer instanceof feu_std_consumer )
			{
				// its the built in stuff.
				return $this->_old_LoggedInId();
			}

    if( $auth_consumer->is_authenticated() )
      {
				// search for a userid based on a property
				$prop = $auth_consumer->get_connecting_property_name();
				$val  = $auth_consumer->get_unique_identifier();
				if( !$val ) return FALSE;
				
				$uinfo = '';
				$useprop = false;
				if( $prop == '' || $prop == feu_auth_consumer::PROPERTY_USERNAME )
					{
						// get user by name
						$uinfo = $this->GetUserInfoByName( $val );
					}
				else if( $prop == feu_auth_consumer::PROPERTY_UID )
					{
						// see if the uid exists.
						$uinfo = $this->GetUserInfo( $val );
					}
				else
					{
						// it's a property of some type.
						$uinfo = $this->GetUserInfoByProperty($prop,$val);
						$useprop = true;
					}

				if( !is_array($uinfo) || (is_array($uinfo) && $uinfo[0] == FALSE) )
					{
						// user not found, do we need to create one?
						if( $module->GetPreference('auto_create_unknown') )
							{
								// we're gonna create a new user.
								$username = $val;
								if( $module->GetPreference('use_randomusername') &&
										$prop != feu_auth_consumer::PROPERTY_USERNAME &&
										$prop != feu_auth_consumer::PROPERTY_UID &&
										$prop != '' )
									{
										$username = $module->GenerateRandomUsername();
									}

								$tmp = $module->GetPreference('expireage_months',6);
								$expires = strtotime(sprintf("+%d months",$tmp));
					
								$dflt_group = $module->GetPreference('default_group');
								$ret = $module->AddUser( $username,
																			 $module->GenerateRandomPrintableString(),
																			 $expires );
								if( $ret[0] == FALSE )
									{
										$module->Audit('',$module->GetName(),$ret[1]);
										return FALSE;
									}
								$uid = $ret[1];
					
								// set his groups.
								if( $dflt_group > 0 )
									{
										$ret = $this->AssignUserToGroup( $uid, $dflt_group );
									}
					
								// now set a property.
								if( $useprop )
									{
										$ret = $this->SetUserPropertyFull($prop,$val,$uid);
										if( $ret == false )
											{
												// should remove the user...
												$module->Audit('',$module->GetName(),$module->Lang('error_problemsettinginfo'));
												return FALSE;
											}
									}
					
								$module->Audit($uid,$module->GetName(),$module->Lang('audit_user_created'));
								return $uid;
							}
					}
				else
					{
						return $uinfo[1]['id'];
					}
      }
    return FALSE;
  }

	private function _attempt_login_with_cookie()
	{
		$module = $this->GetModule();
    $config = cmsms()->GetConfig();
    if( $module->GetPreference('usecookiestoremember') &&
				($module->GetPreference('cookiename') != '') )
      {
				$cookiename = $module->GetPreference('cookiename');

				if( !isset($_COOKIE[$cookiename]) ) 
					{
						return;
					}

				$str = $_COOKIE[$cookiename];
				$origstr = $str;
				$str = base64_decode($str);
				$key = 'FEU'.md5($config['root_path']).md5($cookiename.$this->get_salt());
				$str = $module->_decrypt($key,$str);
				if( $str === FALSE )
					{
						return;
					}
				$arr = unserialize( $str );

				if( count($arr) != 2 || !isset($arr['u']) || !isset($arr['p']) )
					return;

				$res = $module->Login( $arr['u'], $arr['p'], '', true, true );
				return $res;
      }
	}

  private function _old_LoggedInId() 
  {
		global $gCms;
		$config = $gCms->GetConfig();
		if( cge_tmpdata::exists('feu_logginid') )
			{
				// this will save a few queries in each request
				return cge_tmpdata::get('feu_logginid');
			}

		$sessionid = session_id();
    $this->ExpireUsers();
    if( $sessionid == "" )
      {
				return false;
			}

    $db = $this->GetDb();
		$module = $this->GetModule();
		$expirytime = $module->GetPreference('user_session_expires');
		$expireusers_interval = $module->GetPreference('expireusers_interval');
		$interval = min($expireusers_interval,$expirytime);

    $q="SELECT userid FROM ".cms_db_prefix()."module_feusers_loggedin WHERE sessionid=?";
    $p=array($sessionid);
    $result = $db->GetOne($q,$p);
    if ($result)
			{
				// we know this user is logged in.
				$retval = $result;
				
				// now touch the lastused
				// this will ensure that every time we check that a user is
				// logged in, it touches his logged in entry
				$q = "UPDATE ".cms_db_prefix()."module_feusers_loggedin SET lastused = ? where sessionid = ?";
				$db->Execute( $q, array( time(), $sessionid ) );

				// refresh the cookie.
				@setcookie('feu_sessionid',$sessionid,time()+$expirytime,"/");
				@setcookie('feu_uid',$uid,time()+$expirytime,"/");
				cge_tmpdata::set('feu_logginid',$retval);

				// set some session data to save some db queries.

				// and send an event.
			  $module->SendEvent('OnRefreshUser',array('id'=>$retval));
				return $retval;
			} 
		else 
			{
				if( $module->GetPreference('cookie_keepalive',0) &&
						isset($_COOKIE['feu_sessionid']) && isset($_COOKIE['feu_uid']))
					{
						// no session id, but we have a cookie, so what we'll do
						// is first check to see if the session is still logged in
						// if it is, force a logout for that session id
						// and start a new record, otherwise, ignore the cookie
						$uid = $_COOKIE['feu_uid'];
						$sessionid = $_COOKIE['feu_sessionid'];
						
						// delete the existing record
						$q = "DELETE FROM ".cms_db_prefix()."module_feusers_loggedin 
                        WHERE sessionid = ?";
						$db->Execute( $q, array( $sessionid ) );
						
						// log the user in
						// todo, log this too,
						// rationalize this code with Login() and Logout() methods
						@session_start();
						$sessionid = session_id();
						
						$q = "INSERT INTO ".cms_db_prefix()."module_feusers_loggedin
                    (sessionid,lastused,userid)
                  VALUES (?,?,?)";
						$db->Execute( $q, array($sessionid, time(), $uid) );
						
						// set the cookie again
						@setcookie('feu_sessionid',$sessionid,time()+$expirytime,"/");
						@setcookie('feu_uid',$uid,time()+$expirytime,"/");
						
						cge_tmpdata::set('feu_logginid',$uid);
						$module->SendEvent('OnRefreshUser',array('id'=>$uid));
						return $uid;
					}
				else
					{
						$res = $this->_attempt_login_with_cookie();
						if( !is_array($res) || $res[0] == FALSE )
							{
								return false;
							}
						$module->SendEvent('OnRefreshUser',array('id'=>$res[0]));
						return $res[0];
					}
			}
		return false;
  }


  // userid api function
  function LoggedIn() 
  {
    if( !$this->LoggedInId() ) 
			{
				return false; 
			}
    else
			{
				return true;
			}
  }


  // userid api function
  function MemberOfGroup($userid,$groupid) 
  {
    $db = $this->GetDb();
    $q="SELECT * FROM ".cms_db_prefix()."module_feusers_belongs WHERE userid=? AND groupid=?";
    
    $params=array($userid,$groupid);
    $result=$db->Execute($q,$params);
    if ($result && $result->RecordCount()) 
			{
				return true;
			} 
		else 
			{
				return false;
			}
  }

  
  // userid api function
  function GetUserName($userid) 
  {
		$row = $this->_getUser($userid);
		if( !$row ) return FALSE;
		return $row['username'];
  }

  
  // userid api function
  function GetUserID($username) 
  {		
    $db = $this->GetDb();
    $q="SELECT * FROM ".cms_db_prefix()."module_feusers_users WHERE username=?";
    $dbresult=$db->Execute($q,array($username));
    if ($dbresult && $dbresult->RecordCount()) {
      $row=$dbresult->FetchRow();
      return $row["id"];
    } else {
      return false;
    }
  }

  
  // userid api function
  // returns array
  function AddGroup( $name, $description )
  {
    $db = $this->GetDb();
    
    // see if it exists already or not (by name)
    $q = "SELECT * FROM ".cms_db_prefix().
      "module_feusers_groups WHERE groupname = ?";
    $dbresult = $db->Execute( $q, array( $name ) );
    if( !$dbresult )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    $row = $dbresult->FetchRow();
    if( $row )
      {
				$module = $this->GetModule();
				return array(FALSE,$module->Lang('error_groupname_exists'));
      }
    
    $grpid = 
      $db->GenID( cms_db_prefix()."module_feusers_groups_seq" );
    $q = "INSERT INTO ".cms_db_prefix().
      "module_feusers_groups VALUES (?,?,?)";
    $dbresult = $db->Execute( $q, array( $grpid, $name, $description ) );
    if( !$dbresult )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    return array(TRUE,$grpid);
  }


  // userid api function
  // returns array
  function AddUser( $name, $password, $expires, $do_md5 = true )
  {
    $db = $this->GetDb();
    
    // see if it exists already or not (by name)
    $q = "SELECT * FROM ".cms_db_prefix().
      "module_feusers_users WHERE username = ?";
    $dbresult = $db->Execute( $q, array( $name ) );
    if( !$dbresult )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    $row = $dbresult->FetchRow();
    if( $row )
      {
	$module = $this->GetModule();
	return array(FALSE,$module->Lang('error_username_exists'));
      }
    
    // generate the sequence
    $uid = 
      $db->GenID( cms_db_prefix()."module_feusers_users_seq" );

		$pwtxt = $password;
		if( $do_md5 == true )
			{
				$pwtxt = md5($password.$this->get_salt());
			}

    // insert the record
    $q = "INSERT INTO ".cms_db_prefix().
      "module_feusers_users VALUES (?,?,?,?,?)";
    $dbresult = $db->Execute( $q, array( $uid, $name, $pwtxt, 
					 trim($db->DbTimeStamp(time()),"'"),
					 trim($db->DbTimeStamp($expires),"'") ) );
    if( !$dbresult )
      {
	return array(FALSE,$db->ErrorMsg());
      }
    return array(TRUE,$uid);
  }
  
  
  // userid api function
  function GetGroupName($groupid) 
  {
    $db = $this->GetDb();
    $q="SELECT * FROM ".cms_db_prefix()."module_feusers_groups WHERE id=?";
    $dbresult=$db->Execute($q,array($groupid));
    if ($dbresult && $dbresult->RecordCount()) {
      $row=$dbresult->FetchRow();
      return $row["groupname"];
    } else {
      return false;
    }
  }
  
  
  // userid api function
  function GetGroupDesc($groupid) {
    $db = $this->GetDb();
    $q="SELECT * FROM ".cms_db_prefix()."module_feusers_groups WHERE id=?";
    $dbresult=$db->Execute($q,array($groupid));
    if ($dbresult && $dbresult->RecordCount()) {
      $row=$dbresult->FetchRow();
      return $row["groupdesc"];
    } 	else {
      return false;
    }
  }
  

  // userid api function
  // returns an array
  function DeleteGroupFull( $id )
  {
    $db = $this->GetDB();
    $result = array();

    // delete all property relations from this group
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_grouppropmap WHERE group_id = ?";
    $dbresult = $db->Execute( $q, array( $id ) );
    if( !$dbresult )
      {
	return array( FALSE, $db->ErrorMsg() );
      }

    // delete all indication that anybody is a member
    // of this group
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_belongs WHERE groupid = ?";
    $dbresult = $db->Execute( $q, array( $id ) );
    if( !$dbresult )
      {
	return array( FALSE, $db->ErrorMsg() );
      }
    
    // and then delete the group
    $q = "DELETE FROM ".cms_db_prefix()."module_feusers_groups WHERE id = ?";
    $dbresult = $db->Execute( $q, array( $id ) );
    if( !$dbresult )
      {
	return array( FALSE, $db->ErrorMsg() );
      }
    
    return array( TRUE, '' );
  }
  
  
  // userid api function
  function GetGroupList()
  {
    $db = $this->GetDb();
    
    $result = array();
    $q = "SELECT * FROM ".cms_db_prefix()."module_feusers_groups ORDER BY id ASC";
    $dbresult = $db->Execute( $q );
    if( $dbresult ) {
    while( $row = $dbresult->FetchRow() )
      {
		  $result[$row['groupname']] = $row['id'];
      }
    }
    return $result;
  }
  

  // userid api function
  function GetGroupListFull()
  {
    $db = $this->GetDb();
	  
    $result = array();
    $query = "SELECT * FROM ".cms_db_prefix()."module_feusers_groups ORDER BY id ASC";
    $dbresult = $db->Execute( $query );
    if( $dbresult ) {
      while( $row = $dbresult->FetchRow() )
        {
			array_push($result,$row);
        }
    }
    return $result;
  }


  // old userid api function
  function GetGroupID($groupname) 
  {
    $db = $this->GetDb();

    $q="SELECT * FROM ".cms_db_prefix()."module_feusers_groups WHERE groupname=?";
    $dbresult=$db->Execute($q,array($groupname));
    if ($dbresult && $dbresult->RecordCount()) 
      {
				$row=$dbresult->FetchRow();
				return $row["id"];
      } 
    else 
      {
				return false;
      }
  }


  // old userid api function
  function GetMemberGroups($userid) {
    $db = $this->GetDb();
    $q="SELECT * FROM ".cms_db_prefix()."module_feusers_belongs WHERE userid=?";
    $dbresult=$db->Execute($q,array($userid));
    if ($dbresult && $dbresult->RecordCount()) {
      $result="";
      while ($row=$dbresult->FetchRow()) {
				if ($result!="") {
					$result.=",".$this->GetGroupName($row["groupid"]);
				} else {
					$result=$this->GetGroupName($row["groupid"]);
				}
      }
      return $result;
    } else {
      return "none";
    }
  }


  // old userid api function
  function DeleteUser($id) 
  {
    $db = $this->GetDb();
    if (isset($_GET[$id."userid"])) 
      $userid=str_replace("'",'_',$_GET[$id."userid"]); 
    else 
      return;
    $q="DELETE FROM ".cms_db_prefix()."module_feusers_users WHERE id='$userid'";
    $dbresult=$db->Execute($q);
    $q="DELETE FROM ".cms_db_prefix()."module_feusers_belongs WHERE userid='$userid'";
    $dbresult=$db->Execute($q);

		if( isset($this->_cached_uid_map[$userid]) )
			{
				unset($this->_cached_uid_map[$userid]);
			}
  }

} // class

$manipulator = 'FrontEndUsersManipulator';
?>
