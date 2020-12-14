import {brokerCalculator}  from '../../library/broker-calculator';
export default {
  init() {
    // Commom Plugins
	(function($) {

		'use strict';
		// Calculator 
		if (typeof brokerCalculator !== 'undefined') {
			brokerCalculator.initialize();
		}
		
	}).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
