<?php
/**
 *  @desc This file inclue all the external api call setting on 
 *  contact from submit.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
/*---------------------------------------------------------*/

add_action( 'wp_ajax_lead_data_post_to_api',  __NAMESPACE__ . '\\api_master_calls' );
add_action( 'wp_ajax_nopriv_lead_data_post_to_api',  __NAMESPACE__ . '\\api_master_calls' );

/**
 *  Get API list for sending Data.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function api_master_calls(){
   
    global $wp;
    global $wpdb;
    $url = upicrm_get_referer1(); 
    $current_url = home_url( add_query_arg( array(), $wp->request ) );
    $postData= array();
    // Set Post Data in to variable
    parse_str($_POST['post_data'], $postData);
    
    $SelectServices =(isset($postData['cf7s-SelectServices'])) ? $postData['cf7s-SelectServices'] : (isset($postData['cf7s-SelectService'])?$postData['cf7s-SelectService']:'');
     
    $form_id = $postData['_wpcf7'];
    lead_info_save($postData);
    if($form_id == '54644'){
        // Send this form data in to Google Sheet.
        echo 'Lead Send to goolge sheet : 1Pe57PV7d-gxxa49512Urne13Cnevmfm0lwTl4fs1W4c .';
        pa1_cf7_save_to_google_sheets_ajaxs($postData,'1Pe57PV7d-gxxa49512Urne13Cnevmfm0lwTl4fs1W4c',$url);
    }else{
        $urls = $url;
        $service =$SelectServices;
        $importTbl= 'wp_urls_csb_imports';
        $services_optionsTbl= 'wp_api_services_options';
        $srQuery= "select * from ". $importTbl ." WHERE url LIKE '%".$urls."%'";
        $srResults = $wpdb->get_row($srQuery);
        $category ='';
        $sub_category ='';
        $brand ='';
        if($srResults){
            $category = @$srResults->category;
            $sub_category = @$srResults->sub_category;
            $brand = @$srResults->brand;
        }
        $serviceQuery= "select ". $services_optionsTbl .".* ,ser.api_name,ser.google_sheet_id from ". $services_optionsTbl ." left JOIN wp_api_services as ser ON(ser.id=". $services_optionsTbl .".api_id) WHERE ". $services_optionsTbl .".status = 1 AND ". $services_optionsTbl .".active_for = 'url'";
        if($service){
            $serviceQuery .= " AND FIND_IN_SET('".$service."',services) ";
        }
        $open =0; 
        if($category && $sub_category && $brand){
             $serviceQuery .= " AND (FIND_IN_SET('".$category."',categories) OR FIND_IN_SET('".$sub_category."',sub_categories) OR FIND_IN_SET('".$brand."',brands))";
        }elseif($category && $sub_category){
            $serviceQuery .= " AND (FIND_IN_SET('".$category."',categories) OR FIND_IN_SET('".$sub_category."',sub_categories))";
        }elseif($category && $brand){
            $serviceQuery .= " AND (FIND_IN_SET('".$category."',categories) OR FIND_IN_SET('".$brand."',brands))";
        }elseif($sub_category && $brand){
            $serviceQuery .= " AND (FIND_IN_SET('".$sub_category."',sub_categories) OR FIND_IN_SET('".$brand."',brands))";
        }elseif($category){
            $serviceQuery .= " AND FIND_IN_SET('".$category."',categories) ";
        }elseif($sub_category){
            $serviceQuery .= " AND FIND_IN_SET('".$sub_category."',sub_categories) ";
        }elseif($brand){
            $serviceQuery .= " AND FIND_IN_SET('".$brand."',brands) ";
        }
        echo $serviceQuery .'<br/>';
        $serviceResults = $wpdb->get_results($serviceQuery);
        
        if($serviceResults){
            foreach ($serviceResults as $key => $value) {
                switch ($value->api_id) {
                    case '1':
                        echo 'angelBroking_BtoB_Api_Called';
                        angelBroking_BtoB_Api_Call($postData);
                        break;
                    case '2':
                        echo 'angelBroking_BtoC_Api_Called';
                        angelBroking_BtoC_Api_Call($postData);
                        break;
                    case '3': 
                        echo 'serkhan_BtoB_Api_Call';
                        serkhan_BtoB_Api_Call($postData);
                        break;
                    case '4': 
                        echo 'motilal_BtoC_Api_Call';
                        motilal_BtoC_Api_Call($postData);
                        break;
                    case '5': 
                        echo 'mastertrust_API';
                        mastertrust_API($postData);
                        break;
                    case '6':
                        echo 'religare_B2C_API';
                        religare_B2C_API($postData);
                        break;
                    case '7':
                        echo 'Nirmal Bang B2C';
                        nirmal_Bang_B2C_API($postData);
                        break;
                    case '8':
                        echo 'IIFL_B2B fan api';
                        //IIFL_B2B_API($postData);
                        IIFL_B2B_FAN_API($postData);
                        break;
                    case '9':
                        //echo 'IIFL_B2C';
                        //IIFL_B2C_API($postData);
                        echo 'IIFL_B2C_GrowthAPI';
                        IIFL_B2C_GrowthAPI($postData);
                        
                        break;
                    case '10':
                        echo 'BAJAJ';
                        bajajfinservsecurities($postData);
                        break;
                   case '11':
                        echo $value->api_name .$value->google_sheet_id;
                        pa1_cf7_save_to_google_sheets_ajaxs($postData,$value->google_sheet_id,$url);
                        break;
                   case '12':
                        echo $value->api_name .$value->google_sheet_id;
                        pa1_cf7_save_to_google_sheets_ajaxs($postData,$value->google_sheet_id,$url);
                        break;
                    case '14':
                        echo $value->api_name;
                        PA1_GEOJITCRM_API_B2C($postData);
                        break;
                    case '15':
                        echo $value->api_name;
                        PA1_5Paisa_API_B2C($postData);
                        break;
                  default:
                    
                        break;
                     
                }
            }
        }
        api_master_calls_for_city_data();
       exit;
    }
    exit;
}

/**
 *  Get API list for sending Data City Wise api setting from backend.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function api_master_calls_for_city_data(){
    //  ini_set('display_errors', 1);
    //  ini_set('display_startup_errors', 1);
    //  error_reporting(E_ALL);
    echo 'Calling city apis';
    echo '<br/>'; 
    global $wp;
    global $wpdb;
    $url = upicrm_get_referer1();
    $current_url = home_url( add_query_arg( array(), $wp->request ) );
    $postData= array();
    parse_str($_POST['post_data'], $postData);
    $SelectServices =(isset($postData['cf7s-SelectServices'])) ? $postData['cf7s-SelectServices'] : (isset($postData['cf7s-SelectService'])?$postData['cf7s-SelectService']:'');
     
    $form_id = @$postData['_wpcf7'];
    $urls = $url;
    $service ='Open Demat Account';
    // $service =$SelectServices;
    $zoneTable ="{$wpdb->prefix}zones";
    $stateTable ="{$wpdb->prefix}states";
    $cityTable ="{$wpdb->prefix}zone_state_cities";
    $services_optionsTbl= 'wp_api_services_options';
    $city=trim($postData['cf7s-City']);
    $city=urlencode($city);

    $srQuery= "select c.city_name,s.state_name,z.zone_name from $cityTable as c LEFT JOIN $stateTable as s ON(s.id=c.state_id) LEFT JOIN $zoneTable as z ON(z.id=c.zone_id) WHERE city_name='".$city."'";
    $srResults = $wpdb->get_row($srQuery);

    $city_name ='';
    $state_name ='';
    $zone_name ='';
    if($srResults){
        $city_name = @$srResults->city_name;
        $state_name = @$srResults->state_name;
        $zone_name = @$srResults->zone_name;
    }
    $serviceQuery= "select ". $services_optionsTbl .".* ,ser.api_name,ser.google_sheet_id from ". $services_optionsTbl ." left JOIN wp_api_services as ser ON(ser.id=". $services_optionsTbl .".api_id) WHERE ". $services_optionsTbl .".city_status = 1 AND ". $services_optionsTbl .".active_for = 'city'";
        if($service){
            $serviceQuery .= " AND FIND_IN_SET('".$service."',services) ";
        }
        $open =0; 
        if($city_name && $state_name && $zone_name){
             $serviceQuery .= " AND (FIND_IN_SET('".$city_name."',cities) OR FIND_IN_SET('".$state_name."',states) OR FIND_IN_SET('".$zone_name."',zones))";
        }elseif($city_name && $state_name){
            $serviceQuery .= " AND (FIND_IN_SET('".$city_name."',cities) OR FIND_IN_SET('".$state_name."',states))";
        }elseif($city_name && $zone_name){
            $serviceQuery .= " AND (FIND_IN_SET('".$city_name."',cities) OR FIND_IN_SET('".$zone_name."',zones))";
        }elseif($state_name && $zone_name){
            $serviceQuery .= " AND (FIND_IN_SET('".$state_name."',states) OR FIND_IN_SET('".$zone_name."',zones))";
        }elseif($city_name){
            $serviceQuery .= " AND FIND_IN_SET('".$city_name."',cities) ";
        }elseif($state_name){
            $serviceQuery .= " AND FIND_IN_SET('".$state_name."',states) ";
        }elseif($zone_name){
            $serviceQuery .= " AND FIND_IN_SET('".$zone_name."',zones) ";
        }
        echo $serviceQuery;
       // exit;
        $serviceResults = $wpdb->get_results($serviceQuery);
        if($serviceResults){
            foreach ($serviceResults as $key => $value) {
                switch ($value->api_id) {
                    case '1':
                        echo 'angelBroking_BtoB_Api_Called';
                        angelBroking_BtoB_Api_Call($postData);
                        break;
                    case '2':
                        echo 'angelBroking_BtoC_Api_Called';
                        angelBroking_BtoC_Api_Call($postData);
                        break;
                    case '3': 
                        echo 'serkhan_BtoB_Api_Call';
                        serkhan_BtoB_Api_Call($postData);
                        break;
                    case '4': 
                        echo 'motilal_BtoC_Api_Call';
                        motilal_BtoC_Api_Call($postData);
                        break;
                    case '5': 
                        echo 'mastertrust_API';
                        mastertrust_API($postData);
                        break;
                    case '6':
                        echo 'religare_B2C_API';
                        religare_B2C_API($postData);
                        break;
                    case '7':
                        echo 'Nirmal Bang B2C';
                        nirmal_Bang_B2C_API($postData);
                        break;
                    case '8':
                        echo 'IIFL_B2B_NEW api';
                        //IIFL_B2B_API($postData);
                        IIFL_B2B_FAN_API($postData);
                        break;
                    case '9':
                        echo 'IIFL_B2C_GrowthAPI';
                        IIFL_B2C_GrowthAPI($postData);
                        break;
                    case '10':
                        echo 'BAJAJ';
                        bajajfinservsecurities($postData);
                        break;
                    case '11':
                        echo $value->api_name .$value->google_sheet_id;
                        pa1_cf7_save_to_google_sheets_ajaxs($postData,$value->google_sheet_id,$url);
                        break;
                    case '12':
                        echo $value->api_name .$value->google_sheet_id;
                        pa1_cf7_save_to_google_sheets_ajaxs($postData,$value->google_sheet_id,$url);
                        break;
                    case '13':
                        echo $value->api_name;
                        IIFLGrowthPartners($postData);
                        break;
                    case '14':
                        echo $value->api_name;
                        PA1_GEOJITCRM_API_B2C($postData);
                        break;
                    case '15':
                        echo $value->api_name;
                        PA1_5Paisa_API_B2C($postData);
                        break;
                    default:
                        break;
                }
            }
        }
   exit;
}

/**
 *  Save Contact form data.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function lead_info_save($postedArray =array() ){
    global $wp;
    $url = upicrm_get_referer1(); 
    $current_url = home_url( add_query_arg( array(), $wp->request ) );
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    $form_id= $postedArray['_wpcf7'];
    // Add API Details in to DB
    insert_request_response_ac_db($form_id,'referer',$url,'landing_page',$current_url);
}

/**
 *  Get Refral Url.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function upicrm_get_referer1(){
    $ref = '';
    if (!empty($_REQUEST['_wp_http_referer']))
        $ref = $_REQUEST['_wp_http_referer'];
    else if (!empty($_SERVER['HTTP_REFERER']))
        $ref = $_SERVER['HTTP_REFERER'];
    if ($ref !== $_SERVER['REQUEST_URI'])
        return $ref;
    return false;
}

/**
 *  Add Api Request and response in to Advance contact form DB.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function insert_request_response_ac_db($form_id,$request_key,$request_value='',$response_key,$response_value=''){
    global $wpdb;
    $table_name= $wpdb->prefix."cf7_vdata_entry";
    $query = "SELECT * FROM $table_name WHERE `cf7_id` = $form_id order by `id` DESC limit 1";
    $data =$wpdb->get_row($query);
    if($data){
        $data_id = $data->data_id; 
        $wpdb->insert( $table_name , array(
            'cf7_id' =>$form_id,
            'data_id' => $data_id,
            'name' => $request_key,//'ab_b2b_lead_request_url',
            'value' => $request_value,//$apiUrl,  
        ));
        $wpdb->insert( $table_name , array(
            'cf7_id' =>$form_id,
            'data_id' => $data_id,
            'name' => $response_key,//'ab_b2b_lead_status',
            'value' => $response_value,  
       ));
    } 
}
/**
 *  Send Contact Data to Angle Broking B2B.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function angelBroking_BtoB_Api_Call($postedArray =array()){
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    
    $form_id= $postedArray['_wpcf7'];
    $name = urlencode( $postedArray['cf7s-name'] );
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    $email="NA" ;    
    $city=urlencode($postedArray['cf7s-City']);
    
    // Curl 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.angelbroking.com/api/b2b-3rd-party.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
                "api_key=top10stockbroker&api_secret=230c233f-b70a-44fd-8bc8-331671e8b036&fname=".$name."&lname=&LeadSource=WEB&Mobile=".$mobile."&Email=NA&ResidenceCity=".$city."&ResidenceAddress=&ResidenceArea=&ResidencePin=&ProductsInterested=&LeadChannel=Direct&Correspondence=&Category=&Refferal=&Remarks=");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    // receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_value = curl_exec ($ch);
    curl_close ($ch);
    print_r($response_value);
    $request_value = $apiUrl;
    // Add API Details in to DB
    $request_value= "api_key=top10stockbroker&api_secret=230c233f-b70a-44fd-8bc8-331671e8b036&fname=".$name."&lname=&LeadSource=WEB&Mobile=".$mobile."&Email=NA&ResidenceCity=".$city."&ResidenceAddress=&ResidenceArea=&ResidencePin=&ProductsInterested=&LeadChannel=Direct&Correspondence=&Category=&Refferal=&Remarks=";
    insert_request_response_ac_db($form_id,'ab_b2b_lead_request_url',$request_value,'ab_b2b_lead_status',$response_value);
}

/**
 *  Send Contact Data to Angle Broking B2C.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */

