@extends('layouts.Backend.admin.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('admin/css/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/slick.css')}}">
@endsection
@section('content')
    <form action="{{route('admin.product.name.store')}}" method="post" enctype="multipart/form-data" id="createProductForm">
        @csrf
        <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
            <div class="row pt-4">
                <div class="col-12">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                         aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-sm-6 text-white my-auto">
                    <h3 class="mb-0 add-product-name">Create Product</h3>
                </div>
                <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                    <!-- <button class="btn btn-light">New view</button> -->
                    <a href="{{route('admin.product.index')}}" class="btn btn-primary d-flex align-items-center ms-2">
                        <span class="">All Products</span>
                    </a>
                </div>
            </div>
            <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">
                <div class="p-lg-4 p-3 pb-5">
                    <ul class="nav nav-tabs __tabslide product-management-tab" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                                    type="button" role="tab" aria-controls="basic" aria-selected="true" >Basic
                                Information</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color"
                                    type="button" role="tab" aria-controls="color" aria-selected="false" disabled>Product
                                Colour</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="option-tab" data-bs-toggle="tab" data-bs-target="#option"
                                    type="button" role="tab" aria-controls="option" aria-selected="false" disabled>Product
                                Option</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="price-tab" data-bs-toggle="tab" data-bs-target="#price"
                                    type="button" role="tab" aria-controls="price" aria-selected="false"  disabled>Price</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="measure-tab" data-bs-toggle="tab" data-bs-target="#measure"
                                    type="button" role="tab" aria-controls="measure" aria-selected="false" disabled>Measure & Install Guide</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping"
                                    type="button" role="tab" aria-controls="shipping" aria-selected="false" disabled>Shipping & Production</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="warranty-tab" data-bs-toggle="tab" data-bs-target="#warranty"
                                    type="button" role="tab" aria-controls="warranty" aria-selected="false" disabled>Warranty</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                    type="button" role="tab" aria-controls="review" aria-selected="false" disabled>Customer Review</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="photos-tab" data-bs-toggle="tab" data-bs-target="#photos"
                                    type="button" role="tab" aria-controls="photos" aria-selected="false" disabled>Customer Photos</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo"
                                    type="button" role="tab" aria-controls="seo" aria-selected="false" disabled>SEO</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                            <div class="row pt-2">
                                <div class="col-lg-8">
                                    <div class="row gx-2">
                                        <div class="col-xl-7 col-md-8 mt-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control clone-product-name" id="name" name="name" placeholder="Product Name *" value="{{old('name')}}">
                                                <label for="name">Product Name <span class="text-primary">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 col-xl-3 mt-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control clone-product-name" id="sku" name="sku" placeholder="SKU *" value="{{old('sku')}}">
                                                <label for="sku">SKU <span class="text-primary">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-4 col-6 mt-3">
                                            <div class="form-floating">
                                                <input type="number" class="form-control clone-product-name" id="stock" name="stock" placeholder="Product Name" value="{{old('stock')}}">
                                                <label for="stock">Stock</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8 mt-3">
                                            <div class="input-group ">
												<span class="input-group-text small"
                                                      id="basic-addon3">https://HeyBlinds.ca/product/</span>
                                                <input type="text" class="form-control" id="basic-url" name="slug" placeholder="Enter your slug *" value="{{old('slug')}}">
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mt-3">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelectGrid" name="category">
                                                    <option value="">Select a category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" {{old('category') == $category->id ? "selected": "" }}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelectGrid">Category <span class="text-primary">*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mt-3">
                                            <div class="form-floating">
                                                <select class="form-select" id="subCategory" name="sub_category" >
                                                    <option value="">Select a subcategory</option>
                                                </select>
                                                <label for="subCategory">Sub-category</label>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-6 mt-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="default_width" placeholder="00" name="default_width" value="{{old('default_width')}}">
                                                <label for="default_width">Default Width <span class="text-primary">*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-xl-4  col-6 mt-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="default_height" placeholder="00" name="default_height" value="{{old('default_height')}}">
                                                <label for="default_height">Default Height <span class="text-primary">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-4  col-6 mt-3">
                                            <label >Feature One (50 Char Max) <span class="text-counter">0</span></label>
                                            <input type="text" maxlength="50"  class="form-control" name="features[]" value="{{old('features')}}">
                                        </div>
                                        <div class="col-xl-4  col-6 mt-3">
                                            <label >Feature Two (50 Char Max) <span class="text-counter">0</span></label>
                                            <input type="text" maxlength="50"  class="form-control" name="features[]" value="{{old('features')}}">
                                        </div>
                                        <div class="col-xl-4  col-6 mt-3">
                                            <label >Feature Three (50 Char Max) <span class="text-counter">0</span></label>
                                            <input type="text" maxlength="50"  class="form-control" name="features[]" value="{{old('features')}}">
                                        </div>
                                        <div class="col-xl-12 col-6 mt-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control clone-product-name" id="product_image_alt_title" name="product_image_alt_title" placeholder="Product image alt title" value="{{old('product_image_alt_title') }}">
                                                <label for="product_image_alt_title">Product image alt title <span class="text-primary">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-1">

                                                <div class="check-box d-inline-block mt-3 me-3">
                                                    <input class="form-check-input" type="checkbox" value="1" id="is_new" name="is_new" {{old('is_new') == 1 ? "checked" : ""}}>
                                                    <label class="form-check-label" for="is_new">
                                                        New Product
                                                    </label>
                                                </div>

                                                <div class="check-box d-inline-block mt-3 me-3">
                                                    <input class="form-check-input" type="checkbox" value="1" id="is_feature" name="is_feature" {{old('is_feature') == 1 ? "checked" : ""}}>
                                                    <label class="form-check-label" for="is_feature">
                                                        Make Featured
                                                    </label>
                                                </div>

                                                <div class="check-box d-inline-block mt-3 me-3">
                                                    <input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" {{old('show_home_page') == 1 ? "checked" : ""}}>
                                                    <label class="form-check-label" for="show_home_page">
                                                        Show On Home Page
                                                    </label>
                                                </div>

                                                <div class="check-box d-inline-block mt-3 me-3">
                                                    <input class="form-check-input" type="checkbox" value="1" id="is_on_sale" name="is_on_sale" {{old('is_on_sale') == 1 ? "checked" : ""}}>
                                                    <label class="form-check-label" for="is_on_sale">
                                                        On Sale
                                                    </label>
                                                </div>

                                                <div class="check-box d-inline-block mt-3 me-3">
                                                    <input class="form-check-input" type="checkbox" value="1" id="is_live" name="is_live" {{old('is_live') == 1 ? "checked" : ""}}>
                                                    <label class="form-check-label" for="is_live">
                                                        Inactive
                                                    </label>
                                                </div>
                                        </div>
                                        <div class="col-12  mt-3">
                                            <label>Excerpt (250 Char Max)</label>
                                            <div class="mt-2">
                                                <textarea maxlength="250" id="summernote-excerpt" name="excerpt" class="summernote">{{old('excerpt')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="pt-3">
                                                <div class="video-url-input mb-3">
                                                    <label class="mb-2">YouTube Video URL</label>
                                                    <div class="form-floating">
                                                        <select type="text" class="form-control enter-video-url" id="enter-video-url" name="video_url[]" multiple>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="upload-video-section ">
                                                    <label class="mb-2">Upload Videos</label>
                                                    <div class="dropzone justify-content-center product-video-uplode d-flex flex-wrap align-items-center scrollbar" id="video_id">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mt-lg-1 mt-3">
                                        <label class="mb-2" for="">Upload Product Display Image <span class="text-danger">*</span></label>
                                        <div class="dropzone justify-content-center product-image-uplode d-flex flex-wrap align-items-center scrollbar" id="display_image">
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label class="mb-2" for="">Upload Slider Images for Product Details Page</label>
                                        <div class="dropzone justify-content-center product-image-uplode d-flex flex-wrap align-items-center scrollbar" id="slider_image">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <label>Product Specification</label>
                                    <div class="d-block mt-2">
										<textarea class="summernote" name="content">
										Welcome to HeyBlinds!
									  </textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 pb-4 text-end tab-btn-position">
                        <button type="submit"  class="btn btn-secondary info-submit productBasicForm" name="draft" data-type="draft">Save Draft</button>
                        <button type="submit" class="btn btn-primary info-submit productBasicForm" name="save" data-type="save">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{asset('admin/js/dropzone.min.js')}}"></script>

    <script src="{{asset('admin/js/slick.min.js')}}"></script>

    <script>
        Dropzone.autoDiscover = false;
        jQuery(function ($) {
            $('input[name="name"], input[name="slug"]').on('keyup', function () {
                let $this = $(this);
                let slug = slugify($this.val());
                $("#basic-url").val(slug);
            })

            $("#floatingSelectGrid, #colorGroups").select2()
            $(" #enter-video-url").select2({
                theme: "classic",
                tags: "true",
                placeholder: "Select an option",
                allowClear: true
            })

            $("#floatingSelectGrid").on("select2:select", function (e) {
                let data = e.params.data;
                console.log(data);
                axios.post('{{route('admin.product.get.sub.category')}}', data)
                    .then(function (response) {
                        let data = response.data;
                        let html = '';
                        $.each(data, function (i, value){
                            console.log(value);
                            html += `<option value="">Select a subcategory</option><option value="${value.id}">${value.name}</option>`;
                        })
                        $("#subCategory").removeAttr('disabled').empty().append(html);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            })

            $("#video_id").dropzone({
                url: "{{route('upload.media')}}",
                chunking: true,
                method: "POST",
                maxFilesize: 100,
                chunkSize: 4000000,
                maxFiles: 5,
                thumbnailWidth: 100,
                parallelChunkUploads: true,
                dictDefaultMessage: 'Drop image here (or click) to capture/upload',
                maxfilesexceeded: function(file){
                    this.removeAllFiles();
                    this.addFile(file);
                },
                success: function (file, response) {

                    if(response != 0){
                        var inputEl = document.createElement('INPUT');
                        inputEl.setAttribute('type','hidden');
                        inputEl.setAttribute('name','video_id[]');
                        inputEl.setAttribute('value', response.id);
                        file.previewTemplate.appendChild(inputEl);
                    }
                }
            });
            $("#display_image").dropzone({
                url: "{{route('upload.media')}}",
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                maxFiles: 1,
                dictDefaultMessage: 'Drop image here (or click) to capture/upload',
                maxFilesize: 2,
                dictInvalidFileType: "Only image files like jpeg, jpg, png etc are allowed.",
                dictFileTooBig : "File is too big. Max file size: 2MB.",
                maxfilesexceeded: function(file){
                    this.removeAllFiles();
                    this.addFile(file);
                },
                success: function (file, response) {

                    if(response != 0){
                        var inputEl = document.createElement('INPUT');
                        inputEl.setAttribute('type','hidden');
                        inputEl.setAttribute('name','display_media_id');
                        inputEl.setAttribute('value', response.id);
                        file.previewTemplate.appendChild(inputEl);
                    }
                }
            });
            $("#slider_image").dropzone({
                url: "{{route('upload.media')}}",
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                maxFiles: 10,
                maxFilesize: 3,
                addRemoveLinks: true,
                dictDefaultMessage: 'Drop image here (or click) to capture/upload',
                dictInvalidFileType: "Only image files like jpeg, jpg, png etc are allowed.",
                dictFileTooBig : "File is too big. Max file size: 3MB.",
                maxfilesexceeded: function(file){
                    this.removeAllFiles();
                    this.addFile(file);
                },
                success: function (file, response) {

                    if(response != 0){
                        var inputEl = document.createElement('INPUT');
                        inputEl.setAttribute('type','hidden');
                        inputEl.setAttribute('name','slider_id[]');
                        inputEl.setAttribute('value', response.id);
                        file.previewTemplate.appendChild(inputEl);
                    }

                },
            })

            $(".productBasicForm").on("click", function(e){
                e.preventDefault();
                $("#loader").show();
                let $this = $(this);
                let form = $this.parents('form');
                var formData = new FormData(form[0]);
                formData.append('type', $this.attr('data-type'));
                axios.post('{{route('admin.product.name.store')}}', formData)
                .then(function (response) {
                    let data = response.data;
                    window.location = document.location.origin + "/admin/product/" + data.external_id + "/edit";
                    toastr.success("saved!")
                    $("#loader").hide();
                    window.location.assign("{{route('admin.product.index')}}");
                }).catch(function (error) {
                    $("#loader").hide();
                    let errors = error.response.data.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value)
                    })
                });
            })

            $('input[name="features[]"]').on('keyup', function (e) {
                let $this = $(this);
                let charCount = $this.val().length;
                $this.siblings().find('.text-counter').text(`(${charCount})`)
                maxLength($this)
            })

            $('.__tabslide').slick({
                arrows: true,
                speed: 500,
                slidesToShow: 5,
                slidesToScroll: 1,
                variableWidth: true,
                infinite: false,
            });
        })

        function get_hostname(url) {
            var m = url.match(/^http:\/\/[^/]+/);
            return m ? m[0] : null;
        }


    </script>
@endsection
