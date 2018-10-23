<?php

/**
 * Redirect to Getting Started page on theme activation
 */
function portfolioo_redirect_on_activation() {
	global $pagenow;

	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

		wp_redirect( admin_url( "themes.php?page=portfolioo-getting-started" ) );

	}
}
add_action( 'admin_init', 'portfolioo_redirect_on_activation' );

function portfolioo_start_load_admin_scripts() {

	// Load styles only on our page
	global $pagenow;
	if( 'themes.php' != $pagenow )
		return;

	wp_register_style( 'portfolioo-getting-started', get_template_directory_uri() . '/inc/dashboard/portfolioo-info-dashboard.css', false, '1.0.0' );
	wp_enqueue_style( 'portfolioo-getting-started' );
}

add_action( 'admin_enqueue_scripts', 'portfolioo_start_load_admin_scripts' );


/* Hook a menu under Appearance */
function portfolioo_getting_started_menu() {
	add_theme_page(
		esc_attr__( 'Portfolioo: Get Started', 'portfolioo' ),
		esc_attr__( 'Portfolioo: Get Started', 'portfolioo' ),
		'manage_options',
		'portfolioo-getting-started',
		'portfolioo_getting_started'
	);
}

add_action( 'admin_menu', 'portfolioo_getting_started_menu' );



/**
 * Theme Info Page
 */
