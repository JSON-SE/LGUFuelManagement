@extends('layouts.Frontend.app')
@section('title')
    {{ trim($helpers->seo($subCategory->id ?? '', 'sub_category')->title ?? $category->name . ' - HeyBlinds') }}
@endsection
@section('content')
    <form id="categorySearchForm">
        <section id="body-content" class="full-screen">
            <div class="container pt-2">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        {{-- <li class="breadcrumb-item">Category</li> --}}
                        <li class="breadcrumb-item " aria-current="page">
                            <a href="{{ url('category/' . $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                        @if ($isSubCategory)
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ url('category/' . $category->slug . '/' . $subCategory->slug) }} ">{{ $subCategory->name }}
                                </a>
                            </li>
                        @endif
                    </ol>
                </nav>
                <div>

                    <h1 class="heading-two text-center">{{ !$isSubCategory ? $category->name : $subCategory->name }}</h1>

                </div>
                <hr class="my-3" />
                <div class="sticky-search-bar shadow-sm">
                    <div class="row justify-content-between align-items-end ">
                        <div class="col-12 d-block d-md-none">
                            <div class="d-flex justify-content-between">
                                <div id="cetagory-size-dropdown" class="btn btn-sm btn-primary">Size | <span>W <span
                                            id="res_width">
                                            @if (!empty(Session::get('session_width')) && Session::get('session_width') <= $maxWidth)
                                                {{ Session::get('session_width') ?? 24 }}
                                            @else
                                                24
                                            @endif
                                        </span>
                                        " H <span id="res_height">
                                            @if (!empty(Session::get('session_height')) && Session::get('session_width') <= $maxHeight)
                                                {{ Session::get('session_height') ?? 36 }}
                                            @else
                                                36
                                            @endif
                                        </span>"</span></div>

                                <div id="cetagory-sort-dropdown" class="btn btn-sm btn-primary">Sort by</div>
                            </div>
                        </div>
                        <div class="col-md-8 d-md-block col-lg-7 cetagory-size-dropdown-items pt-3 pt-md-0">
                            <div class="row">
                                <div class="col-6 pe-lg-4">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-auto">
                                            <h5 class="border-start border-primary border-4 px-2 label-aria-text">Width:
                                            </h5>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating width-select-fild">
                                                <select class="form-select" name="filter_width" id="filter_width"
                                                    aria-label="Floating label select example" onchange="rembermberSize()">
                                                    @for ($width = $minWidth; $width <= $maxWidth; $width++)
                                                        @if (!empty(Session::get('session_width')) && Session::get('session_width') <= $maxWidth)
                                                            <option value="{{ $width }}"
                                                                {{ $width == Session::get('session_width') ?? 24 ? 'selected' : '' }}>
                                                                {{ $width }}
                                                            </option>

                                                        @else
                                                            <option value="{{ $width }}"
                                                                {{ $width === 24 ? 'selected' : '' }}>
                                                                {{ $width }}
                                                            </option>
                                                        @endif
                                                    @endfor
                                                </select>
                                                <label for="floatingSelectGrid">Inches </label>
                                            </div>
                                        </div>



                                        <div class="col">
                                            <div class="form-floating width-select-fild">
                                                <select class="form-select" name="width_fraction_val"
                                                    id="filter_width_fraction" aria-label="Floating label select example"
                                                    onchange="rembermberSize()">
                                                    <option value="">0/0</option>
                                                    <option value="1/8"
                                                        {{ Session::get('session_width_fraction') == '1/8' ? 'selected' : '' }}>
                                                        1/8</option>
                                                    <option value="1/4"
                                                        {{ Session::get('session_width_fraction') == '1/4' ? 'selected' : '' }}>
                                                        1/4</option>
                                                    <option value="3/8"
                                                        {{ Session::get('session_width_fraction') == '3/8' ? 'selected' : '' }}>
                                                        3/8</option>
                                                    <option value="1/2"
                                                        {{ Session::get('session_width_fraction') == '1/2' ? 'selected' : '' }}>
                                                        1/2</option>
                                                    <option value="5/8"
                                                        {{ Session::get('session_width_fraction') == '5/8' ? 'selected' : '' }}>
                                                        5/8</option>
                                                    <option value="3/4"
                                                        {{ Session::get('session_width_fraction') == '3/4' ? 'selected' : '' }}>
                                                        3/4 </option>
                                                    <option value="7/8"
                                                        {{ Session::get('session_width_fraction') == '7/8' ? 'selected' : '' }}>
                                                        7/8 </option>
                                                </select>
                                                <label for="floatingSelectGrid">Fractions</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 ps-lg-4 ">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-auto">
                                            <h5 class="border-start border-primary border-4 px-2 label-aria-text">Height:
                                            </h5>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating width-select-fild">
                                                <select class="form-select" name="filter_height" id="filter_height"
                                                    aria-label="Floating label select example" onchange="rembermberSize()">
                                                    @for ($height = $minHeight; $height <= $maxHeight; $height++)
                                                        @if (!empty(Session::get('session_height')) && Session::get('session_width') <= $maxHeight)
                                                            <option value="{{ $height }}"
                                                                {{ $height == Session::get('session_height') ?? 36 ? 'selected' : '' }}>
                                                                {{ $height }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $height }}"
                                                                {{ $height === 36 ? 'selected' : '' }}>
                                                                {{ $height }}
                                                            </option>
                                                        @endif
                                                    @endfor

                                                </select>
                                                <label for="floatingSelectGrid">Inches</label>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-floating width-select-fild">
                                                <select class="form-select" id="filter_height_fraction"
                                                    name="filter_height_fraction" aria-label="Floating label select example"
                                                    onchange="rembermberSize()">
                                                    <option value="">0/0</option>
                                                    <option value="1/8"
                                                        {{ Session::get('session_height_fraction') == '1/8' ? 'selected' : '' }}>
                                                        1/8</option>
                                                    <option value="1/4"
                                                        {{ Session::get('session_height_fraction') == '1/4' ? 'selected' : '' }}>
                                                        1/4</option>
                                                    <option value="3/8"
                                                        {{ Session::get('session_height_fraction') == '3/8' ? 'selected' : '' }}>
                                                        3/8</option>
                                                    <option value="1/2"
                                                        {{ Session::get('session_height_fraction') == '1/2' ? 'selected' : '' }}>
                                                        1/2</option>
                                                    <option value="5/8"
                                                        {{ Session::get('session_height_fraction') == '5/8' ? 'selected' : '' }}>
                                                        5/8</option>
                                                    <option value="3/4"
                                                        {{ Session::get('session_height_fraction') == '3/5' ? 'selected' : '' }}>
                                                        3/4 </option>
                                                    <option value="7/8"
                                                        {{ Session::get('session_height_fraction') == '7/8' ? 'selected' : '' }}>
                                                        7/8 </option>
                                                </select>
                                                <label for="floatingSelectGrid">Fractions</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-md-block col-xxl-3 pt-3 pt-md-0 cetagory-sort-dropdown-items">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-auto">
                                    <h5 class="border-start border-primary border-4 px-2 label-aria-text">Sort by:</h5>
                                </div>
                                <div class="col">
                                    <div class=" width-select-fild">
                                        <select class="form-select" id="floatingSelectGrid" name="filter_short"
                                            aria-label="Floating label select example">
                                            {{-- <option value="relevance">Relevance</option> --}}
                                            <option value="min_price">Low To High</option>
                                            <option value="max_price">High To Low</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <ul class="nav nav-tabs mt-3 rounded refine-tab border-bottom-0" id="myTab" role="tablist">
                    <li class="bg-primary nav-tabs-label text-white rounded-start h-100">
                        Refine:
                    </li>
                    <li class="nav-item" role="presentation">
                        <button  class="nav-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Colour
                        </button>
                    </li>
                </ul> --}}
                <div class="tab-pane fade p-1 px-2 shadow-sm collapse" id="collapseExample">
                    <div class="row">
                        @foreach ($colorGroups as $colorGroup)
                            @if (!empty($colorGroup->id))
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="checkbox img-checkbox">
                                        <input type="checkbox" class="check_color" id="colour_{{ $colorGroup->id }}"
                                            name="filter_color[]" value="{{ $colorGroup->id }}">
                                        <label for="colour_{{ $colorGroup->id }}">
                                            <img src="{{ $helpers->getThumbnail($colorGroup->media_id) }}" alt="color" />
                                            {{ $colorGroup->name }} <small class="ps-1">
                                                ({{ !$isSubCategory? $helpers->productCountAsPerColor($category->id, $colorGroup->id): $helpers->productCountAsPerColorForSub($colorGroup->id, $subCategory->id) }})
                                            </small>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div id="categorySearchResult">
                        <div class="row pb-2">
                            @if (!empty($products))
                                @foreach ($products as $product)
                                    <div class="col-lg-6 mt-3">
                                        <div class="category-product rounded-3 h-100">
                                            <div class="w-100">

                                                <div class="category-product-image category-product-href rounded category-product-link"
                                                    style="cursor: pointer"
                                                    data-href="{{ route('frontend.product.details', $product->slug) }}">

                                                    <img class="rounded"
                                                        src="{{ $helpers->getImage($product->display_media_id) }}"
                                                        alt="{{ $product->product_home_image_alt_title ?? $product->name }}" />


                                                    @if ($product->is_new == 1)
                                                        <div class="category-product-sample">
                                                            <img class="rounded"
                                                                src="{{ url('/images/product-sample.png') }}"
                                                                alt="Heyblinds-sample-image" />
                                                        </div>
                                                    @endif
                                                    @if ($product->made_in_canada == 1)
                                                        <div class="category-product-made-in-canada">
                                                            <img class="rounded"
                                                                src="{{ url('/images/made_in_canada.svg') }}"
                                                                alt="Heyblinds-canada-flag" />
                                                        </div>
                                                    @endif
                                                    @if ($product->is_on_sale == 1)
                                                        <div class="category-product-image-text rounded bg-white">
                                                            Sale
                                                        </div>
                                                    @endif
                                                </div>
                                                <a href="{{ route('frontend.product.details', $product->slug) }}"
                                                    class="category-product-name text-center text-dark pt-2 mb-0 h2">
                                                    {{ $product->name }}
                                                </a>
                                                <hr class="my-2 bg-dark" />
                                                <div class="row my-3">
                                                    <div class="col-sm-7">
                                                        <ul class="category-product-list">
                                                            @foreach (!empty($product->features) ? json_decode($product->features) : [] as $key => $feature)
                                                                <li>{{ $feature }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <div class="d-flex py-2">
                                                            @php
                                                                $avg_rating = $product->avgRatingOfProduct($product->id);
                                                                $rating_avg = (100 / 5) * $avg_rating;
                                                            @endphp
                                                            <div class="star-width">
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{ $rating_avg }}%;"
                                                                        aria-valuenow="25" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                                <div class="star-pro">
                                                                    <span>★</span>
                                                                    <span>★</span>
                                                                    <span>★</span>
                                                                    <span>★</span>
                                                                    <span>★</span>
                                                                </div>
                                                            </div>

                                                            <p class="mb-0 ps-2">
                                                                @if (is_float($avg_rating))
                                                                    <b>{{ number_format($avg_rating, 1) }}/5</b>
                                                                @else
                                                                    <b>{{ number_format($avg_rating) }}/5</b>
                                                                @endif
                                                                <small><a
                                                                        href="{{ route('frontend.product.details', $product->slug) }}?GoReview">({{ $product->review->count() }}
                                                                        Reviews)</a></small>
                                                            </p>

                                                        </div>

                                                    </div>
                                                    <div class="col-sm-5 text-center">
                                                        <h6
                                                            class="mb-0 text-dark  d-flex justify-content-center align-items-center flex-wrap">
                                                            @if (!empty($product->getExtraDiscountProductPrice($product->id, $product->default_width, $product->default_height)['discount']))
                                                                <small class="text-decoration-line-through">
                                                                    ${{ $helpers->withoutRounding($product->getExtraDiscountProductPrice($product->id, $product->default_width, $product->default_height)['productPrice'],2) }}
                                                                </small>
                                                            @endif
                                                            <span class="position-relative ms-2 d-block mousuhover-out">
                                                                <span class="text-primary tooltip-hover question-icon ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-question-circle-fill"
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

                                                                                <p>We want you to be sure you’ve chosen the
                                                                                    right blind in the right colour and
                                                                                    texture.
                                                                                </p>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        </h6>
                                                        {{-- <div class="category-product-price text-primary py-2">
                                                            ${{ $product->getExtraDiscountProductPrice($product->id, $product->default_width, $product->default_height)['price'] ?? 0 }}

                                                        </div> --}}
                                                        <h6 class="category-shipping-text mb-0 text-dark fst-italic">
                                                            <span class="pe-2">
                                                                <img src="{{ asset('images/delivery-truck.png') }}"
                                                                    alt="HeyBlinds Delivery Truck">
                                                            </span>
                                                            Free Shipping
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div>
                                                    <a href="{{ route('frontend.product.details', $product->slug) }}"
                                                        class="btn btn-primary custom w-100">Shop Now</a>
                                                </div>
                                                <div class="mb-0 fst-italic text-center pt-2">
                                                    <span class="category-guarantee-text"><span>100</span> Day</span>
                                                    Risk-Free In-Home Trial

                                                    <span class="position-relative ms-2 mousuhover-out">
                                                        <span class="text-primary tooltip-hover question-icon mx-2">
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
                                                                        {{-- @if (empty($product->tooltip->blind_guarantee)) --}}
                                                                        <p>
                                                                            We want you to be sure you’ve chosen the right
                                                                            blind
                                                                            in the right colour and texture.
                                                                        </p>
                                                                        <p>
                                                                            That’s why we’ll let you live with your blind
                                                                            for 100
                                                                            days so you can be confident you made the right
                                                                            choice.
                                                                        </p>
                                                                        <p>
                                                                            The best way to decide is to order a sample or
                                                                            two. That way,
                                                                            you can better see how they look and feel for a
                                                                            perfect complement
                                                                            to your room—order as many as you like.
                                                                            HeyBlinds will ship them all
                                                                            for free.
                                                                        </p>
                                                                        {{-- @else
                                                                            {!! $product->tooltip->blind_guarantee ?? '' !!}
                                                                        @endif --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="container pt-2 pb-4 pb-xxl-5 text-center error-section">
                                    <div class="error-box">
                                        <img src="https://prod.heyblinds.ca/images/404-image.jpg" alt="HeyBlinds">
                                        <div class="eye"></div>
                                    </div>
                                    <h1 class="font-brittan text-primary">404</h1>

                                    <h5 class="heading-two">
                                        No Product Found!
                                    </h5>

                                    <a class="btn btn-primary mt-3" href="#">Back to Home</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr />

                    <p class="">@php echo !$isSubCategory ? $category->meta_description  : $subCategory->description @endphp</p>


                    @if ((!empty($category->content) && !$isSubCategory) || (!empty($subCategory->content) && $isSubCategory))
                        <div class="
                        row justify-content-between py-2">
                            <div class="col-lg-8 col-md-7 pb-3">
                                <h1 class="heading-two ">{{ !$isSubCategory ? $category->name : $subCategory->name }}
                                </h1>
                                <p class="">@php echo !$isSubCategory ? $category->content  : $subCategory->content @endphp</p>

                            </div>
                            <div class="
                            col-lg-4 col-xl-3 col-md-5 ps-xl-5 pb-3">
                                <img class="rounded-3" src="{{ asset('images/product-image.jpg') }}"
                                    alt="HeyBlinds" />
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="review-section bg-light py-2 d-none">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-4 pe-md-4 text-center campany-reviews">
                            <h5 class="mb-0">Reviews</h5>
                            <hr class="mt-2" />
                            <ul class="review-count d-flex pb-3 justify-content-center">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </li>
                            </ul>
                            <h6 class="mb-3">
                                Don't take our word for it, we've
                                got over 125,000 great reviews
                            </h6>
                            <img src="{{ asset('images/logo.png') }}" alt="HeyBlinds" />
                        </div>
                        <div class="col-lg-9 col-md-8 px-lg-4">
                            <div class="testmonial-slider product-category-testmonial">
                                <div class="testmonial-box p-3 h-100">
                                    <div class="testmonial-top pb-1">
                                        <ul class="review-count d-flex pb-3">
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                        </ul>
                                        <h4 class="mb-0">Exceptional quality with exceptional service.</h4>
                                    </div>
                                    <hr class="my-2" />
                                    <p class="auth-content mb-0 py-1">
                                        I ordered my Wooden venetian blind on the Friday and it was delivered on the next
                                        Wednesday. The blind is excellent quality at an extremely ...
                                    </p>
                                </div>
                                <div class="testmonial-box p-3 h-100">
                                    <div class="testmonial-top pb-1">
                                        <ul class="review-count d-flex pb-3">
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                        </ul>
                                        <h4 class="mb-0">Perfectly simple with
                                            fantastic quality</h4>
                                    </div>
                                    <hr class="my-2" />

                                    <p class="auth-content mb-0 py-1">
                                        I was a little bit nervous ordering my Venetian blind that I would somehow do it
                                        wrong. It looked asy, it was easy. Came within a week and even ...
                                    </p>
                                </div>
                                <div class="testmonial-box p-3 h-100">
                                    <div class="testmonial-top pb-1">
                                        <ul class="review-count d-flex pb-3">
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                        </ul>
                                        <h4 class="mb-0">Easy to order and excellent
                                            quality</h4>
                                    </div>
                                    <hr class="my-2" />
                                    <p class="auth-content mb-0 py-1">
                                        Easy to order, we ordered by phone as we required reverse rolled and silver chain.
                                        Blinds are excellent quality and easy to fit, looks great. a week and even ...
                                    </p>
                                </div>
                                <div class="testmonial-box p-3 h-100">
                                    <div class="testmonial-top pb-1">
                                        <ul class="review-count d-flex pb-3">
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </li>
                                        </ul>
                                        <h4 class="mb-0">Exceptional quality with exceptional service.</h4>
                                    </div>
                                    <hr class="my-2" />
                                    <p class="auth-content mb-0 py-1">
                                        I ordered my Wooden venetian blind on the Friday and it was delivered on the next
                                        Wednesday. The blind is excellent quality at an extremely ...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </form>

    @push('js')
        <script>
            function rembermberSize() {
                // var session_width =  $('#filter_width').val();
                // var session_height = $('#filter_height').val();
                // var  session_width_fraction = $('#filter_width_fraction').val();
                // var session_height_fraction = $('#filter_height_fraction').val();

                // axios.post('/rembermber-size-of-measure-store',{
                //     'session_width': session_width,
                //     'session_height' : session_height,
                //     'session_width_fraction' : session_width_fraction,
                //     'session_height_fraction' : session_height_fraction,
                // })
                // .then((response) =>{
                // })
            }

            function rembermberSizeRetrive() {
                axios.post('/rembermber-size-of-measure', {
                        'max_width': "{{ $maxWidth }}",
                        'min_width': "{{ $minWidth }}",
                        'max_height': "{{ $maxHeight }}",
                        'min_height': "{{ $minHeight }}",
                    })
                    .then((response) => {
                        $('#filter_width').val(response.data.session_width);
                        $('#filter_height').val(response.data.session_height);
                        $('#filter_width_fraction').val(response.data.session_width_fraction);
                        $('#filter_height_fraction').val(response.data.session_height_fraction);
                        $('#res_width').val(response.data.session_width);
                        $('#res_height').val(response.data.session_height);
                    })
            }

            jQuery(function($) {

                // rembermberSizeRetrive();
                filters();

                $(document).on('click', function(e) {
                    let $target = e.target;
                    if ($target.tagName === "SELECT") {
                        $($target).on('change', function(event) {
                            event.preventDefault();
                            event.stopPropagation();
                            event.stopImmediatePropagation();
                            createCookie($(this).attr('name'), $(this).val())
                            filters();
                            let width = $("#filter_width").val(),
                                height = $("#filter_height").val();
                            $('#res_width').text(width);
                            $('#res_height').text(height);
                        })
                    } else if ($target.tagName === "INPUT" && ($target.type === "checkbox" || $target.type ===
                            "radio")) {
                        $($target).on('change', function(event) {
                            event.preventDefault();
                            event.stopPropagation();
                            event.stopImmediatePropagation();
                            createCookie($(this).attr('name'), $(this).val())
                            filters();
                        })
                    }
                })
                $(document).on('click', '.category-product-href', function() {
                    let $this = $(this),
                        link = $this.attr('data-href'),
                        width = $("#filter_width").val(),
                        height = $("#filter_height").val(),
                        withFraction = $("#filter_width_fraction").val(),
                        heightFraction = $("#filter_height_fraction").val();
                    window.location = link + '?w=' + width + '&h=' + height + (withFraction ? "&wf=" +
                        withFraction : "") + (heightFraction ? "&hf=" + heightFraction : "");
                })
            });

            function filters() {
                let form = $("#categorySearchForm"),
                    formData = new FormData(form[0]);
                @if ($isSubCategory)
                    formData.append('extra', 'sub-category')
                @endif
                @if (!$isSubCategory)
                    formData.append('category', {{ $category->id }})
                @else
                    formData.append('sub-category', {{ $subCategory->id }})
                @endif
                $("#loader").show();
                let url = '{{ route('frontend.category.search') }}';
                success_callback(url, formData, function(response) {
                    let data = response.data.products;
                    action(data)
                }, function(error) {
                    console.log(error);
                })
            }

            function action(data) {
                var html = '';
                if (data.length > 0) {
                    html += `<div class="row">`;
                    for (let i = 0; i < data.length; i++) {
                        let measurement = (data[i].width ? "w=" + data[i].width : "") + (data[i].height ? "&h=" + data[i]
                            .height : "") + (data[i].width_fraction ? "&wf=" + data[i].width_fraction : "") + (data[i]
                            .height_fraction ? "&hf=" + data[i].height_fraction : "");

                        html +=
                            `<div class="col-lg-6 mt-3"><div class="category-product rounded-3" ><div class="w-100 ">`; //?${measurement}
                        html +=
                            `<div class="category-product-image category-product-link rounded category-product-href" style="cursor: pointer" data-href="${window.location.origin}/product/${data[i].slug}"><img class="rounded" src="${data[i].display_media_id}" alt="${data[i].product_image_alt_title}">`;
                        if (data[i].is_new == 1) {
                            html +=
                                `<div class="category-product-sample"><img class="rounded" src="${window.location.origin}/images/product-sample.png" alt="Heyblinds-sample-image"></div>`;
                        }
                        if (data[i].made_in_canada == 1) {
                            html +=
                                `<div class=${data[i].is_new == 1 ? 'category-product-made-in-canada' : 'category-product-sample'}><img class="rounded" src="${window.location.origin}/images/made_in_canada.svg" alt="made in canada"></div>`;
                        }
                        html +=
                            `<div class="category-product-image-text rounded bg-white"> Sale </div></div><a href="${window.location.origin}/product/${data[i].slug}?${measurement}" class="category-product-name text-dark text-center pt-2 mb-0 h2">${data[i].name}</a><hr class="my-2 bg-dark">`;
                        html += `<div class="row my-3"><div class="col-sm-7"><ul class="category-product-list">`;
                        html += `<li>${data[i].features[0]}</li><li>${data[i].features[1]}</li><li>${data[i].features[2]}</li></ul>
                             <div class="d-flex py-2">
                                <div class="star-width">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: ${data[i].rating_avg}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="star-pro">
                                        <span>★</span>
                                        <span>★</span>
                                        <span>★</span>
                                        <span>★</span>
                                        <span>★</span>
                                    </div>
                                </div>
                                <p class="mb-0 ps-2">
                                        <b>${data[i].avg_rating}/5</b>
                                    <small><a href="${window.location.origin}/product/${data[i].slug}?GoReview">(${data[i].review_count} Reviews)</a></small>
                                </p>

                            </div>
                            </div><div class="col-sm-5 text-center">`;
                        if (data[i].discount) {
                            html +=
                                `<h6 class="mb-0 text-dark d-flex justify-content-center align-items-center flex-wrap"> <small class="text-decoration-line-through">${'$'}${data[i].price}</small>
                                                            </h6>`; //<span class="badge bg-secondary ms-2 py-2"> Save ${data[i].discount}</span>
                        }
                        html += ` <div class="category-product-price text-primary py-2 d-flex justify-content-center align-items-start">${'$'}${data[i].purchasePrice} <span class="position-relative mousuhover-out ms-2  ${data[i].extra_discount == 0 ? 'd-none' : 'd-block'}">

<span class="text-primary tooltip-hover question-icon">
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

                    <p class="mb-0">Price includes highest discount
                    </p>

            </div>
        </div>
    </div>
</div>
</span></div>`;
                        html +=
                            `<h6 class="category-shipping-text mb-0 text-dark fst-italic"> <span class="pe-2"><img src="{{ asset('images/delivery-truck.png') }}" alt="HeyBlinds Delivery Truck"></span> Free Shipping </h6></div></div>`;
                        html +=
                            `</div><div><a href="${window.location.origin}/product/${data[i].slug}?${measurement}" class="btn btn-primary custom w-100">Shop Now</a></div>`;
                        html +=
                            `<div class="mb-0 fst-italic text-center pt-2"><span class="category-guarantee-text"><span>100</span> Day</span> Risk-Free In-Home Trial <span class="position-relative mousuhover-out ms-2">
                                    <span class="text-primary tooltip-hover question-icon">
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
                                                                                We want you to be sure you’ve chosen the right blind
                                                                                in the right colour and texture.
                                                                            </p>
                                                                            <p>
                                                                                That’s why we’ll let you live with your blind for 100
                                                                                days so you can be confident you made the right choice.
                                                                            </p>
                                                                            <p>
                                                                                The best way to decide is to order a sample or two. That way,
                                                                                you can better see how they look and feel for a perfect complement
                                                                                to your room—order as many as you like. HeyBlinds will ship them all
                                                                                for free.
                                                                            </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </span></div></div></div>`

                    }
                    html += `</div>`;
                } else {
                    html = '<p class="h3 py-5 text-center"> No Product Found.. </p>'
                }
                $("#categorySearchResult").empty().append(html).delegate('.mousuhover-out', 'mouseenter', function() {
                    $('.tooltip').removeClass('show');
                    var $this = $(this).children('.tooltip');
                    $this.addClass('show');
                    var rt = ($(window).width() - ($this.offset().left + $this.outerWidth()));
                    if (rt > 1) {
                        $this.css({
                            "left": 'auto',
                            "right": '90%',
                        })
                    }
                    if ($this.offset().left < 1) {
                        $this.css({
                            "left": '90%',
                            "right": 'auto',
                        })
                    }


                });
                $('.mousuhover-out').mouseleave(function() {
                    $('.tooltip').removeClass('show');

                });
            }
        </script>
    @endpush
@endsection
