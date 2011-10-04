<?php

class feu_user_query_opt
{
  const MATCH_USERNAME   = '*username*';
  const MATCH_PASSWORD   = '*password*';
  const MATCH_EXPIRES_LT = '*expires-lt*';
  const MATCH_GROUP      = '*group*';
  const MATCH_GROUPID    = '*gid*';
  const MATCH_PROPERTY   = '*property*';

  private $_type;
  private $_expr;
  private $_opt;

  public function __construct($type,$expr,$opt = '')
  {
    if( empty($expr) )
      {
	throw new Exception('invalid value');
      }

    switch($type)
      {
      case self::MATCH_USERNAME:
      case self::MATCH_PASSWORD:
      case self::MATCH_EXPIRES_LT:
      case self::MATCH_GROUP:
      case self::MATCH_GROUPID:
	$this->_type = $type;
	$this->_expr = $expr;
	break;

      case self::MATCH_PROPERTY:
	if( empty($opt) )
	  {
	    throw new Exception('invalid value');
	  }
	$this->_type = $type;
	$this->_expr = $expr;
	$this->_opt = $opt;
	break;

      default:
	throw new Exception('invalid value');
      }
  }

  
  public function get_type()
  {
    return $this->_type;
  }


  public function get_expr()
  {
    return $this->_expr;
  }


  public function get_opt()
  {
    return $this->_opt;
  }
} // class


class feu_user_query
{
  private $_and_opts   = array();
  private $_groups = '';
  private $_qrecs  = '';
  private $_qcount = '';
  private $_qparms = array();
  private $_pagelimit = 100000;
  private $_meta_count  = '';
  private $_meta_npages = '';
  private $_meta_curpage = 1;

  public function __construct($pagelimit)
  {
    $pagelimit = (int)$pagelimit;
    $pagelimit = max(1,$pagelimit);
    $this->_pagelimit = $pagelimit;
  }

  public function add_and_opt($type,$value)
  {
    $this->_and_opts[] = new feu_user_query_opt($type,$value);
  }

  public function add_and_opt_obj(feu_user_query_opt& $opt)
  {
    $this->_and_opts[] = $opt;
  }

  public function count_opts()
  {
    return count($this->_and_opts);
  }

  private function _get_groups()
  {
    if( !is_array($this->_groups) )
      {
	$feu = cge_utils::get_module('FrontEndUsers');
	$tmp = $feu->GetGroupListFull();
	if( is_array($tmp) && count($tmp) )
	  {
	    $this->_groups = cge_array::to_hash($tmp,'groupname');
	  }
      }
    return $this->_groups;
  }


