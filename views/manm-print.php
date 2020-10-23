<?php

function manm_print_function () {
    $postID = isset($_GET['post-id']) ? strval($_GET['post-id']) : null;
    $post_id = $postID;
    $post = get_post($postID);
    if (!is_admin()) :
    ?>
        <div id="header-print" class="row">
                <h2 class="text-center col-10">
                    <?php 
                        if($post_id) {
                            echo $post->post_title;
                        } else {
                            echo "Nombre del proyecto";
                        }
                    ?>
                </h2>
                <div class="col-2">
                    <a href="/" id="manm-btn-exit" class="btn btn-danger text-white pt-2 pb-2">Regresar</a>
                    <button id="manm-btn-print" class="btn btn-primary">Imprimir</button>
                </div>
            </div>
        <div id="manm-admin-print">
    <?php
        if ($postID) {
            echo $post->post_content;
        } else {
            //require_once('manm-default-manual.php');
            wp_redirect( home_url() );
            exit; 
        }
    ?>
        </div>
    <?php
    endif;
}

add_shortcode('manm-print','manm_print_function');