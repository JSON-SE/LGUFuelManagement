<div id="showModel" style="display:none;">
    <div class="custom-modalcontainer">
        <div class="flex">
            <div class="custom-modal w-75  position-relative">
                <button type="button"
                    class="btn-close continue-shopping top-0 position-absolute start-100 translate-middle bg-white shadow rounded-full"
                    aria-label="Close"></button>
                <div class="px-lg-4 px-2 pb-2 review-order-details-scroll scrollbar-style">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="review-order-details-model-content">
                                @if (count($cart->items) > 0)
                                    @if ($cart->items)
                                        @foreach ($cart->items as $item)
                                            @if (!empty($item->item($item->option_value)))
                                                @php
                                                    $allOptions = $item->item($item->option_value);
                                                @endphp
                                                <div class="cart-box mt-3 p-4 rounded " id="cartItem{{ $item->id }}">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-xl-3 col-sm-6 text-center">
                                                            <div class="cart-image">
                                                                <img src="{{ $item->colorImage($allOptions['option_color']) }}"
                                                                    alt="" />
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-9 pt-3 pt-xl-0">
                                                            <h5 class="font-weight-bold">
                                                                {{ $item->product->name ?? '' }}</h5>
                                                            <div class="row gx-2 pt-1">
                                                                <div class="col-lg-7">
                                                                    <div class="row align-items-center">
                                                                        @foreach ($item->item($item->option_value) as $key => $allItem)
                                                                            @if ($key !== 'total_price' && $key !== 'cart_id' && $key !== 'option_width_fraction' && $key !== 'measurement_price' && $key !== 'option_height_fraction' && $key !== 'unit_price')
                                                                                <div class="col-sm-12">
                                                                                    @if ($key === 'option_color')
                                                                                        <p
                                                                                            class="mb-1 d-flex align-items-center">
                                                                                            <b
                                                                                                class="w-50">Colour:</b>
                                                                                            <small
                                                                                                class="w-50">{{ $item->colorName($allItem['option_color']) }}</small>
                                                                                        </p>
                                                                                    @elseif($key === 'option_width')
                                                                                        <p
                                                                                            class="mb-1 d-flex align-items-center">
                                                                                            <b class="w-50">Width
                                                                                                <small>(Inches)</small>:</b>
                                                                                            {{ !empty($allItem['option_width']) ? $allItem['option_width'] : '' }}
                                                                                            <small>&nbsp;
                                                                                                {{ !empty($allOptions['option_width_fraction']['option_width_fraction']) ? $allOptions['option_width_fraction']['option_width_fraction'] : '0/0' }}</small>
                                                                                        </p>
                                                                                    @elseif($key === 'option_height')
                                                                                        <p
                                                                                            class="mb-1 d-flex align-items-center">
                                                                                            <b class="w-50">Height
                                                                                                <small>(Inches)</small>:</b>
                                                                                            {{ !empty($allItem['option_height']) ? $allItem['option_height'] : '' }}
                                                                                            <small>&nbsp;
                                                                                                {{ !empty($allOptions['option_height_fraction']['option_height_fraction']) ? $allOptions['option_height_fraction']['option_height_fraction'] : '0/0' }}</small>
                                                                                        </p>
                                                                                        @if (!empty($allOptions['headrail_option']))
                                                                                            <p
                                                                                                class="mb-1 d-flex align-items-center">
                                                                                                <b
                                                                                                    class="w-50">Headrail:</b>
                                                                                                {{ $allOptions['headrail_option']['headrail_option'] == 0 ? 'Standard' : '2 on 1' }}
                                                                                            </p>
                                                                                        @endif
                                                                                    @elseif($key === 'headrail_left_filter_width')
                                                                                        <p
                                                                                            class="mb-1 d-flex align-items-center">
                                                                                            <b class="w-50">Left
                                                                                                panel
                                                                                                <small>(Inches)</small>:</b>
                                                                                            {{ !empty($allItem['headrail_left_filter_width']) ? $allItem['headrail_left_filter_width'] : '' }}
                                                                                            <small>&nbsp;
                                                                                                {{ !empty($allOptions['headrail_width_fraction_val']['headrail_width_fraction_val']) ? $allOptions['headrail_width_fraction_val']['headrail_width_fraction_val'] : '0/0' }}</small>
                                                                                        </p>

                                                                                    @elseif($key === 'headrail_filter_right_width')
                                                                                        <p
                                                                                            class="mb-1 d-flex align-items-center">
                                                                                            <b class="w-50">Right
                                                                                                panel
                                                                                                <small>(Inches)</small>:</b>
                                                                                            {{ !empty($allItem['headrail_filter_right_width']) ? $allItem['headrail_filter_right_width'] : '' }}
                                                                                            <small>&nbsp;
                                                                                                {{ !empty($allOptions['headrail_filter_right_fraction']['headrail_filter_right_fraction']) ? $allOptions['headrail_filter_right_fraction']['headrail_filter_right_fraction'] : '0/0' }}</small>
                                                                                        </p>

                                                                                    @elseif($key === 'headrail_left_lift_position')
                                                                                        <p
                                                                                            class="mb-1 d-flex align-items-center">
                                                                                            <b class="w-50">Left
                                                                                                panel lift position:</b>
                                                                                            {{ !empty($allItem['headrail_left_lift_position']) ? $allItem['headrail_left_lift_position'] : '' }}
                                                                                        </p>

                                                                                    @elseif($key === 'headrail_right_lift_postion')
                                                                                        <p
                                                                                            class="mb-1 d-flex align-items-center">
                                                                                            <b class="w-50">Right
                                                                                                panel lift position:</b>
                                                                                            {{ !empty($allItem['headrail_right_lift_postion']) ? $allItem['headrail_right_lift_postion'] : '' }}
                                                                                        </p>

                                                                                    @elseif($key === 'option_room_name')
                                                                                        @if (!empty($item->room_name))
                                                                                            <p
                                                                                                class="mb-1 d-flex align-items-center">
                                                                                                <b
                                                                                                    class="w-50">Room
                                                                                                    Name:
                                                                                                </b> <small
                                                                                                    class="w-50">{{ $item->room_name }}</small>
                                                                                            </p>
                                                                                        @endif


                                                                                    @else
                                                                                        @if ($key !== 'total_price' && $key !== 'cart_id' && $key !== 'option_width_fraction' && $key !== 'measurement_price' && $key !== 'option_height_fraction' && $key !== 'unit_price' && $key !== 'option_color' && $key !== 'option_room_name' && $key !== 'option_width' && $key !== 'option_height' && $key !== 'option_mount' && $key !== 'headrail_option' && $key !== 'headrail_left_filter_width' && $key !== 'headrail_width_fraction_val' && $key !== 'headrail_left_lift_position' && $key !== 'headrail_filter_right_width' && $key !== 'headrail_filter_right_fraction' && $key !== 'headrail_right_lift_postion')
                                                                                            <p
                                                                                                class="mb-1 d-flex align-items-center">
                                                                                                <b
                                                                                                    class="w-50">{{ ucwords(str_replace(['suboption_', 'option_', '_'], ['', '', ' '], $key)) }}:</b>
                                                                                                <small
                                                                                                    class="w-50">{{ $item->optionName($allItem[$key], $key) }}</small>
                                                                                            </p>
                                                                                        @endif
                                                                                        {{-- <p class="mb-1 d-flex align-items-center"><b
                                                            class="w-50">{{ ucwords(str_replace(['suboption_', 'option_', '_'], ['', '', ' '], $key)) }}:</b>
                                                            <small
                                                            class="w-50">{{ $item->optionName($allItem[$key], $key) }}</small>
                                                        </p> --}}
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <div class=" rounded bg-white px-3 py-2">
                                                                        <div class="d-flex"><span
                                                                                class="w-50">SubTotal<small>&nbsp;(<span
                                                                                        id="items{{ $item->id }}">
                                                                                        {{ $item->quantity }}
                                                                                    </span>
                                                                                    @if ($item->quantity > 1)
                                                                                        items
                                                                                    @else
                                                                                        item
                                                                                        @endif)
                                                                                </small></span> <b
                                                                                class="w-50 text-end"
                                                                                id="sub_total{{ $item->id }}">${{ $helpers->withoutRounding($item->unit_price, 2) }}</b>
                                                                        </div>
                                                                        @if (!empty($item->promo_discount))
                                                                            <div class="mb-1 d-flex text-primary">
                                                                                <b class="w-50">Save
                                                                                    {{ !empty(!empty($item->promo_discount)) ? (!empty($item->promo_type) && $item->promo_type === '' ? "$" : '') : '' }}
                                                                                    {{ $item->promo_discount ?? '' }}
                                                                                    {{ !empty(!empty($item->promo_discount)) ? (!empty($item->promo_type) && $item->promo_type === 'percentage' ? '%' : '') : '' }}

                                                                                </b>
                                                                                <span class="text-end w-50"
                                                                                    id="save{{ $item->id }}">-${{ $helpers->withoutRounding($item->promo_price, 2) }}</span>

                                                                            </div>
                                                                        @endif
                                                                        {{-- <div class="mb-1 d-flex text-success">
                                                    <span class="w-50">Warranty </span>
                                                    <b class="text-end w-50">Free</b>
                                                </div> --}}
                                                                        <hr class="my-2" />

                                                                        <div class="d-flex fw-bold"><span
                                                                                class="w-50">Your Price</span>
                                                                            <b class="w-50 text-end"
                                                                                id="price{{ $item->id }}">${{ $helpers->withoutRounding($item->purchase_price, 2) }}</b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <div class="bg-white rounded shadow p-3">
                                <div>
                                    <h5>Cart Summary</h5>
                                    @if (!empty($cart->cart_id))
                                        <p class="fst-italic text-lg-small">Cart #: {{ $cart->cart_id }}</p>
                                    @endif
                                    <hr class="my-2" />

                                    <h6 class="d-flex"><span
                                            class="w-50">SubTotal<small>&nbsp;({{ $cartItemsCount }}
                                                @if ($cartItemsCount > 1)
                                                    items
                                                @else
                                                    item
                                                @endif)
                                            </small></span>
                                        <b
                                            class="w-50 text-end">${{ $helpers->withoutRounding($sub_total, 2) }}</b>
                                    </h6>
                                    @foreach ($promo_items as $key => $item)
                                        <h6 class="mb-2 d-flex text-primary">
                                            <span class="w-50">Sale Discount <span
                                                    id="cart_product_promo_name">
                                                    <span>{{ $item->promo_type == 'flat' ? '$' : '' }}{{ $item->promo_discount }}{{ $item->promo_type == 'percentage' ? '%' : '' }}</span>
                                                </span> </span>
                                            <b class="text-end w-50"
                                                id="cart_product_promo_value{{ $item->id }}">-${{ number_format($item->promoPrice($cart->id, $item->product_id), 2) }}</b>
                                        </h6>

                                    @endforeach

                                    {{-- @if ($totalSave != 0)
                            <h6 class="mb-2 d-flex text-primary">
                                <span class="w-50">Sale Discount<span id="cartSaveAmount"></span> </span>
                                <b class="text-end w-50"
                                id="cartSaveDiscount">-${{  $helpers->withoutRounding($totalSave, 2) }}</b>
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
                                                                        Because there is one or more item(s) in your
                                                                        cart that are over the shipping companies'
                                                                        'normal' size limit, there is an additional fee
                                                                        to cover the extra cost of shipping. This fee is
                                                                        charged only once per order, regardless of the
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

                                    <h5 class="d-flex fw-bold"><span class="w-50">Your Price </span>

                                        <b class="w-50 text-end your_price">
                                            ${{ $helpers->withoutRounding($price - $cart->cart_item_discount + $cart->shipping_extra_amount + $cart->handling_extra_amount, 2) }}</b>
                                    </h5>


                                    <div class="taxData">
                                        @php
                                            $total = $price - $cart->cart_item_discount;
                                            $tax = json_decode($cart->cart_tax, true) ?? [];
                                        @endphp

                                        @foreach ($tax as $key => $value)
                                            @php
                                                $amount = (($price - $cart->cart_item_discount) * $value) / 100;
                                                $total += $amount;
                                            @endphp
                                            <h6 class="mb-2 d-flex text-primary" id="discountAmoutLabel"> <span
                                                    class="w-50 text-uppercase"></span>
                                                <b class="text-end w-50" id="cartSaveDiscount"></b>
                                            </h6>
                                        @endforeach
                                    </div>
                                    @php
                                        $total_your_price = $total + ($cart->shipping_extra_amount + $cart->handling_extra_amount);
                                    @endphp
                                    <h5 class="d-flex fw-bold" id="totalCart"><span
                                            class="w-50">TOTAL</span>

                                        <b class="w-50 text-end totalDisplay" id="totalDisplay">
                                            ${{ $helpers->withoutRounding($total_your_price, 2) }}</b>
                                    </h5>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
