@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sub-Category</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">Edit: {{ $category->name }}</h3>
            </div>
            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <a href="{{ route('admin.sub.category.index') }}" class="btn btn-primary d-flex align-items-center">
                    <span class="">All Sub-Categories</span>
                </a>
                <a href="{{ route('admin.sub.category.create') }}" class="btn btn-primary d-flex align-items-center ms-2">
                    <span class="">Create Sub-Category</span>
                </a>
            </div>

        </div>

        <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">
            <div class="p-lg-4 p-3 pb-5">
                <ul class="nav nav-tabs product-management-tab" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                            type="button" role="tab" aria-controls="basic" aria-selected="true">Basic
                            Information</button>
                    </li>


                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button"
                            role="tab" aria-controls="seo" aria-selected="false">SEO</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                        <form enctype="multipart/form-data"
                            action="{{ route('admin.new.sub.category.update', $category->slug) }}" id="subCategoryForm"
                            method="post">
                            @csrf
                            @method('POST')
                            <div class="pt-2">
                                <div class="row gx-2">
                                    <div class="col-lg-4 mt-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ !empty(old('name')) ? old('name') : $category->name }}"
                                                placeholder="Category Name">
                                            <label for="name">Sub-Category Name<span class="text-primary">*</span></label>
                                        </div>
                                        <div class="input-group mt-2">
                                            <span class="input-group-text small"
                                                id="basic-addon3">https://HeyBlinds.com/category/{parent-category}</span>
                                            <input type="text" class="form-control" id="basic-url"
                                                value="{{ !empty(old('slug')) ? old('slug') : $category->slug }}"
                                                name="slug" aria-describedby="basic-addon3" placeholder="Enter your slug">
                                        </div>

                                    </div>


                                    <div class="col-md-3 mt-3">
                                        <div class="form-floating">
                                            <select name="parent_category_name" id="categoryId" class="form-control">
                                                <option value="0">Select Category</option>
                                                @foreach ($categories as $categoryNew)
                                                    <option value="{{ $categoryNew->id }}"
                                                        {{ (!empty(old('parent_category_name')) ? old('parent_category_name') : $category->category_id) ===$categoryNew->id? 'selected': '' }}>
                                                        {{ $categoryNew->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="parent_category_name">Category<span
                                                    class="text-primary">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-3 d-none" id="super_sub_category_section">
                                        <div class="form-floating">
                                            <select name="super_sub_category" id="super_subcategoryId"
                                                class="form-control">
                                                @foreach ($superSubcategorieList as $superSubCategory)
                                                    <option value="{{ $superSubCategory->id }}"
                                                        {{ isset($superSubcategories->id) && $superSubcategories->id == $superSubCategory->id ? 'selected' : '' }}>
                                                        {{ $superSubCategory->name }} </option>
                                                @endforeach
                                            </select>
                                            <label for="super_sub_category_name">Super Sub Category<span
                                                    class="text-primary">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mt-3">
                                        <div id="uploadCategoryImage"
                                            class="product-image-uplode color-image-uplode scrollbar">
                                            <input type="file" name="image" id="categoryImage" class="form-control"
                                                value="{{ old('image') }}">
                                        </div>
                                        <a class="mt-2" target="_blank"
                                            href="{{ $helpers->getThumbnail($category->media_id) }}"> <img
                                                class="thumb img-fluid"
                                                src="{{ $helpers->getThumbnail($category->media_id) }}" alt=""></a>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="sub_mobile_name"
                                                name="sub_mobile_name"
                                                value="{{ $category->sub_mobile_name ?? $category->name }}"
                                                placeholder=">Name for mobile">
                                            <label for="name">Name for mobile<span class="text-primary">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-12  mt-3">
                                        <label>Excerpt</label>
                                        <div class="pt-2">
                                            <textarea class="summernote" name="description"
                                                row="3">{{ !empty(old('description')) ? old('description') : $category->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="tinymceTextarea">Product Specification</label>
                                        <div class="d-block mt-2">
                                            <textarea class="summernote" name="content" id="tinymceTextarea"
                                                row="3">{{ !empty(old('content')) ? old('content') : $category->content }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="content">Footer Content</label>
                                        <div class="d-block mt-2">
                                            <textarea class="summernote" name="footer_content" id="footer_content"
                                                row="3">{{ !empty(old('footer_content')) ? old('footer_content') : $category->footer_content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4 text-end tab-btn-position">
                                <a href="{{ route('admin.sub.category.index') }}" class="btn btn-danger">Back</a>
                                <button class="btn btn-success save-data" data-url="" type="submit">Submit</button>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="pt-3">
                            <form enctype="multipart/form-data" action="{{ route('admin.main.sub-category.seo.store') }}"
                                id="subCategorySeo" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <div class="row justify-content-center">
                                    <div class="col-7 mt-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="seo_name" name="seo_name"
                                                placeholder="Meta Title"
                                                value="{{ !empty($seo->title) ? $seo->title : '' }}">
                                            <label for="">Meta Title</label>
                                        </div>
                                    </div>


                                    <div class="col-7  mt-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="seo_description" name="seo_description"
                                                placeholder="Leave a comment here" id="floatingTextarea2"
                                                style="height: 100px">{{ !empty($seo->description) ? $seo->description : '' }}</textarea>
                                            <label for="floatingTextarea2">Meta Description</label>
                                        </div>

                                    </div>

                                    <div class="col-7  mt-3">
                                        {{-- <form action="#"
                                                class="dropzone justify-content-center product-image-uplode d-flex flex-wrap align-items-center scrollbar"> --}}
                                        <div id="myId" class="fallback">
                                            <input name="og_image" type="file" />

                                        </div>
                                        <div class="dz-message dz-button" data-dz-message>
                                            <span>Upload OG Image</span>
                                        </div>
                                        {{-- </form> --}}

                                    </div>
                                </div>
                                <div class="px-4 pb-4 text-end tab-btn-position">
                                    <a href="{{ route('admin.sub.category.index') }}" class="btn btn-danger">Back</a>
                                    <button class="btn btn-success category-seo-data-store " data-url=""
                                        type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('input[name="name"]').on('keyup', function() {
                let $this = $(this);
                let slug = slugify($this.val());
                $("#basic-url").val(slug);
            })
            $("#categoryId").select2();
            $("#super_subcategoryId").select2();
            var e = document.getElementById("categoryId");
            var catagoryValue = e.options[e.selectedIndex].value;
            if (catagoryValue == 3) {
                var element = document.getElementById("super_sub_category_section");
                element.classList.remove("d-none");
            }
            $("#categoryId").change(function() {
                var categoryId = $("#categoryId").val();
                var request = $.ajax({
                    url: '{{ route('admin.sub.category.list') }}',
                    method: "POST",
                    data: {
                        categoryId
                    },
                    // cache : false,
                    // processData: false,
                    // contentType: false,
                    beforeSend: function(xhr) {
                        $("#loader").show();
                    }
                });
                request.done(function(res) {
                    console.log(res);
                    $("#loader").hide();
                    var option = '';
                    if (res.data.length != 0) {
                        $.each(res.data, function(i, value) {
                            option += '<option value="' + value.id + '">' + value.name +
                                '</option>';
                        });
                        $("#super_subcategoryId").html(
                            `<option value="0">Select Super Sub-category</option><br>${option}`);
                        var element = document.getElementById("super_sub_category_section");
                        element.classList.remove("d-none");
                    } else {
                        var superCategoryListcount = document.getElementById('super_subcategoryId')
                            .length;
                        $("#super_subcategoryId").html(` `);
                        var element = document.getElementById("super_sub_category_section");
                        element.classList.add("d-none");
                    }

                });
            });


            // $(document).on('submit', '#subCategoryForm', function (e) {
            //     e.preventDefault();
            //     $("#loader").show();
            //     let $this = $(this);
            //     let form = $(this);
            //     console.log($this.attr('action'));
            //     var formData = new FormData(form[0]);
            //
            //     axios($this.attr('action'), formData).then(function (response) {
            //         console.log(response)
            //         $("#description").summernote("reset");
            //         $("#content").summernote("reset");
            //         $("#loader").hide();
            //     }).catch(function (error) {
            //         let errors = error.response.data.errors;
            //         $("#loader").hide();
            //         $.each(errors, function (key, value) {
            //             toastr.error(value)
            //         })
            //     });
            // })



            $(document).on('click', '.save-data', function(e) {
                e.preventDefault();
                var superCategoryListcount = document.getElementById('super_subcategoryId').length;
                var superCategoryValue = document.getElementById('super_subcategoryId').value;
                if (superCategoryListcount > 0 && superCategoryValue == 0) {
                    toastr.error('super sub category field is required');
                    return;
                }
                let $this = $(this);
                let form = $(this).parents('form');

                var formData = new FormData(form[0]);
                var request = $.ajax({
                    url: form.attr('action'),
                    method: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function(xhr) {
                        $("#loader").show();
                    }
                });
                request.done(function(msg) {
                    console.log(msg);
                    toastr.success("saved!")
                    form[0].reset()
                    $("#description").summernote("reset");
                    $("#content").summernote("reset");
                    $("#footer_content").summernote("reset");
                    $("#loader").hide();
                    window.location.assign("{{ route('admin.sub.category.index') }}");
                });

                request.fail(function(jqXHR, textStatus) {
                    let errors = jqXHR.responseJSON.errors;
                    $("#loader").hide();
                    $.each(errors, function(key, value) {
                        toastr.error(value)
                    })
                });


            });


            $(document).on('click', '.category-seo-data-store', function(e) {
                e.preventDefault();

                let $this = $(this);
                let form = $(this).parents('form');
                console.log(form);
                var formData = new FormData(form[0]);
                var request = $.ajax({
                    url: "{{ route('admin.main.sub-category.seo.store') }}",
                    method: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function(xhr) {
                        $("#loader").show();
                    }
                });
                request.done(function(msg) {
                    console.log(msg);
                    $("#loader").hide();
                    toastr.success("saved!")
                });

                request.fail(function(jqXHR, textStatus) {
                    let errors = jqXHR.responseJSON.errors;
                    $("#loader").hide();
                    $.each(errors, function(key, value) {
                        toastr.error(value)
                    })
                });


            })
        })
    </script>
@endsection
