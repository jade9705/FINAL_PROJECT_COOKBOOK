<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/create', 'RecipeController@create');
Route::post('/recipes', 'RecipeController@store');

// route for first homesearch.blade.php page 
Route::get('/', 'HomeSearchController@index');
// vit comment