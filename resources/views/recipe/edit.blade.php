@extends('layouts.layout')

@section('content')

<div class="entire-form">
<h1>EDIT</h1>
<form id="form" className="create-recipe-form" method="post" enctype="multipart/form-data" action="/recipe/{{$recipe->id}}">
   
@csrf

{{-- success and error messages --}}
@if (Session::has('success_message'))
        
    <div class="alert alert-success">
        {{ Session::get('success_message') }}
    </div>

    @endif

    <div class="form-group">
    <label for="fornGroupTitle">TITLE</label>
    <input type="text" class="form-control"ass="input" name="title" id="formGroupTitle" value="{{$recipe->title}}" placeholder="Name your recipe">
    @if($errors->has('title'))
    <div class="alert">
        {{ $errors->first('title')}}
    </div>
    @endif
    </div>
    <br>

    <input type="hidden" name='user_id' value={{$user_id}} />

    <div class="form-group">
    <label for="formGroupImage_url">IMAGE</label>
    <input class="form-control" type="file" id="formGroupImage_url" name="image_url" value="{{$recipe->image_url}}">
    @if($errors->has('image_url'))
    <div class="alert">
     {{ $errors->first('image_url')}}
    </div>
    @endif
    </div>
    <br>
    <div class="form-group">
    <label for="formGroupDescription">Description</label>
    <textarea class="form-control" id="formGroupDescription" name="description" rows="4" cols="50">{{$recipe->description}}</textarea>
    @if($errors->has('description'))
    <div class="alert">
     {{ $errors->first('description')}}
    </div>
    @endif
    </div>
    <br>


    <div id="ingredients-amount">
        <label for="formGroupIngredients">INGREDIENTS <button id="btn" type="button" class="btn btn-success">+</button></label>
@foreach($recipe->ingredients as $ingredient)   
   

    <div class="row">
        <div class="col">
    <input class="form-control" type="text" name="ingredient[]" id="ingredient" value="{{$ingredient->name}}" placeholder="ingredient">
    </div>
<div class="col">
    <input class="form-control" type="text" name="amount[]" id="amount" value="{{$ingredient->pivot->amount}}" placeholder="amount">
</div>
</div>

    
    </div>
    @if($errors->has('ingredient'))
    <div class="alert">
    {{ $errors->first('ingredient')}}
</div>
@endif
@if($errors->has('amount'))
<div class="alert">
{{ $errors->first('amount')}}
</div>
@endif
@endforeach
    <br>

    <div class="form-group">
        <div id="add-step">
        <label for="formGroupSteps">STEPS <button id="stepbtn" type="button" class="btn btn-success">+</button></label>
@foreach($recipe->steps as $step)
    
    
    <textarea class="form-control" id="step[]" name="step[]" rows="2" cols="50" >{{$step->instruction}}</textarea>
    </div>
</div>

    @if($errors->has('step'))
    <div class="alert">
    {{ $errors->first('step')}}
    @endif
    <div class="form-group">
</div>

    <br>
@endforeach
    

    <button type="submit" value="1" name="published" type="button" class="btn btn-success">Save</button>
    </div>
</form>
</div>
<script>
//javascript to deal with adding more inputs on the form
addMore = (e) => {
        e.preventDefault();
        let blob = document.getElementById('ingredients-amount');
        let newInputs = document.createElement('div');
        newInputs.innerHTML = `
            <div class="row">
            <div class="col">
                <input class="form-control" type="text" name="ingredient[]" id="ingredient" value="" placeholder="ingredient">
            </div>
            <div class="col">
                <input class="form-control" type="text" name="amount[]" id="amount" value="" placeholder="amount">
            </div>
            </div>
            `;
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
        <div class="form-group">
        <textarea class="form-control" id="step" name="step[]" rows="2" cols="50"></textarea>
        </div> `;
        bloop.appendChild(newInputSteps)
    }

    let buttonStep = document.getElementById('stepbtn');
    buttonStep.addEventListener('click', addMoreSteps);

   
</script>

@endsection