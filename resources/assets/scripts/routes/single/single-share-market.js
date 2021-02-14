import {SingleShareMarket}  from '../../library/single-share-market';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
import ShareMarketChart from '../../components/graph/share-market-chart';
export default {
  init() {
    // Load page section through ajax

    var process = true;
    if ($( "body.mobile" ).length) {
    }else{
      
    }
    if (typeof SingleShareMarket !== 'undefined') {
      SingleShareMarket.initialize();
    }
    
    // Graph Tabs click event.
    $(document).on('click','.shart_market_chart',function(e){
            var dur=$(this).data("filter");
            var selli=$(this).data("element");
            var resp_div=$(this).data("chart-element");
            if(!$('#'+resp_div).find('.highcharts-container ').length){
              ReactDOM.unmountComponentAtNode(document.getElementById(resp_div));
              $('#'+resp_div).before('<div class="fb-loader loader mx-auto"></div>');
              ReactDOM.render( 
                <ShareMarketChart />,
                document.getElementById(resp_div)
              );
            }
    });
   
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


