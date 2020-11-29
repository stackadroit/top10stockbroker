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

// Calculator shotcodes
add_shortcode( 'real_rate_of_return_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.real_rate_of_return_calculator';

    // Echo the shortcode blade template
        return \App\template($template, $data);
});

add_shortcode( 'inflation_rate', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.inflation_rate';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'return_on_investment_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.return_on_investment_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'return_on_equity_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.return_on_equity_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'return_on_assets_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.return_on_assets_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'retention_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.retention_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'receivables_turnover_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.receivables_turnover_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'quick_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.quick_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'profitability_index_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.profitability_index_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'payback_period_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.payback_period_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'operating_margin_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.operating_margin_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'net_working_capital_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.net_working_capital_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'net_profit_margin_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.net_profit_margin_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'inventory_turnover_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.inventory_turnover_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'interest_coverage_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.interest_coverage_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'gross_profit_margin_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.gross_profit_margin_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'free_cashflow_to_firm_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.free_cashflow_to_firm_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'free_cashflow_to_equity_ratio', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.free_cashflow_to_equity_ratio';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'debt_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.debt_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'debt_equity_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.debt_equity_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'debt_coverage_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.debt_coverage_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'days_inventroy_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.days_inventroy_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'current_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.current_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'contribution_margin_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.contribution_margin_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'average_collection_period_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.average_collection_period_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'assets_turnover_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.assets_turnover_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'assets_sale_ratio_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.assets_sale_ratio_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'risk_premium', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.risk_premium';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'price_to_sale_ratio', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.price_to_sale_ratio';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'price_to_earning', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.price_to_earning';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'holding_period_return', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.holding_period_return';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'geometric_mean_return', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.geometric_mean_return';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'future_value_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.future_value_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'present_value_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.present_value_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'zero_coupon_bond_value', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.zero_coupon_bond_value';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'zero_coupon_be_yield_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.zero_coupon_be_yield_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'yield_maturity', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.yield_maturity';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'total_stock_return_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.total_stock_return_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'tax_equivlent_yield_calculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.tax_equivlent_yield_calculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'pv_with_constant_growth', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.pv_with_constant_growth';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'pv_stock_with_zero_growth', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.pv_stock_with_zero_growth';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'pricetobookvalue', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.pricetobookvalue';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'prefferedstock', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.prefferedstock';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'netassetvalue', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.netassetvalue';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'estimatedearnings', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.estimatedearnings';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'equitymultiplier', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.equitymultiplier';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'bidaskspreadcalculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.bidaskspreadcalculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'simpleinterest', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.simpleinterest';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'compoundinterest', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.compoundinterest';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'bondequivalentyieldcalculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.bondequivalentyieldcalculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'bookvaluepershare', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.bookvaluepershare';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'capitalassetpricingmodal', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.capitalassetpricingmodal';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'capitalgainyield', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.capitalgainyield';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'currentyield', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.currentyield';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'dilutedearningspershare', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.dilutedearningspershare';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'dividendpayoutratio', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.dividendpayoutratio';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'dividendyieldstock', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.dividendyieldstock';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'dividendpershare', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.dividendpershare';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'earningpershare', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.earningpershare';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'grahmcalculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.grahmcalculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'sipcalculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.sipcalculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'futurevaluecalculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.futurevaluecalculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'onetimeinvestmentcalculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.onetimeinvestmentcalculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode( 'targetcorpuscalculator', function ( $atts ) {

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'title' => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.calculator.targetcorpuscalculator';

    // Echo the shortcode blade template
    return \App\template($template, $data);
});

// quicker slider 
add_shortcode('quickerslider', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.quickerslider';


    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('goldInvestmentCalculator', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => '',
        'title'   =>'Gold Investment Calculator - ROI Calculator',
        'city' => '',
        'type'=> '',
        'caret' => ''
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.gold_investment_calculator';

    if (is_admin()) {
        return "";
    }

    if($data['type'] ==1){
        $data['div_id'] = $data['caret'] . "_gold_investment_calculator_" . $data['id'] ."_".  $data['type'];
    }else{
        $data['div_id'] = "silver_investment_calculator_" . $data['id'] . "_" . $data['type'];
    }

    $data['josndata'] = $data;

    if($data['type'] ==1){
        $data['cities'] = get_GoldCityStateLists();
    }else{
        $data['cities'] = get_SilverCityStateLists();
    }

    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('GoldRateComparison', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => '',
        'title'   =>'Gold Rate Comparison',
        'caret' => '',
        'city' => '',
        'type' => ''
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.gold_rate_comparison';

    if (is_admin()) {
        return "";
    }

    $data['div_id'] = "_gold_rate_comparison_" . $data['id'] . "_" . $data['type'];
    $data['cities'] = get_GoldCityStateLists();

    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('goldsilverlast15', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => '',
        'title'   =>'Summary (22 Ct Gold/10 gram)',
        'city' => '',
        'type'=> '',
        'carret' => ''
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.gold_silver_last15';

    global $wpdb;
    $data['gs_val'] =  $wpdb->get_results( "SELECT * FROM gold_silver_rate  WHERE `page_id` = " . $data['id'] . " and `type` = '" . $data['type'] . "'  ORDER BY date DESC LIMIT 15" );


    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('goldsilverpricetoday', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => '',
        'title'   =>'Summary (22 Ct Gold/10 gram)',
        'city' => '',
        'type'=> '',
        'carret' => ''
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.goldsilverpricetoday';

    $data['div_id'] = "goldsilverpricetoday_" . $data['id'] . "_" . $data['type'] . "_" . $data['carret'];

    global $wpdb;
    $gs_val =  $wpdb->get_results( "SELECT * FROM gold_silver_rate  WHERE `page_id` = ". $data['id'] . " and `type` = '".$data['type']."'  ORDER BY date DESC  LIMIT 2" );
    
    if($data['carret'] == '22'){
        $data['today_rate1'] = $gs_val[0]->t22_1_rate; // 120
        $data['yesterday_rate1'] =  $gs_val[1]->t22_1_rate; // 110
        
        $data['today_rate10'] = $gs_val[0]->t22_10_rate; // 120
        $data['yesterday_rate10'] =  $gs_val[1]->t22_10_rate; // 110
        
        $data['today_rate100'] = $gs_val[0]->t22_100_rate; // 120
        $data['yesterday_rate100'] =  $gs_val[1]->t22_100_rate; // 110
    }
    else{
        $data['today_rate1'] = $gs_val[0]->t24_1_rate; // 120
        $data['yesterday_rate1'] =  $gs_val[1]->t24_1_rate; // 110
        
        $data['today_rate10'] = $gs_val[0]->t_24_10_rate; // 120
        $data['yesterday_rate10'] =  $gs_val[1]->t_24_10_rate; // 110
        
        $data['today_rate100'] = $gs_val[0]->t_24_100_rate; // 120
        $data['yesterday_rate100'] =  $gs_val[1]->t_24_100_rate; // 110
    }

        $data['diff1'] = $data['today_rate1'] - $data['yesterday_rate1'];
        $data['diff10'] = $data['today_rate10'] - $data['yesterday_rate10'];
        $data['diff100'] = $data['today_rate100'] - $data['yesterday_rate100'];

    if($data['today_rate1'] == $data['yesterday_rate1']){
        $data['diff_class1'] = 'black-Stable';
        $data['per1'] = 'Stable';
    }elseif( $data['today_rate1'] > $data['yesterday_rate1']){
        $data['diff_class1'] = 'geen-value';
        $data['per1'] = 'Improve';
    }else {
        $data['$diff_class1'] = 'red-value';
        $data['per1'] = 'Down';
    }

    if($data['today_rate10'] == $data['yesterday_rate10']){
        $data['diff_class1'] = 'black-Stable';
        $data['$per10'] = 'Stable';
    }elseif( $data['today_rate10'] > $data['yesterday_rate10']) {
        $data['diff_class10'] = 'geen-value';
        $data['per10'] = 'Improve';
    }
    else {
        $data['diff_class10'] = 'red-value';
        $data['per10'] = 'Down';
    }

    if($data['today_rate100'] == $data['yesterday_rate100']){
        $data['diff_class1'] = 'black-Stable';
        $data['per100'] = 'Stable';
    }elseif( $data['today_rate100'] > $data['yesterday_rate100']) {
        $data['diff_class100'] = 'geen-value';
        $data['per100'] = 'Improve';
    }else{
        $data['diff_class100'] = 'red-value';
        $data['per100'] = 'Down';
    }

    $data['diff_per1'] = ( ($data['today_rate1'] - $data['yesterday_rate1']) / $data['yesterday_rate1'] ) * 100;
    $data['diff_per10'] = ( ($data['today_rate10'] -$data['yesterday_rate10']) / $data['yesterday_rate10'] ) * 100;
    $data['diff_per100'] = ( ($data['today_rate100'] - $data['yesterday_rate100']) / $data['yesterday_rate100']) * 100;

    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('goldsilversummary', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => '',
        'title'   =>'Summary (22 Ct Gold/10 gram)',
        'city' => '',
        'type'=> '',
        'carret' => ''
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.goldsilversummary';

    global $wpdb;
    $gs_val =  $wpdb->get_results( "SELECT * FROM gold_silver_rate  WHERE `page_id` = ".@$data['id']. " and `type` = '".$data['type']."'  ORDER BY date DESC  LIMIT 2" );

    if($data['carret'] == '22'){
        $data['today_rate'] = $gs_val[0]->t22_10_rate; // 120
        $data['yesterday_rate'] =  $gs_val[1]->t22_10_rate; // 110
    }
    else{
        $data['today_rate'] = $gs_val[0]->t_24_10_rate; // 120
        $data['yesterday_rate'] =  $gs_val[1]->t_24_10_rate; // 110
    }

    $data['diff'] = $data['today_rate'] - $data['yesterday_rate'];

    if($data['diff'] > 0){
        $data['class_style'] = 'geen-value';
        $data['arrowclass'] = "fa-angle-up";
    }elseif($data['diff'] < 0){ 
        $data['class_style'] = 'red-value';
        $data['arrowclass'] = "fa-angle-down";
    }else{
        $data['class_style'] = 'black-value';
        $data['arrowclass'] = "fa-angle-right";
    }

    $data['diff_per'] = ( ($data['today_rate'] - $data['yesterday_rate']) / $data['yesterday_rate'] ) * 100;
    
    if($data['type'] ==2){
        $data['typeName'] = 'Silver';
    }else{
        $data['typeName'] = 'Gold';
    }

    $data['title'] = date('dS M Y',strtotime($gs_val[0]->date)).' - ' . $data['title'];

    $data['div_id'] = "gold_summery_data_" . $data['id'] ."_". $data['type'];
    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('goldsilverpricegraph', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => 'goldsilverpricegraph_',
        'title'   =>'Summary (22 Ct Gold/10 gram)',
        'city' => '',
        'type'=> '',
        'carret' => ''
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.goldsilverpricegraph';

    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('brokerslider', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.brokerslider';

    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('tabfilter', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => '',
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.tabfilter';

    $data['get_meta'] = get_post_meta( $data['id'] , 'repeatable_fields' , true );
    
    global $wp;
    $data['current_url'] = home_url( add_query_arg( array(), $wp->request ) );

    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('LIVEPRICEWIDGETHTML', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.live_price_widget_html';

    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('socialPostShare', function ($atts){ 

    // Extract the shortcode attributes
    $data = shortcode_atts( array(
    ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.social_post_share';

    $data['ele_permalink'] = get_the_permalink();
    $data['ele_title'] = get_the_title();

    // Echo the shortcode blade template
    return \App\template($template, $data);

});

add_shortcode('EasyTabWidget', function ($atts){ 
    global $wpdb;
    $post_id =$atts['id'];
    // Extract the shortcode attributes
    $data = shortcode_atts( array(
    ), $atts);
    // Set the template we're going to use for the Shortcode
    $data['ele_permalink'] = get_the_permalink();
    $data['ele_title'] = get_the_title();
    $data['post_id'] = $post_id;
    $data['tabs_count'] = get_post_meta($post_id,'pa1_wp_easy_tabs_count',true);
    $data['tabs_data'] = unserialize(get_post_meta($post_id,'pa1_wp_easy_tabs_data',true));
    $data['totalCount'] =count($data['tabs_data']);
    $data['tabs_type'] = get_post_meta($post_id,'pa1_wp_easy_tabs_type',true);
    // print_r($data);
    // exit;
    foreach ($data['tabs_data'] as $idx => $tabs) {
         print_r($value);
         if($tabs['tab_option'] == 1){
            $tabs_post_type =@$tabs['tabs_post_type'];
            $tabs_category  =@$tabs['tabs_category'];
            $args =array(
                'post_type'=>$tabs_post_type,
                'order'=>'DESC',
                'orderby'=>'date',
                'numberposts' =>10,
            );
            if($tabs_category){
                $args['category']= $tabs_category;
            }
            $tabData =get_posts($args);
            foreach ($tabData as $key => $pd) {
                $tabs_link[] =$pd->post_title;
                $tabs_link_to[] =get_the_permalink($pd->ID);
                $post_modified[] =date('F j, Y',strtotime($pd->post_modified));
                $categories[] =get_the_category_list(',','', $pd->ID);
            }
            $data['tabs_data'][$idx]['tabs_link']=$tabs_link;
            $data['tabs_data'][$idx]['tabs_link_to']=$tabs_link_to;
            $data['tabs_data'][$idx]['post_modified']=$post_modified;
            $data['tabs_data'][$idx]['categories']=$categories;
         }
         // echo '<pre>';
         // print_r($data);
         // exit; 
    }
    // Echo the shortcode blade template
    if($data['tabs_type'] =='VT'){
        $template = 'shortcodes.easy_tab_vertical_widget';
    }else{
        $template = 'shortcodes.easy_tab_widget';
    }
        return \App\template($template, $data);
});

add_shortcode('ShareMarketEducation', function ($atts){ 

    $post_id = @$atts['id'];
    // Extract the shortcode attributes
    $data = shortcode_atts( array(
    ), $atts);
    // Set the template we're going to use for the Shortcode

    $data['ele_permalink'] = get_the_permalink();
    $data['ele_title'] = get_the_title();
    
    // Echo the shortcode blade template
    $template = 'shortcodes.share_market_education';
    return \App\template($template, $data);
});

add_shortcode('broker_city_search', function ($atts){ 

    $post_id = @$atts['id'];
    // Extract the shortcode attributes
    $data = shortcode_atts( array(
    ), $atts);
    $brokers = get_terms( 'brokers', array(
        'hide_empty' => true,
        'parent' => 0   
    ) );
    $locations = get_terms( 'locations', array(
        'hide_empty' => true,
    ));
    // Set the template we're going to use for the Shortcode

    $data['ele_permalink'] = get_the_permalink();
    $data['ele_title'] = get_the_title();
    $data['brokers'] = $brokers;
    $data['locations'] = $locations;
    
    // Echo the shortcode blade template
    $template = 'shortcodes.broker_city_search';
    return \App\template($template, $data);
});
add_shortcode('location_search_pincode', function ($atts){ 
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'city' => ''
    ), $atts);
     
    $data['ele_permalink'] = get_the_permalink();
    $data['ele_title'] = get_the_title();
     
    // Echo the shortcode blade template
    $template = 'shortcodes.location_search_pincode';
    return \App\template($template, $data);
});

/**
*   Shortcode form Stock Broker Internale linking.
*/
add_shortcode('STOCKBROKERSLINKS', function ($atts){ 
    $data = shortcode_atts( array(
        'zone' => '',
    ), $atts, 'bartag' );
    $posts_array = get_posts(
        array(
            'posts_per_page' =>-1,
            'post_type' => 'stock-brokers',
            'order' => 'ASC',
            'orderby' => 'title',
            'tax_query' => array(
                array(
                    'taxonomy' => 'zones',
                    'field' => 'slug',
                    'terms' => $data['zone'],
                )
            )
        )
    ); 
    $data['ele_permalink'] = get_the_permalink();
    $data['ele_title'] = get_the_title();
    $data['posts_array'] = $posts_array ;
     
    // Echo the shortcode blade template
    $template = 'shortcodes.stock-brokers-links';
    return \App\template($template, $data);
});