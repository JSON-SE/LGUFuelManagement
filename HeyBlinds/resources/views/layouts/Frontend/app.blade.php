<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="WUNAki7uAXD7oWZheq8FOJPcAvLeL_bdhsU5MH29Fr8" />
    <meta name="description"
        content="Shop the most popular custom blinds and shades online with Hey Blinds Canada. 100 Day In-Home risk-free trial. Cellular/honeycomb shades, and all the other most popular styles and colours. Free shipping. Free samples. Lowest price guaranteed.">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('images/favicons/site.webmanifest') }}" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta property="og:url" content="https://heyblinds.ca/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Heyblinds | Home" />
    <meta property="og:description"
        content="Get Blinds in a Click! Simple to order. Easy to love. HeyBlinds puts the best blind choices right at your fingertips." />
    <meta property="og:image" content="{{ asset('/heyblinds-og-image.jpg') }}" />

    @yield('head')

    <title>
        @if (View::hasSection('title'))
            @yield('title')
        @else
            Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada
        @endif
    </title>

    {{-- <link href="{{ url('/css/all.css') }}" rel="stylesheet"> --}}
    <link href="{{ url('/css/app.css?version=1.0.1') }}" rel="stylesheet">
    {{-- <link href="{{ url('/css/style.css') }}" rel="stylesheet"> --}}

    <link
        href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,300;1,400&display=swap"
        rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet"> --}}

    <style type="text/css">
        .sample-order-image img {
            width: 30px;
        }

        /* chart bot button */
        .crisp-client .cc-kv6t .cc-1ada,
        .crisp-client .cc-kv6t .cc-ew5j:before,
        .crisp-client .cc-kv6t .cc-ew5j:after {
            background-color: #e5e5f3;
        }

        .kdmtMJ.kdmtMJ {
            background: #495667 !important;
            width: auto !important;
            height: auto !important;
        }

    </style>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', '{{ config('global.google_tag_id') }}');
    </script>

    @stack('css')
    <script>
        function setTimer(date) {
            var countDownDate = new Date(date).getTime();
            countDownDate.toLocaleString("en-US", {
                minimumIntegerDigits: 2,
                useGrouping: false
            });

            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if (document.getElementById("new-timer") != null) {
                    if (days == 0) {
                        document.getElementById("new-timer").innerHTML = ('0' + hours).slice(-2) + " : " +
                            ('0' + minutes).slice(-2) + " : " + ('0' + seconds).slice(-2);
                    } else {
                        document.getElementById("new-timer").innerHTML = days + " : " + ('0' + hours).slice(-2) +
                            " : " +
                            ('0' + minutes).slice(-2) + " : " + ('0' + seconds).slice(-2);
                    }
                }
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("promoTier-visibility").style.display = "none";
                }
            }, 1000);
        }

        var deadline = "{{ @$promo->end_date }}";

        if (deadline) {
            setTimer(deadline);
        };
    </script>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('global.google_tag_id') }}"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- End Google Tag Manager (noscript) -->
    <!-- Google Tag Manager (noscript) -->
    {{-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=UA-191696263-2" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript> --}}
    <!-- End Google Tag Manager (noscript) -->
    @php Cookie::queue('external_id', "23", 100) ?? "" @endphp
    @include('layouts.Frontend.partials._header')
    @include('layouts.Frontend.partials.__modal')
    {{-- @include('layouts.Backend.admin.layouts._loader') --}}

    @yield('banner')

    <input type="hidden" id="coupon-discription" value="{!! strip_tags($promo->content ?? '') !!}">

    <div class="modal fade" id="emailVerificationModal" tabindex="-1" aria-labelledby="emailVerificationModal"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content p-4 border-0">

                <div class="modal-body p-0 text-center">
                    <div class="text-primary pb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                            class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                        </svg>
                    </div>

                    {{-- <h6 id="alert_message">Alert Message Here</h6> --}}
                    <h4 id="textMessgeDisplay">Are you sure?</h4>
                    <div class="pt-3">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                            id="model-no">No</button>
                        <button type="button" class="btn btn-sm btn-primary" id="model-yes">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="couponDetailsModel" tabindex="-1" aria-labelledby="covidModalLabel"
        aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0">
                <div class="modal-body">
                    <div class="row gx-2 justify-content-between">
                        <div class="col-11">
                            <h4 class="font-secondary fw-bold text-secondary">Promo Details</h4>
                        </div>
                        <div class="col-1 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>
                    <hr class="mt-2" />
                    <p id="modelCouponDescription"></p>


                </div>

            </div>
        </div>
    </div>

    @yield('content')
    @include('layouts.Frontend.partials._footer')

    @include('layouts.Frontend.partials.header-modal')
    {{-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K8HZDCX" --}}
    {{-- height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> --}}
    <!-- End Google Tag Manager (noscript) -->

    <script src="{{ url('/js/app.js?version=1.0.1') }}"></script>
    <script src="{{ url('/js/vendors/cleave.min.js') }}"></script>


    {{-- <script src="https://apis.google.com/js/platform.js?onload=renderBadge" async defer></script>
    <script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script> --}}

    <script>
        $(function() {

            $("#couponDetails").on("click", function(event) {
                event.preventDefault();
                var text = $('#coupon-discription').val();
                $("#modelCouponDescription").empty();
                $("#modelCouponDescription").html(text);
                $("#couponDetailsModel").modal('show')
                return false;
            });

            $("#couponMobileDetails").on("click", function(event) {
                event.preventDefault();
                $("#modelCouponDescription").empty();
                var text = $('#coupon-discription').val();

                $("#modelCouponDescription").html(text);
                $("#couponDetailsModel").modal('show')
                return false;
            });



            @php
            $getCookieCartId = $_COOKIE['__sb_sample_cart'] ?? '';
            @endphp

            // $('.tooltip-hover').hover(function() {
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
            })

            $(document).on('click', '.headerSampleCart', function(e) {
                e.preventDefault()
                let $this = $(this);
                let id = readCookie('__sb_sample_cart')
                let cartId = {
                    cart_id: id
                }
                let modal = $('#sampleCart')
                $("#loader").show();
                let url = "/sample/" + id + "/view";
                success_callback(url, cartId, function(response) {
                    $("#loader").hide();
                    let data = response.data;
                    let html = '<div class="samples-cart-list-box">';
                    jQuery.each(data, function(index, value) {
                        // html += '<p class="small"> Classic Fabric Light Filtering Roller Shades </p>';
                        html += `<div>
                                <div class="d-flex align-content-center justify-content-between mb-2 samples-cart-list">
                                <div class="d-flex  align-content-center">
                                <div class="sample-order-image">
                                <img src="${value.image}" alt="" />
                                </div>
                                <p class="ps-2 mb-0">${value.name}</p>
                                </div>
                                <button type="button" class="btn-close btn-sm ms-3 sample-cart-close" data-pid="${value.product_id}" data-cid="${value.color_id}" data-cart="${value.cart_id}"></button>
                                </div>
                                </div>`;
                    });
                    html += '</div>';

                    var sampleCartCount = $("#sampleCartCountBadge").text();
                    if (sampleCartCount == 0) {

                        html = `<div> <h3>Cart is Empty</h3> </div> </div>`
                        $('#finalizeSampleCart').attr('disabled', 'disabled');
                    } else {
                        $('#finalizeSampleCart').removeAttr('disabled');
                    }
                    $('#sampleCart').modal('show').find('.modal-body').empty().append(html);
                }, function(error) {
                    $("#loader").hide();
                    let errors = error.response.data.errors;
                    toastr.error('No Sample Product Found!')
                })
            })
            $(document).on('click', '.sample-cart-close', function(e) {
                e.preventDefault();
                let $this = $(this);
                let sampleCartId = readCookie('__sb_sample_cart');
                let data = {
                    pid: $this.attr('data-pid'),
                    optid: $this.attr('data-cid'),
                    cartid: sampleCartId
                }
                $this.prop('disabled', true);
                removeCart(data, $this, 'cart')
            })
        });
    </script>


    <script id="mcjs">
        ! function(c, h, i, m, p) {
            m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(
                m, p)
        }(document, "script",
            "https://chimpstatic.com/mcjs-connected/js/users/63bcc6cba65e5bd22543f91de/3a96479b7a7f6fa47f33dfddc.js");
    </script>
    <!-- Facebook Pixel Code -->

    <script>
        ! function(f, b, e, v, n, t, s)

        {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?

                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };

            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';

            n.queue = [];
            t = b.createElement(e);
            t.async = !0;

            t.src = v;
            s = b.getElementsByTagName(e)[0];

            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '224555073014662');

        fbq('track', 'PageView');
    </script>

    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=224555073014662&ev=PageView&noscript=1" /></noscript>

    <!-- End Facebook Pixel Code -->

    <script type='text/javascript'>
        window.__lo_site_id = 303100;
        (function() {
            var wa = document.createElement('script');
            wa.type = 'text/javascript';
            wa.async = true;
            wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wa, s);
        })();
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "8c2d5184-83d0-46ab-84c3-a09756f8d7af";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>
    @stack('js')
    {{-- @if (config('global.is_heyblinds_com') == true)
        <script src="https://cdn.verifypass.com/seller/embed/load.js" id="vfyps_widget" data-key="4cfc2eb09" data-show-all="true"></script>
    @endif --}}
    <script async type="text/javascript" src="https://static.klaviyo.com/onsite/js/klaviyo.js?company_id=RDzMew"></script>

</body>

</html>
