<?php
/**
 * Plugin Name:       Greeklish Slugs
 * Plugin URI:        https://github.com/skapator/Skp-Greeklish-Slugs
 * Description:       Translitaration of greek characters to latin (greeklish) for post permalinks with some extra options.
 * Version:           1.1.0
 * Author:            Kostas Charalampidis
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       skp_greeklish_slugs
 * Domain Path:       /languages
 *
 * @since             1.0.0
 * @package           skp-greeklish-slugs
 */

// Based on https://github.com/dyrer/greeklish-permalinks

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

if ( is_admin() )
    require plugin_dir_path( __FILE__ ) . 'includes/skp-greeklish-slugs-options.php';

require plugin_dir_path( __FILE__ ) . 'includes/skp-greeklish-slugs.php';

// The code that runs during plugin uninstall.
register_uninstall_hook( __FILE__, 'skp_greeklish_slugs_delete_options' );
