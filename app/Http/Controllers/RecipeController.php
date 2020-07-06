<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Ingredient;
use App\Step;

class RecipeController extends Controller
{
   
    public function index()
    {
        //
    }

  
    public function create()
    {
        return view('recipe.create');
    }

  
    public function store(Request $request)
    {

        $newFileName = md5(time()) . '.' . $request->file('image_url')->extension();
        $request->file('image_url')->move(public_path('images/uploads'), $newFileName);

        $recipe = new Recipe;
        $recipe->title = $request->input('title');
        $recipe->image_url = $newFileName;
        $recipe->description = $request->input('description');
        $recipe->is_published = $request->input('published');
        $recipe->save();

        $ingredient = new Ingredient;
        $ingredient->name = $request->input('ingredient');
        $ingredient->save();

        $step = new Step;
        $step->instruction = $request->input('step1');
        $step->sequence = 1;
        $step->recipe_id = $recipe->id;
        $step->save();

        $recipe->ingredients()->attach($ingredient->id, ['amount' => $request->input('amount')]);

        return redirect('/recipe/' . $recipe->id );

        
    }

    public function show($id)
    {
        $recipe = Recipe::all()->get();
        $ingredients = Ingredients::all()->get;
        $steps = Steps::all()->get();
        //$user = Users::all()->get(); users isnt set up yet
        return $recipes;
    }

    public function edit($id)
    {
        
    }

  
    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }
}
