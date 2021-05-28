import React, { Component } from "react";
import ReactDOM from 'react-dom';

import StocksSmaIndicator from '../../../components/indicators/stocks-sma-indicator';
import IndicesSmaIndicator from '../../../components/indicators/indices-sma-indicator';

export default {
  init() {
      (function($) {
        'use strict';
        // For Stocks Tab
        if($('#main-sma-indicator').length){
          if($('#stocksSmaIndicator').length){
              ReactDOM.render(
              <StocksSmaIndicator />,
              document.getElementById('stocksSmaIndicator')
            );
          }
            if($('#indicesSmaIndicator').length){
              ReactDOM.render(
              <IndicesSmaIndicator />,
              document.getElementById('indicesSmaIndicator')
            );
          }
        }
          
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
