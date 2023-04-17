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
                        <li class="breadcrumb-item active" aria-current="page">Edit Coupons</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">

                <h3 class="mb-0">Edit: {{$coupon->name}}</h3>
            </div>

            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <!-- <button class="btn btn-light">New view</button> -->
                <a class="btn btn-primary d-flex align-items-center ms-2" href="{{ route('admin.coupons.index') }}">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg> --}}
                    <span class="d-none d-md-block">View All Coupons</span>
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

                <form action="{{ route('admin.coupons.update',$coupon->id)}}" method="post"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="justify-content-center">
                        <div class="color-records pb-3">
                            <div class="row">
                                <div class="col-lg-3 col-xl-12">
                                    <div class="row gx-2">

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text"
                                                    class="form-control   {{ $errors->has('name') ? ' bg-light-danger' : ''}} "
                                                     name="name" value="{{ $coupon->name }}"
                                                    class="@error('name') is-invalid @enderror"
                                                    placeholder="Coupon Name" required>
                                                <label for="">Coupon Name <span class="text-primary">*</span></label>

                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text"
                                                    class="form-control {{ $errors->has('code') ? ' bg-light-danger' : ''}}"
                                                     name="code" class="@error('code') is-invalid @enderror"
                                                    value="{{ $coupon->code }}" placeholder="Coupon Code" required>
                                                <label for="">Coupon Code <span class="text-primary">*</span></label>

                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <select class="form-select" id="floatingSelect" name="type" required
                                                    aria-label="Floating label select example">
                                                    <option disabled>Select coupon type</option>
                                                    <option {{$coupon->type == "percentage" ? "selected" : "" }}
                                                        value="percentage">Percentage</option>
                                                    <option {{$coupon->type == "flat" ? "selected" : "" }}
                                                        value="flat">Flat</option>
                                                </select>
                                                <label for="">Type</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text"
                                                    class="form-control {{ $errors->has('amount') ? ' bg-light-danger' : ''}}"
                                                    id="amount" name="amount"
                                                    class="@error('amount') is-invalid @enderror" required
                                                    value="{{ $coupon->amount }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Discount Amount">
                                                <label for="">Discount Amount <span class="text-primary">*</span></label>

                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text"
                                                    class="form-control {{ $errors->has('min_amount') ? ' bg-light-danger' : ''}}"
                                                    id="min_amount" class="@error('min_amount') is-invalid @enderror"
                                                    name="min_amount" value="{{ $coupon->min_amount }}"
                                                    placeholder="Minimum Spend Amount">
                                                <label for="">Minimum Spend Amount</label>


                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="datetime-local" class="form-control" id="start_date"
                                                    name="start_date" step="1" required
                                                    value="{{ date("Y-m-d", strtotime($coupon->start_date))."T".date("H:i:s", strtotime($coupon->start_date))  }}"
                                                    placeholder="Start Date" >
                                                <label for="">Start Date<span class="text-primary">*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="datetime-local"
                                                    class="form-control  {{ $errors->has('end_date') ? ' bg-light-danger' : ''}} "
                                                    id="end_date" class="@error('end_date') is-invalid @enderror"
                                                    name="end_date" step="1" required
                                                    value="{{ date("Y-m-d", strtotime($coupon->end_date))."T".date("H:i:s", strtotime($coupon->end_date))  }}"
                                                    placeholder="Expiration Date" min="{{date("Y-m-d")."T".date("H:i:s")}}">
                                                <label for="">Expiration Date<span class="text-primary">*</span></label>

                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <select class="form-select" id="coupon_use" name="coupon_use"
                                                    aria-label="Floating label select example">
                                                    <option @php if($coupon->coupon_use == 1) echo "selected" @endphp
                                                        value="1">Once</option>
                                                    <option @php if($coupon->coupon_use == 2) echo "selected" @endphp
                                                        value="2">Twice</option>
                                                    <option @php if($coupon->coupon_use == 999) echo "selected" @endphp
                                                        value="999">Unlimited</option>
                                                </select>
                                                <label for="">Coupon can use</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mt-3">
                                            <div class="upload-group input-group">
                                                <label class="input-group-text">Icon Upload</label>
                                                <input
                                                    class="file-name form-control  {{ $errors->has('icon') ? ' bg-light-danger' : ''}}  "
                                                    type="text" placeholder="Browse"
                                                    class="@error('icon') is-invalid @enderror" name="icon" readonly="">
                                                <input type="file" id="icon" name="icon">
                                                <label class="upload-btn" for="icon">
                                                </label>
                                            </div>
                                            <a href="#" class="mt-1" id="viewIcon">View Icon</a>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <select class="form-select" id="coupon_for" name="coupon_for"
                                                    aria-label="Floating label select example">
                                                    <option @php if($coupon->coupon_for == 0) echo "selected" @endphp
                                                        value="0">New User</option>
                                                    <option @php if($coupon->coupon_for == 1) echo "selected" @endphp
                                                        value="1">Repeated User</option>
                                                    <option @php if($coupon->coupon_for == 2) echo "selected" @endphp
                                                        value="2">All</option>
                                                </select>
                                                <label for="">Coupon For</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-2 d-flex mt-1">
                                            <div class="check-box d-inline-block mt-4">
                                                <input type="checkbox" id="with_promo" name="with_promo" value="1" @php
                                                    if($coupon->with_promo == 1) echo "checked" @endphp >
                                                <label for="with_promo">Combined with promo</label>
                                            </div>
                                        </div>


