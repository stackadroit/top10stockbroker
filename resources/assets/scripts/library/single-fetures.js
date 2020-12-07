(function($) {
	var initialized = false;
	var SingleFutures = {
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
                $(companyStockLive).find('#currentStockChange').html(currentValue.FaOdiff+ ' ('+currentValue.FaOchange+'%)');

              }else{
                  $(companyStockLive).find('#currentStockRateArrow').removeClass('fa-arrow-up color-green').addClass('fa-arrow-down color-red');
                  $(companyStockLive).find('#currentStockChange').removeClass('color-green').addClass('color-red'); 
                  $(companyStockLive).find('#currentStockChange').html(currentValue.FaOdiff+ ' ('+currentValue.FaOchange+'%)');
              }
              $(companyStockLive).find('#strick_price').html(currentValue.STRIKEPRICE);
              $(companyStockLive).find('#open_price').html(currentValue.OPENPRICE);
              $(companyStockLive).find('#high_price').html(currentValue.HIGHPRICE);
              $(companyStockLive).find('#low_price').html(currentValue.LOWPRICE);
              $(companyStockLive).find('#prevclose').html(currentValue.PrevLtp);
              $(companyStockLive).find('#spot_price').html(currentValue.Nseltp);

              $(companyStockLive).find('#bid_price').html(currentValue.BBUYPRICE);
              $(companyStockLive).find('#bid_qty').html(currentValue.BBUYQTY);
              $(companyStockLive).find('#offer_price').html(currentValue.BSELLPRICE);
              $(companyStockLive).find('#offer_qty').html(currentValue.BSELLQTY);
              $(companyStockLive).find('#avg_price').html(currentValue.AVGTP);
              $(companyStockLive).find('#contra_trad').html(currentValue.TradedQtyCnt);

              $(companyStockLive).find('#turnover').html(currentValue.Turnover);
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
                $(liveUpdateElement).find(".loading-data").remove();
                console.log(errorThrown);
              }
        });
      },
      get_future_most_active_stock_index_data: function(InstName,ExpDate,Rtype,eleId){
        jQuery.ajax(
        {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/futures/partial-most-active-stock-index',
            data: {
                'action':'get_future_most_active_stock_index_data',
                'InstName':InstName,
                'ExpDate':ExpDate,
                'Rtype':Rtype,
            },
            cache:false,
            success: function(response){
                if(response){
                   $(eleId).html(response);
                }
                // $('.full-page-loading').hide();
            },
            error:function(error){
               // $('.full-page-loading').hide();
            }
        });
      },
      get_future_top_interest_stock_index_option_data: function(InstName,ExpDate,OptType,Opt,eleId){
        jQuery.ajax(
        {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/futures/partial-top-interest-stock-index',
            data: {
                'action':'get_future_top_interest_stock_index_option_data',
                'InstName':InstName,
                'ExpDate':ExpDate,
                'OptType':OptType,
                'Opt':Opt,
            },
            cache:false,
            success: function(response){
                if(response){
                   $(eleId).html(response);
                }
                // $('.full-page-loading').hide();
            },
            error:function(error){
               // $('.full-page-loading').hide();
            }
        });
      },
			events: function() {
				var self    = this,
					companyStockLive  = '#company-stock-live';
          this.interval = setInterval(function(){
            var instName = $('#companyInstName').val();
            var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
            var ExpDate = $('#ExpiryDate').val();
            var OptType = $('#ajax-load-api-data').data('opt-type');
            var StkPrice = $('#ajax-load-api-data').data('stk-price');
            if (instName) {
                self.get_derivative_companyStock(instName,symbol,ExpDate,OptType,StkPrice);
            }
          }, 10000);
          
          $(companyStockLive)
          .on( 'change', '#ExpiryDate', function(event) {
            var instName = $('#companyInstName').val();
            var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
            var ExpDate = $(this).val();
            $('#ajax-load-api-data').attr('data-exp-date',$(this).val());
            var OptType = $('#ajax-load-api-data').data('opt-type');
            var StkPrice = $('#ajax-load-api-data').data('stk-price');
            self.get_derivative_companyStock(instName,symbol,ExpDate,OptType,StkPrice);
          });
					$(companyStockLive)
          .on( 'change', '#ddlCompanySymble', function(event) {
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
          $(document)
          .on( 'change', '#mostActiveStockExpiryDate', function(event) {
            var Rtype ='vol'
            var InstName ='FUTSTK';
            var ExpDate = $(this).val();
            var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).text();
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
            self.get_future_most_active_stock_index_data(InstName,ExpDate,Rtype,eleId);
          });
          //   End
          // Most Active Index Futures
          $(document).on('click','.changeMAIEDFilter',function(){
            var expdate =$(this).attr('data-expdate');
            $('option:selected', this).remove();
            $('#mostActiveIndexExpiryDate').val('');
            $('#mostActiveIndexExpiryDate').val(expdate);
          });
          $(document)
          .on( 'change', '#mostActiveIndexExpiryDate', function(event) {
            var Rtype ='vol'
            var InstName ='FUTIDX';
            var ExpDate = $(this).val();
            var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).text();
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
            self.get_future_most_active_stock_index_data(InstName,ExpDate,Rtype,eleId);
          });
          // End
          // Top Open Interest Stock Futures
          $(document).on('click','.changeTOISFilter',function(){
            var expdate =$(this).attr('data-expdate');
            $('option:selected', this).remove();
            $('#topInterestStockOptionExpiryDate').val('');
            $('#topInterestStockOptionExpiryDate').val(expdate);
          });
          $(document)
          .on( 'change', '#topInterestStockOptionExpiryDate', function(event) {
              var symbol ='';
              var OptType ='';
              var InstName = $('#companyInstName').val();
              var ExpDate = $('#topInterestStockOptionExpiryDate').val();
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).text();
              var eleId= '';
              if(activeTb =='Highest'){
                Opt ='HOI';
                eleId ='#topInterestStockOptionHighest';
              }else{
                Opt ='LOI';
                eleId ='#topInterestStockOptionLowest';
              } 
              self.get_future_top_interest_stock_index_option_data(InstName,ExpDate,OptType,Opt,eleId);
          });
          // End
          // Top Open Interest Index Futures
          $(document).on('click','.changeTOIIFilter',function(){
            var expdate =$(this).attr('data-expdate');
            $('option:selected', this).remove();
            $('#topInterestIndexOptionExpiryDate').val('');
            $('#topInterestIndexOptionExpiryDate').val(expdate);
          });
          $(document)
          .on( 'change', '#topInterestIndexOptionExpiryDate', function(event) {
              var symbol ='';
              var OptType ='';
              var InstName ='FUTIDX';
              var ExpDate = $('#topInterestIndexOptionExpiryDate').val();
              var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).text();
              var eleId= '';
              if(activeTb =='Highest'){
                Opt ='HOI';
                eleId ='#topInterestIndexOptionHighest';
              }else{
                Opt ='LOI';
                eleId ='#topInterestIndexOptionLowest';
              }
              $('.full-page-loading').show();
              self.get_future_top_interest_stock_index_option_data(InstName,ExpDate,OptType,Opt,eleId);
          });
          // End
				return this;
			},

		};
	exports.SingleFutures = SingleFutures;

}).apply(this, [jQuery]);