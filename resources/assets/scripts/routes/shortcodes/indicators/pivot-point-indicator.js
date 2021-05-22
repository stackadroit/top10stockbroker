import React, { Component } from "react";
import ReactDOM from 'react-dom';
import MainPivotPointsIndicator from '../../../components/indicators/main-pivot-points-indicator';
export default {
  init() {
      (function($) {
        'use strict';
         var resp_div ='#main-pivot-points-indicator';
          ReactDOM.render(
              <MainPivotPointsIndicator />,
              document.getElementById('main-pivot-points-indicator')
            );
      }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
