import {BrokerCitySearch}  from '../../library/shortcodes';
export default {
  init() {
    // Commom Plugins
  (function($) {
    
    'use strict';
    // 
    if (typeof BrokerCitySearch !== 'undefined') {
      BrokerCitySearch.initialize();
    }
    
  }).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
