// macd Fore Cast Calculators
(function($) {

  var initialized = false;

  var MACDForeCastCalculator = {
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
		 
		getMACDStockCalculatorHtml:function($macdStockForeCastEle,macdStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$macdStockForeCastEle.find('.fb-loader').length){
		              	$macdStockForeCastEle.find(macdStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/macd-stock-calculator-html',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $macdStockForeCastEle.find(macdStockTabEle).html(response);    
			            $macdStockForeCastEle.find(macdStockTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $macdStockForeCastEle.find(macdStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},

		getMACDStockCalculator:function($macdStockForeCastEle,macdStockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$macdStockForeCastEle.find('.fb-loader').length){
		              	$macdStockForeCastEle.find(macdStockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/macd-stock-calculator',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $macdStockForeCastEle.find(macdStockTabEle).find('#macd-stock-calculator-results').html(response);    
			            $macdStockForeCastEle.find(macdStockTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $macdStockForeCastEle.find(macdStockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},
		getMACDIndiceCalculatorHtml:function($macdStockForeCastEle,macdIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$macdStockForeCastEle.find('.fb-loader').length){
		              		$macdStockForeCastEle.prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/macd-indices-calculator-html',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $macdStockForeCastEle.find(macdIndexTabEle).html(response);    
			            $macdStockForeCastEle.find(macdIndexTabEle).find('.fb-loader').remove();   
			      	},
			     	error: function(response){
			            $macdStockForeCastEle.find(macdIndexTabEle).find('.fb-loader').remove();   
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+finCode);
			}
		},
		getMACDIndiceCalculator:function($macdStockForeCastEle,macdIndexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$macdStockForeCastEle.find('.fb-loader').length){
		              	$macdStockForeCastEle.find(macdIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/macd-indices-calculator',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			         	'calculateButton':calculateButton,
			      	},
			      	success: function(response){
			            $macdStockForeCastEle.find(macdIndexTabEle).find('#macd-indices-calculator-results').html(response);    
			            $macdStockForeCastEle.find(macdIndexTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $macdStockForeCastEle.find(macdIndexTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
			}
		},
		events: function() {
			var self    = this,
				$macdStockForeCastEle  = $('#macd-stock-forecast-calculator');
				macdStockTabEle  = '#macdForeCastStock';
				macdIndexTabEle  = '#macdForeCastIndices';
			setTimeout(function(ele) {
				var post_id=$macdStockForeCastEle.data('id');
				var calculateButton=$macdStockForeCastEle.data('calculate-button');
				// For Stock Calculator Load
				var finCode=$macdStockForeCastEle.find(macdStockTabEle).data('fincode');
				var filter=$macdStockForeCastEle.find(macdStockTabEle).data('filter');
	        	self.getMACDStockCalculatorHtml($macdStockForeCastEle,macdStockTabEle,finCode,post_id,filter,calculateButton);
				// For Index Calculator Load
				var indexCode=$macdStockForeCastEle.find(macdIndexTabEle).data('index-code');
				var filter=$macdStockForeCastEle.find(macdIndexTabEle).data('filter');
	        	self.getMACDIndiceCalculatorHtml($macdStockForeCastEle,macdIndexTabEle,indexCode,post_id,filter,calculateButton);
	        }, 1,this);
			 
			// sma-stock-refresh and Calculate
			$(document).on('click','#macd-stock-calculator,#macd-stock-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$macdStockForeCastEle.find('#macd-stock-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var post_id=$macdStockForeCastEle.data('id');
				var calculateButton=$macdStockForeCastEle.data('calculate-button');
				var finCode=$macdStockForeCastEle.find(macdStockTabEle).data('fincode');
				var filter=$macdStockForeCastEle.find(macdStockTabEle).data('filter');
				self.getMACDStockCalculator($macdStockForeCastEle,macdStockTabEle,finCode,post_id,filter,calculateButton);
			});
			$(document).on('change','#macd-stocks',function(e){
				$('#calculate-pivot-points').hide();
				$macdStockForeCastEle.find('#macd-stock-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var finCode=$(this).val();
				var post_id=$macdStockForeCastEle.data('id');
				var calculateButton=$macdStockForeCastEle.data('calculate-button');
				$macdStockForeCastEle.find(macdStockTabEle).data('fincode',finCode);
				var filter=$macdStockForeCastEle.find(macdStockTabEle).data('filter');
				self.getMACDStockCalculatorHtml($macdStockForeCastEle,macdStockTabEle,finCode,post_id,filter,calculateButton);
			});

			$(document).on('click','#macd-indices-calculator,#macd-indices-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$macdStockForeCastEle.find('#macd-indices-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var post_id=$macdStockForeCastEle.data('id');
				var calculateButton=$macdStockForeCastEle.data('calculate-button');
				var indexCode=$macdStockForeCastEle.find(macdIndexTabEle).data('index-code');
				var filter=$macdStockForeCastEle.find(macdIndexTabEle).data('filter');
				self.getMACDIndiceCalculator($macdStockForeCastEle,macdIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
 			$(document).on('change','#macd-indices',function(e){
				$macdStockForeCastEle.find('#macd-indices-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$(this).val();
				$macdStockForeCastEle.find(macdIndexTabEle).data('index-code',indexCode);
				var post_id=$macdStockForeCastEle.data('id');
				var calculateButton=$macdStockForeCastEle.data('calculate-button');
				var filter=$macdStockForeCastEle.find(macdIndexTabEle).data('filter');
				self.getMACDIndiceCalculatorHtml($macdStockForeCastEle,macdIndexTabEle,indexCode,post_id,filter,calculateButton);
			});
			return this;
		},
	 
    };
  exports.MACDForeCastCalculator = MACDForeCastCalculator;

}).apply(this, [jQuery]);