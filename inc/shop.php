<?php

remove_filter('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
remove_filter('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');


add_action('woocommerce_after_shop_loop_item_title', 'price_area', 10);
function price_area(){
    global $product;

    $price=$product->get_price();
    $regualar=$product->get_regular_price();
    $salePrice=$product->get_sale_price();
    $currency_symbol = get_woocommerce_currency_symbol();
    $h   ="<div class='price'> <p class='salePrice'> $price $currency_symbol  </p></div>";
    echo $h;
}

add_action('woocommerce_before_shop_loop_item_title', 'discount_area', 10);
function discount_area(){
    global $product;

    $price=$product->get_price();
    $regualar=$product->get_regular_price();
    $salePrice=$product->get_sale_price();
    $currency_symbol = get_woocommerce_currency_symbol();
    $discount=$regualar !== $price  ? ($regualar -  $price) / $regualar * 100 . '%': null;
    if($product->get_regular_price() != $product->get_price()){

        $h   ="<div class='onsale'>-$discount</div>";
        echo $h;
    }
}
add_action('woocommerce_before_shop_loop', 'shop_title',7);
function shop_title(){
    if (is_product_category()) {
        global $wp_query;
        $catName = $wp_query->get_queried_object()->name;
        echo "<div class='theTitle'> $catName </div>";
    }else{
        echo "<div class='theTitle'> Shop </div>";
    }
}
add_action('woocommerce_before_shop_loop', 'custom_before_shop_loop',5);
function custom_before_shop_loop(){
    echo "<div class='beforeShopLoop'>";
}
add_action('woocommerce_before_shop_loop', 'topLoopSection_before',15);
function topLoopSection_before(){
    echo "<div class='topLoopSection'>";
}

add_action('woocommerce_before_shop_loop', 'topLoopSection_after',35);
function topLoopSection_after(){
    echo "</div>";
}
add_action('woocommerce_after_shop_loop', 'custom_after_shop_loop',30);
function custom_after_shop_loop(){
    echo "</div>";
}


