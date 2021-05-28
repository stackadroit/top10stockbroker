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

add_shortcode('GoldInvestmentCalculator', function ($atts){ 

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
add_shortcode('GoldSilverRateCalculator', function ($atts){ 

    // Extract the shortcode attributes
    if(!is_admin()){
        $data =shortcode_atts( 
            array(
                'id'      => '',
                'title'   =>'Gold Rate Comparison',
                'city' => '',
                'caret' => '',
                'type' => ''
                ),
                $atts 
            );
         
        $div_id=$caret."_gold_silver_rate_calculator_".@$data['id']."_".@$data['type'];
        if(@$data['type']){
            $cities = get_GoldCityStateLists();
        }else{
            $cities = get_SilverCityStateLists();
        }
        // Set the template we're going to use for the Shortcode
        $template = 'shortcodes.gold-silver.gold_silver_rate_calculator';
        $data['div_id'] = $div_id;
        $data['cities'] = $cities;
        // Echo the shortcode blade template
        return \App\template($template, $data);
    }
});

/*****************************************************************
                    Gold Rate Calculator
******************************************************************/
function getUnitConvertedAmount($unit,$unit_type,$onegrmPrice){
    $utypePrice=0;
    switch ($unit_type) {
        case 'ounce':
            $utypePrice =28.3495;
            break;
        case 'gram':
            $utypePrice =1;
            break;
        case 'kilo':
            $utypePrice =1000;
            break;
        case 'tola':
            $utypePrice =11.3398;
            break;
        case 'baht':
            $utypePrice =15.224;
            break;
        case 'tael':
            $utypePrice =37.7994;
            break;
        case 'troypound':
            $utypePrice =373.242;
            break;
        case 'pound':
            $utypePrice =453.592;
            break;
        case 'pennyweight':
            $utypePrice =1.55517;
            break;
        case 'vori':
            $utypePrice =11.66;
            break;
        case 'grain':
            $utypePrice =0.0647989;
            break;
        case 'ratti':
            $utypePrice =0.182; 
            break;
        case 'masha':
            $utypePrice =0.972;
            break;
        default:
            $utypePrice =1;
            break;
    }
    $totalAmount= @(number_format(($unit*$onegrmPrice*$utypePrice),2));
    return @$totalAmount;
}

add_action("wp_ajax_gold_silver_unit_calculate_jfunc", __NAMESPACE__ . '\\gold_silver_unit_calculate_jfunc');
add_action("wp_ajax_nopriv_gold_silver_unit_calculate_jfunc", __NAMESPACE__ . '\\gold_silver_unit_calculate_jfunc');

function gold_silver_unit_calculate_jfunc(){
    global $wpdb;
    $p_id = @$_REQUEST['p_id'];
    $type = @$_REQUEST['type'];
    $carat = @$_REQUEST['carat'];
    $unit = @$_REQUEST['unit'];
    $unit_type = @$_REQUEST['unit_type'];
    $g_timeline = @$_REQUEST['g_timeline'];
    if($g_timeline =='1D'){
        $crdateQue= "SELECT * FROM gold_silver_rate  WHERE `page_id` = ".$p_id. " and `type` = '".$type."'  ORDER BY date DESC  LIMIT 1";
    }else{
        switch ($g_timeline) {
            case '1W':
                $prcdate =date("Y-m-d", strtotime("-7 days"));
                break;
            case '2W':
                $prcdate =date("Y-m-d", strtotime("-14 days"));
                break;
            case '3W':
                $prcdate =date("Y-m-d", strtotime("-21 days"));
                break;
            case '1M':
                $prcdate =date("Y-m-d", strtotime("-30 days"));
                break;
            case '3M':
                $prcdate =date("Y-m-d", strtotime("-3 month"));
                break;
            case '6M':
                $prcdate =date("Y-m-d", strtotime("-6 month"));
                break;
            case '9M':
                $prcdate =date("Y-m-d", strtotime("-9 month"));
                break;
            case '1Y':
                $prcdate =date("Y-m-d", strtotime("-365 month"));
                break;
            default:
                $prcdate =date("Y-m-d");
                break;
        }
        $crdateQue="SELECT * FROM gold_silver_rate  WHERE `page_id` = ".$p_id. " and `type` = '".$type."' AND date='".$prcdate."' LIMIT 1";
    }
    // echo $crdateQue;
    $gs_val =  $wpdb->get_row($crdateQue);
   // print_r($gs_val);
    if($type ==1){
        $cities =get_GoldCityStateLists();
        $typeName ='Gold';
        $onegrmPrice=0;
        if($carat ==22){
            $onegrmPrice=@$gs_val->t22_1_rate;
        }else{
            $onegrmPrice=@$gs_val->t24_1_rate;
        }
    }else{
        $cities =get_SilverCityStateLists();
        $typeName ='Silver';
        $onegrmPrice=0;
        $onegrmPrice=@$gs_val->t22_1_rate/10;
    }
    $totalAmount= getUnitConvertedAmount($unit,$unit_type,$onegrmPrice);
     
    $resultStr= 'Rate of <b>'.$unit.' '. @ucfirst($unit_type).' '.$typeName.' in '.@ucfirst($cities[$p_id]).'</b> is <b><span style="font-size:22px">Rs.'.@$totalAmount .'</span></b>';
    ?>
    <div class="pre-result">
        <?php echo @$resultStr; ?>
    </div>
    <?php
    exit;
}
add_shortcode('GoldSilverRateComparisonCalculator', function ($atts){ 
    // Extract the shortcode attributes
    if (is_admin()) {
        return "";
    }
    $data = shortcode_atts( 
            array(
                'id'      => '',
                'title'   =>'Gold Rate Comparison',
                'city' => '',
                'caret' => '',
                'type' => ''
            ),
            $atts 
        );

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.gold-silver.gold_silver_rate_comparison';

    $div_id=@$data['caret']."_gold_silver_rate_comparison_calculator_".$data['id']."_".$data['type'];
    $data['div_id'] =$div_id;

    if(@$data['type'] ==1){
        $data['cities'] = get_GoldCityStateLists();
    }else{
        $data['cities'] = get_SilverCityStateLists();
    }
    // Echo the shortcode blade template
    return \App\template($template, $data);

});
add_shortcode('GoldRateComparison', function ($atts){ 

    // Extract the shortcode attributes
    // print_r($atts);
    $data = shortcode_atts( array(
                'id'      => '',
                'title'   =>'Gold Rate Comparison',
                'city' => '',
                'caret' => '',
                'type' => ''
                ), $atts);

    // Set the template we're going to use for the Shortcode
    $template = 'shortcodes.gold-silver.gold_rate_comparison';

    if (is_admin()) {
        return "";
    }

    $data['div_id'] = "_gold_rate_comparison_" . $data['id'] . "_" . $data['type'];
    if($data['type'] ==1){
        $data['cities'] = get_GoldCityStateLists();
        }else{
        $data['cities'] = get_SilverCityStateLists();
    }
    // Echo the shortcode blade template
    return \App\template($template, $data);
});

add_shortcode('goldsilverlast15_inside', function ($atts){ 

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
add_shortcode('goldsilverlast15', function ($atts){ 
    ob_start();
    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => '',
        'title'   =>'Last 15 Days Gold Price',
        'city' => '',
        'type'=> '',
    ), $atts);
    $div_id = "goldsilverpricelast15day_" . $data['id'] . "_" . $data['type'];
    ?>
    <div class="goldsilverpricelast15day" id="<?php echo $div_id; ?>" data-id="<?php echo $data['id']; ?>" data-title="<?php echo $data['title']; ?>" data-city="<?php echo $data['city']; ?>" data-type="<?php echo $data['type']; ?>">
    </div>
    <?php
    return ob_get_clean();

});
add_shortcode('goldsilverpricetoday_inside', function ($atts){ 

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
add_shortcode('goldsilverpricetoday', function ($atts){ 
    ob_start();
    // Extract the shortcode attributes
    $data = shortcode_atts( array(
        'id'      => '',
        'title'   =>'Summary (22 Ct Gold/10 gram)',
        'city' => '',
        'type'=> '',
        'carret' => ''
    ), $atts);
    $id=$data['id'];
    $title=$data['title'];
    $city=$data['city'];
    $type=$data['type'];
    $carret=$data['carret'];
    $div_id = "goldsilverpricetoday_" . $data['id'] . "_" . $data['type'] . "_" . $data['carret'];
    ?>
    <div class="goldsilverpricetoday" id="<?php echo $div_id; ?>" data-id="<?php echo $id; ?>" data-title="<?php echo $title; ?>" data-city="<?php echo $city; ?>" data-type="<?php echo $type; ?>" data-carret="<?php echo $carret; ?>">
    </div>
    <?php
    return ob_get_clean();
});
add_shortcode('goldsilversummary_inside', function ($atts){ 

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
add_shortcode('goldsilversummary', function ($atts){ 
    global $wpdb;
    ob_start();

    $data = shortcode_atts( array(
        'id'      => '',
        'title'   =>'Summary (22 Ct Gold/10 gram)',
        'city' => '',
        'type'=> '',
        'carret' => ''
    ), $atts);

    $id= @$data['id'];
    $title= @$data['title'];
    $city= @$data['city'];
    $type= @$data['type'];
    $carret= @$data['carret'];
    $div_id="gold_summery_data_".$id."_".$type;
    ?>

    <div class="gold_summery_table" id="<?php echo $div_id; ?>"  data-id="<?php echo $id; ?>" data-title="<?php echo $title; ?>" data-city="<?php echo $city; ?>" data-type="<?php echo $type; ?>" data-carret="<?php echo $carret; ?>">
    </div>
    <?php
    return ob_get_clean();
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
        'id'=>''
    ), $atts);
   
    $tabs_type = get_post_meta($post_id,'pa1_wp_easy_tabs_type',true);
     
    if($tabs_type == 'VT'){
         
    }else{
        $shortcodeWrap ='<div id="content"><div id="easy_tabs_container_wrap_'.$post_id.'" class="easy_tabs_container_wrap" data-id="'.$post_id.'"></div></div>';
    }
    return $shortcodeWrap;
});
add_shortcode('EasyTabWidgetVT', function ($atts){ 
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
    $data['tabs_data'] =array();
    $data['totalCount'] =0;
    $data['tabs_type'] ='';
    if($data['tabs_count']){
        $data['tabs_data'] = unserialize(get_post_meta($post_id,'pa1_wp_easy_tabs_data',true));
        $data['totalCount'] =@count($data['tabs_data']);
        $data['tabs_type'] = get_post_meta($post_id,'pa1_wp_easy_tabs_type',true);
    }
    $totalTopic =0;
    if(@count($data['tabs_data'])){
        foreach ($data['tabs_data'] as $idx => $tabs) {
             //print_r($value);
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
                    $categories[] =strip_tags(get_the_category_list(',','', $pd->ID));
                }
                $data['tabs_data'][$idx]['tabs_link']=$tabs_link;
                $data['tabs_data'][$idx]['tabs_link_to']=$tabs_link_to;
                $data['tabs_data'][$idx]['post_modified']=$post_modified;
                $data['tabs_data'][$idx]['categories']=$categories;

             }
        }
    }
     
    $totalTopic =0;
    if($totalCount){ 
        foreach($tabs_data as $tabs_single_data){
            $totalTopic += (is_array($tabs_single_data['tabs_link'])) ? count($tabs_single_data['tabs_link']): 0;
                       
        }
    }
    $data['totalTopic'] =$totalTopic;
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


/**
*   Shortcode form Branches search based on City.
*/
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

/**
*   Shortcode form Branches search based on Pincode.
*/
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

/**
*   Shortcode form Sub Broker Internale linking.
*/
add_shortcode('SUBBROKERSLINKS', function ($atts){ 
    $data = shortcode_atts( array(
        'zone' => '',
    ), $atts, 'bartag' );
    $posts_array = get_posts(
        array(
            'posts_per_page' =>-1,
            'post_type' => 'sub-broker',
            'order' => 'ASC',
            'orderby' => 'title',
            'tax_query' => array(
                array(
                    'taxonomy' => 'sub-broker-zones',
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
    $template = 'shortcodes.sub-brokers-links';
    return \App\template($template, $data);
});




/**
*   Shortcode form ForeCost Calculators.
[PPStockForecast finCode="217389" stock_filter="1" indexCode="123" index_filter="1" calculate_button="0"]
*/  
add_shortcode('PPStockForecast', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1',
        'type' => '',
        'fin_code' => '217389',
        'stock_filter' => '1',
        'index_code' => '123',
        'index_filter' => '0',
        'calculate_button' => '0',
    ), $atts);
    $template = 'shortcodes.fore-cast.pivot-points-calculator';
    return \App\template($template, $data);
});

/**
*   Shortcode form SMA ForeCost Calculators.
[SMAStockForecast finCode="217389" stock_filter="1" indexCode="123" index_filter="1" calculate_button="0"]
*/  
add_shortcode('SMAStockForecast', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1',
        'type' => '',
        'fin_code' => '217389',
        'stock_filter' => '1',
        'index_code' => '123',
        'index_filter' => '0',
        'calculate_button' => '0',
    ), $atts);
    $template = 'shortcodes.fore-cast.sma-stock-forecast';
    return \App\template($template, $data);
});

/**
*   Shortcode form EMA ForeCost Calculators.
[EMAStockForecast finCode="217389" stock_filter="1" indexCode="123" index_filter="1" calculate_button="0"]
*/  
add_shortcode('EMAStockForecast', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1',
        'type' => '',
        'fin_code' => '217389',
        'stock_filter' => '1',
        'index_code' => '123',
        'index_filter' => '0',
        'calculate_button' => '0',
    ), $atts);
    $template = 'shortcodes.fore-cast.ema-stock-forecast';
    return \App\template($template, $data);
});

