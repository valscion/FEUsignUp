<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Skeleton (c) 2008 
#      by Robert Allen (akrabat) and
#         Robert Campbell (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow displaying calendars,
#  and management and display of time based events.
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

function calendar_AdminDisplayCategories(&$mod,$id,&$parameters,$returnid)
{
  $db =& $mod->GetDb(); /* @var $db ADOConnection */
  $categories = $mod->GetCategories();
  $num_cats = count($categories);

  echo $mod->CreateFormStart($id, 'admin_categories_update', $returnid, $method='post', $enctype='');
  echo '
      <table border=0 cellspacing=0 cellpadding=3>
      <tr>
      <th>'.$mod->Lang("name").'</th>
      <th>'.$mod->Lang("order").'</th>
      </tr>';

  $categories[$num_cats]['category_id'] = -1;
  $categories[$num_cats]['category_name'] = '';
  $categories[$num_cats]['category_order'] = 50;
  $num_cats ++;

  $num_cols = 2;
  $rows_per_col = intval($num_cats / $num_cols);

  $count = 1;
  for($i = 0; $i < $num_cats; $i++,$count ++)
    {
      if($i < $num_cats)
	{
	  $category = $categories[$i];
	  $category_id = $category['category_id'];
	  $category_name = (empty($category['category_name']) && $id > 0) ? '== NOT SET ==' : $category['category_name'];
	  $category_order = $category['category_order'];

	  echo '<tr><td>';
	  echo $mod->CreateInputHidden($id, 'category_ids[]', $category_id);
	  echo $mod->CreateInputText($id, 'category_names[]', $category_name, 25);
	  echo '</td><td>';
	  echo $mod->CreateInputText($id, 'category_orders[]', $category_order);
	  echo "</td></tr>\n";

	}
    }

  // submit button
  echo "<tr><td valign='top' colspan='2' align='center'>";
  echo $mod->CreateInputSubmit($id, '', $mod->Lang('cal_update_categories'));
  echo '</td></tr></table>';
  echo $mod->CreateFormEnd();
}


function calendar_AdminDeleteEvent(&$mod,$id,&$parameters,$returnid)
{
  $db 				   = &$mod->GetDb(); /* @var $db ADOConnection */
  $events_table_name               = $mod->events_table_name;
  $events_to_categories_table_name = $mod->events_to_categories_table_name;
  $event_field_values_table_name   = $mod->event_field_values_table_name;
  
  $event_id = get_parameter_value($parameters, 'event_id', -1);
  if( $event_id == -1 ) return;

  $query = 'SELECT * FROM '.$events_table_name.'
           WHERE event_id = ? OR event_parent_id = ?
          ORDER BY event_parent_id DESC';
  $rows = $db->GetArray($query,array($event_id,$event_id));
  
  $query1 = 'DELETE FROM '.$event_field_values_table_name.'
            WHERE event_id = ?';
  $query2 = 'DELETE FROM '.$events_to_categories_table_name.'
            WHERE event_id = ?';
  $query3 = 'DELETE FROM '.$events_table_name.'
            WHERE event_parent_id = ?';
  $query4 = 'DELETE FROM '.$events_table_name.'
            WHERE event_id = ?';
  foreach( $rows as $one )
    {
      $db->Execute($query1,array($one));
      $db->Execute($query2,array($one));
    }
  $db->Execute($query1,array($event_id));
  $db->Execute($query2,array($event_id));
  $db->Execute($query3,array($event_id));
  $db->Execute($query4,array($event_id));

  $mod->SendEvent('EventDeleted',array('event_id'=>$event_id));
}


function calendar_isValidFilename(&$mod,$filename)
{
  $file_name = trim ($filename);
  $extension = strtolower (strrchr ($file_name, "."));
  
  $valid_extensions = explode(',',$mod->GetPreference('uploadfiletypes','jpg,JPG,gif,GIF'));
  $count = count($valid_extensions);
  
  if( !$file_name ) return false;
  if( $count == 0 ) return true;
  foreach( $valid_extensions as $oneextension )
    {
      $fc = substr($oneextension, 0, 1);
      if( $fc != '.' )
	{
	  $oneextension = '.'.$oneextension;
	}
      if( $oneextension == $extension ) return true;
    }
  return false;
}

