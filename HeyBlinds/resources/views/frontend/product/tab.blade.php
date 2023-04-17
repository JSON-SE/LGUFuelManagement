<div id="product-details-nav-section" class="pt-4">
    <ul class="nav product-details-nav nav-tabs" id="myTab " role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link order-sample-btn" href="javascript:void(0)" target="_self">Order Free
                Samples</a>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Product
                Information</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Measure & Install
                Guide</button>
        </li>

        <li class="nav-item" role="presentation">
            <button href="javascript:void(0)" class="nav-link reviews-link-slider" id="Reviews-tab" data-bs-toggle="tab"
                data-bs-target="#Reviews" type="button" role="tab" aria-controls="Reviews"
                aria-selected="false">Reviews</button>
        </li>
    </ul>
    <div class="tab-content pb-2" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="py-3 text-dark">

                {!! $product->content ?? '' !!}

            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="py-3 text-dark">
                <div class="row pb-3 justify-content-center about-services-section mb-4">
                    @if (!empty($helpers->getYoutubeEmbedUrl($product->measurement->measure_media_id_2 ?? '')))
                        <div class="col-lg-8 col-lg-5 mb-3">
                            <iframe width="100%" height="315"
                                src="{{ $helpers->getYoutubeEmbedUrl($product->measurement->measure_media_id_2 ?? '') }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="col-lg-8 col-lg-5 mb-3">
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/0TeqoxQWf4g?controls=0"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    @endif

                    <div class="col-lg-4 mb-3">
                        <div
                            class="services-box cart-box rounded shadow-none p-4 text-center align-items-center justify-content-center d-flex">
                            <div class="mb-3">
                                <h3 class="heading-two">Download Measuring Guide</h3>
                                @if (!empty($product->measurement->measure_media_id))
                                    <a class="btn btn-primary mt-2" target="_blank"
                                        href="{{ $helpers->getImage($product->measurement->measure_media_id ?? '') }}"
                                        download>Download PDF</a>
                                @else
                                    <a class="btn btn-primary mt-3" target="_blank"
                                        href="{{ asset('images/pdf/HeyBlinds-Measuring-Guide.pdf') }}">Download PDF</a>
                                @endif
                            </div>
                        </div>
                        @if (!empty($product->measurement->installation_media_id))
                            <div
                                class="services-box cart-box rounded shadow-none  mt-3 p-4 text-center align-items-center justify-content-center d-flex">
                                <div>
                                    <h3 class="heading-two">Download Install Guide</h3>
                                    @if (!empty($product->measurement->installation_media_id))
                                        <a class="btn btn-primary mt-2" target="_blank"
                                            href="{{ $helpers->getImage($product->measurement->installation_media_id ?? '') }}"
                                            download="download">Download PDF</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
            <div class="py-3 text-dark">
                <div class="row pb-5 pt-3 justify-content-center about-services-section mb-4">
                    @if ($productReviews->count() > 0)
                        <div class="col-lg-3 col-md-4 pe-md-4 text-center campany-reviews">
                            <h5 class="mb-0">Reviews</h5>
                            <hr class="mt-2" />
                            <div class="py-2 total-product-review">
                                <div class="star-width mx-auto">
                                    @php
                                        $rating_total_percentage = (100 / 5) * $avgOfproductReviews;
                                    @endphp
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $rating_total_percentage }}%;" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="star-pro">
                                        <span>★</span>
                                        <span>★</span>
                                        <span>★</span>
                                        <span>★</span>
                                        <span>★</span>
                                    </div>

                                </div>
                                <h5 class="mb-0 ps-2 pt-3">
                                    <b>{{ is_float($product->avgRatingOfProduct($product->id) ?? 0) == true ? number_format($product->avgRatingOfProduct($product->id), 1) : number_format($product->avgRatingOfProduct($product->id)) }}/5</b>
                                    {{-- @if (is_float($avgOfproductReviews))
                                                <b>{{number_format($avgOfproductReviews)}}/5</b>
                                                @else
                                                <b>{{number_format($avgOfproductReviews,1)}}/5</b>
                                                @endif --}}
                                    <small>({{ $productReviews->count() }} Reviews)</small>
                                </h5>

                            </div>
                        </div>

                        <div class="col-lg-9 col-md-8">

                            <div class="review-slider">
                                @foreach ($productReviews as $review)

                                    <div class="review-box shadow-sm rounded p-3 mx-2">
                                        <div class="testmonial-top pb-1">

                                            {{-- @php
                                                        $name = preg_split ('/\s/',$review->name);
                                                        @endphp --}}

                                            <h6 class="mb-0 font-weight-bold fw-semibold">
                                                {{ ucfirst($review->title_review) }}
                                            </h6>
                                            <p class="mb-1 fw-semibold">
                                                {{ ucfirst($review->name) }} from {{ $review->city }},
                                                {{ $review->province }}&nbsp;{{ $review->created_at->format('M d, Y') }}
                                            </p>
                                            <div class="star-width">
                                                @php
                                                    $rating_percentage = (100 / 5) * $review->rating_point;
                                                @endphp
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $rating_percentage }}%;" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="star-pro">
                                                    <span>★</span>
                                                    <span>★</span>
                                                    <span>★</span>
                                                    <span>★</span>
                                                    <span>★</span>
                                                </div>

                                            </div>
                                        </div>
                                        <hr class="my-2" />

                                        <p class="auth-content mb-0 py-1 text-break review-text">
                                            {{ $review->review }}
                                        </p>

                                        {{-- <p><small>{{$review->created_at->format('M d, Y')}}</small></p> --}}

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <h3 class="text-center">Reviews not found yet.</h3>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
<div class="row justify-content-end py-xxl-3 py-1 product-cart-height mb-3 position-relative">
    <div id="product-cart-box" class="col-lg-10 col-xl-7 product-cart-box">
        <div
            class="rounded  shadow bg-white px-sm-3 px-2 product-cart-padding-y border-bottom border-3 border-primary text-dark">
            <div class="row py-1 ">
                <div class="col-8">
                    <div class="row ">
                        <div class="col-7">
                            <p class="mb-0 fw-bold">My Samples Cart</p>

                            <p class=" mb-1"><span id="totalFreeSampleCarts">{{ $sampleCount }}</span> Free
                                Sample(s) in cart</p>

                            <button class="btn btn-secondary btn-sm headerSampleCart">Samples Cart</button>

                        </div>
                        <div class="col-5 border-start">
                            <div class="mb-1">Guaranteed Lowest Price:
                                <span class="position-relative mousuhover-out">
                                    <span class="text-primary tooltip-hover">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                            </path>
                                        </svg>
                                    </span>
                                    <div class="tooltip shadow">
                                        <div class="tooltip-arrow"></div>
                                        <span class="close-tooltip btn-close btn"></span>
                                        <div class="tooltip-inner">
                                            <div class="row g-2">
                                                <div class="col-12">
                                                    <p class="fw-semibold">Hey, found a better price? We’ll beat it,
                                                        guaranteed.</p>
                                                    <p>Whether you buy one blind or enough for your entire home, we’ll
                                                        guarantee you got the lowest price for up to 60 days after your
                                                        purchase.</p>

                                                    <p class="mb-0">If you find a lower price, we’ll not only
                                                        match it; we’ll beat it with an additional 10% discount on the
                                                        difference.</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </div>

                            <div>
                                <h5 class="text-primary font-secondary fw-bold mb-0" id="displayPrice">
                                    ${{ $isEditProduct && !empty($optionValue['total_price']) ? $optionValue['total_price'] : (!empty($finalPriceAfterDiscount) ? number_format($finalPriceAfterDiscount, 2) : 0) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <p class="fw-bold mb-1">My Blinds & Shades</p>
                    <button id="addToCart" type="button" class="btn-primary btn custom w-100 py-md-2">
                        {{ !empty($isEditProduct) ? 'Update Cart' : 'Add to Cart' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="covidModal" tabindex="-1" aria-labelledby="covidModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0">
            <div class="modal-body">
                <div class="row gx-2 justify-content-between">
                    <div class="col-11">
                        <h4 class="font-secondary fw-bold text-secondary"><span class="text-primary">Covid 19</span>
                            Enhanced Safety Measures</h4>
                    </div>
                    <div class="col-1 text-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
                <hr class="mt-2" />
                <p>HeyBlinds is committed to the health and wellness of all our customers and employees. As a result
                    we have implemented enhanced preventative measures to ensure everyone we come in contact with
                    feels safe. </p>
                <p>We are adhering to the recommendations established by WHO, the Public Health Agency of Canada,
                    the CDC along with the federal and local governments.</p>
                <p>We are doing everything we can to practice safe distancing and working remotely when possible.
                </p>
                <h5 class="font-secondary fw-bold text-secondary  border-bottom pb-2">
                    It’s business as usual
                </h5>
                <p>That’s the beauty of online shopping. We are always open and available to help with any questions
                    or concerns you have. Call us at 888-412-3439 or chat with us online, during our service hours
                    of 8AM - 8PM Eastern Time, Monday - Friday. </p>

                <h5 class="font-secondary fw-bold text-secondary border-bottom pb-2">
                    Ordering and Delivery
                </h5>
                <p>Delivery times may vary due to Covid health and safety guidelines, including proper social
                    distancing between employees. Most orders are shipping on time, but certain orders may
                    experience a delay.</p>
                <p>You can view the status of your order at any time.</p>
                <p>
                    Please stay healthy and safe. <br />We appreciate your business and look forward to serving you.
                </p>

                <h6>The <span class="text-primary">HeyBlinds</span> Team</h6>
            </div>

        </div>
    </div>
</div>
</div>
