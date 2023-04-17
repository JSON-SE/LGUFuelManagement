<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Abandoned Savercart</title>
</head>
<body>
    <p><b>Cart ID:</b> {{ $cart_id ?? ''}}</p>
    <p><b>First Name:</b> {{ $first_name ?? ''}}</p>
    <p><b>Last Name: </b>{{$last_name ?? ''}}</p>
    <p><b>Email:</b> {{$email ?? ''}}</p>
    <p><b>Cart Amount:</b> ${{number_format($cart_amount,2) ?? ''}}</p><br/>

    
</body>
</html>