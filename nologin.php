<?php
/**
 * Plugin Name:       .No Login !!
 * Plugin URI:        http://planetozh.com/blog/my-projects/wordpress-plugin-no-login/
 * GitHub Plugin URI: https://github.com/ozh/no-login
 * Description:       Never authenticate, you're always the admin. Obviously for test sites!
 * Version:           1.1.3
 * Requires at least: 3.3
 * Requires PHP:      5.6
 * Author:            Ozh
 * Author URI:        http://planetozh.com/
 */


if (!function_exists('wp_validate_auth_cookie')) {
    function wp_validate_auth_cookie() {
       return 1;
    }
    add_action( 'admin_head', 'ozh_nologin_admin_css' );
    add_action( 'wp_before_admin_bar_render', 'ozh_nologin_custom_toolbar', 999 );
}


function ozh_nologin_admin_css() {
    echo '
    <style>
    #wp-admin-bar-debug-bar-no-login > .ab-item {
        color:red;
        font-weight:bolder;
        background-color: #ffa;
        background: rgb(254,252,234);
        background: -moz-linear-gradient(top,  rgb(254,252,234) 0%, rgb(241,218,54) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgb(254,252,234)), color-stop(100%,rgb(241,218,54)));
        background: -webkit-linear-gradient(top,  rgb(254,252,234) 0%,rgb(241,218,54) 100%);
        background: -o-linear-gradient(top,  rgb(254,252,234) 0%,rgb(241,218,54) 100%);
        background: -ms-linear-gradient(top,  rgb(254,252,234) 0%,rgb(241,218,54) 100%);
        background: linear-gradient(to bottom,  rgb(254,252,234) 0%,rgb(241,218,54) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#fefcea", endColorstr="#f1da36",GradientType=0 );
    }
    
    #wp-admin-bar-debug-bar-no-login .ab-submenu .ab-item{
        color:#ffa;
        background:red;
    }

    #wp-admin-bar-debug-bar-no-login > .ab-item:before {
        content: "\f348";
        color:red;
        display: inline-block;
        -webkit-font-smoothing: antialiased;
    }    
    </style>
    ';
}

function ozh_nologin_custom_toolbar() {
	global $wp_admin_bar;

	$args = array(
		'id'     => 'debug-bar-no-login',
		'title'  => 'No Login Mode !',
	);
	$wp_admin_bar->add_menu( $args );

	$args = array(
		'id'     => 'debug-bar-no-login-child',
		'parent' => 'debug-bar-no-login',
		'title'  => 'Everybody gets admin rights. Do not use on live sites!',
	);
	$wp_admin_bar->add_menu( $args );

}

