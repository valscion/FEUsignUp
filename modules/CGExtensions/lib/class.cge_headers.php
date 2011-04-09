<?php

class cge_headers
{
  private static $_headers;

  public static function have_headers()
  {
    return is_array(self::$_headers);
  }

  public static function add_header($header)
  {
    if( !is_array(self::$_headers) )
      {
	self::$_headers = array();
      }

    self::$_headers[] = $header;
  }

  public static function output_headers()
  {
    if( !is_array(self::$_headers) ) return;

    foreach( self::$_headers as $value )
      {
	header($value);
      }
  }

} // end of class

?>