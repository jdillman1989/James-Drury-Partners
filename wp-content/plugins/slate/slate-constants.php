<?php
/**
 * Slate Constants
 *
 * Defines several constants for use in theme and plugin development.
 *
 * @since 1.0
 *
 * @package WordPress
 * @subpackage Slate
 */

/**
 * The path to the Slate plugin directory.
 *
 * @since 1.0
 */
define('slate_path', plugin_dir_path(__FILE__));

/**
 * The path to the Slate classes directory.
 *
 * @since 1.0
 */
define('slate_classes', slate_path . 'slate-classes');

/**
 * The path to the Slate custom directory.
 *
 * @since 1.0
 */
define('slate_custom', slate_path . 'slate-custom');

/**
 * The blog title.
 *
 * @since 1.0
 */
define('_blog_name', get_bloginfo('name'));

/**
 * The blog URL.
 *
 * @since 1.0
 */
define('_blog_url', get_bloginfo('url'));

/**
 * The blog description.
 *
 * @since 1.0
 */
define('_blog_description', get_bloginfo('description'));

/**
 * The URL to the active theme directory.
 *
 * @since 1.0
 */
define('_template_uri', get_template_directory_uri());

/**
 * The path to the active theme directory.
 *
 * @since 1.0
 */
define('_template_dir', get_template_directory());

/**
 * The path to the theme classes.
 *
 * @since 1.0
 */
define('theme_classes', _template_dir . '/classes');

/**
 * The path to the theme views.
 *
 * @since 1.0
 */
define('theme_views', _template_dir . '/views');

/**
 * The URL to the active theme's assets directory.
 *
 * @since 1.0
 */
define('_assets_uri', _template_uri . '/assets');

/**
 * The URL to the active theme's CSS directory.
 *
 * @since 1.0
 */
define('_css_uri', _assets_uri . '/css');

/**
 * The URL to the active theme's JavaScript directory.
 *
 * @since 1.0
 */
define('_js_uri', _assets_uri . '/js');

/**
 * The URL to the active theme's images directory.
 *
 * @since 1.0
 */
define('_images_uri', _assets_uri . '/img');

/**
 * The URL to the active theme's vendor scripts & styles directory.
 *
 * @since 1.0
 */
define('_vendor_uri', _assets_uri . '/vendor');
