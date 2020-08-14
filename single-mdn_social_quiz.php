<?php


function output_all_postmeta() {

	$postmetas = get_post_meta(get_the_ID(), '_wporg_meta_key');


    foreach($postmetas as $meta){
        // foreach($meta as $x => $val) {
            echo $meta['ques'][0] . "</br>";
            echo $meta['answA'][0] . "</br>";
            echo "<img src=" . $meta['img1']['url'] . "></br>";
            echo $meta['answB'][0] . "</br>";
            echo "<img src=" . $meta['img2']['url'] . "></br>";
            echo $meta['answC'][0] . "</br>";
            echo "<img src=" . $meta['img3']['url'] . "></br>";
            echo $meta['answD'][0] . "</br>";
            echo "<img src=" . $meta['img4']['url'] . "></br>";


        //   }
    }
 }

output_all_postmeta();