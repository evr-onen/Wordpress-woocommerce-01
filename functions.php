<?php
include 'inc/woo.php';



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


function disable_woocommerce_styles($enqueue_styles) {
    unset($enqueue_styles['woocommerce-general']);
    unset($enqueue_styles['woocommerce-layout']);
    unset($enqueue_styles['woocommerce-smallscreen']);
    return $enqueue_styles;
}

add_filter('woocommerce_enqueue_styles', 'disable_woocommerce_styles');

//                                                             filter function to disable TinyMCE emojicons
function disable_emojicons_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

function disable_wp_emojicons()
{

    //                                                          all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    // filter to remove TinyMCE emojis
    add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}
add_action('init', 'disable_wp_emojicons'); // hook into init and remove actions

add_filter( 'upload_mimes', 'my_myme_types', 1, 1 );
function my_myme_types( $mime_types )
{
    $mime_types['webp'] = 'image/webp';     // Adding .webp extension

//  unset( $mime_types['xls'] );  // Remove .xls extension
//  unset( $mime_types['xlsx'] ); // Remove .xlsx extension

    return $mime_types;
}

function load_css()
{
    wp_enqueue_style('tailwindcss_output', get_template_directory_uri().'/dist/output.css' );
    wp_enqueue_style('toast', get_template_directory_uri().'/assets/toast/toastify.css' );
    wp_enqueue_style('swiper','https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css' );
    wp_enqueue_style('css', get_stylesheet_uri());
} 
 
add_action('wp_enqueue_scripts', 'load_css');    
// wp_enqueue_script( 'my-great-script', get_template_directory_uri() . '/js/my-great-script.js', array( 'jquery' ), '1.0.0', true );

function load_js()
{
    wp_register_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), false, false);
    wp_enqueue_script('swiper');
    wp_register_script('toast', get_template_directory_uri() . '/assets/toast/toastify.js', array('jquery'), false, false);
    wp_enqueue_script('toast');
    wp_register_script('main', get_template_directory_uri() . '/scripts/main.js', array('jquery'), false, true);
    wp_enqueue_script('main');

    wp_localize_script('main', 'siteData', array(
        'root_url' => get_site_url(),
        'ajaxURL' => admin_url( 'admin-ajax.php' ),
      ));
}

add_action('wp_enqueue_scripts', 'load_js');

function load_fonts()
{
    wp_enqueue_style('fonts', "https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600&family=Roboto+Condensed:wght@300;400;700&family=Roboto:wght@100;300;400;500&display=swap");
   
}
add_action('wp_enqueue_scripts', 'load_fonts');

/* theme menus */
function custom_theme_menus() {
    register_nav_menu('primary-menu', __('Header' , 'theme'));  
    register_nav_menu('footer-menu', __('Footer' , 'theme'));
}
add_action('after_setup_theme', 'custom_theme_menus');



