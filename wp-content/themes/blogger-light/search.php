<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package blogger-light
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header search">
				<h1 class="page-title"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'blogger-light' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_theme_mod('layout', 'full') );

			endwhile;

			if ( get_theme_mod('inf_scroll', true) == false ) : ?>
				<div class="post-pagination">
					<?php 
					$args = array(
						'prev_text'          => __('Prev', 'blogger-light'),
						'next_text'          => __('Next', 'blogger-light'),
					);

					the_posts_pagination( $args );

					?>
				</div>
				<?php 
			endif; 

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
get_footer();