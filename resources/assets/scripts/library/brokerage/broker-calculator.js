//assets to sales ratio calculator
(function($) {

	var initialized = false;

	var brokerCalculator = {

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
			compareStockBrokers:function(page_paths){
				jQuery.ajax({
	    		    type:"POST",
	    		    url: global_vars.ajax_url,
	    		    data : {
	    				'action': 'get_url',
	    				'page_paths': page_paths,
	    				'security': global_vars.ajax_nonce
	    			},
	                beforeSend: function() {
	              		$("#loading-image").show();
	           		},
           			cache:false,
	    		    success:function(data){
	    		     	console.log(data)
	                  	if(data == ''){
	                   		alert('No comparision Found')  ; 
	                  	}else{
	                      $("#loading-image").hide();
	                      var url = data;
	                      window.location.href = url;
	                  	}
	                },
	                error: function(errorThrown){
	                 	console.log(errorThrown);
	                }
    		    
    			});
			},
			brokerProfitLossCalculator:function(post_id,idx,buy_price,sell_price,number_lot,lot_size,number_share,stamp_duty){
				jQuery.ajax({
	    		    type:"POST",
	    		    url: global_vars.ajax_url,
	    		    dataType: "json",
	    		    data : {
	    				'action': 'get_broker_profit_loss_calculator',
	    				'post_id': post_id,
	    				'idx': idx,
	    				'buy_price': buy_price,
	    				'sell_price': sell_price,
	    				'number_lot': number_lot,
	    				'lot_size': lot_size,
	    				'number_share': number_share,
	    				'stamp_duty': stamp_duty,
	    				'security': global_vars.ajax_nonce
	    			},
	                beforeSend: function() {
	              		$("#loading-image").show();
	           		},
           			cache:false,
	    		    success:function(data){
	    		     	console.log(data)
	    		     	console.log(data.brokerage_turnover)
	    		     	$("#total_turnover"+idx).text(data.total_turnover);
					  jQuery("#brokerage"+idx).text(data.brokerage_turnover);
					  jQuery("#stt"+idx).text(data.stt_to);
					  jQuery("#sebi_turnover_fees"+idx).text(data.sebi_to);
					  
					  jQuery("#stamp_duty"+idx).text(data.stamp_duty_to);
					  jQuery("#transaction_charges"+idx).text(data.transaction_charges);
					  jQuery("#gst"+idx).text(data.gst_to);
					  jQuery("#total_brokerage"+idx).text(data.total_brokerage);
					  jQuery("#total_profit"+idx).text(data.total_profit);
					  
	                  	 
	                },
	                error: function(errorThrown){
	                 	console.log(errorThrown);
	                }
    		    
    			});
			},
			events: function() {
				var self    = this,
					$compareStockBrokersButton  = $('.comlink');
					// Choose Broker Change
					$(document)
	                .on('change','#choose_broker', function(event) {
	                	 var targetUrl =$(this).find("option:selected").val();
	                	 if(targetUrl){
	                	 	window.location.href = targetUrl;
	                	 }
			        });

	                $(document).find('.calculater').find('section:not(:first)').hide();
	                $(document).on('click','input[name="tabs"]',function(e){
	                	var clickIdx= $(this).data('tab-idx');
	                	$(document).find('.calculater').find('section').hide();
	                	$(document).find('.calculater').find('section#content'+clickIdx).show();
	                	// console.log(clickIdx);
	                });
			        $(document).on('click','#calculate1,#calculate2,#calculate3,#calculate4,#calculate5,#calculate6,#calculate7',function(e){
			        	e.preventDefault();
			        	var idx= $(this).data('cal-idx');
			        	var post_id= $(this).closest('.calculater').data('post-id');
			        	var buy_price = parseFloat($("#buy_price"+idx).val());
			        	console.log(idx);
			        	console.log(buy_price);
	  					var sell_price = parseFloat($("#sell_price"+idx).val());
	  					if(buy_price==""){
						   alert(" Please enter buy price.");
						   return false;
						}
						if(sell_price==""){
						   alert(" Please enter sell price.");
						   return false;
						}
						var  number_lot='';
						var  lot_size='';
						var  number_share='';
						if(idx==4 || idx==6){
							number_lot = parseFloat($("#number_lot"+idx).val());
							lot_size = parseFloat($("#lot_size"+idx).val());
							if(number_lot==""){
							   alert(" Please enter No. of Lots.");
							   return false;
							}
							if(lot_size==""){
							   alert(" Please enter Lot Size.");
							   return false;
							}
						}else{
							var number_share = parseFloat($("#number_share"+idx).val());
							if(number_share==""){
							   alert(" Please enter No. of shares.");
							   return false;
							}
						}
	    				var stamp_duty =parseFloat($("#state"+idx).val());
			 			self.brokerProfitLossCalculator(post_id,idx,buy_price,sell_price,number_lot,lot_size,number_share,stamp_duty);
			        });

				return this;
			},

		};
	exports.brokerCalculator = brokerCalculator;

}).apply(this, [jQuery]);
