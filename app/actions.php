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