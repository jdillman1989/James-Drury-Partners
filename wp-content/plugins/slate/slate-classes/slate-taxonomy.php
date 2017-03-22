<?php
/**
 * Slate Taxonomy
 *
 * Wrapped for the WordPress register taxonomy functionality. Eases the process of creating new
 * taxonomies and sets commonly used defaults.
 *
 * @since 1.0
 *
 * @package WordPress
 * @subpackage Slate
 */

class Slate_Taxonomy {

    /**
     * The name of the taxonomy.
     *
     * @since 1.0
     * @access public
     * @var string
     */
    public $name;

    /**
     * The name of the post type this taxonomy belongs to.
     *
     * @since 1.0
     * @access public
     * @var string|array
     */
    public $post_type;

    /**
     * Optional array of arguments to pass to the taxonomy.
     *
     * @since 1.0
     * @access public
     * @var array
     */
    public $args;

    public function __construct($name, $post_type, $args="") {

        // Set the class properties and argument defaults.
        $this->set_defaults($name, $post_type, $args);

        register_taxonomy($this->args['slug'], $this->post_type, $this->args);

    }

    /**
     * Sets up the class properties and defines default values for the arguments.
     *
     * @since 1.0
     *
     * @param string $name The name of the taxonomy.
     * @param string|array $post_type The name of the post type or types that this taxonomy belongs to.
     * @param array $args Optional. An array of arguments for the register_taxonomy function.
     */

    public function set_defaults($name, $post_type, $args="") {

        // Set the class properties.

        $this->name      = $name;
        $this->post_type = $post_type;
        $this->args      = $args;

        // If a slug isn't already set then create one from the name.
        if(!isset($this->args['slug'])) {

            $this->args['slug'] = sanitize_title($this->name);

        }

        // Most of the time taxonomies will be hierarchical like categories.
        if(!isset($this->args['hierarchical'])) {

            $this->args['hierarchical'] = true;

        }

        // If labels aren't defined then set one with the name.
        if(!isset($this->args['label']) && !isset($this->args['labels'])) {

            $this->args['label'] = $this->name;

        }

    }

}