function calendar_HandleUpload(&$mod,$fldname,&$error)
{
  $config = cmsms()->GetConfig();
  $destDir = $mod->GetPreference('uploaddirectory',$config['uploads_path']);

  if( !isset($_FILES) || !isset($_FILES[$fldname]) || !$_FILES[$fldname]['name'] )
    {
      $error = $mod->Lang('error_noupload');
      return false;
    }

  $file =& $_FILES[$fldname];
  if( !isset($file['type']) ) $file['type'] = '';
  if( !isset($file['name']) ) $file['name'] = '';
  if( !isset($file['size']) ) $file['size'] = '';
  $file['name'] =
    preg_replace('/[^a-zA-Z0-9\.\$\%\'\`\-\@\{\}\~\!\#\(\)\&\_\^]/', '',
		 str_replace (array (' ', '%20'), array ('_', '_'), $file['name']));
  if( !$mod->isValidFilename( $file['name'] ) )
    {
      $error = $mod->Lang('error_invalidfilename');
      return false;
    }

  if( $file['error'] != 0 || $file['size'] == '' || $file['size'] == 0 )
    {
      print_r( $file );
      $error = $mod->Lang('error_problemwithupload');
      return false;
    }

  $destname = $file['name'];
  $destfilespec = cms_join_path( $destDir, $destname );
  if( file_exists( $destfilespec ) )
    {
      if( $mod->GetPreference('uploadunique',1) == 1 )
	{
	  $i = 0;
	  $destname = $i.'_'.$file['name'];
	  $destfilespec = cms_join_path( $destDir, $destname );
	  while( file_exists( $destfilespec ) && $i < 100 )
	    {
	      $i++;
	    }
	  if( $i == 100 ) 
	    {
	      $error = $mod->Lang('error_fileexists');
	      return false;
	    }
	}
      else
	{
	  $error = $mod->Lang('error_fileexists');
	  return false;
	}
    }

  if( !@copy($file['tmp_name'], $destfilespec) )
    {
      $error = $mod->Lang('error_filecopyfailed');
      return false;
    } else {
      /*//////////////////////////////////////////////////////////////
       //	Do image resizing
       /////////////////////////////////////////////////////////////*/
      calendar_resize_then_crop($destfilespec,cms_join_path( $destDir, 'thumb_'.$destname),$mod->GetPreference('thumb_width',180),$mod->GetPreference('thumb_height',180));
      calendar_resize_then_crop($destfilespec,cms_join_path( $destDir, 'large_'.$destname),$mod->GetPreference('large_width',500),$mod->GetPreference('large_height',500));
    }

  return $destname;
}

function calendar_resize_then_crop($filein,$fileout,$imagethumbsize_w,$imagethumbsize_h,$red=255,$green=255,$blue=255)
{
  // TODO: this should use imagemanager library
  // Get new dimensions

  list($width, $height) = getimagesize($filein);
  $new_width = $width * $percent;
  $new_height = $height * $percent;
  
  if(preg_match("/.jpg/i", "$filein")) $format = 'image/jpeg';
  if (preg_match("/.gif/i", "$filein")) $format = 'image/gif';
  if(preg_match("/.png/i", "$filein"))	$format = 'image/png';
  
  switch($format)
    {
    case 'image/jpeg':
      $image = imagecreatefromjpeg($filein);
      break;
      case 'image/gif';
      $image = imagecreatefromgif($filein);
      break;
    case 'image/png':
      $image = imagecreatefrompng($filein);
      break;
    }
  
  $width = $imagethumbsize_w ;
  $height = $imagethumbsize_h ;
  list($width_orig, $height_orig) = getimagesize($filein);
  
  if ($width_orig < $height_orig) 
    {
      $height = ($imagethumbsize_w / $width_orig) * $height_orig;
    }
  else
    {
      $width = ($imagethumbsize_h / $height_orig) * $width_orig;
    }
  
  if ($width < $imagethumbsize_w)
    //if the width is smaller than supplied thumbnail size 
    {
      $width = $imagethumbsize_w;
      $height = ($imagethumbsize_w/ $width_orig) * $height_orig;;
    }
  
  if ($height < $imagethumbsize_h)
    //if the height is smaller than supplied thumbnail size 
    {
      $height = $imagethumbsize_h;
      $width = ($imagethumbsize_h / $height_orig) * $width_orig;
    }
  
  $thumb = imagecreatetruecolor($width , $height);  
  $bgcolor = imagecolorallocate($thumb, $red, $green, $blue);  
  ImageFilledRectangle($thumb, 0, 0, $width, $height, $bgcolor);
  imagealphablending($thumb, true);
  
  imagecopyresampled($thumb, $image, 0, 0, 0, 0,
		     $width, $height, $width_orig, $height_orig);
  $thumb2 = imagecreatetruecolor($imagethumbsize_w , $imagethumbsize_h);
  // true color for best quality
  $bgcolor = imagecolorallocate($thumb2, $red, $green, $blue);  
  ImageFilledRectangle($thumb2, 0, 0,
		       $imagethumbsize_w , $imagethumbsize_h , $white);
  imagealphablending($thumb2, true);
  
  $w1 =($width/2) - ($imagethumbsize_w/2);
  $h1 = ($height/2) - ($imagethumbsize_h/2);
  
  imagecopyresampled($thumb2, $thumb, 0,0, $w1, $h1,
		     $imagethumbsize_w , $imagethumbsize_h ,$imagethumbsize_w, $imagethumbsize_h);
  
  if ($fileout !="")imagejpeg($thumb2, $fileout,90); //write to file
}
#
# EOF
#
?>