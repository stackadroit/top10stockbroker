import React, { Component } from "react";
import ReactDOM from 'react-dom';

import StocksRsiIndicator from '../../../components/indicators/stocks-rsi-indicator';
import IndicesRsiIndicator from '../../../components/indicators/indices-rsi-indicator';

export default {
  init() {
      (function($) {
        'use strict';
        // For Stocks Tab
        if($('#main-rsi-indicator').length){
          if($('#stocksRsiIndicator').length){
              ReactDOM.render(
              <StocksRsiIndicator />,
              document.getElementById('stocksRsiIndicator')
            );
            }
            if($('#indicesRsiIndicator').length){
              ReactDOM.render(
              <IndicesRsiIndicator />,
              document.getElementById('indicesRsiIndicator')
            );
            }
        }
          
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
