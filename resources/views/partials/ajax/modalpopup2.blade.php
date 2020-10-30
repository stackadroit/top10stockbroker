<div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-6 p-4">
      	{!! get_post_meta( $post_id, $form_left_content, true ) !!}
      </div>
      <div class="col-md-6 ml-auto p-4 border-light">
      	<div class="form-container">
		   {!! get_post_meta( $post_id, $form_right_content, true ) !!} 
		   @php do_action($contactform) @endphp
			 <p class="show-mobile bdr">
			 	{!! get_post_meta( $post_id, $form_mobile_content, true ) !!}
			 </p>
		</div><!-- end of form-container -->
      </div>
    </div>
</div>