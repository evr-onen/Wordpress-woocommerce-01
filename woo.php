<?php
/* wc support'ları */
function theme_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,

		'product_grid' => array(
			'default_rows'    => 3,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 4,
			'min_columns'     => 2,
			'max_columns'     => 5,
		),
	) );
}

add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


add_filter( 'wc_product_sku_enabled', '__return_false' );
																				/* remove clear variations btn */
add_filter('woocommerce_reset_variations_link', '__return_empty_string');


																		/* Remove "in stock" text form single products */
function remove_in_stock_text_form_single_products( $html, $text, $product ) {
	$availability = $product->get_availability();
	if ( isset( $availability['class'] ) && 'in-stock' === $availability['class'] ) {
		return '';
	}
	return $html;
}
add_filter( 'woocommerce_stock_html', 'remove_in_stock_text_form_single_products', 10, 3 );












// add_action( 'woocommerce_before_single_product_summary', 'product_slider', 5, 3 );



// function product_slider() {
// 	global $product;

// 	$h = '';
// 	$h = '<div class="product-name-price" >';
// 	$h = '<div class="name" >'. $product->get_name() .'</div>' ;
// 	$h = '<div class="price" >'. $product->get_name() .'</div>' ;
// 	$h = '</div>';

// 	$h .= '<div class="product-page-slider" >';

// 	$h .= '<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper-container mySwiper2">';
// 	$h .= '<div class="swiper-wrapper">';

// 	$gallery_img_ids = $product->get_gallery_image_ids();
// 	foreach ( $gallery_img_ids as $item_id ):
// 		$item_img     = wp_get_attachment_image_src( $item_id, 'full' );
// 		$item_img_url = $item_img[0];

// 		$h .= '<div class="swiper-slide">';
// 		$h .= '<img src="' . $item_img_url . '" alt="">';
// 		$h .= '</div>';
// 	endforeach;


// 	$h .= '</div>';
// 	$h .= '<div class="swiper-button-next"></div>';
// 	$h .= '<div class="swiper-button-prev"></div>';
// 	$h .= '</div>';
// 	$h .= '<div thumbsSlider="" class="swiper-container mySwiper">';
// 	$h .= '<div class="swiper-wrapper">';

// 	$gallery_thumb_ids = $product->get_gallery_image_ids();
// 	foreach ( $gallery_thumb_ids as $item_id ):
// 		$item_img     = wp_get_attachment_image_src( $item_id, 'thumbnails' );
// 		$item_img_url = $item_img[0];


// 		$h .= '<div class="swiper-slide swiper-thumb">';
// 		$h .= '<img src="' . $item_img_url . '" />';
// 		$h .= '</div>';

// 	endforeach;
// 	$h .= '</div>';
// 	$h .= '</div>';
// 	$h .= '</div>';

// 	$h .='<div class="product-desc-wrapper"> ';
// 	$h .= '<div class="product-description">';
// 	if(have_rows('description_product')):while(have_rows('description_product')):
// 	the_row();
// 	$desc_text=get_sub_field('one_cikan_ozellikler');

// 		$h .= '<div class="product-description-text">';
// 		$h .= '<span class="title">Öne Çıkan Özellikler</span> ';
// 		$h .= '<div class="desc">';
// 		$h .=  $desc_text;

// 		$h .= '</div> ';

// 	endwhile;

// 	endif;



// 	$h .= '</div>';

// 	if ( have_rows( 'description_product' ) ):while ( have_rows( 'description_product' ) ):
// 		the_row();
// 		if ( have_rows( 'description_item' ) ):while ( have_rows( 'description_item' ) ):
// 			the_row();
// 		$image=get_sub_field( 'description_image' );
// 			$image_url=$image['sizes']['product_description_image'];
// 			$h .=      '<div class="item">';
// 			$h .=			'<div class="image-wrapper"><img src="' . $image_url . '" ></div>';
// 			$h .=			'<div class="text">';
// 			$h .=				'<div class="title">'. get_sub_field( 'description_title' ) . '</div>';
// 			$h .=				'<div class="desc">'.  get_sub_field( 'description_text' )  . '</div>';
// 			$h .=			'</div>';
// 			$h .=		'</div>';


// 		endwhile;
// 		endif;

// 	endwhile;
// 	endif;
// 	$h .= '</div>';
// 	$h .= '</div>';

// 	$h .=		'<div class="entry-summary-wrapper" >';
// 	$h .=		'<div class="title" >'. $product->get_name() .'</div>';
// 	$h .=		'<div class="product-price" > &#8378;</div>';

