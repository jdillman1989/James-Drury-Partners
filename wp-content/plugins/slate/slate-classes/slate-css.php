<?php
/**
 * Slate CSS
 *
 * Handles loading in new CSS files.
 *
 * @since 1.0
 *
 * @package WordPress
 * @subpackage Slate
 */

class Slate_CSS {

    /**
     * The path to the CSS file to load. Assumes that it's located in the directory specified
     * by the _css_uri constant defined in slate-constants.php
     *
     * @since 1.0
     */
    public $file;

    /**
     * Additional arguments for wp_enqueue_style. Can specify handle, source, dependencies, version
     * and media type.
     *
     * @since 1.0
     */
    public $args;

    /**
     * If this style is in the theme's vendor folder load it based on the _vendor_uri constant
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
        wp_enqueue_style($this->args['handle'], $this->args['src'], $this->args['deps'], $this->args['ver'], $this->args['media']);

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

        // If the source isn't specified then default to the CSS URL set in the slate-constants.php
        // file with the file name appended.
        if(!isset($this->args['src'])) {

            if($this->vendor == true) {

                $this->args['src'] = _vendor_uri . '/' . $this->file;

            } else {

                $this->args['src'] = _css_uri . '/' . $this->file;

            }

        }

    }

}