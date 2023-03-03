<?php

// Load JS and CSS files on Backend
add_action('admin_enqueue_scripts',  'MRSGF_load_admin_script_style');
function MRSGF_load_admin_script_style(){
    wp_enqueue_style( 'MRSGF_back_style', MRSGF_PLUGIN_DIR . '/assets/css/back.css', false, '1.0.0' );
}

// Load JS and CSS files on Frontend
add_action( 'wp_enqueue_scripts','MRSGFenqueue_custom_script', 9000);  
function MRSGFenqueue_custom_script() {
    wp_enqueue_style( 'MRSGF-front-css', MRSGF_PLUGIN_DIR . '/assets/css/front.css', false, '1.0.0' );
    wp_enqueue_script('jquery');
     wp_deregister_script('jquery-ui-core');
    wp_enqueue_script( 'MRSGF-jquery-ui-touch-punch-js', MRSGF_PLUGIN_DIR .'/assets/js/jquery.ui.touch-punch.min.js', false, '1.0.0',true );
    wp_enqueue_style( 'MRSGF-jquery-ui-css', MRSGF_PLUGIN_DIR .'/assets/js/jquery-ui.css', false, '1.0.0' );  
    wp_enqueue_script( 'RSFFCF7-range-jquery-ui-js', MRSGF_PLUGIN_DIR .'/assets/js/range-jquery-range.min.js', false, '1.12.1' );
    wp_enqueue_style( 'MRSGF-jquery-ui-slider-pips-css', MRSGF_PLUGIN_DIR .'/assets/js/jquery-ui-slider-pips.css', false, '1.0.0' ); 
    wp_enqueue_script( 'MRSGF-jquery-ui-slider-pips-js', MRSGF_PLUGIN_DIR .'/assets/js/jquery-ui-slider-pips.js', false, '1.0.0',true );
    wp_enqueue_script( 'MRSGF-front-js', MRSGF_PLUGIN_DIR.'/assets/js/front.js',array('jquery'),'',true);
}
