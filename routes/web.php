<?php

use Illuminate\Support\Str;

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/key', function () {
    return Str::random(32);
});

// $router->get('/foo', 'BooksController@index');
// {
//     return $router->app->version();
// };

$router->get('/books', 'BooksController@index');
$router->get('/books/{id}', 'BooksController@getBookbyId');
$router->post('/books', 'BooksController@store');
$router->put('books/{id}', 'BooksController@update');
$router->delete('books/{id}', 'BooksController@destroy');





