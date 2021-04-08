// RSI Fore Cast Calculators
(function($) {

  var initialized = false;

  var RSIForeCastCalculator = {
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
		 
		getRSIStockCalculatorHtml:function($rsiStockForeCastEle,rsiStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$rsiStockForeCastEle.find('.fb-loader').length){
		              	$rsiStockForeCastEle.find(rsiStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/rsi-stock-calculator-html',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $rsiStockForeCastEle.find(rsiStockTabEle).html(response);    
			            $rsiStockForeCastEle.find(rsiStockTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $rsiStockForeCastEle.find(rsiStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},

		getRSIStockCalculator:function($rsiStockForeCastEle,rsiStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$rsiStockForeCastEle.find('.fb-loader').length){
		              	$rsiStockForeCastEle.find(rsiStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/rsi-stock-calculator',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $rsiStockForeCastEle.find(rsiStockTabEle).find('#rsi-stock-calculator-results').html(response);    
			            $rsiStockForeCastEle.find(rsiStockTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $rsiStockForeCastEle.find(rsiStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},
		getRSIIndiceCalculatorHtml:function($rsiStockForeCastEle,rsiIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$rsiStockForeCastEle.find('.fb-loader').length){
		              		$rsiStockForeCastEle.prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/rsi-indices-calculator-html',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $rsiStockForeCastEle.find(rsiIndexTabEle).html(response);    
			            $rsiStockForeCastEle.find(rsiIndexTabEle).find('.fb-loader').remove();   
			      	},
			     	error: function(response){
			            $rsiStockForeCastEle.find(rsiIndexTabEle).find('.fb-loader').remove();   
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+finCode);
			}
		},
		getRSIIndiceCalculator:function($rsiStockForeCastEle,rsiIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$rsiStockForeCastEle.find('.fb-loader').length){
		              	$rsiStockForeCastEle.find(rsiIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/rsi-indices-calculator',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $rsiStockForeCastEle.find(rsiIndexTabEle).find('#rsi-indices-calculator-results').html(response);    
			            $rsiStockForeCastEle.find(rsiIndexTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $rsiStockForeCastEle.find(rsiIndexTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
			}
		},
		events: function() {
			var self    = this,
				$rsiStockForeCastEle  = $('#rsi-stock-forecast-calculator');
				rsiStockTabEle  = '#rsiForeCastStock';
				rsiIndexTabEle  = '#rsiForeCastIndices';
			setTimeout(function(ele) {
				var post_id=$rsiStockForeCastEle.data('id');
				var calculateButton=$rsiStockForeCastEle.data('calculate-button');
				// For Stock Calculator Load
				var finCode=$rsiStockForeCastEle.find(rsiStockTabEle).data('fincode');
				var filter=$rsiStockForeCastEle.find(rsiStockTabEle).data('filter');
	        	self.getRSIStockCalculatorHtml($rsiStockForeCastEle,rsiStockTabEle,finCode,post_id,filter,calculateButton);
				// For Index Calculator Load
				var indexCode=$rsiStockForeCastEle.find(rsiIndexTabEle).data('index-code');
				var filter=$rsiStockForeCastEle.find(rsiIndexTabEle).data('filter');
	        	self.getRSIIndiceCalculatorHtml($rsiStockForeCastEle,rsiIndexTabEle,indexCode,post_id,filter,calculateButton);
	        }, 1,this);
			 
			// rsi-stock-refresh and Calculate
			$(document).on('click','#rsi-stock-calculator,#rsi-stock-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$rsiStockForeCastEle.find('#rsi-stock-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var post_id=$rsiStockForeCastEle.data('id');
				var calculateButton=$rsiStockForeCastEle.data('calculate-button');
				var finCode=$rsiStockForeCastEle.find(rsiStockTabEle).data('fincode');
				var filter=$rsiStockForeCastEle.find(rsiStockTabEle).data('filter');
				self.getRSIStockCalculator($rsiStockForeCastEle,rsiStockTabEle,finCode,post_id,filter,calculateButton);
			});
			$(document).on('change','#rsi-stocks',function(e){
				// $('#rsi-calculate-pivot-points').hide();
				$rsiStockForeCastEle.find('#rsi-stock-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var finCode=$(this).val();
				var post_id=$rsiStockForeCastEle.data('id');
				var calculateButton=$rsiStockForeCastEle.data('calculate-button');
				$rsiStockForeCastEle.find(rsiStockTabEle).data('fincode',finCode);
				var filter=$rsiStockForeCastEle.find(rsiStockTabEle).data('filter');
				self.getRSIStockCalculatorHtml($rsiStockForeCastEle,rsiStockTabEle,finCode,post_id,filter,calculateButton);
			});

			$(document).on('click','#rsi-indices-calculator,#rsi-indices-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$rsiStockForeCastEle.find('#rsi-indices-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var post_id=$rsiStockForeCastEle.data('id');
				var calculateButton=$rsiStockForeCastEle.data('calculate-button');
				var indexCode=$rsiStockForeCastEle.find(rsiIndexTabEle).data('index-code');
				var filter=$rsiStockForeCastEle.find(rsiIndexTabEle).data('filter');
				self.getRSIIndiceCalculator($rsiStockForeCastEle,rsiIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
 			$(document).on('change','#rsi-indices',function(e){
				$rsiStockForeCastEle.find('#rsi-indices-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$(this).val();
				$rsiStockForeCastEle.find(rsiIndexTabEle).data('index-code',indexCode);
				var post_id=$rsiStockForeCastEle.data('id');
				var calculateButton=$rsiStockForeCastEle.data('calculate-button');
				var filter=$rsiStockForeCastEle.find(rsiIndexTabEle).data('filter');
				self.getRSIIndiceCalculatorHtml($rsiStockForeCastEle,rsiIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
			return this;
		},
	 
    };
  exports.RSIForeCastCalculator = RSIForeCastCalculator;

}).apply(this, [jQuery]);