<?php

class cge_units
{
  const INCHES_TO_CM = 2.54;
  const CM_TO_INCHES = 0.393700787;
  const LBS_TO_KG    = 0.45359237;
  const KG_TO_LBS    = 2.20462262;

  public static function is_length_metric($str)
  {
    $str = strtolower($str);
    if( $str == 'cm' ) return TRUE;
    return FALSE;
  }

  public static function is_weight_metric($str)
  {
    $str = strtolower($str);
    if( $str == 'kg' || $str == 'kgs' ) return TRUE;
    return FALSE;
  }
}

?>