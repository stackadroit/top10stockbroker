// SMA Fore Cast Calculators
(function($) {

  var initialized = false;

  var SMAForeCastCalculator = {
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
		 
		getStockCalculatorHtml:function($smaStockForeCastEle,smaStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$smaStockForeCastEle.find('.fb-loader').length){
		              	$smaStockForeCastEle.find(smaStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/sma-stock-calculator-html',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $smaStockForeCastEle.find(smaStockTabEle).html(response);    
			            $smaStockForeCastEle.find(smaStockTabEle).find('.fb-loader').remove();    
						var $smaForecastWrap=$('#sma-forecast-wrap');
			            if($(document).find('#sma-more-detail').length){
			            	var resultJson =$smaForecastWrap.find(smaStockTabEle).find('#sma-stock-json-results').data('result-json');
			            	$smaForecastWrap.find('#sma-trade-value').html(resultJson.Trade);
			            	$smaForecastWrap.find('#sma-sentiment-value').html(resultJson.Sentiment);
			            	$smaForecastWrap.find('#sma-7day').html(resultJson.sma_7day);
			            	$smaForecastWrap.find('#sma-15day').html(resultJson.sma_15day);
			            	$smaForecastWrap.find('#sma-30day').html(resultJson.sma_30day);
			            	$smaForecastWrap.find('#sma-50day').html(resultJson.sma_50day);
			            	$smaForecastWrap.find('#sma-100day').html(resultJson.sma_100day);
			            	$smaForecastWrap.find('#sma-200day').html(resultJson.sma_200day);
			            }
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $smaStockForeCastEle.find(smaStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},

		getStockCalculator:function($smaStockForeCastEle,smaStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$smaStockForeCastEle.find('.fb-loader').length){
		              	$smaStockForeCastEle.find(smaStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/sma-stock-calculator',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $smaStockForeCastEle.find(smaStockTabEle).find('#stock-calculator-results').html(response);    
			            $smaStockForeCastEle.find(smaStockTabEle).find('.fb-loader').remove();    
			            var $smaForecastWrap=$('#sma-forecast-wrap');
			            if($(document).find('#sma-more-detail').length){
			            	var resultJson =$smaForecastWrap.find(smaStockTabEle).find('#sma-stock-json-results').data('result-json');
			            	$smaForecastWrap.find('#sma-trade-value').html(resultJson.Trade);
			            	$smaForecastWrap.find('#sma-sentiment-value').html(resultJson.Sentiment);
			            	$smaForecastWrap.find('#sma-7day').html(resultJson.sma_7day);
			            	$smaForecastWrap.find('#sma-15day').html(resultJson.sma_15day);
			            	$smaForecastWrap.find('#sma-30day').html(resultJson.sma_30day);
			            	$smaForecastWrap.find('#sma-50day').html(resultJson.sma_50day);
			            	$smaForecastWrap.find('#sma-100day').html(resultJson.sma_100day);
			            	$smaForecastWrap.find('#sma-200day').html(resultJson.sma_200day);
			            }
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $smaStockForeCastEle.find(smaStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},
		getIndiceCalculatorHtml:function($smaStockForeCastEle,smaIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$smaStockForeCastEle.find('.fb-loader').length){
		              		$smaStockForeCastEle.find(smaIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/sma-indices-calculator-html',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $smaStockForeCastEle.find(smaIndexTabEle).html(response);    
			            $smaStockForeCastEle.find(smaIndexTabEle).find('.fb-loader').remove();   
			            var $smaForecastWrap=$('#sma-forecast-wrap');
			            if($(document).find('#sma-more-detail').length){
			            	var resultJson =$smaForecastWrap.find(smaIndexTabEle).find('#sma-indices-json-results').data('result-json');
			            	// console.log(resultJson)
			            	$smaForecastWrap.find('#sma-trade-value').html(resultJson.Trade);
			            	$smaForecastWrap.find('#sma-sentiment-value').html(resultJson.Sentiment);
			            	$smaForecastWrap.find('#sma-7day').html(resultJson.sma_7day);
			            	$smaForecastWrap.find('#sma-15day').html(resultJson.sma_15day);
			            	$smaForecastWrap.find('#sma-30day').html(resultJson.sma_30day);
			            	$smaForecastWrap.find('#sma-50day').html(resultJson.sma_50day);
			            	$smaForecastWrap.find('#sma-100day').html(resultJson.sma_100day);
			            	$smaForecastWrap.find('#sma-200day').html(resultJson.sma_200day);
			            	 
			            }
			      	},
			     	error: function(response){
			            $smaStockForeCastEle.find(smaIndexTabEle).find('.fb-loader').remove();   
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
			}
		},
		getIndiceCalculator:function($smaStockForeCastEle,smaIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$smaStockForeCastEle.find('.fb-loader').length){
		              	$smaStockForeCastEle.find(smaIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/sma-indices-calculator',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $smaStockForeCastEle.find(smaIndexTabEle).find('#indices-calculator-results').html(response);    
			            $smaStockForeCastEle.find(smaIndexTabEle).find('.fb-loader').remove();    
			            var $smaForecastWrap=$('#sma-forecast-wrap');
			            if($(document).find('#sma-more-detail').length){
			            	var resultJson =$smaForecastWrap.find(smaIndexTabEle).find('#sma-indices-json-results').data('result-json');
			            	// console.log(resultJson)
			            	$smaForecastWrap.find('#sma-trade-value').html(resultJson.Trade);
			            	$smaForecastWrap.find('#sma-sentiment-value').html(resultJson.Sentiment);
			            	$smaForecastWrap.find('#sma-7day').html(resultJson.sma_7day);
			            	$smaForecastWrap.find('#sma-15day').html(resultJson.sma_15day);
			            	$smaForecastWrap.find('#sma-30day').html(resultJson.sma_30day);
			            	$smaForecastWrap.find('#sma-50day').html(resultJson.sma_50day);
			            	$smaForecastWrap.find('#sma-100day').html(resultJson.sma_100day);
			            	$smaForecastWrap.find('#sma-200day').html(resultJson.sma_200day);
			            	 
			            }
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $smaStockForeCastEle.find(smaIndexTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
			}
		},
		events: function() {
			var self    = this,
				$smaStockForeCastEle  = $('#sma-stock-forecast-calculator');
				smaStockTabEle  = '#smaForeCastStock';
				smaIndexTabEle  = '#smaForeCastIndices';
			setTimeout(function(ele) {
				var post_id=$smaStockForeCastEle.data('id');
				var calculateButton=$smaStockForeCastEle.data('calculate-button');
				// For Stock Calculator Load
				if($smaStockForeCastEle.find(smaStockTabEle).length){
					var finCode=$smaStockForeCastEle.find(smaStockTabEle).data('fincode');
					var filter=$smaStockForeCastEle.find(smaStockTabEle).data('filter');
		        	self.getStockCalculatorHtml($smaStockForeCastEle,smaStockTabEle,finCode,post_id,filter,calculateButton);
				}
				// For Index Calculator Load
				if($smaStockForeCastEle.find(smaIndexTabEle).length){
					var indexCode=$smaStockForeCastEle.find(smaIndexTabEle).data('index-code');
					var filter=$smaStockForeCastEle.find(smaIndexTabEle).data('filter');
		        	self.getIndiceCalculatorHtml($smaStockForeCastEle,smaIndexTabEle,indexCode,post_id,filter,calculateButton);
		        }
	        }, 1,this);
			 
			// sma-stock-refresh and Calculate
			$(document).on('click','#sma-stock-calculator,#sma-stock-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$smaStockForeCastEle.find('#sma-stock-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var post_id=$smaStockForeCastEle.data('id');
				var calculateButton=$smaStockForeCastEle.data('calculate-button');
				var finCode=$smaStockForeCastEle.find(smaStockTabEle).data('fincode');
				var filter=$smaStockForeCastEle.find(smaStockTabEle).data('filter');
				self.getStockCalculator($smaStockForeCastEle,smaStockTabEle,finCode,post_id,filter,calculateButton);
			});
			$(document).on('change','#sma-stocks',function(e){
				$('#calculate-pivot-points').hide();
				$smaStockForeCastEle.find('#sma-stock-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var finCode=$(this).val();
				var post_id=$smaStockForeCastEle.data('id');
				var calculateButton=$smaStockForeCastEle.data('calculate-button');
				$smaStockForeCastEle.find(smaStockTabEle).data('fincode',finCode);
				var filter=$smaStockForeCastEle.find(smaStockTabEle).data('filter');
				self.getStockCalculatorHtml($smaStockForeCastEle,smaStockTabEle,finCode,post_id,filter,calculateButton);
			});

			$(document).on('click','#sma-indices-calculator,#sma-indices-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$smaStockForeCastEle.find('#sma-indices-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var post_id=$smaStockForeCastEle.data('id');
				var calculateButton=$smaStockForeCastEle.data('calculate-button');
				var indexCode=$smaStockForeCastEle.find(smaIndexTabEle).data('index-code');
				var filter=$smaStockForeCastEle.find(smaIndexTabEle).data('filter');
				self.getIndiceCalculator($smaStockForeCastEle,smaIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
 			$(document).on('change','#sma-indices',function(e){
				$smaStockForeCastEle.find('#sma-indices-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$(this).val();
				$smaStockForeCastEle.find(smaIndexTabEle).data('index-code',indexCode);
				var post_id=$smaStockForeCastEle.data('id');
				var calculateButton=$smaStockForeCastEle.data('calculate-button');
				var filter=$smaStockForeCastEle.find(smaIndexTabEle).data('filter');
				self.getIndiceCalculatorHtml($smaStockForeCastEle,smaIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
			return this;
		},
	 
    };
  exports.SMAForeCastCalculator = SMAForeCastCalculator;

}).apply(this, [jQuery]);