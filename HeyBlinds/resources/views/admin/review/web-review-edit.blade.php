@extends('layouts.Backend.admin.admin')

@section('content')
<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Site Review</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">Edit Website Review</h3>
            </div>
        </div>
        
        <div class="bg-white rounded page-height mt-3 shadow">
            <div class="p-lg-4 p-3">
                <div class="row pb-4 pb-md-5">
                    <div class="col-md-8 pt-3 color-sidedar-fixd">
                       
                        <h5 class="step-heading">Review Info</h5>

                        <div class="row g-2 gx-3 personal-infomation-form align-items-center pt-2">
                            <form method="POST" action="{{ route('admin.website.review.update',$review->id) }}">
                                @csrf
                            <div class="col-md-8">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="created_at" name="created_at" placeholder="Created date"
                                    type="date" required value="{{$review->created_at->format('Y-m-d')}}" />
                                    <label for="created_at">
                                        Created date
                                    </label>
                                </div>
                            </div>
                            <div class="row gx-3 pt-4 text-start">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="title_review" name="title_review"
                                        placeholder="Title of Your Review" required type="text" value="{{$review->title_review}}"/>
                                        <label for="title_review">
                                            Title of Your Review
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="review" placeholder="Leave a comment here"
                                        style="height: 70px" required>{{$review->review}}</textarea>
                                        <label for="Leave a comment here">
                                           Note to HeyBlinds Team
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 text-start pb-2">
                                    <div>
                                        <h6 class="d-inline-block fw-semibold">
                                            Name to show with your review
                                        </h6>
                                        <span class="position-relative ms-1"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="name" name="full_name" placeholder="Your Name"
                                        required type="text" value="{{$review->name}}" />
                                        <label for="">
                                            Your Name
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="city" name="city" placeholder="Your City"
                                        type="text" required value="{{$review->city}}" />
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
                                        <option value="{{ $provience->code }}" {{$review->province == $provience->code ? 'selected' :'' }}>
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
                                    placeholder="Your Email Address" type="email" value="{{$review->email}}" />
                                    <label for="">
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
                                    placeholder="Note to HeyBlinds Team" style="height: 70px">{{$review->customer_suggestion}}</textarea>
                                    <label for="your_review">
                                        Note to HeyBlinds Team
                                    </label>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary px-5" type="submit">
                                    <span class="py-1 d-inline-block">
                                        Update
                                    </span>
                                </button>
                            </div>
                        </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@push('js')

@endpush
@endsection
