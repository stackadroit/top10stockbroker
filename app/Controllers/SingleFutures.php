<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleFutures extends Controller
{
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
		$instName =($instName)?$instName:'FUTSTK';
	    return $instName;
	}
	public function symbol(){
		$symbol = get_post_meta(get_the_ID(),'symbol',true);
		$symbol =($symbol)?$symbol:'TCS';
		return $symbol;
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
	public function futureSymbles(){
		return $this->getSymble('futures');
	}
	public function getSymble($instName ='option-chain'){
	    $args = array(
	      'post_type' => $instName,
	      'order'=>'ASC',
	      'orderby'=>'post_title',
	      'posts_per_page'=>-1,
	    );
	    $post_lists= get_posts($args);
	    // print_r($post_lists);
	    return $post_lists;
	}
	public function getDetailPage(){
		global $post;
	   	$detailPage =array(
	      'most-active-stock-futures',
	      'open-interest-stock-futures',
	    );
	    if(in_array($post->post_name, $detailPage)){
	    	$loadDetailsPageData =array();
	        switch ($post->post_name) {
	          case 'most-active-stock-futures':
	            $InstName ='FUTSTK';
	            $loadDetailsPageData['page']='active-stock';
	            $loadDetailsPageData['InstName']=$InstName;

 				$loadDetailsPageData['main_section_title']= get_post_meta(get_the_ID(),'main_title_h1',true);
 				$loadDetailsPageData['main_section_content']= get_post_meta(get_the_ID(),'main_paragraph_content',true);
 				$loadDetailsPageData['section_title']= get_post_meta(get_the_ID(),'main_title_h1',true);
 				$loadDetailsPageData['section_content']= get_post_meta(get_the_ID(),'main_paragraph_content',true);
  				 
	            break;
	          case 'open-interest-stock-futures':
	          	$loadDetailsPageData['page']='interest-stock';
	            $main_h1_title= get_post_meta(get_the_ID(),'main_title_h1',true);
			 	$main_para_content= get_post_meta(get_the_ID(),'main_paragraph_content',true);
			 	$loadDetailsPageData['main_h1_title']=$main_h1_title;
			 	$loadDetailsPageData['main_para_content']=$main_para_content;
			 	$loadDetailsPageData['section_title']= get_post_meta(get_the_ID(),'main_title_h1',true);
 				$loadDetailsPageData['section_content']= get_post_meta(get_the_ID(),'main_paragraph_content',true);
	            break; 
	          }
	        return $loadDetailsPageData;
	    }else{
	    	return false;
		}

	} 
}