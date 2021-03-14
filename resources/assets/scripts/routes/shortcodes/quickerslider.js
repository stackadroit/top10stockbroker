import {BrokerComparison}  from '../../library/shortcodes';
import QuickerSlider from '../../components/quickerslider';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    // JavaScript to be fired on the home page
    setTimeout(function() {
      ReactDOM.render(
        <QuickerSlider />,
        document.getElementById('list-slider')
      );
    }, 3000);
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
