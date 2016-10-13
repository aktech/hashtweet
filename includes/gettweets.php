<?php

require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', 'YOUR_CONSUMER_KEY');
define('CONSUMER_SECRET', 'YOUR_CONSUMER_SECRET');
define('ACCESS_TOKEN', 'YOUR_ACCESS_TOKEN');
define('ACCESS_TOKEN_SECRET', 'YOUR_ACCESS_TOKEN_SECRET');
define('HASHTAG', '#custserv');


function findtweets() {

  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  $query = array(
	  "q" => HASHTAG,
	  "count" => 20
  );

  $results = $toa->get('search/tweets', $query);
  $tweets = array();

  foreach ($results->statuses as $result) {
    if ($result->retweet_count > 0) {
      $tweets[] = $result; 
      //echo $result->user->screen_name . ": " . $result->text . "</br></br>";
    }
  }
  return $tweets;
}
