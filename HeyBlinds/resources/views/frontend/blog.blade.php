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
        Hey Blog - Window Covering & Home Decor, Design Tips | HeyBlinds Canada
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
        <div class="container pb-4 pb-xxl-5">
            <div class="row">
                <div class="col-md-8 col-lg-9 mt-4">
                    <div class="row gx-2" id="blogs">
                        @if ($blogs->count() > 0)
                            @foreach ($blogs as $blog)

                                <div class="col-lg-4 col-md-6 mb-3">

                                    <div class="blog-box p-2 rounded h-100">
                                        <a class="blog-image" href="{{ url('/blog/' . $blog->slug) }}">
                                            <img class="rounded-3" src="{{ $helpers->getImage($blog->media_id) }}"
                                                alt="{{ $blog->name }}" />
                                        </a>
                                        <div>
                                            <div>
                                                @foreach ($blog->categories as $category)
                                                    <a href="{{ url('/blog/category/' . $category->slug) }}"
                                                        class="blog-tag">{{ $category->name }}</a>
                                                @endforeach
                                            </div>
                                            <h5 class="pt-3">
                                                <a
                                                    href="{{ url('/blog/' . $blog->slug) }}">{{ ucfirst($blog->name) }}</a>
                                            </h5>

                                            <div class="d-flex justify-content-between flex-wrap pt-2">
                                                <p class="mb-0"><span
                                                        class="fw-semibold">{{ $blog->author_by ?? 'By Admin' }}</span>
                                                    <br /><small> {{ $blog->created_at->format('F d, Y') }}</small></p>
                                                <p class="mb-0 mt-2"><small>{{ $blog->comments->count() }}
                                                        Comments</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h5 class="text-center text-danger"> Blog not found yet.</h5>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 pt-4">
                    <div class="sticky-search-bar p-0 blog-side-bar bg-transparent">
                        <form action="#" autocomplete="off" id="blog-search">

                            <div class="position-relative mt-2">
                                <input type="text" class="form-control pe-5" id="search" name="search"
                                    autocomplete="off"></input>
                                <button type="submit" class="btn search-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </form>

                        <div class="mt-4">
                            <div class="text-bg-line text-center">
                                <h4 class="bg-white px-2 d-inline">Connect with HeyBlinds</h4>
                            </div>

                            <div class="social-media">
                                <ul class="d-flex justify-content-center pt-3">
                                    <li class="px-1">
                                        <a href="{{ url('https://www.facebook.com/HeyBlinds/') }}"><img
                                                src="{{ asset('images/social_fb.png') }}" alt="HB-Facebook" /
                                                target="_blank"></a>
                                    </li>
                                    <li class="px-1">
                                        <a href="{{ url('https://www.instagram.com/heyblinds/') }}"><img
                                                src="{{ asset('images/social_ig.png') }}" alt="HB-instagram" /
                                                target="_blank"></a>
                                    </li>

                                </ul>
                            </div>

                        </div>

                        <div class="mt-5">
                            <div class="text-bg-line">
                                <h4 class="bg-white px-2 d-inline">Categories</h4>
                            </div>
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label"
                                    onchange="showCategoryBlog(this)">
                                    <option value="">All</option>
                                    @foreach ($categoies as $cat)
                                        @if (!empty($newcategory->slug))
                                            <option class="level-0"
                                                {{ $newcategory->slug == $cat->slug ? 'selected' : '' }}
                                                value="{{ $cat->slug }}">{{ $cat->name }}</option>
                                        @else
                                            <option class="level-0" value="{{ $cat->slug }}">
                                                {{ $cat->name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                                <label for="floatingSelect">Select Category</label>
                            </div>
                        </div>


                        {{-- <div class="mt-5">
                            <div class="text-bg-line">
                                <h4 class="bg-white px-2 d-inline">Archives</h4>
                            </div>
                            <div class="form-floating mt-3">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option value=""> September 2021 </option>
                                    <option value=""> March 2021 </option>
                                    <option value=""> February 2021 </option>
                                    <option value=""> January 2021 </option>
                                    <option value=""> November 2021 </option>
                                    <option value=""> October 2021 </option>
                                    <option value=""> September 2021 </option>
                                </select>
                                <label for="floatingSelect">Select Month</label>
                              </div>

                        </div> --}}

                    </div>
                </div>

            </div>

        </div>
    </section>
    @include('layouts.Frontend.partials.blog_footer')
    <script type="text/javascript">
        function showCategoryBlog($this) {
            if ($this.value) {
                window.location = "/blog/category/" + $this.value;
            } else {
                window.location = "/blog";
            }
        }
        $('#blog-search').on('submit', function(e) {
            e.preventDefault();
            let $this = $(this);
            let formData = $this.serialize();
            axios.post('/blog/search', formData)
                .then((response) => {
                    $('#blogs').empty();
                    if (response.data.status == true) {
                        if (response.data.count != 0) {
                            $('#blogs').append(response.data.data);
                        } else {
                            $('#blogs').append('<h5 class="text-center text-danger"> Blog not found yet.</h5>');
                        }
                    }
                })

        })
    </script>
</body>

</html>
