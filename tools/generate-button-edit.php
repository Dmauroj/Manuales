<?php

function manm_custom_title_post ($title) {
    global $post;
    $title = $post->post_title;
    $user = wp_get_current_user();
    $out_html = '';

    if (!is_admin()){
        if (strcmp($post->post_type, "post") == 0) {
            $out_html = <<<EOT
                <div id="manm-alert" class="d-none" role="alert"></div>
                <input id="manm-post-id" type="hidden" value="$post->ID">
            EOT;
            
            switch ($user->roles[0]) {
                case 'editor1':
                    $out_html .= <<<_HTML
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1>$title</h1>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <div class="row">
                                    <div class="col-md-4 d-flex justify-content-center">
                                        <button class="btn btn-primary" id="manm-duplicate">Crear uno igual</button>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center">
                                        <button class="btn btn-primary" id="manm-edit">Editar manual</button>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-center">
                                        <button class="btn btn-danger" id="manm-delete">Eliminar manual</button>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <button class="btn btn-success" id="manm-view">Pantalla completa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    _HTML;
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
                                    <button class="btn btn-danger" id="manm-delete">Eliminar manual</button>
                                </div>
                            EOT;
                    }
    
                    $out_html .= <<<EOT
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
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
                                    <button class="btn btn-danger" id="manm-delete">Eliminar manual</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-success" id="manm-view">Pantalla completa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    EOT;
                    break;
                default:
                    $out_html = $title;
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