<?php
class Archive_News_Service {

	public $data;

	public function __construct($data, $post_id="", $extra_data="") {

		$this->data = $data;

		$this->load_view();

	}

	public function load_view() {

		$context = Timber::get_context();
		$context['images_uri'] = _images_uri;

		$context['news_title'] = get_field('news_title', 'option');
		$context['news_sidebar_title'] = get_field('news_sidebar_title', 'option');
		$context['news_image'] = get_field('news_image', 'option');

		// Get news posts.
		$news_data = array();
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$news_args = array(
			'post_type' => 'news',
			'posts_per_page' => get_option('posts_per_page'),
			'paged' => $paged,
		);
		$news = new WP_Query($news_args);

		if( $news->have_posts() ) {

			$news_data = array();

			while($news->have_posts()) {
				$news->the_post();
				$news_id = get_the_ID();

				$post_image = get_field('image');
				$post_date = get_field('date');
				if (strlen($post_date) < 2) {
					$post_date = get_the_date();
				}

				$news_data[] = array(
					'title' => get_the_title($news_id),
					'date' => $post_date,
					'image' => $post_image,
					'permalink' => get_permalink($news_id)
				);
			}
			wp_reset_postdata();
		}
		$context['news_data'] = $news_data;

		$pagination = array();
		$context['max_pages'] = $news->max_num_pages;

		if ($context['max_pages'] < 6) {
			$x = 1;
		} 
		else {
			$x = 4;
		}
		
		if ($context['max_pages'] > 3) {
			for ($i=1; $i <= $x; $i++) {
				$active = '';
				if ($i == $paged) {
					$active = ' active';
				}
				$pagination[] = array(
					'link' => '/news/page/'.$i,
					'active' => $active,
					'number' => $i
				);
			}
		}
		$context['pagination'] = $pagination;

		$prev = $paged - 1;
		$next = $paged + 1;
		$context['next_link'] = '/news/page/'.$next;
		$context['prev_link'] = '/news/page/'.$prev;

		if ($next >= $context['max_pages']) {
			$context['next_link_disabled'] = ' disabled';
		} 
		elseif ($prev < 1) {
			$context['prev_link_disabled'] = ' disabled';
		}
		else{
			$context['next_link_disabled'] = '';
			$context['prev_link_disabled'] = '';
		}
		

		include_once 'twitter-service.php';
		$tweets = array();
		foreach ($twitter_posts as $tweet) {
			$twitter_endpoint = 'https://publish.twitter.com/oembed?url=https://twitter.com/JDruryPartners/status/'.$tweet['id_str'];
			$twitter_json = file_get_contents($twitter_endpoint);
			$tweet_data = json_decode($twitter_json, true);
			$tweets[] = array('html' => $tweet_data['html']);
		}

		$context['tweets'] = $tweets;

		Timber::render( theme_views . '/archive-news.twig', $context);
	}
}
