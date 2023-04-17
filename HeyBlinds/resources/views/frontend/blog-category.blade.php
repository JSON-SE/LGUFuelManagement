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

    <title>
        Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada
    </title>

    <link href="{{ url('/css/app.css?version=1.0.1') }}" rel="stylesheet">
    <script src="{{ url('/js/app.js?version=1.0.1') }}"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,300;1,400&display=swap"
        rel="stylesheet">
</head>
@include('layouts.Frontend.partials.blog_header')

<body>
    <section id="body-content">

    </section>
</body>

</html>
