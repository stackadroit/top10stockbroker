<?php
/*--------------------------------------------------------
/*      Load Option Chain Page Template and Single Page Content
/*      Through Ajax
/*---------------------------------------------------------*/
add_action( 'wp_ajax_load_option_chain_page_section',  __NAMESPACE__ . '\\load_option_chain_page_section' );
add_action( 'wp_ajax_nopriv_load_option_chain_page_section',  __NAMESPACE__ . '\\load_option_chain_page_section' );
function load_option_chain_page_section(){
    $data = $_REQUEST['data'];
    if($data['page']){
        $pageID =  @$data['pageID'];
        $pageID = !empty($pageID) ? $pageID : get_the_ID();
        $page_id =  @$pageID;
      	$InstName = @$data['InstName'];
      	$symbol = @$data['symbol'];
     	$ExpDate = @$data['ExpDate'];
     	$OptType = @$data['OptType'];
       	$StkPrice = @$data['StkPrice'];
      //  	$companyName =  @$data['companyName'];
     	// $acc_companyLists = $GLOBALS['acc_companyLists'];
         
        switch ($data['page']) {
            case 'chart-data':
                $section_title=get_post_meta($page_id,'graph_section_title',true);
                $section_content=get_post_meta($page_id,'graph_section_content',true);;
                $template = 'partials.ajax.option-chain.chart';
                break;
            case 'strike-price-analysis-data':
  				$dates =explode('.', $ExpDate);
				$expDateYDM =@$dates[0].'.'.@$dates[2].'.'.@$dates[1];
				$data['expDateYDM'] =$expDateYDM;
  				$url ="https://derivatives.accordwebservices.com/Derivative/GetQuotes?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$expDateYDM."&OptType=CE&StkPrice=";
			  	$resposeArray =get_deviatives_api_response_curl($url);
			  	if(@$resposeArray->status_code == 200){
			   		$callsAnalysis= (array) $resposeArray->Table;
			   		$data['callsAnalysis'] =$callsAnalysis;
			  	}
  				$url ="https://derivatives.accordwebservices.com/Derivative/GetQuotes?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$expDateYDM."&OptType=PE&StkPrice=";//.$stkPrice;
  				$resposeArray =get_deviatives_api_response_curl($url);
  				if(@$resposeArray->status_code == 200){
    				$putsAnalysis= (array) $resposeArray->Table;
    				$data['putsAnalysis'] =$putsAnalysis;
  				}
  				$epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
  				$resposeArray1 =get_deviatives_api_response_curl($epUrl); 
  				$ExpiryDateFilter =array();
  				if(@$resposeArray1->status_code == 200){
    				$ExpiryDateFilter= (array) @$resposeArray1->Table;
    				$data['ExpiryDateFilter'] =$ExpiryDateFilter;
  				}  
				$section_title= get_post_meta($pageID,'analysis_section_title',true);
				$section_content= get_post_meta($pageID,'analysis_section_content',true);
            	$template = 'partials.ajax.option-chain.strike-price-analysis-data';
            	break;
            case 'most-active-options-data':
				$OptType ='C';
  				$Rtype ='vol';
  				$url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10"; 
  				$resposeArray =get_deviatives_api_response_curl($url);
  				if(@$resposeArray->status_code == 200){
    				$cVol= (array) $resposeArray->Table;
    				$data['cVol']=$cVol;
  				}
  				$OptType ='P';
  				$Rtype ='vol';
  				$url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10"; 
  				$resposeArray =get_deviatives_api_response_curl($url);
  				if(@$resposeArray->status_code == 200){
    				$pVol= (array) $resposeArray->Table;
    				$data['pVol']=$pVol;
  				} 
                $data['ExpDate']=$ExpDate;
				$section_title= get_post_meta($pageID,'options_section_title',true);
				$section_content= get_post_meta($pageID,'options_section_content',true);
            	$template = 'partials.ajax.option-chain.most-active-options-data';
            	break;
            case 'open-interest-analysis-data':
                $dates =explode('.', $ExpDate);
                $expDateYMD =@$dates[0].'.'.@$dates[2].'.'.@$dates[1];
                $data['expDateYMD']=$expDateYMD;
                $PageName ='OICNT';
    
                $data['PageName']=$PageName;
                $Symbol =$symbol;
                $data['Symbol']=$Symbol;
                $Opt='HOI';
                $Top ='';
                $PageNo ='1';
                $PageSize ='10';
                $SortExpression ='Strikepice';
                $SortDirection ='Desc';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=".$Symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $callsAnalysis= (array) $resposeArray->Table;
                    $data['callsAnalysis']=$callsAnalysis;
                }
                $OptType ='CE';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=".$Symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $putsAnalysis= (array) $resposeArray->Table;
                    $data['putsAnalysis']=$putsAnalysis;
                }
                $section_title= get_post_meta($page_id,'option_analysis_section_title',true);
                $section_content= get_post_meta($page_id,'option_analysis_section_content',true);
                $template = 'partials.ajax.option-chain.open-interest-analysis-data';
                break;
            case 'top-put-call-ratio-data':

                $section_title= get_post_meta($pageID,'call_ratio_section_title',true);
                $section_content= get_post_meta($pageID,'call_ratio_section_content',true);
                $section ='TPCR'; 
                $InstName ='OPTSTK';
                $symbol ='';
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 

                if(@$resposeArray1->status_code == 200){
                    $SExpiryDateFilter= (array) @$resposeArray1->Table;
                    $SExpDate =@$SExpiryDateFilter[0]->expdate1;
                    $SExpDateDsp =@$SExpiryDateFilter[0]->expdate;
                    $data['SExpiryDateFilter']=$SExpiryDateFilter;
                    $data['SExpDate']=$SExpDate;
                    $data['SExpDateDsp']=$SExpDateDsp;
                }
  
                $ReportType= 'vol';
                $SortDirection= 'Desc';
                $SortExpression= 'Put';
                $PageSize= '10';
                $PageNo= 1;
                $url ="https://derivatives.accordwebservices.com/Derivative/GetPutCallRatio?Top=&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection."&ExpDate=".$SExpDate."&ReportType=".$ReportType."";
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                     $stockCPAnalysis= (array) $resposeArray->Table;
                      $data['stockCPAnalysis']=$stockCPAnalysis;
                }

   
                $InstName ='OPTIDX';
 
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 

                if(@$resposeArray1->status_code == 200){
                    $IExpiryDateFilter= (array) @$resposeArray1->Table;
                    $IExpDate =@$IExpiryDateFilter[0]->expdate1;
                    $IExpDateDsp =@$IExpiryDateFilter[0]->expdate;
                    $data['IExpiryDateFilter']=$IExpiryDateFilter;
                    $data['IExpDate']=$IExpDate;
                    $data['IExpDateDsp']=$IExpDateDsp;
                }
                 // print_r($data['IExpiryDateFilter']);
                $url ="https://derivatives.accordwebservices.com/Derivative/GetPutCallRatio?Top=&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection."&ExpDate=".$IExpDate."&ReportType=".$ReportType."";
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $indexCPAnalysis= (array) $resposeArray->Table;
                    $data['indexCPAnalysis']=$indexCPAnalysis;
                }
                $optionChainSymbol =get_symble_list_and_id('option-chain');
                $data['optionChainSymbol']=$optionChainSymbol;
                $data['ReportType']=$ReportType;
                $data['section']=$section;
                // print_r($data);
                // exit;
                $template = 'partials.ajax.option-chain.top-put-call-ratio-data';
                break;
            case 'most-active-stock-options-data':
                $section ='MASO'; 
                $symbol ='';
                $InstName ='OPTSTK';
                $OptType ='C';
                $Rtype ='vol';
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 
                $ExpiryDateFilter =array();
                if(@$resposeArray1->status_code == 200){
                    $ExpiryDateFilter= (array) @$resposeArray1->Table;
                    $ExpDate =@$ExpiryDateFilter[0]->expdate1;
                    $ExpDateDsp =@$ExpiryDateFilter[0]->expdate;
                    $data['ExpiryDateFilter']=$ExpiryDateFilter;
                    $data['ExpDate']=$ExpDate;
                    $data['ExpDateDsp']=$ExpDateDsp;
                } 
                $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10"; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $cVol= (array) $resposeArray->Table;
                    $data['cVol']=$cVol;
                }
                $OptType ='P';
                $Rtype ='vol';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10"; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $pVol= (array) $resposeArray->Table;
                    $data['pVol']=$pVol;
                }
                $section_title= get_post_meta($pageID,'stock_options_section_title',true);
                $section_content= get_post_meta($pageID,'stock_options_section_content',true);
                $data['section'] =$section;
                $data['Rtype'] =$Rtype;
                $template = 'partials.ajax.option-chain.most-active-stock-options-data';
                break;
            case 'most-active-index-options-data':
                $section ='MAIO'; 
                $symbol ='';
                $InstName ='OPTIDX';
                $OptType ='C';
                $Rtype ='vol';
                $data['section']=$section;
                $data['Rtype']=$Rtype;
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 
                $ExpiryDateFilter =array();
                if(@$resposeArray1->status_code == 200){
                    $ExpiryDateFilter= (array) @$resposeArray1->Table;
                    $ExpDate =@$ExpiryDateFilter[0]->expdate1;
                    $ExpDateDsp =@$ExpiryDateFilter[0]->expdate;
                    $data['ExpiryDateFilter']= $ExpiryDateFilter;
                    $data['ExpDate']= $ExpDate;
                    $data['ExpDateDsp']= $ExpDateDsp;
                }
                $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10"; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $cVol= (array) $resposeArray->Table;
                    $data['cVol']= $cVol;
                }
                $OptType ='P';
                $Rtype ='vol';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10"; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $pVol= (array) $resposeArray->Table;
                    $data['pVol']= $pVol;
                }
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 
                $ExpiryDateFilter =array();
                if(@$resposeArray1->status_code == 200){
                    $ExpiryDateFilter= (array) @$resposeArray1->Table;
                    $data['ExpiryDateFilter']= $ExpiryDateFilter;
                } 
                $section_title= get_post_meta($pageID,'index_options_section_title',true);
                $section_content= get_post_meta($pageID,'index_options_section_content',true);
                $template = 'partials.ajax.option-chain.most-active-index-options-data';
                break; 
            case 'top-open-interest-stock-options-data':
                $section ='TOIS';
                $PageName ='OICNT';
                $Opt='HOI';
                $Top ='';
                $PageNo ='1';
                $PageSize ='10';
                $SortExpression ='Strikepice';
                $SortDirection ='Desc';
                $OptType ='CE';
                $InstName ='OPTSTK';
                $data['section']=$section;
                $data['OptType']=$OptType;
                $data['Opt']=$Opt;
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 
                $ExpiryDateFilter =array();
                if(@$resposeArray1->status_code == 200){
                    $ExpiryDateFilter= (array) @$resposeArray1->Table;
                    $ExpDate =@$ExpiryDateFilter[0]->expdate1;
                    $ExpDateDsp =@$ExpiryDateFilter[0]->expdate;
                    $data['ExpiryDateFilter']= $ExpiryDateFilter;
                    $data['ExpDate']= $ExpDate;
                    $data['ExpDateDsp']= $ExpDateDsp;
                }
                $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $cVol= (array) $resposeArray->Table;
                    $data['cVol']= $cVol;
                }
                $OptType ='PE';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $pVol= (array) $resposeArray->Table;
                    $data['pVol']= $pVol;
                } 
                $section_title= get_post_meta($pageID,'interest_stock_options_section_title',true);
                $section_content= get_post_meta($pageID,'interest_stock_options_section_content',true);
                $template = 'partials.ajax.option-chain.top-open-interest-stock-options-data';
                break; 
            case 'top-open-interest-index-options-data':
                $section ='TOIS';
                $InstName ='OPTIDX';
                $PageName ='OICNT';
                $Opt='HOI';
                $Top ='';
                $PageNo ='1';
                $PageSize ='10';
                $SortExpression ='Strikepice';
                $SortDirection ='Desc';
                $OptType ='CE';
                $section ='TOII';    
                $data['OptType']=$OptType;
                $data['Opt']=$Opt;
                $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $cVol= (array) $resposeArray->Table;
                    $data['cVol']=$cVol;
                }
                $OptType ='PE';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $pVol= (array) $resposeArray->Table;
                    $data['pVol']=$pVol;
                }
                $symbol ='';
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 
                $ExpiryDateFilter =array();
                if(@$resposeArray1->status_code == 200){
                    $ExpiryDateFilter= (array) @$resposeArray1->Table;
                    $ExpDate =@$ExpiryDateFilter[0]->expdate1;
                    $ExpDateDsp =@$ExpiryDateFilter[0]->expdate;
                    $data['ExpiryDateFilter']= $ExpiryDateFilter;
                    $data['ExpDate']= $ExpDate;
                    $data['ExpDateDsp']= $ExpDateDsp;
                }
                 
                $data['section']=$section;
                $section_title= get_post_meta($pageID,'interest_index_options_section_title',true);
                $section_content= get_post_meta($pageID,'interest_index_options_section_content',true);
                $template = 'partials.ajax.option-chain.top-open-interest-index-options-data';
                break; 
        }
    $data['section_title']=$section_title;
    $data['section_content']=$section_content;
    echo \App\template($template, $data);
    die();

    }
}
/**
*Top Call Put Tabs date filtered Data
**/
add_action( 'wp_ajax_get_top_call_put_data',  __NAMESPACE__ . '\\get_top_call_put_data' );
add_action( 'wp_ajax_nopriv_get_top_call_put_data',  __NAMESPACE__ . '\\get_top_call_put_data' );
function get_top_call_put_data() {
    $nonce = @$_POST['nonce'];
    if ( isset($_REQUEST) ) {
        $resposeArray =array();
        $tableData =array();
        $InstName =@$_REQUEST['InstName'];
        $ExpDate =@$_REQUEST['ExpDate'];
        $ReportType =@$_REQUEST['ReportType'];
        $section =@$_REQUEST['section'];
        $SortDirection= 'Desc';
        $SortExpression= 'Put';
        $PageSize= (@$_REQUEST['PageSize'])?@$_REQUEST['PageSize']:'10';
        $PageNo= 1;
        $data['PageSize']=$PageSize;
        $data['ExpDate']=$ExpDate;
        $data['InstName']=$InstName;
        $data['section']=$section;
        $url ="https://derivatives.accordwebservices.com/Derivative/GetPutCallRatio?Top=&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection."&ExpDate=".$ExpDate."&ReportType=".$ReportType."";
        
        $resposeArray =get_deviatives_api_response_curl($url);
        if(@$resposeArray->status_code == 200){
          $tableData= (array) $resposeArray->Table;
          $data['tableData']=$tableData;
          $tableTotalRow=@$resposeArray->Table1[0]->TotalRows;
          $data['tableTotalRow']=$tableTotalRow;
        }
        $optionChainSymbol =get_symble_list_and_id('option-chain');
        $data['optionChainSymbol']=$optionChainSymbol;
        $template = 'partials.ajax.option-chain.top-call-put-filter';
        echo \App\template($template, $data);
    }
    die();
        
}
/**
Option Chain list page search /option-chain
*/
add_action( 'wp_ajax_get_expire_date_list',  __NAMESPACE__ . '\\get_expire_date_list' );
add_action( 'wp_ajax_nopriv_get_expire_date_list',  __NAMESPACE__ . '\\get_expire_date_list' );
function get_expire_date_list(){
   $nonce = @$_POST['nonce'];
    if ( isset($_REQUEST) ) {
        $symbol =@$_REQUEST['symbol'];
        $InstName ='OPTSTK';
        if($symbol == 'BANKNIFTY' || $symbol == 'NIFTY') {
            $InstName ='OPTIDX';
        }
        $cDetailsresponse =array();
        $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
        $resposeArray1 =get_deviatives_api_response_curl($epUrl); 

        if(@$resposeArray1->status_code == 200){
          $ExpiryDate= (array) @$resposeArray1->Table;
          $ExpDate =@$ExpiryDate[0]->expdate1;
          $ExpDateDsp =@$ExpiryDate[0]->expdate;
        }
        foreach($ExpiryDate as $lprow){ 
            ?>
             <option <?php echo ($ExpDate ==$lprow->expdate1)?'selected="selected"':''?> value="<?php echo $lprow->expdate1; ?>"><?php echo $lprow->expdate; ?></option>
            <?php 
        } 
    }
    exit; 
}
 
