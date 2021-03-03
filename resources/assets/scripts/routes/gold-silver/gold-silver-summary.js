import {GoldSilverSummary}  from '../../library/gold-silver/gold-silver-summary';

export default {
  init() {
    
    if (typeof GoldSilverSummary !== 'undefined') {
      GoldSilverSummary.initialize();
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
