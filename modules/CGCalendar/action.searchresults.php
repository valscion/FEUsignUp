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
$pagenum = 1;
$limit = 10000;
$thetemplate = $this->GetPreference(CGCALENDAR_PREF_DFLTSEARCHRESULT_TEMPLATE);
$destpage = $returnid;
$search_text = '';
$search_type = 'or';


#
# Setup
#
if( isset($params['limit']) )
  {
    $limit = (int)$params['limit'];
  }

if( isset($params['detailpage']) )
  {
    $destpage = trim($params['detailpage']);
  }

if( isset($params['searchresulttemplate']) )
  {
    $thetemplate = trim($params['searchresulttemplate']);
  }
    
if( isset($params['cal_pagenum']) )
  {
    $pagenum = (int)$params['cal_pagenum'];
  }

#
# Get Data
#

#
# Handle Form Submission
#
if( isset($params['cal_search_submit']) )
  {
    if( isset($params['cal_search_type']) )
      {
	$search_type = trim($params['cal_search_type']);
      }
    if( isset($params['cal_search_text']) )
      {
	$search_text = trim($params['cal_search_text']);
      }
    if( isset($params['cal_search_category']) )
      {
	$search_category = (int)$params['cal_search_category'];
      }
    if( isset($params['cal_search_start_date_Month']) )
      {
	$search_start_date = mktime(isset($params['cal_search_start_date_Hour'])?(int)$params['cal_search_start_date_Hour']:0,
				    isset($params['cal_search_start_date_Minute'])?(int)$params['cal_search_start_date_Minute']:0,
				    0,
				    (int)$params['cal_search_start_date_Month'],
				    (int)$params['cal_search_start_date_Day'],
				    (int)$params['cal_search_start_date_Year']);
      }
    if( isset($params['cal_search_end_date_Month']) )
      {
	$search_end_date = mktime(isset($params['cal_search_end_date_Hour'])?(int)$params['cal_search_end_date_Hour']:23,
				  isset($params['cal_search_end_date_Minute'])?(int)$params['cal_search_end_date_Minute']:59,
				  0,
				  (int)$params['cal_search_end_date_Month'],
				  (int)$params['cal_search_end_date_Day'],
				  (int)$params['cal_search_end_date_Year']);
      }

    // validate results
    if( $search_end_date < $search_start_date )
      {
	$tmp = $search_start_date;
	$search_start_date = $search_end_date;
	$search_end_date = $tmp;
      }

    if( $search_end_date - $search_start_date < 60 )
      {
	$error = $this->Lang('error_search_invalid_dates');
      }

    // store the results
    if( isset($params['use_session'])  )
      {
	$this->session_put($use_session.'search_text',$search_text);
	$this->session_put($use_session.'search_category',$search_category);
	$this->session_put($use_session.'search_start_date',$search_start_date);
	$this->session_put($use_session.'search_end_date',$search_end_date);
      }

    // do the search
    if( empty($error) )
      {
	// find all the searchable field names.
	$query = 'SELECT field_name FROM '.$this->fields_table_name.' WHERE field_searchable = 1';
	$searchable_fields = $db->GetCol($query);

	// assemble the query first.
	$from = array();
	$fields = array();
	//$query = 'SELECT DISTINCT ev.event_id,ev.event_parent_id,ev.event_title'; FROM '.$this->events_table_name.' ev';
	$where = array();
	$where2 = array();
	$where3 = array();
	$having = array();
	$joins = array();
	$qparms = array();
	$db_st = $db->DbTimeStamp($search_start_date);
	$db_et = $db->DbTimeStamp($search_end_date);

	$from['ev'] = $this->events_table_name;
	$fields[] = 'ev.event_id';
	$fields[] = 'ev.event_parent_id';
	$fields[] = 'ev.event_title';

	// automatic filtering by date.
	$where[] = "((ev.event_date_start BETWEEN $db_st AND $db_et) OR (ev.event_date_end BETWEEN $db_st and $db_et))";

	if( is_array($searchable_fields) && count($searchable_fields) )
	  {
	    $tmp = array();
	    for( $i = 0; $i < count($searchable_fields); $i++ )
	      {
		$tmp[] = "'".$searchable_fields[$i]."'";
	      }
	    //$from['fv'] = $this->event_field_values_table_name;
	    $joins[] = 'LEFT JOIN 
                        (SELECT event_id,group_concat(field_value) AS vals 
                         FROM '.$this->event_field_values_table_name.'
                         WHERE field_name IN ('.implode(',',$tmp).')
                         GROUP BY event_id) AS fv ON ev.event_id = fv.event_id';
	  }

	if( $search_category > 0 )
	  {
	    // filtering by category
	    $tmp2 = array();
	    foreach( $searchable_fields as $one )
	      {
		$tmp2[] = "'".$one."'";
	      }
	    $str = implode(',',$tmp2);
	    $joins[] = 'LEFT JOIN '.$this->events_to_categories_table_name.' ec 
                         ON ec.event_id = ev.event_id';
	    $where[] = 'ec.category_id = ?';
	    $qparms[] = $search_category;
	  }

	if( !empty($search_text) )
	  {
	    if( $search_type == 'or' )
	      {
		$where2[] = '(MATCH (ev.event_title,ev.event_summary,ev.event_details) AGAINST (?))';
		$qparms[] = $search_text;
	      }
	    else
	      {
		$where2[] = '(MATCH (ev.event_title,ev.event_summary,ev.event_details) AGAINST (? IN BOOLEAN MODE))';
		$qparms[] = $search_text;
	      }
	  }
	if( is_array($searchable_fields) && count($searchable_fields) )
	  {
	    // split and clean up the search words.
	    $tmp = explode(' ',$search_text);
	    $words = array();
	    for( $i = 0; $i < count($tmp); $i++ )
	      {
		$tmp2 = trim($tmp[$i]);
		if( !$tmp2 ) continue;
		$words[] = '%'.trim($tmp[$i]).'%';
	      }

	    for( $i = 0; $i < count($words); $i++ )
	      {
		$where3[] = '(fv.vals LIKE ?)';
		$qparms[] = $words[$i];
	      }
	  }
	
	$query = 'SELECT DISTINCT '.implode(',',$fields).' FROM ';
	{
	  $tmp = array();
	  foreach($from as $tbl => $str )
	    {
	      $tmp[] = " $str $tbl";
	    }
	  $query .= " ".implode(',',$tmp);
	}
	if( count($joins) )
	  {
	    $query .= ' '.implode(' ',$joins);
	  }
	if( count($where) || $count($where2) )
	  {
	    $query .= ' WHERE ';
	  }
	if( count($where) )
	  {
	    $query .= implode(' AND ',$where);
	  }
	if( count($where2) )
	  {
	    $expr = ' AND ';
	    if( $search_type == 'or' ) $expr = ' OR ';
	    if( count($where) )
	      {
		$query .= ' AND ';
	      }
	    $query .= '(';
	    $query .= implode($expr,$where2);
	    if( count($where3) )
	      {
		$query .= ' OR ';
		$query .= '(' . implode($expr, $where3) . ')';
	      }
	    $query .= ')';
	  }

	if(isset($params['unique_only']) && ($params['unique_only']))
	  {
	    $query .= ' GROUP BY ev.event_title';
	  }

	if( count($having) )
	  {
	    $query .= ' HAVING ';
	    $query .= '(' . implode(' AND ',$having). ')';
	  }

	$query .= ' ORDER BY ev.event_date_start ASC';
	$searchresults = $db->GetArray($query,$qparms);
	if( !$searchresults && $db->ErrorMsg != '' )
	  {
	    $error = $this->Lang('error_query_failed');
	  }
	$searchresults = cge_array::extract_field($searchresults,'event_id');
      }
  }

