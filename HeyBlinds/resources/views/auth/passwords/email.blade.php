@extends('layouts.Frontend.app')
@section('title')
    Forgot Password | HeyBlinds Canada  
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-9 py-lg-5 py-4">
            <div class="row align-items-center">
            <div class="col-md-6 ">
                <img src="{{ asset('images/login-image.png') }}" alt="hey blindes logo">
            </div>
            <div class="col-md-6 ps-lg-5">
                <h3 class="fw-bold ps-4 border-start border-5 border-primary py-0">{{ __('Forgot Password') }}</h3>

                <div class="pt-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="email" class="">{{ __('E-Mail Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-primary mt-2 mb-2 px-4">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
