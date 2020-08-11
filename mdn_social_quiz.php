<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              loganwebdev.com
 * @since             1.0.0
 * @package           Mdn_social_quiz
 *
 * @wordpress-plugin
 * Plugin Name:       Midan Social Quiz
 * Plugin URI:        https://midanmarketing.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Midan Dev Team
 * Author URI:        loganwebdev.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mdn_social_quiz
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MDN_SOCIAL_QUIZ_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mdn_social_quiz-activator.php
 */
function activate_mdn_social_quiz() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mdn_social_quiz-activator.php';
	Mdn_social_quiz_Activator::activate();

}


add_action( 'init', 'activate_mdn_social_quiz', 0 );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mdn_social_quiz-deactivator.php
 */
function deactivate_mdn_social_quiz() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mdn_social_quiz-deactivator.php';
	Mdn_social_quiz_Deactivator::deactivate();
}


register_activation_hook( __FILE__, 'activate_mdn_social_quiz' );
register_deactivation_hook( __FILE__, 'deactivate_mdn_social_quiz' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mdn_social_quiz.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mdn_social_quiz() {

	$plugin = new Mdn_social_quiz();
	$plugin->run();

}
run_mdn_social_quiz();




add_filter( 'template_include', 'my_plugin_templates' );
function my_plugin_templates( $template ) {
    $post_types = array( 'mdn_social_quiz' );

    if ( is_post_type_archive( $post_types ) && ! file_exists( get_stylesheet_directory() . '/archive-mdn_social_quiz.php' ) )
    $template = plugin_dir_path( __FILE__ ) . 'archive-mdn_social_quiz.php';
    if ( is_singular( $post_types ) && ! file_exists( get_stylesheet_directory() . '/single-mdn_social_quiz.php' ) )
        $template = plugin_dir_path( __FILE__ ) . 'single-mdn_social_quiz.php';

    return $template;
}


include(plugin_dir_path( __FILE__ ) . 'includes/repeater-fields.php');

register_activation_hook( __FILE__, 'sports_bench_create_db' );

function sports_bench_create_db() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	//* Create the teams table
	$table_name = $wpdb->prefix . 'social_quiz';
	$sql = "CREATE TABLE $table_name (
	quiz_id INTEGER NOT NULL AUTO_INCREMENT,
	quiz_title TEXT NOT NULL,
	quiz_subtitle TEXT NOT NULL,
	PRIMARY KEY (quiz_id)
	) $charset_collate;";
	dbDelta( $sql );
   }
   register_activation_hook( __FILE__, 'sports_bench_create_db' );




function gutenberg_can_edit_post_type( $post_type = 'mdn_social_quiz' ) {
	$can_edit = true;
	if ( ! post_type_exists( $post_type ) ) {
		return false;
		$can_edit = false;
	}

	if ( ! post_type_supports( $post_type, 'editor' ) ) {
		return false;
		$can_edit = false;
	}

	$post_type_object = get_post_type_object( $post_type );
	if ( ! $post_type_object->show_in_rest ) {
		return false;
		$can_edit = false;
	}

	return true;
	/**
	 * Filter to allow plugins to enable/disable Gutenberg for particular post types.
	 *
	 * @since 1.5.2
	 *
	 * @param bool   $can_edit  Whether the post type can be edited or not.
	 * @param string $post_type The post type being checked.
	 */
	return apply_filters( 'gutenberg_can_edit_post_type', $can_edit, $post_type );
}

add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type)
{
    // Use your post type key instead of 'product'
    if ($post_type === 'mdn_social_quiz') return false;
    return $current_status;
}

function sports_bench_team_admin_menu() {
	global $team_page;
	add_menu_page( __( 'Teams', 'sports-bench' ), __( 'Teams', 'sports-bench' ), 'edit_posts', 'add_data', 'sports_bench_teams_page_handler', 'dashicons-groups', 6 ) ;
   }
   add_action( 'admin_menu', 'sports_bench_team_admin_menu' );

   function sports_bench_teams_page_handler() {
	 global $wpdb;
	 echo '<form method="POST" action="?page=add_data">
    <label>Quiz Name: </label><input type="text" name="quiz_title" /><br />
	<label>Quiz Name: </label><input type="text" name="quiz_subtitle" /><br />

   <input type="submit" value="submit" />
   </form>';

   $table_name = $wpdb->prefix . 'social_quiz';
	 $default_row = $wpdb->get_row( "SELECT * FROM $table_name ORDER BY quiz_id DESC LIMIT 1" );
   if ( $default_row != null ) {
	$id = $default_row->quiz_id + 1;
   } else {
	$id = 1;
   }
	$default = array(
	'quiz_id' => $id,
	'quiz_title' => '',
	'quiz_subtitle' => '',
   );
   $item = shortcode_atts( $default, $_REQUEST );

	$wpdb->insert( $table_name, $item );
   }