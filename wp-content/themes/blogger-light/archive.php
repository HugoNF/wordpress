<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogger-light
 */

get_header(); 

$queried_object = get_queried_object();

// get sticky posts first
$sticky = get_option( 'sticky_posts' );

if ( !empty( $sticky ) ) {
	get_template_part( 'template-parts/content', 'sticky-post' );

} ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" data-cat="<?php echo esc_attr( $queried_object->term_id );?>">

		<?php
		if ( have_posts() ) : ?>

			<?php
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


			endwhile;
      

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

		</main><!-- #main -->

    <?php get_template_part( 'template-parts/loader' ); ?>

	</div><!-- #primary -->

	<?php
	get_footer();