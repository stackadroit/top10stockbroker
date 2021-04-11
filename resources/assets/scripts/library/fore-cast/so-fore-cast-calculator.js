// SO Fore Cast Calculators
(function($) {

  var initialized = false;

  var SOForeCastCalculator = {
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
		 
		getSOStockCalculatorHtml:function($soStockForeCastEle,soStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$soStockForeCastEle.find('.fb-loader').length){
		              	$soStockForeCastEle.find(soStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/so-stock-calculator-html',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $soStockForeCastEle.find(soStockTabEle).html(response);    
			            $soStockForeCastEle.find(soStockTabEle).find('.fb-loader').remove();
			            var $soForecastWrap=$('#so-forecast-wrap');
			            if($(document).find('#so-more-detail').length){
			            	var resultJson =$soForecastWrap.find(soStockTabEle).find('#so-stock-json-results').data('result-json');
			            	$soForecastWrap.find('#so-trade-value').html(resultJson.Trade);
			            	$soForecastWrap.find('#so-sentiment-value').html(resultJson.Sentiment);
			            	$soForecastWrap.find('#so-pre-k').html(resultJson.pre_K);
			            	$soForecastWrap.find('#so-pre-d').html(resultJson.pre_D);
			            }   
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $soStockForeCastEle.find(soStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},

		getSOStockCalculator:function($soStockForeCastEle,soStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$soStockForeCastEle.find('.fb-loader').length){
		              	$soStockForeCastEle.find(soStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/so-stock-calculator',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $soStockForeCastEle.find(soStockTabEle).find('#so-stock-calculator-results').html(response);    
			            $soStockForeCastEle.find(soStockTabEle).find('.fb-loader').remove(); 
			            var $soForecastWrap=$('#so-forecast-wrap');
			            if($(document).find('#so-more-detail').length){
			            	var resultJson =$soForecastWrap.find(soStockTabEle).find('#so-stock-json-results').data('result-json');
			            	$soForecastWrap.find('#so-trade-value').html(resultJson.Trade);
			            	$soForecastWrap.find('#so-sentiment-value').html(resultJson.Sentiment);
			            	$soForecastWrap.find('#so-pre-k').html(resultJson.pre_K);
			            	$soForecastWrap.find('#so-pre-d').html(resultJson.pre_D);
			            }   
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $soStockForeCastEle.find(soStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},
		getSOIndiceCalculatorHtml:function($soStockForeCastEle,soIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$soStockForeCastEle.find('.fb-loader').length){
		              		$soStockForeCastEle.find(soIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/so-indices-calculator-html',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $soStockForeCastEle.find(soIndexTabEle).html(response);    
			            $soStockForeCastEle.find(soIndexTabEle).find('.fb-loader').remove();   
			            var $soForecastWrap=$('#so-forecast-wrap');
			            if($(document).find('#so-more-detail').length){
			            	var resultJson =$soForecastWrap.find(soIndexTabEle).find('#so-indices-json-results').data('result-json');
			            	$soForecastWrap.find('#so-trade-value').html(resultJson.Trade);
			            	$soForecastWrap.find('#so-sentiment-value').html(resultJson.Sentiment);
			            	$soForecastWrap.find('#so-pre-k').html(resultJson.pre_K);
			            	$soForecastWrap.find('#so-pre-d').html(resultJson.pre_D);
			            }
			      	},
			     	error: function(response){
			            $soStockForeCastEle.find(soIndexTabEle).find('.fb-loader').remove();   
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+finCode);
			}
		},
		getSOIndiceCalculator:function($soStockForeCastEle,soIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$soStockForeCastEle.find('.fb-loader').length){
		              	$soStockForeCastEle.find(soIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/so-indices-calculator',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $soStockForeCastEle.find(soIndexTabEle).find('#so-indices-calculator-results').html(response);    
			            $soStockForeCastEle.find(soIndexTabEle).find('.fb-loader').remove();    
			            var $soForecastWrap=$('#so-forecast-wrap');
			            if($(document).find('#so-more-detail').length){
			            	var resultJson =$soForecastWrap.find(soIndexTabEle).find('#so-indices-json-results').data('result-json');
			            	$soForecastWrap.find('#so-trade-value').html(resultJson.Trade);
			            	$soForecastWrap.find('#so-sentiment-value').html(resultJson.Sentiment);
			            	$soForecastWrap.find('#so-pre-k').html(resultJson.pre_K);
			            	$soForecastWrap.find('#so-pre-d').html(resultJson.pre_D);
			            }
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $soStockForeCastEle.find(soIndexTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
			}
		},
		events: function() {
			var self    = this,
				$soStockForeCastEle  = $('#so-stock-forecast-calculator');
				soStockTabEle  = '#soForeCastStock';
				soIndexTabEle  = '#soForeCastIndices';
			setTimeout(function(ele) {
				var post_id=$soStockForeCastEle.data('id');
				var calculateButton=$soStockForeCastEle.data('calculate-button');
				// For Stock Calculator Load
				if($soStockForeCastEle.find(soStockTabEle).length){
					var finCode=$soStockForeCastEle.find(soStockTabEle).data('fincode');
					var filter=$soStockForeCastEle.find(soStockTabEle).data('filter');
		        	self.getSOStockCalculatorHtml($soStockForeCastEle,soStockTabEle,finCode,post_id,filter,calculateButton);
				}
				// For Index Calculator Load
				if($soStockForeCastEle.find(soIndexTabEle).length){
					var indexCode=$soStockForeCastEle.find(soIndexTabEle).data('index-code');
					var filter=$soStockForeCastEle.find(soIndexTabEle).data('filter');
		        	self.getSOIndiceCalculatorHtml($soStockForeCastEle,soIndexTabEle,indexCode,post_id,filter,calculateButton);
				}
	        }, 1,this);
			 
			// rsi-stock-refresh and Calculate
			$(document).on('click','#so-stock-calculator,#so-stock-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$soStockForeCastEle.find('#so-stock-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var post_id=$soStockForeCastEle.data('id');
				var calculateButton=$soStockForeCastEle.data('calculate-button');
				var finCode=$soStockForeCastEle.find(soStockTabEle).data('fincode');
				var filter=$soStockForeCastEle.find(soStockTabEle).data('filter');
				self.getSOStockCalculator($soStockForeCastEle,soStockTabEle,finCode,post_id,filter,calculateButton);
			});
			$(document).on('change','#so-stocks',function(e){
				// $('#rsi-calculate-pivot-points').hide();
				$soStockForeCastEle.find('#so-stock-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var finCode=$(this).val();
				var post_id=$soStockForeCastEle.data('id');
				var calculateButton=$soStockForeCastEle.data('calculate-button');
				$soStockForeCastEle.find(soStockTabEle).data('fincode',finCode);
				var filter=$soStockForeCastEle.find(soStockTabEle).data('filter');
				self.getSOStockCalculatorHtml($soStockForeCastEle,soStockTabEle,finCode,post_id,filter,calculateButton);
			});

			$(document).on('click','#so-indices-calculator,#so-indices-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$soStockForeCastEle.find('#so-indices-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var post_id=$soStockForeCastEle.data('id');
				var calculateButton=$soStockForeCastEle.data('calculate-button');
				var indexCode=$soStockForeCastEle.find(soIndexTabEle).data('index-code');
				var filter=$soStockForeCastEle.find(soIndexTabEle).data('filter');
				self.getSOIndiceCalculator($soStockForeCastEle,soIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
 			$(document).on('change','#so-indices',function(e){
				$soStockForeCastEle.find('#so-indices-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$(this).val();
				$soStockForeCastEle.find(soIndexTabEle).data('index-code',indexCode);
				var post_id=$soStockForeCastEle.data('id');
				var calculateButton=$soStockForeCastEle.data('calculate-button');
				var filter=$soStockForeCastEle.find(soIndexTabEle).data('filter');
				self.getSOIndiceCalculatorHtml($soStockForeCastEle,soIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
			return this;
		},
	 
    };
  exports.SOForeCastCalculator = SOForeCastCalculator;

}).apply(this, [jQuery]);