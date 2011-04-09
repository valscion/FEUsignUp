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

function NoBreak($string) {
  return str_replace(" ","&nbsp;",$string);
}

function AdminDisplayManageEvents(&$mod, $id, &$parameters, $returnid)
{
  global $gCms;
  $smarty =& $gCms->GetSmarty();
  $db =& $gCms->GetDb();

  if( isset($parameters['filter_conflicting']) )
    {
      $mod->Redirect($id,'admin_remove_conflicted',$returnid);
      return;
    }

  $showchildren = $mod->param_session_get($parameters,'showchildren','');
  $keyword = $mod->param_session_get($parameters,'keyword','');
  $category_filter = $mod->param_session_get($parameters,'category_filter',-1);
  $not_approved_only = $mod->param_session_get($parameters,'not_approved_only',0);
  $mod->session_put('showchildren',$showchildren);
  $mod->session_put('keyword',$keyword);
  $mod->session_put('category_filter',$category_filter);
  $mod->session_put('not_approved_only',$not_approved_only);

  $smarty->assign('formstart',$mod->CreateFormStart($id,'defaultadmin',$returnid));
  $smarty->assign('formend',$mod->CreateFormEnd());
  $smarty->assign('input_keyword',$mod->CreateInputText($id,'keyword',$keyword, 25, 100));

  $categories = $mod->GetCategories();
  $category_array = array($mod->Lang('cal_any_category')=>-1);
  foreach($categories as $category)
    {
      $category_array[$category['category_name']] = $category['category_id'];
    }
  $smarty->assign('input_categories',$mod->CreateInputDropdown($id,'category_filter',$category_array, -1, $category_filter));
  $smarty->assign('input_submit',$mod->CreateInputSubmit($id,'submit',$mod->Lang('cal_go')));

  $smarty->assign('addlink',
		  $mod->CreateLink($id, 'admin_add_event', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $mod->Lang('cal_add_event'),'','','systemicon'), array(), '', false, false, '') .' '. $mod->CreateLink($id, 'admin_add_event', $returnid, $mod->Lang('cal_add_event'), array(), '', false, false, 'class="pageoptions"'));
  $smarty->assign('show_children',
		  $mod->CreateInputYesNoDropdown($id,'showchildren',$showchildren));

  $where = 'WHERE';
  $sql = "SELECT ". $mod->events_table_name . ".*
	    FROM ". $mod->events_table_name . " ";

  if($category_filter != -1)
    {
      
      $sql .= 'LEFT JOIN ' . $mod->events_to_categories_table_name . ' ON ' .
	$mod->events_to_categories_table_name . '.event_id = ' . $mod->events_table_name . ".event_id \n" .
	$where . ' ' .$mod->events_to_categories_table_name . '.category_id = ' . $category_filter . ' ';
      $where = 'AND';
    }
  
  if(!empty($keyword))
    {
      $sql .= "$where ". $mod->events_table_name . ".event_title LIKE '%$keyword%'
						OR ". $mod->events_table_name . ".event_details LIKE '%$keyword%'
						OR ". $mod->events_table_name . ".event_summary LIKE '%$keyword%' ";
    }
  $sql .= "ORDER BY ". 
    $mod->events_table_name . ".event_date_start ASC, ".
    $mod->events_table_name . ".event_title";
  
  $rs = $db->Execute($sql);
  $entries = array();
  if ($rs && $rs->RecordCount() > 0)
    {
      $smarty->assign('formstart2',
		      $mod->CreateFormStart($id, 'deleteevents', $returnid));
      $smarty->assign('formend2',$mod->CreateFormEnd());
      $smarty->assign('selectall',$mod->CreateInputCheckbox($id,'tagall','tagall','',"onclick='selectall();'"));
      while( ($row = $rs->FetchRow()) )
	{
	  if( $showchildren == 0 && $row['event_parent_id'] > 0 )
	    {
	      continue;
	    }
	  $tmp = $db->UnixTimeStamp($row['event_date_end']);
	  $row['edit_url']   = $mod->CreateURL($id,'admin_add_event',$returnid,array('event_id'=>$row['event_id']));
	  $row['checkbox']   = $mod->CreateInputCheckBox($id,"tag".$row['event_id'],"tagged","");
	  $row['editlink']   = $mod->CreateLink($id, 'admin_add_event',$returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $mod->Lang('cal_edit'),'','','systemicon'), $params=array('event_id'=>$row['event_id']));
	  $row['deletelink'] = $mod->CreateLink($id, 'admin_delete_event', $returnid, 
						$gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', 
											     $mod->Lang('cal_delete'),'','','systemicon'),
						array('event_id'=>$row['event_id']), 
						$mod->Lang('cal_areyousure').' \\\''.strip_tags($row['event_title']).'\\\'?');

	  $entries[] = $row;
	}

      // close off final column
      if( count($entries) )
	{
	  $smarty->assign('events',$entries);
	}
      $rs->Close();
      $smarty->assign('delete_selected',
		      $mod->CreateInputSubmit($id,'delete_selected',$mod->Lang('deletetagged'),'','',$mod->lang('confirmdeletetagged')));
      $smarty->assign('import_link',$mod->CreateLink($id, 'admin_import', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/import.gif', $mod->Lang('cal_import_events'),'','','systemicon'), array(), '', false, false, '').' '. $mod->CreateLink($id, 'admin_import', $returnid, $mod->Lang('cal_import_events'), array(), '', false, false, 'class="pageoptions"'));
      
    }

  echo $mod->ProcessTemplate('admin_events_tab.tpl');
}
?>