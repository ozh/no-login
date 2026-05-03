<?php
/**
 * Plugin Name:       .No Login !!
 * Plugin URI:        http://planetozh.com/blog/my-projects/wordpress-plugin-no-login/
 * GitHub Plugin URI: https://github.com/ozh/no-login
 * Description:       Never authenticate, you're always the admin. Obviously for test sites!
 * Version:           1.2
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
    add_action( 'wp_footer', 'ozh_nologin_admin_css' );
    add_action( 'wp_before_admin_bar_render', 'ozh_nologin_custom_toolbar', 999 );
}

function ozh_nologin_admin_css() {
    echo '
    <style>
    #wp-admin-bar-debug-bar-no-login > .ab-item {
        color:red;
        font-weight:bolder;
        background: rgb(254,252,234);
        background: linear-gradient(to bottom,  rgb(254,252,234) 0%,rgb(241,218,54) 100%);
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
