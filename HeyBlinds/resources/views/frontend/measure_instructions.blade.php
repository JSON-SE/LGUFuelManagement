@extends('layouts.Frontend.app')
@section('title')
    How To Measure Windows for Blinds & Shades | HeyBlinds Canada
@endsection
@section('content')

<section class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb mb-2 pt-2">
            <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Measuring Guide</li>
        </ol>
    </nav>
    <div class="inner-banner rounded">
        <img class="rounded" src="{{asset('images/about-banner.jpg')}}" alt="" />
        <div class="inner-banner-text">
            Measuring Guide
        </div>
    </div>

</section>



<section id="body-content">
    <div class="container py-4 pb-4 pb-xxl-5">

        <div class="row pb-2 justify-content-between  about-services-section">

            <div class="col-lg-7 mt-3">
                <h1 class="heading-two pt-2">Hey! Measuring Your Windows is Easy</h1>
                <h5 class="border-start border-4 pe-md-5 border-primary ps-3">Use this quick measuring guide for perfect fitting blinds.</h5>
            </div>

            <div class="col-lg-6 col-lg-5 mt-3">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/0TeqoxQWf4g?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class="col-lg-3 mt-3">
                <div class="services-box cart-box rounded shadow-none h-100 p-3">
                    <h4>What you’ll need:</h4>
                    <ul class="list-items">
                        <li>Tape measure - make sure it’s steel</li>
                        <li>Pencil</li>
                        <li>Paper</li>
                        <li>Step-Ladder</li>

                    </ul>
                </div>
            </div>

            <div class="col-lg-3 mt-3">
                <div class="services-box cart-box rounded shadow-none h-100 p-4 text-center align-items-center d-flex">
                    <div>
                    <h5>Download your handy measuring guide</h5>
                    <a href="{{asset('HeyBlinds-Handy-Measuring-Guide.pdf')}}" class="btn btn-primary mt-3" download>Download PDF</a>
                </div>
                </div>
            </div>

        </div>


        <h5 class="border-start border-4 mt-4 pe-md-5 border-primary ps-3">Before you begin:</h5>

        <p class="mt-3 mb-2">
            Decide how you want your blinds to hang. Will they be mounted inside or outside of the window frame? 
        </p>
        <p class="mb-2">
            Most customers prefer to mount their blinds inside the window frame. It gives a neater, more tailored look, 
            without covering any details of the window or the surrounding decorative moulding.
        </p>

        <p class="mb-2">
            For an inside mount, be sure the depth of your window is at least 1 1/8” deep so you have the correct amount 
            of space to mount the blind. For a blind to sit completely flush within your window frame, make sure you have 
            the minimum flush mount depth required, which you can find in the Product Information tab for each product, 
            usually at least 2”.  If your window isn’t deep enough, you can still mount your blinds inside, or you can 
            choose to mount them outside your window frame.
        </p>
        <p class="mb-2">
            Remember, window openings are rarely perfectly straight, that’s why its always important to measure in three 
            places for the width and height.
        </p>

        <div class="row align-items-center mt-5">

            <div class="col-md-4">
                <div class=" px-4">
                    <img src="{{asset('images/inside-mount.jpg')}}" alt="" />
                </div>
            </div>

            <div class="col-md-8 ps-md-5">
                <p class="heading-two pt-2">Measuring for an Inside Mount</p>
                <h5 class="border-start border-4 pe-md-5 border-primary ps-3 pe-xl-5">The blind fits neatly within the window frame allowing the window to be the focal point.</h5>
                <ul class="list-items mt-4">
                    <li>Measure the inside width of the window in three places: the top, middle, and bottom</li>
                    <li>Highlight the smallest width measurement and round it down to the nearest ⅛ inch (for example, a width of 39 11/16” is 39 5/8”) - this is the width measurement you will use when ordering your blinds</li>
                    <li>Measure the inside height of the window in three places: the left, middle and right</li>
                    <li>Highlight the largest height measurement and round it up to the nearest ⅛ inch (for example, a width of 39 11/16” is 39 5/8”) - this is the height measurement you will use when ordering your blinds</li>
                    <li>Remember, to ensure a perfect fit for inside mount installations, please follow our measuring instructions; <b>do not deduct anything from your measurements</b> as this will be done automatically by production when they make deductions for mounting brackets. </li>
                </ul>


            </div>

        </div>


        <div class="row align-items-center flex-md-row-reverse mt-4">

            <div class="col-md-4">
                <div class=" px-4">
                    <img src="{{asset('images/outside-mount.jpg')}}" alt="" />
                </div>
            </div>

            <div class="col-md-8 pe-md-5">
                <h1 class="heading-two pt-2">Measuring for an Outside Mount </h1>
                <h5 class="border-start border-4 pe-md-5 border-primary ps-3 pe-xl-5">
                    The blind covers the entire window and frame allowing the blind to be the focal point.</h5>
                <ul class="list-items mt-4">
                    <li>Measure the width of the window frame in three places: the top, middle, and bottom</li>
                    <li>Highlight the longest width measurement and add 3 - 4 inches for maximum coverage. This is the width measurement you will use when ordering your blinds.</li>
                    <li>Measure the height of the window frame in three places: the left, middle and right</li>
                    <li>Highlight the tallest height measurement and add 2 - 3 inches above the window for the mount and any additional length to the bottom depending on how far you want the blind to hang. Your final height measurement will be the measurement you use to order your blinds.</li>
                </ul>


            </div>

        </div>


        <div class="row pb-2 justify-content-between about-services-section mt-4">

            <div class="col-lg-8 col-lg-5 mt-3">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/0TeqoxQWf4g?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class="col-lg-4 mt-3">
                <div class="services-box cart-box rounded shadow-none h-100 p-4 text-center align-items-center d-flex">
                    <div>
                    <h3 class="heading-two">Download your handy measuring guide</h3>
                    <a class="btn btn-primary mt-3" href="{{asset('HeyBlinds-Handy-Measuring-Guide.pdf')}}" download>Download PDF</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
