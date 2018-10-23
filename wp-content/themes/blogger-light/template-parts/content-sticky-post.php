<?php
/**
 * Template part for displaying sticky posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogger-light
 */


$size 		= ( isMobile() ) ? 'large' : 'blogger-light-sticky_posts_size';
$sticky = get_option( 'sticky_posts' ); ?>

<div class="sticky-posts-wrapper">
	<ul class="sticky-posts">

	<?php 
	foreach ( $sticky as $id ) { ?>
		<li class="sticky-post">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'sticky-post' ); ?>>
				<header class="entry-header feat-header">
					<?php
					$thumb_url = ( has_post_thumbnail( $id ) ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size ) : get_template_directory_uri() . '/img/default.jpg'; 

					$thumb_url = ( is_array( $thumb_url ) ) ? $thumb_url[0] : $thumb_url; ?>

					<div class="entry-feat sticky" style="background-image:url('<?php echo esc_url( $thumb_url ); ?>')"></div>

					<div class="entry-meta">
						<p><?php _e('Featured post', 'blogger-light'); ?></p>
						<p><?php the_category( ', ' );?></p>
						<h3><a href="<?php echo  esc_url( get_the_permalink( $id ) );?>"><?php echo esc_html( get_the_title( $id ) );?></a></h3>
					</div>
				</header><!-- .entry-header -->

			</article><!-- #post-## -->
		</li>
		<?php 
	} ?>

	</ul><!-- .sticky-posts> -->
</div><!-- .sticky-post-wrapper> -->

