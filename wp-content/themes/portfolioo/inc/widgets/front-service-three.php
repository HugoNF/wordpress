<?php


/*************************************************
* Service Three Widget
**************************************************/

/**
 * Register the Widget
 */
function portfolioo_service_three_widget() {
    register_widget( 'portfolioo_service_three_widget' );
}
add_action( 'widgets_init', 'portfolioo_service_three_widget' );

class portfolioo_service_three_widget extends WP_Widget
{
    /**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'portfolioo_service_three_widget',
            'description' => esc_html__('Portfolioo Service Widget Three', 'portfolioo'),
            'customize_selective_refresh' => true
        );

        parent::__construct( 'portfolioo_service_three_widget', 'Service Widget Three', $widget_ops );

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


            $title          = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'], $instance, $this->id_base ) : esc_attr__('Services','portfolioo');

            $text1          = isset( $instance['text1'] ) ? apply_filters('', $instance['text1'] ) : esc_attr__('Art Service','portfolioo');
            $text2          = isset( $instance['text2'] ) ? apply_filters('', $instance['text2'] ) : esc_attr__('Mechanical Parts','portfolioo');
            $text3          = isset( $instance['text3'] ) ? apply_filters('', $instance['text3'] ) : esc_attr__('Drawling life','portfolioo');
            $text4          = isset( $instance['text4'] ) ? apply_filters('', $instance['text4'] ) : esc_attr__('Animating','portfolioo');
            $text5          = isset( $instance['text5'] ) ? apply_filters('', $instance['text5'] ) : esc_attr__('Folklore','portfolioo');
            $text6          = isset( $instance['text6'] ) ? apply_filters('', $instance['text6'] ) : esc_attr__('Digital Marketing','portfolioo');
            $text7          = isset( $instance['text7'] ) ? apply_filters('', $instance['text7'] ) : esc_attr__('International Networking','portfolioo');
            $text8          = isset( $instance['text8'] ) ? apply_filters('', $instance['text8'] ) : esc_attr__('Social Experiment','portfolioo');
            $text9          = isset( $instance['text9'] ) ? apply_filters('', $instance['text9'] ) : esc_attr__('SEO','portfolioo');
            $text10          = isset( $instance['text10'] ) ? apply_filters('', $instance['text10'] ) : esc_attr__('Digital strategy','portfolioo');
            $text11          = isset( $instance['text11'] ) ? apply_filters('', $instance['text11'] ) : esc_attr__('Content Marketing','portfolioo');
            $text12          = isset( $instance['text12'] ) ? apply_filters('', $instance['text12'] ) : esc_attr__('Email Marketing','portfolioo');
            
          
 
          /* Before widget (defined by themes). */
          echo $args['before_widget'] ;

              echo '<section class="allserv">
                    <div class="allserv_wrap">
                    <div class="zero">';


              if(isset($title) ){
              
                 echo '<h3>' . esc_html(do_shortcode($title))  .'</h3>';
              }

              echo '</div>
                    <ul class="one">';
					    
              if(isset($text1) ){
              
                 echo '<li>' . esc_html(do_shortcode($text1))  .'</li>';
              }

              if(isset($text2) ){
              
                 echo '<li>' . esc_html(do_shortcode($text2))  .'</li>';
              }

              if(isset($text3) ){
              
                 echo '<li>' . esc_html(do_shortcode($text3))  .'</li>';
              }

              if(isset($text4) ){
              
                 echo '<li>' . esc_html(do_shortcode($text4))  .'</li>';
              }

              echo '</ul>
                    <ul class="one">';

              if(isset($text5) ){
              
                 echo '<li>' . esc_html(do_shortcode($text5))  .'</li>';
              }

              if(isset($text6) ){
              
                 echo '<li>' . esc_html(do_shortcode($text6))  .'</li>';
              }

              if(isset($text7) ){
              
                 echo '<li>' . esc_html(do_shortcode($text7))  .'</li>';
              }

              if(isset($text8) ){
              
                 echo '<li>' . esc_html(do_shortcode($text8))  .'</li>';
              }

              echo '</ul>
                    <ul class="one">';

              if(isset($text9) ){
              
                 echo '<li>' . esc_html(do_shortcode($text9))  .'</li>';
              }

              if(isset($text10) ){
              
                 echo '<li>' . esc_html(do_shortcode($text10))  .'</li>';
              }

              if(isset($text11) ){
              
                 echo '<li>' . esc_html(do_shortcode($text11) ) .'</li>';
              }

              if(isset($text12) ){
              
                 echo '<li>' . esc_html(do_shortcode($text12))  .'</li>';
              }

              echo '</ul><div style="clear:both;></div>"
                    </div>
                    </section>';
			     

