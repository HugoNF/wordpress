<?php
/**
 * Welcome page
 * Mainly based on blogger Theme Welcome page
 *
 * @package blogger-light
 */

// Add Theme page to menu
add_action('admin_menu', 'blogger_light_add_welcome_page');

function blogger_light_add_welcome_page(){

	if ( !current_user_can('install_plugins') ) {
		return;
	}

	$welcome = add_theme_page( __('Blogger Welcome', 'blogger-light'), __('Blogger Welcome', 'blogger-light'), 'manage_options', 'blogger-welcome.php', 'blogger_light_welcome_page' );
	add_action( 'load-' . $welcome, 'blogger_light_welcome_hook_styles' );
}

// Render Page
function blogger_light_welcome_page() {
	$user = wp_get_current_user(); ?>

	<div class="info-container">
		<p class="hello-user"><?php echo sprintf( __( 'Congratulations %s,', 'blogger-light' ), '<span>' . esc_html( ucfirst( $user->display_name ) ) . '</span>' ); ?></p>
		<h1 class="info-title"><?php echo sprintf( __( 'Welcome to Blogger Light %s', 'blogger-light' ), esc_html( wp_get_theme()->version ) ); ?></h1>
		<p class="welcome-desc"><?php esc_html_e( 'Blogger WordPress Theme is now installed and ready for customization. To make these steps as painless as possible, here are some recommended actions. Enjoy Blogger by NiteoThemes. ', 'blogger-light' ); ?>
	

		<div class="blogger-theme-tabs">

			<div class="blogger-tab-nav nav-tab-wrapper">
				<a href="#begin" data-target="begin" class="nav-button nav-tab begin active"><?php esc_html_e( 'Getting started', 'blogger-light' ); ?></a>
				<a href="#actions" data-target="actions" class="nav-button actions nav-tab"><?php esc_html_e( 'Recommended Actions', 'blogger-light' ); ?></a>
				<a href="#support" data-target="support" class="nav-button support nav-tab"><?php esc_html_e( 'Support', 'blogger-light' ); ?></a>
				<a href="#table" data-target="table" class="nav-button table nav-tab"><?php esc_html_e( 'Light vs Pro', 'blogger-light' ); ?></a>
			</div>

			<div class="blogger-tab-wrapper">

				<div id="#begin" class="blogger-tab begin show">
					<h3><?php esc_html_e( 'Step 1 - Implement recommended actions', 'blogger-light' ); ?></h3>
					<p><?php esc_html_e( 'We\'ve made a list of steps for you to follow to get the most of Blogger.', 'blogger-light' ); ?></p>
					<p><a class="actions" href="#actions"><?php esc_html_e( 'Check recommended actions', 'blogger-light' ); ?></a></p>
					<hr>
					<h3><?php esc_html_e( 'Step 2 - Read documentation', 'blogger-light' ); ?></h3>
					<p><?php esc_html_e( 'Our documentation includes basic steps how to install Theme, some tips and resources plus FAQ.', 'blogger-light' ); ?></p>
					<p><a href="https://niteothemes.com/docs/themes/blogger/" target="_blank"><?php esc_html_e( 'Documentation', 'blogger-light' ); ?></a></p>
					<hr>
					<h3><?php esc_html_e( 'Step 3 - Customize', 'blogger-light' ); ?></h3>
					<p><?php esc_html_e( 'Use the Customizer for many Blogger customization options.', 'blogger-light' ); ?></p>
					<p><a class="button button-primary button-large" href="<?php echo admin_url( 'customize.php' ); ?>"><?php esc_html_e( 'Go to Customizer', 'blogger-light' ); ?></a></p>
				</div>

				<div id="#actions" class="blogger-tab actions">				
					<h3><?php esc_html_e( 'Demo content', 'blogger-light' ); ?></h3>
					
					<div class="column-wrapper">
						<div class="tab-column">
						<h4><?php esc_html_e( 'Option 1 - automatic', 'blogger-light' ); ?></h4>
						<p><?php esc_html_e( 'Install the following plugin and then come back here to access the importer. With it you can import all demo content and change your homepage and blog page to the ones from our demo site, automatically. It will also assign a menu.', 'blogger-light' ); ?></p>
						

						<?php if ( !class_exists('OCDI_Plugin') ) :

							if ( !file_exists( WP_PLUGIN_DIR . '/one-click-demo-import' ) ) {
								$odi_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=one-click-demo-import'), 'install-plugin_one-click-demo-import'); ?>
								
								<p style="color:#ff0000;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin is not installed!', 'blogger-light' ); ?></p>
								<p>
									<a class="install-now button importer-install" href="<?php echo esc_url( $odi_url ); ?>"><?php esc_html_e( 'Install and Activate', 'blogger-light' ); ?></a>						
								</p>
								<?php 
							} else {
								$odi_url = self_admin_url('plugins.php'); ?>
								<p style="color:#ff0000;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin is installed but is not activated!', 'blogger-light' ); ?></p>
								<p>
									<a class="install-now button importer-install" href="<?php echo esc_url( $odi_url ); ?>"><?php esc_html_e( 'Go to Plugins and activate it.', 'blogger-light' ); ?></a>
								</p>
								<?php
							} ?>

						<?php else : ?>
							<p style="color:#23d423;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin installed and active!', 'blogger-light' ); ?></p>
							<a class="button button-primary button-large" href="<?php echo admin_url( 'themes.php?page=pt-one-click-demo-import.php' ); ?>"><?php esc_html_e( 'Go to the automatic importer', 'blogger-light' ); ?></a>
						<?php endif; ?>
						</div>
						<div class="tab-column">
						<h4><?php esc_html_e( 'Option 2 - manual', 'blogger-light' ); ?></h4>
						<p><?php esc_html_e( 'Download the following demo content zip file, unzip it and then click the button to go to the WordPress default importer.', 'blogger-light' ); ?></p>
							<a class="button" href="https://niteothemes.com/wp-content/uploads/2018/07/demo-blogger-light.zip"><?php esc_html_e( 'Download demo content', 'blogger-light' ); ?></a>
							<a class="button button-primary" href="<?php echo admin_url( 'import.php' ); ?>"><?php esc_html_e( 'Go to the manual importer', 'blogger-light' ); ?></a>
						</div>
					</div>
				</div>

				<div id="#support" class="blogger-tab support">
					<div class="column-wrapper">
						<div class="tab-column">
						<span class="dashicons dashicons-book-alt"></span>
						<h3><?php esc_html_e( 'Documentation', 'blogger-light' ); ?></h3>
						<p><?php esc_html_e( 'Our documentation can help you learn how to use the theme and also provides you with premade code snippets and answers to FAQs.', 'blogger-light' ); ?></p>
						<a href="https://niteothemes.com/docs/themes/blogger/" target="_blank"><?php esc_html_e( 'See the Documentation', 'blogger-light' ); ?></a>
						</div>
					</div>
				</div>

				<div id="#table" class="blogger-tab table">
				<table class="widefat fixed featuresList"> 
				   <thead> 
					<tr> 
					 <td><strong><h3><?php esc_html_e( 'Feature', 'blogger-light' ); ?></h3></strong></td>
					 <td style="width:20%;"><strong><h3><?php esc_html_e( 'Blogger Light', 'blogger-light' ); ?></h3></strong></td>
					 <td style="width:20%;"><strong><h3><?php esc_html_e( 'Blogger Pro', 'blogger-light' ); ?></h3></strong></td>
					</tr> 
				   </thead> 
				   <tbody> 
					<tr> 
					 <td><?php esc_html_e( 'Access to all Google Fonts', 'blogger-light' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Full Typography options', 'blogger-light' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Extensive Customizer options', 'blogger-light' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Responsive', 'blogger-light' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr>
					 <td><?php esc_html_e( 'Social Icons menu in Header and Footer', 'blogger-light' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Image or video header', 'blogger-light' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr>
					 <td><?php esc_html_e( 'Translation ready', 'blogger-light' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Full Width Page template', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Customizable Layout - full content 1-column or thumbnails 2-columns', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr>

					</tr> 
					 <td><?php esc_html_e( 'Complete Color options', 'blogger-light' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Background image support', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td c
					 lass="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Additional Layout: 3-columns thumbnails', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Sticky vs scrolling menu settings', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Polylang integration', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 

					<tr> 
					 <td><?php esc_html_e( 'Widgetized footer', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr>
					 <td><?php esc_html_e( 'Footer Credits option', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr>
					 <td><?php esc_html_e( 'Social Sharing button for posts', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Custom Shortcodes Plugin (Button, Masonry Gallery, Image Slider, Big First Letter, Text Underline, Hightlight Background)', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'Inifinite AJAX Loading', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

					<tr> 
					 <td><?php esc_html_e( 'WooCommerce integration (WC custom menu, WC custom Shop page, ..)', 'blogger-light' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 

				   </tbody> 
				  </table>
				  <p style="text-align: right;"><a class="button button-primary button-large" href="https://creativemarket.com/NiteoThemes/2571659-Blogger-WP-Blog-with-WooCommerce"><?php esc_html_e('Buy Blogger Pro ', 'blogger-light'); ?></a></p>
				</div>		
			</div>
		</div>
	</div>
<?php
}

//Styles
function blogger_light_welcome_hook_styles(){
	add_action( 'admin_enqueue_scripts', 'blogger_light_welcome_page_styles' );
}

function blogger_light_welcome_page_styles() {
	wp_enqueue_style( 'blogger-welcome-style', get_template_directory_uri() . '/css/welcome-page.css', array(), true );
	wp_enqueue_script( 'blogger-welcome-script', get_template_directory_uri() . '/js/welcome-page.js', array('jquery'),'', true );

}