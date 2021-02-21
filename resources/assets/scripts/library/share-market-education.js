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
		loadTabContent(self) {
			if($(document).find('.v_tabs_wrapper').length){
				var ele ='';
				$(document).find('.v_tabs_wrapper').each(function( index ) {
				  	var post_id =$(this).data('id');
				  	ele =this;
				  	self.ajax(ele, post_id);
				});	
				 
			}
		},
		ajax:function(ele,post_id){
			var is_mobile=0;
			if (jQuery(window).width() < 700){
		       is_mobile =1;
		    }
		    $.ajax({
				cache:false,
				crossDomain: true,
                  	config: {
                      	headers: {
                         	'Access-Control-Allow-Origin': '*',
                  	}
                },
				data:{ 
					post_id:post_id,
					is_mobile:is_mobile,
					tab_type:'VT',
				},
			  	url: global_vars.apiServerUrl +'/api/load-easy-tabs',
			  	type:'post',
			  	'dataType':'html',
			  	success:function(res){
			  		$(ele).html(res);

			  },
			  error:function(er){
			  	console.log(er);
			  }
			  
			});
		},
		events: function() {
			var self =this;
			var loaded=false;
			var is_mobile=0;
			if (jQuery(window).width() < 700){
		       is_mobile =1;
		    }
		    self.loadTabContent(self);
			 
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
