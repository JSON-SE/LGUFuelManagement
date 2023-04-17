@extends('layouts.Frontend.app')

@section('content')
    <div class="container py-lg-4">
        <div class="row justify-content-center">

            <div class="col-md-8 mt-4 mb-4">
                @include('partial.message')
                <div class="card p-4 p-lg-5 rounded shadow border-0 text-center">
                    <h4 class="card-header bg-white pt-0 px-0 pb-3">{{ __('Successfully verified your email address.') }}
                    </h4>
                    <div class="card-body">
                        <div class="mt-4 mt-md-5">
                            @auth
                                <a class="btn btn-primary" href="{{ url('/user/my-account') }}">Go To Profile</a>
                            @else
                                <a class="btn btn-primary" href="{{ url('/login') }}">Go To account</a>
                            @endif
                            @if($cart_id)
                                <a class="btn btn-primary" href="{{ route('frontend.checkout',$cart_id) }}">View your cart</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
