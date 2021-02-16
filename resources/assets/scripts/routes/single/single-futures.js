import {SingleFutures}  from '../../library/single-fetures';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
import OptionFutureChart from '../../components/graph/option-future-chart';

export default {
  init() { 

    if (typeof SingleFutures !== 'undefined') {
        SingleFutures.initialize();
    }
     
    $(document).on('click','.shart_market_chart',function(e){
          var dur=$(this).data("filter");
          var selli=$(this).data("element");
          var resp_div=$(this).data("chart-element");
          if(!$('#'+resp_div).find('.highcharts-container ').length){
            ReactDOM.unmountComponentAtNode(document.getElementById(resp_div));
             $('#'+resp_div).before('<div class="fb-loader loader mx-auto"></div>');
               ReactDOM.render( 
              <OptionFutureChart />,
              document.getElementById(resp_div)
            );
          }
    });
      
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


