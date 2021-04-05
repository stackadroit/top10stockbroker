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
		 
		getStockCalculatorHtml:function($stockForeCastEle,stockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$stockForeCastEle.find('.fb-loader').length){
		              	$stockForeCastEle.find(stockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
			            $stockForeCastEle.find(stockTabEle).html(response);    
			            $stockForeCastEle.find(stockTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $stockForeCastEle.find(stockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},

		getStockCalculator:function($stockForeCastEle,stockTabEle,finCode,post_id,filter,calculateButton){
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
		              if(!$stockForeCastEle.find('.fb-loader').length){
		              	$stockForeCastEle.find(stockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
			            $stockForeCastEle.find(stockTabEle).find('#stock-calculator-results').html(response);    
			            $stockForeCastEle.find(stockTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $stockForeCastEle.find(stockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},
		getIndiceCalculatorHtml:function($stockForeCastEle,indexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$stockForeCastEle.find('.fb-loader').length){
		              		$stockForeCastEle.prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
			            $stockForeCastEle.find(indexTabEle).html(response);    
			            $stockForeCastEle.find(indexTabEle).find('.fb-loader').remove();   
			      	},
			     	error: function(response){
			            $stockForeCastEle.find(indexTabEle).find('.fb-loader').remove();   
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
			}
		},
		getIndiceCalculator:function($stockForeCastEle,indexTabEle,indexCode,post_id,filter,calculateButton){
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
		              if(!$stockForeCastEle.find('.fb-loader').length){
		              	$stockForeCastEle.find(indexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
			            $stockForeCastEle.find(indexTabEle).find('#indices-calculator-results').html(response);    
			            $stockForeCastEle.find(indexTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $stockForeCastEle.find(indexTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
			}
		},
		events: function() {
			var self    = this,
				$stockForeCastEle  = $('#sma-stock-forecast-calculator');
				stockTabEle  = '#smaForeCastStock';
				indexTabEle  = '#smaForeCastIndices';
			setTimeout(function(ele) {
				var post_id=$stockForeCastEle.data('id');
				var calculateButton=$stockForeCastEle.data('calculate-button');
				// For Stock Calculator Load
				var finCode=$stockForeCastEle.find(stockTabEle).data('fincode');
				var filter=$stockForeCastEle.find(stockTabEle).data('filter');
	        	self.getStockCalculatorHtml($stockForeCastEle,stockTabEle,finCode,post_id,filter,calculateButton);
				// For Index Calculator Load
				var indexCode=$stockForeCastEle.find(indexTabEle).data('index-code');
				var filter=$stockForeCastEle.find(indexTabEle).data('filter');
	        	self.getIndiceCalculatorHtml($stockForeCastEle,indexTabEle,indexCode,post_id,filter,calculateButton);
	        }, 1,this);
			 
			// sma-stock-refresh and Calculate
			$(document).on('click','#sma-stock-calculator,#sma-stock-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$stockForeCastEle.find('#stock-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var post_id=$stockForeCastEle.data('id');
				var calculateButton=$stockForeCastEle.data('calculate-button');
				var finCode=$stockForeCastEle.find(stockTabEle).data('fincode');
				var filter=$stockForeCastEle.find(stockTabEle).data('filter');
				self.getStockCalculator($stockForeCastEle,stockTabEle,finCode,post_id,filter,calculateButton);
			});
			$(document).on('change','#sma-stocks',function(e){
				$('#calculate-pivot-points').hide();
				$stockForeCastEle.find('#stock-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var finCode=$(this).val();
				var post_id=$stockForeCastEle.data('id');
				var calculateButton=$stockForeCastEle.data('calculate-button');
				$stockForeCastEle.find(stockTabEle).data('fincode',finCode);
				var filter=$stockForeCastEle.find(stockTabEle).data('filter');
				self.getStockCalculatorHtml($stockForeCastEle,stockTabEle,finCode,post_id,filter,calculateButton);
			});

			$(document).on('click','#sma-indices-calculator,#sma-indices-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$stockForeCastEle.find('#indices-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var post_id=$stockForeCastEle.data('id');
				var calculateButton=$stockForeCastEle.data('calculate-button');
				var indexCode=$stockForeCastEle.find(indexTabEle).data('index-code');
				var filter=$stockForeCastEle.find(indexTabEle).data('filter');
				self.getIndiceCalculator($stockForeCastEle,indexTabEle,indexCode,post_id,filter,calculateButton);
			});
 			$(document).on('change','#sma-indices',function(e){
				$stockForeCastEle.find('#indices-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$(this).val();
				$stockForeCastEle.find(indexTabEle).data('index-code',indexCode);
				var post_id=$stockForeCastEle.data('id');
				var calculateButton=$stockForeCastEle.data('calculate-button');
				var filter=$stockForeCastEle.find(indexTabEle).data('filter');
				self.getIndiceCalculatorHtml($stockForeCastEle,indexTabEle,indexCode,post_id,filter,calculateButton);
			});
			return this;
		},
	 
    };
  exports.SMAForeCastCalculator = SMAForeCastCalculator;

}).apply(this, [jQuery]);