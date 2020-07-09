<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recipe;

class ApiRecipeController extends Controller
{
    public function show($id)
    {
        $recipe = Recipe::with(["ingredients", "steps", "users"])->findOrFail($id);
        return $recipe;
    }
}