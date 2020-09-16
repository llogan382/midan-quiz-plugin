<?php

class AdminSaveMeta {
    public function hook_into_wordpress() {
        add_action( 'save_post', [$this, 'wporg_save_postdata'] );
    }



    public function wporg_save_postdata($post_id){

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