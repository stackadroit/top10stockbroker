// GoldRateComparison
(function($) {

  var initialized = false;

  var GoldRateComparison = {
      defaults: {
      	wrapper: $('.gold-investment-calculator')
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
      
      ajax: function(ele,type,p_id1,p_id2,p_id3,unit,g_timeline,unit_type,carat){
        var self    = this; 
        $.ajax({
              cache: false,
              type:"POST",
              dataType: "html",
              url: global_vars.ajax_url,
              data: {
                        'action':'gold_silver_unit_compare_calculate_jfunc',
                        'p_id1':p_id1,
                        'p_id2':p_id2,
                        'p_id3':p_id3,
                        'type':type,
                        'carat':carat,
                        'unit':unit,
                        'unit_type':unit_type,
                        'g_timeline':g_timeline,
                         
            },
            success: function(response){
               $(ele).find('.get_gold_silver_compare_unit_result').html(response);
               $(ele).find('.fb-loader').remove(); 
            },
            error: function(response){
              $(ele).find('.fb-loader').remove(); 
              console.log('Gold Rate Calculator Calculator Error.'); 
            }
        });
        return this;
      },

      events: function() {
        var self    = this,
          $rootnode  = $(document);

          $rootnode.on('click','.getGoldSilverUnitCompareCalculatedResult',function(e){
              e.preventDefault();
              var ele =$(this).closest('form');
              var type =$(ele).find('[name="type"]').val();
              var p_id1 =$(ele).find('[name="p_id1"]').val();
              var p_id2 =$(ele).find('[name="p_id2"]').val();
              var p_id3 =$(ele).find('[name="p_id3"]').val();
              if(p_id1 =='' && p_id2 =='' && p_id3 ==''){
                alert('Select at least one City / States.');
                return false;
              }
              var unit =$(ele).find('[name="unit"]').val();
              var g_timeline =$(ele).find('[name="g_timeline"]').val();
              var unit_type =$(ele).find('[name="unit_type"]').val();
              var carat ='';
              if(type ==1){
                carat =$(ele).find('[name="carat"]').val();
                if(carat ==''){
                  alert('Select Carat.');
                  return false;
                }
              }
               
              if(unit_type ==''){
                alert('Select Unit type.');
                return false;
              }
              $(this).after('<div class="fb-loader loader mx-auto" style="margin-top:20px"></div>');
              self.ajax(ele,type,p_id1,p_id2,p_id3,unit,g_timeline,unit_type,carat); 
              return false;
          });
        return this;
      },

    };
  exports.GoldRateComparison = GoldRateComparison;

}).apply(this, [jQuery]);