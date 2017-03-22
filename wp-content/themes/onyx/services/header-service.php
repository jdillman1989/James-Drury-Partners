<?php
class Header_Service {

	public $data;

	public function __construct($data, $post_id="", $extra_data="") {

		$this->data = $data;

		$this->load_view();
	}

	public function load_view() {

		$context = Timber::get_context();

		$context['data'] = $this->data;
		$context['blog_url'] = _blog_url;
		$context['site_title'] = get_bloginfo('name');
		$context['theme_url'] = get_template_directory_uri();
		// $context['constants'] = get_slate_constants();

		Timber::render( theme_views . '/header.twig', $context);
	}
}
