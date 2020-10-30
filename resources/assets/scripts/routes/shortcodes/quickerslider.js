import {BrokerComparison}  from '../../library/shortcodes';
import QuickerSlider from '../../components/quickerslider';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    // JavaScript to be fired on the home page
    ReactDOM.render(
      <QuickerSlider />,
      document.getElementById('list-slider')
    );
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
