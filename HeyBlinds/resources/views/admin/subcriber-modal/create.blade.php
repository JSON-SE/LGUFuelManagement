@extends('layouts.Backend.admin.admin')

@section('content')

<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Modal Coupons</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">

                <h3 class="mb-0">Create Modal Coupon</h3>
            </div>

            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <!-- <button class="btn btn-light">New view</button> -->
                <a class="btn btn-primary d-flex align-items-center ms-2" href="{{ route('admin.modal-coupons.index') }}">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg> --}}
                    <span class="d-none d-md-block">View All Modal Coupons</span>
                </a>
            </div>

        </div>

        <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">

            @if(Session::has('message'))
            <p class="alert alert-info my-4">{{ Session::get('message') }}</p>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="mt-1">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            <div class="p-4 pt-3">

                <form action="{{ route('admin.modal-coupons.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf

                    <div class="justify-content-center">
                        <div class="color-records pb-3">
                            <div class="row">
                                <div class="col-lg-3 col-xl-12">
                                    <div class="row gx-2">

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control   {{ $errors->has('name') ? ' bg-light-danger' : ''}} " name="name"
                                                    value="{{old('name')}}" class="@error('name') is-invalid @enderror"
                                                    placeholder="Coupon Name" required>
                                                <label for="">Coupon Name <span class="text-primary">*</span></label>

                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control   {{ $errors->has('code') ? ' bg-light-danger' : ''}} "  name="code"  class="@error('code') is-invalid @enderror"
                                                    value="{{old('code')}}" placeholder="Coupon Code" required>
                                                <label for="">Coupon Code <span class="text-primary">*</span></label>

                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <select class="form-select" id="floatingSelect" name="type" required
                                                    aria-label="Floating label select example">
                                                    <option disabled>Select coupon type</option>
                                                    <option selected value="percentage">Percentage</option>
                                                    <option value="flat">Flat</option>
                                                </select>
                                                <label for="">Type <span class="text-primary">*</span></label>
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control  {{ $errors->has('amount') ? ' bg-light-danger' : ''}} " id="amount" name="amount"  class="@error('amount') is-invalid @enderror"
                                                    required value="{{old('amount')}}" placeholder="Discount Amount">
                                                <label for="">Discount Amount <span class="text-primary">*</span></label>
                                            </div>
                                        </div>


                                        <div class="col-lg-2">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control  {{ $errors->has('min_amount') ? ' bg-light-danger' : ''}} " id="min_amount" class="@error('min_amount') is-invalid @enderror"
                                                    name="min_amount" value="{{old('min_amount')}}"
                                                    placeholder="Minimum Spend Amount">
                                                <label for="">Minimum Spend Amount</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 d-none">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control  {{ $errors->has('min_quantity') ? ' bg-light-danger' : ''}} @error('min_amount') is-invalid @enderror" id="min_quantity"
                                                       name="min_quantity" value="{{old('min_quantity')}}"
                                                       placeholder="Minimum Quantity">
                                                <label for="min_quantity">Minimum Quantity</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="datetime-local" step="1" class="form-control" id="start_date"
                                                    name="start_date" required value="{{old('start_date')}}"
                                                    placeholder="Start Date" min="{{date("Y-m-d")."T".date("H:i:s")}}">
                                                <label for="">Start Date <span class="text-primary">*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="datetime-local" step="1" class="form-control  {{ $errors->has('end_date') ? ' bg-light-danger' : ''}} " id="end_date"  class="@error('end_date') is-invalid @enderror"
                                                    name="end_date" required value="{{old('end_date')}}"
                                                    placeholder="Expiration Date" min="{{date("Y-m-d")."T".date("H:i:s")}}">
                                                <label for="">Expiration Date <span class="text-primary">*</span></label>


                                            </div>
                                        </div>
                                        <div class="col-md-2 d-none">
                                            <div class="form-floating mt-3">
                                                <select class="form-select" id="customer_eligibility" name="coupon_use"
                                                        aria-label="Floating label select example">
                                                    <option selected value="all">Everyone</option>
                                                    <option value="specific">Specific customers</option>
{{--                                                    <option value="group">Specific Group Of customers (Not Working)</option>--}}
                                                </select>
                                                <label for="customer_eligibility">Customer Eligibility</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <select class="form-select" id="coupon_use" name="coupon_use"
                                                    aria-label="Floating label select example">
                                                    <option selected value="1">Once</option>
                                                    <option value="2">Twice</option>
                                                    <option value="99999999">Unlimited</option>
                                                </select>
                                                <label for="">Coupon can use</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mt-3">
                                            <div class="upload-group input-group">
                                                <label class="input-group-text">Icon Upload</label>
                                                <input class="file-name form-control  {{ $errors->has('icon') ? ' bg-light-danger' : ''}} " type="text" placeholder="Browse" class="@error('icon') is-invalid @enderror"
                                                    name="icon" readonly="">
                                                <input type="file" id="icon" name="icon">
                                                <label class="upload-btn" for="icon">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating mt-3">
                                                <select class="form-select" id="coupon_for" name="coupon_for"
                                                    aria-label="Floating label select example">
                                                    <option selected value="0">New User</option>
                                                    <option value="1">Repeated User</option>
                                                    <option value="2">All</option>
                                                </select>
                                                <label for="">Coupon For</label>
                                            </div>
                                        </div>


{{--                                        <div class="col-lg-2 d-flex mt-1">--}}
{{--                                            <div class="check-box d-inline-block mt-4">--}}
{{--                                                <input type="checkbox" id="pre_applied" name="pre_applied" value="1"--}}
{{--                                                    selected>--}}
{{--                                                <label for="pre_applied">Pre Applied</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="col-lg-2 d-flex mt-1">
                                            <div class="check-box d-inline-block mt-4">
                                                <input type="checkbox" id="is_active" name="is_active" value="1" checked>
                                                <label for="is_active">Active</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mt-3">
                                                <label for="description">Coupon Description <span class="text-primary">*</span></label>
                                                <textarea id="summernote-excerpt" name="description" class="summernote" {{ $errors->has('description') ? ' bg-light-danger' : ''}}  class="@error('description') is-invalid @enderror" >{{old('description')}}</textarea>
                                            </div>
                                        </div>

                                        <div>
                                            <button class="btn btn-primary mt-4">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section>

@endsection
