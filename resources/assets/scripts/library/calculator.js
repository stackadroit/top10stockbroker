//assets to sales ratio calculator
(function($) {

	var initialized = false;

	var assetsToSalesRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#srr_id, #tars_id');
					$nodeEventRoot
	                .on( 'keyup', function(event) {
			            var tars = Number($('#tars_id').val());
					    var srr= Number($('#srr_id').val());
					    var atsr1 = (tars/srr).toFixed(2);
					    Number($('#asr_id').val(atsr1));
			        });

				return this;
			},

		};
	exports.assetsToSalesRatioCalculator = assetsToSalesRatioCalculator;

}).apply(this, [jQuery]);

//assets tuenover ratio calculator
(function($) {

	var initialized = false;

	var assetsTuenoverRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#tab_id, #tae_id, #sr2_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
			            var tab_id = Number($('#tab_id').val());
					    var tae_id = Number($('#tae_id').val());
					    var sr2_id = Number($('#sr2_id').val());

					    var ats = (sr2_id/((tab_id + tae_id)/2)).toFixed(2); 
					    
					    Number($('#atr1_id').val(ats));	
			        });

				return this;
			},

		};
	exports.assetsTuenoverRatioCalculator = assetsTuenoverRatioCalculator;

}).apply(this, [jQuery]);

//average collection period1 calculator
(function($) {

	var initialized = false;

	var averageCollectionPeriodCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#sr3_id, #aar_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var sr3 = Number($('#sr3_id').val());
					    var aar = Number($('#aar_id').val());

					    var acp = (365*(aar/sr3)).toFixed(2); 
					    
					    Number($('#acpd_id').val(acp));
			        });

				return this;
			},

		};
	exports.averageCollectionPeriodCalculator = averageCollectionPeriodCalculator;

}).apply(this, [jQuery]);

//bid ask spread calculator
(function($) {

	var initialized = false;

	var bidAskSpreadCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ask_prc_id, #bid_prc_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ask_prc = Number($('#ask_prc_id').val());
					    var bid_prc = Number($('#bid_prc_id').val());

					    var bid_ask = (ask_prc - bid_prc).toFixed(2);

					    Number($('#bid_ask_id').val(bid_ask));
			        });

				return this;
			},

		};
	exports.bidAskSpreadCalculator = bidAskSpreadCalculator;

}).apply(this, [jQuery]);

//bond equivalent yield calculator
(function($) {

	var initialized = false;

	var bondEquivalentYieldCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#face_val_id, #bond_prc_id, #maturity_prd_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var face_val = Number($('#face_val_id').val());
					    var bond_prc = Number($('#bond_prc_id').val());
					    var to_maturity_prd = Number( $('#maturity_prd_id').val());

					    var tg = (face_val - bond_prc).toFixed(2);

					    var bey =  Math.abs(((((face_val - bond_prc) / bond_prc) * (365 / to_maturity_prd)) * 100)).toFixed(2);

					    Number($('#tg_id').val(tg));
					    Number($('#bey_id').val(bey));
			        });

				return this;
			},

		};
	exports.bondEquivalentYieldCalculator = bondEquivalentYieldCalculator;

}).apply(this, [jQuery]);

//book value per share calculator
(function($) {

	var initialized = false;

	var bookValuePerShareCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#shareholder_equity_id, #prefer_equity_id, #to_share_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var shareholder_equity = Number($('#shareholder_equity_id').val());
					    var prefer_equity = Number($('#prefer_equity_id').val());
					    var to_share = Number($('#to_share_id').val());

					    var bvps = ((shareholder_equity - prefer_equity) / to_share).toFixed(2);

					    Number($('#bvps_id').val(bvps));
			        });

				return this;
			},

		};
	exports.bookValuePerShareCalculator = bookValuePerShareCalculator;

}).apply(this, [jQuery]);

//capital asset price modal calculator
(function($) {

	var initialized = false;

	var capitalAssetPriceModalCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#risk_free_id, #beta_id, #return_mkt_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var risk_free = Number($('#risk_free_id').val());
					    var beta = Number($('#beta_id').val());
					    var return_mkt = Number($('#return_mkt_id').val());

					    var er = ((risk_free + beta * (return_mkt - risk_free))).toFixed(2);

					    Number($('#er_id').val(er));
			        });

				return this;
			},

		};
	exports.capitalAssetPriceModalCalculator = capitalAssetPriceModalCalculator;

}).apply(this, [jQuery]);

