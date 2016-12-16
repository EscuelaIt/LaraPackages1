<?php

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/* Admin */
Route::get('/', 'AdminController@index');

/* Recipes */
Route::resource('recipes', 'RecipeController');
Route::get('recipes/destroy/{id}', 'RecipeController@destroy');
Route::post('recipes/{id}/update', 'RecipeController@update');
Route::post('recipes/store', 'RecipeController@store');