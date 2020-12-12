<?php
/*--------------------------------------------------------
/* Get Accord API Response Used in both Share Market and Share Price
/* @author Pavan JI <dropmail2pavan@gmail.com> 
/*---------------------------------------------------------*/
function get_api_response_curl($url =''){
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
/*--------------------------------------------------------
/* Get Indices list In our DB
/* @author Pavan JI <dropmail2pavan@gmail.com> 
/*---------------------------------------------------------*/
function get_indicesListPost(){
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
/*--------------------------------------------------------
/* Get High Low Indices list In our DB
/* @author Pavan JI <dropmail2pavan@gmail.com> 
/*---------------------------------------------------------*/
function get_highLowListPost(){
    $args = array(
      'post_type' => 'share-market',
      'tax_query' => array(
          array(
              'taxonomy' => 'sm-category',
              'field'    => 'slug',
              'terms'    => 'high-low',
          ),
      ),
      'order'=>'DESC',
      'orderby'=>'post_title',
      'posts_per_page'=>-1,
    );
    $post_lists= get_posts($args);
    return $post_lists;
}
/*--------------------------------------------------------
/* Get Gainers Losors Indices list In our DB
/* @author Pavan JI <dropmail2pavan@gmail.com> 
/*---------------------------------------------------------*/
function get_gainersLosorsListPost(){
    $args = array(
      'post_type' => 'share-market',
      'tax_query' => array(
          array(
              'taxonomy' => 'sm-category',
              'field'    => 'slug',
              'terms'    => 'gainers-losers',
          ),
      ),
      'order'=>'DESC',
      'orderby'=>'post_title',
      'posts_per_page'=>-1,
    );
    $post_lists= get_posts($args);
    return $post_lists;
}
$indicesList =array(
    "123"=>'NIFTY 50',
    "124"=>'NIFTY IT',
    "125"=>'NIFTY NEXT 50',
    "127"=>'NIFTY BANK',
    "128"=>'NIFTY FREE MIDCAP 100',
    "129"=>'NIFTY 500',
    "129"=>'NIFTY MIDCAP 50',
    "131"=>'NIFTY 100',
    "134"=>'NIFTY FMCG',
    "136"=>'NIFTY MNC',
    "137"=>'NIFTY SERV SECTOR',
    "138"=>'NIFTY ENERGY',
    "139"=>'NIFTY PHARMA',
    "141"=>'NIFTY INFRA',
    "142"=>'NIFTY REALTY',
    "143"=>'NIFTY PSU BANK',
    "145"=>'NIFTY FREE SMALL 100',
    "146"=>'NIFTY PSE',
    "147"=>'NIFTY CONSUMPTION',
    "148"=>'NIFTY AUTO',
    "149"=>'NIFTY METAL',
    "150"=>'NIFTY 200',
    "151"=>'NIFTY MEDIA',
    "152"=>'NIFTY COMMODITIES',
    "153"=>'NIFTY FINANCE',
    "154"=>'NIFTY DIV OPPS 50',
    "156"=>'ALPHA',
    "159"=>'NIFTY100 LIQ 15',
    "164"=>'NI15',
    "165"=>'LIX 15 MIDCAP',
    "166"=>'NV20',
    "167"=>'Nse Quality 30',
    "175"=>'NIFTY PRIVATE BANK',
    "176"=>'NIFTY MIDCAP150',
    "177"=>'NIFTY SMALLCAP250',
    "179"=>'NIFTY SMALLCAP 50',
    "181"=>'NIFTY MID SMALL400',
    "182"=>'NIFTY 100 EQUAL WEIGHT',
    "206"=>'NIFTY200 QUALITY30',
    "1"=>'S&P Bse Sensex',
    "2"=>'S&P Bse 100',
    "3"=>'S&P Bse 200',
    "4"=>'S&P Bse 500',
    "5"=>'S&P Bse IT',
    "6"=>'S&P Bse FMCG',
    "7"=>'S&P Bse Capital Goods',
    "8"=>'S&P Bse Consumer Durables',
    "9"=>'S&P Bse Healthcare',
    "10"=>'S&P Bse Dollex 200',
    "11"=>'S&P Bse Teck',
    "12"=>'S&P Bse PSU',
    "13"=>'S&P Bse Dollex 30',
    "14"=>'S&P Bse Bankex',
    "15"=>'S&P Bse Auto',
    "16"=>'S&P Bse Metal',
    "17"=>'S&P Bse Oil Gas',
    "18"=>'S&P Bse Mid Cap',
    "19"=>'S&P Bse Small Cap',
    "20"=>'S&P Bse Dollex 100',
    "21"=>'S&P Bse Realty',
    "22"=>'S&P Bse Power',
    "23"=>'S&P Bse IPO',
    "27"=>'S&P Bse SME IPO',
    "36"=>'S&P BSE Consumer Disc',
);
/**
 * Get Indice Company list In our DB
 * @return array
 */
function get_acc_companyLists()
{
    global $wpdb;
    $accord_companies_urls = $wpdb->prefix . "accord_companies_urls";
    $company = $wpdb->get_results( "SELECT DISTINCT(fincode) ,url FROM $accord_companies_urls");
    $acc_companyLists =array();
    foreach ($company as $key => $value) {
       $acc_companyLists[@$value->fincode]=@$value->url;
    }
    return $acc_companyLists;
}

/**
 * Load Share Market Page Template and Single Page Content
 * Through Ajax
 * @return array
 */
add_action( 'wp_ajax_share_market_data_ajax_request',  __NAMESPACE__ . '\\share_market_data_ajax_request' );
add_action( 'wp_ajax_nopriv_share_market_data_ajax_request',  __NAMESPACE__ . '\\share_market_data_ajax_request' );
function share_market_data_ajax_request(){
    $data = $_REQUEST['data'];
    $page = $data['page'];
    $indexCode = $data['indexCode'];
    $data['acc_companyLists']=get_acc_companyLists();
    $page_id =($data['pageID'])? $data['pageID']: get_the_ID();
    if($page == 'chart'){
        $section_title= get_post_meta($page_id,'graph_section_title',true);
        $section_content= get_post_meta($page_id,'graph_section_content',true);
        $template = 'partials.ajax.share-market.chart';
    }
    if($page == 'sectors'){
        $section_title= get_post_meta($page_id,'sectors_section_title',true);
        $section_content= get_post_meta($page_id,'sectors_section_content',true);
        $apiExchg =($indexCode <100)?'BSE':'NSE';
        if(get_post_type($page_id) =='share-market'){
            if(has_term('gainers-losers', 'sm-category', $page_id)){
                $indicesStocks =array();
                $intra_day ='1D';
                $sectors_gl ='G';
                $apiExchg ='NSE';
                $sort ='Desc';
                $sortby ='CHANGE';
                $indexFilterOpt = get_post_meta($page_id, 'indices_code', true );
                if($indexFilterOpt){
                    $indexCodeRep = explode('_', $indexFilterOpt);
                    if(isset($indexCodeRep[0])){
                        $apiExchg = @$indexCodeRep[0];
                    }
                    if(isset($indexCodeRep[1])){
                        $sectors_gl = @$indexCodeRep[1];
                    }
                    if(isset($indexCodeRep[2])){
                        $intra_day = @$indexCodeRep[2];
                    }
                }
                if($sectors_gl =='L'){
                    $sort ='Asc';
                    $sortby ='CHANGE';
                }
                $indexCodes='1';
                if($apiExchg =='NSE'){
                    $indexCodes='123';
                }
                $url ="https://stock.accordwebservices.com/Stock/GetGainerLoserIndex?Exchg=".$apiExchg."&IndexCode=".$indexCodes."&Opt=".$sectors_gl."&Period=".$intra_day."&PageNo=1&PageSize=20&SortExp=".$sortby."&SortDirection=".$sort;
                $resposeArray =get_api_response_curl($url);  
                $totalPage =1;
                if(@$resposeArray->status_code == 200){
                   $indicesStocks= (array) $resposeArray->Table;
                   $totalPage=@$resposeArray->Table1[0]->TotalRows;
                }
                
                $data['gainerLoserFilter']=get_gainersLosorsListPost();
                $data['indicesFilter']=get_indicesListPost();
                $data['indicesStocks']=$indicesStocks;
                $data['apiExchg']=$apiExchg;
                $data['sectors_gl']=$sectors_gl;
                $data['intra_day']=$intra_day;
                $data['page_id']=$page_id;
                $data['totalPage']=$totalPage;
                $data['indexCodes']=$indexCodes;
                $template = 'partials.ajax.share-market.gainar-losors.sectors'; 
            }elseif(has_term('high-low', 'sm-category', $page_id)){
                $indicesStocks =array();
                $intra_day ='1W';
                $sectors_gl ='L';
                $apiExchg ='NSE';
                $sort ='Desc';
                $sortby ='CHANGE';
                $indexFilterOpt = get_post_meta($page_id, 'indices_code', true );
                if($indexFilterOpt){
                    $indexCodeRep = explode('_', $indexFilterOpt);
                    if(isset($indexCodeRep[0])){
                        $apiExchg = @$indexCodeRep[0];
                    }
                    if(isset($indexCodeRep[1])){
                        $sectors_gl = @$indexCodeRep[1];
                    }
                    if(isset($indexCodeRep[2])){
                        $intra_day = @$indexCodeRep[2];
                    }
                }
                $indicesCode = '';
                if($sectors_gl =='L'){
                    $sort ='Asc';
                    $sortby ='CHANGE';
                }

                $url="https://stock.accordwebservices.com/Stock/GethighLowIndex?Exchg=".$apiExchg."&IndexCode=&Opt=".$sectors_gl."&Period=".$intra_day."&PageNo=1&PageSize=20&SortExp=&SortDirection=";
                $resposeArray =get_api_response_curl($url);  
                $totalPage =1;
                if(@$resposeArray->status_code == 200){
                   $indicesStocks= (array) $resposeArray->Table;
                   $totalPage=@$resposeArray->Table1[0]->TotalRows;
                }
  
                $gainerLoserFilter= get_highLowListPost();
                $indicesFilter= get_indicesListPost();
                $data['gainerLoserFilter']=$gainerLoserFilter;
                $data['indicesFilter']=$indicesFilter;
                $data['indicesStocks']=$indicesStocks;
                $data['apiExchg']=$apiExchg;
                $data['sectors_gl']=$sectors_gl;
                $data['intra_day']=$intra_day;
                $data['page_id']=$page_id;
                $data['totalPage']=$totalPage;
                $template = 'partials.ajax.share-market.high-low.sectors'; 
            }else{
                $indicesStocks =array();
                $stock_order =(@$_REQUEST['stock_order'])?@$_REQUEST['stock_order']:'';
                $url ="https://stock.accordwebservices.com/Stock/GetIndicesCompanyData?Exchg=&Indexcode=".$indexCode."&SortExp=CHANGE&Sortdirection=Desc";
                $resposeArray =get_api_response_curl($url);  
                if(@$resposeArray->status_code == 200){
                    $indicesStocks= (array) @$resposeArray->Table;
                }
                $data['indicesStocks']=$indicesStocks;
                $data['stock_order']=$stock_order;
                $template = 'partials.ajax.share-market.indices.sectors';
            }
        }else{
            $GLResponse =array();
            $type ='Gain';
            // $apiExchg ='NSE';
            $intra_day ='Daily';

             $url ="http://stock.accordwebservices.com/Stock/GetGainersAndLosers?Exchange=".$apiExchg."&Group=A&Type=".$type."&Indices=".$indexCode."&Option=&Period=".$intra_day."&PageNo=1&Pagesize=10&SortExpression=OPEN_PRICE&SortDirect=Desc";
              $resposeArray =get_api_response_curl($url);  
            if(@$resposeArray->status_code == 200){
               $GLResponse= (array) $resposeArray->Table;
            } 
            $data['apiExchg']=$apiExchg;
            $data['GLResponse']=$GLResponse;
            $data['intra_day']=$intra_day;
            $data['type']=$type;
            $indicesFilter= get_indicesListPost();
            $data['indicesFilter']=$indicesFilter;
            $template = 'partials.ajax.share-market.sectors';
        }

        
        
    }
    if($page == 'return-calculator'){
         $section_title= get_post_meta($page_id,'return_calculator_section_title',true);
        $section_content= get_post_meta($page_id,'return_calculator_section_content',true);
        $template = 'partials.ajax.share-market.return-calculator';
    }
    // echo $template;
    $data['section_title']=$section_title;
    $data['section_content']=$section_content;
    echo \App\template($template, $data);
    die();
}
/*--------------------------------------------------------
/*      Indices Filter on single indices category page
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_share_market_indices_filter',  __NAMESPACE__ . '\\get_share_market_indices_filter' );
add_action( 'wp_ajax_nopriv_get_share_market_indices_filter',  __NAMESPACE__ . '\\get_share_market_indices_filter' );
 
function get_share_market_indices_filter() {
    $acc_companyLists=get_acc_companyLists();
    $indexCode =(@$_REQUEST['indexCode'])?@$_REQUEST['indexCode']:'';
    $stock_order =(@$_REQUEST['stock_order'])?@$_REQUEST['stock_order']:'';
    $url ="https://stock.accordwebservices.com/Stock/GetIndicesCompanyData?Exchg=&Indexcode=".$indexCode."&SortExp=CHANGE&Sortdirection=Desc";
    $resposeArray =get_api_response_curl($url);  
    if(@$resposeArray->status_code == 200){
        $indicesStocks= (array) @$resposeArray->Table;
    }
    $template = 'partials.ajax.share-market.share-market-indices-filter';
    // echo $template;
    $data['section_title']=$section_title;
    $data['indicesStocks']=$indicesStocks;
    $data['stock_order']=$stock_order;
    $data['acc_companyLists']=$acc_companyLists;
    echo \App\template($template, $data);
    die();
    
}

/*--------------------------------------------------------
/*      Indices Filter on single indices category page
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_share_market_all_sector_gainer_looser',  __NAMESPACE__ . '\\get_share_market_all_sector_gainer_looser' );
add_action( 'wp_ajax_nopriv_get_share_market_all_sector_gainer_looser',  __NAMESPACE__ . '\\get_share_market_all_sector_gainer_looser' );

function get_share_market_all_sector_gainer_looser() {
    $acc_companyLists=get_acc_companyLists();
    $apiExchg =(@$_REQUEST['apiExchg'])?@$_REQUEST['apiExchg']:'NSE';
    $intra_day =(@$_REQUEST['intra_day'])?@$_REQUEST['intra_day']:'1D';
    $sectors_gl =(@$_REQUEST['sectors_gl'])?@$_REQUEST['sectors_gl']:'G';
    $page_no =(@$_REQUEST['page_no'])?@$_REQUEST['page_no']:'1';
    $indices_index =(@$_REQUEST['indices_index'])?@$_REQUEST['indices_index']:'123';
    $sort ='Desc';
    $sortby ='CHANGE';
    if($sectors_gl =='L'){
        $sort ='Asc';
        $sortby ='CHANGE';
    }
    $indices_index =(@$indices_index =='All')?'':@$indices_index;
    $url ="https://stock.accordwebservices.com/Stock/GetGainerLoserIndex?Exchg=".$apiExchg."&IndexCode=".$indices_index."&Opt=".$sectors_gl."&Period=".$intra_day."&PageNo=".$page_no."&PageSize=20&SortExp=".$sortby."&SortDirection=".$sort;
    $resposeArray =get_api_response_curl($url);  
    $totalPage =1;
    if(@$resposeArray->status_code == 200){
       $indicesStocks= (array) $resposeArray->Table;
       $totalPage=@$resposeArray->Table1[0]->TotalRows;
    } 
    $template = 'partials.ajax.share-market.gainar-losors.share-market-gainar-losors-filter';
    // echo $template;
    $data['indicesStocks']=$indicesStocks;
    $data['totalPage']=$totalPage;
    $data['page_no']=$page_no;
    $data['acc_companyLists']=$acc_companyLists;
    
    $data['apiExchg']=$apiExchg;
    $data['sectors_gl']=$sectors_gl;
    $data['indices_index']=$indices_index;
    $data['intra_day']=$intra_day;
    //print_r($data);
    echo \App\template($template, $data);
    die();
    
}
/*--------------------------------------------------------
/*      Indices Filter on single High Low category page
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_share_market_all_sector_high_low',  __NAMESPACE__ . '\\get_share_market_all_sector_high_low' );
add_action( 'wp_ajax_nopriv_get_share_market_all_sector_high_low',  __NAMESPACE__ . '\\get_share_market_all_sector_high_low' );
 
function get_share_market_all_sector_high_low() {
    $acc_companyLists=get_acc_companyLists();
    $apiExchg =(@$_REQUEST['apiExchg'])?@$_REQUEST['apiExchg']:'NSE';
    $intra_day =(@$_REQUEST['intra_day'])?@$_REQUEST['intra_day']:'1W';
    $sectors_gl =(@$_REQUEST['sectors_gl'])?@$_REQUEST['sectors_gl']:'H';
    $page_no =(@$_REQUEST['page_no'])?@$_REQUEST['page_no']:'1';
    $indices_index =(@$_REQUEST['indices_index'])?@$_REQUEST['indices_index']:'123';
    $sort ='Desc';
    $sortby ='CHANGE';
    if($sectors_gl =='L'){
        $sort ='Asc';
        $sortby ='CHANGE';
    }
    $indices_index =(@$indices_index =='All')?'':@$indices_index;
    $url="https://stock.accordwebservices.com/Stock/GethighLowIndex?Exchg=".$apiExchg."&IndexCode=".$indices_index."&Opt=".$sectors_gl."&Period=".$intra_day."&PageNo=".$page_no."&PageSize=20&SortExp=&SortDirection=";
    $resposeArray =get_api_response_curl($url);  
    $totalPage =1;
    if(@$resposeArray->status_code == 200){
       $indicesStocks= (array) $resposeArray->Table;
       $totalPage=@$resposeArray->Table1[0]->TotalRows;
    }
    $template = 'partials.ajax.share-market.high-low.share-market-high-low-filter';
    // echo $template;
    $data['indicesStocks']=$indicesStocks;
    $data['totalPage']=$totalPage;
    $data['page_no']=$page_no;
    $data['acc_companyLists']=$acc_companyLists;
    $data['apiExchg']=$apiExchg;
    $data['sectors_gl']=$sectors_gl;
    $data['indices_index']=$indices_index;
    //print_r($data);
    echo \App\template($template, $data);
    die();
    
}
/*--------------------------------------------------------
/*                      Company Page Ajax Api Call      
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_company_list',  __NAMESPACE__ . '\\get_company_list' );
add_action( 'wp_ajax_nopriv_get_company_list',  __NAMESPACE__ . '\\get_company_list' );
function get_company_list() {

    $SearchTxtArray =($_REQUEST['SearchTxt'])?$_REQUEST['SearchTxt']:'';
    $SearchTxt = @$_REQUEST['SearchTxt'];
    $ajaxResponseTest='<option value="">Select company / stock name</option>';
    if($SearchTxt){
        $url ="https://company.accordwebservices.com/Company/GetCompanyList?SearchTxt=".$SearchTxt;
        $resposeArray =get_api_response_curl($url);  
        if(@$resposeArray->status_code == 200){
            $searchResponse= (array) $resposeArray->Table;
            foreach ($searchResponse as $key => $rowObj) {
                $ajaxResponse[]=array(
                    'id'=>$rowObj->FINCODE,
                    'text'=>$rowObj->S_Name
                );
                $ajaxResponseTest .='<option value="'.$rowObj->FINCODE.'">'.$rowObj->S_Name.'</option>';
            }
        }else{
          $ajaxResponse['status'] = 'error';
        } 
    }else{
        $ajaxResponse['status'] = 'error';
    }
    echo  $ajaxResponseTest;
    exit;
}
/*--------------------------------------------------------
/*                      Company Page Ajax Api Call      
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_return_price_calculator',  __NAMESPACE__ . '\\get_return_price_calculator' );
add_action( 'wp_ajax_nopriv_get_return_price_calculator',  __NAMESPACE__ . '\\get_return_price_calculator' );
function get_return_price_calculator() {

    $amount =($_REQUEST['amount'])?$_REQUEST['amount']:'';
    $period =($_REQUEST['period'])?$_REQUEST['period']:'';
    $apiExchg =(@$_REQUEST['apiExchg'])?@$_REQUEST['apiExchg']:'NSE';
    $finCode =(@$_REQUEST['finCode'])?@$_REQUEST['finCode']:'';
    if($apiExchg){
        $url ="https://company.accordwebservices.com/Company/GetStockReturnsWithPrice?Exchg=".$apiExchg."&Fincode=".$finCode."&Period=".$period; 
        $resposeArray =get_api_response_curl($url);  
        if(@$resposeArray->status_code == 200){
            $searchResponse= (array) $resposeArray->Table;

            $currentData= @$searchResponse[0];
            $pastData= @$searchResponse[1];
            $calResult =0;
            $labC='text-red';
            $resStatus='Loss';
            $totalAmount =$amount;
            if(@$currentData->CLOSE && @$pastData->CLOSE){
                $calResult = (($currentData->CLOSE - $pastData->CLOSE)/$pastData->CLOSE) *100;
                $calResult =number_format($calResult,2);
                $cAmount = ($amount*$calResult)/100;
                $totalAmount = ($amount+$cAmount);
                if($calResult>0){
                    $labC='text-success';
                    $resStatus='Profit';
                }else{
                    $labC='text-red';
                    $resStatus='Loss';
                } 
            }
            
            $ajaxResponse['apiresp'] =$searchResponse;
            $ajaxResponse['result'] ='My investment would be worth <span class="text-blue"> Rs '.number_format($totalAmount,2).'</span> with a '.$resStatus.' of <span class="'.$labC.'"> '.number_format($calResult,2).'%</span>';
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