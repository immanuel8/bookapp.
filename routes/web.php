<?php

use Illuminate\Support\Str;

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/key', function () {
    return Str::random(32);
});

$router->get('/foo', 'BooksController@index');
{
    return $router->app->version();
};