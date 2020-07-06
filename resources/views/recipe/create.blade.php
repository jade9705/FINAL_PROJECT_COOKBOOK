@extends('layouts.layout')

@section('content')


<h1>CREATE</h1>
<form id="form" className="create-recipe-form" method="post" enctype="multipart/form-data" action="/recipes">
   
@csrf

{{-- success and error messages --}}
@if (Session::has('success_message'))
        
    <div class="alert alert-success">
        {{ Session::get('success_message') }}
    </div>

    @endif


    <label for="title">TITLE</label>
    <input type="text" class="input" name="title" id="title" value="" placeholder="Name your recipe">
    @if($errors->has('title'))
        {{ $errors->first('title')}}
    @endif
    <br>

    <label for="image_url">IMAGE</label>
    <input class="input" type="file" name="image_url">
    @if($errors->has('image_url'))
     {{ $errors->first('image_url')}}
    @endif
    <br>

    <label for="description">Description</label>
    <textarea class="input" id="description" name="description" rows="4" cols="50"></textarea>
    @if($errors->has('description'))
     {{ $errors->first('description')}}
    @endif
    <br>



    <div id="ingredients-amount">
    <label for="ingredient">INGREDIENTS</label>

    <div class="two-inputs">
    <input class="input" type="text" name="ingredient[]" id="ingredient" value="">
    <input class="input" type="text" name="amount[]" id="amount" value="" placeholder="amount">
    </div>

    <button id="btn">+</button>
    </div>
    @if($errors->has('ingredient'))
    {{ $errors->first('ingredient')}}
@endif
@if($errors->has('amount'))
{{ $errors->first('amount')}}
@endif
    <br>



    <div id="add-step">
    <label for="step1">STEPS</label>
    <button id="stepbtn">+</button>
    <textarea class="input" id="step[]" name="step[]" rows="2" cols="50"></textarea>
    </div>
    @if($errors->has('step'))
    {{ $errors->first('step')}}
@endif
    <br>

    

    <input type="submit" value="1" name="published">


</form>
<script>
//javascript to deal with adding more inputs on the form
addMore = (e) => {
        e.preventDefault();
        let blob = document.getElementById('ingredients-amount');
        let newInputs = document.createElement('div');
        newInputs.innerHTML = `
         <input className="input" type="text" name="ingredient[]" id="ingredient" value=""> 
        <input className="input" type="text" name="amount[]" id="amount" value="" placeholder="amount" > `;
        blob.appendChild(newInputs)
    }

    let button = document.getElementById('btn');
    button.addEventListener('click', addMore);

    addMoreSteps = (e) => {
        e.preventDefault();
        console.log('clicked')
        let bloop = document.getElementById('add-step');
        let newInputSteps = document.createElement('div');
        newInputSteps.innerHTML = `
        <textarea className="input" id="step" name="step[]" rows="2" cols="50"></textarea> `;
        bloop.appendChild(newInputSteps)
    }

    let buttonStep = document.getElementById('stepbtn');
    buttonStep.addEventListener('click', addMoreSteps);

   
</script>
@endsection