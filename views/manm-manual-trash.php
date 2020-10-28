<?php

function manm_trash_list_function () {
    if (!is_admin()){
        $categories = get_categories(array("slug"=>"manual"));
        $args = array(
            'numberposts' => -1,
            'category' => $categories[0]->term_id,
            'post_status' => 'trash'
        );
        $user = wp_get_current_user();
        $userID = $user->data->ID;
        
        if(strcmp($user->roles,"editor2") == 0) {
            $args = array(
                'numberposts' => -1,
                'category' => $categories[0]->term_id,
                'post_status' => 'trash',
                'post_autor' => $userID
            );
        }

        $posts = get_posts($args);
        ?> <div class="container"> 
                <div id="manm-alert" class="d-none" role="alert"></div>
        <?php

        foreach ($posts as $manual) {
            ?>
                <div class="row">
                    <div class="col-md-8">
                        <h5><?php echo $manual->post_title; ?></h5>
                    </div>
                    <div class="col-md-2 justify-content-end">
                        <a href="#" class="btn btn-success manm-restore" id="res-<?php echo $manual->ID; ?>">Restaurar</a>
                    </div>
                    <div class="col-md-2 justify-content-end">
                        <a href="#" class="btn btn-danger manm-delete" id="del-<?php echo $manual->ID; ?>">Eliminar</a>
                    </div>
                </div>
            <?php
        }
        ?> </div> <?php
    }
}

add_shortcode('manm-trash-list','manm_trash_list_function');