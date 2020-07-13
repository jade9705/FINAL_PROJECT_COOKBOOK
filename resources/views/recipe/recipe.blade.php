@extends('layouts.layout')

@section('content')


  <div id="recipe"></div>

  <script src="{{ mix('js/app.js') }}"></script>

@if(!auth()->check())
<div>Please create an account to leave comments</div>
@else
@if(auth()->user()->id !== $recipe->user_id)


  {{-- @if (auth()->check()) --}}
  <form action='/recipe/{recipe_id}/comment' method="post" class="comment-form">
 
    @csrf

    <h2>What do you think, {{ auth()->user()->first_name}}?</h2>

    {{-- success message --}}
    @if (Session::has('success_message'))
      <div class="alert alert-success">
        {{ Session::get('success_message') }}
      </div>
    @endif
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

  <input type="hidden" name='recipe_id' value={{$recipe_id}} />
  <input type="hidden" name='user_id' value={{$user_id}} />

  <div class="form-group">
      
    <input type="hidden" name="rating" class="ratingNumber" value="" >


    <div class="rating">
      <div class="rating__value">1</div>
      <div class="rating__stars">
        <div class="rating__star rating__star--on"></div>
        <div class="rating__star "></div>
        <div class="rating__star "></div>
        <div class="rating__star"></div>
        <div class="rating__star"></div>
      </div>
      </div>
    </label>
    </div>
    <div class="form-group">
      <label for="">
        Text:<br>
        <textarea name="text" cols="30" rows="10">{{ old('text') }}</textarea>
      </label>
        @if($errors->has('text'))
        {{ $errors->first('text')}}
      @endif
    </div>

  


  {{-- javascript for star rating--}}
  <script>
    const starElms = document.querySelectorAll('.rating__star');
    
    const turnOnStars = (count) => {
      for (let i = 0; i < starElms.length; i++) {
        if (i < count) {
          starElms[i].classList.add('rating__star--on');
        } else {
          starElms[i].classList.remove('rating__star--on');
        }
      }
    };
    
    starElms.forEach((star, index) => {
      star.addEventListener('click', () => {
        const valueELm = document.querySelector('.rating__value');
        valueELm.textContent = index + 1;
        turnOnStars(index + 1);
// this adds the value of the selected stars to the hidden input for the rating, which updates the database to that value
        const starsNumber =  document.querySelector('.ratingNumber');
        starsNumber.value = Number(document.querySelector('.rating__value').textContent)
      });
    });

    const ratingRender = document.querySelector('.ratingRender');
    const amountStars = Number(document.querySelector('.rating__value').textContent);

  </script>

    <div class="form-group">
      <input type="submit" value="submit" name="submit" class="addComment" />
    </div>
@endif
  </form>
  @endif 


  {{-- @else 
    
  <h2>please log in to make a comment  </h2>
  @endif --}}
  <div class="review">

  <h2>Comments...</h2>
    <ul> 
     <div class="hideThis"> {{ $sumOfRatings = 0  }} </div>

      @foreach ($recipe->comments as $comment)
        <div class="recipe-container">
          <div class="hideThis"> {{$number = (int)$comment->rating}}</div>
          
          <img src="/images/uploads/user/{{$comment->user->image_url}}" class="userImage"/>
          
          
          
          <div class="nameAndText">
            <li class="userName"> <a href="/profile/{{$user_id}}"><strong> {{$comment->user->first_name}} {{$comment->user->surname}}</strong></a> </li>
            <div class="stars">
              @for($i = 0; $i < $number; $i ++)
              <div id="starRender" class="rating__star rating__star--on"></div>
            @endfor
            
              </div>
            <li class="review">
              {{ $comment->text }}
              <br>      

              <div class="hideThis" >{{ $sumOfRatings += (int)$comment->rating}} </div>
              @if(auth()->check())
              
                @if(auth()->user()->id === $comment->user->id)
                    <form action="{{route('comment.delete', [$recipe->id, $comment->id])}}" method="post">
                  @csrf
                    @method('delete')
                    <input type="submit" value="delete">
                @endif
                @endif
              </li>
            </div>

            
         
            <div class="ratingRender"> {{ $comment->rating }}/5</div>

           
          </div>
        @endforeach
    </ul> 

      {{-- take each number from the ratings and add them, then divide by the amount of ratings(length), pnly when there is at least one rating --}}
      @if($sumOfRatings != 0)

      {{ $average = $sumOfRatings / count($recipe->comments)  }}

     
      <h2>average rating </h2>
      @for($i = 0; $i < $average; $i ++)
        <div class="rating__star rating__star--on"></div>
      @endfor
      <p>{{ $average }} </p>
      @endif
  </div>
@endsection
