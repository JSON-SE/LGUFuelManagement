@extends('layouts.Frontend.app')
@section('title')
    Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada
@endsection

@section('content')
    <section id="body-content">
        <div class="container pt-2 pb-4 pb-xxl-5">
            <div class="row gx-5">
                <div class="col-lg-8">
                    <div class="text-center p-4 pt-5 bg-secondary rounded ">
                        <h1 class="font-brittan text-white">
                            Thank You!
                        </h1>
                        <h4 class="font-secondary heading-two text-white pt-2">
                            Your order is confirmed now.
                        </h4>
                        <p class="text-white">
                            A confirmation email has been sent to your provided email address.
                        </p>
                        <a class="btn btn-primary mt-2" href="{{ url('/') }}">
                            Continue Shopping
                        </a>
                    </div>
                    <div class="my-2">
                        @if (Session::has('message'))
                            <div class="alert-success">
                                <p class="alert alert-info">
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                        @endif
                    </div>
                    <div class="pt-4">
                        <h5 class="border-start border-4 border-primary font-secondary ps-2">
                            Order Details
                        </h5>
                        <p class="ps-2 font-secondary">
                            Order #: {{ $cart->order->order_id ?? '' }}
                        </p>
                        <hr />
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <p class="fw-bold mb-2">
                                    Billed To:
                                </p>
                                <p class="mb-1">
                                    {{ ucfirst($billingAddress->first_name ?? '') }}
                                    {{ ucfirst($billingAddress->last_name ?? '') }}
                                </p>
                                <p class="mb-1">
                                    {{ $billingAddress->phone_number ?? '' }}
                                </p>
                                <p class="mb-1">
                                    {{ $billingAddress->street ?? '' }}, {{ $billingAddress->area_code ?? '' }}
                                    {{ $billingAddress->city ?? '' }}, {{ $billingAddress->province ?? '' }},
                                    {{ $billingAddress->postal_code ?? '' }}
                                </p>
                            </div>
                            <div class="col-lg-6 text-lg-end">
                                <p class="fw-bold mb-2">
                                    Shipping To:
                                </p>
                                <p class="mb-1">
                                    {{ ucfirst($shippingAddress->first_name ?? '') }}
                                    {{ ucfirst($shippingAddress->last_name ?? '') }}
                                </p>
                                <p class="mb-1">
                                    {{ $shippingAddress->email ?? '' }}
                                </p>
                                <p class="mb-1">
                                    {{ $shippingAddress->phone_number ?? '' }}
                                </p>

                                <p class="mb-1">
                                    {{ $shippingAddress->street ?? '' }},
                                    {{ $shippingAddress->area_code ?? '' }}
                                    {{ $shippingAddress->city ?? '' }},
                                    {{ $shippingAddress->province ?? '' }},
                                    {{ $shippingAddress->postal_code ?? '' }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-3 mb-2">
                            <div class="row" style="padding: 0 15px">
                                <div class="col-12 d-none d-md-block">
                                    <ul class="row bg-secondary  align-items-center py-2">
                                        <li class="col-md-4 text-white">
                                            Item
                                        </li>
                                        <li class="col text-white">
                                            Unit Price
                                        </li>
                                        <li class="col text-white">
                                            Discount
                                        </li>
                                        <li class="col text-white">
                                            Price
                                        </li>
                                        <li class="col text-white">
                                            Quantity
                                        </li>
                                        <li class="col text-white">
                                            Totals
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-3 col-12">
                                    @foreach ($cartItems as $item)
                                        @php
                                            $allOptions = $item->item($item->option_value);
                                        @endphp
                                        <ul class="row ul-table-row">
                                            <li data-label="Item:" class="col-md-4">
                                                {{ $item->getProductName($item->product_id) }}
                                            </li>
                                            <li data-label="Unit Price:" class="col">
                                                ${{ $helpers->withoutRounding($item->unit_price, 2) }}
                                            </li>
                                            <li data-label="Discount:" class="col">
                                                ${{ $helpers->withoutRounding($item->promo_price, 2) }}
                                            </li>
                                            <li data-label="Price:" class="col">
                                                ${{ $helpers->withoutRounding($item->purchase_price / (int) $item->quantity, 2) }}
                                            </li>
                                            <li data-label="Quantity:" class="col">
                                                {{ $item->quantity }}
                                            </li>
                                            <li data-label="Totals" class="col">
                                                ${{ $helpers->withoutRounding((float) $item->purchase_price, 2) }}
                                            </li>
                                        </ul>


                                        <div class="row">
                                            @if (!empty($item->item($item->option_value)))
                                                <div class="cart-box mt-1 mb-4 p-4 rounded"
                                                    id="cartItem{{ $item->id }}">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-sm-6 text-center">
                                                            <div class="cart-image h-100">
                                                                <img alt=""
                                                                    src="{{ $item->colorImage($allOptions['option_color']) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-10 pt-3 pt-lg-0">
                                                            <h5 class="font-weight-bold">
                                                                {{ $item->product->name ?? '' }}
                                                            </h5>
                                                            <p class="mb-2">
                                                                Estimated shipping date:
                                                                <b>
                                                                    {{ $helpers->estimatedShippingDate($order->created_at->format('Y-m-d')) }}
                                                                </b>
                                                            </p>
                                                            <div class="row pt-1">
                                                                <div class="col-md-12">
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
                                                                                <p class="mb-1 d-flex align-items-center"><b
                                                                                        class="w-50">Headrail:</b>
                                                                                    {{ $allOptions['headrail_option']['headrail_option'] == 0 ? 'Standard' : '2 on 1' }}

                                                                                </p>
                                                                            </div>
                                                                        @endif
                                                                        @if (!empty($allOptions['headrail_left_filter_width']))
                                                                            <div class="col-sm-6">
                                                                                <p class="mb-1 d-flex align-items-center"><b
                                                                                        class="w-50">Left panel
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
                                                                                        class="w-50">Right panel
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
                                                                                    <b class="w-50">Left panel
                                                                                        lift position:</b>
                                                                                    {{ $allOptions['headrail_left_lift_position']['headrail_left_lift_position'] ?? '' }}
                                                                                </p>
                                                                            </div>
                                                                        @endif

                                                                        @if (!empty($allOptions['headrail_right_lift_postion']))
                                                                            <div class="col-sm-6">
                                                                                <p class="mb-1 d-flex align-items-center">
                                                                                    <b class="w-50">Right panel
                                                                                        lift position:</b>
                                                                                    {{ $allOptions['headrail_right_lift_postion']['headrail_right_lift_postion'] ?? '' }}
                                                                                </p>
                                                                            </div>
                                                                        @endif

                                                                        @foreach ($allOptions as $key => $allItem)
                                                                            @if ($key !== 'total_price' && $key !== 'cart_id' && $key !== 'option_width_fraction' && $key !== 'measurement_price' && $key !== 'option_height_fraction' && $key !== 'unit_price' && $key !== 'option_color' && $key !== 'option_room_name' && $key !== 'option_width' && $key !== 'option_height' && $key !== 'option_mount' && $key !== 'headrail_option' && $key !== 'headrail_left_filter_width' && $key !== 'headrail_width_fraction_val' && $key !== 'headrail_left_lift_position' && $key !== 'headrail_filter_right_width' && $key !== 'headrail_filter_right_fraction' && $key !== 'headrail_right_lift_postion')
                                                                                <div class="col-sm-6">
                                                                                    <p
                                                                                        class="mb-1 d-flex align-items-center">
                                                                                        <b
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
                                                                        @if (!empty($item->customer_note))
                                                                            <div class="col-sm-6">
                                                                                <label class="form-label font-weight-bold"
                                                                                    for="">
                                                                                    Note
                                                                                </label>
                                                                                <p>
                                                                                    {{ !empty($item->customer_note) ? $item->customer_note : 'N/A' }}
                                                                                </p>
                                                                            </div>
                                                                        @endif
                                                                        @if (!empty($item->room_name))
                                                                            <div class="col-sm-6 pt-3 pt-sm-0">
                                                                                <label class="form-label font-weight-bold"
                                                                                    for="">
                                                                                    Room Name
                                                                                </label>
                                                                                <p>
                                                                                    {{ !empty($item->room_name) ? $item->room_name : 'N/A' }}
                                                                                </p>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-lg-6">
                                <div class="bg-white rounded shadow-sm p-3">
                                    <h6 class="d-flex">
                                        <span class="w-50">
                                            Subtotal
                                            <small>
                                                ({{ $sumOfQty }} items)
                                            </small>
                                        </span>
                                        <b class="w-50 text-end">
                                            ${{ $helpers->withoutRounding($cart->cart_total_price, 2) }}
                                        </b>
                                    </h6>
                                    {{-- <h6 class="mb-2 d-flex text-primary">
                                        <span class="w-50">
                                            Sale Discount
                                            <span id="cartSaveAmount">
                                            </span>
                                        </span>
                                        <b class="text-end w-50" id="cartSaveDiscount">
                                            -${{ $helpers->withoutRounding($totalSave, 2) }}
                                        </b>
                                    </h6> --}}
                                    @foreach ($promo_items as $key => $item)
                                        <h6 class="mb-2 d-flex text-primary">
                                            <span class="w-50">Sale Discount <span id="cart_product_promo_name">
                                                    <span>{{ $item->promo_type == 'flat' ? '$' : '' }}{{ $item->promo_discount }}{{ $item->promo_type == 'percentage' ? '%' : '' }}</span>
                                                </span> </span>
                                            <b class="text-end w-50"
                                                id="cart_product_promo_value{{ $item->product_id }}">-${{ number_format($item->promoPrice($cart->id, $item->product_id), 2) }}</b>
                                        </h6>
                                    @endforeach
                                    <div id="couponDiscount">
                                        @if (!empty($cart->coupon) && !empty($cart->discount))
                                            <h6 class="mb-2 d-flex text-primary" id="discountAmoutLabel">
                                                <span class="w-50">
                                                    Extra Coupon Discount
                                                    {{-- {{ $coupon->type === 'percentage' && !empty($coupon->amount) ? $coupon->amount . '%' : '' }} --}}
                                                </span>
                                                <b class="text-end w-50" id="cartSaveDiscount">
                                                    -${{ $helpers->withoutRounding($cart->cart_item_discount, 2) }}
                                                </b>
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

                                    <hr class="my-2">
                                    <h5 class="d-flex fw-bold">
                                        <span class="w-50">
                                            Your Price
                                        </span>
                                        <b class="w-50 text-end">
                                            @php
                                                $your_price = $cart->cart_amount - $cart->cart_item_discount + ($cart->shipping_extra_amount + $cart->handling_extra_amount);
                                            @endphp
                                            ${{ $helpers->withoutRounding($your_price, 2) }}
                                        </b>

                                    </h5>
                                    <div id="taxData">
                                        @php
                                            $total = $cart->cart_amount - $cart->cart_item_discount;
                                            $tax = json_decode($cart->cart_tax, true) ?? [];
                                            $tatal_tax = array_sum(array_values($tax));
                                            $total_tax_amount = 0;
                                            $add_total_tax_amount = $cart->cart_amount - $cart->cart_item_discount + ((float) $cart->shipping_extra_amount + (float) $cart->handling_extra_amount);
                                            $analytic_total_tax = [];
                                        @endphp

                                        @foreach ($tax as $key => $value)

                                            @php
                                                $amount = (float) (($add_total_tax_amount * $value) / 100);
                                                $total_tax_amount = (float) (($add_total_tax_amount * $tatal_tax) / 100); // for google analytic
                                                $total += $amount;
                                                $analytic_total_tax[] = $amount;

                                            @endphp
                                            <h6 class="mb-2 d-flex text-primary" id="discountAmoutLabel">
                                                <span class="w-50 text-uppercase">
                                                    {{ $key }}( {{ $value }}% )
                                                </span>
                                                <b class="text-end w-50" id="cartSaveDiscount">
                                                    ${{ $helpers->withoutRounding($amount, 2) }}
                                                </b>
                                            </h6>
                                        @endforeach

                                    </div>
                                    @php
                                        $total_your_price = $total + ($cart->shipping_extra_amount + $cart->handling_extra_amount);
                                        $google_analytic_total_tax = array_sum(array_values($analytic_total_tax));
                                        $google_analytic_total_tax = $helpers->withoutRounding($google_analytic_total_tax, 2);
                                    @endphp
                                    <h5 class="d-flex fw-bold" id="totalCart">
                                        <span class="w-50">
                                            TOTAL
                                        </span>
                                        <b class="w-50 text-end" id="totalDisplay">
                                            ${{ $helpers->withoutRounding($total_your_price, 2) }}
                                        </b>
                                    </h5>
                                    </hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="shadow rounded text-center p-3 text-cente">
                        <img alt="" src="{{ url('images/24-hours-outline.png') }}" />
                        <h4 class="pt-3">
                            Have
                            <span class="text-primary">
                                questions?
                            </span>
                        </h4>
                        <h5 class="fw-bold">
                            <a href="tel:(888) 412-3439">
                                (888) 412-3439
                            </a>
                        </h5>
                        <p class="small">
                            Monday - Friday 8AM - 10PM EST
                        </p>

                    </div>
                    <h5 class="border-start border-4 border-primary font-secondary ps-2 mt-4">
                        Order Date:
                    </h5>
                    <div class="cart-box rounded text-primary fw-bold p-3">
                        {{ $order->created_at->format('M d, Y') }}
                    </div>
                    <div class="mt-4">
                        <a class="btn btn-primary mt-2"
                            href="{{ route('frontend.invoice.download', $cart->external_id) }}">
                            Download PDF
                        </a>
                        {{-- <a class="btn btn-primary mt-2"
                            href="{{ route('frontend.invoice.email', $cart->external_id) }}">
                            Re-send order confirmation email
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        eraseCookie('__cart_items');
        window.onload = function() {
            localStorage.removeItem('__cart_items');
        };
        localStorage.removeItem('__cart_items');
        $(document).ready(function() {
            eraseCookie('__cart_items');
            localStorage.removeItem('__cart_items');
        });
    </script>
    {{-- @if ($order->google_review_status != true) --}}

    <script>
        var dataLayer = window.dataLayer || [];
        dataLayer.push({
            'event': 'transaction',
            'ecommerce': {
                'purchase': {
                    'actionField': {
                        'id': '{{ $order->order_id }}', // Transaction ID. Required
                        'affiliation': 'Heyblinds',
                        'revenue': '{{ (float) $helpers->grand_total_amount_of_google_analytic($cart->id) }}', // Total transaction value (incl. tax and shipping)
                        'tax': '{{ (float) $total_tax_amount ?? '0.00' }}',
                        'shipping': '{{ (float) $cart->shipping_extra_amount ?? '0.00' }}',
                        'coupon': '{{ $cart->coupon ?? '' }}',
                        'handling_extra_amount': '{{ (float) $cart->handling_extra_amount ?? '0.00' }}',
                        'total_after_discount_before_taxes': '{{ (float) $your_price ?? '0.00' }}'

                    },
                    'products': {!! $dataTag !!}
                }
            }
        })
        window.onload = (event) => {
            axios.post('/google-review-status', {
                cart_id: {{ $cart->id }}
            });
        }
    </script>
    {{-- @endif --}}
@endpush
