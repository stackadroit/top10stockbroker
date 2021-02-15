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

	},
	

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
					'aria-label': 'Scroll To Top',
					'title': 'Scroll To Top',
				})
				.append(
					$('<i />')
					.addClass(self.options.iconClass)
			);

			// Visible Mobile
			// if (!self.options.visibleMobile) {
			// 	$el.addClass('hidden-mobile');
			// }

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
			stickyWidget: $('body:not(.mobile) #site-sidebar .fixed-widget'),
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

			if ( !self.options.stickyWidget.length ) {
				return this;
			}

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
            	
            	if (modelAction == "custom-hellobar" || modelAction == "mini-popup") {
            		// Condition For Mini Popup
            		if(modelAction != "mini-popup"){
            			modal.find('.modal-dialog').css('max-width','800px');
            		}
            		self.initializedValidation();
            		$(document).trigger('reinitContactform', [modelAction]);
            	}
            },
            error: function(response){
              console.log('Module Data Error.');
            }
        });

          return this;
      	},
      	initializedValidation:function(){
      		var self = this; 
	     	$('.model-popup input[name="cf7s-name"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>');
			$('.model-popup input[name="cf7s-City"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>');
			$('.model-popup input[name="cf7s-phone"]').after('<p><span class="emsg d-none">Invalid number! Use 10 digit numbers starting with 6, 7, 8 or 9.</span></p>');
			$('.model-popup .wpcf7-checkbox').append('<p><span class="emsg d-none">Please select the service.</span></p>');
        
      	},
	    formValidation: function(){
	      	var self = this; 

	      	$('.wpcf7-form').find('.emsg').remove();
	     	$('.wpcf7-form input[name="cf7s-name"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>');
			$('.wpcf7-form input[name="cf7s-City"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>');
			$('.wpcf7-form input[name="cf7s-phone"]').after('<p><span class="emsg d-none">Invalid number! Use 10 digit numbers starting with 6, 7, 8 or 9.</span></p>');
			$('.wpcf7-form .wpcf7-checkbox').append('<p><span class="emsg d-none">Please select the service.</span></p>');
	        
	        $regexname = /^([a-zA-Z ]){1,100}$/;
	        $regexPhone = /^(?:(?:\+|0{0,2})91(\s*[\ -]\s*)?|[0]?)?[56789]\d{9}|(\d[ -]?){10}\d$/;

	        $(document).on('blur','input[name="cf7s-name"], .load-model input[name="cf7s-City"]',function(key){
	        	self.formConditionCheck(this, $regexname);
	        });

	        $(document).on('blur',' input[name="cf7s-phone"]',function(key){
	        	self.formConditionCheck(this, $regexPhone);
	        });

	        var sumbmit_form_data= '';
	        $(document).on('click','.wpcf7-submit',function(e) {
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
	        		if (! modelAction.length) {
	        			// Condition For Mini Popup
	        			if($rootnode.data('mini-popup')){
	        				// console.log('mini-popup');
	        				modelAction = 'mini-popup';
	          				auto = $rootnode.data('mini-popup');
	        			}else{
	          				$rootnode.find('.modal-dialog').css('max-width','800px');
	        				modelAction = 'custom-hellobar';
	          				auto = true;
	        			}
	        		}else{
	        			//console.log('onlick');
	          			$rootnode.find('.modal-dialog').css('max-width','800px');
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

		      // var intervalID = setInterval( function(){ 
		      //   $rootnode.modal('show');
		      // },60000); 

		      //auto open at 1 min
		      setTimeout(function(){ 
		        $rootnode.modal('show');
		      }, 60000); 
		      //auto open at 3 min
		      setTimeout(function(){ 
		        $rootnode.modal('show');
		      }, 180000); 

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
      	direction: 'up',
        easing: 'swing',
        speed: 'slow',
        interval: 2000,
        height: 'auto',
        visible: 0,
        mousePause: true,
        controls: {
            up: '',
            down: '',
            toggle: '',
            playText: 'Play',
            stopText: 'Stop'
        },
        callbacks: {
            before: false,
            after: false
        }
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
        var self    = this,
        name = "easyTicker";

	    // Constructor
	    function EasyTicker(el, options) {
	        
	        var s = this;
	        
	        s.opts = $.extend({}, this.options, options);
	        s.elem = $(el);
	        s.targ = $(el).children(':first-child');
	        s.timer = 0;
	        s.winFocus = 1;
	        
	        init();
	        start();
	        
	        $([window, document]).off('focus').on('focus', function(){
	            s.winFocus = 1;
	        }).off('blur').on('blur', function(){
	            // s.winFocus = 0; // stop when user is not active on page
	            s.winFocus = 1;
	        });
	        
	        if(s.opts.mousePause){
	            s.elem.mouseenter(function(){
	                s.timerTemp = s.timer;
	                stop();
	            }).mouseleave(function(){
	                if(s.timerTemp !== 0)
	                    start();
	            });
	        }
	        
	        $(s.opts.controls.up).on('click', function(e){
	            e.preventDefault();
	            moveDir('up');
	        });
	        
	        $(s.opts.controls.down).on('click', function(e){
	            e.preventDefault();
	            moveDir('down');
	        });
	        
	        $(s.opts.controls.toggle).on('click', function(e){
	            e.preventDefault();
	            if(s.timer == 0) start();
	            else stop();
	        });
	        
	        function init(){
	            
	            s.elem.children().css('margin', 0).children().css('margin', 0);
	            
	            s.elem.css({
	                position: 'relative',
	                height: s.opts.height,
	                overflow: 'hidden'
	            });
	            
	            s.targ.css({
	                'position': 'absolute',
	                'margin': 0
	            });
	            
	            s.heightTimer = setInterval(function(){
	                adjustHeight(false);
	            }, 100);
	        
	        }
	        
	        function start(){
	            s.timer = setInterval(function(){
	                if(s.winFocus == 1){
	                    move(s.opts.direction);
	                }
	            }, s.opts.interval);

	            $(s.opts.controls.toggle).addClass('et-run').html(s.opts.controls.stopText);
	            
	        }
	        
	        function stop(){
	            clearInterval(s.timer);
	            s.timer = 0;
	            $(s.opts.controls.toggle).removeClass('et-run').html(s.opts.controls.playText);
	        }
	        
	        function move(dir){
	            var sel, eq, appType;

	            if(!s.elem.is(':visible')) return;

	            if(dir == 'up'){
	                sel = ':first-child';
	                eq = '-=';
	                appType = 'appendTo';
	            }else{
	                sel = ':last-child';
	                eq = '+=';
	                appType = 'prependTo';
	            }

	            var selChild = s.targ.children(sel);
	            var height = selChild.outerHeight();

	            if(typeof s.opts.callbacks.before === 'function'){
	                s.opts.callbacks.before.call(s, s.targ, selChild);
	            }

	            s.targ.stop(true, true).animate({
	                'top': eq + height + 'px'
	            }, s.opts.speed, s.opts.easing, function(){
	                
	                selChild.hide()[appType](s.targ).fadeIn();
	                s.targ.css('top', 0);
	                
	                adjustHeight(true);
	                
	                if(typeof s.opts.callbacks.after === 'function'){
	                    s.opts.callbacks.after.call(s, s.targ, selChild);
	                }

	            });
	        }
	        
	        function moveDir(dir){
	            stop();
	            if(dir == 'up') move('up'); else move('down');
	            // start();
	        }
	        
	        function setFullHeight(){
	            var height = 0;
	            var tempDisplay = s.elem.css('display'); // Get the current el display value
	            
	            s.elem.css('display', 'block');
	            
	            s.targ.children().each(function(){
	                height += $(this).outerHeight();
	            });
	            
	            s.elem.css({
	                'display': tempDisplay,
	                'height': height
	            });
	        }
	        
	        function setVisibleHeight(animate){
	            var wrapHeight = 0;
	            var visibleItemClass = 'et-item-visible';

	            s.targ.children().removeClass(visibleItemClass);

	            s.targ.children(':lt(' + s.opts.visible + ')').each(function(){
	                wrapHeight += $(this).outerHeight();
	                $(this).addClass(visibleItemClass);
	            });
	            
	            if(animate){
	                s.elem.stop(true, true).animate({height: wrapHeight}, s.opts.speed);
	            }else{
	                s.elem.css('height', wrapHeight);
	            }
	        }
	        
	        function adjustHeight(animate){

	            if(s.opts.height == 'auto'){
	                if(s.opts.visible > 0){
	                    setVisibleHeight(animate);
	                }else{
	                    setFullHeight();
	                }
	            }

	            if(!animate){
	                clearInterval(s.heightTimer);
	            }

	        }
	        
	        return {
	            up: function(){ moveDir('up'); },
	            down: function(){ moveDir('down'); },
	            start: start,
	            stop: stop,
	            options: s.opts
	        };
	        
	    }

	    // Attach the object to the DOM
	    $.fn[name] = function(options) {
	        return this.each(function () {
	            if (!$.data(this, name)) {
	                $.data(this, name, new EasyTicker(this, options));
	            }
	        });
	    };
		    
        return this;
      },

      events: function() {
        var self    = this,
          $document  = $(document);

          $('#arrow-button-widget').on('click',function(e){
	        e.preventDefault();
	        $(this).toggleClass("open");
	        $('.second-rp').toggle();
	      });

        return this;
      },

    };
  exports.SuperTreadmill = SuperTreadmill;

}).apply(this, [jQuery]);

