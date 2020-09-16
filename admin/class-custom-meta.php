<?php
class Dog {
    public function hook_into_wordpress() {
        add_action( 'add_meta_boxes', [$this, 'wporg_add_custom_box'] );
    }



    public function wporg_add_custom_box() {


        require_once(plugin_dir_path(__FILE__).'partials/class-meta-admin-display.php');


        add_meta_box(
            'wporg_box_id',           // Unique ID
            'Custom Meta Box Title',  // Box title
            'showAdminMeta',  // Content callback, must be of type callable
            'mdn_social_quiz'                   // Post type
        );
    }



}

