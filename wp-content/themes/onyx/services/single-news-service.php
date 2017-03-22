<?php
class Single_News_Service {

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

		$context['post'] = get_post($this->post_id);
		$context['images_uri'] = _images_uri;
		$context['news_title'] = get_field('news_title', 'option');
		$context['news_sidebar_title'] = get_field('news_sidebar_title', 'option');
		$context['title'] = get_the_title($context['post']->ID);
		$context['post_content'] = apply_filters( 'the_content', $context['post']->post_content );
		$context['news_image'] = get_field('news_image', 'option');

		$post_date = get_field('date', $context['post']->ID);
		if (strlen($post_date) < 2) {
			$post_date = get_the_date(get_option('date_format'), $context['post']->ID);
		}
		$context['post_date'] = $post_date;

		$context['social_url'] = urlencode(get_permalink($context['post']->ID));

		$next_post = get_adjacent_post(false, '', false);
		if(!empty($next_post)) {
			$context['next_post'] = get_permalink($next_post->ID);
		}

		$context['blog_url'] = _blog_url;

		Timber::render( theme_views . '/single-news.twig', $context);
	}
}
