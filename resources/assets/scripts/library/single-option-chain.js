(function($) {
	var initialized = false;
	var SingleOptionChain = {
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
      get_derivative_companyStock: function(instName,symbol,expDate,optType,stkPrice){
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
              $(companyStockLive).find(".loading-data").show();
            },
            success:function(response){
              response =response.stocks;
              currentValue =response.data;
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
              $(companyStockLive).find('#currentStockRate').html(currentValue.LTP,2);
              if(parseFloat(currentValue.FaOdiff) > 0){
                $(companyStockLive).find('#currentStockRateArrow').removeClass('fa-arrow-down color-red').addClass('fa-arrow-up color-green');
                $(companyStockLive).find('#currentStockChange').removeClass('color-red').addClass('color-green'); 
                $(companyStockLive).find('#currentStockChange').html(parseFloat(currentValue.FaOdiff).toFixed(2)+ ' ('+parseFloat(currentValue.FaOchange).toFixed(2)+'%)');

              }else{
                  $(companyStockLive).find('#currentStockRateArrow').removeClass('fa-arrow-up color-green').addClass('fa-arrow-down color-red');
                  $(companyStockLive).find('#currentStockChange').removeClass('color-green').addClass('color-red'); 
                  $(companyStockLive).find('#currentStockChange').html(parseFloat(currentValue.FaOdiff).toFixed(2)+ ' ('+parseFloat(currentValue.FaOchange).toFixed(2)+'%)');
              }
              $(companyStockLive).find('#strick_price').html(currentValue.STRIKEPRICE);
              $(companyStockLive).find('#open_price').html(currentValue.OPENPRICE);
              $(companyStockLive).find('#high_price').html(parseFloat(currentValue.HIGHPRICE).toFixed(2));
              $(companyStockLive).find('#low_price').html(parseFloat(currentValue.LOWPRICE).toFixed(2));
              $(companyStockLive).find('#prevclose').html(parseFloat(currentValue.PrevLtp).toFixed(2));
              $(companyStockLive).find('#spot_price').html(parseFloat(currentValue.Nseltp).toFixed(2));

              $(companyStockLive).find('#bid_price').html(parseFloat(currentValue.BBUYPRICE).toFixed(2));
              $(companyStockLive).find('#bid_qty').html(currentValue.BBUYQTY);
              $(companyStockLive).find('#offer_price').html(parseFloat(currentValue.BSELLPRICE).toFixed(2));
              $(companyStockLive).find('#offer_qty').html(currentValue.BSELLQTY);
              $(companyStockLive).find('#avg_price').html(parseFloat(currentValue.AVGTP).toFixed(2));
              $(companyStockLive).find('#contra_trad').html(currentValue.TradedQtyCnt);

              $(companyStockLive).find('#turnover').html(parseFloat(currentValue.Turnover).toFixed(2));
              $(companyStockLive).find('#trad_qty').html(currentValue.Volume); 
              $(companyStockLive).find('#market_lot').html(currentValue.MktLot);
              $(companyStockLive).find('#open_intrest').html(currentValue.OPENINTEREST);
                    
              $(companyStockLive).find('#DiffOpenInt').html(currentValue.DiffOpenInt);
              if(currentValue.DiffOpenInt >0){
                $(companyStockLive).find('#DiffOpenInt').removeClass('text-red').addClass('text-green');
              }else{
                $(companyStockLive).find('#DiffOpenInt').removeClass('text-green').addClass('text-red');
              }
              $(companyStockLive).find('#chgOpenInt').html(currentValue['chgOpenInt']);
              if(currentValue['chgOpenInt'] >0){
                $(companyStockLive).find('#chgOpenInt').removeClass('text-red').addClass('text-green');
              }else{
              $(companyStockLive).find('#chgOpenInt').removeClass('text-green').addClass('text-red');
              }
                
            },
            error: function(errorThrown){
                $(companyStockLive).find(".loading-data").remove();
                console.log(errorThrown);
              }
        });
      },
      strikPriceAnalisisExpiryDateFilter:function(eleId,InstName,ExpDate,OptType,section,symbol){
         $(eleId).find('table').find('tbody').html('');
              jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.apiServerUrl + '/apiblock/option-chain/partial-strike-price-analysis',
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
                    $(eleId).find(".loading-data").show();
                  },
                  success: function(response){
                      if(response){
                         $(eleId).find('table').find('tbody').html(response);
                      }
                      $(eleId).find(".loading-data").hide();
                  },
                  error:function(error){
                     $(eleId).find(".loading-data").hide();
                  }
              });
      },
      mostActiveOptionDataFilter:function(eleId,InstName,ExpDate,OptType,Rtype,symbol){
         $(eleId).html('');
              jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.apiServerUrl + '/apiblock/option-chain/partial-most-active-stock-index-option',
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
                    $(eleId).find(".loading-data").show();
                  },
                  success: function(response){
                      if(response){
                         $(eleId).html(response);
                      }
                      $(eleId).find(".loading-data").hide();
                  },
                  error:function(error){
                     $(eleId).find(".loading-data").hide();
                  }
              });
      },
      putCallRatiosFilter: function(eleId,InstName,ExpDate,ReportType,PageSize,section){
         $.ajax(
              {
            type: "POST",
            dataType: "html",
            url: global_vars.ajax_url,
            data:{
                'action':'get_top_call_put_data',
                      'InstName':InstName,
                      'ExpDate':ExpDate,
                      'ReportType':ReportType,
                      'section':section,
                      'PageSize':PageSize,
              },
            cache:false,
              beforeSend: function() {
                $(eleId).find(".loading-data").show();
              },
                  success: function(response){
                      if(response){
                         $(eleId).html(response);
                      }
                      $(eleId).find(".loading-data").hide();
                  },
                  error:function(error){
                     $(eleId).find(".loading-data").hide();
                  }
          });
      },
      loadMorePutCallRatiosData(eleId,InstName,ReportType,ExpDate,PageNo,total,PageSize){
        jQuery.ajax({
          type: "post",
          dataType: "html",
          url: global_vars.ajax_url,
          data: {
            'action':'load_more_top_put_call_ratio',
            'ReportType':ReportType,
            'InstName':InstName,
            'ExpDate':ExpDate,
            'PageNo':PageNo,
            'PageSize':PageSize,
          },
          success: function(response){
            $(eleId).removeClass('loading');
            if(response){
              $(eleId).closest('.tab_content').find('table').find('tbody').append(response);
            }
            if( total >  (PageNo*PageSize)){
              $(eleId).attr('data-page_no',PageNo);
            }else{
              $(eleId).remove();
            }
          },
          error:function(error){
            $(eleId).removeClass('loading');
          }
        });
             
      },
      mostActiveStockIndexOptionCallPutFilter:function(eleId,InstName,ExpDate,OptType,Rtype,symbol,PageSize,section){
        $(eleId).html();
          jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.apiServerUrl + '/apiblock/option-chain/partial-most-active-stock-index-option',
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
                    $(eleId).find(".loading-data").show();
                  },
                  success: function(response){
                      if(response){
                         $(eleId).html(response);
                      }
                      $(eleId).find(".loading-data").hide();
                  },
                  error:function(error){
                     $(eleId).find(".loading-data").hide();
                  }
              });
      },
      load_more_most_active_stack_and_index(eleId,InstName,ExpDate,Rtype,PageNo,PageSize,total){
          jQuery.ajax(
            {
              type: "post",
              dataType: "html",
              url: global_vars.ajax_url,
              data: {
                  'action':'load_more_most_active_stack_and_index',
                  'OptType':OptType,
                  'InstName':InstName,
                  'ExpDate':ExpDate,
                  'Rtype':Rtype,
                  'PageNo':PageNo,
                  'PageSize':PageSize,
                },
              cache:false,
              success: function(response){
                if(response){
                          $(eleId).closest('.tab_content').find('table').find('tbody').append(response);
                      }
                      if( total >  (PageNo*PageSize)){
                        $(eleId).attr('data-page_no',PageNo);
                      }else{
                        $(eleId).remove();
                      }
                      $(eleId).find(".loading-data").hide();
              },
              error:function(error){
                   $(eleId).removeClass('loading');
                }
          });
      },
      topInterestStockIndexOptionCallPutFilter:function(eleId,InstName,ExpDate,OptType,Opt,symbol,PageSize,section){
        $(eleId).html();
          jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.apiServerUrl + '/apiblock/option-chain/partial-top-interest-stock-option',
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
                    $(eleId).find(".loading-data").show();
                  },
                  success: function(response){
                      if(response){
                         $(eleId).html(response);
                      }
                      $(eleId).find(".loading-data").hide();
                  },
                  error:function(error){
                     $(eleId).find(".loading-data").hide();
                  }
              });
      },
      loadMoreTopInterestStockIndexOptionCallPut:function(eleId,InstName,ExpDate,OptType,Opt,PageSize,PageNo,total){
        $(eleId).html();
          jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.ajax_url,
                  data: {
                    'action':'load_more_top_interest_stack_and_index',
                    'OptType':OptType,
                    'InstName':InstName,
                    'ExpDate':ExpDate,
                    'Opt':Opt,
                    'PageNo':PageNo,
                    'PageSize':PageSize,
                  },
                  cache:false,
                  beforeSend: function() {
                    $(eleId).find(".loading-data").show();
                  },
                  success: function(response){
                      if(response){
                          $(eleId).closest('.tab_content').find('table').find('tbody').append(response);
                      }
                      if( total >  (PageNo*PageSize)){
                        $(eleId).attr('data-page_no',PageNo);
                      }else{
                        $(eleId).remove();
                      }
                      $(eleId).find(".loading-data").hide();
                  },
                  error:function(error){
                     $(eleId).find(".loading-data").hide();
                  }
              });
      },
      loadCompanyFilter:function(symbol){
         jQuery.ajax(
          {
            type: "post",
            dataType: "html",
            url: global_vars.ajax_url,
            data: {
              'action':'get_full_page_ajax_search',
              'symbol':symbol,
            },
            success: function(response){
              if(response){
                $('#company-stock-live').html(response);
                get_expiredata('#strikPriceAnalisisExpiryDate',symbol)
              }
              $('.full-page-loading').hide();
            },
            error:function(error){
              $('.full-page-loading').hide();
            }
          }); 
      },
      get_expiredata:function(ele,symbol){
        if(symbol){
            jQuery.ajax(
                {
                    type: "post",
                    dataType: "html",
                    url: ajaxUrl,
                    data: {
                        'action':'get_expire_date_list',
                        'symbol':symbol,
                    },
                    success: function(response){
                        if(response){
                           $(ele).html(response);
                        }
                        var expdate= $(ele).val();
                        $(ele).closest('.inner-wrap').find('.tabs a').attr('data-expdate',expdate);
                        $(ele).trigger('change');
                        $('.full-page-loading').hide();
                    },
                    error:function(error){
                       $('.full-page-loading').hide();
                    }
            });

        }
      },
			events: function() {
				var self    = this,
					companyStockLive  = '#company-stock-live';
          // For Detail page
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
              var symbol = $(this).val();
              if($('.template-option-chain').length){
                if (symbol) {
                  $('.full-page-loading').show();
                  self.loadCompanyFilter(symbol);
                  
                }
              }else{
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
              self.get_derivative_companyStock(InstName,symbol,ExpDate,OptType,StkPrice);
            }
          }, 10000);
          $(document).on('click','#filter_derivative_details', function (e) {
            e.preventDefault();
            var InstName = $('#companyInstName').val();
            var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
            var ExpDate = $('#ExpiryDate').val();
            var OptType = $('#OptionType').val();
            var StkPrice = $('#StrikePrice').val();
            if (InstName) {
              self.get_derivative_companyStock(InstName,symbol,ExpDate,OptType,StkPrice);
            }
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
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).text();
              var eleId= '';
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
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-opt-filter',Rtype).text();
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

            var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').text();
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
             $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).attr('data-reporttype',ReportType);
             var PageSize =10;
              if($('#check-page-type').length){
                var section ='read_more';
                PageSize =20;
              }else{
                var section ='';
              }
              
               
              self.putCallRatiosFilter(eleId,InstName,ExpDate,ReportType,PageSize,section);
          });
          // For Details Page Call Put Stock Index
          $(document).on('click','#loadMore_OPTSTK,#loadMore_OPTIDX',function(e){
            e.preventDefault(); 
            $(this).addClass('loading');
            var ele =this;
            var PageNo =parseInt($(this).attr('data-page_no'));
            var total =parseInt($(this).attr('data-total'));
            PageNo =PageNo+1;
            var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').text();
            var PageSize ='20';
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
            self.loadMorePutCallRatiosData(eleId,InstName,ReportType,ExpDate,PageNo,total,PageSize);  
            
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
              var section =$('#most_a_s_o_section').val();
              var ExpDate = $('#mostActiveStockOptionExpiryDate').val();
              var Rtype = $('#mostActiveStockOptionFilter').val();
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).attr('data-rtypefilter',Rtype).text();
              var eleId= '';
              var PageSize =20;
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
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).attr('data-rtypefilter',Rtype).text();
              var eleId= '';
               var PageSize =20;
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
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).attr('data-rtypefilter',Rtype).text();
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
          $(document).on('click','#loadMoreP,#loadMoreC',function(e){
              e.preventDefault(); 
              $(this).addClass('loading');
              var ele =this;
              var PageSize =20;
              var InstName =$('#ActiveInstName').val();
              var ExpDate = $('#mostActiveStockIndexOptionExpiryDate').val();
              var Rtype = $('#mostActiveStockIndexOptionFilter').val();
              var PageNo =parseInt($(this).attr('data-page_no'));
              var total =parseInt($(this).attr('data-total'));
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').text();
              var eleId=this;
              if(activeTb =='CALL'){
                OptType ='C';
                // eleId ='#mostActiveStockIndexOptionCall';
              }else{
                OptType ='P';
                // eleId ='#mostActiveStockIndexOptionPut';
              }
              PageNo =PageNo+1;
              self.load_more_most_active_stack_and_index(eleId,InstName,ExpDate,Rtype,PageNo,PageSize,total);
                         
                   
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
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).attr('data-otpfilter',Opt).text();
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
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).attr('data-otpfilter',Opt).text();
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
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).attr('data-otpfilter',Opt).text();
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
          //Load More For Details Page
          $(document).on('click','#loadMoreCE,#loadMorePE',function(e){
              e.preventDefault(); 
              $(this).addClass('loading');
              var eleId =this;
              var PageSize =20;
              var InstName =$('#ActiveInstName').val();;
              var ExpDate = $('#topInterestStockIndexOptionExpiryDate').val();
              var Opt = $('#topInterestStockIndexOptionFilter').val();
              var PageNo =parseInt($(this).attr('data-page_no'));
              var total =parseInt($(this).attr('data-total'));
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').text();
              var OptType ='CE';
              if(activeTb =='CALL'){
                OptType ='CE';
              }else{
                OptType ='PE'; 
              }
              
              PageNo =PageNo+1;
              self.loadMoreTopInterestStockIndexOptionCallPut(eleId,InstName,ExpDate,OptType,Opt,PageSize,PageNo,total);
               
          });
          
				return this;
			},

		};
	exports.SingleOptionChain = SingleOptionChain;

}).apply(this, [jQuery]);