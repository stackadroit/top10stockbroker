import {PluginScrollToTop, Header, Nav, PluginStickyWidget}  from '../library/global';
export default {
  init() {
    // Commom Plugins
	(function($) {

		'use strict';

		// Scroll to Top Button.
		if (typeof PluginScrollToTop !== 'undefined') {
			PluginScrollToTop.initialize();
		}

		// Header
		if (typeof Header !== 'undefined') {
			Header.initialize();
		}

		// Navigation.
		if (typeof Nav !== 'undefined') {
			Nav.initialize();
		}

		// Sticky Widget.
		if (typeof PluginStickyWidget !== 'undefined') {
			PluginStickyWidget.initialize();
		}
		
	}).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