//capital gain yield calculator
(function($) {

	var initialized = false;

	var capitalGainYieldCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#initial_stock_id, #end_stock_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var initial_stock = Number($('#initial_stock_id').val());
					    var end_stock = Number($('#end_stock_id').val());

					    var cgy = (((end_stock - initial_stock) / initial_stock) * 100).toFixed(2);

					    Number($('#cgy_id').val(cgy));
			        });

				return this;
			},

		};
	exports.capitalGainYieldCalculator = capitalGainYieldCalculator;

}).apply(this, [jQuery]);

//compound interest calculator
(function($) {

	var initialized = false;

	var compoundInterestCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#principal_id, #rate_id, #prd_id');
	                $nodeEventRoot
	                .on( 'keyup', function(event) {	
	                	var principal = Number($('#principal_id').val());
					    var rate = Number($('#rate_id').val());
					    var prd = Number($('#prd_id').val());
					    final_rate = 1 + rate/100;

					    var compound_interest = (principal * ((Math.pow(final_rate, prd)) - 1)).toFixed(2);
					    var new_principal = (principal * (Math.pow(final_rate, prd))).toFixed(2);

					    Number($('#compound_interest_id').val(compound_interest));
					    Number($('#new_principal_id').val(new_principal));
			        });

				return this;
			},

		};
	exports.compoundInterestCalculator = compoundInterestCalculator;

}).apply(this, [jQuery]);

//contribution margin calculator
(function($) {

	var initialized = false;

	var contributionMarginCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#sr2_id, #vc_id, #nous_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var sr2 = Number($('#sr2_id').val());
					    var vc = Number($('#vc_id').val());
					    var nous = Number($('#nous_id').val())
						
					    var spu1 = (sr2/nous).toFixed(2);
						var vc1 = (vc/nous).toFixed(2);
						var cm1 = (spu1-vc1).toFixed(2);

					    $('#spu_id').val(spu1);
						$('#vcp_id').val(vc1);
						$('#cm_id').val(cm1);
			        });

				return this;
			},

		};
	exports.contributionMarginCalculator = contributionMarginCalculator;

}).apply(this, [jQuery]);

//current ratio calculator
(function($) {

	var initialized = false;

	var currentRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ca1_id, #cl1_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ca1 = Number($('#ca1_id').val());
					    var cl1 = Number($('#cl1_id').val());

					     var cr1 = (ca1 / cl1).toFixed(2);

					    $('#cr_id').val(cr1);
			        });

				return this;
			},

		};
	exports.currentRatioCalculator = currentRatioCalculator;

}).apply(this, [jQuery]);

//current ratio calculator
(function($) {

	var initialized = false;

	var currentRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ca1_id, #cl1_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ca1 = Number($('#ca1_id').val());
					    var cl1 = Number($('#cl1_id').val());

					     var cr1 = (ca1 / cl1).toFixed(2);

					    $('#cr_id').val(cr1);
			        });

				return this;
			},

		};
	exports.currentRatioCalculator = currentRatioCalculator;

}).apply(this, [jQuery]);

//current yield calculator
(function($) {

	var initialized = false;

	var currentYieldCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#coupon_id, #bond_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var coupon = Number($('#coupon_id').val());
					    var bond = Number($('#bond_id').val());

					    var cy = ((coupon / bond) * 100).toFixed(2);

					    Number($('#cy_id').val(cy));
			        });

				return this;
			},

		};
	exports.currentYieldCalculator = currentYieldCalculator;

}).apply(this, [jQuery]);

//days in inventory calculator
(function($) {

	var initialized = false;

	var daysInInventoryCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#al1_id, #cogs_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ca1 = Number($('#al1_id').val());
					    var cl1 = Number($('#cogs_id').val());

					     var cr1 = (365 * (ca1 / cl1)).toFixed(2);

					    $('#dil_id').val(cr1);
			        });

				return this;
			},

		};
	exports.daysInInventoryCalculator = daysInInventoryCalculator;

}).apply(this, [jQuery]);

//debt coverage ratio calculator
(function($) {

	var initialized = false;

	var debtCoverageRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#noi_id, #td_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var noi = Number($('#noi_id').val());
					    var td = Number($('#td_id').val());

					     var dcr = (noi / td).toFixed(2);

					    $('#dcr1_id').val(dcr);
			        });

				return this;
			},

		};
	exports.debtCoverageRatioCalculator = debtCoverageRatioCalculator;

}).apply(this, [jQuery]);

//debt to equity ratio calculator
(function($) {

	var initialized = false;

	var debtToEquityRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#tl1_id, #se1_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var tl1 = Number($('#tl1_id').val());
					    var se1 = Number($('#se1_id').val());

					    var dter = (tl1 / se1).toFixed(2);

					    $('#dcr_id').val(dter);
			        });

				return this;
			},

		};
	exports.debtToEquityRatioCalculator = debtToEquityRatioCalculator;

}).apply(this, [jQuery]);

