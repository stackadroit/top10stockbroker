import React, { Component } from "react";
import ReactDOM from 'react-dom';

import StocksTiIndicator from '../../../components/indicators/stocks-ti-indicator';
import IndicesTiIndicator from '../../../components/indicators/indices-ti-indicator';

export default {
  init() {
      (function($) {
        'use strict';
        // For Stocks Tab
        if($('#main-ti-indicator').length){
          if($('#stocksTiIndicator').length){
              ReactDOM.render(
                <StocksTiIndicator />,
                document.getElementById('stocksTiIndicator')
              );
          }
          // For Indices Tab
          if($('#indicesTiIndicator').length){
              ReactDOM.render(
                <IndicesTiIndicator />,
                document.getElementById('indicesTiIndicator')
              );
          }
        }
          
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
