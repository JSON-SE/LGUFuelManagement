<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<div id="menu-overlay" style="display: none"></div>
<div class="top-header py-2 bg-light d-none d-lg-block">
    <div class="container text-center">

        <a class="text-dark pe-3" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#RightFit-Guarantee">
            <span class="pe-2">
                <img src="{{ asset('images/icon7.png') }}" alt="HeyBlinds Canada RightFit Measuring Guarantee">
            </span>
            RightFit<small class="TrademarkSymbol">&reg;</small> &nbsp; Guarantee
        </a>

        <a class="ps-3 pe-3 text-dark " href="javascript:void(0)" data-bs-toggle="modal"
            data-bs-target="#Risk-Free-Trial">
            <span class="pe-2">
                <img src="{{ asset('images/icon8.png') }}" alt="HeyBlinds Canada 100 Day Risk-Free In-Home Trial">
            </span>
            100 Day Risk-Free In-Home Trial
        </a>

        <a class="ps-3 pe-3 text-dark " href="javascript:void(0)" data-bs-toggle="modal"
            data-bs-target="#Price-Lowest-Guarantee">
            <span class="pe-2">
                <img src="{{ asset('images/icon9.png') }}" alt="HeyBlinds Canada Best Price Guarantee">
            </span>
            Best Price Guarantee
        </a>

        <a class="ps-3 text-dark " href="javascript:void(0)" data-bs-toggle="modal"
            data-bs-target="#Shipping-On-Everything">
            <span class="pe-2">
                <img src="{{ asset('images/delivery-truck.png') }}" alt="HeyBlinds Canada Free Shipping">
            </span>
            Free Shipping</a>

        {{-- <a class="text-dark pe-3" href="{{ route('frontend.warranty') }}">HeyOK Warranties</a>
        <a class="ps-3 text-dark border-start border-secondary" href="{{ route('frontend.free_shipping') }}">
            <span class="pe-2">
                <img src="{{ asset('images/delivery-truck.png') }}" style="width: 24px" alt="Hey Blindes Delivery Truck">
            </span>
            Free Shipping On Everything</a> --}}
    </div>
</div>

