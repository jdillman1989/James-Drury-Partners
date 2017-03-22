<?php
/**
 * Slate ACF
 *
 * Sets the local JSON storage for the Advanced Custom Fields plugin to be stored inside
 * the Slate plugin. This way if the theme is deactived data isn't lost.
 *
 * @since 1.0
 *
 * @package WordPress
 * @subpackage Slate
 */

class Slate_ACF {

    public function __construct() {

        /**
         * Change the ACF JSON save path.
         *
         * This filter is used to change the path with which Advanced Custom Fields stores it's
         * JSON field data.
         *
         * @see http://www.advancedcustomfields.com/resources/local-json/
         */

        add_filter('acf/settings/save_json', array($this, 'set_json_save_point'));

        /**
         * Change the ACF JSON load path.
         *
         * This filter is used to change the path with which Advanced Custom Fields loads it's
         * JSON field data.
         *
         * @see http://www.advancedcustomfields.com/resources/local-json/
         */

        add_filter('acf/settings/load_json', array($this, 'set_json_load_point'));

    }

    /**
     * Sets the ACF JSON save path.
     *
     * Changes the path that Advanced Custom Field uses to store it's JSON field data.
     *
     * @since 1.0
     *
     * @param string $path The default path used by Advanced Custom Fields.
     * @return string The new path for Advaned Custom Fields to use.
     */

    public function set_json_save_point($path) {

        return slate_path . '/slate-acf-json';

    }

    /**
     * Sets the ACF JSON load path.
     *
     * Changes the path that Advanced Custom Field uses to load it's JSON field data.
     *
     * @since 1.0
     *
     * @param array $paths The paths being used by ACF to load the JSON data.
     * @return array $paths The updated array containing the paths ACF uses to load JSON data.
     */

    public function set_json_load_point($paths) {

        // Remove the original path.
        unset($paths[0]);

        // Set the new path.
        $paths[] = slate_path . '/slate-acf-json';

        return $paths;

    }

}