import {PluginScrollToTop, Header, Nav, PluginStickyWidget, ModalPopup}  from '../library/global';
import {contactForm} from '../plugins/contactform';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
import MdfSearchWrap from '../components/mbfsearchwrap';

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

		// contact Form 7
		if (typeof contactForm !== 'undefined') {
			contactForm.initialize();
		}

		// Sticky Widget.
		if (typeof PluginStickyWidget !== 'undefined') {
			PluginStickyWidget.initialize();
		}
		
		// Scroll to Top Button.
		if (typeof PluginScrollToTop !== 'undefined') {
			PluginScrollToTop.initialize();
		}
		
		if (typeof ModalPopup !== 'undefined') {
			ModalPopup.initialize();
		}

		//bell icon popup
		ReactDOM.render(
	  	  <MdfSearchWrap />,
	  	  document.getElementById('mbf-search-wrap')
	  	);

	}).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
