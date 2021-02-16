import {PutCallRatio}  from '../../library/single-put-call-ratio';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    if (typeof PutCallRatio !== 'undefined') {
        PutCallRatio.initialize();
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