//debt ratio calculator
(function($) {

	var initialized = false;

	var debtRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#tlu1_id, #ta1_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var tl1 = Number($('#tlu1_id').val());
					    var se1 = Number($('#ta1_id').val());

					    var dter = (tl1 / se1).toFixed(2);

					    $('#dr_id').val(dter);
			        });

				return this;
			},

		};
	exports.debtRatioCalculator = debtRatioCalculator;

}).apply(this, [jQuery]);

//diluted earnings per share calculator
(function($) {

	var initialized = false;

	var dilutedEarningsPerShareCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#div_stock_id, #net_income_id, #ot_share_id, #dilute_share_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var div_stock = Number($('#div_stock_id').val());
					    var net_income = Number($('#net_income_id').val());
					    var ot_share = Number($('#ot_share_id').val());
					    var dilute_share = Number($('#dilute_share_id').val());
					    
					    var deps = ((net_income - div_stock) / (ot_share + dilute_share)).toFixed(2);

					    Number($('#deps_id').val(deps));
			        });

				return this;
			},

		};
	exports.dilutedEarningsPerShareCalculator = dilutedEarningsPerShareCalculator;

}).apply(this, [jQuery]);

//dividend payout ratio calculator 
(function($) {

	var initialized = false;

	var dividendPayoutRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#dividend_id, #net_income_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var dividend = Number($('#dividend_id').val());
					    var net_income = Number($('#net_income_id').val());
					    
					    var dpr = (dividend * 100 / net_income).toFixed(2);

					    Number($('#dpr_id').val(dpr));
			        });

				return this;
			},

		};
	exports.dividendPayoutRatioCalculator = dividendPayoutRatioCalculator;

}).apply(this, [jQuery]);

// dividend per share calculator
(function($) {

	var initialized = false;

	var dividendPerShareCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#sum_dividend_id, #onetime_div_id, #nos_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var sum_dividend = Number($('#sum_dividend_id').val());
					    var onetime_div = Number($('#onetime_div_id').val());
					    var nos = Number($('#nos_id').val());

					    var dps = ((sum_dividend - onetime_div) / nos).toFixed(2);

					    Number($('#dps_id').val(dps));
			        });

				return this;
			},

		};
	exports.dividendPerShareCalculator = dividendPerShareCalculator;

}).apply(this, [jQuery]);

// dividend yield share calculator
(function($) {

	var initialized = false;

	var dividendYieldShareCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#dividend_id, #share_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var dividend = Number($('#dividend_id').val());
					    var share = Number($('#share_id').val());
					    
					    var dy = (dividend * 100 / share).toFixed(2);

					    Number($('#dy_id').val(dy));
			        });

				return this;
			},

		};
	exports.dividendYieldShareCalculator = dividendYieldShareCalculator;

}).apply(this, [jQuery]);

//earnings per share calculator
(function($) {

	var initialized = false;

	var earningsPerShareCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#net_income_id, #preferred_div_id, #waos_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var net_income = Number($('#net_income_id').val());
					    var preferred_div = Number($('#preferred_div_id').val());
					    var waos = Number($('#waos_id').val());

					    var eps = ((net_income - preferred_div) / waos).toFixed(2);

					    Number($('#eps_id').val(eps));
			        });

				return this;
			},

		};
	exports.earningsPerShareCalculator = earningsPerShareCalculator;

}).apply(this, [jQuery]);

//equity multiplier calculator
(function($) {

	var initialized = false;

	var equityMultiplierCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ta_id, #she_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ta = Number($('#ta_id').val());
					    var she = Number($('#she_id').val());

					    var em = (ta / she).toFixed(2);

					    Number($('#em_id').val(em));
			        });

				return this;
			},

		};
	exports.equityMultiplierCalculator = equityMultiplierCalculator;

}).apply(this, [jQuery]);

//estimated earnings calculator
(function($) {

	var initialized = false;

	var estimatedEarningsCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#e_sales_id, #e_exp_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var e_sales = Number($('#e_sales_id').val());
					    var e_exp = Number($('#e_exp_id').val());

					    var e_earn = (e_sales - e_exp).toFixed(2);

					    Number($('#e_earn_id').val(e_earn));
			        });

				return this;
			},

		};
	exports.estimatedEarningsCalculator = estimatedEarningsCalculator;

}).apply(this, [jQuery]);

