@extends('layouts.Frontend.app')
@section('title')
    Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada
@endsection
@section('content')

<section id="body-content">

    <form method="post" action="{{ url('testing') }}" id="addtocart" >

        <div class="container pt-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Super Value Vinyl Blackout Roller Shades</li>
                </ol>
            </nav>

            <div class="row pt-2 align-items-center">
                <div class="col-lg-6">
                    <div class="product-slider">
                        <div class="product-slider-image">
                            <img src="assets/images/product-image.jpg" alt="" />
                        </div>

                        <div class="product-slider-image">
                            <img src="assets/images/product-image3.jpg" alt="" />
                        </div>
                        <div class="product-slider-image">
                            <img src="assets/images/product-image2.jpg" alt="" />
                        </div>
                        <div class="product-slider-image">
                            <img src="assets/images/category-product.jpg" alt="" />
                        </div>
                        <div class="product-slider-image">
                            <img src="assets/images/category-product2.jpg" alt="" />
                        </div>

                    </div>
                    <div class="row pt-2">
                        <div class="col-9 col-md-10">
                            <div class="product-slider-nav">
                                <div>
                                    <div class="nav-slider-image">
                                        <img src="assets/images/product-image.jpg" alt="" />
                                    </div>
                                </div>

                                <div>
                                    <div class="nav-slider-image">
                                        <img src="assets/images/product-image3.jpg" alt="" />
                                    </div>
                                </div>
                                <div>
                                    <div class="nav-slider-image">
                                        <img src="assets/images/product-image2.jpg" alt="" />
                                    </div>
                                </div>
                                <div>
                                    <div class="nav-slider-image">
                                        <img src="assets/images/category-product.jpg" alt="" />
                                    </div>
                                </div>
                                <div>
                                    <div class="nav-slider-image">
                                        <img src="assets/images/category-product2.jpg" alt="" />
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-3 col-md-2 ps-0">
                            <button class="btn rounded-3 btn-outline-primary w-100 h-100 video-btn">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-play-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M11.596 8.697l-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                                    </svg>
                                </span>
                                Video
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 pt-3 pt-lg-0">
                    <h2 class="product-details-text pe-5">Super Value Vinyl Blackout
                        Roller Shades</h2>
                    <div class="row g-3 pt-md-3">
                        <div class="col-sm-8">
                            <p>NEWLY REDESIGNED! One of our top-selling cellular shades has been redesigned to include
                                more colours, a larger 3/4" pleat size, and a colour-coordinated metal headrail! Our
                                upgraded Value Cordless <a href="#"> More</a></p>
                            <h5 class="details-guarantee-text fst-italic pt-sm-3"><span><span>100</span> Day </span> ‘I
                                <span class="heard-icon text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                </span> My Blinds’ Guarantee</h5>
                        </div>
                        <div class="col-sm-4 text-center text-left">
                            <div class="bg-light p-3 rounded product-details-price-box">
                                <h5 class="fw-light text-decoration-line-through">$56.66</h5>
                                <h4 class="fw-bold">You Save 25%</h4>
                                <h3 class="text-primary fw-bold mb-0">$ 46.74</h3>
                            </div>
                        </div>

                    </div>
                    <div class="row align-items-end pt-4 text-md-start text-center">
                        <div class="col-sm-8">
                            <a href="#product-option" class="btn btn-primary custom">
                                Choose Your Colour / Get Free Samples
                            </a>
                        </div>
                        <div class="col-sm-4 pt-2 pt-ms-0 text-md-end text-center">
                            <h4 class="product-details-shipping-text fw-bold">
                                <span class=" text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                        </path>
                                    </svg>
                                </span>
                                Free Shipping</h4>
                            <div class="star-width d-inline-block">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 73%;" aria-valuenow="25"
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
                            <p class="mb-0"><b>4.4</b> (819 reviews)</p>
                        </div>
                    </div>
                </div>
            </div>


            <hr class="my-3" />


            <div id="product-option">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item mt-3">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button accordion-button-collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                <span class="d-flex align-items-center justify-content-center">
                                    <img src="assets/images/tick.png" alt="" />
                                </span> Select Colour
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show border-0"
                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body py-2 shadow-sm">
                                <h6 class="accodin-heading">For a true colour comparison, please order a free sample
                                    <span class="ps-2 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </span>
                                </h6>
                                <hr class="my-2" />
                                <div class="color-section row pb-2">
                                    <div class="col-md-4 color-sidedar-fixd">

                                        <div class="color-sidedar rounded bg-light p-3">
                                            <div class="color-sidedar-big-image shadow-sm rounded">
                                                <img class="select-color-big-show rounded" class="rounded"
                                                    src="assets/images/sample-image.jpg" alt="" />
                                            </div>
                                            <div class="row g-3 pt-3">
                                                <div class="col-6">
                                                    <div class="color-sidedar-small-image shadow-sm rounded">
                                                        <img class="rounded select-color-small-show"
                                                            src="assets/images/sample-image.jpg" alt="" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <p class="select-color-text">
                                                        <span> Select your colour </span><br />
                                                        <b>Need to Select</b>
                                                    </p>

                                                    <button class=" btn btn-outline-primary btn-sm sample-btn-display">
                                                        Sample Selected
                                                    </button>

                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-md-8 select-colour-items">
                                        <div class="select-colour d-flex flex-wrap">
                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-3" name="radio" value="Perfect White" type="radio">
                                                    <label for="sample-color-3" href="assets/images/silver-grey.svg"
                                                        src="assets/images/image-white.png" value="Perfect White"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/silver-grey.svg"
                                                                alt="" />
                                                        </div>
                                                        <p class="my-1">Perfect White</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-4" name="radio" type="radio"  value="Blue">
                                                    <label for="sample-color-4" href="assets/images/blue.svg"
                                                        src="assets/images/image-blue.png" value="Blue"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/blue.svg" alt="" />
                                                        </div>
                                                        <p class="my-1">Blue</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>


                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-5" name="radio" type="radio" value="Natural" >
                                                    <label for="sample-color-5" href="assets/images/natural.svg"
                                                        src="assets/images/image-fabric1.png" value="Natural"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/natural.svg"
                                                                alt="" />
                                                        </div>
                                                        <p class="my-1">Natural</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-6" name="radio" type="radio"   value="Perfect White" >
                                                    <label for="sample-color-6" href="assets/images/pink.svg"
                                                        src="assets/images/image-fabric2.png" value="Perfect White"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/pink.svg" alt="" />
                                                        </div>
                                                        <p class="my-1">Perfect White</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>



                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-7" name="radio" type="radio" value="Green">
                                                    <label for="sample-color-7" href="assets/images/green.svg"
                                                        src="assets/images/image-fabric3.png" value="Green"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/green.svg" alt="" />
                                                        </div>
                                                        <p class="my-1">Green</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-8" name="radio" type="radio" value="Yellow Gold" >
                                                    <label for="sample-color-8" href="assets/images/yellow-gold.svg"
                                                        src="assets/images/image-fabric4.png" value="Yellow Gold"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/yellow-gold.svg"
                                                                alt="" />
                                                        </div>
                                                        <p class="my-1">Yellow Gold</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>




                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-9" name="radio" type="radio" value="Perfect White" >
                                                    <label for="sample-color-9" href="assets/images/silver-grey.svg"
                                                        src="assets/images/image-white.png" value="Perfect White"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/silver-grey.svg"
                                                                alt="" />
                                                        </div>
                                                        <p class="my-1">Perfect White</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-10" name="radio" type="radio" value="Blue" >
                                                    <label for="sample-color-10" href="assets/images/blue.svg"
                                                        src="assets/images/image-blue.png" value="Blue"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/blue.svg" alt="" />
                                                        </div>
                                                        <p class="my-1">Blue</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-11" name="radio" type="radio" value="Natural">
                                                    <label for="sample-color-11" href="assets/images/natural.svg"
                                                        src="assets/images/image-natural.png" value="Natural"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/natural.svg"
                                                                alt="" />
                                                        </div>
                                                        <p class="my-1">Natural</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-12" name="radio" type="radio" value="Perfect White" >
                                                    <label for="sample-color-12" href="assets/images/pink.svg"
                                                        src="assets/images/image-white.png" value="Perfect White"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/pink.svg" alt="" />
                                                        </div>
                                                        <p class="my-1">Perfect White</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-13" name="radio" type="radio" value="Green" >
                                                    <label for="sample-color-13" href="assets/images/green.svg"
                                                        src="assets/images/image-blue.png" value="Green"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/green.svg" alt="" />
                                                        </div>
                                                        <p class="my-1">Green</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-14" name="radio" type="radio" value="Yellow Gold" >
                                                    <label for="sample-color-14" href="assets/images/yellow-gold.svg"
                                                        src="assets/images/image-natural.png" value="Yellow Gold"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/yellow-gold.svg"
                                                                alt="" />
                                                        </div>
                                                        <p class="my-1">Yellow Gold</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-15" name="radio" type="radio" value="Perfect White" >
                                                    <label for="sample-color-15" href="assets/images/silver-grey.svg"
                                                        src="assets/images/image-white.png" value="Perfect White"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/silver-grey.svg"
                                                                alt="" />
                                                        </div>
                                                        <p class="my-1">Perfect White</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-16" name="radio" type="radio" value="Blue" >
                                                    <label for="sample-color-16" href="assets/images/blue.svg"
                                                        src="assets/images/image-blue.png" value="Blue"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/blue.svg" alt="" />
                                                        </div>
                                                        <p class="my-1">Blue</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>


                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-17" name="radio" type="radio" value="Natural" >
                                                    <label for="sample-color-17" href="assets/images/natural.svg"
                                                        src="assets/images/image-natural.png" value="Natural"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/natural.svg"
                                                                alt="" />
                                                        </div>
                                                        <p class="my-1">Natural</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>



                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-18" name="radio" type="radio" value="Perfect White" >
                                                    <label for="sample-color-18" href="assets/images/pink.svg"
                                                        src="assets/images/image-white.png" value="Perfect White"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/pink.svg" alt="" />
                                                        </div>
                                                        <p class="my-1">Perfect White</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>



                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-19" name="radio" type="radio" value="Green">
                                                    <label for="sample-color-19" href="assets/images/green.svg"
                                                        src="assets/images/image-natural.png" value="Green"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/green.svg" alt="" />
                                                        </div>
                                                        <p class="my-1">Green</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>



                                            <div class="sample-color-box text-center shadow-sm">
                                                <div class="radio check-position">
                                                    <input id="sample-color-20" name="radio" type="radio" value="Yelow Gold Last">
                                                    <label for="sample-color-20" href="assets/images/yellow-gold.svg"
                                                        src="assets/images/image-blue.png" value="Yellow Gold"
                                                        class="radio-label colorchange">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded" src="assets/images/yellow-gold.svg"
                                                                alt="" />
                                                        </div>
                                                        <p class="my-1">Yellow Gold</p>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Sample Selected
                                                </button>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mt-3">
                        <h2 class="accordion-header" id="headingTwo">

                            <button class="accordion-button collapsed justify-content-between" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                <span class="d-flex align-items-center justify-content-center">
                                    <img src="assets/images/tick.png" alt="" />
                                </span>
                                <div>Select Size, Mount Type & Quantity</div>

                                <div class="ms-auto d-none d-md-block">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                                    </svg>
                                    W 24 "
                                    <svg class="ms-4 me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                    </svg> H 36 "</div>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse border-0" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body py-2 shadow-sm">
                                <h6 class="accodin-heading">For a true colour comparison, please order a free sample
                                    <span class="ps-2  text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </span>
                                </h6>
                                <hr class="my-2" />
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="row pt-2">
                                            <div class="col-sm-6 col-lg-5">
                                                <div class="width-graphic-image">
                                                    <img src="assets/images/width-graphic.jpg" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-12">
                                                        <h5
                                                            class="border-start border-primary border-4 px-2 label-aria-text">
                                                            Width:</h5>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating width-select-fild">
                                                            <select class="form-select" id="floatingSelectGrid" name="width"
                                                                aria-label="Floating label select example">
                                                                <option selected value="10">10</option>
                                                                <option value="20">20</option>
                                                                <option value="30">30</option>
                                                                <option value="40">40</option>
                                                                <option value="50">50</option>
                                                            </select>
                                                            <label for="floatingSelectGrid">Inches</label>
                                                        </div>


                                                    </div>

                                                    <div class="col">
                                                        <div class="form-floating width-select-fild">
                                                            <select class="form-select" id="floatingSelectGrid" name="with_fractions"
                                                                aria-label="Floating label select example">
                                                                <option selected value="1">0/0</option>
                                                                <option value="2">1/2</option>
                                                                <option value="3">1/5</option>
                                                                <option value="4">1/8</option>
                                                                <option value="5">1/9 </option>
                                                            </select>
                                                            <label for="floatingSelectGrid">Fractions</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="ruler-slider pt-2">
                                                    <input class="#range" type="range">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-1 d-none d-lg-block"></div>
                                    <div class="col-lg-5 col-md-6">
                                        <div class="row pt-2">
                                            <div class="col-sm-6 col-lg-5">
                                                <div class="width-graphic-image">
                                                    <img src="assets/images/height-graphic.jpg" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-12">
                                                        <h5
                                                            class="border-start border-primary border-4 px-2 label-aria-text">
                                                            Height:</h5>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating width-select-fild">
                                                            <select class="form-select" id="floatingSelectGrid" name="height"
                                                                aria-label="Floating label select example">
                                                                <option selected value="10">10</option>
                                                                <option value="20">20</option>
                                                                <option value="30">30</option>
                                                                <option value="40">40</option>
                                                                <option value="50">50</option>
                                                            </select>
                                                            <label for="floatingSelectGrid">Inches</label>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-floating width-select-fild">
                                                            <select class="form-select" id="floatingSelectGrid" name="height_fractions"
                                                                aria-label="Floating label select example">
                                                                <option selected value="1">0/0</option>
                                                                <option value="2">1/2</option>
                                                                <option value="3">1/5</option>
                                                                <option value="4">1/8</option>
                                                                <option value="5">1/9 </option>
                                                            </select>
                                                            <label for="floatingSelectGrid">Fractions</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="ruler-slider pt-2">
                                                    <input class="#range" type="range">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <h6 class="accodin-heading pt-3">Mount Type
                                    <span class="ps-2  text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </span>
                                </h6>
                                <hr class="my-2" />

                                <div class="d-flex flex-wrap">
                                    <div class="sample-side-box">
                                        <div class="radio check-position">
                                            <input id="sample-side-2" name="radio" type="radio">
                                            <label for="sample-side-2" class="radio-label">
                                                <div class="sample-side-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/inside-image.jpg" alt="" />
                                                </div>
                                                <h5 class="mt-2 mb-0 font-secondary fw-bold">Inside</h5>
                                            </label>
                                        </div>

                                    </div>

                                    <div class="sample-side-box">
                                        <div class="radio check-position">
                                            <input id="sample-side-3" name="radio" type="radio">
                                            <label for="sample-side-3" class="radio-label">
                                                <div class="sample-side-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/outside-image.jpg" alt="" />
                                                </div>
                                                <h5 class="mt-2 mb-0 font-secondary fw-bold">Outside</h5>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row pb-2">
                                    <div class="col-sm-6">
                                        <h6 class="accodin-heading pt-3">Quantity
                                            <span class="ps-2  text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-question-circle-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                                </svg>
                                            </span>
                                        </h6>
                                        <hr class="my-2" />
                                        <div class="row pt-2">
                                            <div class="col-lg-6">
                                                <div class="quantity">

                                                    <input class="count form-control pe-5" type="text" id="1" value="1"
                                                        min="1" max="100" />
                                                    <button type="button" id="add" class="add">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-caret-up-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                                                        </svg>
                                                    </button>
                                                    <button type="button" id="sub" class="sub">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-caret-down-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <h6 class="accodin-heading pt-3">Room Name
                                            <span class="ps-2  text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-question-circle-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                                </svg>
                                            </span>
                                        </h6>
                                        <hr class="my-2" />

                                        <div class="row pt-2">
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" placeholder="Enter Room Name">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="accordion-item mt-3">
                        <h2 class="accordion-header" id="features">
                            <button class="accordion-button collapsed justify-content-between" type="button"
                                data-bs-toggle="collapse" data-bs-target="#features-accordion" aria-expanded="false"
                                aria-controls="features-accordion">
                                <span class="d-flex align-items-center justify-content-center">
                                    <img src="assets/images/tick.png" alt="" />
                                </span>
                                <div>Select Your Features</div>
                            </button>
                        </h2>
                        <div id="features-accordion" class="accordion-collapse collapse border-0"
                            aria-labelledby="features" data-bs-parent="#accordionExample">
                            <div class="accordion-body py-2 shadow-sm">

                                <h6 class="accodin-heading pt-3">Easy Lift Systems
                                    <span class="ps-2  text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </span>
                                </h6>
                                <hr class="my-2" />

                                <div class="d-flex flex-wrap">
                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-2" name="radio" type="radio">
                                            <label for="sample-features-2" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-1.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">Cordless Lift
                                                    <br />
                                                    <b>Free</b>
                                                </p>

                                            </label>
                                        </div>

                                    </div>

                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-3" name="radio" type="radio">
                                            <label for="sample-features-3" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-2.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">Cordless Lift
                                                    <br />
                                                    <b>Free</b>
                                                </p>

                                            </label>
                                        </div>

                                    </div>


                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-4" name="radio" type="radio">
                                            <label for="sample-features-4" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-3.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">Cordless Lift
                                                    <br />
                                                    <b>Free</b>
                                                </p>

                                            </label>
                                        </div>

                                    </div>

                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-5" name="radio" type="radio">
                                            <label for="sample-features-5" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-4.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">Cordless Lift
                                                    <br />
                                                    <b>Free</b>
                                                </p>

                                            </label>
                                        </div>

                                    </div>


                                </div>


                                <h6 class="accodin-heading pt-3">Headrail Options
                                    <span class="ps-2  text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </span>
                                </h6>
                                <hr class="my-2" />

                                <div class="d-flex flex-wrap">

                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-6" name="radio" type="radio">
                                            <label for="sample-features-6" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-5.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">Standard Headrail
                                                    <br />
                                                    <b>Free</b>
                                                </p>

                                            </label>
                                        </div>

                                    </div>

                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-7" name="radio" type="radio">
                                            <label for="sample-features-7" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-6.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">Cordless Lift
                                                    <br />
                                                    <b>Free</b>
                                                </p>

                                            </label>
                                        </div>

                                    </div>


                                </div>

                                <h6 class="accodin-heading pt-3">Valance
                                    <span class="ps-2  text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </span>
                                </h6>
                                <hr class="my-2" />

                                <div class="d-flex flex-wrap">

                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-8" name="radio" type="radio">
                                            <label for="sample-features-8" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-7.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">6" Valance</p>

                                            </label>
                                        </div>

                                    </div>

                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-9" name="radio" type="radio">
                                            <label for="sample-features-9" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-7.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">No Valance</p>

                                            </label>
                                        </div>

                                    </div>


                                </div>


                                <h6 class="accodin-heading pt-3">Bottom Trim
                                    <span class="ps-2  text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </span>
                                </h6>
                                <hr class="my-2" />

                                <div class="d-flex flex-wrap">

                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-10" name="radio" type="radio">
                                            <label for="sample-features-10" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-8.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">No Trim
                                                    <br />
                                                    <b>Free</b>
                                                </p>

                                            </label>
                                        </div>

                                    </div>

                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-11" name="radio" type="radio">
                                            <label for="sample-features-11" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-8.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">Flax Trim
                                                    <br />
                                                    <b>$111.32</b>
                                                </p>

                                            </label>
                                        </div>

                                    </div>

                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-12" name="radio" type="radio">
                                            <label for="sample-features-12" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-9.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">No Trim
                                                    <br />
                                                    <b>$111.32</b>
                                                </p>

                                            </label>
                                        </div>

                                    </div>

                                    <div class="sample-features-box">
                                        <div class="radio check-position">
                                            <input id="sample-features-13" name="radio" type="radio">
                                            <label for="sample-features-13" class="radio-label">
                                                <div class="sample-features-img rounded bg-dark">
                                                    <img class="rounded" src="assets/images/features-9.jpg" alt="" />
                                                </div>
                                                <p class="mt-2 mb-0">No Trim
                                                    <br />
                                                    <b>$111.32</b>
                                                </p>

                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mt-3">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <span class="d-flex align-items-center justify-content-center">
                                    <img src="assets/images/tick.png" alt="" />
                                </span>
                                <div>Select Warranty Options</div>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse border-0"
                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body py-2 shadow-sm">
                                <h6 class="accodin-heading pt-3">Warranty Options
                                    <span class="ps-2  text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </span>
                                </h6>
                                <hr class="my-2" />
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-auto">
                                        <img src="assets/images/warranty-image.png" alt="" />
                                    </div>

                                    <div class="col-sm-8 col-lg-5 col-md-6 col-xl-4">
                                        <!-- <div class="row align-items-center">
                                        <div class="col-9">
                                            <div class="radio">
                                                <input id="radio-1" name="radio" type="radio" checked>
                                                <label for="radio-1" class="radio-label">3-Year Limited Warranty
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <h6 class="mb-0 font-secondary text-primary fw-bold">FREE</h6>
                                        </div>

                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <div class="radio">
                                                <input id="radio-2" name="radio" type="radio">
                                                <label for="radio-2" class="radio-label">5-Year Limited
                                                    Warranty</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <h6 class="mb-0 font-secondary text-primary fw-bold">$6.00</h6>
                                        </div>

                                    </div> -->

                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="radio">
                                                    <input id="radio-3" name="radio" type="radio" checked>
                                                    <label for="radio-3" class="radio-label"><span
                                                            class="cross-text pe-1">5</span> 7-Years Unlimited
                                                        Warranty</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <h5 class="mb-0 font-secondary text-primary fw-bold">
                                                    <small
                                                        class="h6 text-decoration-line-through text-dark pe-2">$25.00</small>FREE
                                                </h5>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div id="product-details-nav-section" class="pt-4">



                <ul class="nav product-details-nav nav-tabs" id="myTab " role="tablist">

                    <li class="nav-item" role="presentation">


                        <a class="nav-link order-sample-btn" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                            aria-controls="collapseOne" href="#product-option">Order Free
                            Samples</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Product
                            Information</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Measure & Install
                            Guide</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">Shipping &
                            Production</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">Warranty</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">Reviews</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">Customer
                            Photos</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="py-3 text-dark">
                            <p class="heading-two">Product Information</p>
                            <hr />
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="font-secondary">Description </h5>
                                    <p class="fst-italic">
                                        NEWLY REDESIGNED! One of our top-selling cellular shades has been redesigned to
                                        include
                                        more colours, a larger 3/4" pleat size, and a colour-coordinated metal headrail!
                                    </p>
                                    <p>
                                        Our upgraded Value Cordless Light Filtering Honeycomb Shade offers the ultimate
                                        in
                                        quality, durable window coverings at the best value in the market. Unlike many
                                        other
                                        retailers who offer cut-down product, the Select Blinds shades are custom made
                                        to
                                        your
                                        exact measurements for a perfect fit you will enjoy for years! Made from 100%
                                        polyester
                                        energy-efficient material, these shades will help keep you cool in the summer
                                        and
                                        warm
                                        in the winter, while saving you money on your energy bills.
                                    </p>
                                    <p>
                                        These shades come in stylish, new neutral colours with a sturdy
                                        colour-coordinated
                                        metal
                                        headrail and bottom rail. The 100% polyester material is durable with
                                        energy-efficient
                                        single-cell construction, which provides insulation and keeps your home cooler
                                        in
                                        the
                                        summer and warmer in the winter. And unlike cut-down shades in the market, the
                                        Select
                                        Blinds shades are custom cut to your specific measurements, so you get a top
                                        quality,
                                        perfect fit, two-in-one shade, at a price you can afford!
                                    </p>

                                    <h5 class="font-secondary">Recommendations and Limitations</h5>
                                    <ul class="list-items">
                                        <li>
                                            Built-in cordless lift system
                                        </li>
                                        <li>
                                            Made from durable 100% polyester fabric
                                        </li>
                                        <li>
                                            Contemporary 3/4” pleats
                                        </li>
                                        <li>
                                            Single-cell construction offers energy efficiency
                                        </li>
                                        <li>
                                            Popular neutral colours
                                        </li>
                                        <li>
                                            Metal headrail and bottom rail colour coordinated with fabric
                                        </li>
                                    </ul>

                                </div>
                                <div class="col-md-6 pt-3 pt-md-0">
                                    <h5 class="font-secondary">Recommendations and Limitations </h5>

                                    <ul class="list-items">
                                        <li>
                                            Back side of shade is white.
                                        </li>
                                        <li>
                                            Inside mount: 1/4" headrail deduction and 3/8" fabric deduction taken at the
                                            factory. No deductions to headrail or fabric on outside mount.
                                        </li>
                                        <li>
                                            Spacer blocks, extension brackets, hold down brackets, and side mount
                                            brackets
                                            are not available.
                                        </li>
                                    </ul>
                                    <div class="shadow rounded mt-4">
                                        <div class="table-heading text-white p-3">
                                            <h5 class="mb-0">Specifications and Installation</h5>
                                        </div>
                                        <div class="p-3">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>Width</td>
                                                        <td>13" - 84"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Height</td>
                                                        <td>12" - 84"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Min inside-mount depth</td>
                                                        <td>3/4”</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Min flush-mount depth</td>
                                                        <td>2 1/8"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Min outside-mount space</td>
                                                        <td>1 1/2"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Headrail dimensions</td>
                                                        <td>1 7/8" D x 1 1/8" H</td>
                                                    </tr>

                                                </tbody>
                                            </table>



                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="py-5 text-dark">

                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="py-5 text-dark"></div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row justify-content-end py-xxl-3 py-1 product-cart-height mb-3 position-relative">
                <div id="product-cart-box" class="col-lg-10 col-xl-7 product-cart-box">
                    <div
                        class="rounded  shadow bg-white px-3 product-cart-padding-y border-bottom border-3 border-primary text-dark">
                        <div class="row py-1 align-items-center">
                            <div class="col-sm-8">
                                <div class="row align-items-center">
                                    <div class="col-7">
                                        <p class="mb-1">My Samples Cart</p>
                                    </div>
                                    <div class="col-5 text-end">
                                        <p class="mb-1">Your Price:
                                            <span class="text-primary ps-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-question-circle-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                                </svg>
                                            </span>
                                        </p>
                                    </div>

                                </div>

                                <div class="row align-items-center">
                                    <div class="col-7">
                                        <p class="fw-bold mb-0">0 Free Samples in cart</p>
                                    </div>
                                    <div class="col-5 text-end">
                                        <h5 class="text-primary font-secondary fw-bold mb-0">$46.74</h5>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <button type="submit" class="btn-primary btn custom w-100 py-md-2">
                                    Add to Cart
                                </button>
                            </div>

                        </div>


                    </div>

                </div>

            </div>
        </div>

    </form>

