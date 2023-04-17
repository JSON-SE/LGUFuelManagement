<h1>Patyment Status</h1>
<h2>Payment Details<h2>
<p>Order Id  : {{ $orderId }} </p>
<p>Order Amount : ${{ number_format($price,2)}}</p>
<p>Payment Status :{{ $status }}</p>
{{-- <p>Payment CardType :{{ $status }}</p> --}}
{{-- <p>Payment Message :{{ $status->Message }}</p> --}}
{{-- <p>Payment StatusMessage :{{ $status->StatusMessage }}</p> --}}
