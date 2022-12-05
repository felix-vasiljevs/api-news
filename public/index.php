<?php

require_once '../vendor/autoload.php';

use App\Template;
use Doctrine\DBAL\DriverManager;
use jcobhams\NewsApi\NewsApi;
use App\Controllers\ArticleController;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$dotenv = Dotenv\Dotenv::createImmutable('/home/spoon/PhpstormProjects/CODELEX/v2-api-news');
$dotenv->load();
$apiKey = $_ENV["API_KEY"];
$apiInUse = new NewsApi($apiKey);

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', [ArticleController::class, 'index']);
    $route->addRoute('GET', '/register', [RegisterController::class, 'showForm']);
    $route->addRoute('POST', '/register', [RegisterController::class, 'store']);
    $route->addRoute('GET', '/login', [LoginController::class, 'showForm']);
    $route->addRoute('POST', '/login', [LoginController::class, 'logIn']);
});

$loader = new FilesystemLoader('../views');

$twig = new Environment($loader);
$twig->addGlobal('session', $_SESSION['id']);

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $methods] = $handler;
        $response = (new $controller)->{$methods}($vars);

        if ($response instanceof Template) {
            echo $twig->render($response->getPath(), $response->getParams());
        }


        // ... call $handler with $vars
        break;
}

