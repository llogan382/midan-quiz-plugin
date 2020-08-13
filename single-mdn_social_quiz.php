<?php


function output_all_postmeta() {

	$postmetas = get_post_meta(get_the_ID());

    $just_answers = $postmetas['_wporg_meta_key'][0];
    for

}
output_all_postmeta();