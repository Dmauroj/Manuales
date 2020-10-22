<?php

function manm_admin_function () {
    $postID = isset($_GET['post-id']) ? strval($_GET['post-id']) : null;
    $duplicate = isset($_GET['duplicate']) ? strval($_GET['duplicate']) : "0";
    $post_id = $postID;
    $post = get_post($postID);
    $user = wp_get_current_user();
    $userID = $user->data->ID;

    if ($post->post_author != $userID) {
        $postID = '';
    }
    
    if (!is_admin()) :
?>
    <form id="manm-update" method="post">
        <div class="manm container-fluid">
            <div id="manm-alert" class="d-none" role="alert"></div>
            <div class="dfree-header mce-content-change row">
                <h2 id="manm-title" class="text-center col-10">
                    <?php 
                        if($post_id) {
                            echo $post->post_title;
                        } else {
                            echo "Nombre del proyecto";
                        }
                    ?>
                </h2>
                <div class="col-2">
                    <a href="/" id="manm-btn-exit" class="btn btn-danger text-white pt-2 pb-2">Cancelar</a>
                    <button id="manm-btn-submit" class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </div>
            <div id="manm-admin">
                <input type="hidden" id="manm-duplicate-post" name="manm-duplicate-post" value="<?php echo $duplicate; ?>">
                <input type="hidden" id="manm-id-post" name="manm-id-post" value="<?php echo $postID; ?>">
                <input type="hidden" id="manm-id-autor" name="manm-id-autor" value="<?php echo $userID; ?>">
                <input type="hidden" id="manm-id-role" name="manm-id-role" value="<?php echo $user->roles[0]; ?>">
                <div id="manm-init">
                    <?php 
                        if ($post_id) {
                            //print_r($post);
                            echo $post->post_content;
                        } else {
                            require_once('manm-default-manual.php');
                        }
                    ?>
                </div>
            </div>
        </div>
    </form>
<?php endif;
}

add_shortcode('manm-admin','manm_admin_function');