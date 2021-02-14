(function($) {
  var initialized = false;
  var SingleSharePrice = {
      defaults: {
        wrapper: $('body'),
        offset:150,
        loadingElement : '',
        delay: 1000,
        visibleMobile: false,
        label: false
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
       
      get_companyStock:function (apiExchg,apiFinCode,filter=true){
        var companyStockLive="#company-stock-live";
        if(apiFinCode){
          jQuery.ajax(
            {
              type: "post",
              dataType: "json",
              url: global_vars.apiServerUrl +'/api/company-details' ,
              data: {
                'action':'get_stock_company_details',
                'apiExchg':apiExchg,
                'finCode':apiFinCode
              },
              cache:false,
              beforeSend: function() {
                if(filter){
                  $(companyStockLive).find(".inner-wrap").prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
                }
              },
              success: function(response){
                // console.log(apiExchg);
                // if(response.status == 'success'){
                  currentValue =response.stocks;
                  // console.log(currentValue); 
                  if(currentValue.CompName){
                    $(".serch-form-comp .select2-selection__rendered").html(currentValue.CompName);
                    var sectorName ='Bank';
                    if(currentValue.Sector !='Bank'){
                      sectorName ='NonBank';
                    } 
                    $('#filter-options').attr('data-sector',sectorName);
                    $('#filter-options').attr('data-details',JSON.stringify(currentValue));
                    $('#filter-options').attr('data-company-name',currentValue.CompName);
                    $('#filter-options').attr('data-apiexchg',currentValue.symbol);
                    $('#ajax-load-api-data').attr('data-company-name',currentValue.CompName);
                    $('#ajax-load-api-data').attr('data-sector',currentValue.Sector);
                  }
                  if(!currentValue.s_name){
                    $('#company-stock-live-hint').show();
                  }
                  $(companyStockLive).find('#company-name').html(currentValue.CompName);
                  if($("#company-list").length){
                    $(".retcalc_form .select2-selection__placeholder").html(currentValue.CompName);
                    $(".serch-form-comp .select2-selection__rendered").html(currentValue.CompName);
                  }
                  
                  $(companyStockLive).find('#bse-value').html(currentValue.scripcode);
                  $(companyStockLive).find('#nse-value').html(currentValue.symbol);
                  $(companyStockLive).find('#sector-value').html(currentValue.Sector);
                  $(companyStockLive).find('#currentStockRate').html(parseFloat(currentValue.CLOSE).toFixed(2));
                  if(currentValue.CHANGE >0){
                    $(companyStockLive).find('#currentStockRateArrow').removeClass('fa-arrow-down color-red').addClass('fa-arrow-up color-green');
                    $('#currentStockChange').removeClass('text-red').addClass('text-green'); 
                    $(companyStockLive).find('#currentStockChange').html(parseFloat(currentValue.CHANGE).toFixed(2)+ ' ('+parseFloat(currentValue.PER_CHANGE).toFixed(2)+'%)');
                  }else{
                    $(companyStockLive).find('#currentStockRateArrow').removeClass('fa-arrow-up color-green').addClass('fa-arrow-down color-red');
                    $('#currentStockChange').removeClass('text-green').addClass('text-red'); 
                    $(companyStockLive).find('#currentStockChange').html(parseFloat(currentValue.CHANGE).toFixed(2)+ ' ('+parseFloat(currentValue.PER_CHANGE).toFixed(2)+'%)');
                  }
                  $(companyStockLive).find('#52weeklow').html(parseFloat(currentValue["52WeekLow"]).toFixed(2));
                  $(companyStockLive).find('#52weekhigh').html(parseFloat(currentValue["52WeekHigh"]).toFixed(2));
                  $(companyStockLive).find('#daylow').html(parseFloat(currentValue.LOW).toFixed(2));
                  $(companyStockLive).find('#dayhigh').html(parseFloat(currentValue.High).toFixed(2));
                  $(companyStockLive).find('#prevclose').html(parseFloat(currentValue.PREV_CLOSE).toFixed(2));
                  $(companyStockLive).find('#open').html(parseFloat(currentValue.OPEN).toFixed(2));
                   
                  $(companyStockLive).find('#6mreturn').html(parseFloat(currentValue['6MonthPerChange']).toFixed(2));
                  if(currentValue['6MonthPerChange']>0){
                    $(companyStockLive).find('#6mreturn').removeClass('text-red').addClass('text-green');
                  }else{
                    $(companyStockLive).find('#6mreturn').removeClass('text-green').addClass('text-red');
                  }
                  $(companyStockLive).find('#1yreturn').html(parseFloat(currentValue['1YearPerChange']).toFixed(2));
                  if(currentValue['1YearPerChange'] >0){
                    $(companyStockLive).find('#1yreturn').removeClass('text-red').addClass('text-green');
                  }else{
                    $(companyStockLive).find('#1yreturn').removeClass('text-green').addClass('text-red');
                  }
                  $(companyStockLive).find('#mcaprs').html(parseFloat(currentValue.MCAP).toFixed(2));
                  $(companyStockLive).find('#totalrs').html(currentValue.VOLUME);
                  $(companyStockLive).find('#facevalue').html(currentValue.FV);
                  $(companyStockLive).find('#epsRATIO').html(parseFloat(currentValue.EPSc).toFixed(2));
                  $(companyStockLive).find('#peRATIO').html(parseFloat(currentValue.PE).toFixed(2));
                  $(companyStockLive).find('#bvRatio').html(parseFloat(currentValue.MCAP_SALES).toFixed(2));
                  $(companyStockLive).find('#deliverableRatio').html(parseFloat(currentValue.Deliverable).toFixed(2));
                  $(companyStockLive).find('#dividendRatio').html(parseFloat(currentValue.YIELD).toFixed(2));
                // }
                 $(companyStockLive).find(".fb-loader").remove();       
              },
              error: function(errorThrown){
                  $(companyStockLive).find(".fb-loader").remove();
                  console.log(errorThrown);
              }
          });
        }
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
       $('#get_return_result').html('<div class="fb-loader loader mx-auto"></div>');
        jQuery.ajax(
          {
              type: "post",
              dataType: "json",
              url: global_vars.apiServerUrl +'/api/price-calculator',
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
                  response =response.stocks;
                  if(response.status == 'success'){
                      $(document).find('#get_return_result').html(response.result);
                  }else{
                      $(document).find('#get_return_result').html('You provided invalid options. Please try again.');
                  }
                  
              },
             error: function(errorThrown){
              $(document).find('#get_return_result').html('You provided invalid options. Please try again.');
            }
          });

      },
      get_historyPrice:function(apiExchg, finCode, period){
        var historyPriceWrap="#history-price-wrap";
        
        jQuery.ajax(
          {
            type: "post",
            dataType: "json",
            // url: global_vars.ajax_url,
            url: global_vars.apiServerUrl +'/api/history-price',
            data: {
                'action':'get_stock_history_price',
                'period':period,
                'apiExchg':apiExchg,
                'finCode':finCode,
            },
            cache:false,
            beforeSend: function() {
                $(historyPriceWrap).html('<tr><td colspan="4"><div class="fb-loader loader mx-auto" style="margin-top:20px;margin-bottom:20px;"></div></td></tr>');
            },
            success: function(response){
              response =response.stocks;
                if(response.price.length){
                    $(historyPriceWrap).html('');
                  var boxcl='';
                   if((parseFloat(response.avg_pre)*100) > 0){
                      boxcl='bggreen_tbl';
                   }else{
                      boxcl='bgred_tbl';
                   }
                   var rowhtml ='';
                   $.each(response.price, function(idx, obj) {
                       rowhtml='<tr><td><span class="fn_semibold">'+obj.label+
                              '</span></td>'+
                            '<td>'+obj.old_price+'</td>'+
                            '<td>'+obj.current_price+'</td>'+
                            '<td><div class="'+obj.class+'">'+obj.avg_pre+'<div>'+
                            '</td></tr>';
                         
                       $(historyPriceWrap).append(rowhtml);
                    });
                }
                
            },
            error:function(){
              $(historyPriceWrap).html('');
            }
        });
      },
      events: function() {
        var self    = this,
          companyStockLive  = '#company-stock-live',_isScrolling = false;
          $(document).ready(function($){
            var apiExchg = $('#ddlCompanyIndexes').val();
            var finCode = $('#filter-options').attr('data-fincode');
              if (apiExchg) {
                self.get_companyStock(apiExchg, finCode);
            }
          });
          // Load full content on Page Scrolling
          $(window).scroll(function() {
            if (!_isScrolling) {
              _isScrolling = true;
              (function($) {
                'use strict';
                var pages = {
                      "chart": global_vars.apiServerUrl+"/apiblock/react-share-price/chart",
                      "history-price": global_vars.apiServerUrl+"/apiblock/react-share-price/history-price",
                      "fundamental-analysis-data": global_vars.apiServerUrl+"/apiblock/react-share-price/fundamental-analysis",
                      "comparative-analysis-data": global_vars.apiServerUrl+"/apiblock/react-share-price/comparative-analysis",
                      "peers-camparison-data": global_vars.apiServerUrl+"/apiblock/react-share-price/peers-camparison",
                      "dividend-data": global_vars.apiServerUrl+"/apiblock/react-share-price/dividend",
                      "return-calculator": global_vars.apiServerUrl+"/apiblock/react-share-price/calculator",
                      "profit-loss": global_vars.apiServerUrl+"/apiblock/react-share-price/profit-loss",
                      "balence-sheet": global_vars.apiServerUrl+"/apiblock/react-share-price/balance-sheet",
                      "corporate-actions": global_vars.apiServerUrl+"/apiblock/react-share-price/corporate-actions",

                  };

                if($('#share-price-tpl').length){
                  var pages = {
                      "chart": global_vars.apiServerUrl+"/apiblock/react-share-price/chart",
                      "return-calculator": global_vars.apiServerUrl+"/apiblock/react-share-price/calculator",
                  };
                }
                for (var key in pages) {
                        var secters =($('#filter-options').data('sector'))?$('#filter-options').data('sector'):'Bank';
                        var cDetailsresponse =($('#filter-options').data('details'))?$('#filter-options').data('details'):'{}';
                        var info = {
                            page: key,
                            pageURI: pages[key],
                            pageID: $('#filter-options').data('post-id'),
                            apiExchg:$('#filter-options').data('apiexchg'),
                            finCode: $('#filter-options').data('fincode'),
                            sector: secters,
                            cDetailsresponse:JSON.stringify(cDetailsresponse),
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
                                  'action': 'data_ajax_request',
                                  'data': info,
                                  'nonce': global_vars.ajax_nonce,
                              },
                              
                              success: function (data) {
                                $("#ajax-load-api-data " + "#" + info.page + "-id").append(data);  
                                $("#"+info.page + "-id ul.tabs").each(function () {
                                    var $active, $content, $links = jQuery(this).find('a');
                                    $active = jQuery($links.filter('[href="' + location.hash + '"]')[0] || $links[0]);
                                    $active.addClass('active');
                                    $content = $($active[0].hash);
                                    $links.not($active).each(function () {
                                        jQuery(this.hash).hide();
                                    });

                                            // Bind the click event handler
                                    jQuery(this).on('click', 'a', function (e) {
                                                // Make the old tab inactive.
                                      $active.removeClass('active');
                                      $content.hide();
                                                // Update the variables with the new link and content
                                      $active = jQuery(this);
                                      $content = jQuery(this.hash);
                                                // Make the tab active.
                                      $active.addClass('active');
                                      $content.show();
                                                // Prevent the anchor's default click action
                                       e.preventDefault();
                                      });
                                }); 
                                if( info.page == 'chart'){
                                      //select the tabs
                                  $("ul.nested_tab a").click(function (e) {
                                  e.preventDefault();
                                  $(this).closest('.nested_tab').find('a').removeClass('active');
                                  $(this).addClass("active");
                                  var activeTab = jQuery(this).attr("href");
                                    $(this).closest(".month_tabs").find('.tab_content').hide();
                                          $(this).closest(".month_tabs").find(activeTab).show();
                                    }); 
                                   $('.nested_tab a[href="#li_1y"').trigger('click');
                                }
                                if( info.page == 'return-calculator'){
                                  $('#company-list').select2({
                                          minimumInputLength: 2,
                                          placeholder: $('#company-name').html(),
                                          tags: [],
                                          ajax: {
                                            type: "post",
                                            url: global_vars.apiServerUrl+'/api/company-list',
                                            dataType: 'json',
                                                  type: "POST",
                                                  data: function (term) {
                                                      return {
                                                          'security': global_vars.ajax_nonce,
                                                          'action':'get_company_list',
                                                          'SearchTxt': term,
                                                      };
                                                  },
                                                  processResults: function (data) {
                                                      return { results: data.stocks};
                                                  },
                                          }
                                        });
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
          });

          if($('#search-stock-info-main').length){
            $('#search-stock-info-main').select2({
              minimumInputLength: 2,
              tags: [],
              ajax: {
                type: "post",
                url: global_vars.apiServerUrl+'/api/company-list',
                dataType: 'json',
                      type: "POST",
                      data: function (term) {
                          return {
                              'security': global_vars.ajax_nonce,
                              'action':'get_company_list',
                              'SearchTxt': term,
                          };
                      },
                      processResults: function (data) {
                          return { results: data.stocks};
                      },
              }
            });
          }
          // Find FinCode Details
          $('#find-co-share-price').on('click',function(e){
              e.preventDefault();
              finCode =$('#search-stock-info-main').val();
              $('#ajax-load-api-data').attr('data-fincode',finCode);
              var apiExchg =$('#ddlCompanyIndexes').val();
              if(apiExchg){
                self.get_companyStock(apiExchg,finCode);
              }
              setTimeout(function(){
                $('.tab_content').find('.highcharts-container').remove();
                $('#ajax-load-api-data').find('.nested_tab a[href="#li_1y"]').trigger('click');
             },500);
          });
          // Company Page Details
          $(companyStockLive).on('change','#ddlCompanyIndexes', function () {
            var apiExchg = $(this).val();
            var finCode = $('#ajax-load-api-data').attr('data-fincode');
            if (apiExchg) {
              self.get_companyStock(apiExchg, finCode);
            }
          });
          
          this.interval = setInterval(function(){
            var apiExchg = $('#ddlCompanyIndexes').val();
            var finCode = $('#ajax-load-api-data').attr('data-fincode');
            if (apiExchg) {
              self.get_companyStock(apiExchg, finCode,false);
            }
          }, 10000);
          




          // history Section Filter
          $(document).on('change', '#history_period_box_filter',function () {
            var apiExchg = $('#ajax-load-api-data').attr('data-apiexchg');
            var finCode = $('#ajax-load-api-data').attr('data-fincode');
            var period = $(this).val();
            if (period) {
                self.get_historyPrice(apiExchg, finCode, period);
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
              if($('#indicesIndexesCode').length){
                finCode =  $('#indicesIndexesCode').val();
              }else{
                finCode = $('#ajax-load-api-data').attr('data-fincode');
              }
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
  exports.SingleSharePrice = SingleSharePrice;

}).apply(this, [jQuery]);