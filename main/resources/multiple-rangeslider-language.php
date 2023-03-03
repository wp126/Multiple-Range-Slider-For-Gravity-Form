<?php

// Use load textdomain
add_action( 'plugins_loaded', 'MRSGF_load_textdomain' );
function MRSGF_load_textdomain() {
    load_plugin_textdomain( 'multiple-range-slider-for-gravity-form', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

// Use load textdomain mofile
function MRSGF_load_my_own_textdomain( $mofile, $domain ) {
    if ( 'multiple-range-slider-for-gravity-form' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'MRSGF_load_my_own_textdomain', 10, 2 );