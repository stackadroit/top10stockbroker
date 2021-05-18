import {MainPivotPointsIndicator}  from '../../../library/fore-cast/indicators/pivot-point-indicator.js';
export default {
  init() {
    (function($) {
      'use strict';
      if (typeof MainPivotPointsIndicator !== 'undefined') {
         MainPivotPointsIndicator.initialize();
      }
    }).apply(this, [jQuery]);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
