<footer class="bg-dark py-4 text-white" id="footer">
    <div class="container py-2">

        <div class="row pb-4">
            <div class="col-md-6 ">
                <div class="d-flex">
                    <span class="footer-chat-icon text-primary">
                        <svg class="bi bi-headset" fill="currentColor" height="16" viewbox="0 0 16 16" width="16"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z">
                            </path>
                        </svg>
                    </span>
                    <p class="ps-2 mb-0">
                        Call
                        <a class="text-white fw-bold mx-1" href="tel:(888) 412-3439">
                            (888) 412-3439
                        </a>
                    </p>
                </div>
                <p class="pt-2 pe-lg-5 mb-0">
                    Monday - Friday 8AM - 10PM EST
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <a class="btn btn-width custom btn-secondary py-2 my-2"
                    href="{{ route('frontend.category', 'blinds-and-shades') }}">Shop Now</a>

                <a class="btn btn-width custom btn-primary py-2 ms-2 my-2" href="{{ url('/samples') }}">Order Free
                    Samples</a>

            </div>
        </div>


        <hr class="m-0" />
        <div class="row">
            <div class="col-lg-4 pt-4">
                <div class="footer-logo">
                    <a href="{{ route('welcome') }}">
                        <img alt="hey blindes logo" src="{{ asset('images/logo.png') }}" />
                    </a>
                </div>
                <h5 class="pt-3 pe-lg-5">
                    Simple to order. Easy to love.
                </h5>
                <ul class="footer-social-media d-flex pt-3">
                    <li>
                        <a href="https://www.bbb.org/ca/qc/montreal/profile/online-retailer/heyblindsca-0117-226511"
                            target="_blank">
                            <img alt="" src="{{ asset('images/bbb-logo.png') }}" />
                        </a>
                    </li>
                    <li>
                        <img alt="" src="{{ asset('images/lets-encrypt.png') }}" />
                    </li>
                </ul>

            </div>
            <div class="col-md-7 col-lg-5 pt-4 ps-lg-5">
                <h2>
                    BLINDS AND SHADES
                </h2>
                <ul class="footer-menu d-flex flex-wrap">
                    @foreach ($subCategories as $key => $subCategory)
                        @if ($subCategory->product->count() > 0 && !empty($subCategory->category->slug))
                            <li class="w-50 text-uppercase">
                                <a class="text-uppercase"
                                    href="{{ route('frontend.category.sub-category', [$subCategory->category->slug, $subCategory->slug]) }}">
                                    {{ $subCategory->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-md-5 col-lg-3 pt-4 ps-lg-5">
                <h2>
                    GET HELP
                </h2>
                <ul class="footer-menu">
                    <li>
                        <a href="{{ url('/measure-instructions') }}">
                            MEASURE INSTRUCTIONS
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.warranty') }} ">
                            HEYOK WARRANTY
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.about') }} ">
                            ABOUT US
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/terms-and-conditions') }} ">
                            POLICIES
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.faq') }} ">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/reviews-of-HeyBlinds') }} ">
                            CUSTOMER REVIEWS
                        </a>
                    </li>

                    {{-- <li>
                        <a class="btn text-white btn-primary px-4" href="{{ url('/blog') }} ">
                            Hey Blog
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</footer>
<div class="footer-bottom py-3 text-white">
    <div class="container">
        <div class="row align-items-center flex-wrap justify-content-between text-center text-lg-start">
            <div class="col-auto">
                <img alt="" src="{{ asset('images/ca-flag.webp') }}" />
                <a class="ps-2" href="{{ route('welcome') }}"> HeyBlinds.ca</a> is a Canadian company, all
                prices in
                CAD.&nbsp; | &nbsp;All contents ©2021 HeyBlinds. All rights reserved
            </div>
            <div class="col pt-2 pt-sm-0">
                <img alt="" src="{{ asset('images/payment-card.png') }}" />
            </div>
        </div>
    </div>
</div>
<div class="tooltip-bg"></div>
