<?php
/*--------------------------------------------------------
/*      Load Share Market Page Template and Single Page Content
/*      Through Ajax
/*---------------------------------------------------------*/
add_action( 'wp_ajax_share_price_data_ajax_request',  __NAMESPACE__ . '\\share_price_data_ajax_request' );
add_action( 'wp_ajax_nopriv_share_price_data_ajax_request',  __NAMESPACE__ . '\\share_price_data_ajax_request' );
function share_price_data_ajax_request(){
    $data = $_REQUEST['data'];
    $data['acc_companyLists']=get_acc_companyLists();
    if($data['page']){
        $page_id =  $data['pageID'];
        $apiExchg = $data['apiExchg'];
        $sector = $data['sector'];
        $finCode =  $data['finCode'];
        $companyName =  $data['companyName'];
        // $acc_companyLists = $GLOBALS['acc_companyLists'];
        // $cDetailsresponse =  (array)json_decode(stripslashes($data['cDetailsresponse']));

        // include "page-templates/share-price/{$data['page']}.php" ;
        switch ($data['page']) {
            case 'chart':
                $section_title=get_post_meta($page_id,'co_graph_section_title',true);
                $section_content=get_post_meta($page_id,'co_graph_section_content',true);;
                $template = 'partials.ajax.share-price.chart';
                break;
            case 'history-price':
                $historyFilter ='1W';
                $section_title=get_post_meta($page_id,'co_historical_section_title',true);
                $section_content=get_post_meta($page_id,'co_historical_section_content',true);
                $data['historyPrice']=getHistoryPriceData($page_id,$apiExchg,$finCode,$sector,$historyFilter);
                $data['historyFilter']=$historyFilter;
                $template = 'partials.ajax.share-price.history-price';
                break;
            case 'fundamental-analysis-data':
                $fundamentalAnalysisArray=array();
                $url ="https://company.accordwebservices.com/Company/GetFinanceRatios_New?Mode=F&FinCode=".$finCode."&YearCount=5&sOpt1=&sOpt2=S&sOpt3=&sOpt4=&sOpt5=";
                $resposeArray =get_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                  $fundamentalAnalysisArray= $resposeArray;
                } 
                $section_title=get_post_meta($page_id,'co_fundamental_analysis_section_title',true);
                $section_content=get_post_meta($page_id,'co_fundamental_analysis_section_content',true);
                $data['fundamentalAnalysisArray']=$fundamentalAnalysisArray;
                $template = 'partials.ajax.share-price.fundamental-analysis-data';
                break;
            case 'comparative-analysis-data':
                $comparativeAnalysis =array();
                $url ="https://company.accordwebservices.com/Company/GetStocknIndexReturns?Exchg=".$apiExchg."&Fincode=".$finCode;
                $resposeArray =get_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                  $comparativeAnalysis1= (array) $resposeArray;
                  $comparativeAnalysis =@array_merge($comparativeAnalysis1['Table'],$comparativeAnalysis1['Table2'],$comparativeAnalysis1['Table1']);
                }
                $pageID = !empty($page_id) ? $page_id : get_the_ID();
                $section_title=get_post_meta($page_id,'co_comparative_study_section_title',true);
                $section_content=get_post_meta($page_id,'co_comparative_study_section_content',true);
                $data['comparativeAnalysis']=$comparativeAnalysis;
                $template = 'partials.ajax.share-price.comparative-analysis-data';
                break;
            case 'peers-camparison-data':

                $peersComparison =array();
                $url ="https://company.accordwebservices.com/Company/GetPeerCompaniesData?Fincode=".$finCode.'&pageno=1&pagesize=10';
                $resposeArray =get_api_response_curl($url);

                if(@$resposeArray->status_code == 200){
                  $peersComparison= (array) $resposeArray->Table;
                }
                $pageID = !empty($page_id) ? $page_id : get_the_ID();
             
                $section_title=get_post_meta($page_id,'co_peer_comparison_section_title',true);
                $section_content=get_post_meta($page_id,'co_peer_comparison_section_content',true);
                $data['peersComparison']=$peersComparison;
                $template = 'partials.ajax.share-price.peers-camparison-data';
                break;
            case 'dividend-data':
                $dividendResponse =array();
                $url ="https://company.accordwebservices.com/Company/Show_CorpAction?FinCode=".$finCode."&CorpActID=77&FromDate=&ToDate=&PageNo=1&PageSize=10&SortExp=&SortDirect=";
                $resposeArray =get_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                  $dividendResponse= (array) $resposeArray->Table;
                }
                $pageID = !empty($page_id) ? $page_id : get_the_ID();
                $section_title=get_post_meta($page_id,'co_dividend_history_section_title',true);
                $section_content=get_post_meta($page_id,'co_dividend_history_section_content',true);
                $data['dividendResponse']=$dividendResponse;
                $template = 'partials.ajax.share-price.dividend-data';
                break;
            case 'return-calculator':
                $section_title=get_post_meta($page_id,'co_return_calculator_section_title',true);
                $section_content=get_post_meta($page_id,'co_return_calculator_section_content',true);
                $template = 'partials.ajax.share-price.return-calculator';
                break;
            case 'profit-loss':
                $profitResposeArray =array();
                $url ="https://company.accordwebservices.com/Company/GetProfitandLose_New?Mode=S&FinCode=".$finCode."&YearCount=5&sOpt1=&sOpt2=S&sOpt3=&sOpt4=&sOpt5";
                $resposeArray =get_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                  $profitResposeArray= $resposeArray;
                }
                if(@$profitResposeArray){ 
                    $profitResposeArray =(array) @$profitResposeArray->Table1;
                }
                $section_title=get_post_meta($page_id,'co_profit_loss_section_title',true);
                $section_content=get_post_meta($page_id,'co_profit_loss_section_content',true);
                $data['profitResposeArray']=$profitResposeArray;
                $template = 'partials.ajax.share-price.profit-loss';
                break;
            case 'balence-sheet':
                $balenceResposeArray=array();
                $url ="https://company.accordwebservices.com/Company/GetBalanceSheet_New?Mode=S&FinCode=".$finCode."&YearCount=5&sOpt1=&sOpt2=S&sOpt3=&sOpt4=&sOpt5";
                $resposeArray =get_api_response_curl($url);

                if(@$resposeArray->status_code == 200){
                  $balenceResposeArray= $resposeArray;
                }
                if(@$balenceResposeArray){ 
                    $balenceResposeArray =(array) @$balenceResposeArray->Table1;
                }
                $section_title=get_post_meta($page_id,'co_balance_sheet_section_title',true);
                $section_content=get_post_meta($page_id,'co_balance_sheet_section_content',true);
                $data['balenceResposeArray']=$balenceResposeArray;
                $template = 'partials.ajax.share-price.balence-sheet';
                break;
            case 'corporate-actions':
                $caBrandMeetingResponse =array();
                $url ="https://company.accordwebservices.com/Company/Show_CorpAction?FinCode=".$finCode."&CorpActID=64&FromDate=&ToDate=&PageNo=1&PageSize=10&SortExp=&SortDirect=";
                $resposeArray =get_api_response_curl($url);

                if(@$resposeArray->status_code == 200){
                  $caBrandMeetingResponse= (array) $resposeArray->Table;
                }
                $data['caBrandMeetingResponse']=$caBrandMeetingResponse;
                $caBonusResponse =array();
                $url ="https://company.accordwebservices.com/Company/GetBonusRightIssues?RType=B&FINCODE=".$finCode."&Top=&PageNo=1&Pagesize=10&SortExpression=&SortDirection=Asc";
                $resposeArray =get_api_response_curl($url);

                if(@$resposeArray->status_code == 200){
                  $caBonusResponse= (array) $resposeArray->Table;
                }
                $data['caBonusResponse']=$caBonusResponse;
                $caRightResponse =array();
                $url ="https://company.accordwebservices.com/Company/GetBonusRightIssues?RType=B&FINCODE=".$finCode."&Top=&PageNo=1&Pagesize=10&SortExpression=&SortDirection=Asc";
                $resposeArray =get_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                  $caRightResponse= (array) $resposeArray->Table;
                }
                $data['caRightResponse']=$caRightResponse;
                $caSplitResponse =array();
                $url ="https://company.accordwebservices.com/Company/Show_CorpAction?FinCode=".$finCode."&CorpActID=78&FromDate=&ToDate=&PageNo=1&PageSize=10&SortExp=&SortDirect=";
                $url ="https://company.accordwebservices.com/Company/Getsplitoffv?FINCODE=".$finCode."&Top=&PageNo=1&Pagesize=10&SortExpression=&SortDirection=";
                $resposeArray =get_api_response_curl($url);

                if(@$resposeArray->status_code == 200){
                  $caSplitResponse= (array) $resposeArray->Table;
                }
                $data['caSplitResponse']=$caSplitResponse;
                $caAGMResponse =array();
                $url ="https://company.accordwebservices.com/Company/Show_CorpAction?FinCode=".$finCode."&CorpActID=65&FromDate=&ToDate=&PageNo=1&PageSize=10&SortExp=&SortDirect=";
                $resposeArray =get_api_response_curl($url);

                if(@$resposeArray->status_code == 200){
                  $caAGMResponse= (array) $resposeArray->Table;
                } 
                $section_title=get_post_meta($page_id,'co_corporate_actions_section_title',true);
                $section_content=get_post_meta($page_id,'co_corporate_actions_section_content',true);
                $data['caAGMResponse']=$caAGMResponse;
                $template = 'partials.ajax.share-price.corporate-actions';
                break;
        }
    $data['section_title']=$section_title;
    $data['section_content']=$section_content;
    echo \App\template($template, $data);
    die();
    }
}