// calculate pagination stuff
// and the subset of event ids.
$numpages = 0;
$num_matches = 0;
if( !empty($searchresults) )
  {
    $num_matches = count($searchresults);
    $numpages = (int)(count($searchresults) / $limit);
    if( count($searchresults) % $limit > 0 )
      {
	$numpages++;
      }
    $startoffset = ($pagenum - 1)*$limit;
    $entries = cgcalendar_utils::expand_events($searchresults,$returnid,$params,$limit,$startoffset);
    if( is_array($entries) && count($entries) )
      {
	$parms = $params;
	if( $pagenum > 1 )
	  {
	    $parms['cal_pagenum'] = $pagenum - 1;
	    $smarty->assign('prevpage_url',$this->CreateURL($id,'searchresults',$returnid,$parms));
	    $parms['cal_pagenum'] = 1;
	    $smarty->assign('firstpage_url',$this->CreateURL($id,'searchresults',$returnid,$parms));
	  }
	if( $pagenum < $numpages )
	  {
	    $parms['cal_pagenum'] = $pagenum + 1;
	    $smarty->assign('nextpage_url',$this->CreateURL($id,'searchresults',$returnid,$parms));
	    $parms['cal_pagenum'] = $numpages;
	    $smarty->assign('lastpage_url',$this->CreateURL($id,'searchresults',$returnid,$parms));
	  }
	$smarty->assign('events',$entries);
      }
  }

#
# Give Everything to smarty
#
$smarty->assign('numpages',$numpages);
$smarty->assign('pagenum',$pagenum);
$smarty->assign('search_start_date',$search_start_date);
$smarty->assign('search_end_date',$search_end_date);
$smarty->assign('search_category',$search_category);
$smarty->assign('search_text',$search_text);


#
# Process The Template
#
echo $this->ProcessTemplateFromDatabase('searchresult_'.$thetemplate);

#
# EOF
#
?>