function angelBroking_BtoC_Api_Call($postedArray =array()){
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    
    $form_id= $postedArray['_wpcf7'];
    $name = urlencode( $postedArray['cf7s-name'] );
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    $email="NA" ;    
    $city=urlencode($postedArray['cf7s-City']);
     
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"https://www.angelbroking.com/api/b2c-3rd-party.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
            "api_key=top10stockbroker&api_secret=230c233f-b70a-44fd-8bc8-331671e8b036&fname=".$name."&strLName=".$name."&mobile=".$mobile."&strLandLine=&city=".$city."&email=". $email."&strRefURL=&strLMSSource=chittorgarh&strDevice=Desktop&strAdType=Direct&strAd_Id=9665&iWebPlacementId=&strIPAddress=172.29.17.111&strOS=Windows&strBrowser=Chrome&UTM=http%3A%2F%2Fopenanaccount.angelbroking.com%2Forb.aspx%3Futm_source%3Dchittorgarh%26utm_medium%3Dweb%26utm_campaign%3Dorb%26utm_content%3Dtopsharebrokers&Keyword1=&Keyword2=&Keyword3=&Keyword_Final=&strReferrerKeyword=&strAdGroup=ad&PageUrl=http%3A%2F%2Fopenanaccount.angelbroking.com%2Forb.aspx");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    // receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_value = curl_exec ($ch);
    curl_close ($ch);
    print_r($response_value );
    $request_value = $apiUrl;
    // Add API Details in to DB
    $request_value= "api_key=top10stockbroker&api_secret=230c233f-b70a-44fd-8bc8-331671e8b036&fname=".$name."&strLName=".$name."&mobile=".$mobile."&strLandLine=&city=".$city."&email=". $email."&strRefURL=&strLMSSource=chittorgarh&strDevice=Desktop&strAdType=Direct&strAd_Id=9665&iWebPlacementId=&strIPAddress=172.29.17.111&strOS=Windows&strBrowser=Chrome&UTM=http%3A%2F%2Fopenanaccount.angelbroking.com%2Forb.aspx%3Futm_source%3Dchittorgarh%26utm_medium%3Dweb%26utm_campaign%3Dorb%26utm_content%3Dtopsharebrokers&Keyword1=&Keyword2=&Keyword3=&Keyword_Final=&strReferrerKeyword=&strAdGroup=ad&PageUrl=http%3A%2F%2Fopenanaccount.angelbroking.com%2Forb.aspx";
    insert_request_response_ac_db($form_id,'ab_b2c_lead_request_url',$request_value,'ab_b2c_lead_status',$response_value);
}

