(function($) {
	var initialized = false;
	var TemplateOptionChain = {
			defaults: {
        wrapper: $('body'),
        offset:150,
        loadingElement : '',
        delay: 1000,
        visibleMobile: false,
        label: false,
        topSectionLoaded: false
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
      get_derivative_companyStock: function(instName,symbol,expDate,optType,stkPrice,filter=true){
        var companyStockLive="#company-stock-live";
        $.ajax({
            type:"POST",
            url: global_vars.apiServerUrl + '/api/derivative-company-details',
            data : {
              'action':'get_derivative_company_details',
              'instName':instName,
              'symbol':symbol,
              'expDate':expDate,
              'optType':optType,
              'stkPrice':stkPrice,
              'security': global_vars.ajax_nonce
            },
            cache: false,
            beforeSend: function() {
              if(filter){
                $(companyStockLive).find('.fb-loader').remove();
                $(companyStockLive).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
              }
            },
            success:function(response){
              response =response.stocks;
              currentValue =response.data;
              if(currentValue.INSTNAME){
                $(companyStockLive).find('#companyInstName').html(currentValue.INSTNAME);
                $(companyStockLive).find('#company-name').html(currentValue.SYMBOL);
                $(companyStockLive).find('#set1-value').html(currentValue.STRIKEPRICE);
                var ot='';
                if(currentValue.OPTTYPE =='PE'){
                  ot ='PUT';
                }
                if(currentValue.OPTTYPE =='CE'){
                  ot ='CALL';
                }
                $(companyStockLive).find('#set2-value').html(ot);
                $(companyStockLive).find('#set3-value').html(currentValue.EXPDATE);
                $(companyStockLive).find('#currentStockRate').html(parseFloat(currentValue.LTP).toFixed(2));
                if(currentValue.LTP >= 0){
                }else{
                }
                if(currentValue.FaOdiff >= 0){
                  $(companyStockLive).find('#currentStockRateArrow').removeClass('fa-arrow-down color-red').addClass('fa-arrow-up color-green');
                  $(companyStockLive).find('#currentStockChange').removeClass('color-red').addClass('color-green'); 
                  $(companyStockLive).find('#currentStockChange').html(parseFloat(currentValue.FaOdiff).toFixed(2)+ ' ('+parseFloat(currentValue.FaOchange).toFixed(2)+'%)');

                }else{
                  $(companyStockLive).find('#currentStockRateArrow').removeClass('fa-arrow-up color-green').addClass('fa-arrow-down color-red');
                    $(companyStockLive).find('#currentStockChange').removeClass('color-green').addClass('color-red'); 
                    $(companyStockLive).find('#currentStockChange').html(parseFloat(currentValue.FaOdiff).toFixed(2)+ ' ('+parseFloat(currentValue.FaOchange).toFixed(2)+'%)');
                }
                $(companyStockLive).find('#strick_price').html(currentValue.STRIKEPRICE);
                $(companyStockLive).find('#open_price').html(parseFloat(currentValue.OPENPRICE).toFixed(2));
                $(companyStockLive).find('#high_price').html(parseFloat(currentValue.HIGHPRICE).toFixed(2));
                $(companyStockLive).find('#low_price').html(parseFloat(currentValue.LOWPRICE).toFixed(2));
                $(companyStockLive).find('#prevclose').html(parseFloat(currentValue.PrevLtp).toFixed(2));
                $(companyStockLive).find('#spot_price').html(parseFloat(currentValue.Nseltp).toFixed(2));

                $(companyStockLive).find('#bid_price').html(parseFloat(currentValue.BBUYPRICE).toFixed(2));
                $(companyStockLive).find('#bid_qty').html(parseFloat(currentValue.BBUYQTY).toFixed(2));
                $(companyStockLive).find('#offer_price').html(parseFloat(currentValue.BSELLPRICE).toFixed(2));
                $(companyStockLive).find('#offer_qty').html(parseFloat(currentValue.BSELLQTY).toFixed(2));
                $(companyStockLive).find('#avg_price').html(parseFloat(currentValue.AVGTP).toFixed(2));
                $(companyStockLive).find('#contra_trad').html(parseFloat(currentValue.TradedQtyCnt).toFixed(2));

                $(companyStockLive).find('#turnover').html(parseFloat(currentValue.Turnover).toFixed(2));
                $(companyStockLive).find('#trad_qty').html(currentValue.Volume); 
                $(companyStockLive).find('#market_lot').html(currentValue.MktLot);
                $(companyStockLive).find('#open_intrest').html(currentValue.OPENINTEREST);
                      
                $(companyStockLive).find('#DiffOpenInt').html(parseFloat(currentValue.DiffOpenInt).toFixed(2));
                if(currentValue.DiffOpenInt >0){
                  $(companyStockLive).find('#DiffOpenInt').removeClass('text-red').addClass('text-green');
                }else{
                  $(companyStockLive).find('#DiffOpenInt').removeClass('text-green').addClass('text-red');
                }
                $(companyStockLive).find('#chgOpenInt').html(parseFloat(currentValue['chgOpenInt']).toFixed(2));
                if(currentValue['chgOpenInt'] >0){
                  $(companyStockLive).find('#chgOpenInt').removeClass('text-red').addClass('text-green');
                }else{
                $(companyStockLive).find('#chgOpenInt').removeClass('text-green').addClass('text-red');
                }
              }
              $(companyStockLive).find('.fb-loader').remove();  
            },
            error: function(errorThrown){
              $(companyStockLive).find('.fb-loader').remove();
                console.log(errorThrown);
              }
        });
      },
      get_derivative_company_detail:function(self,eleId,symbol,filter=true,loadchield){
        var ele ='#strikPriceAnalisisExpiryDate';
        jQuery.ajax(
         {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-option-chain/company-detail',
            data: {
              'action':'company_detail',
                      // 'InstName':instName,
              'symbol':symbol,
            },
            cache:false,
            beforeSend: function() {
              $(eleId).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
            },
            success: function(response){
              if(response){
                  $(eleId).html(response);
                  self.options.topSectionLoaded =true;
                  if(loadchield){
                    var ExpDate =$(eleId).find('#ExpiryDate').val();
                    var OptType =$(eleId).find('#OptionType').val();
                    var StrikePrice = $(eleId).find('#StrikePrice').val();
                     self.loadStrikePriceAnalysis(symbol,ExpDate,OptType,StrikePrice);
                  }
              }
                $(eleId).html();
            },
            error:function(error){
              $(eleId).html();
            }
        });
      },
      loadStrikePriceAnalysis:function(symbol,ExpDate,OptType,StrikePrice){
        eleId ='#strike-price-analysis-data-id';
        $(eleId).html('');
        instName ='OPTSTK';
        if(symbol =='BANKNIFTY' || symbol =='NIFTY'){
           instName ='OPTIDX'; 
        }
        var pageID=$('#filter-options').data('post-id');
        jQuery.ajax(
         {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-option-chain/strike-price-analysis',
            data: {
              'action':'strike-price-analysis',
              'InstName':instName,
              'ExpDate':ExpDate,
              'OptType':OptType,
              'pageID':pageID,
              'symbol':symbol,
            },
            cache:false,
            beforeSend: function() {
              $(eleId).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
            },
            success: function(response){
              if(response){
                  $(eleId).html(response);
              }else{
                $(eleId).html();
              }
            },
            error:function(error){
              $(eleId).html();
            }
        });
      },
      strikPriceAnalisisExpiryDateFilter:function(eleId,InstName,ExpDate,OptType,section,symbol){
         $(eleId).find('table').find('tbody').html('');
              jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.apiServerUrl + '/apiblock/react-option-chain/partial-strike-price-analysis',
                  data: {
                      'action':'get_strick_price_analysis_data',
                      'InstName':InstName,
                      'ExpDate':ExpDate,
                      'OptType':OptType,
                      'section':section,
                      'symbol':symbol,
                  },
                  cache:false,
                  beforeSend: function() {
                   $(eleId).closest(".tab-content").prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
                  },
                  success: function(response){
                      if(response){
                         $(eleId).find('table').find('tbody').html(response);
                      }
                      $(eleId).closest(".tab-content").find('.fb-loader').remove();
                  },
                  error:function(error){
                     $(eleId).closest(".tab-content").find('.fb-loader').remove();
                  }
              });
      },
      mostActiveOptionDataFilter:function(eleId,InstName,ExpDate,OptType,Rtype,symbol){
         $(eleId).find('table').find('tbody').html('');
              jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.apiServerUrl + '/apiblock/react-option-chain/partial-most-active-stock-index-option',
                  data: {
                      'action':'get_most_active_stock_index_option_data',
                      'InstName':InstName,
                      'symbol':symbol,
                      'ExpDate':ExpDate,
                      'OptType':OptType,
                      'Rtype':Rtype,
                  },
                  cache:false,
                  beforeSend: function() {
                    $(eleId).closest(".tab-content").prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
                  },
                  success: function(response){
                      if(response){
                         $(eleId).html(response);
                      }
                      $(eleId).closest(".tab-content").find('.fb-loader').remove();
                  },
                  error:function(error){
                     $(eleId).closest(".tab-content").find('.fb-loader').remove();
                  }
              });
      },
      putCallRatiosFilter: function(eleId,InstName,ExpDate,ReportType,PageSize,section){
         $(eleId).find('table').find('tbody').html('');
         $.ajax(
              {
            type: "POST",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-option-chain/partial-top-put-call-ratio',
            data:{
                'action':'get_top_call_put_data',
                      'InstName':InstName,
                      'ExpDate':ExpDate,
                      'ReportType':ReportType,
                      'section':section,
                      'PageSize':PageSize,
                      'PageNo':1,
              },
              cache:false,
              beforeSend: function() {
                $(eleId).closest(".tab-content").prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
              },
              success: function(response){
                  if(response){
                      $(eleId).html(response);
                  }
                  $(eleId).closest(".tab-content").find('.fb-loader').remove();
              },
              error:function(error){
                 $(eleId).closest(".tab-content").find('.fb-loader').remove();
              }
          });
      },
     
      mostActiveStockIndexOptionCallPutFilter:function(eleId,InstName,ExpDate,OptType,Rtype,symbol,PageSize,section){
        $(eleId).find('table').find('tbody').html('');
          jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.apiServerUrl + '/apiblock/react-option-chain/partial-most-active-stock-index-option',
                  data: {
                      'action':'get_most_active_stock_index_option_data',
                      'InstName':InstName,
                      'symbol':symbol,
                      'ExpDate':ExpDate,
                      'OptType':OptType,
                      'Rtype':Rtype,
                      'PageSize':PageSize,
                      'section':section,
                  },
                  cache:false,
                  beforeSend: function() {
                    $(eleId).closest(".tab-content").prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
                  },
                  success: function(response){
                      if(response){
                         $(eleId).html(response);
                      }
                      $(eleId).closest(".tab-content").find('.fb-loader').remove();
                  },
                  error:function(error){
                     $(eleId).closest(".tab-content").find('.fb-loader').remove();
                  }
              });
      },
     
      topInterestStockIndexOptionCallPutFilter:function(eleId,InstName,ExpDate,OptType,Opt,symbol,PageSize,section){
        $(eleId).find('table').find('tbody').html('');
          jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.apiServerUrl + '/apiblock/react-option-chain/partial-top-interest-stock-option',
                  data: {
                      'action':'get_most_active_stock_index_option_data',
                      'InstName':InstName,
                      'ExpDate':ExpDate,
                      'OptType':OptType,
                      'Opt':Opt,
                      'PageSize':PageSize,
                      'section':section,
                  },
                  cache:false,
                  beforeSend: function() {
                    $(eleId).closest(".tab-content").prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
                  },
                  success: function(response){
                      if(response){
                         $(eleId).html(response);
                      }
                      $(eleId).closest(".tab-content").find('.fb-loader').remove();
                  },
                  error:function(error){
                     $(eleId).closest(".tab-content").find('.fb-loader').remove();
                  }
              });
      },
      events: function() {
				var self    = this,
					companyStockLive  = '#company-stock-live',_isScrolling = false;
          
          (function($) { 

              var symbol = $('#filter-options').data('symbol');
              if (symbol) {
                  self.get_derivative_company_detail(self,companyStockLive,symbol,false);
              } 
              $('ul.tabs').each(function () {
                  var $active, $content, $links = jQuery(this).find('a');
                   $active = jQuery($links.filter('[href="' + location.hash + '"]')[0] || $links[0]);
                  $active.addClass('active');
                  $content = $($active[0].hash);
                 $links.not($active).each(function () {
                      jQuery(this.hash).hide();
                  });
                   jQuery(this).on('click', 'a', function (e) {
                      $active.removeClass('active');
                      $content.hide();
                  $active = jQuery(this);
                      $content = jQuery(this.hash);
                  $active.addClass('active');
                      $content.show();
                    e.preventDefault();
                  });
              });
              
              //Top Filter
              $(document).on('change','#ddlCompanySymble', function () {
                  if($('.template-option-chain').length){
                    var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
                    if (symbol) {
                      this.interval =0;
                      self.get_derivative_company_detail(self,companyStockLive,symbol,filter=true,loadchield=true)
                    }
                  }else{
                  var symbol = $(this).val();
                    if (symbol) {
                        window.location.href =symbol;
                    }
                  }
                  
              });
              this.interval = setInterval(function(){
                var InstName = $('#companyInstName').val();
                var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
                var ExpDate = $('#ExpiryDate').val();
                var OptType = $('#OptionType').val();
                var StkPrice = $('#StrikePrice').val();
                if (InstName) {
                  self.get_derivative_companyStock(InstName,symbol,ExpDate,OptType,StkPrice,false);
                }
              }, 10000);

          }).apply(this, [jQuery]); 

          $(window).scroll(function() {
            if (!_isScrolling) {
               
              if (self.options.topSectionLoaded && $(window).scrollTop() > self.options.offset){
                _isScrolling = true;
                  (function($) {
                    'use strict';
                      var instName = $('#ajax-load-api-data').data('inst-name');
                      var symbol = $('#company-stock-live #ddlCompanySymble').find(':selected').data('symble');
                      var ExpDate = $('#company-stock-live #ExpiryDate').val();
                      var OptType = $('#company-stock-live').find('#OptionType').val();
                      var StkPrice = $('#company-stock-live #StrikePrice').val();
                      $('#filter-options').attr('data-opt-type',OptType);
                      $('#filter-options').attr('data-symbol',symbol);
                      $('#filter-options').attr('data-exp-date',ExpDate);
                      $('#filter-options').attr('data-stk-price',StkPrice);
                        var pages = {
                          "strike-price-analysis-data": "strike-price-analysis",
                          "top-put-call-ratio-data": "top-put-call-ratio",
                          "most-active-stock-options-data": "most-active-stock-options",
                          "most-active-index-options-data": "most-active-index-options",
                          "top-open-interest-stock-options-data": "top-open-interest-stock-options",
                          "top-open-interest-index-options-data": "top-open-interest-index-options",
                        };
                      for (var key in pages) {
                         var info = {
                              page: key,
                              pageURI: global_vars.apiServerUrl+'/apiblock/react-option-chain/'+pages[key],
                              pageID: $('#ajax-load-api-data').data('post-id'),
                              InstName: instName,
                              symbol: symbol,
                              ExpDate: ExpDate,
                              OptType: OptType,
                              StkPrice: StkPrice,
                          };
                           
                          (function(info){
                              $.ajax({
                                method: "POST",
                                url: info.pageURI,
                                crossDomain: true,
                                config: {
                                  headers: {
                                      'Access-Control-Allow-Origin': '*',
                                    }
                                },
                                data: {
                                  'action': 'load_option_chain_page_section',
                                  'data': info,
                                  'security': global_vars.ajax_nonce,
                                },
                                success: function (data) {
                                  $("#ajax-load-api-data " + "#" + info.page + "-id").append(data);   
                                },
                                  error: function (errorThrown) {
                                      console.log(errorThrown);
                                  }
                              });
                          
                          })(info);
                      }
                    
                  }).apply(this, [jQuery]);
              }
            }
          });


          
          $(document).on('click','#filter_derivative_details', function (e) {
            e.preventDefault();
            this.interval =0;
            var InstName = $('#companyInstName').val();
            var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
            var ExpDate = $('#ExpiryDate').val();
            var OptType = $('#OptionType').val();
            var StkPrice = $('#StrikePrice').val();
            if (InstName) {
              self.get_derivative_companyStock(InstName,symbol,ExpDate,OptType,StkPrice);
            }
            setTimeout(function(){
                $('#ajax-load-api-data').find('#chart-data-id .highcharts-container').remove();
                $('#ajax-load-api-data').find('.nested_tab a[href="#li_1m"]').trigger('click');
            },200);
          });
          // Top Filter End
          //  Strike Price Analysis Filter
          $(document).on('click','.changeSPAFilter', function () {
             var expdate =$(this).attr('data-expdate');
             $('option:selected', this).remove();
             $('#strikPriceAnalisisExpiryDate').val('');
             $('#strikPriceAnalisisExpiryDate').val(expdate);
          });
          $(document).on('change','#strikPriceAnalisisExpiryDate',function(){
              var ReportType ='vol'
              var section ='';
              var InstName = $('#companyInstName').val();
              var symbol = $('#ddlCompanySymble').children("option:selected").attr('data-symble');
              var ExpDate = $(this).val();
              var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).text();
              var eleId= '';
              var OptType ='';
              if(activeTb =='PUT'){
                OptType ='PE';
                eleId ='#Puts';
              }else if(activeTb == 'CALL'){
                OptType ='CE';
                eleId ='#Calls';
              }
              
              self.strikPriceAnalisisExpiryDateFilter(eleId,InstName,ExpDate,OptType,section,symbol);

          });
          //  Strike Price Analysis Filter ENd 
          //  Most Active Options Data  Filter
          $(document).on('click','.mostActiveOptionFilterTab', function () {
             var opt_filter =$(this).attr('data-opt-filter');
             $('option:selected', this).remove();
             $('#mostActiveOptionFilter').val('');
             $('#mostActiveOptionFilter').val(opt_filter);
          });
          $(document).on('change','#mostActiveOptionFilter',function(){
              var OptType ='';
              var InstName =$('#companyInstName').val();
              var symbol =$('#ddlCompanySymble').children("option:selected").attr('data-symble');
              var ExpDate =$('#ExpiryDate').val();
              var Rtype = $(this).val();
              var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-opt-filter',Rtype).text();
              var eleId= '';
              if(activeTb =='CALL'){
                OptType ='C';
                eleId ='#mostActiveOptionCall';
              }else{
                OptType ='P';
                eleId ='#mostActiveOptionPut';
              }

              self.mostActiveOptionDataFilter(eleId,InstName,ExpDate,OptType,Rtype,symbol);

          });
          // put-call-ratio
          $(document).on('click','.changeSIFilter', function () {
              var activeTb= $(this).text();
              var expdate =$(this).attr('data-expdate');
              var reporttype =$(this).attr('data-reporttype');
              if(activeTb =='Stocks'){
                $(document).find('#stk-filter').show();
                $(document).find('#idx-filter').hide();
                $(document).find('#stockExpireDateFilter').val('');
                $(document).find('#stockExpireDateFilter').val(expdate);
                $(document).find('#stockReportTypeFilter').val('');
                $(document).find('#stockReportTypeFilter').val(reporttype);
              }
              if(activeTb =='Indexes'){
                $(document).find('#stk-filter').hide();
                $(document).find('#idx-filter').show();
                $(document).find('#indexExpireDateFilter').val('');
                $(document).find('#indexExpireDateFilter').val(expdate);
                $(document).find('#indexReportTypeFilter').val('');
                $(document).find('#indexReportTypeFilter').val(reporttype);
              }
          });
          $(document).on('change','#stockExpireDateFilter,#stockReportTypeFilter,#indexExpireDateFilter,#indexReportTypeFilter',function(){
            var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').text();
            var eleId= '';
             if(activeTb =='Stocks'){
                var InstName ='OPTSTK';
                var ExpDate = $("#stockExpireDateFilter").val();
                var ReportType = $("#stockReportTypeFilter").val();
                eleId ='#stocksPutCallRatios';
             }
             if(activeTb =='Indexes'){
                var InstName ='OPTIDX';
                eleId ='#indexesPutCallRatios';
                var ExpDate = $("#indexExpireDateFilter").val();
                var ReportType = $("#indexReportTypeFilter").val();
             }
             $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).attr('data-reporttype',ReportType);
             var PageSize =10;
              if($('#check-page-type').length){
                var section ='read_more';
                PageSize =20;
              }else{
                var section ='';
              }
              
               
              self.putCallRatiosFilter(eleId,InstName,ExpDate,ReportType,PageSize,section);
          });
          

          //  Strike Price Analysis Filter ENd
          //  Most Active Options Data  Filter
          $(document).on('click','.changeMASOFilter', function () {
             var expdate =$(this).attr('data-expdate');
             var rtypefilter =$(this).attr('data-rtypefilter');
             $('#mostActiveStockOptionExpiryDate').val('');
             $('#mostActiveStockOptionExpiryDate').val(expdate);
             $('#mostActiveStockOptionFilter').val('');
             $('#mostActiveStockOptionFilter').val(rtypefilter);
          });
          $(document).on('change','#mostActiveStockOptionFilter,#mostActiveStockOptionExpiryDate',function(){
              var symbol ='';
              var OptType ='';
              var InstName =$('#companyInstName').val();
              var InstName ='OPTSTK';
              var section =$('#most_a_s_o_section').val();
              var ExpDate = $('#mostActiveStockOptionExpiryDate').val();
              var Rtype = $('#mostActiveStockOptionFilter').val();
              var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).attr('data-rtypefilter',Rtype).text();
              var eleId= '';
              var PageSize =10;
              if(activeTb =='CALL'){
                OptType ='C';
                eleId ='#mostActiveStockOptionCall';
              }else{
                OptType ='P';
                eleId ='#mostActiveStockOptionPut';
              }
              
              self.mostActiveStockIndexOptionCallPutFilter(eleId,InstName,ExpDate,OptType,Rtype,symbol,PageSize,section);
              
          });
          //  Most Active Options Data  Filter
          $(document).on('click','.changeMAIOFilter', function () {
             var expdate =$(this).attr('data-expdate');
             var rtypefilter =$(this).attr('data-rtypefilter');
             $('#mostActiveIndexOptionExpiryDate').val('');
             $('#mostActiveIndexOptionExpiryDate').val(expdate);
             $('#mostActiveIndexOptionFilter').val('');
             $('#mostActiveIndexOptionFilter').val(rtypefilter);
          });
          $(document).on('change','#mostActiveIndexOptionExpiryDate,#mostActiveIndexOptionFilter',function(){
              var symbol ='';
              var OptType ='';
              var InstName =$('#companyInstName').val();
              var InstName ='OPTIDX';
              var section =$('#most_a_i_o_section').val();
              var ExpDate = $('#mostActiveIndexOptionExpiryDate').val();
              var Rtype = $('#mostActiveIndexOptionFilter').val();
              var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).attr('data-rtypefilter',Rtype).text();
              var eleId= '';
               var PageSize =10;
              if(activeTb =='CALL'){
                OptType ='C';
                eleId ='#mostActiveIndexOptionCall';
              }else{
                OptType ='P';
                eleId ='#mostActiveIndexOptionPut';
              }
              
              self.mostActiveStockIndexOptionCallPutFilter(eleId,InstName,ExpDate,OptType,Rtype,symbol,PageSize,section);
              
          });
          //  Most Active Stock Index Options Data  Filter for Details Page
          $(document).on('click','.changeMASIOFilter', function () {
             var expdate =$(this).attr('data-expdate');
             var rtypefilter =$(this).attr('data-rtypefilter');
             $('#mostActiveStockIndexOptionExpiryDate').val('');
             $('#mostActiveStockIndexOptionExpiryDate').val(expdate);
             $('#mostActiveStockIndexOptionFilter').val('');
             $('#mostActiveStockIndexOptionFilter').val(rtypefilter);
          });
          $(document).on('change','#mostActiveStockIndexOptionExpiryDate,#mostActiveStockIndexOptionFilter',function(){
              var symbol ='';
              var OptType ='';
              var PageSize =20;
              var InstName =$('#ActiveInstName').val();
              var section ='read_more';
              var ExpDate = $('#mostActiveStockIndexOptionExpiryDate').val();
              var Rtype = $('#mostActiveStockIndexOptionFilter').val();
              var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).attr('data-rtypefilter',Rtype).text();
              var eleId= '';
              if(activeTb =='CALL'){
                OptType ='C';
                eleId ='#mostActiveStockIndexOptionCall';
              }else{
                OptType ='P';
                eleId ='#mostActiveStockIndexOptionPut';
              }
              
              self.mostActiveStockIndexOptionCallPutFilter(eleId,InstName,ExpDate,OptType,Rtype,symbol,PageSize,section);
              
          });
           
          //  Top Active Filter
          $(document).on('click','.changeTOISFilter', function () {
             var expdate =$(this).attr('data-expdate');
             var otpfilter =$(this).attr('data-otpfilter');
             $('#topInterestStockOptionExpiryDate').val('');
             $('#topInterestStockOptionExpiryDate').val(expdate);
             $('#topInterestStockOptionFilter').val('');
             $('#topInterestStockOptionFilter').val(otpfilter);
          });
          $(document).on('change','#topInterestStockOptionExpiryDate,#topInterestStockOptionFilter',function(){
              var symbol ='';
              var OptType ='';
              var PageSize =10;
              var InstName ='OPTSTK';
              var section =$('#top_i_s_o_section').val();
              var ExpDate = $('#topInterestStockOptionExpiryDate').val();
              var Opt = $('#topInterestStockOptionFilter').val();
              var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).attr('data-otpfilter',Opt).text();
              var eleId= '';
              if(activeTb =='CALL'){
                OptType ='CE';
                eleId ='#topInterestStockOptionCall';
              }else{
                OptType ='PE';
                eleId ='#topInterestStockOptionPut';
              }
              
              self.topInterestStockIndexOptionCallPutFilter(eleId,InstName,ExpDate,OptType,Opt,symbol,PageSize,section);
              
          });
          //  Top Active Stock Filter
          $(document).on('click','.changeTOIIFilter', function () {
             var expdate =$(this).attr('data-expdate');
             var otpfilter =$(this).attr('data-otpfilter');
             $('#topInterestIndexOptionExpiryDate').val('');
             $('#topInterestIndexOptionExpiryDate').val(expdate);
             $('#topInterestIndexOptionFilter').val('');
             $('#topInterestIndexOptionFilter').val(otpfilter);
          });
          $(document).on('change','#topInterestIndexOptionExpiryDate,#topInterestIndexOptionFilter',function(){
              var symbol ='';
              var OptType ='';
              var InstName ='OPTIDX';
              var section =$('#top_i_i_o_section').val();
              var ExpDate = $('#topInterestIndexOptionExpiryDate').val();
              var Opt = $('#topInterestIndexOptionFilter').val();
              var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).attr('data-otpfilter',Opt).text();
              var eleId= '';
              var PageSize=10;

              if(activeTb =='CALL'){
                OptType ='CE';
                eleId ='#topInterestIndexOptionCall';
              }else{
                OptType ='PE';
                eleId ='#topInterestIndexOptionPut';
              }
              self.topInterestStockIndexOptionCallPutFilter(eleId,InstName,ExpDate,OptType,Opt,symbol,PageSize,section);
              
          });
          //  Top Active Stock Index Filter For Details Page
          $(document).on('click','.changeTOISIFilter', function () {
             var expdate =$(this).attr('data-expdate');
             var otpfilter =$(this).attr('data-otpfilter');
             $('#topInterestStockIndexOptionExpiryDate').val('');
             $('#topInterestStockIndexOptionExpiryDate').val(expdate);
             $('#topInterestStockIndexOptionFilter').val('');
             $('#topInterestStockIndexOptionFilter').val(otpfilter);
          });
          $(document).on('change','#topInterestStockIndexOptionExpiryDate,#topInterestStockIndexOptionFilter',function(){
              var symbol ='';
              var OptType ='';
              var InstName =$('#ActiveInstName').val();
              var section ='read_more';
              var ExpDate = $('#topInterestStockIndexOptionExpiryDate').val();
              var Opt = $('#topInterestStockIndexOptionFilter').val();
              var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).attr('data-otpfilter',Opt).text();
              var eleId= '';
              var PageSize=20;
              if(activeTb =='CALL'){
                OptType ='CE';
                eleId ='#topInterestStockIndexOptionCall';
              }else{
                OptType ='PE';
                eleId ='#topInterestStockIndexOptionPut';
              }
              self.topInterestStockIndexOptionCallPutFilter(eleId,InstName,ExpDate,OptType,Opt,symbol,PageSize,section);
              
          });
          
				return this;
			},

		};
	exports.TemplateOptionChain = TemplateOptionChain;

}).apply(this, [jQuery]);