//free cashflow to equity ratio calculator
(function($) {

	var initialized = false;

	var freeCashflowToEquityRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ni_id, #da1_id, #wc_id, #ce1_id, #nb_id ');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ni = Number($('#ni_id').val());
					    var da1 = Number($('#da1_id').val());
					    var wc = Number($('#wc_id').val());
					    var ce1 = Number($('#ce1_id').val());
						var nb = Number($('#nb_id').val());
						
					     var fc = (ni+da1-wc-ce1+nb).toFixed(2);

					    $('#fcte_id').val(fc);
			        });

				return this;
			},

		};
	exports.freeCashflowToEquityRatioCalculator = freeCashflowToEquityRatioCalculator;

}).apply(this, [jQuery]);

//free cashflow to firm calculator
(function($) {

	var initialized = false;

	var freeCashflowToFirmCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#eb_id, #tr2_id, #da2_id, #cw_id, #cex_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var eb = Number($('#eb_id').val());
					    var tr2 = Number($('#tr2_id').val());
					    var da2= Number($('#da2_id').val());
					    var cw = Number($('#cw_id').val());
						var cex = Number($('#cex_id').val());
						
					    var fcf = ((eb * (1 - tr2 / 100) ) + da2 - cw - cex).toFixed(2);

					    $('#fc_id').val(fcf);
			        });

				return this;
			},

		};
	exports.freeCashflowToFirmCalculator = freeCashflowToFirmCalculator;

}).apply(this, [jQuery]);

//calculateFV
(function($) {

	var initialized = false;

	var calculateFV = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#m_amount_id1, #rate_id1, #time_id1');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var p = $('#m_amount_id1').val();
					    var r = $('#rate_id1').val();
					    var t = $('#time_id1').val();

					    var final_r = 1+r/100;

					    var total_r = final_r;

					    for(var i=1; i<t; i++)
					    {
					        total_r *= final_r;
					    }
					    var final_fv = (p * total_r).toFixed(4);

					    $('#result_id1').val(final_fv);
			        });

				return this;
			},

		};
	exports.calculateFV = calculateFV;

}).apply(this, [jQuery]);

// geometric mean return calculator
(function($) {

	var initialized = false;

	var geometricMeanReturnCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#m_amount_id1, #rate_id1, #time_id1');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var p = $('#m_amount_id1').val();
					    var r = $('#rate_id1').val();
					    var t = $('#time_id1').val();

					    var final_r = 1+r/100;

					    var total_r = final_r;

					    for(var i=1; i<t; i++)
					    {
					        total_r *= final_r;
					    }
					    var final_fv = (p * total_r).toFixed(4);

					    $('#result_id1').val(final_fv);
			        });

				return this;
			},

		};
	exports.geometricMeanReturnCalculator = geometricMeanReturnCalculator;

}).apply(this, [jQuery]);

// 
(function($) {

	var initialized = false;

	var grahamCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#crnt_share_price_id, #eps_id, #g_id, #bond1962_id, #y_id, #pe_id, #grm_id ');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var crnt_share_price = Number($('#crnt_share_price_id').val());
					    var eps = Number($('#eps_id').val());
					    
					    var g = Number($('#g_id').val());
					    
					    var bond1962 = Number($('#bond1962_id').val());
					    
					    var y = Number($('#y_id').val());
					    
					    var pe = Number($('#pe_id').val());
					    
					    var grm = Number($('#grm_id').val());

					    var intrinsic_share_price = (eps * (pe + grm * g) * (bond1962 / y)).toFixed(1);

					    $('#intrinsic_share_price_id').val(intrinsic_share_price);
					    var overvalue = crnt_share_price - intrinsic_share_price;
					    var overvalue_per = (overvalue * 100 / intrinsic_share_price).toFixed(1);

					    $('#overvalued_id').val(overvalue_per);
			        });

				return this;
			},

		};
	exports.grahamCalculator = grahamCalculator;

}).apply(this, [jQuery]);

// gross profit margin calculator
(function($) {

	var initialized = false;

	var grossProfitMarginCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#sr4_id, #cog_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var sr4 = Number($('#sr4_id').val());
					    var cog = Number($('#cog_id').val());

					     var gpm = ((sr4-cog) * 100 / sr4).toFixed(2);

					    $('#gp_id').val(gpm);
			        });

				return this;
			},

		};
	exports.grossProfitMarginCalculator = grossProfitMarginCalculator;

}).apply(this, [jQuery]);

