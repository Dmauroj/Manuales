<?php

function manm_modal_title_post () {
    global $post;

    echo <<<EOT
        <div class="modal fade" id="manm-modal-delete" tabindex="-1" aria-labelledby="manm-modal-deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manm-modal-deleteLabel">Eliminar Manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar el manual $post->post_title</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary text-white" data-dismiss="modal">Regresar</a>
                <button type="button" id="manm-delete-trash" data-dismiss="modal" class="btn btn-danger">Eliminar</button>
            </div>
            </div>
        </div>
        </div>
    EOT;

}

function manm_custom_title_post ($title) {
    global $post;
    $title = $post->post_title;
    $user = wp_get_current_user();
    $out_html = '';

    if (!is_admin()){
        add_action( 'wp_footer', 'manm_modal_title_post');
        if (strcmp($post->post_type, "post") == 0) {
            $out_html = <<<EOT
                <div id="manm-alert" class="d-none" role="alert"></div>
                <input id="manm-post-id" type="hidden" value="$post->ID">
            EOT;
            
            switch ($user->roles[0]) {
                case 'editor1':
                    $out_html .= <<<EOT
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1>$title</h1>
                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row">
                                <div class="col-md-4 d-flex justify-content-center">
                                    <button class="btn btn-primary" id="manm-duplicate">Crear uno igual</button>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center">
                                    <button class="btn btn-primary" id="manm-edit">Editar manual</button>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center">
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#manm-modal-delete">Eliminar manual</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 d-flex"></div>
                                <div class="col-md-3 d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="/">Regresar</a>
                                </div>
                                <div class="col-md-3 d-flex justify-content-center">
                                    <button class="btn btn-success" id="manm-view">Pantalla completa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    EOT;
                    break;
                case 'editor2':
                    $out_html .= <<<EOT
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1>$title</h1>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <div class="row">
                                    <div class="col-md-4 d-flex justify-content-center">
                                        <button class="btn btn-primary" id="manm-duplicate">Crear uno igual</button>
                                    </div>
                        EOT;
                    if ($post->post_author == $user->data->ID) {
                        $out_html .= <<<EOT
                                <div class="col-md-4 d-flex justify-content-center">
                                    <button class="btn btn-primary" id="manm-edit">Editar manual</button>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center">
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#manm-modal-delete">Eliminar manual</button>
                                </div>
                            EOT;
                    }
    
                    $out_html .= <<<EOT
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 d-flex"></div>
                                    <div class="col-md-3 d-flex justify-content-center">
                                        <a class="btn btn-secondary" href="/">Regresar</a>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-center">
                                        <button class="btn btn-success" id="manm-view">Pantalla completa</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    EOT;
                    break;
                case 'administrator':
                    $out_html .= <<<EOT
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1>$title</h1>
                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row">
                                <div class="col-md-4 d-flex justify-content-center">
                                    <button class="btn btn-primary" id="manm-duplicate">Crear uno igual</button>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center">
                                    <button class="btn btn-primary" id="manm-edit">Editar manual</button>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center">
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#manm-modal-delete">Eliminar manual</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 d-flex"></div>
                                <div class="col-md-3 d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="/">Regresar</a>
                                </div>
                                <div class="col-md-3 d-flex justify-content-center">
                                    <button class="btn btn-success" id="manm-view">Pantalla completa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    EOT;
                    break;
                default:
                    $out_html .= <<<EOT
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1>$title</h1>
                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row">
                                <div class="col-md-6 d-flex"></div>
                                <div class="col-md-3 d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="/">Regresar</a>
                                </div>
                                <div class="col-md-3 d-flex justify-content-center">
                                    <button class="btn btn-success" id="manm-view">Pantalla completa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    EOT;
                    break;
            }
        } else {
            $out_html = $title;
        }
        return $out_html;
    }

    return $title;
    
}

add_filter('the_title','manm_custom_title_post');