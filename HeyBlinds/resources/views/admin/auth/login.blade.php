<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HeyBlinds') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('admin/images/favicons/apple-touch-icon.png')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('admin/images/favicons/favicon-32x32.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/images/favicons/favicon-16x16.png')}}" />
    <link rel="manifest" href="{{asset('admin/images/favicons/site.webmanifest')}}" />

    <!-- Style sheet import -->
    <link rel="stylesheet" id="bootstrap-css" href="{{asset('admin/css/bootstrap.min.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="style-css" href="{{asset('admin/css/style.css')}}" type="text/css" media="all" />

    <!-- fontawesome import -->
    <script type="text/javascript" src="https://kit.fontawesome.com/4bb008fe2b.js"></script>

    <!-- Google fonts import -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400&display=swap"
        rel="stylesheet">
</head>
<body>
<form method="POST" action="{{ route('admin.login.submit') }}" accept-charset="UTF-8">
    @csrf
    <div class="fullHeight bg-light">
        <div class="loginPage w-100">
            <div class="container">
                <div class="row align-items-center py-5">

                    <div class="col-lg-4 col-md-5 px-5 px-md-0">
                        <div class=" d-flex justify-content-center px-sm-5 pb-3 pb-md-0 px-md-0">
                            <img src="{{asset('admin/images/HeyBlindslogo-big.png')}}" class="" alt="Logo">
                        </div>
                    </div>

                    <div class="offset-lg-1 col-lg-5 offset-md-1 col-md-6 mt-3 mt-md-0">
                        <div class="right__panel">
                            <div class="signIn__head">
                                <h2 class="header__text mb-2">Admin Sign in</h2>
                                <h5 class="subHeader__text">
                                    Simple to order. Easy to love.
                                </h5>
                            </div>
                            @if ($message = Session::get('message'))
                            <div  role="alert" class="alert alert-danger alert-block alert-dismissible fade show">
                                  <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            <div class="form-floating mt-4 mb-3">
                                <input id="floatingInput" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input id="floatingPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                         {{--    <div class="form-floating mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-primary w-100 mb-3 py-3 mt-3">
                                Sign in Now
                            </button>
                            {{-- <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a  href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

</body>
</html>
