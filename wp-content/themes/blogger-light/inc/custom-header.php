<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package blogger-light
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses blogger_light_header_style()
 */
function blogger_light_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'blogger_light_custom_header_args', array(
		'video'					 => true,
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1920,
		'height'                 => 480,
		'flex-height'            => false,
		'wp-head-callback'       => 'blogger_light_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'blogger_light_custom_header_setup' );

if ( ! function_exists( 'blogger_light_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see blogger_light_custom_header_setup().
 */
function blogger_light_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;


// display video only if front page
add_filter( 'is_header_video_active', 'blogger_light_video_header_pages' );
function blogger_light_video_header_pages( $active ) {
	if( is_home() ) {
		return true;
	}

	return false;
}

// display video only on big viewports
add_filter( 'header_video_settings', 'blogger_light_header_video_settings');
function blogger_light_header_video_settings( $settings ) {
	$settings['minWidth'] = 680;
	$settings['minHeight'] = 400;
	return $settings;
}