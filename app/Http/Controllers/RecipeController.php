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
        $this->validate($request, [
            'title' => 'required|max:255',
            'image_url' => 'required',
            'description' => 'required|max:255',
            
            'ingredient' => 'required|array|min:1',
            'step' => 'required|array|min:1'
        ], [
            'required' => 'This input field is required, bitch.',
            'text.max' => 'That is too much text!'
        ]);


        $newFileName = md5(time()) . '.' . $request->file('image_url')->extension();
        $request->file('image_url')->move(public_path('images/uploads'), $newFileName);

        $recipe = new Recipe;
        $recipe->title = $request->input('title');
        $recipe->image_url = $newFileName;
        $recipe->description = $request->input('description');
        $recipe->is_published = $request->input('published');
        $recipe->save();

        foreach( $request->input('ingredient') as $k => $i){
        $ingredient = new Ingredient;
        $ingredient->name = $i;
        $ingredient->save();

        $recipe->ingredients()->attach($ingredient->id, ['amount' => $request->input('amount')[$k]]);
         };

        foreach($request->input('step') as $p){
            $step = new Step;
            $step->instruction = $p;
            $step->sequence = 1;
            $step->recipe_id = $recipe->id;
            $step->save();

        };
       

        return redirect('/recipe/' . $recipe->id );

        
    }

    public function show($id)
    {
        return view('recipe.recipe');

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
