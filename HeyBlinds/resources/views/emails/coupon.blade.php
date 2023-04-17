<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Heyblinds</title>
</head>
<body>
    <br/>
    Cart # :{{$cart_id}} <br/>
    Coupon Code : {{$coupon_code}} <br/>
    Cart Amount : ${{number_format($cart_amount,2)}} <br/>
    Message : {!!html_entity_decode($text)!!}<br/>

</body>
</html>