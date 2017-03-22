<?php
class Single_Service {

	public $data;

	public function __construct($data, $post_id="", $extra_data="") {

		$this->data = $data;

		$this->load_view();

	}

	public function load_view() {

		$context = Timber::get_context();

		$context['data'] = $this->data;
		$context['constants'] = get_slate_constants();

		Timber::render( theme_views . '/single.twig', $context);

	}


}
