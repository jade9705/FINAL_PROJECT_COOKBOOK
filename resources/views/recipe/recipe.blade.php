@extends('layouts.layout')

@section('content')


  <div id="recipe"></div>

  <script src="{{ mix('js/app.js') }}"></script>



  @if (auth()->check())
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
          <label for="">
              Text:<br>
              <textarea name="text" cols="30" rows="10">{{ old('text') }}</textarea>
          </label>
      </div>

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

  </form>
  @else 
  <h2>please log in to make a comment  </h2>
  @endif
  <div class="review">

      <h2>Commemts...</h2>

      <ul>
          @foreach ($recipe->comments as $comment)

              <li class="review">

                  {{ $comment->text }}
                  <br>
                  
                  <div class="ratingRender">Rating: {{ $comment->rating }}/5</div>

                  {{$number = (int)$comment->rating}}
                 @for($i = 0; $i < $number; $i ++)
                 <div class="rating__star rating__star--on"></div>
                 @endfor

                  {{-- @can('delete_reviews')
              <form action="{{route('review.delete', [$review->id])}}" method="post">
                  @csrf
                          @method('delete')
                          <input type="submit" value="delete">
                  @endcan --}}


              </li>

          @endforeach
      </ul> 

  </div>
@endsection