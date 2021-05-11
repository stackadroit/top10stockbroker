// Camarilla Levels Fore Cast Calculators
(function($) {

  var initialized = false;

  var CLForeCastCalculator = {
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
		 
		getCLStockCalculatorHtml:function($clStockForeCastEle,clStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$clStockForeCastEle.find('.fb-loader').length){
		              	$clStockForeCastEle.find(clStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/cl-stock-calculator-html',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $clStockForeCastEle.find(clStockTabEle).html(response);    
			            $clStockForeCastEle.find(clStockTabEle).find('.fb-loader').remove();    
			            var $clForecastWrap=$('#cl-forecast-wrap');
			            if($(document).find('#cl-more-detail').length){
			            	var resultJson =$clForecastWrap.find(clStockTabEle).find('#cl-stock-json-results').data('result-json');
			            	$clForecastWrap.find('#cl-trade-value').html(resultJson.Trade);
			            	$clForecastWrap.find('#cl-sentiment-value').html(resultJson.Sentiment);
			            	$clForecastWrap.find('#cl-resistance1').html(resultJson.Resistance_1);
			            	$clForecastWrap.find('#cl-resistance2').html(resultJson.Resistance_2);
			            	$clForecastWrap.find('#cl-resistance3').html(resultJson.Resistance_3);
			            	$clForecastWrap.find('#cl-resistance4').html(resultJson.Resistance_4);
			            	$clForecastWrap.find('#cl-support1').html(resultJson.Support_1);
			            	$clForecastWrap.find('#cl-support2').html(resultJson.Support_2);
			            	$clForecastWrap.find('#cl-support3').html(resultJson.Support_3);
			            	$clForecastWrap.find('#cl-support4').html(resultJson.Support_4);
			            	 
			            }
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $clStockForeCastEle.find(clStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},

		getCLStockCalculator:function($clStockForeCastEle,clStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$clStockForeCastEle.find('.fb-loader').length){
		              	$clStockForeCastEle.find(clStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/cl-stock-calculator',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $clStockForeCastEle.find(clStockTabEle).find('#cl-stock-calculator-results').html(response);    
			            $clStockForeCastEle.find(clStockTabEle).find('.fb-loader').remove();    
			            var $clForecastWrap=$('#cl-forecast-wrap');
			            if($(document).find('#cl-more-detail').length){
			            	var resultJson =$clForecastWrap.find(clStockTabEle).find('#cl-stock-json-results').data('result-json');
			            	$clForecastWrap.find('#cl-trade-value').html(resultJson.Trade);
			            	$clForecastWrap.find('#cl-sentiment-value').html(resultJson.Sentiment);
			            	$clForecastWrap.find('#cl-resistance1').html(resultJson.Resistance_1);
			            	$clForecastWrap.find('#cl-resistance2').html(resultJson.Resistance_2);
			            	$clForecastWrap.find('#cl-resistance3').html(resultJson.Resistance_3);
			            	$clForecastWrap.find('#cl-resistance4').html(resultJson.Resistance_4);
			            	$clForecastWrap.find('#cl-support1').html(resultJson.Support_1);
			            	$clForecastWrap.find('#cl-support2').html(resultJson.Support_2);
			            	$clForecastWrap.find('#cl-support3').html(resultJson.Support_3);
			            	$clForecastWrap.find('#cl-support4').html(resultJson.Support_4);
			            	 
			            }
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $clStockForeCastEle.find(clStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},
		getCLIndiceCalculatorHtml:function($clStockForeCastEle,clIndexTabEle,indexCode,post_id,filter,calculateButton){
			if(indexCode){
				$.ajax({
			     	cache: false,
			      	crossDomain: true,
		         	config: {
		              	headers: {
		                 	'Access-Control-Allow-Origin': '*',
		              	}
		         	},
		         	beforeSend: function() {
		              if(!$clStockForeCastEle.find('.fb-loader').length){
		              		$clStockForeCastEle.find(clIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/cl-indices-calculator-html',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $clStockForeCastEle.find(clIndexTabEle).html(response);    
			            $clStockForeCastEle.find(clIndexTabEle).find('.fb-loader').remove();   
			            var $clForecastWrap=$('#cl-forecast-wrap');
			            if($(document).find('#cl-more-detail').length){
			            	var resultJson =$clForecastWrap.find(clIndexTabEle).find('#cl-indices-json-results').data('result-json');
			            	$clForecastWrap.find('#cl-trade-value').html(resultJson.Trade);
			            	$clForecastWrap.find('#cl-sentiment-value').html(resultJson.Sentiment);
			            	$clForecastWrap.find('#cl-resistance1').html(resultJson.Resistance_1);
			            	$clForecastWrap.find('#cl-resistance2').html(resultJson.Resistance_2);
			            	$clForecastWrap.find('#cl-resistance3').html(resultJson.Resistance_3);
			            	$clForecastWrap.find('#cl-resistance4').html(resultJson.Resistance_4);
			            	$clForecastWrap.find('#cl-support1').html(resultJson.Support_1);
			            	$clForecastWrap.find('#cl-support2').html(resultJson.Support_2);
			            	$clForecastWrap.find('#cl-support3').html(resultJson.Support_3);
			            	$clForecastWrap.find('#cl-support4').html(resultJson.Support_4);
			            	 
			            }
			      	},
			     	error: function(response){
			            $clStockForeCastEle.find(clIndexTabEle).find('.fb-loader').remove();   
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+finCode);
			}
		},
		getCLIndiceCalculator:function($clStockForeCastEle,clIndexTabEle,indexCode,post_id,filter,calculateButton){
			if(indexCode){
				$.ajax({
			     	cache: false,
			      	crossDomain: true,
		         	config: {
		              	headers: {
		                 	'Access-Control-Allow-Origin': '*',
		              	}
		         	},
		         	beforeSend: function() {
		              if(!$clStockForeCastEle.find('.fb-loader').length){
		              	$clStockForeCastEle.find(clIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/cl-indices-calculator',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $clStockForeCastEle.find(clIndexTabEle).find('#cl-indices-calculator-results').html(response);    
			            $clStockForeCastEle.find(clIndexTabEle).find('.fb-loader').remove();    
			            var $clForecastWrap=$('#cl-forecast-wrap');
			            if($(document).find('#cl-more-detail').length){
			            	var resultJson =$clForecastWrap.find(clIndexTabEle).find('#cl-indices-json-results').data('result-json');
			            	// console.log(resultJson)
			            	$clForecastWrap.find('#cl-trade-value').html(resultJson.Trade);
			            	$clForecastWrap.find('#cl-sentiment-value').html(resultJson.Sentiment);
			            	$clForecastWrap.find('#cl-resistance1').html(resultJson.Resistance_1);
			            	$clForecastWrap.find('#cl-resistance2').html(resultJson.Resistance_2);
			            	$clForecastWrap.find('#cl-resistance3').html(resultJson.Resistance_3);
			            	$clForecastWrap.find('#cl-resistance4').html(resultJson.Resistance_4);
			            	$clForecastWrap.find('#cl-support1').html(resultJson.Support_1);
			            	$clForecastWrap.find('#cl-support2').html(resultJson.Support_2);
			            	$clForecastWrap.find('#cl-support3').html(resultJson.Support_3);
			            	$clForecastWrap.find('#cl-support4').html(resultJson.Support_4);
			            	 
			            }
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $clStockForeCastEle.find(clIndexTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
			}
		},
		events: function() {
			var self    = this,
				$clStockForeCastEle  = $('#cl-stock-forecast-calculator');
				clStockTabEle  = '#clForeCastStock';
				clIndexTabEle  = '#clForeCastIndices';
			setTimeout(function(ele) {
				var post_id=$clStockForeCastEle.data('id');
				var calculateButton=$clStockForeCastEle.data('calculate-button');
				// For Stock Calculator Load
				if($clStockForeCastEle.find(clStockTabEle).length){
					var finCode=$clStockForeCastEle.find(clStockTabEle).data('fincode');
					var filter=$clStockForeCastEle.find(clStockTabEle).data('filter');
		        	self.getCLStockCalculatorHtml($clStockForeCastEle,clStockTabEle,finCode,post_id,filter,calculateButton);
				}
				// For Index Calculator Load
				if($clStockForeCastEle.find(clIndexTabEle).length){
					var indexCode=$clStockForeCastEle.find(clIndexTabEle).data('index-code');
					var filter=$clStockForeCastEle.find(clIndexTabEle).data('filter');
		        	self.getCLIndiceCalculatorHtml($clStockForeCastEle,clIndexTabEle,indexCode,post_id,filter,calculateButton);
		        }
	        }, 1,this);
			 
			// sma-stock-refresh and Calculate
			$(document).on('click','#cl-stock-calculator,#cl-stock-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$clStockForeCastEle.find('#cl-stock-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var post_id=$clStockForeCastEle.data('id');
				var calculateButton=$clStockForeCastEle.data('calculate-button');
				var finCode=$clStockForeCastEle.find(clStockTabEle).data('fincode');
				var filter=$clStockForeCastEle.find(clStockTabEle).data('filter');
				self.getCLStockCalculator($clStockForeCastEle,clStockTabEle,finCode,post_id,filter,calculateButton);
			});
			$(document).on('change','#cl-stocks',function(e){
				// $('#calculate-pivot-points').hide();
				$clStockForeCastEle.find('#cl-stock-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var finCode=$(this).val();
				var post_id=$clStockForeCastEle.data('id');
				var calculateButton=$clStockForeCastEle.data('calculate-button');
				$clStockForeCastEle.find(clStockTabEle).data('fincode',finCode);
				var filter=$clStockForeCastEle.find(clStockTabEle).data('filter');
				self.getCLStockCalculatorHtml($clStockForeCastEle,clStockTabEle,finCode,post_id,filter,calculateButton);
			});

			$(document).on('click','#cl-indices-calculator,#cl-indices-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$clStockForeCastEle.find('#cl-indices-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var post_id=$clStockForeCastEle.data('id');
				var calculateButton=$clStockForeCastEle.data('calculate-button');
				var indexCode=$clStockForeCastEle.find(clIndexTabEle).data('index-code');
				var filter=$clStockForeCastEle.find(clIndexTabEle).data('filter');
				self.getCLIndiceCalculator($clStockForeCastEle,clIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
 			$(document).on('change','#cl-indices',function(e){
				$clStockForeCastEle.find('#cl-indices-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$(this).val();
				$clStockForeCastEle.find(clIndexTabEle).data('index-code',indexCode);
				var post_id=$clStockForeCastEle.data('id');
				var calculateButton=$clStockForeCastEle.data('calculate-button');
				var filter=$clStockForeCastEle.find(clIndexTabEle).data('filter');
				self.getCLIndiceCalculatorHtml($clStockForeCastEle,clIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
			return this;
		},
	 
    };
  exports.CLForeCastCalculator = CLForeCastCalculator;

}).apply(this, [jQuery]);