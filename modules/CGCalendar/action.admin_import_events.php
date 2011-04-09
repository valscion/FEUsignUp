<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Skeleton (c) 2008 
#      by Robert Allen (akrabat) and
#         Robert Campbell (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow displaying calendars,
#  and management and display of time based events.
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


if( !$this->AllowAccess() )
{
	return;
}

// TODO: smartyfy
//    $start_time = preg_split("/[: -]+/", $row['start_time']);
if (!isset($_FILES[$id.'csv_file']))
{
	echo '<p>'.$this->Lang('error_csvfilenotfound').'</p>';
}
else
{
	global $gCms;
	$user_id = $gCms->variables['user_id'];

	$db =& $this->GetDb(); /* @var $db ADOConnection */
	$sql = 'SELECT category_id, category_name FROM ' . $this->categories_table_name;
	$rs = $db->Execute($sql);
	$cat = array();
	while( $rs && $row = $rs->FetchRow())
	{
		$cat[$row['category_name']]=$row['category_id'];
	}
	$handle = fopen($_FILES[$id.'csv_file']['tmp_name'], "r");
	if ($handle === false)
	{
		echo '<p>'.$this->Lang('error_cantopenfile').'</p>';
	}
	$row = 0;
	while (($data = fgetcsv($handle,1000,',')) !== FALSE)
	{
		// skip comments
		if ($row == 0 && preg_match('/Year/i',$data[0]))
		{
			continue;
		}
		$event_id = $db->GenID($this->events_table_name . "_seq");

		$start_time = $data[0];
		if( $start_time == 'NULL' || $start_time == '' )
		{
			$start_time = null;
		}
		else
		{
			$start_time = trim($start_time,"'");
		}
		$end_time = $data[1];
		if( $end_time == 'NULL' || $end_time == '' )
		{
			$end_time = null;
		}
		else
		{
			$end_time = trim($end_time,"'");
		}

		$sql = "INSERT INTO " . $this->events_table_name . " (
                        event_id
                        ,event_title
                        ,event_summary
                        ,event_details
                        ,event_date_start
                        ,event_date_end
                        ,event_created_by
                        ,event_create_date
                        ,event_modified_date
                    ) VALUES (?,?,?,?,?,?,?,?,?)";


		$parms = array($event_id
		,$data[2]
		,$data[3]
		,$data[4]
		,$start_time
		,$end_time
		,$user_id
		,trim($db->DBTimeStamp(time()),"'")
		,trim($db->DBTimeStamp(time()),"'")
		);
		$db->debug = true;
		$db->Execute( $sql, $parms );

		$db->Execute("INSERT INTO ".$this->events_to_categories_table_name.
		' (category_id, event_id) VALUES (?,?)',array($cat[$data[5]],$event_id));
		echo "<p>".$this->Lang('msg_eventadded')."</p>";
	}
	fclose($handle);
}

?>