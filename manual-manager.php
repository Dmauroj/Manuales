<?php
/*
Plugin Name: Manual Manager
Plugin URI: https://daxosline.com
Description: 
Version: 0.1
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
    } else {
        return $template;
    }
}

add_filter('template_include', 'manm_template');

require_once('tools/generate-pages.php');
require_once('views/manm-admin.php');
require_once('modules/manm-save-module.php');
require_once('modules/manm-delete-module.php');
require_once('tools/generate-button-edit.php');