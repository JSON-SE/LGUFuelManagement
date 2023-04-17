<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
    <div>
        <br>
        <h5>Order Id : {{ $order->order_id }} </h5>
        <h5>Shipping Address Information</h5>
        <p>{{ @$order->shippingAddress->first_name }} {{  @$order->shippingAddress->last_name }}</p>
        <p>{{  @$order->shippingAddress->street }}, {{ @$order->shippingAddress->area_code}}</p>
        <p>{{  @$order->shippingAddress->city }}, {{  @$order->shippingAddress->province }} </p>
        <p>{{  @$order->shippingAddress->postal_code }}</p>
        <p>{{  @$order->shippingAddress->email }}</p>
        <p>{{  @$order->shippingAddress->phone_number }}</p>
    </div>
    <br>
    <br>
    {{-- @foreach ($order->orderEntries as $entry)

    <h5> HB Product Name: {{ $entry->name }}</h5>
    <p>Color: {{ $entry->color }}</p>
    <p>Width: {{ $entry->width}}</p>
    <p>Height : {{ $entry->height}}</p>
    <p>Mount Type : {{ $entry->mount_type}}</p>
    <p>Room name : {{ $entry->room }}</p>
    <p>Easy Lift Systems : {{ $entry->lift }}</p>
    <p>Headrail Options : {{ $entry->headrail }}</p>
    <p>Valance :{{ $entry->valance }}</p>
    <p>Bottom Trim : {{ $entry->bottom_trim }}</p>
    <p>Qty : {{ $entry->quantity }}</p>
    <p>Warranty : {{ $entry->warranty }}</p>
    <p>Note : {{ $entry->note }}</p>
    <br>
    <br>

    @endforeach --}}

    <table>


        <tr>
            {{-- @foreach ($order->orderEntries as $item) --}}

                @foreach($item->item($item->option_value) as $key => $allItem)
                    @if($key !== "total_price" && $key !== "cart_id"  && $key !== "unit_price"  && $key !== "option_width_fraction" && $key !==
                    "option_height_fraction")
                            @if($key === "option_color")
                                <td><p class="mb-1 d-flex"><b class="w-50">Color</b></p></td>
                            @elseif($key === "option_width")
                                <td><p class="mb-1 d-flex"><b class="w-50">Width <small>(Inches)</small>:</b></p></td>
                            @elseif($key === "option_height")
                                <td><p class="mb-1 d-flex"><b class="w-50">Height <small>(Inches)</small>:</b></p></td>
                            @elseif($key === "option_room_name")
                                @if(!empty($item->room_name))
                                    <td><p class="mb-1 d-flex"><b class="w-50">Room Name </b> {{ $item->room_name }}</p><td>
                                @else
                                    <td><p class="mb-1 d-flex"><b class="w-50">{{ucwords(str_replace(['option_', '_'],["", " "], $key))}}</b> </p><td>
                                @endif

                            @else
                                <td><p class="mb-1 d-flex"><b class="w-50">{{ucwords(str_replace(['option_', '_'],["", " "], $key))}}</b></p></td>
                            @endif
                    @endif
                @endforeach
            {{-- @endforeach --}}

        </tr>


        @foreach ($order->orderEntries as $item)
        <tr>
        @foreach($item->item($item->option_value) as $key => $allItem)
            @if($key !== "total_price" && $key !== "cart_id"  && $key !== "unit_price"  && $key !== "option_width_fraction" && $key !==
            "option_height_fraction")
                    @if($key === "option_color")
                        <td><p class="mb-1 d-flex">{{ $item->colorName($allItem['option_color']) }}</p></td>
                    @elseif($key === "option_width")
                        <td><p class="mb-1 d-flex">{{!empty($allItem['option_width']) ? $allItem['option_width'] : ""}} <small>&nbsp;
                                {{!empty($allItem['option_width_fraction']) ? $allItem['option_width_fraction'] : "0/0"}}</small>
                        </p></td>
                    @elseif($key === "option_height")
                        </td><p class="mb-1 d-flex">{{!empty($allItem['option_height']) ? $allItem['option_height'] : ""}} <small>&nbsp;
                                {{!empty($allItem['option_height_fraction']) ? $allItem['option_height_fraction'] : "0/0"}}</small>
                        </p></td>
                    @elseif($key === "option_room_name")
                        @if(!empty($item->room_name))
                            <td><p class="mb-1 d-flex">{{ $item->room_name }}</p></td>
                        @else
                            <td><p class="mb-1 d-flex"><b class="w-50">{{ucwords(str_replace(['option_', '_'],["", " "], $key))}}:
                                </b> {{ $item->optionName($allItem[$key]) }}</p></td>
                        @endif

                    @else
                        <td><p class="mb-1 d-flex">{{ $allItem[$key] }}</p></td>
                    @endif
            @endif
        @endforeach
        </tr>
        @endforeach
{{--
        @foreach($item->item($item->option_value) as $key => $allItem)
            @if($key !== "total_price" && $key !== "cart_id"  && $key !== "unit_price"  && $key !== "option_width_fraction" && $key !==
            "option_height_fraction")
                <div class="col-sm-6">
                    @if($key === "option_color")
                        <p class="mb-1 d-flex"><b class="w-50">Color:</b>
                            {{ $item->colorName($allItem['option_color']) }}</p>
                    @elseif($key === "option_width")
                        <p class="mb-1 d-flex"><b class="w-50">Width <small>(Inches)</small>:</b>
                            {{!empty($allItem['option_width']) ? $allItem['option_width'] : ""}} <small>&nbsp;
                                {{!empty($allItem['option_width_fraction']) ? $allItem['option_width_fraction'] : "0/0"}}</small>
                        </p>
                    @elseif($key === "option_height")
                        <p class="mb-1 d-flex"><b class="w-50">Height <small>(Inches)</small>:</b>
                            {{!empty($allItem['option_height']) ? $allItem['option_height'] : ""}} <small>&nbsp;
                                {{!empty($allItem['option_height_fraction']) ? $allItem['option_height_fraction'] : "0/0"}}</small>
                        </p>
                    @elseif($key === "option_room_name")
                        @if(!empty($item->room_name))
                            <p class="mb-1 d-flex"><b class="w-50">Room Name: </b> {{ $item->room_name }}</p>
                        @else
                            <p class="mb-1 d-flex"><b class="w-50">{{ucwords(str_replace(['option_', '_'],["", " "], $key))}}:
                                </b> {{ $item->optionName($allItem[$key]) }}</p>
                        @endif

                    @else
                        <p class="mb-1 d-flex"><b
                                class="w-50">{{ucwords(str_replace(['option_', '_'],["", " "], $key))}}:</b>
                            {{ $allItem[$key] }}</p>
                    @endif
                </div>
            @endif
        @endforeach --}}


        {{-- <tr>
            <td>HB Product Name</td>
            <td>Color</td>
            <td>Width</td>
            <td>Height</td>
            <td>Mount Type</td>
            <td>Room name</td>
            <td>Easy Lift Systems</td>
            <td>Headrail Options</td>
            <td>Valance</td>
            <td>Bottom Trim</td>
            <td>Qty</td>
            <td>Warranty</td>
            <td>Note</td>
        </tr>
        @foreach ($order->orderEntries as $entry)
        <tr>
            <td>{{ $entry->name }}</td>
            <td>{{ $entry->color }}</td>
            <td>{{ $entry->width}}</td>
            <td>{{ $entry->height}}</td>
            <td>{{ $entry->mount_type}}</td>
            <td>{{ $entry->room }}</td>
            <td>{{ $entry->lift }}</td>
            <td>{{ $entry->headrail }}</td>
            <td>{{ $entry->valance }}</td>
            <td>{{ $entry->bottom_trim }}</td>
            <td>{{ $entry->quantity }}</td>
            <td>{{ $entry->warranty }}</td>
            <td>{{ $entry->note }}</td>
        </tr>
        @endforeach --}}

    </table>

</body>

</html>
