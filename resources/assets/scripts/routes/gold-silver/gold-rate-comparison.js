import {GoldRateComparison}  from '../../library/gold-silver/gold-rate-comparison';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    if (typeof GoldRateComparison !== 'undefined') {
      GoldRateComparison.initialize();
    }
 
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
