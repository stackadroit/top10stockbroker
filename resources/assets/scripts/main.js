// import external dependencies
import 'jquery';

// import then needed Font Awesome functionality
import fontawesome from '@fortawesome/fontawesome-free';
import { library, dom  } from '@fortawesome/fontawesome-svg-core';

// import the base SVG icons
import { faAngleDown, faAngleUp, faAngleLeft, faAngleRight, faChevronDown, faPhone, faSearch, faBars, faTimes, faBell, faCaretDown, faCaretUp, faArrowDown, faArrowUp, faArrowRight, faQuestionCircle, faQuestion} from '@fortawesome/free-solid-svg-icons';

// import the Facebook and Twitter icons
import { faFacebookF, faTwitter, faYoutube, faLinkedin, faPinterest, faReddit, faWhatsapp, faTelegram, faTumblr, faMixcloud} from '@fortawesome/free-brands-svg-icons';

// Config FontAwsome
fontawesome.config = { searchPseudoElements: true, autoReplaceSvg: 'nest' };

// add the imported icons to the library
library.add(faCaretDown, faCaretUp, faArrowDown, faArrowUp, faArrowRight, faAngleDown, faAngleUp, faAngleLeft, faAngleRight, faChevronDown, faPhone, faFacebookF, faTwitter, faLinkedin, faPinterest, faReddit, faQuestionCircle, faWhatsapp, faTelegram, faTumblr, faMixcloud ,faYoutube, faSearch, faBars, faTimes, faBell);

// tell FontAwesome to watch the DOM and add the SVGs when it detects icon markup
dom.watch();

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import page from './routes/page';
import demo from './routes/demo';
// import shareMarketEducation from './routes/sharemarketeducation';
  
