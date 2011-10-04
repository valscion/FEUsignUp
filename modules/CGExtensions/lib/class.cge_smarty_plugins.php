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

final class cge_smarty_plugins
{
  protected function __construct() {}

  static private $_cge_cache_keys;
  static private $_cge_cache_keystack;

  /***
   * A smarty function for creating a list of state options
   */
  public static function smarty_function_cge_state_options($params,&$smarty)
  {
    $db = cmsms()->GetDb();
    $obj = cge_utils::get_module('CGExtensions');

    $query = 'SELECT * FROM '.CGEXTENSIONS_TABLE_STATES.' ORDER BY sorting DESC,name ASC';
    $tmp = $db->GetAll($query);
    $output = '';
    if( isset($params['selectone']) )
      {
	$output .= '<option value="">'.trim($params['selectone'])."</option>\n";
      }
    foreach( $tmp as $row )
      {
	$output .= "<option value=\"{$row['code']}\"";
	if( isset($params['selected']) && $params['selected'] == $row['code'] )
	  {
	    $output .= ' selected="selected"';
	  }
        $output .= ">{$row['name']}</option>\n";
      }
    return $output;
  }

  /***
   * A smarty function for creating a list of country options
   */
  public static function smarty_function_cge_country_options($params,&$smarty)
  {
    $db = cmsms()->GetDb();
    $obj = cge_utils::get_module('CGExtensions');

    $query = 'SELECT * FROM '.CGEXTENSIONS_TABLE_COUNTRIES.' ORDER BY sorting DESC,name ASC';
    $tmp = $db->GetAll($query);
    $output = '';
    if( isset($params['selectone']) )
      {
	$output .= '<option value="">'.trim($params['selectone'])."</option>\n";
      }
    foreach($tmp as $row)
      {
	$output .= "<option value=\"{$row['code']}\"";
	if( isset($params['selected']) && $params['selected'] == $row['code'] )
	  {
	    $output .= ' selected="selected"';
	  }
        $output .= ">{$row['name']}</option>\n";
      }
    return $output;
  }


