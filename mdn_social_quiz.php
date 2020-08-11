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
add_action('admin_init', 'gpm_add_meta_boxes', 2);
add_action('save_post', 'custom_repeatable_meta_box_save');


register_activation_hook( __FILE__, 'create_quiz_tables' );
function create_quiz_tables() {

	global $wpdb;
  	$version = get_option( 'midan_quiz_version', '1.0' );
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'social_quiz';

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		quiztitle text DEFAULT '' NOT NULL,
		quiz_subtitle text DEFAULT '' NOT NULL,
		quiz_questions text DEFAULT '' NOT NULL,
  		url varchar(55) DEFAULT '' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );



}