<?php
/*--------------------------------------------------------
/*     Action for checking  Broker Comparison Url
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_url',  __NAMESPACE__ . '\\get_url_for_broker_comparison' );
add_action( 'wp_ajax_nopriv_get_url',  __NAMESPACE__ . '\\get_url_for_broker_comparison' );

function get_url_for_broker_comparison() {
	$nonce =  @$_REQUEST['security'];
	if ( ! wp_verify_nonce( $nonce, 'gloabltop10stockbroker' ) ) {
      	die( __( 'Security check', 'top10stockbroker' ) ); 
   	}		
	$paged = $_POST['page_paths'];
	foreach( $paged as $page_path ) {
	    if( ! $page = get_page_by_path( $page_path ,OBJECT, 'broker-comparison')){
	    } else{
	      echo $get_page_url =  get_permalink( $page->ID ) ;
	        wp_die();
	        break;
	    }  
	}
	wp_die();
}