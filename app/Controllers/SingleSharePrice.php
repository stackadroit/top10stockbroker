<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleSharePrice extends Controller
{
	// var $cDetailsresponse =array();
	var $cpnListed_db ='';
	var $sector ='';
	var $apiExchg ='';
	public function topData() {
		$main_h1_title= get_post_meta(get_the_ID(),'co_main_title_h1',true);
	    $main_para_content= get_post_meta(get_the_ID(),'co_main_paragraph_content',true);
	    $main_h2_title= get_post_meta(get_the_ID(),'co_main_title_h2',true);
	    $main_para2_content= get_post_meta(get_the_ID(),'co_main_paragraph_2_content',true);
        $topData =array(
        	'main_h1_title'=>$main_h1_title,
        	'main_para_content'=>$main_para_content,
        	'main_h2_title'=>$main_h2_title,
        	'main_para2_content'=>$main_para2_content,
        ); 
        return $topData;
    }
	public function finCode(){
		$finCode = get_post_meta(get_the_ID(),'co_fincode',true);
		$finCode =($finCode)?$finCode:'132215';
	    return $finCode;
	}
	public function cpnlistedDb(){
		 return 3;
	}
	public function sector(){
		 return 'Bank';
	}
	public function apiExchg(){
		return 'NSE';
	}
	 
}