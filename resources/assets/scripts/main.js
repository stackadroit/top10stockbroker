// import external dependencies
import 'jquery';

// import then needed Font Awesome functionality
import fontawesome from '@fortawesome/fontawesome-free';
import { library, dom  } from '@fortawesome/fontawesome-svg-core';

// import the base SVG icons
import { faAngleDown, faAngleUp, faAngleRight, faChevronDown, faPhone, faSearch} from '@fortawesome/free-solid-svg-icons';

// import the Facebook and Twitter icons
import { faFacebookF, faTwitter, faYoutube} from '@fortawesome/free-brands-svg-icons';

// Config FontAwsome
fontawesome.config = { searchPseudoElements: true, autoReplaceSvg: 'nest' };

// add the imported icons to the library
library.add(faAngleDown, faAngleUp, faAngleRight, faChevronDown, faPhone, faFacebookF, faTwitter, faSearch);

// tell FontAwesome to watch the DOM and add the SVGs when it detects icon markup
dom.watch();

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
