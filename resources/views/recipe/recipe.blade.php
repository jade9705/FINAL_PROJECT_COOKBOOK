@extends('layouts.layout')

@section('content')
<div class="averageRatingTop">
    
  @for($i = 0; $i < $average; $i ++)
    <div class="rating__star rating__star--on"> </div>
  @endfor

</div>

<div id="recipe"></div>
@if(!auth()->check())
  <p class="hideThis">hi</p>
@else
@if(auth()->user()->id === $recipe->user_id)
  <div class="buttonStyles">
   
    <form action="{{route('delete.recipe', $recipe->id)}}" method="post">
      @csrf
      @method('delete')
      <input type="submit" value="delete"class="btn btn-danger" id="delete">
    </form>

    <a href="/recipe/{{$recipe->id}}/edit"><button class="btn btn-success">edit</button></a>
  </div>
@endif
@endif

<script src="{{ mix('js/app.js') }}"></script>

  <div class="allComments">
    
    @foreach($recipe->comments as $comment)
    @if(!auth()->check())
    <h1 class="hideThis">hi</h1>
    @else
      @if($comment->user_id  === auth()->user()->id)
      <h2 class="usercomment"> {{ $userComment }} </h2>
      @endif
      @endif
    @endforeach
      @if(!auth()->check())
        <h2 class="usercomment">Please create an account to leave comments</h2>
        @else
        @if(auth()->user()->id == $recipe->user_id)
          <h2 class="usercomment" >you cannot rate your own recipe, sorry!</h2>
        @else
        @if(auth()->user()->id !== $recipe->user_id && $userComment !== 'You have already rated this recipe. Thankyou.' )
         <h2 class="usercomment">What do you think,  {{ auth()->user()->first_name }}?</h2>
            <form action='/recipe/{recipe_id}/comment' method="post" class="comment-form">
              @csrf
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
              </div>

              <div class="form-group">
                <label for="">
                  Text:<br>
                  <textarea name="text" cols="85" rows="5">{{ old('text') }}</textarea>
                </label>
                  @if($errors->has('text'))
                    {{ $errors->first('text')}}
                  @endif
              </div>
   
              {{-- javascript for star rating--}}
              <script>
                const starElms = document.querySelectorAll('.rating .rating__star');
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
                <input type="submit" value="submit" name="submit" class="btn btn-success"/>
              </div>
          </form>
@endif 
@endif
{{-- @endforeach --}}
@endif

<div class="review">

  <h2>Comments...</h2>
  {{ $commentNumber }}
  <ul> 
    @foreach ($recipe->comments as $comment)
      <div class="recipe-container">
        <div class="hideThis"> {{$number = (int)$comment->rating}}</div>
        <img src="/images/uploads/user/{{$comment->user->image_url}}" class="userImage"/>
        <div class="nameAndText">
          <li class="userName"> <a href="/profile/{{$comment->user_id}}"><strong> {{$comment->user->first_name}} {{$comment->user->surname}}</strong></a> </li>
          <div class="stars">
            @for($i = 0; $i < $number; $i ++)
              <div id="starRender" class="rating__star rating__star--on"></div>
            @endfor
            {{-- <div class="ratingRender"> {{ $comment->rating }}/5</div>   --}}
          </div>
          <li class="review">
            {{ $comment->text }}
            <br>      
       
      </div>
     
       
            @if(auth()->check())
              @if(auth()->user()->id === $comment->user->id)
                <form action="{{route('comment.delete', [$recipe->id, $comment->id])}}" method="post" id="deleteButton">
                  @csrf
                  @method('delete')
                  <input type="submit" value="delete" class="btn btn-danger">
                </form>
              @endif
            @endif
        </li>        
          <p class="commentTime">{{ $comment->created_at }}</P>
      </div>
    @endforeach
  </ul>
</div> 
</div>
</div>
</div>
@endsection
