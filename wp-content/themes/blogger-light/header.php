<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogger-light
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

<!-- Allow AJAX in WP -->
<script type="text/javascript">
     var ajaxurl = "<?php echo esc_url(admin_url( 'admin-ajax.php'));?>";
</script>

</head>

<body <?php body_class(); ?>>

<?php 
if ( get_theme_mod('display_search', true) ) { ?>
	<!-- search overlay -->
	<div id="search-overlay">
		<a href="#close-search" id="close-overlay">
			<em class="fa fa-times"></em>
		</a>
		<?php 

		get_search_form(); ?>
	</div>
	<?php 
} ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blogger-light' ); ?></a>

	<header id="masthead" class="site-header">
		<?php

		if ( is_front_page()  || ( is_archive() && (function_exists('is_shop') && !is_shop() ) ) ) {

			if ( has_header_image() && ( function_exists('has_header_video') && !has_header_video() ) ) {  ?>
				
				<a href="<?php echo esc_url( get_home_url() ); ?>">
					<div class="header-featured wp-custom-header" style="background-image: url('<?php echo esc_url( get_header_image() );?>');"></div>
				</a>
				<?php
			}

			if ( function_exists('has_header_video') && has_header_video() && !isMobile() ) {
				$video_url = get_header_video_url();
				$youtube = preg_match( '/youtube.com|youtu.be/', $video_url, $yt);

				if ( sizeof($yt) > 0 ) { 
					$type = 'yt';
				} else {
					$type = 'local';
				} ?>
					
				<div id="header-video" class="video-banner" data-video_type="<?php echo esc_attr( $type );?>" data-url="<?php echo esc_url( $video_url );?>" data-poster="<?php echo esc_url( get_header_image() );?>"></div>
				<?php

			}
		} 

		$site_branding_class = 'has-header';
	
		if ( is_singular() || (function_exists( 'is_shop') && is_shop()) ) {
			
			$page_id = get_the_id();

			$site_branding_class = 'no-header';

			if ( function_exists( 'is_shop') && is_shop() ) {
				$page_id = get_option( 'woocommerce_shop_page_id' );
			}


			$post_header   = get_post_meta( $page_id, 'blogger-light-post-header', true );

			$post_header   = ( $post_header == '' ) ? 'featured-image' : $post_header;

			$size 			= ( isMobile() ) ? 'large' : 'blogger-light-fullhd_hero_size';
			
			switch ( $post_header ) {
				case 'disabled':
					break;

				case 'featured-image':
					if ( function_exists('has_post_thumbnail') && has_post_thumbnail( $page_id ) ) {

						$feat_img =  get_the_post_thumbnail_url( $page_id, $size );
						$site_branding_class = 'has-header'; ?>

						<div class="header-featured wp-custom-header" style="background-image: url('<?php echo esc_url( $feat_img );?>');"></div>
						<?php 
					}
					break;

				case 'custom-image':
					$post_header_img_id   = get_post_meta( $page_id, 'blogger-light-post-header-img-id', true );	
		            if ( $post_header_img_id != '' ) {
			            $feat_img = wp_get_attachment_image_src( $post_header_img_id, $size );

			            if ( isset($feat_img[0]) ) {
			            	$site_branding_class = 'has-header'; ?>
							<div class="header-featured wp-custom-header" style="background-image: url('<?php echo esc_url( $feat_img[0] );?>');"></div>
							<?php 
			            }
		          	}
					break;
				default:
					break;
			}


		}  ?>

		<div class="main-nav-container">
			<nav id="site-navigation" class="main-navigation <?php echo ( get_theme_mod('menu_full_width', false ) === false ) ? 'full-width-false' : 'full-width-true';?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary-menu',
						'container_class' => 'main-menu-container',
						
					) );

					if ( class_exists( 'WooCommerce' ) ) {
						if ( has_nav_menu( 'woo-menu-header' ) ) {
							wp_nav_menu( array(
								'theme_location' 	=> 'woo-menu-header',
								'container_class' 	=> 'woo-menu-top-container',
							) );
						}
					}

					if ( has_nav_menu( 'social-menu-header' ) ) {
						wp_nav_menu( array(
							'theme_location' 	=> 'social-menu-header',
							'container_class' 	=> 'social-menu-top-container',
							'fallback_cb'		=> false,
							'depth'          	=> 1,
							'link_before'    	=> '<span class="screen-reader-text">',
							'link_after'     	=> '</span><i class="fa fa-link" aria-hidden="true"></i>',
						) );
					}

					if ( get_theme_mod('display_search', true) ) { ?>
						<div class="menu-search">
							<a href="#search"><span class="screen-reader-text"><?php _e('Search', 'blogger-light');?></span><i class="fa fa-search" aria-hidden="true"></i></a>
						</div>
						<?php 
					}
					
				?>
			</nav><!-- #site-navigation -->
		</div>

		<div class="site-branding <?php echo esc_attr( $site_branding_class );?>">
			<?php 
			the_custom_logo(); 


			if ( !get_theme_mod( 'custom_logo' ) || get_theme_mod( 'custom_logo' ) == '' ) {
				$title = get_bloginfo( 'name', 'display' );

				if ( $title || is_customize_preview() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-link" rel="home"><?php echo esc_html($title); ?></a></h1>
					<?php
				endif;
			}

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
				<?php
			endif; ?>
			
		</div><!-- .site-branding -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">