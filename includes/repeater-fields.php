<?php
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



function wporg_custom_box_html($post)
{
    $value = get_post_meta($post->ID, '_wporg_meta_key', true);
    ?>
<label for="ques1">Question</label>
<input name="ques1[]" class="ques" type="text">
<label for="answer1">Answer</label>
<input name="answer1[]" class="answer1" type="text">

<input id="wp_custom_attachment" name="wp_custom_attachment" size="25" type="file" value="" />
<?php
}


function wporg_save_postdata($post_id)
{

    $new = array();
    $ques1 = $_POST['answer1'];
    $answer1 = $_POST['ques1'];
    $new[1]['ques']= $ques1;
    $new[1]['answ']= $answer1;



    update_post_meta(
        $post_id,
        '_wporg_meta_key',
        $new[1]
    );
    //Here do whathever you want with this $title and $desc.
}

add_action('save_post', 'wporg_save_postdata');