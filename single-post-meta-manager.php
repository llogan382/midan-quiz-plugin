<?php
/*
 * Plugin Name:       Single Post Meta Manager
 * Plugin URI:        http://github.com/tommcfarlin/post-meta-manager
 * Description:       Single Post Meta Manager displays the post meta data associated with a given post.
 * Version:           0.2.0
 * Author:            Tom McFarlin
 * Author URI:        http://tommcfarlin.com
 * Text Domain:       single-post-meta-manager-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
require_once(plugin_dir_path(__FILE__).'admin/class-custom-meta.php');

require_once(plugin_dir_path(__FILE__).'admin/class-save-post-data.php');
require_once(plugin_dir_path(__FILE__).'single-mdn_social_quiz.php');



// require_once(plugin_dir_path(__FILE__).'admin/partials/class-meta-admin-display.php');


// $admin_save = new AdminSaveMeta;
// $admin_save->hook_into_wordpress();



function activate(){

    $labels = array(
        'name'                  => 'Social Quizzes',
        'singular_name'         => 'Social Quiz',
        'menu_name'             => 'Social Quiz',
        'name_admin_bar'        => 'Social Quiz',
        'archives'              => 'Social Quiz Archives',
        'attributes'            => 'Social Quiz Attributes',
        'parent_item_colon'     => 'Parent Social Quiz:',
        'all_items'             => 'All Social Quizzes',
        'add_new_item'          => 'Add New Social Quiz',
        'add_new'               => 'Add New Social Quiz',
        'new_item'              => 'New Social Quiz',
        'edit_item'             => 'Edit Social Quiz',
        'update_item'           => 'Update Social Quiz',
        'view_item'             => 'View Social Quiz',
        'view_items'            => 'View Social Quizzes',
        'search_items'          => 'Search Social Quiz',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into Social Quiz',
        'uploaded_to_this_item' => 'Uploaded to this Social Quiz',
        'items_list'            => 'Social Quizzes list',
        'items_list_navigation' => 'Social Quizzes list navigation',
        'filter_items_list'     => 'Filter Social Quizzes list',
    );
    $rewrite = array(
        'slug'                  => 'quiz',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => 'Social Quiz',
        'description'           => 'A fun quiz generator',
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'custom-fields', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-welcome-learn-more',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type( 'mdn_social_quiz', $args );

}

add_action('init', 'activate');