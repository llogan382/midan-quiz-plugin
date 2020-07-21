<?php

echo "<h2>This is the single quiz page</h2>";

$meta_values = get_post_meta( get_the_ID(), 'mdn_quizzes' )[0];

foreach($meta_values as $meta_value){
    echo 'This is the value ' . $meta_value['TitleItem'] . '</br>';
    echo 'This is the value ' . $meta_value['TitleDescription'] . '</br></br>';

};


