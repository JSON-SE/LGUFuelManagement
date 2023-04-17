<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Order Details</title>
</head>

<body>
    <div>
        <br>
        <h5>Order ID : {{ $order->sample_order_id }}</h5>
        <h5>Shipping Code : {{ ( $order->shipping_type == 0 ) ? "Courier" : "Regular Mail" }}</h5>
        <h5>Shipping Address Information</h5>
        <p>{{ $address->first_name }} {{ $address->last_name }}</p>
        <p>{{ $address->street }}, {{ $address->area_code }} </p>
        <p>{{ $address->city }}, {{ $address->province }}</p>
        <p>{{ $address->postal_code }}</p>
        <p>{{ $address->email }}</p>
        <p>{{ $address->phone_number }}</p>
    </div>
    <br>
    <table>
        <tr>
            <td><h5>HB Product Name</h5></td>
            <td><h5>HB Color #</h5></td>
            <td><h5>HB Color Name</h5></td>
            <td><h5>Vendor Color Name</h5></td>
            <td><h5>HB Location #</h5></td>
            {{-- <td><h5>Note</h5></td> --}}
        </tr>

        @foreach ($order->orderEntries as $entry)
        <tr>
            <td>{{ $entry->product->name }}</td>
            <td>{{ $entry->color->color_id }}</td>
            <td>{{ $entry->color->name}}</td>
            <td>{{ $entry->color->vendor_color_name}}</td>
            <td>{{ $entry->color->id}}</td>
            {{-- <td>{{ $entry->note }}</td> --}}
        </tr>
        @endforeach

    </table>

</body>

</html>