/**
 *  Send Contact Data to Serkhan B2B.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function serkhan_BtoB_Api_Call( $postedArray =array() ){
    
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    $form_id= $postedArray['_wpcf7'];
    $name = urlencode( $postedArray['cf7s-name'] );
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    $email="top10stockbroker@gmail.com" ;    
    $city=urlencode($postedArray['cf7s-City']);
    $s_key="419" ; //2805457C-C7D1-4789-AA6F-89D9B426B253
    $apiUrl="https://www.sharekhan.com/websources/lead_api_uat.asmx/GenerateLead_API?firstname=$name&phone=$mobile&city=$city&emailid=$email&pincode=456789&sourceid=$s_key&prodid=31&campid=1371";
    $curl = curl_init();
    curl_setopt_array($curl, 
        array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $apiUrl,
            CURLOPT_HTTPHEADER => array(
                "user-agent: AngelBroking Server"
            )
        )
    );
    $result = curl_exec($curl);
    print_r($result);
    $xmlObject = simplexml_load_string($result);
    print_r($xmlObject);
    $xmlResult = json_decode($xmlObject[0]);
    print_r($xmlResult[0]->msg);
    // echo $xmlObject->txDescription;
    // Add API Details in to DB
    $request_value =$apiUrl;
    $response_value =$xmlResult[0]->msg;
    insert_request_response_ac_db($form_id,'serkhan_b2b_lead_request_url',$request_value,'serkhan_b2b_lead_status',$response_value);
            // exit;
}

/**
 *  Send Contact Data to Motilal B2C.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function motilal_BtoC_Api_Call($postedArray=array()){
    $password = '3sc3RLrpd17';
    $method = 'aes-256-cbc';
    $password = substr(hash('sha256', $password, true), 0, 32);
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    $postData = json_encode(array(
        'oaoModel' => array(
            'Name' => $postedArray['cf7s-name'],
            'MobileNo' => $postedArray['cf7s-phone'],
            'Email' => '',
            'Country' => 'India',
            'State' => 'Maharashtra',
            'City' => $postedArray['cf7s-City'],
            'pincode'=>''
        ),
        'TokenModel' => array('Token' => '1015LKJH')
    ));
     
    print_r($postData);
   // $postData =json_encode($postData);
    $encryptedPostData = base64_encode(openssl_encrypt($postData, $method, $password, OPENSSL_RAW_DATA, $iv));
    $id= base64_encode(openssl_encrypt('224.000.0.000', $method, $password, OPENSSL_RAW_DATA, $iv));
    $BusinessUnitId= base64_encode(openssl_encrypt('2', $method, $password, OPENSSL_RAW_DATA, $iv));
    $clientinfo= base64_encode(openssl_encrypt('Top10', $method, $password, OPENSSL_RAW_DATA, $iv));
        $token= base64_encode(openssl_encrypt('1015LKJH', $method, $password, OPENSSL_RAW_DATA, $iv));
    $userid= base64_encode(openssl_encrypt('32048', $method, $password, OPENSSL_RAW_DATA, $iv));
    $macaddress= base64_encode(openssl_encrypt('468b7955109917a7', $method, $password, OPENSSL_RAW_DATA, $iv));
     $APPId= base64_encode(openssl_encrypt('3', $method, $password, OPENSSL_RAW_DATA, $iv));
    $EmployeeCode= base64_encode(openssl_encrypt('Top10', $method, $password, OPENSSL_RAW_DATA, $iv));
    $json= base64_encode(openssl_encrypt('application/json; charset=utf-8', $method, $password, OPENSSL_RAW_DATA, $iv));
    $header =array(
        "ipaddress:".$id,
        "BusinessUnitId:".$BusinessUnitId,
        "clientinfo:".$clientinfo,
        "token:".$token,
        "userid:".$userid,
        "macaddress:".$macaddress,
        "Content-Type:".$json,
        "APPId:".$APPId,
        "EmployeeCode:".$EmployeeCode,        
        'Accept-Encoding: deflate'
    );   
    $url= "http://saathi.motilaloswal.com:81/api/OAOLeads/OAOLeadService";
    $ch = curl_init($url);
    $options = array(
        CURLOPT_RETURNTRANSFER => true,         // return web page
        CURLOPT_HEADER         => false,        // don't return headers
        CURLOPT_FOLLOWLOCATION => false,         // follow redirects
               // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
        CURLOPT_AUTOREFERER    => true,         // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
        CURLOPT_TIMEOUT        => 20,          // timeout on response
        CURLOPT_POST            => 1,            // i am sending post data
        CURLOPT_POSTFIELDS     => $encryptedPostData,    // this are my post vars
        CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
        CURLOPT_SSL_VERIFYPEER => false,        //
        CURLOPT_VERBOSE        => 1,
        CURLOPT_HTTPHEADER     => $header

    );
    curl_setopt_array($ch,$options);
    $data = curl_exec($ch);
    curl_close($ch);
    $response_value= openssl_decrypt(base64_decode(gzinflate($data)), $method, $password, OPENSSL_RAW_DATA, IV);
     print_r($response_value);
    $request_value = $apiUrl;
    // Add API Details in to DB
    insert_request_response_ac_db($form_id,'ML_b2c_request',$postData,'ML_b2c_response',$response_value);  
}

/**
 *  Send Contact Data to Mastertrust.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function mastertrust_API( $postedArray =array() ){
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    $form_id= $postedArray['_wpcf7'];
    $name = urlencode( $postedArray['cf7s-name'] );
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    $email="" ;    
    $city=urlencode($postedArray['cf7s-City']);

    $apiUrl="http://broking.mastertrust.co.in/agency/index.aspx?name=$name&mobile=$mobile&email=$email&location=$city&utm_source=Top10&utm_medium=mailer&utm_campaign=contactform&return_url=https://top10stockbroker.com";
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE); // We'll parse redirect url from header.
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION); // We want to just get redirect url but not to follow it.
    $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $response = curl_exec($ch);
    preg_match_all('/^Location:(.*)$/mi', $response, $matches);
    curl_close($ch);
    $result = !empty($matches[1]) ? trim($matches[1][0]) : 'No redirect found';
    // Add API Details in to DB
    insert_request_response_ac_db($form_id,'mastertrust_lead_request_url',$apiUrl,'mastertrust_lead_status',$result); 
}
/**
 *  Send Contact Data to Religare B2C.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function religare_B2C_API( $postedArray =array() ){
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    $form_id= $postedArray['_wpcf7'];
    $name = urlencode( $postedArray['cf7s-name'] );
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    $email=$mobile."@gmail.com" ;    
    $city=urlencode($postedArray['cf7s-City']);
    $apiUrl="https://secure.religareonline.com/TradingAccount/WebleadNew.aspx?phonenumber=$mobile&Name=$name&email=$email&city=$city&utm_source=DLP&utm_keyword=top10broker";
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION);
    $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $response = curl_exec($ch);
    preg_match_all('/^Location:(.*)$/mi', $response, $matches);
    curl_close($ch);
    $result = !empty($matches[1]) ? trim($matches[1][0]) : 'No redirect found';
    $request_value = $apiUrl;
    // Add API Details in to DB
    insert_request_response_ac_db($form_id,'religare_b2c_api_request_url',$request_value,'religare_b2c_api_status',$result);
}
/**
 *  Send Contact Data to Mirmal Bang B2C.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function nirmal_Bang_B2C_API( $postedArray =array() ){
    
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    
    $form_id= $postedArray['_wpcf7'];
    $name = urlencode( $postedArray['cf7s-name'] );
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    $email=$mobile."@gmail.com" ;    
    $city=urlencode($postedArray['cf7s-City']);
    $apiUrl="https://www.nirmalbang.com/campaign/api.aspx?phonenumber=$mobile&Name=$name&email=$email&city=$city&utm_source=top10stockbroker";
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION);
    $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $response = curl_exec($ch);
    print_r($response);
    echo strip_tags($response);
    preg_match_all('/^Location:(.*)$/mi', $response, $matches);
    curl_close($ch);
    $result = !empty($matches[1]) ? trim($matches[1][0]) : 'No redirect found';
    $request_value = $apiUrl;
    // Add API Details in to DB
    $response_value = strip_tags($response);
    insert_request_response_ac_db($form_id,'nirmal_bang_b2c_api_request_url',$apiUrl,'nirmal_bang_b2c_api_status',$response_value);
}

/**
 *  Send Contact Data to IIFL B2B FAN API.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */

