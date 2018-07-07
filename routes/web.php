<?php

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
    return view('index');
});

$router->get('/calificaciones', function (){
    return view('index');
});

$router->get('/api_token', function (){
    return str_random(60);
});

$router->group(['middleware' => ['auth']], function () use ($router){
    $router->get('/calificaciones/{idUsuario}', ['uses' => 'EscuelaController@calificaciones']);
    $router->post('/calificaciones', ['uses' => 'EscuelaController@crearCalificacion']);
    $router->put('/calificaciones/{idCalificacion}', ['uses' => 'EscuelaController@actualizarCalificacion']);
    $router->delete('/calificaciones/{idCalificacion}', ['uses' => 'EscuelaController@eliminarCalificacion']);
});
