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
		 
		getEMAStockCalculatorHtml:function($emastockForeCastEle,emastockTabEle,finCode,post_id,filter,calculateButton){
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
		              	$emastockForeCastEle.find(emastockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
			            $emastockForeCastEle.find(emastockTabEle).html(response);    
			            $emastockForeCastEle.find(emastockTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $emastockForeCastEle.find(emastockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},

		getEMAStockCalculator:function($emastockForeCastEle,emastockTabEle,finCode,post_id,filter,calculateButton){
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
		              	$emastockForeCastEle.find(emastockTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
			            $emastockForeCastEle.find(emastockTabEle).find('#stock-calculator-results').html(response);    
			            $emastockForeCastEle.find(emastockTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $emastockForeCastEle.find(emastockTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},
		getEMAIndiceCalculatorHtml:function($emastockForeCastEle,emaindexTabEle,indexCode,post_id,filter,calculateButton){
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
		              		$emastockForeCastEle.prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
			            $emastockForeCastEle.find(emaindexTabEle).html(response);    
			            $emastockForeCastEle.find(emaindexTabEle).find('.fb-loader').remove();   
			      	},
			     	error: function(response){
			            $emastockForeCastEle.find(emaindexTabEle).find('.fb-loader').remove();   
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+finCode);
			}
		},
		getEMAIndiceCalculator:function($emastockForeCastEle,emaindexTabEle,indexCode,post_id,filter,calculateButton){
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
		              	$emastockForeCastEle.find(emaindexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
			            $emastockForeCastEle.find(emaindexTabEle).find('#indices-calculator-results').html(response);    
			            $emastockForeCastEle.find(emaindexTabEle).find('.fb-loader').remove();    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			            $emastockForeCastEle.find(emaindexTabEle).find('.fb-loader').remove();    
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+indexCode);
			}
		},
		events: function() {
			var self    = this,
				$emastockForeCastEle  = $('#ema-stock-forecast-calculator');
				emastockTabEle  = '#emaForeCastStock';
				emaindexTabEle  = '#emaForeCastIndices';
			setTimeout(function(ele) {
				var post_id=$emastockForeCastEle.data('id');
				var calculateButton=$emastockForeCastEle.data('calculate-button');
				// For Stock Calculator Load
				var finCode=$emastockForeCastEle.find(emastockTabEle).data('fincode');
				var filter=$emastockForeCastEle.find(emastockTabEle).data('filter');
	        	self.getEMAStockCalculatorHtml($emastockForeCastEle,emastockTabEle,finCode,post_id,filter,calculateButton);
				// For Index Calculator Load
				var indexCode=$emastockForeCastEle.find(emaindexTabEle).data('index-code');
				var filter=$emastockForeCastEle.find(emaindexTabEle).data('filter');
	        	self.getEMAIndiceCalculatorHtml($emastockForeCastEle,emaindexTabEle,indexCode,post_id,filter,calculateButton);
	        }, 1,this);
			 
			// sma-stock-refresh and Calculate
			$(document).on('click','#ema-stock-calculator,#ema-stock-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$emastockForeCastEle.find('#stock-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var post_id=$emastockForeCastEle.data('id');
				var calculateButton=$emastockForeCastEle.data('calculate-button');
				var finCode=$emastockForeCastEle.find(emastockTabEle).data('fincode');
				var filter=$emastockForeCastEle.find(emastockTabEle).data('filter');
				self.getEMAStockCalculator($emastockForeCastEle,emastockTabEle,finCode,post_id,filter,calculateButton);
			});
			$(document).on('change','#ema-stocks',function(e){
				$('#calculate-pivot-points').hide();
				$emastockForeCastEle.find('#stock-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var finCode=$(this).val();
				var post_id=$emastockForeCastEle.data('id');
				var calculateButton=$emastockForeCastEle.data('calculate-button');
				$emastockForeCastEle.find(emastockTabEle).data('fincode',finCode);
				var filter=$emastockForeCastEle.find(emastockTabEle).data('filter');
				self.getEMAStockCalculatorHtml($emastockForeCastEle,emastockTabEle,finCode,post_id,filter,calculateButton);
			});

			$(document).on('click','#ema-indices-calculator,#ema-indices-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$emastockForeCastEle.find('#indices-calculator-results').prepend('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var post_id=$emastockForeCastEle.data('id');
				var calculateButton=$emastockForeCastEle.data('calculate-button');
				var indexCode=$emastockForeCastEle.find(emaindexTabEle).data('index-code');
				var filter=$emastockForeCastEle.find(emaindexTabEle).data('filter');
				self.getEMAIndiceCalculator($emastockForeCastEle,emaindexTabEle,indexCode,post_id,filter,calculateButton);
			});
 			$(document).on('change','#ema-indices',function(e){
				$emastockForeCastEle.find('#indices-calculator-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$(this).val();
				$emastockForeCastEle.find(emaindexTabEle).data('index-code',indexCode);
				var post_id=$emastockForeCastEle.data('id');
				var calculateButton=$emastockForeCastEle.data('calculate-button');
				var filter=$emastockForeCastEle.find(emaindexTabEle).data('filter');
				self.getEMAIndiceCalculatorHtml($emastockForeCastEle,emaindexTabEle,indexCode,post_id,filter,calculateButton);
			});
			return this;
		},
	 
    };
  exports.EMAForeCastCalculator = EMAForeCastCalculator;

}).apply(this, [jQuery]);