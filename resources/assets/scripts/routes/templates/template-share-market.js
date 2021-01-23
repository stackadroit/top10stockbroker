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
                          $("ul.nested_tab a").click(function (e) {
                              e.preventDefault();
                              $(this).closest('.nested_tab').find('a').removeClass('active');
                              $(this).addClass("active");

                              var activeTab = jQuery(this).attr("href");
                              $(this).closest(".month_tabs").find('.tab_content').hide();
                              $(this).closest(".month_tabs").find(activeTab).show();
                            }); 
                          $('.nested_tab a[href="#li_1y"').trigger('click');
                        }
                        if( info.page == 'return-calculator'){
                          //select the tabs
                            $('#company-list').select2({
                              minimumInputLength: 2,
                              placeholder: $('#indecName').html(),
                              tags: [],
                              ajax: {
                                type: "post",
                                url: global_vars.apiServerUrl+'/api/company-list',
                                dataType: 'json',
                                      type: "POST",
                                      data: function (term) {
                                          return {
                                              'security': global_vars.ajax_nonce,
                                              'action':'get_company_list',
                                              'SearchTxt': term,
                                          };
                                      },
                                      processResults: function (data) {
                                          return { results: data.stocks};
                                      },
                              }
                            });
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
              ReactDOM.unmountComponentAtNode(document.getElementById(resp_div));
              $('#'+resp_div).before('<div class="fb-loader loader mx-auto"></div>');
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


