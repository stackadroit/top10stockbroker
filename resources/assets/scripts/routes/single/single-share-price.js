import {SingleSharePrice}  from '../../library/single-share-price';
import { createChart } from 'lightweight-charts';
export default {
  init() {
    // Load page section through ajax
  (function($) {
    'use strict';
    var pages = {
            "p1": "chart",
            "p2": "history-price",
            "p3": "fundamental-analysis-data",
            "p4": "comparative-analysis-data",
            "p5": "peers-camparison-data",
            "p6": "dividend-data",
            "p7": "return-calculator",
            "p8": "profit-loss",
            "p9": "balence-sheet",
            "p10": "corporate-actions",

        };
    for (var key in pages) {
            var info = {
                page: pages[key],
                pageID: $('#ajax-load-api-data').data('post-id'),
                apiExchg: $('#ajax-load-api-data').data('apiexchg'),
                finCode: $('#ajax-load-api-data').data('fincode'),
                sector: $('#ajax-load-api-data').data('sector'),
                companyName:$('#ajax-load-api-data').data('company-name'),
                // cDetailsresponse: JSON.stringify(cDetailsresponseTemp),
            };
            
            (function(info){
                $.ajax({
                  url: global_vars.ajax_url,
                  data: {
                    'action': 'share_price_data_ajax_request',
                    'data': info,
                    // 'nonce': ajaxNoncePP
                  },
                  success: function (data) {
                    $("#ajax-load-api-data " + "#" + info.page + "-id").append(data);  
                        $("#"+info.page + "-id ul.tabs").each(function () {
                            var $active, $content, $links = jQuery(this).find('a');
                            $active = jQuery($links.filter('[href="' + location.hash + '"]')[0] || $links[0]);
                            $active.addClass('active');
                            $content = $($active[0].hash);

                            // Hide the remaining content
                            $links.not($active).each(function () {
                                jQuery(this.hash).hide();
                            });

                            // Bind the click event handler
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
            })(info);
        }
    if (typeof SingleSharePrice !== 'undefined') {
      SingleSharePrice.initialize();
    }
    // load Graph Data
    function get_stock_graph(dur,selli,resp_div){
          // sc_did = $('#sc_did').val();
          // sc_did =132215;
          var chartElement =resp_div;

          var width = 1100;
          var height = 300;
          var apiExchg =$('#ajax-load-api-data').data('apiexchg');
          // finCode: $('#ajax-load-api-data').data('fincode'),
          var finCode =$('#indicesIndexesCode').val();
          finCode =(finCode)?finCode:100180;
          $.ajax({
            type: "post",
            dataType: "json",
            url: global_vars.apiServerUrl + '/api/company-graph-data',
            data: {
                'action':'get_indices_graph_data',
                'dur':dur,
                'apiExchg':apiExchg,
                'finCode':finCode,
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
                    // var price = param.seriesPrices.get(series);
                    // dateStr = param.time.year +' - '+ param.time.month + ' - ' + param.time.day;
                    var price = param.seriesPrices.get(lineSeries);
                    var price = param.seriesPrices.get(lineSeries);
                    // console.log(price);
                    $('#mouseoveropenVal').html(price);
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
        // console.log($('#'+resp_div).find('.tv-lightweight-charts').length);
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


