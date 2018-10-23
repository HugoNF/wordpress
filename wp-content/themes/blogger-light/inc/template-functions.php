<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package blogger-light
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( !function_exists('blogger_light_body_classes') ) {
  function blogger_light_body_classes( $classes ) {
  	$classes = array();

  	// Adds a class of hfeed to non-singular pages.
  	if ( ! is_singular() ) {
  		array_push( $classes, 'hfeed' );
  	}

    // custom-background 
  	if ( get_background_image() || get_theme_mod('background_color') ) {
  		array_push( $classes, 'custom-background' );
  	}

    // no header set
  	if ( !has_header_image() && ( function_exists('has_header_video') && !has_header_video() ) ) {
  		array_push( $classes, 'no-header' );
  	}


    // full or two-columns layout
    if ( get_theme_mod('layout', 'full') != 'full' && !is_singular() ) {
      array_push( $classes, 'masonry' );
    }

    // site-branding location
    array_push( $classes, get_theme_mod('logo_location', 'logo-below-hero') );
    
    // sticky menu
    array_push( $classes, get_theme_mod('sticky_menu', 'has-sticky-menu') );

    // sidebar location
    $sidebar  = 'with-sidebar';

    $sidebar  = ( !is_active_sidebar( 'sidebar-widget' ) || get_theme_mod('sidebar', 'left') == 'disabled' || basename( get_page_template() ) == 'template-full-width.php' ) ? 'no-sidebar' : 'with-sidebar';
    array_push( $classes, $sidebar );

  	return $classes;
  }
}
add_filter( 'body_class', 'blogger_light_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
if ( !function_exists('blogger_light_pingback_header') ) {
  function blogger_light_pingback_header() {
  	if ( is_singular() && pings_open() ) {
  		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  	}
  }
}
add_action( 'wp_head', 'blogger_light_pingback_header' );


/**
 * Get Content, parse it, and add text-paragraph class to text only paragprahs
 *
 * @param  string  $content input
 * @return string  $content parsed output
 */
if ( !function_exists('blogger_light_content_filter') ) {
  function blogger_light_content_filter( $content ) {
      // (maybe) modify $content
      if ( $content && $content != '' ) {

        $doc = new DOMDocument(); 
        libxml_use_internal_errors( true );
        $doc->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );

        // new xpath
        $xpath = new DOMXpath($doc);

        $nodes = $xpath->query('/html/body/p[not(descendant::img or descendant::iframe)]|/html/body/a[not(contains(@class, "button"))]');

        if ( $nodes->length ) {

          foreach ( $nodes as $node ) {
            $class = $node->getAttribute( 'class');
            ( $class != '' ) ? $class = $class.' text-paragraph' : $class = 'text-paragraph';

           $node->setAttribute( 'class', $class);
          }

        }

        $content =  preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $doc->saveHTML($doc->documentElement));
      
      }

      return $content;
  }
}

add_filter( 'the_content', 'blogger_light_content_filter');


/**
 * Display icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */

if ( !function_exists('blogger_light_nav_menu_social_icons') ) {
  function blogger_light_nav_menu_social_icons( $item_output, $item, $depth, $args ) {

    // Change SVG icon inside social links menu if there is supported URL.
    if ( 'social-menu-footer' === $args->theme_location || 'social-menu-header' === $args->theme_location ) {
      // Get supported social icons.
      $social_icons = blogger_light_social_links_icons();

      foreach ( $social_icons as $attr => $value ) {
        // Replace text by FA icon if in FA array
        if ( false !== strpos( $item_output, $attr ) ) {
          $item_output = str_replace( $args->link_after, '</span><i class="fa fa-'.$value.'" aria-hidden="true"></i>', $item_output );
        }
      }
    }

    return $item_output;
  }
}
add_filter( 'walker_nav_menu_start_el', 'blogger_light_nav_menu_social_icons', 10, 4 );



