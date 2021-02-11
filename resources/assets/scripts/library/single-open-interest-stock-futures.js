// OpenInterestStockFutures
(function($) {
	var initialized = false;
	var OpenInterestStockFutures = {
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
            url: global_vars.apiServerUrl + '/apiblock/react-futures/open-interest-stock-detail',
            data: {
              'action':'open-interest-stock-detail',
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
      get_future_top_interest_stock_index_option_data_detail: function(eleId,InstName,ExpDate,OptType,Opt,PageSize='',section=''){
        $(eleId).html('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
        jQuery.ajax(
        {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-futures/partial-top-interest-stock-index',
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
			events: function() {
        var self    = this,
          eleId  = '#topInterestStockOptionDetail';

          (function($) {
            var pageId = $(eleId).data('page-id');
            if(pageId){
                self.ajax(eleId,pageId);
            }
            // Load More data
             
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
                 url: global_vars.apiServerUrl + '/apiblock/react-futures/partial-open-interest-stock-load-more',
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
          }).apply(this, [jQuery]);
          
				return this;
			},
		};
	exports.OpenInterestStockFutures = OpenInterestStockFutures;
}).apply(this, [jQuery]);