add_action( 'wp_ajax_get_full_page_ajax_search',  __NAMESPACE__ . '\\get_full_page_ajax_search' );
add_action( 'wp_ajax_nopriv_get_full_page_ajax_search',  __NAMESPACE__ . '\\get_full_page_ajax_search' );
function get_full_page_ajax_search() {
    $nonce = @$_POST['nonce'];
    if ( isset($_REQUEST) ) {
        $symbol =@$_REQUEST['symbol'];
        $InstName ='OPTSTK';
        if($symbol == 'BANKNIFTY' || $symbol == 'NIFTY') {
            $InstName ='OPTIDX';
        }
        $data['symbol']=$symbol;
        $data['InstName']=$InstName;
        $cDetailsresponse =array();
        $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
        $resposeArray1 =get_deviatives_api_response_curl($epUrl); 

        if(@$resposeArray1->status_code == 200){
          $ExpiryDate= (array) @$resposeArray1->Table;
          $ExpDate =@$ExpiryDate[0]->expdate1;
          $ExpDateDsp =@$ExpiryDate[0]->expdate;
          $data['expiry_date']=$ExpiryDate;
          $data['exp_date']=$ExpDate;
          $data['ExpDateDsp']=$ExpDateDsp;
        } 

        $OptionType =array('PE'=>'PE','CE'=>'CE');
        $data['option_type'] =$OptionType;
        $OptType ='PE';
        $spUrl="https://derivatives.accordwebservices.com/Derivative/GetSrikePrice?InstName={$InstName}&Symbol={$symbol}&ExpDate={$ExpDate}&OptType={$OptType}";
        $resposeArrayOT =get_deviatives_api_response_curl($spUrl); 
        if(@$resposeArrayOT->status_code == 200){
          $StrikePrice= (array) @$resposeArrayOT->Table;
          $stcMid=(int) (count($StrikePrice) /2);
          $StkPrice =$StrikePrice[$stcMid]->StrikePrice;
          $data['strike_price']=$StrikePrice;
          $data['stcMid']=$stcMid;
          $data['stk_price']=$StkPrice;
        } 
        $data['get_symble_list']=get_symble_list('option-chain');
        $dates =explode('.', $ExpDate);
        $expDateYDM =@$dates[0].'.'.@$dates[2].'.'.@$dates[1];
        $data['expDateYDM']=$expDateYDM;
        $url ="https://derivatives.accordwebservices.com/Derivative/GetQuotes?InstName={$InstName}&Symbol={$symbol}&ExpDate={$expDateYDM}&OptType={$OptType}&StkPrice={$StkPrice}";
        $resposeArray =get_deviatives_api_response_curl($url);  
        if(@$resposeArray->status_code == 200){
          $cDetailsresponse= (array) @$resposeArray->Table[0];
        }   

        $companyName= @$cDetailsresponse['SYMBOL'];
        $companyNameFull= @$cDetailsresponse['SYMBOL'];
        $data['companyNameFull']=$companyNameFull;
        $data['companyName']=$companyName;
        $data['company_details']=$cDetailsresponse;
        $data['ajaxLoad']=1;
        $data['is_template']=true;
        $template = 'partials.option-chain.company-details';
        echo \App\template($template, $data);
        exit; 
    }
    die();
}
/**
*Top Call Put Tabs Load More Data
**/
add_action( 'wp_ajax_load_more_top_put_call_ratio',  __NAMESPACE__ . '\\load_more_top_put_call_ratio' );
add_action( 'wp_ajax_nopriv_load_more_top_put_call_ratio',  __NAMESPACE__ . '\\load_more_top_put_call_ratio' );
function load_more_top_put_call_ratio() {
    $nonce = @$_POST['nonce'];
    if ( isset($_REQUEST) ) {
        $resposeArray =array();
        $tableData =array();
        $ExpDate =@$_REQUEST['ExpDate'];
        $ReportType =@$_REQUEST['ReportType'];
        $SortDirection= 'Desc';
        $SortExpression= 'Put';
        $PageSize= (@$_REQUEST['PageSize'])?@$_REQUEST['PageSize']:'20';
        $PageNo=@$_REQUEST['PageNo'];
        $url ="https://derivatives.accordwebservices.com/Derivative/GetPutCallRatio?Top=&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection."&ExpDate=".$ExpDate."&ReportType=".$ReportType."";
        
        $resposeArray =get_deviatives_api_response_curl($url);
        if(@$resposeArray->status_code == 200){
          $tableData= (array) $resposeArray->Table;
          $tableTotalRow=@$resposeArray->Table1[0]->TotalRows;
        }
        $optionChainSymbol =get_symble_list_and_id('option-chain');
        if(is_array(@$tableData)){ 
            if(@$tableTotalRow){
                 foreach ($tableData as $idxKey =>$rowObj){
                    $rowObj =(array) $rowObj;
                    ?>
                    <tr>
                           <td>
                            <?php
                          $smId =@$optionChainSymbol[@$rowObj['Symbol']];
                          if(@$smId){
                            $smbLink =get_the_permalink($smId);
                            ?>
                            <a href="<?php echo @$smbLink; ?>" title="<?php echo @$rowObj['Symbol'] ?>"><?php echo @$rowObj['Symbol'] ?></a>
                            <?php
                          }else{
                            echo @$rowObj['Symbol'];
                          }
                         ?>
                           </td>
                           <td><?php echo date('d M Y', strtotime(@$rowObj['ExpDate'])); ?></td>
                           <td><?php echo @number_format(@$rowObj['Put'],2) ?></td>
                           <td><?php echo @number_format(@$rowObj['Call'],2) ?></td>
                           <td><?php echo @number_format(@$rowObj['Ratio'],2) ?></td>
                       </tr>
                <?php
                }
             }else{
                echo '<tr><td colspan="10">No data found(s).</td></tr>';
             }
        }
    }
    die();
}

