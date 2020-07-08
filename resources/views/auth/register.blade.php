{{-- @extends('layouts.app') --}}
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shado">
                <div class="card-header">
                    <svg 
                        class="card-logo"
                        fill="#000000"
                        version="1.1"
                        id="Capa_1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px" y="0px"
                        viewBox="0 0 297 297" style="enable-background:new 0 0 297 297;" xml:space="preserve">
                        <path d="M296.033,108.22c0-37.967-30.877-68.855-68.83-68.855c-1.649,0-3.314,0.062-4.987,0.187C205.884,14.997,178.215,0,148.5,0c-29.714,0-57.383,15-73.715,39.552c-1.673-0.125-3.338-0.187-4.987-0.187c-37.954,0-68.831,30.888-68.831,68.855
                                c0,34.637,25.704,63.368,59.031,68.142v95.157c0,14.051,11.43,25.481,25.48,25.481h126.044c14.051,0,25.48-11.431,25.48-25.481
                                v-95.157C270.33,171.588,296.033,142.856,296.033,108.22z M211.522,277.399H85.479c-3.186,0-5.88-2.693-5.88-5.881v-95.147
                                c9.602-1.36,18.718-4.722,26.941-9.95c12.613,6.822,26.958,10.651,41.96,10.651s29.346-3.829,41.959-10.65
                                c8.225,5.227,17.342,8.589,26.943,9.949v95.147C217.402,274.706,214.709,277.399,211.522,277.399z M227.203,157.471
                                c-6.597,0-12.974-1.289-18.9-3.766c11.927-10.934,20.943-25.146,25.47-41.479c1.445-5.216-1.611-10.617-6.827-12.063
                                c-5.217-1.445-10.616,1.612-12.063,6.827c-8.236,29.723-35.534,50.481-66.383,50.481s-58.146-20.758-66.383-50.481
                                c-1.445-5.216-6.843-8.272-12.063-6.827c-5.216,1.445-8.272,6.847-6.827,12.063c4.526,16.333,13.543,30.546,25.47,41.479
                                c-5.926,2.477-12.303,3.766-18.899,3.766c-27.146,0-49.23-22.094-49.23-49.251c0-27.158,22.085-49.254,49.23-49.254
                                c2.744,0,5.569,0.246,8.397,0.73c4.082,0.696,8.17-1.247,10.2-4.861c12.205-21.733,35.236-35.234,60.104-35.234
                                s47.899,13.502,60.106,35.235c2.029,3.614,6.115,5.557,10.2,4.86c2.828-0.484,5.653-0.73,8.396-0.73
                                c27.145,0,49.229,22.096,49.229,49.254C276.433,135.377,254.348,157.471,227.203,157.471z"/>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                    </svg>                    
                    <p>{{ __('Register') }}</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf



                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>






                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
