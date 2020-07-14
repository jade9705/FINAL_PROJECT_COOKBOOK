<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Recipe;

class CommentController extends Controller
{
    public function show($recipe_id, $comment_id){

        
    }

    public function averageRating($recipe_id)
    {
        $recipe = Recipe::all();     
    }

    public function deleteComment($recipe_id, $comment_id)
    {
        $recipe = Recipe::findOrFail($recipe_id);
        $comment=Comment::findOrFail($comment_id);

        $comment->delete();
        session()->flash('success_message', 'Comment was deleted. Thank you!');

        return redirect()->action('RecipeController@show', [$recipe->id]);
    }
}
//function reduce ()

// if auth id and recipe id is same cant comment !