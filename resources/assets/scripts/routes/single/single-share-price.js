import {SingleSharePrice}  from '../../library/single-share-price';

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
  }).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


