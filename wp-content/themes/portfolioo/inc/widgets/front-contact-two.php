<?php


/*************************************************
* Portfolioo Contact Two Widget
**************************************************/

/**
 * Register the Widget
 */
function portfolioo_contact_two_widget() {
    register_widget( 'portfolioo_contact_two_widget' );
}
add_action( 'widgets_init', 'portfolioo_contact_two_widget' );

class portfolioo_contact_two_widget extends WP_Widget
{
    /**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'portfolioo_contact_two_widget',
            'description' => esc_html__('Portfolioo Contact Widget Two', 'portfolioo'),
            'customize_selective_refresh' => true
        );

        parent::__construct( 'portfolioo_contact_two_widget', 'Contact Widget Two', $widget_ops );

        
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

          $title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'], $instance, $this->id_base ) : esc_attr__('Contact Me','portfolioo');
          
          $name = isset( $instance['name'] ) ? apply_filters('', $instance['name'] ) : esc_attr__('John Doe','portfolioo');
          $text1 = isset( $instance['text1'] ) ? apply_filters('', $instance['text1'] ) : esc_attr__('Founder','portfolioo');
          $text2 = isset( $instance['text2'] ) ? apply_filters('', $instance['text2'] ) : esc_attr__('+44-444-444','portfolioo');
          $email = isset( $instance['email'] ) ? ( $instance['email'] ) : 'example@email.com';

          $address1 = isset( $instance['address1'] ) ? apply_filters('', $instance['address1'] ) : esc_attr__('Office Address','portfolioo');
          $address2 = isset( $instance['address2'] ) ? apply_filters('', $instance['address2'] ) : esc_attr__('134, Pirate road, Free juntion','portfolioo');
          $address3 = isset( $instance['address3'] ) ?  $instance['address3']  : esc_attr__('Seasame Street, NYC','portfolioo');
          $address4 = isset( $instance['address4'] ) ?  $instance['address4']  : esc_attr__('Seasame Street, NYC','portfolioo');


        /* Before widget (defined by themes). */
          echo $args['before_widget'] ;

          echo '<section class="contact2">
                <div id="contact2" class="slide-1 slide-content">
                <article class="fadeInDown">';


          if(isset($title) ){    

              echo '<h2>'. esc_html(do_shortcode($title)) .'</h2>';
                        
          }

          echo '<div class="contact-box">
                <span class="border-1"></span>
                <span class="border-2"></span>
                <div class="inner">
                <div class="column">';

          if(isset($name) ){    
              
              echo '<h3>'. esc_html(do_shortcode($name)) .'</h3>';
                        
          }

          echo '<ul>';

          if(isset($text1) ){    
              echo '<li>'. esc_html(do_shortcode($text1)) .'</li>';         
          }

          if(isset($text2) ){    
              echo '<li>'. esc_html(do_shortcode($text2)) .'</li>';         
          }

          if(isset($email) ) {
              echo '<li>'. esc_html(do_shortcode($email)).'</li>'; 
          }

          echo '</ul>
                </div>
                <div class="column">';

          if(isset($address1) ){    
              echo '<h3>'. esc_html(do_shortcode($address1)) .'</h3>';         
          }

          echo '<ul>';

          if(isset($address2) ){    
              echo '<li>'. esc_html(do_shortcode($address2)) .'</li>';         
          }

          if(isset($address3) ){    
              echo '<li>'. esc_html(do_shortcode($address3)) .'</li>';         
          }

          if(isset($address4) ){    
              echo '<li>'. esc_html(do_shortcode($address4)) .'</li>';         
          }

