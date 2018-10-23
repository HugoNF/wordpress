 <?php
      $rCateogry = wp_get_post_categories($post->ID);
      $rTag = wp_get_post_tags($post->ID);
      $args = 
        array( 
          'tax_query' => array(
            'relation' => 'OR',
            array(
              'taxonomy' => 'category',
              'field'    => 'id',
              'terms'    => $rCateogry,
            ),
            array(
              'taxonomy' => 'tag',
              'field'    => 'id',
              'terms'    => $rTag,
            ),
          ),
          'posts_per_page' => 3,
          'post__not_in' => array($post->ID)
        );
      $query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>

	<div class="related-container">
		<h2><?php echo _e('You Might Also Like..', 'blogger-light');?></h2>
		<div class="related-posts">

			<?php while ( $query->have_posts() ) : $query->the_post();
				$feat_img =  blogger_light_feat_image( get_the_ID(), 'large', 'url' ); ?>

				<a href="<?php the_permalink();?>" title="<?php the_title();?>">

					<div class="feat-image" style="background-image: url(<?php echo esc_url($feat_img);?>);" >
              <div class="hover-effect">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                  <path d="M465.4,247c-2.2-22-12.4-43-28.9-58.4c-17.1-15.9-39.3-24.7-62.7-24.7c-41.5,0-77.3,27.4-88.5,67c-7-7-18.5-11.7-29.3-11.7 c-10.8,0-22.3,4.7-29.3,11.7c-11.2-39.6-47-67-88.5-67c-23.3,0-45.6,8.7-62.7,24.6C59,204,48.8,225,46.6,247H32v18h14.6 c2.2,22,12.4,43,28.9,58.4c17.1,15.9,39.3,24.7,62.7,24.7c50.8,0,92.1-41.2,92.1-92c0-0.1,0-0.1,0-0.1h0c0-9.9,11.5-21.6,25.7-21.6 s25.7,11.7,25.7,21.6h0c0,0,0,0,0,0.1c0,50.8,41.3,92,92.1,92c23.3,0,45.6-8.7,62.7-24.7c16.5-15.4,26.7-36.5,28.9-58.5H480v-18 H465.4z M373.8,333c-42.5,0-77-34.6-77-77c0-42.5,34.6-77,77-77c42.5,0,77,34.6,77,77C450.8,298.5,416.3,333,373.8,333z M138.2,333 c-42.5,0-77-34.6-77-77c0-42.5,34.6-77,77-77c42.5,0,77,34.6,77,77C215.2,298.5,180.7,333,138.2,333z"/>
                </svg>

              </div>     
          </div>
					<h3><?php the_title();?></h3>
					<span><?php the_date();?></span>
				</a>

			<?php endwhile;?>
		</div>
	</div>
	<?php wp_reset_postdata();?>
<?php endif;