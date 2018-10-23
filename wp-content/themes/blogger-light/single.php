<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package blogger-light
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