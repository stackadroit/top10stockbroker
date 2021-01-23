<?php

/**
 *  Get derivative API Response Used in both Future and  
 *  Option  Chain
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
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
/*--------------------------------------------------------
/* Get Future and Option Chain Symble list In our DB
/* @author Pavan JI <dropmail2pavan@gmail.com> 
/*---------------------------------------------------------*/
function get_symble_list($instName ='option-chain'){
    $args = array(
      'post_type' => $instName,
      'order'=>'ASC',
      'orderby'=>'post_title',
      'posts_per_page'=>-1,
    );
    $post_lists= get_posts($args);
    return $post_lists;
}
/*--------------------------------------------------------
/* Get Future and Option Chain Symble Name and Symble ID our DB
/* @author Pavan JI <dropmail2pavan@gmail.com> 
/*---------------------------------------------------------*/
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
/*      Load Future Page Template and Future Single Page Content
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

/*--------------------------------------------------------
/*      Load More data on future single page details
/*---------------------------------------------------------*/
add_action( 'wp_ajax_load_more_future_most_active_stack_and_index',  __NAMESPACE__ . '\\load_more_future_most_active_stack_and_index' );
add_action( 'wp_ajax_nopriv_load_more_future_most_active_stack_and_index',  __NAMESPACE__ . '\\load_more_future_most_active_stack_and_index' );

