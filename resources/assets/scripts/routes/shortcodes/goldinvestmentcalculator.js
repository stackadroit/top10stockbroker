import {GoldInvestmentCalculator}  from '../../library/shortcodes';
export default {
  init() {
    // Commom Plugins
  (function($) {
    
    'use strict';
    // 
    if (typeof GoldInvestmentCalculator !== 'undefined') {
      GoldInvestmentCalculator.initialize();
    }
    
  }).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
