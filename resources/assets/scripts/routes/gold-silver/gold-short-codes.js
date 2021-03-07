import {GoldSilverSummary,GoldSilverPriceToday,GoldSilverLast15}  from '../../library/gold-silver/gold-short-codes';

export default {
  init() {
    
    if (typeof GoldSilverSummary !== 'undefined') {
      GoldSilverSummary.initialize();
    }
    if (typeof GoldSilverPriceToday !== 'undefined') {
      GoldSilverPriceToday.initialize();
    }
    if (typeof GoldSilverLast15 !== 'undefined') {
      GoldSilverLast15.initialize();
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};