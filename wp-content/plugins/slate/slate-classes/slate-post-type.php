<?php
/**
 * Slate Post Type
 *
 * Wrapper for the WordPress register post type functionality. Eases the process of creating
 * new post types and sets commonly used defaults.
 *
 * @since 1.0
 *
 * @package WordPress
 * @subpackage Slate
 */

class Slate_Post_Type {

    /**
     * The name of the post type.
     *
     * @since 1.0
     * @access public
     * @var string
     */
    public $name;

    /**
     * Optional array of arguments to pass to the post type.
     *
     * @since 1.0
     * @access public
     * @var array
     */
    public $args;

    /**
     * Registers a post type.
     *
     * The constructor will first set up class properties and argument defaults. It will then
     * run the register_post_type function to add a new post type to WordPress.
     *
     * @since 1.0
     *
     * @param string $name The name of the post type. Usually plural.
     * @param array $args Optional. An array of arguments for the register_post_type function.
     */

    public function __construct($name, $args="") {

        // Set class properties and argument defaults.
        $this->set_defaults($name, $args);

        // Register the post type.
        $post_type = register_post_type($this->args['slug'], $this->args);

    }

    /**
     * Sets up the class properties and defines default values for the arguments.
     *
     * @since 1.0
     *
     * @param string $name The name of the post type.
     * @param array $args Optional. An array of arguments for the register_post_type function.
     */

    public function set_defaults($name, $args="") {

        $this->name = $name;
        $this->args = $args;

        // If no label is defined set it as the name.
        if(!isset($args['label']) && !isset($args['labels'])) {

            $this->args['label'] = $this->name;

        }

        // If a "slug" isn't specified go ahead and create it based on the name.
        if(!isset($args['slug'])) {

            $this->args['slug'] = sanitize_title($this->name);

        }

        // Typically you want a post type to be public.
        if(!isset($args['public'])) {

            $this->args['public'] = true;

        }

        // Typically you want a post type to have a thumbnail available.
        if(!isset($args['supports'])) {

            $this->args['supports'] = array('title', 'editor', 'thumbnail');

        }

    }

}