<?php

namespace App;


/**
 * Add favicon to head
 */
add_action('wp_head', function () {
    ?>
    	<link rel="apple-touch-icon" sizes="180x180" href=" <?php asset_path('images/apple-touch-icon.png') ?> " >
    	<link rel="icon" type="image/png" sizes="32x32" href=" <?php asset_path('images/favicon-32x32.png') ?> " >
    	<link rel="icon" type="image/png" sizes="16x16" href=" <?php asset_path('images/favicon-16x16.png') ?> " >
    <?php
});

/**
 * Deragister styles and scripts
 */
add_action( 'wp_enqueue_scripts', function () {
    	
        //styles
        wp_dequeue_style( 'contact-form-7' );

    	//scripts
    	wp_dequeue_script( 'contact-form-7');
 });

/**
 * Ajax
 */
add_action( 'wp_ajax_icon_slider_data_ajax_request',  __NAMESPACE__ . '\\icon_slider_data_ajax_request' );
add_action( 'wp_ajax_nopriv_icon_slider_data_ajax_request',  __NAMESPACE__ . '\\icon_slider_data_ajax_request' );
function icon_slider_data_ajax_request() {
    $resonse = [];
    if ( isset($_REQUEST) ):

        $id =  @$_REQUEST['ID'];
        $nonce =  @$_REQUEST['nonce'];

        if ( ! wp_verify_nonce( $nonce, 'gloabltop10stockbroker' ) ) {
            die( __( 'Security check', 'top10stockbroker' ) ); 
        }

        $loopid = 0;
        if( have_rows('quiker_data', $id ) ):
            while( have_rows('quiker_data',$id) ): the_row(); 

                $title = get_sub_field('title');
                $image_upload = get_sub_field('icon');
                $link_url = get_sub_field('link');
                $loopid++;

                $resonse[] = array(
                    'id' => $loopid,
                    'title' => $title, 
                    'image_upload' => $image_upload, 
                    'link_url' => $link_url, 
                );

            endwhile;
        endif;
    endif;
    echo json_encode($resonse);
    die();
}

add_action( 'wp_ajax_brokercomparison_link_ajax_request',  __NAMESPACE__ . '\\brokercomparison_link_ajax_request' );
add_action( 'wp_ajax_nopriv_brokercomparison_link_ajax_request',  __NAMESPACE__ . '\\brokercomparison_link_ajax_request' );
function brokercomparison_link_ajax_request() {
    if ( isset($_REQUEST) ):
        $data = $_REQUEST['data'];
        $nonce =  @$data['security'];
        $paged = @$data['page_paths'];
        
        // if ( ! wp_verify_nonce( $nonce, 'gloabltop10stockbroker' ) ) {
        //     die( __( 'Security check', 'top10stockbroker' ) ); 
        // }

        foreach( $paged as $page_path ) {
            if(!$page = get_page_by_path( $page_path ,OBJECT, 'broker-comparison')){
            } else{
                echo $get_page_url =  get_permalink( $page->ID ) ;
                wp_die();
                break;
            }  
        
        }
    endif;
    wp_die();
}

