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
<label for="answerA">A</label>
<input name="answerA[]" class="answerA" type="text">
<input id="wp_custom_attachmentA" name="wp_custom_attachmentA" size="25" type="file" value="" />
<label for="answerB">B</label>
<input name="answerB[]" class="answerB" type="text">
<input id="wp_custom_attachmentB" name="wp_custom_attachmentB" size="25" type="file" value="" />
<label for="answerC">C</label>
<input name="answerC[]" class="answerC" type="text">
<input id="wp_custom_attachmentC" name="wp_custom_attachmentC" size="25" type="file" value="" />
<label for="answerD">D</label>
<input name="answerD[]" class="answerD" type="text">
<input id="wp_custom_attachmentD" name="wp_custom_attachmentD" size="25" type="file" value="" />
<?php
}


function wporg_save_postdata($post_id){



    if ( ! empty( $_FILES['wp_custom_attachmentA']['name'] ) ) {

        $new = array();
        $ques1 = $_POST['ques1'];
        $answerA = $_POST['answerA'];
        $answerB = $_POST['answerB'];
        $answerC = $_POST['answerC'];
        $answerD = $_POST['answerD'];


		$supported_types = array(
            'image/jpg',
            'image/jpeg',
            'image/png',
        );
		$arr_file_type = wp_check_filetype( basename( $_FILES['wp_custom_attachmentA']['name'] ) );
		$uploaded_type = $arr_file_type['type'];

		if ( in_array( $uploaded_type, $supported_types ) ) {
            $upload1 = wp_upload_bits($_FILES['wp_custom_attachmentA']['name'], null, file_get_contents($_FILES['wp_custom_attachmentA']['tmp_name']));
			$upload2 = wp_upload_bits($_FILES['wp_custom_attachmentB']['name'], null, file_get_contents($_FILES['wp_custom_attachmentB']['tmp_name']));
			$upload3 = wp_upload_bits($_FILES['wp_custom_attachmentC']['name'], null, file_get_contents($_FILES['wp_custom_attachmentC']['tmp_name']));
			$upload4 = wp_upload_bits($_FILES['wp_custom_attachmentD']['name'], null, file_get_contents($_FILES['wp_custom_attachmentD']['tmp_name']));


			if ( isset( $upload['error'] ) && $upload['error'] != 0 ) {
				wp_die( 'There was an error uploading your file. The error is: ' . $upload['error'] );
			} else {

                $new[1]['ques']= $ques1;
                $new[1]['answA']= $answerA;
                $new[1]['answB']= $answerB;
                $new[1]['answC']= $answerC;
                $new[1]['answD']= $answerD;

                $new[1]['img1']= $upload1;
                $new[1]['img2']= $upload2;
                $new[1]['img3']= $upload3;
                $new[1]['img4']= $upload4;


				add_post_meta( $post_id, '_wporg_meta_key', $new[1] );
				update_post_meta( $post_id, '_wporg_meta_key', $new[1] );
			}
		}
		else {
			wp_die( "The file type that you've uploaded is not a PDF." );
		}
	}


    //Here do whathever you want with this $title and $desc.
}

add_action('save_post', 'wporg_save_postdata');