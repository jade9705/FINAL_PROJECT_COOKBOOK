<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// api endpoint for top rated recipes 
Route::get('/toprecipes', 'Api\ApiTopRecipesController@index');
// api endpoint for searched recipes
Route::post('/search/recipes', 'Api\ApiSearchRecipesController@index');
// apiendpoint for newest recipe in profile page
Route::post('/search/newestrecipes', 'Api\ApiSearchRecipesController@newest');
// api endpoint for liked recipe (in this moment like smth is not possible for that it is get method) change it to post method and find first two liked recipe
Route::get('/search/newestliked', 'Api\ApiSearchRecipesController@newestliked');


Route::get('/recipe/{id}', 'Api\ApiRecipeController@show');