function load_more_future_most_active_stack_and_index() {
    $resposeArray =array();
    $tableData =array(); 
    $tableTotalRow =0;
    if (isset($_REQUEST)) {
        $InstName = @$_REQUEST['InstName'];
        $ExpDate = @$_REQUEST['ExpDate'];
        $Rtype = @$_REQUEST['Rtype'];
        $OptType = @$_REQUEST['OptType'];
        $PageNo = (@$_REQUEST['PageNo'])?@$_REQUEST['PageNo']:0;
        $PageSize = (@$_REQUEST['PageSize'])?@$_REQUEST['PageSize']:20;
        $symbol ='';
        $Top ='';
       
        $SortExpression ='Strikepice';
        $SortDirection ='Desc';
      
        $tableData =array();
        $tableTotalRow =0;
        $url ="https://derivatives.accordwebservices.com/Derivative/GetMarketWatch?InstName=".$InstName."&Symbol=".$symbol."&ExpDate=".$ExpDate."&OptType=".$OptType."&Rtype=".$Rtype."&Top=&PageNo=".$PageNo."&PageSize=".$PageSize;
        $resposeArray =get_deviatives_api_response_curl($url); 
        if(@$resposeArray->status_code == 200){
          $tableData= (array) $resposeArray->Table;
          $tableTotalRow=@$resposeArray->Table1[0]->TotalRows;
        }
        $futuresSymbol =get_symble_list_and_id('futures');
         if(@$tableTotalRow){ 
            foreach ($tableData as $idxKey =>$rowObj){
                $rowObj =(array) $rowObj;
            ?>
                <tr>
                       <td>
                        <?php
                          $smId =@$futuresSymbol[@$rowObj['Symbol']];
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
                       <!-- <td><?php //echo @number_format(@$rowObj['StrikePrice'],2) ?></td> -->
                       <td><?php echo @number_format(@$rowObj['LTP'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['PrevLtp'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OI'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OIValue'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['OIdiff'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['Oichg'],2) ?></td>
                       <td><?php echo @number_format(@$rowObj['Qty'],2) ?></td>
                </tr>
           <?php
           }
        }else{
            echo '<tr><td colspan="2">No Record Found!</div>';
        }
    }
    // Always die in functions echoing ajax content
    die();
}
/*--------------------------------------------------------
/*  Load More data on future single page details for          open-interest-stock-futures
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_future_top_interest_stock_index_option_data',  __NAMESPACE__ . '\\get_future_top_interest_stock_index_option_data' );
add_action( 'wp_ajax_nopriv_get_future_top_interest_stock_index_option_data',  __NAMESPACE__ . '\\get_future_top_interest_stock_index_option_data' );
 
function get_future_top_interest_stock_index_option_data() {
    $resposeArray =array();
    $tableData =array(); 
    $tableTotalRow =0;
    if (isset($_REQUEST)) {
        $InstName = @$_REQUEST['InstName'];
        $ExpDate = @$_REQUEST['ExpDate'];
        $Opt = @$_REQUEST['Opt'];
        $OptType = @$_REQUEST['OptType'];
        $section = @$_REQUEST['section'];
        $PageSize = (@$_REQUEST['PageSize'])?@$_REQUEST['PageSize']:10;
        $symbol ='';
        $Top ='';
        $PageName ='OICNT';
          $PageNo ='1';
          $SortExpression ='Strikepice';
          $SortDirection ='Desc';
          $tableData =array();
          $tableTotalRow =0;
      $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection."";  
        $resposeArray =get_deviatives_api_response_curl($url);
        if(@$resposeArray->status_code == 200){
          $tableData= (array) $resposeArray->Table;
          $tableTotalRow=@$resposeArray->Table1[0]->TotalRows;
        }
        $futuresSymbol =get_symble_list_and_id('futures');
        ?>
        <div class="scrollbar-inner">
         <table class="table-style1 <?php echo (@$section =='read_more')? 'mb-20':'mb-0' ?> ">
                <thead>
                     <tr>
                     <th class="big-font">Symbol</th>
                     <th class="big-font">Expiry</th>
                     <!-- <th class="big-font">Strike Price</th> -->
                     <th class="big-font">LTP</th>
                     <th class="big-font">Prev. LTP</th>
                     <th class="big-font">Open Interest</th>
                     <th class="big-font">Prev. OI</th>
                     <th class="big-font">OI Change</th>
                     <th class="big-font">OI Change%</th>
                     <th class="big-font">OI Value</th>
                   </tr>
                </thead>
               <tbody>
 
                  <?php
                  if(@$tableTotalRow){ 
                    foreach ($tableData as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                      ?>
                      <tr>
                       <td>
                        <?php
                          $smId =@$futuresSymbol[@$rowObj['Symbol']];
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
                       <!-- <td><?php //echo @number_format(@$rowObj['Strikepice'],2) ?></td> -->
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
                      echo '<tr><td colspan="2">No Record Found!</div>';
                    }
                  ?>
                 </tbody>
            </table>
        </div>
        <?php
        if(@$section =='read_more' && ($tableTotalRow > $PageSize)){
            ?>
            <div class="alm-btn-wrap" id="loadMoreWrap_<?php echo @$Opt ?>">
              <button class="alm-load-more-btn" id="loadMore_<?php echo @$Opt ?>" href="javascript:void(0);" data-page_no="1" data-total="<?php echo $tableTotalRow; ?>">Load More</button>
            </div>
            <?php
        }
    }
    // Always die in functions echoing ajax content
    die();
}
/*--------------------------------------------------------
/*      Load More data on future single page details for     open-interest-index-futures
/*---------------------------------------------------------*/
add_action( 'wp_ajax_load_more_future_open_interest_stack_and_index',  __NAMESPACE__ . '\\load_more_future_open_interest_stack_and_index' );
add_action( 'wp_ajax_nopriv_load_more_future_open_interest_stack_and_index',  __NAMESPACE__ . '\\load_more_future_open_interest_stack_and_index' );
 
function load_more_future_open_interest_stack_and_index() {
    $resposeArray =array();
    $tableData =array(); 
    $tableTotalRow =0;
    if (isset($_REQUEST)) {
        $InstName = @$_REQUEST['InstName'];
        $ExpDate = @$_REQUEST['ExpDate'];
        $Opt = @$_REQUEST['Opt'];
        $OptType = @$_REQUEST['OptType'];
        $PageSize = (@$_REQUEST['PageSize'])?@$_REQUEST['PageSize']:10;
        $PageNo = (@$_REQUEST['PageNo'])?@$_REQUEST['PageNo']:1;
        $symbol ='';
        $Top ='';
        $PageName ='OICNT';
          $SortExpression ='Strikepice';
          $SortDirection ='Desc';
          $tableData =array();
          $tableTotalRow =0;
        $url ="https://derivatives.accordwebservices.com/Derivative/GetOIReports?PageName=".$PageName."&InstName=".$InstName."&Symbol=&ExpDate=".$ExpDate."&OptType=".$OptType."&Opt=".$Opt."&Top=".$Top."&PageNo=".$PageNo."&PageSize=".$PageSize."&SortExpression=".$SortExpression."&SortDirection=".$SortDirection."";  
        $resposeArray =get_deviatives_api_response_curl($url);
        if(@$resposeArray->status_code == 200){
          $tableData= (array) $resposeArray->Table;
          $tableTotalRow=@$resposeArray->Table1[0]->TotalRows;
        }
        $futuresSymbol =get_symble_list_and_id('futures');
         if(@$tableTotalRow){ 
                    foreach ($tableData as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                      ?>
                      <tr>
                       <td>
                        <?php
                          $smId =@$futuresSymbol[@$rowObj['Symbol']];
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
                       <!-- <td><?php //echo @number_format(@$rowObj['Strikepice'],2) ?></td> -->
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
                      echo '<tr><td colspan="2">No Record Found!</div>';
                    }
    }
    // Always die in functions echoing ajax content
    die();
}
/*--------------------------------------------------------
/*      Futures Template page top search Ajax Load
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_future_full_page_ajax_search',  __NAMESPACE__ . '\\get_future_full_page_ajax_search' );
add_action( 'wp_ajax_nopriv_get_future_full_page_ajax_search',  __NAMESPACE__ . '\\get_future_full_page_ajax_search' );

function get_future_full_page_ajax_search() {
    $nonce = @$_POST['nonce'];
    if ( isset($_REQUEST) ) {
        $symbol =@$_REQUEST['symbol'];
        $InstName ='FUTSTK';
        if($symbol == 'BANKNIFTY' || $symbol == 'NIFTY') {
            $InstName ='FUTIDX';
        }
        $cDetailsresponse =array();
        $epUrl="https://derivatives.accordwebservices.com/Derivative/GetExpiryDate?InstName={$InstName}&Symbol={$symbol}";
        $resposeArray1 =get_deviatives_api_response_curl($epUrl); 

        if(@$resposeArray1->status_code == 200){
          $ExpiryDate= (array) @$resposeArray1->Table;
          $ExpDate =@$ExpiryDate[0]->expdate1;
          $ExpDateDsp =@$ExpiryDate[0]->expdate;
        } 

        $OptType ='XX';
        $StkPrice ='';
        $url ="https://derivatives.accordwebservices.com/Derivative/GetQuotes?InstName={$InstName}&Symbol={$symbol}&ExpDate={$ExpDate}&OptType={$OptType}&StkPrice={$StkPrice}";

        $resposeArray =get_deviatives_api_response_curl($url);  
          if(@$resposeArray->status_code == 200){
            $cDetailsresponse= (array) @$resposeArray->Table[0];
        }       
        $Symbol=get_symble_list('futures');
        $companyName= @$cDetailsresponse['SYMBOL'];
        $companyNameFull= @$cDetailsresponse['SYMBOL'];
         
        if($cDetailsresponse){
         
            ?>
            <div class="inner-wrap">

            <div class="row align-items-center mb30">
             
                <div class="col-md-2 full-box order-md-last">
                    <div class="select-theme-stb">          
                        <select name="" id="ddlCompanySymbleTpl" class="select-style1">
                            <?php 
                                foreach ($Symbol as $lprow) {
                                    // $lprow->post_title;
                                  $smName=get_post_meta($lprow->ID,'symbol',true);
                                  if($smName){
                                   ?>
                                    <option data-symble="<?php echo $lprow->symbol; ?>" <?php echo ($smName==$symbol)?'selected="selected"':'' ?> value="<?php echo $smName; ?>" >
                                        <?php echo $smName; ?>
                                    </option>
                                   <?php
                                }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                
                <!-- col-2 full-box -->
                <div class="col-md-4"> 
                   <div class="index row">
                    <div class="col-4">
                      <input type="hidden" id="companyInstName" name="" value="<?php echo $InstName?>" />     
                      <h2 class="names" style="margin: 0px; padding:0;" title="<?php echo @$companyNameFull ?>"><?php echo @$companyNameFull ?></h2>
                    </div>
                      <div class="col-8" style="display: flex;align-items: center;justify-content: flex-end;">
                        <label style="margin-right: 5px;">Expiry Date : </label>
                        <div class="search-wrap" style="width: 130px;">
                          <select id="ExpiryDate" class="select-style1" style="height:40px;" >
                               <?php foreach($ExpiryDate as $lprow){ ?>
                                  <option <?php echo ($ExpDate ==$lprow->expdate1)?'selected="selected"':''?> value="<?php echo $lprow->expdate1; ?>"><?php echo $lprow->expdate; ?></option>
                              <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>    
                    <!-- index -->
                </div>
                <!-- col-4 -->

                <div class="col-md-6 valuesDiv"> 
                  <?php
                    if(@$cDetailsresponse['FaOdiff'] >= 0 ){
                      $arrowClass ="fa-arrow-up color-green";
                      $lavelClass ="color-green";
                    }else{
                      $arrowClass ="fa-arrow-down color-red";
                      $lavelClass ="color-red";
                    }
                     ?>         
                    <div class="value">              
                        <span class="fa sm-icon-box <?php echo $arrowClass;?>" id="currentStockRateArrow"></span>              
                        <span class="" id="currentStockRate"><?php echo @number_format(@$cDetailsresponse['LTP'],2) ?></span>              
                    </div>          
                    <div class="change">Change: <span class="<?php echo $lavelClass;?>" id="currentStockChange"><?php echo @number_format(@$cDetailsresponse['FaOdiff'],2) ?> (<?php echo @number_format(@$cDetailsresponse['FaOchange'],2) ?>%)</span></div>      
                </div>
                <!-- col-6 valuesDiv -->
            </div>
            
             
            <div class="row marketDetails bt">  
                
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-6 col-md-6">                  
                            <span class="name">Strike Price</span><br>                  
                            <span class="value" id="strick_price"><?php echo @number_format(@$cDetailsresponse['STRIKEPRICE'],2) ?></span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Open Price</span><br>                  
                            <span class="value" id="open_price"><?php echo @number_format(@$cDetailsresponse['OPENPRICE'],2) ?></span>              
                        </div>  
                    </div>
                </div>
                <!-- col-md-4 -->

                 <div class="col-md-4">        
                    <div class="row">              
                        <div class="col-6 col-md-6">                  
                            <span class="name">High Price</span><br>                  
                            <span class="value" id="high_price"><?php echo @number_format(@$cDetailsresponse['HIGHPRICE'],2) ?></span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Low Price</span><br>                  
                            <span class="value" id="low_price"><?php echo @number_format(@$cDetailsresponse['LOWPRICE'],2) ?></span>              
                        </div>          
                    </div>  
                    <!-- row -->
                 </div>
                 <!-- col-md-4 -->

                 <div class="col-md-4">
                    <div class="row ">       
                        <div class="col-6 col-md-6">                  
                            <span class="name">Prev Close</span><br>                  
                            <span class="value" id="prevclose"><?php echo @number_format(@$cDetailsresponse['PrevLtp'],2) ?></span>              
                        </div>       
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Spot Price</span><br>
                            <span class="value" id="spot_price"><?php echo @number_format(@$cDetailsresponse['Nseltp'],2) ?></span>              
                        </div>          
                    </div>    
                    <!-- row -->
                 </div>
                 <!-- col-md-4 -->
            </div>
            <div class="row marketDetails bt">  
                
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-6 col-md-6">                  
                            <span class="name">Bid Price</span><br>                  
                            <span class="value" id="bid_price"><?php echo @number_format(@$cDetailsresponse['BBUYPRICE'],2) ?></span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Bid Quantity</span><br>                  
                            <span class="value" id="bid_qty"><?php echo @number_format(@$cDetailsresponse['BBUYQTY'],2) ?></span>              
                        </div>  
                    </div>
                </div>
                <!-- col-md-4 -->

                 <div class="col-md-4">        
                    <div class="row">              
                        <div class="col-6 col-md-6">                  
                            <span class="name">Offer Price</span><br>                  
                            <span class="value" id="offer_price"><?php echo @number_format(@$cDetailsresponse['BSELLPRICE'],2) ?></span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Offer Quantity</span><br>                  
                            <span class="value" id="offer_qty"><?php echo @number_format(@$cDetailsresponse['BSELLQTY'],2) ?></span>              
                        </div>          
                    </div>  
                    <!-- row -->
                 </div>
                 <!-- col-md-4 -->

                 <div class="col-md-4">
                    <div class="row ">       
                        <div class="col-6 col-md-6">                  
                            <span class="name">Avg. Price</span><br>                  
                            <span class="value" id="avg_price"><?php echo @number_format(@$cDetailsresponse['AVGTP'],2) ?></span>              
                        </div>       
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">No. of Contracts Traded</span><br>
                            <span class="value" id="contra_trad"><?php echo @number_format(@$cDetailsresponse['TradedQtyCnt'],2) ?></span>              
                        </div>          
                    </div>    
                    <!-- row -->
                 </div>
                 <!-- col-md-4 -->
            </div>
            <div class="marketDetails row bt">
                
                <div class="col-md-4">          
                    <div class="row ">              
                        <div class="col-6 col-md-6">                  
                            <span class="name">Turnover (in Lakhs)</span><br>                  
                            <span class="value" id="turnover"><?php echo @number_format(@$cDetailsresponse['Turnover'],2) ?></span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Traded Quantity</span><br>                  
                            <span class="value" id="trad_qty"><?php echo @number_format(@$cDetailsresponse['Volume'],2) ?></span>              
                        </div>          
                    </div> 
                    <!-- row -->
                </div>
                <!-- col-md-4 -->

                <div class="col-md-4">     
                    <div class="row">              
                         <div class="col-6 col-md-6">                  
                            <span class="name">Market Lot</span><br>                  
                            <span class="value" id="market_lot"><?php echo @number_format(@$cDetailsresponse['MktLot'],2) ?></span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Open Interest</span><br>                  
                            <span class="value" id="open_intrest"><?php echo @number_format(@$cDetailsresponse['OPENINTEREST'],2) ?></span>              
                        </div> 
                    </div>
                    <!-- row -->
                </div>
                <!-- col-md-4 -->
                <div class="col-md-4">          
                    <div class="row">       
                        <div class="col-6 col-md-6">                  
                            <span class="name">Open Int. Chg</span><br> <?php 
                            if(@$cDetailsresponse['DiffOpenInt'] >0){
                              $lbClass="text-green";
                            }else{
                              $lbClass="text-red";
                            }
                            ?>                 
                            <span class="value <?php echo $lbClass; ?>" id="DiffOpenInt">
                              <?php echo @number_format(@$cDetailsresponse['DiffOpenInt'],2) ?>
                            </span>              
                        </div>       
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Open Int. Chg%</span><br>
                            <?php 
                            if(@$cDetailsresponse['chgOpenInt'] >0){
                              $lbClass="text-green";
                            }else{
                              $lbClass="text-red";
                            }
                            ?>                   
                            <span class="value <?php echo $lbClass; ?>" id="chgOpenInt">
                              <?php echo @number_format(@$cDetailsresponse['chgOpenInt'],2) ?>
                            </span>              
                        </div>          
                    </div>  
                    <!-- row -->
                </div>   
                <!-- col-md-4 -->

            </div>
        </div>
        <?php
         }


    }
    die();
}
?>