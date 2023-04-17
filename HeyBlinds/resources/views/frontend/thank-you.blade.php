@extends('layouts.Frontend.app')
@section('title')
    Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada 
@endsection
@section('content')
    <section id="body-content">
        <div class="container py-sm-5 py-4 pb-xxl-5">
            <div class="row gx-5">
                <div class="col-lg-8">
                    <div class="text-center p-4 pt-5 bg-secondary rounded ">
                        <h1 class="font-brittan text-white">Thank You!</h1>
                        <h4 class="font-secondary heading-two text-white pt-2">Your order is confirmed!</h4>
                        <p class="text-white">A confirmation email has been sent to your provided email address.</p>
                        <a href="{{route('welcome')}}" class="btn btn-primary mt-2">Continue Shopping</a>
                    </div>
                </div>
                <div class="col-lg-4 mt-3 mt-lg-0">
                    <div class="shadow rounded text-center p-3 text-cente">
                        <img src="{{asset('images/24-hours-outline.png')}}" alt="" />
                        <h4 class="pt-3">Have <span class="text-primary">questions?</span></h4>
                        <h5 class="fw-bold"><a href="tel:(888) 412-3439">(888) 412-3439</a></h5>
                        <p class="small">Monday - Friday 8AM - 10PM EST</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('js')
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('event', 'conversion', {'send_to': '703193369/hwNQCJKhwbECEJnCp88C',
         'value': 1.0,
         'currency': 'USD'
     });
    dataLayer.push({
          'event': 'transactionComplete',
          'transactionId': '{{$sampleOrder->sample_orders}}',         
          'transactionAffiliation': 'HeyBlinds',    
          'transactionTotal':  0.00,             
          'transactionTax': 0.00,                
          'transactionShipping': 0.00,            
          'transactionProducts': {!!$dataTag!!}
  });
</script>
@endpush
@endsection
