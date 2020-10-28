<?php 

function manm_upload_image () {
    $fileImg = isset($_POST['file']) ? $_POST['file'] : null;
    //print_r($file);
    $success = null;
    //print_r($fileImg['base64']);
    if($fileImg) {
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $fileImg['base64']));
        $upload_dir = wp_upload_dir();
        //print_r($image);
        // @new
        $upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;

        $decoded = $image;
        $filename = $fileImg['filename'];

        $hashed_filename = md5( $filename . microtime() ) . '_' . $filename;

        // @new
        $image_upload = file_put_contents( $upload_path . $hashed_filename, $decoded );

        //HANDLE UPLOADED FILE
        if( !function_exists( 'wp_handle_sideload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }

        // Without that I'm getting a debug error!?
        if( !function_exists( 'wp_get_current_user' ) ) {
        require_once( ABSPATH . 'wp-includes/pluggable.php' );
        }

        // @new
        $file             = array();
        $file['error']    = '';
        $file['tmp_name'] = $upload_path . $hashed_filename;
        $file['name']     = $hashed_filename;
        $file['type']     = 'image/png';
        $file['size']     = filesize( $upload_path . $hashed_filename );

        // upload file to server
        // @new use $file instead of $image_upload
        $file_return = wp_handle_sideload( $file, array( 'test_form' => false ) );

        $filename = $file_return['file'];
        $attachment = array(
        'post_mime_type' => $file_return['type'],
        'post_title' => $filename,
        'post_content' => '',
        'post_status' => 'inherit',
        'guid' => $wp_upload_dir['url'] . '/' . $filename
        );
        $attach_id = wp_insert_attachment( $attachment, $filename );
        $success = true;
    }
    
    if ($success) {
        echo wp_get_attachment_url($attach_id);
    } else {
        echo 402;
    }

    die();
}

add_action('wp_ajax_manm_upload_image', 'manm_upload_image');
add_action('wp_ajax_nopriv_manm_upload_image', 'manm_upload_image');