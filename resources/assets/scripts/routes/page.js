import {BrokerComparison, GoldInvestmentCalculator, GoldRateComparison}  from '../library/shortcodes';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {

    if (typeof BrokerComparison !== 'undefined') {
      BrokerComparison.initialize();
    }

    if (typeof GoldInvestmentCalculator !== 'undefined') {
      GoldInvestmentCalculator.initialize();
    }
    
    if (typeof GoldRateComparison !== 'undefined') {
      GoldRateComparison.initialize();
    }
 
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
