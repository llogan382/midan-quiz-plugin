<?php


function output_all_postmeta() {

	$postmetas = get_post_meta(get_the_ID(), '_wporg_meta_key');


    foreach($postmetas as $meta ){
        foreach($meta as $x) {
            echo $x['quiz_question'];


          }
    }
 }

output_all_postmeta();