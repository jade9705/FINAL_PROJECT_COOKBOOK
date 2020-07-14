<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Ingredient;
use App\Step;
use App\Comment;
use App\User;

class RecipeController extends Controller
{
    public function create()
    {
        $user_id = auth()->id();
       
        return view('recipe.create', compact('user_id'));
    }

    public function store(Request $request)
    {
        $user_id = auth()->id();

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
        $recipe->user_id = $user_id;
        $recipe->save();

        foreach( $request->input('ingredient') as $k => $i)
        {
            $ingredient = new Ingredient;
            $ingredient->name = $i;
            $ingredient->save();

            $recipe->ingredients()->attach($ingredient->id, ['amount' => $request->input('amount')[$k]]);
        };

        foreach($request->input('step') as $p)
        {
            $step = new Step;
            $step->instruction = $p;
            $step->sequence = 1;
            $step->recipe_id = $recipe->id;
            $step->save();
        };

        $user = User::findOrFail($user_id);
        $user->recipes()->attach($recipe->id);
       // $recipe->users()->attach($user->name);
        return redirect('/recipe/' . $recipe->id );
    }

    public function show($id)
    {
        $recipe_id = $id;
        $user_id = auth()->id();
        //author
        //next part is making the average star rating
        $recipe = Recipe::findOrFail($recipe_id);
        $comments = Comment::where('recipe_id', $recipe_id)->orderby('created_at','DESC')->get();
        $sumOfRatings = 0;
        if(count($recipe->comments) != 0) {
            foreach($comments as $comment) {
                $sumOfRatings += (int)$comment->rating;
            }
            $average = round($sumOfRatings) / count($recipe->comments);
        } else {
            $average = 0;
        }
        
        if(count($recipe->comments) == 1) {
            $commentNumber = 'This recipe has only 1 comment';
        } else if(count($recipe->comments) != 0){
            $commentNumber = 'This recipe has ' . count($recipe->comments) . ' comments...so far...';
        } else {
            $commentNumber = 'This recipe has no comments.....yet.';
        }
        return view('recipe.recipe', compact('recipe_id', 'user_id', 'recipe', 'average', 'commentNumber' ));

    }


    public function average(Request $request)
    {

        // dd($request);
        $recipe_id = $request->input('recipe_id');
        $recipe = Recipe::findOrFail($recipe_id);
        $comments = Comment::where('recipe_id', $recipe_id)->get();
        $sumOfRatings = 0;
        
        foreach($comments as $comment) {
            $sumOfRatings += (int)$comment->rating;
        };

        if (count($recipe->comments) == 0) {
            $average = 0;
            return $average;
        } else {
            $average = round($sumOfRatings / count($recipe->comments));
            return $average;
        };
    }

    public function comment(Request $request)
    {
        $first_name = auth()->user()->first_name;

        $this->validate($request, [
            'text' => 'required|max:255',
        ], [
            'required' => 'This input field is required, bitch.',
            'text.max' => 'That is too much text!'
        ]);

        $comment = new Comment;

        // fill object with data
        $recipe = $request->input('recipe_id');
        $comment->recipe_id = $request->input('recipe_id');
        $comment->user_id = $request->input('user_id');
        $comment->text = $request->input('text');
        $comment->rating = $request->input('rating');

        // save the object
        $comment->save();

        // flash success message
        session()->flash('success_message', 'Comment was saved. Thank you!');

        // redirect
        return redirect()->action('RecipeController@show', [$recipe, $first_name]);
    }
    
    public function edit($recipe_id)
    {
        $recipe = Recipe::findOrFail($recipe_id);
        $user_id = auth()->id();

        return view('recipe.edit', compact('recipe', 'user_id'));
    }

    public function update($id, Request $request)
    {
        $user_id = auth()->id();
        $recipe_id = $id;

        $recipe = Recipe::findOrFail($recipe_id);

        if($request->hasFile('image_url'))
        {
            $newFileName = md5(time()) . '.' . $request->file('image_url')->extension();
            $request->file('image_url')->move(public_path('images/uploads'), $newFileName);
            $recipe->image_url = $newFileName;
        }

        $recipe->title = $request->input('title');
        $recipe->description = $request->input('description');
        $recipe->is_published = $request->input('published');
        $recipe->user_id = $user_id;
        $recipe->save();

        foreach( $request->input('ingredient') as $k => $i)
        {
            if($recipe->ingredients->count() > $k) {
                $recipe->ingredients[$k]->name = $i;
                $recipe->ingredients[$k]->save();
                $recipe->ingredients()->updateExistingPivot($recipe->ingredients[$k]->id, ['amount' => $request->input('amount')[$k]]);
            } else {
                $ingredient = new Ingredient;
                $ingredient->name = $i;
                $ingredient->save();

                $recipe->ingredients()->attach($ingredient->id, ['amount' => $request->input('amount')[$k]]);
            }
        };

        foreach($request->input('step') as $i => $p)
        {
            //dd([$i, $p, $recipe->steps->count(), $recipe->steps[$i]->toArray()]);
            if($recipe->steps->count() > $i) {
                $recipe->steps[$i]->instruction = $p;
                $recipe->steps[$i]->save();
            } else {
                $step = new Step;
                $step->instruction = $p;
                $step->sequence = 1;
                $step->recipe_id = $recipe->id;
                $step->save();
            }
        };

        // $user = User::findOrFail($user_id);
        // $user->recipes()->attach($recipe->id);
       // $recipe->users()->attach($user->name);

        return redirect('/recipe/' . $recipe->id );
    }

    public function deleteRecipe($recipe_id) 
    {
        $recipe = Recipe::findOrFail($recipe_id);
        $user_id = $recipe->user_id;
        $comments = Comment::where('recipe_id', $recipe_id);

        $recipe->ingredients()->delete();
        $recipe->steps()->delete();
        $comments->delete();
        $recipe->delete();

        return redirect('/profile/' . $user_id );
        session()->flash('success_message', 'Recipe was deleted. Thank you!');
    }
}
