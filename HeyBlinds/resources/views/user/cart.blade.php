@extends('layouts.Frontend.app')
@section('content')
    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
             aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}">
                        Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Saved Cart</li>
            </ol>
        </nav>
    </section>
    <div class="container py-3 pb-4 pb-xxl-5">
        <div class="row">
            <div class="col-lg-4">
                @include('user.sidebar')
            </div>

            <div class="col-lg-8 pt-4">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h5 class="font-secondary fw-bold">My Cart</h5>
                        <hr class="mt-2" />
                        @if ($carts->count() > 0)
                        {{-- <p>Cart details.</p> --}}
                        <div class="pt-2">
                                @foreach ($carts as $key => $cart)
                                    @if($cart->itemsCount() > 0)
                                    <div class="p-3 shadow-sm mb-3 save-cart-list">
                                        <div class="row align-items-center">
                                            <div class="col-10 col-sm-11">
                                                <div class="row">
                                                    <div class="fw-bold col-xl-3 col-md-6 mb-xl-0 mb-3">
                                                        #{{ $cart->cart_id }}
                                                    </div>
                                                    <div class="fw-bold col-xl-3 col-md-6 mb-xl-0 mb-3">
                                                        Date Created: <a class="fw-normal" href="#">
                                                            {{ $cart->updated_at->diffForHumans() }}</a>
                                                    </div>
                                                    <div class="fw-bold col-xl-3 col-md-6 mb-xl-0 mb-3">
                                                        Items: {{ $cart->items->sum('quantity')}}
                                                    </div>
                                                    <div class="fw-bold col-xl-3 col-md-6 mb-xl-0 mb-3"> 
                                                        <a class="fw-normal btn btn-sm admin-edit-cart {{!empty($getCookieReadCartId) && $getCookieReadCartId === $cart->external_id ? "btn-secondary" : "btn-primary"}}" data-cart="{{$cart->external_id}}"
                                                            href="{{route('frontend.cart', $cart->external_id)}}"> Edit Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 col-sm-1 text-end">
                                                <button type="button" class="btn-close cart-remove-button" data-id="{{$cart->external_id}}"></button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @endforeach

                            </div>
                            @else
                                <div class="text-center py-5">
                                    <h4 class="fw-light mb-0">No saved cart found!</h4>
                                    <a class="btn btn-primary mt-3" href="{{ route('welcome') }}">Continue Shopping</a>
                                </div>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@push('js') 
    <script>
        jQuery(function ($) {
            $(document).on('click', '.admin-edit-cart', function(){
                let $this = $(this);
                createCookie('__cart_items', $this.attr('data-cart'))
            })

            $(document).on('click', '.cart-remove-button', function (e) {
                e.preventDefault();
                let $this = $(this);
                const data = {
                    'cartId' : $this.attr('data-id'),
                    '_token' : "{{csrf_token()}}"
                }
                axios.post('{{route('frontend.save.cart.destroy')}}', data)
                    .then(function (response) {
                        let data = response.data;
                        if (data == 1){
                            toastr.success('Removed!');
                            $this.parents('.save-cart-list').remove();
                            location.reload();
                        }else{
                            toastr.error("Something went wrong. Please try again later!");
                        }
                    })
                    .catch(function (errors) {
                        let error = errors.response.data.errors.reason;
                        toastr.error(error);
                    });
            })
        })

    </script>
@endpush
@endsection
