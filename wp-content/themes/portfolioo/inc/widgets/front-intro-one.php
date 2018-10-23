<?php


/*************************************************
* Intro One Widget
**************************************************/

/**
 * Register the Widget
 */
function portfolioo_intro_one_widget() {
    register_widget( 'portfolioo_intro_one_widget' );
}
add_action( 'widgets_init', 'portfolioo_intro_one_widget' );


class portfolioo_intro_one_widget extends WP_Widget
{
    /**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'portfolioo_intro_one_widget',
            'description' => esc_html__('Portfolioo Intro Widget One', 'portfolioo'),
            'customize_selective_refresh' => true
        );

        parent::__construct( 'portfolioo_intro_one_widget', 'Intro Widget One', $widget_ops );

        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
    }


    /**
     * Upload the Javascripts for the media uploader
     */
    public function upload_scripts()
    {
    if( function_exists( 'wp_enqueue_media' ) ) {
        
        wp_enqueue_media();
    }
        wp_enqueue_script('portfolioo_intro_one_widget', get_template_directory_uri() . '/js/media-upload.js');
    }

    


   /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
    public function widget( $args, $instance )
    {

            $heroimage      = isset( $instance['heroimage'] ) ? apply_filters('', $instance['heroimage'] ) : esc_url(get_template_directory_uri().'/assets/images/YT.jpg');
            $introimgfixed  = isset( $instance['introimgfixed'] ) ? $instance['introimgfixed'] : 'static';
            
            $title          = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'], $instance, $this->id_base ) : esc_attr__('Providing World Class WordPress Services','portfolioo');
            $image          = isset( $instance['image'] ) ? apply_filters('', $instance['image'] ) : esc_url(get_template_directory_uri().'/assets/images/short.jpg');
            $text1          = isset( $instance['text1'] ) ? apply_filters('', $instance['text1'] ) : esc_attr__('NAME','portfolioo');
            $text2          = isset( $instance['text2'] ) ? apply_filters('', $instance['text2'] ) : esc_attr__('John Doe','portfolioo');
            $text3          = isset( $instance['text3'] ) ? apply_filters('', $instance['text3'] ) : esc_attr__('EMAIL','portfolioo');
            $text4          = isset( $instance['text4'] ) ? apply_filters('', $instance['text4'] ) : esc_attr__('john@doe.com','portfolioo');
            
          
 
          /* Before widget (defined by themes). */
          echo $args['before_widget'] ;

              echo '<div class="container intro1">
                      <div class="heading" style="background-attachment:'.esc_url($introimgfixed).';background-image: linear-gradient(rgba(00, 00, 00, 1.5), rgba(0, 0, 0, 0.1)), url('. esc_url($heroimage) .')">';


              if(isset($title) ){
              
                 echo '<h1 itemprop="text">' . esc_html(do_shortcode($title))  .'</h1>';
              }
					
			     
              if(isset($image) ){    
                      echo '<img class="portrait" itemprop="image" src="'. esc_url($image) .'">';
                        
              }

              echo '<svg class="slant" viewBox="0 0 1 1" preserveAspectRatio="none">
                      <polygon points="0,1 1,1 1,0">
                    </svg>
                    </div>
                    <dl>';


            if(isset($text1)){

               echo '<dt itemprop="text">'. esc_html(do_shortcode($text1)) . '</dt>';
            }

            if(isset($text2)){

               echo '<dd itemprop="text">'. esc_html(do_shortcode($text2)) . '</dd>';
            }

            if(isset($text3)){

               echo '<dt itemprop="text">'. esc_html(do_shortcode($text3)) . '</dt>';
            }

            if(isset($text4)){

               echo '<dd itemprop="text">'. esc_html(do_shortcode($text4)) . '</dd>';
            }

            echo '</dl></div>';


          
    }


    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance )
    {
        /* Set up some default widget settings. */
        $defaults = array( 
          'heroimage'     =>  get_template_directory_uri().'/assets/images/YT.jpg',
          'introimgfixed' => esc_attr__('static', 'portfolioo'),
          'title'         => esc_attr__('Providing World Class WordPress Services', 'portfolioo'), 
          'titlecolor'    => '#fff',
          'txtcolor'    => '#999',
          'subtitlecolor'    => '#212121',
          'image'         =>  get_template_directory_uri().'/assets/images/short.jpg',
          'text1'         => esc_attr__('NAME',  'portfolioo'),
          'text2'         => esc_attr__('John Doe', 'portfolioo'),
          'text3'         => esc_attr__('EMAIL', 'portfolioo'),
          'text4'         => esc_attr__('john@doe.com', 'portfolioo'),
        
          );
      		
      		
        $instance = wp_parse_args( (array) $instance, $defaults ); 

        
        ?>


        <p>
            <label style="max-width: 100%;overflow: hidden;" for="<?php echo $this->get_field_name( 'heroimage' ); ?>"><?php esc_html_e( 'Hero Image:', 'portfolioo'  ); ?></label> <span><?php esc_attr__(' (Suggested Size : 1920 * 1080 )' , 'portfolioo'); ?></span>
 
            <?php if (!empty($instance['heroimage'])) { 
              ?> <img style="max-width: 100%;overflow: hidden;" src="<?php echo esc_url( $instance['heroimage'] ); ?>" class="widgtimgprv" /> <span style="float:right;cursor: pointer;" class="mediaremvbtn">X</span><?php 
              }  ?>
            
            <input style="display:none;" name="<?php echo $this->get_field_name( 'heroimage' ); ?>" id="<?php echo $this->get_field_id( 'heroimage' ); ?>" class="widefat" type="text" size="36" value="<?php echo esc_url( $instance['heroimage'] ); ?>" />
            <input style="background-color: #0085ba;color: #fff;border: none;cursor: pointer;padding: 6px 5px;" class="upload_image_button" id="<?php echo $this->get_field_id( 'heroimage' ).'-picker'; ?>" type="button" onClick="mediaPicker(this.id)" value="<?php esc_attr_e('Upload Image', 'portfolioo'); ?>" />
        </p>


        <p>
            <label for="<?php echo $this->get_field_id( 'introimgfixed' ); ?>"><?php esc_html_e('Image Setting', 'portfolioo') ?></label>
            <select id="<?php echo $this->get_field_id( 'introimgfixed' ); ?>" name="<?php echo $this->get_field_name( 'introimgfixed' ); ?>" class="widefat">
            <option value="fixed" <?php if ( 'fixed' == $instance['introimgfixed'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Fixed', 'portfolioo') ?></option>
            <option value="static" <?php if ( 'static' == $instance['introimgfixed'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Static', 'portfolioo') ?></option>
            </select>
        </p>

        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php esc_html_e( 'Title', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

       

        <br>
        

        <!-- face image Field -->
        <p>
            <label style="max-width: 100%;overflow: hidden;" for="<?php echo $this->get_field_name( 'image' ); ?>"><?php esc_html_e( 'Image:', 'portfolioo'  ); ?></label> <span><?php _e(' (Suggested Size : 250 * 250 )' , 'portfolioo'); ?></span>
 
            <?php if (!empty($instance['image'])) { 
              ?> <img style="max-width: 100%;overflow: hidden;" src="<?php echo esc_url( $instance['image'] ); ?>" class="widgtimgprv" /> <span style="float:right;cursor: pointer;" class="mediaremvbtn">X</span><?php 
              }  ?>
            
            <input style="display:none;" name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36" value="<?php echo esc_url( $instance['image'] ); ?>" />
            <input style="background-color: #0085ba;color: #fff;border: none;cursor: pointer;padding: 6px 5px;" class="upload_image_button" id="<?php echo $this->get_field_id( 'image' ).'-picker'; ?>" type="button" onClick="mediaPicker(this.id)" value="<?php esc_attr_e('Upload Image', 'portfolioo'); ?>" />
        </p>


        <br>
            
        <!-- text1 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text1' ); ?>"><?php esc_html_e( 'Name Field', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text1' ); ?>" name="<?php echo $this->get_field_name( 'text1' ); ?>" type="text" value="<?php echo esc_attr( $instance['text1'] ); ?>" />
        </p>

        <!-- text2 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text2' ); ?>"><?php esc_html_e( 'Name Field', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text2' ); ?>" name="<?php echo $this->get_field_name( 'text2' ); ?>" type="text" value="<?php echo esc_attr( $instance['text2'] ); ?>" />
        </p>

         <!-- text3 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text3' ); ?>"><?php esc_html_e( 'Email Field', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text3' ); ?>" name="<?php echo $this->get_field_name( 'text3' ); ?>" type="text" value="<?php echo esc_attr( $instance['text3'] ); ?>" />
        </p>

        <!-- text4 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text4' ); ?>"><?php esc_html_e( 'Email Field', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text4' ); ?>" name="<?php echo $this->get_field_name( 'text4' ); ?>" type="text" value="<?php echo esc_attr( $instance['text4'] ); ?>" />
        </p>

        <br>
        <br>


        
    <?php
    }

    /**
       * Sanitize widget form values as they are saved.
       *
       * @see WP_Widget::update()
       *
       * @param array $new_instance Values just sent to be saved.
       * @param array $old_instance Previously saved values from database.
       *
       * @return array Updated safe values to be saved.
    */
    public function update( $new_instance, $old_instance ) {

        // update logic goes here
        $instance = $new_instance;
        $instance[ 'heroimage' ]      = esc_url( $new_instance[ 'heroimage' ] );
        $instance[ 'image' ]          = esc_url( $new_instance[ 'image' ] );
        $instance[ 'text1' ]          = wp_kses_post( $new_instance[ 'text1' ] );
        $instance[ 'text2' ]          = wp_kses_post( $new_instance[ 'text2' ] );
        $instance[ 'text3' ]          = wp_kses_post( $new_instance[ 'text3' ] );
        $instance[ 'text4' ]          = wp_kses_post( $new_instance[ 'text4' ] );
        $instance[ 'introimgfixed' ]  = esc_url( $new_instance[ 'introimgfixed' ] );



        return $instance;
    }

}