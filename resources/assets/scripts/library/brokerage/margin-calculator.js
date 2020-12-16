//assets to sales ratio calculator
(function($) {

	var initialized = false;

	var marginCalculator = {

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
			calculateMarginCalculator:function(ele,prefix,post_id,script_name,margin,share_price){
				jQuery.ajax({
	    		    type:"POST",
	    		    url: global_vars.ajax_url,
	    		    dataType: "json",
	    		    data : {
	    				'action': 'get_calculate_margin_calculator',
	    				'prefix': prefix,
	    				'post_id': post_id,
	    				'script_name': script_name,
	    				'margin': margin,
	    				'share_price': share_price,
	    				'security': global_vars.ajax_nonce
	    			},
	                beforeSend: function() {
	              		$("#loading-image").show();
	           		},
           			cache:false,
	    		    success:function(data){
	    		     	console.log(data)
                
	                  	if(data === undefined){
	                   		alert('No comparision Found')  ; 
	                  	}else{
                  			$(ele).find('input').each(function() {
    							if ($(this).val() == '') { 
     								alert("Please fill in all the required fields");
    								return false;
    							}else{
    								$("#loading-image_de").hide();
        							var url = data;
	                  	 		}
	                  		});
                  			var marginStockPrice= Math.round(data.margin/data.share_price);
                  			var margincx = parseInt(data.meta_value);
                  			var exposureMarginAvl=margincx*data.margin;
                  			var exposureMarginBought=Math.round(exposureMarginAvl/data.share_price);
                  			var leverage=margincx+'x Leverage';
                  			var marginOutput = '<div class="margin-output"><table><thead><tr><th>&nbsp;</th><th>Margin Available</th><th>Shares Can be Bought</th></tr></thead><tbody><tr><td>Available Margin</td><td class="mo-marAvail">'+data.margin+'</td><td class="mo-marStock">'+marginStockPrice+'</td></tr><tr><td>Exposure Margin</td><td class="mo-expoAvail">'+exposureMarginAvl+'</td><td  class="mo-expoStock">'+exposureMarginBought+'</td></tr></tbody></table><div class="leverage">'+leverage+'</div></div>';
                    		$(ele).find('.margin-output').remove();
                    		$(ele).find('#loading-image').remove();
                    		$(ele).append(marginOutput);
	                  	}
	                },
	                error: function(errorThrown){
	                	$(ele).find('#loading-image').remove();
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
			        //Intraday Search Scrip
	                $('#marAutocomp').immybox({
			          choices:$('#marAutocomp').data('options') ,
			          defaultSelectedValue: 'LA'
			        });
			        //Delivery Search Scrip
			        $('#marAutocomp_de').immybox({
			          choices:$('#marAutocomp_de').data('options') ,
			          defaultSelectedValue: 'LA'
			        });
			        //Commodity Search Scrip
			        $('#marAutocomp_co').immybox({
			          choices:$('#marAutocomp_co').data('options') ,
			          defaultSelectedValue: 'LA'
			        });
			        //Currency Search Scrip
			        $('#marAutocomp_cu').immybox({
			          choices:$('#marAutocomp_cu').data('options') ,
			          defaultSelectedValue: 'LA'
			        });
			        $(document).on('click','.calculate_margin',function(e){
			        	e.preventDefault();
			        	var ele=$(this).closest('form');
			        	$(this).closest('form').append('<h5 id="loading-image" style="text-align:center; text-transform:uppercase;">Loading Data..Wait</h5>');
			        	var prefix= $(this).closest('form').find('input[name="prefix"]').val();
			        	var post_id= $(this).closest('form').find('input[name="post_id"]').val();
			        	var script_name= $(this).closest('form').find('input[name="script_name"]').val();
			        	var margin= $(this).closest('form').find('input[name="margin"]').val();
			        	var share_price= $(this).closest('form').find('input[name="share_price"]').val();
			        	self.calculateMarginCalculator(ele,prefix,post_id,script_name,margin,share_price); 
			        });

				return this;
			},

		};
	exports.marginCalculator = marginCalculator;

}).apply(this, [jQuery]);
