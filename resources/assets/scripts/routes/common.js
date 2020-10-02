import {PluginScrollToTop, Search, Nav}  from './global';

export default {
  init() {
    // Commom Plugins
	(function($) {

		'use strict';

		// Search
		if (typeof PluginScrollToTop !== 'undefined') {
			PluginScrollToTop.initialize();
		}

		// Scroll to Top Button.
		if (typeof Search !== 'undefined') {
			Search.initialize();
		}

		// Navigation.
		if (typeof Nav !== 'undefined') {
			Nav.initialize();
		}


	}).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
