<?php 

// Load Plugin in admin init
add_action( 'admin_init',  'MRSGF_load_plugin', 11 );
function MRSGF_load_plugin() {
    if ( ! ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) ) {
        set_transient( get_current_user_id() . 'mrsgferror', 'message' );
    }
}


// Error returns when Contact Form 7 is not installed
add_action( 'admin_notices', 'MRSGF_install_error');
function MRSGF_install_error() {
    if ( get_transient( get_current_user_id() . 'mrsgferror' ) ) {

        deactivate_plugins( plugin_basename( __FILE__ ) );

        delete_transient( get_current_user_id() . 'mrsgferror' );

        echo '<div class="error"><p> This plugin is deactivated because it require <a href="https://www.gravityforms.com/">Gravityforms</a> plugin installed and activated.</p></div>';
    }
}