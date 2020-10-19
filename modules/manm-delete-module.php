<?php

function manm_delete_module () {
    $idPost = isset($_POST['post_id']) ? strval($_POST['post_id']) : null;
    $success = null;
    
    if($idPost) {
        $success = wp_delete_post($idPost,true);
    }
    
    if ($success) {
        echo 200;
    } else {
        echo 402;
    }

    die();
}

add_action('wp_ajax_manm_delete_module', 'manm_delete_module');
add_action('wp_ajax_nopriv_manm_delete_module', 'manm_delete_module');