add_action( 'wp_ajax_goldsilver_investment_calculator',  __NAMESPACE__ . '\\goldsilver_investment_calculator' );
add_action( 'wp_ajax_nopriv_goldsilver_investment_calculator',  __NAMESPACE__ . '\\goldsilver_investment_calculator' );
function goldsilver_investment_calculator() {
    global $wpdb;
    $type = @$_REQUEST['type'];
    $p_id = @$_REQUEST['p_id'];
    $carat = @$_REQUEST['carat'];
    $g_invest = @$_REQUEST['g_invest'];
    $g_timeline = @$_REQUEST['g_timeline'];
    $prcdate ='';

    switch ($g_timeline) {
        case '1W':
            $prcdate =date("Y-m-d", strtotime("-7 days"));
            break;
        case '2W':
            $prcdate =date("Y-m-d", strtotime("-14 days"));
            break;
        case '3W':
            $prcdate =date("Y-m-d", strtotime("-21 days"));
            break;
        case '1M':
            $prcdate =date("Y-m-d", strtotime("-30 days"));
            break;
        case '3M':
            $prcdate =date("Y-m-d", strtotime("-3 month"));
            break;
        case '6M':
            $prcdate =date("Y-m-d", strtotime("-6 month"));
            break;
        case '9M':
            $prcdate =date("Y-m-d", strtotime("-9 month"));
            break;
        case '1Y':
            $prcdate =date("Y-m-d", strtotime("-365 month"));
            break;
        default:
            $prcdate =date("Y-m-d", strtotime("-30 days"));
            break;
    }

    $cData = date('Y-m-d');
    
    $c_val =  $wpdb->get_row("SELECT * FROM gold_silver_rate  WHERE `page_id` = {$p_id} and `type` = '{$type}' AND date='{$cData}' LIMIT 1");
    $gs_val =  $wpdb->get_row("SELECT * FROM gold_silver_rate  WHERE `page_id` = {$p_id} and `type` = '{$type}' AND date='{$prcdate}' LIMIT 1");

    $goldUnits =0;
    $netWorth =0;
    $totalProLoss =0;
    $totalProLossPre =0;
    $currentRate =0;

    if($gs_val){
        if($carat == 22){
            $currentRate = @$c_val->t22_1_rate;
            $timeLineRate = @$gs_val->t22_1_rate;
        }else{
            $currentRate = @$c_val->t24_1_rate;
            $timeLineRate = @$gs_val->t24_1_rate;
             
        }
        $goldUnits = @(number_format(($g_invest/$timeLineRate) ,2));
        $netWorth = @(number_format(($goldUnits * $currentRate),2));
        $totalProLoss = @(number_format($goldUnits * ($currentRate - $timeLineRate),2));
        $totalProLossPre=@(number_format((($totalProLoss/$g_invest)*100),2));

        $data['netWorth'] = @$netWorth;

        if($totalProLoss >= 0){
            $data['plClass'] = 'green';
            $data['plText'] = 'Profit';
        }else{
            $data['plClass'] = 'red';
            $data['plText'] = 'Loss';
        }
        if($totalProLossPre >= 0){
            $data['plpClass'] = 'green';
            $data['plpText'] = 'Profit(%) ';
        }else{
            $data['plpClass'] = 'red';
            $data['plpText'] = 'Loss(%)';
        }

    }

    $template = 'partials.ajax.gold-silver-investment-calculator-data';
    echo \App\template($template, $data);
    die();
}