// 	$h .=		'<div class="havale-price" >'. get_field('havale_fiyati') .' &#8378;</div>';
// 	$h .=		'<div class="product-summery" >';

// 	echo $h;
// }
// add_action( 'woocommerce_after_single_product_summary', 'product_summery_wrapper', 5, 3 );
// function product_summery_wrapper(){
// 	$h ='';

// 	$h .=' <div class="product-tabs" > ';

// 	$h .=			 '<div class="wrapper">';


// 	$h .=	        '<input type="radio" name="slider" checked id="home">';
// 	$h .=	        '<input type="radio" name="slider" id="blog">';
// 	$h .=	        '<input type="radio" name="slider" id="code">';
// 	$h .=			'<input type="radio" name="slider" id="help">';

// 	$h .=	        	'<nav>';
// 	$h .=			            '<label for="home" class="home noselect"><i class="fas fa-info-circle"></i>Detaylar</label>';
// 	$h .=			            '<label for="blog" class="blog noselect"><i class="fas fa-cogs"></i>Teknik</label>';
// 	$h .=			            '<label for="code" class="code noselect"><i class="far fa-file-video"></i>Dökümanlar</label>';
// 	$h .=			            '<label for="help" class="help noselect"><i class="fas fa-box-open"></i>Kutu İçeriği</label>';

// 	$h .=			            '<div class="slider"></div>';
// 	$h .=			     '</nav>';
// 	$h .=			        '<section>';
// 	$h .=			            '<div class="content content-1">';
// 	$h .=                           '<div>'.  get_field('detaylar') .'</div>';
// 	$h .=			             '</div>';
// 	$h .=			             '<div class="content content-2">';
// 	$h .=			                '<div id="accordion">';

// /* 2 */

// 	if(have_rows('technic_details')):while(have_rows('technic_details')):the_row();

// 	if(have_rows('item')):while(have_rows('item')):the_row();





// 	$h .=                               '<div>';
//     $h .=                                   "<input name='accordion' type='radio' id='title-". get_sub_field('sira')  ."'>";

//     $h .=                                   "<label for='title-". get_sub_field('sira') ."'>". get_sub_field("title") ."</label>";

//     $h .=                                   '<div class="desc">';
// 	if(have_rows('satirlar')):while(have_rows('satirlar')):the_row();
// 	$h .=	                                    '<div class="wrapper" >';
// 	$h .=	                                         '<div class="titl" >'.get_sub_field('baslik') .'</div>';
// 	$h .=	                                          '<div class="descr" >'.get_sub_field('aciklama'). '</div>';
// 	$h .=                                       '</div>';
// 	endwhile; endif;
// 	$h .=                                   '</div>';

// 	$h .=                       '</div>';
// 		 endwhile; endif;endwhile; endif;
// 		$h .=       '</div>';


// 		$h .=                '</div>';








//     /*$h .=    '<div>';
//     $h .=        '<input name="accordion" type="radio" id="title-2">';
//     $h .=        '<label for="title-2">Elektrik/Elektronik Komponentleri</label>';
//     $h .=       '<div class="desc">desc 2</div>';
//     $h .=    '</div>';

//     $h .=    '<div>';
//     $h .=        '<input name="accordion" type="radio" id="title-3">';
//     $h .=        '<label for="title-3">Bisiklet Komponentleri</label>';
//     $h .=        '<div class="desc">desc 3</div>';
//     $h .=   '</div>*/













// 	$h .=			            '<div class="content content-3">';
// 	$h .=			                '<div class="title">This is a Code content</div>';
// 	$h .=			                '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, debitis nesciunt! Consectetur officiis, libero nobis dolorem pariatur quisquam temporibus. Labore quaerat neque facere itaque laudantium odit veniam consectetur numquam delectus aspernatur, perferendis repellat illo sequi excepturi quos ipsam aliquid est consequuntur.</p></div>';
// 	$h .=			            '<div class="content content-4">';
// 	$h .=			                '<div class="title">This is a Help content</div>';
// 	$h .=			                '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim reprehenderit null itaq, odio repellat asperiores vel voluptatem magnam praesentium, eveniet iure ab facere officiis. Quod sequi vel, rem quam provident soluta nihil, eos. Illo oditu omnis cumque praesentium voluptate maxime voluptatibus facilis nulla ipsam quidem mollitia! Veniam, fuga, possimus. Commodi, fugiat aut ut quorioms stu necessitatibus, cumque laborum rem provident tenetur.</p></div>';


// 	$h .=			        '</section>';
// 	$h .=			        '</div></div>';









