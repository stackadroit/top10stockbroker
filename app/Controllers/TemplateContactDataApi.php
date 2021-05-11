<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateContactDataApi extends Controller
{
	public function responseData()
	{
		$responseData= array();
	    if(isset($_REQUEST['access_to']) && ($_REQUEST['access_to'] =='top10' || $_REQUEST['access_to'] =='paisachhapo')){
	    	 
	    	$table_name="wpgl_cf7_vdata_entry";
			global $wpdb;
			if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date'])){
				$start_date =$_REQUEST['start_date'];
				 $end_date =$_REQUEST['end_date'];
				 $search_date_query = "AND `name` = 'submit_time' AND value between '".$start_date."' and '".$end_date." 23:59:59'";
				 $query = "SELECT * FROM `".$table_name."` WHERE 1 = 1 AND data_id IN(
							SELECT * FROM (
								SELECT data_id FROM `".$table_name."` WHERE 1 = 1 ".$search_date_query." 
									GROUP BY `data_id` ORDER BY `data_id` DESC
								) 
							temp_table) ORDER BY `data_id`";
			}else{
			    
				$query ="SELECT * FROM `".$table_name."` WHERE  data_id IN(
		  				SELECT * FROM (
		 					SELECT data_id FROM `".$table_name."` WHERE 1 = 1   
		 						GROUP BY `data_id` ORDER BY `data_id` DESC
		  					) 
		  				temp_table) 
			  				ORDER BY `data_id` DESC LIMIT 10";
			  				
			  
			} 
			  $data =$wpdb->get_results($query);
			  $fields =array();
			  $fields[] =['title'=>'Name','key'=>'cf7s-name'];
			  $fields[] =['title'=>'Phone','key'=>'cf7s-phone'];
			  $fields[] =['title'=>'City','key'=>'cf7s-City'];
			  $fields[] =['title'=>'Service','key'=>'cf7s-SelectService'];
			  $fields[] =['title'=>'Submit Time','key'=>'submit_time'];
			  $fields[] =['title'=>'Form Title','key'=>'form_title'];
			  $fields[] =['title'=>'Submit Ip','key'=>'submit_ip'];
			  $fields[] =['title'=>'Ip City','key'=>'ip_city'];
			  $fields[] =['title'=>'Device','key'=>'device'];
			  $fields[] =['title'=>'Landing Page','key'=>'landing_page'];
			  $fields[] =['title'=>'Original Ref','key'=>'original_ref'];
			  $fields[] =['title'=>'Refered By','key'=>'referer'];
			  $fields[] =['title'=>'User Agents','key'=>'user_agents'];
			  $fields[] =['title'=>'B2B Lead Request','key'=>'ab_b2b_lead_request_url'];
			  $fields[] =['title'=>'B2B Lead Status','key'=>'ab_b2b_lead_status'];
			  $fields[] =['title'=>'B2C Lead Request','key'=>'ab_b2c_lead_request_url'];
			  $fields[] =['title'=>'B2C Lead Status','key'=>'ab_b2c_lead_status'];
			  $fields[] =['title'=>'ML B2C Status','key'=>'ML_b2c_response'];
			  $fields[] =['title'=>'ML B2C Request','key'=>'ML_b2c_request'];
			  $fields[] =['title'=>'serkhan  B2B Status','key'=>'serkhan_b2b_lead_status'];
			  $fields[] =['title'=>'serkhan B2B Request','key'=>'serkhan_b2b_lead_request_url'];
			  $fields[] =['title'=>'serkhan  B2B Status','key'=>'mastertrust_lead_status'];
			  $fields[] =['title'=>'serkhan B2B Request','key'=>'mastertrust_lead_request_url'];
			  
			 // $fields[] =['title'=>'Mastertrust Status','key'=>'mastertrust_lead_status'];
			 //  $fields[] =['title'=>'Mastertrust Request','key'=>'mastertrust_lead_request_url'];
			  
			  // $fields[] =['title'=>'Religare B2C Status','key'=>'religare_b2c_api_status'];
			  // $fields[] =['title'=>'Religare B2C Request','key'=>'religare_b2c_api_request_url'];
			  
			  // $fields[] =['title'=>'Nirmal Bang B2C Status','key'=>'nirmal_bang_b2c_api_status'];
			  // $fields[] =['title'=>'Nirmal Bang B2C Request','key'=>'nirmal_bang_b2c_api_request_url'];
			  
			  $fields[] =['title'=>'IIFL B2B Status','key'=>'iifl_b2b_api_status'];
			  $fields[] =['title'=>'IIFL B2B Request','key'=>'iifl_b2b_api_request_url']; 
			  $fields[] =['title'=>'IIFL B2C Status','key'=>'iifl_b2c_api_status'];
			  $fields[] =['title'=>'IIFL B2C Request','key'=>'iifl_b2c_api_request_url']; 
			  
			  		  
			  // $fields[] =['title'=>'Bajaj Finanace Status','key'=>'bajajfinanace_status'];
			  // $fields[] =['title'=>'Bajaj Finanace Request','key'=>'bajaj_url'];
			  $fields[] =['title'=>'IIFL Growth Status','key'=>'iifl_growth_response'];
			  $fields[] =['title'=>'IIFL Growth Request','key'=>'iifl_growth_request'];
			  // $fields[] =['title'=>'Geogit B2C Status','key'=>'geogit_b2c_api_status'];
			  // $fields[] =['title'=>'Geogit B2C Request','key'=>'geogit_b2c_api_request_url'];
			  
			  $fields[] =['title'=>'5Paisa B2C Status','key'=>'5paisa_b2c_api_status'];
			  $fields[] =['title'=>'5Paisa B2C Request','key'=>'5paisa_b2c_req_url'];
			  $fields[] =['title'=>'PayTM B2C Status','key'=>'paytm_b2c_api_status'];
			  $fields[] =['title'=>'PayTM B2C Request','key'=>'paytm_b2c_req_url'];
			 $responseData['headers']=$fields;
			 $responseData['body'] =array();
			 $response =array();
			  foreach ($data as $dArray) {
			  	if($dArray){
			  		$response[$dArray->data_id][$dArray->name] =$dArray->value ;
			  	}
			  }
			   $responseData['body'] =$response;
		}
		// header("Content-Type: application/json; charset=UTF-8");
		return $responseData; 
	}
}