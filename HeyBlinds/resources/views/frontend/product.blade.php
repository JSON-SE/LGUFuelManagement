@extends('layouts.Frontend.app')
@section('title')
{{$helpers->seo($product->id, 'product')->title ?? $product->name . " - HeyBlinds" }}
@endsection
@push('css')
<style type="text/css">
    select[readonly] {
        pointer-events: none;
    }
    .pointer-none{
        pointer-events: none;
    }
</style>

@endpush
@section('content')
<form id="productDetails" enctype="multipart/form-data" action="{{route('frontend.product.store', $product->id)}}"
    method="post">
    @csrf
    <div class="container pt-2">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34);"
            aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                @if(!empty( $product->category->slug))
                <li class="breadcrumb-item">
                    <a href="{{route('frontend.category', $product->category->slug)}}">{{$product->category->name}}</a>
                </li>
                @endif
                @if(!empty($product->category->slug) && !empty($product->subCategory->slug))
                <li class="breadcrumb-item">
                    <a
                        href="{{route('frontend.category.sub-category', [$product->category->slug, $product->subCategory->slug])}}">
                        {{$product->subCategory->name}}
                    </a>
                </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
            </ol>
        </nav>
        <!--product slider -->
        <div class="row pt-2 align-items-center">
            <div class="col-lg-5">
                <div class="product-slider overflow-hidden">
                    @if(!empty($product->slider_id))
                    @foreach( json_decode($product->slider_id) as $sliderId)
                    <div class="product-slider-image">
                        <img src="{{$helpers->getImage($sliderId)}}" alt="heyblinds-product-{{$product->name ?? ''}}" />
                    </div>
                    @endforeach
                    @else
                    <div class="product-slider-image">
                        <img src="{{$helpers->getImage($product->display_media_id)}}" alt="heyblinds-product-{{$product->name ?? ''}}" />
                    </div>
                    @endif
                </div>
                <div class="row pt-2">
                    <div class="col-9 col-md-10">
                        <div class="product-slider-nav">
                            @if(!empty($product->slider_id))
                            @foreach( json_decode($product->slider_id) as $sliderId)
                            <div>
                                <div class="nav-slider-image">
                                    <img src="{{$helpers->getThumbnail($sliderId)}}" alt="heyblinds-thumbnail-product-{{$product->name ?? ''}}" />
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div>
                                <div class="nav-slider-image">
                                    <img src="{{$helpers->getThumbnail($product->display_media_id)}}" alt="heyblinds-thumbnail-product-{{$product->name ?? ''}}" />
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden"
                value="{{( $isEditProduct && !empty($optionValue['total_price']) )? $optionValue['total_price']  : ( !empty($finalPriceAfterDiscount) ? $helpers->withoutRoundingforOther($finalPriceAfterDiscount, 2) : 0) }}"
                id="AddToCartValue" name="total_price">
            <input type="hidden"
                value="{{( $isEditProduct && !empty($optionValue['unit_price']) )? $optionValue['unit_price']  : ( !empty($defaultPrice) ? $helpers->withoutRoundingforOther($defaultPrice, 2) : 0) }}"
                id="AddToCartUnitPrice" name="unit_price">
            <input type="hidden" value="{{$defaultPrice}}" id="measurement_price" name="measurement_price">
            <div class="col-lg-7 pt-3 ps-lg-4 pt-lg-0">
                <h1 class="product-details-text pe-5">{{$product->name}}</h1>
                <div class="row pt-md-3">
                    <div class="col-sm-8">
                        <div class="product-details-description">
                            <div> {!!$product->excerpt ?? ""!!} </div>
                            <a href="javascript:void(0)" class="more_click" target="_self"> More</a>
                        </div>
                        <h5 class="details-guarantee-text pt-sm-3 font-secondary">100 Day Risk-Free In-Home Trial
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
                                                @if(empty($product->tooltip->blind_guarantee))
                                                <p>We want you to be sure you’ve chosen the right blind in the right colour and texture.</p>
                                                <p>That’s why we’ll let you live with your blind for 100 days so you can be confident you made the right choice.</p>
                                                <p>We don't want anyone unhappy so if you're not satisfied with your purchase, we'll do everything in our power to make you happy. But if it's just impossible for us to make you happy then rest assured we’ll be here to help you with returning your order for a refund or exchange!</p>
                                                <p>
                                                    Make sure you’re covered by our 100 Day RIsk-Free In-Home Trial by ordering free samples. That way, you can better see how the colours & materials will look and feel for a perfect complement to your room—order as many as you like. HeyBlinds will ship them all for free. And we’ll lock in today’s sale pricing for 3 weeks so that you have time to be sure of your choice before ordering!
                                                </p>
                                                <p>
                                                    See our <a href="{{url('/warranty')}}" target="_blank">warranty page</a> for full details.
                                                </p>
                                                @else
                                                {!!$product->tooltip->blind_guarantee?? '' !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </h5>

                        <h5 class="details-guarantee-text">
                            <span class="font-secondary fw-normal">RightFit <small class="TrademarkSymbol">&reg;</small>
                                &nbsp; Guarantee</span>
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
                                                @if(empty($product->tooltip->riight_fit_guarantee))
                                                <p>Make a mistake measuring, and we’ll fix it for free. See our HeyOK
                                                    Warranties under Help for full details.</p>
                                                @else
                                                {!!$product->tooltip->riight_fit_guarantee ?? ''!!}
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
                            @if(!empty($initialDiscount))
                            <div class="d-flex align-items-center justify-content-center flex-wrap pb-2">
                                <h5 class="fw-light text-decoration-line-through mb-0" id="totalUnitPrice">
                                    ${{( $isEditProduct && !empty($optionValue['unit_price']) )?
                                    $optionValue['unit_price'] : ( !empty($defaultPrice) ?
                                    $helpers->withoutRoundingforOther($defaultPrice, 2) : 0) }}
                                </h5>
                            </div>

                            <h5 class="fw-bold ">You Save {{$initialDiscount}}</h5>
                            <h6 class="{{$product_promo['extra_discount'] > 0 ? 'd-block' : 'd-none'}}">Plus An Extra
                                {{$product_promo['extra_discount'] ?? 0}}% Off</h6>

                            @endif
                            <div class="d-flex justify-content-center align-items-center">
                                <h3 class="text-primary fw-bold mb-0" id="finalPriceAfterDiscount">${{( $isEditProduct &&
                                    !empty($optionValue['total_price']) )? $optionValue['total_price'] : (
                                    !empty($finalPriceAfterDiscount) ?
                                    $helpers->withoutRoundingforOther($finalPriceAfterDiscount, 2) : 0) }}</h3>
                                {{-- <h3 class="text-primary fw-bold mb-0" id="">${{( $isEditProduct &&
                                    !empty($optionValue['total_price']) )? $optionValue['total_price'] : (
                                    !empty($finalPriceAfterDiscount) ?
                                    $helpers->withoutRoundingforOther($finalPriceAfterDiscount, 2) : 0) }}</h3> --}}

                                    <span
                                    class="position-relative ms-2 mousuhover-out  {{$product_promo['extra_discount'] > 0 ? 'd-block': 'd-none'}}">
                                    <span class="text-primary tooltip-hover question-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
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
                                </span>
                            </div>

                        </div>
                        {{-- product review section --}}
                        <div class="text-end mt-4">
                            <div class="star-width d-inline-block">
                                <div class="progress">
                                    @php
                                    $rating_total_percentage = ((100/5)*$avgOfproductReviews);
                                    @endphp
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{$rating_total_percentage}}%;" aria-valuenow="25"
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
                                <b>{{is_float($product->avgRatingOfProduct($product->id) ?? 0) ==true ?
                                    number_format($product->avgRatingOfProduct($product->id),1) :
                                    number_format($product->avgRatingOfProduct($product->id))}}/5</b>
                                <a href="javascript:void(0)" id="view-review-scroll">({{$productReviews->count()}}
                                    reviews)</a>
                            </p>
                        </div>
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
                                <img src="{{ asset('images/delivery-truck.png') }}" alt="Hey Blindes Delivery Truck" />
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
                                                {{-- {!! $helpers->getSettings('delivery_time_tooltip') ?? "" !!} --}}
                                                @if(!empty($product->tooltip->devlivery_time))
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
                @if(!empty($product->colors))
                <div class="accordion-item ">
                    <h2 class="accordion-header mt-3" id="headingOne">
                        <button class="accordion-button accordion-button-collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne">
                            <span class="d-flex align-items-center justify-content-center">
                                <img src="{{asset('images/tick.png')}}" alt="heynlinds-tick" />
                            </span> Select Colour
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show border-0" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body py-2">
                            <div class="error d-flex justify-content-end">
                            </div>
                            <h6 class="accodin-heading">For a true colour comparison, please order a free sample
                                <span class="position-relative mousuhover-out">
                                    <span class="text-primary tooltip-hover question-icon px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
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
                                                    exactly right, and to be covered by our 100 Day 'I Love My Blinds'
                                                    Guarantee. We guarantee today’s sale pricing for 3 weeks when you order samples. So that you have all the time you need to review your samples and make sure you are ordering the colours and styles that are just right for your windows and home!
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
                                        @if(!empty($product->colors))
                                        @foreach($product->colors as $colorKey => $color)
                                        @if(!empty($color->color->is_enable) && $color->color->is_enable == 1)
                                        @if($loop->first)
                                        @php $optionArrayForJs["radio"][] = "option_color" @endphp
                                        @endif
                                        <div class="sample-color-box text-center shadow-sm">
                                            <div class="radio check-position">
                                                <input id="sample-color-{{$colorKey}}" name="option_color" type="radio"
                                                    value="{{$color->id}}" data-value="{{$color->color->name}}"
                                                    data-type="{{$color->color->name}}" data-id="{{$color->id}}"
                                                    data-option="product-color" {{($isEditProduct && (int)
                                                    $optionValue['option_color']==(int) $color->id &&
                                                array_key_exists("option_color", $optionValue) ? "checked" : "")}}
                                                >
                                                <label for="sample-color-{{$colorKey}}"
                                                    href="{{$helpers->getThumbnail($color->color->color_image_id)}}"
                                                    src="{{$helpers->getImage($color->color->feature_image_id)}}"
                                                    value="{{$color->color->name}}" class="radio-label colorchange">
                                                    <div class="sample-color-img rounded">
                                                        <img class="rounded"
                                                            src="{{$helpers->getThumbnail($color->color->color_image_id)}}"
                                                            alt="Heyblinds-color-thumbnail-{{$color->color->name ?? ''}}" />
                                                    </div>
                                                    <p class="my-1">{{$color->color->name}} </p>
                                                    <input type="hidden" class="disclaimer"
                                                        value="{{$color->color->disclaimer}}">
                                                </label>
                                            </div>
                                            @if($color->color->out_of_stock == 1)
                                            <button type="button"
                                                class="btn btn-sm cart-sample-select-button out-of-stock">
                                                😞 Sample temporarily out of stock
                                            </button>
                                            @else
                                            @php
                                            $sample = $helpers->selectedSamapleCart(($product->id ?? 0),
                                            $_COOKIE['__sb_sample_cart'] ?? "", ($color->color->id ?? 0)) ?? false;
                                            @endphp
                                            <button type="button"
                                                class="btn btn-sm cart-sample-select-button  {{ $sample == true ? 'selected btn-primary' : 'btn-outline-primary' }}"
                                                {{ $sample==true ? 'selected' : '' }} data-pid="{{$product->id}}"
                                                value="{{$color->color->id}}" data-id="{{$color->color->id}}">
                                                {{$sample == true ? 'Sample Selected' : 'Order Free Sample'}}
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
                                        <div class="color-sidedar-big-image shadow-sm rounded position-relative">
                                            <img class="select-color-big-show rounded"
                                                src="{{$helpers->getImage($editProductColor->color->feature_image_id ?? 0)}}"
                                                alt="Heyblinds-color-image" />
                                            <div class="sample_order_description d-none">

                                                <p class="mb-0 text-white">Please order a free sample of this pattern to
                                                    see its actual proportions.</p>
                                            </div>
                                        </div>
                                        <div class="row g-3 pt-3">
                                            <div class="col-6">
                                                <div class="color-sidedar-small-image shadow-sm rounded">
                                                    <img class="rounded select-color-small-show"
                                                        src="{{$helpers->getImage($editProductColor->color->color_image_id ?? 0)}}"
                                                        alt="Heyblinds-color-color-image {{$editProductColor->color->name ?? ''}}" />
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


                @php
                $dupHeadlines = [];
                @endphp
                @foreach($groupHeadings as $fKey => $groupHeading)
                <div class="accordion-item ">
                    @foreach($groupHeading->option as $opt)
                    @if(!empty($opt->productOption) && $helpers->CheckOptionActive($product->id, $opt->id) == true &&
                    !in_array($groupHeading->group_heading, $dupHeadlines))
                    @php
                    $dupHeadlines[] = $groupHeading->group_heading ?? [];
                    @endphp
                    <h2 class="accordion-header mt-3" id="heading{{$fKey}}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{$fKey}}" aria-expanded="true" aria-controls="collapse{{$fKey}}">
                            <span class="d-flex align-items-center justify-content-center">
                                <img src="{{asset('images/tick.png')}}" alt="Heyblind-tik-image">
                            </span>
                            <div>{{$groupHeading->group_heading}}</div>
                        </button>
                    </h2>
                    @endif
                    @endforeach
                    <div id="collapse{{$fKey}}" class="accordion-collapse collapse border-0 show"
                        aria-labelledby="heading{{$fKey}}">
                        <div class="accordion-body py-0 ">
                            <div class="error d-flex justify-content-end mt-2">
                            </div>
                            @if(!empty($allGroups))
                            @php
                            $groupName = [];
                            @endphp
                            @foreach($allGroups as $groups)
                            @foreach($groups as $group)
                            @if(!empty($group->group_heading) &&
                            strtolower(Illuminate\Support\Str::slug($groupHeading->group_heading)) ===
                            strtolower(Illuminate\Support\Str::slug($group->group_heading)))
                            @foreach($group->option as $option)
                            <!-- check in option propoty -->
                            @if(!in_array($group->name, $groupName) && !empty($group->show_group_name)
                            && $helpers->CheckOptionActive($product->id, $option->id) == true
                            && $option->is_active == 1 && $group->show_group_name == true &&
                            !empty($group->option)
                            && $option->option_type!== "text" && $option->option_type!== "quantity")
                            @php
                            $groupName[] = $group->name ?? "";
                            @endphp
                            <h6 class="accodin-heading pb-2">{{$group->name }}
                                @if(!empty($group->content))
                                <span class="position-relative mousuhover-out">
                                    <span class="text-primary tooltip-hover question-icon px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
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
                                                    {!!$group->content ?? "" !!}
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
                            <div class="d-flex flex-wrap {{$group->slug}}"
                                data-name="group_{{Illuminate\Support\Str::slug($group->name, '_')}}"
                                data-slug="{{$group->slug}}" data-type="{{$group->name}}" data-id="{{$group->id}}"
                                data-option="{{" group:$group->id"}}">
                                @foreach($group->option as $option)
                                @if($helpers->CheckOptionActive($product->id, $option->id) == true && $option->is_active
                                == true )
                                @php
                                $optionArrayForJs[($option->option_type ?? "")][] =
                                "option_".Illuminate\Support\Str::slug(($group->name ?? ""), '_');
                                $minAndMaxCheck = $product->getMinAndMax($product->id, $option->id) ?? 0;

                                $minAndMaxHeightCheck = $product->getMinAndMaxHeight($product->id, $option->id) ?? 0;
                               
                                if (!empty($minAndMaxCheck) && $minAndMaxCheck!==0 )
                                    $splitWidth = explode('-', $minAndMaxCheck['width']);
                                else
                                    $splitWidth = explode('-', ($width ?? 0));
                                    $splitHeight = explode('-', ($height ?? 0));

                                if (!empty($minAndMaxHeightCheck) && $minAndMaxHeightCheck!==0 )
                                    $splitHeight = explode('-', $minAndMaxHeightCheck['width']);
                                else
                                    $splitHeight = explode('-', ($height ?? 0));
                                @endphp






                                @php
                                $optionName = "option_".Illuminate\Support\Str::slug(($group->name ?? ""), '_');
                                if (!empty($isEditProduct)){
                                $cartOptionName = !empty($optionValue[$optionName]) ? $optionValue[$optionName] : "";
                                }
                                @endphp
                                @if($option->option_type === "width")
                                @php
                                $optionArrayForJs['select'][] = "option_width";
                                @endphp
                                <div class="col-lg-5 col-md-6 pb-2 pb-md-0">
                                    <div class="row pt-2">
                                        <div class="col-6 col-lg-5">
                                            <div class="width-graphic-image">
                                                <img class="" src="{{$helpers->getThumbnail($option->media_id)}}"
                                                    alt="heyblinds-option-{{$option->name ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-6 pt-sm-3 pt-sm-0 pb-2 pb-sm-0 col-lg-6">
                                            <div class="row g-2 align-items-end">
                                                <div class="col-12 wh-tool">
                                                    <h5
                                                        class="border-start border-primary border-4 px-2 label-aria-text">
                                                        Width:
                                                        @if(!empty($option->tooltip_media_id) ||
                                                        !empty($option->content))
                                                        <span class="position-relative wh-tool mousuhover-out">
                                                            <span class="text-primary tooltip-hover question-icon px-2">
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

                                                                        @if(!empty($option->tooltip_media_id))
                                                                        <div class="col-12">
                                                                            <img class="w-100 rounded img-fluid"
                                                                                src="{{$helpers->getImage($option->tooltip_media_id)}}"
                                                                                alt="heyblinds-tooltip-name">
                                                                        </div>
                                                                        @endif

                                                                        <div class="col-sm-12">
                                                                            @if(!empty($option->content))
                                                                            {!!$option->content ?? "" !!}
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                        </span>
                                                        @endif
                                                    </h5>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating width-select-fild">
                                                        <select class="form-select product-width" name="option_width"
                                                            data-type="{{$option->name}}"
                                                            data-group="{{Illuminate\Support\Str::slug($group->name)}}"
                                                            data-slug="{{$option->slug}}"
                                                            data-value="{{$product->default_width}}"
                                                            data-id="{{$option->id}}" data-option="product-width">
                                                            @for($w = $splitWidth[0]; $w <= $splitWidth[1]; $w++ )
                                                                @if(!empty(Session::get('session_width')) && !$isEditProduct && Session::get('session_width') <= $splitWidth[1]))
                                                                <option value="{{ $w }}" {{ $w == Session::get('session_width')?? 24 ? 'selected' : '' }}>{{ $w }}</option>

                                                                @else
                                                                <option value="{{$w}}" {{ ($isEditProduct && ((int)
                                                                (!empty($getWidth) && $getWidth>= $splitWidth[0] ? (int)
                                                                $getWidth : (int) $optionValue['option_width']) == $w )
                                                                && array_key_exists("option_width", $optionValue) ?
                                                                "checked" : "") ? "selected" : ((!empty($getWidth) &&
                                                                $getWidth >= $splitWidth[0] ? (int) $getWidth :
                                                                $defaultWidth) == $w ? "selected" : "") }}>{{$w}}
                                                                </option>
                                                                @endif
                                                                @endfor
                                                        </select>
                                                        <label for="floatingSelectGrid">Inches </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating width-select-fild">
                                                        <select class="form-select product-width-fractions"
                                                            name="option_width_fraction"
                                                            data-group="{{Illuminate\Support\Str::slug($group->name)}}"
                                                            data-type="width-fractions" data-slug="{{$option->slug}}"
                                                            data-id="{{$option->id}}"
                                                            data-option="option:{{$option->id}}">
                                                            <option value="">0/0</option>
                                                            <option value="1/8" {{(isset ($optionValue['option_width_fraction']) &&

                                                            $optionValue['option_width_fraction']  == "1/8"
                                                            ? "selected"  : '') || !$isEditProduct && Session::get('session_width_fraction') == '1/8' ? 'selected' : ''}}>1/8</option>
                                                            <option value="1/4" {{( isset ($optionValue['option_width_fraction']) &&
                                                                $optionValue['option_width_fraction']  == "1/4"
                                                                ? "selected" : '') || !$isEditProduct && Session::get('session_width_fraction') == '1/4' ? 'selected' : '' }}>1/4</option>
                                                            <option value="3/8" {{(isset ($optionValue['option_width_fraction']) &&
                                                                $optionValue['option_width_fraction']  =="3/8"
                                                                ? "selected" : "" ) || !$isEditProduct && Session::get('session_width_fraction') == '3/8' ? 'selected' : ''}}>3/8</option>
                                                            <option value="1/2" {{(isset ($optionValue['option_width_fraction']) &&
                                                                $optionValue['option_width_fraction']  == "1/2"
                                                                 ? "selected"
                                                                : "" ) || Session::get('session_width_fraction') == '1/2' ? 'selected' : ''}}>1/2</option>
                                                            <option value="5/8" {{(isset ($optionValue['option_width_fraction']) &&
                                                                $optionValue['option_width_fraction'] == "5/8"
                                                                ? "selected" : "") || !$isEditProduct && Session::get('session_width_fraction') == '5/8' ? 'selected' : ''}}>5/8</option>
                                                            <option value="3/4" {{(isset ($optionValue['option_width_fraction']) &&
                                                                $optionValue['option_width_fraction'] == "3/4"
                                                                ? "selected" : "") || !$isEditProduct && Session::get('session_width_fraction') == '3/4' ? 'selected' : ''}}>3/4 </option>
                                                            <option value="7/8" {{(isset ($optionValue['option_width_fraction']) &&
                                                                $optionValue['option_width_fraction']  == "7/8"
                                                                ? "selected" : "") || !$isEditProduct && Session::get('session_width_fraction') == '7/8' ? 'selected' : ''}}>7/8 </option>

                                                        </select>
                                                        <label for="floatingSelectGrid">Fractions</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($option->option_type === "height")

                                @php
                                $optionArrayForJs['select'][] = "option_height";
                                @endphp

                                <div class="col-lg-1 d-none d-lg-block"></div>
                                <div class="col-lg-5 col-md-6">
                                    <div class="row pt-2">
                                        <div class="col-6 col-lg-5">
                                            <div class="width-graphic-image">
                                                <img src="{{$helpers->getThumbnail($option->media_id)}}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-6 pt-3 pt-sm-0 pb-2 pb-sm-0 col-lg-6">
                                            <div class="row g-2 align-items-end">
                                                <div class="col-12">
                                                    <h5
                                                        class="border-start border-primary border-4 px-2 label-aria-text">
                                                        Height:
                                                        @if(!empty($option->tooltip_media_id) ||
                                                        !empty($option->content))
                                                        <span class="position-relative wh-tool mousuhover-out">
                                                            <span class="text-primary tooltip-hover question-icon px-2">
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

                                                                        @if(!empty($option->tooltip_media_id))
                                                                        <div class="col-12">
                                                                            <img class="w-100 rounded img-fluid"
                                                                                src="{{$helpers->getImage($option->tooltip_media_id)}}"
                                                                                alt="">
                                                                        </div>
                                                                        @endif

                                                                        <div class="col-sm-12">
                                                                            @if(!empty($option->content))
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
                                                    <div class="form-floating width-select-fild">
                                                        <select class="form-select product-height" name="option_height"
                                                            data-group="{{Illuminate\Support\Str::slug($group->name)}}"
                                                            data-type="{{$option->name}}" data-id="{{$option->id}}"
                                                            data-option="option:{{$option->id}}">
                                                            @for($h = $splitHeight[0]; $h < $splitHeight[1]+1; $h++ )
                                                                @if(!empty(Session::get('session_height')) && !$isEditProduct && Session::get('session_height') <= $splitHeight[1]))
                                                                    <option value="{{ $h }}"
                                                                    {{ $h == Session::get('session_height') ?? 36 ? 'selected' : '' }}>{{ $h }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{$h}}" {{ ($isEditProduct && ((int)
                                                                    (!empty($getHeight) && $getHeight>= $splitWidth[0] ?
                                                                    (int) $getHeight : (int) $optionValue['option_height'])
                                                                    == $h ) && array_key_exists("option_height",
                                                                    $optionValue) ? "checked" : "") ? "selected" :
                                                                    ((!empty($getHeight) && $getHeight >= $splitWidth[0] ?
                                                                    (int) $getHeight : $defaultHeight) == $h ? "selected" :
                                                                    "") }}>{{$h}}</option>
                                                                    @endif
                                                                @endfor
                                                        </select>
                                                        <label for="floatingSelectGrid">Inches </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating width-select-fild">
                                                        <select class="form-select product-height-fractions"
                                                            name="option_height_fraction"
                                                            data-group="{{Illuminate\Support\Str::slug($group->name)}}"
                                                            data-type="height-fractions" data-id="{{$option->id}}"
                                                            data-option="option:{{$option->id}}">
                                                            <option value="">0/0</option>
                                                            <option value="1/8" {{(isset ($optionValue['option_height_fraction']) &&
                                                            $optionValue['option_height_fraction']  == "1/8"
                                                            ? "selected"  : '') ||!$isEditProduct && Session::get('session_height_fraction') == '1/8' ? 'selected' : ''}}>1/8</option>
                                                            <option value="1/4" {{(isset ($optionValue['option_height_fraction']) &&
                                                            $optionValue['option_height_fraction']  == "1/4"
                                                            ? "selected"  : '') || !$isEditProduct && Session::get('session_height_fraction') == '1/4' ? 'selected' : ''}}>1/4</option>
                                                            <option value="3/8" {{(isset ($optionValue['option_height_fraction']) &&
                                                            $optionValue['option_height_fraction']  == "3/8"
                                                            ? "selected"  : '') || !$isEditProduct && Session::get('session_height_fraction') == '3/8' ? 'selected' : ''}}>3/8</option>
                                                            <option value="1/2" {{(isset ($optionValue['option_height_fraction']) &&
                                                            $optionValue['option_height_fraction']  == "1/2"
                                                            ? "selected"  : '') || !$isEditProduct && Session::get('session_height_fraction') == '1/2' ? 'selected' : ''}}>1/2</option>

                                                            <option value="5/8" {{(isset ($optionValue['option_height_fraction']) &&
                                                            $optionValue['option_height_fraction']  == "5/8"
                                                            ? "selected"  : '') || !$isEditProduct && Session::get('session_height_fraction') == '5/8' ? 'selected' : ''}}>5/8</option>
                                                            <option value="3/4" {{(isset ($optionValue['option_height_fraction']) &&
                                                            $optionValue['option_height_fraction']  == "3/4"
                                                            ? "selected"  : '') || !$isEditProduct && Session::get('session_height_fraction') == '3/4' ? 'selected' : ''}}>3/4</option>
                                                            <option value="7/8" {{(isset ($optionValue['option_height_fraction']) &&
                                                            $optionValue['option_height_fraction']  == "7/8"
                                                            ? "selected"  : '') || !$isEditProduct && Session::get('session_height_fraction') == '7/8' ? 'selected' : ''}}>7/8</option>
                                                        </select>
                                                        <label for="floatingSelectGrid">Fractions</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- headerail section start -->
                               {{--  @if( $product->subCategory->slug == 'roman-shades') --}}
                                <div class="col-12">
                                    @include('frontend.product.headrail')
                                </div>
                               {{--  @endif --}}


                                <!--headerail section end -->
                                @elseif($option->option_type === "number")
                                <div class="col-lg-6">
                                    <h6 class="accodin-heading pt-3">{{$group->name }}
                                        <span class="position-relative">
                                            @if(!empty($option->tooltip_media_id) || !empty($option->content))
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
                                                            @if(!empty($option->tooltip_media_id))
                                                            <div class="col-12">
                                                                <img class="w-100 rounded img-fluid"
                                                                    src="{{$helpers->getImage($option->tooltip_media_id)}}"
                                                                    alt="">
                                                            </div>
                                                            @endif
                                                            <div class="col-sm-12">
                                                                @if(!empty($option->content))
                                                                {!! $option->content ?? "" !!}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                            @endif
                                        </span>
                                    </h6>
                                    <hr class="my-2">
                                    <div class="row pt-2">
                                        <div class="col-lg-6">
                                            <div class="quantity">
                                                <input class="count form-control pe-5" type="number"
                                                    value="{{!empty($isEditProduct) && !empty($cartOptionName) && array_key_exists($optionName, $optionValue)}}"
                                                    min="1" max="100"
                                                    data-group="{{Illuminate\Support\Str::slug($group->name)}}"
                                                    name="{{$optionName}}" data-type="{{$option->name}}"
                                                    data-slug="{{$option->slug}}" data-id="{{$option->id}}"
                                                    data-option="{{!empty($option->price) ? "
                                                    option:$option->id" : ""}}"
                                                >
                                                <button type="button" id="add" class="add">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-caret-up-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button type="button" id="sub" class="sub">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-caret-down-fill"
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
                                @elseif($option->option_type === "quantity")
                                <div class="col-sm-6">
                                    <h6 class="accodin-heading pt-3">{{$group->name }}
                                        @if(!empty($option->tooltip_media_id) || !empty($option->content))
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
                                                        @if(!empty($option->tooltip_media_id))
                                                        <div class="col-12">
                                                            <img class="w-100 rounded img-fluid"
                                                                src="{{$helpers->getImage($option->tooltip_media_id)}}"
                                                                alt="">
                                                        </div>
                                                        @endif

                                                        <div class="col-sm-12">
                                                            @if(!empty($option->content))
                                                            {!! $option->content ?? "" !!}}
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
                                                <input class="count form-control pe-5" name="product_quantity"
                                                    data-group="{{Illuminate\Support\Str::slug($group->name)}}"
                                                    type="text" id="product_quantity"
                                                    value="{{($isEditProduct && !empty($cartOptionName) && array_key_exists($optionName, $optionValue) ? $cartOptionName : 1)}}"
                                                    min="1" max="100">
                                                <button type="button" id="add" class="add">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-caret-up-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button type="button" id="sub" class="sub">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-caret-down-fill"
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
                                @elseif($option->option_type === "text")
                                <div class="col-lg-6">
                                    <h6 class="accodin-heading pt-3">{{$group->name }}
                                        @if(!empty($option->tooltip_media_id) || !empty($option->content))
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

                                                        @if(!empty($option->tooltip_media_id))
                                                        <div class="col-12">
                                                            <img class="w-100 rounded img-fluid"
                                                                src="{{$helpers->getImage($option->tooltip_media_id)}}"
                                                                alt="" />
                                                        </div>
                                                        @endif
                                                        <div class="col-sm-12">
                                                            @if(!empty($option->content))
                                                            {!!$option->content ?? "" !!}
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
                                            <input class="form-control" type="{{$option->option_type}}"
                                                placeholder="{{$option->name}}"
                                                data-group="{{Illuminate\Support\Str::slug($group->name)}}"
                                                data-slug="{{$option->slug}}" name="{{$optionName}}"
                                                data-type="{{$option->name}}" data-id="{{$option->id}}"
                                                data-option="{{!empty($option->price) ? " option:$option->id"
                                            : ""}}"
                                            value="{{($isEditProduct && !empty($cartOptionName) &&
                                            array_key_exists($optionName, $optionValue) ? $cartOptionName : "")}}"
                                            >
                                        </div>
                                    </div>
                                </div>
                                @elseif($option->option_type === "radio" || $option->option_type === "checkbox" )
                                @php
                                $splitMinAndMax = $product->getMinAndMax($product->id, ($option->id ?? 0));
                                $defaultWidthSplit = $product->default_width;
                                if (!empty($splitMinAndMax))
                                $splitSize = explode('-', $splitMinAndMax['width']);
                                else
                                $splitSize = "";
                                @endphp
                                <div class="sample-side-box border m-2 lift-choose-box">
                                    <div class="rounded  p-2">
                                        <div class="radio m-0 check-position">
                                            <input id="sample-side-{{$option->id}}" value="{{$option->id}}"
                                                name="{{$optionName}}"
                                                data-group="{{Illuminate\Support\Str::slug($group->name)}}"
                                                data-slug="{{$option->slug}}" type="{{$option->option_type}}"
                                                data-type="{{$option->name}}" data-id="{{$option->id}}"
                                                data-option="{{!empty($option->price) ? " option:$option->id"
                                            : ""}}"
                                            {{(!empty($splitSize[0]) && !empty($splitSize[1])) &&
                                            ((int)$defaultWidthSplit < (int) $splitSize[0] && (int)$defaultWidthSplit <
                                                (int)$splitSize[1]) ? "disabled" : "" }} {{($isEditProduct &&
                                                !empty($cartOptionName) && $cartOptionName==$option->id &&
                                                array_key_exists($optionName, $optionValue)) ? "checked" : ""}}
                                                {{@$option->is_always_included ? "checked" : ""}}
                                                >

                                                <label for="sample-side-{{$option->id}}" class="radio-label"
                                                    {{(!empty($splitSize[0]) && !empty($splitSize[1])) &&
                                                    ((int)$defaultWidthSplit < (int)$splitSize[0] &&
                                                    (int)$defaultWidthSplit < (int)$splitSize[1]) ? "style=opacity:0.3"
                                                    : "" }}>
                                                    <div class="sample-features-img rounded">
                                                        <img class="rounded"
                                                            src="{{$helpers->getThumbnail($option->media_id)}}" alt="">
                                                    </div>
                                                    <div class="mt-2 mb-0 position-relative">
                                                        <span class="h6 fw-bold">{{$option->name}}</span>
                                                        @if(!empty($option->tooltip_media_id) ||
                                                        !empty($option->content))
                                                        <span class="d-inline position-relative mousuhover-out">
                                                            <span class="text-primary tooltip-hover question-icon px-2">
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
                                                                        @if(!empty($option->tooltip_media_id))
                                                                        <div class="col-12">
                                                                            <img class="w-100 rounded img-fluid"
                                                                                src="{{$helpers->getImage($option->tooltip_media_id)}}"
                                                                                alt="">
                                                                        </div>
                                                                        @endif
                                                                        <div class="col-sm-12">
                                                                            @if(!empty($option->content))
                                                                            @php echo $option->content ?? ""; @endphp

                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </span>
                                                        @endif
                                                        @if(empty($option->price))
                                                        <br>
                                                        <span>Free</span>
                                                        @endif
                                                    </div>
                                                </label>
                                        </div>
                                        <div>
                                            @if(!empty($option->subOption))
                                            @php $subOptionNew = []; @endphp
                                            @foreach($option->subOption as $subOptions)
                                            @php
                                            $subOptionNew[Illuminate\Support\Str::slug($subOptions->sub_group_id)][$subOptions->sub_option_type][]
                                            = $subOptions ?? [];
                                            @endphp
                                            @endforeach

                                            @foreach( $subOptionNew as $getSubOption)
                                            @foreach($getSubOption as $subOptionKey => $subOpts)
                                            @foreach($subOpts as $subOps)
                                            @if($loop->first)
                                            <label
                                                class="mt-2 fw-bold text-black-50 mb-0 option-sub-option-title">{{$subOps->sub_group_id}}</label>
                                            @endif
                                            @endforeach
                                            @php
                                            $checkDuplicateSubOption = [];
                                            @endphp
                                            @php
                                            $optionName =
                                            "suboption_".Illuminate\Support\Str::slug(($subOps->sub_group_id ?? ""),
                                            '_');
                                            if (!empty($isEditProduct)){
                                            $cartOptionValue = $optionValue[$optionName] ?? null;
                                            }
                                            @endphp
                                            @if($subOptionKey === "dropdown")
                                            <select
                                                name="suboption_{{Illuminate\Support\Str::slug($subOps->sub_group_id, '_')}}"
                                                class="form-select" {{($isEditProduct && array_key_exists($optionName,
                                                $optionValue) && $cartOptionName==$option->id) ||
                                                (@$option->is_always_included) ? "" : "disabled"}}
                                                >
                                                <option value="">--Select--</option>
                                                @foreach($subOpts as $subOps)
                                                @if(!empty($subOps->sub_option_name) &&
                                                !in_array($subOps->sub_option_name ?? "", $checkDuplicateSubOption))
                                                @php
                                                $checkDuplicateSubOption[] = ($subOps->sub_option_name ?? "");
                                                @endphp
                                                <option value="{{$subOps->id}}" {{($isEditProduct &&
                                                    !empty($cartOptionValue) && $cartOptionValue==$subOps->id &&
                                                    array_key_exists($optionName, $optionValue) ? "selected" : "")}}
                                                    >
                                                    {{$subOps->sub_option_name}}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @elseif($subOptionKey === "number")
                                            @foreach($subOpts as $subOps)
                                            <input type="number"
                                                name="suboption_{{Illuminate\Support\Str::slug($subOps->sub_group_id, '_')}}"
                                                class="form-control"
                                                value="{{($isEditProduct && !empty($cartOptionValue) && array_key_exists($optionName, $optionValue) ? $cartOptionValue : $subOps->sub_option_name)}}"
                                                {{($isEditProduct && !empty($cartOptionValue) &&
                                                array_key_exists($optionName, $optionValue)) ||
                                                @$option->is_always_included ? "" : "disabled"}}
                                            >
                                            @endforeach
                                            @elseif($subOptionKey === "radio")
                                            @foreach($subOpts as $subOps)
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                    name="suboption_{{Illuminate\Support\Str::slug($subOps->sub_group_id, '_')}}"
                                                    type="radio" value="{{$subOps->id}}"
                                                    id="flexRadioDefault-{{$subOps->id}}" {{($isEditProduct &&
                                                    !empty($cartOptionValue) && $cartOptionValue==$subOps->id &&
                                                array_key_exists($optionName, $optionValue) ? "checked" : "")}}
                                                {{($isEditProduct && !empty($cartOptionValue) && $cartOptionValue ==
                                                $subOps->id && array_key_exists($optionName, $optionValue)) ||
                                                @$option->is_always_included ? "" : "disabled"}}
                                                >
                                                <label class="form-check-label" for="flexRadioDefault-{{$subOps->id}}">
                                                    {{$subOps->sub_option_name}}
                                                </label>
                                            </div>
                                            @endforeach
                                            @elseif($subOptionKey === "checkbox")
                                            @foreach($subOpts as $subOps)
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                    name="suboption_{{Illuminate\Support\Str::slug($subOps->sub_group_id, '_')}}"
                                                    type="checkbox" value="{{$subOps->id}}"
                                                    id="flexCheckDefault-{{$subOps->id}}" {{($isEditProduct &&
                                                    !empty($cartOptionValue) && $cartOptionValue==$subOps->id &&
                                                array_key_exists($optionName, $optionValue) ? "checked" : "")}}
                                                {{($isEditProduct && !empty($cartOptionValue) && $cartOptionValue ==
                                                $subOps->id && array_key_exists($optionName, $optionValue)) ||
                                                @$option->is_always_includedF ? "" : "disabled"}}
                                                >
                                                <label class="form-check-label" for="flexCheckDefault-{{$subOps->id}}">
                                                    {{$subOps->sub_option_name}}
                                                </label>
                                            </div>
                                            @endforeach
                                            @endif
                                            @endforeach
                                            @endforeach
                                            @endif
                                        </div>

                                    </div>

                                </div>
                                @elseif($option->option_type === "warranty")
                                <div class="row justify-content-center align-items-center w-100">
                                    <div class="col-auto">
                                        <img src="{{$helpers->getThumbnail($option->media_id)}}" alt="">
                                    </div>

                                    <div class="col-sm-8 col-lg-5 col-md-6 col-xl-4">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="radio">
                                                    <input id="radio-{{$option->id}}" name="option_warranty"
                                                        type="radio" checked value="1">
                                                    <label for="radio-{{$option->id}}" class="radio-label"><span
                                                            class="cross-text pe-1">7</span>
                                                        {{$option->name}}
                                                        @if(!empty($option->tooltip_media_id) ||
                                                        !empty($option->content))
                                                        <span class="position-relative mousuhover-out">
                                                            <span class="text-primary tooltip-hover question-icon px-2">
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

                                                                        @if(!empty($option->tooltip_media_id))
                                                                        <div class="col-12">
                                                                            <img class="w-100 rounded img-fluid"
                                                                                src="{{$helpers->getImage($option->tooltip_media_id)}}"
                                                                                alt="">
                                                                        </div>
                                                                        @endif
                                                                        <div class="col-sm-12">
                                                                            @if(!empty($option->content))
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
                                                <h5 class="mb-0 font-secondary text-primary fw-bold">
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
                                {{--@endforeach--}}
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
        @include('frontend.product.tab')
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
jQuery(function ($) {
        getPrice('option_width');
    var labels = [];
    for (var i = 0; i <= 102; i += 20) {
        labels.push(i);
    }
    function cartOffset() {
        if ($('#product-cart-box').offset().top + $('#product-cart-box').height() >= $('#footer').offset().top - 10)
            $('#product-cart-box').css('position', 'absolute').removeClass('product-cart-fixd');
        if ($(document).scrollTop() + window.innerHeight < $('#footer').offset().top)
            $('#product-cart-box').css('position', 'fixed').addClass('product-cart-fixd');
    }
    $(document).scroll(function () {
        cartOffset();
    });

$(document).on('click', '.more_click', function(){
    let target = $('#product-details-nav-section');
    if (target.length) {
        $('html,body').animate({
            scrollTop: target.offset().top - 100
        }, 500);
        return false;
    }
});
$(document).on('click', '.order-sample-btn', function(){
    let target = $('#product-option');
    if (target.length) {
        $('html,body').animate({
            scrollTop: target.offset().top - 100
        }, 500);
        return false;
    }
});

$(document).on('click', function (e){
    let $target = e.target,
    data = e.target.dataset;
    if ($target.tagName === "SELECT"){

        $($target).on('change', function (event) {
            event.preventDefault(); event.stopPropagation(); event.stopImmediatePropagation();
            let $this = $(this);
            if ($this.attr('name') === "option_width" || $this.attr('name') === "option_height" || $this.attr('name') === "option_width_fraction" || $this.attr('name') === "option_height_fraction"){
                if ($(".product-width option:last").is(":selected")){
                    $(".product-width-fractions[name=option_width_fraction]").prop("selectedIndex", 0).css('pointer-events', 'none')
                }else{
                    $(".product-width-fractions[name=option_width_fraction]").css('pointer-events', 'auto')
                }
                if ($(".product-height option:last").is(":selected")){
                    $(".product-height-fractions[name=option_height_fraction]").prop("selectedIndex", 0).css('pointer-events', 'none')
                }else{
                    $(".product-height-fractions[name=option_height_fraction]").css('pointer-events', 'auto')
                }
                getPrice('option_width');
            }else {
                getPrice();
            }
            localStorage.setItem($this.attr('name'), $this.val());
        });
    }else if(($target.tagName === "INPUT" && $target.type === "radio" && $target.checked )|| ($target.tagName === "INPUT" && $target.type === "checkbox" && $target.checked)){
        $($target).on('click', function (event) {
            event.stopPropagation(); event.stopImmediatePropagation();
            let $this = $(this);
            if ($target.type === "checkbox"){
                let group = "input:checkbox[name='"+$this.prop("name")+"']";
                $(group).not(this).prop("checked",false);
            }
            let parentClass = '.' + $this.attr('data-group'),
                    checkSelectors = $this.parents(parentClass).find('input, checkbox', 'select'); //.find('input, checkbox').next().find('input, select')
                    jQuery.each(checkSelectors, function (){
                    $(this).parent('.check-position').next().find('input, select').attr('disabled','disabled');
                    $(this).find('.option-sub-option-required').remove();
                })

                    let allSiblings = $this.parent('.check-position').next().find('input, select');
                    if (allSiblings.length > 0){
                    jQuery.each(allSiblings, function (){
                        $(this).removeAttr('disabled');
                        $(this).prev().find('span').remove();
                        $(this).prev().append('<span class="text-danger fw-bold ms-0 fs-5 option-sub-option-required">*</span>')
                        if ($(this).prop("tagName") === "SELECT"){
                            allData['select'].push($(this).attr('name'))
                        }else if($(this).prop("tagName") === "INPUT" && $(this).prop("type") === "checkbox"){
                            allData['checkbox'].push($(this).attr('name'))
                        }else if($(this).prop("tagName") === "INPUT" && $(this).prop("type") === "radio"){
                            allData['radio'].push($(this).attr('name'))
                        }else if($(this).prop("tagName") === "INPUT" && $(this).prop("type") === "text"){
                            allData['text'].push($(this).attr('name'))
                        }
                    })
                }

                let hb_last_data = sessionStorage.getItem('hb_last_data');
                if (hb_last_data){
                    let getParseObject = JSON.parse(hb_last_data);
                    jQuery.each(getParseObject, function (index, value) {
                        let selector = $('input[name="'+value.name+'"]');
                        jQuery.each(selector, function () {
                            $(this).removeAttr('disabled').siblings('label').css('opacity', '1');
                        })
                    })
                }
                getPrice()
            }).trigger('click');
    }
})
getPrice(null)
function getPrice(extra){

    let formData;
    if (extra === "option_width"){
        let Select = $(document).find('input, select'),
        array = {}
        $.each(Select, function () {
            let $this = $(this),
            name = $this.attr('name');
            if ($this.prop('tagName') === "INPUT" && $this.is(':checked') ){
                array[name] = $this.val()
            }else if($this.prop('tagName') === "SELECT" &&  $this.val() !== ""){
                array[name] = $this.val()
            }
        })
        array['extra'] = 'option_width';
        formData = array
    }else{
        let form = $("#productDetails");
        formData = new FormData(form[0]);
        formData.append('extra', extra)
    }
    let data = formData,
    url =  '{{route('frontend.product.get.price', $product->id)}}';
    success_callback(url, data, function (response) {
        let data = response.data;
        action(data)
        $("#loader").hide();
    }, function (error) {
        $("#loader").hide();
    })
}

function action(data){
    let price = $("#displayPrice, #finalPriceAfterDiscount");
    price.empty().text("$"+data.price)
    $("#totalUnitPrice").empty().text("$"+data.unitPrice)
    $("#AddToCartValue").empty().val(data.price)
    $("#AddToCartUnitPrice").empty().val(data.unitPrice)
    $("#measurement_price").empty().val(data.measurement)
    let options = data.option;
    if (options.width){
        let width = options.width;
        jQuery.each(width, function (ind, val) {
            if ((val.action === "disabled" || val.action === "enabled" ) && val.type !== "dropdown" && val.type !== "warranty") {
                let selector = $('input[type="radio"], input[type="checkbox"]');
                jQuery.each(selector, function () {
                    let $this = $(this);
                    if ($this.is(":checked") && $this.attr('name') !== "option_color"){
                       // $this.prop('checked', false);
                        let checkSubOptions = $this.parent().next().find('select');
                        if (checkSubOptions){
                            jQuery.each(checkSubOptions, function () {
                               // $(this).prop("selectedIndex", 0).attr('disabled', 'disabled')
                            })
                        }
                    }
                    if ($this.attr('name') === val.name && parseInt($this.val()) === val.value && $this.attr('data-type') === val.option_name) {
                        if (val.action === "enabled") {
                            $this.removeAttr('disabled').siblings('label').css('opacity', '1');
                            $this.removeAttr('readonly').siblings('label').css('opacity', '1').removeClass('pointer-none');
                        } else {
                            //$this.attr('disabled', 'disabled').siblings('label').css('opacity', '0.3'); // pervious code.
                            $this.attr('readonly', true).siblings('label').css('opacity', '0.3').addClass('pointer-none');
                            $this.prop('checked', false);
                        }
                    }
                })
            }
        })
    }
    if (options){
        let $sessionStorage = [];
        jQuery.each(options, function (key, value) {
            if ((value.action === "disabled" || value.action === "enabled" ) && value.type !== "dropdown" && value.type !== "warranty") {
                let selector = $('input[type="'+value.type+'"]');
                jQuery.each(selector, function () {
                    let $this = $(this);
                    if ($this.attr('name') === value.name && parseInt($this.val()) === value.value && $this.attr('data-type') === value.option_name){
                        if ($this.is(":checked")){
                           // $this.prop('checked', false);
                        }
                        if (value.action === "enabled"){
                            $this.removeAttr('disabled').siblings('label').css('opacity', '1');
                        }else{
                           //$this.attr('disabled','disabled').siblings('label').css('opacity', '0.3');
                        }
                        $sessionStorage.push ({
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
const  quotient = (pole) => {
  const poleArr = pole.split('/');
  const divident = parseInt(poleArr[0]);
  const divisor = parseInt(poleArr[1]);
  let quotient;
  if(divident===0 & divisor===0){
      quotient = 0
  } else {
      quotient = divident / divisor;
  }
  return quotient
}

const headrail_min_width_second = "{{ $headrails->min('min_width') }}";

$(document).on('click', '#addToCart', function(e){
    e.preventDefault();
    let check = true;
    var handrail_value = $('[name=headrail_option]:checked').val();
    var option_width = parseInt($('[name=option_width]').val());
    var headrail_left_filter_width = parseInt($('[name=headrail_left_filter_width]').val());
    var headrail_filter_right_width = parseInt($('[name=headrail_filter_right_width]').val());

    var headrail_width_fraction_val = $('#headrail_width_fraction_val').val();

    var  option_width_fraction = $('[name=option_width_fraction]').val();
    if(option_width_fraction == ''){
        option_width_fraction = '0/0';
    }
    var option_height_fraction = $('[name=option_height_fraction]').val();
    if(option_height_fraction == ''){
        option_height_fraction = '0/0';
    }
    var headrail_filter_right_fraction = $('#headrail_filter_right_fraction').val();

    if(handrail_value == 1){
        var option_divided = option_width / 2;
        if(option_width <= parseInt(headrail_min_width_second) - 1  ){
            $('#heardrailerror').html(`<div class="alert py-2 px-5 alert-danger" role="alert"> Minimum width must ${headrail_filter_right_fraction} be inches </div>`);
            check = false;
            $(window).scrollTop($(`.error .alert, #heardrailerror .alert`).offset().top - 150);

        }
        if(option_width >=  parseInt(headrail_min_width_second) - 1){
            $('#heardrailerror').html('');
            check = true;
        }
        const leftSideWidthFraction = quotient(headrail_width_fraction_val);
        const rightSideWidthFraction = quotient(headrail_filter_right_fraction);
        const globalWidthFraction = quotient(option_width_fraction);

        const totalGlobalWidthWithFraction = option_width + globalWidthFraction;
        const totalSideWidthWithFraction = headrail_left_filter_width + headrail_filter_right_width + leftSideWidthFraction + rightSideWidthFraction

        if(totalGlobalWidthWithFraction !== totalSideWidthWithFraction){
            check = false;
            // $('#heardrailerror').html(`<div class="alert py-2 px-5 alert-danger" role="alert"> Your Left and Right blind width does not equal your overall width of ${option_width} inches.</div>`);
            $('#heardrailerror').html(`<div class="alert py-2 px-5 alert-danger" role="alert"> Your Headrail widths do not equal your total window width, please adjust your measurements.</div>`);
            $(window).scrollTop($(`.error .alert, #heardrailerror .alert`).offset().top - 150);
        }
    }
    jQuery.each(allData, function (index, value) {
        if (index === "radio" || index === "text" || index === "select"  || index === "checkbox") {
            var unique = value.filter(onlyUnique);
            jQuery.each(unique.reverse(), function (ind, val) {
                let $this = $("[name=" + val + "]");
                let error = $this;
                text = val.replace('suboption_', '').replace('option_', '').replace('_', ' ').toLowerCase().replace(/\b[a-z]/g, function(txtVal) {
                   // return txtVal.toUpperCase();
                    return txtVal;
                });
                if (!$this.is(':disabled') && (($this.prop('type') === "radio" && !$this.is(":checked")) || ($this.prop('type') === "checkbox" && !$this.is(":checked")) || ($this.prop('type') === "text" && $this.val() === "") || ($this.prop('type') === "select-one" && $this.val() === ""))){
                    check = false;
                    let name = error.prop('name');
                    if($('.alertRemove').length){
                        $('.alertRemove').remove();
                    }
                    $(`[name=${name}`).parents('.accordion-body').find('.error').append(`<div class="alert alert-danger alertRemove px-5 py-2" role="alert">Please select the ${text}.</div>`);

                }
            })
        }
    })

     // To open collapse
    let parentCollapseElem;
    const alertElem = document.querySelector('.alertRemove');
    if(alertElem){
        parentCollapseElem = alertElem.closest('.collapse:not(.show)');
    }

    if(parentCollapseElem){
        const parentCollapseElemInstance = bootstrap.Collapse.getInstance(parentCollapseElem);
        parentCollapseElemInstance.show();
    }

    if($(`.error .alert, #heardrailerror .alert`).length){
        $(window).scrollTop($(`.error .alert, #heardrailerror .alert`).offset().top - 150);
    }
    // To open collapse end

    if (check){
        $('.alertRemove').remove();
        let $this = $(this),
        form = $this.parents('form'),
        formData = new FormData(form[0]);
        if(handrail_value == 0){
            const deleteData = ['headrail_filter_width', 'headrail_width_fraction_val', 'headrail_left_lift_position', 'headrail_filter_right_width', 'headrail_price','headrail_filter_right_fraction','headrail_left_filter_width','headrail_right_lift_postion',];
                $.each(deleteData, function (index, val) {
                    formData.delete(val)
            })
        }

        @if(!empty($isEditProduct) && !empty($cartItem))
        formData.append('edit_product', true)
        formData.append('itemId', {{$cartItem->id}})
        @endif
                let cartId = readCookie('__cart_items'); // localStorage.getItem('__cart_items')

                formData.append('cart_id', cartId)
                $("#loader").show();
                success_callback(form.attr('action'),formData, function (response) {
                    let data = response.data;
                    $("#loader").hide();
                    if (data.external_id){
                        createCookie('__cart_items', data.external_id, 2)
                        @if(!$isEditProduct)
                        let $orderCartCountBadge = $("#orderCartCountBadge"),

                        existing = parseInt($orderCartCountBadge.text())
                        $orderCartCountBadge.text(existing+1)
                        @endif
                        $('body').append(modal());
                    }
                }, function (error) {
                    $("#loader").hide();
                })
            }
        })
        // $(document).on('click', ".continue-shopping", function(e) {
        //     e.preventDefault();
        //     $(".custom-modalcontainer").fadeOut("slow");
        //     $(".modal").fadeOut("slow");
        // });
        $(document).on('click', '#goToCart', function (e) {
            e.preventDefault();
            let cartId = readCookie('__cart_items');
            if (cartId){
                window.location.href = window.location.origin + "/cart/" + cartId
            }else{
                $(".custom-modalcontainer").fadeOut("slow");
                $(".modal").fadeOut("slow");
                toastr.error("Something Went Wrong With Add To Cart, Please Try again.");
            }
        })

        $(document).on('click', '.cart-sample-select-button', function (e){
            e.preventDefault();
            $(this).attr("disabled", 'disabled');
            let $this = $(this),
            $sampleCartId = readCookie('__sb_sample_cart'),
            data = {
                pid : $this.attr('data-pid'),
                optid: $this.val(),
                cartid: $sampleCartId
            }
            if ($this.hasClass('btn-outline-primary') && !$this.attr('selected')){
                $("#loader").show();
                let url = '{{route('frontend.product.add.to.sample')}}'
                success_callback(url, data, function (response) {
                    let data = response.data;
                    if (data.error !== "null"){
                                // localStorage.setItem('__sb_sample_cart', data.external_id)
                                createCookie('__sb_sample_cart', data.external_id)
                                let existing = parseInt($("#sampleCartCountBadge").text())
                                $("#sampleCartCountBadge, #totalFreeSampleCarts").text(existing+1)
                                $("#sampleCartItems").text(existing+1)
                                $this.attr('selected', 'selected').removeClass('btn-outline-primary').addClass('selected btn-primary').text("Sample Selected").removeAttr('disabled');
                            }
                            $("#loader").hide();
                        }, function (error) {
                            $("#loader").hide();
                        })
            }
            else if ($this.hasClass('selected') && $this.attr('selected')){
                removeCart(data, $this)
            }
        })
    })
function downloadPdfFile(id){
    axios.post(`/product/file/instruction-download/${id}`)
}
function modal(data){
    return `<div class="custom-modalcontainer">
    <div class="flex">
    <div class="custom-modal">
    <div class="content">
    @if(!$isEditProduct)
    <h2 class="text-center">Product Added!</h2>
    @else
    <h2 class="text-center">Product Updated!</h2>
    @endif
    </div>
    <div class="row pb-4 px-4">
    <div class="col-md-6 pb-2 pb-md-0">
    <a href="{{url()->previous()}}" class="btn-light btn custom w-100 py-md-2 continue-shopping">Continue Your Shopping</a>
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
    $(function () {
       // $(document).ready(function(){
            $('.order-sample-btn').click(function () {
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
                        arrows: false,
                    }
                }
                ]
            });

            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(){
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

            $(document).on('click', '#view-review-scroll', function(e){
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

            $('.review-text').each(function(event){
                var max_length = 137;

                if($(this).html().length > max_length){

                    var short_content   = $(this).html().substr(0,max_length);
                    var long_content    = $(this).html().substr(max_length);

                    $(this).html(short_content+
                        '<span class="more_text" style="display:none;">'+long_content+'</span>'+
                        '<a href="#" class="read_more more-dot">...</a> <br/><a href="#" class="read_more small read-text-change">Read More</a>');

                    $(this).find('a.read_more').click(function(event){
                        event.preventDefault();
                            // $(this).hide();
                            $(this).parents('.review-text').find('.more-dot').toggle();
                            $(this).parents('.review-text').find('.more_text').toggle();

                            var ReadLess = $(this).parents('.review-text').find('.read-text-change');

                            if(ReadLess.text() == 'Read More'){
                                ReadLess.text('Read Less');
                            }
                            else{
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
