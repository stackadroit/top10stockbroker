import {EasyTab}  from '../library/global';
import {ShareMarketEducation} from '../library/share-market-education';
export default {
  init() {
    // Commom Plugins
	(function($) {
		//for mobile version for lazy loading
		if (typeof ShareMarketEducation !== 'undefined') {
			ShareMarketEducation.initialize();
		}
		if (typeof EasyTab !== 'undefined') {
			EasyTab.initialize();
		}
	}).apply(this, [jQuery]);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