function portfolioo_getting_started() {

	// Theme info
	$theme = wp_get_theme( 'portfolioo' );
?>

		<div class="wrap getting-started">
		<div class="getting-started__header">
		<div class="row">
			<div class="col-md-5 intro">
				<h2 class="center"><?php esc_html_e( 'Welcome to Portfolioo', 'portfolioo' ); ?></h2>
				<p class="center"><?php esc_html_e('Version:', 'portfolioo'); ?> <?php echo $theme['Version'];?></p>
				<p class="intro__version center">
				<?php esc_html_e( 'Thank you for installing Portfolioo! You Can Now Build Your Own Online Portfolio', 'portfolioo' ); ?> 
				</p>

		<!-- 	<div class="club-discount"> -->
				<!-- <p><strong> --><?php //esc_html_e( 'Exclusive 15% Discount!', 'portfolioo' ); ?><!-- </strong></p> -->
				<!-- <p> --><?php
						//$themes_link = '<code><strong>15PERCENT</strong></code>';
						//printf( __( 'Use the code %s to get 15&#37; off when you purchase portfolioo Pro! For <strong>this month only</strong>', 'portfolioo' ), $themes_link );
					?>
				<!-- </p>
			</div> 
			</div> -->

		<!-- 	<div class="col-md-7">
			<div class="dashboard__block block--pro">
				<h3>Why buy Tar pro</h3>
				<img src="<?php echo get_template_directory_uri() . '/assets/images/front-page-layouts.jpg'; ?>" alt="<?php esc_html_e( 'Why Upgrade To portfolioo Pro', 'portfolioo' ); ?>" />
			</div>
			</div> -->
			<h3 class="dashboard__why_buy"><?php esc_html_e('Why Upgrade To Portfolioo Pro?', 'portfolioo'); ?></h3>
			<div class="col-md-12 text-block" style="padding-top: 2%;">
			<div class="row">
					<div class="col-md-7 dashboard-upgrade-left">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/frontpage-stunning-templates.jpg'; ?>" alt="<?php esc_html_e( 'Why Upgrade To Portfolioo Pro', 'portfolioo' ); ?>" />
					</div>
					<div class="col-md-5 dashboard-upgrade-right">
					<h2 class="dashboard-upgrade-title"><?php esc_html_e('Beautiful Widgets', 'portfolioo'); ?></h2>
					<span class="dashboard-upgrade-button"><a href="https://asphaltthemes.com/portfolioo#buy_pro&utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link" target="_blank"><?php esc_html_e('Upgrade', 'portfolioo'); ?></a></span>
					<p><?php esc_html_e('Top notch beautiful widgets', 'portfolioo'); ?></p>
					<div class="dashboard-upgrade-benefit">
					<ul>
						<li><?php esc_html_e('25 Frontpage Widget', 'portfolioo'); ?></li>
						<li><?php esc_html_e('12 Different Type of Widgets', 'portfolioo'); ?></li>
						<li><?php esc_html_e('Check out the', 'portfolioo'); ?> <a target="_blank" href="<?php echo esc_url('https://asphaltthemes.com/portfolioo#demos&utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link'); ?>"><?php esc_html_e('Portfolioo Demos', 'portfolioo'); ?></a></li>
					</ul>

					</div>
					</div>
			</div>
			</div>


			<div class="clearfix"></div>
			<div class="dashboard_div_divider"></div>
			<div class="col-md-12 text-block no-bottom-margin">
			<div class="row">
					<div class="col-md-7 dashboard-upgrade-left">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/template.png'; ?>" alt="<?php esc_html_e( 'One Click Import', 'portfolioo' ); ?>">
					</div>
					<div class="col-md-5 dashboard-upgrade-right">
					<h2 class="dashboard-upgrade-title"><?php esc_attr_e('One Click Import', 'portfolioo'); ?></h2>
					<span class="dashboard-upgrade-button"><a href="https://asphaltthemes.com/portfolioo#buy_pro&utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link" target="_blank"><?php esc_html_e('Upgrade', 'portfolioo'); ?></a></span>
					<p><?php esc_html_e('Easy One click demo import', 'portfolioo'); ?></p>
					<div class="dashboard-upgrade-benefit">
					<ul>
						<li><?php esc_html_e('16 Prebuilt templates to kickstart', 'portfolioo'); ?></li>
						<li><?php esc_html_e('Say goodbye to complicated site setup', 'portfolioo'); ?></li>
						<li><?php esc_html_e('Lots of Portfolio templates at your fingertip', 'portfolioo'); ?></li>
					</ul>

					</div>
					</div>
			</div>
			</div>

			<div class="clearfix"></div>
			<div class="dashboard_div_divider"></div>
			<div class="col-md-12 text-block no-bottom-margin">
			<div class="row">
					<div class="col-md-7 dashboard-upgrade-left">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/sleek-design.jpg'; ?>" alt="<?php esc_html_e( 'Sleek Design', 'portfolioo' ); ?>">
					</div>
					<div class="col-md-5 dashboard-upgrade-right">
					<h2 class="dashboard-upgrade-title"><?php esc_html_e( 'Sleek Design', 'portfolioo'); ?></h2>
					<span class="dashboard-upgrade-button"><a href="https://asphaltthemes.com/portfolioo#buy_pro&utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link" target="_blank"><?php esc_html_e( 'Upgrade', 'portfolioo'); ?></a></span>
					<p><?php esc_html_e( 'Industry Standard Design', 'portfolioo'); ?></p>
					<div class="dashboard-upgrade-benefit">
					<ul>
						<li><?php esc_html_e( 'Your Portfolio will stand out', 'portfolioo'); ?></li>
						<li><?php esc_html_e( 'Less Cluttred Design', 'portfolioo'); ?></li>

						<li><?php esc_html_e( 'WOW your site visitors', 'portfolioo'); ?></li>
					</ul>

					</div>
					</div>
			</div>
			</div>
			<div class="clearfix"></div><div class="dashboard_div_divider"></div>
			<div class="col-md-12 text-block no-bottom-margin">
				<div class="row">
					<div class="col-md-7 dashboard-upgrade-left">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/extended-customization.jpg'; ?>" alt="<?php esc_html_e( 'Advance Widget Options', 'portfolioo' ); ?>">
					</div>
					<div class="col-md-5 dashboard-upgrade-right">
					<h2 class="dashboard-upgrade-title"><?php esc_html_e( 'Advance Widget Options', 'portfolioo'); ?></h2>
					<span class="dashboard-upgrade-button"><a href="https://asphaltthemes.com/portfolioo#buy_pro&utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link" target="_blank"><?php esc_html_e( 'Upgrade', 'portfolioo'); ?></a></span>
					<p><?php esc_html_e( 'Portfolioo Pro have', 'portfolioo'); ?></p>
					<div class="dashboard-upgrade-benefit">
					<ul>
						<li><?php esc_html_e( '25 Frontpage Widgets', 'portfolioo'); ?></li>
						<li><?php esc_html_e( '600+ Font Awesome Icons', 'portfolioo'); ?></li>
						<li><?php esc_html_e( 'Google Fonts', 'portfolioo'); ?></li>
						<li><?php esc_html_e( 'Integrated SEO Schema Markup', 'portfolioo'); ?></li>
						<li><?php esc_html_e( '6 Widget Area', 'portfolioo'); ?></li>
						<li><?php esc_html_e( '5 Page Template', 'portfolioo'); ?></li>
						<li><?php esc_html_e( 'Plugin Compatibility', 'portfolioo'); ?></li>
						<li><?php esc_html_e( 'Dedicate Support Forum', 'portfolioo'); ?></li>
						<li><?php esc_html_e( 'Extra Widget Options', 'portfolioo'); ?></li>
						<li><?php esc_html_e( 'Lifetime Updates', 'portfolioo'); ?></li>
					</ul>

					</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div><div class="dashboard_div_divider"></div>

			<div class="col-md-12 text-block no-bottom-margin">
				<div class="row">
					<div class="col-md-7 dashboard-upgrade-left">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/less-clutter.jpg'; ?>" alt="<?php esc_html_e( 'More Powerful Options', 'portfolioo' ); ?>">
					</div>
					<div class="col-md-5 dashboard-upgrade-right">
					<h2 class="dashboard-upgrade-title"><?php esc_html_e( 'More powerful options', 'portfolioo' ); ?></h2>
					<span class="dashboard-upgrade-button"><a href="https://asphaltthemes.com/portfolioo#buy_pro&utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link" target="_blank"><?php esc_html_e( 'Upgrade', 'portfolioo' ); ?></a></span>
					<p><?php esc_html_e( 'With Portfolioo Pro You Get', 'portfolioo' ); ?></p>
					<div class="dashboard-upgrade-benefit">
					<ul>
						<li><?php esc_html_e( 'Express Support', 'portfolioo' ); ?></li>
						<li><?php esc_html_e( 'Extended Customizer Options', 'portfolioo' ); ?></li>
						<li><?php esc_html_e( 'Solid Code', 'portfolioo' ); ?></li>
						<li><?php esc_html_e( 'Extended Features', 'portfolioo' ); ?></li>
						<li><?php esc_html_e( 'Lifetime Updates', 'portfolioo' ); ?></li>
						<li><?php esc_html_e( 'Custom Widgets', 'portfolioo' ); ?></li>
						<li><?php esc_html_e( 'Super SEO Friendly', 'portfolioo' ); ?></li>
						<li><?php esc_html_e( 'One Click Updates', 'portfolioo' ); ?></li>
					</ul>

					</div>
					</div>
				</div>
			</div><div class="clearfix"></div>
			<div class="col-md-12 text-block no-bottom-margin">
				<div class="row">
					<div style="text-align: center;float: none;padding-top: 5%;" class="col-md-5 dashboard-upgrade-right">
					<h4 style="font-size: 20px;" class="dashboard-upgrade-title"><?php esc_html_e( '*7 day Money back guarantee.', 'portfolioo' ); ?></h4>
					<span  class="dashboard-upgrade-button"><a target="_blank" href="https://asphaltthemes.com/portfolioo#buy_pro&utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link" target="_blank"><?php esc_html_e( 'Upgrade', 'portfolioo' ); ?></a></span>
					
					</div>
				</div>
			</div>
			<div class="clearfix"></div><div class="dashboard_div_divider"></div>
		</div>
		</div>

			<div class="col-md-12 portfolioo__upgrade-info-box no-top-margin">
			<div class="row flexify--center">
				<div class="col-md-7">
					<h2><?php esc_html_e( 'Upgrade To Get The Most Out Of portfolioo Pro', 'portfolioo' ); ?></h2>
					<p><?php esc_html_e( 'Build your own clean & professional online Portfolio with portfolioo Pro. Upgrade now, comes with 7 refund policy.', 'portfolioo' ); ?></p>
				</div>

				<div class="col-md-5 dashboard-cta-right">
					<a target="_blank" class="theme__cta--download--pro" href="<?php echo esc_url('https://asphaltthemes.com/portfolioo#buy_pro&utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link'); ?>"><?php esc_html_e( 'Upgrade Now', 'portfolioo' ); ?></a>
					
				</div>
			</div>
			</div>



		<div class="dashboard__blocks">
			<div class="col-md-4">
				<h3><?php esc_html_e( 'Get Support', 'portfolioo' ); ?></h3>
				<ol>
					<li><?php esc_html_e( 'Portfolioo', 'portfolioo' ); ?> <a target="_blank" href="<?php echo esc_url('https://asphaltthemes.com/docs/portfolioo-pro/how-to-setup-front-page/#utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link'); ?>"><?php esc_html_e( 'Documentation', 'portfolioo' ); ?></a></li>
					<li><?php esc_html_e( 'WordPress.org', 'portfolioo' ); ?> <a target="_blank" href="<?php echo esc_url('https://wordpress.org/support/theme/portfolioo'); ?>"><?php esc_html_e( 'Support Forum', 'portfolioo' ); ?></a></li>
					<li><a target="_blank" href="<?php echo esc_url('https://asphaltthemes.com/contact/#utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link'); ?>"><?php esc_html_e( 'Email Support', 'portfolioo' ); ?></a></li>
				</ol>
			</div>

			<div class="col-md-4">
				<h3><?php esc_html_e( 'Getting Started', 'portfolioo' ); ?></h3>
				<ol>
					<li><?php esc_html_e( 'Start', 'portfolioo' ); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing', 'portfolioo' ); ?></a> <?php esc_html_e( 'your website', 'portfolioo' ); ?></li>
					<li><?php esc_html_e( 'Upgrade to Pro to unlock all features', 'portfolioo' ); ?></li>
				</ol>
			</div>

			<div class="col-md-4">
				<h3><?php esc_html_e( 'Theme Documentation', 'portfolioo' ); ?></h3>
				<ol>
					<li><a target="_blank" href="<?php echo esc_url('https://asphaltthemes.com/docs/portfolioo-pro/how-to-setup-front-page/#utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link'); ?>"><?php esc_html_e( 'How To Set up the Front Page', 'portfolioo' ); ?></a></li>
					<li><a target="_blank" href="<?php echo esc_url('https://asphaltthemes.com/docs/portfolioo-pro/upgrading-to-portfolioo-pro/#utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link'); ?>"><?php esc_html_e( 'Upgrading To portfolioo Pro', 'portfolioo' ); ?></a></li>
					<li><a target="_blank" href="<?php echo esc_url('https://asphaltthemes.com/docs/portfolioo-pro/basic-site-settings/#utm_source=org&utm_medium=portfoliotheme&utm_campaign=upsell_link'); ?>"><?php esc_html_e( 'Basic Site Settings', 'portfolioo' ); ?></a></li>
				</ol>
			</div>
		</div>

		</div><!-- .getting-started -->

	<?php
}