// Easy Tab
(function($) {

  var initialized = false;

  var EasyTab = {
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
		changeTab() {
			// alert('ddd');
		    
		},
		events: function() {
			var is_mobile=0;
			if ($(window).width() < 700){
		       is_mobile =1;
		    }
		    $(document).on('click','.see-all-btn',function(){
				$(this).closest('.tab_content').find('.row').find('div').show();
				$(this).hide();
			});

			$(document).on('click','.see-all-btn',function(){
				$(this).closest('.tab_content').find('.row').find('div').show();
				$(this).hide();
			});
			var els =".easy_tabs_container";
			$(els+' .tab_content_wrapper div.tab_content:not(:first)').hide();
				$(els+' .previous').hide();
					$(els+' .tabs li > a').click(function (e) {
	                    e.preventDefault();
	                    // alert('dddddd');
	                    if($(this).closest('li').is(':last-child')) {
	                       $(this).closest('.easy_tabs_container').find('.next').hide();
	                    } else {
	                        $(this).closest('.easy_tabs_container').find('.next').show();
	                    }

	                    if ($(this).closest('li').is(':first-child')) {
	                        $(this).closest('.easy_tabs_container').find('.previous').hide();
	                    } else {
	                        $(this).closest('.easy_tabs_container').find('.previous').show();
	                    }

	                    var position = $(this).closest('li').position();
	                    //var corresponding = jQuery(this).data("id");
	                    var corresponding = $(this).attr("href");
	                    scroll = $(this).closest('.tabs').scrollLeft();
	                    // alert(scroll+position.left);
	                    $(this).closest('.tabs').animate({
	                        'scrollLeft': scroll + position.left - 30
	                    }, 200);

	                    // hide all content divs
	                    $(this).closest('.easy_tabs_container').find('.tab_content_wrapper').find('div.tab_content').hide();
	                    // show content of corresponding tab
	                    $(this).closest('.easy_tabs_container').find('div' + corresponding).toggle();
	                    // remove active class from currently not active tabs
	                    $(this).closest('.easy_tabs_container').find(' .tabs li').removeClass('active');
	                    // add active class to clicked tab
	                    $(this).closest('li').addClass('active');
	                });
 
	                $(els+' .next').click(function(e){
	                    e.preventDefault();
	                    $(this).closest('.easy_tabs_container').find('li.active').next('li').find('a').trigger('click');
	                });
	                $(els+' .previous').click(function(e){
	                    e.preventDefault();
	                    $(this).closest('.easy_tabs_container').find('li.active').prev('li').find('a').trigger('click');
	                });
	            // });
			return this;
		},
	 
    };
  exports.EasyTab = EasyTab;

}).apply(this, [jQuery]);

