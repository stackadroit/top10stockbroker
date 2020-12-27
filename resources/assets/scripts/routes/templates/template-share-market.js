import {TemplateShareMarket}  from '../../library/template-share-market';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
import ShareMarketChart from '../../components/graph/share-market-chart';
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
        // Graph Tabs click event.
        $(document).on('click','.shart_market_chart',function(e){
            var dur=$(this).data("filter");
            var selli=$(this).data("element");
            var resp_div=$(this).data("chart-element");
            if(!$('#'+resp_div).find('.highcharts-container ').length){
              ReactDOM.render( 
                <ShareMarketChart />,
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


