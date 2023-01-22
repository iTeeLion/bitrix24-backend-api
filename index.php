<?php

require_once './composer/vendor/autoload.php';

use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create new IoC Container instance
$container = new Container;

// Create a request from server variables, and bind it to the container; optional
$request = Request::capture();
$container->instance('Illuminate\Http\Request', $request);

// Debug requests
//ob_start(); var_dump($request); $ob=ob_get_clean();
//file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/!DUMP_REQUESTS.txt', $ob, FILE_APPEND);

// Using Illuminate/Events/Dispatcher
$events = new Dispatcher($container);

// Create the router instance
$router = new Router($events, $container);

// Global middlewares
$globalMiddleware = [
    \App\Middleware\StartSession::class,
];

// Array middlewares
$routeMiddleware = [
    'token_b24' => \App\Middleware\TokenB24::class,
];

// Load middlewares to router
foreach ($routeMiddleware as $key => $middleware) {
    $router->aliasMiddleware($key, $middleware);
}

// Load the routes
require_once 'routes.php';

// Create the redirect instance
$redirect = new Redirector(new UrlGenerator($router->getRoutes(), $request));

// Create a request from server variables
$response = (new Pipeline($container))
    ->send($request)
    ->through($globalMiddleware)
    ->then(function ($request) use ($router) {
        return $router->dispatch($request);
    });

// Debug responses
//ob_start(); var_dump($response); $ob=ob_get_clean();
//file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/!DUMP_RESPONSES.txt', $ob, FILE_APPEND);

// Send the response back to the browser
$response->send();
