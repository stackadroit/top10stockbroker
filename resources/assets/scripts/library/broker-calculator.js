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
					// Compare Stock Brokers
					$compareStockBrokersButton
	                .on( 'click', function(event) {
	                	
	                	var strBroker1 = $( "#brokerselect1 option:selected" ).val();
				        var strBroker2 = $( "#brokerselect2 option:selected" ).val();
				        if((strBroker1 == '00') || (strBroker2 == '00')){
				             event.preventDefault();
				        }
				        $('.selectbrockerdiv').append('<h5 id="loading-image" style="display:none; text-align:center; text-transform:uppercase;">Loading Data..Wait</h5>');
			           if((strBroker1 != '00') && (strBroker2 != '00')){
				            var url1 =  strBroker1+'-vs-'+strBroker2;
				            var url2 =  strBroker2+'-vs-'+strBroker1;
				           	var page_paths = [url1,url2];
				           	// console.log(page_paths);
				           	// return false;
			           		self.compareStockBrokers(page_paths);
				       }
			        });

				return this;
			},

		};
	exports.brokerCalculator = brokerCalculator;

}).apply(this, [jQuery]);
