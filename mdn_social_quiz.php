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



abstract class WPOrg_Meta_Box
{
    public static function add()
    {
        $screens = ['post', 'mdn_social_quiz'];
        foreach ($screens as $screen) {
            add_meta_box(
                'wporg_box_id',          // Unique ID
                'Custom Meta Box Title', // Box title
                [self::class, 'html'],   // Content callback, must be of type callable
                $screen                  // Post type
            );
        }
    }

    public static function save($post_id)
    {
        if (array_key_exists('wporg_field', $_POST)) {
            update_post_meta(
                $post_id,
                '_wporg_meta_key',
                $_POST['wporg_field']
            );
        }
    }

    public static function html($post)
    {
        $value = get_post_meta($post->ID, '_wporg_meta_key', true);
        ?>
        <label for="wporg_field">Description for this field</label>
        <input type="text" name="wporg_field" id="wporg_field" class="postbox"  value="<?php echo esc_attr( get_post_meta( $post->ID, 'smashing_post_class', true ) ); ?>">

        </input>
        <?php
    }
}

add_action('add_meta_boxes', ['WPOrg_Meta_Box', 'add']);
add_action('save_post', ['WPOrg_Meta_Box', 'save']);

add_filter( 'template_include', 'my_plugin_templates' );
function my_plugin_templates( $template ) {
    $post_types = array( 'mdn_social_quiz' );

    if ( is_post_type_archive( $post_types ) && ! file_exists( get_stylesheet_directory() . '/archive-mdn_social_quiz.php' ) )
    $template = plugin_dir_path( __FILE__ ) . 'archive-mdn_social_quiz.php';
    if ( is_singular( $post_types ) && ! file_exists( get_stylesheet_directory() . '/single-mdn_social_quiz.php' ) )
        $template = plugin_dir_path( __FILE__ ) . 'single-mdn_social_quiz.php';

    return $template;
}