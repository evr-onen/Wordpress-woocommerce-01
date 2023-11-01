<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

	<?php wp_head(); ?>
</head>
<body <?php body_class( 'woocommerce' ); ?> data-ajax-url="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
<div class="page w-full flex flex-col items-center min-h-screen "> 

<header>
<div class="top">
    <div class="top-wrapper">
        <div class="right">
            <div class=""> login | register</div>
        </div>
    </div>
</div>
<div class="mid">
    <div class=""></div>
    <div class="logo">LOGO</div>

    <div class="mid-right">
        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><svg width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_15_82)">
<rect width="24" height="24" fill="white"/>
<g filter="url(#filter0_d_15_82)">
<path d="M14.3365 12.3466L14.0765 11.9195C13.9082 12.022 13.8158 12.2137 13.8405 12.4092C13.8651 12.6046 14.0022 12.7674 14.1907 12.8249L14.3365 12.3466ZM9.6634 12.3466L9.80923 12.8249C9.99769 12.7674 10.1348 12.6046 10.1595 12.4092C10.1841 12.2137 10.0917 12.022 9.92339 11.9195L9.6634 12.3466ZM4.06161 19.002L3.56544 18.9402L4.06161 19.002ZM19.9383 19.002L20.4345 18.9402L19.9383 19.002ZM16 8.5C16 9.94799 15.2309 11.2168 14.0765 11.9195L14.5965 12.7737C16.0365 11.8971 17 10.3113 17 8.5H16ZM12 4.5C14.2091 4.5 16 6.29086 16 8.5H17C17 5.73858 14.7614 3.5 12 3.5V4.5ZM7.99996 8.5C7.99996 6.29086 9.79082 4.5 12 4.5V3.5C9.23854 3.5 6.99996 5.73858 6.99996 8.5H7.99996ZM9.92339 11.9195C8.76904 11.2168 7.99996 9.948 7.99996 8.5H6.99996C6.99996 10.3113 7.96342 11.8971 9.40342 12.7737L9.92339 11.9195ZM9.51758 11.8683C6.36083 12.8309 3.98356 15.5804 3.56544 18.9402L4.55778 19.0637C4.92638 16.1018 7.02381 13.6742 9.80923 12.8249L9.51758 11.8683ZM3.56544 18.9402C3.45493 19.8282 4.19055 20.5 4.99996 20.5V19.5C4.70481 19.5 4.53188 19.2719 4.55778 19.0637L3.56544 18.9402ZM4.99996 20.5H19V19.5H4.99996V20.5ZM19 20.5C19.8094 20.5 20.545 19.8282 20.4345 18.9402L19.4421 19.0637C19.468 19.2719 19.2951 19.5 19 19.5V20.5ZM20.4345 18.9402C20.0164 15.5804 17.6391 12.8309 14.4823 11.8683L14.1907 12.8249C16.9761 13.6742 19.0735 16.1018 19.4421 19.0637L20.4345 18.9402Z" fill="#000000"/>
</g>
</g>
<defs>
<filter id="filter0_d_15_82" x="2.55444" y="3.5" width="18.8911" height="19" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dy="1"/>
<feGaussianBlur stdDeviation="0.5"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_15_82"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_15_82" result="shape"/>
</filter>
<clipPath id="clip0_15_82">
<rect width="24" height="24" fill="white"/>
</clipPath>
</defs>
</svg></a>

        
        <a class="cart" href="<?php echo wc_get_cart_url() ?>">
            <svg class="cart-svg" width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="24" height="24" fill="white"/>
                <path d="M9 9H6.84713C6.35829 9 5.9411 9.35341 5.86073 9.8356L4.19407 19.8356C4.09248 20.4451 4.56252 21 5.18046 21H18.8195C19.4375 21 19.9075 20.4451 19.8059 19.8356L18.1393 9.8356C18.0589 9.35341 17.6417 9 17.1529 9H15M9 9H15M9 9C8.66667 7.66667 8 3 12 3C16 3 15.3333 7.66667 15 9" stroke="#000000" stroke-linejoin="round"/>
            </svg>
            <span class="header-cart-quantity"><?php echo WC()->cart->get_cart_contents_count() ?></span>
        </a>
    </div>
</div>
<div class="bot">
    <?php wp_nav_menu(array(
    'theme_location' => 'primary-menu', 
    'menu_id' => 'main-menu',
    'container' => 'nav', 
    'container_id' => 'menu-container', 
)); ?>
</div>

</header>

 