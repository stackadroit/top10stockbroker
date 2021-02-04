<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateShareMarket extends Controller
{
	var $indicesDetails =array();
	// protected function get_api_response_curl($url =''){
	// 	$token =ACCORD_API_TOKEN;
	//     $url =$url."&token=".$token;
	//     if($url){
	//         $ch = curl_init();
	//         curl_setopt($ch, CURLOPT_URL, $url);
	//         curl_setopt($ch, CURLOPT_HEADER, false);
	//         curl_setopt($ch, CURLOPT_NOBODY, false); // remove body
	//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	//         $response = curl_exec($ch);
	//         $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	//         curl_close($ch);
	//         if($httpCode == 200){
	//            $resposeArray =json_decode($response);
	//            $resposeArray->status_code=$httpCode;
	//            return $resposeArray;
	//         }else{
	//             return array();
	//         }
	//     }else{
	//         return array();
	//     }
	// }

	public function indicesFilter(){
		$args = array(
          'post_type' => 'share-market',
          'tax_query' => array(
              array(
                  'taxonomy' => 'sm-category',
                  'field'    => 'slug',
                  'terms'    => 'indices',
              ),
          ),
          'order'=>'DESC',
          'orderby',
          'posts_per_page'=>-1,
        );
        $post_lists= get_posts($args);
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
	public function indicesDetails(){
		$indexCode =(@get_post_meta(get_the_ID(),'indices_code',true))? @get_post_meta(get_the_ID(),'indices_code',true):'123';
	    $apiExchg =($indexCode <100)?'BSE':'NSE';
	    // $url ="https://stock.accordwebservices.com/Stock/GetIndicesBasicData?Exchg=".$apiExchg."&Indexcode=".$indexCode;
	    // $resposeArray =$this->get_api_response_curl($url);  
	    
	    // if(@$resposeArray->status_code == 200){
	    //    $this->indicesDetails= (array) $resposeArray->Table['0'];
	    // }
		// return $this->indicesDetails;
		return [];
	}
	public function indicesCode(){
		$indexCode =(@get_post_meta(get_the_ID(),'indices_code',true))? @get_post_meta(get_the_ID(),'indices_code',true):'123';
	    return $indexCode;
	}
	public function apiExchg(){
		$indexCode =(@get_post_meta(get_the_ID(),'indices_code',true))? @get_post_meta(get_the_ID(),'indices_code',true):'123';
	    $apiExchg =($indexCode <100)?'BSE':'NSE';
	    return $apiExchg;
	}
	
}