import {GoldInvestmentCalculator}  from '../../library/shortcodes';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    var process = true;
    if ($( "body.mobile" ).length) {
        $([window, document]).on('click', function(){
          if (process) {
            process = false;
            if (typeof GoldInvestmentCalculator !== 'undefined') {
              GoldInvestmentCalculator.initialize();
            }
          }
        });
    }else{
      if (process) {
        process = false;
          if (typeof GoldInvestmentCalculator !== 'undefined') {
              GoldInvestmentCalculator.initialize();
         }
      }
    }
 
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
