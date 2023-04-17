@extends('layouts.Frontend.app')
@section('title')
    Free Shipping Policy | HeyBlinds Canada
@endsection
@section('content')
<section class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb mb-2 pt-2">
            <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Free Shipping</li>
        </ol>
    </nav>
    <div class="inner-banner rounded">
        <img class="rounded" src="{{asset('images/shipping-banner.jpg')}}" alt="" />
        <div class="inner-banner-text">
            Free Shipping
        </div>
    </div>

</section>



<section id="body-content">
    <div class="container py-4 pb-4 pb-xxl-5">
        <p class="heading-two pt-2 mb-0">Shipping Information</p>

        <div class="row pb-2 justify-content-center">
            <div class="col-lg-4 col-md-6 services-section mt-3">
                <div class="services-box h-100 rounded shadow p-3 bg-white">
                    <div class="services-icon d-flex align-items-center justify-content-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"></path>
                        </svg>
                    </div>
                    <h4 class="pt-3">
                        Free shipping.
                    </h4>
                    <p class="mb-0 w-100">
                        HeyBlinds offers free ground shipping, within Canada. Orders with horizontal blinds or shades that are 94” wide or more, 
                        or with vertical blinds that are 94” long or more, are shipped for a flat, non-refundable $85 oversize freight fee. You can 
                        expect to receive your blinds approximately 2-3 weeks after ordering. Oversized blinds and shipments to rural areas may take longer.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 services-section mt-3">
                <div class="services-box h-100 rounded shadow p-3 bg-white">
                    <div class="services-icon d-flex align-items-center justify-content-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
                            <path d="M9.669.864L8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193l.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
                            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                          </svg>
                    </div>
                    <h4 class="pt-3">
                        No surprise fees or charges.
                    </h4>
                    <p class="mb-0 w-100">
                        If your order cannot ship by land for any reason, you will receive a quote before shipping. 
                        HeyBlinds will also never add import or duty fees to your order total.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 services-section mt-3">
                <div class="services-box h-100 rounded shadow p-3 bg-white">
                    <div class="services-icon d-flex align-items-center justify-content-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2" viewBox="0 0 16 16">
                            <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
                          </svg>
                    </div>
                    <h4 class="pt-3">
                        Exactly what you ordered.
                    </h4>
                    <p class="mb-0 w-100">
                        Once your blind arrives, be sure you are receiving exactly what you ordered without damage.
                        If anything is incorrect, missing, or damaged, contact us within seven days to have your
                        order replaced.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 services-section mt-3">
                <div class="services-box h-100 rounded shadow p-3 bg-white">
                    <div class="services-icon d-flex align-items-center justify-content-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-palette2" viewBox="0 0 16 16">
                            <path d="M0 .5A.5.5 0 0 1 .5 0h5a.5.5 0 0 1 .5.5v5.277l4.147-4.131a.5.5 0 0 1 .707 0l3.535 3.536a.5.5 0 0 1 0 .708L10.261 10H15.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5H3a2.99 2.99 0 0 1-2.121-.879A2.99 2.99 0 0 1 0 13.044m6-.21l7.328-7.3-2.829-2.828L6 7.188v5.647zM4.5 13a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0zM15 15v-4H9.258l-4.015 4H15zM0 .5v12.495z"/>
                            <path d="M0 12.995V13a3.07 3.07 0 0 0 0-.005z"/>
                          </svg>
                    </div>
                    <h4 class="pt-3">
                        Unlimited Samples

                    </h4>
                    <p class="mb-0 w-100">
                        Order as many free samples as you need and receive them within 2-7 days via Canada Post.
                        Need them faster? HeyBlinds will send your samples overnight via UPS for an additional $20.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 services-section mt-3">
                <div class="services-box h-100 rounded shadow p-3 bg-white">
                    <div class="services-icon d-flex align-items-center justify-content-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                            <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                          </svg>
                    </div>
                    <h4 class="pt-3">
                        Delivery Times & Covid
                    </h4>
                    <p class="mb-0 w-100">
                        Delivery times may vary due to Covid health and safety guidelines, including proper social
                        distancing between employees. Most orders are shipping on time, but certain orders may
                        experience a delay.
                    </p>
                </div>
            </div>

        </div>

       <hr class="mt-4"/>

        <div class="row pb-2 text-center about-services-section justify-content-center">
            <div class=" col-lg-4 col-sm-6 services-section mt-3">
                <div class="services-box h-100 rounded shadow-none p-0 bg-white">

                    <h6 class=" w-100 fst-italic mb-0 mb-sm-2">“My blinds arrived exactly as I ordered them and faster than the estimated delivery time.”</h6>
                    <p class="fw-bold w-100 mb-0 pt-sm-2">– Nick G. from Hamilton, ON</p>
                </div>
            </div>

            <div class=" col-lg-4 col-sm-6 services-section mt-3">
                <div class="services-box h-100 rounded shadow-none p-0 bg-white">

                    <h6 class=" w-100 fst-italic mb-0 mb-sm-2">“I was disappointed when one of my blinds arrived slightly damaged. HeyBlinds customer service was amazing. They sent me a replacement right away.”</h6>
                    <p class="fw-bold w-100 mb-0 pt-sm-2"> – Alicia K. from Halifax, NS</p>
                </div>
            </div>


        </div>

    </div>
</section>

@endsection
