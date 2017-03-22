<?php
class _Container {

	public function __construct($service, $post_id="", $extra_data="") {

		$slug = strtolower(str_replace('_', '-', $service));

		// Get any data this service requires.
		$data_service = new Data_Service($slug, $post_id);
		$data = $data_service->get_data();

		new $service($data, $post_id, $extra_data);

	}

}
