<?php
/**
 * Invoicing custom item class.
 *
 * @package WPInv_Custom_Item
 * @since 1.0.0
 */

/**
 * WPInv_Custom_Item class.
 *
 * @since 1.0.0
 */
class WPInv_Custom_Item {

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct( ) {
        $this->item_type       = 'product';
        $this->item_type_name  = __( 'Product', 'wpinv-custom' );

        add_action( 'init', array( $this, 'actions' ) );
    }
    
    /**
     * Actions.
     *
     * @since 1.0.0
     */
    public function actions( ) {
        // Register the custom item type.
        add_action( 'wpinv_get_item_types', array( $this, 'register_item_type' ), 10, 1 );

        // Custom item type info which will be displayed under Item Info metabox in backend add/edit item page.
        add_action( 'wpinv_item_info_metabox_after', array( $this, 'metabox_item_type_info' ), 10, 1 );

        // Handle payment received for custom item type.
        add_action( 'wpinv_update_status', array( $this, 'on_payment_completed' ), 10, 3 );
        
        // Handle payment refunded for custom item type.
        add_action( 'wpinv_post_refund_invoice', array( $this, 'on_payment_refunded' ), 10, 1 );
        
        // Validate custom item type delete action.
        add_action( 'wpinv_can_delete_item', array( $this, 'can_delete_item' ), 10, 2 );
    }
    
    /**
     * Register the custom item type.
     */
    public function register_item_type( $item_types ) {
        $item_types[ $this->item_type ] = $this->item_type_name;
            
        return $item_types;
    }
    
    /**
     * Custom item type info which will be displayed under Item Info metabox in backend add/edit item page.
     */
    public function metabox_item_type_info( $post ) {
        ?>
        <p class="wpi-m0"><?php _e( 'Product: Info about product item type.', 'wpinv-custom' );?></p>
        <?php
    }
    
    /**
     * Handle payment received for custom item type.
     */
    public function on_payment_completed( $invoice_id, $new_status, $old_status ) {
        if ( $new_status == 'publish' || $new_status == 'wpi-renewal' ) {
            $invoice = wpinv_get_invoice( $invoice_id );
            
            if ( !empty( $invoice ) ) {
                $cart_items = $invoice->get_cart_details();
                
                if ( !empty( $cart_items ) ) {
                    foreach ( $cart_items as $key => $cart_item ) {
                        $item = !empty( $cart_item['id'] ) ? new WPInv_Item( $cart_item['id'] ) : NULL;
                        
                        if ( !empty( $item ) && $item->get_type() == $this->item_type ) {
                            // Code stuff here payment received for custom item type.
                        }
                    }
                }
            }
        }
    }
    
    /**
     * Handle payment refunded for custom item type.
     */
    public function on_payment_refunded( $invoice ) {
        $cart_items = !empty( $invoice ) ? $invoice->get_cart_details() : NULL;
        
        if ( !empty( $cart_items ) ) {
            foreach ( $cart_items as $key => $cart_item ) {
                $item = !empty( $cart_item['id'] ) ? new WPInv_Item( $cart_item['id'] ) : NULL;
            
                if ( !empty( $item ) && $item->get_type() == $this->item_type ) {
                    // Code stuff here payment refunded for custom item type.
                }
            }
        }
    }
    
    /**
     * Validate custom item type delete action.
     */
    public function can_delete_item( $return, $post_id ) {
        if ( get_post_meta( $post_id, '_wpinv_type', true ) == $this->item_type ) {
            // $return = true; // Allow to delete custom item type.
            // $return = false; // Don't allow to delete custom item type.
        }
     
        return $return;
    }
}

new WPInv_Custom_Item();