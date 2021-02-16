// MostActiveStockFutures
(function($) {
	var initialized = false;
	var MostActiveStockFutures = {
			defaults: {
				loadingElement : '<h5 class="loading-data text-center col-md-12 mt-4" >Loading Data..Wait</h5>'
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
      ajax: function(eleId,pageId){
        jQuery.ajax(
         {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-futures/most-active-stock-detail',
            data: {
              'action':'most-active-stock-detail',
              'pageID':pageId,
              'section':'read_more',
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
      get_future_most_active_stock_index_data: function(eleId,InstName,ExpDate,Rtype,PageSize='',section=''){
         
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
      load_more_future_most_active_stack_and_index: function(eleId,ele,OptType,InstName,ExpDate,Rtype,PageNo,PageSize,total){
        jQuery.ajax(
          {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-futures/partial-most-active-stock-load-more',
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
          eleId  = '#mostActiveStockFuturesDetail';

          (function($) {
            var pageId = $(eleId).data('page-id');
            if(pageId){
                self.ajax(eleId,pageId);
            }
            // Load More data
            
          // Most Active Stock Futures
          $(document).on('click','.changeMASEDFilterInDetail',function(){
              var expdate =$(this).attr('data-expdate');
              $('option:selected', this).remove();
              $('#mostActiveStockInDetailExpiryDate').val('');
              $('#mostActiveStockInDetailExpiryDate').val(expdate);
            });
          $(document).on( 'change', '#mostActiveStockInDetailExpiryDate', function(event) {
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
          }).apply(this, [jQuery]);
          
				return this;
			},
		};
	exports.MostActiveStockFutures = MostActiveStockFutures;
}).apply(this, [jQuery]);
