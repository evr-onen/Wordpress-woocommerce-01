<?php
function ppwp_custom_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
background-image: url(https://passwordprotectwp.com/wp-content/themes/ppwp/img/ppwp-org-logo.png);
        height:100px;
        width:300px;
        background-size: 300px 100px;
        background-repeat: no-repeat;
        padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'ppwp_custom_login_logo' );



