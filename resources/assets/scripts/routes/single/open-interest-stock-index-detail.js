import {OpenInterestStockDetail}  from '../../library/single-open-interest-stock-index-detail';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    if (typeof OpenInterestStockDetail !== 'undefined') {
        OpenInterestStockDetail.initialize();
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