// share-market-education
(function($) {

  var initialized = false;

  var ShareMarketEducation = {
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
		changeTab() {
			
		    
		},
		events: function() {
			var is_mobile=0;
			if (jQuery(window).width() < 700){
		       is_mobile =1;
		    }
		    jQuery(document).on('click','.see-all-btn',function(){
				jQuery(this).closest('.tab_content').find('.row').find('div').show();
				jQuery(this).hide();
			});

			var els ="#easy_tabs_container_vertical_wrap_1";

			$(els+" .tab_content").each(function(i) {
			    $(this).find('.v_tab_content:not(:first)').hide();
			    if ($(window).width() >= 781) {
	                $(this).find(" .v_tab_content:nth-child(2)").show();
	            }
	            $(this).find("ul.v_tabs li").click(function () {
                    	$(this).closest('.v_tabs_wrapper').find('.v_tab_content').hide();
                        var activeTab = jQuery(this).attr("rel");
                        $(this).closest('.v_tabs_wrapper').find("#" + activeTab).fadeIn();
                        $(this).closest('.v_tabs_wrapper').find("ul.v_tabs li").removeClass("v_active");
                        $(this).addClass("v_active");
                        $(this).closest('.v_tabs_wrapper').find(".v_tab_drawer_heading").removeClass("d_active");
                        $(this).closest('.v_tabs_wrapper').find(" .v_tab_drawer_heading[rel^='" + activeTab + "']").addClass("d_active");
                });
                /* if in tab mode */
	          	$(this).find(".v_tab_container").css("min-height", function () {
                  	return $(els+" .v_tabs").outerHeight() + 50;
              	}); 

              	 /* if in drawer mode */
                $(this).find(".v_tab_drawer_heading").click(function () {
                  	$(this).closest('.v_tab_container').find('.v_tab_content').hide();
                 	if($(this).hasClass("d_active")){
                      	$(this).removeClass("d_active");
                   	}else{
                    	var d_activeTab = $(this).attr("rel");
                      	$(this).closest('.v_tab_container').find("#" + d_activeTab).fadeIn();
                     	$(this).closest('.v_tab_container').find(".v_tab_drawer_heading").removeClass("d_active");
                       	$(this).addClass("d_active");
                      	$(this).closest('.v_tab_container').find("ul.v_tabs li").removeClass("v_active");
                       	$(this).closest('.v_tab_container').find(" ul.v_tabs li[rel^='" + d_activeTab + "']").addClass("v_active");
                  	}
            	});
			});
			return this;
		},
	 
    };
  exports.ShareMarketEducation = ShareMarketEducation;

}).apply(this, [jQuery]);