add_action( 'wp_ajax_gold_rate_comparison_calculate',  __NAMESPACE__ . '\\gold_rate_comparison_calculate' );
add_action( 'wp_ajax_nopriv_gold_rate_comparison_calculate',  __NAMESPACE__ . '\\gold_rate_comparison_calculate' );
function gold_rate_comparison_calculate() {
    global $wpdb;

    $type = @$_REQUEST['type'];
    $p_id1 = @$_REQUEST['p_id1'];
    $p_id2 = @$_REQUEST['p_id2'];
    $p_id3 = @$_REQUEST['p_id3'];
    $carat = @$_REQUEST['carat'];
    $g_invest = @$_REQUEST['g_invest'];
    $g_timeline = @$_REQUEST['g_timeline'];

    $cities = get_GoldCityStateLists();
    $prcdate ='';
    if($p_id1)
        $p_id[] =$p_id1;
    if($p_id2)
        $p_id[] =$p_id2;
    if($p_id3)
        $p_id[] =$p_id3;
    switch ($g_timeline) {
        case '1W':
            $prcdate =date("Y-m-d", strtotime("-7 days"));
            break;
        case '2W':
            $prcdate =date("Y-m-d", strtotime("-14 days"));
            break;
        case '3W':
            $prcdate =date("Y-m-d", strtotime("-21 days"));
            break;
        case '1M':
            $prcdate =date("Y-m-d", strtotime("-30 days"));
            break;
        case '3M':
            $prcdate =date("Y-m-d", strtotime("-3 month"));
            break;
        case '6M':
            $prcdate =date("Y-m-d", strtotime("-6 month"));
            break;
        case '9M':
            $prcdate =date("Y-m-d", strtotime("-9 month"));
            break;
        case '1Y':
            $prcdate =date("Y-m-d", strtotime("-365 month"));
            break;
        default:
            $prcdate =date("Y-m-d", strtotime("-30 days"));
            break;
    }
    $cData=date('Y-m-d');
    $priceRes =array();
    $type = 1;
    foreach ($p_id as $key => $value) {

        $c_val =  $wpdb->get_row("SELECT * FROM gold_silver_rate  WHERE `page_id` = {$value} and `type` = '{$type}' AND date='{$cData}' LIMIT 1");
        $gs_val =  $wpdb->get_row("SELECT * FROM gold_silver_rate  WHERE `page_id` = {$value} and `type` = '{$type}' AND date='{$prcdate}' LIMIT 1");
        if($gs_val){
            if($carat == 22){
                $currentRate =@$c_val->t22_1_rate;
                $timeLineRate =@$gs_val->t22_1_rate;
            }else{
                $currentRate =@$c_val->t24_1_rate;
                $timeLineRate =@$gs_val->t24_1_rate;
                 
            }
        }

        $goldUnits = ($g_invest/ $timeLineRate);
        $netWorth = @(number_format(($goldUnits * $currentRate),2));
        $priceRes[$key] =array(
            'currentRate'=>$c_val,
            'timeLineRate'=>$gs_val,
            'netWorth'=>$netWorth
        );
        $data['g_invest'] = $g_invest;
        $data['priceRes'] = $priceRes;
        $data['p_id'] = $p_id;
        $data['cities'] = $cities;
    }

    $template = 'partials.ajax.gold-rate-comparison-calculate-data';
    echo \App\template($template, $data);
    die();
}

add_action( 'wp_ajax_modal_popup',  __NAMESPACE__ . '\\modal_popup' );
add_action( 'wp_ajax_nopriv_modal_popup',  __NAMESPACE__ . '\\modal_popup' );
function modal_popup() {

    $nonce =  @$_REQUEST['security'];
    $data['hello_bar'] =  @$_REQUEST['hello_bar'];
    $model_auto =  @$_REQUEST['model_auto'];
    $data['post_id'] =  @$_REQUEST['post_id'];
    $data['contactform'] =  @$_REQUEST['contactform'];
    $data['model_action'] =  @$_REQUEST['model_action'];
    $data['form_left_content'] =  @$_REQUEST['form_left_content'];
    $data['form_right_content'] =  @$_REQUEST['form_right_content'];
    $data['form_mobile_content'] =  @$_REQUEST['form_mobile_content'];
    $data['auto_popup_left_content'] =  @$_REQUEST['auto_popup_left_content'];
    $data['auto_popup_right_content'] =  @$_REQUEST['auto_popup_right_content'];
    $data['auto_popup_mobile_content'] =  @$_REQUEST['auto_popup_mobile_content'];
    $data['custom_hellobar'] =  @$_REQUEST['custom_hellobar'];

    
    $shortcode_contactform = $data['contactform'];
    
    $data['auto_status'] = $model_auto;

    switch ($data['model_action']) {
        case 'custom-hellobar':
            $template = 'partials.ajax.modalpopup';
            break;
        case 'mbf-search-wrap':
            $template = 'partials.ajax.modalpopup-mdf-search';
            break;
        default:
            if(@$data['hello_bar'] == 'yes'){ 
                $template = 'partials.ajax.modalpopup-default';
                $shortcode_contactform = '[contact-form-7 id="5057" title="Default PopUp Contact Form"]';
            }else{
                $template = 'partials.ajax.modalpopup-demat-default';
                $shortcode_contactform = '[contact-form-7 id="5056" title="DEMAT PopUp Contact Form"]';
            }
            break;
    }

    $data['do_contactform'] = get_post_meta( $data['post_id'], $shortcode_contactform, true );

    echo \App\template($template, $data);
    die();
}