function IIFL_B2B_FAN_API( $postedArray =array() ){
    global $wpdb;
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    
    $form_id= $postedArray['_wpcf7'];
    $name = $postedArray['cf7s-name'];
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    $email=$mobile."@gmail.com" ;    
    $city=urlencode($postedArray['cf7s-City']);
    $apiRequest =array();
    $apiResponse ='';
    $apiRequest = array(
        'userid' => '7EE5F0F19A5A4C66',
        'type' => 'Franchise_Campaign',
        'name' => $name,
        'mobile' => $mobile,
        "email"=>$email,
        "city"=>$city,
        "state"=>"",
        "campaign"=>"Lead campaign newpage_p2",
        "description"=>"",
        "leadsource"=>"Website",
        "leadproduct"=>"FAN",
        "utmsource"=>"",
        "utmmedium"=>"",
        "utmcampaign"=>"",
        "utmcontent"=>"",
        "utmterm"=>"",
        "leadstatus"=>"",
        );
    $payload = json_encode($apiRequest);
    // Prepare new cURL resource
    $ch = curl_init('https://www.indiainfoline.com/business-partners/api/rest/add-lead');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
 
    // Set HTTP Header for POST request 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: {F64F02B4-9414-C42A-1A34-382E27CB5950}',
        'Content-Length: ' . strlen($payload))
    );
    // Submit the POST request
    $result = curl_exec($ch);
    echo '<pre>';
    print_r($result);
    insert_request_response_ac_db($form_id,'iifl_b2b_api_request_url',$payload,'iifl_b2b_api_status',$result);
    //exit;
}

