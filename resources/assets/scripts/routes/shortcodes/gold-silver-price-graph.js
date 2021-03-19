import { EasyTab}  from '../../library/global';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
import GoldSilverChart from '../../components/graph/gold-silver-chart';
export default {
  init() {
      (function($) {
        'use strict';
          if (typeof EasyTab !== 'undefined') {
            EasyTab.initialize();
          }
          setTimeout(function(){
            $('.gold-silver-graph a[href="#li_1y"').trigger('click');
          },4000);
          $(document).on('click','.gold_silver_chart',function(e){
              var dur=$(this).data("filter");
              var selli=$(this).data("element");
              var resp_div=$(this).data("chart-element");
              var post_id=$(this).data("post-id");
             if(!$('#'+resp_div).find('.highcharts-container ').length){
                ReactDOM.render( 
                  <GoldSilverChart />,
                  document.getElementById(resp_div)
                );
              }
          });
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
