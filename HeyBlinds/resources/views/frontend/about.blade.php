@extends('layouts.Frontend.app')
@section('title')
    About Us | HeyBlinds Canada
@endsection
@section('content')
    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </nav>
        <div class="inner-banner rounded">
            <img class="rounded" src="{{ asset('images/shipping-banner.jpg') }}" alt="" />
            <div class="inner-banner-text">
                About Us
            </div>
        </div>
    </section>
    <section id="body-content">
        <div class="container py-4 pb-4 pb-xxl-5">
            <div id="CompanyHistory">
                <h1 class="heading-two pt-2" style="color: var(--colorDark);">HeyBlinds.ca: Online custom blinds for Canadians</h1>

                <div class="pb-2">
                    <a href="#CompanyHistory" class="btn btn-primary mt-2">Company History</a> <a
                        class="btn btn-primary mt-2" href="#BestWarranties">Industry’s Best Warranties </a>
                </div>
                <hr />

                <p class="fst-italic text-primary mb-0"><b>Company History</b></p>
                <h5 class="font-secondary fw-bold pt-2">The HeyBlinds Story-A Message From Our Founder:</h5>

                <p>So many different styles and colours to choose from! No, wait--actually, it was a case of TOO MANY styles
                    & colours to choose from!
                </p>

                <p>Back then, we were focused on offering an ‘endless aisle’ of choices for blinds shoppers in Canada, who
                    could buy from a Canadian blinds online store.</p>

                <p>When I left that business 5 years ago, I already knew that there was an even better way to help Canadian
                    blinds shoppers!
                </p>

                <p>Over the years, I noticed the 80-20 rule in shopper buying habits: 80% of our customers bought from the
                    same 20% of styles & colours.</p>

                <h6 class="fw-semibold">‘Why do we have 27 different styles of honeycomb shades in 500+ colors when the
                    same handful of styles & colours are the ones 80% of our customers are buying??’</h6>


                <p>
                    Imagine, we boasted about how we were offering thousands of styles, colours & options, yet most of our
                    customers were buying from a very small subset of all those choices!
                </p>

                <p>
                    I watched shopper after shopper struggle, feeling stressed and overwhelmed in a sea full of too many
                    choices.
                </p>

                <p>
                    They would order samples, look them over, then order more samples, and take weeks to finally
                    decide...only to order from that smaller 20% of the most popular styles, colours and options.
                </p>

                <p>
                    Like many entrepreneurs, I said: ‘There has to be a better way!’
                    And now there is! <a href="{{ route('welcome') }}"> HeyBlinds.ca</a>

                </p>

                <p>
                    If you want to choose from 27 different styles of Honeycomb shades with hundreds of colours, please go
                    and shop with my competitors.
                </p>

                <p>
                    But if you’re like me, and most consumers, who don’t want the stress and complexity of choosing from
                    tons of styles and colours that you’re never likely to choose anyways, then you’ve come to the right
                    place!
                </p>


                <p>
                    We’ve carefully hand-curated a selection of only the most popular styles, colours and options.
                    Not only do we make the buying process much easier, we also offer the industry's best <a
                        href="{{ url('/warranty') }}"> warranties</a>

                </p>

                <p>
                    Our Hey OK Guarantees give you peace of mind and no-stress, just in case something isn't quite right.
                    So that every customer can order 100-day guaranteed blinds that will make your home beautiful, a great
                    place to live, sleep, work and play.
                    Blinds that everyone will love.
                    Blinds that keep out the light and lock in the love.
                    And give you the satisfaction of a DIY job well done!

                </p>

                <p>
                    You may even be tempted to offer your newfound blinds shopping expertise with a friend who's looking for
                    blinds ('Wanna hire me?' LOL)!
                    Choosing blinds is now one less tough decision to make in our lives that are already too complicated.

                </p>

                <p>
                    As a fellow Canadian living in beautiful Montreal, I am one of many real people behind the business. We
                    are a 100% privately owned, Canadian company. And I’m here if you need me, anytime. <a
                        href="mailto:robert@heyblinds.ca"> Email me</a> and I promise to personally get back to you.
                </p>
                <div id="BestWarranties"></div>

                <p>Merci!</p>

                <h2 class="font-brittan pt-2 pb-4">Robert</h2>

                <hr />

            </div>



            <p class="fst-italic text-primary mb-0"><b>Industry’s Best Warranties</b></p>
            <h5 class="font-secondary fw-bold pt-2">Best choice, more Zen.</h5>
            <h5 class="border-start border-4 border-primary ps-2">HeyBlinds curates only the best designs for you.</h5>
            <p class="mb-0">
                Choosing custom blinds for your home should be easy, not complicated. You’ve got enough to worry about
                and getting the best blinds for your home shouldn’t be one of them. That’s why HeyBlinds focuses on
                keeping things simple. By offering only the best choices you'll hone in on what you need - faster. No
                more wasting time wading through a long search of so-so choices.
            </p>
            <div class="row pb-2">
                <div class="col-lg-3 col-md-6 services-section mt-3">
                    <div class="services-box h-100 rounded shadow p-3 bg-white">
                        <h4 class="">
                            Select your blinds and measure
                        </h4>
                        <p class="mb-0 w-100">Use our handy measuring guide for foolproof measurements.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 services-section mt-3">
                    <div class="services-box h-100 rounded shadow p-3 bg-white">

                        <h4 class="">
                            Get excited with free samples
                        </h4>
                        <p class="mb-0 w-100">Order all the samples you need to make sure your blinds are spot-on.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 services-section mt-3">
                    <div class="services-box rounded shadow h-100 p-3 bg-white">

                        <h4 class="">
                            Don’t stress over your order
                        </h4>
                        <p class="mb-0 w-100">Seriously, don’t stress. We’ll help you get it right.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 services-section mt-3">
                    <div class="services-box h-100 rounded shadow p-3 bg-white">

                        <h4 class="">
                            Easily install and LOVE your blinds
                        </h4>
                        <p class="mb-0 w-100">Everything you need so you can enjoy your blinds immediately.</p>
                    </div>
                </div>

            </div>

            <h5 class="font-secondary fw-bold pt-4">Perfect blinds every time.</h5>
            <h5 class="border-start border-4 border-primary ps-2">Thanks to our HeyOK Warranties.</h5>
            <p class="mb-0">
                From measuring to feeling good about your decision, HeyBlinds has you covered. Because, even when you
                measure twice, or think you’ve chosen the right colour, or someone got a little too “yanky”, mistakes
                can happen.
            </p>

            <div class="row pb-2 text-center about-services-section">
                <div class="col-lg-3 col-sm-6 services-section mt-3">
                    <div class="services-box h-100 rounded shadow-none p-0 bg-white">

                        <h6 class=" mb-0 font-secondary fw-semibold">
                            <img class="me-1" src="{{ asset('images/icon12.png') }}"
                                alt="Hey Blindes RightFit Guarantee" /> RightFit<small class="TrademarkSymbol">&reg;</small>
                            &nbsp; Guarantee
                        </h6>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 services-section mt-3">
                    <div class="services-box h-100 rounded shadow-none p-0 bg-white">

                        <h6 class=" mb-0 font-secondary fw-semibold">
                            <img class="me-1" src="{{ asset('images/icon11.png') }}"
                                alt="Hey Blindes RightFit Guarantee" />
                            100 Day Risk-Free In-Home Trial
                        </h6>

                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 services-section mt-3">
                    <div class="services-box h-100 rounded shadow-none p-0 bg-white">
                        <h6 class="mb-0 font-secondary fw-semibold">
                            <img class="me-1" src="{{ asset('images/icon10.png') }}"
                                alt="Hey Blindes RightFit Guarantee" />
                            FREE 3 Year Limited Warranty
                        </h6>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 services-section mt-3">
                    <div class="services-box h-100 rounded shadow-none p-0 bg-white">

                        <h6 class="mb-0 font-secondary fw-semibold">
                            <img class="me-1" src="{{ asset('images/icon9.png') }}"
                                alt="Hey Blindes RightFit Guarantee" /> Best Price Guarantee
                        </h6>
                    </div>
                </div>
            </div>

            <h5 class="font-secondary fw-bold pt-4">We make good blinds our business.</h5>
            <h5 class="border-start border-4 border-primary ps-2">Quality and satisfaction guaranteed.
            </h5>
            <p class="mb-0">
                With over 10 years experience in the Window Coverings industry, and thousands of satisfied
                customers, we know how important quality is and the workmanship that goes in to the perfect blind.
                In order to deliver you a product we are proud of and you will love, our online store is secured by
                certified, recognized partners who are experts in their field.
            </p>

        </div>
    </section>
@endsection
