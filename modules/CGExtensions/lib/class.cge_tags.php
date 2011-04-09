<?php

class cge_tags
{
  public static function img_tag($params)
  {
    $image = get_parameter_value($params,'image');
    $alt = get_parameter_value($params,'alt',$image);
    $class = get_parameter_value($params,'class');
    $rel = get_parameter_value($params,'rel');
    $width = get_parameter_value($params,'width');
    $height = get_parameter_value($params,'height');
    $id = get_parameter_value($params,'id');

    $output .= '<img src="'.$image.'" alt="'.$alt.'"';
    if( $id ) $output .= ' id="'.$id.'"';
    if( $class ) $output .= ' class="'.$class.'"';
    if( $rel ) $output .= ' rel="'.$rel.'"';
    if( $width ) $output .= ' width="'.$width.'"';
    if( $height ) $output .= ' height="'.$height.'"';
    $output .= '/>';
    return $output;
  }

  public static function link_tag($params)
  {
    $url = get_parameter_value($params,'url');
    $text = get_parameter_value($params,'text',$url);
    $linkclass = get_parameter_value($params,'linkclass');

    // build the tag.
    $output = '<a href="'.$url.'" title="'.$text.'"';
    if( $linkclass ) $output .= ' class="'.$linkclass.'"';
    $output .= '>';
    if( isset($params['image']) ) 
      {
	if( isset($params['imgclass']) )
	  {
	    $params['class'] = $imgclass;
	  }
	$params['alt'] = $text;
	$output .= self::img_tag($params);
      }
    else
      {
	$output .= $text;
      }
    $output .= '</a>';
    return $output;
  }
} // end of class

?>