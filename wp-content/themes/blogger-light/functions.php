<?php
/**
 * blogger functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blogger-light
 */

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogger_light_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blogger_light_content_width', blogger_light_get_content_width() );
}
add_action( 'after_setup_theme', 'blogger_light_content_width', 0 );



if ( ! function_exists( 'blogger_light_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blogger_light_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on blogger, use a find and replace
	 * to change 'blogger-light' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blogger-light', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// register nav menus
	register_nav_menus( array(
		'primary-menu' => esc_html__( 'Primary Menu', 'blogger-light' ),
		'social-menu-header' => esc_html__( 'Social Menu - header', 'blogger-light' ),
		'social-menu-footer' => esc_html__( 'Social Menu - footer', 'blogger-light' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	$args = array(
		'default-color' => 'efefef',
		'default-image' => '',
	);
	add_theme_support( 'custom-background', $args );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 500,
		'width'       => 500,
		'flex-width'  => true,
		'flex-height' => true,
	) );


	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	// add_theme_support( 'post-formats', array(
	// 	'image',
	// 	'video',
	// ) );
	/*
	 * Register custom Thumbnail Image sizes
	 */

	// register image size for content width
    add_image_size( 'blogger-light-content_width_size', $GLOBALS['content_width'] ); 
	// register image size for sticky posts width
    add_image_size( 'blogger-light-sticky_posts_size', get_theme_mod('blog_width', 1140), get_theme_mod('blog_width', 1140) * 0.5625, array( 'center', 'center' ) ); 
    // register image size for header media
    add_image_size( 'blogger-light-fullhd_hero_size', '1920', '480', array( 'center', 'center' ) ); 

    // register image size for header media
    add_image_size( 'blogger-light-fullhd_size', '1920', '1080' ); 

}
endif;
add_action( 'after_setup_theme', 'blogger_light_setup' );

// Register custom image sizes for use in Add Media modal
add_filter( 'image_size_names_choose', 'blogger_light_custom_sizes' );

function blogger_light_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'blogger-light-content_width_size' 	=> __( 'Content Full Width Image', 'blogger-light' ),
        'blogger-light-fullhd_size' 			=> __( 'Full HD Image for Gallery', 'blogger-light' ),
        'blogger-light-fullhd_hero_size' 		=> __( 'Hero Image', 'blogger-light' ),
        'blogger-light-sticky_posts_size' 	=> __( 'Sticky Posts Featured Image', 'blogger-light' ),
    ) );
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogger_light_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blogger-light' ),
		'id'            => 'sidebar-widget',
		'description'   => esc_html__( 'Add widgets here.', 'blogger-light' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Full Width Widgets', 'blogger-light' ),
		'id'            => 'footer-widget',
		'description'   => esc_html__( 'Add widgets here.', 'blogger-light' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}


add_action( 'widgets_init', 'blogger_light_widgets_init' );

/**
 * Render Customizer CSS for wp_add_inline_style
 */
function blogger_light_customizer_css() {

	$background_color = get_background_color();
	$menu_typo = get_theme_mod( 'menu_typography', array() );

	$menu_fontsize = ( isset($menu_typo['font-size']) ) ? $menu_typo['font-size'] : '14px';

	ob_start();

	if ( get_theme_mod('active_color') ) { ?>
		button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.button:hover,.background-color-true .share-container a:hover,.background-color-true .tags-links a:hover,.background-color-true .comments-link a:hover {background-color: <?php echo esc_attr( hex2hsl( get_theme_mod('active_color'), 15 ) );?>;}
		<?php
	}
	if ( !display_header_text() ) { ?>
		.site-title {font-size: 1em;}
		<?php 
	} 
	if ( is_active_sidebar( 'sidebar-widget' ) ) {

		$float = ( get_theme_mod('sidebar', 'left') == 'left' ) ? 'right' : 'left';
		$float = ( get_theme_mod('sidebar', 'left') == 'disabled' ) ? 'none' : $float;
		$float  = ( basename( get_page_template() ) == 'template-full-width.php' ) ? 'none' : $float;
		?>
		#primary {float: <?php echo esc_attr( $float );?>;}
		<?php

	} ?>
	.sidebar-widget, .type-post:not(.sticky-post), .type-page, .page-header.search, .related-container, .comments-area, .sticky-posts-wrapper  { border: <?php echo ( get_theme_mod('borderless_design', 0) == 1 ) ? 'none' : '1px solid '.esc_attr(hex2hsl( $background_color, 7));?>;}
	.main-nav-container { border-bottom: 1px solid <?php echo esc_attr(hex2hsl( $background_color, 7));?>}
	.main-navigation .sub-menu { border-bottom: 1px solid <?php echo esc_attr(hex2hsl( $background_color, 7));?>;border-left: 1px solid <?php echo esc_attr(hex2hsl( $background_color, 7));?>;border-right: 1px solid <?php echo esc_attr(hex2hsl( $background_color, 7));?>}
	.menu-search i { border-left: 1px solid <?php echo esc_attr(hex2hsl( $background_color, 7));?>}
	.main-menu-container {border-color: <?php echo esc_attr(hex2hsl( $background_color, 7));?>;}
	.site-header.sticky{padding-top: calc(<?php echo esc_attr($menu_fontsize);?> * 3.1);}
	input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea {border: 1px solid <?php echo esc_attr(hex2hsl( $background_color, 7));?>;}
	
	@media only screen and (max-width : <?php echo esc_attr( get_theme_mod('blog_width', 1140) );?>px) {
		.site-content,.main-navigation,.footer-content,#footer-widgets .textwidget {padding: 0 10px;}
	}
	::-webkit-input-placeholder {
	    color: <?php echo esc_attr( hex2hsl(get_theme_mod('text_color'), -30) );?>
	}
	.entry-meta, .entry-meta a, .site-description, .not-found p:first-of-type, .main-navigation .menu-item-has-children::after {
	    color: <?php echo ( get_theme_mod('text_color') ) ? esc_attr( hex2hsl(get_theme_mod('text_color'), -30) ) : '#777777'; ?>
	}
	
	<?php

	$css = ob_get_clean();

	return $css;
}


/**
 * Enqueue scripts and styles.
 */
function blogger_light_scripts() {
	// get theme version
	$theme = wp_get_theme();
	// get body typo for google fonts loading
	$body_typo = get_theme_mod( 'body_typography', array() );
	$body_family = ( isset($body_typo['font-family']) ) ? $body_typo['font-family'] : 'Maven+Pro';

	wp_enqueue_style( 'blogger-light-master-style', get_stylesheet_uri(), array(), $theme->get( 'Version' ) , 'all' );

	wp_add_inline_style( 'blogger-light-master-style', wp_kses( blogger_light_customizer_css(), array( "\'", '\"' ) ) );

	wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/css/slicknav.min.css', array(), '1.0.10' , 'all' );

	// FONT AWESOME
	wp_enqueue_style( 'font_awesome', get_template_directory_uri() . '/css/fontawesome/css/font-awesome.min.css', array(), '4.7' , 'all' );
	
	// Google Font
	wp_register_style( 'google-fonts', '//fonts.googleapis.com/css?family='.esc_attr($body_family).':400,400i,700,700i' );
	wp_enqueue_style( 'google-fonts' );

	wp_enqueue_script( 'blogger-main-js', get_template_directory_uri() . '/js/main.js', array('jquery', 'imagesloaded', 'in-viewport', 'slicknav', 'imagelightbox'), $theme->get( 'Version' ), true );

	wp_enqueue_script('imagesloaded');

	wp_enqueue_script('masonry');

	wp_enqueue_script( 'blogger-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'responsive-video', get_template_directory_uri() . '/js/responsive-video.js', array(), '20151215', true );

	wp_enqueue_script( 'in-viewport', get_template_directory_uri() . '/js/jquery.isinviewport.js', array('jquery'), '1.0.3', true );

	wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/js/min/jquery.slicknav.min.js', array('jquery'), '1.0.10', true );

	wp_enqueue_script( 'blogger-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	$sticky = get_option( 'sticky_posts' );

	if ( count( $sticky ) > 1 ) {
		wp_enqueue_script( 'slick-slider', get_template_directory_uri(). '/js/min/slick.min.js', array(), '1.9.0', true );
		wp_enqueue_style( 'slick-slider', get_template_directory_uri() . '/css/slick-slider.css', array(), '1.9.0' , 'all' );
	}
	
	wp_register_script( 'imagelightbox', get_template_directory_uri(). '/js/min/jquery.imagelightbox.min.js', array('jquery'), '1.0', true );

	if ( is_singular() && comments_open()  ) {

		// Register the script
		wp_register_script( 'blogger-comments', get_template_directory_uri() . '/js/blogger-comments.js', array(), $theme->get( 'Version' ), true );
		 
		// Localize the script with new data
		$translation_array = array(
		    's1' => __( 'Processing...', 'blogger-light' ),
		    's2' => __( 'You are posting too quickly, slow down a bit.', 'blogger-light' ),
		    's3' => __( 'Thanks for your comment. Reloading Page to display your comment...', 'blogger-light' ),
		);
		wp_localize_script( 'blogger-comments', 'translation', $translation_array );
		 
		wp_enqueue_script( 'blogger-comments' );
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_front_page() && ( function_exists('has_header_video') && has_header_video() ) ) {
		wp_enqueue_script( 'vidim', get_template_directory_uri() . '/js/min/vidim.min.js', array(), '1.0.1', true );
	}

	if ( is_front_page() && ( function_exists('has_header_video') && has_header_video() ) ) {
		wp_enqueue_script( 'vidim', get_template_directory_uri() . '/js/min/vidim.min.js', array(), '1.0.1', true );
	}
}
add_action( 'wp_enqueue_scripts', 'blogger_light_scripts' );

// Enqueue script for custom header image when in posts/pages edit mode
if ( !function_exists('blogger_light_admin_styles') ) {
  	function blogger_light_admin_styles() {
		global $pagenow;

		if ( $pagenow == 'post.php' ) {
			wp_enqueue_media();
			// Registers and enqueues the required javascript.
			wp_register_script( 'blogger-meta-box-image', get_template_directory_uri() .'/js/blogger-enq-media.js', array() );
			wp_localize_script( 'blogger-meta-box-image', 'meta_image',
				array(
					'title' => __( 'Choose or Upload Media', 'blogger-light' ),
					'button' => __( 'Use this media', 'blogger-light' ),
				)
			);
			wp_enqueue_script( 'blogger-meta-box-image' );
		}


  	}
}
add_action( 'admin_enqueue_scripts', 'blogger_light_admin_styles' );


// Setup actions when GET activated
if ( isset( $_GET['activated'] ) && is_admin( ) ) {

}


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Recommend the Kirki plugin
 */
require get_template_directory() . '/inc/include-kirki.php';

/**
 * Load the Kirki Fallback class
 */
require get_template_directory() . '/inc/kirki-fallback.php';

/**
 * Include upsell message for PRO version in customizer
 */
require get_template_directory() . '/inc/include-upsell.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Admin notice
 */
require get_template_directory() . '/inc/admin-notice/persist-admin-notices-dismissal.php';

/**
 * Welcome page
 */
require get_template_directory() . '/inc/theme-welcome.php';

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/plugins/TGMPA/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'blogger_light_tgm_plugins' );
function blogger_light_tgm_plugins() {
  	/*
   	* Array of plugin arrays. Required keys are name and slug.
   	* If the source is NOT from the .org repo, then source is also required.
   	*/
  	$plugins = array(
	    array(
	      	'name'      => __('CMP - Coming Soon & Maintenance by NiteoThemes', 'blogger-light'),
	      	'slug'      => 'cmp-coming-soon-maintenance',
	      	'required'  => false,
	    ),
	    array(
	      	'name'      => __('Kirki - Rich Customizer options', 'blogger-light'),
	      	'slug'      => 'kirki',
      		'required'  => false,
    	),
	    array(
	      	'name'      => __('Instagram Widget by WPZOOM', 'blogger-light'),
	      	'slug'      => 'instagram-widget-by-wpzoom',
      		'required'  => false,
    	),

	);

	/*
	* Array of configuration settings. Amend each line as needed.
	*/
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

/*
* Theme support for One Click Import
*/
function ocdi_import_files() {

	return array(
		array(
		  'import_file_name'             => 'Blogger Demo',
		  'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/blogger-free-demo-08-06-2018.xml',
		  'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/blogger-free-demo-08-06-2018.wie',
		  'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/blogger-free-demo-08-06-2018.dat',
		  'import_notice'                => __( 'We recommend to activate all required and recommended plugins. If you are using Instagram Widget, you need to set it up manually after demo import.', 'blogger-light' ),
		),
	);


}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );


/*
* Assign menus to it`s location after demo import
*/
function blogger_light_after_import( $selected_import ) {
 
    //Set Menu
    $primary_menu = get_term_by('name', 'Navigation Menu', 'nav_menu');
    $social_menu = get_term_by('name', 'Social Menu', 'nav_menu');

	$locations['primary-menu'] = $primary_menu->term_id;
	$locations['social-menu-header'] = $social_menu->term_id;
	$locations['social-menu-footer'] = $social_menu->term_id;

	set_theme_mod( 'nav_menu_locations', $locations );

    // update WP to to show posts as default
    update_option( 'show_on_front', 'posts' );
        
}
	
add_action( 'pt-ocdi/after_import', 'blogger_light_after_import' );

function ocdi_plugin_intro_text( $default_text ) {
    $default_text = '<div class="ocdi__intro-notice  notice  notice-warning  is-dismissible"><p>' . __('Before you begin, make sure all the required plugins are activated.', 'blogger-light') . '</p></div>';

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'ocdi_plugin_intro_text' );


// disable PT OCDI Branding
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/**
 * Admin Notices
 */
function blogger_light_welcome_admin_notice() {
	if ( ! PAnD::is_admin_notice_active( 'blogger-welcome-forever' ) ) {
		return;
	}
	
	?>
	<div data-dismissible="blogger-welcome-forever" class="blogger-admin-notice updated notice notice-success is-dismissible">

		<p><?php echo sprintf( __( 'Welcome to Blogger theme by NiteoThemes. For best experience visit our <a href="%s">welcome page</a>.', 'blogger-light' ), admin_url( 'themes.php?page=blogger-welcome.php' ) ); ?></p>
		<a class="button" href="<?php echo admin_url( 'themes.php?page=blogger-welcome.php' ); ?>"><?php esc_html_e( 'Get started with Blogger', 'blogger-light' ); ?></a>

	</div>
	<?php
}

add_action( 'admin_init', array( 'PAnD', 'init' ) );
add_action( 'admin_notices', 'blogger_light_welcome_admin_notice' );

