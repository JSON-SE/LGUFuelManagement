@extends('layouts.Frontend.app')
@section('title')
Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada 
@endsection
@section('content')
<div class="container">
    <div class="pb-4 pb-md-5">
        <div class="pt-4 py-sm-5">
            @auth
            <h5 class="step-heading text-uppercase">
                Your Cart is now Saved!
            </h5>
             <hr/>
            <div class="row  pb-2">
                <div class="col-lg-12">
                   {{--  <label>
                        Why are you saving your cart today?
                    </label>
                    <select class="form-select mt-2 " id="saveReason" name="reason">
                        <option value="">
                            Why are you saving your cart today?
                        </option>
                        <option value="I'm waiting for samples">
                            I'm waiting for samples
                        </option>
                        <option value="I'm comparing prices">
                            I'm comparing prices
                        </option>
                        <option value="I'm not ready to order">
                            I'm not ready to order
                        </option>
                        <option value="I need to measure">
                            I need to measure
                        </option>
                        <option value="I'm waiting for a big sale">
                            I'm waiting for a big sale
                        </option>
                        <option value="I need help">
                            I need help
                        </option>
                    </select> --}}
                   <p> 
                        <div class="bg-white p-4 rounded shadow h6">
                            Sign in to <a href="{{ url('/user/my-cart') }}">My Account</a> anytime to review your saved orders and complete them as final orders.
                            <p class="mt-2 mb-0">Hey, just  reach out with any questions:</p>
                            <p class="mt-2 mb-0">Call: <a href="tel:(888) 412-3439">(888) 412-3439</a> or <a href="{{ url('/contact-us') }}">email us</a>.</p>
                        </div>
                    </p>
                </div>
                <div class="col-12 mt-4">
                    <div class="row">
                       {{--  <div class="col-md-3">
                            <button class="mt-3 btn btn-primary w-100 mb-2" id="saveCartButton" type="button">
                                Save Your Cart
                            </button>
                        </div> --}}
                       
                        @endauth
                        @guest
                        <div class="row align-itens-center">
                            <div class="col-lg-7 mt-2 pe-lg-5">
                                <h5 class="font-secondary fw-bold mb-1">
                                    New to Hey Blinds?
                                </h5>
                                <p class="mb-2">
                                    Just complete this info to save your cart:
                                </p>
                                <form action="{{ route('user.registration') }}" method="post" autocomplete="off">
                                    <div class="row g-2 gx-3 ">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control bg-transparent" name="first_name" placeholder="First Name" value="{{old('first_name')}}" type="text"/>
                                                <label for="first_name">
                                                    First Name
                                                    <span class="text-danger">
                                                        *
                                                    </span>
                                                </label>
                                            </div>
                                            @error('first_name')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control bg-transparent" name="last_name" value="{{old('last_name')}}" placeholder="Last Name" type="text"/>
                                                <label for="last_name">
                                                    Last Name
                                                </label>
                                            </div>
                                            @error('last_name')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input class="form-control bg-transparent" name="email" placeholder="Email" type="email" autocomplete="off" value="{{old('email')}}" />
                                                <label for="email" >
                                                    Email
                                                    <span class="text-danger">
                                                        *
                                                    </span>
                                                </label>
                                            </div>
                                            @error('email')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input class="form-control bg-transparent" name="confirm_email" placeholder="confirm email" type="email" value="{{old('confirm_email')}}" autocomplete="off" />
                                                <label for="confirm_email">
                                                    Confirm Email
                                                    <span class="text-danger">
                                                        *
                                                    </span>
                                                </label>
                                            </div>
                                            @error('confirm_email')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating view_password_option">
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
                                                <input class="form-control bg-transparent view_password" id="_password" name="password" placeholder="Password" type="password" value="{{old('password')}}" autocomplete="new-password" />
                                                <label for="password">
                                                    Password
                                                    <span class="text-danger">
                                                        *
                                                    </span>
                                                </label>
                                            </div>
                                            @error('password')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}<br/>
                                            </span>
                                            @enderror
                                            {{-- <small>
                                                (Your password must contain at least one uppercase, or capital, letter
                                                and at least 8 characters).
                                            </small> --}}

                                        <div id="PasswordStrengthMessage" class="rounded shadow p-3">
                                            <p class="mb-2">Password Strength: <span id="result"> </span></p>
        
                                            <div class="progress mb-2">
                                                <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                </div>
                                            </div>
        
                                              <p id="letter" class="invalid mb-1 d-flex align-items-center">
                                                  <span class="pe-2">
        
        
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                      </svg>
        
        
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                      </svg>
                                                  </span>
                                                  <span>A <b>lowercase</b> letter</span></p>
                                              <p id="capital" class="invalid mb-1 d-flex align-items-center">
                                                <span class="pe-2">
        
        
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                      </svg>
        
        
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                      </svg>
                                                  </span>
                                                  <span>A <b>capital (uppercase)</b> letter</span></p>
                                              <p id="number" class="invalid mb-1 d-flex align-items-center">
                                                <span class="pe-2">
        
        
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                      </svg>
        
        
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                      </svg>
                                                  </span>
                                                  <span>A <b>number</b></span></p>
                                              <p id="specialcharacter" class="invalid mb-1 d-flex align-items-center">
                                                <span class="pe-2">
        
        
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                      </svg>
        
        
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                      </svg>
                                                  </span>
                                                  <span>
                                                    1 <b>Special Character</b> (@ , ! , # , $ , & , * ,  - ,  .  ).
                                                  </span></p>
                                              <p id="length" class="invalid mb-0 d-flex align-items-center">
                                                <span class="pe-2">
        
        
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                      </svg>
        
        
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                      </svg>
                                                  </span>
                                                  <span>Minimum <b>8 characters</b></span></p>
                                          </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <input class="form-control num-nav bg-transparent phone_number" maxlength="16" name="phone_number" placeholder="Phone Number" value="{{old('phone_number')}}" type="text"/>
                                                        <label for="">
                                                            Phone Number
                                                            <span class="text-danger">
                                                                *
                                                            </span>
                                                        </label>
                                                    </div>
                                                    @error('phone_number')
                                                    <span class="text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 text-center">
                                                    <button class="mt-3 btn btn-primary w-100 mb-2" name="cart-register" type="submit">
                                                        Create Your Account & Save Your
                                                        Cart
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-5 mt-2 ps-lg-5 py-4 border-start border-lg-none">
                                        <h5 class="font-secondary fw-bold mb-1">
                                            Sign In
                                        </h5>
                                        <p class="mb-2">
                                            Already have an account with us? Log in here:
                                        </p>
                                        <form action="{{ route('user.save.login') }}" method="post" autocomplete="off">
                                            <div class="row g-2 gx-3 align-items-center">
                                                <div class="col-lg-12">
                                                    <div class="form-floating">
                                                        <input class="form-control bg-transparent" name="login_email" placeholder="Email" type="email" autocomplete="login_email"  />
                                                        <label for="email">
                                                            Email
                                                            <span class="text-danger">
                                                                *
                                                            </span>
                                                        </label>
                                                        @error('login_email')
                                                        <span class="text-danger" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-floating  view_password_option">
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
                                                        <input class="form-control bg-transparent view_password" name="login_password" placeholder="Password" type="password" autocomplete="new-password"  />
                                                        <label for="">
                                                            Password
                                                            <span class="text-danger">
                                                                *
                                                            </span>
                                                        </label>
                                                        @error('login_password')
                                                        <span class="text-danger" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 text-end" style="padding-bottom: 2px;">
                                                    <a href="{{ url('/forgot-password') }}">
                                                        Forgot Your
                                                        Password?
                                                    </a>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <button class="mt-3 btn btn-primary w-100 mb-2" name="cart-login" type="submit">
                                                       Sign In & Save Your Cart
                                                   </button>
                                               </div>
                                           </div>
                                       </form>
                                       @endguest
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
      

       @push('js')
       <script>
        @auth
            $(document).ready(function (e) {
               // e.preventDefault();
                const data = {
                    'cartId' : "{{ $id }}",
                    'reason' : 'cart save',
                    '_token' : "{{ csrf_token() }}"
                }
                axios.post('{{ route('frontend.save.cart.store', $id) }}', data)
                .then(function (response) {
                    let data = response.data;
                    if (data == 1){
                       // $('body').append(modal());
                        eraseCookie('__cart_items');
                        localStorage.removeItem("__cart_items");
                        $('#orderCartCountBadge').text("0");
                    }else{
                        toastr.error("Something went wrong. Please try again later!");
                    }
                })
                .catch(function (errors) {
                    let error = errors.response.data.errors.reason;
                    toastr.error(error);
                    
                });
            })

        // function modal(data){
        //     return `<div class="custom-modalcontainer">
        //     <div class="flex">
        //     <div class="custom-modal">
        //     <div class="content">
        //     <h4 class="text-center">You cart is successfully saved!</h4>
        //     </div>
        //     <div class="row pb-4 px-4">
        //     <div class="col-md-6 pb-2 pb-md-0">
        //     <a href="{{ route('welcome') }}" class="btn-light btn custom w-100 py-md-2">Continue Your Shopping</a>
        //     </div>
        //     <div class="col-md-6">
        //     <a href="{{ route('user.cart') }}" id="goToCart" class="btn-primary btn custom w-100 py-md-2">Go To Saved Cart
        //     </a></div>

        //     </div>
        //     </div>
        //     </div>
        //     </div>`
        // }
        @endauth

        $(document).on('focus' , '#_password', function(){
            $('#PasswordStrengthMessage').slideDown();("slow");
        });


        $(document).on('keyup', '#_password',function () {
            var myinput = $("#_password");
            var strength = 0;

            if(this.value.length >= 8) {
                strength += 1;
                $("#length").removeClass("invalid");
                $("#length").addClass("valid");
            } else {
                $("#length").removeClass("valid");
                $("#length").addClass("invalid");
            }


            var lowerCaseLetters = /[a-z]/g;
            if(this.value.match(lowerCaseLetters)) { 
                strength += 1; 
                $("#letter").removeClass("invalid");
                $("#letter").addClass("valid");
            } else {
                $("#letter").removeClass("valid");
                $("#letter").addClass("invalid");
            }


            var upperCaseLetters = /[A-Z]/g;
            if(this.value.match(upperCaseLetters)) {  
                strength += 1;
                $("#capital").removeClass("invalid");
                $("#capital").addClass("valid");
            } else {
                $("#capital").removeClass("valid");
                $("#capital").addClass("invalid");
            }

            var numbers = /[0-9]/g;
            if(this.value.match(numbers)) {  
                strength += 1;
                $("#number").removeClass("invalid");
                $("#number").addClass("valid");
            } else {
                $("#number").removeClass("valid");
                $("#number").addClass("invalid");
            }

            var numbers = /([!,%,&,@,#,$,^,*,?,_,~])/g;
            if(this.value.match(numbers)) {  
                strength += 1;
                $("#specialcharacter").removeClass("invalid");
                $("#specialcharacter").addClass("valid");
            } else {
                $("#specialcharacter").removeClass("valid");
                $("#specialcharacter").addClass("invalid");
            }
            if (strength < 2) {
                $('#result').removeClass()
                $('#password-strength').addClass('bg-danger');
                $('#result').addClass('text-danger').text('Very Weak');
                $('#password-strength').css('width', '10%', 'bac');
            } else if (strength == 2) {
                $('#password-strength').addClass('bg-danger');
                $('#result').addClass('text-danger').text('Weak')
                $('#password-strength').css('width', '40%');
                return 'Weak'
            } else if (strength == 3) {
                $('#result').removeClass()
                $('#password-strength').removeClass('bg-danger');
                $('#password-strength').addClass('bg-warning');
                $('#result').addClass('text-warning').text(' Good');
                $('#password-strength').css('width', '60%');

                return 'Strong'
            } else if (strength == 4) {
                $('#result').addClass('strong');
                $('#result').addClass('text-warning').text('Very Good');
                $('#password-strength').css('width', '80%');

                return 'Strong'
            } else if (strength == 5) {
                $('#result').removeClass()
                $('#result').addClass('strong');
                $('#password-strength').removeClass('bg-warning');
                $('#password-strength').addClass('bg-success');
                $('#result').addClass('text-success').text('Strength');
                $('#password-strength').css('width', '100%');

                return 'Strong'
            }

        });
    </script>
    @endpush
    @endsection
