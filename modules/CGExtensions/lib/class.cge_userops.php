<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGExtensions (c) 2008,2010 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to provide useful functions
#  and commonly used gui capabilities to other modules.
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

class cge_userops
{
  /**
   * A function to return an expanded list of user id's given an input list
   * if one of the id's specified is negative, it is assumed to be a group id
   * and is expanded to its members.
   *
   * @param mixed A comma separated string, or an array of userid's or negative group id's.
   * @return array
   */
  static public function expand_userlist($useridlist)
  {
    $users = array();

    if( !is_array($useridlist) )
      {
	$useridlist = explode(',',$useridlist);
      }
    if( !count($useridlist) ) return $users;

    $userops = cmsms()->GetUserOperations();
    foreach( $useridlist as $oneuid )
      {
	if( $oneuid < 0 )
	  {
	    // assume its a group id
	    // and get all the uids for that group
	    $groupusers = $userops->LoadUsersInGroup($oneuid * -1);
	    foreach( $groupusers as $oneuser )
	      {
		$users[] = $oneuser->id;
	      }
	  }
	else
	  {
	    $users[] = $oneuid;
	  }
      }

    $users = array_unique($users);
    return $users;
  }
} // end of class

#
# EOF
#
?>