<?php

class cms_cache_handler
{
  const TYPE_ANY = 0;
  const TYPE_PAGE = 1;
  const TYPE_CONTENT = 2;
  const TYPE_MODULE = 3;
  const TYPE_TEMPLATE = 4;
  const TYPE_STYLESHEET = 5;

  static private $_instance;
  private $_driver;

  private function __construct() {}
  private function __clone() {}

  final public static function get_instance()
  {
    if( !is_object(self::$_instance) )
      {
	self::$_instance = new cms_cache_handler;
      }
    return self::$_instance;
  }

  final public function set_driver(cms_cache_driver& $driver)
  {
    $this->_driver = $driver;
  }

  final public function get_driver()
  {
    return $this->_driver;
  }

  final public function clear($group = '')
  {
    if( !$this->can_cache() ) return FALSE;

    if( is_object($this->_driver) )
      {
	return $this->_driver->clear();
      }
    return FALSE;
  }

  final public function get($key,$group = '')
  {
    if( !$this->can_cache() ) return FALSE;

    if( is_object($this->_driver) )
      {
	return $this->_driver->get($key,$group);
      }
    return FALSE;
  }

  final public function exists($key,$goup = '')
  {
    if( !$this->can_cache() ) return FALSE;
    if( is_object($this->_driver) )
      {
	return $this->_driver->exists($key,$group);
      }
    return FALSE;
  }

  final public function erase($key,$group = '')
  {
    if( !$this->can_cache() ) return FALSE;
    if( is_object($this->_driver) )
      {
	return $this->_driver->erase($key,$group);
      }
    return FALSE;
  }

  final public function set($key,$value,$group = '')
  {
    if( !$this->can_cache() ) return FALSE;
    if( is_object($this->_driver) )
      {
	return $this->_driver->set($key,$value,$group);
      }
    return FALSE;
  }


  final public static function can_cache($type = 0)
  {
    return TRUE;
    $type == (int)$type;
    global $CMS_ADMIN_PAGE;
    global $CMS_INSTALL_PAGE;
    global $CMS_MODULE_PAGE;
    global $CMS_STYLESHEET;

    if( isset($CMS_INSTALL_PAGE) ) return FALSE;
    if( isset($CMS_ADMIN_PAGE) ) return FALSE;
    if( isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' ) return FALSE;

    $config = cmsms()->GetConfig();
    if( isset($config['debug']) && $config['debug'] == true ) return FALSE;

    $global_caching = get_site_preference('global_caching',0);
    if( !$global_caching ) return FALSE;
    die('so far can cache');

    $uid = get_userid(false);
    if( $uid )
      {
	$user_caching = get_preference($uid,'user_caching',0);
	if( !$user_caching ) return FALSE;
      }
    
    switch( $type )
      {
      case self::TYPE_PAGE:
	return get_site_preference('page_caching',0);
	
      case self::TYPE_STYLESHEET:
	return get_site_preference('stylesheet_caching',0);

      case self::TYPE_TEMPLATE:
	return get_site_preference('template_caching',0);

      case self::TYPE_CONTENT:
      case self::TYPE_MODULE:
	return FALSE;

      case self::TYPE_ANY:
	return TRUE;

      default:
	return FALSE;
      }
    return TRUE;
  }
}

?>