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
        // wp_dequeue_style( 'contact-form-7' );
        //scripts
        // wp_dequeue_script( 'contact-form-7');
 });

/**
 * Load Side Bar.
 */
add_action( 'wp_ajax_load_side_bar',  __NAMESPACE__ . '\\load_side_bar' );
add_action( 'wp_ajax_nopriv_load_side_bar',  __NAMESPACE__ . '\\load_side_bar' );
function load_side_bar() {
    // @if (App\display_sidebar() && !$is_mobile)
    // @endif
    dynamic_sidebar('sidebar-primary');
    exit; 
}

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
        // $data = $_REQUEST['data'];
        $data = $_REQUEST;
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
            $prcdate =date("Y-m-d", strtotime("-12 month"));
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

        $data['netWorth'] = (@$netWorth)?@$netWorth:'0.0';
        $data['totalProLoss'] = (@$totalProLoss)?@$totalProLoss:'0.0';
        $data['totalProLossPre'] = (@$totalProLossPre)?@$totalProLossPre:'0.0';
        
        if($totalProLoss >= 0){
            $data['plClass'] = 'text-success';
            $data['plText'] = 'Profit';
        }else{
            $data['plClass'] = 'text-danger';
            $data['plText'] = 'Loss';
        }
        if($totalProLossPre >= 0){
            $data['plpClass'] = 'text-success';
            $data['plpText'] = 'Profit(%) ';
        }else{
            $data['plpClass'] = 'text-danger';
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
            $prcdate =date("Y-m-d", strtotime("-12 month"));
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
/*****************************************************************
                    Gold Rate  Investment Comparison
******************************************************************/


add_action("wp_ajax_gold_silver_unit_compare_calculate_jfunc",   __NAMESPACE__ . '\\gold_silver_unit_compare_calculate_jfunc');
add_action("wp_ajax_nopriv_gold_silver_unit_compare_calculate_jfunc",   __NAMESPACE__ . '\\gold_silver_unit_compare_calculate_jfunc');

function gold_silver_unit_compare_calculate_jfunc(){
    global $wpdb;
    $p_id1 = @$_REQUEST['p_id1'];
    $p_id2 = @$_REQUEST['p_id2'];
    $p_id3 = @$_REQUEST['p_id3'];
    $type = @$_REQUEST['type'];
    $carat = @$_REQUEST['carat'];
    $unit = @$_REQUEST['unit'];
    $unit_type = @$_REQUEST['unit_type'];
    $g_timeline = @$_REQUEST['g_timeline'];
    $p_ids =array();
    if($p_id1)
        $p_ids[] =$p_id1;
    if($p_id2)
        $p_ids[] =$p_id2;
    if($p_id2)
        $p_ids[] =$p_id3;
    if($type ==1){
        $cities =get_GoldCityStateLists();
    }else{
        $cities =get_SilverCityStateLists();
    }
    foreach ($p_ids as $key => $p_id) {
        if($g_timeline =='1D'){
            $crdateQue= "SELECT * FROM gold_silver_rate  WHERE `page_id` = ".$p_id. " and `type` = '".$type."'  ORDER BY date DESC  LIMIT 1";
        }else{
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
                    $prcdate =date("Y-m-d", strtotime("-12 month"));
                    break;
                default:
                    $prcdate =date("Y-m-d");
                    break;
            }
            $crdateQue="SELECT * FROM gold_silver_rate  WHERE `page_id` = ".$p_id. " and `type` = '".$type."' AND date='".$prcdate."' LIMIT 1";
        }
        $timeLinePriceobj =  $wpdb->get_row($crdateQue);
        $onegrmPrice=0;
        if($timeLinePriceobj){
            if($type ==1){
                if($carat == 22){
                    $onegrmPrice=@$timeLinePriceobj->t22_1_rate;
                }else{
                    $onegrmPrice =@$timeLinePriceobj->t24_1_rate;
                }
            }else{
                $onegrmPrice=@$timeLinePriceobj->t22_1_rate/10;
            }
            $totalAmount= getUnitConvertedAmount($unit,$unit_type,$onegrmPrice);
        }else{
            $totalAmount ="0.00";   
        } 
        $priceRes[$key] =array(
            'timeLineobj'=>$timeLinePriceobj,
            'timeLineRate'=>$totalAmount,
        );
    }
     
    $netw =0;
    $maxidx =0;
    foreach ($priceRes as $key => $value) {
        if($netw < @$value['timeLineRate']){
            $netw =@$value['timeLineRate'];
            $maxidx =$key;
        }
    }
    ?>

    <p style="text-align: center;">Here is the Gold Rate Comparison of 3 cities</p>
    <table>
        <tr>
            <th>&nbsp;</th>
            <?php if($p_id1){ ?>
                <th><?php echo  ucfirst(@$cities[$p_id1]); ?></th>
            <?php }
            if($p_id2){ ?>
                <th><?php echo  ucfirst(@$cities[$p_id2]); ?></th>
            <?php }
            if($p_id3){ ?>
            <th><?php echo  ucfirst(@$cities[$p_id3]); ?></th>
        <?php } ?>
        </tr>
        <tr>
            <td>
                <span style="font-size:25px;"> 
                    <?php 
                    $untString= $unit.' '.ucfirst($unit_type).' '.(($type==1)?'Gold':'Silver').' Price (Rs.)';
                echo $untString; ?>
                </span>
            </td>
            <?php
            foreach ($priceRes as $key => $value) {
                if($maxidx ==$key){
                    $plClass='style="color:green;"';
                }else{
                    $plClass='';
                }
                ?>
                <td <?php echo @$plClass; ?>>
                    <?php echo @$value['timeLineRate'];  ?>
                </td>
            <?php } ?>
        </tr>
    </table>
    <?php
    exit;
}
add_action( 'wp_ajax_modal_popup',  __NAMESPACE__ . '\\modal_popup' );
add_action( 'wp_ajax_nopriv_modal_popup',  __NAMESPACE__ . '\\modal_popup' );
function modal_popup() {
    global $wpdb;
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
    
    
    // $data['auto_status'] = $model_auto;
    if($data['model_action'] =='mini-popup'){
        $template = 'partials.ajax.modal-mini-popup';
        $modelClass =@$_REQUEST['model_auto'];
        switch ($modelClass) {
            case 'open-b2cpopup':
                $data['head_title']='Share your details & Open Demat A/C Now!';
                $data['btm_content']='Offer valid for limited time.';
                $shortcode_contactform = '[contact-form-7 id="17404" title="Image/Link Click - B2C Form"]';
                break;
            case 'open-b2bpopup':
                $data['head_title']='Share your details & Become Sub Broker Now!';
                $data['btm_content']='Offer valid for limited time.';
                $shortcode_contactform = '[contact-form-7 id="17405" title="Image/Link Click - B2B Form"]';
                break;
            case 'open-ipopopup':
                $data['head_title']='Share your details & Get IPO Allotment Now!';
                $data['btm_content']='Offer valid for limited time.';
                $shortcode_contactform = '[contact-form-7 id="17403" title="Image/Link Click - IPO Form"]';
                break;
            case 'open-pmspopup':
                $data['head_title']='Share your details & Invest in PMS Now!';
                $data['btm_content']='Offer valid for limited time.';
                $shortcode_contactform = '[contact-form-7 id="17402" title="Image/Link Click - PMS Form"]';
                break;
            default:
                $shortcode_contactform = '[contact-form-7 id="5056" title="DEMAT PopUp Contact Form"]';
                break;
        }
        
    }else{
        $data['auto_status'] = ($model_auto =='false')?false:true;
        switch ($data['model_action']) {
            case 'custom-hellobar':
                if($data['contactform']){
                    $template = 'partials.ajax.modalpopup';
                    $shortcode_contactform = get_post_meta( $data['post_id'], $shortcode_contactform, true );
                }else{
                    $template = 'partials.ajax.modalpopup-demat-default';
                    $shortcode_contactform = '[contact-form-7 id="5056" title="DEMAT PopUp Contact Form"]';
                }
                
                break;
            case 'mbf-search-wrap':
                 
                $template = 'partials.ajax.modalpopup-mdf-search';
                $data['do_contactform'] = get_post_meta( $data['post_id'], $shortcode_contactform, true );
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
    }
    $data['do_contactform'] = $shortcode_contactform;
    // print_r($template);
    // print_r($data);
    echo \App\template($template, $data);
    die();
}


/**
 * Load Share Market Page Template and Single Page Content
 * Through Ajax
 * @return array
 */
add_action( 'wp_ajax__load_city_list',  __NAMESPACE__ . '\\load_city_list' );
add_action( 'wp_ajax_nopriv__load_city_list',  __NAMESPACE__ . '\\load_city_list' );
function load_city_list(){
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
}
 
/**
 * Load Share Market Page Template and Single Page Content
 * Through Ajax
 * @return array
 */
add_action( 'wp_ajax_get_gold_silver_price_graph_data_',  __NAMESPACE__ . '\\get_gold_silver_price_graph_data' );
add_action( 'wp_ajax_nopriv_get_gold_silver_price_graph_data_',  __NAMESPACE__ . '\\get_gold_silver_price_graph_data' );

function get_gold_silver_price_graph_data() {
    global $wpdb;
    // $nonce = $_POST['nonce'];
    if ( isset($_REQUEST) ) {
        $cDate=date('Y-m-d');
        //$cDate=date("Y-m-d", strtotime("+1 days"));
        $dur = $_REQUEST['dur'];
        $postId = $_REQUEST['postId'];
         //$postId =52358;
        switch ($dur) {
            case '1D':
                $prcdate =date("Y-m-d", strtotime("-1 days"));
            break;
            case '1W':
                $prcdate =date("Y-m-d", strtotime("-7 days"));
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
            case '1Y':
                $prcdate =date("Y-m-d", strtotime("-365 days"));
            break; 
            case '2Y':
                $prcdate =date("Y-m-d", strtotime("-730 days"));
            break;
            case '5Y':
                $prcdate =date("Y-m-d", strtotime("-1825 days"));
            break;  
            case 'ALL':
                 $sql ="SELECT * FROM gold_silver_rate WHERE page_id= ".$postId ." order by date DESC;";
            break;  
            
            default:
                $dur ='ALL';
                $sql ="SELECT * FROM gold_silver_rate WHERE page_id= ".$postId ." order by date DESC;";
            break;
        }
        if($dur !='ALL'){
            $sql ="SELECT * FROM gold_silver_rate WHERE page_id= ".$postId ." AND type = 1 AND ( date  >= '".$prcdate."' AND date <= '".$cDate."' ) order by date DESC;";
        }
        
        // echo $sql;
        $priceResults = $wpdb->get_results($sql);
        // print_r($priceResults);
        foreach ($priceResults as $key => $rowObj) {
            if($dur == '1D'|| $dur =='1W'){
                $data[] =array(
                    'date'=>date('Y-m-d-H-i',strtotime($rowObj->date)),
                    'price'=>$rowObj->t22_1_rate,
                    'open'=>$rowObj->t22_1_rate,
                    'high'=>$rowObj->t24_1_rate,
                    'low'=>$rowObj->t22_1_rate,
                    'volume'=>$rowObj->t22_1_rate,
                    'value'=>$rowObj->t24_1_rate,
                );
            }else{

             $data[] =array(
                    'date'=>date('Y-m-d',strtotime($rowObj->date)),
                    'price'=>$rowObj->t22_1_rate,
                    'open'=>$rowObj->t22_1_rate,
                    'high'=>$rowObj->t24_1_rate,
                    'low'=>$rowObj->t22_1_rate,
                    'volume'=>$rowObj->t22_1_rate,
                    'value'=>$rowObj->t24_1_rate,
                );
            }

        }
        $chartResponse['g1']= $data;
        $chartResponse['newsdata']=null;
        $chartResponse['data']=null;
        // echo json_encode($chartResponse);
        echo json_encode($data);
        exit;
        
     }
    die();
}
 
 

/**--------------------------------------------------------------
 * File include Share Market Actions.
 /---------------------------------------------------------------*/
include 'cpts-action/share-market-actions.php';

/**--------------------------------------------------------------
 * File include Share Price Actions.
 /---------------------------------------------------------------*/
include 'cpts-action/share-price-actions.php';
  
/**----------------------------------------------------------
 * File include broker-calculator Actions.
 /----------------------------------------------------------*/
include 'cpts-action/broker-calculator-actions.php';

/**----------------------------------------------------------
 * Exteral Api Call On Different contact form submit.
 /---------------------------------------------------------*/
include 'cpts-action/external-api-functions-actions.php';
 

// Start Session 
function register_my_session()
{
  if( !session_id() ){
    session_start();
  }
}

add_action('init', __NAMESPACE__ . '\\register_my_session');

// define the comment_form_after_fields callback 
function action_comment_form_after_fields($fields) {
    $_SESSION['comment_captcha']['fv'] = rand(1,10);
    $_SESSION['comment_captcha']['lv'] = rand(1,10);
    $checkSign =['Addition','Multiplication'];
    // 'Subtraction',
    $_SESSION['comment_captcha']['cs'] = $checkSign[array_rand($checkSign)];
    $sign ='';
    $act_ans=0;
    switch ($_SESSION['comment_captcha']['cs']) {
        case 'Addition':
           $act_ans =($_SESSION['comment_captcha']['fv']+$_SESSION['comment_captcha']['lv']);
           $sign ='+';
            break;
        case 'Subtraction':
           $act_ans =($_SESSION['comment_captcha']['fv']-$_SESSION['comment_captcha']['lv']);
           $sign ='-';
            break;
        case 'Multiplication':
            $act_ans =($_SESSION['comment_captcha']['fv']*$_SESSION['comment_captcha']['lv']);
            $sign ='X';
            break;
        
    }
    $_SESSION['comment_captcha']['act_ans']=$act_ans;
    $captch_strimg =$_SESSION['comment_captcha']['fv'].' '. $sign .' '.$_SESSION['comment_captcha']['lv'] .' = ';
    $captch_strimg =' 24 + 9 = ';
    $_SESSION['comment_captcha']['act_ans'] =33;
    ?>
    <label>Captcha</label>
    <div class="form-group row">
        <div class="col-sm-2 text-center" for="ccs_ps_ans"><b><?php echo $captch_strimg; ?></b></div>
        <div class="col-sm-10">
            <input name="captcha_ans" type="number" class="form-control" placeholder="Enter Answer" style="border: 1px solid #EEE;" required="">
        </div>
    </div>
    <?php
    // echo  do_shortcode('[ccs_easy_captcha]') ;
    return $fields;
}
         

 // add the action 
 
add_action( 'comment_form_logged_in_after',  __NAMESPACE__ . '\\action_comment_form_after_fields' );
add_action( 'comment_form_after_fields',  __NAMESPACE__ . '\\action_comment_form_after_fields' );


function custom_validate_comment_url() {
    // echo '<pre>';
    // print_r($_SESSION['comment_captcha']);
    // print_r($_POST);
    $actualAns =$_SESSION['comment_captcha']['act_ans'];
    if(empty($_POST['captcha_ans'])){
         wp_die( __('Error: Please enter a valid captcha.'.'<br/><p><a href="javascript:history.back()">« Back</a></p>') );
    }
    if(trim($_POST['captcha_ans']) != $actualAns){
        wp_die( __('Error: Please enter a valid captcha.'.'<br/><p><a href="javascript:history.back()">« Back</a></p>') );
        // echo '<p><a href="javascript:history.back()">« Back</a></p>'
    }
}
add_action( 'pre_comment_on_post',  __NAMESPACE__ . '\\custom_validate_comment_url' );
 

 