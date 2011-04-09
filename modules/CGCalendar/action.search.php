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
if( !isset($gCms) ) exit;

#
# Initialization
#
$thetemplate = $this->GetPreference(CGCALENDAR_PREF_DFLTSEARCH_TEMPLATE);
$destpage = $returnid;
$inline = 0;
$search_category = -1;
$search_start_date = time();
$search_end_date = strtotime('+1 month',$search_start_date);
$search_text='';
$searchresults = '';
$error = '';
$use_session = '';

#
# Setup
#
if( isset($params['searchtemplate']) )
  {
    $thetemplate = trim($params['searchtemplate']);
  }
if( isset($params['inline']) )
  {
    $inline = (int)$params['inline'];
  }
if( isset($params['searchresultpage']) )
  {
    $tmp = $this->resolve_alias_or_id($params['searchresultpage']);
    if( !empty($tmp) ) $destpage = $tmp;
  }
if( $destpage != $returnid ) $inline = 0;
if( isset($params['use_session']) )
  {
    $search_text = $this->session_get($use_session.'search_text',$search_text);
    $search_category = $this->session_get($use_session.'search_category',$search_category);
    $search_start_date = $this->session_get($use_session.'search_start_date',$search_start_date);
    $search_end_date = $this->session_get($use_session.'search_end_date',$search_end_date);
  }

#
# Get the Data
#



#
# Build the form data
#
$categorys = array();
$categories[-1] = $this->Lang('cal_any_category');
{
  $query = 'SELECT category_id,category_name FROM '.$this->categories_table_name.'
             ORDER BY category_order ASC';
  $tmp = $db->GetArray($query);
  if( is_array($tmp) )
    {
      for( $i = 0; $i < count($tmp); $i++ )
	{
	  $categories[$tmp[$i]['category_id']] = $tmp[$i]['category_name'];
	}
    }
}

#
# Give Everything to Smarty
#
$smarty->assign('formstart',$this->CGCreateFormStart($id,'searchresults',$destpage,$params,$inline));
$smarty->assign('formend',$this->CreateFormEnd());
$smarty->assign('list_categories',$categories);
$smarty->assign('search_category',$search_category);
$smarty->assign('search_start_date',$search_start_date);
$smarty->assign('search_end_date',$search_end_date);
$smarty->assign('search_text',$search_text);

#
# And Display The Template
#
echo $this->ProcessTemplateFromDatabase('search_'.$thetemplate);

#
# EOF
#
?>