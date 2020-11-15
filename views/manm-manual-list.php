<?php 

function manm_manual_list_function () {
    if (!is_admin()){
        $categories = get_categories(array("slug"=>"manual"));
        $args = array(
            'numberposts' => -1,
            'category' => $categories[0]->term_id
        );

        $user = wp_get_current_user();
        $userID = $user->data->ID;

        $posts = get_posts($args);
        ?>  <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Manuales</h1>
                    </div>
        <?php
        //print_r($user);
            if($userID != 0 || (count($user->roles) > 0 && strcmp($user->roles[0],"viewer") != 0)) {
                if(/*strcmp($user->roles[0],"editor2") != 0*/true) {
        ?>
                    <div class="col-md-3">
                        <a href="/manm-admin" class="btn btn-success">Crear manual nuevo</a>
                    </div>
        <?php } ?>
                    <div class="col-md-3">
                        <a href="/trash-list" class="btn btn-danger">Manuales eliminados</a>
                    </div>
        <?php } ?>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <input id="manm-search" placeholder="Buscar manual" type="text">
                        <a href="#" id="manm-btn-search" class="btn btn-success ml-1">Buscar</a>
                    </div>
                    <div class="col-md-5"></div>
                </div>
                <div id="manm-list">
        <?php
        foreach ($posts as $manual) {
            ?>
                <div class="row">
                    <div class="col-md-8 justify-content-start">
                        <h5><?php echo $manual->post_title; ?></h5>
                    </div>
                    <div class="col-md-4 justify-content-end">
                        <a href="<?php echo get_permalink($manual->ID); ?>" class="btn btn-success">Visualizar</a>
                    </div>
                </div>
            <?php
        }
        ?> 
                </div>
            </div> 
        <?php
    }
}

add_shortcode('manm-manual-list','manm_manual_list_function');