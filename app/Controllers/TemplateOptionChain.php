<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateOptionChain extends Controller
{
	var $cDetailsresponse =array();
	var $expDate ='';
	var $expiryDate ='';
	var $expDateDsp ='';
	var $symbol ='';
	var $optType ='';
	var $stkPrice ='';
	var $strikePrice ='';
	var $stcMid ='';
 
	public function topData() {
		$main_h1_title= get_post_meta(get_the_ID(),'main_title_h1',true);
		$main_para_content= get_post_meta(get_the_ID(),'main_paragraph_content',true);
		$main_h2_title= get_post_meta(get_the_ID(),'main_title_h2',true);
		$main_para2_content= get_post_meta(get_the_ID(),'main_paragraph_2_content',true);
        $topData =array(
        	'main_h1_title'=>$main_h1_title,
        	'main_para_content'=>$main_para_content,
        	'main_h2_title'=>$main_h2_title,
        	'main_para2_content'=>$main_para2_content,
        ); 
        return $topData;
    }
    public function instName(){
		$instName = get_post_meta(get_the_ID(),'instrument_name',true);
		$instName =($instName)?$instName:'OPTSTK';
	    return $instName;
	}
	public function isTemplate(){
	    return true;
	}
	public function symbol(){
		$symbol = get_post_meta(get_the_ID(),'symbol',true);
		$symbol =($symbol)?$symbol:'TCS';
		return @$symbol;
	}
	public function optionType(){
		$optionType =array('PE'=>'PE','CE'=>'CE');
		return @$optionType;
	}
	 
	public function currentUrl(){
		global $wp;
		$current_url = home_url( add_query_arg( array(), $wp->request ) ) .'/';
		return @$current_url;
	}
	public function topLinks(){
		$tab_id =  get_post_meta( get_the_id() , 'tab_filter_id' , true );
		$tab_id=53404;
		if(!empty($tab_id)):
			$get_meta = get_post_meta( $tab_id , 'repeatable_fields' , true );
            return $get_meta;
		else:
			return array();
		endif;
		 
	} 
}