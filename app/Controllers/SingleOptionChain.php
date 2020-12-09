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

	protected function get_deviatives_api_response_curl($url =''){
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
	        // print_r($response);
	        // curl_close($ch);
	        if($httpCode == 200){
	           $resposeArray =json_decode($response);
	           // print_r($resposeArray);
	           $resposeArray->status_code=$httpCode;
	           return $resposeArray;
	        }else{
	            return array();
	        }
	    }else{
	        return array();
	    }
	}
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
	    $args = array(
	      'post_type' => $instName,
	      'order'=>'ASC',
	      'orderby'=>'post_title',
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
	
	public function companyDetails(){
		$InstName = $this->instName();
		$symbol = $this->symbol();
		$cDetailsresponse =array();
		$epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
		$resposeArray1 =$this->get_deviatives_api_response_curl($epUrl); 
		if(@$resposeArray1->status_code == 200){
		    $ExpiryDate= (array) @$resposeArray1->Table;
		    $this->expiryDate= $ExpiryDate;
		    $ExpDate =@$ExpiryDate[0]->expdate1;
		    $this->expDate =$ExpDate ;
		    $ExpDateDsp =@$ExpiryDate[0]->expdate;
		    $this->expDateDsp =$ExpDateDsp ;
		} 
    	$OptType ='PE';
  		$this->optType =$OptType;
  		$spUrl="https://derivatives.accordwebservices.com/Derivative/GetSrikePrice?InstName={$InstName}&Symbol={$symbol}&ExpDate={$ExpDate}&OptType={$OptType}";
		$resposeArrayOT =get_deviatives_api_response_curl($spUrl);
		$StrikePrice =''; 
		$stcMid =''; 
		$StkPrice =''; 
		if(@$resposeArrayOT->status_code == 200){
		  $StrikePrice= (array) @$resposeArrayOT->Table;
		  $stcMid=(int) (count($StrikePrice) /2);
		  $StkPrice =$StrikePrice[$stcMid]->StrikePrice;
		} 
  		$this->strikePrice =$StrikePrice;
  		$this->stcMid =$stcMid;
  		$this->stkPrice =$StkPrice;
		$url ="https://derivatives.accordwebservices.com/Derivative/GetQuotes?InstName={$InstName}&Symbol={$symbol}&ExpDate={$ExpDate}&OptType={$OptType}&StkPrice={$StkPrice}";
		$resposeArray =get_deviatives_api_response_curl($url);  
		if(@$resposeArray->status_code == 200){
		  	$this->cDetailsresponse= (array) @$resposeArray->Table[0];
		}
		// print_r($this->cDetailsresponse);
		return $this->cDetailsresponse;
	}
	public function expiryDate(){
	    return $this->expiryDate;
	}
	public function optType(){
	    return $this->optType;
	}
	public function strikePrice(){
	    return $this->strikePrice;
	}
	public function stcMid(){
	    return $this->stcMid;
	}
	public function stkPrice(){
	    return $this->stkPrice;
	}
	public function compName(){
		return $this->cDetailsresponse['SYMBOL'];
	}

	public function expDate(){
		return @$this->expDate;
	}

	public function expDatedisplay(){
		return @$this->expDateDsp;
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
  				$OptType ='';
  				$Rtype ='vol';
  				$epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
  				$resposeArray1 =$this->get_deviatives_api_response_curl($epUrl); 
		  		if(@$resposeArray1->status_code == 200){
			        $ExpiryDateFilter= (array) @$resposeArray1->Table;
			        $ExpDate =@$ExpiryDateFilter[0]->expdate1;
			        $ExpDateDsp =@$ExpiryDateFilter[0]->expdate;
			  	}
			  	$loadDetailsPageData['ExpiryDateFilter']=$ExpiryDateFilter;
			  	$loadDetailsPageData['ExpDate']=$ExpDate;
			  	$loadDetailsPageData['ExpDateDsp']=$ExpDateDsp;
		  		$volumeTableTotalRow =0;
		  		$valueTableTotalRow =0;
		  		$gainerTableTotalRow =0;
		  		$PageSize =20;
		  		$loadDetailsPageData['PageSize']=$PageSize;
  				$url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=".$PageSize; 

  				$resposeArray =$this->get_deviatives_api_response_curl($url);
  				if(@$resposeArray->status_code == 200){
    				$volumeAnalysis= (array) $resposeArray->Table;
    				$volumeTableTotalRow=@$resposeArray->Table1[0]->TotalRows;
  				}
  				$loadDetailsPageData['volumeAnalysis']=$volumeAnalysis;
  				$loadDetailsPageData['volumeTableTotalRow']=$volumeTableTotalRow;
  				$Rtype ='val';
  				$url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=".$PageSize;
  				$resposeArray =$this->get_deviatives_api_response_curl($url);
  				if(@$resposeArray->status_code == 200){
    				$valueAnalysis= (array) $resposeArray->Table;
    				$valueTableTotalRow=@$resposeArray->Table1[0]->TotalRows;
  				}
  				$loadDetailsPageData['valueAnalysis']=$valueAnalysis;
  				$loadDetailsPageData['valueTableTotalRow']=$valueTableTotalRow;
  				$Rtype ='G';
  				$url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=".$PageSize;
  				$resposeArray =$this->get_deviatives_api_response_curl($url);
  				if(@$resposeArray->status_code == 200){
    				$gainerAnalysis= (array) $resposeArray->Table;
    				$gainerTableTotalRow=@$resposeArray->Table1[0]->TotalRows;
  				}
  				$loadDetailsPageData['gainerAnalysis']=$gainerAnalysis;
  				$loadDetailsPageData['gainerTableTotalRow']=$gainerTableTotalRow;
   				$futuresSymbol =$this->get_symble_list_and_id('futures');
   				$loadDetailsPageData['futuresSymbol']=$futuresSymbol;
	            //include 'page-templates/futures/most-active-stock-detail.php';
	            break;
	          case 'open-interest-stock-futures':
	          	$loadDetailsPageData['page']='interest-stock';
	            $main_h1_title= get_post_meta(get_the_ID(),'main_title_h1',true);
			 	$main_para_content= get_post_meta(get_the_ID(),'main_paragraph_content',true);
			 	$loadDetailsPageData['main_h1_title']=$main_h1_title;
			 	$loadDetailsPageData['main_para_content']=$main_para_content;
			 	$loadDetailsPageData['section_title']= get_post_meta(get_the_ID(),'main_title_h1',true);
 				$loadDetailsPageData['section_content']= get_post_meta(get_the_ID(),'main_paragraph_content',true);
			  	$PageName ='OICNT';
			  	$InstName='FUTSTK';
			  	$Opt='HOI';
			  	$Top ='';
  				$PageNo ='1';
  				$PageSize ='20';
  				$SortExpression ='Strikepice';
  				$SortDirection ='Desc';
  				$OptType ='';
  				$loadDetailsPageData['PageName']=$PageName;
  				$loadDetailsPageData['InstName']=$InstName;
  				$loadDetailsPageData['Opt']=$Opt;
  				$loadDetailsPageData['Top']=$Top;
  				$loadDetailsPageData['PageNo']=$PageNo;
  				$loadDetailsPageData['PageSize']=$PageSize;
  				$loadDetailsPageData['SortExpression']=$SortExpression;
  				$loadDetailsPageData['SortDirection']=$SortDirection;
  				$loadDetailsPageData['OptType']=$OptType;
  				$hTableData =array();
  				$lTableData =array();
  				$symbol ='';
  				$epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
  				$resposeArray1 =get_deviatives_api_response_curl($epUrl); 
  				$ExpiryDateFilter =array();
  				if(@$resposeArray1->status_code == 200){
    				$ExpiryDateFilter= (array) @$resposeArray1->Table;
    				$ExpDate =@$ExpiryDateFilter[0]->expdate1;
   					$ExpDateDsp =@$ExpiryDateFilter[0]->expdate;
  				} 
  				$loadDetailsPageData['ExpiryDateFilter']=$ExpiryDateFilter;
  				$loadDetailsPageData['ExpDate']=$ExpDate;
  				$loadDetailsPageData['ExpDateDsp']=$ExpDateDsp;
  				$url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
  				$resposeArray =get_deviatives_api_response_curl($url);
  				if(@$resposeArray->status_code == 200){
      				$hTableData= (array) $resposeArray->Table;
      				$hTableTotalRow=@$resposeArray->Table1[0]->TotalRows;
  				}
  				$loadDetailsPageData['hTableData']=$hTableData;
  				$loadDetailsPageData['hTableTotalRow']=$hTableTotalRow;
  				$Opt='LOI';
  				$url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
  				$resposeArray =get_deviatives_api_response_curl($url);
  				if(@$resposeArray->status_code == 200){
      				$lTableData= (array) $resposeArray->Table;
      				$lTableTotalRow=@$resposeArray->Table1[0]->TotalRows;
  				}
  				$loadDetailsPageData['lTableData']=$lTableData;
  				$loadDetailsPageData['lTableTotalRow']=$lTableTotalRow;
  				$futuresSymbol =get_symble_list_and_id('futures');  
  				$loadDetailsPageData['futuresSymbol']=$futuresSymbol;
	            break; 
	          }
	          // print_r($loadDetailsPageData);
	        return $loadDetailsPageData;
	    }else{
	    	return false;
		}

	} 
}