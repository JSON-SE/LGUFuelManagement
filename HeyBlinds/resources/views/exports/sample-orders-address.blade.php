<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Orders Address Labels</title>
</head>

<body>

    <table>
        <tr>
            <td><h4>Sample Order Id</h4></td>
            <td><h4>Shipping Address</h4></td>
            
        </tr>

    @foreach ($orders as $key =>  $order )
        <tr>
            <td>{{ $order->sample_order_id }} </td>
            <td>
                <p>{{ $order->shippingAddress->first_name ?? '' }} {{ $order->shippingAddress->last_name ?? '' }}</p>
                <p> {{ $order->shippingAddress->street ?? '' }}@if(!empty($order->shippingAddress->area_code)), {{$order->shippingAddress->area_code ?? ''}}@endif</p>
                <p>{{ $order->shippingAddress->city ?? ''}}, {{ $order->shippingAddress->province ?? '' }} </p>
                <p> {{ $order->shippingAddress->postal_code ?? ''}}</p>
            </td>
        </tr>
    @endforeach
</body>

</html>