</section>


@endsection

<script>

    $("#addtocart").submit(function( event ) {
        event.preventDefault();
        alert( "Handler for .submit() called." );
    });

    url = "{{ url('/cart')}}";

    function cartItemUpdate(id){

        var entry_id = id;
        var note = $("#note"+entry_id).val();
        var room = $("#room"+entry_id).val();
        var quantity = $("#quantity"+entry_id).val();

        // console.log(quantity);

        $("#alert_message").text("Are you sure?");
        $("#exampleModaltwo").modal('show');

        $("#model-yes").one("click",function(x){

            $("#exampleModaltwo").modal('hide');

            $.ajax({
                type: "POST",
                url: url+"/"+entry_id,
                data: { note:note, room:room , quantity:quantity },
                success: function( msg ) {
                    console.log(msg);
                    // console.log(msg.sub_total);
                    $("#sub_total"+entry_id).text("$"+msg.sub_total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    $("#save"+entry_id).text("-$"+msg.save.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    $("#extra"+entry_id).text("-$"+msg.extra.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    $("#price"+entry_id).text("$"+msg.price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    $("#cart_sub_total").text("$"+msg.csub_total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    $("#your_price").text("$"+msg.cprice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    $("#items"+entry_id).text(msg.items);
                }
            });

        });

    }
</script>
