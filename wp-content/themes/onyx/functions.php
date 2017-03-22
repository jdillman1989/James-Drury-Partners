<?php
// functions.php
// Keep it lean and mean.

// Load the theme assets.
new _Container("Assets_Service");

// new _Container("AJAX_Service");

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Site Settings',
        'menu_title'    => 'Site Settings',
        'menu_slug'     => 'site-settings'
    ));
}

if ( function_exists( 'acf_add_options_sub_page' ) ){

    acf_add_options_sub_page(array(
        'title'      => 'Archive Landing Page',
        'parent'     => 'edit.php?post_type=news'
    ));
}

function jdp_remove_submenu() {

    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'tools.php' );
    remove_menu_page( 'themes.php' );
    remove_menu_page( 'edit.php' );
}

add_action( 'admin_menu', 'jdp_remove_submenu', 999 );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
