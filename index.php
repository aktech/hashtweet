<?php

ini_set('display_errors', 1);

require 'vendor/autoload.php';
require 'includes/gettweets.php';
require 'includes/config.php';

$config = slimConfig();
$app = new \Slim\App($config);
registerTwigView($app);

// Define named route
$app->get('/', function ($request, $response, $args) {
 	$tweets = findtweets();   
	return $this->view->render($response, 'index.html', [
	    'tweets' => $tweets
    ]);
})->setName('home');

$app->run();

