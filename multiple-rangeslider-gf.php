<?php  
/**
* Plugin Name: Multiple Range Slider For Gravity Form
* Description: This plugin allows create Multiple Range Slider For Gravity Form plugin.
* Version: 1.0
* Copyright: 2023
* Text Domain: multiple-range-slider-for-gravity-form
* Domain Path: /languages 
*/


if (!defined('ABSPATH')) {
    die('-1');
}


// define for base name
define('MRSGF_BASE_NAME', plugin_basename(__FILE__));


// define for plugin file
define('MRSGF_PLUGIN_FILE', __FILE__);


// define for plugin dir path
define('MRSGF_PLUGIN_DIR',plugins_url('', __FILE__));


// Include function files
include_once('main/backend/multiple_rangeslider_backend.php');
include_once('main/resources/multiple-rangeslider-installation-require.php');
include_once('main/resources/multiple-rangeslider-language.php');
include_once('main/resources/multiple-rangeslider-load-js-css.php');

function MRSGF_support_and_rating_links( $links_array, $plugin_file_name, $plugin_data, $status ) {
    if ($plugin_file_name !== plugin_basename(__FILE__)) {
      return $links_array;
    }

    $links_array[] = '<a href="https://www.plugin999.com/support/">'. __('Support', 'multiple-range-slider-for-gravity-form') .'</a>';
    $links_array[] = '<a href="https://wordpress.org/support/plugin/multiple-range-slider-for-gravity-form/reviews/?filter=5">'. __('Rate the plugin ★★★★★', 'multiple-range-slider-for-gravity-form') .'</a>';

    return $links_array;

}
add_filter( 'plugin_row_meta', 'MRSGF_support_and_rating_links', 10, 4 );