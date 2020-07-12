<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recipe;

class ApiTopRecipesController extends Controller
{
    public function index()
    {
        // $topRecipes = Recipe::orderBy('title', 'asc')->limit(3)->get();
        $Allrecipes = Recipe::with(['comments'])->get();

        $averageArr = [];
        foreach ($Allrecipes as $recipe) {
            $average = null;
            foreach ($recipe->comments as $comment) {
                $average += ($comment->rating)/count($recipe->comments);
            }
            $averageArr[$recipe->id] = $average;
            $average = null;
        }

        arsort($averageArr);
        $recipeIdInOrder = array_keys($averageArr);

        $topRecipes = [];
        for ($i=0; $i < 3; $i++) { 
            $topRecipes[] = Recipe::findOrFail($recipeIdInOrder[$i]); 
        }



        // return $recipeIdInOrder;
        return $topRecipes;
        return $Allrecipes;
    }
}
