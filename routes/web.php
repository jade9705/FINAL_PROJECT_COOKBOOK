<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// creating new recipe
Route::get('/create', 'RecipeController@create')->name('create.recipe');
Route::post('/recipes', 'RecipeController@store')->name('store.recipe');
Route::get('/recipes/{id}', 'RecipeController@show')->name('show.recipe');

Route::get('/create', 'RecipeController@create');
Route::post('/recipes', 'RecipeController@store');

// route for first homesearch.blade.php page 
Route::get('/', 'HomeSearchController@index');