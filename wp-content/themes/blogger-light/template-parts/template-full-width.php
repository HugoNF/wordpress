<?php
/**
 * Template part for displaying full width single posts without sidebar
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogger-light
 *
 * Template Name: Full Width
 * Template Post Type: post, page, product
 */


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php

		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'full' );


			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.

		// display related posts
		get_template_part( 'template-parts/related_posts' );
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();