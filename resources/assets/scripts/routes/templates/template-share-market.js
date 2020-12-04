import {TemplateShareMarket}  from '../../library/template-share-market';

export default {
  init() {
    // Commom Plugins
  (function($) {
    
    'use strict';
    // 
    var pages = {
            "p1": "chart",
            "p2": "sectors",
            "p3": "return-calculator",
        };
    for (var key in pages) {

            var info = {
                page: pages[key],
                pageID: '45420',
                indexCode: 123,
            };

            (function(info){
                $.ajax({
                  url: global_vars.ajax_url,
                  data: {
                    'action': 'market_data_ajax_request',
                    'data': info,
                    // 'nonce': ajaxNoncePP
                  },
                  success: function (data) {
                    $("#ajax-load-api-data " + "#" + info.page + "-id").append(data);   
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
    
  }).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


