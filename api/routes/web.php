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

$router->get('/healthcheck', function () use ($router) {
    return json_encode(['is_alive' => true, 'message' => $router->app->version()], true);
});

$router->group(['prefix' => 'users'], function () use ($router) {
    $router->post('/{userId}/locations', 'UserLocationController@store');
	$router->get('/{userId}/locations', 'UserLocationController@getByUserId');
	$router->get('/{userId}/lastlocation', 'UserLocationController@getLastLocationByUserId');
});

