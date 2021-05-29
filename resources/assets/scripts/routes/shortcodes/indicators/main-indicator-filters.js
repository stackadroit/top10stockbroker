import { EasyTab}  from '../../../library/global';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
// import GoldSilverChart from '../../components/graph/gold-silver-chart';
// PivotPoints Indicator  
import StocksPivotPointsIndicator from '../../../components/indicators/stocks-pivot-points-indicator';
import IndicesPivotPointsIndicator from '../../../components/indicators/indices-pivot-points-indicator';
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
            var resp_div="#main-indicator-filters-content";
            var stockActDiv ='stocks'+defaultCal+'Indicator';
            var indicesActDiv ='indices'+defaultCal+'Indicator';
            switch(defaultCal){
              case 'Cl':
                if($(resp_div).find('#'+stockActDiv).length) {
                  ReactDOM.render( 
                    <StocksClIndicator />,
                    document.getElementById(stockActDiv)
                  );
                }
                if($(resp_div).find('#'+indicesActDiv).length) {
                  ReactDOM.render( 
                    <IndicesClIndicator />,
                    document.getElementById(indicesActDiv)
                  );
                }
                break;
              case 'Ema':
                if($(resp_div).find('#'+stockActDiv).length) {
                  ReactDOM.render( 
                    <StocksEmaIndicator />,
                    document.getElementById(stockActDiv)
                  );
                }
                if($(resp_div).find('#'+indicesActDiv).length) {
                  ReactDOM.render( 
                    <IndicesEmaIndicator />,
                    document.getElementById(indicesActDiv)
                  );
                }
                break;
              case 'Giv':
                if($(resp_div).find('#'+stockActDiv).length) {
                  ReactDOM.render( 
                    <StocksGivIndicator />,
                    document.getElementById(stockActDiv)
                  );
                }
                break;
              case 'Macd':
                if($(resp_div).find('#'+stockActDiv).length) {
                  ReactDOM.render( 
                    <StocksMacdIndicator />,
                    document.getElementById(stockActDiv)
                  );
                }
                if($(resp_div).find('#'+indicesActDiv).length) {
                  ReactDOM.render( 
                    <IndicesMacdIndicator />,
                    document.getElementById(indicesActDiv)
                  );
                }
                break;
              case 'PivotPoints':
                if($(resp_div).find('#'+stockActDiv).length) {
                  ReactDOM.render( 
                    <StocksPivotPointsIndicator />,
                    document.getElementById(stockActDiv)
                  );
                }
                if($(resp_div).find('#'+indicesActDiv).length) {
                  ReactDOM.render( 
                    <IndicesPivotPointsIndicator />,
                    document.getElementById(indicesActDiv)
                  );
                }
                break;
              case 'Rsi':
                if($(resp_div).find('#'+stockActDiv).length) {
                  ReactDOM.render( 
                    <StocksRsiIndicator />,
                    document.getElementById(stockActDiv)
                  );
                }
                if($(resp_div).find('#'+indicesActDiv).length) {
                  ReactDOM.render( 
                    <IndicesRsiIndicator />,
                    document.getElementById(indicesActDiv)
                  );
                }
                break;
              case 'Sma':
                if($(resp_div).find('#'+stockActDiv).length) {
                  ReactDOM.render( 
                    <StocksSmaIndicator />,
                    document.getElementById(stockActDiv)
                  );
                }
                if($(resp_div).find('#'+indicesActDiv).length) {
                  ReactDOM.render( 
                    <IndicesSmaIndicator />,
                    document.getElementById(indicesActDiv)
                  );
                }
                break;
              case 'So':
                if($(resp_div).find('#'+stockActDiv).length) {
                  ReactDOM.render( 
                    <StocksSoIndicator />,
                    document.getElementById(stockActDiv)
                  );
                }
                if($(resp_div).find('#'+indicesActDiv).length) {
                  ReactDOM.render( 
                    <IndicesSoIndicator />,
                    document.getElementById(indicesActDiv)
                  );
                }
                break;
            }
           
          }
          function loadIndicatorFilterHtml(defaultCal){
             // console.log(defaultCal);
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
                        // $(eleId).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
          setTimeout(function(){
            if($('#main-indicator-filters').length){
              var defaultCal= $('#main-indicator-filters').data('indicator');
              defaultCal =(defaultCal)?defaultCal:'cl';
              if(defaultCal){
                loadIndicatorFilterHtml(defaultCal)
              }
            }
            $(document).find('#main-indicator-filter').on('change',function(){
              var defaultCal =$(this).val();
              if(defaultCal){
                loadIndicatorFilterHtml(defaultCal)
              }
            });
            
          },500);
           
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
