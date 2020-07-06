<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recipe;

class ApiSearchRecipesController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        $search = $request->searchValue;
        $recipes = Recipe::where('title', 'LIKE', '%'. $search .'%')->get();
        return $recipes;
    }
}
