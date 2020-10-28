<?php

function manm_delete_module () {
    $idPost = isset($_POST['post_id']) ? strval($_POST['post_id']) : null;
    $forceDelete = isset($_POST['force_delete']) ? strval($_POST['force_delete']) : 0;
    $success = null;
    
    if($idPost) {
        if($forceDelete == 0) {
            $success = wp_trash_post($idPost);
        } else {
            $success = wp_delete_post($idPost,true);
        }
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


function manm_untrash_module () {
    $idPost = isset($_POST['post_id']) ? strval($_POST['post_id']) : null;
    $success = null;
    
    if($idPost) {
        $success = wp_untrash_post($idPost);
    }
    
    if ($success) {
        echo 200;
    } else {
        echo 402;
    }

    die();
}

add_action('wp_ajax_manm_untrash_module', 'manm_untrash_module');
add_action('wp_ajax_nopriv_manm_untrash_module', 'manm_untrash_module');