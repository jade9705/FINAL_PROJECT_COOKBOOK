<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recipe;
use App\User;

class ApiRecipeController extends Controller
{
    public function show($id)
    {
        $recipe = Recipe::with(["ingredients", "steps", "user"])->findOrFail($id);
        return $recipe;
    }

    public function allUsersRecipes ($user_id)
    {

        $recipes = Recipe::where('user_id', $user_id)
            ->orderBy('updated_at', 'desc')
            ->get();
        // $recipes = User::find($user_id)
        //     ->recipes()
        //     ->orderBy('updated_at', 'desc')
        //     ->get();
        // dd($recipe);
        return $recipes;
    }

    public function newestliked ($user_id)
    {
        $user = User::findOrFail($user_id);
        $liked_recipes = $user->recipes()->orderBy('id', 'desc')->limit(3)->get();

        return $liked_recipes;
    }

    public function allliked ($user_id)
    {
        $user = User::findOrFail($user_id);
        $liked_recipes = $user->recipes;

        return $liked_recipes;
    }


}