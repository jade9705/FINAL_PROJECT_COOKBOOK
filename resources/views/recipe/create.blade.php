@extends('layouts.layout')

@section('content')


<h1>CREATE</h1>
<form id="form" className="create-recipe-form" method="post" enctype="multipart/form-data" action="/recipes">
   
@csrf

    <label for="title">TITLE</label>
    <input type="text" name="title" id="title" value="" placeholder="Name your recipe">
    <br>

    <label for="image_url">IMAGE</label>
    <input type="file" name="image_url">
    <br>

    <label for="description">Description</label>
    <textarea id="description" name="description" rows="4" cols="50"></textarea>
    <br>

    <label for="ingredient">INGREDIENTS</label>
    <input type="text" name="ingredient" id="ingredient" value="">
   
    <label for="ingredients">AMOUNT</label>
    <input type="text" name="amount" id="amount" value="">
    <br>

    <label for="step1">STEP 1</label>
    <textarea id="step1" name="step1" rows="2" cols="50"></textarea>
    <br>

    <label for="step2">STEP 2</label>
    <textarea id="step2" name="step2" rows="2" cols="50"></textarea>

    <input type="submit" value="1" name="published">


</form>

@endsection