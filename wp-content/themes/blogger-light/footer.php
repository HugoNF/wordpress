<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogger-light
 */

	if ( is_active_sidebar( 'sidebar-widget' ) && get_theme_mod('sidebar', 'left') != 'disabled' && !(is_singular() && basename( get_page_template() ) == 'template-full-width.php') ) { ?>
	    <div id="secondary" class="sidebar-widget <?php echo esc_attr( get_theme_mod('sidebar', 'left') );?>">
	        <?php dynamic_sidebar( 'sidebar-widget' ); ?>
	    </div>
		<?php
	} ?>

	</div><!-- #content -->

	<?php if ( is_active_sidebar( 'footer-widget' ) ) { ?>
	    <div class="footer-widgets full-width">
	        <?php dynamic_sidebar( 'footer-widget' ); ?>
	    </div>
	<?php } ?>

	<footer id="colophon" class="site-footer">

		<?php if ( is_active_sidebar( 'footer-column' ) ) : ?>
			<div class="footer-widgets columns column-<?php echo esc_attr( get_theme_mod('footer_widgets_columns', '3') );?>">
			<?php dynamic_sidebar('footer-column'); ?>
			</div>
		<?php endif; ?>


		<div class="footer-content">
			<div class="copyright-wrapper">
				<p style="margin:0"><?php printf( __( 'Proudly powered by %1$s', 'blogger-light' ), '<a href="https://wordpress.org/">WordPress</a>' ); ?>
				<span> | </span>
				<?php printf( __( 'Theme: %2$s by %1$s.', 'blogger-light' ), '<a href="https://niteothemes.com/" rel="designer">Niteothemes</a>', '<a href="https://niteothemes.com/blogger-wordpress-theme/" rel="designer">Blogger</a>' ); ?></p>
			</div>

			<?php 
			if ( has_nav_menu( 'social-menu-footer' ) ) {
				wp_nav_menu( array(
					'theme_location' 	=> 'social-menu-footer',
					'container_class' 	=> 'social-menu-footer',
					'fallback_cb'		=> false,
					'depth'          	=> 1,
					'link_before'    	=> '<span class="screen-reader-text">',
					'link_after'     	=> '</span><i class="fa fa-link" aria-hidden="true"></i>',
				) );
			}
			?>

			<div class="back-top-wrapper">
				<?php blogger_light_render_backtop(); ?>
			</div>

		</div>
	</footer><!-- #colophon -->
	

	<?php 

	if ( get_theme_mod( 'backtop', 1 ) ) { ?>
		<a class="go-top"><i class="fa fa-angle-up"></i></a>
		<?php 
	} ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>