// OpenInterestStockDetail
(function($) {
	var initialized = false;
	var OpenInterestStockDetail = {
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
      ajax: function(eleId,pageId, InstName,PageSize){
        jQuery.ajax(
         {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-option-chain/top-open-interest-stock-index-options',
            data: {
              'action':'top-open-interest-stock-index-options',
              'InstName':InstName,
              'PageSize':PageSize,
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
      loadMoreTopInterestStockIndexOptionCallPut:function(eleId,InstName,ExpDate,OptType,Opt,PageSize,PageNo,total){
        $(eleId).html();
          jQuery.ajax(
              {
                  type: "post",
                  dataType: "html",
                  url: global_vars.apiServerUrl + '/apiblock/react-option-chain/partial-load-more-top-open-interest-stack-and-index',
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
                  success: function(response){
                    console.log(eleId)
                      if(response){
                          $(eleId).closest('.tab-content').find('.active table').find('tbody').append(response);
                      }
                      if( total >  (PageNo*PageSize)){
                        $(eleId).attr('data-page_no',PageNo);
                      }else{
                        $(eleId).remove();
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
          eleId  = '#openInterestStockOptionDetail';
          (function($) {
            var InstName = $('#ActiveInstName').val();
            var pageId = $('#ActiveInstName').data('page-id');
            var PageSize = $('#ActiveInstName').data('page-size');
            if(pageId){
                self.ajax(eleId,pageId, InstName,PageSize);
            }
             //Load More For Details Page
            $(document).on('click','#loadMoreCE,#loadMorePE',function(e){
                e.preventDefault(); 
                $(this).after('<div class="fb-loader loader mx-auto" style="margin-top:20px;"></div>');
                var eleId =this;
                var PageSize =20;
                var InstName =$('#ActiveInstName').val();;
                var ExpDate = $('#topInterestStockIndexOptionExpiryDate').val();
                var Opt = $('#topInterestStockIndexOptionFilter').val();
                var PageNo =parseInt($(this).attr('data-page_no'));
                var total =parseInt($(this).attr('data-total'));
                var activeTb = $(this).closest('#openInterestStockOptionDetail').find('.nav-tabs a.active').text();
                var OptType ='CE';
                if(activeTb =='CALL'){
                  OptType ='CE';
                }else{
                  OptType ='PE'; 
                }
                
                PageNo =PageNo+1;
                self.loadMoreTopInterestStockIndexOptionCallPut(eleId,InstName,ExpDate,OptType,Opt,PageSize,PageNo,total);
                 
            });
          }).apply(this, [jQuery]);

				return this;
			},
		};
	exports.OpenInterestStockDetail = OpenInterestStockDetail;
}).apply(this, [jQuery]);