function getHistoryPriceData($page_id,$apiExchg,$finCode,$sector,$historyFilter){
    $historyPriceResponse =array();
    
    $url ="https://company.accordwebservices.com/Company/GetStockReturnsWithPrice?Exchg=".$apiExchg."&Fincode=".$finCode."&Period=".$historyFilter;
    $resposeArray =get_api_response_curl($url);
    // print_r( $resposeArray);
    if(@$resposeArray->status_code == 200){
      $historyPriceResponse= $resposeArray->Table;
       
    } 
 
    if($historyPriceResponse && array($historyPriceResponse)){
      $historyPrice =array();
       $currentValue =$historyPriceResponse[0];
       $pastValue =$historyPriceResponse[1];
         $historyPrice[] = array(
            'label' =>'Open Price',
            'old_price' =>$pastValue->OPEN,
            'current_price' =>$currentValue->OPEN,
            'avg_pre' =>@number_format(((($currentValue->OPEN-$pastValue->OPEN)/$pastValue->OPEN)*100),2),
            'avg_pre_all' =>(($currentValue->OPEN-$pastValue->OPEN)/$pastValue->OPEN), 
         );
         $historyPrice[] = array(
            'label' =>'High Price',
            'old_price' =>$pastValue->HIGH,
            'current_price' =>$currentValue->HIGH,
            'avg_pre' =>@number_format(((($currentValue->HIGH-$pastValue->HIGH)/$pastValue->HIGH)*100),2),
            'avg_pre_all' =>(($currentValue->HIGH-$pastValue->HIGH)/$pastValue->HIGH), 
         );
         $historyPrice[] = array(
            'label' =>'Low Price',
            'old_price' =>$pastValue->LOW,
            'current_price' =>$currentValue->LOW,
            'avg_pre' =>@number_format(((($currentValue->LOW-$pastValue->LOW)/$pastValue->LOW)*100),2),
            'avg_pre_all' =>(($currentValue->LOW-$pastValue->LOW)/$pastValue->LOW), 
         );
         $historyPrice[] = array(
            'label' =>'Close Price',
            'old_price' =>$pastValue->CLOSE,
            'current_price' =>$currentValue->CLOSE,
            'avg_pre' =>@number_format(((($currentValue->CLOSE-$pastValue->CLOSE)/$pastValue->CLOSE)*100),2),
            'avg_pre_all' =>(($currentValue->CLOSE-$pastValue->CLOSE)/$pastValue->CLOSE), 
         );
         $historyPrice[] = array(
            'label' =>'Volume',
            'old_price' =>$pastValue->VOLUME,
            'current_price' =>$currentValue->VOLUME,
            'avg_pre' =>@number_format(((($currentValue->VOLUME-$pastValue->VOLUME)/$pastValue->VOLUME)*100),2),
            'avg_pre_all' =>(($currentValue->VOLUME-$pastValue->VOLUME)/$pastValue->VOLUME), 
         );
        
    }else{
        $historyPrice =array();
    }
    return $historyPrice;
}

