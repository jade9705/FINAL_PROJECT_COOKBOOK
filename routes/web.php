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
// route for first homesearch.blade.php page 
Route::get('/', 'HomeSearchController@index')->name('index.homeSearch');




// creating new recipe
Route::get('/create', 'RecipeController@create')->name('create.recipe');
Route::post('/recipes', 'RecipeController@store')->name('store.recipe');
//rendering the single recipe, will render some view
Route::get('/recipe/{id}', 'RecipeController@show')->name('show.recipe');
//for updating the already existing recipe
Route::get('/recipe/{recipe_id}/edit', 'RecipeController@edit')->name('edit.recipe');
Route::post('/recipe/{recipe_id}', 'RecipeController@update')->name('update.recipe');

//Route::get('/create', 'RecipeController@create');
// Route::post('/recipes', 'RecipeController@store');


//go to the profile.blade.php and call profile.jsx component with the post(users/getprofile)
Route::get('/profile/{id}', 'UserController@show')->name('show.user')->middleware('auth');
Route::post('/users/getprofile', 'UserController@getProfile')->name('getProfile.user')->middleware('auth');

// upload img and edit user profile
Route::post('/profile/update', 'UserController@update')->name('update.user')->middleware('auth');
Route::post('/profile/update/follow', 'UserController@follow')->name('follow.user')->middleware('auth');
Route::post('/profile/update/unfollow', 'UserController@unfollow')->name('unfollow.user')->middleware('auth');

//for reviews:
    
Route::post('/recipe/{recipe_id}/comment', 'RecipeController@comment')->name('recipe.comment');
// Route::get('/recipe/recipe{_id}/comments/{comment_id}', 'CommentController@show');
Route::delete('/recipe/{recipe_id}/comment/{comment_id}', 'CommentController@deleteComment')->name('comment.delete');

