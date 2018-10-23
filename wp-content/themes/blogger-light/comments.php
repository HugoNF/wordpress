<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogger-light
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

// used as a callback by wp_list_comments() for displaying the comments.
if ( ! function_exists( 'shape_comment' ) ) :
function shape_comment( $comment, $args, $depth ) {

    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>

    <li class="post pingback">
        <p><?php esc_html_e( 'Pingback:', 'blogger-light' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'blogger-light' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <div class="comment-author vcard">
                <?php echo get_avatar( $comment, 80 ); ?>
                                
                <span class="comment-date"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
                <?php
                    /* translators: 1: date, 2: time */
                    printf( '%1$s', get_comment_date() ); ?>
                </time></span>
                <?php edit_comment_link( __( '(Edit)', 'blogger-light' ), ' ' ); ?>
	            <span class="comment-reply">
	                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	            </span><!-- .reply -->
            </div><!-- .comment-meta .commentmetadata -->

            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em><?php _e( 'Your comment is awaiting moderation.', 'blogger-light' ); ?></em>
                <br />
            <?php endif; ?>
 
            <div class="comment-content">
            	<?php comment_text(); ?>
	        </div>
        </article><!-- #comment-## -->
 
    <?php
            break;
    endswitch;
}
endif; // ends check for shape_comment()
 
    /*
     * If the current post is protected by a password and
     * the visitor has not yet entered the password we will
     * return early without loading the comments.
     */
    if ( post_password_required() )
        return;
?>
 
    <div id="comments" class="comments-area">
 
    <?php // You can start editing here -- including this comment! ?>
 
    <?php if ( have_comments() ) : ?>
 
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
            <h1 class="assistive-text"><?php _e( 'Comment navigation', 'blogger-light' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'blogger-light' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'blogger-light' ) ); ?></div>
        </nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>
 
        <ol class="commentlist">
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use shape_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * define shape_comment() and that will be used instead.
                 * See shape_comment() in inc/template-tags.php for more.
                 */
                wp_list_comments( array( 'callback' => 'shape_comment' ) );
            ?>
        </ol><!-- .commentlist -->
 
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
            <h2 class="assistive-text"><?php _e( 'Comment navigation', 'blogger-light' ); ?></h2>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'blogger-light' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'blogger-light' ) ); ?></div>
        </nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>
 
    <?php endif; // have_comments() ?>
 
    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        
    <?php endif; ?>
 
    <?php
        if ( comments_open() ) : 

        $args = array(
          'id_form'           => 'commentform',
          'class_form'      => 'comment-form',
          'id_submit'         => 'submit',
          'class_submit'      => 'submit button',
          'name_submit'       => 'submit',
          'title_reply'       => __( 'Leave a Comment', 'blogger-light' ),
          'title_reply_to'    => __( 'Leave a Reply to %s', 'blogger-light' ),
          'cancel_reply_link' => __( 'Cancel Reply', 'blogger-light' ),
          'label_submit'      => __( 'Post Comment', 'blogger-light' ),
          'format'            => 'xhtml',

          $fields =  array(

      			'author' =>
      				'<input class="required" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      				'" size="100" placeholder="Name"/>',

      			'email' =>
      				'<input class="required"  id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      				'" size="100" placeholder="Email" />',

      			'url' =>
      				'<input id="url" name="url" type="url" value="' . esc_attr(  $commenter['comment_author_url'] ) .
      				'" size="100" placeholder="Website" />',
      			),

      			'must_log_in' => '<p class="must-log-in">' .
      				sprintf(
      				__( 'You must be <a href="%s">logged in</a> to post a comment.', 'blogger-light' ),
      				wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
      				) . '</p>',

      			'logged_in_as' => '<p class="logged-in-as">' .
      				sprintf(
      				__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'blogger-light' ),
      				admin_url( 'profile.php' ),
      				$user_identity,
      				wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
      				) . '</p>',

      			'comment_notes_before' => '<p class="comment-notes">' .
      				__( 'Your email address will not be published.', 'blogger-light' ) .
      				'</p>',
      			'comment_notes_after' => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'blogger-light' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',

      			'fields' => apply_filters( 'comment_form_default_fields', $fields ),
      			add_filter( 'comment_form_fields', 'blogger_light_move_comment_field_to_bottom' ),
        );

         comment_form( $args );

        ?>

        <?php endif; ?>
 
</div><!-- #comments .comments-area -->