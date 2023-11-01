<?php
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
 add_action('woocommerce_before_single_product_summary', 'product_slider', 20);
 function product_slider(){
    global $product;
    $h = "
<div class'sliderArea' >
    <div class='swiper swiperSingleProductSlider' style='width:500px;height:500px'>
        <div class='swiper-wrapper'>";
    $gallery_img_ids = $product->get_gallery_image_ids();
	foreach ( $gallery_img_ids as $item_id ):
		$item_img     = wp_get_attachment_image_src( $item_id, 'full' );
		$item_img_url = $item_img[0];
        
		$h .= '<div class="swiper-slide">';
		$h .= '<img src="' . $item_img_url . '" alt="">';
		$h .= '</div>';
	endforeach;
            
    $h .=  "</div>";
    $h .=  "<div class='swiper-button-next'></div><div class='swiper-button-prev'></div>";
    $h .=  "</div>";
    $h .=  "<div thumbsSlider='' class='swiper swiperSingleProductThumbnail' style='width:500px;height:100px'>";
    $h .=  "<div class='swiper-wrapper'>";
    $gallery_img_ids = $product->get_gallery_image_ids();
	foreach ( $gallery_img_ids as $item_id ):
		$item_img     = wp_get_attachment_image_src( $item_id, 'full' );
		$item_img_url = $item_img[0];
		$h .= '<div class="swiper-slide">';
		$h .= '<img src="' . $item_img_url . '" alt="">';
		$h .= '</div>';
	endforeach;
    $h .=  "</div>";
    $h .=  "</div>";
    $h .=  "</div>";
    echo $h;
 }


 remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'custom_single_product_summary', 10);

function custom_single_product_summary() {
    global $product;

    $price=$product->get_price();
    $regualar=$product->get_regular_price();
    $salePrice=$product->get_sale_price();
    $currency_symbol = get_woocommerce_currency_symbol();
    $discount=$regualar !== $price  ? ($regualar -  $price) / $regualar * 100 . '%': null;
    $h   ="<div class='price'> <p class='salePrice'> $price $currency_symbol  </p> <p class='discount'> $discount </p></div>";
    echo $h;
}

add_action('woocommerce_before_single_product_summary', 'before_single_product_summary_wrapper', 5);
function before_single_product_summary_wrapper(){
    echo '<div class="singleProductTopSection cardItem">';
}

 add_action('woocommerce_after_single_product_summary', 'after_single_product_summary_wrapper', 5);
function after_single_product_summary_wrapper(){
    echo '</div>';
}

/* add to cart product in single product page */

add_action('wp_ajax_add_to_cart_in_product', 'add_to_cart_ajax_handler');
add_action('wp_ajax_nopriv_add_to_cart_in_product', 'add_to_cart_ajax_handler');
 function add_to_cart_ajax_handler()
 {
    WC()->cart->add_to_cart((int)$_POST['productId'], (int)$_POST['quantity'] );
    echo json_encode("successful");
    die();
 }
 

add_action('wp_footer', 'single_product_script', 40);
function single_product_script(){
    global $product;
    if (is_product()){
    $id = $product->get_id();
    ?>
    <script type="text/javascript">
    jQuery(function($){
        const ajaxURL = $("body").attr("data-ajax-url");
        const productId= <?php echo $id; ?> 

        var myToast = Toastify({
                 text: "The product added to your cart.",
                 duration: 3000
                 })

        $(".single-product .single_add_to_cart_button").on("click", function (e) {
		e.preventDefault();
		jQuery.ajax({
			type: "post",
			url: "<?php echo  admin_url( 'admin-ajax.php' ) ?>",
			data: {
				action: "add_to_cart_in_product", 
				productId: productId,
                quantity:Number($(".single-product .cart input").val()) 
            },
			complete: function (response) {
                console.log(response);
                if (response.status == 200){
                let cartHTML = $('.single-product .mid .header-cart-quantity').html()
                let cartCount = $('.single-product .mid .header-cart-quantity').html()
                $('.single-product .mid .header-cart-quantity').html(Number(cartCount)+Number($(".single-product .cart input").val()) ) 
                $(".single-product .cart input").val('1')
                myToast.showToast();
                }else{
                    console.log("something is wrong")
                }

			},
		});
	});
    });
    </script>
<?php
}
} 

/*  SIngle product page quantity btns */
add_action( 'woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_plus' );
function bbloomer_display_quantity_plus() {
   echo '<button type="button" class="plus">+</button>';
}
  
add_action( 'woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus' );
function bbloomer_display_quantity_minus() {
   echo '<button type="button" class="minus">-</button>';
}

add_action( 'wp_footer', 'bbloomer_add_cart_quantity_plus_minus' );
function bbloomer_add_cart_quantity_plus_minus() {
   if ( ! is_product() && ! is_cart() ) return;
   wc_enqueue_js( "   
      $(document).on( 'click', 'button.plus, button.minus', function() {
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
 
         if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
               qty.val( max ).change();
            } else {
               qty.val( val + step ).change();
            }
         } else {
            if ( min && ( min >= val ) ) {
               qty.val( min ).change();
            } else if ( val > 1 ) {
               qty.val( val - step ).change();
            }
         }
 
      });
        
   " );
}
