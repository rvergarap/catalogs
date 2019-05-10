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
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('catalogs',  ['uses' => 'CatalogController@showAllCatalogs']);

    $router->get('catalogs/{idc}/products/{idp}', ['uses' => 'CatalogController@showOneCatalog']);


    $router->get('catalogs/{id}', ['uses' => 'CatalogController@showOneCatalog']);

    $router->post('catalogs', ['uses' => 'CatalogController@create']);

    $router->delete('catalogs/{id}', ['uses' => 'CatalogController@delete']);

    $router->put('catalogs/{id}', ['uses' => 'CatalogController@update']);

});