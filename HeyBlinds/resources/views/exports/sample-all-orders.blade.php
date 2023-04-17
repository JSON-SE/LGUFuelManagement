<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample All Orders Details</title>
</head>

<body>

    <table>
        <tr>
            <td><h4>Sample Order Id</h4></td>
             <td><h4>Shipping Address</h4></td>
            <td><h4>First Name</h4></td>
            <td><h4>Last Name</h4></td>
             <td><h4>Email Address</h4></td>
            <td><h4>Shipping Method</h4></td>
            <td><h4>HB Product Name</h4></td>
            <td><h4>HB Color Name</h4></td>
            <td><h4>Location #</h4></td>
            {{-- <td><h4>Vendor Color Name</h4></td>
            <td><h4>HB Location #</h4></td>
            <td><h4>Note</h4></td> --}}
        </tr>

    @foreach ($orders as $key =>  $order)
 
        <tr>
            <td>{{ $order->sample_order_id }} </td>
            <td>
                <p>{{ $order->shippingAddress->first_name ?? "" }} {{ $order->shippingAddress->last_name ?? "" }}</p>
                <p>{{ $order->shippingAddress->street ?? "" }}@if(!empty($order->shippingAddress->area_code)), {{$order->shippingAddress->area_code}}@endif
                  </p>
                <p>{{ $order->shippingAddress->city . ", " ?? "" }} {{ $order->shippingAddress->province . " " ?? "" }}</p>
                <p>{{ $order->shippingAddress->postal_code ?? "" }}</p>
            </td>
            <td><p>{{ $order->shippingAddress->first_name ?? "" }}</p></td>
            <td><p>{{ $order->shippingAddress->last_name ?? "" }}</p></td>
            <td><p>{{ $order->shippingAddress->email ?? "" }}</p></td>
            <td><p>{{ ( $order->shipping_type == 0 ) ? "Regular Mail" : "Courier" }}</p></td>
            @foreach ($order->orderEntries as $entry)
                <td><h5>{{ $entry->product->name ?? "" }}</h5></td>
                <td><p>{{ $entry->color->name ?? ""}}</p></td>
                <td><p>{{ $entry->color->color_id ?? "" }}</p></td>
                {{-- <td><p>{{ $entry->color_name}}</p></td>
                <td><p>{{ $entry->color_name}}</p></td>
                <td><p>{{ $entry->note }}</p></td> --}}
                </tr><tr><td><td></td><td></td><td></td><td></td><td></td>
                    {{-- <td></td> --}}

            @endforeach
        </tr>
    @endforeach

</body>

</html>
