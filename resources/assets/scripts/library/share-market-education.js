
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
			alert('ddd');
		    
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
			// var els ="#v_tabs_wrapper_56975";
			var els =".v_tabs_wrapper";
			 
			$(els+" .v_tab_content:not(:first)").hide();
            if ($(window).width() >= 768) {
                $(els+" .v_tab_content:nth-child(2)").show();
            }
				/* if in tab mode */
                    $(els+" ul.v_tabs li").click(function () {
                    	$(this).closest('.v_tabs_wrapper').find('.v_tab_content').hide();
                        var activeTab = jQuery(this).attr("rel");
                        $(this).closest('.v_tabs_wrapper').find("#" + activeTab).fadeIn();
                        $(this).closest('.v_tabs_wrapper').find("ul.v_tabs li").removeClass("v_active");
                        $(this).addClass("v_active");
                        $(this).closest('.v_tabs_wrapper').find(".v_tab_drawer_heading").removeClass("d_active");
                        $(this).closest('.v_tabs_wrapper').find(" .v_tab_drawer_heading[rel^='" + activeTab + "']").addClass("d_active");
                    });                    
                    $(els+" .v_tab_container").css("min-height", function () {
                        return $(els+" .v_tabs").outerHeight() + 50;
                    });
                    /* if in drawer mode */
                    $(els+" .v_tab_drawer_heading").click(function () {
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
			 
			return this;
		},
	 
    };
  exports.ShareMarketEducation = ShareMarketEducation;

}).apply(this, [jQuery]);