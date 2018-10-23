<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package portfolioo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- entry-meta -->
		<div class="post-entry-meta">
			<?php portfolioo_posted_on(); ?>
		</div>
		<!-- entry-meta -->
	<div class="entry-content">

		<div class="featured__image">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			}
			else {
				echo '<div class="hide_featured_image"></div>';
			} ?>
	</div>

	<!-- post wrap-->
	<div class="post_wrap">

		<div class="post_others">

			<!-- .entry-header -->
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) : ?>
				
					<?php //portfolioo_entry_footer(); ?>
				
				<?php
				endif; ?>
			</header>
			<!-- .entry-header -->

			<!-- .entry-content -->
			<div class="entry">
				<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'portfolioo' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					?> 
					<section class="color-1">
					<?php wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'portfolioo' ),
							'after'  => '</div>',
						) );

						?>
				
			</section>
						
					
			</div>
			<!-- .entry-content -->

			<!-- entry-footer -->
			<footer class="entry-footer">
				<?php portfolioo_entry_footer(); ?>
			</footer>
			<!-- entry-footer -->

		</div>
	</div>
	<!-- post wrap-->
</article><!-- #post-## -->
