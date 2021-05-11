import {SingleIndexPrediction}  from '../../library/single-index-prediction';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
export default {
  init() {
    if (typeof SingleIndexPrediction !== 'undefined') {
        SingleIndexPrediction.initialize();
    }
  },
  finalize() {
  },
};