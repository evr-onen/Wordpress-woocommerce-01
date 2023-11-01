<?php
include 'login.php';
include 'single_product.php';
include 'header.php';
include 'shop.php';
include 'cart.php';



add_filter('woocommerce_output_all_notices', '__return_false');
add_filter( 'wc_add_to_cart_message_html', '__return_false' );

/* product card (at single now) */ 
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action('woocommerce_after_single_product_summary', 'custom_related_product', 10);
function custom_related_product() {
    global $product;
    $upselProductsIds= $product->get_upsell_ids();
  
    $h  ="<div class='relatedProducts'>  "  ;
    foreach ( $upselProductsIds as $item_id ):

		$relatedProduct     = wc_get_product($item_id);
        $sale_price=$relatedProduct->get_price();
        $link= get_permalink( $relatedProduct->get_id() );
        $cats = $relatedProduct->get_categories();
        $discount=$relatedProduct->get_regular_price() - $relatedProduct->get_price() /$relatedProduct->get_regular_price()* 100;
        $title = $relatedProduct->get_name();
        $currency_symbol = get_woocommerce_currency_symbol();
        $image=$relatedProduct->get_image();


        
        $h  .=" <div  class='productCard_wrapper'>";
    $h  .=" <span  class='discount'>-$discount% </span>";
    $h .=" <a  href='". esc_url($link). "' class='imageWrapper'>"; 
    $h .="     $image";
    $h .=" </a>";
    $h .="<div class='text'>";
    $h .="     <a href='". esc_url($link). "' class='productTitle'>$title</a>";
    $h .="     <p class='productCategory'>$cats </p>";
    $h .="     <p class='productPrice'>$sale_price  $currency_symbol </p>";
    $h .="</div>";
    $h .="</div>";
    
endforeach;
    $h .="</div>";
    
 
     echo $h;
 }

 

 






 
