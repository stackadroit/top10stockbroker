import {BrokerComparison}  from '../library/shortcodes';
import QuickerSlider from '../components/quickerslider';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    
    // JavaScript to be fired on the home page


    //
    if (typeof BrokerComparison !== 'undefined') {
      BrokerComparison.initialize();
    }

    var process = true;
    if ($( "body.mobile" ).length) {
        $([window, document]).on('click', function(){
          if (process) {
            setTimeout(function() {
              process = false;
              ReactDOM.render(
                <QuickerSlider />,
                document.getElementById('list-slider')
              );
            }, 5000);
          }
        });
    }else{
      setTimeout(function() {
        ReactDOM.render(
          <QuickerSlider />,
          document.getElementById('list-slider')
        );
      }, 5000);
    }

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
