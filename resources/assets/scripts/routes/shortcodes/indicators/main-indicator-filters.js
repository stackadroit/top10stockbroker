import { EasyTab}  from '../../../library/global';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
// import GoldSilverChart from '../../components/graph/gold-silver-chart';
// Sma Indicator
import StocksSmaIndicator from '../../../components/indicators/stocks-sma-indicator';
import IndicesSmaIndicator from '../../../components/indicators/indices-sma-indicator';

// Ema Indicator
import StocksEmaIndicator from '../../../components/indicators/stocks-ema-indicator';
import IndicesEmaIndicator from '../../../components/indicators/indices-ema-indicator';

// Macd Indicator
import StocksMacdIndicator from '../../../components/indicators/stocks-macd-indicator';
import IndicesMacdIndicator from '../../../components/indicators/indices-macd-indicator';

// RSI Indicator
import StocksRsiIndicator from '../../../components/indicators/stocks-rsi-indicator';
import IndicesRsiIndicator from '../../../components/indicators/indices-rsi-indicator';

// Stochastic Oscillator Indicator
import StocksSoIndicator from '../../../components/indicators/stocks-so-indicator';
import IndicesSoIndicator from '../../../components/indicators/indices-so-indicator';

// Graham Intrinsic Value Indicator
import StocksGivIndicator from '../../../components/indicators/stocks-giv-indicator';
 
 // Camarilla Levels Indicator
import StocksClIndicator from '../../../components/indicators/stocks-cl-indicator';
import IndicesClIndicator from '../../../components/indicators/indices-cl-indicator';

export default {
  init() {
      (function($) {
        'use strict';
          if (typeof EasyTab !== 'undefined') {
            EasyTab.initialize();
          }
          setTimeout(function(){
            console.log('s');
            $(document).find('#main-indicator-filter').on('change',function(){
              console.log('sss');
            });
            // .trigger('click');
            // $('.more-indicator-filter').trigger('click');
          },500);
          // $(document).on('click','.gold_silver_chart',function(e){
          //     var dur=$(this).data("filter");
          //     var selli=$(this).data("element");
          //     var resp_div=$(this).data("chart-element");
          //     var post_id=$(this).data("post-id");
          //    if(!$('#'+resp_div).find('.highcharts-container ').length){
          //       ReactDOM.render( 
          //         <GoldSilverChart />,
          //         document.getElementById(resp_div)
          //       );
          //     }
          // });
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
