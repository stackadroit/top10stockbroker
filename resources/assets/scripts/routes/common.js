import {PluginScrollToTop, Header, Nav, PluginStickyWidget}  from '../library/global';
import {contactForm} from '../plugins/contactform';
export default {
  init() {
    // Commom Plugins
	(function($) {

		'use strict';

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
		
		// Scroll to Top Button.
		if (typeof PluginScrollToTop !== 'undefined') {
			PluginScrollToTop.initialize();
		}
		
		// contact Form 7
		if (typeof contactForm !== 'undefined') {
			contactForm.initialize();
		}

	}).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
