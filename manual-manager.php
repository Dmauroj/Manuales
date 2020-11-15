<?php
/*
Plugin Name: Manual Manager
Plugin URI: https://daxosline.com
Description: Este plugin crea distintos tipos de manuales a partir de uno manual base, con gestion de usuarios y listas de manuales.
Version: 0.9
Author: Daxos
Author URI: https://daxosline.com
*/

if (!defined('ABSPATH')) {
    exit;
}

!defined('MANM_PATH') && define('MANM_PATH', plugin_dir_path(__FILE__));
!defined('MANM_URL') && define('MANM_URL', plugin_dir_url(__FILE__));

require_once('assets/register-assets-function.php');


function manm_template($template) {
    if (is_page('manm-admin')) {
        include (MANM_PATH.'/templates/manm-template.php');
        exit;
    } else if (is_page('manm-print')) {
        include (MANM_PATH.'/templates/manm-print.php');
        exit;
    } else {
        return $template;
    }
}

add_filter('template_include', 'manm_template');

require_once('tools/generate-pages.php');
require_once('views/manm-admin.php');
require_once('views/manm-print.php');
require_once('modules/manm-save-module.php');
require_once('modules/manm-delete-module.php');
require_once('tools/generate-button-edit.php');
require_once('views/manm-manual-list.php');
require_once('views/manm-manual-trash.php');
require_once('tools/manm-upload-images.php');
require_once('modules/manm-search-module.php');