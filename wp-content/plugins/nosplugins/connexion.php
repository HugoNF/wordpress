<?php
class connexionWidget extends WP_Widget
{
    public function __construct()
    {
        $options = array(
            'classname' => 'connexionwidget',
            'description' => 'Affiche un formulaire de connexion'
        );
        parent::__construct('connexionwidget', 'Connexion', $options);
    }
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];
        add_action('widgets_init', wp_login_form());
        echo $args['after_widget'];
    }
}