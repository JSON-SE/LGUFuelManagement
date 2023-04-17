@extends('layouts.Frontend.app')
@section('title')
    Warranty - Window Blinds & Shade | HeyBlinds Canada
@endsection
@section('content')

    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Warranties</li>
            </ol>
        </nav>
        <div class="inner-banner rounded">
            <img class="rounded" src="{{ asset('images/warranties-banner.jpg') }}" alt="" />
            <div class="inner-banner-text">
                HeyOK Warranties
            </div>
        </div>

    </section>

    <section id="body-content">
        <div class="container py-4 pb-4" id="RightFit">
            <h1 class="heading-two pt-2 mb-0" style="color: var(--colorDark)">HeyOK Warranties for Peace of Mind Shopping</h1>

            <div class="pt-3 pb-3">
                <a class="btn btn-primary mt-2 me-2" href="#RightFit">RightFit<small class="TrademarkSymbol">®</small>
                    Guarantee</a>
                <a href="#Risk-Free" class="btn btn-primary mt-2 me-2">100 Day Risk-Free In-Home Trial</a>

                <a href="#BestPrice" class="btn btn-primary mt-2 me-2">Best Price Guarantee</a>
                <a class="btn btn-primary mt-2 me-2" href="#Warranties">Warranties</a>
            </div>

            <div class="row pb-2 justify-content-center about-services-section">
                <div class="col-lg-12 mt-3">
                    <div class="services-box p-0  rounded shadow-none bg-white">
                        <h4>
                            RightFit<small class="TrademarkSymbol">®</small> Guarantee
                        </h4>
                        <p class="w-100">
                            Make a mistake measuring, and we’ll fix it for free.</p>
                        @if(config('global.is_heyblinds_com') == true)
                            <p class="w-100">That’s right. Even if you make a slight mistake, we’ll remake your same blind for free because we want your blind to fit perfectly for a professional look. You only pay a small shipping charge of $15 per product (oversized items over 94” will be charged an oversize shipping fee).</p>
                        @else
                        <p class="w-100">That’s right. Even if you make a slight mistake, we’ll remake your same
                            blind for free because we want your blind to fit perfectly for a professional look. You only pay
                            a small, below-market shipping charge of $15 per product (oversized items over 94” will be charged an
                            oversize shipping fee).</p>
                        @endif
                        <p class="mb-0 w-100">Don’t let measuring worry you. We set you up for success with our handy,
                            foolproof <a href="{{ url('/measure-instructions') }}"> Measuring Guide</a> .
                        </p>

                    </div> 
                    
                </div>
                <div class="col-lg-6 mt-3">
                    <div class="services-box rounded shadow-none h-100 bg-ex-light p-3">
                        <h4>What to do if you made a mistake</h4>
                        <ul class="list-items">
                            <li>
                                Contact customer service within 30 days.</li>
                            <li>We will help you re-measure your window and remake (no cash refunds) the original blind you
                                ordered in the same colour,
                                revised size and/or revised mount.</li>
                            <li>Donate your mis-measured blind to a charity and submit your donation receipt to HeyBlinds.
                                (Please contact us first for a list of approved charities.)</li>
                            <li>In certain circumstances, we may ask for pictures and/or the original blind to be returned.
                            </li>
                            <li>Good for upto 6 blinds per household, 3 items per order, maximum 2 orders per person and per
                                household. </li>

                        </ul>
                    </div>

                </div>

                <div class="col-lg-6 mt-3">
                    <div class="services-box rounded shadow-none h-100 bg-ex-light p-3">
                        <h4 class="0">
                            Good to know
                        </h4>

                        <ul class="list-items">
                            <li>
                                If your replacement blind increases the price due to size, we will only charge you the
                                difference.</li>
                            <li>If the item being remade is a lower price than the original, no refund or store credit will
                                be issued.</li>
                            <li>Shutters and motorized products are limited to 1 free remake per household.</li>
                            <li>This offer cannot be combined with our 100 Day Risk-Free In-Home Trial</li>
                            <li>It's always a good idea to try out new things, but when ordering for the first time, if
                                you’re unsure, we recommend ordering just one item.
                                That way if it doesn't meet your expectations then there won’t be an expensive mistake on
                                both of our parts!</li>

                        </ul>
                    </div>
                </div>



            </div>

            <div id="Risk-Free" class="row pb-2 text-center about-services-section justify-content-center">
                <div class=" col-lg-4 col-sm-6 services-section mt-3">
                    <div class="services-box h-100 rounded shadow-none p-0 bg-white">

                        <h6 class=" w-100 fst-italic mb-0 mb-sm-2">“We couldn’t believe HeyBlinds replaced our blind
                            because we made a mistake! That is the best customer service we’ve ever experienced.”</h6>
                        <p class="fw-bold w-100 mb-0 pt-sm-2"> – Amelia H. from Saskatoon, SK </p>
                    </div>
                </div>

                <div class=" col-lg-4 col-sm-6 services-section mt-3">
                    <div class="services-box h-100 rounded shadow-none p-0 bg-white">

                        <h6 class=" w-100 fst-italic mb-0 mb-sm-2">“I loved that the blind I goofed measuring went to a
                            charity. What a great idea.”</h6>
                        <p class="fw-bold w-100 mb-0 pt-sm-2"> – Richard F. from Oshawa, ON</p>
                    </div>
                </div>


            </div>

            <hr class="mt-3 mb-0" />
            <div id="warranty-scroll-section" class="row pb-2 justify-content-center about-services-section">
                <div class="col-lg-8 mt-3">
                    <div class="services-box p-0  rounded shadow-none bg-white">
                        <h4 class="details-guarantee-text fst-italic"><span><span>100</span> Day </span> Risk-Free In-Home
                            Trial</h4>
                        <p class="w-100">
                            We want you to be sure you’ve chosen the right blind in the right colour and texture.</p>

                        <p class=" w-100">That’s why we’ll let you live with your blind for 100 days so you can be
                            confident you made the right choice.</p>

                        <p class=" w-100">We don't want anyone unhappy so if you're not satisfied with your
                            purchase, we'll do everything in our power to make you happy. But if it's just impossible for us
                            to make you happy then rest assured we’ll be here to help you with returning your order for a
                            refund or exchange!</p>
                        <p class="w-100">
                            Make sure you’re covered by our 100 Day RIsk-Free In-Home Trial by ordering free samples. That way, you can better see how the colours & materials will look and feel for a perfect complement to your room—order as many as you like. HeyBlinds will ship them all for free. And we’ll lock in today’s sale pricing for 3 weeks so that you have time to be sure of your choice before ordering!
                        </p>
                        <p class="w-100">
                            If you need the same blinds and shades for many different rooms, you may consider first ordering
                            for just one room to ensure they meet your expectations, and then place your order for the rest
                            of your home.
                        </p>

                        <p class="w-100">
                            Because all of our products are custom made, they cannot be resold, so all returns must be
                            donated to charity.
                        </p>

                        <p class="w-100">
                            Our 100 Day Risk-Free In-Home Trial covers all single orders up to $500 in value per order, or a
                            combination of multiple orders within
                            any 12 month period, from the same household, person or address, with a total combined value of
                            up to $500. Only items in colours for
                            which samples were ordered are covered by this policy (unless samples were out of stock at time
                            of ordering).
                        </p>

                        <p class="w-100">
                            Any oversize freight fees, return shipping costs and handling charges are non-refundable.
                        </p>
                        <div id="BestPrice"></div>
                        <p class="mb-0 w-100">
                            Our 100 Day Risk-Free In-Home Trial cannot be combined with our RightFit<small
                                class="TrademarkSymbol">®</small> Guarantee or any other
                            offer. This offer is not available on commercial or dealer orders. Shutters and motorized products are limited to 1 free remake per household.
                        </p>


                        <h6 class=" w-100 fst-italic mb-0 pt-3">“Being able to live with our blind for a little while really
                            helped us to feel good about our choice. That was a nice touch. Thanks HeyBlinds.”</h6>
                        <p class="fw-bold w-100 mb-0 pt-1"> – Alice R. from Mississauga, ON</p>


                    </div>
                </div>

                <div class="col-lg-4 mt-3">
                    <div class="services-box rounded shadow-none bg-ex-light p-3">
                        <h4 class="0">
                            What to do if you made the wrong choice
                        </h4>

                        <ul class="list-items">
                            <li>
                                If you’re not completely satisfied, contact customer service before the 100 Days are up
                            </li>
                            <li>
                                We'll do everything in our power to make you happy, even if it means replacing items (as
                                long as you ordered samples for them)
                            </li>
                            <li>
                                If it's just impossible for us to make you happy then rest assured we’ll be here to help you
                                with returning your order for a refund or exchange!
                            </li>
                            <li>
                                HeyBlinds guarantees up to a value of $500 of blinds per household.
                            </li>
                            <li>
                                If the replacement blind is more, HeyBlinds will only charge the difference.
                            </li>

                        </ul>
                    </div>
                </div>



            </div>

            <hr class="mt-3 mb-0" />

            <div class="row pb-2 justify-content-center about-services-section">
                <div class="col-lg-6 mt-3">
                    <div class="services-box p-0  rounded shadow-none bg-white">
                        <h4 class="heading-two mb-0">Best Price Guarantee</h4>
                        <p class=" w-100 fw-bold mb-1 pt-2">
                            Hey, found a better price? We’ll beat it, guaranteed.
                        </p>
                        <p class=" w-100">
                            Whether you buy one blind or enough for your entire home, we guarantee you paid the lowest price
                            for 60 days after your purchase.</p>

                        <p class=" w-100 mb-0">If you find a lower price, we’ll not only match it; we’ll beat it with an
                            additional 10% discount on the difference.</p>



                    </div>
                </div>
                <div class="col-lg-6 mt-3">
                    <div class="services-box bg-ex-light p-4 rounded shadow-none h-100 p-0">
                        <h4>What to do if you find your blind at a lower price</h4>
                        <ul class="list-items">
                            <li>
                                Notify us of the competitor's price by <a href="javascript:void(0)"
                                    onclick="$crisp.push(['do', 'chat:open'])"> contacting us by Chat</a>.</li>
                            <li>We'll verify the competitor's price.</li>
                            <li>If the blind you found at a lower price is brand new, in stock and the same material, size,
                                shape, and colour,
                                we'll refund you the difference plus an additional 10% of the difference!</li>

                        </ul>
                    </div>

                </div>





            </div>

            {{-- <hr class="mt-3 mb-0" /> --}}

            <div class="row pb-2 pt-3 justify-content-center about-services-section">
                <div class="col-lg-7 mt-3">
                    <div class="services-box p-0  rounded shadow-none bg-white">
                        <h4 class="heading-two mb-0">A guide to comparing prices</h4>

                        <p class=" w-100 mb-1 pt-2">
                            Blinds from Canadian Retailers: Take the competitor's price and add the delivery, handling and
                            other fees to the cost and then compare it to the price you paid for your blind from HeyBlinds.

                        </p>


                        <h6 class=" w-100 fst-italic mb-0 pt-3">“We tried to find blinds at a lower price, but couldn’t do
                            it! HeyBlinds had the lowest pricing by far.”</h6>
                        <div id="Warranties"></div>
                        <p class="fw-bold w-100 mb-0 pt-1"> – Olivia M. from Nanaimo, BC</p>



                    </div>
                </div>
                <div class="col-lg-5 mt-3">
                    <div class="services-box rounded shadow-none bg-ex-light p-4 h-100 p-0">
                        <p class="fw-normal w-100">Blinds from US Retailers: When comparing prices, you will need to add
                            more fees to competitor pricing outside of Canada.
                            Those fees include:</p>
                        <ul class="list-items">
                            <li>Duties</li>
                            <li>Brokerage costs of up to $35 or more</li>
                            <li>Shipping costs into and across Canada</li>
                            <li>Currency exchange</li>
                            <li>Handling and other fees charged by the retailer</li>

                        </ul>
                    </div>

                </div>





            </div>

            <hr class="mt-3 mb-0" />

            <div class="row pb-2 justify-content-center about-services-section">
                <div class="col-lg-12 mt-2">
                    <div class="services-box p-0  rounded shadow-none bg-white">
                        <h4 class="heading-two mb-0">3 Year Limited Warranty</h4>

                        <p class=" w-100 mb-1 pt-2">
                            You, as the original purchaser, are covered for no charge replacements (see details in the chart
                            below) if your blinds arrive damaged, something breaks or if there is any kind of defect in
                            materials and workmanship, as long as you own your blinds in your residential home, for up to 3
                            years. As long your blinds have been installed following the installation instructions, you’re
                            also covered for all defective internal mechanisms and parts. This coverage is automatically
                            included on your purchase.
                        </p>

                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="shadow rounded">
                        <div class="p-3">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>

                                        <th scope="col">Warranty *</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Parts</td>
                                        <td>
                                            Parts that are replaceable include (but are not limited to): tilter mechanisms,
                                            cord locks, valance clips, equalizers, tensioners, bottom rail plugs and cord
                                            cleats. Replacement parts will be mailed free via regular mail of standard
                                            ground shipping.<br />
                                            Remotes, motors and other original parts of motorized products are not covered
                                            past the manufacturer's original warranty period; it may be possible to replace
                                            these parts at manufacturer's cost if they are available.
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Fabric and Slats</td>
                                        <td>
                                            Fabric and Slats issues such as warping, fabric separating and/or breaking, are
                                            covered for 3 years.
                                            Following the first 3 years, normal wear & tear is applicable to durability of
                                            fabric and slats, product will be
                                            remade at an extra discount.
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Restrings</td>
                                        <td>We will restring the product at no charge for upto 3 years, all you pay is
                                            shipping. After 3 years, there is a $35 charge plus shipping.</td>
                                    </tr>
                                    <tr>
                                        <td>Product not raising or losing tension</td>
                                        <td>Product will be remade at no charge for upto 3 years. After 3 years, normal wear
                                            & tear is applicable to all materials which can lose original intensity and the
                                            life of cords varies depending on use, and are no longer covered after 3 years.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Vertical Track</td>
                                        <td>Operation of the track includes track not tilting or not drawing open/close.
                                            This does not include breakage of track stems due to misuse. Replacement tracks
                                            are available for $35, plus shipping.
                                            <br />
                                            Up to 3 years: Track will be replaced at no charge. If the track is over 90"
                                            wide, a $70 oversize fee will be charged.
                                            <br />
                                            After 3 years: $35 charge for new track. If the track is over 90" wide, an
                                            additional $70 fee will be charged.
                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

            </div>
            <hr class="mt-3 mb-0" />
            <div class="row pb-2 justify-content-center about-services-section">
                <div class="col-lg-12 mt-2">
                    <div class="services-box p-0  rounded shadow-none bg-white">
                        <h4 class="heading-two mb-0">5 Year Limited Warranty</h4>

                        <p class=" w-100 mb-1 pt-2">
                            You, as the original purchaser, are covered for no charge replacements (see details in the chart
                            below) if your blinds arrive damaged, something breaks or if there is any kind of defect in
                            materials and workmanship, as long as you own your blinds in your residential home, for up to 5
                            years. As long your blinds have been installed following the installation instructions, you’re
                            also covered for all defective internal mechanisms and parts. This coverage is automatically
                            included on your purchase.
                        </p>

                    </div>
                </div>

                <div class="col-lg-12 mt-3">
                    <div class="shadow rounded">
                        <div class="p-3">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>

                                        <th scope="col">Warranty *</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Parts</td>
                                        <td>
                                            Parts that are replaceable include (but are not limited to): tilter mechanisms,
                                            cord locks, valance clips, equalizers, tensioners, bottom rail plugs and cord
                                            cleats. Replacement parts will be mailed free via regular mail of standard
                                            ground shipping.<br />
                                            Remotes, motors and other original parts of motorized products are not covered
                                            past the manufacturer's original warranty period; it may be possible to replace
                                            these parts at manufacturer's cost if they are available.
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Fabric and Slats</td>
                                        <td>
                                            Fabric and Slats issues such as warping, fabric separating and/or breaking, are
                                            covered for 5 years.
                                            Following the first 5 years, normal wear & tear is applicable to durability of
                                            fabric and slats, product will be
                                            remade at an extra discount.
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Restrings</td>
                                        <td>We will restring the product at no charge for upto 5 years, all you pay is
                                            shipping. After 5 years, there is a $35 charge plus shipping.</td>
                                    </tr>
                                    <tr>
                                        <td>Product not raising or losing tension</td>
                                        <td>Product will be remade at no charge for upto 5 years. After 5 years, normal wear
                                            & tear is applicable to all materials which can lose original intensity and the
                                            life of cords varies depending on use, and are no longer covered after 5 years.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Vertical Track</td>
                                        <td>Operation of the track includes track not tilting or not drawing open/close.
                                            This does not include breakage of track stems due to misuse. Replacement tracks
                                            are available for $35, plus shipping.
                                            <br />
                                            Up to 5 years: Track will be replaced at no charge. If the track is over 90"
                                            wide, a $70 oversize fee will be charged.
                                            <br />
                                            After 5 years: $35 charge for new track. If the track is over 90" wide, an
                                            additional $70 fee will be charged.
                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

            </div>

            <hr class="mt-3 mb-0" />

            <div class="row pb-2 justify-content-center about-services-section pt-3">
                <div class="col-lg-12 mt-2">
                    <div class="services-box p-0  rounded shadow-none bg-white">
                        <h4 class="">10 Year Peace Of Mind B.L.I.N.D.S. (Blinds Lifesaver If Nasty Damage
                            Surfaces) Unlimited Protection Plan</h4>
                        <p class=" w-100 mb-1 pt-2">
                            Hey, we know accidents happen. That’s why we offer our <b class="fw-bold">10 Year Peace
                                Of Mind B.L.I.N.D.S.</b>
                            {{-- </p>

                        <p class=" w-100 mb-1 pt-2"> --}}
                            <b class="fw-bold">Unlimited Protection Plan</b> to help with accidental damage. We know
                            you need to use your blinds every day and that some days will
                            be rougher than others. It covers everything. From repeated yanking to unexpected accidents you
                            didn’t see coming, it’s all covered.
                            If your blind starts breaking down, you can rest easy knowing we’ll take care of it.
                        </p>

                        <p class=" w-100 mb-1 pt-2">
                            <b class="fw-bold">What’s Covered?</b>
                        </p>

                        <p class=" w-100  mb-0 pt-2">
                            In the event that your product gets accidentally damaged, we will fix or replace it within 10
                            years at no cost!
                        </p>

                        <p class=" w-100  mb-0 pt-2">
                            Accidental damage includes, but is not limited to: damaged or broken mechanisms or parts; tears,
                            stains, rips, burns, cracks, scratches, holes from accidents such as fire/water exposure.
                            Damaged products covered by your plan can be replaced one time free of charge and shipping is
                            paid by HeyBlinds!
                        </p>

                        <p class=" w-100  mb-0 pt-2">
                            This plan is only available to the original customer and can’t be sold or transferred to anyone
                            else. Because this plan starts protecting you right away, it cannot be refunded.
                        </p>
                        <p class=" w-100  mb-0 pt-2">
                            Any replacement products offered by this plan can only be shipped to the same shipping address
                            and person as is on the original order; our standard oversize shipping fees may apply if any
                            dimension is 94” or more.
                        </p>
                        <p class=" w-100  mb-0 pt-2">
                            When making a claim under this plan, you’ll need to provide us with electronic images (photos or
                            videos) showing the reason for the claim. We may need to, at our expense, pick up your damaged
                            goods so that they can be inspected before they are replaced.

                        </p>
                        <p class=" w-100  mb-0 pt-2">
                            This plan does not cover motorized products, commercial or dealer orders, any order of $5,000 or
                            more, or any other order at our sole discretion.

                        </p>
                        <p class=" w-100  mb-0 pt-2">
                            You’ll see the option and cost to add this coverage to your order when you configure each
                            product.
                        </p>
                        <p class=" w-100  mb-0 pt-2">
                            You can choose to add this additional protection to one, some or all the items in your order.

                        </p>


                    </div>
                </div>

                <div class="col-lg-12 mt-3">
                    <div class="shadow rounded">
                        <div class="p-3">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>

                                        <th scope="col">Warranty *</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Parts</td>
                                        <td>
                                            Covered for 10 years; after that, $5/part, plus shipping.
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Product not raising or losing tension</td>
                                        <td>
                                            Covered for 10 years; after that, no longer covered due to normal wear & tear.
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Restrings</td>
                                        <td>
                                            Covered for 10 years; after that, $35/restring, plus shipping.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vertical Track</td>
                                        <td>
                                            Covered for 10 years; after that, $35/new track, plus shipping.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Fabric and Slats</td>
                                        <td>
                                            Covered for 10 years; after that, no longer covered due to normal wear & tear.
                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>

                    <p class="text-center pt-3">* Discounts, coupons, or promo codes not applicable to the cost of the
                        warranty.</p>

                </div>


            </div>



            {{-- <div class="mt-4 mb-2 small mb-0"> --}}
            {{-- <p class=""> --}}
            {{-- * Discounts, coupons, or promo codes not applicable to the cost of the warranty. --}}
            {{-- </p> --}}
            {{-- <p class=" mb-0 small"> --}}
            {{-- ** This warranty supersedes any and all stated warranties, whether written or oral. In no event --}}
            {{-- shall we be liable for incidental or consequential damages that may result from any defect in --}}
            {{-- product or breach of this warranty. We reserve the right to inspect any part or component prior to --}}
            {{-- replacements. In order for repair or replacement to be made, a Bill of Sale, canceled cheque or --}}
            {{-- other payment record verifying the original purchase date must be presented to us. The exclusion or --}}
            {{-- limitation of incidental or consequential damages may vary according to state of purchase, therefore --}}
            {{-- the above limitations or exclusions may not be applicable to you. This warranty gives you specific --}}
            {{-- legal rights and may also include other rights which may vary between provinces. --}}
            {{-- </p> --}}
            {{-- </div> --}}

        </div>
    </section>


@endsection
