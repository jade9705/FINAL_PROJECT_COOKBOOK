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
}