// Register Tabs
(function($) {

  var initialized = false;

  var PaTabs = {
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
		changeTab() {
			
		    
		},
		events: function() {
			$('ul.tabs').each(function () {
	            var $active, $content, $links = jQuery(this).find('a');
	             $active = jQuery($links.filter('[href="' + location.hash + '"]')[0] || $links[0]);
	            $active.addClass('active');
	            $content = $($active[0].hash);
	           $links.not($active).each(function () {
	                jQuery(this.hash).hide();
	            });
	             jQuery(this).on('click', 'a', function (e) {
	                $active.removeClass('active');
	                $content.hide();
	            $active = jQuery(this);
	                $content = jQuery(this.hash);
	            $active.addClass('active');
	                $content.show();
	              e.preventDefault();
	            });
	          });
			return this;
		},
	 
    };
  exports.PaTabs = PaTabs;

}).apply(this, [jQuery]);

(function(theme, $) {

	var initialized = false;

	var ContactFormValidation = {

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
			formConditionCheck: function($el, $regex){
		      	if (!$($el).val().match($regex)) {
		    		$($el).closest('li').find('.emsg').show().removeClass('d-none');
		    	}else{
		    		$($el).closest('li').find('.emsg').hide().addClass('d-none');
		    	}
		    },
		    leadPostApi:function(sumbmit_form_data){
		    	console.log(sumbmit_form_data);
				$.ajax({
		           	url : global_vars.ajax_url,
		          	type : 'post',
		           	data : {
		               	action : 'lead_data_post_to_api',
		             	post_data :sumbmit_form_data,
		          	},
		          	success : function( response ) {
		              	console.log(response);
		          	}
		      	});
					
			},
			events: function() {
				var self = this;
				$('input[name="cf7s-name"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>');
				$('input[name="cf7s-City"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>');
				$('input[name="cf7s-phone"]').after('<p><span class="emsg d-none">Invalid number! Use 10 digit numbers starting with 6, 7, 8 or 9.</span></p>');
				$('.wpcf7-checkbox').append('<p><span class="emsg d-none">Please select the service.</span></p>');
				$regexname = /^([a-zA-Z ]){1,100}$/;
        		$regexPhone = /^(?:(?:\+|0{0,2})91(\s*[\ -]\s*)?|[0]?)?[6789]\d{9}|(\d[ -]?){10}\d$/;


		        $(document).on('blur','input[name="cf7s-name"],input[name="cf7s-City"]',function(key){
		        	self.formConditionCheck(this, $regexname);
		        });
		        $(document).on('keypress','input[name="cf7s-name"],input[name="cf7s-City"]',function(key){
		    		self.formConditionCheck(this, $regexname);
		    	});
		        
		        $(document).on('blur','form.wpcf7-form input[name="cf7s-phone"]',function(key){
		 		 	$(this).closest('li').find('.emsg').hide().addClass('d-none');
		 		 	// self.formConditionCheck(this, $regexname);
		 		 	// var $regexmobile=/^(?:(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/;
		    		if (!$(this).val().match($regexPhone)) {
			  			 $(this).closest('li').find('.emsg').show().removeClass('d-none');
			        }else{
			             $(this).closest('li').find('.emsg').hide().addClass('d-none');
			        }
		 		 });
				$(document).on('keypress','form.wpcf7-form input[name="cf7s-phone"]',function(key){
		    		$(this).closest('li').find('.emsg').hide().addClass('d-none');
		    		var value =$(this).val();
		    		$re = /^[0-9]$/;
		    		if(key.charCode === 0 ){
		    		    console.log(key.charCode);
		    		    return true;
		    		}
		    		if($.trim(value) == ""){
		    			if(key.charCode == 54 || key.charCode == 55 || key.charCode == 56 || key.charCode == 57){
		    			
			    		} else{
			    			$(this).closest('li').find('.emsg').show().removeClass('d-none');
			    			return false;
			    		}
		    		}else{
		    			if(key.charCode >= 48 && key.charCode <= 57){
		    			
			    		} else{
			    			$(this).closest('li').find('.emsg').show().removeClass('d-none');
			    			return false;
			    		}
		    		}
		    		if(value.length != 9 && value.length > 0) {
		    			if(value.length > 9) return false;
		    		}else{
		    			$(this).closest('li').find('.emsg').hide().addClass('d-none');
		    		}
		    	});
		    	$(document).on('keydown','form.wpcf7-form input[name="cf7s-phone"]',function(key){
		    		$(this).closest('li').find('.emsg').hide().addClass('d-none');
		    		var value =$(this).val();
		    		$re = /^[0-9]$/;
		    		if(key.charCode === 0 ){
		    		    console.log(key.charCode);
		    		    return true;
		    		}
		    		if($.trim(value) == ""){
		    			if(key.charCode == 54 || key.charCode == 55 || key.charCode == 56 || key.charCode == 57){
		    			
			    		} else{
			    			$(this).closest('li').find('.emsg').show().removeClass('d-none');
			    			return false;
			    		}
		    		}else{
		    			if(key.charCode >= 48 && key.charCode <= 57){
		    			
			    		} else{
			    			$(this).closest('li').find('.emsg').show().removeClass('d-none');
			    			return false;
			    		}
		    		}
		    		if(value.length != 9 && value.length > 0) {
		    			if(value.length > 9) return false;
		    		}else{
		    			$(this).closest('li').find('.emsg').hide().addClass('d-none');
		    		}
		    	});
			 	 
				var sumbmit_form_data='';
		    	$(document).on('click','.wpcf7-submit',function(e) {
		 			e.preventDefault();
		 			var form =$(this).closest('form.wpcf7-form');
		 			var name =$(form).find('input[name="cf7s-name"]');
		 			var city =$(form).find('input[name="cf7s-City"]');
		 			var number =$(form).find('input[name="cf7s-phone"]');
		 			var $regexname=/^([a-zA-Z ]){1,100}$/;
		 			 
		 			Er =0;
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
		 				Er = 3;
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
			            // $('.ajax-loader', $(form)).addClass('is-active');
			            $(this).after('<div class="fb-loader  mx-auto"></div>');
			            sumbmit_form_data =$(form).serialize();
			         	var submit = $(form).submit();
			         	// console.log(sumbmit_form_data);
			          	return true;
			      	}
		 	  	});

		 	  	// Track Contact Form Submit Event
		    	document.addEventListener('wpcf7mailsent', function( event ) {
		    		// console.log(event);
		    		// sumbmit_form_data =event;
		    		$('.wpcf7-form').find('.fb-loader').remove();
		    		self.leadPostApi(sumbmit_form_data) ;
		    		$('.wpcf7-form').find('.wpcf7-submit').prop("disabled",false).removeAttr('disabled');
		        }, false );
		        document.addEventListener('wpcf7mailfailed', function( event ) {
		    		console.log(event);
		    		$('.wpcf7-form').find('.fb-loader').remove();
		    		$('.wpcf7-form').find('.wpcf7-submit').prop("disabled",false).removeAttr('disabled');
		        }, false );
		        document.addEventListener('wpcf7invalid', function( event ) {
		    		console.log(event);
		    		$('.wpcf7-form').find('.wpcf7-submit').prop("disabled",false).removeAttr('disabled');
		    		$('.wpcf7-form').find('.fb-loader').remove();
		        }, false );
		        document.addEventListener('wpcf7spam', function( event ) {
		    		console.log(event);
		    		$('.wpcf7-form').find('.wpcf7-submit').prop("disabled",false).removeAttr('disabled');
		    		$('.wpcf7-form').find('.fb-loader').remove();
		        }, false );
		        document.addEventListener('wpcf7submit', function( event ) {
		    		console.log(event);
		    		$('.wpcf7-form').find('.wpcf7-submit').prop("disabled",false).removeAttr('disabled');
		    		$('.wpcf7-form').find('.fb-loader').remove();
		        }, false );

			  	return this;
			}
		};

	exports.ContactFormValidation = ContactFormValidation;

}).apply(this, [window.theme, jQuery]);


