<?php
add_action('woocommerce_before_cart', 'before_cart_table', 10);

function before_cart_table(){
    echo "<div class='cartTable-wrapper'>";
    
}
add_action('woocommerce_before_cart', 'cart_title', 15);

function cart_title(){
    echo "<h1>Cart</h1>";
    
}

add_action('woocommerce_after_cart_contents', 'after_cart_contents',15);
function after_cart_contents(){
    echo "</h1>";
    
}

add_action( 'wp_footer', 'cart_refresh_update_qty' ); 
 
function cart_refresh_update_qty() {
   if ( is_cart() || ( is_cart() && is_checkout() ) ) {
      wc_enqueue_js( "
         $('div.woocommerce').on('change', 'input.qty', function(){
            $('[name=\'update_cart\']').prop('disabled', false);
            $('[name=\'update_cart\']').trigger('click');
         });
      " );
   }
}