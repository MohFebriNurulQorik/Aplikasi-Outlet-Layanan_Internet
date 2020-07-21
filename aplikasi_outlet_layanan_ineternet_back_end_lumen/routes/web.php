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
    return response()->json(['status' => 'Konek']);
});


$router->get('/users', 'UserController@users');
$router->get('/users/{id}', 'UserController@deatail_user');
$router->put('/users', 'UserController@create_user');
$router->post('/users/{id}', 'UserController@edit_user');

$router->get('/layanan', 'LayananController@layanan');
$router->get('/layanan/{id}', 'LayananController@deatail_layanan');
$router->put('/layanan', 'LayananController@create_layanan');
$router->post('/layanan/{id}', 'LayananController@edit_layanan');

$router->get('/transaksi', 'TransaksiController@transaksi');
$router->get('/transaksi_user/{id}', 'TransaksiController@transaksi_user');
$router->get('/transaksi/{id}', 'TransaksiController@deatail_transaksi');
$router->put('/transaksi', 'TransaksiController@create_transaksi');
$router->post('/transaksi/{id}', 'TransaksiController@edit_transaksi');
