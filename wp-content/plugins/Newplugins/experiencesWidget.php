<?php
class experiencesmanagerWidget extends WP_Widget {
    public function __construct() {
        $options = array(
            'classname' => 'experiencesmanagerwidget',
            'description' => 'Ajout des experiences'
        );
        parent::__construct('experiencesmanagerwidget', 'experience', $options);
    }
    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];
        ?>


        <form action="" method="POST">
            <p>
                <label for="experience">Experience</label>
                <textarea id="experience" name="experience" rows="7" cols="40"></textarea>
            </p>

            <input type="submit" name="submit" value="envoyer">
        </form>




        <?php
        echo $args['after_widget'];
    }
    public function form($instance){
        if(isset($instance['title'])){
            $title = $instance['title'];
        } else {
            $title = '';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Title:') ?></label>
            <input id="<?php echo $this->get_field_id('title') ?>" type="text" value="<?php echo $title ?>" name="<?php echo $this->get_field_name('title') ?>">
        </p>

        <?php
    }
}