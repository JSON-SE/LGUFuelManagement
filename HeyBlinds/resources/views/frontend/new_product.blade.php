@extends('layouts.Frontend.app')
@section('title')
    {{ $helpers->seo($product->id, 'product')->title ?? $product->name . ' - HeyBlinds' }}
@endsection
@section('content')
    <form id="productDetails" enctype="multipart/form-data" action="{{ route('frontend.product.store', $product->id) }}"
        method="post">
        @csrf
        <div class="container pt-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34);"
                aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                    @if (!empty($product->category->slug))
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('frontend.category', $product->category->slug) }}">{{ $product->category->name }}</a>
                        </li>
                    @endif
                    @if (!empty($product->category->slug) && !empty($product->subCategory->slug))
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('frontend.category.sub-category', [$product->category->slug, $product->subCategory->slug]) }}">
                                {{ $product->subCategory->name }}
                            </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
            <!--product slider -->
            <div class="row pt-2 align-items-center">
                <div class="col-lg-5">
                    <div class="product-slider">
                        @if (!empty($product->slider_id))
                            @foreach (json_decode($product->slider_id) as $sliderId)
                                <div class="product-slider-image">
                                    <img src="{{ $helpers->getImage($sliderId) }}" alt="" />
                                </div>
                            @endforeach
                        @else
                            <div class="product-slider-image">
                                <img src="{{ $helpers->getImage($product->display_media_id) }}" alt="" />
                            </div>
                        @endif
                    </div>
                    <div class="row pt-2">
                        <div class="col-9 col-md-10">
                            <div class="product-slider-nav">
                                @if (!empty($product->slider_id))
                                    @foreach (json_decode($product->slider_id) as $sliderId)
                                        <div>
                                            <div class="nav-slider-image">
                                                <img src="{{ $helpers->getThumbnail($sliderId) }}" alt="" />
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div>
                                        <div class="nav-slider-image">
                                            <img src="{{ $helpers->getThumbnail($product->display_media_id) }}" alt="" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden"
                    value="{{ $isEditProduct && !empty($optionValue['total_price']) ? $optionValue['total_price'] : (!empty($finalPriceAfterDiscount) ? $helpers->withoutRounding($finalPriceAfterDiscount, 2) : 0) }}"
                    id="AddToCartValue" name="total_price">
                <input type="hidden"
                    value="{{ $isEditProduct && !empty($optionValue['unit_price']) ? $optionValue['unit_price'] : (!empty($defaultPrice) ? $helpers->withoutRounding($defaultPrice, 2) : 0) }}"
                    id="AddToCartUnitPrice" name="unit_price">
                <input type="hidden" value="{{ $defaultPrice }}" id="measurement_price" name="measurement_price">
                <div class="col-lg-7 pt-3 ps-lg-4 pt-lg-0">
                    <h1 class="product-details-text pe-5">{{ $product->name }}</h1>
                    <div class="row pt-md-3">
                        <div class="col-sm-8">
                            <div class="product-details-description">
                                <div> {!! $product->excerpt ?? '' !!} </div>
                                <a href="javascript:void(0)" class="more_click" target="_self"> More</a>
                            </div>
                            <h5 class="details-guarantee-text fst-italic pt-sm-3"><span><span>100</span> Day </span> ‘I
                                <span class="heard-icon text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                </span>
                                My Blinds’ Guarantee
                                <span class="position-relative ms-2 mousuhover-out">
                                    <span class="text-primary tooltip-hover question-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-question-circle-fill" viewBox="0 0 16 16">
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
                                                    @if (empty($product->tooltip->blind_guarantee))
                                                        <p>We want you to be sure you’ve chosen the right blind in the right
                                                            colour and texture.</p>
                                                        <p>That’s why we’ll let you live with your blind for 100 days so you
                                                            can be confident you made the right choice.</p>
                                                        <p>The best way to decide is to order a free sample or two. That
                                                            way, you can better see how they look and feel for a perfect
                                                            complement to your room—order as many as you like. HeyBlinds
                                                            will ship them all for free.</p>
                                                    @else
                                                        {!! $product->tooltip->blind_guarantee ?? '' !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </h5>

                            <h5 class="details-guarantee-text">
                                RightFit Guarantee
                                <span class="position-relative ms-1 mousuhover-out">
                                    <span class="text-primary tooltip-hover question-icon ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-question-circle-fill" viewBox="0 0 16 16">
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
                                                    @if (empty($product->tooltip->riight_fit_guarantee))
                                                        <p>Make a mistake measuring, and we’ll fix it for free. See our
                                                            HeyOK Warranties under Help for full details.</p>
                                                    @else
                                                        {!! $product->tooltip->riight_fit_guarantee ?? '' !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </h5>
                        </div>
                        <div class="col-sm-4 text-center text-left">
                            <div class="bg-light p-3 rounded product-details-price-box">
                                @if (!empty($initialDiscount))
                                    <h5 class="fw-light text-decoration-line-through" id="totalUnitPrice">
                                        ${{ $isEditProduct && !empty($optionValue['unit_price']) ? $optionValue['unit_price'] : (!empty($defaultPrice) ? $helpers->withoutRounding($defaultPrice, 2) : 0) }}
                                    </h5>
                                    <h4 class="fw-bold">You Save {{ $initialDiscount }}</h4>
                                @endif
                                <h3 class="text-primary fw-bold mb-0" id="finalPriceAfterDiscount">
                                    ${{ $isEditProduct && !empty($optionValue['total_price']) ? $optionValue['total_price'] : (!empty($finalPriceAfterDiscount) ? $helpers->withoutRounding($finalPriceAfterDiscount, 2) : 0) }}
                                </h3>
                            </div>
                            {{-- product review section --}}
                            {{-- <div class="text-end mt-4">
                            <div class="star-width d-inline-block">
                                <div class="progress">
                                     @php
                                            $rating_total_percentage =  ((100/5)*$avgOfproductReviews);
                                        @endphp
                                        <div class="progress-bar" role="progressbar" style="width: {{$rating_total_percentage}}%;" aria-valuenow="25"
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
                            <p class="mb-0">
                                @if (is_float($avgOfproductReviews))
                                    <b>{{number_format($avgOfproductReviews,1)}}/5</b>
                                @else
                                    <b>{{number_format($avgOfproductReviews)}}/5</b>
                                @endif
                                <a href="javascript:void(0)" id="view-review-scroll">({{$productReviews->count()}} reviews)</a>
                            </p>
                        </div> --}}
                        </div>
                    </div>
                    <div class="row align-items-end pt-4 text-md-start text-center">
                        <div class="col-sm-8">
                            <a href="#product-option" class="btn btn-primary custom">
                                Choose My Colour/Get My Free Samples
                            </a>
                        </div>
                        <div class="col-sm-4 pt-2 pt-ms-0 text-md-end text-center">
                            <h4 class="product-details-shipping-text fw-bold mb-0">
                                <span class="pe-2">
                                    <img src="{{ asset('images/delivery-truck.png') }}"
                                        alt="Hey Blindes Delivery Truck" />
                                </span>
                                Free Shipping
                            </h4>

                            <h5 class="details-guarantee-text mb-0">
                                Delivery Time
                                <span class="position-relative ms-1 mousuhover-out">
                                    <span class="text-primary tooltip-hover question-icon ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-question-circle-fill" viewBox="0 0 16 16">
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
                                                    {{-- {!! $helpers->getSettings('delivery_time_tooltip') ?? ""  !!} --}}
                                                    @if (!empty($product->tooltip->devlivery_time))
                                                        {!! $product->tooltip->devlivery_time !!}
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-3" />
            <div id="product-option">
                <div class="accordion">
                    @if (!empty($product->colors->toArray()))
                        <div class="accordion-item ">
                            <h2 class="accordion-header mt-3" id="headingOne">
                                <button class="accordion-button accordion-button-collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    <span class="d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('images/tick.png') }}" alt="" />
                                    </span> Select Colour
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show border-0"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body py-2">
                                    <h6 class="accodin-heading">For a true colour comparison, please order a free sample
                                        <span class="position-relative mousuhover-out">
                                            <span class="text-primary tooltip-hover question-icon px-2">
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

                                                        <div class="col-sm-12">
                                                            Order Free Samples to make sure you get the colour and texture
                                                            exactly right, and to be covered by our 100 Day 'I Love My
                                                            Blinds' Guarantee.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                    </h6>
                                    <hr class="my-2" />
                                    <div class="color-section row pb-2 flex-md-row-reverse">
                                        <div class="col-md-8 select-colour-items">
                                            <div class="select-colour d-flex flex-wrap">
                                                @if (!empty($product->colors->toArray()))
                                                    @foreach ($product->colors as $colorKey => $color)
                                                        @if (!empty($color->color->is_enable) && $color->color->is_enable == 1)
                                                            @if ($loop->first)
                                                                @php $optionArrayForJs["radio"][] = "option_color" @endphp
                                                            @endif
                                                            <div class="sample-color-box text-center shadow-sm">
                                                                <div class="radio check-position">
                                                                    <input id="sample-color-{{ $colorKey }}"
                                                                        name="option_color" type="radio"
                                                                        value="{{ $color->id }}"
                                                                        data-value="{{ $color->color->name }}"
                                                                        data-type="{{ $color->color->name }}"
                                                                        data-id="{{ $color->id }}"
                                                                        data-option="product-color"
                                                                        {{ $isEditProduct && (int) $optionValue['option_color'] == (int) $color->id && array_key_exists('option_color', $optionValue) ? 'checked' : '' }}>
                                                                    <label for="sample-color-{{ $colorKey }}"
                                                                        href="{{ $helpers->getThumbnail($color->color->color_image_id) }}"
                                                                        src="{{ $helpers->getImage($color->color->feature_image_id) }}"
                                                                        value="{{ $color->color->name }}"
                                                                        class="radio-label colorchange">
                                                                        <div class="sample-color-img rounded">
                                                                            <img class="rounded"
                                                                                src="{{ $helpers->getThumbnail($color->color->color_image_id) }}"
                                                                                alt="" />
                                                                        </div>
                                                                        <p class="my-1">{{ $color->color->name }}
                                                                        </p>
                                                                    </label>
                                                                </div>
                                                                @if ($color->color->out_of_stock == 1)
                                                                    <button type="button"
                                                                        class="btn btn-sm cart-sample-select-button out-of-stock">
                                                                        😞 Sample temporarily out of stock
                                                                    </button>
                                                                @else
                                                                    @php
                                                                        $sample = $helpers->selectedSamapleCart($product->id ?? 0, $_COOKIE['__sb_sample_cart'] ?? '', $color->color->id ?? 0) ?? false;
                                                                    @endphp
                                                                    <button type="button"
                                                                        class="btn btn-sm cart-sample-select-button  {{ $sample == true ? 'selected btn-primary' : 'btn-outline-primary' }}"
                                                                        {{ $sample == true ? 'selected' : '' }}
                                                                        data-pid="{{ $product->id }}"
                                                                        value="{{ $color->color->id }}"
                                                                        data-id="{{ $color->color->id }}">
                                                                        {{ $sample == true ? 'Sample Selected' : 'Free Sample' }}
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 color-sidedar-fixd pt-3 pt-md-0">
                                            <div class="color-sidedar rounded bg-light p-3">
                                                <div class="color-sidedar-big-image shadow-sm rounded">
                                                    <img class="select-color-big-show rounded"
                                                        src="{{ $helpers->getImage($editProductColor->color->feature_image_id ?? 0) }}"
                                                        alt="" />
                                                </div>
                                                <div class="row g-3 pt-3">
                                                    <div class="col-6">
                                                        <div class="color-sidedar-small-image shadow-sm rounded">
                                                            <img class="rounded select-color-small-show"
                                                                src="{{ $helpers->getImage($editProductColor->color->color_image_id ?? 0) }}"
                                                                alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="select-color-text">
                                                            <span> Select your colour </span><br />
                                                            <b>Need to Select</b>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- Headrail section --}}
                    <div class="accordion-item mt-3">
                        <div class="accordion-header" id="headingTwo">
                            <button class="accordion-button fw-semibold accordion-button-collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                Select Your Options
                                <span class="d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('images/tick.png') }}" alt="">
                                </span>
                            </button>

                        </div>
                        <div id="collapseTwo" class="accordion-collapse collapse show border-0"
                            aria-labelledby="headingTwo" data-bs-parent="#accordionPremium">
                            <div class="accordion-body">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <h6 class="accodin-heading"> Headrail
                                            <span class="position-relative ms-1 mousuhover-out">
                                                <span class="text-primary tooltip-hover question-icon ">
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
                                                                Most customers prefer to mount their blinds inside the
                                                                window frame. It gives a neater, more tailored look,
                                                                without covering any details of the window or the
                                                                surrounding decorative moulding.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </h6>

                                    </div>

                                    <div class="col-md-7 mt-1 mt-md-0">
                                        <div class="form-floating">
                                            <select class="form-select" id="premium-floating-headrail"
                                                aria-label="Floating label select example">
                                                <option value="0">Standard</option>
                                                <option value="1">2 Shades on 1 Headrail</option>
                                            </select>
                                            <label for="premium">Click to Choose Headrail</label>
                                            <span
                                                class="headrail-price bg-primary text-white rounded position-absolute top-50 end-0 me-5 translate-middle-y py-1 px-2">+
                                                $124.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div id="premium-floating-headrail-option" class="cart-box p-4 rounded mt-3">
                                    <p class="mb-1">Split Headrail Options</p>
                                    <hr class="my-0" />
                                    <div class="row py-3">
                                        <div class="col-lg-6 pe-lg-4">
                                            <div class="row g-2 align-items-end">
                                                <div class="col-12 fw-semibold  font-secondary">Left Shades</div>

                                                <div class="col-md-auto">
                                                    <h5 class="border-start border-primary border-4 px-2 label-aria-text">
                                                        Width:</h5>
                                                </div>

                                                <div class="col">
                                                    <div class="form-floating width-select-fild">
                                                        <select class="form-select bg-transparent" name="filter_width"
                                                            id="filter_width" aria-label="Floating label select example">
                                                            <option value="">00</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                        </select>
                                                        <label for="floatingSelectGrid">Inches</label>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-floating width-select-fild">
                                                        <select class="form-select bg-transparent"
                                                            name="width_fraction_val" id="filter_width_fraction"
                                                            aria-label="Floating label select example">
                                                            <option value="">0/0</option>
                                                            <option value="1/8">1/8</option>
                                                            <option value="1/4">1/4</option>
                                                            <option value="3/8">3/8</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="5/8">5/8</option>
                                                            <option value="3/4">3/4 </option>
                                                            <option value="7/8">7/8 </option>
                                                        </select>
                                                        <label for="floatingSelectGrid">Fractions</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row g-2 align-items-end mt-2">
                                                <div class="col-md-auto">
                                                    <h5 class="border-start border-primary border-4 px-2 label-aria-text">
                                                        Lift Position:</h5>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating width-select-fild">
                                                        <select class="form-select bg-transparent" name="filter_width"
                                                            id="filter_width" aria-label="Floating label select example">
                                                            <option value="" selected>Left</option>
                                                            <option value="1">Right</option>

                                                        </select>
                                                        <label for="floatingSelectGrid">Position</label>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <div class="d-block d-lg-none">
                                            <hr />
                                        </div>
                                        <div class="col-lg-6 ps-lg-4 mt-lg-0">
                                            <div class="row g-2 align-items-end">
                                                <div class="col-12 fw-semibold font-secondary">Right shades</div>

                                                <div class="col-md-auto">
                                                    <h5 class="border-start border-primary border-4 px-2 label-aria-text">
                                                        Width:</h5>
                                                </div>

                                                <div class="col">
                                                    <div class="form-floating width-select-fild">
                                                        <select class="form-select bg-transparent" name="filter_height"
                                                            id="filter_height" aria-label="Floating label select example">
                                                            <option value="">00</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>

                                                        </select>
                                                        <label for="floatingSelectGrid">Inches</label>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-floating width-select-fild">
                                                        <select class="form-select bg-transparent"
                                                            id="filter_height_fraction" name="filter_height_fraction"
                                                            aria-label="Floating label select example">
                                                            <option value="">0/0</option>
                                                            <option value="1/8">1/8</option>
                                                            <option value="1/4">1/4</option>
                                                            <option value="3/8">3/8</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="5/8">5/8</option>
                                                            <option value="3/4">3/4 </option>
                                                            <option value="7/8">7/8 </option>
                                                        </select>
                                                        <label for="floatingSelectGrid">Fractions</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row g-2 align-items-end mt-2">
                                                <div class="col-md-auto">
                                                    <h5 class="border-start border-primary border-4 px-2 label-aria-text">
                                                        Lift Position:</h5>
                                                </div>

                                                <div class="col">
                                                    <div class="form-floating width-select-fild">
                                                        <select class="form-select bg-transparent" name="filter_width"
                                                            id="filter_width" aria-label="Floating label select example">
                                                            <option value="">Left</option>
                                                            <option value="1" selected>Right</option>

                                                        </select>
                                                        <label for="floatingSelectGrid">Position</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- Headrail section end --}}

                    @php
                        $dupHeadlines = [];
                    @endphp
                    @foreach ($groupHeadings as $fKey => $groupHeading)
                        <div class="accordion-item ">
                            @foreach ($groupHeading->option as $opt)
                                @if (!empty($opt->productOption) && $helpers->CheckOptionActive($product->id, $opt->id) == true && !in_array($groupHeading->group_heading, $dupHeadlines))
                                    @php
                                        $dupHeadlines[] = $groupHeading->group_heading ?? [];
                                    @endphp
                                    <h2 class="accordion-header mt-3" id="heading{{ $fKey }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $fKey }}" aria-expanded="true"
                                            aria-controls="collapse{{ $fKey }}">
                                            <span class="d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('images/tick.png') }}" alt="">
                                            </span>
                                            <div>{{ $groupHeading->group_heading }}</div>
                                        </button>
                                    </h2>
                                @endif
                            @endforeach
                            <div id="collapse{{ $fKey }}" class="accordion-collapse collapse border-0 show"
                                aria-labelledby="heading{{ $fKey }}">
                                <div class="accordion-body py-0 ">
                                    @if (!empty($allGroups))
                                        @php
                                            $groupName = [];
                                        @endphp
                                        @foreach ($allGroups as $groups)
                                            @foreach ($groups as $group)
                                                @if (!empty($group->group_heading) && strtolower(Illuminate\Support\Str::slug($groupHeading->group_heading)) === strtolower(Illuminate\Support\Str::slug($group->group_heading)))
                                                    @foreach ($group->option as $option)
                                                        @if (!in_array($group->name, $groupName) && !empty($group->show_group_name) && $helpers->CheckOptionActive($product->id, $option->id) == true && $option->is_active == 1 && $group->show_group_name == true && !empty($group->option) && $option->option_type !== 'text' && $option->option_type !== 'quantity')
                                                            @php
                                                                $groupName[] = $group->name ?? '';
                                                            @endphp
                                                            <h6 class="accodin-heading pt-4 pb-2">{{ $group->name }}
                                                                @if (!empty($group->content))
                                                                    <span class="position-relative mousuhover-out">
                                                                        <span
                                                                            class="text-primary tooltip-hover question-icon px-2">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16" fill="currentColor"
                                                                                class="bi bi-question-circle-fill"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                                </path>
                                                                            </svg>
                                                                        </span>
                                                                        <div class="tooltip shadow">
                                                                            <div class="tooltip-arrow"></div>
                                                                            <span
                                                                                class="close-tooltip btn-close btn"></span>
                                                                            <div class="tooltip-inner">
                                                                                <div class="row g-2">
                                                                                    <div class="col-sm-12">
                                                                                        {!! $group->content ?? '' !!}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                                @endif
                                                            </h6>
                                                            <hr class="my-2">
                                                        @endif
                                                    @endforeach
                                                    <div class="d-flex flex-wrap {{ $group->slug }}"
                                                        data-name="group_{{ Illuminate\Support\Str::slug($group->name, '_') }}"
                                                        data-slug="{{ $group->slug }}" data-type="{{ $group->name }}"
                                                        data-id="{{ $group->id }}"
                                                        data-option="{{ "group:$group->id" }}">
                                                        @foreach ($group->option as $option)
                                                            @if ($helpers->CheckOptionActive($product->id, $option->id) == true && $option->is_active == true)
                                                                @php
                                                                    $optionArrayForJs[$option->option_type ?? ''][] = 'option_' . Illuminate\Support\Str::slug($group->name ?? '', '_');
                                                                    $minAndMaxCheck = $product->getMinAndMax($product->id, $option->id) ?? 0;
                                                                    if (!empty($minAndMaxCheck)) {
                                                                        $splitWidth = explode('-', $minAndMaxCheck['width']);
                                                                    } else {
                                                                        $splitWidth = explode('-', $width ?? 0);
                                                                    }
                                                                @endphp
                                                                @php
                                                                    $optionName = 'option_' . Illuminate\Support\Str::slug($group->name ?? '', '_');
                                                                    if (!empty($isEditProduct)) {
                                                                        $cartOptionName = !empty($optionValue[$optionName]) ? $optionValue[$optionName] : '';
                                                                    }
                                                                @endphp
                                                                @if ($option->option_type === 'width')
                                                                    @php
                                                                        $optionArrayForJs['select'][] = 'option_width';
                                                                    @endphp
                                                                    <div class="col-lg-5 col-md-6 pb-2 pb-md-0">
                                                                        <div class="row pt-2">
                                                                            <div class="col-sm-6 col-lg-5">
                                                                                <div class="width-graphic-image">
                                                                                    <img class=""
                                                                                        src="{{ $helpers->getThumbnail($option->media_id) }}"
                                                                                        alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-6 pt-3 pt-sm-0 pb-2 pb-sm-0 col-lg-6">
                                                                                <div class="row g-2 align-items-end">
                                                                                    <div class="col-12">
                                                                                        <h5
                                                                                            class="border-start border-primary border-4 px-2 label-aria-text">
                                                                                            Width:
                                                                                            @if (!empty($option->tooltip_media_id) || !empty($option->content))
                                                                                                <span
                                                                                                    class="position-relative mousuhover-out">
                                                                                                    <span
                                                                                                        class="text-primary tooltip-hover question-icon px-2">
                                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                            width="16"
                                                                                                            height="16"
                                                                                                            fill="currentColor"
                                                                                                            class="bi bi-question-circle-fill"
                                                                                                            viewBox="0 0 16 16">
                                                                                                            <path
                                                                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                                                            </path>
                                                                                                        </svg>
                                                                                                    </span>
                                                                                                    <div
                                                                                                        class="tooltip shadow">
                                                                                                        <div
                                                                                                            class="tooltip-arrow">
                                                                                                        </div>
                                                                                                        <span
                                                                                                            class="close-tooltip btn-close btn"></span>
                                                                                                        <div
                                                                                                            class="tooltip-inner">
                                                                                                            <div
                                                                                                                class="row g-2">

                                                                                                                @if (!empty($option->tooltip_media_id))
                                                                                                                    <div
                                                                                                                        class="col-12">
                                                                                                                        <img class="w-100 rounded img-fluid"
                                                                                                                            src="{{ $helpers->getImage($option->tooltip_media_id) }}"
                                                                                                                            alt="">
                                                                                                                    </div>
                                                                                                                @endif

                                                                                                                <div
                                                                                                                    class="col-sm-12">
                                                                                                                    @if (!empty($option->content))
                                                                                                                        {!! $option->content ?? '' !!}
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </span>
                                                                                            @endif
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div
                                                                                            class="form-floating width-select-fild">
                                                                                            <select
                                                                                                class="form-select product-width"
                                                                                                name="option_width"
                                                                                                data-type="{{ $option->name }}"
                                                                                                data-group="{{ Illuminate\Support\Str::slug($group->name) }}"
                                                                                                data-slug="{{ $option->slug }}"
                                                                                                data-value="{{ $product->default_width }}"
                                                                                                data-id="{{ $option->id }}"
                                                                                                data-option="product-width">
                                                                                                @for ($w = $splitWidth[0]; $w <= $splitWidth[1]; $w++)
                                                                                                    <option
                                                                                                        value="{{ $w }}"
                                                                                                        {{ ($isEditProduct && (int) (!empty($getWidth) && $getWidth >= $splitWidth[0] ? (int) $getWidth : (int) $optionValue['option_width']) == $w && array_key_exists('option_width', $optionValue) ? 'checked' : '') ? 'selected' : ((!empty($getWidth) && $getWidth >= $splitWidth[0] ? (int) $getWidth : $defaultWidth) == $w ? 'selected' : '') }}>
                                                                                                        {{ $w }}
                                                                                                    </option>
                                                                                                @endfor
                                                                                            </select>
                                                                                            <label
                                                                                                for="floatingSelectGrid">Inches</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div
                                                                                            class="form-floating width-select-fild">
                                                                                            <select
                                                                                                class="form-select product-width-fractions"
                                                                                                name="option_width_fraction"
                                                                                                data-group="{{ Illuminate\Support\Str::slug($group->name) }}"
                                                                                                data-type="width-fractions"
                                                                                                data-slug="{{ $option->slug }}"
                                                                                                data-id="{{ $option->id }}"
                                                                                                data-option="option:{{ $option->id }}">
                                                                                                <option value="">0/0
                                                                                                </option>
                                                                                                <option value="1/8"
                                                                                                    {{ $isEditProduct && $optionValue['option_width_fraction'] == '1/8' && array_key_exists('option_width_fraction', $optionValue) ? 'selected' : ($width_fraction_val == '1/8' ? 'selected' : '') }}>
                                                                                                    1/8</option>
                                                                                                <option value="1/4"
                                                                                                    {{ $isEditProduct && $optionValue['option_width_fraction'] == '1/4' && array_key_exists('option_width_fraction', $optionValue) ? 'selected' : ($width_fraction_val == '1/4' ? 'selected' : '') }}>
                                                                                                    1/4</option>
                                                                                                <option value="3/8"
                                                                                                    {{ $isEditProduct && $optionValue['option_width_fraction'] == '3/8' && array_key_exists('option_width_fraction', $optionValue) ? 'selected' : ($width_fraction_val == '3/8' ? 'selected' : '') }}>
                                                                                                    3/8</option>
                                                                                                <option value="1/2"
                                                                                                    {{ $isEditProduct && $optionValue['option_width_fraction'] == '1/2' && array_key_exists('option_width_fraction', $optionValue) ? 'selected' : ($width_fraction_val == '1/2' ? 'selected' : '') }}>
                                                                                                    1/2</option>
                                                                                                <option value="5/8"
                                                                                                    {{ $isEditProduct && $optionValue['option_width_fraction'] == '5/8' && array_key_exists('option_width_fraction', $optionValue) ? 'selected' : ($width_fraction_val == '5/8' ? 'selected' : '') }}>
                                                                                                    5/8</option>
                                                                                                <option value="3/4"
                                                                                                    {{ $isEditProduct && $optionValue['option_width_fraction'] == '3/4' && array_key_exists('option_width_fraction', $optionValue) ? 'selected' : ($width_fraction_val == '3/4' ? 'selected' : '') }}>
                                                                                                    3/4 </option>
                                                                                                <option value="7/8"
                                                                                                    {{ $isEditProduct && $optionValue['option_width_fraction'] == '7/8' && array_key_exists('option_width_fraction', $optionValue) ? 'selected' : ($width_fraction_val == '7/8' ? 'selected' : '') }}>
                                                                                                    7/8 </option>

                                                                                            </select>
                                                                                            <label
                                                                                                for="floatingSelectGrid">Fractions</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($option->option_type === 'height')
                                                                    @php
                                                                        $optionArrayForJs['select'][] = 'option_height';
                                                                    @endphp
                                                                    <div class="col-lg-1 d-none d-lg-block"></div>
                                                                    <div class="col-lg-5 col-md-6">
                                                                        <div class="row pt-2">
                                                                            <div class="col-sm-6 col-lg-5">
                                                                                <div class="width-graphic-image">
                                                                                    <img src="{{ $helpers->getThumbnail($option->media_id) }}"
                                                                                        alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-6 pt-3 pt-sm-0 pb-2 pb-sm-0 col-lg-6">
                                                                                <div class="row g-2 align-items-end">
                                                                                    <div class="col-12">
                                                                                        <h5
                                                                                            class="border-start border-primary border-4 px-2 label-aria-text">
                                                                                            Height:
                                                                                            @if (!empty($option->tooltip_media_id) || !empty($option->content))
                                                                                                <span
                                                                                                    class="position-relative mousuhover-out">
                                                                                                    <span
                                                                                                        class="text-primary tooltip-hover question-icon px-2">
                                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                            width="16"
                                                                                                            height="16"
                                                                                                            fill="currentColor"
                                                                                                            class="bi bi-question-circle-fill"
                                                                                                            viewBox="0 0 16 16">
                                                                                                            <path
                                                                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                                                            </path>
                                                                                                        </svg>
                                                                                                    </span>
                                                                                                    <div
                                                                                                        class="tooltip shadow">
                                                                                                        <div
                                                                                                            class="tooltip-arrow">
                                                                                                        </div>
                                                                                                        <span
                                                                                                            class="close-tooltip btn-close btn"></span>
                                                                                                        <div
                                                                                                            class="tooltip-inner">
                                                                                                            <div
                                                                                                                class="row g-2">

                                                                                                                @if (!empty($option->tooltip_media_id))
                                                                                                                    <div
                                                                                                                        class="col-12">
                                                                                                                        <img class="w-100 rounded img-fluid"
                                                                                                                            src="{{ $helpers->getImage($option->tooltip_media_id) }}"
                                                                                                                            alt="">
                                                                                                                    </div>
                                                                                                                @endif

                                                                                                                <div
                                                                                                                    class="col-sm-12">
                                                                                                                    @if (!empty($option->content))
                                                                                                                        @php echo $option->content ?? ""; @endphp

                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </span>
                                                                                            @endif
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div
                                                                                            class="form-floating width-select-fild">
                                                                                            <select
                                                                                                class="form-select product-height"
                                                                                                name="option_height"
                                                                                                data-group="{{ Illuminate\Support\Str::slug($group->name) }}"
                                                                                                data-type="{{ $option->name }}"
                                                                                                data-id="{{ $option->id }}"
                                                                                                data-option="option:{{ $option->id }}">
                                                                                                @for ($h = $splitWidth[0]; $h < $splitWidth[1] + 1; $h++)
                                                                                                    <option
                                                                                                        value="{{ $h }}"
                                                                                                        {{ ($isEditProduct && (int) (!empty($getHeight) && $getHeight >= $splitWidth[0] ? (int) $getHeight : (int) $optionValue['option_height']) == $h && array_key_exists('option_height', $optionValue) ? 'checked' : '') ? 'selected' : ((!empty($getHeight) && $getHeight >= $splitWidth[0] ? (int) $getHeight : $defaultHeight) == $h ? 'selected' : '') }}>
                                                                                                        {{ $h }}
                                                                                                    </option>
                                                                                                @endfor
                                                                                            </select>
                                                                                            <label
                                                                                                for="floatingSelectGrid">Inches</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div
                                                                                            class="form-floating width-select-fild">
                                                                                            <select
                                                                                                class="form-select product-height-fractions"
                                                                                                name="option_height_fraction"
                                                                                                data-group="{{ Illuminate\Support\Str::slug($group->name) }}"
                                                                                                data-type="height-fractions"
                                                                                                data-id="{{ $option->id }}"
                                                                                                data-option="option:{{ $option->id }}">
                                                                                                <option value="">0/0
                                                                                                </option>
                                                                                                <option value="1/8"
                                                                                                    {{ $isEditProduct && $optionValue['option_height_fraction'] == '1/8' && array_key_exists('option_height_fraction', $optionValue) ? 'selected' : ($filter_height_fraction == '1/8' ? 'selected' : '') }}>
                                                                                                    1/8</option>
                                                                                                <option value="1/4"
                                                                                                    {{ $isEditProduct && $optionValue['option_height_fraction'] == '1/4' && array_key_exists('option_height_fraction', $optionValue) ? 'selected' : ($filter_height_fraction == '1/4' ? 'selected' : '') }}>
                                                                                                    1/4</option>
                                                                                                <option value="3/8"
                                                                                                    {{ $isEditProduct && $optionValue['option_height_fraction'] == '3/8' && array_key_exists('option_height_fraction', $optionValue) ? 'selected' : ($filter_height_fraction == '3/8' ? 'selected' : '') }}>
                                                                                                    3/8</option>
                                                                                                <option value="1/2"
                                                                                                    {{ $isEditProduct && $optionValue['option_height_fraction'] == '1/2' && array_key_exists('option_height_fraction', $optionValue) ? 'selected' : ($filter_height_fraction == '1/2' ? 'selected' : '') }}>
                                                                                                    1/2</option>
                                                                                                <option value="5/8"
                                                                                                    {{ $isEditProduct && $optionValue['option_height_fraction'] == '5/8' && array_key_exists('option_height_fraction', $optionValue) ? 'selected' : ($filter_height_fraction == '5/8' ? 'selected' : '') }}>
                                                                                                    5/8</option>
                                                                                                <option value="3/4"
                                                                                                    {{ $isEditProduct && $optionValue['option_height_fraction'] == '3/4' && array_key_exists('option_height_fraction', $optionValue) ? 'selected' : ($filter_height_fraction == '3/4' ? 'selected' : '') }}>
                                                                                                    3/4 </option>
                                                                                                <option value="7/8"
                                                                                                    {{ $isEditProduct && $optionValue['option_height_fraction'] == '7/8' && array_key_exists('option_height_fraction', $optionValue) ? 'selected' : ($filter_height_fraction == '7/8' ? 'selected' : '') }}>
                                                                                                    7/8 </option>
                                                                                            </select>
                                                                                            <label
                                                                                                for="floatingSelectGrid">Fractions</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($option->option_type === 'number')
                                                                    <div class="col-lg-6">
                                                                        <h6 class="accodin-heading pt-3">
                                                                            {{ $group->name }}
                                                                            <span class="position-relative">
                                                                                @if (!empty($option->tooltip_media_id) || !empty($option->content))
                                                                                    <span
                                                                                        class="position-relative mousuhover-out">
                                                                                        <span
                                                                                            class="text-primary tooltip-hover question-icon px-2">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                width="16" height="16"
                                                                                                fill="currentColor"
                                                                                                class="bi bi-question-circle-fill"
                                                                                                viewBox="0 0 16 16">
                                                                                                <path
                                                                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                                                </path>
                                                                                            </svg>
                                                                                        </span>
                                                                                        <div class="tooltip shadow">
                                                                                            <div class="tooltip-arrow">
                                                                                            </div>
                                                                                            <span
                                                                                                class="close-tooltip btn-close btn"></span>
                                                                                            <div class="tooltip-inner">
                                                                                                <div
                                                                                                    class="row g-2">

                                                                                                    @if (!empty($option->tooltip_media_id))
                                                                                                        <div
                                                                                                            class="col-12">
                                                                                                            <img class="w-100 rounded img-fluid"
                                                                                                                src="{{ $helpers->getImage($option->tooltip_media_id) }}"
                                                                                                                alt="">
                                                                                                        </div>
                                                                                                    @endif


                                                                                                    <div
                                                                                                        class="col-sm-12">
                                                                                                        @if (!empty($option->content))
                                                                                                            {!! $option->content ?? '' !!}
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </span>
                                                                                @endif
                                                                        </h6>
                                                                        <hr class="my-2">
                                                                        <div class="row pt-2">
                                                                            <div class="col-lg-6">
                                                                                <div class="quantity">
                                                                                    <input class="count form-control pe-5"
                                                                                        type="number"
                                                                                        value="{{ !empty($isEditProduct) && !empty($cartOptionName) && array_key_exists($optionName, $optionValue) }}"
                                                                                        min="1" max="100"
                                                                                        data-group="{{ Illuminate\Support\Str::slug($group->name) }}"
                                                                                        name="{{ $optionName }}"
                                                                                        data-type="{{ $option->name }}"
                                                                                        data-slug="{{ $option->slug }}"
                                                                                        data-id="{{ $option->id }}"
                                                                                        data-option="{{ !empty($option->price->toArray()) ? "option:$option->id" : '' }}">
                                                                                    <button type="button" id="add"
                                                                                        class="add">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="16" height="16"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-caret-up-fill"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </button>
                                                                                    <button type="button" id="sub"
                                                                                        class="sub">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="16" height="16"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-caret-down-fill"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($option->option_type === 'quantity')
                                                                    <div class="col-sm-6">
                                                                        <h6 class="accodin-heading pt-3">
                                                                            {{ $group->name }}
                                                                            @if (!empty($option->tooltip_media_id) || !empty($option->content))
                                                                                <span
                                                                                    class="position-relative mousuhover-out">
                                                                                    <span
                                                                                        class="text-primary tooltip-hover question-icon px-2">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="16" height="16"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-question-circle-fill"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </span>
                                                                                    <div class="tooltip shadow">
                                                                                        <div class="tooltip-arrow"></div>
                                                                                        <span
                                                                                            class="close-tooltip btn-close btn"></span>
                                                                                        <div class="tooltip-inner">
                                                                                            <div class="row g-2">
                                                                                                @if (!empty($option->tooltip_media_id))
                                                                                                    <div
                                                                                                        class="col-12">
                                                                                                        <img class="w-100 rounded img-fluid"
                                                                                                            src="{{ $helpers->getImage($option->tooltip_media_id) }}"
                                                                                                            alt="">
                                                                                                    </div>
                                                                                                @endif

                                                                                                <div
                                                                                                    class="col-sm-12">
                                                                                                    @if (!empty($option->content))
                                                                                                        {!! $option->content ?? '' !!}}
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </span>
                                                                            @endif
                                                                        </h6>
                                                                        <hr class="my-2">
                                                                        <div class="row pt-2">
                                                                            <div class="col-lg-6">
                                                                                <div class="quantity">
                                                                                    <input class="count form-control pe-5"
                                                                                        name="product_quantity"
                                                                                        data-group="{{ Illuminate\Support\Str::slug($group->name) }}"
                                                                                        type="text" id="product_quantity"
                                                                                        value="{{ $isEditProduct && !empty($cartOptionName) && array_key_exists($optionName, $optionValue) ? $cartOptionName : 1 }}"
                                                                                        min="1" max="100">
                                                                                    <button type="button" id="add"
                                                                                        class="add">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="16" height="16"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-caret-up-fill"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </button>
                                                                                    <button type="button" id="sub"
                                                                                        class="sub">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="16" height="16"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-caret-down-fill"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($option->option_type === 'text')
                                                                    <div class="col-lg-6">
                                                                        <h6 class="accodin-heading pt-3">
                                                                            {{ $group->name }}
                                                                            @if (!empty($option->tooltip_media_id) || !empty($option->content))
                                                                                <span
                                                                                    class="position-relative mousuhover-out">
                                                                                    <span
                                                                                        class="text-primary tooltip-hover question-icon px-2">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="16" height="16"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-question-circle-fill"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </span>
                                                                                    <div class="tooltip shadow">
                                                                                        <div class="tooltip-arrow"></div>
                                                                                        <span
                                                                                            class="close-tooltip btn-close btn"></span>
                                                                                        <div class="tooltip-inner">
                                                                                            <div class="row g-2">

                                                                                                @if (!empty($option->tooltip_media_id))
                                                                                                    <div
                                                                                                        class="col-12">
                                                                                                        <img class="w-100 rounded img-fluid"
                                                                                                            src="{{ $helpers->getImage($option->tooltip_media_id) }}"
                                                                                                            alt="" />
                                                                                                    </div>
                                                                                                @endif
                                                                                                <div
                                                                                                    class="col-sm-12">
                                                                                                    @if (!empty($option->content))
                                                                                                        {!! $option->content ?? '' !!}
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </span>
                                                                            @endif
                                                                        </h6>
                                                                        <hr class="my-2">
                                                                        <div class="row pt-2">
                                                                            <div class="col-lg-6">
                                                                                <input class="form-control"
                                                                                    type="{{ $option->option_type }}"
                                                                                    placeholder="{{ $option->name }}"
                                                                                    data-group="{{ Illuminate\Support\Str::slug($group->name) }}"
                                                                                    data-slug="{{ $option->slug }}"
                                                                                    name="{{ $optionName }}"
                                                                                    data-type="{{ $option->name }}"
                                                                                    data-id="{{ $option->id }}"
                                                                                    data-option="{{ !empty($option->price->toArray()) ? "option:$option->id" : '' }}"
                                                                                    value="{{ $isEditProduct && !empty($cartOptionName) && array_key_exists($optionName, $optionValue) ? $cartOptionName : '' }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($option->option_type === 'radio' || $option->option_type === 'checkbox')
                                                                    @php
                                                                        $splitMinAndMax = $product->getMinAndMax($product->id, $option->id ?? 0);
                                                                        $defaultWidthSplit = $product->default_width;
                                                                        if (!empty($splitMinAndMax)) {
                                                                            $splitSize = explode('-', $splitMinAndMax['width']);
                                                                        } else {
                                                                            $splitSize = '';
                                                                        }
                                                                    @endphp
                                                                    <div class="sample-side-box border m-2">
                                                                        <div class="rounded  p-2">
                                                                            <div class="radio m-0 check-position">
                                                                                <input
                                                                                    id="sample-side-{{ $option->id }}"
                                                                                    value="{{ $option->id }}"
                                                                                    name="{{ $optionName }}"
                                                                                    data-group="{{ Illuminate\Support\Str::slug($group->name) }}"
                                                                                    data-slug="{{ $option->slug }}"
                                                                                    type="{{ $option->option_type }}"
                                                                                    data-type="{{ $option->name }}"
                                                                                    data-id="{{ $option->id }}"
                                                                                    data-option="{{ !empty($option->price->toArray()) ? "option:$option->id" : '' }}"
                                                                                    {{ !empty($splitSize[0]) && !empty($splitSize[1]) && ((int) $defaultWidthSplit < (int) $splitSize[0] && (int) $defaultWidthSplit < (int) $splitSize[1]) ? 'disabled' : '' }}
                                                                                    {{ $isEditProduct && !empty($cartOptionName) && $cartOptionName == $option->id && array_key_exists($optionName, $optionValue) ? 'checked' : '' }}
                                                                                    {{ @$option->is_always_included ? 'checked' : '' }}>

                                                                                <label
                                                                                    for="sample-side-{{ $option->id }}"
                                                                                    class="radio-label"
                                                                                    {{ !empty($splitSize[0]) && !empty($splitSize[1]) && ((int) $defaultWidthSplit < (int) $splitSize[0] && (int) $defaultWidthSplit < (int) $splitSize[1]) ? 'style=opacity:0.3' : '' }}>
                                                                                    <div
                                                                                        class="sample-features-img rounded">
                                                                                        <img class="rounded"
                                                                                            src="{{ $helpers->getThumbnail($option->media_id) }}"
                                                                                            alt="">
                                                                                    </div>
                                                                                    <div class="mt-2 mb-0 d-flex">
                                                                                        <span
                                                                                            class="h6 fw-bold">{{ $option->name }}</span>
                                                                                        @if (!empty($option->tooltip_media_id) || !empty($option->content))
                                                                                            <span
                                                                                                class="position-relative mousuhover-out">
                                                                                                <span
                                                                                                    class="text-primary tooltip-hover question-icon px-2">
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="16"
                                                                                                        height="16"
                                                                                                        fill="currentColor"
                                                                                                        class="bi bi-question-circle-fill"
                                                                                                        viewBox="0 0 16 16">
                                                                                                        <path
                                                                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                                                        </path>
                                                                                                    </svg>
                                                                                                </span>
                                                                                                <div
                                                                                                    class="tooltip shadow">
                                                                                                    <div
                                                                                                        class="tooltip-arrow">
                                                                                                    </div>
                                                                                                    <span
                                                                                                        class="close-tooltip btn-close btn"></span>
                                                                                                    <div
                                                                                                        class="tooltip-inner">
                                                                                                        <div
                                                                                                            class="row g-2">
                                                                                                            @if (!empty($option->tooltip_media_id))
                                                                                                                <div
                                                                                                                    class="col-12">
                                                                                                                    <img class="w-100 rounded img-fluid"
                                                                                                                        src="{{ $helpers->getImage($option->tooltip_media_id) }}"
                                                                                                                        alt="">
                                                                                                                </div>
                                                                                                            @endif
                                                                                                            <div
                                                                                                                class="col-sm-12">
                                                                                                                @if (!empty($option->content))
                                                                                                                    @php echo $option->content ?? ""; @endphp

                                                                                                                @endif
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </span>
                                                                                        @endif
                                                                                        @if (empty($option->price->toArray()))
                                                                                            <br>
                                                                                            <span>Free</span>
                                                                                        @endif
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                            <div>
                                                                                @if (!empty($option->subOption->toArray()))
                                                                                    @php $subOptionNew = []; @endphp
                                                                                    @foreach ($option->subOption as $subOptions)
                                                                                        @php
                                                                                            $subOptionNew[Illuminate\Support\Str::slug($subOptions->sub_group_id)][$subOptions->sub_option_type][] = $subOptions ?? [];
                                                                                        @endphp
                                                                                    @endforeach

                                                                                    @foreach ($subOptionNew as $getSubOption)
                                                                                        @foreach ($getSubOption as $subOptionKey => $subOpts)
                                                                                            @foreach ($subOpts as $subOps)
                                                                                                @if ($loop->first)
                                                                                                    <label
                                                                                                        class="mt-2 fw-bold text-black-50 mb-0 option-sub-option-title">{{ $subOps->sub_group_id }}</label>
                                                                                                @endif
                                                                                            @endforeach
                                                                                            @php
                                                                                                $checkDuplicateSubOption = [];
                                                                                            @endphp
                                                                                            @php
                                                                                                $optionName = 'suboption_' . Illuminate\Support\Str::slug($subOps->sub_group_id ?? '', '_');
                                                                                                if (!empty($isEditProduct)) {
                                                                                                    $cartOptionValue = $optionValue[$optionName] ?? null;
                                                                                                }
                                                                                            @endphp
                                                                                            @if ($subOptionKey === 'dropdown')
                                                                                                <select
                                                                                                    name="suboption_{{ Illuminate\Support\Str::slug($subOps->sub_group_id, '_') }}"
                                                                                                    class="form-select"
                                                                                                    {{ ($isEditProduct && array_key_exists($optionName, $optionValue) && $cartOptionName == $option->id) || @$option->is_always_included ? '' : 'disabled' }}>
                                                                                                    <option value="">
                                                                                                        --Select--</option>
                                                                                                    @foreach ($subOpts as $subOps)
                                                                                                        @if (!empty($subOps->sub_option_name) && !in_array($subOps->sub_option_name ?? '', $checkDuplicateSubOption))
                                                                                                            @php
                                                                                                                $checkDuplicateSubOption[] = $subOps->sub_option_name ?? '';
                                                                                                            @endphp
                                                                                                            <option
                                                                                                                value="{{ $subOps->id }}"
                                                                                                                {{ $isEditProduct && !empty($cartOptionValue) && $cartOptionValue == $subOps->id && array_key_exists($optionName, $optionValue) ? 'selected' : '' }}>
                                                                                                                {{ $subOps->sub_option_name }}
                                                                                                            </option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            @elseif($subOptionKey === 'number')
                                                                                                @foreach ($subOpts as $subOps)
                                                                                                    <input type="number"
                                                                                                        name="suboption_{{ Illuminate\Support\Str::slug($subOps->sub_group_id, '_') }}"
                                                                                                        class="form-control"
                                                                                                        value="{{ $isEditProduct && !empty($cartOptionValue) && array_key_exists($optionName, $optionValue) ? $cartOptionValue : $subOps->sub_option_name }}"
                                                                                                        {{ ($isEditProduct && !empty($cartOptionValue) && array_key_exists($optionName, $optionValue)) || @$option->is_always_included ? '' : 'disabled' }}>
                                                                                                @endfor
                                                                                                each
                                                                                            @elseif($subOptionKey === 'radio')
                                                                                                @foreach ($subOpts as $subOps)
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            name="suboption_{{ Illuminate\Support\Str::slug($subOps->sub_group_id, '_') }}"
                                                                                                            type="radio"
                                                                                                            value="{{ $subOps->id }}"
                                                                                                            id="flexRadioDefault-{{ $subOps->id }}"
                                                                                                            {{ $isEditProduct && !empty($cartOptionValue) && $cartOptionValue == $subOps->id && array_key_exists($optionName, $optionValue) ? 'checked' : '' }}
                                                                                                            {{ ($isEditProduct && !empty($cartOptionValue) && $cartOptionValue == $subOps->id && array_key_exists($optionName, $optionValue)) || @$option->is_always_included ? '' : 'disabled' }}>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="flexRadioDefault-{{ $subOps->id }}">
                                                                                                            {{ $subOps->sub_option_name }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                @endfor
                                                                                                each
                                                                                            @elseif($subOptionKey === 'checkbox')
                                                                                                @foreach ($subOpts as $subOps)
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            name="suboption_{{ Illuminate\Support\Str::slug($subOps->sub_group_id, '_') }}"
                                                                                                            type="checkbox"
                                                                                                            value="{{ $subOps->id }}"
                                                                                                            id="flexCheckDefault-{{ $subOps->id }}"
                                                                                                            {{ $isEditProduct && !empty($cartOptionValue) && $cartOptionValue == $subOps->id && array_key_exists($optionName, $optionValue) ? 'checked' : '' }}
                                                                                                            {{ ($isEditProduct && !empty($cartOptionValue) && $cartOptionValue == $subOps->id && array_key_exists($optionName, $optionValue)) || @$option->is_always_includedF ? '' : 'disabled' }}>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="flexCheckDefault-{{ $subOps->id }}">
                                                                                                            {{ $subOps->sub_option_name }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                @endfor
                                                                                                each
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                @elseif($option->option_type === 'warranty')
                                                                    <div
                                                                        class="row justify-content-center align-items-center w-100">
                                                                        <div class="col-auto">
                                                                            <img src="{{ $helpers->getThumbnail($option->media_id) }}"
                                                                                alt="">
                                                                        </div>

                                                                        <div class="col-sm-8 col-lg-5 col-md-6 col-xl-4">
                                                                            <div class="row align-items-center">
                                                                                <div class="col-9">
                                                                                    <div class="radio">
                                                                                        <input
                                                                                            id="radio-{{ $option->id }}"
                                                                                            name="option_warranty"
                                                                                            type="radio" checked value="1">
                                                                                        <label
                                                                                            for="radio-{{ $option->id }}"
                                                                                            class="radio-label"><span
                                                                                                class="cross-text pe-1">7</span>
                                                                                            {{ $option->name }}
                                                                                            @if (!empty($option->tooltip_media_id) || !empty($option->content))
                                                                                                <span
                                                                                                    class="position-relative mousuhover-out">
                                                                                                    <span
                                                                                                        class="text-primary tooltip-hover question-icon px-2">
                                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                            width="16"
                                                                                                            height="16"
                                                                                                            fill="currentColor"
                                                                                                            class="bi bi-question-circle-fill"
                                                                                                            viewBox="0 0 16 16">
                                                                                                            <path
                                                                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                                                            </path>
                                                                                                        </svg>
                                                                                                    </span>
                                                                                                    <div
                                                                                                        class="tooltip shadow">
                                                                                                        <div
                                                                                                            class="tooltip-arrow">
                                                                                                        </div>
                                                                                                        <span
                                                                                                            class="close-tooltip btn-close btn"></span>
                                                                                                        <div
                                                                                                            class="tooltip-inner">
                                                                                                            <div
                                                                                                                class="row g-2">

                                                                                                                @if (!empty($option->tooltip_media_id))
                                                                                                                    <div
                                                                                                                        class="col-12">
                                                                                                                        <img class="w-100 rounded img-fluid"
                                                                                                                            src="{{ $helpers->getImage($option->tooltip_media_id) }}"
                                                                                                                            alt="">
                                                                                                                    </div>
                                                                                                                @endif
                                                                                                                <div
                                                                                                                    class="col-sm-12">
                                                                                                                    @if (!empty($option->content))
                                                                                                                        @php echo $option->content ?? ""; @endphp
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </span>
                                                                                            @endif
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <h5
                                                                                        class="mb-0 font-secondary text-primary fw-bold">
                                                                                        <small
                                                                                            class="h6 text-decoration-line-through text-dark pe-2">$25.00</small>FREE
                                                                                    </h5>
                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        {{-- @endforeach --}}
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach







                </div>
            </div>
            <div id="product-details-nav-section" class="pt-4">
                <ul class="nav product-details-nav nav-tabs" id="myTab " role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link order-sample-btn" href="javascript:void(0)" target="_self">Order Free
                            Samples</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Product
                            Information</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Measure & Install
                            Guide</button>
                    </li>

                    {{-- <li class="nav-item" role="presentation">
        <button href="javascript:void(0)" class="nav-link reviews-link-slider" id="Reviews-tab" data-bs-toggle="tab" data-bs-target="#Reviews"
        type="button" role="tab" aria-controls="Reviews" aria-selected="false">Reviews</button>
    </li> --}}



                </ul>
                <div class="tab-content pb-2" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="py-3 text-dark">

                            {!! $product->content ?? '' !!}

                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="py-3 text-dark">
                            <div class="row pb-3 justify-content-center about-services-section mb-4">
                                @if (!empty($helpers->getYoutubeEmbedUrl($product->measurement->measure_media_id_2 ?? '')))
                                    <div class="col-lg-8 col-lg-5 mb-3">
                                        <iframe width="100%" height="315"
                                            src="{{ $helpers->getYoutubeEmbedUrl($product->measurement->measure_media_id_2 ?? '') }}"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    </div>
                                @else
                                    <div class="col-lg-8 col-lg-5 mb-3">
                                        <iframe width="100%" height="315"
                                            src="https://www.youtube.com/embed/0TeqoxQWf4g?controls=0"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    </div>
                                @endif
                                {{-- @if ($helpers->checkExtension($helpers->getImage($product->measurement->measure_media_id ?? '')) === 'pdf' || $helpers->checkExtension($helpers->getImage($product->measurement->installation_media_id ?? ' ?? ')) === 'pdf') --}}
                                <div class="col-lg-4 mb-3">
                                    {{-- {{$product->measurement->measure_media_id}} --}}
                                    {{-- @if (!empty($product->measurement->measure_media_id)) --}}
                                    <div
                                        class="services-box cart-box rounded shadow-none p-4 text-center align-items-center justify-content-center d-flex">
                                        <div class="mb-3">
                                            <h3 class="heading-two">Download Measuring Guide</h3>
                                            @if (!empty($product->measurement->measure_media_id))
                                                <a class="btn btn-primary mt-2" target="_blank"
                                                    href="{{ $helpers->getImage($product->measurement->measure_media_id ?? '') }}"
                                                    download>Download PDF</a>
                                            @else
                                                <a class="btn btn-primary mt-3" target="_blank"
                                                    href="{{ asset('images/pdf/HeyBlinds-Measuring-Guide.pdf') }}">Download
                                                    PDF</a>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- @endif --}}
                                    {{-- {{$product->measurement->installation_media_id}} --}}
                                    @if (!empty($product->measurement->installation_media_id))
                                        <div
                                            class="services-box cart-box rounded shadow-none  mt-3 p-4 text-center align-items-center justify-content-center d-flex">
                                            <div>
                                                <h3 class="heading-two">Download Install Guide</h3>
                                                @if (!empty($product->measurement->installation_media_id))
                                                    <a class="btn btn-primary mt-2" target="_blank"
                                                        href="{{ $helpers->getImage($product->measurement->installation_media_id ?? '') }}"
                                                        download="download">Download PDF</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                {{-- @else
                                    <div class="col-lg-4 mb-3">
                                        <div class="services-box cart-box rounded shadow-none  p-4 text-center w-100 align-items-center d-flex">
                                            <div>
                                                <h3 class="heading-two">Download Measuring Guide</h3>
                                                <a class="btn btn-primary mt-3" target="_blank" href="{{asset('images/pdf/HeyBlinds-Measuring-Guide.pdf')}}" download>Download PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif --}}
                            </div>
                        </div>

                    </div>


                    <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        <div class="py-3 text-dark">
                            <div class="row pb-5 pt-3 justify-content-center about-services-section mb-4">
                                @if ($productReviews->count() > 0)
                                    <div class="col-lg-3 col-md-4 pe-md-4 text-center campany-reviews">
                                        <h5 class="mb-0">Reviews</h5>
                                        <hr class="mt-2" />
                                        <div class="py-2 total-product-review">
                                            <div class="star-width mx-auto">
                                                @php
                                                    $rating_total_percentage = (100 / 5) * $avgOfproductReviews;
                                                @endphp
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $rating_total_percentage }}%;" aria-valuenow="25"
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
                                            <h5 class="mb-0 ps-2 pt-3">
                                                @if (is_float($avgOfproductReviews))
                                                    <b>{{ number_format($avgOfproductReviews, 1) }}/5</b>
                                                @else
                                                    <b>{{ number_format($avgOfproductReviews) }}/5</b>
                                                @endif
                                                <small>({{ $productReviews->count() }} Reviews)</small>
                                            </h5>

                                        </div>

                                        {{-- <h6 class="mb-3 pt-4">
                                            Don't take our word for it, we've
                                            got over 125,000 great reviews
                                        </h6> --}}
                                    </div>

                                    <div class="col-lg-9 col-md-8">

                                        <div class="review-slider">
                                            @foreach ($productReviews as $review)

                                                <div class="review-box shadow-sm rounded p-3 mx-2">
                                                    <div class="testmonial-top pb-1">

                                                        {{-- @php
                                                        $name = preg_split ('/\s/',$review->name);
                                                        @endphp --}}

                                                        <h6 class="mb-0 font-weight-bold fw-semibold">
                                                            {{ ucfirst($review->title_review) }}
                                                        </h6>
                                                        <p class="mb-1 fw-semibold">
                                                            {{ ucfirst($review->name) }} from {{ $review->city }},
                                                            {{ $review->province }}&nbsp;{{ $review->created_at->format('M d, Y') }}
                                                        </p>
                                                        <div class="star-width">
                                                            @php
                                                                $rating_percentage = (100 / 5) * $review->rating_point;
                                                            @endphp
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: {{ $rating_percentage }}%;"
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
                                                    </div>
                                                    <hr class="my-2" />

                                                    <p class="auth-content mb-0 py-1 text-break review-text">
                                                        {{ $review->review }}
                                                    </p>

                                                    {{-- <p><small>{{$review->created_at->format('M d, Y')}}</small></p> --}}

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <h3 class="text-center">Reviews not found yet.</h3>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row justify-content-end py-xxl-3 py-1 product-cart-height mb-3 position-relative">
                <div id="product-cart-box" class="col-lg-10 col-xl-7 product-cart-box">
                    <div
                        class="rounded  shadow bg-white px-sm-3 px-2 product-cart-padding-y border-bottom border-3 border-primary text-dark">
                        <div class="row py-1 ">
                            <div class="col-8">
                                <div class="row ">
                                    <div class="col-7">
                                        <p class="mb-0 fw-bold">My Samples Cart</p>

                                        <p class=" mb-1"><span
                                                id="totalFreeSampleCarts">{{ $sampleCount }}</span> Free Sample(s) in
                                            cart</p>

                                        <button class="btn btn-secondary btn-sm headerSampleCart">Samples Cart</button>

                                    </div>
                                    <div class="col-5 border-start">
                                        <div class="mb-1">Guaranteed Lowest Price:
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
                                                                <h5>100 Day Lowest Price Guarantee</h5>
                                                                <p>Hey, found a better price? We’ll beat it, guaranteed.</p>

                                                                <p>Whether you buy one blind or enough for your entire home,
                                                                    we’ll guarantee you got the lowest price for up to 100
                                                                    days
                                                                    after your purchase. Most price guarantees only cover 60
                                                                    days
                                                                    after purchase, but we’ll give you an extra 40 days to
                                                                    find a lower price.</p>

                                                                <p>If you find a lower price, we’ll not only match it; we’ll
                                                                    beat it with an
                                                                    additional 10% discount on the difference.</p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </div>

                                        <div>
                                            <h5 class="text-primary font-secondary fw-bold mb-0" id="displayPrice">
                                                ${{ $isEditProduct && !empty($optionValue['total_price']) ? $optionValue['total_price'] : (!empty($finalPriceAfterDiscount) ? number_format($finalPriceAfterDiscount, 2) : 0) }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <p class="fw-bold mb-1">My Blinds & Shades</p>
                                <button id="addToCart" type="button" class="btn-primary btn custom w-100 py-md-2">
                                    {{ !empty($isEditProduct) ? 'Update Cart' : 'Add to Cart' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade " id="covidModal" tabindex="-1" aria-labelledby="covidModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content border-0">
                        <div class="modal-body">
                            <div class="row gx-2 justify-content-between">
                                <div class="col-11">
                                    <h4 class="font-secondary fw-bold text-secondary"><span class="text-primary">Covid
                                            19</span> Enhanced Safety Measures</h4>
                                </div>
                                <div class="col-1 text-end">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                            <hr class="mt-2" />
                            <p>HeyBlinds is committed to the health and wellness of all our customers and employees. As a
                                result
                                we have implemented enhanced preventative measures to ensure everyone we come in contact
                                with
                                feels safe. </p>
                            <p>We are adhering to the recommendations established by WHO, the Public Health Agency of
                                Canada,
                                the CDC along with the federal and local governments.</p>
                            <p>We are doing everything we can to practice safe distancing and working remotely when
                                possible.
                            </p>
                            <h5 class="font-secondary fw-bold text-secondary  border-bottom pb-2">
                                It’s business as usual
                            </h5>
                            <p>That’s the beauty of online shopping. We are always open and available to help with any
                                questions
                                or concerns you have. Call us at 888-412-3439 or chat with us online, during our service
                                hours
                                of 8AM - 8PM Eastern Time, Monday - Friday. </p>

                            <h5 class="font-secondary fw-bold text-secondary border-bottom pb-2">
                                Ordering and Delivery
                            </h5>
                            <p>Delivery times may vary due to Covid health and safety guidelines, including proper social
                                distancing between employees. Most orders are shipping on time, but certain orders may
                                experience a delay.</p>
                            <p>You can view the status of your order at any time.</p>
                            <p>
                                Please stay healthy and safe. <br />We appreciate your business and look forward to serving
                                you.
                            </p>

                            <h6>The <span class="text-primary">HeyBlinds</span> Team</h6>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>





    @push('js')
        <script>
            $.fn.hasName = function(name) {
                return this.name == name;
            };
            sessionStorage.removeItem('hb_last_data');

            function onlyUnique(value, index, self) {
                return self.indexOf(value) === index;
            }
            window.option = @php echo json_encode(($optionArrayForJs ?? [])) @endphp;
            var allData = window.option;
            jQuery(function($) {
                var labels = [];
                for (var i = 0; i <= 102; i += 20) {
                    labels.push(i);
                }

                function cartOffset() {
                    if ($('#product-cart-box').offset().top + $('#product-cart-box').height() >= $('#footer').offset()
                        .top - 10)
                        $('#product-cart-box').css('position', 'absolute').removeClass('product-cart-fixd');
                    if ($(document).scrollTop() + window.innerHeight < $('#footer').offset().top)
                        $('#product-cart-box').css('position', 'fixed').addClass('product-cart-fixd');
                }
                $(document).scroll(function() {
                    cartOffset();
                });

                $('.headrail-price').fadeOut();
                $("#premium-floating-headrail").on('click', function() {
                    var headrailVal = $("#premium-floating-headrail").val();
                    if (headrailVal == 1) {
                        $("#premium-floating-headrail-option").slideDown();
                        $('.headrail-price').fadeIn();
                    } else {
                        $("#premium-floating-headrail-option").slideUp();
                        $('.headrail-price').fadeOut();
                    }
                    // alert(headrailVal);
                });

                $(document).on('click', '.more_click', function() {
                    let target = $('#product-details-nav-section');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top - 100
                        }, 500);
                        return false;
                    }
                });
                $(document).on('click', '.order-sample-btn', function() {
                    let target = $('#product-option');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top - 100
                        }, 500);
                        return false;
                    }
                });



                // $(document).on('click', '#open-tap-scroll', function(){
                //     $('#product-details-nav-section .nav-tabs li #home-tab').trigger('click');
                //     let target = $('#product-details-nav-section');
                //     if (target.length) {
                //         $('html,body').animate({
                //             scrollTop: target.offset().top - 100
                //         }, 1000);
                //         return false;
                //     }
                // });

                $(document).on('click', function(e) {
                    let $target = e.target,
                        data = e.target.dataset;
                    if ($target.tagName === "SELECT") {
                        $($target).on('change', function(event) {
                            event.preventDefault();
                            event.stopPropagation();
                            event.stopImmediatePropagation();
                            let $this = $(this);
                            if ($this.attr('name') === "option_width" || $this.attr('name') ===
                                "option_height" || $this.attr('name') === "option_width_fraction" ||
                                $this.attr('name') === "option_height_fraction") {
                                if ($(".product-width option:last").is(":selected")) {
                                    $(".product-width-fractions[name=option_width_fraction]").prop(
                                        "selectedIndex", 0).prop('disabled', true)
                                } else {
                                    $(".product-width-fractions[name=option_width_fraction]").prop(
                                        'disabled', false)
                                }
                                if ($(".product-height option:last").is(":selected")) {
                                    $(".product-height-fractions[name=option_height_fraction]").prop(
                                        "selectedIndex", 0).prop('disabled', true)
                                } else {
                                    $(".product-height-fractions[name=option_height_fraction]").prop(
                                        'disabled', false)
                                }
                                getPrice('option_width')
                            } else {
                                getPrice();
                            }
                            localStorage.setItem($this.attr('name'), $this.val());
                        });
                    } else if (($target.tagName === "INPUT" && $target.type === "radio" && $target.checked) || (
                            $target.tagName === "INPUT" && $target.type === "checkbox" && $target.checked)) {
                        $($target).on('click', function(event) {
                            event.stopPropagation();
                            event.stopImmediatePropagation();
                            let $this = $(this);
                            if ($target.type === "checkbox") {
                                let group = "input:checkbox[name='" + $this.prop("name") + "']";
                                $(group).not(this).prop("checked", false);
                            }
                            let parentClass = '.' + $this.attr('data-group'),
                                checkSelectors = $this.parents(parentClass).find('input, checkbox',
                                    'select'); //.find('input, checkbox').next().find('input, select')
                            jQuery.each(checkSelectors, function() {
                                $(this).parent('.check-position').next().find('input, select')
                                    .attr('disabled', 'disabled');
                                $(this).find('.option-sub-option-required').remove();
                            })

                            let allSiblings = $this.parent('.check-position').next().find(
                                'input, select');
                            if (allSiblings.length > 0) {
                                jQuery.each(allSiblings, function() {
                                    $(this).removeAttr('disabled');
                                    $(this).prev().find('span').remove();
                                    $(this).prev().append(
                                        '<span class="text-danger fw-bold ms-0 fs-5 option-sub-option-required">*</span>'
                                        )
                                    if ($(this).prop("tagName") === "SELECT") {
                                        allData['select'].push($(this).attr('name'))
                                    } else if ($(this).prop("tagName") === "INPUT" && $(this)
                                        .prop("type") === "checkbox") {
                                        allData['checkbox'].push($(this).attr('name'))
                                    } else if ($(this).prop("tagName") === "INPUT" && $(this)
                                        .prop("type") === "radio") {
                                        allData['radio'].push($(this).attr('name'))
                                    } else if ($(this).prop("tagName") === "INPUT" && $(this)
                                        .prop("type") === "text") {
                                        allData['text'].push($(this).attr('name'))
                                    }
                                })
                            }

                            let hb_last_data = sessionStorage.getItem('hb_last_data');
                            if (hb_last_data) {
                                let getParseObject = JSON.parse(hb_last_data);
                                jQuery.each(getParseObject, function(index, value) {
                                    let selector = $('input[name="' + value.name + '"]');
                                    jQuery.each(selector, function() {
                                        $(this).removeAttr('disabled').siblings('label')
                                            .css('opacity', '1');
                                    })
                                })
                            }
                            getPrice()
                        }).trigger('click');
                    }
                })
                getPrice(null)

                function getPrice(extra) {
                    let formData;
                    if (extra === "option_width") {
                        let Select = $(document).find('input, select'),
                            array = {}
                        $.each(Select, function() {
                            let $this = $(this),
                                name = $this.attr('name');
                            if ($this.prop('tagName') === "INPUT" && $this.is(':checked')) {
                                array[name] = $this.val()
                            } else if ($this.prop('tagName') === "SELECT" && $this.val() !== "") {
                                array[name] = $this.val()
                            }
                        })
                        array['extra'] = 'option_width';
                        formData = array
                    } else {
                        let form = $("#productDetails");
                        formData = new FormData(form[0]);
                        formData.append('extra', extra)
                    }
                    let data = formData,
                        url = '{{ route('frontend.product.get.price', $product->id) }}';
                    success_callback(url, data, function(response) {
                        let data = response.data;
                        action(data)
                        $("#loader").hide();
                    }, function(error) {
                        $("#loader").hide();
                    })
                }

                function action(data) {
                    let price = $("#displayPrice, #finalPriceAfterDiscount");
                    price.empty().text("$" + data.price)
                    $("#totalUnitPrice").empty().text("$" + data.unitPrice)
                    $("#AddToCartValue").empty().val(data.price)
                    $("#AddToCartUnitPrice").empty().val(data.unitPrice)
                    $("#measurement_price").empty().val(data.measurement)
                    let options = data.option;
                    if (options.width) {
                        let width = options.width;
                        jQuery.each(width, function(ind, val) {
                            if ((val.action === "disabled" || val.action === "enabled") && val.type !==
                                "dropdown" && val.type !== "warranty") {
                                let selector = $('input[type="radio"], input[type="checkbox"]');
                                jQuery.each(selector, function() {
                                    let $this = $(this);
                                    if ($this.is(":checked") && $this.attr('name') !== "option_color") {
                                        $this.prop('checked', false);
                                        let checkSubOptions = $this.parent().next().find('select');
                                        if (checkSubOptions) {
                                            jQuery.each(checkSubOptions, function() {
                                                $(this).prop("selectedIndex", 0).attr(
                                                    'disabled', 'disabled')
                                            })
                                        }
                                    }
                                    if ($this.attr('name') === val.name && parseInt($this.val()) === val
                                        .value && $this.attr('data-type') === val.option_name) {
                                        if (val.action === "enabled") {
                                            $this.removeAttr('disabled').siblings('label').css(
                                                'opacity', '1');
                                        } else {
                                            $this.attr('disabled', 'disabled').siblings('label').css(
                                                'opacity', '0.3');
                                        }
                                    }
                                })
                            }
                        })
                    }
                    if (options) {
                        let $sessionStorage = [];
                        jQuery.each(options, function(key, value) {
                            if ((value.action === "disabled" || value.action === "enabled") && value.type !==
                                "dropdown" && value.type !== "warranty") {
                                let selector = $('input[type="' + value.type + '"]');
                                jQuery.each(selector, function() {
                                    let $this = $(this);
                                    if ($this.attr('name') === value.name && parseInt($this.val()) ===
                                        value.value && $this.attr('data-type') === value.option_name) {
                                        if ($this.is(":checked")) {
                                            $this.prop('checked', false);
                                        }
                                        if (value.action === "enabled") {
                                            $this.removeAttr('disabled').siblings('label').css(
                                                'opacity', '1');
                                        } else {
                                            $this.attr('disabled', 'disabled').siblings('label').css(
                                                'opacity', '0.3');
                                        }
                                        $sessionStorage.push({
                                            type: value.type,
                                            name: $this.attr('name'),
                                            value: $this.val(),
                                            isOption: true
                                        })
                                    }
                                })
                                sessionStorage.setItem("hb_last_data", JSON.stringify($sessionStorage));
                            }
                        })
                    }
                }

                $(document).on('click', '#addToCart', function(e) {
                    e.preventDefault();
                    let check = true;
                    jQuery.each(allData, function(index, value) {
                        if (index === "radio" || index === "text" || index === "select" || index ===
                            "checkbox") {
                            var unique = value.filter(onlyUnique);
                            jQuery.each(unique.reverse(), function(ind, val) {
                                let $this = $("[name=" + val + "]"),
                                    text = val.replace("suboption_", "").replace("option_", "")
                                    .replaceAll("_", " ").toLowerCase().replace(/\b[a-z]/g,
                                        function(txtVal) {
                                            return txtVal.toUpperCase();
                                        }) + " Required";
                                if (!$this.is(':disabled') && (($this.prop('type') ===
                                            "radio" && !$this.is(":checked")) || ($this.prop(
                                            'type') === "checkbox" && !$this.is(":checked")) ||
                                        ($this.prop('type') === "text" && $this.val() === "") ||
                                        ($this.prop('type') === "select-one" && $this.val() ===
                                            ""))) {
                                    toastr.error(text);
                                    check = false;
                                }
                            })
                        }
                    })
                    if (check) {
                        let $this = $(this),
                            form = $this.parents('form'),
                            formData = new FormData(form[0]);
                        @if (!empty($isEditProduct) && !empty($cartItem))
                            formData.append('edit_product', true)
                            formData.append('itemId', {{ $cartItem->id }})
                        @endif
                        let cartId = readCookie('__cart_items'); // localStorage.getItem('__cart_items')
                        formData.append('cart_id', cartId)
                        $("#loader").show();
                        success_callback(form.attr('action'), formData, function(response) {
                            let data = response.data;
                            $("#loader").hide();
                            if (data.external_id) {
                                createCookie('__cart_items', data.external_id, 2)
                                @if (!$isEditProduct)
                                    let $orderCartCountBadge = $("#orderCartCountBadge"),
                                    existing = parseInt($orderCartCountBadge.text())
                                    $orderCartCountBadge.text(existing+1)
                                @endif
                                $('body').append(modal());
                            }
                        }, function(error) {
                            $("#loader").hide();
                        })
                    }
                })
                // $(document).on('click', ".continue-shopping", function(e) {
                //     e.preventDefault();
                //     $(".custom-modalcontainer").fadeOut("slow");
                //     $(".modal").fadeOut("slow");
                //
                // });
                $(document).on('click', '#goToCart', function(e) {
                    e.preventDefault();
                    let cartId = readCookie('__cart_items');
                    if (cartId) {
                        window.location.href = window.location.origin + "/cart/" + cartId
                    } else {
                        $(".custom-modalcontainer").fadeOut("slow");
                        $(".modal").fadeOut("slow");
                        toastr.error("Something Went Wrong With Add To Cart, Please Try again.");
                    }
                })

                $(document).on('click', '.cart-sample-select-button', function(e) {
                    e.preventDefault();
                    let $this = $(this),
                        $sampleCartId = readCookie('__sb_sample_cart'),
                        data = {
                            pid: $this.attr('data-pid'),
                            optid: $this.val(),
                            cartid: $sampleCartId
                        }
                    if ($this.hasClass('btn-outline-primary') && !$this.attr('selected')) {
                        $("#loader").show();
                        let url = '{{ route('frontend.product.add.to.sample') }}'
                        success_callback(url, data, function(response) {
                            let data = response.data;
                            if (data.error !== "null") {
                                // localStorage.setItem('__sb_sample_cart', data.external_id)
                                createCookie('__sb_sample_cart', data.external_id)
                                let existing = parseInt($("#sampleCartCountBadge").text())
                                $("#sampleCartCountBadge, #totalFreeSampleCarts").text(existing + 1)
                                $("#sampleCartItems").text(existing + 1)
                                $this.attr('selected', 'selected').removeClass('btn-outline-primary')
                                    .addClass('selected btn-primary').text("Sample Selected")
                            }
                            $("#loader").hide();
                        }, function(error) {
                            $("#loader").hide();
                        })
                    } else if ($this.hasClass('selected') && $this.attr('selected')) {
                        removeCart(data, $this)
                    }
                })
            })

            function downloadPdfFile(id) {
                axios.post(`/product/file/instruction-download/${id}`)
            }

            function modal(data) {
                return `<div class="custom-modalcontainer">
    <div class="flex">
    <div class="custom-modal">
    <div class="content">
    @if (!$isEditProduct)
        <h2 class="text-center">Product Added!</h2>
    @else
        <h2 class="text-center">Product Updated!</h2>
    @endif
    </div>
    <div class="row pb-4 px-4">
    <div class="col-md-6 pb-2 pb-md-0">
    <a href="{{ url()->previous() }}" class="btn-light btn custom w-100 py-md-2 continue-shopping">Continue Your Shopping</a>
    </div>
    <div class="col-md-6">
    <button type="button"  id="goToCart" class="btn-primary btn custom w-100 py-md-2">Go To Cart</buttons>
    </div>

    </div>
    </div>
    </div>
    </div>`
            }
        </script>
        <script type="text/javascript">
            // $(function () {
            $(document).ready(function() {
                $('.order-sample-btn').click(function() {
                    $("#collapseOne").addClass("show");
                    $('.accordion-button-collapsed').removeClass("collapsed").attr("aria-expanded", "true");
                });


                $('.review-slider').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    arrows: true,
                    autoplaySpeed: 2000,
                    responsive: [{
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                infinite: true,
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                            }
                        }
                    ]
                });

                $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function() {
                    $('.review-slider').slick('setPosition');
                });




                // --------product slider

                $('.product-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.product-slider-nav'
                });

                $('.product-slider-nav').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: '.product-slider',
                    centerMode: true,
                    focusOnSelect: true,
                    responsive: [{
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 400,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                            }
                        }

                    ]
                });

                $(document).on('click', '#view-review-scroll', function(e) {
                    e.preventDefault();
                    $('#product-details-nav-section .nav-tabs li #Reviews-tab').trigger('click');
                    let target = $('#product-details-nav-section');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top - 100
                        }, 1000);
                        return false;
                    }
                });



                $('.review-text').each(function(event) {
                    var max_length = 130;

                    if ($(this).html().length > max_length) {

                        var short_content = $(this).html().substr(0, max_length);
                        var long_content = $(this).html().substr(max_length);

                        $(this).html(short_content +
                            '<span class="more_text" style="display:none;">' + long_content + '</span>' +
                            '<a href="#" class="read_more more-dot">...</a> <br/><a href="#" class="read_more small read-text-change">Read More</a>'
                            );

                        $(this).find('a.read_more').click(function(event) {
                            event.preventDefault();
                            // $(this).hide();
                            $(this).parents('.review-text').find('.more-dot').toggle();
                            $(this).parents('.review-text').find('.more_text').toggle();

                            var ReadLess = $(this).parents('.review-text').find('.read-text-change');

                            if (ReadLess.text() == 'Read More') {
                                ReadLess.text('Read Less');
                            } else {
                                ReadLess.text('Read More');
                            }
                        });
                    }
                });

                if (window.location.href.indexOf("GoReview") > -1) {

                    $('#product-details-nav-section .nav-tabs li #Reviews-tab').trigger('click');
                    let target = $('#product-details-nav-section');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top - 100
                        }, 500);
                        return false;
                    }
                }


            });
        </script>
    @endpush
@endsection
