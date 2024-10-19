<?php

/*************************************************
## Scripts
*************************************************/
function machic_free_shipping_scripts() {
	wp_enqueue_style( 'klb-free-shipping',   plugins_url( 'css/free-shipping.css', __FILE__ ), false, '1.0');
}
add_action( 'wp_enqueue_scripts', 'machic_free_shipping_scripts' );


/*************************************************
## Free shipping progress bar.
*************************************************/
function machic_shipping_progress_bar() {
		
		$total           = WC()->cart->get_displayed_subtotal();
		$limit           = get_theme_mod( 'shipping_progress_bar_amount' );
		$percent         = 100;


		if ( $total < $limit ) {
			$percent = floor( ( $total / $limit ) * 100 );
			$message = str_replace( '[remainder]', wc_price( $limit - $total ), get_theme_mod( 'shipping_progress_bar_message_initial' ) );
			$class = 'warning';
		} else {
			$message = get_theme_mod( 'shipping_progress_bar_message_success' );
			$class = 'success';
		}
		
	?>
	
	<div class="klb-free-progress-bar <?php echo esc_attr($class); ?>">
		<div class="free-shipping-notice">
			<?php echo wp_kses( $message, 'post' ); ?>
		</div>
		<div class="klb-progress-bar">
			<span class="progress" style="width: <?php echo esc_attr( $percent ); ?>%"></span>
		</div>
	</div>
			
	<?php
}
	
if(get_theme_mod( 'shipping_progress_bar_location_card_page',0) == '1'){
	add_action( 'woocommerce_before_cart_table',  'machic_shipping_progress_bar' );
}

if(get_theme_mod( 'shipping_progress_bar_location_mini_cart',0) == '1'){
	add_action( 'woocommerce_widget_shopping_cart_before_buttons', 'machic_shipping_progress_bar' );
}

if(get_theme_mod( 'shipping_progress_bar_location_checkout',0) == '1'){
	add_action( 'woocommerce_checkout_before_customer_details', 'machic_shipping_progress_bar' );
}
