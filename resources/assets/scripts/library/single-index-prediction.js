(function($) {
  var initialized = false;
  var SingleIndexPrediction = {
      defaults: {
        wrapper: $('body'),
        offset:50,
        loadingElement : '',
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
      getIndexCamarillaLevels:function($clstockForeCastEle,clIndexTabEle,indexCode) {
          $.ajax({
            cache: false,
              crossDomain: true,
              config: {
                    headers: {
                      'Access-Control-Allow-Origin': '*',
                    }
              },
              beforeSend: function() {
                  if(!$clstockForeCastEle.find('.fb-loader').length){
                    $clstockForeCastEle.find(clIndexTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
                  }
                },
              type:"post",
            dataType: "json",
              url: global_vars.apiServerUrl + '/apiblock/cl-indices-calculator',
                data: {
                  'indexCode':indexCode,
                  'jsonData':true,
              },
              success: function(response){
                // cData=response.calData;
                // console.log(clIndexTabEle);
                var cEle = $clstockForeCastEle.find(clIndexTabEle);
                  cEle.find('#cl-company-name').html(response.Index);
                  cEle.find('#cl-ltp-val').html(response.LTP);
                  if(response.Change >0){
                    cEle.find('#currentStockRateArrow').removeClass('fa-arrow-down color-red').addClass('fa-arrow-up color-green');
                    cEle.find('#cl-change-val').removeClass('text-red').addClass('text-green'); 
                    cEle.find('#cl-ltp-val').removeClass('text-red').addClass('text-green'); 
                    cEle.find('#cl-change-val').html(parseFloat(response.Change).toFixed(2)+ ' ('+parseFloat(response.Change_pre).toFixed(2)+'%)');
                  }else{
                    cEle.find('#currentStockRateArrow').removeClass('fa-arrow-up color-green').addClass('fa-arrow-down color-red');
                    cEle.find('#cl-change-val').removeClass('text-green').addClass('text-red'); 
                    cEle.find('#cl-ltp-val').removeClass('text-green').addClass('text-red'); 
                    cEle.find('#cl-change-val').html(parseFloat(response.Change).toFixed(2)+ ' ('+parseFloat(response.Change_pre).toFixed(2)+'%)');
                  }
                  cEle.find('#entry-bt').html(response.Support_3);
                  cEle.find('#cl-date').html(response.date);
                  cEle.find('#target1-bt').html(response.Resistance_1);
                  cEle.find('#target2-bt').html(response.Resistance_2);
                  // cEle.find('#target3-bt').html(response.Resistance_3);
                  cEle.find('#stop-loss-bt').html(response.Support_4);

                  cEle.find('#entry-st').html(response.Resistance_3);
                  cEle.find('#target1-st').html(response.Support_1);
                  cEle.find('#target2-st').html(response.Support_2);
                  // cEle.find('#target3-st').html(response.Support_3);
                  cEle.find('#stop-loss-st').html(response.Resistance_4);
                  cEle.find('#camarilla-levels-sentiment').html(response.Sentiment);

                  cEle.find('#cl-buy-entry').html(response.Support_3);
                  cEle.find('#cl-buy-target1').html(response.Resistance_1);
                  cEle.find('#cl-buy-target2').html(response.Resistance_2);
                  cEle.find('#cl-buy-target3').html(response.Resistance_3);

                  cEle.find('#cl-sell-entry').html(response.Resistance_3);
                  cEle.find('#cl-sell-target1').html(response.Support_1);
                  cEle.find('#cl-sell-target2').html(response.Support_2);
                  cEle.find('#cl-sell-target3').html(response.Support_3);
                  cEle.find('#cl-sentiment').html(response.Sentiment);
                  $clstockForeCastEle.find(clIndexTabEle).find('.fb-loader').remove();    
              },
            error: function(response){
                console.log('Error in loading...'); 
                  $clstockForeCastEle.find(clIndexTabEle).find('.fb-loader').remove();    
              }
        });
      },
      getStockCamarillaLevels:function($clstockForeCastEle,clStackTabEle,finCode) {
          $.ajax({
            cache: false,
              crossDomain: true,
              config: {
                    headers: {
                      'Access-Control-Allow-Origin': '*',
                    }
              },
              beforeSend: function() {
                  if(!$clstockForeCastEle.find('.fb-loader').length){
                    $clstockForeCastEle.find(clStackTabEle).prepend('<div class="fb-loader loader mx-auto" style="margin-bottom:20px;"></div>');
                  }
                },
              type:"post",
            dataType: "json",
              url: global_vars.apiServerUrl + '/apiblock/cl-stock-calculator',
                data: {
                  'finCode':finCode,
                  'jsonData':true,
              },
              success: function(response){
                var cEle = $clstockForeCastEle.find(clStackTabEle);
                var change_val =response.Change+'('+response.Change_pre+'%)';
                  cEle.find('#cl-company-name').html(response.Stock_name);
                  cEle.find('#cl-ltp-val').html(response.LTP);
                  if(response.Change >0){
                    cEle.find('#currentStockRateArrow').removeClass('fa-arrow-down color-red').addClass('fa-arrow-up color-green');
                    cEle.find('#cl-change-val').removeClass('text-red').addClass('text-green'); 
                    cEle.find('#cl-ltp-val').removeClass('text-red').addClass('text-green'); 
                    cEle.find('#cl-change-val').html(parseFloat(response.Change).toFixed(2)+ ' ('+parseFloat(response.Change_pre).toFixed(2)+'%)');
                  }else{
                    cEle.find('#currentStockRateArrow').removeClass('fa-arrow-up color-green').addClass('fa-arrow-down color-red');
                    cEle.find('#cl-change-val').removeClass('text-green').addClass('text-red'); 
                    cEle.find('#cl-ltp-val').removeClass('text-green').addClass('text-red'); 
                    cEle.find('#cl-change-val').html(parseFloat(response.Change).toFixed(2)+ ' ('+parseFloat(response.Change_pre).toFixed(2)+'%)');
                  }
                  cEle.find('#entry-bt').html(response.Support_3);
                  cEle.find('#cl-date').html(response.date);
                  cEle.find('#target1-bt').html(response.Resistance_1);
                  cEle.find('#target2-bt').html(response.Resistance_2);
                  cEle.find('#target3-bt').html(response.Resistance_3);
                  cEle.find('#stop-loss-bt').html(response.Support_4);

                  cEle.find('#entry-st').html(response.Resistance_3);
                  cEle.find('#target1-st').html(response.Support_1);
                  cEle.find('#target2-st').html(response.Support_2);
                  cEle.find('#target3-st').html(response.Support_3);
                  cEle.find('#stop-loss-st').html(response.Resistance_4);
                  cEle.find('#camarilla-levels-sentiment').html(response.Sentiment);

                  cEle.find('#cl-buy-entry').html(response.Support_3);
                  cEle.find('#cl-buy-target1').html(response.Resistance_1);
                  cEle.find('#cl-buy-target2').html(response.Resistance_2);
                  cEle.find('#cl-buy-target3').html(response.Resistance_3);

                  cEle.find('#cl-sell-entry').html(response.Resistance_3);
                  cEle.find('#cl-sell-target1').html(response.Support_1);
                  cEle.find('#cl-sell-target2').html(response.Support_2);
                  cEle.find('#cl-sell-target3').html(response.Support_3);
                  cEle.find('#cl-sentiment').html(response.Sentiment);
                  $clstockForeCastEle.find(clStackTabEle).find('.fb-loader').remove();    
              },
            error: function(response){
                console.log('Error in loading...'); 
                  $clstockForeCastEle.find(clIndexTabEle).find('.fb-loader').remove();    
              }
        });
      },
      events: function() {
        var self    = this,
          companyStockLive  = '#company-stock-live';
          //For Camran Table
          if($('#camarilla-levels-table-data').length){
            var $clstockForeCastEle=$('#camarilla-levels-table-data');
            var clIndexTabEle='#camarilla-levels-index';
            var indexCode =$(clIndexTabEle).data('index-code');
            if(indexCode){
              self.getIndexCamarillaLevels($clstockForeCastEle,clIndexTabEle,indexCode);
            }
            var clStockTabEle='#camarilla-levels-stock';
            var finCode =$(clStockTabEle).data('fin-code');
            if(finCode){
              self.getStockCamarillaLevels($clstockForeCastEle,clStockTabEle,finCode);
            }
          } 
  
        return this;
      },

    };
  exports.SingleIndexPrediction = SingleIndexPrediction;

}).apply(this, [jQuery]);