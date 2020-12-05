import {SingleShareMarket}  from '../../library/single-share-market';

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
                indexCode: $('#indicesIndexesCode').val(),
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
                  },
                    error: function (errorThrown) {
                        console.log(errorThrown);
                    }
                });
                //$.ajaxSetup({async: true});
            })(info);
        }
    if (typeof SingleShareMarket !== 'undefined') {
      SingleShareMarket.initialize();
    }
    
  }).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


