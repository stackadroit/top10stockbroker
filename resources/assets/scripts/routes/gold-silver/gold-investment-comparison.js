import {GoldInvestmentComparison}  from '../../library/gold-silver/gold-investment-comparison';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

export default {
  init() {
    var process = true;
    if ($( "body.mobile" ).length) {
        $([window, document]).on('click', function(){
          if (process) {
            process = false;
            if (typeof GoldInvestmentComparison !== 'undefined') {
              GoldInvestmentComparison.initialize();
            }
          }
        });
    }else{
      if (process) {
          process = false;
          if (typeof GoldInvestmentComparison !== 'undefined') {
              GoldInvestmentComparison.initialize();
         }
      }
    }
 
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
