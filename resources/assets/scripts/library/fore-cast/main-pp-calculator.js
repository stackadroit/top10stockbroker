// Fore Cast Calculators
(function($) {

  var initialized = false;

  var MainPPCalculator = {
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
		getPPCalculator:function($pivotPointCalculator,finCode,post_id,is_single){
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
		              $pivotPointCalculator.find('.fb-loader').remove();
		              $pivotPointCalculator.prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/react-fore-cast/get-pivot-points',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'is_single':is_single,
			      	},
			      	success: function(response){
			            $pivotPointCalculator.html(response);    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
			
		},
		getPPCalculatorHtml:function($pivotPointCalculator,finCode,post_id,filter){
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
		              // $pivotPointCalculator.find('.fb-loader').remove();
		              if(!$pivotPointCalculator.find('.fb-loader').length){
		              	$pivotPointCalculator.find('#pivotPointStock').prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/react-fore-cast/get-pivot-points-html',
	             	data: {
			          	'finCode':finCode,
			         	'post_id':post_id,
			         	'filter':filter,
			      	},
			      	success: function(response){
			            $pivotPointCalculator.find('#pivotPointStock').html(response);    
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('finCode Not valid:'+finCode);
			}
		},

		calculatePivotPoints:function($pivotPointCalculator,finCode,post_id,filter,LTP){
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
			      	},
			      	success: function(response){
			            $pivotPointCalculator.find('#pivot-points-results').html(response);    
			            $pivotPointCalculator.find('#calculate-pivot-points').show();
			            $pivotPointCalculator.find('.fb-loader').remove();
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
		getPPIndiceCalculatorHtml:function($pivotPointCalculator,indexCode,post_id,filter){
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
		              	$pivotPointCalculator.prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		              }
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/react-fore-cast/get-pivot-points-indices-html',
	             	data: {
			          	'indexCode':indexCode,
			         	'post_id':post_id,
			         	'filter':filter,
			      	},
			      	success: function(response){
			            $pivotPointCalculator.find('#pivotPointIndices').html(response);    
			            $pivotPointCalculator.find('.fb-loader').remove();   
			      	},
			     	error: function(response){
			     		$pivotPointCalculator.find('.fb-loader').remove();
			        	console.log('Error in loading...'); 
			      	}
				});
			}else{
				console.log('indexCode Not valid:'+finCode);
			}
		},
		getPPLists:function($pivotPointCalculator){
			 
			$.ajax({
			     	cache: false,
			      	crossDomain: true,
		         	config: {
		              	headers: {
		                 	'Access-Control-Allow-Origin': '*',
		              	}
		         	},
		         	beforeSend: function() {
		              $pivotPointCalculator.find('.fb-loader').remove();
		              $pivotPointCalculator.prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
		            },
			      	type:"post",
			     	dataType: "html",
			      	url: global_vars.apiServerUrl + '/apiblock/react-fore-cast/main-pp-lists',
	             	data: {
			          // 	'indexCode':indexCode,
			         	// 'post_id':post_id,
			         	// 'filter':filter,
			         	// 'LTP':LTP,
			      	},
			      	success: function(response){
			            $pivotPointCalculator.find('#main-pp-lists tbody').html(response);    
			            $pivotPointCalculator.find('.fb-loader').remove();
			      	},
			     	error: function(response){
			        	console.log('Error in loading...'); 
			        	$pivotPointCalculator.find('.fb-loader').remove();
			      	}
			});
			 
		},
		events: function() {
			var self    = this,
				$pivotPointCalculator  = $('#main-pp-calculator');
			setTimeout(function(ele) {
				self.getPPLists($pivotPointCalculator);
	        }, 3000,this);
			 
			// calculate-pivot-points
			$(document).on('click','#calculate-pivot-points',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$(this).after('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>')
				var finCode=$pivotPointCalculator.find('#pivotPointStock').data('fincode');
				var post_id=$pivotPointCalculator.data('id');
				var filter=$pivotPointCalculator.find('#pivotPointStock').data('filter');
				self.calculatePivotPoints($pivotPointCalculator,finCode,post_id,filter,LTP);
			});

			$(document).on('click','#pivot-point-refresh',function(e){
				e.preventDefault();
				$pivotPointCalculator.find('#pivot-points-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var LTP=$(this).data('ltp');
				var finCode=$pivotPointCalculator.find('#pivotPointStock').data('fincode');
				var post_id=$pivotPointCalculator.data('id');
				var filter=$pivotPointCalculator.find('#pivotPointStock').data('filter');
				self.calculatePivotPoints($pivotPointCalculator,finCode,post_id,filter,LTP);
			});

			$(document).on('change','#pivot-point-stocks',function(e){
				$('#calculate-pivot-points').hide();
				$pivotPointCalculator.find('#pivot-points-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var finCode=$(this).val();
				$pivotPointCalculator.find('#pivotPointStock').data('fincode',finCode);
				var post_id=$pivotPointCalculator.data('id');
				var filter=$pivotPointCalculator.find('#pivotPointStock').data('filter');
				self.getPPCalculatorHtml($pivotPointCalculator,finCode,post_id,filter);
			});
			$(document).on('change','#pivot-point-indices',function(e){
				$pivotPointCalculator.find('#indices-pivot-points-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$(this).val();
				$pivotPointCalculator.find('#pivotPointIndices').data('index-code',indexCode);
				var post_id=$pivotPointCalculator.data('id');
				var filter=$pivotPointCalculator.find('#pivotPointIndices').data('filter');
				self.getPPIndiceCalculatorHtml($pivotPointCalculator,indexCode,post_id,filter);
			});

			$(document).on('click','#calculate-indices-pivot-points,#pivot-point-indices-refresh',function(e){
				e.preventDefault();
				var LTP=$(this).data('ltp');
				$pivotPointCalculator.find('#indices-pivot-points-results').html('<div class="fb-loader loader mx-auto" style="margin-top: 15px;margin-bottom:20px;"></div>');
				var indexCode=$pivotPointCalculator.find('#pivotPointIndices').data('index-code');
				var post_id=$pivotPointCalculator.data('id');
				var filter=$pivotPointCalculator.find('#pivotPointIndices').data('filter');
				self.calculateIndicePivotPoints($pivotPointCalculator,indexCode,post_id,filter,LTP);
			});
			

			return this;
		},
	 
    };
  exports.MainPPCalculator = MainPPCalculator;

}).apply(this, [jQuery]);