<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actions Report</title>
</head>

<body>

    <table>
        <tr>
            <td><h4>Email</h4></td>
            <td><h4>First Name</h4></td>
            <td><h4>Last Name</h4></td>
            <td><h4>tel. #</h4></td>
            <td><h4>$customer_action</h4></td>
            <td><h4>Action Date</h4></td>
            <td><h4>Cart Link</h4></td>
            <td><h4>Cart #</h4></td>
            <td><h4>Cart Subtotal</h4></td>
            <td><h4>Province</h4></td>
            <td><h4>Postal Code</h4></td>
        </tr>
        @foreach ($abandonedCustomers as $key =>  $user)
            <tr>
                <td>{{ $user->shipping_email ?? '' }}</td>
                <td>{{ $user->shipping_first_name ?? '' }}</td>
                <td>{{ $user->shipping_last_name ?? '' }}</td>
                <td>{{ $user->shipping_phone_number ?? '' }}</td>
                <td>
                    @if($user->cart_type== 1)
                    Saved Cart
                    @else
                    Saved Cart and Sample Ordered
                    @endif
               </td>
                <td>{{$user->updated_at->format('Y-m-d H:m:s')}}</td>
                <td>{{$user->makeroute($user)}}</td>
                <td>{{$user->cart->cart_id ?? ''}}</td>
                <td>{{number_format($user->cart->cart_amount ?? '0.00', 2)}}</td>
                <td>{{ $user->shipping_province ?? ''}}</td>
                <td>{{ $user->shipping_postal_code ?? ''}}</td>
                
            </tr>
        @endforeach

    @foreach ($orders as $key =>  $order)
        <tr>
            <td> {{ $order->shippingAddress->email ?? '' }} </td>
            <td> {{ $order->shippingAddress->first_name ?? '' }} </td>
            <td> {{ $order->shippingAddress->last_name ?? '' }} </td>
            <td> {{ $order->shippingAddress->phone_number ?? '' }}</td>
            <td>
            @if($key == 0)
            <b>Ordered</b>
            @else
            Ordered
            @endif
            </td>
            <td>{{$order->updated_at->format('Y-m-d H:m:s')}}</td>
            <td>{{$order->makeroute($order)}}</td>
            <td>{{$order->cart->cart_id ?? ''}}</td>
            <td>{{$helpers->grand_total_amount($order->cart_id ?? '')}}</td>
            <td>{{ $order->shippingAddress->province ?? '' }} </td>
            <td>{{ $order->shippingAddress->postal_code ?? ''}}</td>
        </tr>
    @endforeach

    @foreach ($sample_orders as $key =>  $sample)
        <tr>
            <td> {{ $sample->shippingAddress->email ?? '' }} </td>
            <td> {{ $sample->shippingAddress->first_name ?? '' }} </td>
            <td> {{ $sample->shippingAddress->last_name ?? '' }} </td>
            <td> {{ $sample->shippingAddress->phone_number ?? '' }}</td>
            <td>
           {{--  @if($key == 0)
                <b>Sample Ordered</b>
            @else --}}
                @if($sample->order_cart_status == 1)
                @if($key == 0)
                   <b>Saved Cart and Sample Ordered</b>
                    @else
                   Saved Cart and Sample Ordered
                    @endif
                    
                @else
                    @if($key == 0)
                   <b>Sample Ordered</b>
                    @else
                    Sample Ordered
                    @endif
                @endif
            {{-- @endif --}}
            </td>
            <td>{{$sample->updated_at->format('Y-m-d H:m:s')}}</td>
            <td></td>
            <td>{{$sample->sample_order_id}}</td>
            <td>{{'0.00'}}</td>
            <td>{{$sample->shippingAddress->province ?? '' }} </td>
            <td> {{$sample->shippingAddress->postal_code ?? ''}}</td>
        </tr>
    @endforeach
</body>

</html>
