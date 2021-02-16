// PutCallRatio
(function($) {
	var initialized = false;
	var PutCallRatio = {
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
      ajax: function(eleId,pageID){
        jQuery.ajax(
         {
            type: "post",
            dataType: "html",
            url: global_vars.apiServerUrl + '/apiblock/react-option-chain/put-call-ratio-stock-index-option',
            data: {
              'action':'partial_put_call_ratio_stock_index_option',
              'pageID':pageID,
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
      loadMorePutCallRatiosData(eleId,InstName,ReportType,ExpDate,PageNo,total,PageSize){
        jQuery.ajax({
          type: "post",
          dataType: "html",
          url: global_vars.apiServerUrl + '/apiblock/react-option-chain/partial-load-more-put-call-ratio-stock-index-option',
          data: {
            'action':'load_more_top_put_call_ratio',
            'ReportType':ReportType,
            'InstName':InstName,
            'ExpDate':ExpDate,
            'PageNo':PageNo,
            'PageSize':PageSize,
          },
          cache:false,
          beforeSend: function() {
              $(eleId).closest(".tab-content").prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
          },
          success: function(response){
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
            $(eleId).find('.fb-loader').remove();
            $(eleId).closest(".tab-content").find('.fb-loader').remove();
          }
        });
             
      },
			events: function() {
        var self    = this,
          putCallRatioDetails  = '#putCallRatioDetails';

          var pageId = $('#pageID').val();
          if(pageId){
              self.ajax(putCallRatioDetails,pageId);
          }

          // For Details Page Call Put Stock Index
          $(document).on('click','#loadMore_OPTSTK,#loadMore_OPTIDX',function(e){
              e.preventDefault(); 
              $(this).after('<div class="fb-loader loader mx-auto" style="margin-top:20px;"></div>');
              var ele =this;
              var PageNo =parseInt($(this).attr('data-page_no'));
              var total =parseInt($(this).attr('data-total'));
              PageNo =PageNo+1;
              var activeTb = $(this).closest('#putCallRatioDetails').find('.nav-tabs a.active').text();
              var PageSize ='20';
              var eleId= '';
              if(activeTb =='Stocks'){
                var InstName ='OPTSTK';
                var ExpDate = $("#stockExpireDateFilter").val();
                var ReportType = $("#stockReportTypeFilter").val();
                eleId ='#stocksPutCallRatios';
              }
              if(activeTb =='Indexes'){
                var InstName ='OPTIDX';
                eleId ='#indexesPutCallRatios';
                var ExpDate = $("#indexExpireDateFilter").val();
                var ReportType = $("#indexReportTypeFilter").val();
              }
              self.loadMorePutCallRatiosData(ele,InstName,ReportType,ExpDate,PageNo,total,PageSize);  
              
          });


				return this;
			},
		};
	exports.PutCallRatio = PutCallRatio;
}).apply(this, [jQuery]);
