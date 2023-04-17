@section('content')
    <section id="body-content" class="full-screen">
        <div class="container py-5 text-center error-section">

            <div class="error-box shadow p-2">
                <img src="{{ asset('images/cart404.png') }}" alt="" />
            </div>


            <h5 class="heading-two pt-3">
                Hey, your cart is empty
            </h5>
            <a class="btn-primary btn custom py-md-2" href="{{ url('/#body-content') }}">Continue Your Shopping</a>

            @guest
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-4 col-md-6">
                        <div class="bg-light p-4 rounded mx-auto">
                            <h5 class="">Want to get back to a cart that you previously saved?</h5>
                            <a class="btn-primary btn custom py-md-2 mt-4" href="{{ url('/login') }}">SIGN IN TO MY ACCOUNT</a>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </section>
@endsection
