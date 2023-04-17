@extends('layouts.Frontend.app')

@section('content')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-10 col-lg-9 py-lg-5">
            <div class="row align-items-center">

                <div class="col-md-6 ">
                    <img src="{{ asset('images/login-image.png') }}" alt="hey blindes logo">
                </div>
                <div class="col-md-6 ps-lg-5">
                    <h3 class="fw-bold ps-4 border-start border-5 border-primary py-0">{{ __('Login') }}</h3>
                   @if (Session::has('message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {!! Session::get('message') !!}
                        </div>
                    @endif
                    @if (Session::has('errors'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @include('partial.message')
                    <div class=" pt-4">
                        <form method="POST" action="{{route('user.login')}}" id="loginForm">
                            @csrf
                            <div class="form-group">
                                <label for="email"
                                class="">{{ __('E-Mail Address') }}</label>
                                <div class="">
                                    <input id="email" type="email" class="form-control"
                                    name="email"  autocomplete="email" required autofocus/>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="password"
                                class="">{{ __('Password') }}</label>

                                <div class="position-relative view_password_option">
                                    <span id="togglePassword" class="toggle-password">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                            <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                        </svg>
                                    </span>
                                    <input id="password" type="password" class="form-control view_password" name="password" autocomplete="new-password" required/>
                                            
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="text-end mt-1">
                                @if (Route::has('password.request'))
                                <a class="text-primary" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                            <br/>
                            <div class="form-group mb-0 d-flex align-items-center">
                                <div class="me-3">
                                    <button type="submit" class="btn btn-primary px-5 py-2">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <p class="mb-0 ">Don't have an account? 
                                    Create one <a href="{{url('/register')}}" class="">Here</a>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection