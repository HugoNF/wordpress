<?php


/*************************************************
* Portfolioo Clients two Widget
**************************************************/

/**
 * Register the Widget
 */
function portfolioo_porfolio_two_widget() {
    register_widget( 'portfolioo_porfolio_two_widget' );
}
add_action( 'widgets_init', 'portfolioo_porfolio_two_widget' );


class portfolioo_porfolio_two_widget extends WP_Widget
{
    /**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'portfolioo_porfolio_two_widget',
            'description' => esc_html__('Portfolioo Porfolio Widget Two', 'portfolioo'),
            'customize_selective_refresh' => true
        );

        parent::__construct( 'portfolioo_porfolio_two_widget', 'Porfolio Widget Two', $widget_ops );

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


          $title  = isset( $instance['title'] ) ?  apply_filters('widget_title', $instance['title'], $instance, $this->id_base ) : esc_attr__('Portfolio','portfolioo');

          $text1          = isset( $instance['text1'] ) ? apply_filters('', $instance['text1'] ) : esc_attr__('Branding','portfolioo');
          $text2          = isset( $instance['text2'] ) ? apply_filters('', $instance['text2'] ) : esc_attr__('Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolore Lorem Ipsum dolor','portfolioo');
          $text3          = isset( $instance['text3'] ) ? apply_filters('', $instance['text3'] ) : esc_attr__('Design','portfolioo');
          $text4          = isset( $instance['text4'] ) ? apply_filters('', $instance['text4'] ) : esc_attr__('Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolore Lorem Ipsum dolor','portfolioo');
          $text5          = isset( $instance['text5'] ) ? apply_filters('', $instance['text5'] ) : esc_attr__('Advertising','portfolioo');
          $text6          = isset( $instance['text6'] ) ? apply_filters('', $instance['text6'] ) : esc_attr__('Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolore Lorem Ipsum dolor','portfolioo');



          /* Before widget (defined by themes). */
          echo $args['before_widget'] ;


          echo '<section class="services">
                <div class="services_wrap">
                <div class="part1">';

          if(isset($title) ) {
            
            echo '<h2>'.esc_html(do_shortcode($title)) .'</h2>'; 
          }
          
          echo '</div>
                <div class="part2">
                <div class="div">';

          if(isset($text1) ){
              
            echo '<h3>' . esc_html(do_shortcode($text1))  .'</h3>';
          }

          if(isset($text2) ){
              
            echo '<p>' . esc_html(do_shortcode($text2))  .'</p>';
          }

          echo '</div>
                <div style="clear: both;"></div>
                <div class="div">';

          if(isset($text3) ){
              
            echo '<h3>' . esc_html(do_shortcode($text3))  .'</h3>';
          }

          if(isset($text4) ){
              
            echo '<p>' . esc_html(do_shortcode($text4))  .'</p>';
          }

          echo '</div>
                <div style="clear: both;"></div>
                <div class="div">';

          if(isset($text5) ){
              
            echo '<h3>' . esc_html(do_shortcode($text5))  .'</h3>';
          }

          if(isset($text6) ){
              
            echo '<p>' . esc_html(do_shortcode($text6))  .'</p>';
          }

          echo '</div>
                </div>
                <div style="clear: both;"></div>
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
          'title'        => esc_attr__('Portfolio', 'portfolioo'),
          'text1'         => esc_attr__('Branding',  'portfolioo'),
          'text2'         => esc_attr__('Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolore Lorem Ipsum dolor', 'portfolioo'),
          'text3'         => esc_attr__('Design', 'portfolioo'),
          'text4'         => esc_attr__('Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolore Lorem Ipsum dolor', 'portfolioo'),
          'text5'         => esc_attr__('Advertising',  'portfolioo'),
          'text6'         => esc_attr__('Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolore Lorem Ipsum dolor', 'portfolioo'),
          );
      		
      		
        $instance = wp_parse_args( (array) $instance, $defaults ); 

        
        ?>

        <p>
          <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php esc_html_e( 'Title', 'portfolioo'  ); ?></label>
            <input placeholder="<?php esc_attr__('Portfolio', 'portfolioo'); ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
       
        <br>

        <p>
          <label for="<?php echo $this->get_field_name( 'text1' ); ?>"><?php esc_html_e( 'Sub Title', 'portfolioo'  ); ?></label>
            <input placeholder="<?php esc_attr__('Branding', 'portfolioo'); ?>"class="widefat" id="<?php echo $this->get_field_id( 'text1' ); ?>" name="<?php echo $this->get_field_name( 'text1' ); ?>" type="text" value="<?php echo esc_attr( $instance['text1'] ); ?>" />
        </p>

       <p>
          <label for="<?php echo $this->get_field_name( 'text5' ); ?>"><?php esc_html_e( 'Sub Title', 'portfolioo'  ); ?></label>
            <input placeholder="<?php esc_attr__('Advertising', 'portfolioo'); ?>"class="widefat" id="<?php echo $this->get_field_id( 'text5' ); ?>" name="<?php echo $this->get_field_name( 'text5' ); ?>" type="text" value="<?php echo esc_attr( $instance['text5'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_name( 'text3' ); ?>"><?php esc_html_e( 'Sub Title', 'portfolioo'  ); ?></label>
            <input placeholder="<?php esc_attr__('Design', 'portfolioo'); ?>"class="widefat" id="<?php echo $this->get_field_id( 'text3' ); ?>" name="<?php echo $this->get_field_name( 'text3' ); ?>" type="text" value="<?php echo esc_attr( $instance['text3'] ); ?>" />
        </p>
       
        <br>

        <p>
          <label for="<?php echo $this->get_field_name( 'text4' ); ?>"><?php esc_html_e( 'Text', 'portfolioo'  ); ?></label>
            <input placeholder="<?php esc_attr__('Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolore Lorem Ipsum dolor', 'portfolioo'); ?>"class="widefat" id="<?php echo $this->get_field_id( 'text4' ); ?>" name="<?php echo $this->get_field_name( 'text4' ); ?>" type="text" value="<?php echo esc_attr( $instance['text4'] ); ?>" />
        </p>

         <p>
          <label for="<?php echo $this->get_field_name( 'text2' ); ?>"><?php esc_html_e( 'Text', 'portfolioo'  ); ?></label>
            <input placeholder="<?php esc_attr__('Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolore Lorem Ipsum dolor', 'portfolioo'); ?>"class="widefat" id="<?php echo $this->get_field_id( 'text2' ); ?>" name="<?php echo $this->get_field_name( 'text2' ); ?>" type="text" value="<?php echo esc_attr( $instance['text2'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_name( 'text6' ); ?>"><?php esc_html_e( 'Text', 'portfolioo'  ); ?></label>
            <input placeholder="<?php esc_attr__('Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolor Lorem Ipsum dolore Lorem Ipsum dolor', 'portfolioo'); ?>"class="widefat" id="<?php echo $this->get_field_id( 'text6' ); ?>" name="<?php echo $this->get_field_name( 'text6' ); ?>" type="text" value="<?php echo esc_attr( $instance['text6'] ); ?>" />
        </p>
  

   
        
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

        $instance[ 'title' ]      = wp_kses_post( $new_instance[ 'title' ] );
        $instance[ 'text1' ]          = wp_kses_post( $new_instance[ 'text1' ] );
        $instance[ 'text2' ]          = wp_kses_post( $new_instance[ 'text2' ] );
        $instance[ 'text3' ]          = wp_kses_post( $new_instance[ 'text3' ] );
        $instance[ 'text4' ]          = wp_kses_post( $new_instance[ 'text4' ] );
        $instance[ 'text5' ]          = wp_kses_post( $new_instance[ 'text5' ] );
        $instance[ 'text6' ]          = wp_kses_post( $new_instance[ 'text6' ] );
      
   
        return $instance;
    }

}
