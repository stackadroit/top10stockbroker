import {grossProfitMarginCalculator}  from '../../library/calculator';
export default {
  init() {
    // Commom Plugins
	(function($) {
		
		'use strict';
		// Calculator 
		if (typeof grossProfitMarginCalculator !== 'undefined') {
			grossProfitMarginCalculator.initialize();
		}
		
	}).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
