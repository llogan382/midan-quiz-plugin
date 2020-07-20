<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       loganwebdev.com
 * @since      1.0.0
 *
 * @package    Mdn_social_quiz
 * @subpackage Mdn_social_quiz/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mdn_social_quiz
 * @subpackage Mdn_social_quiz/includes
 * @author     Midan Dev Team <llogan382@gmail.com>
 */
class Mdn_social_quiz_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mdn_social_quiz',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
