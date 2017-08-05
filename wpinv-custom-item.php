<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Invoicing Custom Item
 * Plugin URI:        https://wpinvoicing.com/docs/adding-a-custom-invoicing-item/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress dashboard.
 * Version:           1.0.0
 * Author:            GeoDirectory Team
 * Author URI:        https://wpgeodirectory.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpinv-custom
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( is_admin() ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    
    if ( !is_plugin_active( 'invoicing/invoicing.php' ) ) {
        return;
    }
}

if ( !defined( 'WPINV_CUSTOM_ITEM_PLUGIN_VERSION' ) ) {
    define( 'WPINV_CUSTOM_ITEM_PLUGIN_VERSION', '1.0.0' );
}

if ( !defined( 'WPINV_CUSTOM_ITEM_PLUGIN_FILE' ) ) {
    define( 'WPINV_CUSTOM_ITEM_PLUGIN_FILE', __FILE__ );
}

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( WPINV_CUSTOM_ITEM_PLUGIN_FILE ) . 'includes/class-wpinv-custom-item-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function wpinv_custom_item_plugin() {
    global $wpinv_custom_item_plugin;
    $wpinv_custom_item_plugin = WPInv_Custom_Item_Plugin::instance();
}
wpinv_custom_item_plugin();