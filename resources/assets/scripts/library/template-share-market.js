(function($) {

	var initialized = false;

	var TemplateShareMarket = {

			defaults: {
				loadingElement : ''
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
      
      getStockMarket: function( indexCode,liveUpdateElement ){

        $.ajax({
            type:"POST",
            url: global_vars.apiServerUrl + '/api/stock-market',
            data : {
              'action': 'get_stock_market_details',
              'indexCode': indexCode,
              'security': global_vars.ajax_nonce
            },
            beforeSend: function() {
              $(liveUpdateElement).find(".loading-data").show();
            },
            success:function(response){
              console.log(response.stocks);
              response =response.stocks;
              $(liveUpdateElement).find(".loading-data").remove();
                if(response == ''){
                    
                }
                else{
                  if(liveUpdateElement == '#stock-market-live'){
                    $(liveUpdateElement).find('#indecName').html(response.INDEX_NAME);
                    $(liveUpdateElement).find('#indecName').attr('data-indices-code',indexCode);
                    $(liveUpdateElement).find('#currentStockRate').html(response.PRICE);
                    $(liveUpdateElement).find('#currentStockChange').html(response.CHANGE + '('+response.PER_CHANGE+'%)');
                    if(response.CHANGE >0){
                        $(liveUpdateElement).find('#currentStockChangee').removeClass('color-red').addClass('color-green');
                        $(liveUpdateElement).find('#currentStockRateArrow').removeClass('fa-arrow-down color-red').addClass('fa-arrow-up color-green');
                    }else{
                        $(liveUpdateElement).find('#currentStockChange').removeClass('color-green').addClass('color-red');
                        $(liveUpdateElement).find('#currentStockRateArrow').removeClass('fa-arrow-up color-green').addClass('fa-arrow-down color-red');
                    }
                   
                    $(liveUpdateElement).find('#52weeklow').html(response["52WEEKLOW"]);
                    $(liveUpdateElement).find('#52weekhigh').html(response["52WEEKHIGH"]);
                    
                    $(liveUpdateElement).find('#daylow').html(response.LOW);
                    $(liveUpdateElement).find('#dayhigh').html(response.HIGH);
                    $(liveUpdateElement).find('#prevclose').html(response.PREV_CLOSE);
                    $(liveUpdateElement).find('#open').html(response.OPEN);
                    $(liveUpdateElement).find('#mcaprs').html(response.ADV);
                    $(liveUpdateElement).find('#totalrs').html(response.DEC);
                    var owlblclass =(response['WEEKPERCHANGE'] >0)?"text-green":"text-red";
                    $(liveUpdateElement).find('#1wreturn').removeClass('text-green').removeClass('text-red').addClass(owlblclass).html(response.WEEKPERCHANGE);
                    var omlblclass =(response['MONTHPERCHANGE'] >0)?"text-green":"text-red";
                    $(liveUpdateElement).find('#1mreturn').removeClass('text-green').removeClass('text-red').addClass(omlblclass).html(response.MONTHPERCHANGE);
                    var smlblclass =(response['6MONTHPERCHANGE'] >0)?"text-green":"text-red";
                    $(liveUpdateElement).find('#6mreturn').removeClass('text-green').removeClass('text-red').addClass(smlblclass).html(response['6MONTHPERCHANGE']);
                    var orlblclass =(response['1YEARPERCHANGE'] >0)?"text-green":"text-red";
                    $(liveUpdateElement).find('#1yreturn').removeClass('text-green').removeClass('text-red').addClass(orlblclass).html(response['1YEARPERCHANGE']);
                  }
                }
              },
              error: function(errorThrown){
                $(liveUpdateElement).find(".loading-data").remove();
                console.log(errorThrown);
              }
        });
      },
      getShareMarketGainerLooser: function(type,apiExchg,intra_day,indecCode,sectorsSectionWrap){
        var shareMarketGainer="#share-market-gainer-looser";
        $.ajax({
            type:"POST",
            url: global_vars.apiServerUrl + '/apiblock/share-market/gainer-looser',
            data: {
                'action':'get_share_market_gainer_looser',
                'type':type,
                'apiExchg':apiExchg,
                'intra_day':intra_day,
                'indecCode':indecCode,
            },
            beforeSend: function() {
              $(sectorsSectionWrap).find(".loading-data").show();
            },
            success:function(response){
              $(sectorsSectionWrap).find(".loading-data").remove();
                $(document).find(shareMarketGainer).html(response);
              },
            error: function(errorThrown){
              $(sectorsSectionWrap).find(".loading-data").remove();
                console.log(errorThrown);
            }
        });
      },
      ajax: function( SearchTxt ){
        $.ajax({
            type:"POST",
            url: global_vars.ajax_url,
            data : {
              'action':'get_company_list',
              'SearchTxt': SearchTxt,
            },
            beforeSend: function() {
              // $("#brokercomparison .loading-data").show();
            },
            success:function(data){
              $(document).find('#company-list-wrap').show(); 
              $(document).find('#company-list').show().html(data); 
              
            },
            error: function(errorThrown){
              console.log(errorThrown);
            }
        });
      },
      
       
      get_ReturnPriceCalculator:function(apiExchg,finCode,amount,period){
       $('#get_return_result').html('');
      jQuery.ajax(
          {
              type: "post",
              dataType: "json",
              url: global_vars.ajax_url,
              data: {
                  'action':'get_return_price_calculator',
                  'apiExchg':apiExchg,
                  'finCode':finCode,
                  'amount':amount,
                  'period':period,
              },
              success: function(response){
                  console.log(response);
                  if(response.status == 'success'){
                      $(document).find('#get_return_result').html(response.result);
                  }else{
                      $(document).find('#get_return_result').html('You provided invalid options. Please try again.');
                  }
                  
              }
          });

  },
			events: function() {
				var self    = this,
					stockMarketLive  = '#stock-market-live';
          this.interval = setInterval(function(){
            var indexCode = $('#indicesIndexes').val();
            // self.getStockMarket(indexCode,stockMarketLive);
          }, 10000);

					$(stockMarketLive)
          .on( 'change', '#indicesIndexes', function(event) {
	            var indexCode = $(this).val();
               self.getStockMarket(indexCode,stockMarketLive);
	        });
          // Stocks Event Filter
          sectorsSectionWrap ="#sectors-section-wrap";
          $(document)
          .on('change', '#type', function(event) {
              var type = $(this).val();
              var indecCode = $("#gl_indices_change").val();
              var intra_day = $("#intra_day").val();
              var apiExchg =$('#exchanges').val();  
               self.getShareMarketGainerLooser(type,apiExchg,intra_day,indecCode,sectorsSectionWrap);
          });
          $(document)
          .on('change', '#gl_indices_change', function(event) {
              var indecCode = $(this).val();
              var type = $("#type").val();
              var intra_day = $("#intra_day").val();
              var apiExchg =$('#exchanges').val();  
               self.getShareMarketGainerLooser(type,apiExchg,intra_day,indecCode,sectorsSectionWrap);
          });
          $(document)
          .on('change', '#intra_day', function(event) {
              var intra_day = $(this).val();
              var type = $("#type").val();
              var indecCode= $("#gl_indices_change").val();
              var apiExchg =$('#exchanges').val();  
               self.getShareMarketGainerLooser(type,apiExchg,intra_day,indecCode,sectorsSectionWrap);
          }); 

          // Calulater
          $(document).on("keyup","#company-list-input", function(e) {
               var searchText = $(this).val();
            if(searchText.length >= 3){
                $("#result-search").html('<div class="fb-loader loader mx-auto"></div>');
                  self.ajax(searchText); 
            }
            
          });
          $(document).on('click','#getCalculatedResult',function(e){
            e.preventDefault();
            var period =$('#rc_period_box_filter').val();
            var amount =$('#investmentOf').val();
            var apiExchg =$('#ddlCompanyIndexes').val();
            var finCode =$('#company-list').val();
            if(finCode ==''){
               finCode = $('#indices_index').val();
            }
            if(period ==''){
                alert('Please select time period.');
                $('#rc_period_box_filter').focus();
                return false;
            }
            if(amount ==''){
                alert('Please enter amount which you want to calculate.');
                $('#investmentOf').focus();
                return false;
            }
            if(finCode ==''){
                alert('Please search company which you want to calculate.');
                $('#investmentOf').focus();
                return false;
            }
            self.get_ReturnPriceCalculator(apiExchg,finCode,amount,period);
        });
				return this;
			},

		};
	exports.TemplateShareMarket = TemplateShareMarket;

}).apply(this, [jQuery]);