          echo '</ul>
                </div>
                </div>
                </div>
                </article>
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
          'title'         => esc_attr__('Contact Me', 'portfolioo'),
          'name'          => esc_attr__('John Doe', 'portfolioo'),
          'text1'         => esc_attr__('Founder', 'portfolioo'),
          'text2'         => esc_attr__('+44-444-444', 'portfolioo'),
          'email'         => esc_attr__('example@email.com', 'portfolioo'),
          'address1'      => esc_attr__('Office Address', 'portfolioo'),
          'address2'      => esc_attr__('134, Pirate road, Free juntion', 'portfolioo'),
          'address3'      => esc_attr__('Seasame Street, NYC', 'portfolioo'),
          'address4'           => esc_attr__('Seasame Street, NYC', 'portfolioo')
          );
          
          
        $instance = wp_parse_args( (array) $instance, $defaults ); 

        
        ?>

        <p>
          <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php esc_html_e( 'Title', 'portfolioo'  ); ?></label>
            <input placeholder="<?php esc_attr__('Contact Me', 'portfolioo'); ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>


        <br>

        <p>
          <label for="<?php echo $this->get_field_name( 'name' ); ?>"><?php esc_html_e( 'Text: Address', 'portfolioo'  ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_name( 'text1' ); ?>"><?php esc_html_e( 'Text: Address', 'portfolioo'  ); ?></label>
            <input  class="widefat" id="<?php echo $this->get_field_id( 'text1' ); ?>" name="<?php echo $this->get_field_name( 'text1' ); ?>" type="text" value="<?php echo esc_attr( $instance['text1'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_name( 'text2' ); ?>"><?php esc_html_e( 'Text: Number', 'portfolioo'  ); ?></label>
            <input  class="widefat" id="<?php echo $this->get_field_id( 'text2' ); ?>" name="<?php echo $this->get_field_name( 'text2' ); ?>" type="text" value="<?php echo esc_attr( $instance['text2'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_name( 'email' ); ?>"><?php esc_html_e( 'Text: Email', 'portfolioo'  ); ?></label>
            <input  class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $instance['email'] ); ?>" />
        </p>

        <br>


        <p>
          <label for="<?php echo $this->get_field_name( 'address1' ); ?>"><?php esc_html_e( 'Top Text', 'portfolioo'  ); ?></label>
            <input  class="widefat" id="<?php echo $this->get_field_id( 'address1' ); ?>" name="<?php echo $this->get_field_name( 'address1' ); ?>" type="text" value="<?php echo esc_attr( $instance['address1'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_name( 'address2' ); ?>"><?php esc_html_e( 'Text', 'portfolioo'  ); ?></label>
            <input  class="widefat" id="<?php echo $this->get_field_id( 'address2' ); ?>" name="<?php echo $this->get_field_name( 'address2' ); ?>" type="text" value="<?php echo esc_attr( $instance['address2'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_name( 'address3' ); ?>"><?php esc_html_e( 'Text', 'portfolioo'  ); ?></label>
            <input  class="widefat" id="<?php echo $this->get_field_id( 'address3' ); ?>" name="<?php echo $this->get_field_name( 'address3' ); ?>" type="text" value="<?php echo esc_attr( $instance['address3'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_name( 'address4' ); ?>"><?php esc_html_e( 'Text', 'portfolioo'  ); ?></label>
            <input  class="widefat" id="<?php echo $this->get_field_id( 'address4' ); ?>" name="<?php echo $this->get_field_name( 'address4' ); ?>" type="text" value="<?php echo esc_attr( $instance['address4'] ); ?>" />
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

        $instance[ 'title' ]      = wp_kses_post( $new_instance[ 'title' ] );
        $instance[ 'name' ]      = wp_kses_post( $new_instance[ 'name' ] );
        $instance[ 'text1' ]      = wp_kses_post( $new_instance[ 'text1' ] );
        $instance[ 'text2' ]      = wp_kses_post( $new_instance[ 'text2' ] );
        $instance[ 'email' ]      = sanitize_email($new_instance[ 'email' ] );
        $instance[ 'address1' ]      = wp_kses_post( $new_instance[ 'address1' ] );
        $instance[ 'address2' ]      = wp_kses_post( $new_instance[ 'address2' ] );
        $instance[ 'address3' ]      = wp_kses_post( $new_instance[ 'address3' ] );
        $instance[ 'address4' ]      = wp_kses_post( $new_instance[ 'address4' ] );
        
   

        return $instance;
    }

     
             
}