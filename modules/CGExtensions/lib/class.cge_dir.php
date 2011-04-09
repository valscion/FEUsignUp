<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGExtensions (c) 2008 by Robert Campbell 
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

class cge_dir
{
  /**
   * Recursively remove a directory
   * an alias for recursive_remove_directory
   *
   */
  public static function recursive_rmdir($directory)
  {
    return self::recursive_remove_directory($directory);
  }


  /**
   * Recursively remove a directory
   */
  public static function recursive_remove_directory($directory)
  {
    if(substr($directory,-1) == '/')
      {
	$directory = substr($directory,0,-1);
      }
    if(!file_exists($directory) || !is_dir($directory))
      {
	return FALSE;
      }
    elseif(is_readable($directory))
      {
	$handle = opendir($directory);
	while (FALSE !== ($item = readdir($handle)))
	  {
	    if($item != '.' && $item != '..')
	      {
		$path = $directory.'/'.$item;
		if(is_dir($path)) 
		  {
		    self::recursive_remove_directory($path);
		  }else{
		  unlink($path);
		}
	      }
	  }
	closedir($handle);
	if(!rmdir($directory))
	  {
	    return FALSE;
	  }
      }
    return TRUE;
  }

  
  /**
   * Return a list of all of the directories inside a parent 
   */
  static public function dir_list($parent)
    {
      if( empty($parent) ) return false;
      if( !is_dir($parent) ) return false;

      $dh = opendir($parent);
      if( !$dh ) return false;

      $results = array();
      while( ($file = readdir($dh)) !== false )
	{
	  if( $file == '.' || $file == '..' ) continue;
	  if( startswith($file,'.') ) continue;
	  if( is_dir($parent.'/'.$file) )
	    {
	      $results[] = $file;
	    }
	}
      closedir($dh);

      if( count($results) == 0 ) return false;
      return $results;
    }


  /**
   * A function to return a list of all files in a directory that match
   * a regular expression 
   */
  public static function file_list_regexp($dir,$regexp,$limit=1000000)
  {
    if( empty($dir) ) return false;
    if( !is_dir($dir) ) return false;

    $dh = opendir($dir);
    if( !$dh ) return false;

    $results = array();
    while( ($file = readdir($dh)) !== false && count($results) < $limit  )
      {
	if( $file == '.' || $file == '..' ) continue;
	if( preg_match( '/'.$regexp.'/', $file ) )
	  {
	    $results[] = $file;
	  }
      }
    closedir($dh);

    if( count($results) == 0 ) return false;
    return $results;
  }


  /*---------------------------------------------------------
   mkdirr( $pathname, $mode )
   NOT PART OF THE MODULE API

   Make a directory recursively
   ---------------------------------------------------------*/
  public static function mkdirr ($pathname, $mode = 0777)
  {
    // Check if directory already exists
    if (is_dir ($pathname) || empty ($pathname))
      {
	return true;
      }

    // Ensure a file does not already exist with the same name
    if (is_file ($pathname))
      {
	// RC: Modification such that this isn't an error
	return true;
      }

    // Crawl up the directory tree
    $next_pathname =
      substr ($pathname, 0, strrpos ($pathname, DIRECTORY_SEPARATOR));
    if (self::mkdirr ($next_pathname, $mode))
      {
	if (!file_exists ($pathname))
	  {
	    return mkdir ($pathname, $mode);
	  }
      }

    return false;
  }


  public static function get_file_list($dir,$extensions)
  {
    $config = cmsms()->GetConfig();

    $filetypes = array();
    if( !empty($extensions) )
      {
	$filetypes = explode(',',strtolower($extensions));
      }

    $files = array();
    $dh = opendir( $dir );
    if( $dh )
      {
	while (false !== ($file = readdir($dh))) {
	  if( $file == '.' || $file == '..' ) continue;
	  
	  $fullpath = cms_join_path($dir,$file);
	  if( is_dir( $fullpath ) ) continue;

	  $ext = substr(strrchr($file, '.'), 1);
	  if( count($filetypes) > 0 && !in_array( $ext, $filetypes ) ) continue;

	  $files[$file] = $file;
	}
	closedir($dh);
      }

    return $files;
  }


  public static function file_matches_pattern($filename,$pattern)
  {
    if( !is_array($pattern) )
      {
	$pattern = array($pattern);
      }
    for( $i = 0; $i < count($pattern); $i++ )
      {
	if( fnmatch($pattern[$i],$filename) )
	  {
	    return TRUE;
	  }
      }
    return FALSE;
  }


  public static function recursive_glob($path,$pattern,$mode = 'FULL',$excludepattern = '',$maxdepth = -1, $d = 0)
  {    
    if( !endswith($path,'/') ) $path .= '/';
    $dirlist = array();
    if( $mode != 'FILES' ) 
      {
	if( self::file_matches_pattern(basename($file),$pattern) &&
	    !self::file_matches_pattern(basename($file),$excludepattern) )
	  {
	    $dirlist[] = $path;
	  }
      }

    if( $handle = opendir($path) )
      {
	while( false !== ( $file = readdir($handle) ) )
	  {
	    if( $file == '.' || $file == '..' ) continue;

	    $fs = $path . $file;
	    if ( ! @is_dir($fs) ) 
	      {  
		if( $mode != "DIRS" && self::file_matches_pattern($file,$pattern) )
		  { 
		    if( !self::file_matches_pattern($file,$excludepattern) )
		      {
			$dirlist[] = $fs; 
		      }
		  }
	      }
	    elseif( $d >= 0 && ($d < $maxdepth || $maxdepth < 0) )
	      {
		$tmp = self::recursive_glob( $fs.'/', $pattern, $mode, $excludepattern, $maxdepth, $d+1 );
		$dirlist = array_merge( $dirlist, $tmp );
	      }
	  }
	closedir( $handle );
      }
    return $dirlist;
  }
} // end of class

#
# EOF
#
?>