/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
if ( !function_exists('blogger_light_social_links_icons') ) {
  function blogger_light_social_links_icons() {
    // Supported social links icons.
    $social_links_icons = array(
      'behance.net'     => 'behance',
      'codepen.io'      => 'codepen',
      'deviantart.com'  => 'deviantart',
      'digg.com'        => 'digg',
      'dribbble.com'    => 'dribbble',
      'dropbox.com'     => 'dropbox',
      'facebook.com'    => 'facebook',
      'flickr.com'      => 'flickr',
      'foursquare.com'  => 'foursquare',
      'plus.google.com' => 'google-plus',
      'github.com'      => 'github',
      'instagram.com'   => 'instagram',
      'linkedin.com'    => 'linkedin',
      'mailto:'         => 'envelope-o',
      'medium.com'      => 'medium',
      'pinterest.com'   => 'pinterest-p',
      'getpocket.com'   => 'get-pocket',
      'reddit.com'      => 'reddit-alien',
      'skype.com'       => 'skype',
      'skype:'          => 'skype',
      'slideshare.net'  => 'slideshare',
      'snapchat.com'    => 'snapchat-ghost',
      'soundcloud.com'  => 'soundcloud',
      'spotify.com'     => 'spotify',
      'stumbleupon.com' => 'stumbleupon',
      'tumblr.com'      => 'tumblr',
      'twitch.tv'       => 'twitch',
      'twitter.com'     => 'twitter',
      'vimeo.com'       => 'vimeo',
      'vine.co'         => 'vine',
      'vk.com'          => 'vk',
      'wordpress.org'   => 'wordpress',
      'wordpress.com'   => 'wordpress',
      'yelp.com'        => 'yelp',
      'youtube.com'     => 'youtube',
    );

    /**
     *
     * @param array $social_links_icons Array of social links icons.
     */
    return apply_filters( 'blogger_light_social_links_icons', $social_links_icons );
  } 
}


if ( !function_exists('blogger_light_move_comment_field_to_bottom') ) {
  function blogger_light_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = '<textarea class="required"  id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Comment"></textarea>';
    return $fields;
  }
}


/**
 * Returns featured image with fallback to first image and then to default image
 * @param string ID, string size, string type
 * @return html string 
 */
if ( !function_exists('blogger_light_feat_image') ) {
  function blogger_light_feat_image( $id, $size, $type ) {

    if ( (function_exists('has_post_thumbnail')) && ( has_post_thumbnail()) ) {

      if ( $type == 'img' ) {
        $img = get_the_post_thumbnail( $id, $size );

      } else {
        $img = get_the_post_thumbnail_url( $id, $size );
      }

    } else {
        preg_match('~<img[^>]+wp-image-(\\d+)~', get_post_field('post_content', $id), $matches);
        if ( $matches ) {
          if ( $type == 'img' ) {
            $img = wp_get_attachment_image( $matches[1], $size );

          } else {
            $img = wp_get_attachment_image_src( $matches[1], $size );
            if (is_array($img)) {
              $img = $img[0];
            }
          }
        }
    }

    if ( !isset( $img ) && $type == 'img' ) {
      $img = '<img width="1024" height="683" src="'.get_template_directory_uri().'/img/default.jpg" class="attachment-large size-large" alt="'.get_the_title($id).'">';
    }

    if ( !isset( $img ) && $type != 'img' ) {
      $img = get_template_directory_uri().'/img/default.jpg';
    }

    return $img;

  }
}

/**
 * Add metabox to the posts and pages
 */
if ( !function_exists( 'blogger_light_add_post_meta' ) ) {
  function blogger_light_add_post_meta() {
    add_meta_box( 'blogger_light_post_layout', 'Header Image', 'blogger_light_post_layout', array('post', 'page'), 'side', 'low' );
  }
}
add_action( 'add_meta_boxes', 'blogger_light_add_post_meta' );

