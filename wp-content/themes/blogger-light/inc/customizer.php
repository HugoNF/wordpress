<?php
/**
 * blogger Theme Customizer
 *
 * @package blogger-light
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogger_light_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )			->transport 	= 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )			->transport 	= 'refresh';
	$wp_customize->get_setting( 'blogdescription' )		->transport 	= 'postMessage';
	$wp_customize->remove_control( 'header_textcolor' );

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title a',
		'render_callback' => 'blogger_light_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
		'render_callback' => 'blogger_light_customize_partial_blogdescription',
	) );
	
}
add_action( 'customize_register', 'blogger_light_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blogger_light_customize_preview_js() {
	wp_enqueue_script( '_s-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'blogger_light_customize_preview_js' );

/**
 * Add the theme configuration
 */
niteo_blogger_light_Kirki::add_config( 'niteo_blogger', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add Theme panel
 */
niteo_blogger_light_Kirki::add_panel( 'theme_panel', array(
	'title'      => esc_attr__( 'Theme Settings', 'blogger-light' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
) );


/**
 * Add log size to site Identity logo settings
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'slider',
	'settings'    => 'logo_size',
	'label'       => __( 'Set custom logo size', 'blogger-light' ),
	'description'       => __( 'Units in percent of original logo size', 'blogger-light' ),
	'section'     => 'title_tagline',
	'default'     => '100',
	'choices'     => array(
		'min'  => '10',
		'max'  => '100',
		'step' => '5',
	),
	'priority'    => 9,
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'element'  => '.custom-logo-link img',
			'function' => 'css',
			'property' => 'max-width',
			'units'	   => '%',
		),
	),
	'output' => array(
		array(
			'element' 	=> '.custom-logo-link img',
			'property' 	=> 'max-width',
			'units' 	=> '%',
		),
	),
) );


/**
 * Add Search option to menu locations settings
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'toggle',
	'settings'    => 'display_search',
	'label'       => __( 'Display Search field in Navigation Menu', 'blogger-light' ),
	'section'     => 'menu_locations',
	'default'     => '1',
	'priority'    => 10,
	'partial_refresh' => array(
		'display_search' => array(
			'selector'        => '.main-navigation form',
			'render_callback' => 'display_search',
		),
	),

) );


/**
 * Add color controls
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'color',
	'settings'    => 'text_color',
	'label'       => __( 'Text Color', 'blogger-light' ),
	'section'     => 'colors',
	'default'     => '#2a2a2a',
	'priority'    => 10,
	'choices'     => array(
		'alpha' => false,
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => 'html, body, a, a:visited, button, input, select, optgroup, textarea, input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea',
			'property' => 'color',
		),
		array(
			'element' => '.slicknav_menu .slicknav_icon-bar',
			'property' => 'background-color',
		),


	),
) );

niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'color',
	'settings'    => 'active_color',
	'label'       => __( 'Active Color', 'blogger-light' ),
	'section'     => 'colors',
	'default'     => '#00a28d',
	'priority'    => 20,
	'choices'     => array(
		'alpha' => false,
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => 	'.button,
							.background-color-true .share-container a,
							.page-numbers.current,
							button,
							input[type="button"],
							input[type="reset"],
							input[type="submit"],
							.type-post:not(.multi-columns) .entry-footer.background-color-true,
							.sticky-post .entry-meta p:nth-of-type(2) a::after,
							.go-top',
			'property' => 'background-color',
		),

		array(
			'element' => 'a:not(.button):not(.site-link):hover, .entry-content a:not(.button), blockquote p::before, .comment-reply a, input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea:focus, .entry-title a:hover, .related-posts a:hover h3, .main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a, .main-navigation .current-menu-ancestor > a, .post-categories a, .entry-meta a:hover, .zoom-instagram-widget__item a::before, .product-cat.selected, .sticky-posts-wrapper .slick-arrow',
			'property' => 'color',
		),

		array(
			'element' => 'input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea:focus, #search-overlay .input-search' ,
			'property' => 'border-color',
		),

		array(
			'element' 	=> '.g--circle, .hover-effect path',
			'property' 	=> 'fill'
		),

		array(
			'element' 	=> '#secondary .widget h3',
			'property' 	=> 'border-color'
		),

		array(
			'element' 		=> '.main-navigation .sub-menu',
			'property' 		=> 'border-top',
			'value_pattern'	=> '2px solid $',
		)
	),
) );


niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'color',
	'settings'    => 'branding_color',
	'label'       => __( 'Site Branding Color', 'blogger-light' ),
	'section'     => 'colors',
	'default'     => '#2a2a2a',
	'priority'    => 30,
	'choices'     => array(
		'alpha' => false,
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => '.site-branding a, .site-branding p',
			'property' => 'color',
		),

	),
) );

niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'color',
	'settings'    => 'hero_overlay_color',
	'label'       => __( 'Header Hero Overlay', 'blogger-light' ),
	'section'     => 'colors',
	'default'     => 'rgba(0,0,0,0)',
	'priority'    => 30,
	'choices'     => array(
		'alpha' => true,
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => '.header-featured::before, .video-banner::before',
			'property' => 'background-color',
		),
	),
) );

niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'color',
	'settings'    => 'footer_bg_color',
	'label'       => __( 'Footer Background', 'blogger-light' ),
	'section'     => 'colors',
	'default'     => '#333333',
	'priority'    => 40,
	'choices'     => array(
		'alpha' => false,
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => '.site-footer',
			'property' => 'background-color',
		),
	),
) );

niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'color',
	'settings'    => 'footer_text_color',
	'label'       => __( 'Footer Text Color', 'blogger-light' ),
	'section'     => 'colors',
	'default'     => '#ffffff',
	'priority'    => 50,
	'choices'     => array(
		'alpha' => false,
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => '.site-footer *, .site-footer a',
			'property' => 'color',
		),
	),
) );

/**
 * Add post footer color switch
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'toggle',
	'settings'    => 'posts_footer_colored',
	'label'       => __( 'Posts footer background color', 'blogger-light' ),
	'description' => __('Applies Active color to posts footer as a background color.', 'blogger-light'),
	'section'     => 'colors',
	'default'     => '1',
	'priority'    => 60,
	'transport'		=> 'postMessage',
	'js_vars'   => array(
		array(
			'element'  		=> '.type-post .entry-footer',
			'function' 		=> 'html',
			'attr' 			=> 'class',
			'value_pattern'	=> 'entry-footer background-color-$',
		),
	),

) );


/**
 * Add the typography section
 */
niteo_blogger_light_Kirki::add_section( 'typography', array(
	'title'      => esc_attr__( 'Theme Typography', 'blogger-light' ),
	'priority'   => 62,
	'capability' => 'edit_theme_options',
	'panel'		=> 'theme_panel'
) );

/**
 * Add the menu-typography control
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'typography',
	'settings'    => 'menu_typography',
	'label'       => esc_attr__( 'Menu Typography', 'blogger-light' ),
	'description' => esc_attr__( 'Select the typography options for your navigation menu.', 'blogger-light' ),
	'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for navigation menu on your site.', 'blogger-light' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Maven Pro',
		'variant'        => '400',
		'font-size'      => '14px',
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => array( '.main-navigation a', '.main-navigation button, .slicknav_nav a, .slicknav_nav button' ),
		),
	),
) );


/**
 * Add the body-typography control
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'typography',
	'settings'    => 'body_typography',
	'label'       => esc_attr__( 'Body Typography', 'blogger-light' ),
	'description' => esc_attr__( 'Select the main typography options for your site.', 'blogger-light' ),
	'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'blogger-light' ),
	'section'     => 'typography',
	'priority'    => 20,
	'default'     => array(
		'font-family'    => 'Maven Pro',
		'variant'        => '400',
		'font-size'      => '15px',
		'line-height'    => '1.5',
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => 'html, body, button, input, select, optgroup, textarea',
		),
	),
) );

/**
 * Add the body-typography control
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'typography',
	'settings'    => 'headers_typography',
	'label'       => esc_attr__( 'Headings Typography', 'blogger-light' ),
	'description' => esc_attr__( 'Select the typography options for your headings tags.', 'blogger-light' ),
	'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headings on your site (post titles, widget titles etc).', 'blogger-light' ),
	'section'     => 'typography',
	'priority'    => 30,
	'default'     => array(
		'font-family'    => 'Montserrat',
		'variant'        => '500',
		'letter-spacing' => '0',
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6' ),
		),
	),
) );


/**
 * Add the Theme Functions section
 */
niteo_blogger_light_Kirki::add_section( 'theme_functions', array(
	'title'      => esc_attr__( 'Theme Functions', 'blogger-light' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'		=> 'theme_panel'
) );

/**
 * Add back top icon switch
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'switch',
	'settings'    => 'backtop',
	'label'       => __( 'Display Back to Top Icon after scrolling', 'blogger-light' ),
	'section'     => 'theme_functions',
	'default'     => '1',
	'priority'    => 20,
	'choices'     => array(
		'on'  => esc_attr__( 'Display Icon', 'blogger-light' ),
		'off' => esc_attr__( 'Hide Icon', 'blogger-light' ),
	),

) );

/**
 * Add the Theme Layout section
 */
niteo_blogger_light_Kirki::add_section( 'theme_layout', array(
	'title'      => esc_attr__( 'Theme Layout', 'blogger-light' ),
	'priority'   => 61,
	'capability' => 'edit_theme_options',
	'panel'		=> 'theme_panel'
) );


niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'			=> 'slider',
	'settings'		=> 'blog_width',
	'label'			=> __( 'Content width', 'blogger-light' ),
	'description'	=> esc_attr__( 'Value is in CSS pixels. Do not forget to regenerate thumbnails to fit the image size correctly. We suggest Regenerate Thumbnails plugin from WordPress plugins repository.', 'blogger-light' ),
	'help'			=> esc_attr__( 'We recommend to regenerate your image library after blog width change to display all images correctly. You can use any plugin such as Regenerate Thumbnails>', 'blogger-light' ),
	'section'		=> 'theme_layout',	
	'default'		=> '1140',
	'choices'		=> array(
		'min'  => '720',
		'max'  => '1920',
		'step' => '10',
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '.main-navigation, .site-content, .footer-content, #footer-widgets .textwidget, .footer-widgets.columns',
			'property' => 'width',
			'units'    => 'px',
		),
	),
	'priority'		=> 10,
) );

