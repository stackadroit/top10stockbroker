<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleBrokerageCalculator extends Controller
{

	public function suggestion_menu() {
        $tab_id = get_post_meta( get_the_id() , 'tab_filter_id' , true );
        if( !empty( $tab_id ) ) :
        	global $wp;
        	$get_meta = get_post_meta( $tab_id , 'repeatable_fields' , true );
            $current_url = home_url( add_query_arg( array(), $wp->request ) ).'/';
            return array('current_url' => $current_url,'get_meta' => $get_meta);
        else:
        	return array();
        endif;	
    }

    public function choose_broker() {
    	global $wpdb;
    	$choose_broker = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title,post_name FROM {$wpdb->posts} WHERE post_type = %s and post_status = 'publish' order by post_title ASC", 'brokerage-calculator' ), ARRAY_A );
       	$choose_broker =  ($choose_broker)?$choose_broker:array();
    	return array('post_id' => get_the_id(),'cb_posts' => $choose_broker);
    }

    public function state_name(){
        global $wpdb;
        $state_array=array();
        $rp_query = get_posts( array('posts_per_page' => -1, 'post_type' => 'state', 'orderby'=>'title','order'=> 'ASC') );
        if ($rp_query) {
            foreach ($rp_query as $key => $pd) {
                $stamp_fee_id= get_post_meta($pd->ID, 'stamp_fee_id', true );
                $state_name     = get_the_title($pd);
                $state_array[$state_name]=$stamp_fee_id;
            }
               
        }else{
            $state_array=array();    
        }  
        return $state_array;   
    }
}