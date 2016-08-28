<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

ini_set('display_errors', 1);

require 'vendor/autoload.php';

// Display Slim Errors
function slimConfig() {
    $configuration = [
        'settings' => [
            'displayErrorDetails' => true,
        ],
    ];
    $config = new \Slim\Container($configuration);
    return $config;
}

// Fetch DI Container
// Register Twig View helper
function registerTwigView($app) {
    $container = $app->getContainer();
    $container['view'] = function ($c) {
        $view = new \Slim\Views\Twig('templates');
        // Instantiate and add Slim specific extension
        $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
        $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
    return $view;
    };
}


