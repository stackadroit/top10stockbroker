import React, { Component } from "react";
import ReactDOM from 'react-dom';
import StocksPivotPointsIndicator from '../../../components/indicators/stocks-pivot-points-indicator';
import IndicesPivotPointsIndicator from '../../../components/indicators/indices-pivot-points-indicator';
export default {
  init() {
      (function($) {
        'use strict';
        // For Stocks Tab
        if($('#stocksPivotPointsIndicator').length){
            ReactDOM.render(
              <StocksPivotPointsIndicator />,
              document.getElementById('stocksPivotPointsIndicator')
            );
        }
        // For Indices Tab
        if($('#indicesPivotPointsIndicator').length){
            ReactDOM.render(
              <IndicesPivotPointsIndicator />,
              document.getElementById('indicesPivotPointsIndicator')
            );
        }
          
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
