<?php

namespace App;


/**
 * Add favicon to head
 */
add_action('wp_head', function () {
    ?>
    	<link rel="apple-touch-icon" sizes="180x180" href=" <?php asset_path('images/apple-touch-icon.png') ?> " >
    	<link rel="icon" type="image/png" sizes="32x32" href=" <?php asset_path('images/favicon-32x32.png') ?> " >
    	<link rel="icon" type="image/png" sizes="16x16" href=" <?php asset_path('images/favicon-16x16.png') ?> " >
    <?php
});

/**
 * Deragister styles and scripts
 */
add_action( 'wp_enqueue_scripts', function () {
    	
    	//scripts
    	wp_dequeue_script( 'contact-form-7' );

    	//styles
        wp_dequeue_style( 'contact-form-7' );
 });

/**
 * Ajax
 */
add_action( 'wp_ajax_icon_slider_data_ajax_request',  __NAMESPACE__ . '\\icon_slider_data_ajax_request' );
add_action( 'wp_ajax_nopriv_icon_slider_data_ajax_request',  __NAMESPACE__ . '\\icon_slider_data_ajax_request' );
function icon_slider_data_ajax_request() {
    $resonse = [];
    if ( isset($_REQUEST) ):

        $id =  @$_REQUEST['ID'];
        $nonce =  @$_REQUEST['nonce'];

        if ( ! wp_verify_nonce( $nonce, 'gloabltop10stockbroker' ) ) {
            die( __( 'Security check', 'top10stockbroker' ) ); 
        }

        $loopid = 0;
        if( have_rows('quiker_data', $id ) ):
            while( have_rows('quiker_data',$id) ): the_row(); 

                $title = get_sub_field('title');
                $image_upload = get_sub_field('icon');
                $link_url = get_sub_field('link');
                $loopid++;

                $resonse[] = array(
                    'id' => $loopid,
                    'title' => $title, 
                    'image_upload' => $image_upload, 
                    'link_url' => $link_url, 
                );

            endwhile;
        endif;
    endif;
    echo json_encode($resonse);
    die();
}