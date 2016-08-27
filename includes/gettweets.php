<?php

require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', 'sd5K9XKB5gu8dwyNPWYBEnues');
define('CONSUMER_SECRET', 'VjZ5MZnA42L5JFoVysmn1W9AJ1bEadR6Gq79Ou6Z8qcWSI9hJH');
define('ACCESS_TOKEN', '2254569260-4Jw5I7Ywc61eY5O900AkaWRhqOP8aZqZ5ciu91q');
define('ACCESS_TOKEN_SECRET', 'wE0a6tU8Xlen06KErmyu6NUWvg2tzNmVoKNZAqKt2j8jM');
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
