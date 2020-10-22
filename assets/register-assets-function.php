<?php
//--Import CSS

function manm_bootstrap_enqueue_styles() {
    wp_register_style('manm-bootstrap-styles', plugins_url('/css/manm-bootstrap.min.css', __FILE__), '4.5.2', true);
    wp_enqueue_style( 'manm-bootstrap-styles');
}
add_action( 'wp_enqueue_scripts', 'manm_bootstrap_enqueue_styles');

function manm_styles_enqueue_styles() {
    wp_register_style('manm-template-styles', plugins_url('/css/manm-template.css', __FILE__), '1', true);
    wp_enqueue_style( 'manm-template-styles');
    wp_register_style('manm-admin-styles', plugins_url('/css/manm-admin-style.css', __FILE__), '1', true);
    wp_enqueue_style( 'manm-admin-styles');
    wp_register_style('manm-default-styles', plugins_url('/css/manm-default-styles.css', __FILE__), '1', true);
    wp_enqueue_style( 'manm-default-styles');
}
add_action( 'wp_enqueue_scripts', 'manm_styles_enqueue_styles',10);


//--Import JS

function manm_bootstrap_js_insert_enqueue(){
    wp_register_script('manm-bootstrap-script', plugins_url('/js/manm-bootstrap.min.js', __FILE__), array('jquery'), '4.5.2', true);
    wp_enqueue_script( 'manm-bootstrap-script');
    wp_register_script('manm-popper-script', plugins_url('/js/manm-popper.min.js', __FILE__), array('jquery'), '1.16.1', true);
    wp_enqueue_script( 'manm-popper-script');
}

add_action('wp_enqueue_scripts','manm_bootstrap_js_insert_enqueue');


function manm_form_controller() {
    wp_register_script('manm-form-controller', plugins_url('/js/controller/manm-forms-controller.js', __FILE__), array(), '2', true);
    wp_enqueue_script( 'manm-form-controller');

    wp_localize_script('manm-form-controller','manm_ajax', ['ajaxurl'=>admin_url('admin-ajax.php')]);
}

add_action('wp_enqueue_scripts','manm_form_controller');