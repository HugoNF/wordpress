<?php
add_action( 'wp_enqueue_scripts', 'certify_theme_css',999);
function certify_theme_css() {
    wp_enqueue_style( 'certify-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('bootstrap', ST_TEMPLATE_DIR . '/css/bootstrap.css');
	wp_enqueue_style('certify-child-style',get_stylesheet_directory_uri() . '/style.css',array('parent-style'));
	wp_enqueue_style('certify-theme-menu-style', get_stylesheet_directory_uri().'/css/theme-menu.css');
	wp_enqueue_style('certify-default-style-css', get_stylesheet_directory_uri()."/css/default.css" );
	wp_enqueue_style('certify-media-responsive-css', get_stylesheet_directory_uri()."/css/media-responsive.css" );
	wp_enqueue_script('certify-menu-js', get_stylesheet_directory_uri() . '/js/menu/menu.js');
}



if ( ! function_exists( 'certify_theme_setup' ) ) :

function certify_theme_setup() {

//Load text domain for translation-ready
load_theme_textdomain( 'certify', get_stylesheet_directory() . '/languages' );

require( get_stylesheet_directory() . '/functions/certify-info/welcome-screen.php' );
require( get_stylesheet_directory() . '/functions/customizer/customizer_general_settings.php' );

}
endif; 
add_action( 'after_setup_theme', 'certify_theme_setup' );

/**
 * Import options from SpicePress
 *
 */
function certify_get_lite_options() {
	$spicepress_mods = get_option( 'theme_mods_spicepress' );
	if ( ! empty( $spicepress_mods ) ) {
		foreach ( $spicepress_mods as $spicepress_mod_k => $spicepress_mod_v ) {
			set_theme_mod( $spicepress_mod_k, $spicepress_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'certify_get_lite_options' );


add_action( 'admin_init', 'certify_detect_button' );
	function certify_detect_button() {
	wp_enqueue_style('certify-info-button', get_stylesheet_directory_uri().'/css/import-button.css');
}