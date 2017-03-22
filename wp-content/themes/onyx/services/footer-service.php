<?php
class Footer_Service {

	public $data;

	public function __construct($data, $post_id="", $extra_data="") {

		$this->data = $data;

		$this->load_view();
	}

	public function load_view() {

		$context = Timber::get_context();

		$context['data'] = $this->data;
		$context['blog_url'] = _blog_url;
		$context['theme_url'] = get_template_directory_uri();
		$context['site_links'] = get_field('site_links', 'options');

		$phone = get_field('phone', 'options');
		$stripped_phone = preg_replace("/[^\d]/", "", $phone);
		$phone_formatted = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $stripped_phone);

		$context['phone_formatted'] = $phone_formatted;
		$context['phone'] = $phone;

		$context['site_title'] = get_bloginfo('name');
		$context['year'] = date("Y");
		// $context['constants'] = get_slate_constants();

		Timber::render( theme_views . '/footer.twig', $context);
	}
}
