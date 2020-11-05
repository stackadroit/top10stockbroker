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
			iconClass: 'fas fa-angle-up',
			delay: 1000,
			visibleMobile: false,
			label: false
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
				}, self.options.delay);
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
			stickyWidget: $('#site-sidebar .fixed-widget'),
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
			// $( window ).resize(function() {
			//   if ($( document ).width() < self.options.brakePoint ) {
			//   	$('#site-sidebar').addClass('no-sticky');
			//   }else{
			//   	$('#site-sidebar').removeClass('no-sticky');
			//   }
			// });

			// Distance from top of page to sidebar add in px
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
        				//$('body').addClass('sticky-widget');
        			}else {
			          	self.options.stickyWidget.removeClass('sticky-widget');
			          	//$('body').removeClass('sticky-widget');
			        }

			        // If scroll distance from top is greater than content height remove class. 
			        //Added  X-px to pull out a bit before reaching the bottom.
			        if ($(window).scrollTop() > contentHeight - self.options.offset) {
			          self.options.stickyWidget.removeClass('sticky-widget');
			          //$('body').removeClass('sticky-widget'); 
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

			ajax: function(term){
		        var self    = this; 
		        $.ajax({
		              dataType: 'json',
                	  type: "POST",
		              url: global_vars.apiServerUrl + '/api/company-list-search',
		              data : {
		                'action': 'get_company_list',
		                'SearchTxt': term,
		              },
			          success: function(response){
			            
			            var  result =  '';
			            $.each(response.stocks, function (index, value) {
			            	result += '<li><a href="'+ response.stocks[index].id + '">' + response.stocks[index].text + '</a></li>';
			            });
			            $("#result-search").html(result);
			          },
			          error: function(response){
			             console.log('search Data Error.');
			          }
		        });

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
				$(".overlay").on("click", function(e) {
					if($('html').hasClass('openmenu')){
						$('html').removeClass('openmenu');
					}
				});

				//search
				$("#search-header-btn").on("click", function(e) {
					e.preventDefault();
                  	self.search();
                });

				$("#headerSearch").on("keyup change", function(e) {
	                 self.search();
                });

				return this;
			},

			search: function(){
 					
 				var self  = this,
				$headerSearch   = $("#headerSearch");
                    
                var term = $headerSearch.val();
                if(term != ""){
                    $("#result-search").html('<div class="fb-loader loader mx-auto"></div>');
                    self.ajax(term); 
                }
            },
		};
	exports.Nav = Nav;

}).apply(this, [window.theme, jQuery]);

