<?php

function gpm_add_meta_boxes() {
    add_meta_box( 'gpminvoice-group', 'Custom Repeatable', 'Repeatable_meta_box_display', 'mdn_social_quiz', 'normal', 'default');
}

function Repeatable_meta_box_display() {
    global $post;
    $gpminvoice_group = get_post_meta($post->ID, 'mdn_quizzes', true);
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
                <input type="text" placeholder="Title" name="Question_Text[]"
                    value="<?php if($field['Question_Text'] != '') echo esc_attr( $field['Question_Text'] ); ?>" />
            </td>

            <td>
                <input type="text" placeholder="Question 1"
                    value=<?php if ($field['question_answer_option1'] != '') echo esc_attr( $field['question_answer_option1'] ); ?>
                    name="question_answer_option1[]">
            </td>
            <td>
                <input type="text" placeholder="Question 2"
                    value=<?php if ($field['question_answer_option2'] != '') echo esc_attr( $field['question_answer_option2'] ); ?>
                    name="question_answer_option2[]">
            </td>
            <td>
                <input type="text" placeholder="Question 3"
                    value=<?php if ($field['question_answer_option3'] != '') echo esc_attr( $field['question_answer_option3'] ); ?>
                    name="question_answer_option3[]">
            </td>
            <td>
                <input type="text" placeholder="Question 4"
                    value=<?php if ($field['question_answer_option4'] != '') echo esc_attr( $field['question_answer_option4'] ); ?>
                    name="question_answer_option4[]">
            </td>
            <div width="15%"><a class="button remove-row" href="#1">Remove</a></div>
        </tr>


        <?php
    }
    else :
    // show a blank one
    ?>

        <tr>
            <td>
                <input type="text" placeholder="Title" name="Question_Text[]"
                    value="<?php if($field['Question_Text'] != '') echo esc_attr( $field['Question_Text'] ); ?>" />
            </td>
            <td>
                <input type="text" placeholder="Answer 1" name="question_answer_option1[]">
            </td>
            <td>
                <input type="text" placeholder="Answer 2" name="question_answer_option2[]">
            </td>
            <td>
                <input type="text" placeholder="Answer 3" name="question_answer_option3[]">
            </td>
            <td>
                <input type="text" placeholder="Answer 4" name="question_answer_option4[]">
            </td>


            <td><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
        </tr>
        <?php endif; ?>

        <!-- empty hidden one for jQuery -->
        <tr class="empty-row screen-reader-text">

            <td>
                <input type="text" placeholder="Title" name="Question_Text[]"
                    value="<?php if($field['Question_Text'] != '') echo esc_attr( $field['Question_Text'] ); ?>" />
            </td>
            <td>
                <input type="text" placeholder="Answer 1" name="question_answer_option1[]">
            </td>
            <td>
                <input type="text" placeholder="Answer 2" name="question_answer_option2[]">
            </td>
            <td>
                <input type="text" placeholder="Answer 3" name="question_answer_option3[]">
            </td>
            <td>
                <input type="text" placeholder="Answer 4" name="question_answer_option4[]">
            </td>


            <td><a class="button remove-row" href="#">Remove</a></td>
    </tr>
  </tbody>
</table>
<p><a id="add-row" class="button" href="#">Add another</a></p>



            <?php
}

function custom_repeatable_meta_box_save($post_id) {
    if ( ! isset( $_POST['gpm_repeatable_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['gpm_repeatable_meta_box_nonce'], 'gpm_repeatable_meta_box_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'mdn_quizzes', true);
    $new = array();
    $question_text = $_POST['Question_Text'];
    $answer_option1 = $_POST['question_answer_option1'];
    $answer_option2 = $_POST['question_answer_option2'];
    $answer_option3 = $_POST['question_answer_option3'];
    $answer_option4 = $_POST['question_answer_option4'];

     $count = count( $question_text );
     for ( $i = 0; $i < $count; $i++ ) {
        if ( $question_text[$i] != '' ) :
            $new[$i]['Question_Text'] = stripslashes( strip_tags( $question_text[$i] ) );
             $new[$i]['question_answer_option1'] = stripslashes( $answer_option1[$i] ); // and however you want to sanitize
             $new[$i]['question_answer_option2'] = stripslashes( $answer_option2[$i] ); // and however you want to sanitize
             $new[$i]['question_answer_option3'] = stripslashes( $answer_option3[$i] ); // and however you want to sanitize
             $new[$i]['question_answer_option4'] = stripslashes( $answer_option4[$i] ); // and however you want to sanitize

        endif;
    }
    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'mdn_quizzes', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'mdn_quizzes', $old );


}