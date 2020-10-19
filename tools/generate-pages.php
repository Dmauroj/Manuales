<?php
global $wpdb;   

$pages = array(
    array('title' => 'Manm Admin',
    'content' => '[manm-admin]')
);

foreach ($pages as $page) {
    $query = $wpdb->prepare(
        'SELECT ID FROM ' . $wpdb->posts . '
            WHERE post_title = %s
            AND post_type = \'page\'',
        $page['title']
    );
    $wpdb->query( $query );

    if ( $wpdb->num_rows ) {
        // Title already exists
    } else {
        $new_page_data = array(
            'post_title' => $page['title'],
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_content' => $page['content']
        );

        // Add page
        $insert_id = wp_insert_post( $new_page_data );
    }
}

