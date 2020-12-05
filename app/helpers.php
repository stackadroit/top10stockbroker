<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views'
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                })
                ->concat([
                    "{$template}.blade.php",
                    "{$template}.php",
                ]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('top10stockbroker/display_sidebar', false);
    return $display;
}

/**
 * 
 * @return array
 */
function get_GoldCityStateLists()
{
     $cities =array(
        '52274' =>'india',
        '52365' =>'hyderabad',
        '52361' =>'patna',
        '52360' =>'raipur',
        '52359' =>'panaji',
        '52358' =>'chandigarh',
        '52357' =>'shimla',
        '52356' =>'srinagar',
        '52355' =>'ranchi',
        '52363' =>'bangalore',
        '52354' =>'thiruvananthapuram',
        '52276' =>'bhopal',
        '52362' =>'mumbai',
        '52353' =>'bhubaneswar',
        '52352' =>'jaipur',
        '52364' =>'chennai',
        '52351' =>'lucknow',
        '52350' =>'dehradun',
        '52349' =>'kolkata',
        '52348' =>'kerala',
        '52347' =>'delhi',
        '52346' =>'coimbatore',
        '52345' =>'vijayawada',
        '52344' =>'pune',
        '52343' =>'madurai',
        '52342' =>'vizag',
        '52341' =>'udupi',
        '52340' =>'pondicherry',
        '52339' =>'nellore',
        '52333' =>'tirunelveli',
        '52338' =>'salem',
        '52337' =>'warangal',
        '52336' =>'kanpur',
        '52335' =>'sangli',
        '52334' =>'ahmedabad',
        '52332' =>'mysore',
        '52331' =>'mangalore',
        '52330' =>'guntur',
        '52329' =>'rajahmundry',
        '52328' =>'kakinada',
        '52327' =>'hosur',
        '52326' =>'indore',
        '52325' =>'amritsar',
        '52324' =>'gurugram',
        '52323' =>'faridabad',
        '52322' =>'meerut',
        '52321' =>'kochi',
        '52303' =>'andhra pradesh',
        '52316' =>'bihar',
        '52315' =>'chattisgarh',
        '52314' =>'goa',
        '52313' =>'punjab',
        '52311' =>'himachal pradesh',
        '52310' =>'jammu & kashmir',
        '52309' =>'jharkhand',
        '52318' =>'karnataka',
        '52308' =>'madhya pradesh',
        '52317' =>'maharashtra',
        '52307' =>'odisha',
        '52306' =>'rajasthan',
        '52319' =>'tamil nadu',
        '52305' =>'uttar pradesh',
        '52304' =>'west bengal',
        '52320' =>'telangana',
        '52302' =>'gujarat',
        '52312' =>'haryana',
    );
     
  return $cities;
}

/**
 * 
 * @return array
 */
function get_SilverCityStateLists()
{
     $cities =array(
        '52274' =>'india',
        '52365' =>'hyderabad',
        '52361' =>'patna',
        '52360' =>'raipur',
        '52359' =>'panaji',
        '52358' =>'chandigarh',
        '52357' =>'shimla',
        '52356' =>'srinagar',
        '52355' =>'ranchi',
        '52363' =>'bangalore',
        '52354' =>'thiruvananthapuram',
        '52276' =>'bhopal',
        '52362' =>'mumbai',
        '52353' =>'bhubaneswar',
        '52352' =>'jaipur',
        '52364' =>'chennai',
        '52351' =>'lucknow',
        '52350' =>'dehradun',
        '52349' =>'kolkata',
        '52348' =>'kerala',
        '52347' =>'delhi',
        '52346' =>'coimbatore',
        '52345' =>'vijayawada',
        '52344' =>'pune',
        '52343' =>'madurai',
        '52342' =>'vizag',
        '52341' =>'udupi',
        '52340' =>'pondicherry',
        '52339' =>'nellore',
        '52333' =>'tirunelveli',
        '52338' =>'salem',
        '52337' =>'warangal',
        '52336' =>'kanpur',
        '52335' =>'sangli',
        '52334' =>'ahmedabad',
        '52332' =>'mysore',
        '52331' =>'mangalore',
        '52330' =>'guntur',
        '52329' =>'rajahmundry',
        '52328' =>'kakinada',
        '52327' =>'hosur',
        '52326' =>'indore',
        '52325' =>'amritsar',
        '52324' =>'gurugram',
        '52323' =>'faridabad',
        '52322' =>'meerut',
        '52321' =>'kochi',
        '52303' =>'andhra pradesh',
        '52316' =>'bihar',
        '52315' =>'chattisgarh',
        '52314' =>'goa',
        '52313' =>'punjab',
        '52311' =>'himachal pradesh',
        '52310' =>'jammu & kashmir',
        '52309' =>'jharkhand',
        '52318' =>'karnataka',
        '52308' =>'madhya pradesh',
        '52317' =>'maharashtra',
        '52307' =>'odisha',
        '52306' =>'rajasthan',
        '52319' =>'tamil nadu',
        '52305' =>'uttar pradesh',
        '52304' =>'west bengal',
        '52320' =>'telangana',
        '52302' =>'gujarat',
        '52312' =>'haryana',
    );
     
  return $cities;
}

