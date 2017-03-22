<?php
/**
 * Slate JS
 *
 * Handles loading in new JavaScript files.
 *
 * @since 1.0
 *
 * @package WordPress
 * @subpackage Slate
 */

class Slate_JS {

    /**
     * The path to the JavaScript file to load. Assumes that it's located in the directory specified
     * by the _js_uri constant defined in slate-constants.php
     *
     * @since 1.0
     */
    public $file;

    /**
     * Additional arguments for wp_enqueue_script. Can specify handle, source, dependencies, version
     * and in footer.
     *
     * @since 1.0
     */
    public $args;

    /**
     * If this script is in the theme's vendor folder load it based on the _vendor_uri constant
     * defined in slate-constants.php
     *
     * @since 1.0
     */
    public $vendor;

    public function __construct($file, $args="", $vendor=false) {

        $this->file = $file;
        $this->args = $args;
        $this->vendor = $vendor;

        // Set default parameters.
        $this->set_defaults();

        // Enqueue the style.
        wp_enqueue_script($this->args['handle'], $this->args['src'], $this->args['deps'], $this->args['ver'], $this->args['in_footer']);

    }

    /**
     * Analyzes the arguments supplied and sets defaults based on what's provided.
     *
     * @since 1.0
     */

    public function set_defaults() {

        // If the handle isn't supplied default to the file name.
        if(!isset($this->args['handle'])) {

            $this->args['handle'] = $this->file;

        }

        // If the source isn't specified then default to the JavaScript URL set in the
        // slate-constants.php file with the file name appended.
        if(!isset($this->args['src'])) {

            if($this->vendor == true) {

                $this->args['src'] = _vendor_uri . '/' . $this->file;

            } else {

                $this->args['src'] = _js_uri . '/' . $this->file;

            }

        }

        // If not specified assume the JavaScript should be loaded in the footer.
        if(!isset($this->args['in_footer'])) {

            $this->args['in_footer'] = true;

        }

    }

}