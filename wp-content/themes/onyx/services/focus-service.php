<?php
class Focus_Service {

    public $data;

    public function __construct($data, $post_id="", $extra_data="") {

        $this->data = $data;

        $this->load_view();

    }

    public function load_view() {

        $context = Timber::get_context();
        $context['images_uri'] = _images_uri;
        $context['theme_url'] = get_template_directory_uri();
        $context['data'] = $this->data;

        Timber::render( theme_views . '/focus.twig', $context);
    }
}