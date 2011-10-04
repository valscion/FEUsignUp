<?php

class cms_filecache_driver extends cms_cache_driver
{
  private static $_instance;
  private $_key;
  private $_group;
  private $_lifetime = 300;
  private $_locking = false;
  private $_blocking = false;
  private $_cache_dir = '/tmp';
  private $_auto_cleaning = 0;

  protected function __fork() {}

  public function __construct($opts)
  {
    if( is_object(self::$_instance) )
      throw new Exception('Instance of cms_filecache_driver already exists');
    self::$_instance = $this;

    $_keys = array('lifetime','locking','cache_dir','auto_cleaning','blocking');
    if( is_array($opts) )
      {
	foreach( $opts as $key => $value )
	  {
	    if( in_array($key,$_keys) )
	      {
		$tmp = '_'.$key;
		$this->$tmp = $value;
	      }
	  }
      }
  }


  public function get($key,$group = '')
  {
    if( !$group ) $group = 'default';

    $this->_key = $key;
    $this->_group = $group;
    $this->_auto_clean_files();
    $fn = $this->_get_filename($key,$group);
    $data = $this->_read_cache_file($fn);
    return $data;
  }


  public function clear($group = '')
  {
    return $this->_clean_dir($this->_cache_dir,$group,false);
  }


  public function exists($key,$group = '')
  {
    if( !$group ) $group = 'default';

    $fn = $this->_get_filename($key,$group);
    clearstatcache();
    if( @file_exists($fn) )
      {
	return TRUE;
      }
    return FALSE;
  }


  public function erase($key,$group = '')
  {
    if( !$group ) $group = 'default';

    $fn = $this->_get_filename($key,$group);
    if( @file_exists($fn) )
      {
	@unlink($fn);
	return TRUE;
      }
    return FALSE;
  }


  public function set($key,$value,$group = '')
  {
    if( !$group ) $group = 'default';

    $fn = $this->_get_filename($key,$group);
    $res = $this->_write_cache_file($fn,$value);
    return $res;
  }


  private function _get_filename($key,$group)
  {
    $fn = $this->_cache_dir . '/dcache_'.md5($group).'_'.md5($key).'.cg';
    return $fn;
  }


  private function _flock($res,$flag)
  {
    if( !$this->_locking ) return TRUE;

    $mode = '';
    switch( strtolower($flag) )
      {
      case 'read':
	$mode = LOCK_SH;
	break;

      case 'write':
	$mode = LOCK_EX;
	break;

      case 'unlock':
	$mode = LOCK_UN;
      }
      
    if( $this->_blocking )
      {
	return flock($res,$mode);
      }

    // non blocking lock
    $mode = $mode | LOCK_NB;
    for( $n = 0; $n < 5; $n++ )
      {
	$res = flock($res,$mode);
	if( $res ) return TRUE;
	$tl = rand(1,300);
	usleep($tl);
      }
    return FALSE;
  }

  private function _read_cache_file($fn)
  {
    $this->_cleanup($fn);
    $data = null;
    if( @file_exists($fn) )
      {
	clearstatcache();
	$fp = @fopen($fn,'rb');
	if( $fp )
	  {
	    if( $this->_flock($fp,'read') )
	      {
		$len = @filesize($fn);
		if( $len > 0 ) $data = fread($fp,$len);
		$this->_flock($fp,'unlock');
	      }
	    @fclose($fp);

	    if( startswith($data,'__SERIALIZED__') )
	      {
		$data = unserialize(substr($data,strlen('__SERIALIZED__')));
	      }
	    return $data;
	  }
      }
  }


  private function _cleanup($fn)
  {
    if( is_null($this->_lifetime) ) return;
    clearstatcache();
    $filemtime = @filemtime($fn);
    if( $filemtime < time() - $this->_lifetime )
      {
	@unlink($fn);
      }
  }


  private function _write_cache_file($fn,$data)
  {
    @touch($fn);
    $fp = @fopen($fn,'r+');
    if( $fp )
      {
	if( !$this->_flock($fp,'write') )
	  {
	    @fclose($fp);
	    @unlink($fn);
	    return FALSE;
	  }
	else
	  {
	    if( is_array($data) || is_object($data) )
	      {
		$data = '__SERIALIZED__'.serialize($data);
	      }
	    @fwrite($fp,$data);
	    $this->_flock($fp,'unlock');
	  }
	@fclose($fp);
	return TRUE;
      }
    return FALSE;
  }


  private function _auto_clean_files()
  {
    if( $this->_auto_cleaning > 0 && ($this->_auto_cleaning == 1 || mt_rand(1,$this->_auto_cleaning) == 1) )
      {
	return $this->_clean_dir($this->_cache_dir);
      }
    return 0;
  }


  private function _clean_dir($dir,$group = '',$old = true)
  {
    $mask = $dir.'/dcache_*_*.cg';
    //$mask = $dir.'/dcache_*.cg';
    if( $group ) 
      {
	$mask = $dir.'/dcache_'.md5($group).'_*.cg';
      }
    
    $files = glob($mask);
    if( !is_array($files) ) return 0;

    $nremoved = 0;
    foreach( $files as $file )
      {
	if( is_file($file) )
	  {
	    $del = false;
	    if( $old == true )
	      {
		if( !is_null($this->_lifetime) )
		  {
		    if( (time() - @filemtime($file)) > $this->_lifetime )
		      {
			@unlink($file);
			$nremoved++;
		      }
		  }
	      }
	    else
	      {
		@unlink($file);
		$nremoved++;
	      }
	  }
      }

    return $nremoved;
  }
}

?>