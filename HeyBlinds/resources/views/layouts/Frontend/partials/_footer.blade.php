<footer class="bg-dark pt-4 pb-3 text-white" id="footer">
    <div class="container pt-2">
        <div class="row pb-4 pt-2">
            <div class="col-12 pb-3 d-flex justify-content-between flex-wrap">

                <a class="text-white ps-3 pe-3 d-flex align-items-center h6 font-secondary" href="javascript:void(0)"
                    data-bs-toggle="modal" data-bs-target="#RightFit-Guarantee">
                    <span class="pe-2">
                        <img src="{{ asset('images/icon7.png') }}"
                            alt="HeyBlinds Canada RightFit Measuring Guarantee">
                    </span>
                    RightFit<small class="TrademarkSymbol">&reg;</small> &nbsp; Guarantee
                </a>

                <a class="ps-3 pe-3 text-white d-flex align-items-center h6 font-secondary" href="javascript:void(0)"
                    data-bs-toggle="modal" data-bs-target="#Risk-Free-Trial">
                    <span class="pe-2">
                        <img src="{{ asset('images/icon8.png') }}"
                            alt="HeyBlinds Canada 100 Day Risk-Free In-Home Trial">
                    </span>
                    100 Day Risk-Free In-Home Trial
                </a>

                <a class="ps-3 pe-3 text-white d-flex align-items-center h6 font-secondary" href="javascript:void(0)"
                    data-bs-toggle="modal" data-bs-target="#Price-Lowest-Guarantee">
                    <span class="pe-2">
                        <img src="{{ asset('images/icon9.png') }}" alt="HeyBlinds Canada Best Price Guarantee">
                    </span>
                    <span>Best Price Guarantee</span>
                </a>

                <a class="ps-3 text-white d-flex align-items-center h6 font-secondary" href="javascript:void(0)"
                    data-bs-toggle="modal" data-bs-target="#Shipping-On-Everything">
                    <span class="pe-2">
                        <img src="{{ asset('images/delivery-truck.png') }}" alt="HeyBlinds Canada Free Shipping">
                    </span>
                    <span>Free Shipping</span></a>

            </div>
            <div class="col-lg-6 border-end pe-lg-5">
                <h4 class="mb-0">
                    Sign up for emails and
                    <b class="text-primary">
                        get exclusive offers!
                    </b>
                </h4>
                <div class="subcribe-box pt-2">
                    <div class="form-floating" id="hb-klaviya">
                        <!---klaviyo subcriber -->
                        <div class="klaviyo-form-XXTK9N"></div>
                        <!---end klaviyo subcriber -->
                        {{-- <div class="klaviyo-form-XXTK9N"></div> --}}



                        <!--End mc_embed_signup-->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5 pt-4 pt-lg-0">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="d-flex">
                            <span class="footer-chat-icon text-primary">
                                <svg class="bi bi-headset" fill="currentColor" height="16" viewbox="0 0 16 16"
                                    width="16" xmlns="http://www.w3.org/2000/svg">
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
                    <div class="col-md-6 ">
                        <div class="d-flex align-items-center">
                            <span class="footer-chat-icon text-primary">

                                <div class="footer-chat-iamge rounded-circle border border-primary border-2">
                                    <img alt="contact-image" class="rounded-circle"
                                        src="{{ asset('images/contact-image.webp') }}" />

                                </div>
                            </span>
                            <p class="ps-2 mb-0">
                                HeyBlinds
                                <a class="text-white fw-bold" href="#" onclick="$crisp.push(['do', 'chat:open'])">
                                    LIVE
                                    CHAT
                                </a>
                            </p>
                        </div>
                        <a class="btn btn-primary mt-3 btn-sm" href="{{ url('/review') }}">
                            Write a Review
                        </a>

                    </div>
                </div>

            </div>
        </div>
        <hr class="m-0" />
        <div class="row">
            <div class="col-lg-4 pt-4">
                <div class="footer-logo">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('images/logo.png') }}"
                            alt="HeyBlinds Canada - Online Custom Blinds & Shades Shipped Free to your door" />
                    </a>
                </div>
                <h5 class="pt-3 pe-lg-5">
                    Simple to order. Easy to love.
                </h5>
                <ul class="footer-social-media d-flex pt-3">
                    <li>
                        <a href="https://www.bbb.org/ca/qc/montreal/profile/online-retailer/heyblindsca-0117-226511"
                            target="_blank">
                            <img src="{{ asset('images/bbb-logo.png') }}"
                                alt="HeyBlinds Canada is a BBB accredited business" />
                        </a>
                    </li>
                    <li>
                        <img src="{{ asset('images/lets-encrypt.png') }}"
                            alt="HeyBlinds Canada uses Let's Encrypt for secure online blinds shopping" />
                    </li>
                </ul>
                <!-- <ul class="footer-social-media d-flex pt-3">
                    <li>
                        <a href="#"><i class="fab fa-facebook-square"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-twitter-square"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-instagram-square"></i></a>
                    </li>
                </ul> -->
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

                    <li>
                        <a class="btn text-white btn-primary px-4" href="{{ url('/blog') }} ">
                            Hey Blog
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @if (config('global.is_heyblinds_com') == true)
            <p class="text-center mb-0 pt-4 mt-2">Delivering custom blinds and shades coast to coast across
                America, including New York, Los Angeles, Chicago, Houston, Phoenix, Philadelphia, San Antonio, San
                Diego, Dallas, San Jose, Austin and everywhere else in the contiguous 48.</p>
        @else
            <p class="text-center mb-0 pt-4 mt-2">Delivering custom blinds and shades coast to coast across Canada,
                including Toronto, Calgary, Vancouver, Montreal, Edmonton and Mississauga</p>
        @endif
    </div>
</footer>
<div class="footer-bottom py-3 text-white">
    <div class="container">
        <div class="row align-items-center flex-wrap justify-content-between text-center text-lg-start">
            <div class="col-auto">
                @if (config('global.is_heyblinds_com') == true)
                    Copyright ©2021 - 2022 HeyBlinds. All rights reserved.
                @else
                    <img src="{{ asset('images/ca-flag.webp') }}"
                        alt="Payment Options: Visa, Mastercard, AMEX, Interac, credit cards" />
                    <a class="ps-2" href="{{ route('welcome') }}"> HeyBlinds.ca</a> is a Canadian company,
                    all prices in
                    CAD.&nbsp; | &nbsp;All contents ©2021-2022 HeyBlinds. All rights reserved
                @endif

            </div>
            <div class="col pt-2 pt-sm-0 text-lg-end">
                <img src="{{ asset('images/payment-card.webp') }}"
                    alt="Payment Options: Visa, Mastercard, AMEX, Interac, credit cards" />
            </div>
        </div>
    </div>
</div>
<div class="tooltip-bg"></div>
