<?php
/**
 * Invoicing custom item plugin class.
 *
 * @package WPInv_Custom_Item
 * @since  1.0.0
 */

/**
 * WPInv_Custom_Item_Plugin class.
 *
 * @since  1.0.0
 */
class WPInv_Custom_Item_Plugin {
    protected static $instance = null;
    
    /**
     * The current version of the plugin.
     *
     * @since  1.0.0
     */
    protected $version;

    /**
     * Instance.
     *
     * @since  1.0.0
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor.
     *
     * @since  1.0.0
     */
    public function __construct() {
        $this->define_constants();
        $this->setup_globals();
        $this->includes();
        $this->setup_actions();
    }
    
    /**
     * Define constants.
     *
     * @since  1.0.0
     */
    private function define_constants() {
        if ( !defined( 'WPINV_CUSTOM_ITEM_PLUGIN_DIR' ) ) {
            define( 'WPINV_CUSTOM_ITEM_PLUGIN_DIR', plugin_dir_path( WPINV_CUSTOM_ITEM_PLUGIN_FILE ) );
        }

        if ( !defined( 'WPINV_CUSTOM_ITEM_PLUGIN_URL' ) ) {
            define( 'WPINV_CUSTOM_ITEM_PLUGIN_URL', plugin_dir_url( WPINV_CUSTOM_ITEM_PLUGIN_FILE ) );
        }
    }
    
    /**
     * Set global variables.
     *
     * @since  1.0.0
     */
    private function setup_globals() {
        $this->version      = WPINV_CUSTOM_ITEM_PLUGIN_VERSION;
        $this->plugin_file  = WPINV_CUSTOM_ITEM_PLUGIN_FILE;
        $this->plugin_dir   = WPINV_CUSTOM_ITEM_PLUGIN_DIR;
        $this->plugin_url   = WPINV_CUSTOM_ITEM_PLUGIN_URL;
    }
    
    /**
     * Includes files.
     *
     * @since  1.0.0
     */
    private function includes() {
        require_once( $this->plugin_dir . 'includes/class-wpinv-custom-item.php' );
    }
    
    /**
     * Setup actions.
     *
     * @since  1.0.0
     */
    private function setup_actions() {
        register_activation_hook( $this->plugin_file, array( $this, 'activate' ) );
        register_deactivation_hook( $this->plugin_file, array( $this, 'deactivate' ) );
        
        add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
    }
    
    /**
     * Plugin activation hook.
     *
     * @since  1.0.0
     */
    public function activate( $network_wide = false ) {
        
    }
    
    /**
     * Plugin deactivation hook.
     *
     * @since  1.0.0
     */
    public function deactivate() {
        
    }
    
    /**
     * Load the plugin textdomain.
     *
     * @since  1.0.0
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'wpinv-custom',
            FALSE,
            $this->plugin_dir . 'languages/'
        );
    }
}