// holding period return calculator
(function($) {

	var initialized = false;

	var holdingPeriodReturnCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ror1_id, #ror2_id, #ror3_id, #ror4_id, #ror5_id, #ror6_id, #ror7_id, #period_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var amount = 1;
					    var n = Number($('#period_id').val());

					    var x = document.getElementsByName("ror[]");
					    for(i = 0; i < x.length; i++)
					    {
					        val = Number(x[i].value);
					        if(val)
					        {
					            amount = amount * (1+(val/100))
					        }
					    }
					    //var power_val = 1/n;
					    gmr = ((amount - 1)*100).toFixed(2);

					    Number($('#hpr_id').val(gmr));
			        });

				return this;
			},

		};
	exports.holdingPeriodReturnCalculator = holdingPeriodReturnCalculator;

}).apply(this, [jQuery]);

//inflation rate calculator
(function($) {

	var initialized = false;

	var inflationRateCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#icpi_id, #ecpi_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var icpi_id = Number($('#icpi_id').val());
					    var ecpi_id = Number($('#ecpi_id').val());

					    
					    gmr = (((ecpi_id - icpi_id) / icpi_id) * 100).toFixed(2);

					    Number($('#ir_id').val(gmr));
			        });

				return this;
			},

		};
	exports.inflationRateCalculator = inflationRateCalculator;

}).apply(this, [jQuery]);

//interest coverage ratio calculator
(function($) {

	var initialized = false;

	var interestCoverageRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#eb_id, #eb_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var eb = Number($('#eb_id').val());
					    var ie = Number($('#eb_id').val());

					     var icr2 = (eb/ie).toFixed(2);

					    $('#icr1_id').val(icr2);
			        });

				return this;
			},

		};
	exports.interestCoverageRatioCalculator = interestCoverageRatioCalculator;

}).apply(this, [jQuery]);

//inventory turnover ratio calculator
(function($) {

	var initialized = false;

	var inventoryTurnoverRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#cgs_id, #ai_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var cgs = Number($('#cgs_id').val());
					    var ai = Number($('#ai_id').val());
					    

					    var itr = (cgs/ai).toFixed(2);
					    var di1 = (365/(cgs/ai)).toFixed(2);
						
						
					    Number($('#itr_id').val(itr));
						Number($('#dis_id').val(di1)); 
			        });

				return this;
			},

		};
	exports.inventoryTurnoverRatioCalculator = inventoryTurnoverRatioCalculator;

}).apply(this, [jQuery]);

// net profit margin calculator
(function($) {

	var initialized = false;

	var netProfitMarginCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#cgs_id, #ai_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ni1 = Number($('#ni1_id').val());
					    var srrs = Number($('#srrs_id').val());

					    var npm = (ni1 * 100/srrs).toFixed(2);
						
					    $('#np_id').val(npm); 
			        });

				return this;
			},

		};
	exports.netProfitMarginCalculator = netProfitMarginCalculator;

}).apply(this, [jQuery]);

//net working capital calculator
(function($) {

	var initialized = false;

	var netWorkingCapitalCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ca2_id, #cl2_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ca2 = Number($('#ca2_id').val());
					    var cl2 = Number($('#cl2_id').val());

					    var nwc = (ca2-cl2).toFixed(2);

					    Number($('#nwc_id').val(nwc));
			        });

				return this;
			},

		};
	exports.netWorkingCapitalCalculator = netWorkingCapitalCalculator;

}).apply(this, [jQuery]);

// net asset value calculator
(function($) {

	var initialized = false;

	var netAssetValueCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#fund_assets_id, #fund_liabl_id, #ot_share_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var fund_assets = Number($('#fund_assets_id').val());
					    var fund_liabl = Number($('#fund_liabl_id').val());
					    var ot_share = Number($('#ot_share_id').val());

					    var nav = ((fund_assets - fund_liabl) / ot_share).toFixed(2);

					    Number($('#nav_id').val(nav));
			        });

				return this;
			},

		};
	exports.netAssetValueCalculator = netAssetValueCalculator;

}).apply(this, [jQuery]);

//calculatePV
(function($) {

	var initialized = false;

	var calculatePV = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#m_amount_id2, #rate_id2, #time_id2');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var p = $('#m_amount_id2').val();
					    var r = $('#rate_id2').val();
					    var t = $('#time_id2').val();

					    var final_r = 1+r/100;
					    
					    var total_r = final_r;

					    for(var i=1; i<t; i++)
					    {
					        total_r *= final_r;
					    }

					    var final_pv =( p / total_r).toFixed(2);

					    $('#result_id2').val(final_pv);
			        });

				return this;
			},

		};
	exports.calculatePV = calculatePV;

}).apply(this, [jQuery]);

