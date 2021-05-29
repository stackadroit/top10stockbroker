import React, { Component } from "react";
import ReactDOM from 'react-dom';

import StocksMacdIndicator from '../../../components/indicators/stocks-macd-indicator';
import IndicesMacdIndicator from '../../../components/indicators/indices-macd-indicator';

export default {
  init() {
      (function($) {
        'use strict';
        // For Stocks Tab
        if($('#main-macd-indicator').length){
          if($('#stocksMacdIndicator').length){
              ReactDOM.render(
              <StocksMacdIndicator />,
              document.getElementById('stocksMacdIndicator')
            );
            }
            if($('#indicesMacdIndicator').length){
              ReactDOM.render(
              <IndicesMacdIndicator />,
              document.getElementById('indicesMacdIndicator')
            );
            }
        }
          
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
