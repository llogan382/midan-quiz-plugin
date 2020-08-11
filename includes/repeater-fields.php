<div id="container">




<?php
    // <div class="row">
    // <div class="question">
    //     <label for="question">Question:</label>
    //     <input type="text" placeholder="Title" name="Question"
    //         value="<?php if($field['Question'] != '') echo esc_attr( $field['Question'] );



function save_quiz() {
    $question = $_POST['question'];
    print_r('<script>' .
    $question .
    '</script>');
}

add_action('save_post', 'save_quiz');