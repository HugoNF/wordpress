<?php
/**
 * Template Name: Blog Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package portofolioo
 */
get_header(); ?>
<section class="blog_page">
    <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' , 'portfolioo'); ?>
            <footer class="entry-footer">
                <?php edit_post_link( esc_html__( 'Edit', 'portfolioo' ), '<span class="edit-link">', '</span>' ); ?>
            </footer><!-- .entry-footer -->
    </header><!-- .entry-header -->

    <div class="blog_wrap">
            
        <div class="blg_page_post_list">

                <?php 
                $args = array (
                    'post__in'  => '',
                    'ignore_sticky_posts' => 'false',
                    'posts_per_page' => '10',
                    'paged' => $paged
                    );
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

                // the query
                $the_query = new WP_Query( $args ); ?>

                <?php if ( $the_query->have_posts() ) : ?>

                <!-- the loop -->
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
              
              <section class="blog_post_list_wrap">
                 <div class="blog_post_list_img">

                    <?php if ( has_post_thumbnail() ) {
                        
                        ?> <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a> <?php
                        
                         } ?>

                 </div>

              <div class="blog_post_list_other">

                    <div class="blog_meta">
                    
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
                        

                    <div class="blog_post_list_others">

                        <h3 class="blog_post_list_title"><a href="<?php the_permalink(); ?>"><?php the_title();  ?></a></h3>

                        <?php get_template_part( 'template-parts/postmeta'); ?>

                    </div>
               </div>
               <!-- </div> -->
               <div class="clearfix"></div>
                
              </section>

                    <?php endwhile; ?>
                    <!-- end of the loop -->

                    <!-- pagination here -->
                <div class="clearfix"></div>
                

                 <?php wp_reset_postdata(); ?>

                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'portfolioo' ); ?></p>
                <?php endif; ?>

                <div class="blog_pagination"><div class="clearfix"></div>
                 <?php next_posts_link(__('Older Entries <i class="fa fa-angle-right" aria-hidden="true"></i> ', 'portfolioo'), $the_query->max_num_pages) ?>
                 <?php previous_posts_link(__('<i class="fa fa-angle-left" aria-hidden="true"></i> Newer Entries ', 'portfolioo')) ?>
                </div> <div class="clearfix"></div><div class="clearfix"></div>
        </div>

        <div class="sidebar-widget" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
            <?php
                if ( ! dynamic_sidebar( 'sidebar-1' ) ) {
                the_widget( 'WP_Widget_Meta' );
            } ?>
         </div>     

     </div>

</section>


<div class="clearfix"></div>
    <section class="footer-widget">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1') ) :   endif; ?>
        <div class="clearfix"></div>
    </section>
<?php get_footer(); ?>