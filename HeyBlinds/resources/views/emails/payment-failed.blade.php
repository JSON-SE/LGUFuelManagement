<!DOCTYPE html>
<html>
<head>
	<title>Heyblinds</title>
</head>
<body>
	<h2><u>User info</u></h2>
		User Name : {{$user_name}}<br/>
		email: {{$email}} <br/>
		Phone Number: {{$phone_number}}<br/>
		Cart : #{{$cart_id}}<br/>
		Cart Amount : ${{number_format($cart_amount,2)}}<br/>
		Cart URL : <a href="{{$cart_full_path}}" target="_blank">{{$cart_full_path}}</a><br/>
		<h2>Payment Failed reason</h2>
		Message : {{$response}}
</body>
</html>
