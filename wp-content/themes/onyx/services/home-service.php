<?php
class Home_Service {

	public $data;

	public function __construct($data, $post_id="", $extra_data="") {

		$this->data = $data;

		$this->load_view();

	}

	public function load_view() {

        global $post;
        setup_postdata($post);

		$context = Timber::get_context();

		$context['data'] = $this->data;
		$context['theme_url'] = get_template_directory_uri();

		include_once 'twitter-service.php';
		$tweets = array();
		foreach ($twitter_posts as $tweet) {
			$twitter_endpoint = 'https://publish.twitter.com/oembed?url=https://twitter.com/JDruryPartners/status/'.$tweet['id_str'];
			$twitter_json = file_get_contents($twitter_endpoint);
			$tweet_data = json_decode($twitter_json, true);
			$tweets[] = array('html' => $tweet_data['html']);
		}

		$context['tweets'] = $tweets;

		Timber::render( theme_views . '/home.twig', $context);
	}
}