/**
*   Shortcode form MACD ForeCost Calculators.
[MACDStockForecast finCode="217389" stock_filter="1" indexCode="123" index_filter="1" calculate_button="0"]
*/  
add_shortcode('MACDStockForecast', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1',
        'type' => '',
        'fin_code' => '217389',
        'stock_filter' => '1',
        'index_code' => '123',
        'index_filter' => '0',
        'calculate_button' => '0',
    ), $atts);
    $template = 'shortcodes.fore-cast.macd-stock-forecast';
    return \App\template($template, $data);
});

/**
*   Shortcode form RSI ForeCost Calculators.
[RSIStockForecast finCode="217389" stock_filter="1" indexCode="123" index_filter="1" calculate_button="0"]
*/  
add_shortcode('RSIStockForecast', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1',
        'type' => '',
        'fin_code' => '217389',
        'stock_filter' => '1',
        'index_code' => '123',
        'index_filter' => '0',
        'calculate_button' => '0',
    ), $atts);
    $template = 'shortcodes.fore-cast.rsi-stock-forecast';
    return \App\template($template, $data);
});

/**
*   Shortcode form RSI ForeCost Calculators.
[SOStockForecast finCode="217389" stock_filter="1" indexCode="123" index_filter="1" calculate_button="0"]
*/  
add_shortcode('SOStockForecast', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1',
        'type' => '',
        'fin_code' => '217389',
        'stock_filter' => '1',
        'index_code' => '123',
        'index_filter' => '0',
        'calculate_button' => '0',
    ), $atts);
    $template = 'shortcodes.fore-cast.so-stock-forecast';
    return \App\template($template, $data);
});

