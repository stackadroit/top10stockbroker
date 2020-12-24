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

/**
 * Register Taxonomy for Broker Comparison
 */
add_action( 'init', 'create_comparison_tax' );

function create_comparison_tax() {
    register_taxonomy( 
            'broker-comparison_tag', 
            'broker-comparison', 
            array( 
                'hierarchical'  => false, 
                'label'         => __( 'Tags', 'CURRENT_THEME' ), 
                'singular_name' => __( 'Tag', 'CURRENT_THEME' ), 
                'rewrite'       => true, 
                'query_var'     => true 
            )  
        );
}


// add tags in Brokerage Calculator
add_action( 'init', 'create_calculator_tax' );

function create_calculator_tax() {
    register_taxonomy( 
            'brokerage-calculator_tag', 
            'brokerage-calculator', 
            array( 
                'hierarchical'  => false, 
                'label'         => __( 'Tags', 'CURRENT_THEME' ), 
                'singular_name' => __( 'Tag', 'CURRENT_THEME' ), 
                'rewrite'       => true, 
                'query_var'     => true 
            )  
        );
}

/**
*   tab filter in  Metabox in CPTS
*/
add_action('admin_init', 'tab_filter_add_meta_boxes', 1);
function tab_filter_add_meta_boxes() {
    add_meta_box( 'tab_filter', 'Tab Fields', 'tab_filter_meta_box_display', array( 'share-market','share-price','branches', 'brokerage-calculator','margin-calculator', 'broker-comparison', 'page' , 'post' , 'state','option-chain','futures' ,'news','sub-brokers','stock-broker'), 'normal', 'default');
}
/**
*   Function to display in backend.
*/
function tab_filter_meta_box_display() {
    global $post;
    $tab_filter_id = get_post_meta( $post->ID, 'tab_filter_id', true);
    wp_nonce_field( 'tab_filter_meta_box_nonce2', 'tab_filter_meta_box_nonce2' );

    $args = array(
      'numberposts' => -1,
      'post_type'   => 'tabfilter'
    );
     
    $tab_post = get_posts( $args );
    ?>
    <select name="tab_filter_id">
        <option value="0" > Select Filter Tab </option>
        <?php
            if( $tab_post ){
                foreach( $tab_post as $post ){
                     setup_postdata( $post ); 
                     $selct_id = ( $tab_filter_id == $post->ID ) ? 'selected' : '';
                    echo '<option value="'.$post->ID.'" '.$selct_id.'>'.get_the_title().'</option>';
                }
                  wp_reset_postdata();
            }
        ?>
    </select>
    

    
    <?php
}

add_action('save_post', 'tab_filter_meta_box_save');
function tab_filter_meta_box_save( $post_id) {
    // check autosave
    if ( wp_is_post_autosave( $post_id ) ) {
        return __( 'autosave', 'mybusiness' );
    }
    //check post revision
    if ( wp_is_post_revision( $post_id ) ) {
        return __( 'revision', 'mybusiness' );
    }
    // check permissions
    if ( isset( $_POST['post_type'] ) && 'page' == sanitize_text_field( wp_unslash( $_POST['post_type'] ) ) ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return __( 'cannot edit page' , 'mybusiness' );
        }
    } elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
        return __( 'cannot edit post', 'mybusiness' );
    }
    $old = get_post_meta( $post_id, 'tab_filter_id', true);
    $new = array();
    $tab_filter_id = $_POST['tab_filter_id'];
    $new = stripslashes( strip_tags( $tab_filter_id ) );
    if ( !empty( $new ) && $new != $old ){
        update_post_meta( $post_id, 'tab_filter_id', $new );
    }
    elseif ( empty($new) && $old ){
        update_post_meta( $post_id, 'tab_filter_id', $old );
    }
}