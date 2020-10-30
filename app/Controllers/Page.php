<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Page extends Controller
{

	public function suggestion_menu()
    {
        $tab_id = get_post_meta( get_the_id() , 'tab_filter_id' , true );
        if( !empty( $tab_id ) ) :
        	global $wp;
        	$get_meta = get_post_meta( $tab_id , 'repeatable_fields' , true );
            $current_url = home_url( add_query_arg( array(), $wp->request ) ).'/';

            return array('current_url' => $current_url,'get_meta' => $get_meta);
        endif;	
    }
}