/**
*   Shortcode form Graham Intrinsic Value ForeCost Calculators.
[SOStockForecast finCode="217389" stock_filter="1" indexCode="123" index_filter="1" calculate_button="0"]
*/  
add_shortcode('GIVStockForecast', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1',
        'type' => '',
        'fin_code' => '217389',
        'stock_filter' => '1',
        'index_code' => '123',
        'index_filter' => '0',
        'calculate_button' => '0',
    ), $atts);
    $template = 'shortcodes.fore-cast.giv-stock-forecast';
    return \App\template($template, $data);
});


/**
*   Shortcode form Camarilla Levels ForeCost Calculators.
[CLStockForecast finCode="217389" stock_filter="1" indexCode="123" index_filter="1" calculate_button="0"]
*/  
add_shortcode('CLStockForecast', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1',
        'type' => '',
        'fin_code' => '217389',
        'stock_filter' => '1',
        'index_code' => '123',
        'index_filter' => '0',
        'calculate_button' => '0',
    ), $atts);
    // print_r($data);
    $template = 'shortcodes.fore-cast.cl-stock-forecast';
    return \App\template($template, $data);
});

/**
*   Shortcode form Camarilla Levels ForeCost Table.
[Camarilla_Clevels_Stock_Table]
*/  
add_shortcode('Camarilla_Clevels_Stock_Table', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
    ), $atts);
    // print_r($data);
    $template = 'shortcodes.fore-cast.cl-stock-table';
    return \App\template($template, $data);
});

