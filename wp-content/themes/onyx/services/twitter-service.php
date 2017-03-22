<?php
require_once('TwitterAPIExchange.php');

// THE_ENV is set by nginx / apache
switch (getenv("THE_ENV")) {
    case "dev":
		$twitter_settings = array(
		    'oauth_access_token' => '*********',
		    'oauth_access_token_secret' => '*********',
		    'consumer_key' => '*********',
		    'consumer_secret' => '*********'
		);
        break;
    case "staging":
		$twitter_settings = array(
		    'oauth_access_token' => '*********',
		    'oauth_access_token_secret' => '*********',
		    'consumer_key' => '*********',
		    'consumer_secret' => '*********'
		);
        break;
    case "production":
		$twitter_settings = array(
		    'oauth_access_token' => '*********',
		    'oauth_access_token_secret' => '*********',
		    'consumer_key' => '*********',
		    'consumer_secret' => '*********'
		);
        break;
}

$twitter_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$twitter_field = '?screen_name=JDruryPartners&count=5&exclude_replies=true';
$requestMethod = 'GET';
$twitter_agent = new TwitterAPIExchange($twitter_settings);

$twitter_posts = json_decode($twitter_agent->setGetfield($twitter_field)->buildOauth($twitter_url, $requestMethod)->performRequest(), true);