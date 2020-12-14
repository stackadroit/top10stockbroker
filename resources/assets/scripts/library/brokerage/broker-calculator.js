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

				return this;
			},

		};
	exports.brokerCalculator = brokerCalculator;

}).apply(this, [jQuery]);