{{--                                        <div class="col-lg-2 d-flex mt-1">--}}
{{--                                            <div class="check-box d-inline-block mt-4">--}}
{{--                                                <input type="checkbox" id="pre_applied" name="pre_applied" value="1"--}}
{{--                                                    @php if($coupon->pre_applied == 1) echo "checked" @endphp >--}}
{{--                                                <label for="pre_applied">Pre Applied</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="col-lg-2 d-flex mt-1">
                                            <div class="check-box d-inline-block mt-4">
                                                <input type="checkbox" id="is_active" name="is_active" value="1"
                                                    @php if($coupon->is_active == 1) echo "checked" @endphp >
                                                <label for="is_active">Active</label>
                                            </div>
                                        </div>


                                        <div class="col-md-6 mt-3 d-none">
                                            <label class="pb-2">Category Name</label>
                                            <select class="form-control add-colour-name" multiple="multiple"
                                                name="category_id[]" data-placeholder="Select Categories">
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @php if(in_array($category->
                                                    id,$categoryIds) ) echo "selected"; @endphp>{{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mt-3 d-none">
                                            <label class="pb-2">Product Name</label>
                                            <select class="form-control add-colour-name" multiple="multiple"
                                                name="product_id[]" data-placeholder="Select Products">
                                                @foreach($products as $product)
                                                <option value="{{ $product->id }}" @php if(in_array($product->
                                                    id,$productIds) ) echo "selected"; @endphp >{{ $product->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-lg-12">
                                            <div class="mt-3">
                                                <label for="description">Coupon Description<span class="text-primary">*</span></label>
                                                <textarea id="summernote-excerpt" name="description" class="summernote" {{ $errors->has('description') ? ' bg-light-danger' : ''}}  class="@error('description') is-invalid @enderror" >{{$coupon->description}}</textarea>
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

        {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <img src="{{ $url }}">
        </div>
    </div>
</div> --}}


<div class="modal fade" id="couponIcon" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="couponIconLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content shadow">
        
         
          <button type="button" class="btn-close position-absolute end-0" data-bs-dismiss="modal" aria-label="Close"></button>
        
            <img src="{{ $url }}">
        
      </div>
    </div>
  </div>

</section>

<script>
    $("#viewIcon").on("click",function(e){
        e.preventDefault();
        $("#couponIcon").modal("show");
        $(".modal-backdrop").hide();
    });
</script>

@endsection


