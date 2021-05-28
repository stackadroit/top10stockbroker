import {ContactFormValidation,PluginScrollToTop, Header, Nav, PluginStickyWidget, ModalPopup, SuperTreadmill,LoadEasyTab,EasyTab,ShareMarketEducation,LoadSideBar}  from '../library/global';
// import {contactForm} from '../plugins/contactform';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
import SimpleBar from 'simplebar';
// import Select2 from 'select2';
import MdfSearchWrap from '../components/mbfsearchwrap';
import QuickerSlider from '../components/quickerslider';
import WidgetMarket from '../components/widgetmarket';
import WidgetMarketTop from '../components/widgetmarketTop';
import {PPForeCastCalculator}  from '../library/fore-cast/pp-fore-cast-calculator';
import {SMAForeCastCalculator}  from '../library/fore-cast/sma-fore-cast-calculator';
import {EMAForeCastCalculator}  from '../library/fore-cast/ema-fore-cast-calculator';
import {MACDForeCastCalculator}  from '../library/fore-cast/macd-fore-cast-calculator';
import {RSIForeCastCalculator}  from '../library/fore-cast/rsi-fore-cast-calculator';
import {SOForeCastCalculator}  from '../library/fore-cast/so-fore-cast-calculator';
import {GIVForeCastCalculator}  from '../library/fore-cast/giv-fore-cast-calculator';
import {CLForeCastCalculator}  from '../library/fore-cast/cl-fore-cast-calculator';

// Sma Indicator
import StocksSmaIndicator from '../components/indicators/stocks-sma-indicator';
import IndicesSmaIndicator from '../components/indicators/indices-sma-indicator';

// Ema Indicator
import StocksEmaIndicator from '../components/indicators/stocks-ema-indicator';
import IndicesEmaIndicator from '../components/indicators/indices-ema-indicator';

// Macd Indicator
import StocksMacdIndicator from '../components/indicators/stocks-macd-indicator';
import IndicesMacdIndicator from '../components/indicators/indices-macd-indicator';

// RSI Indicator
import StocksRsiIndicator from '../components/indicators/stocks-rsi-indicator';
import IndicesRsiIndicator from '../components/indicators/indices-rsi-indicator';

// Stochastic Oscillator Indicator
import StocksSoIndicator from '../components/indicators/stocks-so-indicator';
import IndicesSoIndicator from '../components/indicators/indices-so-indicator';

// Graham Intrinsic Value Indicator
import StocksGivIndicator from '../components/indicators/stocks-giv-indicator';
 
 // Camarilla Levels Indicator
