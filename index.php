<?php declare(strict_types=1);

require_once 'vendor/autoload.php';
include 'views/index.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use jcobhams\NewsApi\NewsApi;
use App\Controllers\BaseController;
use App\ApiClient;

$apikey = $_ENV["NEWS_API_KEY"];
$newsApi = new NewsApi($apikey);
$greeting = "hello";

$apiClient = new ApiClient($apikey);
echo "<pre>";
$news = $apiClient->getNews($_GET["Apple"]);

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', [BaseController::class, 'index']);
});

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
        [$controllers, $methods] = $handler;

        $response = (new $controllers)->{$methods}();
        echo $response;

        break;
}
