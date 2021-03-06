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
 * @package           lwd_social_quiz
 *
 * @wordpress-plugin
 * Plugin Name:       Logan Social Quiz
 * Plugin URI:        https://Loganmarketing.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Logan Dev Team
 * Author URI:        loganwebdev.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lwd_social_quiz
 * Domain Path:       /languages
 */



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
register_post_type( 'lwd_social_quiz', $args );

}

add_action( 'init', 'activate', 0 );


function Zumper_widget_enqueue_script()
{
    wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'js/addQuestion.js');
}
add_action('admin_enqueue_scripts', 'Zumper_widget_enqueue_script');

/**
 * Generated by the WordPress Meta Box Generator at http://goo.gl/8nwllb
 */
class Rational_Meta_Box {

	private $fields = array(
		'fields' => array(

			'id' => 'question',
			'label' => 'question',
			'type' => 'text',
				),
				array(
					'id' => 'answer1',
					'label' => 'answer1',
					'type' => 'text',
				),
				array(
					'id' => 'answer1img',
					'label' => 'answer1img',
					'type' => 'media',
				),
				array(
					'id' => 'answer2',
					'label' => 'answer2',
					'type' => 'text',
				),
				array(
					'id' => 'answer2img',
					'label' => 'answer2img',
					'type' => 'media',
				),
				array(
					'id' => 'answer3',
					'label' => 'answer3',
					'type' => 'text',
				),
				array(
					'id' => 'answer3img',
					'label' => 'answer3img',
					'type' => 'media',
				)
				);


	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'admin_footer' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
		add_action( 'add_question', array( $this, 'add_question' ) );

	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {

			add_meta_box(
				'advanced-options',
				__( 'Advanced Options', 'lwd_quiz_meta' ),
				array( $this, 'add_meta_box_callback' ),
				'lwd_social_quiz',
				'normal',
				'default'
			);

	}

	/**
	 * Generates the HTML for the meta box
	 *
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'advanced_options_data', 'advanced_options_nonce' );
		$ques_count = $_POST['question'];
		$count = count( $ques_count );
		var_dump($count + 1);
		$this->generate_fields( $post );
	}

	/**
	 * Hooks into WordPress' admin_footer function.
	 * Adds scripts for media uploader.
	 */
	public function admin_footer() {
		?><script>
			// https://codestag.com/how-to-use-wordpress-3-5-media-uploader-in-theme-options/
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.rational-metabox-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$("#"+id).val(attachment.url);
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
				}
			});
		</script><?php
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';

		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '[]' .'">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'advanced_options_' . $field['id'], true );
			switch ( $field['type'] ) {
				case 'media':
					$input = sprintf(
						'<input class="regular-text" id="%s" name="%s[]" type="text" value="%s"> <input class="button rational-metabox-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
						$field['id'],
						$field['id'],
						$db_value,
						$field['id'],
						$field['id']
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s[]" type="%s" value="%s">',
						$field['type'] !== 'color' ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= $this->row_format( $label, $input );

		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
		echo $this->add_question();

	}

	/**
	 * Generates the HTML for table rows.
	 */
	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}
	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['advanced_options_nonce'] ) )
			return $post_id;

		$nonce = $_POST['advanced_options_nonce'];
		if ( !wp_verify_nonce( $nonce, 'advanced_options_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'advanced_options_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'advanced_options_' . $field['id'], '0' );
			}
		}
	}

	public function add_question(){
		return sprintf(
			'<button onclick="lwdAddQuestion()";>Add Question</button>'
		);
	}
}
new Rational_Meta_Box;