//operating margin calculator
(function($) {

	var initialized = false;

	var operatingMarginCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#oi_id, #sr5_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var oi = Number($('#oi_id').val());
					    var sr5 = Number($('#sr5_id').val());

					    var om = (oi * 100 /sr5).toFixed(2);
						
					    Number($('#om_id').val(om));
			        });

				return this;
			},

		};
	exports.operatingMarginCalculator = operatingMarginCalculator;

}).apply(this, [jQuery]);

//payback period calculator
(function($) {

	var initialized = false;

	var paybackPeriodCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ii_id, #pof_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ii = Number($('#ii_id').val());
					    var pof = Number($('#pof_id').val());

					     var pp = (ii / pof).toFixed(2);

					    $('#pp1_id').val(pp);
			        });

				return this;
			},

		};
	exports.paybackPeriodCalculator = paybackPeriodCalculator;

}).apply(this, [jQuery]);

// preferred stock value calculator
(function($) {

	var initialized = false;

	var preferredStockValueCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#d_per_stk_id, #ror_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var d_per_stk = Number($('#d_per_stk_id').val());
					    var ror = Number($('#ror_id').val());

					    var psv = (d_per_stk / (ror / 100)).toFixed(2);

					    Number($('#psv_id').val(psv));
			        });

				return this;
			},

		};
	exports.preferredStockValueCalculator = preferredStockValueCalculator;

}).apply(this, [jQuery]);

//price to earnings calculator
(function($) {

	var initialized = false;

	var priceToEarningsCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#pps_id, #eps_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var pps = Number($('#pps_id').val());
					    var eps = Number($('#eps_id').val());

					    var pe  = (pps/eps).toFixed(2);

					    Number($('#pe_id').val(pe));
			        });

				return this;
			},

		};
	exports.priceToEarningsCalculator = priceToEarningsCalculator;

}).apply(this, [jQuery]);

//price to sales calculator
(function($) {

	var initialized = false;

	var priceToSalesCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#pps_id, #sps_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var pps = Number($('#pps_id').val());
					    var sps = Number($('#sps_id').val());

					    var ps  = (pps/sps).toFixed(2);

					    Number($('#ps_id').val(ps));
			        });

				return this;
			},

		};
	exports.priceToSalesCalculator = priceToSalesCalculator;

}).apply(this, [jQuery]);

//profitability index calculator
(function($) {

	var initialized = false;

	var profitabilityIndexCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#fo1_id, #iit_id, #dr_id, #tp_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var p = Number($('#fo1_id').val());
					    var iit = Number($('#iit_id').val());
					    var r = Number($('#dr_id').val());
					    var t = Number($('#tp_id').val());

					    var final_r = 1+r/100;
					    
					    var total_r = final_r;
					    var p1 = 0;

					    for(var i=2; i<=t; i++)
					    {
					        var get_p = Math.pow(final_r, i);
					        var get_p1 = Number(p/get_p);
					        p1 += get_p1;
					    }

					    var final_pv = p + p1;
					    var pi = ( (final_pv * 100 / iit) / 100 ).toFixed(6);;

					    $('#pi1_id').val(pi);
			        });

				return this;
			},

		};
	exports.profitabilityIndexCalculator = profitabilityIndexCalculator;

}).apply(this, [jQuery]);

//stock pv with zero growth calculator
(function($) {

	var initialized = false;

	var stockPvWithZeroGrowthCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#edf_id, #rate_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var edf = Number($('#edf_id').val());
					    var rrf = Number($('#rate_id').val());
					    
					    var pvsz = (edf  / (rrf / 100)).toFixed(2);
					    var pvf = (pvsz/edf ).toFixed(2); 

					    Number($('#pszg_id').val(pvsz));
					    Number($('#psp_id').val(pvf));
			        });

				return this;
			},

		};
	exports.stockPvWithZeroGrowthCalculator = stockPvWithZeroGrowthCalculator;

}).apply(this, [jQuery]);

//stock pv with constant growth calculator
(function($) {

	var initialized = false;

	var stockPvWithConstantGrowthCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#edfnp_id, #rrfr_id, #gr1_id ');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var edfnp = Number($('#edfnp_id').val());
					    var rrfr = Number($('#rrfr_id').val());
					    var gr1 = Number($('#gr1_id').val());

					    var pvfs  = (edfnp * 100 /(rrfr-gr1)).toFixed(2);
					    var pos = ((pvfs/edfnp)).toFixed(2); 

					    Number($('#pvosc_id').val(pvfs));
					    Number($('#pvspr_id').val(pos));
			        });

				return this;
			},

		};
	exports.stockPvWithConstantGrowthCalculator = stockPvWithConstantGrowthCalculator;

}).apply(this, [jQuery]);

