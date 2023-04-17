@extends('layouts.Frontend.app')
@section('title')
    {{ trim('Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada') }}
@endsection
@section('banner')
    @include('layouts.Frontend.partials._header-banner')
@endsection
@push('css')
    <style type="text/css">
        .subcriber-error {
            position: relative;
            border: solid 1px #ced4da;
            border-radius: 5px;
            margin-top: 5px;
            display: none;
        }

        .subcriber-error::before {
            position: absolute;
            content: '';
            width: 15px;
            height: 15px;
            background-color: #fff;
            transform: rotate(45deg);
            top: -8px;
            border-top: solid 1px #ced4da;
            border-left: solid 1px #ced4da;
        }

    </style>

@endpush
@section('content')
    <section id="body-content">
        <section>
            <div class="container pt-4">
                <div class="text-center heading-section mx-auto">
                    <h1 class="heading-one">
                        Simple to order. Easy to love.
                        <br>
                        HeyBlinds puts the best blind choices right at your fingertips.
                        <br>
                    </h1>
                </div>
            </div>
        </section>

        <section class="home-product-show">
            <div class="container">
                <div class="product-grid-section row justify-content-center gx-3">
                    @foreach ($products as $key => $product)
                        <div class="col-lg-4 col-md-6 product-grid mt-3">
                            <a class="product-box w-100 h-100"
                                href="{{ route('frontend.category.sub-category', [$product->category->slug ?? '', $product->subcategory->slug ?? '']) }}">
                                @if ($product->home_media_id)
                                    <img src="{{ $helpers->getImage($product->home_media_id) }}"
                                        alt="{{ $product->product_home_image_alt_title ?? $product->name }}" />
                                @else
                                    <img src="{{ $helpers->getImage($product->display_media_id) }}"
                                        alt="{{ $product->product_home_image_alt_title ?? $product->name }}" />
                                @endif
                                <div class="product-name d-none d-sm-inline-block">
                                    {{ $product->subcategory->name ?? '' }}
                                </div>
                                <div class="product-name d-inline-block d-sm-none">
                                    <b>
                                        {{ $product->subcategory->sub_mobile_name ?? $product->subcategory->name }}</b>
                                </div>
                                <div class="home-product-option d-none d-sm-inline-block">
                                    <div
                                        class="d-flex justify-content-between border-start border-2 border-white ps-3 align-items-end mt-4">
                                        <div>
                                            <h5>
                                                <span class="badge bg-secondary ">
                                                    {{ $product->subcategory->name ?? '' }}
                                                </span>
                                            </h5>
                                            <p class="mb-0 text-white">
                                                @if (!empty($product->getProductPrice($product->id, $product->default_width, $product->default_height)['productPrice']))
                                                    <span class="text-decoration-line-through pe-3">
                                                        From
                                                        ${{ $product->getProductPrice($product->id, $product->default_width, $product->default_height)['productPrice'] ??0 }}
                                                    </span>
                                                @endif
                                                Now
                                                ${{ $product->getExtraDiscountProductPrice($product->id, $product->default_width, $product->default_height)['price'] ?? 0 }}
                                            </p>

                                        </div>
                                        <button class="btn-light btn"
                                            href="{{ route('frontend.product.details', $product->slug) }}">
                                            Shop Now
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section>
            <div class="container py-4 pb-4 pb-xxl-5">

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 services-section mt-3">
                        <div class="services-box bg-white rounded-3 h-100 shadow-sm">
                            <div class="row align-items-center pb-3">
                                <div class="col-auto">
                                    <div class="d-flex align-items-center justify-content-center ">

                                        <img src="{{ asset('images/icon7.png') }}"
                                            alt="HeyBlinds Canada RightFit Measuring Guarantee" />

                                    </div>
                                </div>
                                <div class="col-8">
                                    <h4 class="mb-0">
                                        RightFit <small class="TrademarkSymbol">&reg;</small> &nbsp;
                                        {{-- <br /> --}}
                                        Guarantee

                                    </h4>
                                </div>
                            </div>
                            <p>
                                Worried about measuring? Don’t! If you make a mistake, HeyBlinds will offer a free
                                replacement.
                            </p>
                            <a class="btn-primary btn" href="{{ url('/warranty') }}">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 services-section mt-3">
                        <div class="services-box bg-white rounded-3 h-100 shadow-sm">
                            <div class="row align-items-center pb-3">
                                <div class="col-auto">
                                    <div class=" d-flex align-items-center justify-content-center">

                                        <img src="{{ asset('images/delivery-truck.png') }}"
                                            alt="HeyBlinds Canada Free Shipping" />
                                        {{-- <svg class="bi bi-truck" fill="currentColor" height="16" viewbox="0 0 16 16"
                                        width="16" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                                        </path>
                                    </svg> --}}
                                    </div>
                                </div>
                                <div class="col-8">
                                    <h4 class="mb-0">
                                        Free Shipping
                                    </h4>
                                </div>
                            </div>
                            <p class="w-100">
                                Coast to Coast across Canada, we've got you covered with free ground shipping where
                                available, for all blinds up to oversized sizes as determined by the shipping companies.
                            </p>
                            <a class="btn-primary btn" href="{{ url('/free-shipping') }}">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 services-section mt-3">
                        <div class="services-box bg-white rounded-3 h-100 shadow-sm">
                            <div class="row align-items-center pb-3">
                                <div class="col-auto">
                                    <div class=" d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('images/icon8.png') }}"
                                            alt="HeyBlinds Canada 100 Day Risk-Free In-Home Trial" />
                                    </div>
                                </div>
                                <div class="col-8">
                                    <h4 class="mb-0">
                                        100 Day Risk-Free In-Home Trial
                                    </h4>
                                </div>
                            </div>
                            <p>
                                Live with your blinds for 100 days so you can be confident you made the right choice.
                            </p>
                            <a class="btn-primary btn" href="{{ url('/warranty') }}">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>

                <p class="heading-para mb-0 text-center pt-4 ">
                    Ordering custom blinds is easier than ever. Endless scrolling to find what you’re looking for is
                    so last year. With a curated selection of the most popular blinds and shades in the best-selling
                    colours with the top requested options, and industry-best “hey really?” guarantees, you’ll stay
                    focused on finding the perfect blinds for your home—no stress or regrets. The way ordering custom
                    blinds should be.
                </p>
            </div>
        </section>

        <section class="">
            <div class="container ">
                <div class="heading-section mx-auto pb-2 d-flex justify-content-center flex-wrap">
                    <h1 class="heading-one text-center">
                        Behind every HeyBlinds purchase is a satisfied customer.
                    </h1>
                    <div class="text-center ps-xl-5">
                        <a href="{{ url('/reviews-of-HeyBlinds') }}" class="btn btn-secondary btn-sm">All Reviews</a>
                    </div>

                </div>
                <div class="testmonial-slider">

                    @foreach ($reviews as $review)
                        <div class="testmonial-box rounded">
                            <div class="row align-items-center testmonial-top ">
                                <div class="col-12">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h4>
                                                {{ ucfirst($review->title_review) }}
                                            </h4>
                                            <p class="text-primary">
                                                {{-- @php
                                        $name = preg_split ('/\s/',$review->name);
                                        @endphp --}}
                                                {{ ucfirst($review->name) }} from {{ $review->city }},
                                                {{ $review->province }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex py-2">
                                @php
                                    $rating_avg = (100 / 5) * $review->rating_point;
                                @endphp
                                <div class="star-width">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $rating_avg }}%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="star-pro">
                                        <span>★</span>
                                        <span>★</span>
                                        <span>★</span>
                                        <span>★</span>
                                        <span>★</span>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <p class="auth-content mb-0 review-text">
                                {{ $review->review ?? '' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <div class="container pb-4 pt-0">
            <div class="row pb-2 gx-2">
                <div class="text-end col-6">
                    <a class="btn btn-width py-3 custom btn-secondary"
                        href="{{ route('frontend.category', 'blinds-and-shades') }}">
                        Shop Now
                    </a>
                </div>
                <div class="text-start col-6">
                    <a class="btn btn-width py-3 custom btn-primary" href="{{ url('/samples') }}">
                        Order Free Samples
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="klaviyo-form-UvzJAL"></div>
    {{-- Users For Canada --}}


    @push('js')
        <script type="text/javascript" language="javascript">
            // Close the bottom popup
            function closeBottomPopUp(elem) {
                const popup = $(elem).closest('.bottom-fixed-notification');
                if (popup.length) {
                    $(popup).hide('slow', function() {
                        popup.remove();
                    });
                }
            }

            // Detect location for Canada and show the popup
            $(document).ready(function() {
                let isLocationCanada = false;
                const popupMarkup = `<div class="bottom-fixed-notification">
                <div class="bottom-wrapper-fixed">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="py-3">
                                    <h4 class="fw-bold text-white mb-0 text-center">Hey, shopping from Canada? We suggest heading over to <a class="text-white" href="https://heyblinds.ca/"><u>HeyBlinds.ca</u></a> where you’ll find our complete product selection that ships free across Canada, as well as blinds & shades Made In Canada!</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="close-fixed-wrapper" onclick="closeBottomPopUp(this)"><i class="bi bi-x"></i></button>
                </div>

            </div>`

                if (isLocationCanada) {
                    $(document.body).append(popupMarkup)
                }
            })

            $(function() {
                $('.review-text').each(function(event) {
                    var max_length = 350;
                    if ($(this).html().length > max_length) {

                        var short_content = $(this).html().substr(0, max_length);
                        var long_content = $(this).html().substr(max_length);

                        $(this).html(short_content +
                            '<span class="more_text" style="display:none;">' + long_content + '</span>' +
                            '<span class="">.....</span> <br/><a href="{{ url('/reviews-of-HeyBlinds') }}" class="read_more read-text-change">View More</a>'
                        );
                    }
                });


                // --------testmonial slider
                $('.testmonial-slider').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    responsive: [{
                            breakpoint: 1025,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: false,
                            }
                        }

                    ]
                });
                //  ---------banner slider
                $('.banner-slider').slick({
                    dots: false,
                    infinite: true,
                    speed: 1000,
                    fade: true,
                    autoplay: true,
                    autoplaySpeed: 3000,
                });
            });
        </script>
    @endpush
@endsection
