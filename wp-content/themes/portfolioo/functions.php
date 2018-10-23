<?php
/**
 * portfolioo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package portfolioo
 */

if ( ! function_exists( 'portfolioo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function portfolioo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on portfolioo, use a find and replace
	 * to change 'portfolioo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'portfolioo', get_template_directory() . '/languages' );

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

	/*Allows to link a custom stylesheet file to the TinyMCE visual editor.*/
	add_editor_style();

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'portfolioo' ),
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

	/*
	 * Enable support for custom-logo
	 */	add_theme_support( 'custom-logo', array(
	    'flex-width' => false,
	    'height'     => 50,
   	  	'width'      => 50,
	) );

	/*
	 * Enable selective customizer refresh
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'portfolioo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif;
add_action( 'after_setup_theme', 'portfolioo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function portfolioo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'portfolioo_content_width', 640 );
}
add_action( 'after_setup_theme', 'portfolioo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function portfolioo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'portfolioo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'portfolioo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget', 'portfolioo' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add footer widgets here.', 'portfolioo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage', 'portfolioo' ),
		'id'            => 'frontpage-1',
		'description'   => esc_html__( 'Add widgets here.', 'portfolioo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'portfolioo_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function portfolioo_scripts() {
	wp_enqueue_style( 'portfolioo-style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'portfolioo-sidr', get_template_directory_uri() . '/js/sidr.js', array(), '0.0.1', true );
	wp_enqueue_script( 'portfolioo-jquery', get_template_directory_uri() . '/js/portfolioo.js', array(), '0.0.1', true );
	wp_enqueue_style('portfolioo-fontawesome',get_template_directory_uri().'/assets/fonts/font-awesome.css', array(), '4.7.0' );
	wp_enqueue_script( 'portfolioo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'portfolioo_scripts' );


//google font enqueue
function portfolioo_google_fonts() {
	$query_args = array(
		'family' => 'Raleway:300,400|Source+Sans:300,600,latin-ext',
	);
	wp_enqueue_style( 'portfolioo_google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
    }
            
add_action('wp_enqueue_scripts', 'portfolioo_google_fonts'); 


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 */
function portfolioo_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'portfolioo' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'portfolioo_excerpt_more' );



/**
 * Frontpage widgets
 */
require get_template_directory() . '/inc/widgets/front-intro-one.php';
require get_template_directory() . '/inc/widgets/front-portfolio-two.php';
require get_template_directory() . '/inc/widgets/front-service-three.php';
require get_template_directory() . '/inc/widgets/front-contact-two.php';
require get_template_directory() . '/inc/widgets/front-blog.php';
require get_template_directory() . '/inc/defaults.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer/customizer-function.php';


/**
 * Theme activation redirector
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/dashboard/portfolioo-info-dashboard.php');


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load theme upsell
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/trt-customize-pro/example-1/class-customize.php' );