// quick ratio calculator
(function($) {

	var initialized = false;

	var quickRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ca_id, #i_id, #cl_id ');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ca = Number($('#ca_id').val());
					    var i = Number($('#i_id').val());
					    var cl = Number($('#cl_id').val());
						 
						 
					     var qr1 = ((ca-i)/cl).toFixed(2);

					    $('#qr_id').val(qr1);
			        });

				return this;
			},

		};
	exports.quickRatioCalculator = quickRatioCalculator;

}).apply(this, [jQuery]);

// real rate of return calculator
(function($) {

	var initialized = false;

	var realRateOfReturnCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#nr_id, #ir_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var icpi_id = Number($('#nr_id').val());
					    var ecpi_id = Number($('#ir_id').val());

					    gmr = (((1 + icpi_id/100) / (1 + ecpi_id/100) - 1) * 100).toFixed(2);

					    Number($('#rrr_id').val(gmr));
			        });

				return this;
			},

		};
	exports.realRateOfReturnCalculator = realRateOfReturnCalculator;

}).apply(this, [jQuery]);

// receivables turnover ratio calculator
(function($) {

	var initialized = false;

	var receivablesTurnoverRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#sr_id, #aar_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var sr = Number($('#sr_id').val());
					    var aar = Number($('#aar_id').val());

					    var rtr1 = (sr/aar).toFixed(2);

					    Number($('#rtr_id').val(rtr1));
			        });

				return this;
			},

		};
	exports.receivablesTurnoverRatioCalculator = receivablesTurnoverRatioCalculator;

}).apply(this, [jQuery]);

// retention ratio calculator
(function($) {

	var initialized = false;

	var retentionRatioCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ni_id, #d_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ni = Number($('#ni_id').val());
					    var d = Number($('#d_id').val());

					    var rr1 = ((ni-d) * 100 / ni).toFixed(2);

					    Number($('#rr_id').val(rr1));
			        });

				return this;
			},

		};
	exports.retentionRatioCalculator = retentionRatioCalculator;

}).apply(this, [jQuery]);

// return on assets calculator
(function($) {

	var initialized = false;

	var returnOnAssetsCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ni2_id, #ta_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ni2 = Number($('#ni2_id').val());
					    var ta = Number($('#ta_id').val());

					    var roa1 = (ni2 * 100 / ta).toFixed(2);

					    Number($('#roa_id').val(roa1));
			        });

				return this;
			},

		};
	exports.returnOnAssetsCalculator = returnOnAssetsCalculator;

}).apply(this, [jQuery]);

// return on equity calculator
(function($) {

	var initialized = false;

	var returnOnEquityCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#ni3_id, #se_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var ni3 = Number($('#ni3_id').val());
					    var se = Number($('#se_id').val());

					    var re = (ni3 * 100 / se).toFixed(2);

					    Number($('#roe_id').val(re));
			        });

				return this;
			},

		};
	exports.returnOnEquityCalculator = returnOnEquityCalculator;

}).apply(this, [jQuery]);

// returnOnInvestmentCalculator 
(function($) {

	var initialized = false;

	var returnOnInvestmentCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#te_id, #iin_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var te = Number($('#te_id').val());
					    var iin = Number($('#iin_id').val());

					    var roi = ((te-iin) * 100 / iin).toFixed(2);

					    Number($('#roi_id').val(roi));
			        });

				return this;
			},

		};
	exports.returnOnInvestmentCalculator = returnOnInvestmentCalculator;

}).apply(this, [jQuery]);

// risk premium calculator
(function($) {

	var initialized = false;

	var riskPremiumCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#mr_id, #rfr_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var mr = Number($('#mr_id').val());
					    var rfr = Number($('#rfr_id').val());

					    var rp  = (mr - rfr)

					    Number($('#rp_id').val(rp));
			        });

				return this;
			},

		};
	exports.riskPremiumCalculator = riskPremiumCalculator;

}).apply(this, [jQuery]);

// simple interest calculator
(function($) {

	var initialized = false;

	var simpleInterestCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#principal_id, #rate_id, #prd_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var principal = Number($('#principal_id').val());
					    var rate = Number($('#rate_id').val());
					    var prd = Number($('#prd_id').val());

					    var simple_interest = ((principal * rate * prd) / 100).toFixed(2);
					    var new_principal = (principal + ((principal * rate * prd) / 100)).toFixed(2);

					    Number($('#simple_interest_id').val(simple_interest));
					    Number($('#new_principal_id').val(new_principal));
			        });

				return this;
			},

		};
	exports.simpleInterestCalculator = simpleInterestCalculator;

}).apply(this, [jQuery]);

