@section('content')
    <section id="body-content" class="full-screen">
        <div class="container pt-2 pb-4 pb-xxl-5 text-center error-section">

            <div class="error-box">
                <img src="{{asset('images/404-image.jpg')}}" alt=""/>
                <div class='eye'></div>
            </div>
            <h1 class="font-brittan text-primary">Empty!</h1>

            <h5 class="heading-two">
                Oops! We Can Not Found Any Items On Your Cart.
            </h5>
            <a class="btn btn-primary mt-3" href="{{url('/')}}"> Add Items </a>
        </div>
    </section>
@endsection
