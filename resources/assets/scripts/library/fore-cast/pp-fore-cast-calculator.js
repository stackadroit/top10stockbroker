// Fore Cast Calculators
(function($) {

  var initialized = false;

  var PPForeCastCalculator = {
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
		 
		getPPStockCalculatorHtml:function($pivotPointCalculator,ppStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$pivotPointCalculator.find('.fb-loader').length){
		              	$pivotPointCalculator.find(ppStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/react-fore-cast/get-pivot-points-html',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $pivotPointCalculator.find(ppStockTabEle).html(response);
			            $pivotPointCalculator.find(ppStockTabEle).find('.fb-loader').remove();   
			            var $ppForecastWrap=$('#pp-forecast-wrap');
			            if($(document).find('#pp-more-detail').length){
			            	var resultJson =$ppForecastWrap.find(ppStockTabEle).find('#pp-stock-json-results').data('result-json');
			            	if(resultJson){
				            	$ppForecastWrap.find('#pp-head-trade-value').html(resultJson.Trade);
				            	$ppForecastWrap.find('#pp-trade-value').html(resultJson.Trade);
				            	$ppForecastWrap.find('#pp-sentiment-value').html(resultJson.Sentiment);
				            	$ppForecastWrap.find('#pp-idx-resistance1').html(resultJson.Resistance_1);
				            	$ppForecastWrap.find('#pp-idx-resistance2').html(resultJson.Resistance_2);
				            	$ppForecastWrap.find('#pp-idx-resistance3').html(resultJson.Resistance_3);
				            	$ppForecastWrap.find('#pp-idx-support1').html(resultJson.Support_1);
				            	$ppForecastWrap.find('#pp-idx-support2').html(resultJson.Support_2);
				            	$ppForecastWrap.find('#pp-idx-support3').html(resultJson.Support_3);
			            	}
			            }    
			      	},
			     	error: function(response){
			            $pivotPointCalculator.find(ppStockTabEle).find('.fb-loader').remove();   
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
			 	$pivotPointCalculator.find('.fb-loader').remove();   
				console.log('finCode Not valid:'+finCode);
			}
		},

		getPPStockCalculator:function($pivotPointCalculator,ppStockTabEle,finCode,post_id,filter,LTP,calculateButton){
			if(finCode){
				$.ajax({
			     	cache: false,
			      	crossDomain: true,
		         	config: {
		              	headers: {
		                 	'Access-Control-Allow-Origin': '*',
		              	}
		         	},
		         	// beforeSend: function() {
		          //     $pivotPointCalculator.find('.fb-loader').remove();
		          //     $pivotPointCalculator.prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		          //   },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/react-fore-cast/calculate-pivot-points',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'LTP':LTP,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $pivotPointCalculator.find(ppStockTabEle).find('#pp-stock-calculator-results').html(response);    
			            $pivotPointCalculator.find(ppStockTabEle).find('.fb-loader').remove();
			            var $ppForecastWrap=$('#pp-forecast-wrap');
			            if($(document).find('#pp-more-detail').length){
			            	var resultJson =$ppForecastWrap.find(ppStockTabEle).find('#pp-stock-json-results').data('result-json');
			            	if(resultJson){
				            	$ppForecastWrap.find('#pp-head-trade-value').html(resultJson.Trade);
				            	$ppForecastWrap.find('#pp-trade-value').html(resultJson.Trade);
				            	$ppForecastWrap.find('#pp-sentiment-value').html(resultJson.Sentiment);
				            	$ppForecastWrap.find('#pp-idx-resistance1').html(resultJson.Resistance_1);
				            	$ppForecastWrap.find('#pp-idx-resistance2').html(resultJson.Resistance_2);
				            	$ppForecastWrap.find('#pp-idx-resistance3').html(resultJson.Resistance_3);
				            	$ppForecastWrap.find('#pp-idx-support1').html(resultJson.Support_1);
				            	$ppForecastWrap.find('#pp-idx-support2').html(resultJson.Support_2);
				            	$ppForecastWrap.find('#pp-idx-support3').html(resultJson.Support_3);
			            	}
			            } 
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			        	$pivotPointCalculator.find('.fb-loader').remove();
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
				$pivotPointCalculator.find('.fb-loader').remove();
			}
		},
		getPPIndiceCalculatorHtml:function($pivotPointCalculator,ppIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              // $pivotPointCalculator.find('.fb-loader').remove();
		              if(!$pivotPointCalculator.find('.fb-loader').length){
		              	$pivotPointCalculator.find(ppIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/react-fore-cast/get-pivot-points-indices-html',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $pivotPointCalculator.find(ppIndexTabEle).html(response);    
			            $pivotPointCalculator.find(ppIndexTabEle).find('.fb-loader').remove();   
			            var $ppForecastWrap=$('#pp-forecast-wrap');
			            if($(document).find('#pp-more-detail').length){
			            	var resultJson =$ppForecastWrap.find(ppIndexTabEle).find('#pp-indices-json-results').data('result-json');
			            	// console.log(resultJson)
			            	$ppForecastWrap.find('#pp-head-trade-value').html(resultJson.Trade);
			            	$ppForecastWrap.find('#pp-trade-value').html(resultJson.Trade);
			            	$ppForecastWrap.find('#pp-sentiment-value').html(resultJson.Sentiment);
			            	$ppForecastWrap.find('#pp-idx-resistance1').html(resultJson.Resistance_1);
			            	$ppForecastWrap.find('#pp-idx-resistance2').html(resultJson.Resistance_2);
			            	$ppForecastWrap.find('#pp-idx-resistance3').html(resultJson.Resistance_3);
			            	$ppForecastWrap.find('#pp-idx-support1').html(resultJson.Support_1);
			            	$ppForecastWrap.find('#pp-idx-support2').html(resultJson.Support_2);
			            	$ppForecastWrap.find('#pp-idx-support3').html(resultJson.Support_3);
			            }
			      	},
			     	error: function(response){
			     		$pivotPointCalculator.find(ppIndexTabEle).find('.fb-loader').remove();
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+finCode);
			}
		},
		getPPIndiceCalculator:function($pivotPointCalculator,ppIndexTabEle,indexCode,post_id,filter,LTP,calculateButton){
			if(indexCode){
				$.ajax({
			     	cache: false,
			      	crossDomain: true,
		         	config: {
		              	headers: {
		                 	'Access-Control-Allow-Origin': '*',
		              	}
		         	},
		         	// beforeSend: function() {
		          //     $pivotPointCalculator.find('.fb-loader').remove();
		          //     $pivotPointCalculator.prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		          //   },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/react-fore-cast/calculate-indices-pivot-points',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'LTP':LTP,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $pivotPointCalculator.find(ppIndexTabEle).find('#pp-indices-calculator-results').html(response);    
			            $pivotPointCalculator.find(ppIndexTabEle).find('.fb-loader').remove();
			            var $ppForecastWrap=$('#pp-forecast-wrap');
			            if($(document).find('#pp-more-detail').length){
			            	var resultJson =$ppForecastWrap.find(ppIndexTabEle).find('#pp-indices-json-results').data('result-json');
			            	// console.log(resultJson)
			            	$ppForecastWrap.find('#pp-head-trade-value').html(resultJson.Trade);
			            	$ppForecastWrap.find('#pp-trade-value').html(resultJson.Trade);
			            	$ppForecastWrap.find('#pp-sentiment-value').html(resultJson.Sentiment);
			            	$ppForecastWrap.find('#pp-idx-resistance1').html(resultJson.Resistance_1);
			            	$ppForecastWrap.find('#pp-idx-resistance2').html(resultJson.Resistance_2);
			            	$ppForecastWrap.find('#pp-idx-resistance3').html(resultJson.Resistance_3);
			            	$ppForecastWrap.find('#pp-idx-support1').html(resultJson.Support_1);
			            	$ppForecastWrap.find('#pp-idx-support2').html(resultJson.Support_2);
			            	$ppForecastWrap.find('#pp-idx-support3').html(resultJson.Support_3);
			            }
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			        	$pivotPointCalculator.find('.fb-loader').remove();
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
				$pivotPointCalculator.find('.fb-loader').remove();
			}
		},
		events: function() {
			var self    = this,
				$pivotPointCalculator  = $('#pp-stock-forecast-calculator');
				ppStockTabEle  = '#ppForeCastStock';
				ppIndexTabEle  = '#ppForeCastIndices';
				setTimeout(function(ele) {
					var post_id=$pivotPointCalculator.data('id');
					var calculateButton=$pivotPointCalculator.data('calculate-button');
					// For Stock Calculator Load
					if($pivotPointCalculator.find(ppStockTabEle).length){
						var finCode=$pivotPointCalculator.find(ppStockTabEle).data('fincode');
						var filter=$pivotPointCalculator.find(ppStockTabEle).data('filter');
			        	self.getPPStockCalculatorHtml($pivotPointCalculator,ppStockTabEle,finCode,post_id,filter,calculateButton);
					}
					// For Index Calculator Load
					if($pivotPointCalculator.find(ppIndexTabEle).length){
						var indexCode=$pivotPointCalculator.find(ppIndexTabEle).data('index-code');
						var filter=$pivotPointCalculator.find(ppIndexTabEle).data('filter');
		        		self.getPPIndiceCalculatorHtml($pivotPointCalculator,ppIndexTabEle,indexCode,post_id,filter,calculateButton);
		        	}
		        }, 1,this);
			$(document).on('click','#pp-stock-calculator,#pp-stock-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$pivotPointCalculator.find('#pp-stock-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var post_id=$pivotPointCalculator.data('id');
				var calculateButton=$pivotPointCalculator.data('calculate-button');
				var finCode=$pivotPointCalculator.find(ppStockTabEle).data('fincode');
				var filter=$pivotPointCalculator.find(ppStockTabEle).data('filter');
				self.getPPStockCalculator($pivotPointCalculator,ppStockTabEle,finCode,post_id,filter,calculateButton);
			});
 			$(document).on('change','#pp-stock',function(e){
				$pivotPointCalculator.find('#pp-stock-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var finCode=$(this).val();
				$pivotPointCalculator.find(ppStockTabEle).data('fin-code',finCode);
				var post_id=$pivotPointCalculator.data('id');
				var calculateButton=$pivotPointCalculator.data('calculate-button');
				var filter=$pivotPointCalculator.find(ppStockTabEle).data('filter');
				self.getPPStockCalculatorHtml($pivotPointCalculator,ppStockTabEle,finCode,post_id,filter,calculateButton);
			});

			$(document).on('click','#pp-indices-calculator,#pp-indices-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$pivotPointCalculator.find('#pp-indices-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var post_id=$pivotPointCalculator.data('id');
				var calculateButton=$pivotPointCalculator.data('calculate-button');
				var indexCode=$pivotPointCalculator.find(ppIndexTabEle).data('index-code');
				var filter=$pivotPointCalculator.find(ppIndexTabEle).data('filter');
				self.getPPIndiceCalculator($pivotPointCalculator,ppIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
 			$(document).on('change','#pp-indices',function(e){
				$pivotPointCalculator.find('#pp-indices-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$(this).val();
				$pivotPointCalculator.find(ppIndexTabEle).data('index-code',indexCode);
				var post_id=$pivotPointCalculator.data('id');
				var calculateButton=$pivotPointCalculator.data('calculate-button');
				var filter=$pivotPointCalculator.find(ppIndexTabEle).data('filter');
				self.getPPIndiceCalculatorHtml($pivotPointCalculator,ppIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
    
			return this;
		},
	 
    };
  exports.PPForeCastCalculator = PPForeCastCalculator;

}).apply(this, [jQuery]);