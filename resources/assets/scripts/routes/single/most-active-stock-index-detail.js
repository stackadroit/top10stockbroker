import {MostActiveStockIndexDetail}  from '../../library/single-most-active-stock-index-detail';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
export default {
  init() {
    if (typeof MostActiveStockIndexDetail !== 'undefined') {
        MostActiveStockIndexDetail.initialize();
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


