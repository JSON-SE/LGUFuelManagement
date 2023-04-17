@extends('layouts.Frontend.app')
@section('title')
    Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada 
@endsection
@section('content')

    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
             aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Measurement Guide</li>
            </ol>
        </nav>
    </section>
    <section id="body-content">
        <div class="container py-4 pb-4">
{{--            <p class="heading-two pt-2 mb-0">Measurement Guide</p>--}}
            <iframe src="{{asset('images/pdf/HeyBlinds-Handy-Measuring-Guide.pdf')}}" style="width: 100%; height: 1500px"> </iframe>
        </div>
    </section>


@endsection
