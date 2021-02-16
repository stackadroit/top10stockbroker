<?php

/**
 * 	Call Action to register funtion
 *  
 * 	@author Pavan JI <dropmail2pavan@gmail.com> 
 **/

add_action('admin_init', 'hhs_add_meta_boxes', 1);

/**
 * 	Tab Fileds Metabox Header
 *  
 * 	@author Pavan JI <dropmail2pavan@gmail.com> 
 **/

function hhs_add_meta_boxes() {
	add_meta_box( 'repeatable-fields', 'Tab Fields', 'hhs_repeatable_meta_box_display', array( 'tabfilter' ), 'normal', 'default');
}
/**
 * 	Tab Fileds Metabox Html 
 *  
 * 	@author Pavan JI <dropmail2pavan@gmail.com> 
 **/

function hhs_repeatable_meta_box_display() {
	global $post;
	$repeatable_fields = get_post_meta($post->ID, 'repeatable_fields', true);
	wp_nonce_field( 'hhs_repeatable_meta_box_nonce', 'hhs_repeatable_meta_box_nonce' );
	?>
	<script type="text/javascript">
	jQuery(document).ready(function( $ ){
		$( '#add-row' ).on('click', function() {
			var row = $( '.empty-row.screen-reader-text' ).clone(true);
			row.removeClass( 'empty-row screen-reader-text' );
			row.insertBefore( '#repeatable-fieldset-one tbody>tr:last' );
			return false;
		});
  	
		$( '.remove-row' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});
	});
	</script>
  
	<table id="repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			
			<th width="30%">Title</th>
			<th width="50%">URL</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
	if ( $repeatable_fields ) :
	
	foreach ( $repeatable_fields as $field ) {
	?>
	<tr>
		
		<td><input type="text" class="widefat" name="ptitle[]" value="<?php if ($field['ptitle'] != '') echo esc_attr( $field['ptitle'] ); else echo ''; ?>" /></td>
		<td><input type="text" class="widefat" name="purl[]" value="<?php if ($field['purl'] != '') echo esc_attr( $field['purl'] ); else echo ''; ?>" /></td>
	
		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	<?php
	}
	else :
	// show a blank one
	?>
	<tr>
			<td><input type="text" class="widefat" name="ptitle[]" /></td>

		<td><input type="text" class="widefat" name="purl[]" /></td>
	
		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	<?php endif; ?>
	
	<!-- empty hidden one for jQuery -->
	<tr class="empty-row screen-reader-text">
		
		<td><input type="text" class="widefat" name="ptitle[]" /></td>

		<td><input type="text" class="widefat" name="purl[]" /></td>
		  
		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	</tbody>
	</table>
	
	<p><a id="add-row" class="button" href="#">Add another</a></p>
	<?php
}

/**
 * 	Tab Fileds Metabox Value Save 
 *  
 * 	@author Pavan JI <dropmail2pavan@gmail.com> 
 **/
add_action('save_post', 'hhs_repeatable_meta_box_save');
function hhs_repeatable_meta_box_save($post_id) {
	if ( ! isset( $_POST['hhs_repeatable_meta_box_nonce'] ) ||
	! wp_verify_nonce( $_POST['hhs_repeatable_meta_box_nonce'], 'hhs_repeatable_meta_box_nonce' ) )
		return;
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
	
	if (!current_user_can('edit_post', $post_id))
		return;

	$post_type = get_post_type($post_id);
	if($post_type != 'tabfilter'){
		return;
	}
	 
   	$old = get_post_meta($post_id, 'repeatable_fields', true);

	$new = array();
	
	 $ptitle = $_POST['ptitle'];
	 $purl = $_POST['purl'];

	$count = count( $ptitle );
	
	for ( $i = 0; $i < $count; $i++ ) {
	
		if ( $ptitle[$i] != '' ) :
			$new[$i]['ptitle'] = stripslashes( strip_tags( $ptitle[$i] ) );			
		endif;
		if ( $purl[$i] != '' ) :
			$new[$i]['purl'] = stripslashes( strip_tags( $purl[$i] ) );			
		endif;
	}

	if ( !empty( $new ) && $new != $old ){
		update_post_meta( $post_id, 'repeatable_fields', $new );
	}
	elseif ( empty($new) && $old ){
		delete_post_meta( $post_id, 'repeatable_fields', $old );
	}
}
?>