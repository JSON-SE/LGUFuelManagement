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
        <li class="breadcrumb-item active" aria-current="page">Order Items List</li>
    </ol>
</nav>
</section>


<section id="body-content">
    <div class="container py-3 pb-4 pb-xxl-5">
        <div class="row">
            <div class="col-lg-4">
                @include('user.sidebar')
            </div>

            <div class="col-lg-8 pt-4">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h5 class="font-secondary fw-bold">My Order</h5>
                        <hr class="mt-2" />
                        {{-- <p>Select an order to view details.</p> --}}

                        <div class="pt-2">
                            @if($orders->count() > 0 )
                            @foreach($orders as $key => $order)
                            <div class="p-3 shadow-sm mb-3">
                                <div class="row align-content-center">
                                    <div class="col-12">
                                        <div class="row align-content-center">
                                                    <div class="fw-bold col-xl-3 col-md-6 mb-xl-0 mb-3">
                                                        #{{ $key+1 }}: <a class="fw-normal"> {{$order->order_id ?? ' '}}</a>
                                                    </div>

                                                    <div class="fw-bold col-xl-3 col-md-6 mb-xl-0 mb-3">Ordered: 
                                                        <a class="fw-normal" > {{$order->created_at->diffForhumans()}}</a>
                                                    </div>

                                                    <div class="fw-bold col-xl-2 col-md-6 mb-xl-0 mb-3">Qty: 
                                                        <a class="fw-normal"> {{$order->cart->items->count()}}</a>
                                                    </div>
                                                   
                                                    <div class="fw-bold col-xl-2 col-md-6 mb-xl-0 mb-3"> 
                                                        @if($order->order_status == 10)
                                                            <a class="fw-normal">Transaction failed.</a>
                                                        @endif
                                                    </div>
                                                
                                                    <div class="fw-bold col-xl-2 col-md-6 mt-2 mt-xl-0 text-xl-end"> 
                                                        <a class="fw-normal btn btn-sm btn-primary" href="{{ url('user/cart/'.$order->cart->external_id.'/details') }}"> View Order</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <h4 class="fw-light mb-0 text-center" >No Orders Found!</h4>
                                        {{-- <div class="text-center py-4">
                                            <a class="btn btn-primary mt-3" href="{{ route('welcome') }}">Continue Shopping</a>
                                        </div> --}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @endsection

