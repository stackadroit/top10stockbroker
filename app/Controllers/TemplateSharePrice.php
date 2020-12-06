<?php
namespace App\Controllers;
use Sober\Controller\Controller;
class TemplateSharePrice extends Controller
{
	var $cDetailsresponse =array();
	var $cpnListed_db ='';
	var $sector ='';
	var $apiExchg ='';
	protected function get_api_response_curl($url =''){
		$token =ACCORD_API_TOKEN;
	    $url =$url."&token=".$token;
	    if($url){
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_HEADER, false);
	        curl_setopt($ch, CURLOPT_NOBODY, false); // remove body
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	        $response = curl_exec($ch);
	        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	        curl_close($ch);
	        if($httpCode == 200){
	           $resposeArray =json_decode($response);
	           $resposeArray->status_code=$httpCode;
	           return $resposeArray;
	        }else{
	            return array();
	        }
	    }else{
	        return array();
	    }
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
	
	public function companyDetails(){
		$apiExchg ='NSE';
		$finCode =(@$_REQUEST['finCode'])?@$_REQUEST['finCode']:'100180'; 
		$apiSYMBOL ='AXISBANK';
		$cDetailsresponse =array();
 		$url ="https://company.accordwebservices.com/Company/GetQuoteDetails?FinCode=".$finCode;
		$resposeArray =$this->get_api_response_curl($url);
		$this->cpnListed_db ='1'; 
		if(@$resposeArray->status_code == 200){
		  $this->cDetailsresponse= (array) @$resposeArray->Table[1];
		  $this->cpnListed_db =2;
		  if(empty($this->cDetailsresponse)){
		        $this->cDetailsresponse= (array) @$resposeArray->Table[0];
		        $this->cpnListed_db =1;
		  }
		  if(isset($resposeArray->Table[1]) && isset($resposeArray->Table[0])){
		    $this->cpnListed_db =3;
		  }
		} 
		$this->sector ='Bank';
		if(@$this->cDetailsresponse['Sector'] !=='Bank'){
		  $this->sector ='NonBank';
		}
		$this->apiExchg =$apiExchg;
		return $this->cDetailsresponse;
	}
	public function finCode(){
		$finCode = get_post_meta(get_the_ID(),'co_fincode',true);
		$finCode =($finCode)?$finCode:'132215';
	    return $finCode;
	}
	public function cpnlistedDb(){
		 return $this->cpnListed_db;
	}
	public function sector(){
		 return $this->sector;
	}
	public function sName(){
		return @$this->cDetailsresponse['s_name'];
	}
	public function compName(){
		return @$this->cDetailsresponse['CompName'];
	}
	public function apiExchg(){
		return $this->apiExchg;
	}
	 
}