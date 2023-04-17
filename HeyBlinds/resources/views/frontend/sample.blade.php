@extends('layouts.Frontend.app')
@section('title')
    Free Blinds & Shades Samples | HeyBlinds Canada
@endsection
@section('content')
    @include('layouts.Backend.admin.layouts._loader')
    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Free Samples</li>
            </ol>
        </nav>
    </section>
    <form action="#" method="post">
        @csrf
        <section id="body-content">
            <div class="container pb-4 pb-xxl-5">
                <h1 class="text-center heading-two text-dark">Order Your Free Samples & Lock in Today's Sale Prices for 3
                    weeks
                    <span class="position-relative ms-2 mousuhover-out">
                        <span class="text-primary tooltip-hover question-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                </path>
                            </svg>
                        </span>
                        <div class="tooltip shadow" style="z-index: 999;">
                            <div class="tooltip-arrow"></div>
                            <span class="close-tooltip btn-close btn"></span>
                            <div class="tooltip-inner">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <p>
                                            You want to make sure you don’t miss today’s sale, but you don’t want to order
                                            until you get your free samples? No worries!
                                        </p>
                                        <p>
                                            We'll include details of today's sale in your samples order confirmation email.
                                            Then, once you've
                                            received your samples and had time to decide on those perfect styles and
                                            colours,
                                            save your cart and just send us back that email when you're ready to order, and
                                            we'll
                                            adjust your cart to today's sale pricing. Easy peasy!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </span>
                </h1>

                <p class="text-center border-bottom pb-2 mb-3">Go ahead, order as many FREE Samples as you’d like!</p>

                <div class="row mb-view-row relative">
                    <div class="col-lg-8 col-md-7">
                        <h2 class="hedline-tag d-block text-center mb-0">Choose Your Samples</h2>
                        <ul class="sample-ul mt-3 mb-3">
                            <li>
                                <div><span>1</span>Select blinds category & <br> product</div>
                            </li>
                            <li>
                                <div><span>2</span> Click on your desired <br> sample colours</div>
                            </li>
                            <li>
                                <div><span>3</span> Click Checkout</div>
                            </li>
                        </ul>
                        <div class="d-flex flex-wrap mt-3">
                            <div class="color-section">
                                <div class="select-colour-items">
                                    <div class="row">
                                        @foreach ($sub_Categories as $category)
                                            <div class="text-center mb-3 shadow-sm col-lg-3">
                                                <div class="radio check-position py-3">
                                                    <input id="sample-color-{{ $category->id }}"
                                                        data-id="{{ $category->id }}" data-mapper="{{ $category->id }}"
                                                        name="sub_category" type="radio" value="{{ $category->id }}">
                                                    <label for="sample-color-{{ $category->id }}"
                                                        class="radio-label colorchange sample_color_scroll">
                                                        <div class="sample-color-img rounded">
                                                            <img class="rounded"
                                                                src="{{ $helpers->getThumbnail($category->media_id) }}"
                                                                alt="" />
                                                        </div>
                                                        <p class="fw-bold mt-2 mb-0 text-uppercase text-break">
                                                            {{ $category->name ?? '' }}</p>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="productData"></div>
                    </div>

                    <div class="col-lg-4 col-md-5 mb-3">
                        <div class="shadow py-4 rounded" style="position: sticky; top: 140px; left:0;">
                            <div class="px-4">
                                <h5 class="font-secondary text-center fw-bold border-bottom mb-2 pb-2">SAMPLES CART</h5>
                                <div class="sample-page-cart-right" id="sample-page-cart-right">
                                    @if (count($sampleCartProducts) > 0)
                                        @foreach ($sampleCartProducts as $sample)
                                            <div class="samples-cart-list-box shadow-box"
                                                data-auto="{{ $sample->external_id }}"
                                                data-pid="{{ $sample->product_id }}">
                                                <p class="mb-2 fw-bold">
                                                    {{ $helpers->getProductName($sample->product_id) }}</p>
                                                @if ($allSampleCarts)
                                                    @foreach ($allSampleCarts as $color)
                                                        @if ($sample->product_id === $color->product_id)
                                                            <div class="d-flex align-items-center justify-content-between mb-2 samples-cart-list"
                                                                data-pid="{{ $sample->product_id }}"
                                                                data-auto="{{ $sample->external_id }}"
                                                                data-cid="{{ $color->color_id }}">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="sample-order-image">
                                                                        <img src="{{ $helpers->getThumbnail($color->color->color_image_id ?? 0) }}"
                                                                            alt="" />
                                                                    </div>
                                                                    <p class="ps-2 mb-0 fw-bold">
                                                                        {{ $color->color->name ?? '' }}</p>

                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <p class="mb-0 text-primary">FREE</p>
                                                                    <button data-pid="{{ $color->product_id }}"
                                                                        value="{{ $color->color_id }}"
                                                                        data-id="{{ $color->color_id }}"
                                                                        data-auto="{{ $sample->external_id }}"
                                                                        data-cid="{{ $color->color_id }}"
                                                                        data-cart="{{ $color->external_id }}"
                                                                        type="button"
                                                                        class="btn-close btn-sm ms-3 sample-cart-close-button">
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <p id="emptySampleText">Add your first sample.</p>
                                    @endif
                                </div>
                            </div>

                            <div class="px-4 sample-checkout-sticky">
                                <div class="sample-checkout-cart-count">
                                    <hr />
                                    <p class="mb-1 fw-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-palette2 me-1" viewBox="0 0 16 16">
                                            <path
                                                d="M0 .5A.5.5 0 0 1 .5 0h5a.5.5 0 0 1 .5.5v5.277l4.147-4.131a.5.5 0 0 1 .707 0l3.535 3.536a.5.5 0 0 1 0 .708L10.261 10H15.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5H3a2.99 2.99 0 0 1-2.121-.879A2.99 2.99 0 0 1 0 13.044m6-.21l7.328-7.3-2.829-2.828L6 7.188v5.647zM4.5 13a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0zM15 15v-4H9.258l-4.015 4H15zM0 .5v12.495z">
                                            </path>
                                            <path d="M0 12.995V13a3.07 3.07 0 0 0 0-.005z"></path>
                                        </svg>
                                        My Samples Cart
                                    </p>
                                    <p class="mb-0"><span id="totalFreeSampleCarts">{{ $sampleCount }}</span>
                                        Items (FREE)</p>
                                </div>
                                <div class="text-center mt-2" id="finalizeSampleCheckoutButton"
                                    style="display: {{ count($sampleCartProducts) < 1 ? 'none' : 'block' }}">
                                    @if ($id)
                                        <a href="{{ route('frontend.sample.checkout.index', $id) }}"
                                            class="btn btn-primary btn-lg w-100" id="">Checkout</a>

                                    @else

                                        <a href="javascript:void(0)" class="btn btn-primary btn-lg w-100 finalizeSampleCart"
                                            id="">Checkout</a>

                                    @endif
                                </div>
                            </div>
                            <div id="sample-checkout-sticky-section"></div>

                            <div class="px-4 mt-3">
                                <a href="{{ route('welcome') }}" class="btn btn-secondary w-100">Continue Shopping</a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="sample-note-box mt-5">
                    <h2>Order Samples and lock in today’s sale pricing for 3 weeks!</h2>
                    <p>We guarantee today’s sale pricing for 3 weeks when you order samples. So that you have all the time
                        you need to review your samples and make sure you are ordering the colours and styles that are just
                        right for your windows and home!</p>
                </div>
            </div>
        </section>
    </form>

    @push('js')


        <script>
            jQuery(function($) {

                const displayCart = $("#sample-page-cart-right");
                $(document).on('click', 'input[name="sub_category"]', function(e) {
                    let $this = e.target;
                    if ($this.tagName === "INPUT" && $this.type === "radio" && $($this).attr("name") ===
                        "sub_category" && $($this).attr("id") === "sample-color-" + $($this).val()) {
                        let $sampleCartId = readCookie('__sb_sample_cart')
                        const data = {
                            id: $($this).val(),
                            cart_id: $sampleCartId
                        };
                        $("#loader").show();
                        axios.post('{{ route('frontend.show.sample.product.data') }}', data)
                            .then(function(response) {
                                $("#loader").hide();
                                let data = response.data;
                                $("#productData").empty().append(appendProducts(data))
                            })
                            .catch(function(error) {
                                console.log(error);
                                $("#loader").hide();
                            });
                    }
                })
                $(document).on('click', '.cart-sample-select-button', function(e) {
                    let $this = $(this);
                    let $sampleCartId = readCookie('__sb_sample_cart')
                    let data = {
                        pid: $this.attr('data-pid'),
                        optid: $this.val(),
                        cartid: $sampleCartId
                    }
                    if ($this.hasClass('sample-select-cart') && !$this.attr('checked')) {
                        axios.post('{{ route('frontend.product.add.to.sample') }}', data)
                            .then(function(response) {
                                let data = response.data;
                                if (data.error !== "null") {
                                    $(".finalizeSampleCart").attr('href', '/sample/checkout/' + response
                                        .data.external_id);
                                    $("#emptySampleText").remove();
                                    $("#finalizeSampleCheckoutButton").show();
                                    createCookie('__sb_sample_cart', data.external_id)
                                    let existing = parseInt($("#sampleCartCountBadge").text())
                                    $("#sampleCartCountBadge, #totalFreeSampleCarts").text(existing + 1)
                                    $("#sampleCartItems").text(existing + 1)
                                    $this.addClass('selected').attr('checked', 'checked');
                                    let checkAlreadyAdded = displayCart.find("[data-auto='" + data
                                        .external_id + "']").find("[data-pid='" + data.product_id +
                                        "']");
                                    console.log("checking " + checkAlreadyAdded);
                                    if (checkAlreadyAdded.length > 0) {
                                        checkAlreadyAdded.parents('.samples-cart-list-box').append(
                                            appendProduct(data)
                                        )
                                    } else {
                                        displayCart.append(
                                            '<div class="samples-cart-list-box shadow-box" data-auto="' +
                                            data.external_id + '" data-pid="' + data.product_id +
                                            '"><p class="mb-2 fw-bold"> ' + data.productName + ' </p>' +
                                            appendProduct(data) +
                                            '</div>'
                                        );
                                    }
                                }
                            })
                            .catch(function(error) {
                                console.log(error);
                                $("#loader").hide();
                            });
                    } else if ($this.hasClass('selected') && $this.attr('checked')) {
                        axios.post("/product/" + data.pid + "/sample-remove-from-cart", data)
                            .then(function(response) {
                                let data = response.data;
                                let existing = parseInt($("#sampleCartCountBadge").text())
                                $("#sampleCartCountBadge, #totalFreeSampleCarts").text(existing - 1)
                                $("#sampleCartItems").text(existing - 1)
                                console.log('working');
                                $this.removeClass('selected').prop('checked', false).removeAttr('checked');
                                let addedOption = $(".samples-cart-list[data-pid='" + data.pid +
                                    "'][data-cid='" + data.optid + "']");
                                let totalProductCount = $(".samples-cart-list-box[data-pid='" + data.pid +
                                    "']").find(".samples-cart-list[data-pid='" + data.pid + "']");
                                if ((totalProductCount.length - 1) > 0) {
                                    addedOption.remove();
                                } else {
                                    addedOption.parents(".samples-cart-list-box[data-pid='" + data.pid +
                                        "']").remove();
                                }
                                removeCartButton()
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    }
                })
                $(document).on('click', '.sample-cart-close-button', function(e) {
                    e.preventDefault();
                    const $this = $(this);
                    let $sampleCartId = readCookie('__sb_sample_cart')
                    let data = {
                        pid: $this.attr('data-pid'),
                        optid: $this.val(),
                        cartid: $sampleCartId
                    }
                    removeCart(data, $this, 'samples')
                })
                var count = 0;

                function appendProducts(data) {
                    let html = '';
                    html +=
                        '<h5 class="border-bottom pt-3 pb-2 mt-3 fw-bold heading-three">PLEASE CHOOSE A PRODUCT:</h5> <div id="product-option"> <div class="accordion" id="accordionExample">';
                    $.each(data, function(i, val) {
                        count++
                        let colors = val.color;
                        html +=
                            `<div class="accordion-item mt-2"><h2 class="accordion-header" id="heading${i}"> <button class="accordion-button collapsed sample-page-btn accordion-button-collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${val.productId}" aria-expanded="${(count === 1 ? "true" : "false")}" aria-controls="collapse${val.productId}">`;
                        html += '<a target="_blank" href="' + document.location.origin + '/product/' + val
                            .productSlug +
                            '"><span class="d-flex align-items-center justify-content-center"> Shop </span> </a> ' +
                            val.productName + ' </button> </h2>';
                        html += '<div id="collapse' + val.productId +
                            '" class="accordion-collapse collapse border-0 " aria-labelledby="heading' + val
                            .productId + '" data-bs-parent="#accordionExample">';
                        html +=
                            '<div class="py-2 shadow-sm"><div class="color-section"><div class="select-colour-items"><div class="select-colour d-flex flex-wrap">';
                        $.each(colors, function(c, color) {
                            html +=
                                '<div class="sample-color-box text-center shadow-sm"><div class="radio check-position"> <input class="sample-select-cart cart-sample-select-button ' +
                                (color.selected === "checked" ? "selected" : "") + '" data-pid="' + val
                                .productId + '" value="' + color.id + '" data-id="' + color.id +
                                '" id="product-sample-color-' + color.id + '-' + val.productId +
                                '" name="samples" type="checkbox" ' + color.selected + color.out_of_stock+' >';

                            html += '<label for="product-sample-color-' + color.id + '-' + val
                                .productId + '" href="' + color.colorImage + '" src="' + color
                                .colorFeatureImage + '" value="' + color.id +
                                '" class="radio-label colorchange"> ';

                            html +=
                                '<div class="sample-color-img rounded"> <img class="rounded" src="' +
                                color.colorImage + '" alt="" /> </div> <p class="my-1">' + color
                                .colorName + '</p> ';
                                html += `<p class="mb-0 text-primary ${color.active_of_stock == 1 ? 'd-block' : 'd-none'}">😞 Sample temporarily out of stock</p>
                                </label></div></div>`;

                        })

                        html += '</div></div></div></div></div></div>'
                    })
                    html += '</div></div>'
                    return html;
                }

                function appendProduct(data) {
                    let html = '';

                    html +=
                        '<div class="d-flex align-items-center justify-content-between mb-2 samples-cart-list" data-pid="' +
                        data.product_id + '" data-auto="' + data.external_id + '" data-cid="' + data.color_id + '">';
                    html += '<div class="d-flex align-items-center"><div class="sample-order-image"><img src="' + data
                        .colorImage + '" alt="HeyBlinds-' + data.colorName + '" /></div>';
                    html += '<p class="ps-2 mb-0 fw-bold">' + data.colorName +
                        '</p></div><div class="d-flex align-items-center"><p class="mb-0 text-primary">FREE</p>';
                        // html += `<p class="${data.out_of_stock != 0 ? 'd-none': ''}">😞 Sample temporarily out of stock</>`;
                    html += '<button data-pid="' + data.product_id + '" value="' + data.color_id + '" data-id="' + data
                        .color_id + '" data-auto="' + data.external_id + '" data-cid="' + data.color_id +
                        '" data-cart="' + data.external_id +
                        '" type="button" class="btn-close btn-sm ms-3 sample-cart-close-button"> </button>';
                    html += '</div></div>';
                    // html += '</div>';
                    return html;
                }

                function cartOffset() {
                    if ($('.sample-checkout-sticky').offset().top + $('.sample-checkout-sticky').height() >= $(
                            '#sample-checkout-sticky-section').offset().top - 10)
                        $('.sample-checkout-sticky').css('position', 'relative').removeClass('sample-cart-fixd');
                    if ($(document).scrollTop() + window.innerHeight < $('#sample-checkout-sticky-section').offset()
                        .top)
                        $('.sample-checkout-sticky').css('position', 'fixed').addClass('sample-cart-fixd');
                }
                $(document).scroll(function() {
                    cartOffset();
                });
            })
        </script>

    @endpush
@endsection
