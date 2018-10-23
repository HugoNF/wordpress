<?php
/*
Plugin Name: Inscription
Plugin URI:
Description: Plugin d'inscription
Author: Hugo Ratel
Version: 0.0.1
Author URI:
*/
class UsersManagerPlugin {
    public function __construct(){
        require_once(plugin_dir_path(__FILE__).'/registerWidget.php');
        add_action ('wp_loaded',array($this,'ajoututilisateur'));
        add_action ('widgets_init',function(){
            register_widget('UsersManagerWidget');
        });
        add_shortcode('inscription_form', array($this, 'shortcodeAction'));
    }

   public function ajoututilisateur(){ 

    #
       $userdata = array(
           'first_name' =>  $_POST['name'],
           'last_name'   =>  $_POST['surname'],
           'user_email'  =>  $_POST['email'],
           'user_login'  => $_POST['email'],
           'user_pass'   =>  $_POST['password'],
       );

       wp_insert_user($userdata);
   }

    public function shortcodeAction(){
        the_widget('UsersManagerWidget');
    }
}
add_shortcode( 'inscription', array( 'UsersManagerPlugin', 'ajoututilisateur' ) );
register_activation_hook(__FILE__, array('UsersManagerPlugin','pluginActivation'));
register_uninstall_hook(__FILE__, array('UsersManagerPlugin','uninstall'));
add_action( 'plugins_loaded', function(){
    new UsersManagerPlugin();
} );