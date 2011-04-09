<?php

class cms_filecache_driver extends cms_cache_driver
{
  private static $_instance;
  private $_key;
  private $_group;
  private $_lifetime = 300;
  private $_locking = false;
  private $_cache_dir = '/tmp';
  private $_auto_cleaning = 0;

  protected function __fork() {}

  public function __construct($opts)
  {
    if( is_object(self::$_instance) )
      throw new Exception('Instance of cms_filecache_driver already exists');
    self::$_instance = $this;

    $_keys = array('lifetime','locking','cache_dir','auto_cleaning');
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
    $fn = $this->_get_filename($key,$group);
    $data = $this->_read_cache_file($fn);
    return $data;
  }


  public function clear($group = '')
  {
    if( !$group ) $group = 'default';

    return $this->_clean_dir($this->_cache_dir,$group,false,true);
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
    $this->_auto_clean_files();
    $res = $this->_write_cache_file($fn,$value);
    return $res;
  }


  private function _get_filename($key,$group)
  {
    $fn = $this->_cache_dir . '/dcache_'.md5($group).'_'.md5($key).'.cg';
    return $fn;
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
	    if( $this->_locking ) @flock($fp,LOCK_SH);
	    $len = @filesize($fn);
	    if( $len > 0 ) $data = fread($fp,$len);
	    if( $this->_locking ) @flock($fp,LOCK_UN);
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
    $fp = @fopen($fn,'wb');
    if( $fp )
      {
	if( $this->_locking ) @flock($fp,LOCK_EX);
	if( is_array($data) || is_object($data) )
	  {
	    $data = '__SERIALIZED__'.serialize($data);
	  }
	@fwrite($fp,$data);
	if( $this->_locking ) @flock($fp,LOCK_UN);
	@fclose($fp);
	return TRUE;
      }
    return FALSE;
  }


  private function _auto_clean_files()
  {
    if( $this->_auto_cleaning > 0 && ($this->_auto_cleaning == 1 || mt_rand(1,$this->_auto_cleaning) == 1) )
      {
	return $this->_clean_dir($this->_cache_dir,'','old');
      }
  }


  private function _clean_dir($dir,$group = '',$old = true,$ingroup = true)
  {
    if( !$group ) $group = 'default';
    
    $mask = $dir.'/dcache_'.md5($group).'_*.cg';
    if( !$ingroup )
      {
	$mask = $dir.'/dcache_*_*.cg';
      }
    
    $files = glob($mask);
    if( !is_array($files) ) return TRUE;

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
  }
}

?>