if ( !function_exists( 'blogger_light_post_layout' ) ) {
  function blogger_light_post_layout( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'post_layout', 'layout-nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */

    $post_header          = get_post_meta( $post->ID, 'blogger-light-post-header', true );
    $post_header_img_id   = get_post_meta( $post->ID, 'blogger-light-post-header-img-id', true );

    $post_header      = ( $post_header == '' ) ? 'featured-image' : $post_header;
    $display_custom   = ( $post_header == 'custom-image' ) ? 'block' : 'none';
    ?>

    <p>
      <input type="radio" value="disabled" <?php checked( $post_header, 'disabled' );?> name="blogger-light-post-header"/><?php _e('Disable Header Image.', 'blogger-light');?><br>

      <input type="radio" value="featured-image" <?php checked( $post_header, 'featured-image' );?> name="blogger-light-post-header"/><?php _e('Use Featured image.', 'blogger-light');?><br>

      <input type="radio" value="custom-image" <?php checked( $post_header, 'custom-image' );?> name="blogger-light-post-header"/><?php _e('Use custom image.', 'blogger-light');?>
    </p>

    <div class="custom-image" style="display:<?php echo esc_attr( $display_custom );?>">

      <input type="hidden" name="blogger-light-post-header-img-id" id="blogger-light-post-header-img-id" value="<?php echo esc_attr( $post_header_img_id ); ?>">

      <div id="blogger-light-post-header-img">
            <?php if ( $post_header_img_id != '' ) {
              $post_header_img = wp_get_attachment_image_src( $post_header_img_id, 'medium' );
              if ( isset($post_header_img[0]) ) {
                echo '<img src="' . esc_url( $post_header_img[0] ) . '" alt="" style="max-width:100%"/>';
              }
              
            } ?>
      </div>

      <span><?php _e( 'Recommended Header image size is 1920 x 480px.', 'blogger-light' );?></span><br><br>

      <button type="button" class="button" id="events_video_upload_btn" data-media-uploader-target="#blogger-light-post-header-img-id" data-media-uploader-target-img="#blogger-light-post-header-img"><?php _e( 'Upload Media', 'blogger-light' );?></button>

      <p class="hide-if-no-js"><a href="#" id="remove-post-meta-img"><?php _e( 'Remove custom header image', 'blogger-light' );?></a></p>

    </div>

    <?php
  }
}


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
if ( !function_exists( 'blogger_light_meta_box_data' ) ) {
  function blogger_light_meta_box_data( $post_id ) {

      /*
       * We need to verify this came from our screen and with proper authorization,
       * because the save_post action can be triggered at other times.
       */

      if ( isset( $_POST['layout-nonce'] ) ) {

          // Verify that the nonce is valid.
          if ( wp_verify_nonce( $_POST['layout-nonce'], 'post_layout' )) {
            // If this is an autosave, our form has not been submitted, so we don't want to do anything.
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                    return;
            }

            // Check the user's permissions.
            if ( !current_user_can( 'edit_post', $post_id ) ) {
                    return;
            }

            if ( isset( $_POST['blogger-light-post-header'] ) ) {
               $post_header = filter_var( $_POST['blogger-light-post-header'], FILTER_SANITIZE_STRING );
               update_post_meta( $post_id, 'blogger-light-post-header', $post_header );
            }

            if ( isset( $_POST['blogger-light-post-header-img-id'] ) ) {
               $post_header_img_id = filter_var( $_POST['blogger-light-post-header-img-id'], FILTER_SANITIZE_NUMBER_INT );
               update_post_meta( $post_id, 'blogger-light-post-header-img-id', $post_header_img_id );
            }

          }
      } 

      return;
  }
}

add_action( 'save_post', 'blogger_light_meta_box_data' );

// get single page width for woo commerce image width
if ( !function_exists( 'blogger_light_get_content_width' ) ) {
  function blogger_light_get_content_width() {

    $width = get_theme_mod('blog_width', 1140);

    if ( is_active_sidebar( 'sidebar-widget' ) && get_theme_mod('sidebar', 'left') != 'disabled' ) {
      $width = $width - 350;
    }

    return $width;
  }
}


// ignore sticky posts in main loop
if ( !function_exists( 'blogger_light_ignore_sticky_posts' ) ) {
  function blogger_light_ignore_sticky_posts( $query ) {
    if ( is_home() && $query->is_main_query() ) {
      $query->set( 'ignore_sticky_posts', 1 );
      $query->set( 'post__not_in', get_option('sticky_posts') );  
    }
  }
}
// add_action('pre_get_posts','blogger_light_ignore_sticky_posts');