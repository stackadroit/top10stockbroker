import {SingleFutures}  from '../../library/single-fetures';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
// import OptionFutureChart from '../../components/graph/option-future-chart';

export default {
  init() {
    // Load page section through ajax
  (function($) {
    'use strict';
      
      var info = {
          page: '',
          pageURI: '',
          pageID: $('#ajax-load-api-data').data('post-id'),
          instName: $('#ajax-load-api-data').data('inst-name'),
          symbol: $('#ajax-load-api-data').data('symbol'),
          ExpDate: $('#ajax-load-api-data').data('exp-date'),
          OptType: $('#ajax-load-api-data').data('opt-type'),
          StkPrice: $('#ajax-load-api-data').data('stk-price'),
          companyName: '',
          cDetailsresponse: $('#ajax-load-api-data').data('cDetails'),
      };

      var pages = {
          "chart-data": "https://api.top10stockbroker.com/apiblock/futures/chart",
          "most-active-stock-data": "https://api.top10stockbroker.com/apiblock/futures/most-active-stock",
          "most-active-index-data": "https://api.top10stockbroker.com/apiblock/futures/most-active-index",
          "top-open-interest-stock-data": "https://api.top10stockbroker.com/apiblock/futures/top-open-interest-stock",
          "top-open-interest-index-data": "https://api.top10stockbroker.com/apiblock/futures/top-open-interest-index",
      };

      for (var key in pages) {

            info.page = key;
            info.pageURI = pages[key];

            (function(info){
                $.ajax({
                    method: "POST",
                    url: info.pageURI,
                    crossDomain: true,
                    config: {
                       headers: {
                         'Access-Control-Allow-Origin': '*',
                       }
                    },
                    cache:false,
                    data: {
                        'action': 'load_future_single_page_section',
                        'data': info
                    },
                    success: function (data) {
                        
                    },
                    error: function (errorThrown) {
                        console.log(errorThrown);
                    }
                });
            })(info);
        }

  }).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


