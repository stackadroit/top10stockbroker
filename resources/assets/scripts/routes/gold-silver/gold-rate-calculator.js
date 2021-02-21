import {GoldSilverRateCalculator}  from '../../library/gold-silver/gold-silver-rate-calculator';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    if (typeof GoldSilverRateCalculator !== 'undefined') {
      GoldSilverRateCalculator.initialize();
    }
 
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