          /* After widget (defined by themes). */
           echo $args['after_widget'] ;

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
          'title'         => esc_attr__('Services',  'portfolioo'),
          'text1'         => esc_attr__('Art Service',  'portfolioo'),
          'text2'         => esc_attr__('Mechanical Parts', 'portfolioo'),
          'text3'         => esc_attr__('Drawling life', 'portfolioo'),
          'text4'         => esc_attr__('Animating', 'portfolioo'),
          'text5'         => esc_attr__('Folklore',  'portfolioo'),
          'text6'         => esc_attr__('Digital Marketing', 'portfolioo'),
          'text7'         => esc_attr__('International Networking', 'portfolioo'),
          'text8'         => esc_attr__('Social Experiment', 'portfolioo'),
          'text9'         => esc_attr__('SEO',  'portfolioo'),
          'text10'         => esc_attr__('Digital strategy', 'portfolioo'),
          'text11'         => esc_attr__('Content Marketing', 'portfolioo'),
          'text12'         => esc_attr__('Email Marketing', 'portfolioo'),
        
          );
      		
      		
        $instance = wp_parse_args( (array) $instance, $defaults ); 

        
        ?>


        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php esc_html_e( 'Title', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
       
        <br>

        <br>
            
        <!-- text1 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text1' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text1' ); ?>" name="<?php echo $this->get_field_name( 'text1' ); ?>" type="text" value="<?php echo esc_attr( $instance['text1'] ); ?>" />
        </p>

        <!-- text2 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text2' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text2' ); ?>" name="<?php echo $this->get_field_name( 'text2' ); ?>" type="text" value="<?php echo esc_attr( $instance['text2'] ); ?>" />
        </p>

         <!-- text3 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text3' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text3' ); ?>" name="<?php echo $this->get_field_name( 'text3' ); ?>" type="text" value="<?php echo esc_attr( $instance['text3'] ); ?>" />
        </p>

        <!-- text4 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text4' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text4' ); ?>" name="<?php echo $this->get_field_name( 'text4' ); ?>" type="text" value="<?php echo esc_attr( $instance['text4'] ); ?>" />
        </p>


        <br>
        <br>
        <!-- text5 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text5' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text5' ); ?>" name="<?php echo $this->get_field_name( 'text5' ); ?>" type="text" value="<?php echo esc_attr( $instance['text5'] ); ?>" />
        </p>

        <!-- text6 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text6' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text6' ); ?>" name="<?php echo $this->get_field_name( 'text6' ); ?>" type="text" value="<?php echo esc_attr( $instance['text6'] ); ?>" />
        </p>

         <!-- text7 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text7' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text7' ); ?>" name="<?php echo $this->get_field_name( 'text7' ); ?>" type="text" value="<?php echo esc_attr( $instance['text7'] ); ?>" />
        </p>

        <!-- text8 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text8' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text8' ); ?>" name="<?php echo $this->get_field_name( 'text8' ); ?>" type="text" value="<?php echo esc_attr( $instance['text8'] ); ?>" />
        </p>

        <br>
        <br>
        <!-- text9 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text9' ); ?>"><?php _e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text9' ); ?>" name="<?php echo $this->get_field_name( 'text9' ); ?>" type="text" value="<?php echo esc_attr( $instance['text9'] ); ?>" />
        </p>

        <!-- text10 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text10' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text10' ); ?>" name="<?php echo $this->get_field_name( 'text10' ); ?>" type="text" value="<?php echo esc_attr( $instance['text10'] ); ?>" />
        </p>

         <!-- text11 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text11' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text11' ); ?>" name="<?php echo $this->get_field_name( 'text11' ); ?>" type="text" value="<?php echo esc_attr( $instance['text11'] ); ?>" />
        </p>

        <!-- text12 field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'text12' ); ?>"><?php esc_html_e( 'Text', 'portfolioo' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text12' ); ?>" name="<?php echo $this->get_field_name( 'text12' ); ?>" type="text" value="<?php echo esc_attr( $instance['text12'] ); ?>" />
        </p>

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

        $instance[ 'text1' ]          = wp_kses_post( $new_instance[ 'text1' ] );
        $instance[ 'text2' ]          = wp_kses_post( $new_instance[ 'text2' ] );
        $instance[ 'text3' ]          = wp_kses_post( $new_instance[ 'text3' ] );
        $instance[ 'text4' ]          = wp_kses_post( $new_instance[ 'text4' ] );
        $instance[ 'title' ]          = wp_kses_post( $new_instance[ 'title' ] );
        $instance[ 'text5' ]          = wp_kses_post( $new_instance[ 'text5' ] );
        $instance[ 'text6' ]          = wp_kses_post( $new_instance[ 'text6' ] );
        $instance[ 'text7' ]          = wp_kses_post( $new_instance[ 'text7' ] );
        $instance[ 'text8' ]          = wp_kses_post( $new_instance[ 'text8' ] );
        $instance[ 'text9' ]          = wp_kses_post( $new_instance[ 'text9' ] );
        $instance[ 'text10' ]          = wp_kses_post( $new_instance[ 'text10' ] );
        $instance[ 'text11' ]          = wp_kses_post( $new_instance[ 'text11' ] );
        $instance[ 'text12' ]          = wp_kses_post( $new_instance[ 'text12' ] );



        return $instance;
    }

}
