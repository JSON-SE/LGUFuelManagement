@extends('layouts.Frontend.app')
@section('head')
    <link rel="canonical" href="https://heyblinds.ca/reviews-of-HeyBlinds" />
    <meta name="robots" content="index, follow">
@endsection
@section('title')
    Customer Reviews & Ratings | HeyBlinds Canada
@endsection
@section('content')

    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 pt-2">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer Reviews</li>
            </ol>
        </nav>


    </section>

    <section id="body-content">
        <div class="container py-4 pb-xxl-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="text-center">

                        <div class="d-flex justify-content-center flex-wrap align-items-center">
                            <div class="px-3">
                                <a href="{{ route('welcome') }}" id="logo">
                                    <img src="{{ asset('images/logo.png') }}" alt="Hey Blindes logo">
                                </a>
                            </div>
                            <div class="py-2 px-3 total-product-review">

                                <div class="star-width mx-auto">
                                    <div class="progress">
                                        @php
                                            $rating_total_avg_percentage = (100 / 5) * $avgOfReviews;
                                        @endphp
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $rating_total_avg_percentage }}%;" aria-valuenow="25"
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
                                <h5 class="mb-0 ps-2 pt-3"><b>{{ number_format($avgOfReviews, 1) }}</b><small>/5
                                        ({{ $reviewsCount }} Reviews)</small></h5>
                            </div>
                        </div>

                        {{-- <h6 class="mb-3 pt-4 font-secondary">
                        Don't take our word for it, we've
                        got over 125,000 great reviews
                    </h6> --}}

                    </div>
                </div>

            </div>

            <h1 class="font-secondary fw-bold mt-3" style="font-size: 1.25rem">CUSTOMER REVIEWS</h1>
            <hr class="mb-0" />
            <div class="row">
                @if ($reviews->count() > 0)
                    @foreach ($reviews as $review)
                        <div class="col-lg-6 pt-3">
                            <div class="cart-box p-4 rounded" id="cartItem1769">
                                <div class="row">
                                    <div class="">
                                        <h6 class="mb-0 font-weight-bold fw-semibold">
                                            {{ ucfirst($review->title_review) }}
                                        </h6>
                                        <p class="mb-1 fw-semibold">
                                            {{ ucfirst($review->name) }} from {{ $review->city }},
                                            {{ $review->province }}&nbsp;{{ $review->created_at->format('M d, Y') }}
                                        </p>
                                        <div class="pb-2 d-flex">
                                            <div class="star-width">
                                                <div class="progress">
                                                    @php
                                                        $rating_avg = (100 / 5) * $review->rating_point;
                                                    @endphp
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $rating_avg }}%;" aria-valuenow="25"
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

                                        <div class="">
                                            <h6 class=" w-100 fst-italic text-break pt-3 review-text mb-0">
                                                “{{ $review->review }}”</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4 class="text-center">Data not found yet.</h4>
                @endif
            </div>
            <div class="mt-4 d-flex justify-content-center review-pagination">
                {{ $reviews->links() }}
            </div>

        </div>
    </section>

    @push('js')
        <script>
            $(function() {
                $('.review-text').each(function(event) {
                    var max_length = 130;
                    if ($(this).html().length > max_length) {
                        var short_content = $(this).html().substr(0, max_length);
                        var long_content = $(this).html().substr(max_length);

                        $(this).html(short_content +
                            '<span class="more_text" style="display:none;">' + long_content + '</span>' +
                            '<a href="#" class="read_more more-dot">...</a> <br/><a href="#" class="read_more small read-text-change">Read More</a>'
                        );

                        $(this).find('a.read_more').click(function(event) {
                            event.preventDefault();
                            // $(this).hide();
                            $(this).parents('.review-text').find('.more-dot').toggle();
                            $(this).parents('.review-text').find('.more_text').toggle();

                            var ReadLess = $(this).parents('.review-text').find('.read-text-change');

                            if (ReadLess.text() == 'Read More') {
                                ReadLess.text('Read Less');
                            } else {
                                ReadLess.text('Read More');
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
