<!DOCTYPE html>
<html>
<head>
    <title>Heyblinds</title>
</head>
<body>
    <p><b>Order ID :</b> #{{$order_id}}</p>
    <p><b>Body</b></p>
    <p>Shipping Address : {{$shippingAddress['street'] ?? ''}} {{$shippingAddress['area_code'] ?? ''}}<br/>
        {{$shippingAddress['city']?? ''}}, {{$shippingAddress['province']??''}}, {{$shippingAddress['postal_code']?? ''}}</p>
    <p>Billing Address : {{$billingAddress['street'] ?? ''}} {{$billingAddress['area_code']?? ''}} <br/>
        {{$billingAddress['city'] ?? ''}}, {{$billingAddress['province']??''}}, {{$billingAddress['postal_code']?? ''}}
    </p>
</body>
</html>