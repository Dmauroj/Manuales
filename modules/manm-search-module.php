<?php

function manm_search_module () {
    $search = isset($_GET['search']) ? strval($_GET['search']) : null;
    $is_trash = isset($_GET['is_trash']) ? strval($_GET['is_trash']) : 0;
    $success = '';
    $args = array();

    if ($search) {
        $categories = get_categories(array("slug"=>"manual"));

        if ($is_trash == 1) {
            $args = array(
                'numberposts' => -1,
                'category' => $categories[0]->term_id,
                'post_status' => 'trash',
                's' => $search
            );
            $user = wp_get_current_user();
            $userID = $user->data->ID;
            
            if(strcmp($user->roles,"editor2") == 0 || strcmp($user->roles,"viewer") == 0) {
                $args = array(
                    'numberposts' => -1,
                    'category' => $categories[0]->term_id,
                    'post_status' => 'trash',
                    'post_autor' => $userID,
                    's' => $search
                );
            }
        } else {
            $args = array(
                'numberposts' => -1,
                'category' => $categories[0]->term_id,
                's' => $search
            );
        }
        
        $posts = get_posts($args);
        $out_html = '';
        foreach ($posts as $manual) {
            $url = get_permalink($manual->ID);
            $title = $manual->post_title;
            if ($is_trash == 1) {
                $out_html .= <<<EOT
                    <div class="row">
                        <div class="col-md-8">
                            <h5>$title</h5>
                        </div>
                        <div class="col-md-2 justify-content-end">
                            <a href="#" class="btn btn-success manm-restore" onclick="manm_restore($manual->ID);" id="res-$manual->ID">Restaurar</a>
                        </div>
                        <div class="col-md-2 justify-content-end">
                            <a href="#" class="btn btn-danger manm-delete" onclick="manm_delete(1,$manual->ID)" id="del-$manual->ID">Eliminar</a>
                        </div>
                    </div>
                EOT;
            } else {
                $out_html .= <<<EOT
                    <div class="row">
                        <div class="col-md-8 justify-content-start">
                            <h5>$title</h5>
                        </div>
                        <div class="col-md-4 justify-content-end">
                            <a href="$url" class="btn btn-success">Visualizar</a>
                        </div>
                    </div>
                EOT;
            }
        }
        if (count($posts) == 0) {
            $out_html = "<h4>No se han encontrado resultados</h4>";
        }
        $success = true;
    }

    if ($success) {
        echo $out_html;
    } else {
        echo 402;
    }

    die();
}

add_action('wp_ajax_manm_search_manual', 'manm_search_module');
add_action('wp_ajax_nopriv_manm_search_manual', 'manm_search_module');