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
      ajax: function( page_paths ){
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

              $("#brokercomparison .loading-data").remove();
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
      },
			events: function() {
				var self    = this,
					$brokerComparison  = $('#brokercomparison');

					$brokerComparison
          .on( 'change', '#brokerselect1', function(event) {
	            var Broker = $(this).val();
	            $("#brokerselect2 option").removeAttr('disabled');
	            $("#brokerselect2 option[value='"+ Broker +"']").attr('disabled','disabled');
	            var strBroker1 = $("#brokerselect1 option:selected" ).val();
	        });

          $brokerComparison
          .on( 'change', '#brokerselect2', function(event) {
              var Broker = $(this).val();
              $("#brokerselect1 option").removeAttr('disabled');
              $("#brokerselect1 option[value='"+ Broker +"']").attr('disabled','disabled');
              var strBroker2 = $("#brokerselect2 option:selected" ).val();
	        });

          $brokerComparison
          .on( 'click', '.comlink', function(event) {		
					    var strBroker1 = $( "#brokerselect1 option:selected" ).val();
        			var strBroker2 = $( "#brokerselect2 option:selected" ).val();
         			if((strBroker1 == '00') || (strBroker2 == '00')){
             			event.preventDefault();
         			}

  			      $("#brokercomparison").append(self.options.loadingElement);
						
						  if((strBroker1 != '00') && (strBroker2 != '00')){
				          var url1 =  strBroker1+'-vs-'+strBroker2;
				          var url2 =  strBroker2+'-vs-'+strBroker1;
				          var page_paths = [url1,url2];

                  self.ajax(page_paths);
				      }
					});

				return this;
			},

		};
	exports.BrokerComparison = BrokerComparison;

}).apply(this, [jQuery]);

// GoldInvestmentCalculator
(function($) {

  var initialized = false;

  var GoldInvestmentCalculator = {

      defaults: {
      	wrapper: $('.gold-investment-calculator')
      },

      initialize: function($wrapper, opts) {
        if (initialized) {
          return this;
        }

        initialized = true;
        this.$wrapper = ($wrapper || this.defaults.wrapper); 

        this
          .setOptions(opts)
          .events(); 

        return this;
      },

      setOptions: function(opts) {
        this.options = $.extend(true, {}, this.defaults, opts, window.theme.fn.getOptions(this.$wrapper.data('plugin-options')));

        return this;
      },
      
      ajax: function( ele, type, p_id, carat, g_invest, g_timeline){
        var self    = this; 
        $.ajax({
              cache: false,
              type:"POST",
              dataType: "html",
              url: global_vars.ajax_url,
              data : {
                'action': 'goldsilver_investment_calculator',
                'security': global_vars.ajax_nonce,
                'type':type,
                'p_id':p_id,
                'carat':carat,
                'g_invest':g_invest,
                'g_timeline':g_timeline,
              },
            success: function(response){
               $(ele).find('.get_gold_silver_return_result').html(response);
            },
            error: function(response){
              console.log('Gold Silver Calculator Error.'); 
            }
        });

          return this;
      },

      events: function() {
        var self    = this,
          $rootnode  = $(document);

          $rootnode
          .on( 'click', '.getGoldSilverCalculatedResult', function(e) {
              e.preventDefault();

              var ele = $(this).closest('form');
              var type = $(ele).find('[name="type"]').val();
              var p_id = $(ele).find('[name="p_id"]').val();
              var carat = '';
              if(type == 1){
                var carat = $(ele).find('[name="carat"]').val();
                if(carat ==''){
                  alert('Select Carat.');
                  return false;
                }
              }

              var g_invest =$(ele).find('[name="g_invest"]').val();
              if(g_invest ==''){
                alert('Select Investment Amount.');
                return false;
              }

              var g_timeline = $(ele).find('[name="g_timeline"]').val();
              if(g_timeline ==''){
                alert('Select Timeline.');
                return false;
              }
              self.ajax(ele, type, p_id, carat, g_invest, g_timeline);
              return false;
          });
        return this;
      },

    };
  exports.GoldInvestmentCalculator = GoldInvestmentCalculator;

}).apply(this, [jQuery]);

// GoldRateComparison
(function($) {

  var initialized = false;

  var GoldRateComparison = {

      defaults: {
      },

      initialize: function($wrapper, opts) {
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
      
      ajax: function( ele, p_id1, p_id2, p_id3, carat, g_invest, g_timeline ){
        var self    = this; 
        $.ajax({
              cache: false,
              type:"POST",
              dataType: "html",
              url: global_vars.ajax_url,
              data : {
                'action': 'gold_rate_comparison_calculate',
                'security': global_vars.ajax_nonce,
                'p_id1':p_id1,
                'p_id2':p_id2,
                'p_id3':p_id3,
                'carat':carat,
                'g_invest':g_invest,
                'g_timeline':g_timeline,
              },
            success: function(response){
               $(ele).find('.get_gold_rate_comparison_result').html(response);
            },
            error: function(response){
              console.log('gold rate comparison Calculator Error.');
            }
        });

          return this;
      },

      events: function() {
        var self    = this,
          $rootnode  = $(document);

          $rootnode
          .on( 'click', '.getGoldRateComparisonResult', function(e) {
              e.preventDefault();

              var ele =$(this).closest('form');
              var p_id1 =$(ele).find('[name="p_id1"]').val();
              var p_id2 =$(ele).find('[name="p_id2"]').val();
              var p_id3 =$(ele).find('[name="p_id3"]').val();
              var carat =$(ele).find('[name="carat"]').val();
             
             if(carat ==''){
               alert('Select Carat.');
               return false;
             }

             if(p_id1 =='' && p_id2 =='' && p_id3 ==''){
                alert('Select at least one City / States.');
                return false;
              }

              var g_invest =$(ele).find('[name="g_invest"]').val();
              if(g_invest ==''){
                alert('Select Investment Amount.');
                return false;
              }
              var g_timeline =$(ele).find('[name="g_timeline"]').val();
              if(g_timeline ==''){
                alert('Select Timeline.');
                return false;
              }

              self.ajax(ele, p_id1, p_id2, p_id3, carat, g_invest, g_timeline );
              return false;
          });
        return this;
      },

    };
  exports.GoldRateComparison = GoldRateComparison;

}).apply(this, [jQuery]);