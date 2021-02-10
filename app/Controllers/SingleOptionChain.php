<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleOptionChain extends Controller
{
	var $cDetailsresponse =array();
	var $expDate ='';
	var $expiryDate ='';
	var $expDateDsp ='';
	var $symbol ='';
	var $optType ='';
	var $stkPrice ='';
	var $strikePrice ='';
	var $stcMid ='';
	public function get_symble_list_and_id($instName ='option-chain'){
	    $args = array(
	      'post_type' => $instName,
	      'order'=>'ASC',
	      'orderby'=>'post_title',
	      'posts_per_page'=>-1,
	    );
	    $post_lists= get_posts($args);
	    $responseData=array();
	    foreach ($post_lists as $key => $value) {
	        $symbol =get_post_meta($value->ID,'symbol',true);
	        $responseData[$symbol] =$value->ID;
	    }
	    return $responseData;
	}
	public function get_symble_list($instName ='option-chain'){
		global $wpdb;
	    $args = array(
	      'post_type' => $instName,
	      'order'=>'ASC',
	      'orderby'=>'post_title',
	      'posts_per_page'=>-1,
	    );
	    $post_lists= get_posts($args);
	    // print_r($wpdb->last_query);
	    return $post_lists;
	}
	public function topData() {
		$main_h1_title= get_post_meta(get_the_ID(),'main_title_h1',true);
		$main_para_content= get_post_meta(get_the_ID(),'main_paragraph_content',true);
		$main_h2_title= get_post_meta(get_the_ID(),'main_title_h2',true);
		$main_para2_content= get_post_meta(get_the_ID(),'main_paragraph_2_content',true);
        $topData =array(
        	'main_h1_title'=>$main_h1_title,
        	'main_para_content'=>$main_para_content,
        	'main_h2_title'=>$main_h2_title,
        	'main_para2_content'=>$main_para2_content,
        ); 
        return $topData;
    }
    public function instName(){
		$instName = get_post_meta(get_the_ID(),'instrument_name',true);
		$instName =($instName)?$instName:'OPTSTK';
	    return $instName;
	}
	public function symbol(){
		$symbol = get_post_meta(get_the_ID(),'symbol',true);
		$symbol =($symbol)?$symbol:'TCS';
		return @$symbol;
	}
	public function optionType(){
		$optionType =array('PE'=>'PE','CE'=>'CE');
		return @$optionType;
	}
	public function getSymbleList(){
		$get_symble_list =$this->get_symble_list('option-chain');
		return @$get_symble_list;
	}
	 
	public function currentUrl(){
		global $wp;
		$current_url = home_url( add_query_arg( array(), $wp->request ) ) .'/';
		return @$current_url;
	}
	public function topLinks(){
		$tab_id =  get_post_meta( get_the_id() , 'tab_filter_id' , true );
		$tab_id=53404;
		if(!empty($tab_id)):
			$get_meta = get_post_meta( $tab_id , 'repeatable_fields' , true );
            return $get_meta;
		else:
			return array();
		endif;
		 
	}
 
	public function getDetailPage(){
		global $post;
	   	$detailPage =array(
		  'put-call-ratio',
		  'most-active-stock-option',
		  'most-active-index-option',
		  'open-interest-stock-option',
		  'open-interest-index-option',
		);
	    if(in_array($post->post_name, $detailPage)){

	    	$loadDetailsPageData =array();
	        switch ($post->post_name) {
	        	case 'put-call-ratio':
		          	$page ='put-call-ratio';
		            break;
		        case 'most-active-stock-option':
		          	$InstName ='OPTSTK';
		          	$page ='most-active-stock-option';
		            break;
	          	case 'most-active-index-option':
		          	$page ='most-active-index-option';
		          	$InstName ='OPTIDX';
		            break;
		        case 'open-interest-stock-option':
		          	$InstName ='OPTSTK';
		          	$page ='open-interest-stock-option';
		            break;
	          	case 'open-interest-index-option':
		          	$page ='open-interest-index-option';
		          	$InstName ='OPTIDX';
		            break;
	            
	          }
	          $loadDetailsPageData['pageID']=get_the_ID();
	          $loadDetailsPageData['page']=$page;
		      $loadDetailsPageData['InstName']=$InstName;
		      $loadDetailsPageData['PageSize']=20;
			$main_h1_title= get_post_meta(get_the_ID(),'main_title_h1',true);
			$main_para_content= get_post_meta(get_the_ID(),'main_paragraph_content',true);
			$loadDetailsPageData['main_h1_title']=$main_h1_title;
			$loadDetailsPageData['main_para_content']=$main_para_content;
	        return $loadDetailsPageData;
	    }else{
	    	return false;
		}

	} 
}