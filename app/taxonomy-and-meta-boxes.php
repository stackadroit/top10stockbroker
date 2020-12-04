<?php
 /**
     * Register Taxonomy for Share Market
     */
    
    add_action( 'init',   function () {
        $labels = array(
            'name'                       => _x( 'SM Categories', 'Taxonomy General Name', 'snt' ),
            'singular_name'              => _x( 'SM Category', 'Taxonomy Singular Name', 'snt' ),
            'menu_name'                  => __( 'SM Category', 'snt' ),
            'all_items'                  => __( 'All Items', 'snt' ),
            'parent_item'                => __( 'Parent Item', 'snt' ),
            'parent_item_colon'          => __( 'Parent Item:', 'snt' ),
            'new_item_name'              => __( 'New Item Name', 'snt' ),
            'add_new_item'               => __( 'Add New Item', 'snt' ),
            'edit_item'                  => __( 'Edit Item', 'snt' ),
            'update_item'                => __( 'Update Item', 'snt' ),
            'view_item'                  => __( 'View Item', 'snt' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'snt' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'snt' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'snt' ),
            'popular_items'              => __( 'Popular Items', 'snt' ),
            'search_items'               => __( 'Search Items', 'snt' ),
            'not_found'                  => __( 'Not Found', 'snt' ),
            'no_terms'                   => __( 'No items', 'snt' ),
            'items_list'                 => __( 'Items list', 'snt' ),
            'items_list_navigation'      => __( 'Items list navigation', 'snt' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => false,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => false,
            // 'rewrite'                    => array('slug' => 'resources')
        );
        register_taxonomy( 'sm-category', array( 'share-market' ), $args );

    }, 0 );
    /**-----------------------------------------------------
	 * Output the HTML for the metabox.
	 /-----------------------------------------------------*/
    function _pa1_share_market_indices_code_fun() {
	    global $post;
	    // Nonce field to validate form request came from current site
	    wp_nonce_field( basename( __FILE__ ), 'indices_fields' );
	    // Get the location data if it's already been entered
	    $indices_code = get_post_meta( $post->ID, 'indices_code', true );
	    // Output the field
	    echo '<input type="text" name="indices_code" value="' . esc_textarea( $indices_code )  . '" class="widefat">';
	}
	/**
	 * Save the metabox data
	 */
	add_action( 'save_post', function ( $post_id, $post ) {

	    // Return if the user doesn't have edit permissions.
	    if ( ! current_user_can( 'edit_post', $post_id ) ) {
	        return $post_id;
	    }
	    // Verify this came from the our screen and with proper authorization,
	    // because save_post can be triggered at other times.
	    if ( ! isset( $_POST['indices_code'] ) || ! wp_verify_nonce( $_POST['indices_fields'], basename(__FILE__) ) ) {
	        return $post_id;
	    }
	    // Now that we're authenticated, time to save the data.
	    // This sanitizes the data from the field and saves it into an array $events_meta.
	    $events_meta['indices_code'] = esc_textarea( $_POST['indices_code'] );
	    // Cycle through the $events_meta array.
	    // Note, in this example we just have one item, but this is helpful if you have multiple.
	    foreach ( $events_meta as $key => $value ) :
	        // Don't store custom data twice
	        if ( 'revision' === $post->post_type ) {
	            return;
	        }
	        if ( get_post_meta( $post_id, $key, false ) ) {
	            // If the custom field already has a value, update it.
	            update_post_meta( $post_id, $key, $value );
	        } else {
	            // If the custom field doesn't have a value, add it.
	            add_post_meta( $post_id, $key, $value);
	        }
	        if ( ! $value ) {
	            // Delete the meta key if there's no value
	            delete_post_meta( $post_id, $key );
	        }
	    endforeach;
	}, 1, 2 );


    /**
     * Register Taxonomy for Stock Brokers
     */
    add_action( 'init',  function () {

        $labels = array(
            'name'                       => _x( 'Zones', 'Taxonomy General Name', 'snt' ),
            'singular_name'              => _x( 'Zone', 'Taxonomy Singular Name', 'snt' ),
            'menu_name'                  => __( 'Zones', 'snt' ),
            'all_items'                  => __( 'All Zones', 'snt' ),
            'parent_item'                => __( 'Parent Zone', 'snt' ),
            'parent_item_colon'          => __( 'Parent Zone:', 'snt' ),
            'new_item_name'              => __( 'New Zone Name', 'snt' ),
            'add_new_item'               => __( 'Add New Zone', 'snt' ),
            'edit_item'                  => __( 'Edit Zone', 'snt' ),
            'update_item'                => __( 'Update Zone', 'snt' ),
            'view_item'                  => __( 'View Zone', 'snt' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'snt' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'snt' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'snt' ),
            'popular_items'              => __( 'Popular Zones', 'snt' ),
            'search_items'               => __( 'Search Zones', 'snt' ),
            'not_found'                  => __( 'Not Found', 'snt' ),
            'no_terms'                   => __( 'No Zones', 'snt' ),
            'items_list'                 => __( 'Zones list', 'snt' ),
            'items_list_navigation'      => __( 'Zones list navigation', 'snt' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            // 'rewrite'                    => array('slug' => 'resources')
        );
        register_taxonomy( 'zones', array( 'stock-brokers' ), $args );

        }
    , 0 );