<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/orders', 'OrderController');
Route::resource('/cities', 'CityController', ['only' => ['index', 'edit', 'update']]);
//Route::resource('/companies', 'CityController', ['only' => ['index', 'edit', 'update']]);
//Route::resource('/clients', 'CityController', ['only' => ['index', 'edit', 'update']]);

Route::get('/cities/hint/{name}', 'CityController@hint')->name('cities.hint');
Route::get('/clients/hint/id/{id}', 'ClientController@hint_by_id')->name('client.hint_by_id');
Route::get('/clients/hint/{name}', 'ClientController@hint')->name('client.hint');
Route::get('/companies/hint/{name}', 'CompanyController@hint')->name('company.hint');
