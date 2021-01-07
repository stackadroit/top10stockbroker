export default {
  init() {
     
  (function($) {
    
    'use strict';

      // $(els+ ".month_tabs").find('.tab_content').hide();
      // var els =".gold-silver-price-graph";
      
      // $(els+ " ul.nested_tab li > a").click(function (e) {
      //   e.preventDefault();
      //   $(this).closest('.nested_tab').find('a').removeClass('active');
      //   var activeTab = jQuery(this).addClass("active").attr("href");
      //   $(this).closest(".month_tabs").find('.tab_content').hide();
      //   $(this).closest(".month_tabs").find(activeTab).show();
      // }); 
      // $(els+' .nested_tab a[href="#li_1y"').trigger('click');
      // setTimeout(function(){
      //   
      // },1000);
  
// load Graph Data
        // function get_gold_silver_graph(dur,selli,resp_div,postId){
        //   var chartElement =resp_div;
        //   var width = 1100;
        //   var height = 300;
        //   // alert(postId);
        //   if(postId){
        //     $.ajax({
        //       type: "post",
        //       dataType: "json",
        //       url: global_vars.ajax_url,
        //       data: {
        //           'action':'get_gold_silver_price_graph_data_',
        //           'dur':dur,
        //           'postId':postId,
        //       },
        //       cache:false,
        //       success:function(res){
        //         // var data =res.stocks;
        //         $('#'+chartElement).html('');
        //         var data =res;
        //         var width = 1100;
        //         var height = 300;
        //         // var height = 300;
        //         const chart = createChart(chartElement, {height: height,
        //             rightPriceScale: {
        //               scaleMargins: {
        //                 top: 0.1,
        //                 bottom: 0.2,
        //               },
        //               borderVisible: true,
        //             },
        //             timeScale: {
        //               borderVisible: true,
        //             },
        //             grid: {
        //               horzLines: {
        //                 color: '#eee',
        //                 visible: true,
        //               },
        //               vertLines: {
        //                 color: '#ffffff',
        //               },
        //             },
        //             crosshair: {
        //                 horzLine: {
        //                   visible: false,
        //                   labelVisible: false
        //                 },
        //                 vertLine: {
        //                   visible: true,
        //                   style: 0,
        //                   width: 2,
        //                   color: 'rgba(32, 38, 46, 0.1)',
        //                   labelVisible: false,
        //                 }
        //             },
        //           }); 
        //         const lineSeries = chart.addAreaSeries({  
        //             topColor: 'rgba(19, 68, 193, 0.4)', 
        //             bottomColor: 'rgba(0, 120, 255, 0.0)',
        //             lineColor: 'rgba(19, 40, 153, 1.0)',
        //             lineWidth:3
        //         });
                 
        //         // var data = getGraphData();
        //         lineSeries.setData(data);
        //         function setLastBarText() {
        //           var dateStr = data[data.length - 1].value + data[data.length - 1].time.year + ' - ' + data[data.length - 1].time.month + ' - ' +  data[data.length - 1].time.day;
        //           // console.log(dateStr);
        //           //  toolTip.innerHTML =  '<div style="font-size: 24px; margin: 4px 0px; color: #20262E"> AEROSPACE</div>'+ '<div style="font-size: 22px; margin: 4px 0px; color: #20262E">' + data[data.length-1].value + '</div>' +
        //           //   '<div>' + dateStr + '</div>';
        //         }

        //         setLastBarText(); 

        //         chart.subscribeCrosshairMove(function(param) {
        //           // 
        //           if ( param === undefined || param.time === undefined || param.point.x < 0 || param.point.x > width || param.point.y < 0 || param.point.y > height ) {
        //               setLastBarText();   
        //             } else {
        //               var month_arr = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'];
        //               var dateStr = param.time.day +' - '+ month_arr[param.time.month] + ' - ' + param.time.year;
        //               var price = param.seriesPrices.get(lineSeries);
        //               $('#mouseoveropenVal').html(price);
        //               $('#mouseoverDate').html(dateStr);
        //               // toolTip.innerHTML = '<div style="font-size: 24px; margin: 4px 0px; color: #20262E"> AEROSPACE</div>'+ '<div style="font-size: 22px; margin: 4px 0px; color: #20262E">' + (Math.round(price * 100) / 100).toFixed(2) + '</div>' + '<div>' + dateStr + '</div>';
        //             }
        //         });
        //       },
        //       error: function(errorThrown){
        //           // $(liveUpdateElement).find(".loading-data").remove();
        //           console.log(errorThrown);
        //       }
        //     });  
        //   }
        // }
      $(document).on('click','.gold_silver_chart',function(e){
          var dur=$(this).data("filter");
          var selli=$(this).data("element");
          var resp_div=$(this).data("chart-element");
          var post_id=$(this).data("post-id");
         
      });
  }).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
