<?php
/**
 * Slate Functions
 *
 * Utility functions and theme settings.
 *
 * @since 1.0
 *
 * @package WordPress
 * @subpackage Slate
 */

add_action('after_setup_theme', 'slate_theme_support');

/**
 * Sets theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook. This runs before the init
 * hook.
 *
 * @since 1.0
 */

function slate_theme_support() {

    /**
     * Register theme support for post thumbnails.
     */
    add_theme_support( 'post-thumbnails' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

}

/**
 * Simple error logging.
 *
 * Uses the system console to store debug information. Automatically parses arrays.
 *
 * @since 1.0
 *
 * @param int|string|array $input The debug information.
 *
 * @return int|string|array Returns information to the system console.
 */

function _log($input) {

    error_log(print_r($input, true));

}

function wp_get_thumbnail_url($post_id, $size="full") {

    $thumb_id = get_post_thumbnail_id($post_id);
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, $size);
    $thumb_url = $thumb_url_array[0];

    return $thumb_url;

}

function bg_style($image) {

    if(isset($image['url'])) {

        return 'background-image: url(' . $image['url'] . ');';

    }

    return;

}

function silo($fields, $prefix="", $option="", $post_id="") {

    $silo = array();

    if(is_array($fields)) {

        foreach($fields as $field) {

            $field_value = '';

            if($prefix) {

                $field_value .= $prefix;

            }

            $field_value .= $field;

            if($option) {

                $silo[$field] = get_field($field_value, 'option');

            } elseif($post_id) {

                $silo[$field] = get_field($field_value, $post_id);

            } else {

                $silo[$field] = get_field($field_value);

            }

        }

        return $silo;

    }

    return;

}

function _exists($var) {

    if( isset($var) && !empty($var) ) {
        return true;
    }

    return false;

}

function get_slate_constants() {

  $constants = array(
    'blog_name'    => _blog_name,
    'blog_url'     => _blog_url,
    'template_uri' => _template_uri,
    'template_dir' => _template_dir,
    'theme_views'  => theme_views,
    'assets_uri'   => _assets_uri,
    'css_uri'      => _css_uri,
    'js_uri'       => _js_uri,
    'images_uri'   => _images_uri,
    'vendor_uri'   => _vendor_uri
  );

  return $constants;
}
