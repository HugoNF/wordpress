<?php global $portfolioo;
/**
 * portfolioo Theme Customizer
 *
 * @package portfolioo
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function portfolioo_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	// Moving default sections
	//$wp_customize->get_section('nav_menus')->panel = 'header';
	$wp_customize->get_section('header_image')->panel = 'header';
	$wp_customize->get_section('title_tagline')->panel = 'header';
	$wp_customize->get_section('static_front_page')->panel = 'frontpage';
	$wp_customize->get_section('background_image')->panel = 'basic_settings';

	//$wp_customize->get_control('header_textcolor')->section = 'header_section';
	//$wp_customize->get_control('background_color')->section = 'svgbg_section';
	$wp_customize->get_control('background_color')->priority = 20;

	// Abort if selective refresh is not available.
    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }


    // Panel
	$wp_customize->add_panel( 'header', array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Header', 'portfolioo' ),
            'description' => esc_html__( 'This panel allows you to customize Header', 'portfolioo' ),
    	)
    );

    $wp_customize->add_panel( 'frontpage', array(
            'priority' => 11,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Frontpage', 'portfolioo' ),
            'description' => esc_html__( 'This panel allows you to customize Frontpage', 'portfolioo' ),
    	)
    );

    $wp_customize->add_panel( 'basic_settings', array(
            'priority' => 9,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Basic Site Settings', 'portfolioo' ),
            'description' => esc_html__( 'This panel allows you to customize site settings', 'portfolioo' ),
    	)
    );


    $wp_customize->add_panel( 'footer', array(
            'priority' => 13,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Footer', 'portfolioo' ),
            'description' => esc_html__( 'This panel allows you to customize Footer', 'portfolioo' ),
    	)
    );


    // custom content class
      if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'portfolioo_Custom_Content' ) ) :
			class portfolioo_Custom_Content extends WP_Customize_Control {
				 // Whitelist content parameter
				 public $content = '';
				 /**
				 * Render the control's content.
				 *
				 * Allows the content to be overriden without having to rewrite the wrapper.
				 *
				 * @since   1.0.0
				 * @return  void
				 */
				 public function render_content() {
				 if ( isset( $this->label ) ) {
					 echo '<span class="customize-control-title">' . $this->label . '</span>';
				 }
				 if ( isset( $this->content ) ) {
					 echo $this->content;
				 }
				 if ( isset( $this->description ) ) {
				 	 echo '<span class="description customize-control-description">' . $this->description . '</span>';
				 }
			   }
			}
		endif;



	// Header Section
	$wp_customize->add_section( 'header_section' , array(
		    'title'      => esc_html__('Header Colors','portfolioo'), 
		    'panel'      => 'header',
		    'capability'     => 'edit_theme_options',
		    'priority'   => 10   
		)
	);  

	

	// Nav icon Color
	$wp_customize->add_setting('portfolioo[nav_icon_color]',array(
		          'default'         => '#fff',
		          'sanitize_callback' => 'sanitize_hex_color',
		          'transport'       => 'postMessage',
		          'type'            => 'option',
		)
	);
				// Control
				$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'nav_icon_color', array(
				               'label'      => esc_html__( 'Hamburger Icon Color', 'portfolioo' ),
				               'section'    => 'header_section',
				               'settings'   => 'portfolioo[nav_icon_color]' 
				           )
				       )
				   );

	// Header background
	$wp_customize->add_setting('portfolioo[nav_background]',array(
		          'default'         => '#000',
		          'sanitize_callback' => 'sanitize_hex_color',
		          'transport'       => 'postMessage',
		          'type'            => 'option',
		)
	);
				// Control
				$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'nav_background', array(
				               'label'      => esc_html__( 'Header Background Color', 'portfolioo' ),
				               'section'    => 'header_section',
				               'settings'   => 'portfolioo[nav_background]' 
				           )
				       )
				   );


	// site title color
	$wp_customize->add_setting('portfolioo[site_title_color]',array(
		          'default'         => '#fff',
		          'sanitize_callback' => 'sanitize_hex_color',
		          'transport'       => 'postMessage',
		          'type'            => 'option',
		)
	);
				// Control
				$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'site_title_color', array(
				               'label'      => esc_html__( 'Site Title Color', 'portfolioo' ),
				               'section'    => 'header_section',
				               'settings'   => 'portfolioo[site_title_color]' 
				           )
				       )
				   );

	// sidr close color
	$wp_customize->add_setting('portfolioo[sidr_close_color]',array(
		          'default'         => '#2196F3',
		          'sanitize_callback' => 'sanitize_hex_color',
		          'transport'       => 'postMessage',
		          'type'            => 'option',
		)
	);
				// Control
				$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'sidr_close_color', array(
				               'label'      => esc_html__( 'Menu Close BG Color', 'portfolioo' ),
				               'section'    => 'header_section',
				               'settings'   => 'portfolioo[sidr_close_color]' 
				           )
				       )
				   );


	// static frontpage info
	$wp_customize->add_setting( 'portfolioo[fp_instruction]', array(
			    'default' => '',
			    'sanitize_callback' => 'portfolioo_sanitize_text',
			    'type'   => 'option'
			) );

			// Control
		    $wp_customize->add_control( new portfolioo_Custom_Content( $wp_customize, 'fp_instruction', array(
			 'section' => 'static_front_page',
			 'content' => sprintf( __( '<h2>To Setup frontpage, Go to:</h2></br>
		<ul>
		<li>1. <b>Dashboard -> Pages -> Add New</b></li>
		<li>2. On the right, you will find a box titled <b>Page Attributes</b></li>
		<li>3. Select <b>Front Page Template</b> from the dropdown <b>Template</b> options</li>
		<li>4. Type Page title & click on <b>Publish</b></li>
		<li>5. Go to <b>Dashboard -> Settings -> Reading -> Front page displays </b></li>
		<li>6. Select <b>A static page(select below)</b> </li>
		<li>7. Then select the page with <b>"Front Page Template"</b> as <b>Front Page</b></li>
		<li>8. Click on <b>Save & Publish</b> and you are done.</li>
		<li>9. Still struggling? Follow the documentation <a portfoliooget="_blank" href="%s">Front Page Setup Documentation</a>
		</ul></br>', 'portfolioo' ), esc_url( 'https://asphaltthemes.com/docs/portfolioo/how-to-setup-frontpage/' )),
			 'settings' =>  'portfolioo[fp_instruction]',
		) ) );


	// basic  Section
	$wp_customize->add_section( 'basic_site_section' , array(
		    'title'      => esc_html__('Site Settings','portfolioo'), 
		    'panel'      => 'misc',
		    'capability'     => 'edit_theme_options',
		    'priority'   => 10   
		)
	);  


	// Typography Section
	$wp_customize->add_section( 'typorgraphy_section' , array(
		    'title'      => esc_html__('Typography Settings','portfolioo'), 
		    'panel'      => 'basic_settings',
		    'capability'     => 'edit_theme_options',
		    'priority'   => 10   
		)
	); 

	//site font family 
	$wp_customize->add_setting('portfolioo[body_font_family]',array(
		          'default'         => 'Open Sans',
		          'sanitize_callback' => 'sanitize_text_field',
		          'transport'       => 'postMessage',
		          'type'			=> 'option'
		      )
		);

				// Control
				$wp_customize->add_control(new WP_Customize_Control($wp_customize,'body_font_family', array(
		                'label'          => __( 'Font-Family', 'portfolioo' ),
		                'section'        => 'typorgraphy_section',
		                'settings'       => 'portfolioo[body_font_family]',
		                'type'           => 'select',
		                'choices'        => portfolioo_fonts()
		            )
		        )       
		   );


	//site body_ font size
	$wp_customize->add_setting('portfolioo[body_font_size]',array(
		          'default'         => '16',
		          'sanitize_callback' => 'sanitize_text_field',
		          'transport'       => 'postMessage',
		          'type'			=> 'option'
		      )
		);

				
		   		// Control
		   		$wp_customize->add_control(new WP_Customize_Control($wp_customize,'body_font_size', array(
		                'label'          => __( 'Font Size', 'portfolioo' ),
		                'section'        => 'typorgraphy_section',
		                'settings'       => 'portfolioo[body_font_size]',
		                'type'           => 'range',
		                'input_attrs' => array(
					    'min' => '12',
					    'max' => '25',
					    'step' => '1',
					  )
		            )
		        )       
		   );



}
add_action( 'customize_register', 'portfolioo_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function portfolioo_customize_preview_js() {
	wp_enqueue_script( 'portfolioo_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'portfolioo_customize_preview_js' );


function portfolioo_customizer_misc_js() {
	wp_enqueue_script( 'portfolioo-customizer-widget-js', get_template_directory_uri() .'/js/customizer-control.js', array( 'customize-controls' , 'jquery'), null, true );

}
add_action( 'customize_controls_enqueue_scripts', 'portfolioo_customizer_misc_js' );




// load backend css file on widget.php page
function portfolioo_admin_load($hook) {
 
	if( $hook != 'widgets.php'  )  {
		return;
	}
 
	wp_enqueue_style( 'portfolioo-css', get_template_directory_uri() . '/assets/css/backend.css' );
}
add_action('admin_enqueue_scripts', 'portfolioo_admin_load');


// Sanitize text field
function portfolioo_sanitize_text( $text ) {

    return wp_kses_post( force_balance_tags( $text ) );
}

// Sanitize texportfoliooea 
function portfolioo_sanitize_css( $input ) {
	return wp_filter_nohtml_kses( $input );
}


// checkbox sanitization
   function portfolioo_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
   }

// icon sanitization
function portfolioo_icon_sanitize( $input ) {
    
    $valid_keys = athena_icons();
    
    if (array_key_exists($input, $valid_keys)) {
        return $input;
    } else {
        return '';
    }
    
}




function portfolioo_fonts(){
    
    $font_family_array = array(
        'Arial, Helvetica, sans-serif'          => 'Arial',
        'Arial Black, Gadget, sans-serif'       => 'Arial Black',
        'Courier New', 'monospace'              => 'Courier New',
        'Lobster Two, cursive'                  => 'Lobster - Cursive',
        'Georgia, serif'                        => 'Georgia',
        'Impact, Charcoal, sans-serif'          => 'Impact',
        'Lucida Console, Monaco, monospace'     => 'Lucida Console',
        'Lucida Sans Unicode sans-serif'	    => 'Lucida Sans Unicode',
        'MS Sans Serif, Geneva, sans-serif'     => 'MS Sans Serif',
        'MS Serif, New York, serif'             => 'MS Serif',
        'Open Sans, sans-serif'                 => 'Open Sans',
        'Source Sans Pro, sans-serif'           => 'Source Sans Pro',
        'Lato, sans-serif'                      => 'Lato',
        'Tahoma, Geneva, sans-serif'            => 'Tahoma',
        'Times New Roman, Times, serif'         => 'Times New Roman',
        'Trebuchet MS, sans-serif'              => 'Trebuchet MS',
        'Verdana, Geneva, sans-serif'           => 'Verdana',
        'Raleway, sans-serif'                   => 'Raleway',
        'Roboto Condensed, sans-serif'          => 'Robot Condensed',
        'PT Sans, sans-serif'                   => 'PT Sans',
        'Open Sans Condensed, sans-serif'       => 'Open Sans Condensed',
        'Roboto Slab, sans-serif'               => 'Roboto Slab',
        'Droid Sans, sans-serif'                => 'Droid Sans',
        'Ubuntu, sans-serif'  					=> 'Ubuntu',
        'Tangerine, serif'						=> 'Tangerine serif',
        'Josefin Slab, sans-serif'				=> 'Josefin Slab',
        'Arvo, sans-serif'						=> 'Arvo',
        'Vollkorn, sans-serif'					=> 'Vollkorn',
        'Abril Fatface, cursive'				=> 'Abril Fatface',
        'Old Standard TT, serif'			    => 'Old Standard TT',
        'Anivers, sans-serif'					=> 'Anivers',
        'Junction, sans-serif'					=> 'Junction',
        'Fertigo, sans-serif'					=> 'Fertigo',
        'Aller, sans-serif'						=> 'Aller',
        'Audimat, sans-serif'					=> 'Audimat',
        'Delicious, sans-serif'					=> 'Delicious',
        'Prociono, sans-serif'					=> 'Prociono',
        'Fontin, sans-serif'					=> 'Fontin',
        'Fontin-Sans, sans-serif'				=> 'Fontin-Sans',
        'Playfair Display, sans-serif'			=> 'Playfair Display',
        'Work Sans, sans-serif'					=> 'Work Sans',
        'Alegreya, sans-serif'					=> 'Alegreya',
        'Alegreya Sans, sans-serif'				=> 'Alegreya Sans',
        'Fira Sans, sans-serif'					=> 'Fira Sans',
        'Inconsolata, sans-serif'				=> 'Inconsolata',
        'Source Serif Pro, sans-serif'			=> 'Source Serif Pro',
        'Lora, sans-serif'						=> 'Lora',
        'Karla, sans-serif'						=> 'Karla',
        'Cardo, sans-serif'						=> 'Cardo',
        'Bitter, sans-serif'					=> 'Bitter',
        'Domine, sans-serif'					=> 'Domine',
        'Varela Round, sans-serif'				=> 'Varela Round',
        'Chivo, sans-serif'						=> 'Chivo',
        'Montserrat, sans-serif'				=> 'Montserrat',
        'Crimson Text, sans-serif'				=> 'Crimson Text',
        'Libre Baskerville, sans-serif'			=> 'Libre Baskerville',
        'Archivo Narrow, sans-serif'			=> 'Archivo Narrow',
        'Anonymous Pro, sans-serif'				=> 'Anonymous Pro',
        'Merriweather, sans-serif'				=> 'Merriweather',
        'Neuton, sans-serif'					=> 'Neuton',
        'Poppins, sans-serif'					=> 'Poppins',
        'Noto Sans, sans-serif'					=> 'Noto Sans',
    );
    
    return $font_family_array;
}



function portfolioo_icons(){
    
    return array( 
        'none' => __( 'None', 'portfolioo'), 
        'fa-500px' => __( ' 500px', 'portfolioo'), 
        'fa-amazon' => __( ' amazon', 'portfolioo'), 
        'fa-balance-scale' => __( ' balance-scale', 'portfolioo'), 
        'fa-battery-0' => __( ' battery-0', 'portfolioo'), 
        'fa-battery-1' => __( ' battery-1', 'portfolioo'), 
        'fa-battery-2' => __( ' battery-2', 'portfolioo'), 
        'fa-battery-3' => __( ' battery-3', 'portfolioo'), 
        'fa-battery-4' => __( ' battery-4', 'portfolioo'), 
        'fa-battery-empty' => __( ' battery-empty', 'portfolioo'), 
        'fa-battery-full' => __( ' battery-full', 'portfolioo'), 
        'fa-battery-half' => __( ' battery-half', 'portfolioo'),
        'fa-battery-quarter' => __( ' battery-quarter', 'portfolioo'), 
        'fa-battery-three-quarters' => __( ' battery-three-quarters', 'portfolioo'), 
        'fa-black-tie' => __( ' black-tie', 'portfolioo'),
        'fa-calendar-check-o' => __( ' calendar-check-o', 'portfolioo'), 
        'fa-calendar-minus-o' => __( ' calendar-minus-o', 'portfolioo'), 
        'fa-calendar-plus-o' => __( ' calendar-plus-o', 'portfolioo'), 
        'fa-calendar-times-o' => __( ' calendar-times-o', 'portfolioo'), 
        'fa-cc-diners-club' => __( ' cc-diners-club', 'portfolioo'), 
        'fa-cc-jcb' => __( ' cc-jcb', 'portfolioo'), 
        'fa-chrome' => __( ' chrome', 'portfolioo'), 
        'fa-clone' => __( ' clone', 'portfolioo'), 
        'fa-commenting' => __( ' commenting', 'portfolioo'), 
        'fa-commenting-o' => __( ' commenting-o', 'portfolioo'), 
        'fa-contao' => __( ' contao', 'portfolioo'), 
        'fa-creative-commons' => __( ' creative-commons', 'portfolioo'), 
        'fa-expeditedssl' => __( ' expeditedssl', 'portfolioo'), 
        'fa-firefox' => __( ' firefox', 'portfolioo'), 
        'fa-fonticons' => __( ' fonticons', 'portfolioo'), 
        'fa-genderless' => __( ' genderless', 'portfolioo'), 
        'fa-get-pocket' => __( ' get-pocket', 'portfolioo'), 
        'fa-gg' => __( ' gg', 'portfolioo'), 
        'fa-gg-circle' => __( ' gg-circle', 'portfolioo'), 
        'fa-hand-grab-o' => __( ' hand-grab-o', 'portfolioo'), 
        'fa-hand-lizard-o' => __( ' hand-lizard-o', 'portfolioo'), 
        'fa-hand-paper-o' => __( ' hand-paper-o', 'portfolioo'), 
        'fa-hand-peace-o' => __( ' hand-peace-o', 'portfolioo'), 
        'fa-hand-pointer-o' => __( ' hand-pointer-o', 'portfolioo'), 
        'fa-hand-rock-o' => __( ' hand-rock-o', 'portfolioo'), 
        'fa-hand-scissors-o' => __( ' hand-scissors-o', 'portfolioo'), 
        'fa-hand-spock-o' => __( ' hand-spock-o', 'portfolioo'), 
        'fa-hand-stop-o' => __( ' hand-stop-o', 'portfolioo'), 
        'fa-hourglass' => __( ' hourglass', 'portfolioo'), 
        'fa-hourglass-1' => __( ' hourglass-1', 'portfolioo'), 
        'fa-hourglass-2' => __( ' hourglass-2', 'portfolioo'), 
        'fa-hourglass-3' => __( ' hourglass-3', 'portfolioo'), 
        'fa-hourglass-end' => __( ' hourglass-end', 'portfolioo'), 
        'fa-hourglass-half' => __( ' hourglass-half', 'portfolioo'), 
        'fa-hourglass-o' => __( ' hourglass-o', 'portfolioo'), 
        'fa-hourglass-sportfolioot' => __( ' hourglass-sportfolioot', 'portfolioo'), 
        'fa-houzz' => __( ' houzz', 'portfolioo'), 
        'fa-i-cursor' => __( ' i-cursor', 'portfolioo'), 
        'fa-industry' => __( ' industry', 'portfolioo'), 
        'fa-internet-explorer' => __( ' internet-explorer', 'portfolioo'), 
        'fa-map' => __( ' map', 'portfolioo'), 
        'fa-map-o' => __( ' map-o', 'portfolioo'), 
        'fa-map-pin' => __( ' map-pin', 'portfolioo'), 
        'fa-map-signs' => __( ' map-signs', 'portfolioo'), 
        'fa-mouse-pointer' => __( ' mouse-pointer', 'portfolioo'), 
        'fa-object-group' => __( ' object-group', 'portfolioo'), 
        'fa-object-ungroup' => __( ' object-ungroup', 'portfolioo'), 
        'fa-odnoklassniki' => __( ' odnoklassniki', 'portfolioo'), 
        'fa-odnoklassniki-square' => __( ' odnoklassniki-square', 'portfolioo'), 
        'fa-opencart' => __( ' opencart', 'portfolioo'), 
        'fa-opera' => __( ' opera', 'portfolioo'), 
        'fa-optin-monster' => __( ' optin-monster', 'portfolioo'), 
        'fa-registered' => __( ' registered', 'portfolioo'), 
        'fa-safari' => __( ' safari', 'portfolioo'), 
        'fa-sticky-note' => __( ' sticky-note', 'portfolioo'), 
        'fa-sticky-note-o' => __( ' sticky-note-o', 'portfolioo'), 
        'fa-television' => __( ' television', 'portfolioo'), 
        'fa-trademark' => __( ' trademark', 'portfolioo'), 
        'fa-tripadvisor' => __( ' tripadvisor', 'portfolioo'), 
        'fa-tv' => __( ' tv', 'portfolioo'), 
        'fa-vimeo' => __( ' vimeo', 'portfolioo'), 
        'fa-wikipedia-w' => __( ' wikipedia-w', 'portfolioo'), 
        'fa-y-combinator' => __( ' y-combinator', 'portfolioo'), 
        'fa-yc' => __( ' yc', 'portfolioo'), 
        'fa-adjust' => __( ' adjust', 'portfolioo'), 
        'fa-anchor' => __( ' anchor', 'portfolioo'), 
        'fa-archive' => __( ' archive', 'portfolioo'), 
        'fa-area-chart' => __( ' area-chart', 'portfolioo'), 
        'fa-arrows' => __( ' arrows', 'portfolioo'), 
        'fa-arrows-h' => __( ' arrows-h', 'portfolioo'), 
        'fa-arrows-v' => __( ' arrows-v', 'portfolioo'), 
        'fa-asterisk' => __( ' asterisk', 'portfolioo'), 
        'fa-at' => __( ' at', 'portfolioo'), 
        'fa-automobile' => __( ' automobile', 'portfolioo'), 
        'fa-balance-scale' => __( ' balance-scale', 'portfolioo'), 
        'fa-ban' => __( ' ban', 'portfolioo'), 
        'fa-bank' => __( ' bank', 'portfolioo'), 
        'fa-bar-chart' => __( ' bar-chart', 'portfolioo'), 
        'fa-bar-chart-o' => __( ' bar-chart-o', 'portfolioo'), 
        'fa-barcode' => __( ' barcode', 'portfolioo'), 
        'fa-bars' => __( ' bars', 'portfolioo'), 
        'fa-battery-0' => __( ' battery-0', 'portfolioo'), 
        'fa-battery-1' => __( ' battery-1', 'portfolioo'), 
        'fa-battery-2' => __( ' battery-2', 'portfolioo'), 
        'fa-battery-3' => __( ' battery-3', 'portfolioo'), 
        'fa-battery-4' => __( ' battery-4', 'portfolioo'), 
        'fa-battery-empty' => __( ' battery-empty', 'portfolioo'), 
        'fa-battery-full' => __( ' battery-full', 'portfolioo'), 
        'fa-battery-half' => __( ' battery-half', 'portfolioo'), 
        'fa-battery-quarter' => __( ' battery-quarter', 'portfolioo'), 
        'fa-battery-three-quarters' => __( ' battery-three-quarters', 'portfolioo'), 
        'fa-bed' => __( ' bed', 'portfolioo'), 
        'fa-beer' => __( ' beer', 'portfolioo'), 
        'fa-bell' => __( ' bell', 'portfolioo'), 
        'fa-bell-o' => __( ' bell-o', 'portfolioo'), 
        'fa-bell-slash' => __( ' bell-slash', 'portfolioo'), 
        'fa-bell-slash-o' => __( ' bell-slash-o', 'portfolioo'),
        'fa-bicycle' => __( ' bicycle', 'portfolioo'), 
        'fa-binoculars' => __( ' binoculars', 'portfolioo'), 
        'fa-birthday-cake' => __( ' birthday-cake', 'portfolioo'), 
        'fa-bolt' => __( ' bolt', 'portfolioo'), 
        'fa-bomb' => __( ' bomb', 'portfolioo'), 
        'fa-book' => __( ' book', 'portfolioo'), 
        'fa-bookmark' => __( ' bookmark', 'portfolioo'), 
        'fa-bookmark-o' => __( ' bookmark-o', 'portfolioo'),
        'fa-briefcase' => __( ' briefcase', 'portfolioo'), 
        'fa-bug' => __( ' bug', 'portfolioo'),
        'fa-building' => __( ' building', 'portfolioo'), 
        'fa-building-o' => __( ' building-o', 'portfolioo'), 
        'fa-bullhorn' => __( ' bullhorn', 'portfolioo'), 
        'fa-bullseye' => __( ' bullseye', 'portfolioo'),
        'fa-bus' => __( ' bus', 'portfolioo'), 
        'fa-cab' => __( ' cab', 'portfolioo'), 
        'fa-calculator' => __( ' calculator', 'portfolioo'), 
        'fa-calendar' => __( ' calendar', 'portfolioo'), 
        'fa-calendar-check-o' => __( ' calendar-check-o', 'portfolioo'), 
        'fa-calendar-minus-o' => __( ' calendar-minus-o', 'portfolioo'), 
        'fa-calendar-o' => __( ' calendar-o', 'portfolioo'), 
        'fa-calendar-plus-o' => __( ' calendar-plus-o', 'portfolioo'), 
        'fa-calendar-times-o' => __( ' calendar-times-o', 'portfolioo'), 
        'fa-camera' => __( ' camera', 'portfolioo'), 
        'fa-camera-retro' => __( ' camera-retro', 'portfolioo'),
        'fa-car' => __( ' car', 'portfolioo'), 
        'fa-caret-square-o-down' => __( ' caret-square-o-down', 'portfolioo'),
        'fa-caret-square-o-left' => __( ' caret-square-o-left', 'portfolioo'), 
        'fa-caret-square-o-right' => __( ' caret-square-o-right', 'portfolioo'),
        'fa-caret-square-o-up' => __( ' caret-square-o-up', 'portfolioo'),
        'fa-cart-arrow-down' => __( ' cart-arrow-down', 'portfolioo'),
        'fa-cart-plus' => __( ' cart-plus', 'portfolioo'), 
        'fa-cc' => __( ' cc', 'portfolioo'),
        'fa-certificate' => __( ' certificate', 'portfolioo'), 
        'fa-check' => __( ' check', 'portfolioo'), 
        'fa-check-circle' => __( ' check-circle', 'portfolioo'),
        'fa-check-circle-o' => __( ' check-circle-o', 'portfolioo'),
        'fa-check-square' => __( ' check-square', 'portfolioo'),
        'fa-check-square-o' => __( ' check-square-o', 'portfolioo'), 
        'fa-child' => __( ' child', 'portfolioo'),
        'fa-circle' => __( ' circle', 'portfolioo'), 
        'fa-circle-o' => __( ' circle-o', 'portfolioo'), 
        'fa-circle-o-notch' => __( ' circle-o-notch', 'portfolioo'), 
        'fa-circle-thin' => __( ' circle-thin', 'portfolioo'), 
        'fa-clock-o' => __( ' clock-o', 'portfolioo'), 
        'fa-clone' => __( ' clone', 'portfolioo'),
        'fa-close' => __( ' close', 'portfolioo'), 
        'fa-cloud' => __( ' cloud', 'portfolioo'),
        'fa-cloud-download' => __( ' cloud-download', 'portfolioo'), 
        'fa-cloud-upload' => __( ' cloud-upload', 'portfolioo'), 
        'fa-code' => __( ' code', 'portfolioo'), 
        'fa-code-fork' => __( ' code-fork', 'portfolioo'), 
        'fa-coffee' => __( ' coffee', 'portfolioo'),
        'fa-cog' => __( ' cog', 'portfolioo'),
        'fa-cogs' => __( ' cogs', 'portfolioo'), 
        'fa-comment' => __( ' comment', 'portfolioo'),
        'fa-comment-o' => __( ' comment-o', 'portfolioo'),
        'fa-commenting' => __( ' commenting', 'portfolioo'),
        'fa-commenting-o' => __( ' commenting-o', 'portfolioo'),
        'fa-comments' => __( ' comments', 'portfolioo'), 
        'fa-comments-o' => __( ' comments-o', 'portfolioo'), 
        'fa-compass' => __( ' compass', 'portfolioo'), 
        'fa-copyright' => __( ' copyright', 'portfolioo'), 
        'fa-creative-commons' => __( ' creative-commons', 'portfolioo'), 
        'fa-credit-card' => __( ' credit-card', 'portfolioo'), 
        'fa-crop' => __( ' crop', 'portfolioo'), 
        'fa-crosshairs' => __( ' crosshairs', 'portfolioo'), 
        'fa-cube' => __( ' cube', 'portfolioo'), 
        'fa-cubes' => __( ' cubes', 'portfolioo'), 
        'fa-cutlery' => __( ' cutlery', 'portfolioo'), 
        'fa-dashboard' => __( ' dashboard', 'portfolioo'), 
        'fa-database' => __( ' database', 'portfolioo'), 
        'fa-desktop' => __( ' desktop', 'portfolioo'), 
        'fa-diamond' => __( ' diamond', 'portfolioo'), 
        'fa-dot-circle-o' => __( ' dot-circle-o', 'portfolioo'), 
        'fa-download' => __( ' download', 'portfolioo'), 
        'fa-edit' => __( ' edit', 'portfolioo'), 
        'fa-ellipsis-h' => __( ' ellipsis-h', 'portfolioo'), 
        'fa-ellipsis-v' => __( ' ellipsis-v', 'portfolioo'), 
        'fa-envelope' => __( ' envelope', 'portfolioo'), 
        'fa-envelope-o' => __( ' envelope-o', 'portfolioo'), 
        'fa-envelope-square' => __( ' envelope-square', 'portfolioo'), 
        'fa-eraser' => __( ' eraser', 'portfolioo'), 
        'fa-exchange' => __( ' exchange', 'portfolioo'), 
        'fa-exclamation' => __( ' exclamation', 'portfolioo'), 
        'fa-exclamation-circle' => __( ' exclamation-circle', 'portfolioo'), 
        'fa-exclamation-triangle' => __( ' exclamation-triangle', 'portfolioo'), 
        'fa-external-link' => __( ' external-link', 'portfolioo'), 
        'fa-external-link-square' => __( ' external-link-square', 'portfolioo'), 
        'fa-eye' => __( ' eye', 'portfolioo'), 
        'fa-eye-slash' => __( ' eye-slash', 'portfolioo'), 
        'fa-eyedropper' => __( ' eyedropper', 'portfolioo'), 
        'fa-fax' => __( ' fax', 'portfolioo'), 
        'fa-feed' => __( ' feed', 'portfolioo'), 
        'fa-female' => __( ' female', 'portfolioo'), 
        'fa-fighter-jet' => __( ' fighter-jet', 'portfolioo'), 
        'fa-file-archive-o' => __( ' file-archive-o', 'portfolioo'), 
        'fa-file-audio-o' => __( ' file-audio-o', 'portfolioo'), 
        'fa-file-code-o' => __( ' file-code-o', 'portfolioo'), 
        'fa-file-excel-o' => __( ' file-excel-o', 'portfolioo'), 
        'fa-file-image-o' => __( ' file-image-o', 'portfolioo'), 
        'fa-file-movie-o' => __( ' file-movie-o', 'portfolioo'), 
        'fa-file-pdf-o' => __( ' file-pdf-o', 'portfolioo'), 
        'fa-file-photo-o' => __( ' file-photo-o', 'portfolioo'), 
        'fa-file-picture-o' => __( ' file-picture-o', 'portfolioo'), 
        'fa-file-powerpoint-o' => __( ' file-powerpoint-o', 'portfolioo'), 
        'fa-file-sound-o' => __( ' file-sound-o', 'portfolioo'), 
        'fa-file-video-o' => __( ' file-video-o', 'portfolioo'), 
        'fa-file-word-o' => __( ' file-word-o', 'portfolioo'), 
        'fa-file-zip-o' => __( ' file-zip-o', 'portfolioo'), 
        'fa-film' => __( ' film', 'portfolioo'), 
        'fa-filter' => __( ' filter', 'portfolioo'), 
        'fa-fire' => __( ' fire', 'portfolioo'), 
        'fa-fire-extinguisher' => __( ' fire-extinguisher', 'portfolioo'), 
        'fa-flag' => __( ' flag', 'portfolioo'), 
        'fa-flag-checkered' => __( ' flag-checkered', 'portfolioo'), 
        'fa-flag-o' => __( ' flag-o', 'portfolioo'), 
        'fa-flash' => __( ' flash', 'portfolioo'), 
        'fa-flask' => __( ' flask', 'portfolioo'), 
        'fa-folder' => __( ' folder', 'portfolioo'), 
        'fa-folder-o' => __( ' folder-o', 'portfolioo'), 
        'fa-folder-open' => __( ' folder-open', 'portfolioo'), 
        'fa-folder-open-o' => __( ' folder-open-o', 'portfolioo'), 
        'fa-frown-o' => __( ' frown-o', 'portfolioo'), 
        'fa-futbol-o' => __( ' futbol-o', 'portfolioo'), 
        'fa-gamepad' => __( ' gamepad', 'portfolioo'), 
        'fa-gavel' => __( ' gavel', 'portfolioo'), 
        'fa-gear' => __( ' gear', 'portfolioo'), 
        'fa-gears' => __( ' gears', 'portfolioo'), 
        'fa-gift' => __( ' gift', 'portfolioo'), 
        'fa-glass' => __( ' glass', 'portfolioo'), 
        'fa-globe' => __( ' globe', 'portfolioo'), 
        'fa-graduation-cap' => __( ' graduation-cap', 'portfolioo'), 
        'fa-group' => __( ' group', 'portfolioo'), 
        'fa-hand-grab-o' => __( ' hand-grab-o', 'portfolioo'), 
        'fa-hand-lizard-o' => __( ' hand-lizard-o', 'portfolioo'), 
        'fa-hand-paper-o' => __( ' hand-paper-o', 'portfolioo'), 
        'fa-hand-peace-o' => __( ' hand-peace-o', 'portfolioo'), 
        'fa-hand-pointer-o' => __( ' hand-pointer-o', 'portfolioo'), 
        'fa-hand-rock-o' => __( ' hand-rock-o', 'portfolioo'), 
        'fa-hand-scissors-o' => __( ' hand-scissors-o', 'portfolioo'), 
        'fa-hand-spock-o' => __( ' hand-spock-o', 'portfolioo'), 
        'fa-hand-stop-o' => __( ' hand-stop-o', 'portfolioo'), 
        'fa-hdd-o' => __( ' hdd-o', 'portfolioo'), 
        'fa-headphones' => __( ' headphones', 'portfolioo'), 
        'fa-heart' => __( ' heart', 'portfolioo'), 
        'fa-heart-o' => __( ' heart-o', 'portfolioo'), 
        'fa-heartbeat' => __( ' heartbeat', 'portfolioo'), 
        'fa-history' => __( ' history', 'portfolioo'), 
        'fa-home' => __( ' home', 'portfolioo'), 
        'fa-hotel' => __( ' hotel', 'portfolioo'), 
        'fa-hourglass' => __( ' hourglass', 'portfolioo'), 
        'fa-hourglass-1' => __( ' hourglass-1', 'portfolioo'), 
        'fa-hourglass-2' => __( ' hourglass-2', 'portfolioo'), 
        'fa-hourglass-3' => __( ' hourglass-3', 'portfolioo'), 
        'fa-hourglass-end' => __( ' hourglass-end', 'portfolioo'), 
        'fa-hourglass-half' => __( ' hourglass-half', 'portfolioo'), 
        'fa-hourglass-o' => __( ' hourglass-o', 'portfolioo'), 
        'fa-hourglass-sportfolioot' => __( ' hourglass-sportfolioot', 'portfolioo'), 
        'fa-i-cursor' => __( ' i-cursor', 'portfolioo'), 
        'fa-image' => __( ' image', 'portfolioo'), 
        'fa-inbox' => __( ' inbox', 'portfolioo'), 
        'fa-industry' => __( ' industry', 'portfolioo'), 
        'fa-info' => __( ' info', 'portfolioo'), 
        'fa-info-circle' => __( ' info-circle', 'portfolioo'), 
        'fa-institution' => __( ' institution', 'portfolioo'), 
        'fa-key' => __( ' key', 'portfolioo'), 
        'fa-keyboard-o' => __( ' keyboard-o', 'portfolioo'), 
        'fa-language' => __( ' language', 'portfolioo'), 
        'fa-laptop' => __( ' laptop', 'portfolioo'), 
        'fa-leaf' => __( ' leaf', 'portfolioo'), 
        'fa-legal' => __( ' legal', 'portfolioo'), 
        'fa-lemon-o' => __( ' lemon-o', 'portfolioo'), 
        'fa-level-down' => __( ' level-down', 'portfolioo'), 
        'fa-level-up' => __( ' level-up', 'portfolioo'), 
        'fa-life-bouy' => __( ' life-bouy', 'portfolioo'), 
        'fa-life-buoy' => __( ' life-buoy', 'portfolioo'), 
        'fa-life-ring' => __( ' life-ring', 'portfolioo'), 
        'fa-life-saver' => __( ' life-saver', 'portfolioo'), 
        'fa-lightbulb-o' => __( ' lightbulb-o', 'portfolioo'), 
        'fa-line-chart' => __( ' line-chart', 'portfolioo'), 
        'fa-location-arrow' => __( ' location-arrow', 'portfolioo'), 
        'fa-lock' => __( ' lock', 'portfolioo'), 
        'fa-magic' => __( ' magic', 'portfolioo'), 
        'fa-magnet' => __( ' magnet', 'portfolioo'), 
        'fa-mail-forward' => __( ' mail-forward', 'portfolioo'), 
        'fa-mail-reply' => __( ' mail-reply', 'portfolioo'), 
        'fa-mail-reply-all' => __( ' mail-reply-all', 'portfolioo'), 
        'fa-male' => __( ' male', 'portfolioo'), 
        'fa-map' => __( ' map', 'portfolioo'), 
        'fa-map-marker' => __( ' map-marker', 'portfolioo'), 
        'fa-map-o' => __( ' map-o', 'portfolioo'), 
        'fa-map-pin' => __( ' map-pin', 'portfolioo'), 
        'fa-map-signs' => __( ' map-signs', 'portfolioo'), 
        'fa-meh-o' => __( ' meh-o', 'portfolioo'), 
        'fa-microphone' => __( ' microphone', 'portfolioo'), 
        'fa-microphone-slash' => __( ' microphone-slash', 'portfolioo'), 
        'fa-minus' => __( ' minus', 'portfolioo'), 
        'fa-minus-circle' => __( ' minus-circle', 'portfolioo'), 
        'fa-minus-square' => __( ' minus-square', 'portfolioo'), 
        'fa-minus-square-o' => __( ' minus-square-o', 'portfolioo'), 
        'fa-mobile' => __( ' mobile', 'portfolioo'), 
        'fa-mobile-phone' => __( ' mobile-phone', 'portfolioo'), 
        'fa-money' => __( ' money', 'portfolioo'), 
        'fa-moon-o' => __( ' moon-o', 'portfolioo'), 
        'fa-morportfolioo-board' => __( ' morportfolioo-board', 'portfolioo'), 
        'fa-motorcycle' => __( ' motorcycle', 'portfolioo'), 
        'fa-mouse-pointer' => __( ' mouse-pointer', 'portfolioo'), 
        'fa-music' => __( ' music', 'portfolioo'), 
        'fa-navicon' => __( ' navicon', 'portfolioo'), 
        'fa-newspaper-o' => __( ' newspaper-o', 'portfolioo'), 
        'fa-object-group' => __( ' object-group', 'portfolioo'), 
        'fa-object-ungroup' => __( ' object-ungroup', 'portfolioo'), 
        'fa-paint-brush' => __( ' paint-brush', 'portfolioo'), 
        'fa-paper-plane' => __( ' paper-plane', 'portfolioo'), 
        'fa-paper-plane-o' => __( ' paper-plane-o', 'portfolioo'), 
        'fa-paw' => __( ' paw', 'portfolioo'), 
        'fa-pencil' => __( ' pencil', 'portfolioo'), 
        'fa-pencil-square' => __( ' pencil-square', 'portfolioo'),
        'fa-pencil-square-o' => __( ' pencil-square-o', 'portfolioo'), 
        'fa-phone' => __( ' phone', 'portfolioo'), 
        'fa-phone-square' => __( ' phone-square', 'portfolioo'), 
        'fa-photo' => __( ' photo', 'portfolioo'), 
        'fa-picture-o' => __( ' picture-o', 'portfolioo'), 
        'fa-pie-chart' => __( ' pie-chart', 'portfolioo'), 
        'fa-plane' => __( ' plane', 'portfolioo'), 
        'fa-plug' => __( ' plug', 'portfolioo'), 
        'fa-plus' => __( ' plus', 'portfolioo'), 
        'fa-plus-circle' => __( ' plus-circle', 'portfolioo'), 
        'fa-plus-square' => __( ' plus-square', 'portfolioo'), 
        'fa-plus-square-o' => __( ' plus-square-o', 'portfolioo'),
        'fa-power-off' => __( ' power-off', 'portfolioo'), 
        'fa-print' => __( ' print', 'portfolioo'), 
        'fa-puzzle-piece' => __( ' puzzle-piece', 'portfolioo'), 
        'fa-qrcode' => __( ' qrcode', 'portfolioo'), 
        'fa-question' => __( ' question', 'portfolioo'), 
        'fa-question-circle' => __( ' question-circle', 'portfolioo'), 
        'fa-quote-left' => __( ' quote-left', 'portfolioo'), 
        'fa-quote-right' => __( ' quote-right', 'portfolioo'), 
        'fa-random' => __( ' random', 'portfolioo'), 
        'fa-recycle' => __( ' recycle', 'portfolioo'), 
        'fa-refresh' => __( ' refresh', 'portfolioo'), 
        'fa-registered' => __( ' registered', 'portfolioo'), 
        'fa-remove' => __( ' remove', 'portfolioo'), 
        'fa-reorder' => __( ' reorder', 'portfolioo'), 
        'fa-reply' => __( ' reply', 'portfolioo'), 
        'fa-reply-all' => __( ' reply-all', 'portfolioo'), 
        'fa-retweet' => __( ' retweet', 'portfolioo'), 
        'fa-road' => __( ' road', 'portfolioo'), 
        'fa-rocket' => __( ' rocket', 'portfolioo'), 
        'fa-rss' => __( ' rss', 'portfolioo'), 
        'fa-rss-square' => __( ' rss-square', 'portfolioo'), 
        'fa-search' => __( ' search', 'portfolioo'), 
        'fa-search-minus' => __( ' search-minus', 'portfolioo'), 
        'fa-search-plus' => __( ' search-plus', 'portfolioo'), 
        'fa-send' => __( ' send', 'portfolioo'), 
        'fa-send-o' => __( ' send-o', 'portfolioo'), 
        'fa-server' => __( ' server', 'portfolioo'), 
        'fa-share' => __( ' share', 'portfolioo'), 
        'fa-share-alt' => __( ' share-alt', 'portfolioo'), 
        'fa-share-alt-square' => __( ' share-alt-square', 'portfolioo'), 
        'fa-share-square' => __( ' share-square', 'portfolioo'), 
        'fa-share-square-o' => __( ' share-square-o', 'portfolioo'), 
        'fa-shield' => __( ' shield', 'portfolioo'), 
        'fa-ship' => __( ' ship', 'portfolioo'), 
        'fa-shopping-cart' => __( ' shopping-cart', 'portfolioo'), 
        'fa-sign-in' => __( ' sign-in', 'portfolioo'), 
        'fa-sign-out' => __( ' sign-out', 'portfolioo'), 
        'fa-signal' => __( ' signal', 'portfolioo'), 
        'fa-sitemap' => __( ' sitemap', 'portfolioo'), 
        'fa-sliders' => __( ' sliders', 'portfolioo'), 
        'fa-smile-o' => __( ' smile-o', 'portfolioo'), 
        'fa-soccer-ball-o' => __( ' soccer-ball-o', 'portfolioo'), 
        'fa-sort' => __( ' sort', 'portfolioo'), 
        'fa-sort-alpha-asc' => __( ' sort-alpha-asc', 'portfolioo'), 
        'fa-sort-alpha-desc' => __( ' sort-alpha-desc', 'portfolioo'), 
        'fa-sort-amount-asc' => __( ' sort-amount-asc', 'portfolioo'), 
        'fa-sort-amount-desc' => __( ' sort-amount-desc', 'portfolioo'), 
        'fa-sort-asc' => __( ' sort-asc', 'portfolioo'), 
        'fa-sort-desc' => __( ' sort-desc', 'portfolioo'), 
        'fa-sort-down' => __( ' sort-down', 'portfolioo'), 
        'fa-sort-numeric-asc' => __( ' sort-numeric-asc', 'portfolioo'), 
        'fa-sort-numeric-desc' => __( ' sort-numeric-desc', 'portfolioo'), 
        'fa-sort-up' => __( ' sort-up', 'portfolioo'), 
        'fa-space-shuttle' => __( ' space-shuttle', 'portfolioo'), 
        'fa-spinner' => __( ' spinner', 'portfolioo'), 
        'fa-spoon' => __( ' spoon', 'portfolioo'), 
        'fa-square' => __( ' square', 'portfolioo'), 
        'fa-square-o' => __( ' square-o', 'portfolioo'), 
        'fa-sportfolioo' => __( ' sportfolioo', 'portfolioo'), 
        'fa-sportfolioo-half' => __( ' sportfolioo-half', 'portfolioo'), 
        'fa-sportfolioo-half-empty' => __( ' sportfolioo-half-empty', 'portfolioo'), 
        'fa-sportfolioo-half-full' => __( ' sportfolioo-half-full', 'portfolioo'), 
        'fa-sportfolioo-half-o' => __( ' sportfolioo-half-o', 'portfolioo'), 
        'fa-sportfolioo-o' => __( ' sportfolioo-o', 'portfolioo'), 
        'fa-sticky-note' => __( ' sticky-note', 'portfolioo'), 
        'fa-sticky-note-o' => __( ' sticky-note-o', 'portfolioo'), 
        'fa-street-view' => __( ' street-view', 'portfolioo'), 
        'fa-suitcase' => __( ' suitcase', 'portfolioo'), 
        'fa-sun-o' => __( ' sun-o', 'portfolioo'), 
        'fa-support' => __( ' support', 'portfolioo'), 
        'fa-tablet' => __( ' tablet', 'portfolioo'), 
        'fa-tachometer' => __( ' tachometer', 'portfolioo'), 
        'fa-tag' => __( ' tag', 'portfolioo'), 
        'fa-tags' => __( ' tags', 'portfolioo'), 
        'fa-tasks' => __( ' tasks', 'portfolioo'), 
        'fa-taxi' => __( ' taxi', 'portfolioo'), 
        'fa-television' => __( ' television', 'portfolioo'), 
        'fa-terminal' => __( ' terminal', 'portfolioo'), 
        'fa-thumb-tack' => __( ' thumb-tack', 'portfolioo'), 
        'fa-thumbs-down' => __( ' thumbs-down', 'portfolioo'), 
        'fa-thumbs-o-down' => __( ' thumbs-o-down', 'portfolioo'), 
        'fa-thumbs-o-up' => __( ' thumbs-o-up', 'portfolioo'), 
        'fa-thumbs-up' => __( ' thumbs-up', 'portfolioo'), 
        'fa-ticket' => __( ' ticket', 'portfolioo'), 
        'fa-times' => __( ' times', 'portfolioo'), 
        'fa-times-circle' => __( ' times-circle', 'portfolioo'), 
        'fa-times-circle-o' => __( ' times-circle-o', 'portfolioo'), 
        'fa-tint' => __( ' tint', 'portfolioo'), 
        'fa-toggle-down' => __( ' toggle-down', 'portfolioo'), 
        'fa-toggle-left' => __( ' toggle-left', 'portfolioo'), 
        'fa-toggle-off' => __( ' toggle-off', 'portfolioo'), 
        'fa-toggle-on' => __( ' toggle-on', 'portfolioo'), 
        'fa-toggle-right' => __( ' toggle-right', 'portfolioo'), 
        'fa-toggle-up' => __( ' toggle-up', 'portfolioo'), 
        'fa-trademark' => __( ' trademark', 'portfolioo'), 
        'fa-trash' => __( ' trash', 'portfolioo'), 
        'fa-trash-o' => __( ' trash-o', 'portfolioo'), 
        'fa-tree' => __( ' tree', 'portfolioo'), 
        'fa-trophy' => __( ' trophy', 'portfolioo'), 
        'fa-truck' => __( ' truck', 'portfolioo'), 
        'fa-tty' => __( ' tty', 'portfolioo'), 
        'fa-tv' => __( ' tv', 'portfolioo'), 
        'fa-umbrella' => __( ' umbrella', 'portfolioo'), 
        'fa-university' => __( ' university', 'portfolioo'), 
        'fa-unlock' => __( ' unlock', 'portfolioo'), 
        'fa-unlock-alt' => __( ' unlock-alt', 'portfolioo'), 
        'fa-unsorted' => __( ' unsorted', 'portfolioo'), 
        'fa-upload' => __( ' upload', 'portfolioo'), 
        'fa-user' => __( ' user', 'portfolioo'), 
        'fa-user-plus' => __( ' user-plus', 'portfolioo'),
        'fa-user-secret' => __( ' user-secret', 'portfolioo'), 
        'fa-user-times' => __( ' user-times', 'portfolioo'), 
        'fa-users' => __( ' users', 'portfolioo'), 
        'fa-video-camera' => __( ' video-camera', 'portfolioo'), 
        'fa-volume-down' => __( ' volume-down', 'portfolioo'), 
        'fa-volume-off' => __( ' volume-off', 'portfolioo'), 
        'fa-volume-up' => __( ' volume-up', 'portfolioo'), 
        'fa-warning' => __( ' warning', 'portfolioo'), 
        'fa-wheelchair' => __( ' wheelchair', 'portfolioo'), 
        'fa-wifi' => __( ' wifi', 'portfolioo'), 
        'fa-wrench' => __( ' wrench', 'portfolioo'), 
        'fa-hand-grab-o' => __( ' hand-grab-o', 'portfolioo'), 
        'fa-hand-lizard-o' => __( ' hand-lizard-o', 'portfolioo'), 
        'fa-hand-o-down' => __( ' hand-o-down', 'portfolioo'), 
        'fa-hand-o-left' => __( ' hand-o-left', 'portfolioo'), 
        'fa-hand-o-right' => __( ' hand-o-right', 'portfolioo'), 
        'fa-hand-o-up' => __( ' hand-o-up', 'portfolioo'), 
        'fa-hand-paper-o' => __( ' hand-paper-o', 'portfolioo'), 
        'fa-hand-peace-o' => __( ' hand-peace-o', 'portfolioo'), 
        'fa-hand-pointer-o' => __( ' hand-pointer-o', 'portfolioo'), 
        'fa-hand-rock-o' => __( ' hand-rock-o', 'portfolioo'), 
        'fa-hand-scissors-o' => __( ' hand-scissors-o', 'portfolioo'), 
        'fa-hand-spock-o' => __( ' hand-spock-o', 'portfolioo'), 
        'fa-hand-stop-o' => __( ' hand-stop-o', 'portfolioo'), 
        'fa-thumbs-down' => __( ' thumbs-down', 'portfolioo'), 
        'fa-thumbs-o-down' => __( ' thumbs-o-down', 'portfolioo'), 
        'fa-thumbs-o-up' => __( ' thumbs-o-up', 'portfolioo'), 
        'fa-thumbs-up' => __( ' thumbs-up', 'portfolioo'), 
        'fa-ambulance' => __( ' ambulance', 'portfolioo'), 
        'fa-automobile' => __( ' automobile', 'portfolioo'), 
        'fa-bicycle' => __( ' bicycle', 'portfolioo'), 
        'fa-bus' => __( ' bus', 'portfolioo'), 
        'fa-cab' => __( ' cab', 'portfolioo'), 
        'fa-car' => __( ' car', 'portfolioo'), 
        'fa-fighter-jet' => __( ' fighter-jet', 'portfolioo'), 
        'fa-motorcycle' => __( ' motorcycle', 'portfolioo'), 
        'fa-plane' => __( ' plane', 'portfolioo'), 
        'fa-rocket' => __( ' rocket', 'portfolioo'), 
        'fa-ship' => __( ' ship', 'portfolioo'), 
        'fa-space-shuttle' => __( ' space-shuttle', 'portfolioo'), 
        'fa-subway' => __( ' subway', 'portfolioo'), 
        'fa-taxi' => __( ' taxi', 'portfolioo'), 
        'fa-train' => __( ' train', 'portfolioo'), 
        'fa-truck' => __( ' truck', 'portfolioo'), 
        'fa-wheelchair' => __( ' wheelchair', 'portfolioo'), 
        'fa-genderless' => __( ' genderless', 'portfolioo'), 
        'fa-intersex' => __( ' intersex', 'portfolioo'), 
        'fa-mars' => __( ' mars', 'portfolioo'), 
        'fa-mars-double' => __( ' mars-double', 'portfolioo'), 
        'fa-mars-stroke' => __( ' mars-stroke', 'portfolioo'), 
        'fa-mars-stroke-h' => __( ' mars-stroke-h', 'portfolioo'), 
        'fa-mars-stroke-v' => __( ' mars-stroke-v', 'portfolioo'), 
        'fa-mercury' => __( ' mercury', 'portfolioo'), 
        'fa-neuter' => __( ' neuter', 'portfolioo'), 
        'fa-transgender' => __( ' transgender', 'portfolioo'), 
        'fa-transgender-alt' => __( ' transgender-alt', 'portfolioo'), 
        'fa-venus' => __( ' venus', 'portfolioo'), 
        'fa-venus-double' => __( ' venus-double', 'portfolioo'), 
        'fa-venus-mars' => __( ' venus-mars', 'portfolioo'), 
        'fa-file' => __( ' file', 'portfolioo'), 
        'fa-file-archive-o' => __( ' file-archive-o', 'portfolioo'), 
        'fa-file-audio-o' => __( ' file-audio-o', 'portfolioo'), 
        'fa-file-code-o' => __( ' file-code-o', 'portfolioo'), 
        'fa-file-excel-o' => __( ' file-excel-o', 'portfolioo'), 
        'fa-file-image-o' => __( ' file-image-o', 'portfolioo'), 
        'fa-file-movie-o' => __( ' file-movie-o', 'portfolioo'), 
        'fa-file-o' => __( ' file-o', 'portfolioo'), 
        'fa-file-pdf-o' => __( ' file-pdf-o', 'portfolioo'), 
        'fa-file-photo-o' => __( ' file-photo-o', 'portfolioo'), 
        'fa-file-picture-o' => __( ' file-picture-o', 'portfolioo'), 
        'fa-file-powerpoint-o' => __( ' file-powerpoint-o', 'portfolioo'), 
        'fa-file-sound-o' => __( ' file-sound-o', 'portfolioo'), 
        'fa-file-text' => __( ' file-text', 'portfolioo'), 
        'fa-file-text-o' => __( ' file-text-o', 'portfolioo'), 
        'fa-file-video-o' => __( ' file-video-o', 'portfolioo'), 
        'fa-file-word-o' => __( ' file-word-o', 'portfolioo'), 
        'fa-file-zip-o' => __( ' file-zip-o', 'portfolioo'), 
        'fa-circle-o-notch' => __( ' circle-o-notch', 'portfolioo'), 
        'fa-cog' => __( ' cog', 'portfolioo'), 
        'fa-gear' => __( ' gear', 'portfolioo'), 
        'fa-refresh' => __( ' refresh', 'portfolioo'), 
        'fa-spinner' => __( ' spinner', 'portfolioo'), 
        'fa-check-square' => __( ' check-square', 'portfolioo'), 
        'fa-check-square-o' => __( ' check-square-o', 'portfolioo'), 
        'fa-circle' => __( ' circle', 'portfolioo'), 
        'fa-circle-o' => __( ' circle-o', 'portfolioo'), 
        'fa-dot-circle-o' => __( ' dot-circle-o', 'portfolioo'), 
        'fa-minus-square' => __( ' minus-square', 'portfolioo'), 
        'fa-minus-square-o' => __( ' minus-square-o', 'portfolioo'), 
        'fa-plus-square' => __( ' plus-square', 'portfolioo'), 
        'fa-plus-square-o' => __( ' plus-square-o', 'portfolioo'), 
        'fa-square' => __( ' square', 'portfolioo'), 
        'fa-square-o' => __( ' square-o', 'portfolioo'), 
        'fa-cc-amex' => __( ' cc-amex', 'portfolioo'), 
        'fa-cc-diners-club' => __( ' cc-diners-club', 'portfolioo'), 
        'fa-cc-discover' => __( ' cc-discover', 'portfolioo'), 
        'fa-cc-jcb' => __( ' cc-jcb', 'portfolioo'), 
        'fa-cc-mastercard' => __( ' cc-mastercard', 'portfolioo'), 
        'fa-cc-paypal' => __( ' cc-paypal', 'portfolioo'), 
        'fa-cc-stripe' => __( ' cc-stripe', 'portfolioo'), 
        'fa-cc-visa' => __( ' cc-visa', 'portfolioo'), 
        'fa-credit-card' => __( ' credit-card', 'portfolioo'), 
        'fa-google-wallet' => __( ' google-wallet', 'portfolioo'), 
        'fa-paypal' => __( ' paypal', 'portfolioo'), 
        'fa-area-chart' => __( ' area-chart', 'portfolioo'), 
        'fa-bar-chart' => __( ' bar-chart', 'portfolioo'), 
        'fa-bar-chart-o' => __( ' bar-chart-o', 'portfolioo'), 
        'fa-line-chart' => __( ' line-chart', 'portfolioo'), 
        'fa-pie-chart' => __( ' pie-chart', 'portfolioo'), 
        'fa-bitcoin' => __( ' bitcoin', 'portfolioo'), 
        'fa-btc' => __( ' btc', 'portfolioo'), 
        'fa-cny' => __( ' cny', 'portfolioo'), 
        'fa-dollar' => __( ' dollar', 'portfolioo'), 
        'fa-eur' => __( ' eur', 'portfolioo'), 
        'fa-euro' => __( ' euro', 'portfolioo'), 
        'fa-gbp' => __( ' gbp', 'portfolioo'), 
        'fa-gg' => __( ' gg', 'portfolioo'), 
        'fa-gg-circle' => __( ' gg-circle', 'portfolioo'), 
        'fa-ils' => __( ' ils', 'portfolioo'), 
        'fa-inr' => __( ' inr', 'portfolioo'), 
        'fa-jpy' => __( ' jpy', 'portfolioo'), 
        'fa-krw' => __( ' krw', 'portfolioo'), 
        'fa-money' => __( ' money', 'portfolioo'), 
        'fa-rmb' => __( ' rmb', 'portfolioo'), 
        'fa-rouble' => __( ' rouble', 'portfolioo'), 
        'fa-rub' => __( ' rub', 'portfolioo'), 
        'fa-ruble' => __( ' ruble', 'portfolioo'), 
        'fa-rupee' => __( ' rupee', 'portfolioo'), 
        'fa-shekel' => __( ' shekel', 'portfolioo'), 
        'fa-sheqel' => __( ' sheqel', 'portfolioo'), 
        'fa-try' => __( ' try', 'portfolioo'), 
        'fa-turkish-lira' => __( ' turkish-lira', 'portfolioo'), 
        'fa-won' => __( ' won', 'portfolioo'), 
        'fa-yen' => __( ' yen', 'portfolioo'), 
        'fa-align-center' => __( ' align-center', 'portfolioo'), 
        'fa-align-justify' => __( ' align-justify', 'portfolioo'), 
        'fa-align-left' => __( ' align-left', 'portfolioo'), 
        'fa-align-right' => __( ' align-right', 'portfolioo'), 
        'fa-bold' => __( ' bold', 'portfolioo'), 
        'fa-chain' => __( ' chain', 'portfolioo'), 
        'fa-chain-broken' => __( ' chain-broken', 'portfolioo'), 
        'fa-clipboard' => __( ' clipboard', 'portfolioo'), 
        'fa-columns' => __( ' columns', 'portfolioo'), 
        'fa-copy' => __( ' copy', 'portfolioo'), 
        'fa-cut' => __( ' cut', 'portfolioo'), 
        'fa-dedent' => __( ' dedent', 'portfolioo'), 
        'fa-eraser' => __( ' eraser', 'portfolioo'), 
        'fa-file' => __( ' file', 'portfolioo'), 
        'fa-file-o' => __( ' file-o', 'portfolioo'), 
        'fa-file-text' => __( ' file-text', 'portfolioo'), 
        'fa-file-text-o' => __( ' file-text-o', 'portfolioo'), 
        'fa-files-o' => __( ' files-o', 'portfolioo'), 
        'fa-floppy-o' => __( ' floppy-o', 'portfolioo'), 
        'fa-font' => __( ' font', 'portfolioo'), 
        'fa-header' => __( ' header', 'portfolioo'), 
        'fa-indent' => __( ' indent', 'portfolioo'), 
        'fa-italic' => __( ' italic', 'portfolioo'), 
        'fa-link' => __( ' link', 'portfolioo'), 
        'fa-list' => __( ' list', 'portfolioo'), 
        'fa-list-alt' => __( ' list-alt', 'portfolioo'), 
        'fa-list-ol' => __( ' list-ol', 'portfolioo'), 
        'fa-list-ul' => __( ' list-ul', 'portfolioo'), 
        'fa-outdent' => __( ' outdent', 'portfolioo'), 
        'fa-paperclip' => __( ' paperclip', 'portfolioo'), 
        'fa-paragraph' => __( ' paragraph', 'portfolioo'), 
        'fa-paste' => __( ' paste', 'portfolioo'), 
        'fa-repeat' => __( ' repeat', 'portfolioo'), 
        'fa-rotate-left' => __( ' rotate-left', 'portfolioo'), 
        'fa-rotate-right' => __( ' rotate-right', 'portfolioo'), 
        'fa-save' => __( ' save', 'portfolioo'), 
        'fa-scissors' => __( ' scissors', 'portfolioo'), 
        'fa-strikethrough' => __( ' strikethrough', 'portfolioo'), 
        'fa-subscript' => __( ' subscript', 'portfolioo'), 
        'fa-superscript' => __( ' superscript', 'portfolioo'), 
        'fa-table' => __( ' table', 'portfolioo'), 
        'fa-text-height' => __( ' text-height', 'portfolioo'), 
        'fa-text-width' => __( ' text-width', 'portfolioo'), 
        'fa-th' => __( ' th', 'portfolioo'), 
        'fa-th-large' => __( ' th-large', 'portfolioo'), 
        'fa-th-list' => __( ' th-list', 'portfolioo'), 
        'fa-underline' => __( ' underline', 'portfolioo'), 
        'fa-undo' => __( ' undo', 'portfolioo'), 
        'fa-unlink' => __( ' unlink', 'portfolioo'), 
        'fa-angle-double-down' => __( ' angle-double-down', 'portfolioo'), 
        'fa-angle-double-left' => __( ' angle-double-left', 'portfolioo'), 
        'fa-angle-double-right' => __( ' angle-double-right', 'portfolioo'), 
        'fa-angle-double-up' => __( ' angle-double-up', 'portfolioo'), 
        'fa-angle-down' => __( ' angle-down', 'portfolioo'), 
        'fa-angle-left' => __( ' angle-left', 'portfolioo'), 
        'fa-angle-right' => __( ' angle-right', 'portfolioo'), 
        'fa-angle-up' => __( ' angle-up', 'portfolioo'), 
        'fa-arrow-circle-down' => __( ' arrow-circle-down', 'portfolioo'), 
        'fa-arrow-circle-left' => __( ' arrow-circle-left', 'portfolioo'), 
        'fa-arrow-circle-o-down' => __( ' arrow-circle-o-down', 'portfolioo'), 
        'fa-arrow-circle-o-left' => __( ' arrow-circle-o-left', 'portfolioo'), 
        'fa-arrow-circle-o-right' => __( ' arrow-circle-o-right', 'portfolioo'), 
        'fa-arrow-circle-o-up' => __( ' arrow-circle-o-up', 'portfolioo'), 
        'fa-arrow-circle-right' => __( ' arrow-circle-right', 'portfolioo'), 
        'fa-arrow-circle-up' => __( ' arrow-circle-up', 'portfolioo'), 
        'fa-arrow-down' => __( ' arrow-down', 'portfolioo'), 
        'fa-arrow-left' => __( ' arrow-left', 'portfolioo'), 
        'fa-arrow-right' => __( ' arrow-right', 'portfolioo'), 
        'fa-arrow-up' => __( ' arrow-up', 'portfolioo'), 
        'fa-arrows' => __( ' arrows', 'portfolioo'), 
        'fa-arrows-alt' => __( ' arrows-alt', 'portfolioo'), 
        'fa-arrows-h' => __( ' arrows-h', 'portfolioo'), 
        'fa-arrows-v' => __( ' arrows-v', 'portfolioo'), 
        'fa-caret-down' => __( ' caret-down', 'portfolioo'), 
        'fa-caret-left' => __( ' caret-left', 'portfolioo'), 
        'fa-caret-right' => __( ' caret-right', 'portfolioo'), 
        'fa-caret-square-o-down' => __( ' caret-square-o-down', 'portfolioo'), 
        'fa-caret-square-o-left' => __( ' caret-square-o-left', 'portfolioo'), 
        'fa-caret-square-o-right' => __( ' caret-square-o-right', 'portfolioo'), 
        'fa-caret-square-o-up' => __( ' caret-square-o-up', 'portfolioo'), 
        'fa-caret-up' => __( ' caret-up', 'portfolioo'), 
        'fa-chevron-circle-down' => __( ' chevron-circle-down', 'portfolioo'), 
        'fa-chevron-circle-left' => __( ' chevron-circle-left', 'portfolioo'), 
        'fa-chevron-circle-right' => __( ' chevron-circle-right', 'portfolioo'), 
        'fa-chevron-circle-up' => __( ' chevron-circle-up', 'portfolioo'), 
        'fa-chevron-left' => __( ' chevron-left', 'portfolioo'), 
        'fa-chevron-right' => __( ' chevron-right', 'portfolioo'), 
        'fa-chevron-up' => __( ' chevron-up', 'portfolioo'), 
        'fa-exchange' => __( ' exchange', 'portfolioo'), 
        'fa-hand-o-down' => __( ' hand-o-down', 'portfolioo'), 
        'fa-hand-o-left' => __( ' hand-o-left', 'portfolioo'), 
        'fa-hand-o-right' => __( ' hand-o-right', 'portfolioo'), 
        'fa-hand-o-up' => __( ' hand-o-up', 'portfolioo'), 
        'fa-long-arrow-down' => __( ' long-arrow-down', 'portfolioo'), 
        'fa-long-arrow-left' => __( ' long-arrow-left', 'portfolioo'), 
        'fa-long-arrow-right' => __( ' long-arrow-right', 'portfolioo'), 
        'fa-long-arrow-up' => __( ' long-arrow-up', 'portfolioo'), 
        'fa-toggle-down' => __( ' toggle-down', 'portfolioo'), 
        'fa-toggle-left' => __( ' toggle-left', 'portfolioo'), 
        'fa-toggle-right' => __( ' toggle-right', 'portfolioo'), 
        'fa-toggle-up' => __( ' toggle-up', 'portfolioo'), 
        'fa-arrows-alt' => __( ' arrows-alt', 'portfolioo'), 
        'fa-backward' => __( ' backward', 'portfolioo'), 
        'fa-compress' => __( ' compress', 'portfolioo'), 
        'fa-eject' => __( ' eject', 'portfolioo'), 
        'fa-expand' => __( ' expand', 'portfolioo'), 
        'fa-fast-backward' => __( ' fast-backward', 'portfolioo'), 
        'fa-fast-forward' => __( ' fast-forward', 'portfolioo'), 
        'fa-forward' => __( ' forward', 'portfolioo'), 
        'fa-pause' => __( ' pause', 'portfolioo'), 
        'fa-play' => __( ' play', 'portfolioo'), 
        'fa-play-circle' => __( ' play-circle', 'portfolioo'), 
        'fa-play-circle-o' => __( ' play-circle-o', 'portfolioo'), 
        'fa-random' => __( ' random', 'portfolioo'), 
        'fa-step-backward' => __( ' step-backward', 'portfolioo'), 
        'fa-step-forward' => __( ' step-forward', 'portfolioo'), 
        'fa-stop' => __( ' stop', 'portfolioo'), 
        'fa-youtube-play' => __( ' youtube-play', 'portfolioo'), 
        'fa-500px' => __( ' 500px', 'portfolioo'), 
        'fa-adn' => __( ' adn', 'portfolioo'), 
        'fa-amazon' => __( ' amazon', 'portfolioo'), 
        'fa-android' => __( ' android', 'portfolioo'), 
        'fa-angellist' => __( ' angellist', 'portfolioo'), 
        'fa-apple' => __( ' apple', 'portfolioo'), 
        'fa-behance' => __( ' behance', 'portfolioo'), 
        'fa-behance-square' => __( ' behance-square', 'portfolioo'), 
        'fa-bitbucket' => __( ' bitbucket', 'portfolioo'), 
        'fa-bitbucket-square' => __( ' bitbucket-square', 'portfolioo'), 
        'fa-bitcoin' => __( ' bitcoin', 'portfolioo'), 
        'fa-black-tie' => __( ' black-tie', 'portfolioo'), 
        'fa-btc' => __( ' btc', 'portfolioo'), 
        'fa-buysellads' => __( ' buysellads', 'portfolioo'), 
        'fa-cc-amex' => __( ' cc-amex', 'portfolioo'), 
        'fa-cc-diners-club' => __( ' cc-diners-club', 'portfolioo'), 
        'fa-cc-discover' => __( ' cc-discover', 'portfolioo'), 
        'fa-cc-jcb' => __( ' cc-jcb', 'portfolioo'), 
        'fa-cc-mastercard' => __( ' cc-mastercard', 'portfolioo'), 
        'fa-cc-paypal' => __( ' cc-paypal', 'portfolioo'), 
        'fa-cc-stripe' => __( ' cc-stripe', 'portfolioo'), 
        'fa-cc-visa' => __( ' cc-visa', 'portfolioo'), 
        'fa-chrome' => __( ' chrome', 'portfolioo'), 
        'fa-codepen' => __( ' codepen', 'portfolioo'), 
        'fa-connectdevelop' => __( ' connectdevelop', 'portfolioo'), 
        'fa-contao' => __( ' contao', 'portfolioo'), 
        'fa-css3' => __( ' css3', 'portfolioo'), 
        'fa-dashcube' => __( ' dashcube', 'portfolioo'), 
        'fa-delicious' => __( ' delicious', 'portfolioo'), 
        'fa-devianportfolioot' => __( ' devianportfolioot', 'portfolioo'), 
        'fa-digg' => __( ' digg', 'portfolioo'), 
        'fa-dribbble' => __( ' dribbble', 'portfolioo'), 
        'fa-dropbox' => __( ' dropbox', 'portfolioo'), 
        'fa-drupal' => __( ' drupal', 'portfolioo'), 
        'fa-empire' => __( ' empire', 'portfolioo'), 
        'fa-expeditedssl' => __( ' expeditedssl', 'portfolioo'), 
        'fa-facebook' => __( ' facebook', 'portfolioo'), 
        'fa-facebook-f' => __( ' facebook-f', 'portfolioo'), 
        'fa-facebook-official' => __( ' facebook-official', 'portfolioo'), 
        'fa-facebook-square' => __( ' facebook-square', 'portfolioo'), 
        'fa-firefox' => __( ' firefox', 'portfolioo'), 
        'fa-flickr' => __( ' flickr', 'portfolioo'), 
        'fa-fonticons' => __( ' fonticons', 'portfolioo'), 
        'fa-forumbee' => __( ' forumbee', 'portfolioo'), 
        'fa-foursquare' => __( ' foursquare', 'portfolioo'), 
        'fa-ge' => __( ' ge', 'portfolioo'), 
        'fa fa-get-pocket' => __( ' get-pocket', 'portfolioo'), 
        'fa-gg' => __( ' gg', 'portfolioo'), 
        'fa-gg-circle' => __( ' gg-circle', 'portfolioo'), 
        'fa-git' => __( ' git', 'portfolioo'), 
        'fa-git-square' => __( ' git-square', 'portfolioo'), 
        'fa-github' => __( ' github', 'portfolioo'), 
        'fa-github-alt' => __( ' github-alt', 'portfolioo'), 
        'fa-github-square' => __( ' github-square', 'portfolioo'), 
        'fa-gittip' => __( ' gittip', 'portfolioo'), 
        'fa-google' => __( ' google', 'portfolioo'), 
        'fa-google-plus' => __( ' google-plus', 'portfolioo'), 
        'fa-google-plus-square' => __( ' google-plus-square', 'portfolioo'), 
        'fa-google-wallet' => __( ' google-wallet', 'portfolioo'), 
        'fa-gratipay' => __( ' gratipay', 'portfolioo'), 
        'fa-hacker-news' => __( ' hacker-news', 'portfolioo'), 
        'fa-houzz' => __( ' houzz', 'portfolioo'), 
        'fa-html5' => __( ' html5', 'portfolioo'), 
        'fa-instagram' => __( ' instagram', 'portfolioo'), 
        'fa-internet-explorer' => __( ' internet-explorer', 'portfolioo'), 
        'fa-ioxhost' => __( ' ioxhost', 'portfolioo'), 
        'fa-joomla' => __( ' joomla', 'portfolioo'), 
        'fa-jsfiddle' => __( ' jsfiddle', 'portfolioo'), 
        'fa-lastfm' => __( ' lastfm', 'portfolioo'), 
        'fa-lastfm-square' => __( ' lastfm-square', 'portfolioo'), 
        'fa-leanpub' => __( ' leanpub', 'portfolioo'), 
        'fa-linkedin' => __( ' linkedin', 'portfolioo'), 
        'fa-linkedin-square' => __( ' linkedin-square', 'portfolioo'), 
        'fa-linux' => __( ' linux', 'portfolioo'), 
        'fa-maxcdn' => __( ' maxcdn', 'portfolioo'), 
        'fa-meanpath' => __( ' meanpath', 'portfolioo'), 
        'fa-medium' => __( ' medium', 'portfolioo'), 
        'fa-odnoklassniki' => __( ' odnoklassniki', 'portfolioo'), 
        'fa-odnoklassniki-square' => __( ' odnoklassniki-square', 'portfolioo'), 
        'fa-opencart' => __( ' opencart', 'portfolioo'), 
        'fa-openid' => __( ' openid', 'portfolioo'), 
        'fa-opera' => __( ' opera', 'portfolioo'), 
        'fa-optin-monster' => __( ' optin-monster', 'portfolioo'), 
        'fa-pagelines' => __( ' pagelines', 'portfolioo'), 
        'fa-paypal' => __( ' paypal', 'portfolioo'), 
        'fa-pied-piper' => __( ' pied-piper', 'portfolioo'), 
        'fa-pied-piper-alt' => __( ' pied-piper-alt', 'portfolioo'), 
        'fa-pinterest' => __( ' pinterest', 'portfolioo'), 
        'fa-pinterest-p' => __( ' pinterest-p', 'portfolioo'), 
        'fa-pinterest-square' => __( ' pinterest-square', 'portfolioo'), 
        'fa-qq' => __( ' qq', 'portfolioo'), 
        'fa-ra' => __( ' ra', 'portfolioo'), 
        'fa-rebel' => __( ' rebel', 'portfolioo'), 
        'fa-reddit' => __( ' reddit', 'portfolioo'), 
        'fa-reddit-square' => __( ' reddit-square', 'portfolioo'), 
        'fa-renren' => __( ' renren', 'portfolioo'), 
        'fa-safari' => __( ' safari', 'portfolioo'), 
        'fa-sellsy' => __( ' sellsy', 'portfolioo'), 
        'fa-share-alt' => __( ' share-alt', 'portfolioo'), 
        'fa-share-alt-square' => __( ' share-alt-square', 'portfolioo'), 
        'fa-shirtsinbulk' => __( ' shirtsinbulk', 'portfolioo'), 
        'fa-simplybuilt' => __( ' simplybuilt', 'portfolioo'), 
        'fa-skyatlas' => __( ' skyatlas', 'portfolioo'), 
        'fa-skype' => __( ' skype', 'portfolioo'), 
        'fa-slack' => __( ' slack', 'portfolioo'), 
        'fa-slideshare' => __( ' slideshare', 'portfolioo'), 
        'fa-soundcloud' => __( ' soundcloud', 'portfolioo'), 
        'fa-spotify' => __( ' spotify', 'portfolioo'), 
        'fa-stack-exchange' => __( ' stack-exchange', 'portfolioo'), 
        'fa-stack-overflow' => __( ' stack-overflow', 'portfolioo'), 
        'fa-steam' => __( ' steam', 'portfolioo'), 
        'fa-steam-square' => __( ' steam-square', 'portfolioo'), 
        'fa-stumbleupon' => __( ' stumbleupon', 'portfolioo'), 
        'fa-stumbleupon-circle' => __( ' stumbleupon-circle', 'portfolioo'), 
        'fa-tencent-weibo' => __( ' tencent-weibo', 'portfolioo'), 
        'fa-trello' => __( ' trello', 'portfolioo'), 
        'fa-tripadvisor' => __( ' tripadvisor', 'portfolioo'), 
        'fa-tumblr' => __( ' tumblr', 'portfolioo'), 
        'fa-tumblr-square' => __( ' tumblr-square', 'portfolioo'), 
        'fa-twitch' => __( ' twitch', 'portfolioo'), 
        'fa-twitter' => __( ' twitter', 'portfolioo'), 
        'fa-twitter-square' => __( ' twitter-square', 'portfolioo'), 
        'fa-viacoin' => __( ' viacoin', 'portfolioo'), 
        'fa-vimeo' => __( ' vimeo', 'portfolioo'), 
        'fa-vimeo-square' => __( ' vimeo-square', 'portfolioo'), 
        'fa-vine' => __( ' vine', 'portfolioo'), 
        'fa-vk' => __( ' vk', 'portfolioo'), 
        'fa-wechat' => __( ' wechat', 'portfolioo'), 
        'fa-weibo' => __( ' weibo', 'portfolioo'), 
        'fa-weixin' => __( ' weixin', 'portfolioo'), 
        'fa-whatsapp' => __( ' whatsapp', 'portfolioo'), 
        'fa-wikipedia-w' => __( ' wikipedia-w', 'portfolioo'), 
        'fa-windows' => __( ' windows', 'portfolioo'), 
        'fa-wordpress' => __( ' wordpress', 'portfolioo'), 
        'fa-xing' => __( ' xing', 'portfolioo'), 
        'fa-xing-square' => __( ' xing-square', 'portfolioo'), 
        'fa-y-combinator' => __( ' y-combinator', 'portfolioo'), 
        'fa-y-combinator-square' => __( ' y-combinator-square', 'portfolioo'), 
        'fa-yahoo' => __( ' yahoo', 'portfolioo'), 
        'fa-yc' => __( ' yc', 'portfolioo'), 
        'fa-yc-square' => __( ' yc-square', 'portfolioo'), 
        'fa-yelp' => __( ' yelp', 'portfolioo'), 
        'fa-youtube' => __( ' youtube', 'portfolioo'), 
        'fa-youtube-play' => __( ' youtube-play', 'portfolioo'), 
        'fa-youtube-square' => __( ' youtube-square', 'portfolioo'), 
        'fa-ambulance' => __( ' ambulance', 'portfolioo'), 
        'fa-h-square' => __( ' h-square', 'portfolioo'), 
        'fa-heart' => __( ' heart', 'portfolioo'), 
        'fa-heart-o' => __( ' heart-o', 'portfolioo'), 
        'fa-heartbeat' => __( ' heartbeat', 'portfolioo'), 
        'fa-hospital-o' => __( ' hospital-o', 'portfolioo'), 
        'fa-medkit' => __( ' medkit', 'portfolioo'), 
        'fa-plus-square' => __( ' plus-square', 'portfolioo'), 
        'fa-stethoscope' => __( ' stethoscope', 'portfolioo'), 
        'fa-user-md' => __( ' user-md', 'portfolioo'), 
        'fa-wheelchair' => __( ' wheelchair', 'portfolioo') 
        );
}