<div class="active-header-height">
    <header id="header">
        <div class="pro-section">
            <div class="container position-relative">
                <div class="d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <a href="{{ route('welcome') }}" id="logo">
                            <img src="{{ asset('images/logo.png') }}" alt="HeyBlinds Canada - Online Custom Blinds & Shades Shipped Free to your door">
                        </a>
                    </div>



                    <div class="top-menu-btn d-flex align-items-center top-header-dropdown-menu">
                        <div class="pe-4 d-none d-lg-block">

                            <div class="star-width ">
                                <div class="progress">
                                    @php
                                        $rating_total_avg_percentage = (100 / 5) * $avgOfReviews;
                                    @endphp
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $rating_total_avg_percentage }}%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="star-pro">
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                </div>
                            </div>
                            <p class="mb-0 pt-1"><b>{{ number_format($avgOfReviews, 1) }}</b><small>/5 <a
                                        class="text-secondary"
                                        href="{{ url('/reviews-of-HeyBlinds') }}">({{ $reviewsCount }}
                                        Reviews)</a></small></p>
                        </div>

                        <ul class="d-flex align-items-end">
                            <li>
                                <button class="callBtn top-menu-btn">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                        </svg>
                                    </span>
                                    Contact
                                </button>
                                <div
                                    class="top-menu-dropdown rounded shadow-lg px-4 py-3 border-bottom border-4 border-primary">
                                    <div class="pb-2">

                                        <div class="d-flex align-items-center ">
                                            <div class="dropdown-call-image chat-image">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-chat-text-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <a class="dropdown-call-btn ps-3" href="#"
                                                    onclick="$crisp.push(['do', 'chat:open'])">
                                                    <small>Talk to a Blinds Buddy</small>
                                                    LIVE CHAT</a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-3">
                                            <div class="dropdown-call-image">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-headset" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <a class="dropdown-call-btn ps-3" href="tel:(888) 412-3439">
                                                    <small>Call </small>
                                                    (888) 412-3439</a>
                                            </div>
                                        </div>
                                        <div class="open-time ps-2 border-3 border-primary border-start mt-4">
                                            <small>Monday - Friday</small>
                                            8AM - 10PM EST
                                        </div>

                                    </div>

                                    <hr class="mt-4" />
                                    <ul class="top-menu-dropdown-items">
                                        <li><a href="{{ url('/contact-us') }}">CONTACT US</a></li>
                                        @auth
                                            {{-- <li><a href="{{url('/order-tracking')}}">TRACK YOUR ORDER</a></li> --}}
                                        @endauth
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <button class="aountBtn top-menu-btn">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                        </svg>
                                    </span>
                                    Account
                                </button>

                                <div
                                    class="top-menu-dropdown rounded shadow-lg px-4 py-3 border-bottom border-4 border-primary">
                                    @guest
                                        <div>
                                            <h5 class="">SIGN IN</h5>

                                            <form autocomplete="off" class="">
                                                <div class="form-floating mb-3">
                                                    <input type="email" name="email" class="form-control" id="email"
                                                        placeholder="name@example.com" autocomplete="new-email">
                                                    <label for="floatingInput">Email address</label>
                                                </div>
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
                                                    <input type="password" name="password"
                                                        class="form-control view_password" id="id_password"
                                                        placeholder="Password" autocomplete="new-password">
                                                    <label for="floatingPassword">Password</label>
                                                </div>
                                                <div class="text-end"><a
                                                        href="{{ url('/forgot-password') }}">Forgot Your Password?</a>
                                                </div>
                                                <button type="button" onclick="signin(this)"
                                                    class="btn btn-primary w-100 mt-3">Sign me in</button>
                                            </form>

                                            <hr class="mt-3" />
                                            <div class="text-center or-border"><span class="">or</span></div>
                                            {{-- <div> --}}
                                            {{-- <button class="social-media-btn"><span><i --}}
                                            {{-- class="fab fa-facebook-f"></i></span> --}}
                                            {{-- SIGN IN WITH FACEBOOK</button> --}}
                                            {{-- </div> --}}
                                            <p class="text-center pt-3">Don't have an account?<br>
                                                Create one <a href="{{ url('/register') }}"><b>Here</b></a>.</p>
                                            {{-- <div class="text-center">
                                                        <a href="{{url('order-tracking')}}" class="btn btn-primary btn-sm">Track Order</a>
                                                    </div> --}}
                                        </div>
                                    @else
                                        <ul class="top-menu-dropdown-items text-uppercase">
                                            <li><a href="{{ url('/user/my-account') }}">My Account</a></li>
                                            <li><a href="{{ url('/user/my-order') }}">My Orders</a></li>
                                            <li><a href="{{ url('/user/my-cart') }}">Saved Carts</a></li>
                                            <li><a href="#" onclick="logoutFunction()">Logout</a></li>
                                        </ul>
                                    @endguest

                                </div>

                            </li>
                            <li>
                                <button class="helpBtn top-menu-btn">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </span>
                                    Help
                                </button>
                                <div
                                    class="top-menu-dropdown rounded shadow-lg px-4 py-3 border-bottom border-4 border-primary">
                                    <ul class="top-menu-dropdown-items text-uppercase">
                                        <li><a href="{{ url('/measure-instructions') }}">MEASURE INSTRUCTIONS</a>
                                        </li>
                                        {{-- <li><a href="#">INSTALL INSTRUCTIONS</a></li> --}}
                                        <!-- <li><a href="#">TECH TIPS</a></li> -->
                                        <!-- <li><a href="#">BUYING GUIDES</a></li> -->
                                        {{-- <li><a href="#">FAQ'S</a></li> --}}
                                        <!-- <li><a href="#">DESIGN BLOG</a></li> -->
                                        <li><a class="" href="{{ route('frontend.warranty') }}">HeyOK
                                                Warranties</a>
                                        </li>
                                        <li><a href="{{ route('frontend.about') }} ">ABOUT US</a></li>
                                        <li><a href="{{ url('/contact-us') }}">CONTACT US</a></li>
                                        <li><a href="{{ route('frontend.faq') }} ">FAQ</a></li>
                                        <li>
                                            <a class="btn text-white text-capitalize btn-primary px-4"
                                                href="{{ url('/blog') }} ">
                                                Hey Blog
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <button type="button" class="cartBtn top-menu-btn headerSampleCart"
                                    id="headerSampleCart">
                                    <span class="badge-cercle" id="sampleCartCountBadge">{{ $sampleCount }}</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-palette2 me-1" viewBox="0 0 16 16">
                                            <path
                                                d="M0 .5A.5.5 0 0 1 .5 0h5a.5.5 0 0 1 .5.5v5.277l4.147-4.131a.5.5 0 0 1 .707 0l3.535 3.536a.5.5 0 0 1 0 .708L10.261 10H15.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5H3a2.99 2.99 0 0 1-2.121-.879A2.99 2.99 0 0 1 0 13.044m6-.21l7.328-7.3-2.829-2.828L6 7.188v5.647zM4.5 13a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0zM15 15v-4H9.258l-4.015 4H15zM0 .5v12.495z" />
                                            <path d="M0 12.995V13a3.07 3.07 0 0 0 0-.005z" />
                                        </svg>
                                    </span>
                                    Samples
                                </button>
                            </li>
                            <li>
                                <button class="cartBtn top-menu-btn">
                                    <a href="{{ route('frontend.cart', $getCookieReadCartId) }}">
                                        <span class="badge-cercle"
                                            id="orderCartCountBadge">{{ $cartCount }}</span>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                        </span>
                                        Cart
                                    </a>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between navigation-section position-relative">
                    <div class="navigation">
                        <div class="menu-bar">
                            <div class="menu-icon">
                                <span></span><span></span><span></span>
                            </div>
                            <div class="right-menu">
                                <div class="menu-items">

                                    <nav>
                                        <ul class="nav-menu">

                                            <li class="menu-dropdown d-block d-lg-none">
                                                <a href="{{ route('welcome') }}"
                                                    class="text-capitalize">HeyBlinds.ca</a>
                                            </li>
                                            @foreach ($categories as $category)

                                                @if ($category->product->count() > 0 && $helpers->checkIsProductExist($category->id, 'category'))
                                                    @foreach ($category->subCategories as $subCategory)

                                                        @if ($subCategory->product->count() > 0 && $helpers->checkIsProductExist($subCategory->id, 'sub-category'))
                                                            <li class="menu-dropdown ">
                                                                <a href="{{ route('frontend.category.sub-category', [$category->slug, $subCategory->slug]) }}"
                                                                    class="{{ $subCategory->slug == Request::segment(3) ? 'active' : '' }}">{{ $subCategory->name }}</a>
                                                                {{-- @if (!empty($category->subCategories))
                                                                    <div class="dropdown-menu-items d-none">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 d-none d-lg-block">
                                                                                <div
                                                                                    class="bg-light rounded p-4 h-100 ">
                                                                                    <div
                                                                                        class="position-relative h-100">
                                                                                        @foreach ($category->subCategories as $key => $subCategory)
                                                                                            @if ($subCategory->product->count() > 0)
                                                                                                @php
                                                                                                    $active = '';
                                                                                                    if ($key == 0) {
                                                                                                        $active = 'active';
                                                                                                    }
                                                                                                @endphp
                                                                                                <div
                                                                                                    class="row align-items-center dropdown-items-description {{ $active }} ">
                                                                                                    <div
                                                                                                        class="col-md-6">
                                                                                                        <h4>{{ $subCategory->name }}
                                                                                                        </h4>
                                                                                                        <p>
                                                                                                            @php
                                                                                                                echo $subCategory->description;
                                                                                                            @endphp
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="col-md-6">
                                                                                                        <img class="round"
                                                                                                            src="{{ $helpers->getThumbnail($subCategory->media_id) }}"
                                                                                                            alt="" />
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif --}}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach


                                            <li class="menu-dropdown">
                                                @include('layouts.Frontend.partials.shop-menu')
                                            </li>

                                        </ul>
                                        <ul class=" nav-menu d-block d-lg-none">
                                            <hr />
                                            <li><a class="text-capitalize res-head-menu text-dark pe-3"
                                                    href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#RightFit-Guarantee">
                                                    <span class="pe-2">
                                                        <img src="{{ asset('images/icon7.png') }}"
                                                            style="width: 25px" alt="Hey Blindes Delivery Truck">
                                                    </span>
                                                    RightFit<small class="TrademarkSymbol">&reg;</small> &nbsp;
                                                    Guarantee
                                                </a></li>

                                            <li><a class="text-capitalize res-head-menu pe-3 text-dark "
                                                    href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#Risk-Free-Trial">
                                                    <span class="pe-2">
                                                        <img src="{{ asset('images/icon8.png') }}"
                                                            style="width: 25px" alt="Hey Blindes Delivery Truck">
                                                    </span>
                                                    100 Day Risk-Free In-Home Trial
                                                </a></li>

                                            <li><a class="text-capitalize res-head-menu pe-3 text-dark "
                                                    href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#Price-Lowest-Guarantee">
                                                    <span class="pe-2">
                                                        <img src="{{ asset('images/icon9.png') }}"
                                                            style="width: 25px" alt="Hey Blindes Delivery Truck">
                                                    </span>
                                                    Best Price Guarantee
                                                </a></li>

                                            <li><a class="text-capitalize res-head-menu text-dark "
                                                    href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#Shipping-On-Everything">
                                                    <span class="pe-2">
                                                        <img src="{{ asset('images/delivery-truck.png') }}"
                                                            style="width: 25px" alt="Hey Blindes Delivery Truck">
                                                    </span>
                                                    Free Shipping</a></li>
                                        </ul>

                                    </nav>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="d-block d-lg-none">

                        <div class="star-width small">
                            <div class="progress">
                                @php
                                    $rating_total_avg_percentage = (100 / 5) * $avgOfReviews;
                                @endphp
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ $rating_total_avg_percentage }}%;" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="star-pro">
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                            </div>
                        </div>
                        <p class="mb-0 pt-0"><b>{{ number_format($avgOfReviews, 1) }}</b><small>/5 <a
                                    class="text-secondary"
                                    href="{{ url('/reviews-of-HeyBlinds') }}">({{ $reviewsCount }}
                                    Reviews)</a></small></p>
                    </div>

                    <div>
                        <a class="btn custom btn-primary header-btn" href="{{ url('/samples') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-palette2 me-1" viewBox="0 0 16 16">
                                <path
                                    d="M0 .5A.5.5 0 0 1 .5 0h5a.5.5 0 0 1 .5.5v5.277l4.147-4.131a.5.5 0 0 1 .707 0l3.535 3.536a.5.5 0 0 1 0 .708L10.261 10H15.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5H3a2.99 2.99 0 0 1-2.121-.879A2.99 2.99 0 0 1 0 13.044m6-.21l7.328-7.3-2.829-2.828L6 7.188v5.647zM4.5 13a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0zM15 15v-4H9.258l-4.015 4H15zM0 .5v12.495z" />
                                <path d="M0 12.995V13a3.07 3.07 0 0 0 0-.005z" />
                            </svg>
                            Order Free Samples
                        </a>
                    </div>
                </div>
            </div>
            <div id="scroll-bar"></div>
        </div>

    </header>
