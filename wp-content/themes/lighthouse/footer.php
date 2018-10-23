<?php
/**
 * The template for displaying the footer.
 *
 * Please browse readme.txt for credits and forking information
 * Contains the closing of the #content div and all content after
 *
 * @package Lighthouse
 */

?>



    <div class="container"> 
    <div class="row">
        <div class="col-md-4">
           <?php dynamic_sidebar( 'bottom_widget_left' ); ?>
        </div>
        <div class="col-md-4">
           <?php dynamic_sidebar( 'bottom_widget_middle' ); ?>
        </div>
        <div class="col-md-4">
           <?php dynamic_sidebar( 'bottom_widget_right' ); ?> 
        </div>
      </div>
    </div>



</div><!-- #content -->
<div class="footer-widget-wrapper">
		<div class="container">

	<div class="row">
			<div class="col-md-4">
				<?php dynamic_sidebar( 'footer_widget_left' ); ?> 
			</div>
			<div class="col-md-4">
				<?php dynamic_sidebar( 'footer_widget_middle' ); ?> 
			</div>
			<div class="col-md-4">
				<?php dynamic_sidebar( 'footer_widget_right' ); ?> 
			</div>
		</div>
	</div>
</div>
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="row site-info">
		<?php echo '&copy; '.esc_html(date_i18n(__('Y','lighthouse'))); ?> <?php bloginfo( 'name' ); ?>
			<?php printf( __( '| Powered by ', 'lighthouse' ) ); ?>
			<a href="<?php echo esc_url( __( 'https://outstandingthemes.com/', 'lighthouse' ) ); ?>"><?php printf( __( 'Outstandingthemes', 'lighthouse' ) ); ?></a>
				</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>



</body>
</html>
