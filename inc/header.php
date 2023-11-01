<?php

add_filter( 'woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment' );
function header_add_to_cart_fragment( $fragments ) {
	$fragments[ '.header-cart-quantity' ] = '<span class="header-cart-quantity">' . WC()->cart->get_cart_contents_count() . '</span>';
 	return $fragments;
 }