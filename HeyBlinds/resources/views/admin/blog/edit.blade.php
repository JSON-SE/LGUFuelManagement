@extends('layouts.Backend.admin.admin')
@section('content')
<div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
    <div class="row pt-4">
        <div class="col-12">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row pb-4">
    <div class="col-sm-6 text-white my-auto">
        <h3 class="mb-0">Edit: {{ $blog->name }}</h3>
    </div>
    <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
        <!-- <button class="btn btn-light">New view</button> -->
      
        <a href="{{ route('admin.blog.index') }}" class="btn btn-primary d-flex align-items-center">
            <span
            class="">All Blogs</span>
        </a>
        
    </div>

</div>

<form action="
{{ route('admin.blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
@csrf
<div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">
    <div class="p-lg-4 p-3 pb-5">
        @include('partial.message')
        <div class="tab-content">
            <div class="pt-2">
                <div class="row gx-2">
                    <div class="col-lg-6 mt-3">
                        <div class="">
                            <label for=" name">Title
                                Name<span class="text-primary">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                placeholder="Title Name" value="{{ $blog->name }}" required>

                            </div>
                        </div>
                        <div class="col-lg-3 mt-3">
                            <div class="">
                                <label for="
                                blog_category">Category<span class="text-primary">*</span></label>
                                <select class="form-select form-control" id="blog_category"
                                name="category[]" multiple required>
                                <!-- <option value="{{ $blog->category }}">{{ $blog->category }}</option> -->
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array(
                                        $category->id,
                                        $blog->categories()->pluck('blog_category_id')->toArray(),
                                    )
                                    ? 'selected'
                                    : '' }}>
                                    {{ $category->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-3  mt-3">
                            <label for="uploadCategoryImage">Banner Image<span
                                class="text-primary">*</span></label>
                                <div id="uploadCategoryImage"
                                class="justify-content-center product-image-uplode color-image-uplode d-flex flex-wrap align-items-center ">
                                <input type="file" class="form-control" name="image" id="blogImage"
                                accept="image/*">
                            </div>
                            <a href="{{ $helpers->getThumbnail($blog->media_id) }}">View image</a>
                        </div>
                        <div class="col-lg-6 mb-3">
                                <div class="">
                                    <label for="name">Author By</label>
                                    <input type="text" class="form-control" id="author_by" name="author_by" placeholder="Author by" value="{{$blog->author_by}}" >
                                    
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="">
                                    <label for="name">Written By</label>
                                    <textarea  id="written_by" name="written_by">{{$blog->written_by}}</textarea>
                                </div>
                            </div>
                        <div class="col-12  mt-3">
                            <label>Description <span
                                class="text-primary">*</span></label>
                            <div class="pt-2">
                                <textarea id="description" name="description" >{{$blog->description}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 pb-4 text-end tab-btn-position">
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-danger">Back</a>
                    <button class="btn btn-success save-data" data-url="" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@push('js')
<script type="text/javascript">
    $(function() {
        $("#blog_category").select2();
        $('#written_by').summernote({
            placeholder: 'Written By',
            height: 200,
        });
        $('#description').summernote({
            placeholder: 'Blog Description',
            height: 350,
            focus: true,
           
            callbacks: {
                onImageUpload: function(files,editor,welEditable) {
                    sendFile(files[0],editor,welEditable);
                }
            }
        });
    });
    function sendFile(file,editor,welEditable) {
         $("#loader").show();
        data = new FormData();
        data.append("file", file);
        $.ajax({
            data: data,
            type: "POST",
            url: "/admin/blog/image/upload",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                $('#description').summernote("insertImage", url);
                $("#loader").hide();
            },
            error:function(error){
                $("#loader").hide();
            }
        });
    }
</script>
@endpush

@endsection