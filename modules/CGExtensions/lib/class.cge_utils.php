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

class cge_utils
{
  private static function &_get_cge()
  {
    return self::get_module('CGExtensions');
  }


  public static function db_time($unixtime,$trim = true)
  {
    $db = cmsms()->GetDb();
    $tmp = $db->DbTimeStamp($unixtime);
    if( $trim )
      {
	$tmp = trim($tmp,"'");
      }
    return $tmp;
  }


  public static function unix_time($string)
  {
    // snarfed from smarty.
    $string = trim($string);
    $time = '';
    if(empty($string)) {
      // use "now":
      $time = time();

    } elseif (preg_match('/^\d{14}$/', $string)) {
      // it is mysql timestamp format of YYYYMMDDHHMMSS?
      $time = mktime(substr($string, 8, 2),substr($string, 10, 2),substr($string, 12, 2),
		     substr($string, 4, 2),substr($string, 6, 2),substr($string, 0, 4));

    } elseif (preg_match("/(\d{4})-(\d{2})-(\d{2})\s(\d{2}):(\d{2}):(\d{2})/", $string, $dt)) {
      $time = mktime($dt[4],$dt[5],$dt[6],$dt[2],$dt[3],$dt[1]);
    } elseif (is_numeric($string)) {
      // it is a numeric string, we handle it as timestamp
      $time = (int)$string;

    } else {
      // strtotime should handle it
      $time = strtotime($string);
      if ($time == -1 || $time === false) {
	// strtotime() was not able to parse $string, use "now":
	// but try one more thing
	list($p1,$p2) = explode(' ',$string,2);
	
	$db = cmsms()->GetDb();
	$time = $db->UnixTimeStamp($string);
	if( !$time )
	  {
	    $time = time();
	  }
      }
    }

    return $time;
  }

  public static function get_image_extensions()
  {
    $cge = self::_get_cge();
    return $cge->GetPreference('imageextensions');
  }

  
  public static function &get_module($module_name = '',$version = '',$op = '')
  {
    if( empty($module_name) && cge_tmpdata::exists('module') )
      {
	$module_name = cge_tmpdata::get('module');
      }

    return cms_utils::get_module($module_name,$version);
  }


  public static function &get_cge()
  {
    return self::get_module('CGExtensions');
  }


  public static function get_mime_type($filename)
  {
    if( version_compare(phpversion(),'5.3','ge') && function_exists('finfo_open') )
      {
	$fh = finfo_open(FILEINFO_MIME_TYPE);
	$mime_type = finfo_file($fh,$filename);
	finfo_close($fh);
      }
    else if( function_exists('mime_content_type') )
      {
	$mime_type = mime_content_type($filename);
        if( !$mime_type )
        {
          // begin crude and ugly hack for windoze machines.
          $ext = substr($filename,strrpos($filename,'.'));
          if( $ext ) $ext = strtolower(substr($ext,1));
          switch( $ext )
          {
            case 'jpg':
            case 'png':
            case 'gif':
            case 'bmp':
             $mime_type = "image/$ext";
             break;
            case 'jpeg': 
             $mime_type = "image/jpg";
             break;
          }
        }
      }

    return $mime_type;
  }


  public static function send_data_and_exit($data,$content_type = 'text/plain',$filename = 'report.txt')
  {
    $handlers = ob_list_handlers(); 
    for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private',false);
    header('Content-Description: File Transfer');
    header('Content-Type: '.$content_type);
    header("Content-Disposition: attachment; filename=\"$filename\"" );
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . count($data));

    // send the data
    print($data);

    // don't allow any further processing.
    exit();
  }


  public static function send_file_and_exit($file,$chunksize = 65535,$mime_type = '',$filename = '')
  {
    if( !file_exists($file) )
      {
	return false;
      }

    if( empty($mime_type) )
      {
	$mime_type = self::get_mime_type($file);
	if( $mime_type == 'unknown' )
	  {
	    $mime_type = 'application/octet-stream';
	  }
      }

    if( empty($filename) )
      {
	$filename = $file;
      }
    $filename = basename($filename);

    $handlers = ob_list_handlers(); 
    for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private',false);
    header('Content-Description: File Transfer');
    header('Content-Type: '.$mime_type);
    header("Content-Disposition: attachment; filename=\"$filename\"" );
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file));

    $handle=fopen($file,'rb');
    $contents = '';
    do {
      $data = fread($handle,$chunksize);
      if( strlen($data) == 0 ) break;
      print($data); 
    } while(true);
    fclose($handle);
    
    // don't allow any more processing
    exit();
  }


  public static function get_real_ip()
  {
    $ip = null;
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

  public static function to_bool($in,$strict = FALSE)
  {
    $in = strtolower($in);
    if( in_array($in,array('1','y','yes','true','t','on')) )
      return TRUE;
    if( in_array($in,array('0','n','no','false','f','off')) )
      return FALSE;
    if( $strict )
      {
	return null;
      }
    return ($in?TRUE:FALSE);
  }


  // see Browser.php
  public static function get_browser()
  {
    static $_browser = null;

    if( $_browser == null )
      {
	$_browser = new cge_browser();
      }
    return $_browser;
  }


  public static function fgets($fh)
  {
    if( !$fh || !is_resource($fh) ) return;
    $pos1 = ftell($fh);
    
    $line = fgets($fh);
    if( strpos($line,"\r") === FALSE )
      {
	return $line;
      }
    
    // line is probably a crappy mac line.
    $len1 = strlen($line);
    $pos = strpos($line,"\r");
    
    $line = substr($line,0,$pos);
    fseek($fh,($len1 - $pos -1 ) * -1,SEEK_CUR);
    return $line;    
  }


  public function coalesce()
  {
    $args = func_get_args();
    if( !is_array($args) || count($args) == 0 ) return;

    for( $i = 0; $i < count($args); $i++ )
      {
	if( $args[$i] ) return $args[$i];
      }
  }
} // class

#
# EOF
#
?>
