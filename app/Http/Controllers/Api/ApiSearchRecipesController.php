<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recipe;
use App\User;

class ApiSearchRecipesController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        $search = $request->searchValue;
        $recipes = Recipe::where('title', 'LIKE', '%'. $search .'%')->get();
        return $recipes;
    }


    public function newest(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        $newestRecipes = $user->recipes->all();
        return $newestRecipes;
    }
}
