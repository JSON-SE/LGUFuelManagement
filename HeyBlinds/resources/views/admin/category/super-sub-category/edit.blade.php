@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                     aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Super Sub-Category</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">Edit: {{$supSubcategory->name}}</h3>
            </div>
            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <a href="{{route('admin.super-subcategory.index')}}" class="btn btn-primary d-flex align-items-center">
                    <span class="">All Super Sub-Category</span>
                </a>
                <a href="{{route('admin.super-subcategory.create')}}" class="btn btn-primary d-flex align-items-center ms-2">
                    <span class="">Create Super Sub-Category</span>
                </a>
            </div>
        </div>
        <form action="#" method="post" enctype="multipart/form-data" id="super-subcategory-form">
          
          <input type="hidden" name="super_subcategory_slug" id="super_subcategory_slug" value="{{$supSubcategory->slug}}">
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
                                            <input type="text" class="form-control" id="name" name="name"  value="{{ !empty(old('name')) ? old('name') : $supSubcategory->name}}" placeholder="Super Sub-category Name *">
                                            <label for="name">Super Sub-category Name <span class="text-primary">*</span> </label>
                                        </div>
                                        <div class="input-group mt-2">
                                                <span class="input-group-text small"
                                                      id="basic-addon3">https://HeyBlinds.com/category/{parent-category}/</span>
                                            <input type="text" class="form-control" id="basic-url" name="slug" value="{{ !empty(old('slug')) ? old('slug') :  $supSubcategory->slug}}"
                                                   aria-describedby="basic-addon3" placeholder="Enter your  *">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div class="form-floating">
                                            <select name="parent_category_name" id="categoryId" class="form-control">
                                                <option value="0">Select Category</option>
                                                @foreach($categories as $categoryNew)
                                                <option value="{{$categoryNew->id}}" {{ (!empty(old('parent_category_name')) ? old('parent_category_name') : $supSubcategory->category_id) === $categoryNew->id ? "selected" : ""}}>{{$categoryNew->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="category_id">Category<span class="text-primary">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div id="uploadCategoryImage" class="product-image-uplode color-image-uplode scrollbar">
                                            <input type="file" name="image" id="categoryImage" class="form-control" value="{{old('image')}}" accept="image/*">
                                        </div>
                                        <a class="mt-2" target="_blank" href="{{$helpers->getThumbnail($supSubcategory->media_id)}}"> <img class="thumb img-fluid" src="{{$helpers->getThumbnail($supSubcategory->media_id)}}" alt=""></a>
                                    </div>
                                    <div class="col-12  mt-3">
                                        <label>Excerpt</label>
                                        <div class="pt-2">
                                            <textarea class="summernote" id="description" name="description" row="3">{{ !empty(old('description')) ? old('description') : $supSubcategory->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <lable for="content">Product Specification</lable>
                                        <div class="d-block mt-2">
                                            <textarea class="summernote" name="content" id="content" row="3">{{ !empty(old('content')) ? old('content') : $supSubcategory->content}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4 text-end tab-btn-position">
                                <a href="{{route('admin.super-subcategory.index')}}" class="btn btn-danger">Back</a>
                                
                                 <button class="btn btn-success save-data" type="submit">Submit</button> 
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

                $(document).on('submit', '#super-subcategory-form', function (e) {
                    e.preventDefault();
                    var super_subcategory_slug = $('#super_subcategory_slug').val();
                    let $this = $(this);
                    let formData = $this.serialize();
                    axios.put(`/admin/super-subcategory/${super_subcategory_slug}`,formData).then((res)=>{
                        if(res.data.status == true){
                            toastr.success(res.data.message);
                        }
                    })
                    .catch((error) =>{
                        toastr.error('Something went wrong');
                    })
                })
        });
       
    </script>
@endsection
