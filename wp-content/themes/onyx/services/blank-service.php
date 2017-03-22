<?php
class Blank_Service {

	public $data;
	public $post_id;

	public function __construct($data, $post_id="", $extra_data="") {

		$this->data = $data;
		$this->post_id = $post_id;

		$this->load_view();

	}

	public function load_view() {

		$context = Timber::get_context();

		$context['data'] = $this->data;
		$context['constants'] = get_slate_constants();

		Timber::render( theme_views . '/blank.twig', $context);

	}


}
