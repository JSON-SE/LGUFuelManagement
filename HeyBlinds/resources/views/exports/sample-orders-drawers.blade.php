<!DOCTYPE html>
<html lang="en">
@php
use App\Models\Admin\Product\Product;
@endphp

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report with samples and drawers</title>
</head>

<body>

    <table>
        <tr>
            <td><h4>Vendor</h4></td>
            <td><h4>HB Product Name</h4></td>
            <td><h4>HB Color Name</h4></td>
            <td><h4>ColorID</h4></td>
            <td><h4>Samples Drawer #</h4></td>
            <td><h4>Qty remaining</h4></td>
        </tr>

        @forelse ($orders as $key =>  $order  )
        <tr>
            <td>{{ $order->color->vendor_color_name	 }} </td>
            <td>{{ $order->product_name  }} </td>
            <td>{{ $order->color->name  }} </td>
            <td>{{ $order->color->color_id}} </td>
            <td>{{ $order->quantity }} </td>
            <td>{{ @$order->color->quantity  }} </td>
        </tr>
        @empty
            <tr><td colspan="6">Samples Drawer#s are Empty</td></tr>
        @endforelse

</body>

</html>