import StocksClIndicator from '../components/indicators/stocks-cl-indicator';
import IndicesClIndicator from '../components/indicators/indices-cl-indicator';
import MainIndicatorFilters from '../routes/shortcodes/indicators/main-indicator-filters';
 
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
	    }
		// Easy tab
		if($('.easy_tabs_container_wrap').length){
			if (typeof LoadEasyTab !== 'undefined') {
				LoadEasyTab.initialize();
			}
		}

		// Navigation.
		if (typeof Nav !== 'undefined') {
			Nav.initialize();
		}
		if($('#pp-stock-forecast-calculator').length){
			if (typeof PPForeCastCalculator !== 'undefined') {
		        PPForeCastCalculator.initialize();
		    }
		}
		
		if($('#sma-stock-forecast-calculator').length){
			if (typeof SMAForeCastCalculator !== 'undefined') {
		        SMAForeCastCalculator.initialize();
		    }
		}
		if($('#ema-stock-forecast-calculator').length){
			if (typeof EMAForeCastCalculator !== 'undefined') {
		        EMAForeCastCalculator.initialize();
		    }
		}
		if($('#macd-stock-forecast-calculator').length){
			if (typeof MACDForeCastCalculator !== 'undefined') {
		        MACDForeCastCalculator.initialize();
		    }
		}
		if($('#rsi-stock-forecast-calculator').length){
			if (typeof RSIForeCastCalculator !== 'undefined') {
		        RSIForeCastCalculator.initialize();
		    }
		}
		if($('#so-stock-forecast-calculator').length){
			if (typeof SOForeCastCalculator !== 'undefined') {
		        SOForeCastCalculator.initialize();
		    }
		}
		if($('#giv-stock-forecast-calculator').length){
			if (typeof GIVForeCastCalculator !== 'undefined') {
		        GIVForeCastCalculator.initialize();
		    }
		}
		if($('#cl-stock-forecast-calculator').length){
			if (typeof CLForeCastCalculator !== 'undefined') {
		        CLForeCastCalculator.initialize();
		    }
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
		if (typeof MainIndicatorFilters !== 'undefined') {
			if($('#main-indicator-filters').length){
				MainIndicatorFilters.init();
			}
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
	     //    if($('#pivot-point-calculator').length){
	     //    	ReactDOM.render(
			  	//   <ForeCastPivotPoint />,
			  	//   document.getElementById('pivot-point-calculator')
			  	// );
	     //    }
	     	//Sma Stocks Indicator
	     	if($('#main-sma-indicator').length){
	     		if($('#stocksSmaIndicator').length){
		        	ReactDOM.render(
				  	  <StocksSmaIndicator />,
				  	  document.getElementById('stocksSmaIndicator')
				  	);
		        }
		        if($('#indicesSmaIndicator').length){
		        	ReactDOM.render(
				  	  <IndicesSmaIndicator />,
				  	  document.getElementById('indicesSmaIndicator')
				  	);
		        }
	        }
	        //Ema Stocks Indicator
	     	if($('#main-ema-indicator').length){
	     		if($('#stocksEmaIndicator').length){
		        	ReactDOM.render(
				  	  <StocksEmaIndicator />,
				  	  document.getElementById('stocksEmaIndicator')
				  	);
		        }
		        if($('#indicesEmaIndicator').length){
		        	ReactDOM.render(
				  	  <IndicesEmaIndicator />,
				  	  document.getElementById('indicesEmaIndicator')
				  	);
		        }
	        }
	  		//Macd Stocks Indicator
	     	if($('#main-macd-indicator').length){
	     		if($('#stocksMacdIndicator').length){
		        	ReactDOM.render(
				  	  <StocksMacdIndicator />,
				  	  document.getElementById('stocksMacdIndicator')
				  	);
		        }
		        if($('#indicesMacdIndicator').length){
		        	ReactDOM.render(
				  	  <IndicesMacdIndicator />,
				  	  document.getElementById('indicesMacdIndicator')
				  	);
		        }
	        }
	        //RSI Stocks Indicator
	     	if($('#main-rsi-indicator').length){
	     		if($('#stocksRsiIndicator').length){
		        	ReactDOM.render(
				  	  <StocksRsiIndicator />,
				  	  document.getElementById('stocksRsiIndicator')
				  	);
		        }
		        if($('#indicesRsiIndicator').length){
		        	ReactDOM.render(
				  	  <IndicesRsiIndicator />,
				  	  document.getElementById('indicesRsiIndicator')
				  	);
		        }
	        }

	        //Stochastic Oscillator Indicator
	     	if($('#main-so-indicator').length){
	     		if($('#stocksSoIndicator').length){
		        	ReactDOM.render(
				  	  <StocksSoIndicator />,
				  	  document.getElementById('stocksSoIndicator')
				  	);
		        }
		        if($('#indicesSoIndicator').length){
		        	ReactDOM.render(
				  	  <IndicesSoIndicator />,
				  	  document.getElementById('indicesSoIndicator')
				  	);
		        }
	        }
	        //Graham Intrinsic Value Indicator
	     	if($('#main-giv-indicator').length){
	     		if($('#stocksGivIndicator').length){
		        	ReactDOM.render(
				  	  <StocksGivIndicator />,
				  	  document.getElementById('stocksGivIndicator')
				  	);
		        }
		       
	        }
	        //Camarilla Levels Indicator
	     	if($('#main-cl-indicator').length){
	     		if($('#stocksClIndicator').length){
		        	ReactDOM.render(
				  	  <StocksClIndicator />,
				  	  document.getElementById('stocksClIndicator')
				  	);
		        }
		        if($('#indicesClIndicator').length){
		        	ReactDOM.render(
				  	  <IndicesClIndicator />,
				  	  document.getElementById('indicesClIndicator')
				  	);
		        }
	        }
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
        $(document).on('click','.custom-hellobar a', function (event, eventInfo) {
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
