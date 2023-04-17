@extends('layouts.Frontend.app')
@section('title')
Heyblind - order-tracking
@endsection
@section('content')

<section>
    <div class="container pt-3 pb-5">
        <div class="cart-box px-4 py-4 rounded mt-4" id="">
            <div class="row align-items-center pt-2 justify-content-center">
                <div class="col-lg-3">
                    <img src="{{asset('images/relax.png')}}" alt=""/>
                </div>
                <div class="col-lg-8">
                    <form class="row gx-2" action="" method="post" id="trackOrder">
                        <div class="col-12">
                            <h5 class="font-secondary fw-bold mb-1">Track Your Order</h5>
                            <p>Enter order information to track</p>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" name="order_number" class="form-control bg-transparent" placeholder="Order Number" required >
                                <label for="floatingInput">Order Number *</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="email" class="form-control bg-transparent" name="email" placeholder="Email" autocomplete="off" required>
                                <label for="floatingPassword">Email *</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button type="submit" class="btn h-100 w-100 btn-primary" >Track</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="shadow px-4 py-4 rounded mt-4"  id="orderResponse">
          
         </div>
     </div>
 </div>
</div>
</div>
</section>
@push('js')
<script>
    $(document).on('submit', '#trackOrder', function(e) {
        e.preventDefault();
        let $this = $(this);
        let formData = $this.serialize();

        $("#loader").show();
        axios.post('/order-tracking', formData)
        .then(function(response) {
            console.log(response.data);
            if (response.data.status == true) {
                $("#loader").hide();
                $('#orderResponse').html(`<div class="">
                <h2 class="fw-light">Tracking</h2>
                <div class="d-inline-block fw-semibold border bg-ex-light px-4 py-2 rounded">
                    Order ID #${response.data.order_id}
                </div>

                <hr/>

                <div class="row">
                    <div class="col-4">
                        <div>
                         <p class="mb-2">Shipped Via </p>
                         <h6>UPS</h6>
                     </div>
                 </div>

                 <div class="col-4 border-start ps-md-5">
                    <div>
                     <p class="mb-2">
                     Status </p>
                     <h6>${response.data.order_status}</h6>
                 </div>
             </div>

             <div class="col-4 border-start ps-md-5">
                <div>
                 <p class="mb-2">
                 Expected </p>
                 <h6>${response.data.expected_date}</h6>
             </div>`);
            } else {
                toastr.error(response.data.message);
                $('#orderResponse').html('');
            }
        })
        .catch(function(error) {
            $("#loader").hide();
            let errors = error.response.data.errors;
            $.each(errors, function(key, value) {
                toastr.error(value)
            })
        });
    })

</script>


@endpush
@endsection