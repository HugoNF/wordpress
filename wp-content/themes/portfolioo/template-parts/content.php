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
	<header class="entry-header">
		

		<div class="entry-content">
		<div class="index_featured_image">
			<?php	if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			}
			else {
				echo '<div class="hide_featured_image"></div>';
			} ?>
		</div>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php //portfolioo_posted_on(); ?>
			<div class="index_meta">
                
                    <?php

                    $post_tags = get_the_tags();
                     if ( $post_tags ) {
                        echo "<p>".  $post_tags[0]->name ."</p>"; 
                    }  else {
                        echo '<p>' . esc_html__('Post Tag', 'portfolioo') . '</p>';
                    }
                    ?>

                    <?php 
                        $post_date = get_the_date( 'd m, Y' ); 
                        echo "<p>". $post_date . "</p>";
                     ?>
                  
            </div>
	            <?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
		</div><!-- .entry-meta -->
		
		


		
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	
	<footer class="entry-footer">
		<?php //portfolioo_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php //the_ID(); ?> -->  
