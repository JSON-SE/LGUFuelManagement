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
        <div class="container pb-5 pt-md-4 pt-4">
            <div class="blog-image details-img">
                <img src="{{ $helpers->getImage($blog->media_id) }}" alt="{{ $blog->name }}" alt="" />
            </div>

            <div class="row">
                <div class="col-lg-9 pt-5 text-center">

                    <div class="text-start  pt-3 pt-sm-0 details-text">

                        <h3>
                            <a class="text-secondary">{{ $blog->name }}</a>
                        </h3>
                        <p class="small mb-3">
                        <div class=" me-2 post-logo border border-2 border-primary rounded-circle">
                            {{-- <img class="rounded-circle" src="{{asset('images/auth-image3.jpg')}}" alt=""> --}}
                            <span>HB</span>
                        </div>
                        <span class="pe-2">By <span
                                class="fw-semibold">{{ $blog->author_by ?? 'Admin' }}</span> </span>
                        </p>
                        <div class="blog-details-text">
                            {!! $blog->description !!}
                        </div>

                        <div class="text-capitalize pt-4">
                            <span class="btn btn-sm bg-secondary text-white">Tags:</span>
                            @foreach ($blog->categories as $category)
                                <a href="{{ url('/blog/category/' . $category->slug) }}"
                                    class="btn btn-sm btn-outline-secondary">{{ $category->name }}</a>
                            @endforeach

                        </div>
                        {{-- <div class="pb-2 pt-4">
                            <div>
                                <div class="social-media">
                                    <ul class="d-flex">
                                        <li>
                                            <h5 class="mb-0">
                                                Share:
                                            </h5>
                                        </li>
                                        <li class="ps-4">
                                            <a href="#"><img src="{{ asset('images/social_fb.png') }}" alt="" /></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div> --}}
                        <hr />

                        {{-- <div class="row pb-4 pt-2">
                            <div class="col-md-6 pe-md-5 pt-3">
                                <p class="mb-2">
                                    Previous article
                                </p>
                                <a class="h6 fw-semibold" href="#">
                                    What’s the Difference Between Single and Double Cellular Shades?
                                </a>

                            </div>

                            <div class="col-md-6 ps-md-5 pt-3 text-md-end">
                                <p class="mb-2">
                                    Next article
                                </p>
                                <a class="h6 fw-semibold" href="#">
                                    What’s the Difference Between Single and Double Cellular Shades?
                                </a>
                            </div>

                        </div> --}}

                        <div class="cart-box rounded-3 p-3">
                            <p class="mb-1 fw-semibold">Written by</p>
                            @if (!empty($blog->written_by))
                                <p> {!! $blog->written_by !!}</p>
                            @else
                                <h4 class="fw-semibold">Heyblinds</h4>
                                <p>
                                    I'm a happy person with a love for food. Originally from Michigan. Extreme
                                    social media practitioner and web enthusiast. I love bacon. Extreme
                                    social media practitioner and web enthusiast. I love bacon.
                                </p>
                            @endif
                            <div class="social-media">
                                {{-- <ul class="d-flex pt-2">
                                    <li class="px-1">
                                        <a href="#"><img src="{{asset('images/social_fb.png')}}" alt="facebook"/></a>
                                    </li>
                                    <li class="px-1">
                                        <a href="#"><img src="{{asset('images/social_in.png')}}" alt=""/></a>
                                    </li>
                                    <li class="px-1">
                                        <a href="#"><img src="{{asset('images/social_t.png')}}" alt=""/></a>
                                    </li>
                                </ul> --}}
                            </div>

                        </div>

                        <div class="pt-4 pb-2">
                            <h5 class="mb-2 font-secondary">Related Articles</h5>
                            <div class="row">
                                @foreach ($relativeBlog as $relBlog)
                                    <div class="col-lg-6 mb-3">
                                        <div class="blog-box p-2 rounded h-100">
                                            <a class="blog-image" href="{{ url('/blog/' . $relBlog->slug) }}">
                                                <img class="rounded-3"
                                                    src="{{ $helpers->getImage($relBlog->media_id) }}"
                                                    alt="{{ $relBlog->name }}" />
                                            </a>

                                            <div>
                                                <div>
                                                    @foreach ($relBlog->categories as $category)
                                                        <a href="{{ url('/blog/category/' . $category->slug) }}"
                                                            class="blog-tag">{{ $category->name }}</a>
                                                    @endforeach

                                                </div>

                                                <h5 class="pt-3">
                                                    <a
                                                        href="{{ url('/blog/' . $relBlog->slug) }}">{{ $relBlog->name }}</a>
                                                </h5>

                                                <div class="d-flex justify-content-between flex-wrap pt-2">
                                                    <p class="mb-0"><span class="fw-semibold">By
                                                            Admin</span>
                                                        <br /><small>{{ $relBlog->created_at->format('F d, Y') }}</small>
                                                    </p>
                                                    <p class="mb-0 mt-2"><small>{{ $blog->comments->count() }}
                                                            Comments</small></p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <hr />

                        <div class="pt-2">
                            <h5 class="mb-3 font-secondary">Leave a Reply</h5>

                            <form class="row" action="#" id="commentForm">
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Name" required>
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="name@example.com" required>
                                        <label for="">Email address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="message" style="height: 100px"
                                            placeholder="Leave a comment here" id="floatingTextarea"
                                            required></textarea>
                                        <label for="floatingTextarea">Comments</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                </div>
                            </form>
                        </div>


                        <div>
                            @foreach ($comments as $comment)
                                <div class="cart-box rounded-3 p-3 mt-3">
                                    <div class="d-flex">
                                        <div>
                                            <div
                                                class="me-2 comment-img-logo border border-2 border-primary rounded-circle">
                                                {{-- <img class="rounded-circle" src="{{asset('images/auth-image1.jpg')}}" alt=""> --}}
                                                <span> {{ substr($comment->name, 0, 1) }} </span>
                                            </div>
                                        </div>
                                        <div class="ps-3">
                                            <div class="d-flex align-items-end">
                                                <h5 class="fw-semibold mb-0 mt-1">{{ $comment->name }}</h5><small
                                                    class="ms-2">{{ $comment->created_at->format('l, H:i A') }}</small>
                                            </div>
                                            <p class="pt-2">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="ps-4 mt-2">
                                        @foreach ($comment->replies as $replay)
                                            <div class="d-flex ps-4 border-start">
                                                <div>
                                                    <div
                                                        class="me-2 reply-comment-img-logo border border-2 border-primary rounded-circle">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('images/auth-image3.jpg') }}" alt="">
                                                    </div>
                                                </div>

                                                <div class="ps-2">
                                                    <div class="d-flex align-items-end">
                                                        <h6 class="fw-semibold mb-0 mt-1">
                                                            {{ substr($replay->name, 0, 1) }}</h6><small
                                                            class="ms-2">{{ $replay->created_at->format('l, h:i A   ') }}</small>
                                                    </div>
                                                    <p class="pt-2">
                                                        {{ $replay->comment }}
                                                    </p>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="reply-box-section mt-3">
                                        <div class="reply-box-slide">
                                            <form class="row" id="replayForm">
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                <div class="col-lg-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="name"
                                                            class="form-control bg-transparent" required id="name"
                                                            placeholder="Name">
                                                        <label for="">Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" name="email"
                                                            class="form-control bg-transparent" required id="email"
                                                            placeholder="name@example.com">
                                                        <label for="">Email address</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating">
                                                        <textarea class="form-control bg-transparent"
                                                            style="height: 80px" required
                                                            placeholder="Leave a comment here" name="message"
                                                            id="floatingTextarea"></textarea>
                                                        <label for="floatingTextarea">Comments</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit"
                                                        class="px-3 btn btn-primary mt-3">Reply</button>
                                                </div>
                                            </form>
                                        </div>
                                        <button type="submit"
                                            class="reply-box-slide-btn btn btn-primary mt-3">Reply</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 pt-5 text-left">

                    <div class="sticky-search-bar pt-0">

                        <h5 class="border-start border-4 pe-md-5 border-primary ps-3">Categories</h5>
                        <ul class="list-items mt-3">
                            @foreach ($categoies as $category)
                                <li>
                                    <a
                                        href="{{ url('/blog/category/' . $category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>


                        <div class="pt-4 mt-2">
                            <h5 class="border-start border-4 pe-md-5 border-primary ps-3 ">Recent Post</h5>
                            @foreach ($blogs as $blog)
                                <div class="mt-3 pb-1">

                                    <a class="text-secondary h6 mb-0" href="{{ $blog->slug }}">
                                        <h6 class="mb-0 fw-semibold">{{ $blog->name }}</h6>
                                    </a>

                                    <p class="small mb-0">{{ $blog->created_at->format('F d, Y') }}</p>
                                </div>
                            @endforeach

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>

    @include('layouts.Frontend.partials._footer')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.reply-box-slide-btn', function() {
            $(this).parent('.reply-box-section').find('.reply-box-slide').slideDown();
            $(this).fadeOut();
        });
        $(document).on('submit', '#commentForm', function(e) {
            e.preventDefault();
            let $this = $(this);
            let formData = $this.serialize();
            axios.post('/comment', formData)
                .then((response) => {
                    if (response.data.status == true) {
                        Swal.fire({
                            text: response.data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                        document.getElementById("commentForm").reset();
                    }
                })
        });
        $(document).on('submit', '#replayForm', function(e) {
            e.preventDefault();
            let $this = $(this);
            let formData = $this.serialize();
            axios.post('/reply', formData)
                .then((response) => {
                    if (response.data.status == true) {
                        Swal.fire({
                            text: response.data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                        document.getElementById("commentForm").reset();
                        window.location.reload();
                    }
                })
        })
    </script>

</body>

</html>
