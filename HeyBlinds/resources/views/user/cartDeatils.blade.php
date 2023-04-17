@extends('layouts.Frontend.app')
@section('content')

    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order item details</li>
            </ol>
        </nav>
    </section>

    <section id="body-content">
        <div class="container py-3 pb-4 pb-xxl-5">
            <div class="row">
                <div class="col-lg-4">
                    @include('user.sidebar')
                </div>


                <div class="col-lg-8 pt-4">
                    <div class="row align-items-center">
                        @if (Session::has('message'))
                            <span class="alert-success">
                                <p class="alert alert-info">{{ Session::get('message') }}</p>
                            </span>
                        @endif
                        <div class="col-md-6">
                            <h5 class="font-secondary fw-bold mb-md-0">Orders Details</h5>
                        </div>

                        @if ($order->order_status != 10)
                            <div class="col-md-6 text-md-end">
                                <a href="{{ url('invoice/send-invoice-email/' . $cart->external_id) }}"
                                    class="btn btn-primary mt-2 mt-md-0">Share with Email</a>
                                <a href="{{ url('/invoice/download/' . $cart->external_id) }}"
                                    class="btn btn-primary mt-2 mt-md-0">Save as PDF</a>
                            </div>
                        @endif
                    </div>

                    <hr class="mt-2" />

                    <p><b>Email:</b> <a class="me-2"
                            href="mailto:customer@gmail.com">{{ $billingAddress->email }}</a> | <b
                            class="ms-2">Phone:</b> <a href="tel:">{{ $billingAddress->phone_number }}</a> </p>

                    <div class="row justify-content-between">

                        <div class="col-md-6 col-lg-4">
                            <p class="font-secondary fw-bold mt-4 mb-0">Billing Address</p>

                            <p class="border-start border-3 border-primary ps-3 mt-3">
                                {{ $billingAddress->billing_addresses }} {{ $billingAddress->city }},
                                {{ $billingAddress->province }} ,{{ $billingAddress->postal_code }}
                            </p>

                        </div>

                        <div class="col-md-6 col-lg-4">
                            <p class="font-secondary fw-bold mt-4 mb-0">Shipping Address</p>

                            <p class="border-start border-3 border-primary ps-3 mt-3">
                                {{ $shippingAddress->billing_addresses }} {{ $shippingAddress->city }},
                                {{ $shippingAddress->province }} ,{{ $shippingAddress->postal_code }}
                            </p>

                        </div>
                    </div>

                    {{-- foreach --}}
                    @foreach ($cartItems as $item)
                        <div class="cart-box mt-3 p-4 rounded">

                            <div class="row">
                                <div class="col-md-4 col-sm-6 text-center">
                                    <div class="cart-image">
                                        <img src="{{ $helpers->getImage($item->product->display_media_id ?? 0) }}"
                                            alt="" />
                                    </div>

                                </div>
                                <div class="col-md-8 pt-3 pt-lg-0">
                                    <h5 class="font-weight-bold">{{ $item->getProductName($item->product_id) }}</h5>
                                    <p class="mb-2">Estimated shipping date:
                                        <b>{{ $helpers->estimatedShippingDate($order->created_at->format('Y-m-d')) }}</b>
                                    </p>
                                    <div class="row pt-1">
                                        @php
                                            $allOptions = $item->item($item->option_value);
                                        @endphp

                                        @foreach ($item->item($item->option_value) as $key => $allItem)
                                            @if ($key !== 'total_price' && $key !== 'cart_id' && $key !== 'option_width_fraction' && $key !== 'option_height_fraction' && $key !== 'unit_price')
                                                <div class="col-sm-6">
                                                    @if ($key === 'option_color')
                                                        <p class="mb-1 d-flex align-items-center"><b
                                                                class="w-50">Color:</b>
                                                            <small
                                                                class="w-50">{{ $item->colorName($allItem['option_color']) }}</small>
                                                        </p>
                                                    @elseif($key === 'option_width')
                                                        <p class="mb-1 d-flex align-items-center"><b
                                                                class="w-50">Width
                                                                <small>(Inches)</small>:</b>
                                                            {{ !empty($allItem['option_width']) ? $allItem['option_width'] : '' }}
                                                            <small>&nbsp;
                                                                {{ !empty($allOptions['option_width_fraction']['option_width_fraction'])? $allOptions['option_width_fraction']['option_width_fraction']: '0/0' }}</small>
                                                        </p>
                                                    @elseif($key === 'option_height')
                                                        <p class="mb-1 d-flex align-items-center"><b
                                                                class="w-50">Height
                                                                <small>(Inches)</small>:</b>
                                                            {{ !empty($allItem['option_height']) ? $allItem['option_height'] : '' }}
                                                            <small>&nbsp;
                                                                {{ !empty($allOptions['option_height_fraction']['option_height_fraction'])? $allOptions['option_height_fraction']['option_height_fraction']: '0/0' }}</small>
                                                        </p>
                                                    @elseif($key === 'option_room_name')
                                                        @if (!empty($item->room_name))
                                                            <p class="mb-1 d-flex align-items-center"><b
                                                                    class="w-50">Room Name:
                                                                </b> <small
                                                                    class="w-50">{{ $item->room_name }}</small>
                                                            </p>
                                                        @endif

                                                    @else
                                                        <p class="mb-1 d-flex align-items-center"><b
                                                                class="w-50">{{ ucwords(str_replace(['suboption_', 'option_', '_'], ['', '', ' '], $key)) }}:</b>
                                                            <small
                                                                class="w-50">{{ $item->optionName($allItem[$key], $key) }}</small>
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="col-sm-6">
                                            <p class="mb-1  d-flex"><b class="w-50">Quantity:</b> <small
                                                    class="w-50">{{ $item->quantity }}</small></p>

                                        </div>
                                        <div>
                                            <hr />
                                            <h6>Unit Price:
                                                <b>${{ $helpers->withoutRounding($item->unit_price / $item->quantity, 2) }}</b>
                                            </h6>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach


                    <div class="row gx-3 mb-3">
                        <div class="row justify-content-end">
                            <div class="col-lg-6">
                                <div class="bg-white rounded shadow-sm p-3">

                                    <h6 class="d-flex"><span
                                            class="w-50">SubTotal<small>&nbsp;({{ $sumOfQty }}
                                                items)</small></span> <b
                                            class="w-50 text-end">${{ $cart->cart_total_price }}</b></h6>

                                    <h6 class="mb-2 d-flex text-primary">
                                        <span class="w-50">Sale Discount <span id="cartSaveAmount"></span> </span>
                                        <b class="text-end w-50"
                                            id="cartSaveDiscount">-${{ $helpers->withoutRounding($totalSave, 2) }}</b>
                                    </h6>

                                    <div id="couponDiscount">
                                        @if (!empty($cart->coupon) && !empty($cart->discount))
                                            <h6 class="mb-2 d-flex text-primary" id="discountAmoutLabel">
                                                <span class="w-50">Extra Coupon Discount
                                                    {{-- {{$coupon->type === "percentage" && !empty($coupon->amount) ?  $coupon->amount."%" : "Flat "}} --}}
                                                </span>
                                                <b class="text-end w-50"
                                                    id="cartSaveDiscount">-${{ $helpers->withoutRounding($cart->cart_item_discount, 2) }}</b>
                                            </h6>
                                        @endif
                                    </div>

                                    <h6 class="mb-2 d-flex text-success">
                                        <span class="w-50">Shipping <span class=" ps-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z">
                                                    </path>
                                                    <path
                                                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z">
                                                    </path>
                                                </svg>
                                            </span></span>
                                        <b class="w-50 text-end">Free</b>
                                    </h6>

                                    {{-- <h6 class="mb-2 d-flex text-success">
                            <span class="w-50">7 Year Warranty <span class=" ps-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"></path>
                                </svg>
                            </span></span>
                            <b class="text-end w-50">Free</b>
                        </h6> --}}

                                    <h6 class="mb-2 d-flex text-success">
                                        <span class="w-50">Handling <span class=" ps-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z">
                                                    </path>
                                                    <path
                                                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z">
                                                    </path>
                                                </svg>
                                            </span></span>
                                        <b class="text-end w-50">Free</b>
                                    </h6>

                                    <hr class="my-2">

                                    {{-- <h5 class="d-flex fw-bold"><span class="w-50">Your Price </span>
                                    <b class="w-50 text-end">${{ number_format($cart->cart_amount - $cart->cart_item_discount, 2) }}</b></h5> --}}

                                    <div id="taxData">
                                        @php
                                            $total = $cart->cart_amount - $cart->cart_item_discount;
                                            $tax = json_decode($cart->cart_tax, true) ?? [];
                                        @endphp
                                        @foreach ($tax as $key => $value)
                                            @php
                                                $amount = (($cart->cart_amount - $cart->cart_item_discount) * $value) / 100;
                                                $total += $amount;
                                            @endphp
                                            <h6 class="mb-2 d-flex text-primary" id="discountAmoutLabel">
                                                <span class="w-50 text-uppercase">{{ $key }}(
                                                    {{ $value }}% )</span>
                                                <b class="text-end w-50"
                                                    id="cartSaveDiscount">${{ $helpers->withoutRounding($amount, 2) }}</b>
                                            </h6>
                                        @endforeach
                                    </div>
                                    <h5 class="d-flex fw-bold"><span class="w-50">Your Price</span> <b
                                            class="w-50 text-end">${{ $helpers->withoutRounding($total, 2) }}</b></h5>
                                    @if ($order->order_status != 10)
                                        <a href="{{ url('/invoice/download/' . $cart->external_id) }}"
                                            class="btn btn-primary w-100 mt-2 btn-lg">Download Order Details</a>
                                    @else
                                        <a href="#" class="btn btn-primary disabled w-100 mt-2 btn-lg">Transaction
                                            Failed.</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
