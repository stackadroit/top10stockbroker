import {SingleSharePrice}  from '../../library/single-share-price';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
import SharePriceChart from '../../components/graph/share-price-chart';
import select2 from 'select2';  

export default {
  init() {
    // Load page section through ajax
    if (typeof SingleSharePrice !== 'undefined') {
      SingleSharePrice.initialize();
    }
    
    $(document).on('click','.shart_market_chart',function(e){
        var dur=$(this).data("filter");
        var selli=$(this).data("element");
        var resp_div=$(this).data("chart-element");
        if(!$('#'+resp_div).find('.highcharts-container ').length){
          ReactDOM.unmountComponentAtNode(document.getElementById(resp_div));
          $('#'+resp_div).before('<div class="fb-loader loader mx-auto"></div>');
          ReactDOM.render( 
            <SharePriceChart />,
            document.getElementById(resp_div)
          );
           
        }
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


