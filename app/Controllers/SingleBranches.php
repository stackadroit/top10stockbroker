<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleBranches extends Controller
{
    public function cBroker(){
        $brokerObj =get_the_terms(get_the_ID(),'brokers');
        $cBroker ='';
        if($brokerObj && is_array($brokerObj)){
            // $parentObj= get_term_by('id',$brokerObj[0]->parent,'brokers');
            // if($parentObj){
            // }
            $cBroker = $brokerObj[0]->parent;
            $clocation = $brokerObj[0]->term_id;
        }
        return $cBroker;
    }
}