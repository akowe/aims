<?php
use Illuminate\Http\Request;
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
$router->group(['prefix'=>'api'],function($router){

    $router->get('all_animal_identification_numbers', 'AnimalIdentificationController@index');
    $router->post('create_animal_identification_number', 'AnimalIdentificationController@create');
    $router->get('get_animal_identification_number/{id}', 'AnimalIdentificationController@show'); 
    $router->put('update_animal_identification_number/{id}', 'AnimalIdentificationController@update');      
    $router->delete('delete_animal_identification_number/{id}', 'AnimalIdentificationController@delete');
    $router->post('search_animal_identification_number', 'AnimalIdentificationController@search');

});
