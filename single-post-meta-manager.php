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




function wporg_add_custom_box()
{

        add_meta_box(
            'wporg_box_id',           // Unique ID
            'Custom Meta Box Title',  // Box title
            'wporg_custom_box_html',  // Content callback, must be of type callable
            'mdn_social_quiz'                   // Post type
        );

    }
add_action('add_meta_boxes', 'wporg_add_custom_box');



function wporg_custom_box_html($post){
    $value = get_post_meta($post->ID, '_wporg_meta_key', true);
    wp_nonce_field( 'pre_repeatable_meta_box_nonce', 'pre_repeatable_meta_box_nonce' );

    if($value):
    foreach($value as $x  ){

    ?>
<table class="quesTables">
    <tr>


        <td><label class="ques" for="quiz_question">Question</label></td>
        <td><input name="quiz_question[]" class="quesInp" type="text" value="<?php echo $x['quiz_question']; ?>"/></td>
        <td><label class="answAlab" for="answerA">A</label></td>
        <td><input class="answerAinp" name="answerA[]" class="answerA" type="text" value="<?php if($x['answerA'] != '') echo esc_attr($x['answerA']);?>"></td>
        <td><label class="answBlab" for="answerB">B</label></td>
        <td><input class="answerBinp" name="answerB[]" class="answerB" type="text" value="<?php if($x['answerB'] != '') echo esc_attr($x['answerB']);?>"></td>
        <td><label class="answClab" for="answerC">C</label></td>
        <td><input class="answerCinp" name="answerC[]" class="answerC" type="text" value="<?php if($x['answerC'] != '') echo esc_attr($x['answerC']);?>"></td>
        <td><label class="answDlab" for="answerD">D</label></td>
        <td><input class="answerDinp" name="answerD[]" class="answerD" type="text" value="<?php if($x['answerD'] != '') echo esc_attr($x['answerD']);?>"></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2"></td>

        <td colspan="2">
            <?php
            if($x['img1']['url'] != '') echo "<label>Current File: " . $x['img1']['url'] . "</label>";
            ?>
        <input class="answ1File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td colspan="2"><input class="answ2File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td colspan="2"><input class="answ3File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td colspan="2"><input class="answ4File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td></td>
    </tr>


</table>
<?php

}
    else :
    // show a blank one
    ?>
<table>
    <tr>

        <td><label class="ques" for="quiz_question">Question</label></td>
        <td><input name="quiz_question[]" class="quesInp" type="text" value=""></td>
        <td><label class="answAlab" for="answerA">A</label></td>
        <td><input class="answerAinp" name="answerA[]" class="answerA" type="text" value=""></td>
        <td><label class="answBlab" for="answerB">B</label></td>
        <td><input class="answerBinp" name="answerB[]" class="answerB" type="text" value=""></td>
        <td><label class="answClab" for="answerC">C</label></td>
        <td><input class="answerCinp" name="answerC[]" class="answerC" type="text" value=""></td>
        <td><label class="answDlab" for="answerD">D</label></td>
        <td><input class="answerDinp" name="answerD[]" class="answerD" type="text" value=""></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2"></td>

        <td colspan="2"><input class="answ1File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td colspan="2"><input class="answ2File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td colspan="2"><input class="answ3File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td colspan="2"><input class="answ4File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td></td>
    </tr>


</table>
<?php endif; ?>



<table class="hidden-table mdn-hidden-input">
    <tr>

        <td><label class="ques" for="quiz_question">Question</label></td>
        <td><input name="quiz_question[]" class="quesInp" type="text" value=""></td>
        <td><label class="answAlab" for="answerA">A</label></td>
        <td><input class="answerAinp" name="answerA[]" class="answerA" type="text" value=""></td>
        <td><label class="answBlab" for="answerB">B</label></td>
        <td><input class="answerBinp" name="answerB[]" class="answerB" type="text" value=""></td>
        <td><label class="answClab" for="answerC">C</label></td>
        <td><input class="answerCinp" name="answerC[]" class="answerC" type="text" value=""></td>
        <td><label class="answDlab" for="answerD">D</label></td>
        <td><input class="answerDinp" name="answerD[]" class="answerD" type="text" value=""></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2"></td>

        <td colspan="2"><input class="answ1File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td colspan="2"><input class="answ2File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td colspan="2"><input class="answ3File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td colspan="2"><input class="answ4File" id="wp_custom_attachment" name="wp_custom_attachment" size="25"
                type="file" value="" /></td>
        <td></td>
    </tr>


</table>
<button onclick="myFunction()">Add Question</button>
<!-- Make a hidden copy of the table -->
<!-- On click, 1) make hidden copy visible -->
<!-- 2) duplicate the table -->
<?php

add_action('save_post', 'wporg_save_postdata');



function wporg_save_postdata($post_id){

    if ( ! isset( $_POST['pre_repeatable_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['pre_repeatable_meta_box_nonce'], 'pre_repeatable_meta_box_nonce' ) )
        return;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;


        $old = get_post_meta($post_id, '_wporg_meta_key', true);
        $new = array();
        $quiz_question = $_POST['quiz_question'];
        $answerA = $_POST['answerA'];
        $answerB = $_POST['answerB'];
        $answerC = $_POST['answerC'];
        $answerD = $_POST['answerD'];


        $upload1 = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
        $upload2 = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
        $upload3 = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
        $upload4 = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));


        $count = count($quiz_question);
        for($i = 0; $i < $count; $i++){
            if($quiz_question[$i] != ''):
                $new[$i]['quiz_question'] = stripslashes( strip_tags( $quiz_question[$i] ) );

                $new[$i]['answerA'] = stripslashes($answerA[$i]);
                $new[$i]['answerB'] = stripslashes($answerB[$i]);
                $new[$i]['answerC'] = stripslashes($answerC[$i]);
                $new[$i]['answerD'] = stripslashes($answerD[$i]);

                $new[$i]['img1']= $upload1;
                $new[$i]['img2']= $upload2;
                $new[$i]['img3']= $upload3;
                $new[$i]['img4']= $upload4;

            endif;
        }

        update_post_meta( $post_id, '_wporg_meta_key', $new );
    }
}



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