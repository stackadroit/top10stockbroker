<div class="container-fluid">
    <div class="row">
      <div class="col-md-6 p-4 left-section d-none d-md-block">
        @if(!$auto_status)
      	  {!! get_post_meta( $post_id, $form_left_content, true ) !!}
        @else
          {!! get_post_meta( $post_id, $auto_popup_left_content, true ) !!}
        @endif
      </div>
      <div class="col-md-6 ml-auto p-4 border-light">
      	<div class="form-container">
          @if(!$auto_status)
            {!! get_post_meta( $post_id, $form_right_content, true ) !!} 
          @else
            {!! get_post_meta( $post_id, $auto_popup_right_content, true ) !!}
          @endif
    		  {!! do_shortcode($do_contactform) !!} 
    			<p class="d-block d-sm-none mb-0">
            @if(!$auto_status)
              {!! get_post_meta( $post_id, $form_mobile_content, true ) !!}
            @else
              {!! get_post_meta( $post_id, $auto_popup_mobile_content, true ) !!}
            @endif
    			</p>
    		</div><!-- end of form-container -->
      </div>
    </div>
</div>