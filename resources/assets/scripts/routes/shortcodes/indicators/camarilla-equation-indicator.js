import React, { Component } from "react";
import ReactDOM from 'react-dom';

import StocksClIndicator from '../../../components/indicators/stocks-cl-indicator';
import IndicesClIndicator from '../../../components/indicators/indices-cl-indicator';

export default {
  init() {
      (function($) {
        'use strict';
        // For Stocks Tab
        if($('#main-cl-indicator').length){
          if($('#stocksClIndicator').length){
              ReactDOM.render(
                <StocksClIndicator />,
                document.getElementById('stocksClIndicator')
              );
          }
          // For Indices Tab
          if($('#indicesClIndicator').length){
              ReactDOM.render(
                <IndicesClIndicator />,
                document.getElementById('indicesClIndicator')
              );
          }
        }
          
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
