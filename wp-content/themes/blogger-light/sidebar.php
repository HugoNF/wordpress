<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogger-light
 */

if ( is_active_sidebar( 'footer-widget' ) ) {
	dynamic_sidebar( 'footer-widget' );

}

