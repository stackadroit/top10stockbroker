// GoldSilverRateCalculator
(function($) {

  var initialized = false;

  var GoldSilverRateCalculator = {
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
      
      ajax: function(ele,p_id, type, carat, unit, unit_type,g_timeline){
        var self    = this; 
        $.ajax({
              cache: false,
              type:"POST",
              dataType: "html",
              url: global_vars.ajax_url,
              data: {
                  'action':'gold_silver_unit_calculate_jfunc',
                  'p_id':p_id,
                  'type':type,
                  'carat':carat,
                  'unit':unit,
                  'unit_type':unit_type,
                  'g_timeline':g_timeline,
              },
            success: function(response){
               $(ele).find('.get_gold_silver_unit_result').html(response);
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
          $rootnode.on('click','.getGoldSilverUnitCalculatedResult',function(e){
              e.preventDefault();
              var ele =$(this).closest('form');
              var type =$(ele).find('[name="type"]').val();
              var p_id =$(ele).find('[name="p_id"]').val();
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
               
              if(p_id ==''){
                alert('Select City / States.');
                return false;
              }
              
              if(unit_type ==''){
                alert('Select Unit type.');
                return false;
              }
              $(this).after('<div class="fb-loader loader mx-auto" style="margin-top:20px"></div>');
              self.ajax(ele,p_id,type,carat,unit,unit_type,g_timeline); 
              return false;
          });
        return this;
      },

    };
  exports.GoldSilverRateCalculator = GoldSilverRateCalculator;

}).apply(this, [jQuery]);