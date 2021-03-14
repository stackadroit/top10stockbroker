<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('top10stockbroker/main.css', asset_path('styles/main.css'), '2.5.9', true);
    wp_enqueue_script('top10stockbroker/main.js', asset_path('scripts/main.js'), ['jquery'], '2.5.9', true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    $localize_script_vars = array( 
        'site_url' => site_url('/'),
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'ajax_nonce' => wp_create_nonce('gloabltop10stockbroker'),
    );
    //set api server url
    if ( WP_DEBUG ) {
        $localize_script_vars['apiServerUrl'] = 'http://127.0.0.1:8000';
    }else{
        // $localize_script_vars['apiServerUrl'] = 'https://api.top10stockbroker.com';
        $localize_script_vars['apiServerUrl'] = 'https://api1.top10stockbroker.com';
    }

    // if ( defined( 'WPCF7_LOAD_JS' ) ) {
    //     $wpcf7 = array(
    //         'apiSettings' => array(
    //             'root' => esc_url_raw( rest_url( 'contact-form-7/v1' ) ),
    //             'namespace' => 'contact-form-7/v1',
    //         ),
    //     );

    //     if ( defined( 'WP_CACHE' ) and WP_CACHE ) {
    //         $wpcf7['cached'] = 1;
    //     }

    //     if ( wpcf7_support_html5_fallback() ) {
    //         $wpcf7['jqueryUi'] = 1;
    //     }
    //     $localize_script_vars['wpcf7'] = $wpcf7;
    // }

    wp_localize_script( 'top10stockbroker/main.js', 'global_vars', $localize_script_vars);

}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from topstockbroker-extension when plugin is activated
     */
    //    add_theme_support('topstockbroker-clean-up');
    //    add_theme_support('topstockbroker-jquery-cdn');
    //    add_theme_support('topstockbroker-nav-walker');
    //    add_theme_support('topstockbroker-nice-search');
    //    add_theme_support('topstockbroker-relative-urls');

    add_theme_support('topstockbroker', [
        'clean-up',
        //'disable-rest-api',
        'disable-asset-versioning',
        'disable-trackbacks',
        'js-to-footer',
        'nav-walker',
        'nav-walker-edit',
        'nice-search',
        'relative-urls',
        'custom-post-type',
        'widget-options',
        'google-analytics',
    ]);

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'top10stockbroker'),
        'top_navigation' => __('Top Navigation', 'top10stockbroker'),
        'footer_navigation' => __('Footer Navigation', 'top10stockbroker')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'stockadroit'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'stockadroit'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

/**
 * Register CPT
 */
add_filter('top10stockbroker_cpt', function ($array) {
    
    $array[] = array( 
                'cpt' => array( 
                            __( 'Share Market', 'top10stockbroker' ),
                            __( 'Share Markets', 'top10stockbroker' ),
                            'share-market'
                        ),
                'arg_overrides' => array( 
                            'has_archive' => false,
                            'menu_position' => 5,
                            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ), 
                            'menu_icon'           => 'dashicons-tagcloud',
                            'register_meta_box_cb' => function () {
                                add_meta_box(
                                    'share_market_indices_code',
                                    'Indices Code',
                                    '_pa1_share_market_indices_code_fun',
                                    'share-market',
                                    'side',
                                    'default'
                                );
                            },
                        )
            );

    $array[] = array( 
                'cpt' => array( 
                            __( 'Share Price', 'top10stockbroker' ),
                            __( 'Share Prices', 'top10stockbroker' ),
                            'share-price'
                        ),
                'arg_overrides' => array( 
                            'has_archive' => false,
                            'menu_position' => 5,
                            'supports' => array('title','thumbnail', 'editor' ,'page-attributes'),
                            'menu_icon'           => 'dashicons-tagcloud',
                        )
            );

    $array[] = array( 
                'cpt' => array( 
                            __( 'Option Chain', 'top10stockbroker' ),
                            __( 'Option Chains', 'top10stockbroker' ),
                            'option-chain'
                        ),
                'arg_overrides' => array( 
                            'has_archive' => false,
                            'menu_position' => 5,
                            'supports' => array('title','thumbnail', 'editor'),
                            'menu_icon'           => 'dashicons-tagcloud',
                        )
            );

    $array[] = array( 
                'cpt' => array( 
                            __( 'Futures', 'top10stockbroker' ),
                            __( 'Futuress', 'top10stockbroker' ),
                            'futures'
                        ),
                'arg_overrides' => array( 
                            'has_archive' => false,
                            'menu_position' => 5,
                            'supports' => array('title','thumbnail', 'editor' ,'page-attributes'),
                            'menu_icon'           => 'dashicons-tagcloud',
                        )
            );
    $array[] = array( 
                'cpt' => array( 
                            __( 'News', 'top10stockbroker' ),
                            __( 'News', 'top10stockbroker' ),
                            'news'
                        ),
                'arg_overrides' => array( 
                            'has_archive' => true,
                            'menu_position' => 5,
                            'supports' => array('title','thumbnail', 'editor' ,'page-attributes'),
                            'menu_icon' => 'dashicons-tagcloud',
                            'taxonomies'=> array( 'category' ),
                        )
            );
    $array[] = array( 
                'cpt' => array( 
                            __( 'Stock Broker', 'top10stockbroker' ),
                            __( 'Stock Brokers', 'top10stockbroker' ),
                            'stock-brokers'
                        ),
                'arg_overrides' => array( 
                            'has_archive' => false,
                            'menu_position' => 5,
                           'supports' => array('title','thumbnail', 'editor' ,'page-attributes'),
                            'menu_icon' => 'dashicons-tagcloud',
                           
                        )
            );
    $array[] = array( 
                'cpt' => array( 
                            __( 'BK State', 'top10stockbroker' ),
                            __( 'BK States', 'top10stockbroker' ),
                            'state'
                        ),
                'arg_overrides' => array( 
                            'has_archive' => false,
                            'menu_position' => 5,
                           'supports' => array('title','thumbnail', 'editor' ,'page-attributes'),
                            'menu_icon' => 'dashicons-tagcloud',
                           
                        )
            );
    $array[] = array( 
                'cpt' => array( 
                            __( 'Brokerage', 'top10stockbroker' ),
                            __( 'Brokerages', 'top10stockbroker' ),
                            'brokerage-calculator'
                        ),
                'arg_overrides' => array( 
                            'has_archive' => true,
                            'menu_position' => 5,
                           'supports' => array('title','thumbnail', 'editor' ,'page-attributes'),
                            'menu_icon' => 'dashicons-tagcloud',
                           
                        )
            );
    $array[] = array( 
                'cpt' => array( 
                            __( 'Brokerage comparison', 'top10stockbroker' ),
                            __( 'Brokerage comparisons', 'top10stockbroker' ),
                            'broker-comparison'
                        ),
                'arg_overrides' => array( 
                            'has_archive' => true,
                            'menu_position' => 5,
                           'supports' => array('title','thumbnail', 'editor' ,'page-attributes'),
                            'menu_icon' => 'dashicons-tagcloud',
                           
                        )
            );
    $array[] = array( 
                'cpt' => array( 
                            __( 'Margin Calculator', 'top10stockbroker' ),
                            __( 'Margin Calculators', 'top10stockbroker' ),
                            'margin-calculator'
                        ),
                'arg_overrides' => array( 
                            'has_archive' => false,
                            'menu_position' => 5,
                           'supports' => array('title','thumbnail', 'editor' ,'page-attributes'),
                            'menu_icon' => 'dashicons-tagcloud',
                           
                        )
            );
    
    return $array;

}, 10, 1);
    
    

