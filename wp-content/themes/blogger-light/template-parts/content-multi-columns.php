<?php
/**
 * Template part for displaying posts: two columns format
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogger-light
 */


$class  = array( get_theme_mod('layout', 'full'), 'multi-columns');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>


	<a href="<?php the_permalink();?>">

		<div class="entry-thumbnail">
			<div class="hover-effect"></div>
			<?php echo blogger_light_feat_image( get_the_ID(), 'large', 'img' );?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>

			<div class="post-categories">
				<?php
				the_category( ', ' ); ?>
			</div>
		
		</footer><!-- .entry-footer -->

	</a>
</article><!-- #post-<?php the_ID(); ?> -->