function get_chield_pages($post_parent){
    global $wpdb; 
    if($post_parent){
        $chieldPages =[];
        $all_wp_pages = get_posts(
            array(
                'posts_per_page' =>-1,
                'post_type' => 'page',
                'post_parent' => $post_parent,
                'order' => 'ASC',
                'orderby' => 'title',
                 
            )
        );
        foreach ($all_wp_pages as $key => $value) {
            $chieldPages[get_the_permalink($value->ID)] =$value->post_title;
        }
        return $chieldPages;
    }else{
        return [];
    }
    return [];
}
/**
*   Shortcode form Main Pivot Points Calculator.
 
[MainPivotPointsIndicator]
*/
add_shortcode('MainPivotPointsIndicator', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1', 
        'parent_page' => '57204', 
    ), $atts);
    $parent_page =($data['parent_page'])?$data['parent_page']:'57204';
    $chieldPages =get_chield_pages($parent_page);
    $data['chieldPages']=$chieldPages;
    $template = 'shortcodes.fore-cast.indicators.pivot-points-indicator';
    return \App\template($template, $data);
});

/**
*  Shortcode form Main SMA Indicator.
 
[MainSMAIndicator]
*/
add_shortcode('MainSMAIndicator', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1', 
        'parent_page' => '57204', 
    ), $atts);
    $parent_page =($data['parent_page'])?$data['parent_page']:'57204';
    $chieldPages =get_chield_pages($parent_page);
    $data['chieldPages']=$chieldPages;
    $template = 'shortcodes.fore-cast.indicators.sma-indicator';
    return \App\template($template, $data);
});

