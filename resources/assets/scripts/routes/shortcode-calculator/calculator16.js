import {debtRatioCalculator}  from '../../library/calculator';
export default {
  init() {
    // Commom Plugins
	(function($) {
		
		'use strict';
		// Calculator 
		if (typeof debtRatioCalculator !== 'undefined') {
			debtRatioCalculator.initialize();
		}
		
	}).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};