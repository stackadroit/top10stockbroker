import React, { Component } from "react";
import ReactDOM from 'react-dom';

import StocksEmaIndicator from '../../../components/indicators/stocks-ema-indicator';
import IndicesEmaIndicator from '../../../components/indicators/indices-ema-indicator';

export default {
  init() {
      (function($) {
        'use strict';
        // For Stocks Tab
        if($('#main-ema-indicator').length){
          if($('#stocksEmaIndicator').length){
              ReactDOM.render(
                <StocksEmaIndicator />,
                document.getElementById('stocksEmaIndicator')
              );
          }
          // For Indices Tab
          if($('#indicesEmaIndicator').length){
              ReactDOM.render(
                <IndicesEmaIndicator />,
                document.getElementById('indicesEmaIndicator')
              );
          }
        }
          
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