/**
 *  Send Contact Data to IIFL B2C Growth API.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */

function IIFL_B2C_GrowthAPI( $postedArray =array() ){
    global $wpdb;
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    
    $form_id= $postedArray['_wpcf7'];
    $name = $postedArray['cf7s-name'];
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    $email=$mobile."@gmail.com" ;    
    $city=urlencode($postedArray['cf7s-City']);
    $apiRequest =array();
    $apiResponse ='';
    $apiRequest = array(
        'name' => $name,
        'mobile' => $mobile
    );
    $payload = json_encode($apiRequest);
    // Prepare new cURL resource
    $ch = curl_init('https://www.indiainfoline.com/campaigns/growthamplifiers/api/rest/add-leads');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
 
    // Set HTTP Header for POST request 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: {6CB7E6B2-BC4A-EE92-EFFB-2C381E22D2C8}',
        'Content-Length: ' . strlen($payload))
    );
    // Submit the POST request
    $result = curl_exec($ch);
    echo '<pre>';
    print_r($result);
     //$form_id= $postedArray['_wpcf7'];
    insert_request_response_ac_db($form_id,'iifl_b2c_api_request_url',$payload,'iifl_b2c_api_status',$result);
    //exit;return
}
/**
 *  Send Contact Data to Bajaj Finserv Securities.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function bajajfinservsecurities($postedArray =array()){
   
    $form_id= $postedArray['_wpcf7'];
    $email =$postedArray['cf7s-phone'].'@gmail.com';
    $data= array(
        'name' => $postedArray['cf7s-name'],
        'mobile' => $postedArray['cf7s-phone'],
        'email' => $email,
        'partner' => 'top10stockbroker',
        'date' => date("Y-m-d"),
        'product' => 'Lead',
        'City' => $postedArray['cf7s-City'],
        'additionalone'=>'one',
        'additionaltwo' => 'two');
    $postdata = json_encode($data);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_PORT => "8282",
      CURLOPT_URL => "https://bfslwebapi.bajajfinservsecurities.in:8282/BFSL/sfdc/create",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0, 
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $postdata,
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 044eacd3-84e9-62f8-230e-a796361195bf"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      echo $response= "cURL Error #:" . $err;
    } else {
      echo $response;
    }
    insert_request_response_ac_db($form_id,'bajaj_url',$postdata,'bajajfinanace_status',$response);
}

/**
 *  Send Contact Data to IIFL Growth Partners.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */

