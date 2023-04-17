<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <!-- CSS only -->

    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}" media="all">

    <style type="text/css">
        * {
            -webkit-font-smoothing: antialiased;
            margin: 0;
            padding: 0;
        }

        @page {
            margin: 100px 25px;
        }

        html {
            margin: 40px 0px
        }


        body {
            Margin: 0;
            padding: 0;
            min-width: 100%;
            -webkit-font-smoothing: antialiased;
            mso-line-height-rule: exactly;
        }

        .body-table {
            border-spacing: 0;
            color: #333333;
            font-family: Arial, sans-serif;
            margin-top: 15px;
        }


        .body-table>thead {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
        }

        .body-table>thead>tr>td {
            background-color: #577399;
            padding: .5rem .5rem;
            font-size: 15px;
            color: #FFFFFF;
        }



        /*.body-table > tbody > tr:nth-child(odd){*/
        /*    background-color: #f2f2f2;*/
        /* }*/
        .even td {
            border-bottom: 1px solid #000;
        }

        .body-table>tbody>tr>td {
            padding: .5rem .5rem;
            font-size: 15px;
        }

        img {
            border: 0;
        }

        /* .page-break {
            page-break-before: always;
        } */

        .page-break {
            page-break-after: always;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        }

    </style>
</head>
@php

$avatarUrl = 'https://heyblinds.ca/images/logo.png';
$arrContextOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
];
$type = pathinfo($avatarUrl, PATHINFO_EXTENSION);
$avatarData = file_get_contents($avatarUrl, false, stream_context_create($arrContextOptions));
$avatarBase64Data = base64_encode($avatarData);
$imageData = 'data:image/' . $type . ';base64,' . $avatarBase64Data;
@endphp

