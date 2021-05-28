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
          function loadIndicatorsComponent(defaultCal){
            console.log(defaultCal);
            var resp_div="#main-indicator-filters-content";
            var actDiv ='';
            switch(defaultCal){
              case 'Cl':
                actDiv='stocksClIndicator';
                if($(resp_div).find('#stocksClIndicator').length) {
                  ReactDOM.render( 
                    <StocksClIndicator />,
                    document.getElementById(actDiv)
                  );
                }
            }
            // if(!$(resp_div).find('.highcharts-container ').length){
          //       ReactDOM.render( 
          //         <GoldSilverChart />,
          //         document.getElementById(resp_div)
          //       );
          //     }
          }
          setTimeout(function(){
            // console.log('s');
            if($('#main-indicator-filters').length){
              var defaultCal= $('#main-indicator-filters').data('indicator');
              defaultCal =(defaultCal)?defaultCal:'cl';
              if(defaultCal){
                console.log(defaultCal);
                var eleId ='#main-indicator-filters-content';
                jQuery.ajax(
                   {
                      type: "post",
                      dataType: "html",
                      url:global_vars.ajax_url,
                      data: {
                        'action':'load-main-indicator-filters',
                        'defaultCal':defaultCal,
                        'security': global_vars.ajax_nonce,
                      },
                      cache:false,
                      beforeSend: function() {
                        $(eleId).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
                      },
                      success: function(response){
                        if(response){
                            $(eleId).html(response);
                            loadIndicatorsComponent(defaultCal);
                        }else{
                          $(eleId).html();
                        }
                      },
                      error:function(error){
                        $(eleId).html();
                      }
                  });
              }
            }
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
