<!DOCTYPE html>
<html lang="en">
@php
use App\Models\Admin\Product\Product;
@endphp
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Orders Inventory Report</title>
</head>
<body>
    <table>
        <tr>
            <td><h4>HB Color # (AKA HB Location #)</h4></td>
            <td><h4>Active/Inactive</h4></td>
            <td><h4>HB Product Name</h4></td>
            <td><h4>HB Color Name</h4></td>
            <td><h4>Vendor Color Name</h4></td>
            <td><h4>Qty remaining</h4></td>
        </tr>
    @foreach ($colors as $key =>  $color )
        @foreach ($color->productColor as  $product)
        @php
            $quantity = ($color->quantity - $color->remaining_quantity) > 0 ? $color->quantity - $color->remaining_quantity : 0;
        @endphp
        <tr>
            <td>{{ $color->color_id }} </td>
            <td>{{ ($color->is_enable == 1 ) ? "Active" : "Inactive" }} </td>
            <td>{{ $product->product->name }} </td>
            <td>{{ $color->name  }} </td>
            <td>{{ $color->vendor_color_name }} </td>
            <td>{{ $quantity > 0 ? $quantity : 0 }} </td>
        </tr>
        @endforeach
    @endforeach
</body>
</html>
