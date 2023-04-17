@extends('layouts.Frontend.app')
@section('title')
    Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada
@endsection
@section('style')
    <style>
        select[readonly] {
            pointer-events: none;
        }

        .btn-close.continue-shopping {
            background-color: #fe5f55;
            position: absolute;
            right: -15px;
            top: -15px;
            width: 25px;
            height: 25px;
            border-radius: 100%;
            opacity: 1;
            color: #fff;
        }

        .review-order-details-model-content {
            height: 50vh;
            overflow-y: scroll;
        }

        .capitalize_for_card {
            text-transform: capitalize;
        }

    </style>
@endsection

@section('content')
    @php
    $user = Auth::user();
    @endphp

    <div id="loader">
        <div class="loader-body">
            <div class="loader">
                <div class="face">
                    <div class="circle"></div>
                </div>
                <div class="face">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="POST" action="#" id="placeOrderForm" class="payment__form" autocomplete="off" role="presentation">
            <input type="hidden" name="current_url" value="{{ Request::fullUrl() }}">
            <div class="row pb-4 pb-md-5">
                <div class="col-md-8 pt-3 color-sidedar-fixd">
                    <h5 class="step-heading">Checkout</h5>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    @php
                        $verified = @Auth::user()->email_verified_at ?? false;
                        @endphp

                        @if (!Auth::check())
                            <div class="cart-box px-4 py-3 rounded mt-3" id="checkout-signin-block">
                                <h5 class="font-secondary fw-bold">Sign In</h5>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="row gx-2 ">
                                            <div class="col-lg-5 ">
                                                <div class="form-floating">
                                                    <input type="email" class="form-control bg-transparent signin_email"
                                                        name="email" placeholder="Email" id="signin_email" autocomplete="off">
                                                    <label for="floatingInput">Email address</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 pt-2 pt-lg-0">
                                                <div class="form-floating view_password_option">
                                                    <span id="togglePassword" class="toggle-password">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                            <path
                                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                        </svg>

                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                                            <path
                                                                d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" />
                                                            <path
                                                                d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z" />
                                                            <path
                                                                d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z" />
                                                        </svg>
                                                    </span>

                                                    <input type="password"
                                                        class="form-control bg-transparent view_password signin_password"
                                                        name="password" placeholder="Password" autocomplete="off">
                                                    <label for="floatingPassword">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 pt-2 pt-lg-0">
                                                <button type="button" class="btn h-100 w-100 btn-secondary btn-sm" id="signin"
                                                    name="signin" style="padding:9px" onClick="LoginSignin(this)">Sign
                                                    In</button>
                                            </div>
                                        </div>
                                        <a class="text-secondary mt-2" href="{{ url('/forgot-password') }}">Forgot Your
                                            Password?</a>
                                        <label class="gx-2 mt-2 text-danger checkoutsignin"></label>
                                    </div>
                                    <div class="col-lg-4 d-none">
                                        <button class="social-media-btn"><span><i class="fab fa-facebook-f"></i></span>
                                            Sign in with Facebook</button>
                                    </div>
                                    <div class="col-lg-12">

                                        <div class="mb-0 mt-3">Don't have an account with us? You can create one below
                                            <span class="position-relative mousuhover-out">
                                                <span class="text-primary tooltip-hover">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-question-circle-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <div class="tooltip shadow">
                                                    <div class="tooltip-arrow"></div>
                                                    <span class="close-tooltip btn-close btn"></span>
                                                    <div class="tooltip-inner">
                                                        <div class="row g-2">
                                                            <div class="col-12">
                                                                <h6 class="fw-semibold mb-1">Create an account and benefit from:
                                                                </h6>
                                                                <hr class="mb-0 mt-2" />
                                                            </div>

                                                            <div class="col-6">
                                                                <ul class="category-product-list">
                                                                    <li>Order tracking</li>
                                                                    <li>Faster checkout</li>
                                                                    <li>Exclusive offers </li>
                                                                </ul>
                                                            </div>

                                                            <div class="col-6">
                                                                <ul class="category-product-list">
                                                                    <li>Saved carts</li>
                                                                    <li>Easier shopping</li>
                                                                    <li>Promotional emails</li>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @elseif(!$verified)
                            <div class="cart-box px-4 py-3 rounded mt-3 pt-4" id="checkout-signin-block">
                                <p style="font-size:16px; color:red">Hey, please check your email for a link we sent you to
                                    verify your email address. <br />Then you can checkout and we can get started on making your
                                    custom blinds & shades!
                                    <br>
                                    <span id="verificationLink" style="cursor:pointer; text-decoration:underline">Click here to
                                        get verification email if you haven't received it before.</span><br>
                                </p>
                                <br>
                                <p> If you have just verified your email, please refresh the page once.
                                <p>
                            </div>
                        @endif
                        <input type="hidden" name="cart_id" value="{{ $cart->id }}" />
                        <div class="accordion mt-4 text-left" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header accordion-btn-section " id="headingOne">
                                    <button class="accordion-button ps-3" type="button" data-bs-target="#collapseOne"
                                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                        <div>Shipping Information</div>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show border-0"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body px-1">

                                        <p>No P.O. boxes please, blinds won't fit in them.</p>

                                        <h5 class="step-heading">Shipping Address</h5>
                                        <div class="row g-2 gx-3 personal-infomation-form align-items-center pt-2">
                                            <div class="col-lg-6">
                                                <div class="form-floating">

                                                    <input type="text" class="form-control required" placeholder="Email"
                                                        name="shipping_email"
                                                        value="{{ $cart->abandoned->shipping_email ?? (auth()->user()->email ?? '') }}"
                                                        required autocomplete="off" />
                                                    <label for="">Email <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control required" placeholder="Email"
                                                        name="confirm_shipping_email" required autocomplete="off" />
                                                    <label for="">Confirm Email <span class="text-danger">*</span></label>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-floating">

                                                    <input type="text" class="form-control required capitalize"
                                                        placeholder="First Name" name="shipping_first_name"
                                                        value="{{ $cart->abandoned->shipping_first_name ?? (auth()->user()->first_name ?? '') }}"
                                                        required />
                                                    <label for="">First Name <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control required capitalize"
                                                        placeholder="Last Name" name="shipping_last_name"
                                                        value="{{ $cart->abandoned->shipping_last_name ?? (auth()->user()->last_name ?? '') }}"
                                                        required />
                                                    <label for="">Last Name <span class="text-danger">*</span></label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-floating ">
                                                    <input type="text" class="form-control phone_number required"
                                                        placeholder="Phone Number" name="shipping_phone_number" maxlength="16"
                                                        id="shipping_phone_number"
                                                        value="{{ $cart->abandoned->shipping_phone_number ?? (auth()->user()->profile->phone_number ?? '') }}"
                                                        required />
                                                    <label for="Phone Number">Phone Number <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control capitalize required"
                                                        placeholder="Street Address" name="shipping_street"
                                                        value="{{ auth()->user()->profile->street ?? ($cart->abandoned->shipping_street ?? '') }}"
                                                        required />
                                                    <label for="">Street Address<span class="text-danger">*</span></label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control capitalize"
                                                        placeholder="Street Address" name="shipping_address"
                                                        value="{{ $cart->abandoned->shipping_address ?? (auth()->user()->profile->address ?? '') }}" />
                                                    <label for="">Apt, Ste, Unit, Bldg (Optional)</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-sm-6">
                                                <div class="position-relative">
                                                    <div class="form-floating">
                                                        @if (config('global.is_heyblinds_com') == true)
                                                            <input type="text" class="form-control  required"
                                                                placeholder="Postal" name="shipping_postal_code"
                                                                value="{{ $cart->abandoned->shipping_postal_code ?? (auth()->user()->profile->postal_code ?? '') }}"
                                                                maxlength="5" required />
                                                        @else
                                                            <input type="text" class="form-control postal_code required"
                                                                placeholder="Postal" name="shipping_postal_code"
                                                                id="shipping_postal_code"
                                                                value="{{ $cart->abandoned->shipping_postal_code ?? (auth()->user()->profile->postal_code ?? '') }}"
                                                                maxlength="7" required />
                                                        @endif
                                                        <label for="">Postal Code <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="invalid-tooltip shipping-postal">
                                                        Please enter your postal code following this format X0X 0X0 (for example
                                                        H3Y 2B6)
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-sm-6">
                                                <div class="form-floating">

                                                    @if (config('global.is_heyblinds_com') == true)
                                                        <select class="form-select required"
                                                            aria-label="Floating label select example" name="shipping_province"
                                                            id="shipping_province" required>
                                                            <option value="">State</option>
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->name }}">{{ $state->name }}
                                                                </option>
                                                            @endforeach
                                                            <label for="">State <span class="text-danger">*</span></label>
                                                        </select>
                                                    @else

                                                        <select class="form-select required"
                                                            aria-label="Floating label select example" name="shipping_province"
                                                            id="shipping_province" onchange="taxCalculation(event)" required>
                                                            <option value="">Province</option>
                                                            @foreach ($proviences as $provience)
                                                                <option value="{{ $provience->code }}"
                                                                    {{ @$cart->abandoned->shipping_province == $provience->code ? 'selected' : ' ' }}>
                                                                    {{ $provience->code }}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="">Province <span class="text-danger">*</span></label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control capitalize required"
                                                        placeholder="City" name="shipping_city" id="shipping_city"
                                                        value="{{ $cart->abandoned->shipping_city ?? (auth()->user()->profile->city ?? '') }}"
                                                        required />
                                                    <label for="city">City <span class="text-danger">*</span></label>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <input type="checkbox" id="billingInformation" name="billingInformation"
                                                        {{ !empty($cart->abandoned->has_billing) && $cart->abandoned->has_billing == 1 ? 'checked' : '' }}
                                                        value="1" onchange="valueChanged()" checked />
                                                    <label class="m-0 p-0" for="billingInformation">(Billing Address is
                                                        same as Shipping Address)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="shipping-display"></div>
                                        @if (!Auth::check())
                                            <div class="cart-box p-3 mt-3">
                                                <div class="radio m-0 mb-2" style="height: auto;">
                                                    <input id="checkout-1" name="guest_user" type="radio"
                                                        class="required" checked value="1"
                                                        onchange="CheckoutPassword()" />
                                                    <label for="checkout-1" class="radio-label required fw-bold">CONTINUE AS A
                                                        GUEST</label>
                                                </div>

                                                <div class="radio m-0" style="height: auto;">
                                                    <input id="checkout-2" name="guest_user" type="radio"
                                                        onchange="CheckoutPassword()" value="0" />
                                                    <label for="checkout-2" class="radio-label fw-bold">CREATE A HEYBLINDS
                                                        ACCOUNT
                                                        <br />
                                                        <p class="ms-4 ps-2 mb-0">Benefit from order tracking, faster checkout
                                                            and easier shopping.</p>
                                                    </label>
                                                </div>
                                                <div id="checkout-password"> </div>

                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion mt-4 text-left" id="accordionExample2">
                            <div class="accordion-item mt-3">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button  ps-3 " type="button" data-bs-target="#collapseTwo"
                                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseTwo">
                                        <div>Card Details</div>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show border-0"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
                                    <div class="accordion-body px-1">
                                        <div
                                            class="row g-2 gx-3 personal-infomation-form align-items-center pt-2 flex-lg-row-reverse">

                                            <div class="col-xl-6 pb-lg-0">
                                                <div class="card-wrapper"></div>
                                            </div>
                                            <div class="col-xl-6 pt-4 pt-xl-0">

                                                <div class="form-container row g-2 active">

                                                    <div class="col-md-12 form-group pt-2 pt-md-0">
                                                        <label>Card Number</label>
                                                        <input class="form-control  required" placeholder="#### #### #### ####"
                                                            type="tel" id="card_input" name="card_number" required>
                                                    </div>
                                                    <div class="col-xxl-5 col-12 form-group pt-2">
                                                        <label>Full Name</label>
                                                        <input class="form-control  required"
                                                            style="text-transform: capitalize;" id="card_holder_name"
                                                            placeholder="Name" type="text" name="card_name" required>
                                                    </div>

                                                    <div class="col-xxl-4 col-6 form-group pt-2">
                                                        <label style="font-size: 12px;">Expiry date (MM/YYYY)</label>
                                                        <input type="text" class="form-control required" id="card_expiry"
                                                            placeholder="MM/YYYY" name="card_expiry" required>
                                                    </div>

                                                    <div class="col-xxl-3 col-6 form-group pt-2">
                                                        <label>CVV</label>
                                                        <input class="form-control num-nav required" id="card_cvc"
                                                            placeholder="CVC" type="password" name="card_cvc" maxlength="4"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="p-4 shadow-sm rounded mt-3">
                            Free ground shipping on blinds and shades. Shipments over 94” long are shipped for a flat,
                            non-refundable $85 oversize freight fee.You can expect to receive your blinds to arrive at your door
                            approximately 2-3 weeks after ordering. Shipping may take a little longer depending on your
                            location. Contact us for shipping estimates for your particular order.
                        </div>

                        <div class="accordion mt-4 text-left" id="accordionExample4">

                            <div class="accordion-item mt-3">
                                <h2 class="accordion-header" id="headingThree">
                                    <button type="button" class="accordion-button ps-3" data-bs-target="#collapseThree"
                                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseThree">
                                        <div>Terms & Conditions</div>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse show collapse border-0"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample4">
                                    <div class="accordion-body px-1">
                                        <div class="pt-2 row">
                                            <div class="form-group">
                                                <input type="checkbox" class="required" id="terms" name="terms"
                                                    value="1">
                                                <label class="m-0 p-0" for="terms">
                                                    Yes, sign me up for HeyBlinds special offers and important news.
                                                </label>
                                            </div>

                                            <div class="form-group mt-2">
                                                <input type="checkbox" id="terms_condition" name="terms_condition" value="1"
                                                    class="terms_condition required" required>
                                                <label class="m-0 p-0" for="terms_condition">
                                                    <span class="text-primary h4">*</span> By placing your order, you are
                                                    agreeing to the <a href="{{ url('/terms-and-conditions') }}"
                                                        target="_blank"> terms &
                                                        conditions</a>.
                                                </label>
                                            </div>
                                            <div class="mt-3">


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a class="pe-4 mt-2 text-dark " href="javascript:void(0)"
                                                            data-bs-toggle="modal" data-bs-target="#Risk-Free-Trial">
                                                            <span class="pe-2">
                                                                <img src="{{ asset('images/icon8.png') }}"
                                                                    alt="Hey Blindes 100 Day Risk Free">
                                                            </span>
                                                            100 Day Risk-Free In-Home Trial
                                                        </a>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <a class="text-dark mt-2 pe-4" href="javascript:void(0)"
                                                            data-bs-toggle="modal" data-bs-target="#RightFit-Guarantee">
                                                            <span class="pe-2">
                                                                <img src="{{ asset('images/icon7.png') }}"
                                                                    alt="Hey Blindes RightFit Guarantee">
                                                            </span>
                                                            <span>RightFit<small class="TrademarkSymbol">®</small> &nbsp;
                                                                Guarantee</span>
                                                        </a>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <a class="pe-4 mt-2 text-dark " href="javascript:void(0)"
                                                            data-bs-toggle="modal" data-bs-target="#Price-Lowest-Guarantee">
                                                            <span class="pe-2">
                                                                <img src="{{ asset('images/icon9.png') }}"
                                                                    alt="Hey Blindes Price Guarantee Lowest">
                                                            </span>
                                                            Best Price Guarantee
                                                        </a>
                                                    </div>


                                                    {{-- <div class="col-md-6">
                                                    <a class="pe-4 mt-2 text-dark " href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Year-Unlimited-Warranty">
                                                        <span class="pe-2">
                                                            <img src="{{ asset('images/icon10.png') }}" alt="Hey Blindes Delivery Truck">
                                                        </span>
                                                        FREE Limited Lifetime Warranty

                                                    </a>
                                                </div> --}}
                                                </div>
                                                {{-- <a href="{{ url('/free-shipping') }}" class="font-secondary text-dark fw-semibold me-4 mt-2">
                                                <span class="pe-1">
                                                    <img src="{{ asset('images/delivery-truck.png') }}" style="width: 30px; margin: -2px 0 0; position:relative;" alt="Hey Blindes Delivery Truck">
                                                </span>
                                                 Free Shipping
                                            </a>

                                            <a href="{{ url('/warranty') }}" class="font-secondary text-dark fw-semibold me-4 mt-2">RightFit Guarantee</a>

                                            <a href="{{ url('/warranty') }}" class="font-secondary text-dark fw-semibold me-4 mt-2">
                                                <h5 class="details-guarantee-text fst-italic"><span><span>100</span> Day </span> ‘I
                                                    <span class="heard-icon text-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"></path>
                                                          </svg>
                                                    </span> My Blinds’ Guarantee</h5>
                                            </a>

                                            <a href="{{ url('/warranty') }}" class="font-secondary text-dark fw-semibold me-4 mt-2">100-Day Price Guarantee</a> --}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 select-colour-items" style="z-index: 995;">
                        <div class="pt-4">

                            <div class="bg-white rounded shadow p-3">
                                <div>
                                    <h5>Cart Summary</h5>
                                    @if (!empty($cart->cart_id))
                                        <p class="fst-italic text-lg-small">Cart #: {{ $cart->cart_id }}</p>
                                    @endif
                                    <hr class="my-2" />

                                    <h6 class="d-flex"><span
                                            class="w-50">Subtotal<small>&nbsp;({{ $cartItemsCount }}
                                                @if ($cartItemsCount > 1)
                                                    items
                                                @else
                                                    item
                                                @endif)
                                            </small></span>
                                        <b class="w-50 text-end">${{ $helpers->withoutRounding($sub_total, 2) }}</b>
                                    </h6>
                                    @foreach ($promo_items as $key => $item)
                                        <h6 class="mb-2 d-flex text-primary">
                                            <span class="w-50">Sale Discount <span id="cart_product_promo_name">
                                                    <span>{{ $item->promo_type == 'flat' ? '$' : '' }}{{ $item->promo_discount }}{{ $item->promo_type == 'percentage' ? '%' : '' }}</span>
                                                </span> </span>
                                            <b class="text-end w-50"
                                                id="cart_product_promo_value{{ $item->id }}">-${{ number_format($item->promoPrice($cart->id, $item->product_id), 2) }}</b>
                                        </h6>
                                    @endforeach

                                    {{-- @if ($totalSave != 0)
                                    <h6 class="mb-2 d-flex text-primary">
                                        <span class="w-50">Sale Discount <span id="cartSaveAmount">  <span>{{$promoType === "percentage" ? $totalPercentage . "%" : "" }}</span> </span></span>
                                        <b class="text-end w-50"
                                           id="cartSaveDiscount">-${{ $helpers->withoutRounding($totalSave, 2) }}</b>
                                    </h6>
                                @endif --}}

                                    <div id="couponDiscount">
                                        @if (!empty($cart->coupon) && !empty($cart->discount))
                                            <h6 class="mb-2 d-flex text-primary" id="discountAmoutLabel">
                                                <span class="w-50">Extra Coupon Discount

                                                </span>
                                                <b class="text-end w-50"
                                                    id="cartSaveDiscount">-${{ $helpers->withoutRounding($cart->cart_item_discount, 2) }}</b>
                                            </h6>
                                        @endif
                                    </div>

                                    @if ($cart->shipping_extra_amount > 0)
                                        <h6 class="mb-2 d-flex shipping-price bg-white  text-start">
                                            <div class="w-50 d-flex"><span>Oversize Fee </span>
                                                <div class="position-relative ms-2 d-block mousuhover-out">
                                                    <span class="tooltip-hover question-icon text-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-question-circle-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                    <div class="tooltip shadow">
                                                        <div class="tooltip-arrow"></div>
                                                        <span class="close-tooltip btn-close btn"></span>
                                                        <div class="tooltip-inner">
                                                            <div class="row g-2">
                                                                <div class="col-12">

                                                                    <p>
                                                                        Because there is one or more item(s) in your
                                                                        cart that are over the shipping companies'
                                                                        'normal' size limit, there is an additional fee
                                                                        to cover the extra cost of shipping. This fee is
                                                                        charged only once per order, regardless of the
                                                                        number of oversized items in your cart.
                                                                    </p>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <b class="w-50 text-end"
                                                id="shipping_price">{{ $cart->shipping_extra_amount > 0 ? '$' . number_format($cart->shipping_extra_amount, 2) : 'Free' }}</b>
                                        </h6>
                                    @endif

                                    <h6 class="mb-2 d-flex bg-white  text-start">
                                        <span class="w-50">Shipping </span>
                                        <b class="text-end w-50 ">Free</b>
                                    </h6>

                                    <div class="mb-2 fs-6 d-flex handling-price text-start">
                                        <div class="w-50 d-flex"><span>Handling</span>
                                            <div class="position-relative ms-2 d-block mousuhover-out">
                                                <span
                                                    class="tooltip-hover question-icon position-relative {{ $cart->handling_extra_amount ?? 0 > 0 ? 'text-primary' : 'text-success' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-question-circle-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <div class="tooltip shadow">
                                                    <div class="tooltip-arrow"></div>
                                                    <span class="close-tooltip btn-close btn"></span>
                                                    <div class="tooltip-inner">
                                                        <div class="row g-2">

                                                            <div class="col-12">

                                                                <p>
                                                                    Our low industry standard order processing fee
                                                                    allows us to continue to offer you the best
                                                                    prices and free shipping.
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <b class="text-end w-50 "
                                            id='handling_price'>{{ $cart->handling_extra_amount ?? 0 > 0 ? '$' . number_format($cart->handling_extra_amount, 2) : 'Free' }}</b>
                                    </div>
                                    <hr class="my-2" />

                                    {{-- <h5 class="d-flex fw-bold"><span class="w-50 ">Your Price </span> --}}
                                    {{-- <b class="w-50 text-end">${{ $helpers->withoutRounding($price - $cart->cart_item_discount, 2) }}</b> --}}
                                    {{-- <b class="w-50 text-end your_price">${{ $helpers->withoutRounding(($price - $cart->cart_item_discount) +  ($cart->shipping_extra_amount + $cart->handling_extra_amount), 2) }}</b>
                                </h5> --}}
                                    <div class="taxData">
                                        @php
                                            $total = $price - $cart->cart_item_discount;
                                            $total_tax_amount = $price - $cart->cart_item_discount + ((float) $cart->shipping_extra_amount + (float) $cart->handling_extra_amount);
                                            $tax = json_decode($cart->cart_tax, true) ?? [];
                                        @endphp
                                        @foreach ($tax as $key => $value)
                                            @php
                                                $amount = (float) (($total_tax_amount * $value) / 100);
                                                $total += $amount;
                                            @endphp
                                            <h6 class="mb-2 d-flex text-primary" id="discountAmoutLabel">
                                                <span class="w-50 text-uppercase">{{ $key }}( {{ $value }}%
                                                    )</span>
                                                <b class="text-end w-50"
                                                    id="cartSaveDiscount">${{ $helpers->withoutRounding($amount, 2) }}</b>
                                            </h6>
                                        @endforeach
                                    </div>
                                    @php
                                        $total_your_price = $total + ($cart->shipping_extra_amount + $cart->handling_extra_amount);
                                    @endphp
                                    <h5 class="d-flex fw-bold" id="totalCart"><span class="w-50">TOTAL</span>
                                        <input type="hidden" name="total_cart_purchase_price"
                                            value="{{ $total_your_price }}">
                                        <b class="w-50 text-end totalDisplay" id="">
                                            ${{ $helpers->withoutRounding($total_your_price, 2) }}</b>
                                    </h5>
                                </div>
                                <div class="row gx-2">
                                    <div class="col-xl-6">
                                        <button type="button" class="btn btn-sm btn-secondary w-100 mt-2"
                                            id="reviewOrder">Review Order Details</button>
                                    </div>
                                    <div class="col-xl-6">
                                        <a href="{{ url('cart', $cart->external_id) }}"
                                            class="btn btn-sm btn-secondary w-100 mt-2" id="EditCart">Edit order</a>
                                    </div>
                                </div>
                                {{-- @if ($verified || !Auth::check()) --}}
                                <button type="submit" class="btn btn-lg btn-primary w-100 mt-2" id="placeOrder" disabled>Place
                                    Order</button>
                                {{-- @else
                              <a href="#" class="btn btn-lg btn-primary w-100 mt-2 disabled" id="placeOrderSecond">Verify
                              Email to Place Order</a>
                              @endif --}}

                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @include('layouts.review-order-modal')
        </div>

    @endsection
    @push('js')
        <script src="{{ asset('js/vendors/card.js') }}"></script>
        <script>
            jQuery(document).ready(function($) {
                let cartItemsCount = "{{ $cartItemsCount }}";
                $("#orderCartCountBadge").text(cartItemsCount);
                const data_cart_id = "{{ $cart->external_id }}";
                console.log(data_cart_id);
                createCookie('__cart_items', data_cart_id, 2);

                const provience_value = $('#shipping_province').val();
                if (provience_value) {
                    taxCalculation();
                }

                var card = new Card({
                    form: '.payment__form',
                    container: '.card-wrapper', // *required*
                    formSelectors: {
                        numberInput: 'input#card_input', // optional — default input[name="number"]
                        expiryInput: 'input#card_expiry', // optional — default input[name="expiry"]
                        cvcInput: 'input#card_cvc', // optional — default input[name="cvc"]
                        nameInput: 'input#card_holder_name' // optional - defaults input[name="name"]
                    },
                    debug: true // optional - default false
                });
            })
        </script>
        <script>
            jQuery(function($) {
                $(document).on('click', '#verificationLink', function(e) {
                    var cart_id = '{{ $cart->external_id }}';

                    axios.post('/email/verification-notification', {
                            'car_id': cart_id
                        })
                        .then(function(response) {
                            $("#emailVerificationModal").modal('show');
                            $("#textMessgeDisplay").text(
                                "A verification email is sent to your email address. Please check your email and verify to proceed."
                            );
                            $("#model-no").text("Yes");
                            $("#model-yes").css("display", "none");
                        });
                });
                $(document).on('submit', '#placeOrderForm', function(e) {
                    $('#placeOrder').prop('disabled', true);
                    e.preventDefault();
                    let $this = $(this);
                    let formData = $this.serialize();

                    $("#loader").show();
                    axios.post('/place-order', formData)
                        .then(function(response) {
                            if (response.data.status == true) {
                                $("#loader").hide();
                                eraseCookie('__cart_items');
                                localStorage.removeItem('__cart_items');
                                localStorage.clear();
                                window.location.href = "/thank-you/" + response.data.cart_id;
                            } else {
                                $("#loader").hide();
                                $('#placeOrder').prop('disabled', false);
                                toastr.error(response.data.message);
                            }

                        })
                        .catch(function(error) {
                            $("#loader").hide();
                            $('#placeOrder').prop('disabled', false);
                            let errors = error.response.data.errors;
                            $.each(errors, function(key, value) {
                                toastr.error(value)
                            })
                        });
                })
                $(document).on('click', '#reviewOrder', function(e) {
                    e.preventDefault();
                    $('#showModel, .custom-modalcontainer').show();
                })
            });

            jQuery(function($) {
                $(document).on('keyup', 'select, input', function(e) {
                    if ((e.target.tagName === "INPUT" || e.target.tagName === "SELECT")) {

                        var hasValue = true;

                        let common = $('select, input')
                        $(common).each(function() {

                            let $this = $(this);
                            if (($this.hasClass('required') || $this.attr('required')) && $this.prop(
                                    'name') !== 'email' && $this.prop('name') !==
                                'billingInformation' && $this.prop('name') !== 'terms' && $this.prop(
                                    'name') !== 'EMAIL' && $this.prop('name') !== 'cart_id' && $this
                                .prop('name') !== 'shipping_address' && $this.prop('name') !==
                                'password' && $this.prop('name') !==
                                'b_63bcc6cba65e5bd22543f91de_015c294428') {
                                if (($this.prop('tagName') === "INPUT" && $this.val() === "") || ($this
                                        .prop('type') === "select-one" && $this.val() === "") || ($this
                                        .prop('type') === "checkbox" && !$this.is(":checked"))) {
                                    hasValue = false;
                                }
                            }
                        })

                        saveCheckout()

                        if (hasValue) {
                            $('#placeOrder').prop('disabled', false);
                        } else {
                            $('#placeOrder').prop('disabled', true);
                        }
                    }
                })

                if ($('#billingInformation').is(":checked")) {
                    $('#shipping-display').empty();
                    $('#billingInformation').val(1);
                } else {
                    $('#shipping-display').append(shippingToggle());
                    $('#billingInformation').val(0);
                }
            })

            function saveCheckout() {
                let form = $("#placeOrderForm");
                let formData = new FormData(form[0]);
                const deleteData = ['card_number', 'card_name', 'card_expiry', 'card_cvc', 'email', 'password', 'guest_user',
                    'password_confirmation'
                ];
                $.each(deleteData, function(index, val) {
                    formData.delete(val)
                })
                axios.post('{{ route('frontend.save.checkout', $cart->id) }}', formData)
                    .catch(function(error) {
                        let errors = error.response.data.errors;
                        console.error(errors)
                    });
            }

            function AllowOnlyNumbers(e) {
                e = (e) ? e : window.event;
                var clipboardData = e.clipboardData ? e.clipboardData : window.clipboardData;
                var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
                var str = (e.type && e.type == "paste") ? clipboardData.getData('Text') : String.fromCharCode(key);
                return (/^\d+$/.test(str));
            }

            function LoginSignin(e) {
                var email = $(".signin_email").val();
                var password = $(".signin_password").val();
                var data = {
                    email: email,
                    password: password
                };

                // $("#signin").attr('type', 'submit');

                $("#loader").show();
                axios.post('/user/form-cart-login', data)
                    .then(function(response) {

                        if (response.data.status == true) {
                            $("#loader").hide();
                            toastr.success(response.data.message);
                            window.location.reload();
                        } else {
                            $("#loader").hide();
                            toastr.error(response.data.message);
                        }
                    })
                    .catch(function(error) {
                        $("#loader").hide();
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })
                    });
            }

            function valueChanged() {
                if ($('#billingInformation').is(":checked")) {
                    $('#shipping-display').empty();
                    $('#billingInformation').val(1);
                } else {
                    $('#shipping-display').append(shippingToggle());
                    $('#billingInformation').val(0);
                }
            }

            function shippingToggle() {
                return `<div class="shipping-display d-block mt-4">
        <h5 class="step-heading">Billing Address</h5>
        <div class="row g-2 gx-3 personal-infomation-form align-items-center pt-2">
        <div class="col-md-6">
        <div class="form-floating">
        <input type="text" class="form-control capitalize required" value="{{ $cart->abandoned->billing_first_name ?? '' }}" placeholder="First Name"
        name="billing_first_name" required/>
        <label for="">First Name <span class="text-danger">*</span></label>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-floating">
        <input type="text" class="form-control capitalize required" value="{{ $cart->abandoned->billing_last_name ?? '' }}" placeholder="Last Name"
        name="billing_last_name" required/>
        <label for="">Last Name <span class="text-danger">*</span></label>
        </div>
        </div>
        <div class="col-lg-6">
        <div class="form-floating ">
        <input type="text" class="form-control phone_number required" value="{{ $cart->abandoned->billing_phone_number ?? '' }}" placeholder="Phone Number"
        name="billing_phone_number" maxlength="16"
        onkeypress="return AllowOnlyNumbers(event);" required/>
        <label for="">Phone Number <span class="text-danger">*</span></label>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-floating">
        <input type="text" class="form-control capitalize required" value="{{ $cart->abandoned->billing_street ?? '' }}" placeholder="Street Address"
        name="billing_street" required/>
        <label for="">Street Address<span class="text-danger">*</span></label>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-floating">
        <input type="text" class="form-control capitalize" value="{{ $cart->abandoned->billing_address ?? '' }}" placeholder="Street Address"
        name="billing_address"/>
        <label for="">Apt, Ste, Unit, Bldg (Optional)</label>
        </div>
        </div>

        <div class="col-lg-3 col-sm-6">
        <div class="form-floating">
        <input type="text" class="form-control postal_code required" value="{{ $cart->abandoned->billing_postal_code ?? '' }}" placeholder="Postal" id="billing_postal_code"
        name="billing_postal_code" maxlength="7"
        required>

        <label for="">Postal Code <span class="text-danger">*</span></label>
          <div class="invalid-tooltip billing-postal">
            Please enter your postal code following this format X0X 0X0 (for example H3Y 2B6)
        </div>
        </div>

        </div>
        <div class="col-lg-3 col-sm-6">
        <div class="form-floating">
        <select class="form-select required" aria-label="Floating label select example"
        name="billing_province" id="billing_province" required>
        <option value="">Province</option>
        @foreach ($proviences as $provience)
            <option value="{{ $provience->code }}"
                {{ @$cart->abandoned->billing_province == $provience->code ? 'selected' : '' }}>{{ $provience->code }}
            </option>
        @endforeach
        </select>
        <label for="">Province <span class="text-danger">*</span></label>
        </div>
        </div>
         <div class="col-lg-6">
        <div class="form-floating">
        <input type="text" class="form-control capitalize required" value="{{ $cart->abandoned->billing_city ?? '' }}" placeholder="City"
        name="billing_city" id="billing_city" required/>
        <label for="">City <span class="text-danger">*</span></label>
        </div>
        </div>

        </div>
        </div>`;
            }

            function CheckoutPassword() {
                if ($('#checkout-2').is(":checked"))
                    $('#checkout-password').append(passwordFields()).delegate('.toggle-password', 'click', function() {
                        $(this).toggleClass('eye-active');
                        let input = $(this).next('.view_password');
                        input.attr('type', input.attr('type') === 'password' ? 'text' : 'password').focus();
                    });
                else
                    $('#checkout-password').empty();
            }

            function passwordFields() {
                return `<div class="checkout-password d-block">
        <div class="row g-2 mt-2">
        <div class="col-md-6">
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
        <input type="password" class="form-control view_password required bg-transparent"
        name="password" placeholder="First Name" required/>
        <label for="">Password <span class="text-danger">*</span></label>
        </div>
        </div>
        <div class="col-md-6">
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
        <input type="password" class="form-control view_password required bg-transparent"
        name="password_confirmation" placeholder="First Name" required>
        <label for="">Confirm Password <span
        class="text-danger">*</span></label>
        </div>
        </div>
        </div>
        </div>`
            }

            function taxCalculation(event) {
                var val = $("#shipping_province").val();
                url = "{{ url('tax-calculation') }}";
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        "provience": val,
                        "cart_id": {{ $cart->id }}
                    },
                    success: function(res) {
                        $(".taxData").css('display', 'block');
                        if (res.status == true) {
                            $(".taxData").html(res.response);
                            $(".totalDisplay").text("$" + (res.total));
                        }
                    },
                    error: function() {
                        console.log("error");
                    }
                });
            }
            $(document).on('keyup change', ".capitalize_for_card", function(e) {
                var string = $(this).val();
                if (string) {
                    //const uppercaseWords = string => string.replace(/^(.)|\s+(.)/g, c => c.toUpperCase());
                    //return uppercaseWords;
                    $(this).val(string.charAt(0).toUpperCase() + string.slice(1).toLowerCase());
                }
            });

            $(document).on('click', ".continue-shopping", function(e) {
                e.preventDefault();
                $(".custom-modalcontainer").fadeOut("slow");
                $(".modal").fadeOut("slow");
            });

            $(document).on('keyup change', "#shipping_postal_code", function(e) {
                e.preventDefault();
                var postal_code = $(this).val();
                var ca = new RegExp(/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]( )?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i);
                if (postal_code.length == 7 && ca.test(postal_code.toString())) {
                    $('.shipping-postal').css('display', 'none');
                    axios.post('/postal/code', {
                            postal_code: postal_code,
                        })
                        .then((response) => {
                            $('.shipping-postal').css('display', 'none');
                            if (response.data.standard.city) {
                                //$('#shipping_city').val(response.data.standard.city);
                                $("#shipping_province").val(response.data.standard.prov);
                                $(".taxData").css('display', 'block');
                                taxCalculation();
                            }
                        }).catch((error) => {
                            // $('#shipping_city').val('');
                            $('#shipping_province').val('');
                            $(".taxData").css('display', 'none');
                            $('.shipping-postal').css('display', 'block');
                        })
                } else {
                    //$('#shipping_city').val('');
                    $('#shipping_province').val('');
                    $(".taxData").css('display', 'none');
                    $('.shipping-postal').css('display', 'block');
                }
            });

            $(document).on('keyup change', "#billing_postal_code", function(e) {
                e.preventDefault();
                var billing_postal_code = $(this).val();
                var ca = new RegExp(/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]( )?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i);
                if (billing_postal_code.length == 7 && ca.test(billing_postal_code.toString())) {
                    $('.billing-postal').css('display', 'none');
                    axios.post('/postal/code', {
                            postal_code: billing_postal_code,
                        })
                        .then((response) => {
                            $('.billing-postal').css('display', 'none');
                            if (response.data.standard.city) {
                                $('#billing_city').val(response.data.standard.city);
                                $("#billing_province").val(response.data.standard.prov);
                            }
                        }).catch((error) => {
                            $('.billing-postal').css('display', 'block');
                        });
                } else {
                    $('.billing-postal').css('display', 'block');
                }
            });

            $(window).bind('beforeunload', function() {
                var cart_id = "{{ $cart->external_id }}";
                axios.post(`/alert-for-saved-abandoned-cart/${cart_id}`)
            });
        </script>
    @endpush
