@extends('layouts.layout')

@section('content')
  <div id="profile"></div>
  <script>    
    //wow! this is the way how to import variable from blade(from controller) to javascript!!!!!
    var profile_id = {!! json_encode($profile_id) !!};
  </script>
  <script src="{{ mix('js/app.js') }}"></script>
@endsection