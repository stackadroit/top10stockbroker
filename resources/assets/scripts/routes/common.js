import {ContactFormValidation,PluginScrollToTop, Header, Nav, PluginStickyWidget, ModalPopup, SuperTreadmill,EasyTab,ShareMarketEducation,LoadSideBar}  from '../library/global';
// import {contactForm} from '../plugins/contactform';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
import SimpleBar from 'simplebar';
// import Select2 from 'select2';
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
		// SideBar
		if ($(window).width() < 700){
	        // For mobile
	    }else {
	    	if (typeof LoadSideBar !== 'undefined') {
				LoadSideBar.initialize();
			}
			setTimeout(function(){
			
			},5500); 
	    }
		// Easy tab
		if (typeof EasyTab !== 'undefined') {
			EasyTab.initialize();
		}
		// Easy tab
		if (typeof ShareMarketEducation !== 'undefined') {
			ShareMarketEducation.initialize();
		}

		// Navigation.
		if (typeof Nav !== 'undefined') {
			Nav.initialize();
		}

		// contact Form 7
		// if (typeof contactForm !== 'undefined') {
		// 	contactForm.initialize();
		// }
		if (typeof ContactFormValidation !== 'undefined') {
			ContactFormValidation.initialize();
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

	    setTimeout(function(){
	    	$(document).on('reinitContactform', function (event, eventInfo) {
	        	// var $form = $( '.load-model .wpcf7-form' );
	        	var $form =eventInfo;
	        	wpcf7.initForm( $form );
	  		});
	    },500,wpcf7);

        

  		// Show contact model on button click
        $(document).on('click','.custom-hellobar', function (event, eventInfo) {
        	$("#popup-main").modal('show');
  		});

  		// Banner Class Image image class click Event Capture
        $(document)
        .on('click','.open-b2cpopup,.open-b2bpopup,.open-ipopopup,.open-pmspopup', function (event) {
        	event.preventDefault();
        	var clickedClass ='';
        	if($(this).hasClass('open-b2cpopup')){
        		clickedClass='open-b2cpopup';
        		$("#mini-b2cpopup").attr('data-mini-popup',clickedClass).modal('show');
      	 	}
        	if($(this).hasClass('open-b2bpopup')){
        		clickedClass='open-b2bpopup';
        		$("#mini-b2bpopup").attr('data-mini-popup',clickedClass).modal('show');
        	}
        	if($(this).hasClass('open-ipopopup')){
        		clickedClass='open-ipopopup';
        		$("#mini-ipopopup").attr('data-mini-popup',clickedClass).modal('show');
        	}
        	if($(this).hasClass('open-pmspopup')){
        		clickedClass='open-pmspopup';
        		$("#mini-pmspopup").attr('data-mini-popup',clickedClass).modal('show');
        	}
        	
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
