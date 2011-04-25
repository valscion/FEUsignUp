<?php
if (!isset($gCms)) exit;

/* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

   Output for FEUsignUp adminpanel tab "overview"

   -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
   
*/

echo '<p>Hello world! Here\'s the "overview" tab ;)</p>';

if( isset( $params['extracontent'] ) && !empty( $params['extracontent'] ) ) {
  $extra_arr = explode( '|', $params['extracontent'] );
  echo '<ul>';
  foreach( $extra_arr as $p ) {
    echo "<li>$p</li>";
  }
  echo '</ul>';
}

## EOF