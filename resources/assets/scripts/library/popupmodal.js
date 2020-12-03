import QuickerSlider from '../components/quickerslider';
import React, { Component } from "react";
import ReactDOM from 'react-dom';

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
            },
            error: function(response){
              console.log('Module Data Error.'); 
            }
        });

          return this;
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
          modelAction = 'custom-hellobar';
          auto = true;
        }else{
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
          modal.find('.load-model').html(' <div class="fb-loader loader"></div>'); 
      });

      var intervalID = setInterval( function(){ 
        $rootnode.modal('show');
      },60000); 
          // clearInterval(intervalID); // Will clear the timer.
        return this;
      },

    };
  exports.ModalPopup = ModalPopup;

}).apply(this, [jQuery]);