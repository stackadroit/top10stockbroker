import {BrokerComparison}  from '../library/shortcodes';
import QuickerSlider from '../components/quickerslider';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    
    // JavaScript to be fired on the home page

    var process = true;
    if ($( "body.mobile" ).length) {
        $([window, document]).on('click', function(){
          if (process) {
            process = false;
            ReactDOM.render(
              <QuickerSlider />,
              document.getElementById('list-slider')
            );
          }
        });
    }else{
      ReactDOM.render(
        <QuickerSlider />,
        document.getElementById('list-slider')
      );
    }

    //
    if (typeof BrokerComparison !== 'undefined') {
      BrokerComparison.initialize();
    }

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