//Shortcodes calculator
import assetsToSalesRatioCalculator from './routes/shortcode-calculator/calculator01';
import assetsTurnoverRatioCalculator from './routes/shortcode-calculator/calculator02';
import averageCollectionPeriodCalculator from './routes/shortcode-calculator/calculator03';
import bidAskSpreadCalculator from './routes/shortcode-calculator/calculator04';
import bondEquivalentYieldCalculator from './routes/shortcode-calculator/calculator05';
import bookValuePerShareCalculator from './routes/shortcode-calculator/calculator06';
import capitalAssetPricingModelCalculator from './routes/shortcode-calculator/calculator07';
import capitalGainsYieldCalculator from './routes/shortcode-calculator/calculator08';
import compoundInterestCalculator from './routes/shortcode-calculator/calculator09';
import contributionMarginCalculator from './routes/shortcode-calculator/calculator10';
import currentRatioCalculator from './routes/shortcode-calculator/calculator11';
import currentYieldCalculator from './routes/shortcode-calculator/calculator12';
import daysInInventoryCalculator from './routes/shortcode-calculator/calculator13';
import debtCoverageRatioCalculator from './routes/shortcode-calculator/calculator14';
import debtEquityRatioCalculator from './routes/shortcode-calculator/calculator15';
import debtRatioCalculator from './routes/shortcode-calculator/calculator16';
import dilutedEpsCalculator from './routes/shortcode-calculator/calculator17';
import dividendPayoutRatioCalculator from './routes/shortcode-calculator/calculator18';
import dividendsPerShareCalculator from './routes/shortcode-calculator/calculator19';
import dividendYieldStockCalculator from './routes/shortcode-calculator/calculator20';
import earningsPerShareCalculator from './routes/shortcode-calculator/calculator21';
import equityMultiplierCalculator from './routes/shortcode-calculator/calculator22';
import estimatedEarningsCalculator from './routes/shortcode-calculator/calculator23';
import freeCashflowToEquityCalculator from './routes/shortcode-calculator/calculator24';
import freeCashflowToFirmCalculator from './routes/shortcode-calculator/calculator25';
import futureValueCalculator from './routes/shortcode-calculator/calculator26';
import futurevaluecalculator from './routes/shortcode-calculator/calculator26';
import geometricMeanReturnCalculator from './routes/shortcode-calculator/calculator27';
import grahmcalculator from './routes/shortcode-calculator/calculator28';
import grossProfitMarginCalculator from './routes/shortcode-calculator/calculator29';
import holdingPeriodReturnCalculator from './routes/shortcode-calculator/calculator30';
import rateOfInflationCalculator from './routes/shortcode-calculator/calculator31';
import interestCoverageRatioCalculator from './routes/shortcode-calculator/calculator32';
import inventoryTurnoverRatioCalculator from './routes/shortcode-calculator/calculator33';
import netProfitMarginCalculator from './routes/shortcode-calculator/calculator34';
import netWorkingCapitalCalculator from './routes/shortcode-calculator/calculator35';
import netAssetValueCalculator from './routes/shortcode-calculator/calculator36';
import onetimeinvestmentcalculator from './routes/shortcode-calculator/calculator37';
import operatingMarginCalculator from './routes/shortcode-calculator/calculator38';
import paybackPeriodCalculator from './routes/shortcode-calculator/calculator39';
import preferredStockCalculator from './routes/shortcode-calculator/calculator40';
import presentValueCalculator from './routes/shortcode-calculator/calculator37';
import priceEarningsRatioCalculator from './routes/shortcode-calculator/calculator41';
import priceToSalesRatioCalculator from './routes/shortcode-calculator/calculator42';
//import priceToBookValueCalculator from './routes/shortcode-calculator/calculator43';
import profitabilityIndexCalculator from './routes/shortcode-calculator/calculator44';
import pvWithZeroGrowthCalculator from './routes/shortcode-calculator/calculator45';
import pvWithConstantGrowthCalculator from './routes/shortcode-calculator/calculator46';
import quickRatioCalculator from './routes/shortcode-calculator/calculator47';
import realRateOfReturnCalculator from './routes/shortcode-calculator/calculator48';
import receivablesTurnoverRatioCalculator from './routes/shortcode-calculator/calculator49';
import retentionRatioCalculator from './routes/shortcode-calculator/calculator50';
import returnOnAssetsCalculator from './routes/shortcode-calculator/calculator51';
import returnOnEquityCalculator from './routes/shortcode-calculator/calculator52';
import roiCalculator from './routes/shortcode-calculator/calculator53';
import riskPremiumCalculator from './routes/shortcode-calculator/calculator54';
import simpleInterestCalculator from './routes/shortcode-calculator/calculator55';
//import sipcalculator from './routes/shortcode-calculator/calculator56';
//import targetcorpuscalculator from './routes/shortcode-calculator/calculator56';
import taxEquivalentYieldCalculator from './routes/shortcode-calculator/calculator57';
import totalStockReturnCalculator from './routes/shortcode-calculator/calculator58';
import yieldToMaturityCalculator from './routes/shortcode-calculator/calculator59';
import zeroCouponBondYieldCalculator from './routes/shortcode-calculator/calculator60';
import zeroCouponBondValueCalculator from './routes/shortcode-calculator/calculator61';

//Shortcodes
import quickerslider from './routes/shortcodes/quickerslider';
import GoldInvestmentCalculator from './routes/shortcodes/goldinvestmentcalculator';
// Gold Silver Graph js
import pageGoldRateData from './routes/shortcodes/gold-silver-price-graph';
// import pageChild from './routes/shortcodes/gold-silver-price-graph';
/**
 Js For Branches Single Page (CPT) Branche Template Page
*/
import singleBranches from './routes/shortcodes/broker_city_search';
/**
 Js For Single share Market (CPT) Share Market Template
*/
import templateShareMarket from './routes/templates/template-share-market';
import singleShareMarket from './routes/single/single-share-market';
/**
 Js For Single share price (CPT) Share Price Template
*/
import singleSharePrice from './routes/single/single-share-price';
import templateSharePrice from './routes/single/single-share-price';

