<?php

function showAdminMeta($post){
        $value = get_post_meta($post, '_wporg_meta_key', true);
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
}




    ?>