  private function _build_queries()
  {
    if( $this->_qrecs != '' ) return;
    if( $this->_qcount != '' ) return;

    if( !$this->count_opts() ) 
      {
	throw new Exception('invalid value');
      }

    $where  = array();
    $qparms = array();
    $joins  = array();
    $jcount = 0;
    foreach( $this->_and_opts as &$opt )
    {
      switch( $opt->get_type() )
	{
	case feu_user_query_opt::MATCH_USERNAME:
	  $where[]  = 'u.username LIKE ?';
	  $qparms[] = str_replace('*','%',$opt->get_expr());
	  break;

	case feu_user_query_opt::MATCH_PASSWORD:
	  $where[]  = 'u.password = ?';
	  $qparms[] = $opt->get_expr();
	  break;
	  
	case feu_user_query_opt::MATCH_EXPIRES_LT:
	  $tmp = $db->DbTimeStamp($opt->get_expr());
	  $where[] = "u.expires < {$tmp}";
	  break;

	case feu_user_query_opt::MATCH_GROUP:
	  $tmp = $this->_get_groups();
	  if( !isset($tmp[$opt->get_expr()]) )
	    {
	      throw new Exception('invalid value');
	    }
	  $joins = 'LEFT JOIN '.cms_db_prefix().'module_feusers_belongs bl ON u.id = bl.userid';
	  $where[] = 'bl.groupid = ?';
	  $qparms[] = $opt->get_expr();
	  break;

	case feu_user_query_opt::MATCH_GROUPID:
	  $joins = 'LEFT JOIN '.cms_db_prefix().'module_feusers_belongs bl ON u.id = bl.userid';
	  $where[] = 'bl.groupid = ?';
	  $qparms[] = $opt->get_expr();
	  break;

	case feu_user_query_opt::MATCH_PROPERTY:
	  $feu = cge_utils::get_module('FrontEndUsers');
	  $defns = $feu->GetPropertyDefns();
	  if( !in_array($opt->get_expr(),array_keys($defns)) )
	    {
	      throw new Exception('invalid value');
	    }
	  $jcount++;
	  $joins[] = 'LEFT JOIN '.cms_db_prefix()."module_feusers_properties pr{$jcount} 
                        ON pr{$jcount}.userid = u.id 
                       AND pr{$jcount}.title = '".$opt->get_expr()."'";
	  if( strstr($opt->get_opt(),'*') === FALSE )
	    {
	      $where[] = "pr{$jcount}.data = '".$opt->get_opt()."'";
	    }
	  else
	    {
	      $where[] = "pr{$jcount}.data LIKE '".str_replace('*','%',$opt->get_opt())."'";
	    }
	  break;
	}
    }

    // asembly
    $qrec = 'SELECT u.id FROM '.cms_db_prefix().'module_feusers_users u';
    $qcnt = 'SELECT count(u.id) AS count FROM '.cms_db_prefix().'module_feusers_users u';
    
    if( count($joins) )
      {
	$qrec .= ' '.implode(' ',$joins);
	$qcnt .= ' '.implode(' ',$joins);
      }
    if( count($where) )
      {
	$qrec .= "\nWHERE ".implode(' AND ',$where);
	$qcnt .= "\nWHERE ".implode(' AND ',$where);
      }

    $this->_qrecs  = $qrec;
    $this->_qcount = $qcnt;
    $this->_qparms = $qparms;
    return;
  }


  public function prepare()
  {
    $this->_build_queries();
    if( !$this->_qrecs ) return FALSE;
    if( !$this->_qcount ) return FALSE;

    global $gCms;
    $db = $gCms->GetDb();

    $tmp = $db->GetOne($this->_qcount,$this->_qparms);
    if( $tmp )
      {
	$this->_meta_count = $tmp;
	$npages = (int)($this->_meta_count / $this->_pagelimit);
	if( $this->_meta_count % $this->_pagelimit )
	  {
	    $npages++;
	    $this->_meta_npages = $npages;
	  }
	$this->_meta_curpage = 1;
      }
    return TRUE;
  }


  public function get_match_count()
  {
    if( $this->_meta_npages == 0 )
      {
	$res = $this->prepare();
	if( !$res ) return $res;
      }

    if( empty($this->_meta_count) ) return 0;
    return $this->_meta_count;
  }


  public function get_data($pagenum = '')
  {
    if( $this->_meta_npages == 0 )
      {
	$res = $this->prepare();
	if( !$res ) return $res;
      }
    if( empty($pagenum) )
      {
	$pagenum = $this->_meta_curpage;
      }

    global $gCms;
    $db = $gCms->GetDb();
    $pagenum = max(1,$pagenum);
    $pagenum = min(100000,$pagenum);
    
    $start = $this->_pagelimit * ($pagenum - 1);
    $dbr = $db->SelectLimit($this->_qrecs,$this->_pagelimit,$start,$this->_qparms);
    if( !$dbr )
      {
	// query failed
	return FALSE;
      }
    
    $res = array();
    while( $dbr && $row = $dbr->FetchRow() )
      {
	$res[] = $row;
      }
    $dbr->Close();
    $this->_meta_curpage = $pagenum + 1;
    return $res;
  }

} // class

?>