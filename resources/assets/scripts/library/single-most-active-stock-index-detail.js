// PutCallRatio
(function($) {
	var initialized = false;
	var MostActiveStockIndexDetail = {
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
            url: global_vars.apiServerUrl + '/apiblock/react-option-chain/most-active-stock-index-options',
            data: {
              'action':'strike-price-analysis',
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
      load_more_most_active_stack_and_index(eleId,InstName,ExpDate,Rtype,PageNo,PageSize,total){
          jQuery.ajax(
            {
              type: "post",
              dataType: "html",
              url: global_vars.apiServerUrl + '/apiblock/react-option-chain/partial-load-more-most-active-stack-and-index',
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
                console.log(eleId);
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
          eleId  = '#mostActiveStockIndexOptionDetail';

          (function($) {
            var InstName = $('#ActiveInstName').val();
            var pageId = $('#ActiveInstName').data('page-id');
            var PageSize = $('#ActiveInstName').data('page-size');
            if(pageId){
                self.ajax(eleId,pageId, InstName,PageSize);
            }
            // Load More data
            $(document).on('click','#loadMoreP,#loadMoreC',function(e){
                e.preventDefault(); 
                $(this).after('<div class="fb-loader loader mx-auto" style="margin-top:20px;"></div>');
                var ele =this;
                var PageSize =20;
                var InstName =$('#ActiveInstName').val();
                var ExpDate = $('#mostActiveStockIndexOptionExpiryDate').val();
                var Rtype = $('#mostActiveStockIndexOptionFilter').val();
                var PageNo =parseInt($(this).attr('data-page_no'));
                var total =parseInt($(this).attr('data-total'));
                var activeTb = $(this).closest('#mostActiveStockIndexOptionDetail').find('.nav-tabs a.active').text();
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
          }).apply(this, [jQuery]);
          
				return this;
			},
		};
	exports.MostActiveStockIndexDetail = MostActiveStockIndexDetail;
}).apply(this, [jQuery]);
