import {SingleOptionChain}  from '../../library/single-option-chain';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
import OptionChainChart from '../../components/graph/option-chain-chart';

export default {
  init() {
    // Load page section through ajax
  	(function($) {
    	'use strict';
      	var instName = $('#ajax-load-api-data').data('inst-name');
      	var symbol = $('#ajax-load-api-data').data('symbol');
      	var ExpDate = $('#ajax-load-api-data').data('exp-date');
      	var OptType = $('#ajax-load-api-data').data('opt-type');
      	var StkPrice = $('#ajax-load-api-data').data('stk-price');
        // For Template page condition
        if($('.template-option-chain').length){
          var pages = {
            // "p1": "chart-data",
            "p2": "strike-price-analysis-data",
            // "p3": "most-active-options-data",
            // "p4": "open-interest-analysis-data",
            "p5": "top-put-call-ratio-data",
            "p6": "most-active-stock-options-data",
            "p7": "most-active-index-options-data",
            "p8": "top-open-interest-stock-options-data",
            "p9": "top-open-interest-index-options-data",
          };
        }else{
          var pages = {
            "p1": "chart-data",
            "p2": "strike-price-analysis-data",
            "p3": "most-active-options-data",
            "p4": "open-interest-analysis-data",
            "p5": "top-put-call-ratio-data",
            "p6": "most-active-stock-options-data",
            "p7": "most-active-index-options-data",
            "p8": "top-open-interest-stock-options-data",
            "p9": "top-open-interest-index-options-data",
          };
        }
      	
      	for (var key in pages) {
	        var info = {
                page: pages[key],
                pageID: $('#ajax-load-api-data').data('post-id'),
                InstName: instName,
                symbol: symbol,
                ExpDate: ExpDate,
                OptType: OptType,
                StkPrice: StkPrice,
                // companyName: '<?php echo @$companyName; ?>',
                // cDetailsresponse: JSON.stringify(cDetailsresponseTemp),
            };
             
            (function(info){
                $.ajax({
                  url: global_vars.ajax_url,
                  data: {
                    'action': 'load_option_chain_page_section',
                    'data': info,
                    'security': global_vars.ajax_nonce,
                  },
                  success: function (data) {
                    $("#ajax-load-api-data " + "#" + info.page + "-id").append(data);   
                    //select the tabs
                        jQuery("#" + info.page + "-id "+'ul.tabs').each(function () {
                            // For each set of tabs, we want to keep track of
                            // which tab is active and it's associated content
                            var $active, $content, $links = jQuery(this).find('a');

                            // If the location.hash matches one of the links, use that as the active tab.
                            // If no match is found, use the first link as the initial active tab.
                            $active = jQuery($links.filter('[href="' + location.hash + '"]')[0] || $links[0]);
                             if(info.page !='chart-data'){
                              $active.addClass('active');
                            }

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
                                 // $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
                         
                                // Prevent the anchor's default click action
                                e.preventDefault();
                            });
                        });
                      if( info.page == 'chart-data'){
                          //select the tabs
                          $("ul.nested_tab a").click(function (e) {
                              e.preventDefault();
                              $(this).closest('.nested_tab').find('a').removeClass('active');
                              $(this).addClass("active");

                              var activeTab = jQuery(this).attr("href");
                              $(this).closest(".month_tabs").find('.tab_content').hide();
                              $(this).closest(".month_tabs").find(activeTab).show();
                            });
                          $('.nested_tab a[href="#li_1m"').trigger('click');
                      }
                  },
                    error: function (errorThrown) {
                        console.log(errorThrown);
                    }
                });
                //$.ajaxSetup({async: true});
            })(info);
        }
	    if (typeof SingleOptionChain !== 'undefined') {
	      SingleOptionChain.initialize();
	      
	    }
    
    // load Graph Data
    function get_stock_graph(dur,selli,resp_div){
          // sc_did = $('#sc_did').val();
          // sc_did =132215;
          var chartElement =resp_div;

          var width = 1100;
          var height = 300;
          var apiExchg =$('#ajax-load-api-data').data('apiexchg');
          var symbol =$('#ddlCompanySymble').find(':selected').data('symble');
          symbol =(symbol)?symbol:'TCS';
          var instName =$('#companyInstName').val();
          var expDate =$('#ExpiryDate').val();
          var optType =$('#OptionType').val();
          var stkPrice =$('#StrikePrice').val();
          $.ajax({
            type: "post",
            dataType: "json",
            url: global_vars.apiServerUrl + '/api/derivative-company-graph-data',
            data: {
                'action':'get_derivative_company_graph_data',
                'dur':dur,
                'instName':instName,
                'symbol':symbol,
                'expDate': expDate,
                'optType': optType,
                'stkPrice': stkPrice
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
        if(!$('#'+resp_div).find('.highcharts-container ').length){
          ReactDOM.render( 
            <OptionChainChart />,
            document.getElementById(resp_div)
          );
        }
      });
  }).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