// modal popup
(function($) {

  var initialized = false;

  var ModalPopup = {

      defaults: {
        wrapper: $('.popup-main')
      },

      initialize: function($wrapper, opts) {
        if (initialized) {
          return this;
        }

        initialized = true;
        this.$wrapper = ($wrapper || this.defaults.wrapper); 

        this
          .setOptions(opts)
          .events(); 

        return this;
      },

      setOptions: function(opts) {
        this.options = $.extend(true, {}, this.defaults, opts, window.theme.fn.getOptions(this.$wrapper.data('plugin-options')));

        return this;
      },
      
      ajax: function(modal, modelAction, auto){
        var self    = this; 
        $.ajax({
              cache: false,
              type:"POST",
              dataType: "html",
              url: global_vars.ajax_url,
              data : {
                'action': 'modal_popup',
                'security': global_vars.ajax_nonce,
                'model_auto': auto,
                'model_action': modelAction,
                'post_id': self.options.post_id,
                'contactform': self.options.contactform,
                'form_left_content': self.options.form_left_content,
                'form_right_content': self.options.form_right_content,
                'form_mobile_content': self.options.form_mobile_content,
                'auto_popup_left_content': self.options.auto_popup_left_content,
                'auto_popup_right_content': self.options.auto_popup_right_content,
                'auto_popup_mobile_content': self.options.auto_popup_mobile_content,
                'custom_hellobar': self.options.custom_hellobar,
                'hello_bar': self.options.hello_bar,
              },
            success: function(response){
            	modal.find('.load-model').html(response); 

            	if (modelAction == "mbf-search-wrap") {
            		$(document).trigger('loadReactSlickIcons', [modelAction]);
            	}
            	
            	if (modelAction == "custom-hellobar") {
            		self.formValidation();
            		$(document).trigger('reinitContactform', [modelAction]);
            	}
            },
            error: function(response){
              console.log('Module Data Error.');
            }
        });

          return this;
      },

      formValidation: function(){
      	var self = this; 

      	$('.load-model input[name="cf7s-name"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>');
		$('.load-model input[name="cf7s-City"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>');
		$('.load-model input[name="cf7s-phone"]').after('<p><span class="emsg d-none">Invalid number! Use 10 digit numbers starting with 6, 7, 8 or 9.</span></p>');
		$('.load-model .wpcf7-checkbox').append('<p><span class="emsg d-none">Please select the service.</span></p>');
        
        $regexname = /^([a-zA-Z ]){1,100}$/;
        $regexPhone = /^(?:(?:\+|0{0,2})91(\s*[\ -]\s*)?|[0]?)?[789]\d{9}|(\d[ -]?){10}\d$/;

        $(document).on('blur','.load-model input[name="cf7s-name"], .load-model input[name="cf7s-City"]',function(key){
        	self.formConditionCheck(this, $regexname);
        });

        $(document).on('blur','.load-model input[name="cf7s-phone"]',function(key){
        	self.formConditionCheck(this, $regexPhone);
        });

        var sumbmit_form_data= '';
        $(document).on('click','.load-model .wpcf7-submit',function(e) {
        	e.preventDefault();
        	var Er = 0;
        	var form = $(this).closest('form.wpcf7-form');
 			var name = $(form).find('input[name="cf7s-name"]');
 			var city = $(form).find('input[name="cf7s-City"]');
 			var number = $(form).find('input[name="cf7s-phone"]');

 			self.formConditionCheck(name, $regexname);
 			if (!$(name).val().match($regexname)) {
 				Er = 1;
 			}

 			self.formConditionCheck(city, $regexname);
 			if (!$(city).val().match($regexname)) {
 				Er = 2;
 			}

 			self.formConditionCheck(number, $regexPhone);
 			if (!$(number).val().match($regexPhone)) {
 				Er = 2;
 			}

 			if($(form).find('.wpcf7-checkbox [type="checkbox"]').is(":checked")){
                $(form).find('.wpcf7-checkbox').find('.emsg').addClass('d-none');
            }else{
                $(form).find('.wpcf7-checkbox').find('.emsg').removeClass('d-none');
	            Er = 4;
            } 

            if(Er){
            	console.log(Er);
            	return false; 
            }else{
            	$(this).prop("disabled",true);
            	sumbmit_form_data = $(form).serialize();
            	var submit = $(form).submit();
            	return true;
            }
        });

      },

      formConditionCheck: function($el, $regex){
      	if (!$($el).val().match($regex)) {
    		$($el).parent().find('.emsg').removeClass('d-none');
    	}else{
    		$($el).parent().find('.emsg').addClass('d-none');
    	}
      },

      events: function() {
        var self    = this,
          $document  = $(document),
          $rootnode  = $("#popup-main");

          $rootnode
          .on('show.bs.modal', function (event) {
        		var modelAction = $(event.relatedTarget); // Button that triggered the modal
        		var auto = false;
        		if ($.isEmptyObject(modelAction)) {
        			//console.log('auto');
          			modelAction = 'custom-hellobar';
          			auto = true;
        		}else{
        			//console.log('onlick');
          			modelAction = modelAction.get(0).id;
        		}
        		var modal = $(this);
        		var statusModalOpen = (modal.data('bs.modal') || {isShown: false}).isShown;
        		if (!statusModalOpen) {
          			self.ajax(modal, modelAction, auto); 
        		}
      		});

          $rootnode
      	  .on('hidden.bs.modal', function (event) {
          	var modal = $(this);
          	modal.find('.load-model').html('<div class="fb-loader loader"></div>'); 
      		});

	      var intervalID = setInterval( function(){ 
	        //$rootnode.modal('show');
	      },60000); 
          // clearInterval(intervalID); // Will clear the timer.
        return this;
      },
    };
  exports.ModalPopup = ModalPopup;

}).apply(this, [jQuery]);

