import {SingleFutures}  from '../../library/single-fetures';

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
      var pages = {
              "p1": "chart-data",
              "p2": "most-active-stock-data",
              "p3": "most-active-index-data",
              "p4": "top-open-interest-stock-data",
              "p5": "top-open-interest-index-data",
          };
      for (var key in pages) {
        var ins ='';
        var smb ='';
        if(key =='p2' || key =='p4'){
            ins ='FUTSTK';
            smb ='';
        }else{
            ins =$('#ajax-load-api-data').data('inst-name');
            smb =$('#ajax-load-api-data').data('symbol');
        }
            var info = {
                page: pages[key],
                pageID: $('#ajax-load-api-data').data('post-id'),
                instName: ins,
                symbol: smb,
                ExpDate:  $('#ajax-load-api-data').data('exp-date'),
                OptType: $('#ajax-load-api-data').data('opt-type'),
                StkPrice: $('#ajax-load-api-data').data('stk-price'),

                // companyName: '<?php echo @$companyName; ?>',
                // cDetailsresponse: JSON.stringify(cDetailsresponseTemp),
            };

            (function(info){
                $.ajax({
                  url: global_vars.ajax_url,
                  data: {
                    'action': 'load_future_single_page_section',
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
                  },
                    error: function (errorThrown) {
                        console.log(errorThrown);
                    }
                });
                //$.ajaxSetup({async: true});
            })(info);
        }
    if (typeof SingleFutures !== 'undefined') {
      SingleFutures.initialize();
      
    }
    
  }).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