/**
*  Shortcode form Main EMA Indicator.
 
[MainSMAIndicator]
*/
add_shortcode('MainEMAIndicator', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1', 
        'parent_page' => '57204', 
    ), $atts);
    $parent_page =($data['parent_page'])?$data['parent_page']:'57204';
    $chieldPages =get_chield_pages($parent_page);
    $data['chieldPages']=$chieldPages;
    $template = 'shortcodes.fore-cast.indicators.ema-indicator';
    return \App\template($template, $data);
});

/**
*  Shortcode form Main MACD Indicator.
[MainMACDIndicator]
*/
add_shortcode('MainMACDIndicator', function ($atts){ 
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1', 
        'parent_page' => '57204', 
    ), $atts);
    $parent_page =($data['parent_page'])?$data['parent_page']:'57204';
    $chieldPages =get_chield_pages($parent_page);
    $data['chieldPages']=$chieldPages;
    $template = 'shortcodes.fore-cast.indicators.macd-indicator';
    return \App\template($template, $data);
});


/**
*  Shortcode form Main RSI Indicator.
[MainRSIIndicator]
*/
add_shortcode('MainRSIIndicator', function ($atts){
    
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1', 
        'parent_page' => '57204',
    ), $atts);
    $parent_page =($data['parent_page'])?$data['parent_page']:'57204';
    $chieldPages =get_chield_pages($parent_page);
    
    $data['chieldPages'] =$chieldPages;
     
    $template = 'shortcodes.fore-cast.indicators.rsi-indicator';
    return \App\template($template, $data);
});
/**
*  Shortcode form Main Stochastic Oscillator - Stochastic Indicator.
[MainSOIndicator]
*/
add_shortcode('MainSOIndicator', function ($atts){
    
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1', 
        'parent_page' => '57204', 
    ), $atts);
    $parent_page =($data['parent_page'])?$data['parent_page']:'57204';
    $chieldPages =get_chield_pages($parent_page);
    
    $data['chieldPages'] =$chieldPages;
     
    $template = 'shortcodes.fore-cast.indicators.so-indicator';
    return \App\template($template, $data);
});