// 	$h .='</div>';
// 	$h .='</div>';
// 	$h .='<div class="product-bottom" >';
// 	$h .='<div class="left" >';
// 	$h .='<div class="brand-title" >'. get_field('brand_name', 'option').'</div>';
// 	$h .='<div class="brand-address" >'. get_field('brand_address', 'option').'</div>';
// 	$h .='<div class="brand-comminication" >'. get_field('brand_comminication', 'option').'</div>';
// 	if(get_field('extra_note', 'option')): $h .='<div class="brand-note" >'. get_field('extra_note', 'option').'</div>'; endif;



// 	$h .='</div>';
// 	$h .='<div class="right" >';
// 	$h .=   '<div class="right-left">';
//      $h .=      '<div >';
//      $h .='<div class="product-price"></div>';
//      $h .='* '. get_field('product_note');
//      $h .='</div>';
//      $h .='<div class="havale" >' . get_field('havale_fiyati') .'</div></div>';
// 	 $h .='<div class="cart-button">Add To Cart </div> ';





// 	echo $h;
// }

/* radio btn yapma işlemi js'de de dosyalar var yoksa etkileşim olmuyor  */
// function variation_radio_buttons($html, $args) {
// 	$args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
// 		'options'          => false,
// 		'attribute'        => false,
// 		'product'          => false,
// 		'selected'         => false,
// 		'name'             => '',
// 		'id'               => '',
// 		'class'            => '',
// 		'show_option_none' => __('Choose an option', 'woocommerce'),
// 	));

// 	if(false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
// 		$selected_key     = 'attribute_'.sanitize_title($args['attribute']);
// 		$args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
// 	}

// 	$options               = $args['options'];
// 	$product               = $args['product'];
// 	$attribute             = $args['attribute'];
// 	$name                  = $args['name'] ? $args['name'] : 'attribute_'.sanitize_title($attribute);
// 	$id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
// 	$class                 = $args['class'];
// 	$show_option_none      = (bool)$args['show_option_none'];
// 	$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce');

// 	if(empty($options) && !empty($product) && !empty($attribute)) {
// 		$attributes = $product->get_variation_attributes();
// 		$options    = $attributes[$attribute];
// 	}

// 	$radios = '<div class="variation-radios">';

// 	if(!empty($options)) {
// 		if($product && taxonomy_exists($attribute)) {
// 			$terms = wc_get_product_terms($product->get_id(), $attribute, array(
// 				'fields' => 'all',
// 			));

// 			foreach($terms as $term) {
// 				if(in_array($term->slug, $options, true)) {
// 					$id = $name.'-'.$term->slug;
// 					$radios .= '<input  type="radio" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($term->slug).'" '.checked(sanitize_title($args['selected']), $term->slug, false).'><label for="'.esc_attr($id).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $term->name)).'</label>';
// 				}
// 			}
// 		} else {
// 			foreach($options as $option) {
// 				$id = $name.'-'.$option;
// 				$checked    = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
// 				$radios    .= '<input type="radio" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($option).'" id="'.sanitize_title($option).'" '.$checked.'><label for="'.esc_attr($id).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $option)).'</label>';
// 			}
// 		}
// 	}

// 	$radios .= '</div>';

// 	return $html.$radios;
// }
// add_filter('woocommerce_dropdown_variation_attribute_options_html', 'variation_radio_buttons', 20, 2);

// function variation_check($active, $variation) {
// 	if(!$variation->is_in_stock() && !$variation->backorders_allowed()) {
// 		return false;
// 	}
// 	return $active;
// }
// add_filter('woocommerce_variation_is_active', 'variation_check', 10, 2);


																	/* variation radio buton haline getirme bitti  */

/*function move_variation_price() {
	remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
	add_action( 'woocommerce_after_add_to_cart_quantity', 'woocommerce_single_variation', 10 );
}
add_action( 'woocommerce_before_add_to_cart_form', 'move_variation_price' );*/


																		/* variation btn u silme ve yerini değiştirme */

/*function remove_loop_button(){
	remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
}
add_action('init','remove_loop_button');
*/
								/* add to cart ekleme ama başarılı olamadı submit etmedi nedeni bilinmiyor */
/*add_action( 'woocommerce_after_single_product_summary', 'woocommerce_single_variation_add_to_cart_button', 30 );*/



// add_action( 'woocommerce_after_single_product_summary', 'product_bottom_wrapper', 35 );
// function product_bottom_wrapper(){

// 	echo '</div>';
// 	echo '</div>';


// }



