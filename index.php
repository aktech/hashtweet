<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

ini_set('display_errors', 1);

require 'vendor/autoload.php';
require 'includes/gettweets.php';

$app = new \Slim\App;
// Fetch DI Container
$container = $app->getContainer();

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('templates');

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

// Define named route
$app->get('/', function ($request, $response, $args) {
 	$tweets = findtweets();   
	return $this->view->render($response, 'index.html', [
	    'tweets' => $tweets
    ]);
})->setName('home');

$app->run();