add_action("wp_ajax__load_city_list", function (){
    $parent_term_id =($_REQUEST['parent_term_id'])?$_REQUEST['parent_term_id']:0;
    $locationIds= get_term_meta($parent_term_id, 'broker_locations_ids',true);
    $locationsHtml ='<option data-slug="" value="">Select City</option>';
    if($locationIds){
        $locations = get_terms( 'locations', array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => true,
            'include' =>(is_array($locationIds))?$locationIds:explode(',', $locationIds),
        ));
        if($locations){
            foreach ($locations as $key => $value) {
                $locationsHtml.='<option data-slug="'.$value->slug.'" value="'.$value->term_id.'">'.$value->name.'</option>';
            }
        }
    }
    echo $locationsHtml;
    exit;
});
add_action("wp_ajax_nopriv__load_city_list", function (){
    $parent_term_id =($_REQUEST['parent_term_id'])?$_REQUEST['parent_term_id']:0;
    $locationIds= get_term_meta($parent_term_id, 'broker_locations_ids',true);
    $locationsHtml ='<option data-slug="" value="">Select City</option>';
    if($locationIds){
        $locations = get_terms( 'locations', array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => true,
            'include' =>(is_array($locationIds))?$locationIds:explode(',', $locationIds),
        ));
        if($locations){
            foreach ($locations as $key => $value) {
                $locationsHtml.='<option data-slug="'.$value->slug.'" value="'.$value->term_id.'">'.$value->name.'</option>';
            }
        }
    }
    echo $locationsHtml;
    exit;
});

 
// add_action("wp_ajax_market_data_ajax_request", function (){
//     $data = $_REQUEST['data'];
//     echo $page = $data['page'];
//     $page_id =($data['pageID'])? $data['pageID']: get_the_ID();
//     if($page == 'chart'){
//         $section_title= get_post_meta($page_id,'graph_section_title',true);
//         $section_content= get_post_meta($page_id,'graph_section_content',true);
//         $template = 'partials.ajax.share-market.chart';
//     }
//     if($page == 'sectors'){
//          $section_title= get_post_meta($page_id,'sectors_section_title',true);
//         $section_content= get_post_meta($page_id,'sectors_section_content',true);
//         $template = 'partials.ajax.share-market.sectors';
//     }
//     if($page == 'return-calculator'){
//          $section_title= get_post_meta($page_id,'return_calculator_section_title',true);
//         $section_content= get_post_meta($page_id,'return_calculator_section_content',true);
//         $template = 'partials.ajax.share-market.return-calculator';
//     }
//     $data['section_title']=$section_title;
//     $data['section_content']=$section_content;
//     echo \App\template($template, $data);
//     die();
// });
add_action("wp_ajax_nopriv_market_data_ajax_request", function (){
    $data = $_REQUEST['data'];
    // print_r($data);
    $page = $data['page'];
    $indexCode = $data['indexCode'];
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
    if($page == 'return-calculator'){
         $section_title= get_post_meta($page_id,'return_calculator_section_title',true);
        $section_content= get_post_meta($page_id,'return_calculator_section_content',true);
        $template = 'partials.ajax.share-market.return-calculator';
    }
    
    $data['section_title']=$section_title;
    $data['section_content']=$section_content;
    echo \App\template($template, $data);
    die();
});

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
/*                      Company Page Ajax Api Call      
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_company_list',  __NAMESPACE__ . '\\get_company_list' );
add_action( 'wp_ajax_nopriv_get_company_list',  __NAMESPACE__ . '\\get_company_list' );
function get_company_list() {

    $SearchTxtArray =($_REQUEST['SearchTxt'])?$_REQUEST['SearchTxt']:'';
    $SearchTxt = @$SearchTxtArray['term'];
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

    // echo json_encode($ajaxResponse);
    // echo \App\template($template, $data);
    // die();
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
/**--------------------------------------------------------------
 * File include to create Taxonomy And Meta Box for cpts.
 /---------------------------------------------------------------*/
include 'taxonomy-and-meta-boxes.php';