// super treadmill
(function($) {

  var initialized = false;

  var SuperTreadmill = {

      defaults: {
      },

      initialize: function(opts) {
        if (initialized) {
          return this;
        }

        initialized = true;
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
        var self    = this;

         var running = false;

		    // moves treadmill in the downward direction
		    treadmillDown = function(obj, speed) {
		                    setTimeout( function() {
		                        if(running) {
		                            var elm = obj.find('.treadmill-unit').last();
		                            var elm2 = elm.clone();
		                            var height = elm.height();
		                            elm2.css('top', -height + 'px');
		                            elm2.css('height', '0px');
		                            elm2.prependTo(obj);
		                            elm2.animate({
		                                'top': '0px',
		                                'height': height
		                            }, 1000, function() { 
		                                elm.remove();
		                            });

		                            treadmillDown(obj, speed);
		                        }
		                    }, speed);
		    },

		    //moves treadmill in the upward direction
		    treadmillUp = function(obj, speed) {
		                    setTimeout( function() {
		                        if(running) {
		                            var elm = obj.find('.treadmill-unit').first();
		                            var elm2 = elm.clone();
		                            var height = elm.height();
		                            elm.animate({
		                                'height': '0px',
		                                'top': -height
		                            }, 1000, function() {
		                                elm.remove();
		                            });
		                            elm2.appendTo(obj);

		                            treadmillUp(obj, speed);
		                        }                   
		                    }, speed);
		    },

		    // decides which type of treadmill to use
		    selectTreadmill = function(direction, obj, speed) {
		        if(direction == "down")
		            treadmillDown(obj, speed);
		        else
		            treadmillUp(obj, speed);
		    },
		    
		    // starts the treadmill
		    $.fn.startTreadmill = function( options ) {

		        var treadmillHeight = 0;

		        var settings = $.extend({
		            // These are the defaults.
		            runAfterPageLoad: true,
		            direction: "down",
		            speed: "medium",
		            viewable: 3,
		            pause: false
		        }, options );

		        // Sets the height of Super Treadmill to viewable times height of the first unit else it is set to user-defined css value
		        if(settings.viewable <= $(this).children().length && settings.viewable != 0)
		            treadmillHeight = settings.viewable * $(this).find('.treadmill-wrap').first().height();
		        else
		            treadmillHeight = $(this).height();

		        $(this).css('height', treadmillHeight);

		        
		        // Super-Treadmill starts immediately after the page load
		        if(settings.runAfterPageLoad)
		            running = true;

		        
		        // Setting the tread speed of the Super-Treadmill
		        var treadSpeed = 3000;

		        if(settings.speed == "slow" || settings.speed == "medium" || settings.speed == "fast" || $.isNumeric(settings.speed)) {
		            if(settings.speed == "slow")
		                treadSpeed = 5000; // 5 seconds
		            else if(settings.speed == "fast")
		                treadSpeed = 1200; // 1.2 seconds
		            else if(settings.speed == "medium")
		                treadSpeed = 3000; // 3 seconds
		            else
		                treadSpeed = settings.speed; // user-defined value
		        }
		        else
		            $.error("Super-Treadmill can only use one of its predefined speeds: 'slow', 'medium', 'fast' or a number that you specify, which it later converts into milliseconds");

		        
		        // Binding events to pause the Super-Treadmill during mouse enter and leave.
		        if(settings.pause) {
		            $(this).mouseenter( function() {
		                running = !running;
		            });

		            $(this).mouseleave( function() {
		                running = !running;
		                selectTreadmill(settings.direction, $(this).find('.treadmill-wrap'), treadSpeed);
		            });
		        }

		        selectTreadmill(settings.direction, $(this).find('.treadmill-wrap'), treadSpeed);
		        
		    };
		    
        return this;
      },

      events: function() {
        var self    = this,
          $document  = $(document);

        return this;
      },

    };
  exports.SuperTreadmill = SuperTreadmill;

}).apply(this, [jQuery]);