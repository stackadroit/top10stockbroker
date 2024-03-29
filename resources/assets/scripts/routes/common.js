import {PluginScrollToTop, Header, Nav, PluginStickyWidget, ModalPopup, SuperTreadmill}  from '../library/global';
import {contactForm} from '../plugins/contactform';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
import SimpleBar from 'simplebar';
import MdfSearchWrap from '../components/mbfsearchwrap';
import QuickerSlider from '../components/quickerslider';
import WidgetMarket from '../components/widgetmarket';
import WidgetMarketTop from '../components/widgetmarketTop';

export default {
  init() {
    // Commom Plugins
	(function($) {
		//for mobile version for lazy loading
		var process = true;

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

		function loadReactComp(){
			//bell icon popup
			ReactDOM.render(
		  	  <MdfSearchWrap />,
		  	  document.getElementById('mbf-search-wrap')
		  	);

			//widget market
			ReactDOM.render(
		  	  <WidgetMarket />,
		  	  document.getElementById('widget-first')
		  	);

			ReactDOM.render(
		  	  <WidgetMarketTop />,
		  	  document.getElementById('widget-second')
		  	);

			//slick oncall load
			$(document)
	        .on('loadReactSlickIcons', function (event, eventInfo) {
		        ReactDOM.render( 
			  	  <QuickerSlider />,
			  	  document.getElementById('list-slider-modal')
			  	);
	  		});
	    }

	    //only for mobile render
	    function checkReactLoad(){
	    	if ($( "body.mobile" ).length && process) {
	    		loadReactComp();
	    		process = false;
	    	}
	    }
	    
		if ($( "body.mobile" ).length) {
	        $([window, document]).on('click', function(){
	          if (process) {
	            loadReactComp();
	            process = false;
	          }
	        });
	    }else{
	      	loadReactComp();
	    }

	    setTimeout(checkReactLoad, 3000); 

        $(document)
        .on('reinitContactform', function (event, eventInfo) {
        	var $form = $( '.load-model .wpcf7-form' );
        	wpcf7.initForm( $form );
  		});

        // super tread mill
        if (typeof SuperTreadmill !== 'undefined') {
			SuperTreadmill.initialize();
		}

        //scroll bar on sections
        $('.scrollbar').each(function() {
        	new SimpleBar(this , { autoHide: true });
        });

	}).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