<body
    style="Margin:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;min-width:100%;background-color:#FFFFFF;">

    <center class="wrapper"
        style="width:100%;table-layout:fixed; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; background-color:#FFFFFF;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style=" background-color:#FFFFFF;"
            bgcolor="#FFFFFF;">
            <tr>
                <td width="100%" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0; margin: 0;">
                    <div class="webkit" style="max-width:700px;Margin:0 auto;">

                        <!-- ======= start main body ======= -->
                        <table class="outer" align="center" cellpadding="0" cellspacing="0" border="0"
                            style="border-spacing:0;Margin:0 auto;width:100%;max-width:600px;">
                            <tr>
                                <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">

                                    <!-- ======= start two column ======= -->

                                    <table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#FFFFFF">
                                        <tr>
                                            <td style="padding: 30px 20px 10px;">

                                                <div style="text-align: center;">
                                                    <img src="{{ $imageData }}">
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 0px 20px 0;">
                                                <p
                                                    style="font-size: 20px; font-weight: 600; padding-left: 25px; border-left: solid 4px #fe5f55; padding: 3px 0 3px 15px;">
                                                    Order Details</p>
                                                <p style="padding-left: 20px; ">Order #: {{ $orderId }}</p>
                                                <div style="border-top: solid 1px #ccc; margin-top: 20px;">
                                                </div>

                                            </td>

                                        </tr>


                                        <tr>
                                            <td class="two-column"
                                                style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;font-size:0;">


                                                <div class="column"
                                                    style="width:100%;max-width:350px;display:inline-block;vertical-align:top;">
                                                    <table width="100%" style="border-spacing:0">
                                                        <tr>
                                                            <td class="inner"
                                                                style="padding-top:20px;padding-bottom:10px;padding-right:10px;padding-left:20px;">
                                                                <table class="contents"
                                                                    style="border-spacing:0;width:100%;font-size:14px;text-align:left;">

                                                                    <tr>
                                                                        <td align="left" class="text"
                                                                            style="padding-bottom:0;padding-right:0;padding-left:0;padding-top:10px;">
                                                                            <p
                                                                                style="font-size:16px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:left; padding-bottom: 5px;">
                                                                                <strong>Billed To:</strong>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" class="text"
                                                                            style="padding-bottom:0;padding-right:0;padding-left:0;padding-top:0px;">
                                                                            <table border="0" cellpadding="0"
                                                                                cellspacing="0"
                                                                                style="border-bottom:2px solid #fe5f55">
                                                                                <tr>
                                                                                    <td height="5" width="50"
                                                                                        style="font-size: 10px; line-height:10px">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" class="text"
                                                                            style="padding-bottom:0;padding-right:0;padding-left:0;padding-top:20px;">
                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:left">
                                                                                {{ ucfirst($billingAddress->first_name ?? '') }}
                                                                                {{ ucfirst($billingAddress->last_name ?? '') }}
                                                                            </p>

                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:left">
                                                                                {{ $billingAddress->phone_number ?? '' }}
                                                                            </p>

                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:left">
                                                                                {{ $billingAddress->street . ', ' ?? '' }}
                                                                                @if (!empty($billingAddress->area_code))
                                                                                    {{ $billingAddress->area_code . ',' ?? '' }}
                                                                                @endif
                                                                            </p>

                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:left">
                                                                                {{ $billingAddress->city . ', ' ?? '' }}
                                                                                {{ $billingAddress->province . ', ' ?? '' }}
                                                                            </p>

                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:left">
                                                                                {{ $billingAddress->postal_code ?? '' }}
                                                                            </p>

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="column"
                                                    style="width:100%;max-width:350px;display:inline-block;vertical-align:top;">
                                                    <table width="100%" style="border-spacing:0">
                                                        <tr>
                                                            <td class="inner"
                                                                style="padding-top:20px;padding-bottom:10px;padding-right:20px;padding-left:10px;">
                                                                <table class="contents"
                                                                    style="border-spacing:0;width:100%;font-size:14px;text-align:right;">

                                                                    <tr>
                                                                        <td align="left" class="text"
                                                                            style="padding-bottom:0;padding-right:0;padding-left:0;padding-top:10px;">
                                                                            <p
                                                                                style="font-size:16px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:right; padding-bottom: 5px;">
                                                                                <strong>Shipped To:</strong>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="right" class="text"
                                                                            style="padding-bottom:0;padding-right:0;padding-left:0;padding-top:0px;">
                                                                            <table border="0" cellpadding="0"
                                                                                cellspacing="0"
                                                                                style="border-bottom:2px solid #fe5f55">
                                                                                <tr>
                                                                                    <td height="5" width="50"
                                                                                        style="font-size: 10px; line-height:10px">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="right" class="text"
                                                                            style="padding-bottom:0;padding-right:0;padding-left:0;padding-top:20px;">
                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:right">
                                                                                {{ ucfirst($shippingAddress->first_name ?? '') }}
                                                                                {{ ucfirst($shippingAddress->last_name ?? '') }}
                                                                            </p>
                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:right">
                                                                                {{ $shippingAddress->email ?? '' }}
                                                                            </p>

                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:right">
                                                                                {{ $shippingAddress->phone_number ?? '' }}
                                                                            </p>

                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:right">
                                                                                {{ $shippingAddress->street . ', ' ?? '' }}
                                                                                @if (!empty($shippingAddress->area_code))
                                                                                    {{ $shippingAddress->area_code . ',' ?? '' }}
                                                                                @endif
                                                                            </p>
                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:right">
                                                                                {{ $shippingAddress->city . ', ' ?? '' }}
                                                                                {{ $shippingAddress->province . ', ' ?? '' }}
                                                                            </p>
                                                                            <p
                                                                                style="font-size:14px; text-decoration:none; color:#3a3d41; font-family: Verdana, Geneva, sans-serif; text-align:right">
                                                                                {{ $shippingAddress->postal_code ?? '' }}
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="mt-3 mb-5">
                                        <table class="body-table" width="100%">
                                            <thead style="background-color:#577399;">
                                                <tr style="background-color:#577399;">
                                                    <td>Item</td>
                                                    <td>Unit Price</td>
                                                    <td>Discount </td>
                                                    <td>Price</td>
                                                    <td>Quantity</td>
                                                    <td>Totals</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cartItems as $index => $item)
                                                    {{-- <tr>
                <td>
                    <div class="{{$index == 4 || $index == 11    ? 'header page-break' : ''}}"></div>
                </td>
            </tr> --}}

                                                    <tr class="odd">
                                                        <td style="width: 35%">
                                                            {{ $item->getProductName($item->product_id) }}</td>
                                                        <td>${{ $helpers->withoutRounding($item->unit_price, 2) }}
                                                        </td>
                                                        <td>${{ number_format($item->promo_price, 2) }}</td>
                                                        <td>${{ number_format($item->purchase_price / $item->quantity, 2) }}
                                                        </td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>${{ number_format($item->purchase_price, 2) }}</td>
                                                    </tr>
                                                    <tr class="even">
                                                        <td colspan="6">
                                                            @if (!empty($item->item($item->option_value)))
                                                                @php
                                                                    $allOptions = $item->item($item->option_value);
                                                                @endphp
                                                                <div style="margin: 5px 0 15px 0">
                                                                    @foreach ($item->item($item->option_value) as $key => $allItem)
                                                                        @if ($key !== 'total_price' && $key !== 'cart_id' && $key !== 'option_width_fraction' && $key !== 'measurement_price' && $key !== 'option_height_fraction' && $key !== 'unit_price' && $key !== 'headrail_width_fraction_val' && $key !== 'headrail_filter_right_fraction')
                                                                            <span style="margin-right: 15px">
                                                                                @if ($key === 'option_color')
                                                                                    <span><strong>Color:</strong>
                                                                                        <small
                                                                                            class="w-50">{{ $item->colorName($allItem['option_color']) }}</small>
                                                                                    </span>
                                                                                @elseif($key === 'option_width')
                                                                                    <span><strong>Width
                                                                                            <small>(Inches)</small>:</strong>
                                                                                        {{ !empty($allItem['option_width']) ? $allItem['option_width'] : '' }}
                                                                                        <small>&nbsp;
                                                                                            {{ !empty($allOptions['option_width_fraction']['option_width_fraction']) ? $allOptions['option_width_fraction']['option_width_fraction'] : '0/0' }}</small>
                                                                                    </span>
                                                                                @elseif($key === 'option_height')
                                                                                    <span><strong>Height
                                                                                            <small>(Inches)</small>:</strong>
                                                                                        {{ !empty($allItem['option_height']) ? $allItem['option_height'] : '' }}
                                                                                        <small>&nbsp;
                                                                                            {{ !empty($allOptions['option_height_fraction']['option_height_fraction']) ? $allOptions['option_height_fraction']['option_height_fraction'] : '0/0' }}</small>
                                                                                    </span>

                                                                                @elseif($key === 'headrail_option')
                                                                                    <span><strong>Headrail:</strong>
                                                                                        {{ $allOptions['headrail_option']['headrail_option'] == 0 ? 'Standard' : '2 on 1' }}

                                                                                    </span>
                                                                                @elseif($key === 'headrail_filter_right_width')
                                                                                    <span>
                                                                                        <strong> Right
                                                                                            panel<small>&nbsp;(Inches)</small>:</strong>
                                                                                        {{ $allOptions['headrail_filter_right_width']['headrail_filter_right_width'] ?? '' }}
                                                                                        <small>&nbsp;
                                                                                            {{ $allOptions['headrail_filter_right_fraction']['headrail_filter_right_fraction'] ?? '0/0' }}</small>
                                                                                    </span>
                                                                                @elseif($key === 'headrail_left_filter_width')
                                                                                    <span><strong> Left panel
                                                                                            <small>(Inches)</small>:</strong>
                                                                                        {{ $allOptions['headrail_left_filter_width']['headrail_left_filter_width'] ?? '' }}
                                                                                        <small>&nbsp;
                                                                                            {{ $allOptions['headrail_width_fraction_val']['headrail_width_fraction_val'] ?? '0/0' }}</small>
                                                                                    </span>

                                                                                @elseif($key === 'headrail_left_lift_position')
                                                                                    <span><strong>Left panel
                                                                                            lift position:</strong>
                                                                                        {{ $allOptions['headrail_left_lift_position']['headrail_left_lift_position'] ?? '' }}

                                                                                    </span>

                                                                                @elseif($key === 'headrail_right_lift_postion')
                                                                                    <span><strong>Right panel lift
                                                                                            position:</strong>
                                                                                        {{ $allOptions['headrail_right_lift_postion']['headrail_right_lift_postion'] ?? '' }}

                                                                                    </span>



                                                                                @elseif($key === 'option_room_name')
                                                                                    @if (!empty($item->room_name))
                                                                                        <span><strong>Room Name:
                                                                                            </strong> <small
                                                                                                class="w-50">{{ $item->room_name }}</small>
                                                                                        </span>
                                                                                    @endif
                                                                                @else
                                                                                    <span><strong>{{ ucwords(str_replace(['suboption_', 'option_', '_'], ['', '', ' '], $key)) }}:</strong>
                                                                                        <small>{{ $item->optionName($allItem[$key], $key) }}</small>
                                                                                    </span>
                                                                                @endif
                                                                            </span>

                                                                        @endif
                                                                    @endforeach
                                                                    <br />
                                                                    @if (!empty($item->customer_note))

                                                                        <span><strong>Note:</strong><small>
                                                                                {{ !empty($item->customer_note) ? $item->customer_note : 'N/A' }}</small></span>
                                                                    @endif
                                                                    @if (!empty($item->room_name))
                                                                        <span><strong>Room
                                                                                Name:</strong><small>{{ !empty($item->room_name) ? $item->room_name : 'N/A' }}</small></span>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td>
                                                            <div
                                                                class="{{ $index == 4 || $index == 11 ? 'header page-break' : '' }}">
                                                            </div>
                                                        </td>
                                                    </tr> --}}

                                                @endforeach

                                            </tbody>
                                        </table>

                                    </div>
                                    <div
                                        class="{{ $cartItems->count() == 3 || $cartItems->count() == 7 ? 'page-break' : '' }}">
                                    </div>

                                    <table width="100%" style="border-spacing:0">
                                        <tr>
                                            <td
                                                style="padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;">
                                                <table class="one-column" border="0" cellpadding="0" cellspacing="0"
                                                    width="100%" style="border-spacing:0" bgcolor="#FFFFFF">
                                                    <tr>
                                                        <td class="two-column"
                                                            style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:right;font-size:0;">

                                                            <div class="column"
                                                                style="width:100%;max-width:350px;display:inline-block;vertical-align:top;">
                                                                <table width="100%" style="border-spacing:0">
                                                                    <tr>
                                                                        <td class="inner"
                                                                            style="padding-top:20px;padding-bottom:10px;padding-right:10px;padding-left:20px;">

                                                                        </td>
                                                                    </tr>

                                                                </table>
                                                            </div>
                                                            <div class="column"
                                                                style="width:100%;max-width:350px;display:inline-block;vertical-align:top;">
                                                                <table width="100%" style="border-spacing:0">
                                                                    <tr>
                                                                        <td class="inner"
                                                                            style="padding-top:20px;padding-bottom:30px;padding-right:20px;padding-left:10px;">
                                                                            <table class="one-column"
                                                                                border="solid 1px #ccc" cellpadding="0"
                                                                                cellspacing="0" width="100%"
                                                                                style="border-spacing:0"
                                                                                bgcolor="#FFFFFF">

                                                                                <tbody
                                                                                    style="border-bottom: solid 1px #ccc;">
                                                                                    <tr>
                                                                                        <td
                                                                                            style="border: 0; padding: 5px 10px; text-align: left; font-size: 14px; font-weight: 400; border-top: solid 1px #ccc;">
                                                                                            SubTotal
                                                                                            ({{ $sumOfQty }} items)
                                                                                        </td>
                                                                                        <td
                                                                                            style="border: 0; text-align: right; padding: 5px 10px; font-size: 14px; font-weight: 600; border-top: solid 1px #ccc; border-left: solid 1px #ccc;">
                                                                                            ${{ number_format($cart->cart_total_price, 2) }}
                                                                                        </td>

                                                                                    </tr>
                                                                                    @foreach ($promo_items as $key => $item)
                                                                                        <tr>
                                                                                            <td
                                                                                                style="border: 0; color:#fe5f55; padding: 5px 10px; text-align: left; font-size: 14px; font-weight: 400; border-top: solid 1px #ccc;">
                                                                                                Sale Discount
                                                                                                {{ $item->promo_type == 'flat' ? '$' : '' }}{{ $item->promo_discount }}{{ $item->promo_type == 'percentage' ? '%' : '' }}
                                                                                            </td>
                                                                                            <td
                                                                                                style="border: 0; color:#fe5f55; text-align: right; padding: 5px 10px; font-size: 14px; font-weight: 600; border-top: solid 1px #ccc; border-left: solid 1px #ccc;">
                                                                                                -${{ number_format($item->promoPrice($cart->id, $item->product_id), 2) }}
                                                                                            </td>

                                                                                        </tr>
                                                                                    @endforeach



                                                                                    @if (!empty($cart->coupon) && !empty($cart->discount))

                                                                                        <tr>
                                                                                            <td
                                                                                                style="border: 0; color: #fe5f55; padding: 5px 10px; text-align: left; font-size: 14px; font-weight: 400; border-top: solid 1px #ccc;">
                                                                                                Extra Coupon Discount
                                                                                                {{-- {{$coupon->type === "percentage" && !empty($coupon->amount) ?  $coupon->amount."%" : ""}} --}}
                                                                                            </td>
                                                                                            <td
                                                                                                style="border: 0; color: #fe5f55; text-align: right; padding: 5px 10px; font-size: 14px; font-weight: 600; border-top: solid 1px #ccc; border-left: solid 1px #ccc;">
                                                                                                -${{ number_format($cart->cart_item_discount, 2) }}
                                                                                            </td>
                                                                                        </tr>

                                                                                    @endif


                                                                                    @if ($cart->shipping_extra_amount > 0)
                                                                                        <tr>
                                                                                            <td
                                                                                                style="border: 0;  color: {{ $cart->shipping_extra_amount > 0 ? '#fe5f55' : '#198754' }}; padding: 5px 10px; text-align: left; font-size: 14px; font-weight: 400; border-top: solid 1px #ccc;">
                                                                                                Oversize Fee</td>
                                                                                            <td
                                                                                                style="border: 0; color: {{ $cart->shipping_extra_amount > 0 ? '#fe5f55' : '#198754' }}; text-align: right; padding: 5px 10px; font-size: 14px; font-weight: 600; border-top: solid 1px #ccc; border-left: solid 1px #ccc;">
                                                                                                +{{ $cart->shipping_extra_amount > 0 ? '$' . number_format($cart->shipping_extra_amount, 2) : 'Free' }}
                                                                                            </td>

                                                                                        </tr>
                                                                                    @endif
                                                                                    <tr>
                                                                                        <td
                                                                                            style="border: 0;  padding: 5px 10px; text-align: left; font-size: 14px; font-weight: 400; border-top: solid 1px #ccc;">
                                                                                            Shipping</td>
                                                                                        <td
                                                                                            style="border: 0;  text-align: right; padding: 5px 10px; font-size: 14px; font-weight: 600; border-top: solid 1px #ccc; border-left: solid 1px #ccc;">
                                                                                            Free</td>

                                                                                    </tr>


                                                                                    <tr>
                                                                                        <td
                                                                                            style="border: 0;  padding: 7px 10px; text-align: left; font-size: 14px; font-weight: 400; border-top: solid 1px #ccc;">
                                                                                            Handling </td>
                                                                                        <td
                                                                                            style="border: 0;  text-align: right; padding: 7px 10px; font-size: 14px; font-weight: 600; border-top: solid 1px #ccc; border-left: solid 1px #ccc;">
                                                                                            {{ $cart->handling_extra_amount > 0 ? '$' . number_format($cart->handling_extra_amount, 2) : 'Free' }}
                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td
                                                                                            style="border: 0; padding: 10px 10px; text-align: left; font-size: 16px; font-weight: 600; border-top: solid 1px #ccc;">
                                                                                            Your Price </td>
                                                                                        @php
                                                                                            $your_price = $cart->cart_amount - $cart->cart_item_discount + ($cart->shipping_extra_amount + $cart->handling_extra_amount);
                                                                                        @endphp
                                                                                        <td
                                                                                            style="border: 0; text-align: right; padding: 10px 10px; font-size: 16px; font-weight: 600; border-top: solid 1px #ccc; border-left: solid 1px #ccc;">
                                                                                            ${{ $helpers->withoutRounding($your_price, 2) }}
                                                                                        </td>

                                                                                    </tr>


                                                                                    @php
                                                                                        $total = $cart->cart_amount - $cart->cart_item_discount;
                                                                                        $tax = json_decode($cart->cart_tax, true) ?? [];
                                                                                        $add_total_tax_amount = $cart->cart_amount - $cart->cart_item_discount + ((float) $cart->shipping_extra_amount + (float) $cart->handling_extra_amount);
                                                                                    @endphp
                                                                                    @foreach ($tax as $key => $value)
                                                                                        @php
                                                                                            $amount = $helpers->withoutRounding(($add_total_tax_amount * $value) / 100, 2);
                                                                                            $total += $amount;
                                                                                        @endphp

                                                                                        <tr>
                                                                                            <td
                                                                                                style="border: 0;  padding: 7px 10px; text-align: left; font-size: 14px; font-weight: 400; border-top: solid 1px #ccc; text-transform: uppercase">
                                                                                                {{ $key }}(
                                                                                                {{ $value }}% )
                                                                                            </td>
                                                                                            <td
                                                                                                style="border: 0; text-align: right; padding: 7px 10px; font-size: 14px; font-weight: 600; border-top: solid 1px #ccc; border-left: solid 1px #ccc;">
                                                                                                ${{ $helpers->withoutRounding($amount, 2) }}
                                                                                            </td>

                                                                                        </tr>

                                                                                    @endforeach


                                                                                    <tr>
                                                                                        <td
                                                                                            style="border: 0; padding: 10px 10px; text-align: left; font-size: 16px; font-weight: 600; border-top: solid 1px #ccc;">
                                                                                            Total Price</td>
                                                                                        <td
                                                                                            style="border: 0; text-align: right; padding: 10px 10px; font-size: 16px; font-weight: 600; border-top: solid 1px #ccc; border-left: solid 1px #ccc;">
                                                                                            @php
                                                                                                $total_your_price = $total + ($cart->shipping_extra_amount + $cart->handling_extra_amount);
                                                                                            @endphp
                                                                                            ${{ $helpers->withoutRounding($total_your_price, 2) }}
                                                                                        </td>

                                                                                    </tr>


                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>


                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>

                    </div>
                </td>
            </tr>
        </table>
    </center>
    {{-- <div class="{{ $cartItems->count() == 4 || $cartItems->count() == 11 ? 'page-break' : '' }}">
    </div> --}}
</body>
<script type="text/php">
    if ( isset($pdf) ) {
        // OLD
        // $font = Font_Metrics::get_font("helvetica", "bold");
        // $pdf->page_text(72, 18, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(255,0,0));
        // v.0.7.0 and greater
        $x = 72;
        $y = 18;
        $text = "{PAGE_NUM} of {PAGE_COUNT}";
        $font = $fontMetrics->get_font("helvetica", "bold");
        $size = 6;
        $color = array(255,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>

</html>