/*--------------------------------------------------------
/*      History Price data filter
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_stock_history_price',  __NAMESPACE__ . '\\get_stock_history_price' );
add_action( 'wp_ajax_nopriv_get_stock_history_price',  __NAMESPACE__ . '\\get_stock_history_price' );
function get_stock_history_price(){
    $period =($_REQUEST['period'])?$_REQUEST['period']:'1W';
    $apiExchg =($_REQUEST['apiExchg'])?$_REQUEST['apiExchg']:'NSE';
    $finCode =($_REQUEST['finCode'])?$_REQUEST['finCode']:'';
    if($finCode){
        $url ="https://company.accordwebservices.com/Company/GetStockReturnsWithPrice?Exchg=".$apiExchg."&Fincode=".$finCode."&Period=".$period;
        $resposeArray =get_api_response_curl($url);
        if($resposeArray->status_code == 200){
          $historyPriceResponse= $resposeArray->Table;
           $currentValue =$historyPriceResponse[0];
           $pastValue=$historyPriceResponse[1];
            $ajaxResponse['price'][] = array(
                'label' =>'Open Price',
                'old_price' =>$pastValue->OPEN,
                'current_price' =>$currentValue->OPEN,
                'avg_pre' =>@number_format(((($currentValue->OPEN-$pastValue->OPEN)/$pastValue->OPEN)*100),2),
                'avg_pre_all' =>(($currentValue->OPEN-$pastValue->OPEN)/$pastValue->OPEN)*100, 
                'class' =>(@number_format(((($currentValue->OPEN-$pastValue->OPEN)/$pastValue->OPEN)*100),2) >0)?'bggreen_tbl':'bgred_tbl', 
             );
             $ajaxResponse['price'][] = array(
                'label' =>'High Price',
                'old_price' =>$pastValue->HIGH,
                'current_price' =>$currentValue->HIGH,
                'avg_pre' =>@number_format(((($currentValue->HIGH-$pastValue->HIGH)/$pastValue->HIGH)*100),2),
                'class' =>(@number_format(((($currentValue->HIGH-$pastValue->HIGH)/$pastValue->HIGH)*100),2) >0)?'bggreen_tbl':'bgred_tbl',
                'avg_pre_all' =>(($currentValue->HIGH-$pastValue->HIGH)/$pastValue->HIGH)*100, 
             );
             $ajaxResponse['price'][] = array(
                'label' =>'Low Price',
                'old_price' =>$pastValue->LOW,
                'current_price' =>$currentValue->LOW,
                'avg_pre' =>@number_format(((($currentValue->LOW-$pastValue->LOW)/$pastValue->LOW)*100),2),
                'class' =>(@number_format(((($currentValue->LOW-$pastValue->LOW)/$pastValue->LOW)*100),2) >0)?'bggreen_tbl':'bgred_tbl',
                'avg_pre_all' =>(($currentValue->LOW-$pastValue->LOW)/$pastValue->LOW)*100, 
             );
             $ajaxResponse['price'][] = array(
                'label' =>'Close Price',
                'old_price' =>$pastValue->CLOSE,
                'current_price' =>$currentValue->CLOSE,
                'avg_pre' =>@number_format(((($currentValue->CLOSE-$pastValue->CLOSE)/$pastValue->CLOSE)*100),2),
                'class' =>(@number_format(((($currentValue->CLOSE-$pastValue->CLOSE)/$pastValue->CLOSE)*100),2) >0)?'bggreen_tbl':'bgred_tbl',
                'avg_pre_all' =>(($currentValue->CLOSE-$pastValue->CLOSE)/$pastValue->CLOSE)*100, 
             );
             $ajaxResponse['price'][] = array(
                'label' =>'Volume',
                'old_price' =>$pastValue->VOLUME,
                'current_price' =>$currentValue->VOLUME,
                'avg_pre' =>@number_format(((($currentValue->VOLUME-$pastValue->VOLUME)/$pastValue->VOLUME)*100),2),
                'class' =>(@number_format(((($currentValue->VOLUME-$pastValue->VOLUME)/$pastValue->VOLUME)*100),2) >0)?'bggreen_tbl':'bgred_tbl',
                'avg_pre_all' =>(($currentValue->VOLUME-$pastValue->VOLUME)/$pastValue->VOLUME)*100, 
             );
          $ajaxResponse['status'] = 'success';
        }else{
          $ajaxResponse['status'] = 'error';
        } 
    }else{
        $ajaxResponse['status'] = 'error';
    }
    echo json_encode($ajaxResponse);
    exit;
}
?>
