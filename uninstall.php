<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$options = get_option( 'skp_greeklish_slugs' );

if ( $options['delete_option_data'] ) {
    delete_option( 'skp_greeklish_slugs' );
}