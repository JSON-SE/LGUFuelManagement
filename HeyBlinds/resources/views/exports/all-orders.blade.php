<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Order Details</title>
</head>

<body>

    <table>
        <tr>
            <td><h5>#</h5></td>
            <td><h5>Shipping Address</h5></td>
            <td><h5>HB Product Name</h5></td>

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

        </tr>


        @foreach ($orders as $key =>  $order )
        <tr>
            <td>{{ $order->order_id }} </td>
            <td>
                <p>{{ @$order->shippingAddress->first_name }} {{ @$order->shippingAddress->last_name }}</p>
                <p>{{ @$order->shippingAddress->street }}, {{ @$order->shippingAddress->area_code }}</p>
                <p>{{ @$order->shippingAddress->city }}, {{ @$order->shippingAddress->province }}</p>
                <p>{{ @$order->shippingAddress->postal_code }}</p>
                <p>{{ @$order->shippingAddress->email }}</p>
                <p>{{ @$order->shippingAddress->phone_number }}</p>
            </td>
        @foreach ($order->orderEntries as $item)
        <td>{{ $item->product->name }}</td>
        @foreach($item->item($item->option_value) as $key => $allItem)

                @if($key !== "total_price" && $key !== "cart_id"  && $key !== "unit_price"  && $key !== "option_width_fraction" && $key !=="option_height_fraction")
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
        </tr><tr><td></td><td></td>
        @endforeach
        </tr>
        @endforeach
    </table>

</body>

</html>
