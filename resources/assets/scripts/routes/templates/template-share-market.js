import {TemplateShareMarket}  from '../../library/template-share-market';
import { createChart } from 'lightweight-charts';


export default {
  init() {

    // Load page section through ajax
  (function($) {
    'use strict';
    
    var pages = {
            "p1": "chart",
            "p2": "sectors",
            "p3": "return-calculator",
        };
        for (var key in pages) {

                var info = {
                    page: pages[key],
                    pageID: $('#ajax-load-api-data').data('post-id'),
                    indexCode: $('#indicesIndexes').val(),
                };

                (function(info){
                    $.ajax({
                      url: global_vars.ajax_url,
                      data: {
                        'action': 'share_market_data_ajax_request',
                        'data': info,
                        // 'nonce': ajaxNoncePP
                      },
                      success: function (data) {
                        $("#ajax-load-api-data " + "#" + info.page + "-id").append(data); 
                        if( info.page == 'chart'){
                          //select the tabs
                          jQuery('ul.tabs').each(function () {
                            // For each set of tabs, we want to keep track of
                            // which tab is active and it's associated content
                            var $active, $content, $links = jQuery(this).find('a');

                            // If the location.hash matches one of the links, use that as the active tab.
                            // If no match is found, use the first link as the initial active tab.
                            $active = jQuery($links.filter('[href="' + location.hash + '"]')[0] || $links[0]);
                            $active.addClass('active');

                            $content = $($active[0].hash);

                            // Hide the remaining content
                            $links.not($active).each(function () {
                                jQuery(this.hash).hide();
                            });

                          jQuery(this).on('click', 'a', function (e) {
                                // Make the old tab inactive.
                                $active.removeClass('active');
                                $content.hide();

                                // Update the variables with the new link and content
                                $active = jQuery(this);
                                $content = jQuery(this.hash);

                                // Make the tab active.
                                $active.addClass('active');
                                $content.show();

                                // Prevent the anchor's default click action
                                e.preventDefault();
                            });
                          });
                          $('.nested_tab a[href="#li_1y"').trigger('click');
                        }
                      },
                        error: function (errorThrown) {
                            console.log(errorThrown);
                        }
                    });
                    //$.ajaxSetup({async: true});
                })(info);
            }
        if (typeof TemplateShareMarket !== 'undefined') {
          TemplateShareMarket.initialize();
        }
        //Removed
        function getGraphData(){
          var data =[
                {time: "2020-6-17", value: "9881.15", OPEN: "9876.7", HIGH: "10003.6", LOW: "9833.8"}
            ,{time: "2020-6-18", value: "1.65", OPEN: "9863.25", HIGH: "10111.2", LOW: "9845.05"}
            ,{time: "2020-6-19", value: "10244.4", OPEN: "10119", HIGH: "10272.4", LOW: "10072.65"}
            ,{time: "2020-6-22", value: "10311.2", OPEN: "10318.75", HIGH: "10393.65", LOW: "10277.6"}
            ,{time: "2020-6-23", value: "10471", OPEN: "10347.95", HIGH: "10484.7", LOW: "10301.75"}
            ,{time: "2020-6-24", value: "10305.3", OPEN: "10529.25", HIGH: "10553.15", LOW: "10281.95"}
            ,{time: "2020-6-25", value: "10288.9", OPEN: "10235.55", HIGH: "10361.8", LOW: "10194.5"}
            ,{time: "2020-6-26", value: "10383", OPEN: "10378.9", HIGH: "10409.85", LOW: "10311.25"}
            ,{time: "2020-6-29", value: "10312.4", OPEN: "10311.95", HIGH: "10337.95", LOW: "10223.6"}
            ,{time: "2020-6-30", value: "4.1", OPEN: "10382.6", HIGH: "10401.05", LOW: "10267.35"}
            ,{time: "2020-7-1", value: "20.05", OPEN: "10323.8", HIGH: "10447.05", LOW: "10299.6"}
            ,{time: "2020-7-2", value: "10551.7", OPEN: "10493.05", HIGH: "10598.2", LOW: "10485.55"}
            ,{time: "2020-7-3", value: "10607.35", OPEN: "10614.95", HIGH: "10631.3", LOW: "10562.65"}
            ,{time: "2020-7-6", value: "10763.65", OPEN: "10723.85", HIGH: "10811.4", LOW: "10695.1"}
            ,{time: "2020-7-7", value: "2.65", OPEN: "10802.85", HIGH: "10813.8", LOW: "10689.7"}
            ,{time: "2020-7-8", value: "10705.75", OPEN: "10818.65", HIGH: "10847.85", LOW: "10676.55"}
            ,{time: "2020-7-9", value: "400.45", OPEN: "10755.55", HIGH: "10836.85", LOW: "10733"}
            ,{time: "2020-7-10", value: "10.05", OPEN: "10764.1", HIGH: "10819.4", LOW: "10713"}
            ,{time: "2020-7-13", value: "10802.7", OPEN: "10851.85", HIGH: "10894.05", LOW: "10756.05"}
            ,{time: "2020-7-14", value: "10607.35", OPEN: "10750.85", HIGH: "10755.65", LOW: "10562.9"}
            ,{time: "2020-7-15", value: "300.2", OPEN: "10701", HIGH: "10827.45", LOW: "10577.75"}
            ,{time: "2020-7-16", value: "10739.95", OPEN: "10706.2", HIGH: "10755.3", LOW: "10595.2"}
            ,{time: "2020-7-17", value: "4.7", OPEN: "10752", HIGH: "10933.45", LOW: "10749.65"}
            ,{time: "2020-7-20", value: "11022.2", OPEN: "10999.45", HIGH: "11037.9", LOW: "10953"}
            ,{time: "2020-7-21", value: "11162.25", OPEN: "11126.1", HIGH: "11179.55", LOW: "11113.25"}
            ,{time: "2020-7-22", value: "11132.6", OPEN: "11231.2", HIGH: "11238.1", LOW: "11056.55"}
            ,{time: "2020-7-23", value: "11215.45", OPEN: "11135", HIGH: "11239.8", LOW: "11103.15"}
             ];
          return data;
        }
        // load Graph Data
        function get_stock_graph(dur,selli,resp_div){
          // sc_did = $('#sc_did').val();
          // sc_did =132215;
          var chartElement =resp_div;

          var width = 1100;
          var height = 300;
          var indexCode =$('#indicesIndexes').val();
          indexCode =(indexCode)?indexCode:123;
          $.ajax({
            type: "post",
            dataType: "json",
            url: global_vars.apiServerUrl + '/api/get-indices-graph-data',
            data: {
                'action':'get_indices_graph_data',
                'dur':dur,
                'indexCode':indexCode,
                // 'finCode':finCode,
            },
            cache:false,
            success:function(res){
              // var data =res.stocks;
              $('#'+chartElement).html('');
              var data =res;
              // console.log(data);
              var width = 1100;
              var height = 300;
              // var height = 300;
              const chart = createChart(chartElement, {height: height,
                  rightPriceScale: {
                    scaleMargins: {
                      top: 0.35,
                      bottom: 0.2,
                    },
                    borderVisible: true,
                  },
                  timeScale: {
                    borderVisible: true,
                  },
                  grid: {
                    horzLines: {
                      color: '#eee',
                      visible: true,
                    },
                    vertLines: {
                      color: '#ffffff',
                    },
                  },
                  crosshair: {
                      horzLine: {
                        visible: false,
                        labelVisible: false
                      },
                      vertLine: {
                        visible: true,
                        style: 0,
                        width: 2,
                        color: 'rgba(32, 38, 46, 0.1)',
                        labelVisible: false,
                      }
                  },
                }); 
              const lineSeries = chart.addAreaSeries({  
                  topColor: 'rgba(19, 68, 193, 0.4)', 
                  bottomColor: 'rgba(0, 120, 255, 0.0)',
                  lineColor: 'rgba(19, 40, 153, 1.0)',
                  lineWidth:3
              });
               
              // var data = getGraphData();
              lineSeries.setData(data);
              function setLastBarText() {
                var dateStr = data[data.length - 1].value + data[data.length - 1].time.year + ' - ' + data[data.length - 1].time.month + ' - ' +  data[data.length - 1].time.day;
                // console.log(dateStr);
                //  toolTip.innerHTML =  '<div style="font-size: 24px; margin: 4px 0px; color: #20262E"> AEROSPACE</div>'+ '<div style="font-size: 22px; margin: 4px 0px; color: #20262E">' + data[data.length-1].value + '</div>' +
                //   '<div>' + dateStr + '</div>';
              }

              setLastBarText(); 

              chart.subscribeCrosshairMove(function(param) {
                // 
                if ( param === undefined || param.time === undefined || param.point.x < 0 || param.point.x > width || param.point.y < 0 || param.point.y > height ) {
                    setLastBarText();   
                  } else {
                    // console.log(param);
                    var month_arr = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'];
                    var dateStr = param.time.day +' - '+ month_arr[param.time.month] + ' - ' + param.time.year;
                    var price = param.seriesPrices.get(lineSeries);
                    $('#mouseoveropenVal').html(price);
                    $('#mouseoverDate').html(dateStr);
                    // toolTip.innerHTML = '<div style="font-size: 24px; margin: 4px 0px; color: #20262E"> AEROSPACE</div>'+ '<div style="font-size: 22px; margin: 4px 0px; color: #20262E">' + (Math.round(price * 100) / 100).toFixed(2) + '</div>' + '<div>' + dateStr + '</div>';
                  }
              });
            },
            error: function(errorThrown){
                // $(liveUpdateElement).find(".loading-data").remove();
                console.log(errorThrown);
            }
          });  
        }
        $(document).on('click','.shart_market_chart',function(e){
            var dur=$(this).data("filter");
            var selli=$(this).data("element");
            var resp_div=$(this).data("chart-element");
            if(!$('#'+resp_div).find('.tv-lightweight-charts').length){
                get_stock_graph(dur,selli,resp_div);
            }
        });
 
  }).apply(this, [jQuery]);
  
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


