@extends('layouts.Frontend.app')
@section('title')
    Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada
@endsection
@php
    $user = Auth::user();
@endphp
@section('content')
    @if (count($sampleCartProducts) < 1)
        @include('errors.404-cart')
    @endif
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
    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
             aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </section>
    <form action="{{ route('frontend.sample.checkout.store', $id) }}" method="post" id="sampleCheckoutForm"
          class="payment__sampale__form">
        @csrf
        <input type="hidden" value="{{ $id }}" name="cart_id">
        <section id="body-content">
            <div class="container py-3 pb-4 pb-xxl-5">

                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-5">
                        <div class="shadow p-4 rounded">
                            <h5 class="font-secondary text-center fw-bold border-bottom mb-2 pb-2">SAMPLES CART</h5>
                            <div class="sample-page-cart-right" id="sample-page-cart-right">
                                @if(count($sampleCartProducts) > 0)
                                    @foreach ($sampleCartProducts as $sample)
                                        <div class="samples-cart-list-box shadow-box" data-auto="{{$sample->external_id}}" data-pid="{{$sample->product_id}}">
                                            <p class="mb-2 fw-bold">{{ $helpers->getProductName($sample->product_id)}}</p>
                                            @if($allSampleCarts)
                                                @foreach($allSampleCarts as $color)
                                                    @if($sample->product_id === $color->product_id)
                                                        <div class="d-flex align-items-center justify-content-between mb-2 samples-cart-list" data-pid="{{$sample->product_id}}" data-auto="{{$sample->external_id}}" data-cid="{{$color->color_id}}">
                                                            <div class="d-flex align-items-center">
                                                                <div class="sample-order-image">
                                                                    <img src="{{ $helpers->getThumbnail($color->color->color_image_id ?? 0) }}" alt="" />
                                                                </div>
                                                                <p class="ps-2 mb-0 fw-bold">{{$color->color->name ?? ""}}</p>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <p class="mb-0 text-primary">FREE</p>
                                                                <button data-pid="{{ $color->product_id }}" value="{{ $color->color_id }}"
                                                                        data-id="{{ $color->color_id }}" data-auto="{{$sample->external_id}}" data-cid="{{ $color->color_id }}"
                                                                        data-cart="{{ $color->external_id }}" type="button"
                                                                        class="btn-close btn-sm ms-3 sample-cart-close-button"> </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <p id="emptySampleText">Add your first sample.</p>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-9 col-lg-8 col-md-7 pt-4">
                        <h5 class="font-secondary fw-bold">Checkout and Review</h5>
                        <hr class="mt-2" />
                        <p>Please enter the name and address where you would like the samples sent. (We CANNOT ship to PO
                            Boxes if you select overnight shipping):</p>

                        <div class="pt-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p class="fw-bold font-secondary mb-1">Shipping Information</p>

                                    <div class="row g-2 gx-3 personal-infomation-form align-items-center pt-2">

                                        <div class="col-md-6">
                                            <div class="form-floating">

                                                <input type="text" class="form-control" name="shipping_first_name"
                                                       placeholder="First Name" value="{{$AutoSavedData->shipping_first_name ?? $user->first_name ?? ''}}" required>
                                                <label for="">First Name <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">

                                                <input type="text" class="form-control" name="shipping_last_name"
                                                       placeholder="Last Name" value="{{$AutoSavedData->shipping_last_name ?? $user->last_name ?? ''}}" required>
                                                <label for="">Last Name <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" name="shipping_email"
                                                       placeholder="Email" value="{{$AutoSavedData->shipping_email ?? $user->email ?? ''}}" required>
                                                <label for="">Email <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control phone_number" name="shipping_phone"
                                                       placeholder="Phone Number" maxlength="16" value="{{$AutoSavedData->shipping_phone_number ?? $user->profile->phone_number ?? ''}}" required>
                                                <label for="">Phone Number <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">

                                                <input type="text" class="form-control" name="shipping_address"
                                                       placeholder="Street Address" value="{{$AutoSavedData->shipping_address ?? $user->profile->street ?? ''}}" required>
                                                <label for="">Street Address<span class="text-danger">*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="shipping_apt"
                                                       placeholder="Street Number" value="{{$AutoSavedData->shipping_apt ??  $user->profile->address ?? ''}}">
                                                <label for="">Apt, Ste, Unit, Bldg (Optional)</label>
                                            </div>
                                        </div>

                                      
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control postal_code" name="shipping_postal_code" placeholder="Postal" maxlength="7" id="shipping_postal_code" value="{{$AutoSavedData->shipping_postal_code ?? $user->profile->postal_code ?? ''}}" required>
                                                <label for="">Postal Code <span class="text-danger">*</span></label>
                                                <div class="invalid-tooltip">
                                                    Please enter in a proper Canada postal code.
                                                </div>
                                            </div>
                                           
                                        </div>

                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-floating">
                                                <select class="form-select" name="shipping_province" id="shipping_province" 
                                                        aria-label="Floating label select example" required>
                                                    <option value="">Province</option>
                                                    <option value="AB" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province== 'AB') ? 'selected' : '' }} >AB</option>
                                                    <option value="BC" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'BC') ? 'selected' : '' }} >BC</option>
                                                    <option value="MB" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'MB') ? 'selected' : '' }} >MB</option>
                                                    <option value="NB" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'NB') ? 'selected' : '' }} >NB</option>
                                                    <option value="NL" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'NL') ? 'selected' : '' }} >NL</option>
                                                    <option value="NS" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'NS') ? 'selected' : '' }} >NS</option>
                                                    <option value="NT" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'NT') ? 'selected' : '' }} >NT</option>
                                                    <option value="NU" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'NU') ? 'selected' : '' }} >NU</option>
                                                    <option value="ON" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'ON') ? 'selected' : '' }} >ON</option>
                                                    <option value="PE" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'PE') ? 'selected' : '' }} >PE</option>
                                                    <option value="QC" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'QC') ? 'selected' : '' }} >QC</option>
                                                    <option value="SK" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'SK') ? 'selected' : '' }} >SK</option>
                                                    <option value="YT" {{ ( @$user->profile->province || @$AutoSavedData->shipping_province == 'YT') ? 'selected' : '' }} >YT</option>
                                                </select>
                                                <label for="">Province <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                          <div class="col-lg-6">
                                            <div class="form-floating">

                                                <input type="text" class="form-control" name="shipping_city"
                                                       placeholder="City" id="shipping_city" value="{{$AutoSavedData->shipping_city ?? $user->profile->city ?? ''}}" required>
                                                <label for="">City <span class="text-danger">*</span></label>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="pt-3">
                                        <p class="fw-bold font-secondary mb-2 mt-3">Shipping Options</p>
                                        <div class="cart-box p-2 mb-3 rounded">
                                            <div class="radio">
                                                <input id="free_postal_service" name="postal_service" value="0" type="radio"
                                                       onchange="CheckoutPassword()" checked />
                                                <label for="free_postal_service"
                                                       class="radio-label payment-radio fw-bold d-flex text-center align-items-center">
                                                    <div class="px-4">
                                                        <b>FREE</b><br />Standard
                                                    </div>
                                                    <div class="ps-5 ms-lg-5">
                                            <span>
                                                <img src="{{ asset('images/usps-logo.png') }}" alt="" />
                                            </span>
                                                        {{-- <p class="mb-0">Ships 2-5 days</p> --}}
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="cart-box p-2 mb-3 rounded">
                                            <div class="radio">
                                                <input id="paid_postal_service" name="postal_service" value="1" type="radio"
                                                       onchange="CheckoutPassword()" />
                                                <label for="paid_postal_service"
                                                       class="radio-label payment-radio fw-bold d-flex text-center align-items-center">
                                                    <div class="px-4">
                                                        <b>$20</b><br />Express
                                                    </div>
                                                    <div class="ps-5 ms-lg-5">

                                        <span class="col"><img src="{{ asset('images/upsFedex.png') }}"
                                                               alt="" class="w-100" /></span>
                                                        {{-- <span class="col"><img src="{{asset('images/express_post.jpg')}}" alt="" class="w-100"></span> --}}

                                                        {{-- <p class="mb-0">Overnight</p> --}}
                                                    </div>
                                                </label>
                                            </div>
                                        </div>


                                        <p>Ordering Express samples? Get your $20 refunded when you place your order for
                                            window
                                            coverings within 45 days of when you placed your samples order. It’s easy, just
                                            let
                                            us know your sample order # in the Notes section of your order.
                                        </p>
                                        <p>
                                            We guarantee today’s sale pricing for 3 weeks when you order samples. So that
                                            you
                                            have all the time you need to review your samples and make sure you are ordering
                                            the
                                            colours and styles that are just right for your windows and home!
                                        </p>

                                        <p class="mb-2">Please keep in mind that due to Covid and high order volume:</p>
                                        {{-- <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 fill="currentColor" class="bi bi-check align-middle" viewBox="0 0 16 16">
                                                <path
                                                    d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                            </svg>
                                            Regular mail may take up to 2-3 weeks, depending on where in Canada you live

                                        </div> --}}

                                        <div class="pb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 fill="currentColor " class="bi bi-check align-middle" viewBox="0 0 16 16">
                                                <path
                                                    d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                            </svg>
                                            UPS is unable to guarantee next-day delivery, so you may receive your samples
                                            within an
                                            extra couple of days
                                        </div>



                                        <div class="checkout-password">
                                            <div>
                                                <div class="pb-lg-0">
                                                    <div class="card-wrapper"></div>
                                                </div>
                                                <div class="">
                                                    <div class="form-container active">
                                                        <form action="" class="">
                                                            <div class="row g-3 pt-3">
                                                                <div class="col-md-12 form-group">
                                                                    <label>Card Number</label>
                                                                    <input class="form-control"
                                                                           placeholder="#### #### #### ####" type="tel"
                                                                           name="card_number" id="card_input">
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <label>Full Name</label>
                                                                    <input class="form-control" placeholder="Name"
                                                                           type="text" id="card_holder_name" name="card_name">
                                                                </div>

                                                                <div class="col-md-8 col-6 form-group">
                                                                    <label style="font-size: 12px;">Expiry Month
                                                                        (MM/YYYY)</label>
                                                                    <input class="form-control" placeholder="MM/YYYY"
                                                                           type="tel" id="card_expiry" name="card_expiry">
                                                                </div>

                                                                <div class="col-md-4 col-6 form-group">
                                                                    <label>CVV</label>
                                                                    <input class="form-control num-nav" placeholder="CVC"
                                                                           type="password" id="card_cvc" name="card_cvc">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <p class="mb-1 mt-4"><span class="fw-bold font-secondary">Billing
                        Address</span> (exactly as it appears on your credit card statement)
                                                </p>
                                                <div class="form-group mt-3">
                                                    <input type="checkbox" id="BillingInformation" onchange="valueChanged()"
                                                           name="BillingInformation" value="1" checked>
                                                    <label class="m-0 p-0" for="BillingInformation">(Billing Address is same
                                                        as
                                                        Shipping Address)</label>
                                                </div>
                                            </div>
                                            <div class="shipping-display">
                                                {{-- <p class="fw-bold font-secondary mb-1 mt-3">How many windows are you
                                                covering?</p> --}}
                                                <div class="row g-2 gx-3 personal-infomation-form align-items-center pt-2">

                                                    <div class="col-md-6">
                                                        <div class="form-floating">

                                                            <input type="text" class="form-control"
                                                                   name="billing_first_name" placeholder="First Name" value="{{$AutoSavedData->billing_first_name ?? ""}}">
                                                            <label for="">First Name <span
                                                                    class="text-danger">*</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">

                                                            <input type="text" class="form-control" name="billing_last_name"
                                                                   placeholder="Last Name"  value="{{$AutoSavedData->billing_last_name ?? ""}}">
                                                            <label for="">Last Name <span
                                                                    class="text-danger">*</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-floating">

                                                            <input type="email" class="form-control " name="billing_email"
                                                                   placeholder="Email" value="{{$AutoSavedData->billing_email ?? ""}}">
                                                            <label for="">Email <span class="text-danger">*</span></label>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">


                                                        <div class="form-floating ">
                                                            <input type="text" class="form-control phone_number" name="billing_phone"
                                                                   placeholder="Phone Number" maxlength="16" value="{{$AutoSavedData->billing_phone_number ?? ""}}">
                                                            <label for="">Phone Number <span class="text-danger">*</span></label>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <div class="form-floating">

                                                            <input type="text" class="form-control" name="billing_address"
                                                                   placeholder="Street Address" value="{{$AutoSavedData->billing_address ?? ""}}">
                                                            <label for="">Street Address<span
                                                                    class="text-danger">*</span></label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-floating">

                                                            <input type="text" class="form-control" name="billing_apt"
                                                                   placeholder="Street Address" value="{{$AutoSavedData->billing_apt ?? ""}}">
                                                            <label for="">Apt, Ste, Unit, Bldg (Optional)</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" name="billing_city"
                                                                   placeholder="City" value="{{$AutoSavedData->billing_city ?? ""}}">
                                                            <label for="">City <span class="text-danger">*</span></label>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="form-floating">
                                                            <select class="form-select" name="billing_province"
                                                                    aria-label="Floating label select example">
                                                                <option value="">Province</option>
                                                                <option value="AB" {{(@$AutoSavedData->billing_province == "AB") ? "selected" : ""}}>AB</option>
                                                                <option value="BC" {{(@$AutoSavedData->billing_province == "BC") ? "selected" : ""}}>BC</option>
                                                                <option value="MB" {{(@$AutoSavedData->billing_province == "MB") ? "selected" : ""}}>MB</option>
                                                                <option value="NB" {{(@$AutoSavedData->billing_province == "NB") ? "selected" : ""}}>NB</option>
                                                                <option value="NL" {{(@$AutoSavedData->billing_province) == "NL" ? "selected" : ""}}>NL</option>
                                                                <option value="NS" {{(@$AutoSavedData->billing_province) == "NS" ? "selected" : ""}}>NS</option>
                                                                <option value="NT" {{(@$AutoSavedData->billing_province) == "NT" ? "selected" : ""}}>NT</option>
                                                                <option value="NU" {{(@$AutoSavedData->billing_province) == "NU" ? "selected" : ""}}>NU</option>
                                                                <option value="ON" {{(@$AutoSavedData->billing_province) == "ON" ? "selected" : ""}}>ON</option>
                                                                <option value="PE" {{(@$AutoSavedData->billing_province) == "PE" ? "selected" : ""}}>PE</option>
                                                                <option value="QC" {{(@$AutoSavedData->billing_province) == "QC" ? "selected" : ""}}>QC</option>
                                                                <option value="SK" {{(@$AutoSavedData->billing_province) == "SK" ? "selected" : ""}}>SK</option>
                                                                <option value="YT" {{(@$AutoSavedData->billing_province) == "YT" ? "selected" : ""}}>YT</option>
                                                            </select>
                                                            <label for="">Province <span
                                                                    class="text-danger">*</span></label>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control postal_code" name="billing_postal"
                                                                   placeholder="Postal" maxlength="7  value="{{$AutoSavedData->billing_area_code ?? ""}}"
                                                            >
                                                            <label for="">Postal Code <span
                                                                    class="text-danger">*</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="col-lg-6 pt-3 pt-lg-0">
                                    <p class="fw-bold font-secondary mb-1">How many blinds are you planning to order?</p>
                                    <div class="">
                                        <div class="cart-box p-2 mb-3 rounded">
                                            <div class="radio">
                                                <input id="checkout-1" name="windows" type="radio" value="1" {{(@$AutoSavedData->no_of_sample_blinds) == 1 ? "checked" : ""}}/>
                                                <label for="checkout-1" class="radio-label fw-bold">1 to 2</label>
                                            </div>
                                        </div>
                                        <div class="cart-box p-2 mb-3 rounded">
                                            <div class="radio">
                                                <input id="checkout-2" name="windows" type="radio" value="2" {{(@$AutoSavedData->no_of_sample_blinds) == 2 ? "checked" : ""}}/>
                                                <label for="checkout-2" class="radio-label fw-bold">3 to 5</label>
                                            </div>
                                        </div>


                                        <div class="cart-box p-2 mb-3 rounded">
                                            <div class="radio">
                                                <input id="checkout-3" name="windows" type="radio" value="3" {{(@$AutoSavedData->no_of_sample_blinds) == 3 ? "checked" : ""}}/>
                                                <label for="checkout-3" class="radio-label fw-bold">6 or More</label>
                                            </div>
                                        </div>

                                        <div class="">
                                            <p class="fw-bold font-secondary mb-1">How did you hear about us?:</p>
                                            <div class="form-floating">
                                                <select class="form-select" name="hear_us" aria-label="Floating label select example">

                                                    <option value="">-- Please Select --</option>
                                                    <option value="Google/Bing/Yahoo" {{(@$AutoSavedData->how_to_hear == "Google/Bing/Yahoo") ? "selected" : ""}}>Google/Bing/Yahoo</option>
                                                    <option value="Radio Ad"  {{(@$AutoSavedData->how_to_hear == "Radio Ad") ? "selected" : ""}}>Radio Ad</option>
                                                    <option value="Friend/family"  {{(@$AutoSavedData->how_to_hear == "Friend/family") ? "selected" : ""}}>Friend/family</option>
                                                    <option value="Social Media"  {{(@$AutoSavedData->how_to_hear == "Social Media") ? "selected" : ""}}>Social Media</option>
                                                    <option value="TV commercial"  {{(@$AutoSavedData->how_to_hear == "TV commercial") ? "selected" : ""}}>TV commercial</option>
                                                    <option value="Podcast"  {{(@$AutoSavedData->how_to_hear == "Podcast") ? "selected" : ""}}>Podcast</option>
                                                    <option value="I am a returning customer"  {{(@$AutoSavedData->how_to_hear == "I am a returning customer") ? "selected" : ""}}>I am a returning customer</option>
                                                    <option value="Other"  {{(@$AutoSavedData->how_to_hear == "Other") ? "selected" : ""}}>Other</option>
                                                </select>
                                                <label for="">Source</label>
                                            </div>
                                        </div>
                                        <div class="row gx-2">
                                            <div class="col-12">
                                                <button class="btn w-100 btn-primary btn-lg mt-3 py-2 text-uppercase">
                                                    Send Samples
                                                </button>
                                            </div>

                                            <div class="col-12">
                                                <a href="{{ url('/samples') }}" class="btn w-100 btn-secondary py-2 mt-3 text-uppercase">
                                                    Choose More Samples
                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@push('js')
    <script src="{{ asset('js/vendors/card.js') }}"></script>
    <script>
        jQuery(function($) {
            $(document).on('click', '.sample-cart-close-button', function (e) {
                e.preventDefault();
                const $this = $(this);
                let $sampleCartId = readCookie('__sb_sample_cart')
                let data = {
                    pid : $this.attr('data-pid'),
                    optid: $this.val(),
                    cartid: $sampleCartId
                }
                removeCart(data, $this, 'samples')
            })
            $(document).on('submit', '#sampleCheckoutForm', function(e) {
                e.preventDefault();
                let $this = $(this);
                let formData = $this.serialize();
                $("#loader").show();
                axios.post($this.attr('action'), formData)
                    .then(function(response) {
                        let data = response.data;
                        $("#loader").hide();
                        if(data.status == true){
                            eraseCookie('__sb_sample_cart');
                            localStorage.removeItem('__sb_sample_cart');
                            document.location.href = document.location.origin + "/sample/thank-you/" + data.data
                                .sample_cart_external_id;
                        }
                        else{
                            toastr.error(data.message);
                        }
                    })
                    .catch(function(error) {
                        $("#loader").hide();
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })
                    });
            })
            $(document).on('change', 'select, input', function(e) {
                if ((e.target.tagName === "INPUT" || e.target.tagName === "SELECT")){
                    saveCheckout();
                }
            })
        })
        function saveCheckout(){
            let form = $("#sampleCheckoutForm");
            let formData = new FormData(form[0]);
            const deleteData = ['card_number', 'card_name', 'card_expiry', 'card_cvc', 'email', 'password', 'guest_user', 'password_confirmation'];
            $.each(deleteData, function (index, val) {
                formData.delete(val)
            })
        
        }
        function CheckoutPassword() {
            if ($('#paid_postal_service').is(":checked"))
                $('.checkout-password').slideDown(300);
            else
                $('.checkout-password').slideUp(300);
        }
        $(document).on('click', '.info-submit', function() {

            $('.shipping-address-section > .nav-item > .active').parent().next('li').find('button').trigger('click');
        });

        function valueChanged() {
            if ($('#BillingInformation').is(":checked")) {
                $('.shipping-display').slideUp(300);
                $(".billing-btn").removeClass('info-submit').attr('data-bs-target', '#collapseTwo');
            } else {
                $(".billing-btn").addClass('info-submit').attr('data-bs-target', null);
                $('.shipping-display').slideDown(300);
            }
        }

    </script>

    <script>
        jQuery(document).ready(function($) {
            var card = new Card({
                form: '.payment__sampale__form',
                container: '.card-wrapper', // *required*
                formSelectors: {
                    numberInput: 'input#card_input', // optional — default input[name="number"]
                    expiryInput: 'input#card_expiry', // optional — default input[name="expiry"]
                    cvcInput: 'input#card_cvc', // optional — default input[name="cvc"]
                    nameInput: 'input#card_holder_name' // optional - defaults input[name="name"]
                },
                debug: true // optional - default false
            });
       
           $(document).on('keyup change',"#shipping_postal_code", function(e) {
            e.preventDefault();
           var postal_code =  $(this).val();
           var ca = new RegExp(/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]( )?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i);
            if(postal_code.length == 7 && ca.test(postal_code.toString())){
            $('.invalid-tooltip').addClass('d-none');
              axios.post('/postal/code',{
                postal_code : postal_code,
              })
              .then((response) => {
                if(response.data.standard.city){
                    $('#shipping_city').val(response.data.standard.city);
                    $("#shipping_province").val(response.data.standard.prov);
                    $('.invalid-tooltip').addClass('d-none');
                }
               }).catch((error) =>{
                   $('#shipping_city').val('');
                    $('#shipping_province').val('');
                    $('.invalid-tooltip').addClass('d-block');
               })
           }
           else{
                $('#shipping_city').val('');
                $('#shipping_province').val('');
                $('.invalid-tooltip').addClass('d-block');
             }
        });
    })
    </script>

@endpush
