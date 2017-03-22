<?php
class Contact_Service {

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
        $context['data'] = $this->data;

        $contact_data = array();
        $contact_content = get_field('contact_content');
        foreach ($contact_content as $contact) {
            if ($contact['contact_method'] == 'phone') {
                $phone = $contact['phone'];
                $stripped_phone = preg_replace("/[^\d]/", "", $phone);
                $phone_formatted = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $stripped_phone);
                $link = 'tel:'.$phone_formatted;
                $label = $phone;
                $image = $context['images_uri'].'/hero_contact_option_image_phone.svg';
            } 
            elseif ($contact['contact_method'] == 'email') {
                $label = $contact['email'];
                $link = 'mailto:'.$label;
                $image = $context['images_uri'].'/hero_contact_option_image_email.svg';
            } 
            else{
                $label = $contact['address'];
                $link = $contact['map_link'].'" target="_blank';
                $image = $context['images_uri'].'/hero_contact_option_image_address.svg';
            }
            $contact_data[] = array(
                'label' => $label,
                'link' => $link,
                'image' => $image,
                'title' => $contact['option_title'],
                'content' => $contact['option_content']
            );
        }
        $context['contact_data'] = $contact_data;

        Timber::render( theme_views . '/contact.twig', $context);
    }
}