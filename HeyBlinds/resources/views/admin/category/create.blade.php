@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">

        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                     aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">Create Category</h3>
            </div>
            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <!-- <button class="btn btn-light">New view</button> -->
               <a href="{{route('admin.category.index')}}" class="btn btn-primary d-flex align-items-center">
                    <span class="">All Categories</span>
                </a>
            </div>
            
        </div>
        <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
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
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Category Name">
                                            <label for="name">Category Name<span class="text-primary">*</span></label>
                                        </div>
                                        <div class="input-group mt-2">
                                                <span class="input-group-text small"
                                                      id="basic-addon3">https://HeyBlinds.com/category/</span>
                                            <input type="text" class="form-control" id="basic-url" name="slug"
                                                   aria-describedby="basic-addon3" placeholder="Enter your slug*">
                                        </div>
                                    </div>

                                    <div class="col-6  mt-3">
                                        <div id="uploadCategoryImage" class="justify-content-center product-image-uplode color-image-uplode d-flex flex-wrap align-items-center scrollbar">
                                            <input type="file" name="image" id="categoryImage" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-12  mt-3">
                                        <label>Excerpt</label>
                                        <div class="pt-2">
                                            <textarea class="summernote" id="meta_description" name="meta_description" row="3">{{old('meta_description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="content">Product Specification</label>
                                        <div class="d-block mt-2">
                                            <textarea class="summernote" name="description" id="content" row="3">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4 text-end tab-btn-position">
                                <a href="{{route('admin.category.index')}}" class="btn btn-danger">Back</a>
                                <button class="btn btn-success save-data" data-url="{{route('admin.category.store')}}" type="submit">Submit</button>
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
            $('input[name="name"]').on('keyup', function(){
               let $this = $(this);
               let slug = slugify($this.val());
               $("#basic-url").val(slug);
            })

            $(document).on('click', '.save-data', function (e) {
                e.preventDefault();
                $("#loader").show();
                let $this = $(this);
                let form = $(this).parents('form');
                var formData = new FormData(form[0]);
                axios({
                    method: 'post',
                    url: $this.attr('data-url'),
                    data: formData
                }).then(function (response) {
                    console.log(response)
                    $("#loader").hide();
                    form[0].reset();
                    toastr.success("saved!")
                    $('#meta_description').summernote("reset");
                    $('#content').summernote("reset");
                    window.location.assign("{{route('admin.category.index')}}");

                }).catch(function (error) {
                    let errors = error.response.data.errors;
                    $("#loader").hide();
                    $.each(errors, function (key, value) {
                        toastr.error(value)
                    })
                });
            })
        })
    </script>
@endsection
