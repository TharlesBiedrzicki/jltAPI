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

$router->group(['middleware' => 'apicheck'], function() use ($router){

    $router->get('/produtos', ['as' => 'produtos.all', 'uses' => 'ProdutoController@all']);
    $router->get('/produtos/{id}', ['as' => 'produtos.getOne', 'uses' => 'ProdutoController@getOne']);
    $router->post('/produtos', ['as' => 'produtos.post', 'uses' => 'ProdutoController@store']);
    $router->put('/produtos/{id}', ['as' => 'produtos.put', 'uses' => 'ProdutoController@update']);
    $router->delete('/produtos/{id}', ['as' => 'produtos.delete', 'uses' => 'ProdutoController@destroy']);

    $router->get('/servicos',['as'=> 'servicos.all', 'uses' => 'ServicoController@all']);
    $router->get('/servicos/{id}',['as'=> 'servicos.get', 'uses' => 'ServicoController@one']);
    $router->post('/servicos',['as'=> 'servicos.post', 'uses' => 'ServicoController@store']);
    $router->put('/servicos/{id}', ['as' => 'servicos.put', 'uses' => 'ServicoController@update']);
    $router->delete('/servicos/{id}', ['as' => 'servicos.delete', 'uses' => 'ServicoController@destroy']);

    $router->get('/usuarios',['as'=> 'usuarios.all', 'uses' => 'UsuarioController@all']);
    $router->get('/usuarios/{id}',['as'=> 'usuarios.get', 'uses' => 'UsuarioController@one']);
    $router->post('/usuarios',['as'=> 'usuarios.post', 'uses' => 'UsuarioController@store']);
    $router->put('/usuarios/{id}', ['as' => 'usuarios.put', 'uses' => 'UsuarioController@update']);
    $router->delete('/usuarios/{id}', ['as' => 'usuarios.delete', 'uses' => 'UsuarioController@destroy']);
    
});


$router->post('/authenticate', ['as' => 'auntentica.api', 'uses' => 'UsuarioAPIController@store']);

