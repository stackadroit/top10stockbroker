<?php
/*--------------------------------------------------------
/*     Action for checking  Broker Comparison Url
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_url',  __NAMESPACE__ . '\\get_url_for_broker_comparison' );
add_action( 'wp_ajax_nopriv_get_url',  __NAMESPACE__ . '\\get_url_for_broker_comparison' );

function get_url_for_broker_comparison() {
	$nonce =  @$_REQUEST['security'];
	if ( ! wp_verify_nonce( $nonce, 'gloabltop10stockbroker' ) ) {
      	die( __( 'Security check', 'top10stockbroker' ) ); 
   	}		
	$paged = $_POST['page_paths'];
	foreach( $paged as $page_path ) {
	    if( ! $page = get_page_by_path( $page_path ,OBJECT, 'broker-comparison')){
	    } else{
	      echo $get_page_url =  get_permalink( $page->ID ) ;
	        wp_die();
	        break;
	    }  
	}
	wp_die();
}
/*--------------------------------------------------------
/*     Action for Calculate Brokrage Profit and lass
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_broker_profit_loss_calculator',  __NAMESPACE__ . '\\get_broker_profit_loss_calculator' );
add_action( 'wp_ajax_nopriv_get_broker_profit_loss_calculator',  __NAMESPACE__ . '\\get_broker_profit_loss_calculator' );

function get_broker_profit_loss_calculator() {
	$nonce =  @$_REQUEST['security'];
	if ( ! wp_verify_nonce( $nonce, 'gloabltop10stockbroker' ) ) {
      	die( __( 'Security check', 'top10stockbroker' ) ); 
   	}		
	$data=array();
		$post_id =  @$_REQUEST['post_id'];
		$idx =  @$_REQUEST['idx'];
		$buy_price =  @$_REQUEST['buy_price'];
		$sell_price =  @$_REQUEST['sell_price'];
		$number_lot =  @$_REQUEST['number_lot'];
		$lot_size =  @$_REQUEST['lot_size'];
		$number_share =  @$_REQUEST['number_share'];
		$stamp_duty =  @$_REQUEST['stamp_duty'];
		$stt=get_option('stt');
        $gst=get_option('gst');
        $sebi=get_option('sebi');
        switch ($idx) {
        	case '1':
        		$transaction_charges = get_post_meta( $post_id, 'equity_delivery_tr', true );
        		$brokerage = get_post_meta( $post_id, 'equity_delivery', true );
        		$brokerage=explode("%",$brokerage);	
        		$brokerage_max = get_post_meta( $post_id, 'equity_delivery_max', true );
        		break;
        	case '2':
        		$transaction_charges = get_post_meta( $post_id, 'equity_intraday_tr', true );
        		$brokerage = get_post_meta( $post_id, 'equity_intraday', true );
        		$brokerage=explode("%",$brokerage);	
        		$brokerage_max = get_post_meta( $post_id, 'equity_intraday_max', true );
        		break;
        	case '3':
        		$transaction_charges = get_post_meta( $post_id, 'equity_futures_tr', true );
        		$brokerage = get_post_meta( $post_id, 'equity_futures', true );
        		$brokerage=explode("%",$brokerage);	
        		$brokerage_max = get_post_meta( $post_id, 'equity_futures_max', true );
        		break;
        	case '4':
        		$transaction_charges = get_post_meta( $post_id, 'equity_options_tr', true );
        		$brokerage = get_post_meta( $post_id, 'equity_options', true );
        		$brokerage=explode("%",$brokerage);	
        		$brokerage_max = get_post_meta( $post_id, 'equity_options_max', true );
        		break;
        	case '5':
        		$transaction_charges = get_post_meta( $post_id, 'currency_futures_tr', true );
        		$brokerage = get_post_meta( $post_id, 'currency_futures', true );
        		$brokerage=explode("%",$brokerage);	
        		$brokerage_max = get_post_meta( $post_id, 'currency_futures_max', true );
        		break;
        	case '6':
        		$transaction_charges = get_post_meta( $post_id, 'currency_options_tr', true );
        		$brokerage = get_post_meta( $post_id, 'currency_options', true );
        		$brokerage=explode("%",$brokerage);	
        		$brokerage_max = get_post_meta( $post_id, 'currency_options_max', true );
        		break;
        	case '7':
        		$transaction_charges = get_post_meta( $post_id, 'commodity_tr', true );
        		$brokerage = get_post_meta( $post_id, 'commodity', true );
        		$brokerage=explode("%",$brokerage);	
        		$brokerage_max = get_post_meta( $post_id, 'commodity_max', true );
        		break;
        	default:
        		# code...
        		break;
        }
        if($idx==4 || $idx==6){
	  		$total_turnover=($buy_price+$sell_price)*$number_lot*$lot_size;
	  	}else{
	  		$total_turnover=($buy_price+$sell_price)*$number_share;
	  	}
		$data['total_turnover'] =@number_format($total_turnover,3);
	  	if(isset($brokerage['1'])){
			$brokerage =$brokerage[0];
			$brokerage_turnover =$total_turnover*$brokerage/100;
		}else{
			if($idx==4 || $idx==6){
				$brokerage =$brokerage[0];
				$brokerage_turnover =$number_lot*$brokerage;
			}else{
				$brokerage =$brokerage[0];
				$brokerage_turnover =$brokerage;
			}
		}
	    if($brokerage_max > 0 && $brokerage_turnover > $brokerage_max){
		   $brokerage_turnover=$brokerage_max;
	  	}
	  	$data['brokerage_turnover'] =@number_format($brokerage_turnover,3);
	  	$sebi_to =$total_turnover*$sebi/100;
	  	$data['sebi_to'] =@number_format($sebi_to,3);
	  	$stt_to =$total_turnover*$stt/100;
	  	$data['stt_to'] =@number_format($stt_to,3);
	  	$stamp_duty_to =$total_turnover*$stamp_duty/100;
	  	$data['stamp_duty_to'] =@number_format($stamp_duty_to,3);
	  	$transaction_charges =$total_turnover*$transaction_charges/100;
	  	$data['transaction_charges'] =@number_format($transaction_charges,3);
	  	$gst_to =($brokerage_turnover+$transaction_charges)*$gst/100;
	  	$data['gst_to'] =@number_format($gst_to,3);
	  	$total_brokerage =$brokerage_turnover+$stt_to+$sebi_to+$stamp_duty_to+$transaction_charges+$gst_to;
	  	$data['total_brokerage'] =@number_format($total_brokerage,3);
      	if($idx==4 || $idx==6){
      		$total_profit =	$sell_price*$number_lot*$lot_size-($buy_price*$number_lot*$lot_size+$total_brokerage);
	  	}else{
	  		$total_profit =	$sell_price*$number_share-($buy_price*$number_share+$total_brokerage);
	  	}
	  	$data['total_profit'] =@number_format($total_profit,3);
	  	echo json_encode($data);
	  	exit;
	  	 
	wp_die();
}
/*--------------------------------------------------------
/*     Action for Calculate Margin Calculator
/*---------------------------------------------------------*/
add_action( 'wp_ajax_get_calculate_margin_calculator',  __NAMESPACE__ . '\\get_calculate_margin_calculator' );
add_action( 'wp_ajax_nopriv_get_calculate_margin_calculator',  __NAMESPACE__ . '\\get_calculate_margin_calculator' );

function get_calculate_margin_calculator(){
	$nonce =  @$_REQUEST['security'];
	if ( ! wp_verify_nonce( $nonce, 'gloabltop10stockbroker' ) ) {
      	die( __( 'Security check', 'top10stockbroker' ) ); 
   	}		
	$output=array();
	$post_id =  @$_REQUEST['post_id'];
	$prefix =  @$_REQUEST['prefix'];
	$script_name =  @$_REQUEST['script_name'];
	$margin =  @$_REQUEST['margin'];
	$share_price =  @$_REQUEST['share_price'];
	$meta_data = sanitize_title($prefix .'-'. $script_name) ; 
	$meta_value = get_post_meta($post_id , $meta_data , true); 
	$meta_value =($meta_value)?$meta_value:0;
	$output = array( 'meta_value' => $meta_value, 'margin' => $margin , 'share_price' => $share_price );
	echo json_encode( $output );
	exit;
}