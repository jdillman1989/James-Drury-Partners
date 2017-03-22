<?php
class Assets_Service {

	public $data;

	public function __construct($data, $post_id="", $extra_data="") {

		$this->data = $data;

		// Hook into the wp_enqueue_scripts action to add the CSS and JavaScript requests.
        add_action('wp_enqueue_scripts', array($this, 'load_assets'));

	}

	/**
     * Load the CSS and JavaScript requests.
     */
    public function load_assets() {

        $this->load_css();

        $this->load_js();

    }

    /**
     * Load the CSS requests.
     *
     * @since 1.0
     */
    public function load_css() {

        new Slate_CSS('application.css');

    }

    /**
     * Load the JavaScript requests.
     *
     * @since 1.0
     */
    public function load_js() {

        new Slate_Jquery;
        new Slate_JS('application-vendor.js');
        new Slate_JS('application.js');
    }


}
