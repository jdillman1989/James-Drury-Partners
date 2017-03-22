<?php
/**
 * Plugin Name: Slate
 * Plugin URI: http://mccoy.io
 * Description: Simplifies the WordPress API for theme and plugin development.
 * Version: 2.0
 * Author: Brian McCoy
 * Author URI: http://mccoy.io
 */

/**
 * Include constants to be used through out Slate and the WordPress theme.
 */
require 'slate-constants.php';

/**
 * Include some utility functions.
 */
include 'slate-functions.php';

/**
 * Set up the class autoloader.
 */
require 'slate-classes/slate-autoloader.php';

/**
 * Include plugin.php so we can use the is_plugin_active function.
 */
include_once ABSPATH . 'wp-admin/includes/plugin.php';

// If Advanced Custom Fields is active set the local JSON to be stored in the Slate plugin.
if(is_plugin_active('advanced-custom-fields/acf.php') || is_plugin_active('advanced-custom-fields-pro/acf.php')) {

    /**
     * Utilize the Slate_ACF class to set the JSON storage.
     */
    $slate_acf = new Slate_ACF;

}

/**
 * Register custom post types.
 */
$slate_cpt = new Slate_Custom_Post_Types;

/**
 * Register custom taxonomies.
 */
$slate_taxonomies = new Slate_Custom_Taxonomies;
