<?php global $portfolioo;
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package portfolioo
 */

?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'portfolioo' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'portfolioo' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s', 'portfolioo' ), 'portfolioo', '<a href="https://asphaltthemes.com/">Asphalt Themes</a>' );
			?>
		</div><!-- .site-info -->
		<a href="#" class="scrolltotop"><i class="fa fa-chevron-up"></i></a>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
