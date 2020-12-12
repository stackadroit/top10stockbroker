import {SingleOptionChain}  from '../../library/single-option-chain';

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
    
  }).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


