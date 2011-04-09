<?php

abstract class friendly
{
  private $_friends;

  protected function __construct()
  {
    $this->add_friend(get_class($this));
  }

  protected function is_friendly()
  {
    $class = 'unknown';
    if( is_array($this->_friends) ) 
      {
	$trace = debug_backtrace();
	if( isset($trace[2]['class']) ) $class = $trace[2]['class'];
	if( $class && in_array($class,$this->_friends) )
	  {
	    return;
	  }
      }

    throw new Exception('-- Access to invalid function from class ('.$class.')');
  }


  protected function add_friend($classname)
  {
    $tmp = explode(',',$classname);
    if( !is_array($tmp) ) return;

    if( !is_array($this->_friends) )
      {
	$this->_friends = array();
      }

    foreach( $tmp  as $one )
      {
	$this->_friends[] = $one;
      }
  }
} // end of class

?>