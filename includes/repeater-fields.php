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
 <table>
       <tr>
        <td><label class="ques" for="ques1">Question</label></td>
        <td><input name="ques1[]" class="quesInp" type="text" value="fav southern dish"></td>
        <td><label class="answAlab"for="answerA">A</label></td>
        <td><input class="answerAinp" name="answerA[]" class="answerA" type="text" value="bbq"></td>
        <td><label class="answBlab"for="answerB">B</label></td>
        <td><input class="answerBinp" name="answerB[]" class="answerB" type="text" value="collards"></td>
        <td><label class="answClab"for="answerC">C</label></td>
        <td><input class="answerCinp" name="answerC[]" class="answerC" type="text" value="grits"></td>
        <td><label class="answDlab"for="answerD">D</label></td>
        <td><input class="answerDinp" name="answerD[]" class="answerD" type="text" value="sweet tea"></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2"></td>

        <td colspan="2"><input class="answ1File" id="wp_custom_attachment" name="wp_custom_attachment" size="25" type="file" value="" /></td>
        <td colspan="2"><input class="answ2File" id="wp_custom_attachment" name="wp_custom_attachment" size="25" type="file" value="" /></td>
        <td colspan="2"><input class="answ3File" id="wp_custom_attachment" name="wp_custom_attachment" size="25" type="file" value="" /></td>
        <td colspan="2"><input class="answ4File" id="wp_custom_attachment" name="wp_custom_attachment" size="25" type="file" value="" /></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="10"></td>
        <td>Add question</td>
    </tr>

    </table>
    <table class="mdn-hidden">
       <tr>
        <td><label class="ques" for="ques1">Question</label></td>
        <td><input name="ques1[]" class="quesInp" type="text" value="fav southern dish"></td>
        <td><label class="answAlab"for="answerA">A</label></td>
        <td><input class="answerAinp" name="answerA[]" class="answerA" type="text" value="bbq"></td>
        <td><label class="answBlab"for="answerB">B</label></td>
        <td><input class="answerBinp" name="answerB[]" class="answerB" type="text" value="collards"></td>
        <td><label class="answClab"for="answerC">C</label></td>
        <td><input class="answerCinp" name="answerC[]" class="answerC" type="text" value="grits"></td>
        <td><label class="answDlab"for="answerD">D</label></td>
        <td><input class="answerDinp" name="answerD[]" class="answerD" type="text" value="sweet tea"></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2"></td>

        <td colspan="2"><input class="answ1File" id="wp_custom_attachment" name="wp_custom_attachment" size="25" type="file" value="" /></td>
        <td colspan="2"><input class="answ2File" id="wp_custom_attachment" name="wp_custom_attachment" size="25" type="file" value="" /></td>
        <td colspan="2"><input class="answ3File" id="wp_custom_attachment" name="wp_custom_attachment" size="25" type="file" value="" /></td>
        <td colspan="2"><input class="answ4File" id="wp_custom_attachment" name="wp_custom_attachment" size="25" type="file" value="" /></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="10"></td>
        <td><button>Add Question</button></td>
    </tr>

    </table>
    <!-- Make a hidden copy of the table -->
    <!-- On click, 1) make hidden copy visible -->
    <!-- 2) duplicate the table -->
<?php
}


function wporg_save_postdata($post_id){



    if ( ! empty( $_FILES['wp_custom_attachment']['name'] ) ) {

        $new = array();
        $ques1 = $_POST['ques1'];
        $answerA = $_POST['answerA'];
        $answerB = $_POST['answerB'];
        $answerC = $_POST['answerC'];
        $answerD = $_POST['answerD'];


		$arr_file_type = wp_check_filetype( basename( $_FILES['wp_custom_attachmentA']['name'] ) );
		$uploaded_type = $arr_file_type['type'];


            $upload1 = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
			$upload2 = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
			$upload3 = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
			$upload4 = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));


			if ( isset( $upload['error'] ) && $upload['error'] != 0 ) {
				wp_die( 'There was an error uploading your file. The error is: ' . $upload['error'] );
			} else {

                $new['ques']= $ques1;
                $new['answA']= $answerA;
                $new['answB']= $answerB;
                $new['answC']= $answerC;
                $new['answD']= $answerD;

                $new['img1']= $upload1;
                $new['img2']= $upload2;
                $new['img3']= $upload3;
                $new['img4']= $upload4;


				add_post_meta( $post_id, '_wporg_meta_key', $new );
				update_post_meta( $post_id, '_wporg_meta_key', $new );
			}
		}
	}


    //Here do whathever you want with this $title and $desc.

add_action('save_post', 'wporg_save_postdata');