  /*
   * A smarty plugin for displaying the current page url
   */
  public static function smarty_function_get_current_url($params, &$smarty)
  {
    $url = cge_url::current_url();
    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$url);
	return;
      }
    return $url;
  }


  /*
   * A smarty function to output a yes/no dropdown.
   */
  public static function smarty_function_cge_yesno_options($params,&$smarty)
  {
    $mod = cge_utils::get_module('CGExtensions');
    $name = '';
    $prefix = '';
    $selected = '';
    if( isset($params['prefix']) )
      {
	$prefix = trim($params['prefix']);
      }
    if( isset($params['name']) )
      {
	$name = trim($params['name']);
      }
    if( isset($params['selected']) )
      {
	$selected = trim($params['selected']);
      }

    $out = '';
    if( !empty($name) )
      {
	$out .= "<select name=\"{$prefix}{$name}\">";
      }

    $seltxt = '';
    if( $selected == 1 )
      {
	$seltxt = ' selected="selected"';
      }
    $out .= '<option value="1"'.$seltxt.'>'.$mod->Lang('yes').'</option>';
    $seltxt = '';
    if( $selected == 0 )
      {
	$seltxt = ' selected="selected"';
      }
    $out .= '<option value="0"'.$seltxt.'>'.$mod->Lang('no').'</option>';
    if( !empty($name) )
      {
	$out .= "</select>";
      }

    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$out);
	return;
      }
    return $out;
  }


  /*
   * A smarty plugin for testing if a module is available.
   */
  public static function smarty_function_have_module($params, &$smarty)
  {
    $name = '';
    $trythis = array('module','mod','m');
    foreach( $trythis as $one )
      {
	if( isset($params[$one]) )
	  {
	    $name = trim($params[$one]);
	    break;
	  }
      }
    if( empty($name) ) return;

    $tmp = cge_utils::get_module($name);
    $res = (is_object($tmp))?1:0;

    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$res);
	return;
      }
    return $res;
  }


  /*
   * A smarty function for displaying an image
   */
  public static function smarty_function_cgimage($params, &$smarty)
  {
    $obj = cge_utils::get_module('CGExtensions');
    
    if( !isset($params['image']) ) return;
    
    $alt = trim($params['image']);
    if( isset($params['alt']) )
      {
	$alt = trim($params['alt']);
      }
    $class = '';
    if( isset($params['class']) )
      {
	$class = trim($params['class']);
      }
    $height = '';
    if( isset($params['width']) )
      {
	$width = trim($params['width']);
      }
    $width = '';
    if( isset($params['height']) )
      {
	$height = trim($params['height']);
      }

    //$obj->_load_main();
    $txt = $obj->DisplayImage(trim($params['image']),$alt,$class,$width,$height);

    if( isset($params['assign']) )
      {
	$smarty->assign(trim($params['assign']),$txt);
      }
    else
      {
	return $txt;
      }
  }


  public static function smarty_modifier_rfc_date($string)
  {
    if( !function_exists('__make_timestamp') ) {
    function __make_timestamp($string)
    {
      if(empty($string)) {
        $time = time();

      } elseif (preg_match('/^\d{14}$/', $string)) {
        $time = mktime(substr($string, 8, 2),substr($string, 10, 2),substr($string, 12, 2),
                       substr($string, 4, 2),substr($string, 6, 2),substr($string, 0, 4));
        
      } elseif (is_numeric($string)) {
        $time = (int)$string;
        
      } else {
        $time = strtotime($string);
        if ($time == -1 || $time === false) {
	  // strtotime() was not able to parse $string, use "now":
	  $time = time();
        }
      }
      return $time;
    }
    }

    $timestamp = '';
    if( $string != '' )
      {
	$timestamp = __make_timestamp($string);
      }
    else
      {
	return;
      }

    $txt = date('r',$timestamp);
    return $txt;
  }


  public static function smarty_modifier_cge_entity_decode($string)
  {
    return html_entity_decode($string,ENT_QUOTES);
  }


  /*
   * A smarty block plugin for displaying an error using
   * a template.  i.e {error}blah blah blah{/error}
   *
   */
  public static function blockDisplayError($params,$content,&$smarty,$repeat)
  {
    $txt = '';
    if( trim($content) != '' )
      {
	$errorclass = 'error';
	if( isset( $params['errorclass'] ) )
	  {
	    $errorclass = trim($params['errorclass']);
	  }
	$obj = cge_utils::get_module('CGExtensions');
	$txt = $obj->DisplayErrorMessage($content,$errorclass);
      }
    
    if( isset( $params['assign'] ) )
      {
	$smarty->assign($params['assign'],$txt);
	return '';
      }
    return $txt;
  }


  public static function jsmin($params,$content,&$smarty,$repeat)
  {
    require_once(dirname(__FILE__).'/jsmin.php');
    $txt = '';
    if( $content != '' )
      {
	$txt = JSMin::minify($content);
      }

    if( isset( $params['assign'] ) )
      {
	$smarty->assign($params['assign'],$txt);
	return;
      }
    return $txt;
  }


  /**
   * A smarty plugin to provide a text area 
   */
  public static function smarty_function_cge_textarea($params, &$smarty)
  {
    $name = '';
    $wysiwyg = false;
    $content = '';
    $class= '';

    if( isset($params['prefix']) )
      {
	$name = trim($params['prefix']);
      }
    if( isset($params['name']) )
      {
	$name .= trim($params['name']);
      }

    if( isset($params['wysiwyg']) )
      {
	$wysiwyg = (int)$params['wysiwyg'];
      }

    if( isset($params['content']) )
      {
	$content = $params['content'];
      }

    if( isset($params['class']) )
      {
	$class = trim($params['class']);
      }

    if( $name == '' ) return;

    $output = create_textarea($wysiwyg,$content,$name,$class);

    if( isset($params['assign']) )
      {
	$smarty->assign(trim($params['assign']),$output);
	return;
      }
    return $output;
  }


  /*---------------------------------------------------------
   array_to_assoc
   ---------------------------------------------------------*/
  function smarty_function_str_to_assoc($params,&$smarty)
  {
    $input = '';
    $delim1 = ',';
    $delim2 = '=';
    if( isset($params['input']) ) $input = trim($params['input']);
    if( isset($params['delim1']) ) $delim1 = trim($params['delim1']);
    if( isset($params['delim2']) ) $delim2 = trim($params['delim2']);

    if( $input == '' ) return;
    $tmp = cge_array::explode_with_key($input,$delim2,$delim1);

    if( isset($params['assign']) )
      {
	$smarty->assign(trim($params['assign']),$tmp);
	return;
      }
    return $tmp;
  }


  public static function cache_start($tag_arg,&$smarty)
  { 
    if( !cms_cache_handler::can_cache() ) return '{';

    $tmp = debug_backtrace();
    $bt = array();
    foreach( $tmp as $elem )
      {
	$bt[] = $elem['file'].':'.$elem['line'];
      }

    if( !is_array(self::$_cge_cache_keys) )
      {
	self::$_cge_cache_keys = array();
	self::$_cge_cache_keystack = array();
      }
    $nn = '';
    while( $nn == '' || $nn < 100 )
      {
	$keyr = 'v'.md5(serialize($bt).cms_utils::get_current_pageid().cge_url::current_url());
	$key = $keyr.$nn;
	if( !in_array($key,self::$_cge_cache_keys) )
	  {
	    break;
	  }
	if( $nn == '' ) $nn = 1;
	$nn = $nn++;
      }

    if( $key == '' ) return '{';
    self::$_cge_cache_keys[] = $key;
    self::$_cge_cache_keystack[] = $key;

    $output = "\$$key=cms_cache_handler::get_instance()->get('$key','cge_cache'); if(\$$key!=''){echo '<!--cge_cache-->'.\$$key;}else{ob_start();";
    return $output;
  }


  public static function cache_end($tag_arg,&$smarty)
  {
    if( !cms_cache_handler::can_cache() ) return '}';

    if( !is_array(self::$_cge_cache_keystack) || count(self::$_cge_cache_keystack) == 0 )
      {
	throw new Exception('in /cge_cache smarty tag without existing cache data');
      }
    $key = array_pop(self::$_cge_cache_keystack);
    if( $key == '' )
      {
	throw new Exception('in /cge_cache with invalid key');
      }

    $output = "\$$key=@ob_get_contents();@ob_end_clean();echo \$$key;cms_cache_handler::get_instance()->set('$key',\$$key,'cge_cache');}";
    return $output;
  }


  public static function cge_array_set($params,&$smarty)
  {
    if( !(isset($params['array']) && isset($params['value'])) )
      {
	// no params, do nothing.
	return;
      }

    $arr = get_parameter_value($params,'array');
    $key = get_parameter_value($params,'key');
    $val = get_parameter_value($params,'value');

    if( $arr == '' || $val == '' ) return;

    $data = array();
    if( cge_tmpdata::exists($arr) )
      {
	$data = cge_tmpdata::get($arr);
      }
    if( !is_array($data) )
      {
	return;
      }
    if( $key )
      {
	$data[$key] = $val;
      }
    else
      {
	$data[] = $val;
      }
    cge_tmpdata::set($arr,$data);
  }


  public static function cge_array_pop($params,&$smarty)
  {
    if( !isset($params['array']) ) return;
    $arr = get_parameter_value($params,'array');
    if( !$arr ) return;

    if( !cge_tmpdata::exists($arr) )
      {
	return;
      }
    $data = cge_array::get($arr);
    if( !is_array($data) ) return;

    $ret = array_pop($data);
    cge_tmpdata::set($arr,$data);
    
    if( isset($params['assign']) )
      {
	$smarty->assign(trim($params['assign']),$ret);
	return;
      }

    return $ret;
  }


  public static function cge_array_erase($params,&$smarty)
  {
    if( !isset($params['array']) || !isset($params['key']) )
      {
	// no params, do nothing.
	return;
      }

    $arr = trim($params['array']);
    $key = trim($params['key']);
    if( $arr == '' || $key == '' ) return;
    if( !cge_tmpdata::exists($arr) ) return;

    $data = cge_tmpdata::get($arr);
    if( isset($data[$key]) ) unset($data[$key]);
    if( count(array_keys($data)) == 0 )
      {
	cge_tmpdata::erase($arr);
	return;
      }
    cge_tmpdata::set($arr,$data);
  }


  public static function cge_array_get($params,&$smarty)
  {
    if( !isset($params['array']) || !isset($params['key']) )
      {
	// no params, do nothing.
	return;
      }

    $arr = trim($params['array']);
    $key = trim($params['key']);
    if( $arr == '' || $key == '' ) return;
    if( !cge_tmpdata::exists($arr) ) return;

    $data = cge_tmpdata::get($arr);
    if( isset($data[$key]) ) 
      {
	$val = $data[$key];

	if( isset($params['assign']) )
	  {
	    $smarty->assign(trim($params['assign']),$val);
	    return;
	  }

	return $val;
      }
  }


  public static function cge_array_getall($params,&$smarty)
  {
    if( !isset($params['array']) )
      {
	// no params, do nothing.
	return;
      }

    $arr = trim($params['array']);
    if( $arr == '' ) return;
    if( !cge_tmpdata::exists($arr) ) return;
    $data = cge_tmpdata::get($arr);
    if( isset($params['assign']) )
      {
	$smarty->assign(trim($params['assign']),$data);
	return;
      }

    return $data;
  }


  public static function cge_admin_error($params,&$smarty)
  {
    global $CMS_ADMIN_PAGE;
    if( !isset($CMS_ADMIN_PAGE) ) return;

    if( !isset($params['error']) )
      {
	return;
      }

    $mod = cge_utils::get_module('CGExtensions');
    $tmp = $mod->ShowErrors($params['error']);
    
    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$tmp);
	return;
      }

    return $tmp;
  }


  public static function cge_isbot($params,&$smarty)
  {
    $browser = cge_utils::get_browser();
    $robot = $browser->isRobot();
    
    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$robot);
	return;
      }
    return $robot;
  }


  public static function cge_is_smartphone($params,&$smarty)
  {
    $browser = cge_utils::get_browser();
    $smartphone = $browser->isMobile();
    
    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$smartphone);
	return;
      }
    return $smartphone;
  }

}

#
# EOF
#
?>