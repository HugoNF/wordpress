<?php
/*
Plugin Name: connexion
Description: Plugin de connexion
Author: Hugo Ratel
Version: 0.0.1
*/
class connexionPlugin
{
    public function __construct()
    {
        require_once(plugin_dir_path(__FILE__) . '/connexion.php');
        add_action('widgets_init', function () {
            register_widget('connexionWidget');
        });
        add_shortcode('connexion', array($this, 'shortcodeAction'));
    }
    public function shortcodeAction(){
        the_widget('connexionWidget');
    }
}
register_activation_hook(__FILE__, array('connexionPlugin','pluginActivation'));
register_uninstall_hook(__FILE__, array('connexionPlugin','uninstall'));
add_action( 'plugins_loaded', function(){
    new connexionPlugin();
} );
?>