function IIFLGrowthPartners( $postedArray =array() ){
    global $wpdb;
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    
    $form_id= $postedArray['_wpcf7'];
    $name = $postedArray['cf7s-name'];
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    $email=$mobile."@gmail.com" ;    
    $city=urlencode($postedArray['cf7s-City']);
    $apiRequest =array();
    $apiResponse ='';
    $apiRequest = array(
        'name' => $name,
        'mobile' => $mobile
    );
    $payload = json_encode($apiRequest);
 
    // Prepare new cURL resource
    $ch = curl_init('https://www.indiainfoline.com/campaigns/growthamplifiers/api/rest/add-leads');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
 
    // Set HTTP Header for POST request 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: {8D323DE9-C82C-644E-8A65-8E6F881C49C2}',
        'Content-Length: ' . strlen($payload))
    );
 
    // Submit the POST request
    $result = curl_exec($ch);
    echo '<pre>';
    print_r($result);
    insert_request_response_ac_db($form_id,'iifl_growth_request',$payload,'iifl_growth_response',$result);
    //exit;
}

/**
 *  Send Contact Data to GEOJITCRM API B2C.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */

function PA1_GEOJITCRM_API_B2C( $postedArray =array() ){
    
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    
    $form_id= $postedArray['_wpcf7'];
    $name = $postedArray['cf7s-name'];
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    //$email=$mobile."@gmail.com" ;  
    $email="";  
    $city=$postedArray['cf7s-City'];
    //Get Token Request
    $apiRequest =array();
    $apiResponse ='';
    echo $url = 'https://login.microsoftonline.com/43736b0b-a13c-43a1-a5e2-3bfe4bb05f90/oauth2/token';
    echo '<br/>';
    $fields = array('client_id' => '0b69ba46-8b56-48e1-a024-e1c20d6f4d47',
        'resource' => 'https://geojit.crm8.dynamics.com/',
        'client_secret' => 'it6M~FZk0PZOy3doTIBe1GHO-S7b18_-Ii',
        'grant_type' => 'client_credentials'
    );
    $apiRequest['token_req']=json_encode($fields);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://login.microsoftonline.com/43736b0b-a13c-43a1-a5e2-3bfe4bb05f90/oauth2/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>$fields ,
       
    ));

    $token_response = curl_exec($curl);

    if($token_response){
        // $apiRequest['token_res']=$token_response;
        $token_response =json_decode($token_response);
        $leadApiAccessToken =$token_response->token_type.' '.$token_response->access_token;
        echo 'Geojit API Token: '.$leadApiAccessToken;

    }
    //Get Token Request End
    curl_close($curl);
    if(@$leadApiAccessToken) {
        $leadHeaderVars= array(
            'Content-Type: application/json',
            'Authorization:'.$leadApiAccessToken,
            'Prefer: return=representation'
        );
            
        $postArrayFiends=array(
            "geo_external"=>true,
            "firstname"=>$name,
            "lastname"=>"",
            "emailaddress1"=>$email,
            "mobilephone"=>$mobile,
            "geo_city"=>$city,
            "geo_product@odata.bind"=>"products(productnumber='P0001')",
            "geo_subproduct"=>"1",
            "geo_leadsource@odata.bind"=>"geo_leadsources(geo_name='Campaign')",
            "campaignid@odata.bind"=>"campaigns(geo_campaigncode='CMP-257')",
            "geo_utmcampaign"=>"",
            "geo_utmcontent"=>"",
            "geo_utmmedium"=>"",
            "geo_utmsource"=>"",
            "geo_utmterm"=>"",
            "geo_adgroupid"=>"",
            "geo_gclid"=>""
        );
        echo $postJsonFiends =json_encode($postArrayFiends);
        $apiRequest['lead_req'] =$postJsonFiends;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://geojit.crm8.dynamics.com/api/data/v9.1/leads?$select=geo_leadid',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$postJsonFiends,
            CURLOPT_HTTPHEADER =>$leadHeaderVars,
        ));

        $apiResponse = curl_exec($curl);

        curl_close($curl);
    }
    // echo '-------------------------------------';
    // echo '<pre>';
    // print_r($apiRequest);
    // echo '-------------------------------------';
    insert_request_response_ac_db($form_id,'geogit_b2c_api_request_url',json_encode($apiRequest),'geogit_b2c_api_status',$apiResponse);
}
/**
 *  Send Contact Data to PA1 5Paisa API B2C.
 *  @author Pavan JI <dropmail2pavan@gmail.com> 
 */
