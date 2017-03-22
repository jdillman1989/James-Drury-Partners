<?php
class Firm_Service {

    public $data;

    public function __construct($data, $post_id="", $extra_data="") {

        $this->data = $data;

        $this->load_view();

    }

    public function load_view() {

        global $post;
        setup_postdata($post);

        $context = Timber::get_context();
        $context['images_uri'] = _images_uri;
        $context['theme_url'] = get_template_directory_uri();
        $context['data'] = $this->data;

        $sources = '';
        $content_video_sources = get_field('content_video_sources');
        foreach($content_video_sources as $source) {
            $file_type = substr(strrchr($source['content_video_source_file'], "."), 1);
            $sources .= '<source src="'.$source['content_video_source_file'].'" type="video/'.$file_type.'">';
        }
        $context['sources'] = $sources;

        $content_video_text = get_field('content_video_text');
        $drop_cap = substr($content_video_text, 0, 1);
        $not_drop_cap = substr($content_video_text, 1);
        $context['drop_cap'] = $drop_cap;
        $context['not_drop_cap'] = $not_drop_cap;

        Timber::render( theme_views . '/firm.twig', $context);
    }
}