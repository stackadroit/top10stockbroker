import {TemplateOptionChain}  from '../../library/template-option-chain';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    if (typeof TemplateOptionChain !== 'undefined') {
        TemplateOptionChain.initialize();
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};


