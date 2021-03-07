(function($) {
  var initialized = false;
  var SingleFutures = {
      defaults: {
        wrapper: $('body'),
        offset:50,
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
      getDerivativeCompanyStock: function(instName,symbol,expDate,optType,stkPrice,filter=true){
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
              if(filter)
                $(companyStockLive).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
              $(companyStockLive).find('#currentStockRate').html(parseFloat(currentValue.LTP).toFixed(2));
              if(parseFloat(currentValue.FaOdiff) > 0){
                $(companyStockLive).find('#currentStockRateArrow').removeClass('fa-arrow-down color-red').addClass('fa-arrow-up color-green');
                $(companyStockLive).find('#currentStockChange').removeClass('color-red').addClass('color-green'); 
                $(companyStockLive).find('#currentStockChange').html(parseFloat(currentValue.FaOdiff).toFixed(2)+ ' ('+parseFloat(currentValue.FaOchange).toFixed(2)+'%)');

              }else{
                  $(companyStockLive).find('#currentStockRateArrow').removeClass('fa-arrow-up color-green').addClass('fa-arrow-down color-red');
                  $(companyStockLive).find('#currentStockChange').removeClass('color-green').addClass('color-red'); 
                  $(companyStockLive).find('#currentStockChange').html(parseFloat(currentValue.FaOdiff).toFixed(2)+ ' ('+parseFloat(currentValue.FaOchange).toFixed(2)+'%)');
              }
              $(companyStockLive).find('#strick_price').html(parseFloat(currentValue.STRIKEPRICE).toFixed(2));
              $(companyStockLive).find('#open_price').html(parseFloat(currentValue.OPENPRICE).toFixed(2));
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
              $(companyStockLive).find('#market_lot').html(parseFloat(currentValue.MktLot).toFixed(2));
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
              $(companyStockLive).find('.fb-loader').remove();  
            },
            error: function(errorThrown){
               $(companyStockLive).find('.fb-loader').remove();
                console.log(errorThrown);
              }
        });
      },
            
      get_future_most_active_stock_index_data: function(eleId,InstName,ExpDate,Rtype,PageSize='',section=''){
        $(eleId).find('table').find('tbody').html('');
        jQuery.ajax(
        {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-futures/partial-most-active-stock-index',
            data: {
                'action':'get_future_most_active_stock_index_data',
                'InstName':InstName,
                'ExpDate':ExpDate,
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
      get_future_top_interest_stock_index_option_data: function(eleId,InstName,ExpDate,OptType,Opt){
        $(eleId).find('table').find('tbody').html('');
        jQuery.ajax(
        {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-futures/partial-top-interest-stock-index',
            data:{
                'action':'get_future_top_interest_stock_index_option_data',
                'InstName':InstName,
                'ExpDate':ExpDate,
                'OptType':OptType,
                'Opt':Opt,
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
      ajax: function(self,eleId,pageID,symbol){
        jQuery.ajax(
         {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-futures/company-detail',
            data: {
              'pageID':pageID,
              'symbol':symbol,
              'security': global_vars.ajax_nonce
            },
            cache:false,
            beforeSend: function() {
              $(eleId).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
            },
            success: function(response){
              if(response){
                $(eleId).html(response);
                  if(self.options.topSectionLoaded){
                    setTimeout(function(){
                      $('#ajax-load-api-data').find('#chart-data-id .highcharts-container').remove();
                      $('#ajax-load-api-data').find('.nested_tab a[href="#li_1m"]').trigger('click');
                    },200);
                  }
                 self.options.topSectionLoaded =true;
                  
              }else{
                $(eleId).html();
              }
            },
            error:function(error){
              $(eleId).html();
            }
        });
      },
      events: function() {
        var self    = this,
          companyStockLive  = '#company-stock-live',
          _isScrolling = false;
          // Toad Top Section Data
          (function($) {
              'use strict';
              var pageID =$('#filter-options').data('post-id');
              var symbol =$('#filter-options').data('symbol');
              if(symbol){
                self.ajax(self,companyStockLive,pageID,symbol);
              }
              this.interval = setInterval(function(){
                var instName =$('#filter-options').data('inst-name');
                var symbol = $('#filter-options').data('symbol');
                var ExpDate = $('#ExpiryDate').val();
                var OptType = $('#filter-options').data('opt-type');
                var StkPrice = $('#filter-options').data('stk-price');
                if (instName) {
                    self.getDerivativeCompanyStock(instName,symbol,ExpDate,OptType,StkPrice,false);
                }
              }, 10000);
 
          }).apply(this, [jQuery]);  

          // Load Bellow page content after page scroll
          $(window).scroll(function() {
            if (!_isScrolling) {
              if (self.options.topSectionLoaded && $(window).scrollTop() > self.options.offset){
                _isScrolling = true;
                (function($) {
                  'use strict';
                    var instName = $('#filter-options').data('inst-name');
                    var symbol = $('#filter-options').data('symbol');
                    var ExpDate = $('#filter-options').data('exp-date');
                    var OptType = $('#filter-options').data('opt-type');
                    var StkPrice = $('#filter-options').data('stk-price');
                    var pageID =$('#filter-options').data('post-id');
                    var pages = {
                          "chart-data": "chart",
                          "most-active-stock-data": "most-active-stock",
                          "most-active-index-data": "most-active-index",
                          "top-open-interest-stock-data": "top-open-interest-stock",
                          "top-open-interest-index-data": "top-open-interest-index",
                        };
                    for (var key in pages) {
                      var ins ='';
                      var smb ='';
                      if(key =='most-active-stock-data' || key =='top-open-interest-stock-data'){
                          ins ='FUTSTK';
                          smb ='';
                      }else{
                          ins =$('#filter-options').data('inst-name');
                          smb =$('#filter-options').data('symbol');
                      }
                      var info = {
                          page: key,
                          pageURI: global_vars.apiServerUrl+'/apiblock/react-futures/'+pages[key],
                          pageID: $('#filter-options').data('post-id'),
                          instName: ins,
                          symbol: smb,
                          ExpDate: $('#filter-options').data('exp-date'),
                          OptType: $('#filter-options').data('opt-type'),
                          StkPrice: $('#filter-options').data('stk-price'),
                          companyName: $('#filter-options').data('symbol'),
                        // cDetailsresponse: JSON.stringify(cDetailsresponseTemp),
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
                                if( info.page == 'chart-data'){
                                    $("ul.nested_tab a").click(function (e) {
                                        e.preventDefault();
                                        $(this).closest('.nested_tab').find('a').removeClass('active');
                                        $(this).addClass("active");
                                        var activeTab = jQuery(this).attr("href");
                                        $(this).closest(".month_tabs").find('.tab_content').hide();
                                        $(this).closest(".month_tabs").find(activeTab).show();
                                      });
                                  $('.nested_tab a[href="#li_1m"').trigger('click');
                                }
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

          // For Detail page
          $('ul.nav-tabs').each(function () {
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
          this.interval = setInterval(function(){
            var instName = $('#filter-options').data('inst-name');
            var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
            var ExpDate = $('#ExpiryDate').val();
            var OptType = $('#ajax-load-api-data').data('opt-type');
            var StkPrice = $('#ajax-load-api-data').data('stk-price');
            if (instName) {
                self.getDerivativeCompanyStock(instName,symbol,ExpDate,OptType,StkPrice,false);
            }
          }, 10000);

          
          $(companyStockLive).on( 'change', '#ExpiryDate', function(event) {
            var instName = $('#filter-options').data('inst-name');
            var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
            var ExpDate = $(this).val();
            $('#ajax-load-api-data').attr('data-exp-date',$(this).val());
            var OptType = $('#ajax-load-api-data').data('opt-type');
            var StkPrice = $('#ajax-load-api-data').data('stk-price');
            self.getDerivativeCompanyStock(instName,symbol,ExpDate,OptType,StkPrice);
          });
          $(companyStockLive).on( 'change', '#ddlCompanySymble', function(event) {
              var filterUri = $(this).val();
              if (filterUri) {
                  window.location.href =filterUri;
              }
          });
          // Most Active Stock Futures
          $(document).on('click','.changeMASEDFilter',function(){
            var expdate =$(this).attr('data-expdate');
            $('option:selected', this).remove();
            $('#mostActiveStockExpiryDate').val('');
            $('#mostActiveStockExpiryDate').val(expdate);
          });
          $(document).on( 'change', '#mostActiveStockExpiryDate', function(event) {
            var Rtype ='vol'
            var InstName ='FUTSTK';
            var ExpDate = $(this).val();
            var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).text();
            var eleId= '';
            if(activeTb =='Volume'){
              Rtype ='vol';
              eleId ='#mostActiveStockVolume';
            }else if(activeTb == 'Value'){
              Rtype ='val';
              eleId ='#mostActiveStockValue';
            }else if(activeTb == 'Gainers'){
              Rtype ='G';
              eleId ='#mostActiveStockGainers';
            }
            self.get_future_most_active_stock_index_data(eleId,InstName,ExpDate,Rtype);
          });
          //   End
          // Most Active Index Futures
          $(document).on('click','.changeMAIEDFilter',function(){
            var expdate =$(this).attr('data-expdate');
            $('option:selected', this).remove();
            $('#mostActiveIndexExpiryDate').val('');
            $('#mostActiveIndexExpiryDate').val(expdate);
          });
          $(document).on( 'change', '#mostActiveIndexExpiryDate', function(event) {
            var Rtype ='vol'
            var InstName ='FUTIDX';
            var ExpDate = $(this).val();
            var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).text();
            var eleId= '';
            if(activeTb =='Volume'){
              Rtype ='vol';
              eleId ='#mostActiveIndexVolume';
            }else if(activeTb == 'Value'){
              Rtype ='val';
              eleId ='#mostActiveIndexValue';
            }else if(activeTb == 'Gainers'){
              Rtype ='G';
              eleId ='#mostActiveIndexGainers';
            }
            self.get_future_most_active_stock_index_data(eleId,InstName,ExpDate,Rtype);
          });
          // End
          // Top Open Interest Stock Futures
          $(document).on('click','.changeTOISFilter',function(){
            var expdate =$(this).attr('data-expdate');
            $('option:selected', this).remove();
            $('#topInterestStockOptionExpiryDate').val('');
            $('#topInterestStockOptionExpiryDate').val(expdate);
          });
          $(document).on( 'change', '#topInterestStockOptionExpiryDate', function(event) {
              var symbol ='';
              var OptType ='';
              var InstName = $('#filter-options').data('inst-name');
              var ExpDate = $('#topInterestStockOptionExpiryDate').val();
              var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).text();
              var eleId= '';
              if(activeTb =='Highest'){
                Opt ='HOI';
                eleId ='#topInterestStockOptionHighest';
              }else{
                Opt ='LOI';
                eleId ='#topInterestStockOptionLowest';
              } 
              self.get_future_top_interest_stock_index_option_data(eleId,InstName,ExpDate,OptType,Opt);
          });
          // End
          // Top Open Interest Index Futures
          $(document).on('click','.changeTOIIFilter',function(){
            var expdate =$(this).attr('data-expdate');
            $('option:selected', this).remove();
            $('#topInterestIndexOptionExpiryDate').val('');
            $('#topInterestIndexOptionExpiryDate').val(expdate);
          });
          $(document).on( 'change', '#topInterestIndexOptionExpiryDate', function(event) {
              var symbol ='';
              var OptType ='';
              var InstName ='FUTIDX';
              var ExpDate = $('#topInterestIndexOptionExpiryDate').val();
              var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).text();
              var eleId= '';
              if(activeTb =='Highest'){
                Opt ='HOI';
                eleId ='#topInterestIndexOptionHighest';
              }else{
                Opt ='LOI';
                eleId ='#topInterestIndexOptionLowest';
              }
              self.get_future_top_interest_stock_index_option_data(eleId,InstName,ExpDate,OptType,Opt);
          });
          // End

          
        return this;
      },

    };
  exports.SingleFutures = SingleFutures;

}).apply(this, [jQuery]);