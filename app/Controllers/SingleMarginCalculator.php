<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleMarginCalculator extends Controller
{

    public function choose_broker() {
    	global $wpdb;
    	$choose_broker = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title,post_name FROM {$wpdb->posts} WHERE post_type = %s and post_status = 'publish' order by post_title ASC", 'margin-calculator' ), ARRAY_A );
       	$choose_broker =  ($choose_broker)?$choose_broker:array();
    	return array('post_id' => get_the_id(),'cb_posts' => $choose_broker);
    }

    public function intraday_search_scrip() {
    	global $wpdb;
    	$get_fields_meta = $wpdb->get_results( "SELECT * FROM testmeta where `prefix` = 'in' " );
    	$search_scrip = array();
    	foreach ($get_fields_meta  as $gmeta) {
    	   $search_scrip[] =array('text' => $gmeta->name,'value' =>$gmeta->name ) ;
    	}
    	return $search_scrip;
    }	

    public function delivery_search_scrip() {
    	global $wpdb;
    	$get_fields_meta = $wpdb->get_results( "SELECT * FROM testmeta where `prefix` = 'de' " ); 
    	$search_scrip = array();
    	foreach ($get_fields_meta  as $gmeta) {
    	   $search_scrip[] =array('text' => $gmeta->name,'value' =>$gmeta->name ) ;
    	}
    	return $search_scrip;
    } 

    public function commodity_search_scrip() {
    	global $wpdb;
    	$get_fields_meta = $wpdb->get_results( "SELECT * FROM testmeta where `prefix` = 'co' " ); 
    	$search_scrip = array();
    	foreach ($get_fields_meta  as $gmeta) {
    	   $search_scrip[] =array('text' => $gmeta->name,'value' =>$gmeta->name ) ;
    	}
    	return $search_scrip;
    } 
    
    public function currency_search_scrip() {
    	global $wpdb;
    	$get_fields_meta = $wpdb->get_results( "SELECT * FROM testmeta where `prefix` = 'cu' " ); 
    	$search_scrip = array();
    	foreach ($get_fields_meta  as $gmeta) {
    	   $search_scrip[] =array('text' => $gmeta->name,'value' =>$gmeta->name ) ;
    	}
    	return $search_scrip;
    } 
}