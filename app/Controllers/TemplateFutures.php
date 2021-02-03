<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateFutures extends Controller
{

	
	function __construct() {
        // run the intal code to get the main detials from the server
    }

	public function instName(){
		$instName = get_post_meta(get_the_ID(),'instrument_name',true);
		$instName =($instName)?$instName:'FUTSTK';
	    return $instName;
	}

	public function symbol(){
		$symbol = get_post_meta(get_the_ID(),'symbol',true);
		$symbol =($symbol)?$symbol:'TCS';
		return $symbol;
	}	

	public function ExpDate(){
		return "";
	}

	public function OptType(){
		return "";
	}

	public function StkPrice(){
		return "";
	}

	public function companyName(){
		return "";
	}

	public function cDetails(){
		return "";
	}

	
}