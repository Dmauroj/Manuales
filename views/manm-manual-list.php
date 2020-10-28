<?php 

function manm_manual_list_function () {
    if (!is_admin()){
        $categories = get_categories(array("slug"=>"manual"));
        $args = array(
            'numberposts' => -1,
            'category' => $categories[0]->term_id
        );

        $posts = get_posts($args);
        ?> <div class="container-fluid"> <?php
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
        ?> </div> <?php
    }
}

add_shortcode('manm-manual-list','manm_manual_list_function');