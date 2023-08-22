<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/pessoa/cadastrar','PessoaController@cadastrarPessoa');

$router->post('/pessoa/login', 'AuthController@login');

$router->get('/pessoa/mostrar', 'PessoaController@mostrar');

$router->delete('/pessoa/{id}/deletar', 'PessoaController@deletar');

$router->put('/pessoa/{id}/editar', 'PessoaController@editar');

$router->get('/pessoa/{id}/uma', 'PessoaController@mostrarUm');















