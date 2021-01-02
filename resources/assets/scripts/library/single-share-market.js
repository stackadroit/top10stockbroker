(function($) {
	var initialized = false;
	var SingleShareMarket = {
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
            cache: false,
            beforeSend: function() {
              $(liveUpdateElement).find(".loading-data").show();
            },
            success:function(response){
              // console.log(response.stocks);
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
       
      ajax: function( SearchTxt ){
        $.ajax({
            type:"POST",
            url: global_vars.ajax_url,
            data : {
              'action':'get_company_list',
              'SearchTxt': SearchTxt,
              'security': global_vars.ajax_nonce
            },
            cache: false,
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
                  'security': global_vars.ajax_nonce
              },
              cache: false,
              success: function(response){
                  // console.log(response);
                  if(response.status == 'success'){
                      $(document).find('#get_return_result').html(response.result);
                  }else{
                      $(document).find('#get_return_result').html('You provided invalid options. Please try again.');
                  }
                  
              }
          });

      },
      get_ShareMarketIndicesFilter:function(indexCode,stock_order){
       $('#get_return_result').html('');
        jQuery.ajax(
          {
              type: "post",
              dataType: "html",
              url: global_vars.ajax_url,
              data: {
                  'action':'get_share_market_indices_filter',
                  'indexCode':indexCode,
                  'stock_order':stock_order,
                  'security': global_vars.ajax_nonce
              },
              cache: false,
              success: function(response){
                  $('#loadMoreWrap').remove();
                  if(response){
                     $('#indices-sector-g-l').html(response);
                  }
                  $('.full-page-loading').hide();
              },
              error:function(error){
                 $('.full-page-loading').hide();
              }
          });

      },
      get_ShareMarketAllSectorHighLowLoadMore:function(apiExchg,sectors_gl,intra_day,indices_index,page_no){
          $('#loadMoreHighLow').attr('data-page_no',(page_no+1));
          jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.ajax_url,
                  data: {
                      'action':'get_share_market_all_sector_high_low',
                      'apiExchg':apiExchg,
                      'intra_day':intra_day,
                      'sectors_gl':sectors_gl,
                      'indices_index':indices_index,
                      'page_no':(page_no+1),
                      'security': global_vars.ajax_nonce
                  },
                  cache: false,
                  success: function(response){
                      $('#loadMoreWrap').remove();
                      if(response){
                         $('#indices-sector-high-low-live').append(response);
                      }
                      $('#loadMoreHighLow').removeClass('loading');
                  },
                  error:function(error){
                     $('#loadMoreHighLow').removeClass('loading');
                  }
              });

      },
      get_ShareMarketAllSectorHighLow:function(apiExchg,sectors_gl,intra_day,indices_index){
        $('#indices-sector-high-low-live').html('');
        $('.full-page-loading').show();
        $('#loadMore').attr('data-page_no',1);
        jQuery.ajax(
            {
                type: "post",
                dataType: "html",
                url: global_vars.ajax_url,
                data: {
                    'action':'get_share_market_all_sector_high_low',
                    'apiExchg':apiExchg,
                    'intra_day':intra_day,
                    'indices_index':indices_index,
                    'sectors_gl':sectors_gl,
                    'security': global_vars.ajax_nonce
                },
                cache: false,
                success: function(response){
                    if(response){
                       $('#indices-sector-high-low-live').html(response);
                    }
                    $('.full-page-loading').hide();
                },
                error:function(error){
                    $('.full-page-loading').hide();
                }
            });

      },
      get_ShareMarketAllSectorGainerLooser:function(apiExchg,sectors_gl,intra_day,indices_index){
        $('#indices-stock-list-live').html('');
        $('.full-page-loading').show();
        $('#loadMoreGainarLosor').attr('data-page_no',1);
        jQuery.ajax(
          {
            type: "post",
            dataType: "html",
            url: global_vars.ajax_url,
            data: {
              'action':'get_share_market_all_sector_gainer_looser',
              'apiExchg':apiExchg,
              'intra_day':intra_day,
              'sectors_gl':sectors_gl,
              'indices_index':indices_index,
            },
            cache: false,
            success: function(response){
              if(response){
                $('#indices-stock-list-live').html(response);
              }
                $('.full-page-loading').hide();
              },
            error:function(error){
              $('.full-page-loading').hide();
            }
        });
      },
      get_ShareMarketAllSectorGainerLooserLoadMore:function(apiExchg,sectors_gl,intra_day,indices_index,page_no){
          // $('.loading').show();
          $('#loadMoreGainarLosor').attr('data-page_no',(page_no+1));
          jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.ajax_url,
                  data: {
                      'action':'get_share_market_all_sector_gainer_looser',
                      'apiExchg':apiExchg,
                      'intra_day':intra_day,
                      'sectors_gl':sectors_gl,
                      'indices_index':indices_index,
                      'page_no':(page_no+1),
                  },
                  cache: false,
                  success: function(response){
                      $('#loadMoreWrap').remove();
                      if(response){
                         $('#indices-stock-list-live').append(response);
                      }
                      $('#loadMoreGainarLosor').removeClass('loading');
                  },
                  error:function(error){
                     $('#loadMoreGainarLosor').removeClass('loading');
                  }
              });

      },
			events: function() {
				var self    = this,
					stockMarketLive  = '#stock-market-live';
          this.interval = setInterval(function(){
            var indexCode =  $('#indicesIndexesCode').val();
            self.getStockMarket(indexCode,stockMarketLive);
          }, 10000);

					$(stockMarketLive)
          .on( 'change', '#indicesIndexes', function(event) {
	            var indicesName =$.trim($(this).val());
               // self.getStockMarket(indexCode,stockMarketLive);
               window.location.href=indicesName;
	        });

          // Calulater
          $(document).on("keyup","#company-list-input", function(e) {
               var searchText = $(this).val();
            if(searchText.length >= 3){
                $("#result-search").html('<div class="fb-loader loader mx-auto"></div>');
                  self.ajax(searchText); 
            }
            
          });
          // get Calulater result
          $(document).on('click','#getCalculatedResult',function(e){
            e.preventDefault();
            var period =$('#rc_period_box_filter').val();
            var amount =$('#investmentOf').val();
            var apiExchg =$('#ddlCompanyIndexes').val();
            var finCode =$('#company-list').val();
            if(finCode ==''){
               finCode =  $('#indicesIndexesCode').val();
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
          //Event for single share market page
          $(document).on('change','#stock_order',function(){
            var stock_order =$(this).val();
            var indexCode =  $('#indicesIndexesCode').val();
            self.get_ShareMarketIndicesFilter(indexCode,stock_order);
          });
          var pagePerItem =20;
          var totalShow =pagePerItem;
          $(document).on('click','#loadMore',function(e){
                  e.preventDefault(); 
                  var companyList =$(document).find('.companyList').length;
                  totalShow =parseInt(totalShow)+parseInt(pagePerItem);
                  var cShow= 0;
                  $(this).addClass('loading');
                  setTimeout(function(){ 
                    $('.companyList').each(function(){
                        if($(this).is(":visible")){
                              // alert("The paragraph  is visible.");
                        } else{
                             cShow =cShow+1;
                             $(this).show();
                        }
                        if(cShow >= pagePerItem){
                            return false
                        }
                    });
                      $('#loadMore').removeClass('loading');
                  }, 500);
                  if(totalShow >= companyList){
                      $('#loadMore').hide();
                  }
          });
          //Event forn High Low
          $(document).on('click','#loadMoreHighLow',function(e){
            e.preventDefault(); 
            var apiExchg =$('#api_exchg').val();
            var sectors_gl =$('#sectors_gl').val();
            var intra_day = $('#stock-period-search').val();
            var indices_index = $('#indices_index_filter').val();
            var page_no = parseInt($(this).attr('data-page_no'));
            self.get_ShareMarketAllSectorHighLowLoadMore(apiExchg,sectors_gl,intra_day,indices_index,page_no); 
          });
          $(document).on('change','#high_low_filter',function(){
             window.location.href=$(this).val();
          });
          $(document).on('change','#api_exchg',function(){
            var apiExchg =$(this).val();
            var sectors_gl =$('#sectors_gl').val();
            var indices_index = $('#indices_index_filter').val();
            var intra_day = $('#stock-period-search').val();
            self.get_ShareMarketAllSectorHighLow(apiExchg,sectors_gl,intra_day,indices_index);
          });
          $(document).on('change','#indices_index_filter',function(){
            var indices_index =$(this).val();
            var sectors_gl =$('#sectors_gl').val();
            var apiExchg = $('#api_exchg').val();
            var intra_day = $('#stock-period-search').val();
            self.get_ShareMarketAllSectorHighLow(apiExchg,sectors_gl,intra_day,indices_index);
          });

          //Event forn Gainar Losor
          $(document).on('change','#gl_stock_order',function(){
             window.location.href=$(this).val();
          });
          $(document).on('change','#gl_indices_index_filter',function(){
            var indices_index =$(this).val();
            var apiExchg =$('#api_exchg').val();
            var sectors_gl =$('#sectors_gl').val();
            var intra_day = $('#gl_stock-period-search').val();
            self.get_ShareMarketAllSectorGainerLooser(apiExchg,sectors_gl,intra_day,indices_index);
          });
          $(document).on('change','#gl_stock-period-search',function(){
            var apiExchg =$('#api_exchg').val();
            var sectors_gl =$('#sectors_gl').val();
            var intra_day = $(this).val();
            var indices_index = $('#gl_indices_index_filter').val();
            self.get_ShareMarketAllSectorGainerLooser(apiExchg,sectors_gl,intra_day,indices_index);
          });
          $(document).on('click','#loadMoreGainarLosor',function(e){
              e.preventDefault(); 
              $(this).addClass('loading');
               var apiExchg =$('#api_exchg').val();
              var sectors_gl =$('#sectors_gl').val();
              var intra_day = $('#gl_stock-period-search').val();
              var indices_index = $('#gl_indices_index_filter').val();
              var page_no = parseInt($(this).attr('data-page_no'));
              self.get_ShareMarketAllSectorGainerLooserLoadMore(apiExchg,sectors_gl,intra_day,indices_index,page_no); 
          });
				return this;
			},

		};
	exports.SingleShareMarket = SingleShareMarket;

}).apply(this, [jQuery]);