/**
 * Add custom width menu switch
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'toggle',
	'settings'    => 'menu_full_width',
	'label'       => __( 'Full Width Menu', 'blogger-light' ),
	'description' => esc_attr__( 'If you want full width Menu, you can set it here.', 'blogger-light' ),
	'section'     => 'theme_layout',
	'default'     => 'off',
	'transport'		=> 'postMessage',
	'js_vars'   => array(
		array(
			'element'  		=> '.main-navigation',
			'function' 		=> 'html',
			'attr' 			=> 'class',
			'value_pattern'	=> 'main-navigation full-width-$',
		),
	),
	'priority'    => 11,

) );


niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'			=> 'radio',
	'settings'		=> 'layout',
	'label'			=> __( 'Layout', 'blogger-light' ),
	'description'	=> esc_attr__( 'Choose layout for displaying posts.', 'blogger-light' ),
	'section'		=> 'theme_layout',	
	'default'		=> 'full',
	'choices'		=> array(
		'full'  => esc_attr__( 'One Column (full post content)', 'blogger-light' ),
		'columns-2'  => esc_attr__( 'Two Columns (featured image + title only)', 'blogger-light' ),
	),
	'priority'		=> 20,
) );

niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'			=> 'radio',
	'settings'		=> 'logo_location',
	'label'			=> __( 'Site Branding Location', 'blogger-light' ),
	'description'	=> esc_attr__( 'Choose where to display Site Branding including Logo - must have enabled Image/Video header.', 'blogger-light' ),
	'section'		=> 'theme_layout',	
	'default'		=> 'logo-below-hero',
	'choices'		=> array(
		'logo-over-hero'  	=> esc_attr__( 'Header Image Overlay', 'blogger-light' ),
		'logo-below-hero'  	=> esc_attr__( 'Below Header Image', 'blogger-light' ),
	),
	'priority'		=> 30,
) );


niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'			=> 'radio',
	'settings'		=> 'sidebar',
	'label'			=> __( 'Sidebar', 'blogger-light' ),
	'description'	=> esc_attr__( 'Choose side for displaying Sidebar.', 'blogger-light' ),
	'section'		=> 'theme_layout',	
	'default'		=> 'left',
	'choices'		=> array(
		'disabled'  	=> esc_attr__( 'Disabled', 'blogger-light' ),
		'left'  		=> esc_attr__( 'Left Side', 'blogger-light' ),
		'right'  		=> esc_attr__( 'Right Side', 'blogger-light' ),
	),
	'output' => array(
		array(
			'element'  => '.sidebar-widget',
			'property' => 'float',
		),
	),
	'priority'		=> 40,
) );

/**
 * Enable / disable borders
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'toggle',
	'settings'    => 'borderless_design',
	'label'       => __( 'Borderless layout', 'blogger-light' ),
	'description' => __('Removes 1px border from all main elements (sidebar, post, ..)', 'blogger-light'),
	'section'     => 'theme_layout',
	'default'     => '0',
	'priority'    => 50,

) );


/**
 * Add the Theme Footer section
 */
