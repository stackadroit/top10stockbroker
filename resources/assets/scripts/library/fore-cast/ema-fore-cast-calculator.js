// EMA Fore Cast Calculators
(function($) {

  var initialized = false;

  var EMAForeCastCalculator = {
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
		 
		getEMAStockCalculatorHtml:function($emastockForeCastEle,emaStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$emastockForeCastEle.find('.fb-loader').length){
		              	$emastockForeCastEle.find(emaStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/ema-stock-calculator-html',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $emastockForeCastEle.find(emaStockTabEle).html(response);    
			            $emastockForeCastEle.find(emaStockTabEle).find('.fb-loader').remove();    
			            var $emaForecastWrap=$('#ema-forecast-wrap');
			            if($(document).find('#ema-more-detail').length){
			            	var resultJson =$emaForecastWrap.find(emaStockTabEle).find('#ema-stock-json-results').data('result-json');
			            	if(resultJson){
				            	$emaForecastWrap.find('#ema-trade-value').html(resultJson.Trade);
				            	$emaForecastWrap.find('#ema-sentiment-value').html(resultJson.Sentiment);
				            	$emaForecastWrap.find('#ema-9day').html(resultJson.ema_9day);
				            	$emaForecastWrap.find('#ema-12day').html(resultJson.ema_12day);
				            	$emaForecastWrap.find('#ema-26day').html(resultJson.ema_26day);
				            	$emaForecastWrap.find('#ema-50day').html(resultJson.ema_50day);
				            	$emaForecastWrap.find('#ema-100day').html(resultJson.ema_100day);
				            }
			            } 
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $emastockForeCastEle.find(emaStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},

		getEMAStockCalculator:function($emastockForeCastEle,emaStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$emastockForeCastEle.find('.fb-loader').length){
		              	$emastockForeCastEle.find(emaStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/ema-stock-calculator',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $emastockForeCastEle.find(emaStockTabEle).find('#stock-calculator-results').html(response);    
			            $emastockForeCastEle.find(emaStockTabEle).find('.fb-loader').remove();    
			            var $emaForecastWrap=$('#ema-forecast-wrap');
			            if($(document).find('#ema-more-detail').length){
			            	var resultJson =$emaForecastWrap.find(emaStockTabEle).find('#ema-stock-json-results').data('result-json');
			            	if(resultJson){
				            	$emaForecastWrap.find('#ema-trade-value').html(resultJson.Trade);
				            	$emaForecastWrap.find('#ema-sentiment-value').html(resultJson.Sentiment);
				            	$emaForecastWrap.find('#ema-9day').html(resultJson.ema_9day);
				            	$emaForecastWrap.find('#ema-12day').html(resultJson.ema_12day);
				            	$emaForecastWrap.find('#ema-26day').html(resultJson.ema_26day);
				            	$emaForecastWrap.find('#ema-50day').html(resultJson.ema_50day);
				            	$emaForecastWrap.find('#ema-100day').html(resultJson.ema_100day);
				            }
			            } 
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $emastockForeCastEle.find(emaStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},
		getEMAIndiceCalculatorHtml:function($emastockForeCastEle,emaIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$emastockForeCastEle.find('.fb-loader').length){
		              		$emastockForeCastEle.find(emaIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/ema-indices-calculator-html',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $emastockForeCastEle.find(emaIndexTabEle).html(response);    
			            $emastockForeCastEle.find(emaIndexTabEle).find('.fb-loader').remove();
			            var $emaForecastWrap=$('#ema-forecast-wrap');
			            if($(document).find('#ema-more-detail').length){
			            	var resultJson =$emaForecastWrap.find(emaIndexTabEle).find('#ema-indices-json-results').data('result-json');
			            	// console.log(resultJson)
			            	$emaForecastWrap.find('#ema-trade-value').html(resultJson.Trade);
			            	$emaForecastWrap.find('#ema-sentiment-value').html(resultJson.Sentiment);
			            	$emaForecastWrap.find('#ema-9day').html(resultJson.ema_9day);
			            	$emaForecastWrap.find('#ema-12day').html(resultJson.ema_12day);
			            	$emaForecastWrap.find('#ema-26day').html(resultJson.ema_26day);
			            	$emaForecastWrap.find('#ema-50day').html(resultJson.ema_50day);
			            	$emaForecastWrap.find('#ema-100day').html(resultJson.ema_100day);
			            	 
			            }   
			      	},
			     	error: function(response){
			            $emastockForeCastEle.find(emaIndexTabEle).find('.fb-loader').remove();   
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+finCode);
			}
		},
		getEMAIndiceCalculator:function($emastockForeCastEle,emaIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$emastockForeCastEle.find('.fb-loader').length){
		              	$emastockForeCastEle.find(emaIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/ema-indices-calculator',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $emastockForeCastEle.find(emaIndexTabEle).find('#indices-calculator-results').html(response);    
			            $emastockForeCastEle.find(emaIndexTabEle).find('.fb-loader').remove();    
			            var $emaForecastWrap=$('#ema-forecast-wrap');
			            if($(document).find('#ema-more-detail').length){
			            	var resultJson =$emaForecastWrap.find(emaIndexTabEle).find('#ema-indices-json-results').data('result-json');
			            	// console.log(resultJson)
			            	$emaForecastWrap.find('#ema-trade-value').html(resultJson.Trade);
			            	$emaForecastWrap.find('#ema-sentiment-value').html(resultJson.Sentiment);
			            	$emaForecastWrap.find('#ema-9day').html(resultJson.ema_9day);
			            	$emaForecastWrap.find('#ema-12day').html(resultJson.ema_12day);
			            	$emaForecastWrap.find('#ema-26day').html(resultJson.ema_26day);
			            	$emaForecastWrap.find('#ema-50day').html(resultJson.ema_50day);
			            	$emaForecastWrap.find('#ema-100day').html(resultJson.ema_100day);
			            	 
			            } 
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $emastockForeCastEle.find(emaIndexTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
			}
		},
		events: function() {
			var self    = this,
				$emastockForeCastEle  = $('#ema-stock-forecast-calculator');
				emaStockTabEle  = '#emaForeCastStock';
				emaIndexTabEle  = '#emaForeCastIndices';
			setTimeout(function(ele) {
				var post_id=$emastockForeCastEle.data('id');
				var calculateButton=$emastockForeCastEle.data('calculate-button');
				// For Stock Calculator Load
				if($emastockForeCastEle.find(emaStockTabEle).length){
					var finCode=$emastockForeCastEle.find(emaStockTabEle).data('fincode');
					var filter=$emastockForeCastEle.find(emaStockTabEle).data('filter');
		        	self.getEMAStockCalculatorHtml($emastockForeCastEle,emaStockTabEle,finCode,post_id,filter,calculateButton);
				}
				// For Index Calculator Load
				if($emastockForeCastEle.find(emaIndexTabEle).length){
					var indexCode=$emastockForeCastEle.find(emaIndexTabEle).data('index-code');
					var filter=$emastockForeCastEle.find(emaIndexTabEle).data('filter');
	        		self.getEMAIndiceCalculatorHtml($emastockForeCastEle,emaIndexTabEle,indexCode,post_id,filter,calculateButton);
	        	}
	        }, 1,this);
			 
			// sma-stock-refresh and Calculate
			$(document).on('click','#ema-stock-calculator,#ema-stock-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$emastockForeCastEle.find('#ema-stock-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var post_id=$emastockForeCastEle.data('id');
				var calculateButton=$emastockForeCastEle.data('calculate-button');
				var finCode=$emastockForeCastEle.find(emaStockTabEle).data('fincode');
				var filter=$emastockForeCastEle.find(emaStockTabEle).data('filter');
				self.getEMAStockCalculator($emastockForeCastEle,emaStockTabEle,finCode,post_id,filter,calculateButton);
			});
			$(document).on('change','#ema-stocks',function(e){
				$('#calculate-pivot-points').hide();
				$emastockForeCastEle.find('#ema-stock-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var finCode=$(this).val();
				var post_id=$emastockForeCastEle.data('id');
				var calculateButton=$emastockForeCastEle.data('calculate-button');
				$emastockForeCastEle.find(emaStockTabEle).data('fincode',finCode);
				var filter=$emastockForeCastEle.find(emaStockTabEle).data('filter');
				self.getEMAStockCalculatorHtml($emastockForeCastEle,emaStockTabEle,finCode,post_id,filter,calculateButton);
			});

			$(document).on('click','#ema-indices-calculator,#ema-indices-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$emastockForeCastEle.find('#ema-indices-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var post_id=$emastockForeCastEle.data('id');
				var calculateButton=$emastockForeCastEle.data('calculate-button');
				var indexCode=$emastockForeCastEle.find(emaIndexTabEle).data('index-code');
				var filter=$emastockForeCastEle.find(emaIndexTabEle).data('filter');
				self.getEMAIndiceCalculator($emastockForeCastEle,emaIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
 			$(document).on('change','#ema-indices',function(e){
				$emastockForeCastEle.find('#ema-indices-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$(this).val();
				$emastockForeCastEle.find(emaIndexTabEle).data('index-code',indexCode);
				var post_id=$emastockForeCastEle.data('id');
				var calculateButton=$emastockForeCastEle.data('calculate-button');
				var filter=$emastockForeCastEle.find(emaIndexTabEle).data('filter');
				self.getEMAIndiceCalculatorHtml($emastockForeCastEle,emaIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
			return this;
		},
	 
    };
  exports.EMAForeCastCalculator = EMAForeCastCalculator;

}).apply(this, [jQuery]);