@extends('layouts.Frontend.app')
@section('content')
<section class="container">
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&quot;);">
        <ol class="breadcrumb mb-2 pt-2">
            <li class="breadcrumb-item">
                <a href="{{ route('welcome') }}">
                    Home
                </a>
            </li>
            <li aria-current="page" class="breadcrumb-item active">
              My Account
            
            </li>
        </ol>
    </nav>
</section>
<section id="body-content">
    <div class="container py-3 pb-4 pb-xxl-5">
        <div class="row">
            <div class="col-lg-4">
                @include('user.sidebar')
            </div>
            <div class="col-lg-8 pt-4">
                <div class="tab-content" id="myTabContent">
                    <div aria-labelledby="home-tab" class="tab-pane fade show active" id="home" role="tabpanel">
                        <h5 class="font-secondary fw-bold">
                            My Account
                        </h5>
                       @include('partial.message')
                        <hr class="mt-2"/>
                        <p>
                            Account info.
                        </p>
                        <form action="{{ route('user.account.update') }}" method="POST">
                            @php
                            $user = Auth::user();
                            @endphp
                            <div class="row g-3 align-items-center ">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control bg-transparent" name="first_name" placeholder="First Name" type="text" value="{{old('first_name')?? $user->first_name?? ''}}"/>
                                        <label for="first_name">
                                            First Name
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{-- @error('first_name')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control bg-transparent" name="last_name" placeholder="Last Name" type="text" value="{{old('last_name') ?? $user->last_name ?? ''}}"/>
                                        <label for="last_name">
                                            Last Name
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control bg-transparent" name="email" placeholder="Email" type="email" value="{{old('email') ?? $user->email ?? ''}}"/>
                                        <label for="email">
                                            Email
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{-- @error('email')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control num-nav bg-transparent phone_number" maxlength="16" name="phone_number" placeholder="Phone Number" type="text" value="{{ old('phone_number')?? $user->profile->phone_number ?? ''}}"/>
                                        <label for="phone_number">
                                            Phone Number
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{-- @error('phone_number')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="shipping_street" placeholder="Street Address" type="text" value="{{old('shipping_street') ?? $user->profile->street ?? ''}}"/>
                                        <label for="">
                                            Street Address
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{-- @error('shipping_street')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="shipping_address" placeholder="Street Address" type="text" value="{{old('shipping_address',$user->profile->address ?? '')}}"/>
                                        <label for="">
                                            Apt, Ste, Unit, Bldg (Optional)
                                        </label>
                                        {{-- @error('shipping_address')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="shipping_city" placeholder="City" type="text" value="{{old('shipping_city',$user->profile->city ?? '')}}"/>
                                        <label for="city">
                                            City
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{-- @error('shipping_city')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-floating">
                                        <select class="form-select" aria-label="Floating label select example"
                                            name="shipping_province" id="shipping_province">
                                            <option value="">Province</option>
                                            <option value="AB" {{ (@$user->profile->province == 'AB') ? 'selected' : '' }} >AB</option>
                                            <option value="BC" {{ ( @$user->profile->province == 'BC') ? 'selected' : '' }} >BC</option>
                                            <option value="MB" {{ ( @$user->profile->province == 'MB') ? 'selected' : '' }} >MB</option>
                                            <option value="NB" {{ ( @$user->profile->province == 'NB') ? 'selected' : '' }} >NB</option>
                                            <option value="NL" {{ ( @$user->profile->province == 'NL') ? 'selected' : '' }} >NL</option>
                                            <option value="NS" {{ ( @$user->profile->province == 'NS') ? 'selected' : '' }} >NS</option>
                                            <option value="NT" {{ ( @$user->profile->province == 'NT') ? 'selected' : '' }} >NT</option>
                                            <option value="NU" {{ ( @$user->profile->province == 'NU') ? 'selected' : '' }} >NU</option>
                                            <option value="ON" {{ ( @$user->profile->province == 'ON') ? 'selected' : '' }} >ON</option>
                                            <option value="PE" {{ ( @$user->profile->province == 'PE') ? 'selected' : '' }} >PE</option>
                                            <option value="QC" {{ ( @$user->profile->province == 'QC') ? 'selected' : '' }} >QC</option>
                                            <option value="SK" {{ ( @$user->profile->province == 'SK') ? 'selected' : '' }} >SK</option>
                                            <option value="YT" {{ ( @$user->profile->province == 'YT') ? 'selected' : '' }} >YT</option>
                                        </select>
                                        <label for="province">
                                            Province
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{-- @error('shipping_province')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-floating">
                                        <input class="form-control postal_code" maxlength="7" name="postal_code" placeholder="Postal" type="text" value="{{old('postal_code') ?? $user->profile->postal_code ?? ''}}"/>
                                        <label for="">
                                            Postal Code
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{-- @error('postal_code')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <button class="mt-3 btn btn-primary px-4 mb-2" type="submit">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                        <h5 class="font-secondary fw-bold mt-3 mt-lg-0">
                            Change Password
                        </h5>
                        <hr class="mt-2"/>
                        <form action="{{ route('user.change.password') }}" method="POST">
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input class="form-control bg-transparent" name="current_password" placeholder="Current Password" type="password"/>
                                        <label for="">
                                            Current Password
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{-- @error('current_password')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-lg-6 d-none d-lg-block">
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
                                        <input id="new_password" class="form-control num-nav bg-transparent view_password" name="new_password" placeholder="New Password" type="password"/>
                                        <label for="">
                                            New Password
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                            
                                        {{-- @error('new_password')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror --}}
                                    </div>


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
                                        <input class="form-control num-nav bg-transparent view_password" name="confirm_password" placeholder="Confirm Password" type="password"/>
                                        <label for="">
                                            Confirm Password
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                         {{-- @error('confirm_password')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span> 
                                        @enderror --}}
                                    </div>
                                </div>
                                
                                <div class="col-12 text-end">
                                    <button class="mt-3 btn btn-secondary mb-2  px-4" type="reset">
                                        Cancel
                                    </button>
                                    <button class="mt-3 btn btn-primary mb-2 ms-2 px-4" type="submit">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
<script>
    $(document).on('click', '.cart-remove-button', function (e) {
        e.preventDefault();
        let $this = $(this);
        const data = {
            'cartId' : $this.attr('data-id'),
            '_token' : "{{csrf_token()}}"
        }
        console.log(data);
        axios.post('{{route('frontend.save.cart.destroy')}}', data)
        .then(function (response) {
            let data = response.data;
            if (data == 1){
                toastr.success('Removed!');
                $this.parents('.save-cart-list').remove();
            }else{
                toastr.error("Something went wrong. Please try again later!");
            }
        })
        .catch(function (errors) {
            let error = errors.response.data.errors.reason;
            toastr.error(error);
        });
    });



    $(document).on('focus' , '#new_password', function(){
            $('#PasswordStrengthMessage').slideDown();("slow");
        });


        $(document).on('keyup', '#new_password',function () {
            var myinput = $("#new_password");
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
                $('#result').addClass('text-danger').text('Very Week');
                $('#password-strength').css('width', '10%', 'bac');
            } else if (strength == 2) {
                $('#password-strength').addClass('bg-danger');
                $('#result').addClass('text-danger').text('Week')
                $('#password-strength').css('width', '40%');
                return 'Week'
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

<script type="text/javascript">
   {{--  $(document).ready(function(){
        var cartId = readCookie('__cart_items');
        const data = {
            'cartId' : cartId,
            '_token' : "{{ csrf_token() }}",
        }
        if(cartId){
            //alert(cartId);
            axios.post(`/save-cart/${cartId}/update`, data)
            .then(function (response) {
               // console.log(response);
                // if (response.data == 1){
                //     eraseCookie('__cart_items');
                //     localStorage.removeItem("__cart_items");
                //     $('#orderCartCountBadge').text("0");
                // }else{
                //     toastr.error("Something went wrong. Please try again later!");
                // }
            })
        }
    })
</script> --}}

@endpush
@endsection
