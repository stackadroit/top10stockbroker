(function($) {
	var initialized = false;
	var SingleSharePrice = {
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
       
      get_companyStock:function (apiExchg,apiFinCode){
        var companyStockLive="#company-stock-live";
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
            success: function(response){
              // console.log(apiExchg);
              // if(response.status == 'success'){
                currentValue =response.stocks;
                $(companyStockLive).find('#company-name').html(currentValue.CompName);
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
      get_historyPrice:function(apiExchg, finCode, period){
        var historyPriceWrap="#history-price-wrap";
        jQuery.ajax(
          {
            type: "post",
            dataType: "json",
            url: global_vars.ajax_url,
            data: {
                'action':'get_stock_history_price',
                'period':period,
                'apiExchg':apiExchg,
                'finCode':finCode,
            },
            cache:false,
            success: function(response){
                if(response.status == 'success'){
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
                
            }
        });
      },
			events: function() {
				var self    = this,
					companyStockLive  = '#company-stock-live';

          // Find FinCode Details
          $('#find-co-share-price').on('click',function(e){
              e.preventDefault();
              finCode =$('#search-stock-info-main').val();
              $('#ajax-load-api-data').data('fincode',finCode);
              var apiExchg =$('#ddlCompanyIndexes').val();
              if(apiExchg){
                self.get_companyStock(apiExchg,finCode);
              }
              setTimeout(function(){
                  $('.nested_tab a[href="#li_1y"').trigger('click');
             },200);
              

          });
          // Company Page Details
          $(companyStockLive).on('change','#ddlCompanyIndexes', function () {
            var apiExchg = $(this).val();
            var finCode = $('#ajax-load-api-data').data('fincode');
            if (apiExchg) {
              self.get_companyStock(apiExchg, finCode);
            }
          });
          this.interval = setInterval(function(){
            var apiExchg = $('#ddlCompanyIndexes').val();
            var finCode = $('#ajax-load-api-data').data('fincode');
            if (apiExchg) {
              self.get_companyStock(apiExchg, finCode);
            }
          }, 10000);
          // history Section Filter
          $(document).on('change', '#history_period_box_filter',function () {
            var apiExchg = $('#ajax-load-api-data').data('apiexchg');
            var finCode = $('#ajax-load-api-data').data('fincode');
            var period = $(this).val();
            if (period) {
                self.get_historyPrice(apiExchg, finCode, period);
              }
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
              if($('#indicesIndexesCode').length){
                finCode =  $('#indicesIndexesCode').val();
              }else{
                finCode =  $('#ajax-load-api-data').data('fincode');
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