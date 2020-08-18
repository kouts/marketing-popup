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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });

    // Popups
    $router->get('popups', 'PopupController@showAllPopups');
    $router->get('popups/{id}', 'PopupController@showOnePopup');
    $router->post('popups', 'PopupController@create');
    $router->put('popups/{id}', 'PopupController@update');
    $router->delete('popups/{id}', 'PopupController@delete');

    // List of values
    $router->get('list-of-values/{name}', 'ListOfValueController@showOneListOfValues');
});
