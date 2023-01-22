<?php

use Illuminate\Routing\Router;

/** @var $router Router */

// Base routes

$router->get('/', function () {
    return 'It`s work!';
});

// Secured routes

$router->group(['middleware' => 'token_b24'], function (Router $router) {

    $router->post('/test', [\App\Controllers\Test\Test::class, 'TestRoute']);
    $router->post('/crm/deal/prods2fields', [\App\Controllers\Crm\Deal\ProdsToFields::class, 'process']);

});

// All other

$router->any('{any}', function () {
    return 'Route not found!';
})->where('any', '(.*)');
