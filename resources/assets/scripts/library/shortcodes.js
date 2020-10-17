// BrokerComparison
(function($) {

	var initialized = false;

	var BrokerComparison = {

			defaults: {
				loadingElement : '<h5 class="loading-data text-center col-md-12 mt-4" >Loading Data..Wait</h5>'
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

			events: function() {
				var self    = this,
					$brokerComparison  = $('#brokercomparison');

					$brokerComparison
	                .on( 'change', '#brokerselect1', function(event) {
			            var Broker = $(this).val();
			            $("#brokercomparison #brokerselect2 option").removeAttr('disabled');
			            $("#brokercomparison #brokerselect2 option[value='"+ Broker +"']").attr('disabled','disabled');
			            var strBroker1 = $("#brokercomparison #brokerselect1 option:selected" ).val();
			        });

	                $brokerComparison
	                .on( 'change', '#brokerselect2', function(event) {
			            var Broker = $(this).val();
			            $("#brokercomparison #brokerselect1 option").removeAttr('disabled');
			            $("#brokercomparison #brokerselect1 option[value='"+ Broker +"']").attr('disabled','disabled');
			            var strBroker2 = $("#brokercomparison #brokerselect2 option:selected" ).val();
			        });

	                $brokerComparison
	                .on( 'click', '.comlink', function(event) {		
						var strBroker1 = $( "#brokercomparison #brokerselect1 option:selected" ).val();
	        			var strBroker2 = $( "#brokercomparison #brokerselect2 option:selected" ).val();
	         			if((strBroker1 == '00') || (strBroker2 == '00')){
	             			event.preventDefault();
	         			}

	        			$("#brokercomparison").append(self.options.loadingElement);
						
						if((strBroker1 != '00') && (strBroker2 != '00')){
				            var url1 =  strBroker1+'-vs-'+strBroker2;
				            var url2 =  strBroker2+'-vs-'+strBroker1;
				            
				           var page_paths = [url1,url2];

				           $.ajax({
			    		    type:"POST",
			    		    url: global_vars.ajax_url,
			    		    data : {
			    				'action': 'brokercomparison_link_ajax_request',
			    				'page_paths': page_paths,
			    				'security': global_vars.ajax_nonce
			    			},
			                beforeSend: function() {
			              		$("#brokercomparison .loading-data").show();
			           		},
			    		    success:function(data){
			                  if(data == ''){
			                   alert('No comparision Found')  ; 
			                  }
			                  else{
			                      $("#brokercomparison .loading-data").hide();
			                      window.location.href = data;
			                  }
			                },
			                error: function(errorThrown){
			                      console.log(errorThrown);
			                }
			    		    
			    		});
				       }

					});

				return this;
			},

		};
	exports.BrokerComparison = BrokerComparison;

}).apply(this, [jQuery]);