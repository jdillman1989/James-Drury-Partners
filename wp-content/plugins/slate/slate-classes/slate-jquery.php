<?php
/**
 * Slate JQuery
 *
 * Replaces the default WordPress jQuery with the Google CDN jQuery.
 *
 * @since 1.0
 *
 * @package WordPress
 * @subpackage Slate
 */

class Slate_Jquery {

    public function __construct() {

        // Remove the default jQuery.
        wp_deregister_script('jquery');

        // Load the Google CDN jQuery.
        new Slate_JS('jquery', array(
            'src' => '//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js',
            'ver' => '1.12.0'
        ));

    }

}
