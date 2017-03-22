<?php
class Confirmation_Service {

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

        $phone = get_field('phone');
        $stripped_phone = preg_replace("/[^\d]/", "", $phone);
        $phone_formatted = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $stripped_phone);
        $context['phone_formatted'] = $phone_formatted;
        $context['phone'] = $phone;

        include_once 'twitter-service.php';
        $tweets = array();
        foreach ($twitter_posts as $tweet) {
            $date = $tweet['created_at'];
            $date_format = substr($date, 4, -20);

            $text = $tweet['text'];
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
            if(preg_match($reg_exUrl, $text, $url)) {
                $text_format = preg_replace($reg_exUrl, '<a href="'.$url[0].'">'.$url[0].'</a>', $text);
            } 
            else {
                $text_format = $text;
            }
            $tweets[] = array(
                'date' => $date_format,
                'text' => $text_format
            );
        }

        $context['tweets'] = $tweets;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $file = "../../site_mail.txt";
            $send_to = get_field('send_to');

            date_default_timezone_set('America/Chicago');
            $timestamp = date('l jS \of F Y h:i:s A');
            $email_content = "Sent: $timestamp\n\n";

            foreach ($_POST as $input => $value) {
                $input_name = explode( '-', $input );
                $validate = true;
                switch ($input_name[0]) {
                    case 'phone':
                        $format = filter_var(trim($value), FILTER_SANITIZE_NUMBER_INT);
                        if (strlen($format) < 10) {
                            $validate = false;
                        }
                        break;
                    case 'email':
                        $format = filter_var(trim($value), FILTER_SANITIZE_EMAIL);
                        $validate = filter_var($value, FILTER_VALIDATE_EMAIL);
                    case 'message':
                        $format = trim($value);
                    default:
                        $format = $this->filter_input($value);
                        break;
                }

                if ( $input_name[1] == 'required' && (empty($value) || !$validate)) {
                    http_response_code(400); // bad request
                    $context['intro_headline'][0]['text'] = "There was a problem";
                    $context['intro_headline'][1]['text'] = "with your submission";
                    $context['intro_content'] = "Try submitting the form again. Be sure to fill out the required fields. (error: 400)";
                    Timber::render( theme_views . '/confirmation.twig', $context);
                    die();
                }
                else{
                    if ($input_name[0] != 'button') {
                        $email_content .= $input_name[0].": " .$value."\n\n";
                    }
                }
            }

            $email_content .= "**********\n\n";
            file_put_contents($file, $email_content, FILE_APPEND | LOCK_EX);
            wp_mail($send_to, 'New Message From Website', $email_content);

            http_response_code(200); // okay
            $context['intro_headline'] = get_field('intro_headline');
            $context['intro_content'] = get_field('intro_content');
            Timber::render( theme_views . '/confirmation.twig', $context);
            die();
        } else {
            http_response_code(403); //forbidden
            $context['intro_headline'][0]['text'] = "There was a problem";
            $context['intro_headline'][1]['text'] = "with your submission";
            $context['intro_content'] = "Our server was not able to process your request. Please try again.  (error: 403)";
            Timber::render( theme_views . '/confirmation.twig', $context);
            die();
        }
    }

    public function filter_input($value){
        $return = strip_tags(trim($value));
        $return = str_replace(array("\r","\n"),array(" "," "),$return);
        return $return;
    }
}