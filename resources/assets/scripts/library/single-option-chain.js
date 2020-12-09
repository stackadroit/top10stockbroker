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
                $(companyStockLive).find(".loading-data").remove();
                console.log(errorThrown);
              }
        });
      },
      get_derivative_template_companyStock:function(symbol){
        var companyStockLive="#company-stock-live";
         jQuery.ajax(
          {
            type: "post",
            dataType: "html",
            url: global_vars.ajax_url,
            data: {
              'action':'get_future_full_page_ajax_search',
              'symbol':symbol,
            },
            success: function(response){
              if(response){
                $(companyStockLive).html(response);
                // $(companyStockLive).find();
                $('#ajax-load-api-data').attr('data-exp-date',$('#ExpiryDate').val());
                $('#ajax-load-api-data').attr('data-symbol',$('#ddlCompanySymbleTpl').val());
                // $('#ajax-load-api-data').attr('data-opt-type',$('#companyInstName').val());
                // $('#ajax-load-api-data').attr('data-stk-price',$(this).val());
            
              }
              setTimeout(function(){
                // $('.nested_tab a[href="#li_1y"]').trigger('click');
              },200);
                       
              $('.full-page-loading').hide();
            },
            error:function(error){
              $('.full-page-loading').hide();
            }
        }); 
      }, 
              
      get_future_most_active_stock_index_data: function(eleId,InstName,ExpDate,Rtype,PageSize='',section=''){
        if(section){
          // for details page load more option
          var postData = {
                'action':'get_future_most_active_stock_index_data',
                'InstName':InstName,
                'ExpDate':ExpDate,
                'Rtype':Rtype,
                'PageSize':PageSize,
                'section':section,
            }
        }else{
          var postData = {
                'action':'get_future_most_active_stock_index_data',
                'InstName':InstName,
                'ExpDate':ExpDate,
                'Rtype':Rtype,
            }
        }
        
        jQuery.ajax(
        {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/futures/partial-most-active-stock-index',
            data: postData,  
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
      get_future_top_interest_stock_index_option_data: function(eleId,InstName,ExpDate,OptType,Opt){
        jQuery.ajax(
        {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/futures/partial-top-interest-stock-index',
            data:{
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
      get_future_top_interest_stock_index_option_data_detail: function(eleId,InstName,ExpDate,OptType,Opt,PageSize='',section=''){
        $(eleId).html('');
        jQuery.ajax(
        {
            type: "post",
            dataType: "html",
            url: global_vars.ajax_url,
            data:{ 
                'action':'get_future_top_interest_stock_index_option_data',
                'PageSize':PageSize,
                'InstName':InstName,
                'ExpDate':ExpDate,
                'OptType':OptType,
                'Opt':Opt,
                'section':'read_more',
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
      load_more_future_most_active_stack_and_index: function(ele,OptType,InstName,ExpDate,Rtype,PageNo,PageSize,total){
        jQuery.ajax(
                {
                  type: "post",
                  dataType: "html",
                  url: global_vars.ajax_url,
                  data: {
                    'action':'load_more_future_most_active_stack_and_index',
                    'OptType':'',
                    'InstName':InstName,
                    'ExpDate':ExpDate,
                    'Rtype':Rtype,
                    'PageNo':PageNo,
                    'PageSize':PageSize,
                  },
                success: function(response){
                    if( total >  (PageNo*PageSize)){
                      $(ele).attr('data-page_no',PageNo);
                    }else{
                      $(ele).remove();
                    }
                    if(response){
                      $(ele).closest('.tab_content').find('table').find('tbody').append(response);
                    }
                    $(ele).removeClass('loading');
                  },
                error:function(error){
                  $(ele).removeClass('loading');
                }
              });
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
          this.interval = setInterval(function(){
            var instName = $('#companyInstName').val();
            if($('#ddlCompanySymble').length){
              var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
            }else{
              var symbol = $('#ddlCompanySymbleTpl option:selected').attr('data-symble');
            }
            var ExpDate = $('#ExpiryDate').val();
            var OptType = $('#ajax-load-api-data').data('opt-type');
            var StkPrice = $('#ajax-load-api-data').data('stk-price');
            if (instName) {
                self.get_derivative_companyStock(instName,symbol,ExpDate,OptType,StkPrice);
            }
          }, 10000);
          $(companyStockLive).on('change','#ddlCompanySymbleTpl', function () {
            var symbol = $(this).val();
            if (symbol) {
              self.get_derivative_template_companyStock(symbol);  
              
            }
        });
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
              self.get_future_top_interest_stock_index_option_data(eleId,InstName,ExpDate,OptType,Opt);
          });
          // End

          // Most Active Stock Futures
          $(document).on('click','.changeMASEDFilterInDetail',function(){
              var expdate =$(this).attr('data-expdate');
              $('option:selected', this).remove();
              $('#mostActiveStockInDetailExpiryDate').val('');
              $('#mostActiveStockInDetailExpiryDate').val(expdate);
            });
          $(document)
          .on( 'change', '#mostActiveStockInDetailExpiryDate', function(event) {
              var Rtype ='vol'
              var InstName =$(this).closest('.inner-wrap').find('.tabs a.active').data('inst-name');
              var PageSize =$(this).closest('.inner-wrap').find('.tabs a.active').data('page-size');
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
            self.get_future_most_active_stock_index_data(eleId,InstName,ExpDate,Rtype,PageSize,'read_more');
          });
          //   End
          $(document).on('click','#loadMore_vol,#loadMore_val,#loadMore_G',function(e){
              e.preventDefault(); 
              var ele =this;
              var PageSize =$('.changeMASEDFilterInDetail.active').data('page-size');
              var InstName =$('.changeMASEDFilterInDetail.active').data('inst-name');
              var ExpDate = $('.changeMASEDFilterInDetail.active').data('expdate');
              var PageNo =parseInt($(this).attr('data-page_no'));
              var total =parseInt($(this).attr('data-total'));
              var activeTb= $('.tabs a.active').html();
              var Rtype = 'vol';
              if(activeTb =='Volume'){
                Rtype ='vol';
              }
              if(activeTb =='Value'){
                Rtype ='val';
              }
              if(activeTb =='Gainers'){
                Rtype ='G';
              }
              PageNo =PageNo+1;
              var OptType ='';
              self.load_more_future_most_active_stack_and_index(ele,OptType,InstName,ExpDate,Rtype,PageNo,PageSize,total);
               
            });
          // Most Active Stock Futures
          $(document).on('click','.changeTOISFilterDetails',function(){
              var expdate =$(this).attr('data-expdate');
              $('option:selected', this).remove();
              $('#topInterestStockOptionInDetailExpiryDate').val('');
              $('#topInterestStockOptionInDetailExpiryDate').val(expdate);
            });
          
          $(document).on('change','#topInterestStockOptionInDetailExpiryDate',function(){
            var symbol ='';
            var OptType ='';
            var InstName =$(this).closest('.inner-wrap').find('.tabs a.active').data('inst-name');
            var PageSize =$(this).closest('.inner-wrap').find('.tabs a.active').data('page-size');
            var ExpDate = $(this).val();
            var activeTb = $(this).closest('.inner-wrap').find('.tabs a.active').attr('data-expdate',ExpDate).text();
            var eleId= '';
            if(activeTb =='Highest'){
              Opt ='HOI';
              eleId ='#topInterestStockOptionHighest';
            }else{
              Opt ='LOI';
              eleId ='#topInterestStockOptionLowest';
            }
            self.get_future_top_interest_stock_index_option_data_detail(eleId,InstName,ExpDate,OptType,Opt,PageSize,'read_more');
          });

           $(document).on('click','#loadMore_HOI,#loadMore_LOI',function(e){
              e.preventDefault(); 
              $(this).addClass('loading');
              var ele =this;
              var InstName =$(this).closest('.inner-wrap').find('.tabs a.active').data('inst-name');
              var PageSize =$(this).closest('.inner-wrap').find('.tabs a.active').data('page-size');
              var ExpDate = $('#topInterestStockOptionExpiryDate').val();
              var PageNo =parseInt($(this).attr('data-page_no'));
              var total =parseInt($(this).attr('data-total'));
              var activeTb= $('.tabs a.active').html();
              var Opt = 'HOI';
              if(activeTb =='Highest'){
                Opt ='HOI';
              }else{
                Opt ='LOI';
              }
               
              PageNo =PageNo+1;
              jQuery.ajax(
                {
                  type: "post",
                  dataType: "html",
                  url: global_vars.ajax_url,
                  data: {
                    'action':'load_more_future_open_interest_stack_and_index',
                    'InstName':InstName,
                    'ExpDate':ExpDate,
                    'OptType':'',
                    'Opt':Opt,
                    'PageNo':PageNo,
                    'PageSize':PageSize,
                  },
                success: function(response){
                    if( total >  (PageNo*PageSize)){
                      $(ele).attr('data-page_no',PageNo);
                    }else{
                      $(ele).remove();
                    }
                    if(response){
                      $(ele).closest('.tab_content').find('table').find('tbody').append(response);
                    }
                    $(ele).removeClass('loading');
                  },
                error:function(error){
                  $(ele).removeClass('loading');
                }
              });
            });
				return this;
			},

		};
	exports.SingleOptionChain = SingleOptionChain;

}).apply(this, [jQuery]);