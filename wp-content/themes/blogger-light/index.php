<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogger-light
 */

get_header();

// get sticky posts first
$sticky = get_option( 'sticky_posts' );

if ( !empty( $sticky ) ) {
	get_template_part( 'template-parts/content', 'sticky-post' );

} ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" cat-id="0">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				if ( get_theme_mod('layout', 'full') == 'full' )  {
					get_template_part( 'template-parts/content', 'full' );

				} else {
					get_template_part( 'template-parts/content', 'multi-columns' );
				}

			endwhile; ?>

			</main><!-- #main -->

			<?php

			if ( get_theme_mod('inf_scroll', false) == false ) :
				
					$args = array(
					'prev_text'          => __('Prev', 'blogger-light'),
					'next_text'          => __('Next', 'blogger-light'),
					);

					$pagination =  get_the_posts_pagination( $args );

					if ( $pagination != null ) {
						echo '<div class="post-pagination">';
						the_posts_pagination( $args );
						echo '</div>';
					}
			endif;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		<?php get_template_part( 'template-parts/loader' ); ?>

	</div><!-- #primary -->

<?php 


get_footer();