</div>

<div class="header-bottom">
    <div id="promoTier-visibility"
        class="bg-secondary promoTier {{ empty($promo->hide_timer) && empty($promo->end_date) ? 'text-center' : 'text-start' }} text-white">
        @if (!empty($promo->ticker))
            <div
                class="container py-2 {{ empty($promo->hide_timer) && empty($promo->end_date) ? '' : 'promoTierCount' }} ">
                <p class="promoTier-text d-none d-md-block">
                    {{ $promo->ticker }}
                    @if (!empty($promo->content))
                        <a class="text-decoration-underline ms-2" href="javascript:void(0)" id="couponDetails">
                            Details</a>
                    @endif
                </p>

                <p class="promoTier-text d-block d-md-none">
                    {{ $promo->mob_text_bar }}
                    @if (!empty($promo->mob_text_bar))
                        <a class="text-decoration-underline ms-2" href="javascript:void(0)" id="couponMobileDetails">
                            Details</a>
                    @endif
                </p>
                @if (!empty($promo->end_date) && $promo->hide_timer != 1 && !empty($promo->is_active))
                    <div id="timeCountdown" class="countdownWrap d-flex">
                        <div id="new-timer"></div>
                        <p class="ps-2 mb-0"> Left To Save</p>
                    </div>
                @endif
            </div>
        @else
            <div class="container py-2 pe-4">
                <p class="promoTier-text">
                    Everything already discounted to our low sale prices!
                </p>
            </div>
        @endif
    </div>
    {{-- <div class="bg-primary promoTier text-center text-white">
        <div class="container py-2 pe-4">
            <p class="promoTier-text">
                Due to worldwide supply chain delays, order extra early by Nov. 20 to ensure delivery by Dec. 25.
            </p>
        </div>
    </div> --}}
</div>

@push('js')



@endpush
