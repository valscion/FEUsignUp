<?php

final class cge_tmpdata 
{
  private static $_data;

  private static function _setup()
  {
    if( !is_array(self::$_data) )
      {
	self::$_data = array();
      }
  }

  public static function exists($key)
  {
    if( empty($key) ) return FALSE;
    if( !is_array(self::$_data) ) return FALSE;
    if( !isset(self::$_data[$key]) ) return FALSE;
    return TRUE;
  }

  public static function get($key)
  {
    if( self::exists($key) )
      {
	return self::$_data[$key];
      }
  }

  public static function set($key,$value)
  {
    if( !empty($key) )
      {
	self::_setup();
	self::$_data[$key] = $value;
      }
  }

  public static function erase($key)
  {
    if( self::exists($key) )
      {
	unset(self::$_data[$key]);
      }
  }
} // end of class

#
# EOF
#
?>