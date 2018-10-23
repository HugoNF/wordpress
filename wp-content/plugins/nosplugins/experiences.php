<?php
/*
Plugin Name: les experiences
Description: les experiences
Version: 0.0.1
Author: Hugo Ratel
*/
class experiencesmanagerPlugin {
    public function __construct() {
        require_once( plugin_dir_path(__FILE__) . '/experiencesWidget.php' );
        add_action('wp_loaded', array($this, 'addNewExperience'));
        add_action('widgets_init', function() {
            register_widget('experiencesmanagerWidget');
        });
        add_shortcode('experience', array($this, 'shortcodeAction'));
    }

    
    public function addNewExperience() {
        if(isset($_POST['experience'])) {
            if($_POST['experience'] === "") {
                return;
            } else {
                global $wpdb;
                $wpdb->query(
                    $wpdb->prepare(
                        'INSERT INTO '. $wpdb->prefix .'experiences (DESCRIPTION) VALUES (%s)', $_POST['experience']
                    )
                );
            }
        }
    }

    public function displayMsg($msg){
        add_action('wp_enqueue_scripts',function() use ($msg){
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function(){
                    alert('<?php echo $msg; ?>');
                });
            </script>
            <?php
        });
    }
    public function shortcodeAction(){
        the_widget('experiencesmanagerWidget');
    }
}
register_activation_hook(__FILE__, array('experiencesmanagerPlugin', 'pluginActivation'));
register_uninstall_hook(__FILE__, array('experiencesmanagerPlugin', 'uninstall'));
add_action( 'plugins_loaded', function(){
    new experiencesmanagerPlugin();
} );