// GoldSilverSummary
(function($) {

  var initialized = false;

  var GoldSilverSummary = {
      defaults: {
      	wrapper: $('.gold_summery_table')
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
      
      ajax: function(){
        var self    = this;
        $rootnode  = $(document);
        var id ='';
        var title ='';
        var city ='';
        var type ='';
        var carret ='';
        var responseDiv ='';
        $rootnode.find('.gold_summery_table').each(function(e){
          id =$(this).data('id');
          title =$(this).data('title');
          city =$(this).data('city');
          type =$(this).data('type');
          carret =$(this).data('carret');
          responseDiv ='#gold_summery_data_'+id+'_'+type;
          $.ajax({
                cache: false,
                type:"POST",
                dataType: "html",
                url: global_vars.apiServerUrl + '/apiblock/react-gold-silver/get-gold-summery-data',
                // async:false,
                data: {
                  'action':'get_gold_summery_data_',
                  'id':id,
                  'title':title,
                  'city':city,
                  'type':type,
                  'carret':carret,      
              },
              success: function(response){
                 $rootnode.find(responseDiv).html(response);
              },
              error: function(response){
                console.log('Gold Rate Summary data error.'); 
              }
          });
        });
        return this;
      },

      events: function() {
        var self    = this;
        self.ajax();   
        return this;
      },

    };
  exports.GoldSilverSummary = GoldSilverSummary;

}).apply(this, [jQuery]);

// GoldSilverPriceToday
(function($) {

  var initialized = false;

  var GoldSilverPriceToday = {
      defaults: {
        wrapper: $('.goldsilverpricetoday')
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
      
      ajax: function(){
        var self    = this;
        $rootnode  = $(document);
        var id ='';
        var title ='';
        var city ='';
        var type ='';
        var carret ='';
        var responseDiv ='';
        $rootnode.find('.goldsilverpricetoday').each(function(e){
          id =$(this).data('id');
          title =$(this).data('title');
          city =$(this).data('city');
          type =$(this).data('type');
          carret =$(this).data('carret');
          $.ajax({
                cache: false,
                type:"POST",
                dataType: "html",
                // url: global_vars.ajax_url,
                url: global_vars.apiServerUrl + '/apiblock/react-gold-silver/get-gold-silver-today-price',
                async:false,
                data: {
                  'action':'get_gold_silver_today_price',
                  'id':id,
                  'title':title,
                  'city':city,
                  'type':type,
                  'carret':carret,      
              },
              success: function(response){
                responseDiv ='#goldsilverpricetoday_'+id+'_'+type+'_'+carret;
                 $rootnode.find(responseDiv).html(response);
              },
              error: function(response){
                console.log('Gold Silver Price Today Error.'); 
              }
          });
        });
        return this;
      },

      events: function() {
        var self    = this;
        self.ajax();   
        return this;
      },

    };
  exports.GoldSilverPriceToday = GoldSilverPriceToday;

}).apply(this, [jQuery]);

// GoldSilverLast15
(function($) {

  var initialized = false;

  var GoldSilverLast15 = {
      defaults: {
        wrapper: $('.goldsilverpricelast15')
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
      
      ajax: function(){
        var self    = this;
        $rootnode  = $(document);
        var id ='';
        var title ='';
        var city ='';
        var type ='';
        var carret ='';
        var responseDiv ='';
        $rootnode.find('.goldsilverpricelast15day').each(function(e){
          id =$(this).data('id');
          title =$(this).data('title');
          city =$(this).data('city');
          type =$(this).data('type');
          $.ajax({
                cache: false,
                type:"POST",
                dataType: "html",
                // url: global_vars.ajax_url,
                url: global_vars.apiServerUrl + '/apiblock/react-gold-silver/get-gold-silver-last15day-price',
                // async:false,
                data: {
                  'action':'get_gold_silver_last15day_price',
                  'id':id,
                  'title':title,
                  'city':city,
                  'type':type,
                  'carret':carret,      
              },
              success: function(response){
                responseDiv ='#goldsilverpricelast15day_'+id+'_'+type;
                 $rootnode.find(responseDiv).html(response);
              },
              error: function(response){
                console.log('Gold Silver Price Last 15 day Error.'); 
              }
          });
        });
        return this;
      },

      events: function() {
        var self    = this;
        self.ajax();   
        return this;
      },

    };
  exports.GoldSilverLast15 = GoldSilverLast15;

}).apply(this, [jQuery]);