/**
*  Shortcode form Main Graham Intrinsic Indicator.
[MainGLIndicator]
*/
add_shortcode('MainGIVIndicator', function ($atts){
    
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1', 
        'parent_page' => '57204', 
    ), $atts);
    $parent_page =($data['parent_page'])?$data['parent_page']:'57204';
    $chieldPages =get_chield_pages($parent_page);
    
    $data['chieldPages'] =$chieldPages;
     
    $template = 'shortcodes.fore-cast.indicators.giv-indicator';
    return \App\template($template, $data);
});
/**
*  Shortcode form Main  Camarilla Levels Indicator.
[MainCLIndicator]
*/
add_shortcode('MainCLIndicator', function ($atts){
    
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1', 
        'parent_page' => '57204', 
    ), $atts);
    $parent_page =($data['parent_page'])?$data['parent_page']:'57204';
    $chieldPages =get_chield_pages($parent_page);
    
    $data['chieldPages'] =$chieldPages;
     
    $template = 'shortcodes.fore-cast.indicators.cl-indicator';
    return \App\template($template, $data);
});

/**
*  Shortcode form Main  Camarilla Levels Indicator.
[MainIndicatorFilters]
*/
add_shortcode('MainIndicatorFilters', function ($atts){
    
    $data = shortcode_atts( array(
        'title' => '',
        'id' => get_the_ID(),
        'tabs' => '1', 
        'default' => 'cl', 
    ), $atts);
    $defaultCal =($data['default'])?$data['default']:'cl';
    // $chieldPages =get_chield_pages($parent_page);
    $chieldPages =array(
        'cl'=>'Camarilla Levels Indicator',
        'ema'=>'Ema Indicator',
        'giv'=>'Graham Intrinsic Value Indicator',
        'macd'=>'Macd Indicator',
        'pp'=>'Pivot Point Indicator',
        'rsi'=>'Rsi Indicator',
        'sma'=>'Sma Indicator',
        'so'=>'Stochastic Oscillator Indicator',
    );
    
    $data['chieldPages'] =$chieldPages;
    $data['defaultCal'] =$defaultCal;
     
    $template = 'shortcodes.fore-cast.indicators.main-indicators-filters';
    return \App\template($template, $data);
});