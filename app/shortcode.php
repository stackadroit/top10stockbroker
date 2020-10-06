<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;


add_shortcode('brokercomparison', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
    ), $atts, 'brokercomparison' );

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.brokercomparison';

    global $wpdb;
    $posts = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title,post_name FROM {$wpdb->posts} WHERE post_type = %s and post_status = 'publish'", 'broker-comparison' ), ARRAY_A );

    foreach($posts as $post){
        $post_name = explode('-vs-', $post['post_name']);
        $broker1[] = $post_name[0];
        $broker2[] = $post_name[1];
    }

    $ubroker1[] = str_replace('-',' ',array_unique($broker1));
    $ubroker2[] = str_replace('-',' ',array_unique($broker2));

    $data['ubroker1']  = $ubroker1[0];
    $data['ubroker2']  = $ubroker2[0];

    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('menudropdown', function ($atts, $content = null) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'menu' => 'Full Service Dropdown',
        'title' =>'Choose Full Service'
    ), $atts, 'menudropdown' );

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.menudropdown';

    // Set up template data
    // $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
    //     return apply_filters("sage/template/{$class}/data", $data, $template);
    // }, []);


    $data['el_id'] = uniqid();
    $data['current_menu'] = esc_html( $atts['menu'] );
    $data['array_menu'] = wp_get_nav_menu_items($data['current_menu'], array( 'order' => 'ASC', 'orderby' => 'title'));
    $data['requested_url'] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}";

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode('invCalculator', function ($atts) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
    ), $atts, 'invCalculator' );

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.invcalculatordetails';

    // Echo the shortcode blade template
    return \App\template($template, $data);

});
 
add_shortcode( 'BRANCHOFFICELINKS', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'zone' => '',
    ), $atts, 'bartag' );

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.branchofficelinks';

    
    global $post;
    $terms = get_the_terms($post, 'locations');

    if($terms){
        $termsid = @$terms[0]->term_id;
        $data['terms_name'] = @$terms[0]->name;
    }

    if(@$termsid){
        $posts_array = get_posts(
            array(
                'posts_per_page' =>-1,
                'post_type' => 'branches',
                'order' => 'ASC',
                'orderby' => 'title',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'locations',
                        'field' => 'term_id',
                        'terms' => @$termsid,
                    )
                )
            )
        );

        $data['intrnalLinks'] = $posts_array;
        
        $data['Lidx'] = 1;
        $data['colm'] = 1;

        // Echo the shortcode blade template
        return \App\template($template, $data);
    }

    return '';
});
