// Graham Intrinsic Value Fore Cast Calculators
(function($) {

  var initialized = false;

  var GIVForeCastCalculator = {
 		defaults: {
		},

		initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
		},

		setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
		},
		 
		getGIVStockCalculatorHtml:function($givStockForeCastEle,givStockTabEle,finCode,post_id,filter,calculateButton){
			if(finCode){
				$.ajax({
			     	cache: false,
			      	crossDomain: true,
		         	config: {
		              	headers: {
		                 	'Access-Control-Allow-Origin': '*',
		              	}
		         	},
		         	beforeSend: function() {
		              if(!$givStockForeCastEle.find('.fb-loader').length){
		              	$givStockForeCastEle.find(givStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/giv-stock-calculator-html',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $givStockForeCastEle.find(givStockTabEle).html(response);    
			            $givStockForeCastEle.find(givStockTabEle).find('.fb-loader').remove();    
			            var $givForecastWrap=$('#giv-forecast-wrap');
			            if($(document).find('#giv-more-detail').length){
			            	var resultJson =$givForecastWrap.find(givStockTabEle).find('#giv-stock-json-results').data('result-json');
			            	$givForecastWrap.find('#giv-current-intrinsic-value').html(resultJson.Intrinsic_Value);
			            	$givForecastWrap.find('#giv-trade-value').html(resultJson.Invest);
			            	 
			            }
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $givStockForeCastEle.find(givStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},

		getGIVStockCalculator:function($givStockForeCastEle,givStockTabEle,finCode,post_id,filter,calculateButton){
			if(finCode){
				$.ajax({
			     	cache: false,
			      	crossDomain: true,
		         	config: {
		              	headers: {
		                 	'Access-Control-Allow-Origin': '*',
		              	}
		         	},
		         	beforeSend: function() {
		              if(!$givStockForeCastEle.find('.fb-loader').length){
		              	$givStockForeCastEle.find(givStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/giv-stock-calculator',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $givStockForeCastEle.find(givStockTabEle).find('#giv-stock-calculator-results').html(response);    
			            $givStockForeCastEle.find(givStockTabEle).find('.fb-loader').remove();    
			            var $givForecastWrap=$('#giv-forecast-wrap');
			            if($(document).find('#giv-more-detail').length){
			            	var resultJson =$givForecastWrap.find(givStockTabEle).find('#giv-stock-json-results').data('result-json');
			            	$givForecastWrap.find('#giv-current-intrinsic-value').html(resultJson.Intrinsic_Value);
			            	$givForecastWrap.find('#giv-trade-value').html(resultJson.Invest);
			            	 
			            }
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $givStockForeCastEle.find(givStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},
	 
		events: function() {
			var self    = this,
				$givStockForeCastEle  = $('#giv-stock-forecast-calculator');
				givStockTabEle  = '#givForeCastCalculator';
			setTimeout(function(ele) {
				var post_id=$givStockForeCastEle.data('id');
				var calculateButton=$givStockForeCastEle.data('calculate-button');
				// For Stock Calculator Load
				if($givStockForeCastEle.find(givStockTabEle).length){
					var finCode=$givStockForeCastEle.find(givStockTabEle).data('fincode');
					var filter=$givStockForeCastEle.find(givStockTabEle).data('filter');
		        	self.getGIVStockCalculatorHtml($givStockForeCastEle,givStockTabEle,finCode,post_id,filter,calculateButton);
		        }
	        }, 1,this);
			 
			// rsi-stock-refresh and Calculate
			$(document).on('click','#giv-stock-calculator,#giv-stock-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$givStockForeCastEle.find('#giv-stock-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var post_id=$givStockForeCastEle.data('id');
				var calculateButton=$givStockForeCastEle.data('calculate-button');
				var finCode=$givStockForeCastEle.find(givStockTabEle).data('fincode');
				var filter=$givStockForeCastEle.find(givStockTabEle).data('filter');
				self.getGIVStockCalculator($givStockForeCastEle,givStockTabEle,finCode,post_id,filter,calculateButton);
			});
			$(document).on('change','#giv-stocks',function(e){
				// $('#rsi-calculate-pivot-points').hide();
				$givStockForeCastEle.find('#giv-stock-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var finCode=$(this).val();
				var post_id=$givStockForeCastEle.data('id');
				var calculateButton=$givStockForeCastEle.data('calculate-button');
				$givStockForeCastEle.find(givStockTabEle).data('fincode',finCode);
				var filter=$givStockForeCastEle.find(givStockTabEle).data('filter');
				self.getGIVStockCalculatorHtml($givStockForeCastEle,givStockTabEle,finCode,post_id,filter,calculateButton);
			});
 
			return this;
		},
	 
    };
  exports.GIVForeCastCalculator = GIVForeCastCalculator;

}).apply(this, [jQuery]);