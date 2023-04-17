@extends('layouts.Frontend.app')
@section('title')
    Customer Reviews & Ratings | HeyBlinds Canada
@endsection
@section('content')
    <section class="container">
        <nav aria-label="breadcrumb"
            style="--bs-breadcrumb-divider: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&quot;);">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}">
                        Home
                    </a>
                </li>
                <li aria-current="page" class="breadcrumb-item active">
                    Review
                </li>
            </ol>
        </nav>
        <div class="row pb-5 justify-content-center">
            <div class="col-lg-8">
                <h1 class="font-secondary pb-4 text-center" id="SiteReview" style="font-size: 1.25rem;">
                    Hey! Write a review to share your experience with HeyBlinds and our products.
                </h1>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-primary mx-sm-4 mx-1" href="#SiteReview">
                        Review Our Site
                    </a>
                    <a class="btn btn-primary mx-sm-4 mx-1" href="#ProductsReview">
                        Review Our Products
                    </a>
                </div>
                <div class="text-center p-lg-5 p-4 bg-white mt-5 shadow rounded">
                    <div>
                        <div>
                            <p class="heading-one">
                                Review our site
                            </p>
                            <p>
                                How did you like your shopping experience on HeyBlinds?
                            </p>
                            <p class="h5 font-secondary text-primary mt-5">
                                Overall Rating
                            </p>
                            <form method="POST" action="#" id="website_review">
                                <div class="mt-3" id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input class="rating__input rating__input--none" checked id="rating3-none"
                                            name="rating_point" type="radio" value="" />
                                        <label aria-label="1 star" class="rating__label" for="rating3-1">
                                            <svg class="bi bi-star-fill rating__icon rating__icon--star fa fa-star"
                                                fill="currentColor" height="35" viewbox="0 0 16 16" width="35"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                </path>
                                            </svg>
                                        </label>
                                        <input class="rating__input" id="rating3-1" name="rating_point" type="radio"
                                            value="1" />
                                        <label aria-label="2 stars" class="rating__label" for="rating3-2">
                                            <svg class="bi bi-star-fill rating__icon rating__icon--star fa fa-star"
                                                fill="currentColor" height="35" viewbox="0 0 16 16" width="35"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                </path>
                                            </svg>
                                        </label>
                                        <input class="rating__input" id="rating3-2" name="rating_point" type="radio"
                                            value="2" />
                                        <label aria-label="3 stars" class="rating__label" for="rating3-3">
                                            <svg class="bi bi-star-fill rating__icon rating__icon--star fa fa-star"
                                                fill="currentColor" height="35" viewbox="0 0 16 16" width="35"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                </path>
                                            </svg>
                                        </label>
                                        <input class="rating__input" id="rating3-3" name="rating_point" type="radio"
                                            value="3" />
                                        <label aria-label="4 stars" class="rating__label" for="rating3-4">
                                            <svg class="bi bi-star-fill rating__icon rating__icon--star fa fa-star"
                                                fill="currentColor" height="35" viewbox="0 0 16 16" width="35"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                </path>
                                            </svg>
                                        </label>
                                        <input class="rating__input" id="rating3-4" name="rating_point" type="radio"
                                            value="4" />
                                        <label aria-label="5 stars" class="rating__label" for="rating3-5">
                                            <svg class="bi bi-star-fill rating__icon rating__icon--star fa fa-star"
                                                fill="currentColor" height="35" viewbox="0 0 16 16" width="35"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                </path>
                                            </svg>
                                        </label>
                                        <input class="rating__input" id="rating3-5" name="rating_point" type="radio"
                                            value="5" />
                                    </div>
                                </div>
                                <div class="row gx-3 pt-4 text-start">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="title_review" name="title_review"
                                                placeholder="Title of Your Review" required type="text" />
                                            <label for="title_review">
                                                Title of Your Review
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="review"
                                                placeholder="Leave a comment here" style="height: 70px" required></textarea>
                                            <label for="Leave a comment here">
                                                Your Review
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-start pb-2">
                                        <div>
                                            <h6 class="d-inline-block fw-semibold">
                                                Name to show with your review
                                            </h6>
                                            <span class="position-relative ms-1 mousuhover-out">
                                                <span class="text-primary tooltip-hover question-icon mx-2">
                                                    <svg class="bi bi-question-circle-fill" fill="currentColor" height="16"
                                                        viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <div class="tooltip shadow">
                                                    <div class="tooltip-arrow">
                                                    </div>
                                                    <span class="close-tooltip btn-close btn">
                                                    </span>
                                                    <div class="tooltip-inner">
                                                        <div class="row g-2">
                                                            <div class="col-12">
                                                                <p>
                                                                    Most customers use their first name and the first
                                                                    initial of their last name.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="name" name="full_name" placeholder="Your Name"
                                                required type="text" />
                                            <label for="">
                                                Your Name
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="city" name="city" placeholder="Your City"
                                                type="text" required />
                                            <label for="city">
                                                Your City
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select aria-label="Floating label select" class="form-select required"
                                                id="province" name="province" required>
                                                <option value="">
                                                    ---
                                                </option>
                                                @foreach ($proviences as $provience)
                                                    <option value="{{ $provience->code }}">
                                                        {{ $provience->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="provience">
                                                Your Province
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 ">
                                            <input class="form-control" id="email" name="email"
                                                placeholder="Your Email Address" type="email" />
                                            <label class="text-nowrap w-100 overflow-hidden" for="">
                                                Your Email Address (not shown on site):
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="d-inline-block fw-semibold mb-1">
                                            <b>
                                                Anything else you’d like to share only with the HeyBlinds team?
                                            </b>
                                            (This won’t appear in your published review)
                                        </p>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="customer_suggestion"
                                                placeholder="Leave a comment here" style="height: 70px"></textarea>
                                            <label for="your_review">
                                                Note to HeyBlinds Team
                                            </label>

                                        </div>
                                    </div>
                                    <div class="col-12 mt-4" id="ProductsReview">
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary px-5" type="submit">
                                            <span class="py-1 d-inline-block">
                                                Share My Review With The World
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr class="my-4" />
                <div class="text-center p-lg-5 p-4 bg-white shadow rounded">
                    <div>
                        <div class="">
                            <p class="heading-one">
                                Review Our Products
                            </p>
                            <p>
                                Which product would you like to review?
                            </p>
                            <div>
                                <div class="row product-review-box">
                                    @foreach ($products as $key => $product)
                                        <div class="text-center mb-3 shadow-sm col-lg-3 col-md-4 col-sm-6">
                                            <div class="radio check-position py-3">
                                                <input data-id="{{ $key + 1 }}" data-mapper="1"
                                                    id="subcategory-id-{{ $key + 1 }}" class="subcategory"
                                                    name="sub_category" type="radio"
                                                    value="{{ $product->subcategory->id }}" />
                                                <label class="radio-label colorchange sample_review_scroll"
                                                    for="subcategory-id-{{ $key + 1 }}">
                                                    <div class="sample-color-img rounded">
                                                        <img alt="Heyblinds-review-{{ $product->name ?? '' }}"
                                                        class="rounded"
                                                        src="{{ $helpers->getImage($product->display_media_id) }}" />
                                                    </div>
                                                    <p class="fw-bold mt-2 mb-0 text-uppercase text-break">
                                                        {{ $product->subcategory->name ?? ' ' }}
                                                    </p>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div id="productReview_scroll">
                                <div class="accordion review-accordion product_review_form" id="accordionSubcatory">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            function tooltip() {
                $('.mousuhover-out').mouseenter(function() {
                    $('.tooltip').removeClass('show');
                    var $this = $(this).children('.tooltip');
                    $this.addClass('show');
                    var rt = ($(window).width() - ($this.offset().left + $this.outerWidth()));
                    if (rt > 1) {
                        $this.css({
                            "left": 'auto',
                            "right": '90%',
                        })
                    }
                    if ($this.offset().left < 1) {
                        $this.css({
                            "left": '90%',
                            "right": 'auto',
                        })
                    }

                });
                var $tooltipHoverOut = $('.tooltip-hover').parents('.position-relative');
                $('.mousuhover-out').mouseleave(function() {
                    $('.tooltip').removeClass('show');
                });
            }

            $(document).on('submit', '#website_review', function(e) {
                e.preventDefault();
                let $this = $(this);
                let formData = $this.serialize();
                axios.post('{{ route('frontend.review.store') }}', formData)
                    .then((response) => {
                        if (response.data.status == true) {
                            Swal.fire({
                                text: response.data.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            document.getElementById("website_review").reset();
                        }
                    })
                    .catch((error) => {
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.options = {
                                "positionClass": "toast-bottom-center",
                            }
                            toastr.error(value)
                        })
                    })
            })
            $(document).on('click', '.subcategory', function(e) {
                var subcategory_id = $(this).val();
                axios.get(`/review/${subcategory_id}`)
                    .then((response) => {
                        if (response.data.status === true) {
                            $('.product_review_form').html(' ');
                            $.each(response.data.products, function(key, val) {
                                $('.product_review_form').append(`<div class="accordion-item mt-2">
                                <h2 class="accordion-header" id="${'heading'+key}">
                                <button aria-controls="${'collapse'+key}" aria-expanded="false" class="accordion-button collapsed sample-page-btn accordion-button-collapsed" data-bs-target="${'#collapse'+key}" data-bs-toggle="collapse" type="button">
                                    <span class="d-flex align-items-center justify-content-center small">
                                        Review
                                    </span>
                                    ${val.name}
                                </button>
                        </h2>
                            <div aria-labelledby="${'heading'+key}" class="accordion-collapse collapse border-0" data-bs-parent="#accordionSubcatory" id=${'collapse'+key}>
                                <form action="#" method="post" id="prduct_review" class="prduct_review">
                                <input type="hidden" name="product_id" value="${val.id}">
                                <input type="hidden" name="form_id" class="form_id" id="form_id" value="${key}">
                                <div class="py-2 ">
                                    <div class="">
                                        <h5 class="font-secondary">
                                            Your are reviewing:
                                            <span class="fw-semibold">
                                                ${val.name}
                                            </span>
                                        </h5>
                                        <p class="h5 font-secondary text-primary mt-4">
                                            Overall Rating
                                        </p>
                                        <div class="mt-3" id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input  class="rating__input rating__input--none" checked  id="p2-rating3-none" name="rating_point" type="radio" value=""/>
                                                <label aria-label="1 star" class="rating__label" for="p2-rating3-1${key}">
                                                    <svg class="bi bi-star-fill rating__icon rating__icon--star fa fa-star" fill="currentColor" height="35" viewbox="0 0 16 16" width="35" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                        </path>
                                                    </svg>
                                                </label>
                                                <input class="rating__input" id="p2-rating3-1${key}" name="rating_point" type="radio" value="1"/>
                                                <label aria-label="2 stars" class="rating__label" for="p2-rating3-2${key}">
                                                    <svg class="bi bi-star-fill rating__icon rating__icon--star fa fa-star" fill="currentColor" height="35" viewbox="0 0 16 16" width="35" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                        </path>
                                                    </svg>
                                                </label>
                                                <input class="rating__input" id="p2-rating3-2${key}" name="rating_point" type="radio" value="2"/>
                                                <label aria-label="3 stars" class="rating__label" for="p2-rating3-3${key}">
                                                    <svg class="bi bi-star-fill rating__icon rating__icon--star fa fa-star" fill="currentColor" height="35" viewbox="0 0 16 16" width="35" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                        </path>
                                                    </svg>
                                                </label>
                                                <input class="rating__input" id="p2-rating3-3${key}" name="rating_point" type="radio" value="3"/>
                                                <label aria-label="4 stars" class="rating__label" for="p2-rating3-4${key}">
                                                    <svg class="bi bi-star-fill rating__icon rating__icon--star fa fa-star" fill="currentColor" height="35" viewbox="0 0 16 16" width="35" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                        </path>
                                                    </svg>
                                                </label>
                                                <input class="rating__input" id="p2-rating3-4${key}" name="rating_point" type="radio" value="4"/>
                                                <label aria-label="5 stars" class="rating__label" for="p2-rating3-5${key}">
                                                    <svg class="bi bi-star-fill rating__icon rating__icon--star fa fa-star" fill="currentColor" height="35" viewbox="0 0 16 16" width="35" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                        </path>
                                                    </svg>
                                                </label>
                                                <input class="rating__input" id="p2-rating3-5${key}" name="rating_point" type="radio" value="5"/>
                                            </div>
                                        </div>
                                        <div class="row gx-3 pt-4 text-start">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="title_review" name="title_review" placeholder="Title of Your Review" required type="text"/>
                                                    <label for="">
                                                        Title of Your Review
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" name="review" required placeholder="Leave a comment here" style="height: 70px"></textarea>
                                                    <label for="review">
                                                        Your Review
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 text-start pb-2">
                                                <div>
                                                    <h6 class="d-inline-block fw-semibold">
                                                        Name to show with your review
                                                    </h6>
                                                    <span class="position-relative ms-1  mousuhover-out">
                                                        <span class="text-primary tooltip-hover question-icon mx-2">
                                                            <svg class="bi bi-question-circle-fill" fill="currentColor" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                        <div class="tooltip shadow">
                                                            <div class="tooltip-arrow">
                                                            </div>
                                                            <span class="close-tooltip btn-close btn">
                                                            </span>
                                                            <div class="tooltip-inner">
                                                                <div class="row g-2">
                                                                    <div class="col-12">
                                                                        <p>
                                                                            Most customers use their first name and the first initial of their last name.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="full_name" required name="full_name" placeholder="Your Name" type="text"/>
                                                    <label for="full_name">
                                                        Your Name
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="city" required name="city" placeholder="Your City" type="text"/>
                                                    <label for="city">
                                                        Your City
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <select aria-label="Floating label select" class="form-select required" id="province" name="province" required="">
                                                        <option value="">
                                                            --
                                                        </option>
                                                        @foreach ($proviences as $provience)
                                                            <option value="{{ $provience->code }}">
                                                                {{ $provience->code }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    <label for="provience">
                                                        Your Province
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="email" name="email" required
                                                        placeholder="Your Email Address" type="email" />
                                                    <label class="text-nowrap w-100 overflow-hidden" for="">
                                                        Your Email Address (not shown on site):
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p class="d-inline-block fw-semibold mb-1">
                                                    <b>
                                                        Anything else you’d like to share only with the HeyBlinds team?
                                                    </b>
                                                    (This won’t appear in your published review)
                                                </p>
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" name="customer_suggestion"
                                                        placeholder="Leave a comment here" style="height: 70px"></textarea>
                                                    <label for="your_review">
                                                        Note to HeyBlinds Team
                                                    </label>

                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-primary px-5" type="submit">
                                                    <span class="py-1 d-inline-block">
                                                        Share My Review With The World
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>`);
                            })
                        }
                        tooltip();
                        $('html,body').animate({
                            scrollTop: $('#productReview_scroll').offset().top - 120
                        }, 200);
                    })
            })
            $(document).on('submit', '.prduct_review', function(e) {
                // var that = this;
                e.preventDefault();
                let $this = $(this);
                let formData = $this.serialize();
                console.log(formData);
                axios.post('/product-form-review', formData).then((response) => {
                        if (response.data.status == true) {
                            Swal.fire({
                                text: response.data.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            this.reset();
                        }
                    })
                    .catch((error) => {
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.options = {
                                "positionClass": "toast-bottom-center",
                            }
                            toastr.error(value)
                        })
                    })
            })
        </script>

    @endpush
@endsection
