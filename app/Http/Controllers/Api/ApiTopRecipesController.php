<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recipe;

class ApiTopRecipesController extends Controller
{
    public function index()
    {
        $topRecipes = Recipe::orderBy('title', 'asc')->limit(3)->get();
        return $topRecipes;
    }
}
