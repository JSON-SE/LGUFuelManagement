@extends('layouts.Backend.admin.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/dropzone.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">

        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                     aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">Edit: {{$category->name ?? ""}}</h3>
            </div>
            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <a href="{{route('admin.category.index')}}" class="btn btn-primary d-flex align-items-center">
                    <span class="">All Categories</span>
                </a>
                <a href="{{route('admin.category.create')}}" class="btn btn-primary d-flex align-items-center ms-2">
                    <span class="">Add New Category</span>
                </a>
            </div>
        </div>
        @if(Session::has('message'))
            <p class="alert alert-success my-4">{{ Session::get('message') }}</p>
        @endif

        <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">

            <div class="p-lg-4 p-3 pb-5">
                <ul class="nav nav-tabs product-management-tab" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                                type="button" role="tab" aria-controls="basic" aria-selected="true">Basic
                            Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo"
                                type="button" role="tab" aria-controls="seo" aria-selected="false">SEO</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                        <form action="{{route('admin.category.update', $category->slug)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="pt-2">
                                <div class="row gx-2">
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" value="{{$category->name}}">
                                            <label for="name">Category Name<span class="text-primary">*</span></label>
                                        </div>
                                        <div class="input-group mt-2">
                                                <span class="input-group-text small"
                                                      id="basic-addon3">https://HeyBlinds.com/category/</span>
                                            <input type="text" class="form-control" id="basic-url" name="slug"
                                                   aria-describedby="basic-addon3" placeholder="Enter your slug" value="{{$category->slug}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div class="d-flex">
                                            <div id="uploadCategoryImage" class="product-image-uplode color-image-uplode scrollbar">
                                                <input type="file" name="image" id="categoryImage" class="form-control" accept="image/*">

                                            </div>
                                            <a target="_blank" href="{{$helpers->getThumbnail($category->media_id)}}"><img src="{{$helpers->getThumbnail($category->media_id)}}" class="img-fluid thumb ms-3" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-12  mt-3">
                                        <label>Excerpt</label>
                                        <div class="pt-2">
                                            <textarea class="summernote" name="meta_description" row="3">{{$category->meta_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <lable for="content">Product Specification</lable>
                                        <div class="d-block mt-2">
                                            <textarea class="summernote" name="description" id="content" row="3">{{$category->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4 text-end tab-btn-position">
                                <a href="{{route('admin.category.index')}}" class="btn btn-danger">Back</a>
                                <button class="btn btn-success save-data" data-url="{{route('admin.category.store')}}" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="pt-3">
                            <form action="{{route('admin.main.category.seo.store')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{$category->id}}">
                                @csrf
                                @include('admin.common.__seo')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin/js/dropzone.min.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        jQuery(function ($) {
            $("#categoryId").select2();
            $('input[name="name"]').on('keyup', function(){
                let $this = $(this);
                let slug = slugify($this.val());
                $("#basic-url").val(slug);
            })

            $("#seo_og_image").dropzone({
                url: "{{ route('upload.media') }}",
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                maxFiles: 1,
                dictDefaultMessage: 'Drop image here (or click) to capture/upload',
                maxFilesize: 2,
                maxfilesexceeded: function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                },
                success: function(file, response) {
                    console.log(response)
                    console.log(file)
                    if (response != 0) {
                        var inputEl = document.createElement('INPUT');
                        inputEl.setAttribute('type', 'hidden');
                        inputEl.setAttribute('name', 'seo_og_media_id');
                        inputEl.setAttribute('value', response.id);
                        file.previewTemplate.appendChild(inputEl);
                    }
                }
            });
        })
    </script>
@endsection
