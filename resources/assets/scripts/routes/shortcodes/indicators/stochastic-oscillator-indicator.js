import React, { Component } from "react";
import ReactDOM from 'react-dom';

import StocksSoIndicator from '../../../components/indicators/stocks-so-indicator';
import IndicesSoIndicator from '../../../components/indicators/indices-so-indicator';

export default {
  init() {
      (function($) {
        'use strict';
        // For Stocks Tab
        if($('#main-so-indicator').length){
          if($('#stocksSoIndicator').length){
              ReactDOM.render(
              <StocksSoIndicator />,
              document.getElementById('stocksSoIndicator')
            );
          }
            if($('#indicesSoIndicator').length){
              ReactDOM.render(
              <IndicesSoIndicator />,
              document.getElementById('indicesSoIndicator')
            );
          }
        }
          
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
