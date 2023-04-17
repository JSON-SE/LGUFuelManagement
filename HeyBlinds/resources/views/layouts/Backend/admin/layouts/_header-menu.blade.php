<header id="header">
    <nav class="navbar navbar-expand-xl navbar-overlap navbar-dark bg-dark px-lg-5 px-md-4">
        <div class="container-fluid d-flex position-relative">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="HeyBlinds Logo" />
            </a>
            <button class="navbar-toggler ms-auto me-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="header-nav-bar collapse navbar-collapse me-lg-auto" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto ms-lg-3 mb-lg-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }} " aria-current="page"
                            href="{{ route('admin.dashboard') }}">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-house" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                    <path fill-rule="evenodd"
                                        d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                </svg>
                                <span class=" ps-1">Dashboard</span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-grid" viewBox="0 0 16 16">
                                    <path
                                        d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
                                </svg>
                                <span class=" ps-1">Category</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.category.index') }}">Categories</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.category.create') }}">Add category</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li><a class="dropdown-item" href="{{ route('admin.super-subcategory.index') }}">Super
                                    Sub-categories</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.super-subcategory.create') }}">Add
                                    Super
                                    Sub-category</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.sub.category.index') }}">Sub
                                    Categories</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.sub.category.create') }}">Add
                                    Sub-category</a></li>

                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-gem" viewBox="0 0 16 16">
                                    <path
                                        d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z" />
                                </svg>
                                <span class=" ps-1">Product</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.product.index') }}">All Products</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.product.create') }}">Add Products</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.product.option.index') }}">All
                                    Options</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.product.option.group.index') }}">All
                                    Option Groups</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.color.index') }}">All Colours</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.color.group.index') }}">All Colour
                                    Groups</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.extra-setting.index') }}">Extra
                                    Setting</a></li>

                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="{{ request()->routeIs('admin.coupons.*') ||request()->routeIs('admin.promo.*') ||request()->routeIs('admin.modal-coupons.*')? 'active': '' }} nav-link dropdown-toggle"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-bookmarks" viewBox="0 0 16 16">
                                    <path
                                        d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z" />
                                    <path
                                        d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z" />
                                </svg>
                                <span class=" ps-1">Discount Management</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">

                            <li><a class="dropdown-item" href="{{ route('admin.promo.index') }}">All Promos</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.promo.create') }}">Add Promos</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.coupons.index') }}">All Coupons</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.coupons.create') }}">Add Coupons</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.modal-coupons.index') }}">All Modal
                                    Coupons</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.modal-coupons.create') }}">Add Modal
                                    Coupons</a></li>

                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle  {{ request()->routeIs('admin.order.*') ? 'active' : '' }}"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                </svg>
                                <span class=" ps-1">Order Management</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.order.index') }}">All Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.abandoned.cart') }}">Action</a></li>
                            {{-- <li><a class="dropdown-item" href="{{route('admin.saved.cart')}}">Saved Cart</a></li> --}}
                            {{-- <li><a class="dropdown-item" href="{{route('admin.coupons.create')}}">Add Coupons</a></li> --}}
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle  {{ request()->routeIs('admin.customer.*') ? 'active' : '' }}"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                </svg>
                                <span class=" ps-1">User Management</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.customers.index') }}">All Users</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle   {{ request()->routeIs('admin.samples.*') ? 'active' : '' }} "
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-palette2" viewBox="0 0 16 16">
                                    <path
                                        d="M0 .5A.5.5 0 0 1 .5 0h5a.5.5 0 0 1 .5.5v5.277l4.147-4.131a.5.5 0 0 1 .707 0l3.535 3.536a.5.5 0 0 1 0 .708L10.261 10H15.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5H3a2.99 2.99 0 0 1-2.121-.879A2.99 2.99 0 0 1 0 13.044m6-.21 7.328-7.3-2.829-2.828L6 7.188v5.647zM4.5 13a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0zM15 15v-4H9.258l-4.015 4H15zM0 .5v12.495V.5z" />
                                    <path d="M0 12.995V13a3.07 3.07 0 0 0 0-.005z" />
                                </svg>
                                <span class=" ps-1">Sample Orders</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.samples.index') }}">All Sample
                                    Orders</a></li>
                            {{-- <li><a class="dropdown-item" href="{{route('admin.coupons.create')}}">Add Coupons</a></li> --}}
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle   {{ request()->routeIs('admin.blog.index') || request()->routeIs('admin.blog.create') ? 'active' : '' }} "
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-blog"></i>
                                <span class="ps-1">Blog</span>

                            </div>

                        </a>
                        <ul class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.blog.index') }}">All Blogs</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.blog.create') }}">Create</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.blog-category.index') }}">All
                                    Categories</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.blog-category.create') }}">Add
                                    Category</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle   {{ request()->routeIs('admin.review.web') ||request()->routeIs('admin.subcriber.index') ||request()->routeIs('admin.review.product')? 'active': '' }} || {{ request()->routeIs('admin.product') ? 'active' : '' }}"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-palette2" viewBox="0 0 16 16">
                                    <path
                                        d="M0 .5A.5.5 0 0 1 .5 0h5a.5.5 0 0 1 .5.5v5.277l4.147-4.131a.5.5 0 0 1 .707 0l3.535 3.536a.5.5 0 0 1 0 .708L10.261 10H15.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5H3a2.99 2.99 0 0 1-2.121-.879A2.99 2.99 0 0 1 0 13.044m6-.21 7.328-7.3-2.829-2.828L6 7.188v5.647zM4.5 13a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0zM15 15v-4H9.258l-4.015 4H15zM0 .5v12.495V.5z" />
                                    <path d="M0 12.995V13a3.07 3.07 0 0 0 0-.005z" />
                                </svg>
                                <span class=" ps-1">Other Management</span>

                            </div>

                        </a>
                        <ul class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.subcriber.index') }}">Subscriber</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.review.web') }}">Site Review</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.review.product') }}">Product
                                    Review</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.contact') }}">Contact us</a></li>
                        </ul>
                    </li>

                </ul>
            </div>

            <div class="d-flex">
                <div class="dropdown me-lg-3 me-2">
                    <button class="btn btn-light bg-opacity dropdown-toggle notifications-btn brop-none" type="button"
                        id="notifications" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bell" viewBox="0 0 16 16">
                            <path
                                d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                        </svg>
                    </button>
                    <ul class=" dropdown-menu notifications-menu dropdown-custom dropdown-menu-end"
                        aria-labelledby="notifications">
                        <li>
                            <a class="notifications-items" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="mr-2">
                                        <svg id="notification" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <g id="icon_notification" data-name="icon/notification">
                                                <rect id="Rectangle" width="14" height="19" fill="rgba(216,216,216,0)">
                                                </rect>
                                                <g id="Group" transform="translate(4.8 2.88)">
                                                    <g id="Path" transform="translate(0 1.92)" fill="none"
                                                        stroke-miterlimit="10">
                                                        <path
                                                            d="M14.4,14.821a.537.537,0,0,1-.535.539H.534A.537.537,0,0,1,0,14.821V7.253a7.2,7.2,0,1,1,14.4,0Z"
                                                            stroke="none"></path>
                                                        <path
                                                            d="M 12.39999961853027 13.35999965667725 L 12.39999961853027 7.252949714660645 C 12.39999961853027 4.356459617614746 10.06728935241699 1.99999988079071 7.199999809265137 1.99999988079071 C 4.332709789276123 1.99999988079071 1.999999761581421 4.356459617614746 1.999999761581421 7.252949714660645 L 1.999999761581421 13.35999965667725 L 9.115189552307129 13.35999965667725 L 9.123849868774414 13.35999965667725 L 12.39999961853027 13.35999965667725 M 13.86516952514648 15.35999965667725 L 9.123849868774414 15.35999965667725 C 9.120960235595703 15.35999965667725 9.118080139160156 15.35999965667725 9.115189552307129 15.35999965667725 L 0.5338698029518127 15.35999965667725 C 0.2395198047161102 15.35999965667725 -1.907348661234209e-07 15.11872005462646 -1.907348661234209e-07 14.82123947143555 L -1.907348661234209e-07 7.252949714660645 C -1.907348661234209e-07 3.253889799118042 3.229179859161377 -1.716613837743353e-07 7.199999809265137 -1.716613837743353e-07 C 11.16985988616943 -1.716613837743353e-07 14.39999961853027 3.253889799118042 14.39999961853027 7.252949714660645 L 14.39999961853027 14.82123947143555 C 14.39999961853027 15.11872005462646 14.16047954559326 15.35999965667725 13.86516952514648 15.35999965667725 Z"
                                                            stroke="none" fill="#6f7e90"></path>
                                                    </g>
                                                    <path id="Rectangle-2" data-name="Rectangle"
                                                        d="M0,0H4.8a0,0,0,0,1,0,0V.48a2.4,2.4,0,0,1-2.4,2.4h0A2.4,2.4,0,0,1,0,.48V0A0,0,0,0,1,0,0Z"
                                                        transform="translate(4.8 16.32)" fill="#6f7e90"></path>
                                                    <rect id="Rectangle-3" data-name="Rectangle" width="4.8"
                                                        height="3.84" rx="1.92" transform="translate(4.8)"
                                                        fill="#6f7e90"></rect>
                                                </g>
                                            </g>
                                            <circle class="alertNotification" cx="3.5" cy="3.5" r="3.5"
                                                transform="translate(14 4)" fill="#e02020" stroke="#f0f2f8"
                                                stroke-miterlimit="10" stroke-width="2"></circle>
                                        </svg>
                                    </div>
                                    <div class="ms-2">
                                        <p class="mb-0 text-ex-small">
                                            It is a long established fact
                                        </p>
                                        <p class="text-small mb-0">2 hours ago</p>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="notifications-items" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="mr-2">
                                        <svg id="notification" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <g id="icon_notification" data-name="icon/notification">
                                                <rect id="Rectangle" width="14" height="19" fill="rgba(216,216,216,0)">
                                                </rect>
                                                <g id="Group" transform="translate(4.8 2.88)">
                                                    <g id="Path" transform="translate(0 1.92)" fill="none"
                                                        stroke-miterlimit="10">
                                                        <path
                                                            d="M14.4,14.821a.537.537,0,0,1-.535.539H.534A.537.537,0,0,1,0,14.821V7.253a7.2,7.2,0,1,1,14.4,0Z"
                                                            stroke="none"></path>
                                                        <path
                                                            d="M 12.39999961853027 13.35999965667725 L 12.39999961853027 7.252949714660645 C 12.39999961853027 4.356459617614746 10.06728935241699 1.99999988079071 7.199999809265137 1.99999988079071 C 4.332709789276123 1.99999988079071 1.999999761581421 4.356459617614746 1.999999761581421 7.252949714660645 L 1.999999761581421 13.35999965667725 L 9.115189552307129 13.35999965667725 L 9.123849868774414 13.35999965667725 L 12.39999961853027 13.35999965667725 M 13.86516952514648 15.35999965667725 L 9.123849868774414 15.35999965667725 C 9.120960235595703 15.35999965667725 9.118080139160156 15.35999965667725 9.115189552307129 15.35999965667725 L 0.5338698029518127 15.35999965667725 C 0.2395198047161102 15.35999965667725 -1.907348661234209e-07 15.11872005462646 -1.907348661234209e-07 14.82123947143555 L -1.907348661234209e-07 7.252949714660645 C -1.907348661234209e-07 3.253889799118042 3.229179859161377 -1.716613837743353e-07 7.199999809265137 -1.716613837743353e-07 C 11.16985988616943 -1.716613837743353e-07 14.39999961853027 3.253889799118042 14.39999961853027 7.252949714660645 L 14.39999961853027 14.82123947143555 C 14.39999961853027 15.11872005462646 14.16047954559326 15.35999965667725 13.86516952514648 15.35999965667725 Z"
                                                            stroke="none" fill="#6f7e90"></path>
                                                    </g>
                                                    <path id="Rectangle-2" data-name="Rectangle"
                                                        d="M0,0H4.8a0,0,0,0,1,0,0V.48a2.4,2.4,0,0,1-2.4,2.4h0A2.4,2.4,0,0,1,0,.48V0A0,0,0,0,1,0,0Z"
                                                        transform="translate(4.8 16.32)" fill="#6f7e90"></path>
                                                    <rect id="Rectangle-3" data-name="Rectangle" width="4.8"
                                                        height="3.84" rx="1.92" transform="translate(4.8)"
                                                        fill="#6f7e90"></rect>
                                                </g>
                                            </g>
                                            <circle class="alertNotification" cx="3.5" cy="3.5" r="3.5"
                                                transform="translate(14 4)" fill="#e02020" stroke="#f0f2f8"
                                                stroke-miterlimit="10" stroke-width="2"></circle>
                                        </svg>
                                    </div>
                                    <div class="ms-2">
                                        <p class="mb-0 text-ex-small">
                                            It is a long established fact
                                        </p>
                                        <p class="text-small mb-0">2 hours ago</p>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <li>
                            <a class="notifications-items" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="mr-2">
                                        <svg id="notification" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <g id="icon_notification" data-name="icon/notification">
                                                <rect id="Rectangle" width="14" height="19" fill="rgba(216,216,216,0)">
                                                </rect>
                                                <g id="Group" transform="translate(4.8 2.88)">
                                                    <g id="Path" transform="translate(0 1.92)" fill="none"
                                                        stroke-miterlimit="10">
                                                        <path
                                                            d="M14.4,14.821a.537.537,0,0,1-.535.539H.534A.537.537,0,0,1,0,14.821V7.253a7.2,7.2,0,1,1,14.4,0Z"
                                                            stroke="none"></path>
                                                        <path
                                                            d="M 12.39999961853027 13.35999965667725 L 12.39999961853027 7.252949714660645 C 12.39999961853027 4.356459617614746 10.06728935241699 1.99999988079071 7.199999809265137 1.99999988079071 C 4.332709789276123 1.99999988079071 1.999999761581421 4.356459617614746 1.999999761581421 7.252949714660645 L 1.999999761581421 13.35999965667725 L 9.115189552307129 13.35999965667725 L 9.123849868774414 13.35999965667725 L 12.39999961853027 13.35999965667725 M 13.86516952514648 15.35999965667725 L 9.123849868774414 15.35999965667725 C 9.120960235595703 15.35999965667725 9.118080139160156 15.35999965667725 9.115189552307129 15.35999965667725 L 0.5338698029518127 15.35999965667725 C 0.2395198047161102 15.35999965667725 -1.907348661234209e-07 15.11872005462646 -1.907348661234209e-07 14.82123947143555 L -1.907348661234209e-07 7.252949714660645 C -1.907348661234209e-07 3.253889799118042 3.229179859161377 -1.716613837743353e-07 7.199999809265137 -1.716613837743353e-07 C 11.16985988616943 -1.716613837743353e-07 14.39999961853027 3.253889799118042 14.39999961853027 7.252949714660645 L 14.39999961853027 14.82123947143555 C 14.39999961853027 15.11872005462646 14.16047954559326 15.35999965667725 13.86516952514648 15.35999965667725 Z"
                                                            stroke="none" fill="#6f7e90"></path>
                                                    </g>
                                                    <path id="Rectangle-2" data-name="Rectangle"
                                                        d="M0,0H4.8a0,0,0,0,1,0,0V.48a2.4,2.4,0,0,1-2.4,2.4h0A2.4,2.4,0,0,1,0,.48V0A0,0,0,0,1,0,0Z"
                                                        transform="translate(4.8 16.32)" fill="#6f7e90"></path>
                                                    <rect id="Rectangle-3" data-name="Rectangle" width="4.8"
                                                        height="3.84" rx="1.92" transform="translate(4.8)"
                                                        fill="#6f7e90"></rect>
                                                </g>
                                            </g>
                                            <circle class="alertNotification" cx="3.5" cy="3.5" r="3.5"
                                                transform="translate(14 4)" fill="#e02020" stroke="#f0f2f8"
                                                stroke-miterlimit="10" stroke-width="2"></circle>
                                        </svg>
                                    </div>
                                    <div class="ms-2">
                                        <p class="mb-0 text-ex-small">
                                            It is a long established fact
                                        </p>
                                        <p class="text-small mb-0">2 hours ago</p>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <li>
                            <a class="notifications-items" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="mr-2">
                                        <svg id="notification" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <g id="icon_notification" data-name="icon/notification">
                                                <rect id="Rectangle" width="14" height="19" fill="rgba(216,216,216,0)">
                                                </rect>
                                                <g id="Group" transform="translate(4.8 2.88)">
                                                    <g id="Path" transform="translate(0 1.92)" fill="none"
                                                        stroke-miterlimit="10">
                                                        <path
                                                            d="M14.4,14.821a.537.537,0,0,1-.535.539H.534A.537.537,0,0,1,0,14.821V7.253a7.2,7.2,0,1,1,14.4,0Z"
                                                            stroke="none"></path>
                                                        <path
                                                            d="M 12.39999961853027 13.35999965667725 L 12.39999961853027 7.252949714660645 C 12.39999961853027 4.356459617614746 10.06728935241699 1.99999988079071 7.199999809265137 1.99999988079071 C 4.332709789276123 1.99999988079071 1.999999761581421 4.356459617614746 1.999999761581421 7.252949714660645 L 1.999999761581421 13.35999965667725 L 9.115189552307129 13.35999965667725 L 9.123849868774414 13.35999965667725 L 12.39999961853027 13.35999965667725 M 13.86516952514648 15.35999965667725 L 9.123849868774414 15.35999965667725 C 9.120960235595703 15.35999965667725 9.118080139160156 15.35999965667725 9.115189552307129 15.35999965667725 L 0.5338698029518127 15.35999965667725 C 0.2395198047161102 15.35999965667725 -1.907348661234209e-07 15.11872005462646 -1.907348661234209e-07 14.82123947143555 L -1.907348661234209e-07 7.252949714660645 C -1.907348661234209e-07 3.253889799118042 3.229179859161377 -1.716613837743353e-07 7.199999809265137 -1.716613837743353e-07 C 11.16985988616943 -1.716613837743353e-07 14.39999961853027 3.253889799118042 14.39999961853027 7.252949714660645 L 14.39999961853027 14.82123947143555 C 14.39999961853027 15.11872005462646 14.16047954559326 15.35999965667725 13.86516952514648 15.35999965667725 Z"
                                                            stroke="none" fill="#6f7e90"></path>
                                                    </g>
                                                    <path id="Rectangle-2" data-name="Rectangle"
                                                        d="M0,0H4.8a0,0,0,0,1,0,0V.48a2.4,2.4,0,0,1-2.4,2.4h0A2.4,2.4,0,0,1,0,.48V0A0,0,0,0,1,0,0Z"
                                                        transform="translate(4.8 16.32)" fill="#6f7e90"></path>
                                                    <rect id="Rectangle-3" data-name="Rectangle" width="4.8"
                                                        height="3.84" rx="1.92" transform="translate(4.8)"
                                                        fill="#6f7e90"></rect>
                                                </g>
                                            </g>
                                            <circle class="alertNotification" cx="3.5" cy="3.5" r="3.5"
                                                transform="translate(14 4)" fill="#e02020" stroke="#f0f2f8"
                                                stroke-miterlimit="10" stroke-width="2"></circle>
                                        </svg>
                                    </div>
                                    <div class="ms-2">
                                        <p class="mb-0 text-ex-small">
                                            It is a long established fact
                                        </p>
                                        <p class="text-small mb-0">2 hours ago</p>
                                    </div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>


                <div class="dropdown">
                    <button class="btn profile-btn dropdown-toggle p-0 text-white border-0 d-flex align-items-center"
                        type="button" id="profile" data-display="static" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="user-image me-1">
                            <img src="{{ asset('images/auth-image1.jpg') }}" alt="" />
                        </span>
                        <span class="d-none ps-1 d-md-block">
                            {{ Auth::guard('admin')->user()->name }}
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-custom dropdown-menu-end" aria-labelledby="profile">
                        <li><a class="dropdown-item" target="_blank" href="{{ url('/') }}">Visit Site</a></li>
                        {{-- <li><a class="dropdown-item" href="#">My Account</a></li> --}}
                        <li><a class="dropdown-item" href="{{ url('/admin/admin-account-setting') }}">Account
                                Settings</a></li>
                        <hr class="my-2" />
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>


            </div>

        </div>
    </nav>
</header>
