<?php
/**
 * Template part for displaying posts full format
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogger-light
 */

$class = is_singular() ? 'single-post' : '';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	<header class="entry-header">

		<div class="post-categories">
			<?php
			the_category( ', ' ); ?>
		</div>

		<?php

		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php blogger_light_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogger-light' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer <?php echo ( get_theme_mod('posts_footer_colored', '1') == 1 ) ? 'background-color-true' : 'background-color-false';?>">
		<?php blogger_light_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
