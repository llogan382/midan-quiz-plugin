<?php
abstract class LWDQuiz
{
    public static function add()
    {
            add_meta_box(
                'wporg_box_id',          // Unique ID
                'Custom Meta Box Title', // Box title
                [self::class, 'html'],   // Content callback, must be of type callable
                'mdn_social_quiz'                  // Post type
            );
        }



        public static function save($post_id){

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




    public static function html($post){

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
    <script>
function myFunction() {
    var lastTable = document.querySelector('.mdn-hidden-input:last-of-type');
    var clonedTable = document.querySelector('table:last-of-type');
    var clone = clonedTable.cloneNode(true);
    clonedTable.after(clone);
    lastTable.classList.toggle("hidden-table");

}
        </script>

    <button onclick="myFunction()">Add Question</button>
    <!-- Make a hidden copy of the table -->
    <!-- On click, 1) make hidden copy visible -->
    <!-- 2) duplicate the table -->
    <?php
    }

}


add_action('add_meta_boxes', ['LWDQuiz', 'add']);

function wpb_hook_button() {
    ?>

    <?php
}
add_action('wp_head', 'wpb_hook_button');
