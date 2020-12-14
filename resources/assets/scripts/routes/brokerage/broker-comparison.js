import {brokerComparison}  from '../../library/brokerage/broker-comparison';
export default {
  init() {
    // Commom Plugins
	(function($) {

		'use strict';
		// Calculator 
		if (typeof brokerComparison !== 'undefined') {
			brokerComparison.initialize();
		}
		
	}).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
