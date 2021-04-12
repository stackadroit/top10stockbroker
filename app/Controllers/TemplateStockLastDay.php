<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateStockLastDay extends Controller
{

	public function index()
    {
        $args = array(
          'post_type' => 'stock-prediction',
          'order'=>'ASC',
          'orderby'=>'post_title',
          'posts_per_page'=>-1,
        );
        $post_lists= get_posts($args);
        $responseData=array();
        foreach ($post_lists as $key => $value) {
            $finCode =get_post_meta($value->ID,'fin_code',true);
            if($finCode){
               $postData = array(
                'login' => 'acogneau',
                'finCode' => $finCode,
                ); 
                $ch = curl_init();
                curl_setopt_array($ch, array(
                CURLOPT_URL => 'https://api.top10stockbroker.com/apiblock/update-last-day-stock-data',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_FOLLOWLOCATION => true
                ));

                $output = curl_exec($ch);
                $outputData = json_decode($output);
                // print_r($outputData);
                update_post_meta($value->ID,'stock_date',$outputData->Date);
                update_post_meta($value->ID,'y_pivot_point',$outputData->ppValue);
                update_post_meta($value->ID,'y_high',$outputData->yHigh);
                update_post_meta($value->ID,'y_low',$outputData->yLow);
                update_post_meta($value->ID,'y_close',$outputData->yClose);
            } 
        }
    }
}
