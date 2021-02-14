import {OpenInterestStockFutures}  from '../../library/single-open-interest-stock-futures';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
export default {
  init() {
    if (typeof OpenInterestStockFutures !== 'undefined') {
        OpenInterestStockFutures.initialize();
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


