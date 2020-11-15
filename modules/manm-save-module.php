<?php

function manm_save_module () {
    $manual = isset($_POST['manual']) ? strval($_POST['manual']) : null;
    $post_title = isset($_POST['title']) ? strval($_POST['title']) : null;
    $idPost = isset($_POST['id_post']) ? strval($_POST['id_post']) : null;
    $authorID = isset($_POST['id_user']) ? strval($_POST['id_user']) : null;
    $duplicate = isset($_POST['duplicate']) ? strval($_POST['duplicate']) : null;
    $categories = get_categories(array("slug"=>"manual"));
    $success = '';

    if ($manual) {
        if (!$duplicate && $idPost) {
            $args = array(
                'ID' => $idPost,
                'post_content'   => $manual,
                'post_status'    => 'publish',
                'post_title'     => $post_title,
                'post_type'      => 'post'
            );
            $success = wp_update_post($args);
        } else {
            $args = array(
                'post_content'   => $manual,
                'post_status'    => 'publish',
                'post_title'     => $post_title,
                'author'         => $authorID,
                'post_type'      => 'post'
            );
            $success = wp_insert_post($args);
        }
        
        wp_set_post_categories($success,$categories[0]->term_id);

        if ($success) {
            echo $success;
        } else {
            echo 402;
        }
    }

    die();
}

add_action('wp_ajax_manm_save_manual', 'manm_save_module');
add_action('wp_ajax_nopriv_manm_save_manual', 'manm_save_module');