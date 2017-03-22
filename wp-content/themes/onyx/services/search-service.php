<?php
class Search_Service {

	public $data;

	public function __construct($data, $post_id="", $extra_data="") {

		$this->data = $data;

		$this->load_view();

	}

	public function load_view() {

		$context = Timber::get_context();
		$context['posts'] = Timber::get_posts();
		Timber::render( theme_views . '/search.twig', $context);

	}


}