niteo_blogger_light_Kirki::add_section( 'theme_footer', array(
	'title'      => esc_attr__( 'Theme Footer', 'blogger-light' ),
	'priority'   => 70,
	'capability' => 'edit_theme_options',
	'panel'		=> 'theme_panel'
) );



/**
 * Add back to top option to footers
 */
niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'toggle',
	'settings'    => 'back_to_top',
	'label'       => __( 'Display Back to Top arrow in Footer area', 'blogger-light' ),
	'section'     => 'theme_footer',
	'default'     => '1',
	'priority'    => 10,
	'partial_refresh' => array(
		'display_back_to_top' => array(
			'selector'        => '.footer-content .back-top-wrapper',
			'render_callback' => 'blogger_light_render_backtop',
		),
	),

) );

niteo_blogger_light_Kirki::add_field( 'niteo_blogger', array(
	'type'        => 'text',
	'settings'    => 'back_top_text',
	'label'       => __( 'Back to Top text', 'blogger-light' ),
	'section'     => 'theme_footer',
	'default'     => 'Back to Top',
	'priority'    => 20,
	'active_callback'    => array(
		array(
			'setting'  => 'back_to_top',
			'operator' => '==',
			'value'    => true,
		),
	),
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'element'  => '#back-to-top span',
			'function' => 'html',
		),

	)
) );


/**
 * Partial refresh functions to return HTML
 *
 * @return void
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blogger_light_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blogger_light_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the Back to Top for the selective refresh partial.
 *
 * @return void
 */
function blogger_light_render_backtop() {

	if ( get_theme_mod('back_to_top', true) ) { ?>
		<a id="back-to-top" href="#"><span><?php echo esc_html( get_theme_mod('back_top_text', 'Back to top') );?></span><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></a>
		<?php 
	} 
}

/**
 * Render Search form for selective refresh partial
 *
 * @return void
 */
function display_search() {
	if ( get_theme_mod('display_search', true) ) {
		return get_search_form();
	}
}