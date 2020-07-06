<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
// // Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');
 
// // Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');
 
// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

// creating new recipe
Route::get('/create', 'RecipeController@create')->name('create.recipe');
Route::post('/recipes', 'RecipeController@store')->name('store.recipe');
Route::get('/recipes/{id}', 'RecipeController@show')->name('show.recipe');

Route::get('/create', 'RecipeController@create');
Route::post('/recipes', 'RecipeController@store');

// route for first homesearch.blade.php page 
Route::get('/', 'HomeSearchController@index');