// CalculateSIP
(function($) {

	var initialized = false;

	var calculateSIP = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#m_amount_id, #rate_id, #time_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var p = $('#m_amount_id').val();
					    var r = $('#rate_id').val();
					    var t = $('#time_id').val();

					    var final_r = 1+r/1200;
					    final_t = t*12;
					    
					    var total_r = final_r;

					    for(var i=0; i<final_t; i++)
					    {
					        total_r *= final_r;
					    }

					    var series_fv = p * ((total_r - 1)/(r/1200)) - p;
					    var final_fv = Math.round(series_fv);

					    $('#result_id').val(final_fv);
			        });

				return this;
			},

		};
	exports.calculateSIP = calculateSIP;

}).apply(this, [jQuery]);

// tax equivlent yield calculator
(function($) {

	var initialized = false;

	var taxEquivlentYieldCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#tfy_id, #tr1_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var tfy = Number($('#tfy_id').val());
					    var tr1 = Number($('#tr1_id').val());

					     var tey1 = ((tfy/100) * 100 /(1-tr1/100)).toFixed(2);

					    $('#tey2_id').val(tey1);
			        });

				return this;
			},

		};
	exports.taxEquivlentYieldCalculator = taxEquivlentYieldCalculator;

}).apply(this, [jQuery]);

// total stock return calculator
(function($) {

	var initialized = false;

	var totalStockReturnCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#isp_id, #esp_id, #deps1_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var isp = Number($('#isp_id').val());
					    var esp = Number($('#esp_id').val());
					    var deps1= Number($('#deps1_id').val())
					    
						
						var tsr = (((esp-isp)+deps1) * 100 / isp).toFixed(2);
					    var tsrps = ((esp-isp)+deps1).toFixed(2); 

					    Number($('#tsr1_id').val(tsr));
						Number($('#tsr2_id').val(tsrps));
			        });

				return this;
			},

		};
	exports.totalStockReturnCalculator = totalStockReturnCalculator;

}).apply(this, [jQuery]);

// yield of maturity calculator
(function($) {

	var initialized = false;

	var yieldOfMaturityCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#interest_id, #face_value_id, #price_of_bond_id, #maturity_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var interest = Number($('#interest_id').val());
					    var face_value = Number($('#face_value_id').val());
					    var bond_price= Number($('#price_of_bond_id').val());
					    var maturity = Number($('#maturity_id').val());

					    var yfm = ((100+((face_value - bond_price) / 10)) / ((face_value+bond_price) / 2) *100).toFixed(2);
					   
					    Number($('#ram_id').val(yfm));
			        });

				return this;
			},

		};
	exports.yieldOfMaturityCalculator = yieldOfMaturityCalculator;

}).apply(this, [jQuery]);

// zero coupon bond effective yield calculator
(function($) {

	var initialized = false;

	var zeroCouponBondEffectiveYieldCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#face_value1_id, #pre_value_id, #time_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var fvb = Number($('#face_value1_id').val());
					    var rfy = Number($('#pre_value_id').val());
					    var tom= Number($('#time_id').val());
					  
					  
					   var zcb = ((Math.pow((fvb/rfy) , (1/tom)) - 1 ) * 100).toFixed(2);

					    Number($('#gita_id').val(zcb));
			        });

				return this;
			},

		};
	exports.zeroCouponBondEffectiveYieldCalculator = zeroCouponBondEffectiveYieldCalculator;

}).apply(this, [jQuery]);

// zero coupon bond value calculator 
(function($) {

	var initialized = false;

	var zeroCouponBondValueCalculator = {

			defaults: {
			},

			initialize: function(opts) {
				if (initialized) {
					return this;
				}

				initialized = true;

				this
					.setOptions(opts)
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			events: function() {
				var self    = this,
					$nodeEventRoot  = $('#face_value1_id, #rate_of_yield_id, #time_of_maturity_id');

					$nodeEventRoot
	                .on( 'keyup', function(event) {
	                	var fvb = Number($('#face_value1_id').val());
					    var rfy = Number($('#rate_of_yield_id').val());
					    var tom= Number($('#time_of_maturity_id').val());
					    
					    var zcb = (fvb / (Math.pow((1+rfy/100), tom))).toFixed(2);
					    
					    Number($('#sita_id').val(zcb));
			        });

				return this;
			},

		};
	exports.zeroCouponBondValueCalculator = zeroCouponBondValueCalculator;

}).apply(this, [jQuery]);