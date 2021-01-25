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
            beforeSend: function() {
              $(companyStockLive).find('.fb-loader').remove();
              $(companyStockLive).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
                $('#ajax-load-api-data').find('#chart-data-id .highcharts-container').remove();
                $('#ajax-load-api-data').find('.nested_tab a[href="#li_1m"]').trigger('click');
              },200);
               $(companyStockLive).find('.fb-loader').remove();
            },
            error:function(error){
              $(companyStockLive).find('.fb-loader').remove();
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
      get_future_top_interest_stock_index_option_data_detail: function(eleId,InstName,ExpDate,OptType,Opt,PageSize='',section=''){
        $(eleId).html('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
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
                $(eleId).find('.fb-loader').remove();
            },
            error:function(error){
               $(eleId).find('.fb-loader').remove();
            }
        });
      },
      load_more_future_most_active_stack_and_index: function(eleId,ele,OptType,InstName,ExpDate,Rtype,PageNo,PageSize,total){
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
                 cache:false,
                success: function(response){
                  $(eleId).find('.fb-loader').remove();
                    if( total >  (PageNo*PageSize)){
                      $(ele).attr('data-page_no',PageNo);
                    }else{
                      $(ele).remove();
                    }
                    if(response){
                      $(eleId).find('table').find('tbody').append(response);
                    }
                    $(eleId).find('.fb-loader').remove();
                  },
                error:function(error){
                  $(eleId).find('.fb-loader').remove();
                }
              });
      },
			events: function() {
				var self    = this,
					companyStockLive  = '#company-stock-live';
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
            var instName = $('#companyInstName').val();
            if($('#ddlCompanySymble').length){
              var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
            }else{
              var symbol = $('#ddlCompanySymbleTpl option:selected').attr('data-symble');
            }
            // alert(symbol);
            var ExpDate = $('#ExpiryDate').val();
            var OptType = $('#ajax-load-api-data').data('opt-type');
            var StkPrice = $('#ajax-load-api-data').data('stk-price');
            if (instName) {
                self.get_derivative_companyStock(instName,symbol,ExpDate,OptType,StkPrice,false);
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
            // var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
            if($('#ddlCompanySymble').length){
              var symbol = $('#ddlCompanySymble option:selected').attr('data-symble');
            }else{
              var symbol = $('#ddlCompanySymbleTpl option:selected').attr('data-symble');
            }
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
          $(document)
          .on( 'change', '#mostActiveIndexExpiryDate', function(event) {
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
          $(document)
          .on( 'change', '#topInterestStockOptionExpiryDate', function(event) {
              var symbol ='';
              var OptType ='';
              var InstName = $('#companyInstName').val();
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
          $(document)
          .on( 'change', '#topInterestIndexOptionExpiryDate', function(event) {
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
              var InstName =$(this).closest('.tab-holder').find('.nav-tabs a.active').data('inst-name');
              var PageSize =$(this).closest('.tab-holder').find('.nav-tabs a.active').data('page-size');
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
            self.get_future_most_active_stock_index_data(eleId,InstName,ExpDate,Rtype,PageSize,'read_more');
          });
          //   End
          $(document).on('click','#loadMore_vol,#loadMore_val,#loadMore_G',function(e){
              e.preventDefault(); 
              $(this).after('<div class="fb-loader loader mx-auto" style="margin-top:20px;"></div>');
              var ele =this;
              var PageSize =$('.changeMASEDFilterInDetail.active').data('page-size');
              var InstName =$('.changeMASEDFilterInDetail.active').data('inst-name');
              var ExpDate = $('.changeMASEDFilterInDetail.active').data('expdate');
              var PageNo =parseInt($(this).attr('data-page_no'));
              var total =parseInt($(this).attr('data-total'));
              var activeTb= $('.nav-tabs a.active').html();
              // console.log(activeTb+PageNo+total+PageSize);
              var Rtype = 'vol';
              var eleId = '';
              if(activeTb =='Volume'){
                Rtype ='vol';
                eleId ='#mostActiveStockVolume';
              }
              if(activeTb =='Value'){
                Rtype ='val';
                eleId ='#mostActiveStockValue';
              }
              if(activeTb =='Gainers'){
                Rtype ='G';
                eleId ='#mostActiveStockGainers';
              }
              PageNo =PageNo+1;
              var OptType ='';
              self.load_more_future_most_active_stack_and_index(eleId,ele,OptType,InstName,ExpDate,Rtype,PageNo,PageSize,total);
               
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
            var InstName =$(this).closest('.tab-holder').find('.nav-tabs a.active').data('inst-name');
            var PageSize =$(this).closest('.tab-holder').find('.nav-tabs a.active').data('page-size');
            var ExpDate = $(this).val();
            var activeTb = $(this).closest('.tab-holder').find('.nav-tabs a.active').attr('data-expdate',ExpDate).text();
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
              $(this).after('<div class="fb-loader loader mx-auto" style="margin-top:20px;"></div>');
              var ele =this;
              var InstName =$(this).closest('#topInterestStockOptionDetail').find('.nav-tabs a.active').data('inst-name');
              var PageSize =$(this).closest('#topInterestStockOptionDetail').find('.nav-tabs a.active').data('page-size');
              var ExpDate = $('#topInterestStockOptionInDetailExpiryDate').val();

              var PageNo =parseInt($(this).attr('data-page_no'));
              var total =parseInt($(this).attr('data-total'));
              var activeTb= $('.nav-tabs a.active').html();
              var Opt = 'HOI';
              if(activeTb =='Highest'){
                Opt ='HOI';
                eleId='#topInterestStockOptionHighest';
              }else{
                Opt ='LOI';
                eleId='#topInterestStockOptionLowest';
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
                      $(eleId).find('table').find('tbody').append(response);
                    }
                    $(eleId).closest(".tab-content").find('.fb-loader').remove();
                  },
                error:function(error){
                  $(eleId).closest(".tab-content").find('.fb-loader').remove();
                }
              });
            });
				return this;
			},

		};
	exports.SingleFutures = SingleFutures;

}).apply(this, [jQuery]);