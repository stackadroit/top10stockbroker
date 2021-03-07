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
                url: global_vars.ajax_url,
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
                console.log('Gold Rate Calculator Calculator Error.'); 
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