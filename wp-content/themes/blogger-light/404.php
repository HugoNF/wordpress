<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package blogger-light
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="page-content not-found">
				<p><?php _e('404', 'blogger-light');?></p>
				<p><?php _e('Oops! That page cannot be found!', 'blogger-light');?></p>
			</div><!-- .page-content -->
		</main>

	</div><!-- #primary -->


<?php
get_footer();