import React, { Component } from "react";
import ReactDOM from 'react-dom';

import StocksGivIndicator from '../../../components/indicators/stocks-giv-indicator';

export default {
  init() {
      (function($) {
        'use strict';
        // For Stocks Tab
        if($('#main-giv-indicator').length){
          if($('#stocksGivIndicator').length){
              ReactDOM.render(
              <StocksGivIndicator />,
              document.getElementById('stocksGivIndicator')
            );
            }
           
        }
          
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
