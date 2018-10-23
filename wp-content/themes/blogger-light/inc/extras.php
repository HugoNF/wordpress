<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 *
 * @package blogger-light
 */

// helper function object to array
if ( !function_exists( 'objectToArray' ) ) {
  function objectToArray( $object ) {
    if( !is_object( $object ) && !is_array( $object ) )
    {
      return $object;
    }
    if( is_object( $object ) )
    {
      $object = get_object_vars( $object );
    }
    return array_map( 'objectToArray', $object );
  }
}

// get attachment details
if ( !function_exists( 'wp_get_attachment' ) ) {
  function wp_get_attachment( $attachment_id ) {
  	$attachment = get_post( $attachment_id );
  	return array(
  		'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
  		'caption'     => $attachment->post_excerpt,
  		'description' => $attachment->post_content,
  		'href'        => get_permalink( $attachment->ID ),
  		'src'         => $attachment->guid,
  		'title'       => $attachment->post_title
  	);
  }
}

// detect mobile browser
if ( !function_exists( 'isMobile' ) ) {
  function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
  }
}

// convert hex to rgba
if ( !function_exists( 'hex2rgba' ) ) {
  function hex2rgba ( $hex, $opacity ) {
    $hex = (substr($hex, 0, 1) === '#') ? $hex : '#'.$hex;
    list( $red, $green, $blue ) = sscanf( $hex, '#%02x%02x%02x' );
    if ( $opacity == '1' ) {
      $rgba = 'rgb(' . $red . ',' . $green . ',' . $blue . ')'; 
    } else {
      $rgba = 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $opacity.')'; 
    }
    return $rgba;
  }
}

// convert hex to hsl css
if ( !function_exists( 'hex2hsl' ) ) {
  function hex2hsl( $hex, $opacity ) {

      $hex = (substr($hex, 0, 1) === '#') ? $hex : '#'.$hex;

      list( $red, $green, $blue ) = sscanf( $hex, '#%02x%02x%02x' );

      $r = $red / 255.0;
      $g = $green / 255.0;
      $b = $blue / 255.0;
      $H = 0;
      $S = 0;
      $V = 0;

      $min = min( $r, $g, $b );
      $max = max( $r, $g, $b );
      $delta = ( $max - $min );

      $L = ( $max + $min ) / 2.0;

      if( $delta == 0 ) {
          $H = 0;
          $S = 0;
      } else {
          $S = $L > 0.5 ? $delta / ( 2 - $max - $min ) : $delta / ( $max + $min );

          $dR = ( ( ( $max - $r ) / 6) + ( $delta / 2  ) ) / $delta;
          $dG = ( ( ( $max - $g ) / 6) + ( $delta / 2  ) ) / $delta;
          $dB = ( ( ( $max - $b ) / 6) + ( $delta / 2  ) ) / $delta;

          if ( $r == $max )
              $H = $dB - $dG;
          else if( $g == $max )
              $H = ( 1/3 ) + $dR - $dB;
          else
              $H = ( 2/3 ) + $dG - $dR;

          if ( $H < 0 )
              $H += 1;
          if ( $H > 1 )
              $H -= 1;
      }
      $HSL = array( 'hue' => round( ($H*360), 0 ), 'saturation'=> round( ($S*100), 0 ), 'luminosity' => round( ( $L*100 ), 0) );
      $HSL = 'hsl( '. $HSL['hue'] .', '.( $HSL['saturation']) .'%, '. ( $HSL['luminosity'] - $opacity ) . '%)';
      return $HSL;
  }
}

