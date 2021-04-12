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
        wrapper: $('.popup-main'),
        is_main_popup_loaded:false,
        is_mbf_search_loaded:false,
        is_mini_b2cpopup_loaded:false,
        is_mini_b2bpopup_loaded:false,
        is_mini_ipopopup_loaded:false,
        is_mini_pmspopup_loaded:false,
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
        // modal.close();
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
            		self.options.is_mbf_search_loaded =true;
            		$(document).trigger('loadReactSlickIcons', [modelAction]);
            	}
            	
            	if (modelAction == "custom-hellobar" || modelAction == "mini-popup") {
            		// Condition For Mini Popup
            		var form='';
            		if(modelAction != "mini-popup"){
            			modal.find('.modal-dialog').addClass('modal-lg');
            			self.options.is_main_popup_loaded =true;
            			form =$('#popup-main').find('form');
            		}else{
            			if(auto =='open-b2cpopup'){
            				self.options.is_mini_b2cpopup_loaded =true;
            				form =$('#mini-b2cpopup').find('form');
            			}
            			if(auto =='open-b2bpopup'){
            				self.options.is_mini_b2bpopup_loaded =true;
            				form =$('#mini-b2bpopup').find('form');
            			}
            			if(auto =='open-ipopopup'){
            				self.options.is_mini_ipopopup_loaded =true;
            				form =$('#mini-ipopopup').find('form');
            			}
            			if(auto =='open-pmspopup'){
            				self.options.is_mini_pmspopup_loaded =true;
            				form =$('#mini-pmspopup').find('form');
            			}
            		}
            		$(document).trigger('reinitContactform', $(form));
            		self.initializedValidation(modal);
            		
            	}
            },
            error: function(response){
              console.log('Module Data Error.');
            }
    	});

       	return this;
 	},
      	initializedValidation:function(modal){
      		var self = this;
      		$(modal).find('input[name="cf7s-name"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>'); 
      		$(modal).find('input[name="cf7s-City"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>'); 
      		$(modal).find('input[name="cf7s-phone"]').after('<p><span class="emsg d-none">Invalid number! Use 10 digit numbers starting with 6, 7, 8 or 9.</span></p>'); 
      		$(modal).find('.wpcf7-checkbox').after('<p><span class="emsg d-none">Please select the service.</span></p>'); 
      	},
	     
	    events: function() {
	        var self    = this,
	        $document  = $(document);
	        var popupLoading = {
               	"popup-main": ['custom-hellobar','is_main_popup_loaded',true],
              	"mbf-search-popup": ["mbf-search-wrap",'is_mbf_search_loaded',false],
              	"mini-b2cpopup": ['mini-popup','is_mini_b2cpopup_loaded','open-b2cpopup'],
              	"mini-b2bpopup": ['mini-popup','is_mini_b2bpopup_loaded','open-b2bpopup'],
              	"mini-ipopopup": ['mini-popup','is_mini_ipopopup_loaded','open-ipopopup'],
              	"mini-pmspopup": ['mini-popup','is_mini_pmspopup_loaded','open-pmspopup'],
         	};
         
         	setTimeout(function() {
         		for (var key in popupLoading) {
         			modal =$('#'+key);
         			modelAction = popupLoading[key][0];
         			lodedVal = popupLoading[key][1];
         			auto = popupLoading[key][2];
         			if(!self.options[lodedVal]){
		       	  		self.ajax(modal, modelAction, auto); 
		       	  	}
         		}

         	}, 5000);	
	    	$rootnode  = $("#popup-main");
	      	$rootnode.on('show.bs.modal', function (event) {
	        		var modelAction = $(event.relatedTarget); // Button that triggered the modal
	        		var auto = false;
	        		if (! modelAction.length) {
	        			// Condition For Mini Popup
	        			if($rootnode.data('mini-popup')){
	        				modelAction = 'mini-popup';
	          				auto = $rootnode.data('mini-popup');
	        			}else{
	          				$rootnode.find('.modal-dialog').addClass('modal-lg');
	        				modelAction = 'custom-hellobar';
	          				auto = true;
	        			}
	        		}else{
	          			$rootnode.find('.modal-dialog').addClass('modal-lg');
	          			modelAction = modelAction.get(0).id;
	        		}
	        		var modal = $(this);
	        		var statusModalOpen = (modal.data('bs.modal') || {isShown: false}).isShown;
	        		if (!statusModalOpen) {
	        			if(modelAction == 'custom-hellobar'){
	        				if(!self.options.is_main_popup_loaded){
	        					self.ajax(modal, modelAction, auto);
	        				}
	        			}else if(modelAction =='mini-popup'){
	        				if(!self.options.is_mini_popup_loaded){
	        					self.ajax(modal, modelAction, auto);
	        				}
	        			}else{
	        				self.ajax(modal, modelAction, auto);
	        			}
	        		}
	      	});
	          
	      	$rootnode
	      	  .on('hidden.bs.modal', function (event) {
	          	var modal = $(this);
	          	// modal.find('.load-model').html('<div class="fb-loader loader"></div>'); 
	      	});

	      	$('#mini-b2cpopup').on('show.bs.modal', function (event) {
	       		var modelAction = $(event.relatedTarget); // Button that triggered the modal
	        	var auto = 'open-b2cpopup';
	        	modelAction = 'mini-popup';
	        	var modal = $(this); 
	    		if(!self.options.is_mini_b2cpopup_loaded){
	        		self.ajax(modal, modelAction, auto);
	        	} 
	     	}); 
	     	$('#mini-b2bpopup').on('show.bs.modal', function (event) {
	       		var modelAction = $(event.relatedTarget); // Button that triggered the modal
	        	var auto = 'open-b2bpopup';
	        	modelAction = 'mini-popup';
	        	var modal = $(this); 
	    		if(!self.options.is_mini_b2bpopup_loaded){
	        		self.ajax(modal, modelAction, auto);
	        	} 
	     	});
	     	$('#mini-ipopopup').on('show.bs.modal', function (event) {
	       		var modelAction = $(event.relatedTarget); // Button that triggered the modal
	        	var auto = 'open-ipopopup';
	        	modelAction = 'mini-popup';
	        	var modal = $(this); 
	    		if(!self.options.is_mini_ipopopup_loaded){
	        		self.ajax(modal, modelAction, auto);
	        	} 
	     	}); 
	     	$('#mini-pmspopup').on('show.bs.modal', function (event) {
	       		var modelAction = $(event.relatedTarget); // Button that triggered the modal
	        	var auto = 'open-pmspopup';
	        	modelAction = 'mini-popup';
	        	var modal = $(this); 
	    		if(!self.options.is_mini_pmspopup_loaded){
	        		self.ajax(modal, modelAction, auto);
	        	} 
	     	}); 
 			$('#mbf-search-popup').on('show.bs.modal', function (event) {
	       		var modelAction = $(event.relatedTarget); // Button that triggered the modal
	        	var auto = false;
	        	$('#mbf-search-popup').find('.modal-dialog').addClass('modal-lg');
	       		modelAction = modelAction.get(0).id;
	        	var modal = $(this);
	        	var statusModalOpen = (modal.data('bs.modal') || {isShown: false}).isShown;
	        	if (!statusModalOpen) {
	        		if(!self.options.is_mbf_search_loaded){
			       	  	self.ajax(modal, modelAction, auto); 
			     	}
	        	}
	     	});
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

// Load Easy Tab
(function($) {

  var initialized = false;

  var LoadEasyTab = {
 		defaults: {
		},

		initialize: function(opts) {
			if (initialized) {
				return this;
			}

			initialized = true;

			this.setOptions(opts)
				.events();
 			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, this.defaults, opts);
 			return this;
		},
		initializedEasyTab:function(tab_wrap){
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
			var els =tab_wrap+" .easy_tabs_container";
			$(els+' .tab_content_wrapper div.tab_content:not(:first)').hide();
			$(els+' .previous').hide();
			$(els+' .tabs li > a').click(function (e) {
	           	e.preventDefault();
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
	            var corresponding = $(this).attr("href");
	           	scroll = $(this).closest('.tabs').scrollLeft();
		        $(this).closest('.tabs').animate({'scrollLeft': scroll + position.left - 30
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
		},
		loadEasyTabHtml:function(self){
			// $('.easy_tabs_container_wrap').each(function(){
				// console.log($(this).data('id'));
		        // $rootnode  = $(document);

		        var id =$('.easy_tabs_container_wrap').data('id');
		        var tab_wrap ='#easy_tabs_container_wrap_'+id;
		        $.ajax({
		          	cache: false,
		          	crossDomain: true,
	                  	config: {
	                      	headers: {
	                         	'Access-Control-Allow-Origin': '*',
	                  	}
	                },
		         	type:"POST",
		            dataType: "html",
		        	url: global_vars.apiServerUrl + '/api/load-easy-tabs',
            
		        	// url: global_vars.ajax_url,
		           	data: {
		              	'action':'load_easy_tabs_html',
		              	'post_id':id,
		              	'tab_type':'HT',
		           	},
		           	success: function(response){
		                // sticky Widget
		                $(tab_wrap).html(response);
						setTimeout(function(){
							self.initializedEasyTab(tab_wrap);
						},500); 
		          	},
		          	error: function(response){
		                console.log('Easy Tabs loading error.'); 
		          	}
		        });
		        // return this;
			// });
		},
		events: function() {
			setTimeout(function(self){
				if($('#easy_tabs_container_vertical_wrap_1').length){
					 
				}else{
					if($('.easy_tabs_container_wrap').length){
						self.loadEasyTabHtml(self);
					}
				}
				
			},4500,this);
			return this;
		},
	 
    };
  exports.LoadEasyTab = LoadEasyTab;

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
        		// $regexPhone = /^(?:(?:\+|0{0,2})91(\s*[\ -]\s*)?|[0]?)?[6789]\d{9}|(\d[ -]?){10}\d$/;
        		$regexPhone = /^[6789]\d{9}$/;


		        $(document).on('blur','input[name="cf7s-name"],input[name="cf7s-City"]',function(key){
		        	self.formConditionCheck(this, $regexname);
		        });
		        $(document).on('keypress','input[name="cf7s-name"],input[name="cf7s-City"]',function(key){
		    		self.formConditionCheck(this, $regexname);
		    	});
		        
		        $(document).on('blur','form.wpcf7-form input[name="cf7s-phone"]',function(key){
		 		 	$(this).closest('li').find('.emsg').hide().addClass('d-none');
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
		 			var _wpcf7 =$(form).find('input[name="_wpcf7"]');
		 			console.log($(_wpcf7).val());
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
		 			if($(form).find('.wpcf7-checkbox').length){
				      	if($(form).find('.wpcf7-checkbox [type="checkbox"]').is(":checked")){
			                $(form).find('.wpcf7-checkbox').closest('li').find('.emsg').addClass('d-none');
			            }else{
			                $(form).find('.wpcf7-checkbox').closest('li').find('.emsg').removeClass('d-none');
				            Er = 4;
			            } 
		 			}
			        if(Er){
			            console.log(Er);
			        	return false;  	
			        }else{
			            $(this).prop("disabled",true);
			            $(this).after('<div class="fb-loader  mx-auto"></div>');
			            sumbmit_form_data =$(form).serialize();
			         	var submit = $(form).submit();
			            $(this).siblings('.ajax-loader').removeClass('is-active')
			         	e.preventDefault();
						return false;
			      	}
		 	  	});

		 	  	// Track Contact Form Submit Event
		    	document.addEventListener('wpcf7mailsent', function( event ) {
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

// Side Bar
(function(theme, $) {

  var initialized = false;

  var LoadSideBar = {
      defaults: {
      	wrapper: $('#site-sidebar'),
      	// stickyWidget: $('#site-sidebar .fixed-widget'),
      	stickyWidget: $('body:not(.mobile) #site-sidebar .fixed-widget'),
		offset: 50,
		brakePoint: 975,
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
      stickyWidgetCreate:function(){
      	var self    = this;
      	var stickyWidget=$('#site-sidebar .fixed-widget');
       	if ( !stickyWidget.length ) {
			return this;
		}

		// Distance from top of page to sidebar add in px
		var widgetFromTop = stickyWidget.offset().top
			// console.log('widgetFromTop'+widgetFromTop);	
		// Height of entire content area
		var contentHeight = $('#main-content').height();
		// console.log('contentHeight'+contentHeight);	
		// Height of entire sidebar
		var sidebarHeight = $('#site-sidebar').height();
		// console.log('sidebarHeight'+sidebarHeight);	
 		if (sidebarHeight < contentHeight + self.options.offset) {
		// console.log('self.options.offset'+self.options.offset);	
	    	$(window).scroll(function() {
 				// If scroll distance from top exceeds by widget distance from top, add class
	        	if ($(window).scrollTop() >= widgetFromTop) {
	        		stickyWidget.addClass('sticky-widget');
	        		//$('body').addClass('sticky-widget');
	        	}else {
				  	stickyWidget.removeClass('sticky-widget');
				   	//$('body').removeClass('sticky-widget');
				}
 				// If scroll distance from top is greater than content height remove class. 
				//Added  X-px to pull out a bit before reaching the bottom.
				if ($(window).scrollTop() > contentHeight - self.options.offset) {
				 	stickyWidget.removeClass('sticky-widget');
				 	//$('body').removeClass('sticky-widget'); 
				}

	   		});
	 	}
      },
      ajax: function(){
        var self    = this;
        $rootnode  = $(document);
        $.ajax({
          	cache: false,
         	type:"POST",
            dataType: "html",
        	url: global_vars.ajax_url,
                // async:false,
           	data: {
              	'action':'load_side_bar',
           	},
           	success: function(response){
               	$('#site-sidebar').html(response);
               	var form ='#site-sidebar form';

               	// Initalize contact form
               	$('#site-sidebar div.wpcf7 > form' ).each( function() {
					var $form = $( this );
                	self.initializedValidation($form);
					wpcf7.initForm( $form );
					if ( wpcf7.cached ) {
						wpcf7.refill( $form );
					}
				}); 
				// sticky Widget
				setTimeout(function(){
					self.stickyWidgetCreate();
				},500); 
               	
          	},
          	error: function(response){
                console.log('Side Bar error.'); 
          	}
          });
        return this;
      },
      initializedValidation:function(form){
      		var self = this;
      		$(form).find('input[name="cf7s-name"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>'); 
      		$(form).find('input[name="cf7s-City"]').after('<p><span class="emsg d-none">Use Alphabet Only!</span></p>'); 
      		$(form).find('input[name="cf7s-phone"]').after('<p><span class="emsg d-none">Invalid number! Use 10 digit numbers starting with 6, 7, 8 or 9.</span></p>'); 
      		$(form).find('.wpcf7-checkbox').after('<p><span class="emsg d-none">Please select the service.</span></p>'); 
     	},
      events: function() {
        var self    = this;
        self.ajax();   
        return this;
      },

    };
  exports.LoadSideBar = LoadSideBar;

}).apply(this, [window.theme, jQuery]);


