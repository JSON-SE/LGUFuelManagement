@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                     aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Super Sub-Category</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">Create Super Sub-Category</h3>
            </div>
            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <a href="{{route('admin.super-subcategory.index')}}" class="btn btn-primary d-flex align-items-center">
                    <span class="">All Super Sub-Category</span>
                </a>
                <!--<a href="{{route('admin.super-subcategory.create')}}" class="btn btn-primary d-flex align-items-center ms-2">
                    <span class="">Create Super Sub-Category</span>-->
                </a>
            </div>
        </div>
        <form action="{{route('admin.super-subcategory.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">

                <div class="p-lg-4 p-3 pb-5">
                    <ul class="nav nav-tabs product-management-tab" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                                    type="button" role="tab" aria-controls="basic" aria-selected="true">Basic
                                Information</button>
                        </li>
                        
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                            <div class="pt-2">
                                <div class="row gx-2">
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Super Sub-category Name *">
                                            <label for="name">Super Sub-category Name <span class="text-primary">*</span></label>
                                        </div>
                                        <div class="input-group mt-2">
                                                <span class="input-group-text small"
                                                      id="basic-addon3">https://HeyBlinds.com/category/{parent-category}/</span>
                                            <input type="text" class="form-control" id="basic-url" name="slug"
                                                   aria-describedby="basic-addon3" placeholder="Enter your  *">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div class="form-floating">
                                            <select name="category_id" id="categoryId" class="form-control">
                                                <option value="0">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="category_id">Category<span class="text-primary">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div id="uploadCategoryImage" class="product-image-uplode color-image-uplode scrollbar">
                                            <input type="file" name="image" id="categoryImage" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-12  mt-3">
                                        <label>Excerpt</label>
                                        <div class="pt-2">
                                            <textarea class="summernote" id="description" name="description" row="3">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="content">Product Specification</label>
                                        <div class="d-block mt-2">
                                            <textarea class="summernote" name="content" id="content" row="3">{{old('content')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4 text-end tab-btn-position">
                                <a href="{{route('admin.super-subcategory.index')}}" class="btn btn-danger">Back</a>
                                <button class="btn btn-success save-data" data-url="{{route('admin.super-subcategory.store')}}" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        $(document).ready(function () {

            $("#categoryId").select2();

            $('input[name="name"]').on('keyup', function(){
               let $this = $(this);
               let slug = slugify($this.val());
               $("#basic-url").val(slug);
            })

            $(document).on('click', '.save-data', function (e) {
                e.preventDefault();
                let $this = $(this);
                let form = $(this).parents('form');
                var formData = new FormData(form[0]);
                var request = $.ajax({
                    url: form.attr('action'),
                    method: "POST",
                    data:formData,
                    cache : false,
                    processData: false,
                    contentType: false,
                    beforeSend: function( xhr ) {
                        $("#loader").show();
                    }
                });
                request.done(function( msg ) {
                    console.log(msg);
                    toastr.success("saved!")
                    form[0].reset()
                    $("#description").summernote("reset");
                    $("#content").summernote("reset");
                    $("#loader").hide();
                    window.location.assign("{{route('admin.super-subcategory.index')}}");
                });

                request.fail(function( jqXHR, textStatus ) {
                    let errors = jqXHR.responseJSON.errors;
                    $("#loader").hide();
                    $.each(errors, function (key, value) {
                        toastr.error(value)
                    })
                });
            })
        })
    </script>
@endsection
