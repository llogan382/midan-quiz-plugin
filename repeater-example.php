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




add_action('admin_init', 'gpm_add_meta_boxes', 2);

function gpm_add_meta_boxes() {
    add_meta_box( '
    gpminvoice-group',
    'Custom Repeatable',
    'Repeatable_meta_box_display',
    'lwd_social_quiz',
    'normal', 'default');
}

function Repeatable_meta_box_display() {
    global $post;
    $gpminvoice_group = get_post_meta($post->ID, 'customdata_group', true);
     wp_nonce_field( 'gpm_repeatable_meta_box_nonce', 'gpm_repeatable_meta_box_nonce' );
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function( $ ){
        $( '#add-row' ).on('click', function() {
            var row = $( '.empty-row.screen-reader-text' ).clone(true);
            row.removeClass( 'empty-row screen-reader-text' );
            row.insertBefore( '#repeatable-fieldset-one tbody>tr:last' );
            return false;
        });

        $( '.remove-row' ).on('click', function() {
            $(this).parents('tr').remove();
            return false;
        });
    });
  </script>
  <table id="repeatable-fieldset-one" width="100%">
  <tbody>
    <?php
     if ( $gpminvoice_group ) :
      foreach ( $gpminvoice_group as $field ) {
    ?>
    <tr>
      <td width="15%">
        <input type="text"  placeholder="Title" name="TitleItem[]" value="<?php if($field['TitleItem'] != '') echo esc_attr( $field['TitleItem'] ); ?>" /></td>
      <td width="70%">
      <textarea placeholder="Description" cols="55" rows="5" name="TitleDescription[]"> <?php if ($field['TitleDescription'] != '') echo esc_attr( $field['TitleDescription'] ); ?> </textarea></td>
      <td width="15%"><a class="button remove-row" href="#1">Remove</a></td>
    </tr>
    <?php
    }
    else :
    // show a blank one
    ?>
    <tr>
      <td>
        <input type="text" placeholder="Title" title="Title" name="TitleItem[]" /></td>
      <td>
          <textarea  placeholder="Description" name="TitleDescription[]" cols="55" rows="5">  </textarea>
          </td>
      <td><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
    </tr>
    <?php endif; ?>

    <!-- empty hidden one for jQuery -->
    <tr class="empty-row screen-reader-text">
      <td>
        <input type="text" placeholder="Title" name="TitleItem[]"/></td>
      <td>
          <textarea placeholder="Description" cols="55" rows="5" name="TitleDescription[]"></textarea>
          </td>
      <td><a class="button remove-row" href="#">Remove</a></td>
    </tr>
  </tbody>
</table>
<p><a id="add-row" class="button" href="#">Add another</a></p>
 <?php
}
add_action('save_post', 'custom_repeatable_meta_box_save');
function custom_repeatable_meta_box_save($post_id) {
    if ( ! isset( $_POST['gpm_repeatable_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['gpm_repeatable_meta_box_nonce'], 'gpm_repeatable_meta_box_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'customdata_group', true);
    $new = array();
    $invoiceItems = $_POST['TitleItem'];
    $prices = $_POST['TitleDescription'];
     $count = count( $invoiceItems );
     for ( $i = 0; $i < $count; $i++ ) {
        if ( $invoiceItems[$i] != '' ) :
            $new[$i]['TitleItem'] = stripslashes( strip_tags( $invoiceItems[$i] ) );
             $new[$i]['TitleDescription'] = stripslashes( $prices[$i] ); // and however you want to sanitize
        endif;
    }
    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'customdata_group', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'customdata_group', $old );


}