add_action( 'wp_ajax_load_more_top_interest_stack_and_index',  __NAMESPACE__ . '\\load_more_top_interest_stack_and_index' );
add_action( 'wp_ajax_nopriv_load_more_top_interest_stack_and_index',  __NAMESPACE__ . '\\load_more_top_interest_stack_and_index' );

function load_more_top_interest_stack_and_index() {
    $nonce = @$_POST['nonce'];
    if ( isset($_REQUEST) ) {
        $resposeArray =array();
        $tableData =array();
        $PageName ='OICNT';
        $InstName =@$_REQUEST['InstName'];
        $ExpDate =@$_REQUEST['ExpDate'];
        $OptType =@$_REQUEST['OptType'];
        $Opt =@$_REQUEST['Opt'];
        $SortExpression= 'Strikepice';
        $SortDirection= 'Desc';
        $PageSize= (@$_REQUEST['PageSize'])?@$_REQUEST['PageSize']:'20';
        $PageNo= @$_REQUEST['PageNo'];
        $Top ='';
        $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
        // exit;
        $resposeArray =get_deviatives_api_response_curl($url);
        if(@$resposeArray->status_code == 200){
          $tableData= (array) $resposeArray->Table;
          $tableTotalRow=@$resposeArray->Table1[0]->TotalRows;
        }
            if(@$tableTotalRow){
             foreach ($tableData as $idxKey =>$rowObj){
                $rowObj =(array) $rowObj;
                ?>
                    <tr>
                       <td><?php echo @$rowObj['Symbol'] ?></td>
                       <td><?php echo date('d M Y', strtotime(@$rowObj['ExpDate'])); ?></td>
                       <td><?php echo @number_format(@$rowObj['Strikepice'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['Ltp'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['PrevLtp'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OI'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['PrevOI'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OIdiff'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OIchg'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OIVAlue'],2) ?></td>
                    </tr>
            <?php
            }
         }else{
            echo '<tr><td colspan="10">No data found(s).</td></tr>';
         }
                  
    }
    die();
}
 
add_action( 'wp_ajax_load_more_most_active_stack_and_index',  __NAMESPACE__ . '\\load_more_most_active_stack_and_index' );
add_action( 'wp_ajax_nopriv_load_more_most_active_stack_and_index',  __NAMESPACE__ . '\\load_more_most_active_stack_and_index' );
function load_more_most_active_stack_and_index() {
    $nonce = @$_POST['nonce'];
    if ( isset($_REQUEST) ) {
        $resposeArray =array();
        $tableData =array();
        $InstName =@$_REQUEST['InstName'];
        $symbol ='';
        $ExpDate =@$_REQUEST['ExpDate'];
        $OptType =@$_REQUEST['OptType'];
        $Rtype =@$_REQUEST['Rtype'];
        $PageNo =@$_REQUEST['PageNo'];
        $PageSize =(@$_REQUEST['PageSize'])?@$_REQUEST['PageSize']:20;
        $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=".$PageNo."&PageSize=".$PageSize; 
        $resposeArray =get_deviatives_api_response_curl($url);
        if(@$resposeArray->status_code == 200){
          $tableData= (array) $resposeArray->Table;
          $tableTotalRow=@$resposeArray->Table1[0]->TotalRows;
        }
         if(@$tableTotalRow){
             foreach ($tableData as $idxKey =>$rowObj){
                $rowObj =(array) $rowObj;
                ?>
                <tr>
                       <td><?php echo @$rowObj['Symbol'] ?></td>
                       <td><?php echo date('d M Y', strtotime(@$rowObj['ExpDate'])) ?></td>
                       <td><?php echo @number_format(@$rowObj['StrikePrice'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['LTP'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['PrevLtp'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OI'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OIValue'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OIdiff'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OIchg'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['Qty'],2) ?></td>
            </tr>
            <?php
            }
         }else{
            echo '<tr><td colspan="10">No data found(s).</td></tr>';
         }
    }
    die();
}

?>