function PA1_5Paisa_API_B2C( $postedArray =array() ){
    
    $SelectServices =(isset($postedArray['cf7s-SelectServices'])) ? $postedArray['cf7s-SelectServices'] : (isset($postedArray['cf7s-SelectService'])?$postedArray['cf7s-SelectService']:'');
    
    $form_id= $postedArray['_wpcf7'];
    $name = $postedArray['cf7s-name'];
    $mobile= ($postedArray['cf7s-phone'])?$postedArray['cf7s-phone']:'' ; 
    $email="";  
    // $email=$mobile."@gmail.com" ;  
    $city=$postedArray['cf7s-City'];
    //Get Token Request
    $apiRequest =array();
    $apiResponse =array();
    $fields = array('client_id' => '4e60302c-f733-4616-87b5-2d644d1768e5',
        'scope' => 'api://zohocrmapi/.default',
        'client_secret' => '~e~F-Wr5Uy_tIt-WkuS3l.03.059WLi3O~',
        'grant_type' => 'client_credentials'
    );
    $apiRequest['token_req']=json_encode($fields);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://login.microsoftonline.com/51840122-2b13-4509-940a-04f06940dd5d/oauth2/v2.0/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>$fields ,
       
    ));
    $token_response = curl_exec($curl);
    if($token_response){
        // $apiRequest['token_res']=$token_response;
        $token_response =json_decode($token_response);
        $leadApiAccessToken =$token_response->token_type.' '.$token_response->access_token;
        echo '5Paisa API Token: '.$leadApiAccessToken;

    }
    //Get Token Request End
    curl_close($curl);
    if(@$leadApiAccessToken) {
        $tokenHeaderVars= array(
            'Content-Type: application/json',
            'Authorization:'.$leadApiAccessToken,
            'Ocp-Apim-Subscription-Key:e2117d3d7aa041a4a7e6927631b2a752',
            'Ocp-Apim-Trace:true'
        );
        $tokenPostData=array(
            'UserID'=>'0F46C5923FEF4409'
        );
        $tokenPostDataJson =json_encode($tokenPostData);
        $url2 ='https://zohocrmapi.azure-api.net/CRMAPI/Token';
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url2,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$tokenPostDataJson ,
          CURLOPT_HTTPHEADER =>$tokenHeaderVars,
           
        ));

        $token2_response = curl_exec($curl);
        curl_close($curl);
        if(@$token2_response){
            $token2_response =json_decode($token2_response);
            $token2=$token2_response->Body->Token;
            if($token2){
                $leadHeaderVars= array(
                    'Content-Type: application/json',
                    'Authorization:'.$leadApiAccessToken,
                    'Ocp-Apim-Subscription-Key:e2117d3d7aa041a4a7e6927631b2a752',
                    'Ocp-Apim-Trace:true'
                );
                $leadPostArray=array(
                    'Token'=>$token2,
                    'ObjectName'=>'Lead',
                    'Parameters'=>array(
                        "IsReg" => "Y",
                        "FName" => $name,
                        "LastName"=>"",
                        "LeadProduct"=>"Equity",
                        "Mobile"=>$mobile,
                        "Email"=>$email,
                        "LeadSource"=>"Partner Program",
                        "lead_source"=>"Partner Program",
                        'partner_client_code' => '58398898',
                        'Campaign'=> 'Top10StockBroker',
                        "subsource"=>"Top10stockbroker",
                        "SubSource"=>"Top10stockbroker",
                        "city"=>$city
                    )
                );
                   
                $leadPostDataJson =json_encode($leadPostArray);
                $apiRequest['token_res']=$leadPostDataJson;
                $url3 ='https://zohocrmapi.azure-api.net/CRMAPI/Save';
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => $url3,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>$leadPostDataJson ,
                  CURLOPT_HTTPHEADER =>$leadHeaderVars,
                   
                ));

                $apiResponse = curl_exec($curl); 
                print_r($apiResponse);
            }
        }else{
            $apiResponse ='Second Step Token Getting Failed';
        }
         
    }else{
        $apiResponse ='First Step Token Getting Failed';
    }
    print_r($apiRequest);
    insert_request_response_ac_db($form_id,'5paisa_b2c_req_url',json_encode($apiRequest),'5paisa_b2c_api_status',$apiResponse);
}
