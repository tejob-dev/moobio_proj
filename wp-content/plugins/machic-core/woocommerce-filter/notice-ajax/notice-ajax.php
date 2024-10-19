<?php
/*************************************************
## Scripts
*************************************************/
function machic_notice_ajax_scripts() {
	wp_enqueue_script( 'klb-notice-ajax',   plugins_url( 'js/notice-ajax.js', __FILE__ ), false, '1.0');
	wp_enqueue_style( 'klb-notice-ajax',   plugins_url( 'css/notice-ajax.css', __FILE__ ), false, '1.0');
	wp_enqueue_script( 'wc-cart-fragments' );
}
add_action( 'wp_enqueue_scripts', 'machic_notice_ajax_scripts' );


/*************************************************
## AJax Handler Function
*************************************************/
if ( !function_exists( 'machic_ajax_add_to_cart_archive_handler' ) ) {
    /**
    * Add to cart handler.
    */
    function machic_ajax_add_to_cart_archive_handler() {
        WC_AJAX::get_refreshed_fragments();
    }
    add_action( 'wc_ajax_machic_add_to_cart_archive', 'machic_ajax_add_to_cart_archive_handler' );
    add_action( 'wc_ajax_nopriv_machic_add_to_cart_archive', 'machic_ajax_add_to_cart_archive_handler' );
    
    /**
    * Add fragments for notices.
    */
	if ( !function_exists( 'machic_ajax_add_to_cart_add_fragments' ) ) {
	    function machic_ajax_add_to_cart_add_fragments( $fragments ) {
	        $all_notices  = WC()->session->get( 'wc_notices', array() );
	        $notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );
	        
	        ob_start();
	        foreach ( $notice_types as $notice_type ) {
	            if ( wc_notice_count( $notice_type ) > 0 ) {
	                wc_get_template( "notices/{$notice_type}.php", array(
	                    'notices' => array_filter( $all_notices[ $notice_type ] ),
	                ) );
	            }
	        }
	        $fragments['notices_html'] = ob_get_clean();
	        
	        wc_clear_notices();
	        
	        return $fragments;
	    }
	    add_filter( 'woocommerce_add_to_cart_fragments', 'machic_ajax_add_to_cart_add_fragments' );
	}
}
