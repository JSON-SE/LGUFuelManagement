@extends('layouts.Frontend.app')
@section('title')
    Online Shopping Cart | HeyBlinds Canada
@endsection
@if (count($cartItems) < 1)
    @include('errors.404-cart')
@else
    @section('content')
        <div class="container">
            <div class="pb-4 pt-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="step-heading">Your Shopping Cart</h4>
                        @if (!empty($cart->cart_id))
                            <p>Cart #: {{ $cart->cart_id }}</p>
                        @endif
                    </div>
                    <div class="col-md-6 text-md-end">
                        @auth
                            <button type="button" class="btn btn-secondary btn-sm" id="updateCartButton">Update
                                Cart</button>
                        @else
                            <a href="{{ route('save.cart', $cart->external_id) }}" class="btn btn-secondary btn-sm">Save
                                Cart</a>
                        @endauth
                        <a href="{{ route('welcome') }}" class="btn btn-secondary btn-sm ms-2">Continue Shopping</a>
                    </div>
                </div>

                @if (count($cart->items) > 0)
                    @if ($cart->items)
                        <form action="{{ route('frontend.cart.item.update', $cart->external_id) }}" method="post"
                            id="updateAllCart">
                            @foreach ($cart->items as $item)
                                @if (!empty($item->item($item->option_value)))
                                    @php
                                        $allOptions = $item->item($item->option_value);
                                    @endphp
                                    <div class="cart-box mt-3 p-4 rounded" id="cartItem{{ $item->id }}">
                                        <div class="row">
                                            <input type="hidden" value="{{ $item->id }}" name="item_id">
                                            <div class="col-lg-3 col-sm-6 text-center">
                                                <div class="cart-image">
                                                    <img src="{{ $item->colorImage($allOptions['option_color']) }}"
                                                        alt="" />
                                                </div>
                                                <div class="mt-3">
                                                    <a type="button" class="btn py-0 px-2 btn-link"
                                                        href="{{ route('frontend.edit.product.details', [$item->product->slug ?? '', $cart->external_id, $item->id]) }}">Edit</a>
                                                    <button type="button"
                                                        class="btn border-start  py-0 px-2 btn-link copy-item"
                                                        data-id="{{ $item->id }}">Copy Item</button>
                                                    <button type="button" class="btn border-start  py-0 px-2 btn-link"
                                                        data-id="{{ $item->id }}"
                                                        onclick="cartItemDelete({{ $item->id }})">Remove</button>
                                                </div>
                                            </div>

                                            <div class="col-lg-9 pt-3 pt-lg-0">
                                                <h5 class="font-weight-bold">{{ $item->product->name ?? '' }}</h5>

                                                <p class="mb-2">Estimated shipping date:
                                                    <b>{{ $helpers->estimatedShippingDate() }}</b>
                                                </p>
                                                <div class="row pt-1">
                                                    <div class="col-md-8">
                                                        <div class="row align-items-center">
                                                            @if (!empty($allOptions['option_color']))
                                                                <div class="col-sm-6">
                                                                    <p class="mb-1 d-flex align-items-center"><b
                                                                            class="w-50">Colour:</b>
                                                                        <small
                                                                            class="w-50">{{ $item->colorName($allOptions['option_color']['option_color']) ?? '' }}</small>
                                                                    </p>
                                                                </div>
                                                            @endif
                                                            @if (!empty($allOptions['option_mount']))
                                                                <div class="col-sm-6">
                                                                    <p class="mb-1 d-flex align-items-center">
                                                                        <b class="w-50">Mount:</b>
                                                                        <small
                                                                            class="w-50">{{ $item->optionName($allOptions['option_mount']['option_mount'], 'option_mount') ?? '' }}</small>
                                                                    </p>
                                                                </div>
                                                            @endif
                                                            @if (!empty($allOptions['option_width']))
                                                                <div class="col-sm-6">
                                                                    <p class="mb-1 d-flex align-items-center"><b
                                                                            class="w-50">Width
                                                                            <small>(Inches)</small>:</b>
                                                                        {{ $allOptions['option_width']['option_width'] ?? '' }}
                                                                        <small>&nbsp;
                                                                            {{ $allOptions['option_width_fraction']['option_width_fraction'] ?? '0/0' }}</small>
                                                                    </p>
                                                                </div>
                                                            @endif
                                                            @if (!empty($allOptions['option_height']))
                                                                <div class="col-sm-6">
                                                                    <p class="mb-1 d-flex align-items-center"><b
                                                                            class="w-50">Height
                                                                            <small>(Inches)</small>:</b>
                                                                        {{ $allOptions['option_height']['option_height'] ?? '' }}
                                                                        <small>&nbsp;
                                                                            {{ $allOptions['option_height_fraction']['option_height_fraction'] ?? '0/0' }}</small>
                                                                    </p>
                                                                </div>
                                                            @endif
                                                            @if (!empty($allOptions['headrail_option']))
                                                                <div class="col-sm-6">
                                                                    <div class="mb-1 d-flex align-items-center"><b
                                                                            class="w-50">Headrail:</b>
                                                                        {{ $allOptions['headrail_option']['headrail_option'] == 0 ? 'Standard' : '2 on 1' }}

                                                                    </div>
                                                                </div>
                                                            @endif

                                                            @if (!empty($allOptions['headrail_left_filter_width']))
                                                                <div class="col-sm-6">
                                                                    <p class="mb-1 d-flex align-items-center"><b
                                                                            class="w-50">Left Panel
                                                                            <small>(Inches)</small>:</b>
                                                                        {{ $allOptions['headrail_left_filter_width']['headrail_left_filter_width'] ?? '' }}
                                                                        <small>&nbsp;
                                                                            {{ $allOptions['headrail_width_fraction_val']['headrail_width_fraction_val'] ?? '0/0' }}</small>
                                                                    </p>
                                                                </div>
                                                            @endif



                                                            @if (!empty($allOptions['headrail_filter_right_width']))
                                                                <div class="col-sm-6">
                                                                    <p class="mb-1 d-flex align-items-center"><b
                                                                            class="w-50">Right Panel
                                                                            <small>(Inches)</small>:</b>
                                                                        {{ $allOptions['headrail_filter_right_width']['headrail_filter_right_width'] ?? '' }}
                                                                        <small>&nbsp;
                                                                            {{ $allOptions['headrail_filter_right_fraction']['headrail_filter_right_fraction'] ?? '0/0' }}</small>
                                                                    </p>
                                                                </div>
                                                            @endif
                                                            @if (!empty($allOptions['headrail_left_lift_position']))
                                                                <div class="col-sm-6">
                                                                    <p class="mb-1 d-flex align-items-center">
                                                                        <b class="w-50">Left panel lift
                                                                            position:</b>
                                                                        {{ $allOptions['headrail_left_lift_position']['headrail_left_lift_position'] ?? '' }}
                                                                    </p>
                                                                </div>
                                                            @endif

                                                            @if (!empty($allOptions['headrail_right_lift_postion']))
                                                                <div class="col-sm-6">
                                                                    <p class="mb-1 d-flex align-items-center">
                                                                        <b class="w-50">Right panel lift
                                                                            position:</b>
                                                                        {{ $allOptions['headrail_right_lift_postion']['headrail_right_lift_postion'] ?? '' }}
                                                                    </p>
                                                                </div>
                                                            @endif

                                                            @if (!empty($allOptions['option_room_name']))
                                                                <div class="col-sm-6">
                                                                    <p class="mb-1 d-flex align-items-center"><b
                                                                            class="w-50">Room Name:
                                                                        </b> <small
                                                                            class="w-50">{{ $item->room_name }}</small>
                                                                    </p>
                                                                </div>
                                                            @endif

                                                            @foreach ($allOptions as $key => $allItem)
                                                                @if ($key !== 'total_price' && $key !== 'cart_id' && $key !== 'option_width_fraction' && $key !== 'measurement_price' && $key !== 'option_height_fraction' && $key !== 'unit_price' && $key !== 'option_color' && $key !== 'option_room_name' && $key !== 'option_width' && $key !== 'option_height' && $key !== 'option_mount' && $key !== 'headrail_option' && $key !== 'headrail_left_filter_width' && $key !== 'headrail_width_fraction_val' && $key !== 'headrail_left_lift_position' && $key !== 'headrail_filter_right_width' && $key !== 'headrail_filter_right_fraction' && $key !== 'headrail_right_lift_postion')
                                                                    <div class="col-sm-6">
                                                                        <p class="mb-1 d-flex align-items-center"><b
                                                                                class="w-50">{{ ucwords(str_replace(['suboption_', 'option_', '_'], ['', '', ' '], $key)) }}:</b>
                                                                            <small
                                                                                class="w-50">{{ $item->optionName($allItem[$key], $key) }}</small>
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="col-12">
                                                            <hr class="my-2" />
                                                        </div>
                                                        <div class="row align-items-end">
                                                            <div class="col-sm-6">
                                                                <label for="" class="form-label">Note
                                                                    <span class="position-relative mousuhover-out">
                                                                        <span
                                                                            class="text-primary tooltip-hover question-icon mx-2">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16" fill="currentColor"
                                                                                class="bi bi-question-circle-fill"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                                </path>
                                                                            </svg>
                                                                        </span>

                                                                        <div class="tooltip shadow "
                                                                            style="left: auto; right: 100%;">
                                                                            <div class="tooltip-arrow"></div>
                                                                            <span
                                                                                class="close-tooltip btn-close btn"></span>
                                                                            <div class="tooltip-inner">
                                                                                <div class="row g-2">
                                                                                    <div class="col-sm-12">
                                                                                        <p>Any special instructions or other
                                                                                            details related to this blind.
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                                </label>
                                                                <input type="text" class="form-control bg-transparent"
                                                                    id="note{{ $item->id }}" name="note"
                                                                    onchange="cartItemUpdate({{ $item->id }})"
                                                                    value="{{ $item->customer_note }}">
                                                            </div>
                                                            <div class="col-sm-6 pt-3 pt-sm-0">
                                                                <label for="" class="form-label">Room Name
                                                                    <span class="position-relative mousuhover-out">
                                                                        <span
                                                                            class="text-primary tooltip-hover question-icon mx-2">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16" fill="currentColor"
                                                                                class="bi bi-question-circle-fill"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                                </path>
                                                                            </svg>
                                                                        </span>

                                                                        <div class="tooltip shadow "
                                                                            style="left: auto; right: 100%;">
                                                                            <div class="tooltip-arrow"></div>
                                                                            <span
                                                                                class="close-tooltip btn-close btn"></span>
                                                                            <div class="tooltip-inner">
                                                                                <div class="row g-2">
                                                                                    <div class="col-sm-12">
                                                                                        <p>Entering the room name is
                                                                                            especially
                                                                                            helpful if you're ordering
                                                                                            blinds
                                                                                            for more than one room.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                                </label>
                                                                <input type="text" class="form-control bg-transparent"
                                                                    id="room{{ $item->id }}" name="room"
                                                                    onchange="cartItemUpdate({{ $item->id }})"
                                                                    placeholder="Ex: Living Room - West Wall"
                                                                    value="{{ $item->room_name }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-2 mt-md-0">
                                                        <div class=" rounded bg-white px-3 py-2">
                                                            <div class="d-flex"><span
                                                                    class="w-50">Subtotal<small>&nbsp;(<span
                                                                            id="items{{ $item->id }}">{{ $item->quantity }}
                                                                        </span>
                                                                        @if ($item->quantity > 1)
                                                                            items
                                                                        @else
                                                                            item
                                                                        @endif
                                                                        )
                                                                    </small></span>
                                                                <b class="w-50 text-end"
                                                                    id="sub_total{{ $item->id }}">${{ $helpers->withoutRounding($item->unit_price, 2) }}</b>
                                                            </div>
                                                            @if (!empty($item->promo_discount))
                                                                <div class="mb-1 d-flex text-primary">
                                                                    <b class="w-50">Save
                                                                        {{ !empty(!empty($item->promo_discount)) ? (!empty($item->promo_type) && $item->promo_type === 'flat' ? "$" : '') : '' }}{{ $item->promo_discount ?? '' }}
                                                                        {{ !empty(!empty($item->promo_discount)) ? (!empty($item->promo_type) && $item->promo_type === 'percentage' ? '%' : '') : '' }}
                                                                        <span class="position-relative mousuhover-out">
                                                                            <span
                                                                                class="text-primary tooltip-hover question-icon mx-2">
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

                                                                            <div class="tooltip shadow "
                                                                                style="left: auto; right: 100%;">
                                                                                <div class="tooltip-arrow"></div>
                                                                                <span
                                                                                    class="close-tooltip btn-close btn"></span>
                                                                                <div class="tooltip-inner">
                                                                                    <div class="row g-2">
                                                                                        <div class="col-sm-12">
                                                                                            <p>This discount only applies to
                                                                                                blinds, and excludes any
                                                                                                options
                                                                                                that may have been added.
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </span>
                                                                    </b>
                                                                    {{-- @if (!empty($promo->extra_amount))
                                                                        <b class="w-50">+ {{$promo->extra_amount}}
                                                                        </b> --}}

                                                                    <span class="text-end w-50"
                                                                        id="save{{ $item->id }}">-${{ $helpers->withoutRounding((float) $item->unit_price - (float) $item->purchase_price, 2) }}</span>

                                                                </div>
                                                            @endif

                                                            {{-- <div class="mb-1 d-flex text-success">
                                                                <span class="w-50">7 Year Warranty</span>
                                                                <b class="text-end w-50">Free</b>
                                                            </div> --}}
                                                            <hr class="my-2" />

                                                            <div class="d-flex fw-bold"><span class="w-50">Your
                                                                    Price</span> <b class="w-50 text-end"
                                                                    id="price{{ $item->id }}">${{ $helpers->withoutRounding($item->purchase_price, 2) }}</b>
                                                            </div>
                                                        </div>

                                                        <div class="mb-1 mt-2 d-flex align-items-center">
                                                            <b class="w-50">Quantity: </b>
                                                            <div class="text-end mt-1 ms-auto">
                                                                <select
                                                                    class="form-select cart-quantity bg-transparent form-select-sm "
                                                                    name="quantity" id="quantity{{ $item->id }}"
                                                                    aria-label="form-select-sm example"
                                                                    onchange="cartItemUpdate({{ $item->id }})">
                                                                    @for ($i = 1; $i <= 100; $i++)
                                                                        <option value="{{ $i }}"
                                                                            {{ $item->quantity == $i ? 'selected' : '' }}>
                                                                            {{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </form>
                    @endif
                    <div class="row gx-3 mb-3">
                        <div class="col-lg-12">
                            <div class=" mt-4 rounded">
                                <div class="row ">
                                    <div class="col-lg-8 col-md-7">
                                        <div class="rounded border border-primary p-4">
                                            <h5 class="font-secondary fw-bold">HeyBlinds covers your windows, and your
                                                back, just in case something goes wrong:</h5>

                                            <div class="pt-4">

                                                <p class="mb-1">
                                                    <a class="font-secondary h6 d-flex align-items-center fw-semibold text-dark "
                                                        href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#Risk-Free-Trial">
                                                        <span class="pe-2" style="width: 45px;">
                                                            <img src="{{ asset('images/icon8.png') }}"
                                                                alt="Hey Blindes Delivery Truck">
                                                        </span>
                                                        <span>100 Day Risk-Free In-Home Trial</span>
                                                    </a>
                                                </p>

                                                <p class="mb-1">
                                                    <a class="font-secondary h6 d-flex align-items-center fw-semibold text-dark"
                                                        href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#RightFit-Guarantee">
                                                        <span class="pe-2" style="width: 45px;">
                                                            <img src="{{ asset('images/icon7.png') }}"
                                                                alt="Hey Blindes Delivery Truck">
                                                        </span>
                                                        <span>RightFit<small class="TrademarkSymbol">&reg;</small> &nbsp;
                                                            Guarantee</span>
                                                    </a>
                                                </p>


                                                <p class="mb-1">
                                                    <a class="font-secondary h6 d-flex align-items-center fw-semibold text-dark"
                                                        href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#Price-Lowest-Guarantee">
                                                        <span class="pe-2" style="width: 45px;">
                                                            <img src="{{ asset('images/icon9.png') }}"
                                                                alt="Hey Blindes Delivery Truck">
                                                        </span>
                                                        <span>Best Price Guarantee</span>
                                                    </a>
                                                </p>

                                                {{-- <p class="mb-1">
                                                    <a class="font-secondary h6 d-flex align-items-center fw-semibold text-dark"
                                                        href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#Year-Unlimited-Warranty">
                                                        <span class="pe-2" style="width: 45px;">
                                                            <img src="{{ asset('images/icon10.png') }}"
                                                                alt="Hey Blindes Delivery Truck">
                                                        </span>
                                                        <span>FREE Limited Lifetime Warranty</span>
                                                    </a>
                                                </p> --}}
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-5 pt-3 pt-md-0 text-end">
                                        <div class="row g-2 justify-content-end">
                                            <div class="col-sm-12">
                                                @if (!empty($promo->coupon_text_box))
                                                    <p class="font-secondary fw-bold text-start mb-0">
                                                        {{ $promo->coupon_text_box }}</p>
                                                @else
                                                    <p class="font-secondary fw-bold text-start mb-0">Have A Coupon Code?
                                                        Enter It Here </p>
                                                @endif
                                            </div>
                                            @if (!empty($cart->coupon) && !empty($cart->discount))
                                                {{-- @if (false) --}}
                                                <div class="col-8" id="removeButton">
                                                    <input class="form-control bg-transparent  remove" type="text"
                                                        id="couponCode" value="{{ $cart->coupon }}" autocomplete="off">
                                                </div>
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-secondary remove w-100"
                                                        id="removeCoupon">Remove</button>
                                                </div>
                                            @else
                                                <div class="col-8" id="applyButton">
                                                    <input class="form-control bg-transparent apply" type="text"
                                                        id="couponCode" placeholder="Enter Coupon Code" autocomplete="off">
                                                </div>
                                                <div class="col-4"><button type="button"
                                                        class="btn btn-primary apply w-100" id="applyCoupon">Apply</button>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="bg-white rounded shadow text-start p-3 mt-3">
                                            <h6 class="d-flex"><span
                                                    class="w-50">Subtotal<small>&nbsp;(<span
                                                            id="cartItesm">{{ $cartItemsCount }} </span>
                                                        @if ($cartItemsCount > 1)
                                                            items
                                                        @else
                                                            item
                                                        @endif)
                                                    </small>
                                                </span> <b class="w-50 text-end"
                                                    id="cart_sub_total">${{ $helpers->withoutRounding($cart->cart_total_price, 2) }}</b>
                                            </h6>
                                            @foreach ($promo_items as $key => $item)
                                                <h6 class="mb-2 d-flex text-primary">
                                                    <span class="w-50">Sale Discount <span
                                                            id="cart_product_promo_name">
                                                            <span>{{ $item->promo_type == 'flat' ? '$' : '' }}{{ $item->promo_discount }}{{ $item->promo_type == 'percentage' ? '%' : '' }}</span>
                                                        </span> </span>
                                                    <b class="text-end w-50"
                                                        id="cart_product_promo_value{{ $item->product_id }}">-${{ number_format($item->promoPrice($cart->id, $item->product_id), 2) }}</b>
                                                </h6>
                                            @endforeach
                                            {{-- @if ($totalSave != 0)
                                                <h6 class="mb-2 d-flex text-primary">
                                                    <span class="w-50">Sale Discount <span id="cartSaveAmount">
                                                            <span>{{ $promoType === 'percentage' ? number_format($totalPercentage) . '%' : '' }}</span>
                                                        </span> </span> <b class="text-end w-50"
                                                        id="cartSaveDiscount">-${{ $helpers->withoutRounding($totalSave, 2) }}</b>
                                                </h6>
                                            @endif --}}

                                            <div id="couponDiscount">
                                                @if (!empty($cart->coupon) && !empty($cart->discount))
                                                    <h6 class="mb-2 d-flex text-primary" id="discountAmoutLabel">
                                                        <span class="w-50">Extra Coupon Discount
                                                            {{-- {{ $coupon->type === 'percentage' && !empty($coupon->amount) ? $coupon->amount . '%' : '' }} --}}
                                                        </span>
                                                        <b class="text-end w-50"
                                                            id="cartSaveDiscount">-${{ $helpers->withoutRounding($cart->cart_item_discount, 2) }}</b>
                                                    </h6>
                                                @endif
                                            </div>
                                            @if ($cart->shipping_extra_amount > 0)
                                                <h6 class="mb-2 d-flex shipping-price bg-white  text-start">
                                                    <div class="w-50 d-flex"><span>Oversize Fee </span>
                                                        <span class="position-relative ms-2 d-block mousuhover-out">
                                                            <span class="tooltip-hover question-icon text-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
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

                                                                            <p>
                                                                                Because there is one or more item(s) in your
                                                                                cart that are over the shipping companies'
                                                                                'normal' size limit, there is an additional
                                                                                fee
                                                                                to cover the extra cost of shipping. This
                                                                                fee is
                                                                                charged only once per order, regardless of
                                                                                the
                                                                                number of oversized items in your cart.
                                                                            </p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <b class="w-50 text-end"
                                                        id="shipping_price">{{ $cart->shipping_extra_amount > 0 ? '$' . number_format($cart->shipping_extra_amount, 2) : 'Free' }}</b>
                                                </h6>
                                            @endif

                                            <h6 class="mb-2 d-flex bg-white  text-start">
                                                <span class="w-50">Shipping </span>
                                                <b class="text-end w-50 ">Free</b>
                                            </h6>

                                            <h6 class="mb-2 d-flex handling-price bg-white  text-start">
                                                <span class="w-50 d-flex">Handling
                                                    <span class="position-relative ms-2 d-block mousuhover-out">
                                                        <span
                                                            class="tooltip-hover question-icon {{ $cart->handling_extra_amount ?? 0 > 0 ? 'text-primary' : 'text-success' }}">
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
                                                    </span>
                                                </span>
                                                <b class="text-end w-50 "
                                                    id='handling_price'>{{ $cart->handling_extra_amount ?? 0 > 0 ? '$' . number_format($cart->handling_extra_amount, 2) : 'Free' }}</b>
                                            </h6>
                                            <hr class="my-2" />
                                            <h5 class="d-flex fw-bold" id="yourPrice"><span class="w-50">Your
                                                    Price</span>
                                                <b class="w-50 text-end"
                                                    id="your_price">${{ $helpers->withoutRounding($cart->cart_amount - $cart->cart_item_discount + ($cart->shipping_extra_amount + $cart->handling_extra_amount), 2) }}
                                                </b>
                                                <br />
                                                <br />

                                            </h5>
                                            <a href="{{ url('checkout', $cart->external_id) }}"
                                                class="btn btn-primary w-100 mt-2 btn-lg">Proceed to Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4  col-md-5 col-sm-6 mt-3 pt-sm-0 ms-auto">

                        </div>
                    </div>
                @else

                    <br />
                    <h1>Cart is Empty</h1>
                    <br />
                    <p>Add items to the cart, <a href="{{ route('welcome') }}"
                            class="btn btn-secondary btn-sm ms-2">Continue
                            Shopping</a>
                    </p>
                @endif
            </div>
        </div>
        <div class="modal fade" id="exampleModaltwo" tabindex="-1" aria-labelledby="exampleModalLabeltwo"
            aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content p-4 border-0">

                    <div class="modal-body p-0 text-center">
                        <div class="text-primary pb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                                class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                            </svg>
                        </div>


                        <h3 id="textMessgeDisplay">Are you sure?</h3>
                        <div class="pt-3">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                id="cart-model-no">No</button>
                            <button type="button" class="btn btn-sm btn-primary" id="cart-model-yes">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="couponDetailsModel" tabindex="-1" aria-labelledby="covidModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <div class="row gx-2 justify-content-between">
                            <div class="col-11">
                                <h4 class="font-secondary fw-bold text-secondary">Coupon Details</h4>
                            </div>
                            <div class="col-1 text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                        <hr class="mt-2" />
                        <p id="modelCouponDescription"> </p>
                        <h6>The <span class="text-primary">HeyBlinds</span> Team</h6>
                    </div>

                </div>
            </div>
        </div>

        @push('js')

            <script>
                function savedAbadonedCart() {
                    var cart_id = "{{ $cart->external_id }}";
                    axios.post(`/alert-for-saved-abandoned-cart/${cart_id}`)
                }

                function cartItemUpdate(id) {
                    note = $("#note" + id).val();
                    room = $("#room" + id).val();
                    url = "{{ url('/cart/items/update') }}/" + id;
                    quantity = $("#quantity" + id).val();
                    data = {
                        note: note,
                        room: room,
                        quantity: quantity
                    };

                    success_callback(url, data, function(response) {
                        let res = response.data;
                        $("#sub_total" + id).text("$" + res.indSubTotal);
                        $("#save" + id).text("-$" + res.indPromo);
                        $("#price" + id).text("$" + res.indTotal);
                        $("#cart_product_promo_value" + res.product_id).text("-$" + res.promo_price);
                        $("#items" + id).text(res.quantity);
                        $("#cart_sub_total").text("$" + res.mainPrice);
                        $("#cartSaveDiscount").text("-$" + res.mainPromoPrice);
                        $("#your_price").text("$" + res.mainTotalCart);
                        $("#couponDiscountAmount ").text("$" + res.couponAmount);
                        $("#orderCartCountBadge").text(res.cartItemsCount);
                        $("#cartItesm").text(res.cartItemsCount);
                        if (res.is_handling_price > 0) {
                            $('#handling_price').text('+$' + res.is_handling_price.toFixed(2));
                        } else {
                            $('#handling_price').text('Free');
                        }


                        if (res.couponExist) {
                            if ($('#couponDiscount').length) {
                                $("#couponDiscount").html(
                                    '<h6 class="d-flex text-primary mb-2 __coupon-discount"> <span class="w-100">Extra Coupon Discount ' +
                                    // (res.couponType == "flat" ? "" : res.couponAmount + "% ") +
                                    '</span> <b class="w-50 text-end"><span id="couponDiscountAmount ">-$' + res
                                    .couponSave
                                    .toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' </span></b>  </h6>');
                            } else {}
                        } else {
                            $("#couponDiscount").html('');
                            $("#couponCode").removeAttr('disabled');
                            $("#removeCoupon").attr("id", "applyCoupon");
                            $("#applyCoupon").removeClass('btn-secondary').addClass('btn-primary').text('Apply');
                        }
                        // toastr.success("Cart Updated!");
                    })
                }

                function removeCoupon(id, coupon_code, $this) {
                    let data = {
                            cart_id: id,
                            coupon_code: coupon_code
                        },
                        url = '{{ route('frontend.removeCoupon', $id) }}';
                    success_callback(url, data, function(response) {
                        let data = response.data;
                        if (data.error) {
                            toastr.error(data.error);
                        } else {
                            $(".__coupon-discount").remove();
                            $("#cart_sub_total").text("$" + data.cart_sub_total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g,
                                    '$&,'))
                                .parents('.d-flex').after('');
                            $("#your_price").text("$" + (data.cart_price - data.discount).toFixed(2).replace(
                                /\d(?=(\d{3})+\.)/g, '$&,'));
                            $this.removeClass('btn-secondary').addClass('btn-primary').text('Apply').parents(
                                '.justify-content-end').find('#couponCode').attr('disabled', 'false');
                            $("#couponCode").removeAttr('disabled');
                            $this.attr("id", "applyCoupon")
                            $("#discountAmoutLabel").attr('style', 'display: none !important');
                            $("#couponDiscount").html('');
                        }
                    }, function(error) {
                        console.log(error);
                        $("#loader").hide();
                    })
                }

                function cartItemDelete(id) {
                    var entry_id = id;
                    $("#exampleModaltwo").modal('show');
                    $("#cart-model-yes").one("click", function(x) {
                        $("#exampleModaltwo").modal('hide');
                        $.ajax({
                            type: "delete",
                            url: `/cart/${entry_id}`,
                            success: function(msg) {
                                window.location.reload(true);
                            }
                        });
                    });
                }

                couponUrl = "{{ url('/apply-coupon') }}";
                jQuery(function($) {
                    let cartItemsCount = "{{ $cartItemsCount }}";
                    $("#orderCartCountBadge").text(cartItemsCount);
                    savedAbadonedCart();
                    $(document).on('click', '#removeCoupon', function(e) {
                        e.preventDefault();
                        let coupon_code = $("#couponCode").val(),
                            $this = $(this);
                        removeCoupon('{{ $id }}', coupon_code, $this)
                    });

                    $(document).on('click', '#applyCoupon', function(e) {
                        e.preventDefault();
                        let coupon_code = $("#couponCode").val();
                        $this = $(this);
                        applyCoupon('{{ $id }}', coupon_code, $this)
                    })

                    $(document).on('click', '.copy-item', function(e) {
                        e.preventDefault()
                        let $this = $(this),
                            data = {
                                CartId: "{{ $cart->id }}",
                                ItemId: $this.attr('data-id'),
                            },
                            url = '{{ route('frontend.save.cart.clone') }}'
                        success_callback(url, data, function(response) {
                            let data = response.data;
                            if (data == 1) {
                                window.location.reload();
                            } else if (data.error) {
                                toastr.error(data.error);
                            } else {
                                toastr.error("Something went wrong. Please try again later!");
                            }
                        }, function(errors) {
                            let error = errors.response.data.errors.reason;
                            toastr.error(error);
                        })
                    })
                    $(document).on('click', '#updateCartButton', function(e) {
                        e.preventDefault();
                        console.log(readCookie('__cart_items'));
                        // if (readCookie('__cart_items') == "{{ $cart->external_id }}"){
                        let data = {
                                'cartId': "{{ $cart->external_id }}",
                                '_token': "{{ csrf_token() }}",
                            },
                            url = '{{ route('frontend.save.cart.update', $cart->external_id) }}';
                        success_callback(url, data, function(response) {
                            if (response.data.status == true) {
                                eraseCookie('__cart_items');
                                localStorage.removeItem("__cart_items");
                                $('#orderCartCountBadge').text("0");
                                window.location.href = window.location.origin + "/user/my-cart";
                            } else {
                                toastr.error("Something went wrong. Please try again later!");
                            }
                        }, function(errors) {
                            let error = errors.response.data.errors.reason;
                            toastr.error(error);
                            console.log();
                        })
                        // }else {
                        //     toastr.error("Something went wrong. Please try again later!");
                        // }
                    })
                });

                function applyCoupon(id, coupon_code, $this) {
                    let data = {
                            cart_id: id,
                            coupon_code: coupon_code
                        },
                        url = '{{ route('frontend.applyCoupon', $id) }}';
                    $("#loader").show();
                    success_callback(url, data, function(response) {
                        let data = response.data;
                        if (data.error) {
                            toastr.error(data.error);
                        } else {
                            $(".__coupon-discount").remove();
                            $("#cart_sub_total").text("$" + data.cart_sub_total);
                            $("#your_price").text("$" + data.your_price);
                            $this.removeClass('btn-primary').addClass('btn-secondary').text('Remove').parents(
                                '.justify-content-end').find('#couponCode').attr('disabled', 'disabled')
                            $this.attr("id", "removeCoupon")
                            $("#couponDiscount").html(
                                '<h6 class="d-flex text-primary mb-2 __coupon-discount"> <span class="w-100">Extra Coupon Discount ' +
                                // (data.type == "flat" ? "" : data.discount_amount + "% ") +
                                '</span> <b class="w-50 text-end"><span id="couponDiscountAmount ">-$' + data
                                .discount + ' </span></b>  </h6>');
                        }
                    }, function(error) {
                        console.log(error);
                        $("#loader").hide();
                    })
                }
            </script>
        @endpush
    @endsection
@endif
