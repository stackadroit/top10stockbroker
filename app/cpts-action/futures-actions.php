<?php

function get_deviatives_api_response_curl($url =''){
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
function get_symble_list_and_id($instName ='option-chain'){
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
/*--------------------------------------------------------
/*      Load Share Market Page Template and Single Page Content
/*      Through Ajax
/*---------------------------------------------------------*/
add_action( 'wp_ajax_load_future_single_page_section',  __NAMESPACE__ . '\\load_future_single_page_section' );
add_action( 'wp_ajax_nopriv_load_future_single_page_section',  __NAMESPACE__ . '\\load_future_single_page_section' );
function load_future_single_page_section(){
    $data = $_REQUEST['data'];
    // $data['acc_companyLists']=get_acc_companyLists();
    if($data['page']){
        $page_id =  @$data['pageID'];
        $instName = @$data['instName'];
        $symbol = @$data['symbol'];
        $ExpDate =  @$data['ExpDate'];
        $OptType =  @$data['OptType'];
        $StkPrice =  @$data['StkPrice'];
        // $companyName =  $data['companyName'];
        // $acc_companyLists = $GLOBALS['acc_companyLists'];
        // $cDetailsresponse =  (array)json_decode(stripslashes($data['cDetailsresponse']));
 // "p1": "chart-data",
 //              "p2": "most-active-stock-data",
 //              "p3": "most-active-index-data",
 //              "p4": "top-open-interest-stock-data",
 //              "p5": "top-open-interest-index-data",
        switch ($data['page']) {
            case 'chart-data':
                $section_title=get_post_meta($page_id,'graph_section_title',true);
                $section_content=get_post_meta($page_id,'graph_section_content',true);;
                $template = 'partials.ajax.futures.chart';
                break;
            case 'most-active-stock-data':
                $symbol ='';
                $OptType ='';
                $Rtype ='vol';
                $instName ='FUTSTK';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$instName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10"; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $callsAnalysis= (array) $resposeArray->Table;
                }
                $data['callsAnalysis']=$callsAnalysis;
                $Rtype ='val';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$instName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10";
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $putsAnalysis= (array) $resposeArray->Table;
                }
                $data['putsAnalysis']=$putsAnalysis;
                $Rtype ='G';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$instName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10";
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $gainerAnalysis= (array) $resposeArray->Table;
                }
                $data['gainerAnalysis']=$gainerAnalysis;
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$instName}&Symbol={$symbol}";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 

                if(@$resposeArray1->status_code == 200){
                    $ExpiryDateFilter= (array) @$resposeArray1->Table;
                }
                $data['ExpiryDateFilter']=$ExpiryDateFilter;
                $futuresSymbol =get_symble_list_and_id('futures');
                $data['futuresSymbol']=$futuresSymbol;
                $section_title= get_post_meta($page_id,'most_active_stock_title',true);
                $section_content= get_post_meta($page_id,'most_active_stock_content',true);
                $template = 'partials.ajax.futures.most-active-stock-data';
                break;
            case 'most-active-index-data':
                $instName ='FUTIDX';
                $symbol ='';
                $OptType ='';
                $Rtype ='vol';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$instName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10"; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $callsAnalysis= (array) $resposeArray->Table;
                }
                $data['callsAnalysis']=$callsAnalysis;
                $Rtype ='val';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$instName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10";
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $putsAnalysis= (array) $resposeArray->Table;
                }
                $data['putsAnalysis']=$putsAnalysis;
                $Rtype ='G';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$instName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=1&PageSize=10";
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $gainerAnalysis= (array) $resposeArray->Table;
                }
                $data['gainerAnalysis']=$gainerAnalysis;
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$instName}&Symbol={$symbol}";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 

                if(@$resposeArray1->status_code == 200){
                    $ExpiryDateFilter= (array) @$resposeArray1->Table;
                }
                $data['ExpiryDateFilter']=$ExpiryDateFilter;
                $section_title= get_post_meta($page_id,'most_active_index_title',true);
                $section_content= get_post_meta($page_id,'most_active_index_content',true);
                $futuresSymbol =get_symble_list_and_id('futures');
                $data['futuresSymbol']=$futuresSymbol;
                $template = 'partials.ajax.futures.most-active-index-data';
                break;
            case 'top-open-interest-stock-data':
                $PageName ='OICNT';
                $InstName ='FUTSTK';
                $Opt='HOI';
                $Top ='';
                $PageNo ='1';
                $PageSize ='10';
                $SortExpression ='Strikepice';
                $SortDirection ='Desc';
                $OptType ='';
                $hTableData =array();
                $lTableData =array();
                $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $hTableData= (array) $resposeArray->Table;
                }
                $data['hTableData']=$hTableData;
                $Opt='LOI';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $lTableData= (array) $resposeArray->Table;
                }
                $data['lTableData']=$lTableData;
  
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol=";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 
                $ExpiryDateFilter =array();
                if(@$resposeArray1->status_code == 200){
                    $ExpiryDateFilter= (array) @$resposeArray1->Table;
                } 
                $data['ExpiryDateFilter']=$ExpiryDateFilter;
                $section_title= get_post_meta($page_id,'top_open_interest_stock_title',true);
                $section_content= get_post_meta($page_id,'top_open_interest_stock_content',true);
                $futuresSymbol =get_symble_list_and_id('futures');
                $data['futuresSymbol']=$futuresSymbol; 
                $template = 'partials.ajax.futures.top-open-interest-stock-data';
                break;
            case 'top-open-interest-index-data':
                $PageName ='OICNT';
                $InstName='FUTIDX';
                $Opt='HOI';
                $Top ='';
                $PageNo ='1';
                $PageSize ='10';
                $SortExpression ='Strikepice';
                $SortDirection ='Desc';
                $OptType ='';
                $hTableData =array();
                $lTableData =array();
                $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $hTableData= (array) $resposeArray->Table;
                }
                $data['hTableData']=$hTableData;
                $Opt='LOI';
                $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection.""; 
                $resposeArray =get_deviatives_api_response_curl($url);
                if(@$resposeArray->status_code == 200){
                    $lTableData= (array) $resposeArray->Table;
                }
                $data['lTableData']=$lTableData;
   
                $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol=";
                $resposeArray1 =get_deviatives_api_response_curl($epUrl); 
                $ExpiryDateFilter =array();
                if(@$resposeArray1->status_code == 200){
                    $ExpiryDateFilter= (array) @$resposeArray1->Table;
                } 
                $data['ExpiryDateFilter']=$ExpiryDateFilter;
                $section_title= get_post_meta($page_id,'top_open_interest_index_title',true);
                $section_content= get_post_meta($page_id,'top_open_interest_index_content',true);
                $futuresSymbol =get_symble_list_and_id('futures');
                $data['futuresSymbol']=$futuresSymbol;
                $template = 'partials.ajax.futures.top-open-interest-index-data';
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
?>