/**
 Js For Single Futures (CPT) Futures Template
*/
import singleFutures from './routes/single/single-futures';
import templateFutures from './routes/single/single-futures';

/**
 Js For Single Option Chain (CPT) Option Chain Template
*/
import singleOptionChain from './routes/single/single-option-chain';
import templateOptionChain from './routes/single/single-option-chain';
import singleBrokerComparison from './routes/brokerage/broker-comparison';
import singleBrokerageCalculator from './routes/brokerage/brokerage-calculator';
import singleMarginCalculator from './routes/brokerage/margin-calculator';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // Pages 
  page,
  demo,
  
   // Shotcodes branch
  singleBranches,
  /**
   Js For Single share Market (CPT) Share Market Template
  */
  templateShareMarket,
  singleShareMarket,
  /**
   Js For Single share Price (CPT) Share Price Template
  */
  singleSharePrice,
  templateSharePrice,
  /**
   Js For Single Futures (CPT) Futures Template
  */
  singleFutures,
  templateFutures,
  /**
   Js For Single Option Chain (CPT) Option Chain Template
  */
  singleOptionChain,
  templateOptionChain,
  /**
   Include Broker Comparison js function
  */
  singleBrokerComparison,
  /**
   Include Broker calculator js function
  */
  singleBrokerageCalculator,
  /**
   Include Margin calculator js function
  */
  singleMarginCalculator,
  // shareMarketEducation,
  // Shotcodes Calculator
  assetsToSalesRatioCalculator,
  assetsTurnoverRatioCalculator,
  averageCollectionPeriodCalculator,
  bidAskSpreadCalculator,
  bondEquivalentYieldCalculator,
  bookValuePerShareCalculator,
  capitalAssetPricingModelCalculator,
  capitalGainsYieldCalculator,
  compoundInterestCalculator,
  contributionMarginCalculator,
  currentRatioCalculator,
  currentYieldCalculator,
  daysInInventoryCalculator,
  debtCoverageRatioCalculator,
  debtEquityRatioCalculator,
  debtRatioCalculator,
  dilutedEpsCalculator,
  dividendPayoutRatioCalculator,
  dividendsPerShareCalculator,
  dividendYieldStockCalculator,
  earningsPerShareCalculator,
  equityMultiplierCalculator,
  estimatedEarningsCalculator,
  freeCashflowToEquityCalculator,
  freeCashflowToFirmCalculator,
  futureValueCalculator,
  futurevaluecalculator,
  geometricMeanReturnCalculator,
  grahmcalculator,
  grossProfitMarginCalculator,
  holdingPeriodReturnCalculator,
  rateOfInflationCalculator,
  interestCoverageRatioCalculator,
  inventoryTurnoverRatioCalculator,
  netProfitMarginCalculator,
  netWorkingCapitalCalculator,
  netAssetValueCalculator,
  operatingMarginCalculator,
  paybackPeriodCalculator,
  preferredStockCalculator,
  presentValueCalculator,
  priceEarningsRatioCalculator,
  priceToSalesRatioCalculator,
  profitabilityIndexCalculator,
  pvWithZeroGrowthCalculator,
  pvWithConstantGrowthCalculator,
  quickRatioCalculator,
  realRateOfReturnCalculator,
  receivablesTurnoverRatioCalculator,
  retentionRatioCalculator,
  returnOnAssetsCalculator,
  returnOnEquityCalculator,
  roiCalculator,
  riskPremiumCalculator,
  simpleInterestCalculator,
  taxEquivalentYieldCalculator,
  totalStockReturnCalculator,
  yieldToMaturityCalculator,
  zeroCouponBondYieldCalculator,
  zeroCouponBondValueCalculator,
  //shortcodes
  quickerslider,
  GoldInvestmentCalculator,
  // Gold Rate Graph js include
  pageGoldRateData,
  // pageChild,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());






