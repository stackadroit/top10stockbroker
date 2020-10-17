// Theme
window.theme = {};

// Theme Common Functions
window.theme.fn = {

	getOptions: function(opts) {

		if (typeof(opts) == 'object') {

			return opts;

		} else if (typeof(opts) == 'string') {

			try {
				return JSON.parse(opts.replace(/'/g,'"').replace(';',''));
			} catch(e) {
				return {};
			}

		} else {

			return {};

		}

	}

};

exports.theme = window.theme;

// Scroll to Top
(function(theme, $) {
	
	var PluginScrollToTop = {

		defaults: {
			wrapper: $('body'),
			offset: 150,
			buttonClass: 'scroll-to-top',
			iconClass: 'fas fa-chevron-up',
			delay: 1000,
			visibleMobile: false,
			label: false,
			easing: 'easeOutBack'
		},

		initialize: function(opts) {
			initialized = true;

			// Don't initialize if the page has Section Scroll
			if( $('body[data-plugin-section-scroll]').get(0) ) {
				return;
			}

			this
				.setOptions(opts)
				.build()
				.events();

			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, this.defaults, opts);

			return this;
		},

		build: function() {
			var self = this,
				$el;

			// Base HTML Markup
			$el = $('<a />')
				.addClass(self.options.buttonClass)
				.attr({
					'href': '#',
				})
				.append(
					$('<i />')
					.addClass(self.options.iconClass)
			);

			// Visible Mobile
			if (!self.options.visibleMobile) {
				$el.addClass('hidden-mobile');
			}

			// Label
			if (self.options.label) {
				$el.append(
					$('<span />').html(self.options.label)
				);
			}

			this.options.wrapper.append($el);

			this.$el = $el;

			return this;
		},

		events: function() {
			var self = this,
				_isScrolling = false;

			// Click Element Action
			self.$el.on('click', function(e) {
				e.preventDefault();
				$('body, html').animate({
					scrollTop: 0
				}, self.options.delay, self.options.easing);
				return false;
			});

			// Show/Hide Button on Window Scroll event.
			$(window).scroll(function() {

				if (!_isScrolling) {

					_isScrolling = true;

					if ($(window).scrollTop() > self.options.offset) {

						self.$el.stop(true, true).addClass('visible');
						_isScrolling = false;

					} else {

						self.$el.stop(true, true).removeClass('visible');
						_isScrolling = false;

					}

				}

			});

			return this;
		}

	};

	exports.PluginScrollToTop = PluginScrollToTop;
		
}).apply(this, [window.theme, jQuery]);	

// Stickey Widget
(function(theme, $) {
	
	var initialized = false;

	var PluginStickyWidget = {

		defaults: {
			stickyWidget: $('#site-sidebar > .widget.text-6'),
			offset: 50,
			brakePoint: 975,
		},

		initialize: function(opts) {
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
			var self = this;

			//only for desktop
			$( window ).resize(function() {
			  if ($( document ).width() < self.options.brakePoint ) {
			  	$('#site-sidebar').addClass('no-sticky');
			  }else{
			  	$('#site-sidebar').removeClass('no-sticky');
			  }
			});

			// Distance from top of page to sidebar ad in px
			var widgetFromTop = self.options.stickyWidget.offset().top
			
			// Height of entire content area
    		var contentHeight = $('#main-content').height();

    		// Height of entire sidebar
    		var sidebarHeight = $('#site-sidebar').height();


    		if (sidebarHeight < contentHeight + self.options.offset) {
    			$(window).scroll(function() {
    				// If scroll distance from top exceeds by widget distance from top, add class
        			if ($(window).scrollTop() >= widgetFromTop) {
        				self.options.stickyWidget.addClass('sticky-widget');
        			}else {
			          	self.options.stickyWidget.removeClass('sticky-widget');
			        }

			        // If scroll distance from top is greater than content height remove class. 
			        //Added  X-px to pull out a bit before reaching the bottom.
			        if ($(window).scrollTop() > contentHeight - self.options.offset) {
			          self.options.stickyWidget.removeClass('sticky-widget');
			        }

    			});
    		}
    		
			return this;
		}

	};

	exports.PluginStickyWidget = PluginStickyWidget;
		
}).apply(this, [window.theme, jQuery]);	

// header
(function(theme, $) {

	var initialized = false;

	var Header = {

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
					var self = this,
					$header = $('#header');

					$header.find('a[href="#"]').on('click', function(e) {
							e.preventDefault();
						});
				
					// Top Features
					$header.find('.header-nav-features-toggle').on('click', function(e) {
						e.preventDefault();

						var $toggleParent = $(this).parent();

						if (!$(this).siblings('.header-nav-features-dropdown').hasClass('show')) {

							var $dropdown = $(this).siblings('.header-nav-features-dropdown');

							$('.header-nav-features-dropdown.show').removeClass('show');

							$dropdown.addClass('show');

							$(document).off('click.header-nav-features-toggle').on('click.header-nav-features-toggle', function (e) {
								if (!$toggleParent.is(e.target) && $toggleParent.has(e.target).length === 0) {
									$('.header-nav-features-dropdown.show').removeClass('show');
								}
							});

							if ($(this).attr('data-focus')) {
								$('#' + $(this).attr('data-focus')).focus();
							}

						} else {
							$(this).siblings('.header-nav-features-dropdown').removeClass('show');
						}
					});

				return this;
			}
	};

	exports.Header = Header;

}).apply(this, [window.theme, jQuery]);

// Nav
(function(theme, $) {

	theme = theme || {};

	var initialized = false;

	var Nav = {

			defaults: {
				scrollDelay: 600,
				scrollAnimation: 'easeOutQuad'
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
					$html   = $('html');

				$('.header-btn-collapse-nav, .close-menu-mobile').on('click',function(e){
					if($html.hasClass('openmenu')) {
					  $html.removeClass('openmenu');
					} else {
					  $html.addClass('openmenu');
					}
				});

				// Submenu
				$(".mega-menu .caret-submenu").on('click', function(e){
				   $(this).toggleClass('active');
				   $(this).siblings('.sub-menu').toggle(300);
				});

				//Overlay
				$('.overlay').click(function () {
					if($('html').hasClass('openmenu')){
						$('html').removeClass('openmenu');
					}
				});

				return this;
			},

		};
	exports.Nav = Nav;

}).apply(this, [window.theme, jQuery]);