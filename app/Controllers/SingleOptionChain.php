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

	// protected function get_deviatives_api_response_curl($url =''){
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
	//         // print_r($response);
	//         // curl_close($ch);
	//         if($httpCode == 200){
	//            $resposeArray =json_decode($response);
	//            // print_r($resposeArray);
	//            $resposeArray->status_code=$httpCode;
	//            return $resposeArray;
	//         }else{
	//             return array();
	//         }
	//     }else{
	//         return array();
	//     }
	// }
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
		// SELECT wpgl_posts.* FROM wpgl_posts WHERE 1=1 AND wpgl_posts.post_type = 'option-chain' AND ((wpgl_posts.post_status = 'publish')) ORDER BY wpgl_posts.post_title ASC
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
	
	// public function companyDetails(){
	// 	$InstName = $this->instName();
	// 	$symbol = $this->symbol();
	// 	$cDetailsresponse =array();
	// 	$epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
	// 	$resposeArray1 =$this->get_deviatives_api_response_curl($epUrl); 
	// 	if(@$resposeArray1->status_code == 200){
	// 	    $ExpiryDate= (array) @$resposeArray1->Table;
	// 	    $this->expiryDate= $ExpiryDate;
	// 	    $ExpDate =@$ExpiryDate[0]->expdate1;
	// 	    $this->expDate =$ExpDate ;
	// 	    $ExpDateDsp =@$ExpiryDate[0]->expdate;
	// 	    $this->expDateDsp =$ExpDateDsp ;
	// 	} 
 //    	$OptType ='PE';
 //  		$this->optType =$OptType;
 //  		$spUrl="https://derivatives.accordwebservices.com/Derivative/GetSrikePrice?InstName={$InstName}&Symbol={$symbol}&ExpDate={$ExpDate}&OptType={$OptType}";
	// 	$resposeArrayOT =get_deviatives_api_response_curl($spUrl);
	// 	$StrikePrice =''; 
	// 	$stcMid =''; 
	// 	$StkPrice =''; 
	// 	if(@$resposeArrayOT->status_code == 200){
	// 	  $StrikePrice= (array) @$resposeArrayOT->Table;
	// 	  $stcMid=(int) (count($StrikePrice) /2);
	// 	  $StkPrice =$StrikePrice[$stcMid]->StrikePrice;
	// 	} 
 //  		$this->strikePrice =$StrikePrice;
 //  		$this->stcMid =$stcMid;
 //  		$this->stkPrice =$StkPrice;
	// 	$url ="https://derivatives.accordwebservices.com/Derivative/GetQuotes?InstName={$InstName}&Symbol={$symbol}&ExpDate={$ExpDate}&OptType={$OptType}&StkPrice={$StkPrice}";
	// 	$resposeArray =get_deviatives_api_response_curl($url);  
	// 	if(@$resposeArray->status_code == 200){
	// 	  	$this->cDetailsresponse= (array) @$resposeArray->Table[0];
	// 	}
	// 	// print_r($this->cDetailsresponse);
	// 	return $this->cDetailsresponse;
	// }
	// public function expiryDate(){
	//     return $this->expiryDate;
	// }
	// public function optType(){
	//     return $this->optType;
	// }
	// public function strikePrice(){
	//     return $this->strikePrice;
	// }
	// public function stcMid(){
	//     return $this->stcMid;
	// }
	// public function stkPrice(){
	//     return $this->stkPrice;
	// }
	// public function compName(){
	// 	return $this->cDetailsresponse['SYMBOL'];
	// }

	// public function expDate(){
	// 	return @$this->expDate;
	// }

	// public function expDatedisplay(){
	// 	return @$this->expDateDsp;
	// }
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

	// protected function openInterestStockIndexOptionData($InstName,$PageSize,$page){
	// 		$loadDetailsPageData =array();
	// 		$loadDetailsPageData['page']=$page;
	// 		$main_h1_title= get_post_meta(get_the_ID(),'main_title_h1',true);
	// 		$main_para_content= get_post_meta(get_the_ID(),'main_paragraph_content',true);
	// 		$loadDetailsPageData['main_h1_title']=$main_h1_title;
	// 		$loadDetailsPageData['main_para_content']=$main_para_content;
	// 		$symbol ='';
	// 		$epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
	// 		$resposeArray1 =$this->get_deviatives_api_response_curl($epUrl); 
 // 			if(@$resposeArray1->status_code == 200){
	// 		    $ExpiryDateFilter= (array) @$resposeArray1->Table;
	// 		    $ExpDate =@$ExpiryDateFilter[0]->expdate1;
	// 		    $ExpDateDsp =@$ExpiryDateFilter[0]->expdate;
	// 		  	$loadDetailsPageData['ExpiryDateFilter']=$ExpiryDateFilter;
	// 		  	$loadDetailsPageData['ExpDate']=$ExpDate;
	// 		  	$loadDetailsPageData['ExpDateDsp']=$ExpDateDsp;
	// 		}
	// 		$ctableTotalRow =0;
	// 		$ptableTotalRow =0;
	// 		$PageName ='OICNT';
	// 		$Opt='HOI';
	// 		$Top ='';
	// 		$PageNo ='1';
	// 		$PageSize ='20';
	// 		$SortExpression ='Strikepice';
	// 		$SortDirection ='Desc';
	// 		$OptType ='CE';
	// 		$loadDetailsPageData['Opt']=$Opt;
	// 		$loadDetailsPageData['InstName']=$InstName;
	// 		$url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
	// 		$resposeArray =$this->get_deviatives_api_response_curl($url);
	// 		if(@$resposeArray->status_code == 200){
	// 		      $cVol= (array) $resposeArray->Table;
	// 		      $loadDetailsPageData['cVol']=$cVol;
	// 		      $ctableTotalRow=@$resposeArray->Table1[0]->TotalRows;
	// 		      $loadDetailsPageData['ctableTotalRow']=$ctableTotalRow;
	// 		}
	// 		$OptType ='PE';
	// 		$url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
	// 		$resposeArray =$this->get_deviatives_api_response_curl($url);
	// 		if(@$resposeArray->status_code == 200){
	// 		    $pVol= (array) $resposeArray->Table;
	// 		    $loadDetailsPageData['pVol']=$pVol;
	// 		    $ptableTotalRow=@$resposeArray->Table1[0]->TotalRows;
	// 		    $loadDetailsPageData['ptableTotalRow']=$ptableTotalRow;
	// 		}
 //            return $loadDetailsPageData;		
	// }
	// protected function mostActiveStockIndexOptionData($InstName,$PageSize,$page){
	// 		$loadDetailsPageData =array();
	// 		$loadDetailsPageData['page']=$page;
	// 		$main_h1_title= get_post_meta(get_the_ID(),'main_title_h1',true);
	// 		$main_para_content= get_post_meta(get_the_ID(),'main_paragraph_content',true);
	// 		$loadDetailsPageData['main_h1_title']=$main_h1_title;
	// 		$loadDetailsPageData['main_para_content']=$main_para_content;
	// 		$loadDetailsPageData['InstName']=$InstName;
	// 		$symbol ='';
  
	// 	  	$epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
	// 	  	$resposeArray1 =get_deviatives_api_response_curl($epUrl); 

	// 	  	if(@$resposeArray1->status_code == 200){
	// 	    	$ExpiryDateFilter= (array) @$resposeArray1->Table;
	// 	    	$ExpDate =@$ExpiryDateFilter[0]->expdate1;
	// 	    	$ExpDateDsp =@$ExpiryDateFilter[0]->expdate;
	// 	    	$loadDetailsPageData['ExpiryDateFilter']=$ExpiryDateFilter;
	// 	    	$loadDetailsPageData['ExpDate']=$ExpDate;
	// 	    	$loadDetailsPageData['ExpDateDsp']=$ExpDateDsp;
	// 	  	}
	// 	  	$ctableTotalRow =0;
	// 	  	$ptableTotalRow =0;
	// 	  	$OptType ='C';
	// 	  	$Rtype ='vol';
	// 	  	$PageSize ='20';
	// 	  	$loadDetailsPageData['Rtype']=$Rtype;
	// 	  	$url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=".$PageSize; 
	// 	  	$resposeArray =get_deviatives_api_response_curl($url);
	// 	  	if(@$resposeArray->status_code == 200){
	// 	    	$cVol= (array) $resposeArray->Table;
	// 	    	$ctableTotalRow=@$resposeArray->Table1[0]->TotalRows;
	// 	    	$loadDetailsPageData['cVol']=$cVol;
	// 	    	$loadDetailsPageData['ctableTotalRow']=$ctableTotalRow;
	// 	  	}
	// 	  	$OptType ='P';
	// 	  	$Rtype ='vol';
	// 	  	$url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=".$PageSize; 
	// 	  	$resposeArray =get_deviatives_api_response_curl($url);
	// 	  	if(@$resposeArray->status_code == 200){
	// 	    	$pVol= (array) $resposeArray->Table;
	// 	    	$ptableTotalRow=@$resposeArray->Table1[0]->TotalRows;
	// 	    	$loadDetailsPageData['pVol']=$pVol;
	// 	    	$loadDetailsPageData['ptableTotalRow']=$ptableTotalRow;
	// 	  	}
 //            return $loadDetailsPageData;		
	// } 
	// protected function putCallRatio($page){
	// 	$main_h1_title= get_post_meta(get_the_ID(),'main_title_h1',true);
 // 		$main_para_content= get_post_meta(get_the_ID(),'main_paragraph_content',true);
	//   	$loadDetailsPageData['main_h1_title']=$main_h1_title;
	//   	$loadDetailsPageData['main_para_content']=$main_para_content;
	//   	$loadDetailsPageData['page']=$page;

	//   	$InstName ='OPTSTK';
	//   	$symbol ='';
	//   	$epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
	//   	$resposeArray1 =get_deviatives_api_response_curl($epUrl); 

	//   	if(@$resposeArray1->status_code == 200){
	//      	$SExpiryDateFilter= (array) @$resposeArray1->Table;
	//      	$SExpDate =@$SExpiryDateFilter[0]->expdate1;
	//      	$SExpDateDsp =@$SExpiryDateFilter[0]->expdate;
	//      	$loadDetailsPageData['SExpiryDateFilter']=$SExpiryDateFilter;
	//      	$loadDetailsPageData['SExpDate']=$SExpDate;
	//      	$loadDetailsPageData['SExpDateDsp']=$SExpDateDsp;
	//   	}
	//   	$StableTotalRow =0;
	//   	$ItableTotalRow =0;
	//   	$ReportType= 'vol';
	//   	$SortDirection= 'Desc';
	//   	$SortExpression= 'Put';
	//   	$PageSize= '20';
	//   	$PageNo= 1;
 //  		$url ="https://derivatives.accordwebservices.com/Derivative/GetPutCallRatio?Top=&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection."&ExpDate=".$SExpDate."&ReportType=".$ReportType."";
 //  		$resposeArray =get_deviatives_api_response_curl($url);
 //  		if(@$resposeArray->status_code == 200){
 //    		$stockCPAnalysis= (array) $resposeArray->Table;
 //    		$loadDetailsPageData['stockCPAnalysis']=$stockCPAnalysis;
 //    		$StableTotalRow=@$resposeArray->Table1[0]->TotalRows;
 //    		$loadDetailsPageData['StableTotalRow']=$StableTotalRow;
 //  		}

   
 //  		$InstName ='OPTIDX';
 
 //  		$epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
 //  		$resposeArray1 =get_deviatives_api_response_curl($epUrl); 

 //  		if(@$resposeArray1->status_code == 200){
 //     		$IExpiryDateFilter= (array) @$resposeArray1->Table;
 //     		$IExpDate =@$IExpiryDateFilter[0]->expdate1;
 //     		$IExpDateDsp =@$IExpiryDateFilter[0]->expdate;
 //     		$loadDetailsPageData['IExpiryDateFilter']=$IExpiryDateFilter;
 //     		$loadDetailsPageData['IExpDate']=$IExpDate;
 //     		$loadDetailsPageData['IExpDateDsp']=$IExpDateDsp;
 //  		}
 //  		$ReportType= 'vol';
 //  		$SortDirection= 'Desc';
 //  		$SortExpression= 'Put';
 //  		$PageSize= '20';
 //  		$PageNo= 1;
 //  		$loadDetailsPageData['PageSize']=$PageSize;
 //  		$url ="https://derivatives.accordwebservices.com/Derivative/GetPutCallRatio?Top=&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection."&ExpDate=".$IExpDate."&ReportType=".$ReportType."";
 //    	$resposeArray =get_deviatives_api_response_curl($url);
 //    	if(@$resposeArray->status_code == 200){
 //      		$indexCPAnalysis= (array) $resposeArray->Table;
 //      		$loadDetailsPageData['indexCPAnalysis']=$indexCPAnalysis;
 //      		$ItableTotalRow=@$resposeArray->Table1[0]->TotalRows;
 //      		$loadDetailsPageData['ItableTotalRow']=$ItableTotalRow;
 //    	}
 //   		$optionChainSymbol =get_symble_list_and_id('option-chain');
 //   		$loadDetailsPageData['optionChainSymbol']=$optionChainSymbol;
 //   		// print_r($loadDetailsPageData['optionChainSymbol']);
 //   		// exit;
 //   		$loadDetailsPageData['ReportType']=$ReportType;
 //   		return $loadDetailsPageData;	 
	// } 
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
		            $loadDetailsPageData =$this->putCallRatio($page);
		            break;
		        case 'most-active-stock-option':
		          	$InstName ='OPTSTK';
		          	$PageSize =20;
		          	$page ='most-active-stock-option';
		           
		            // $loadDetailsPageData =$this->mostActiveStockIndexOptionData($InstName,$PageSize,$page);
		            break;
	          	case 'most-active-index-option':
		          	$page ='most-active-index-option';
		          	$InstName ='OPTIDX';
		          	$PageSize =20;
		          	 
		            // $loadDetailsPageData =$this->mostActiveStockIndexOptionData($InstName,$PageSize,$page);
		            break;
		        case 'open-interest-stock-option':
		          	$InstName ='OPTSTK';
		          	$PageSize =20;
		          	$page ='open-interest-stock-option';
		           
		            // $loadDetailsPageData =$this->openInterestStockIndexOptionData($InstName,$PageSize,$page);
		            break;
	          	case 'open-interest-index-option':
		          	$page ='open-interest-index-option';
		          	$InstName ='OPTIDX';
		          	$PageSize =20;

		            // $loadDetailsPageData =$this->openInterestStockIndexOptionData($InstName,$PageSize,$page);
		            break;
	            
	          }
	          $loadDetailsPageData['page']=$page;
		      $loadDetailsPageData['InstName']=$InstName;
		      $loadDetailsPageData['PageSize']=$PageSize;
	          // print_r($loadDetailsPageData);
	        return $loadDetailsPageData;
	    }else{
	    	return false;
		}

	} 
}